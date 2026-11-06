<?php
/**
 * Lớp kết nối Google Gemini API - Chuyên biệt VinFast Vĩnh Phúc (Ô tô điện VinFast)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class AI_Writer_Gemini_API {

    private $api_key;
    private $model;
    private $language;
    private $api_url = 'https://generativelanguage.googleapis.com/v1beta/models/';

    public function __construct() {
        $this->api_key  = get_option( 'ai_writer_gemini_api_key', '' );
        $model          = get_option( 'ai_writer_model', 'gemini-2.0-flash' );
        if ( empty( $model ) ) {
            $model = 'gemini-2.0-flash';
        }
        $this->model    = $model;
        $this->language = get_option( 'ai_writer_language', 'vi' );
    }

    /**
     * Quy tắc hệ thống (System Rule): Giới hạn phạm vi CHỈ tập trung vào Ô tô điện VinFast
     */
    private function system_instruction(): string {
        $lang = $this->language === 'vi' ? 'Trả lời hoàn toàn bằng tiếng Việt.' : 'Reply entirely in English.';
        return "{$lang}\n"
             . "QUY TẮC BẮT BUỘC (STRICT RULE):\n"
             . "Bạn là Chuyên gia Content & SEO thương hiệu Ô TÔ ĐIỆN VINFAST (Đại lý VinFast Vĩnh Phúc).\n"
             . "Mọi gợi ý tiêu đề, meta description, từ khóa SEO và nội dung viết lại BẮT BUỘC CHỈ TẬP TRUNG 100% VÀO CÁC DÒNG Ô TÔ ĐIỆN VINFAST (bao gồm các dòng xe: VF 2, VF 3, VF 5, VF 6, VF 7, VF 8, VF 8 The All New, VF 9, Minio Green, Limo Green, Herio Green, Nerio Green, EC Van, eBus, Pin & Trạm sạc V-Energy, ưu đãi chính hãng, báo giá lăn bánh, đăng ký lái thử, bảo hành).\n"
             . "TUYỆT ĐỐI KHÔNG viết hoặc tư vấn về xe máy điện, xe 2 bánh hay bất kỳ thương hiệu ô tô nào khác ngoài VinFast.";
    }

    /**
     * Gọi Gemini API với danh sách model dự phòng (Fallback)
     */
    private function call_api( string $prompt, array $try_models = [] ): string|WP_Error {
        if ( empty( $this->api_key ) ) {
            return new WP_Error( 'no_api_key', 'Chưa cấu hình Gemini API Key. Vào Settings > AI Writer để nhập.' );
        }

        if ( empty( $try_models ) ) {
            $try_models = array_values( array_unique( array_filter( [
                $this->model,
                'gemini-2.0-flash',
                'gemini-1.5-flash-latest',
                'gemini-1.5-flash',
                'gemini-2.0-flash-exp',
                'gemini-2.5-flash',
            ] ) ) );
        }

        $current_model = array_shift( $try_models );
        $endpoint      = $this->api_url . $current_model . ':generateContent?key=' . $this->api_key;

        $body = wp_json_encode( [
            'contents' => [
                [
                    'parts' => [
                        [ 'text' => $prompt ]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature'     => 0.7,
                'maxOutputTokens' => 8192,
            ]
        ] );

        $response = wp_remote_post( $endpoint, [
            'headers' => [ 'Content-Type' => 'application/json' ],
            'body'    => $body,
            'timeout' => 30,
        ] );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code( $response );
        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( $code !== 200 ) {
            $msg = $data['error']['message'] ?? 'Lỗi không xác định từ Gemini API';

            // Nếu model hiện tại bị 404 (Not Found) hoặc 429 (Quota limit), tự động thử model dự phòng tiếp theo
            if ( ! empty( $try_models ) && ( $code === 404 || $code === 429 || str_contains( strtolower( $msg ), 'not found' ) || str_contains( strtolower( $msg ), 'quota' ) || str_contains( strtolower( $msg ), 'limit' ) ) ) {
                return $this->call_api( $prompt, $try_models );
            }

            return new WP_Error( 'api_error', $msg );
        }

        return $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
    }

    /**
     * Gợi ý 3 tiêu đề SEO Ô tô điện VinFast
     */
    public function generate_titles( string $topic ): string|WP_Error {
        $sys = $this->system_instruction();
        $prompt = "{$sys}\n"
                . "Hãy gợi ý đúng 3 tiêu đề bài viết SEO khác nhau, cực kỳ hấp dẫn, tối ưu lượt click CHUYÊN CHỦ ĐỀ Ô TÔ ĐIỆN VINFAST dựa trên chủ đề hoặc từ khóa dưới đây.\n"
                . "Mỗi tiêu đề nằm trên 1 dòng riêng biệt, bắt đầu bằng số thứ tự từ 1 đến 3 (Ví dụ: 1. Tiêu đề...\n 2. Tiêu đề...). Không ghi thêm bất kỳ lời giải thích hay dẫn nhập nào khác.\n"
                . "Chủ đề: {$topic}";
        return $this->call_api( $prompt );
    }

    /**
     * Tạo meta description từ nội dung
     */
    public function generate_meta( string $content ): string|WP_Error {
        $sys   = $this->system_instruction();
        $short = mb_substr( strip_tags( $content ), 0, 1500 );
        $prompt = "{$sys}\n"
                . "Viết 1 meta description (150-160 ký tự) hấp dẫn, có từ khóa SEO ô tô điện VinFast chính hãng, thúc đẩy click cho bài viết dưới đây. Chỉ trả về meta description, không thêm gì khác.\n"
                . "Nội dung bài: {$short}";
        return $this->call_api( $prompt );
    }

    /**
     * Gợi ý từ khóa SEO Ô tô điện VinFast
     */
    public function suggest_keywords( string $content, bool $is_topic = false ): string|WP_Error {
        $sys = $this->system_instruction();
        if ( $is_topic ) {
            $prompt = "{$sys}\n"
                    . "Hãy gợi ý 10 từ khóa SEO quan trọng nhất CHUYÊN VỀ Ô TÔ ĐIỆN VINFAST (bao gồm cả từ khóa ngắn và long-tail keywords) liên quan đến chủ đề sau. Liệt kê dạng danh sách, mỗi từ khóa 1 dòng. Không giải thích gì thêm.\n"
                    . "Chủ đề gốc: {$content}";
        } else {
            $short = mb_substr( strip_tags( $content ), 0, 1500 );
            $prompt = "{$sys}\n"
                    . "Phân tích nội dung bài và gợi ý 10 từ khóa SEO quan trọng nhất CHUYÊN VỀ Ô TÔ ĐIỆN VINFAST, bao gồm cả long-tail keywords. Liệt kê dạng danh sách, mỗi từ khóa 1 dòng. Không giải thích.\n"
                    . "Nội dung: {$short}";
        }
        return $this->call_api( $prompt );
    }

    /**
     * Cải thiện đoạn văn chuẩn phong cách VinFast
     */
    public function improve_text( string $text, string $style = 'professional' ): string|WP_Error {
        $sys = $this->system_instruction();
        $style_map = [
            'professional' => 'chuyên nghiệp, chuẩn hãng VinFast',
            'friendly'     => 'thân thiện, tư vấn tận tâm',
            'concise'      => 'ngắn gọn, súc tích, làm nổi bật ưu điểm xe điện',
            'engaging'     => 'hấp dẫn, cuốn hút, thúc đẩy nhận báo giá / lái thử',
        ];
        $style_desc = $style_map[ $style ] ?? 'chuyên nghiệp';
        $prompt = "{$sys}\n"
                . "Viết lại đoạn văn sau theo phong cách {$style_desc}, chuẩn tinh thần ô tô điện VinFast Vĩnh Phúc. Chỉ trả về đoạn văn đã viết lại, không thêm gì khác.\n"
                . "Đoạn văn gốc:\n{$text}";
        return $this->call_api( $prompt );
    }

    /**
     * Test kết nối API
     */
    public function test_connection(): array {
        $result = $this->call_api( 'Trả lời đúng 1 từ: "OK"' );
        if ( is_wp_error( $result ) ) {
            return [ 'success' => false, 'message' => $result->get_error_message() ];
        }
        return [ 'success' => true, 'message' => 'Kết nối thành công! AI Writer đã sẵn sàng làm Chuyên gia Ô tô điện VinFast Vĩnh Phúc.' ];
    }
}
