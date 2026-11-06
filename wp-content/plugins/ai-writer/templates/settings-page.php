<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$saved    = isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] === 'true';
$api_key  = get_option( 'ai_writer_gemini_api_key', '' );
$language = get_option( 'ai_writer_language', 'vi' );
$model    = get_option( 'ai_writer_model', 'gemini-2.0-flash' );
if ( empty( $model ) ) {
    $model = 'gemini-2.0-flash';
}
?>
<div class="aiw-settings-wrap">

    <!-- Header -->
    <div class="aiw-settings-header">
        <div class="aiw-icon">✨</div>
        <div>
            <h1>AI Writer — Trợ Lý Viết Bài</h1>
            <p>Sử dụng Google Gemini AI để gợi ý tiêu đề SEO, meta description, từ khóa và cải thiện đoạn văn.</p>
        </div>
    </div>

    <?php if ( $saved ) : ?>
        <div class="notice notice-success is-dismissible" style="border-radius:8px;padding:12px 16px;">
            <p>✅ Cài đặt đã được lưu thành công!</p>
        </div>
    <?php endif; ?>

    <form method="post" action="options.php" id="aiw-settings-form">
        <?php settings_fields( 'ai_writer_options' ); ?>

        <!-- API Key Card -->
        <div class="aiw-card">
            <h2>🔑 Google Gemini API Key</h2>

            <div class="aiw-form-group">
                <label for="ai_writer_gemini_api_key">API Key</label>
                <div class="aiw-api-key-row">
                    <input
                        type="password"
                        id="ai_writer_gemini_api_key"
                        name="ai_writer_gemini_api_key"
                        value="<?php echo esc_attr( $api_key ); ?>"
                        placeholder="AIza..."
                    />
                    <button type="button" class="aiw-btn aiw-btn-test" id="aiw-test-btn">
                        🔗 Test kết nối
                    </button>
                </div>
                <p class="aiw-hint-text">
                    Lấy API key miễn phí tại
                    <a href="https://aistudio.google.com/apikey" target="_blank">aistudio.google.com/apikey</a>
                    &nbsp;|&nbsp;
                    <span class="aiw-badge aiw-badge-free">✓ Miễn phí với quota hàng ngày</span>
                </p>
            </div>

            <div id="aiw-test-result" style="display:none;" class="aiw-test-result"></div>
        </div>

        <!-- Config Card -->
        <div class="aiw-card">
            <h2>⚙️ Cấu hình</h2>

            <div class="aiw-form-group">
                <label for="ai_writer_language">Ngôn ngữ output AI</label>
                <select id="ai_writer_language" name="ai_writer_language">
                    <option value="vi" <?php selected( $language, 'vi' ); ?>>🇻🇳 Tiếng Việt</option>
                    <option value="en" <?php selected( $language, 'en' ); ?>>🇺🇸 English</option>
                </select>
            </div>

            <div class="aiw-form-group">
                <label for="ai_writer_model">Model Gemini</label>
                <select id="ai_writer_model" name="ai_writer_model">
                    <option value="gemini-2.0-flash" <?php selected( $model, 'gemini-2.0-flash' ); ?>>
                        🚀 gemini-2.0-flash (Mới nhất, Nhanh & Miễn phí)
                    </option>
                    <option value="gemini-1.5-flash-latest" <?php selected( $model, 'gemini-1.5-flash-latest' ); ?>>
                        ⚡ gemini-1.5-flash-latest (Ổn định & Miễn phí)
                    </option>
                    <option value="gemini-1.5-flash" <?php selected( $model, 'gemini-1.5-flash' ); ?>>
                        ⚡ gemini-1.5-flash (Tiêu chuẩn Miễn phí)
                    </option>
                </select>
                <p class="aiw-hint-text">💡 <strong>Mới:</strong> Plugin đã tích hợp cơ chế <em>Auto-Fallback 6 cấp độ</em>. Nếu bất kỳ model nào bị bảo trì hoặc lỗi 404/429, hệ thống sẽ tự động thử các model dự phòng tiếp theo để đảm bảo luôn kết nối thành công!</p>
            </div>
        </div>

        <!-- Save Button -->
        <div style="text-align:right;">
            <?php submit_button( '💾 Lưu cài đặt', 'primary aiw-btn aiw-btn-save', 'submit', false ); ?>
        </div>
    </form>

    <!-- Usage Guide -->
    <div class="aiw-card" style="margin-top:24px;">
        <h2>📖 Hướng dẫn sử dụng</h2>
        <ol style="line-height:2;color:#374151;font-size:14px;">
            <li>Nhập Gemini API Key ở trên và bấm <strong>Lưu cài đặt</strong></li>
            <li>Mở bất kỳ bài viết nào trong Gutenberg Editor</li>
            <li>Ở góc trên bên phải, bấm vào <strong>⋮ → ✨ AI Writer</strong></li>
            <li>Sidebar AI Writer sẽ xuất hiện với 4 tab chức năng</li>
        </ol>
    </div>
</div>

<script>
document.getElementById('aiw-test-btn').addEventListener('click', async function () {
    const btn    = this;
    const result = document.getElementById('aiw-test-result');
    btn.textContent = '⏳ Đang kiểm tra...';
    btn.disabled = true;
    result.style.display = 'none';

    try {
        const res = await fetch('<?php echo esc_url( rest_url("ai-writer/v1/test") ); ?>', {
            headers: { 'X-WP-Nonce': '<?php echo wp_create_nonce("wp_rest"); ?>' }
        });
        const data = await res.json();
        result.className = 'aiw-test-result ' + ( data.success ? 'success' : 'error' );
        result.textContent = ( data.success ? '✅ ' : '❌ ' ) + data.message;
    } catch (e) {
        result.className = 'aiw-test-result error';
        result.textContent = '❌ Lỗi kết nối: ' + e.message;
    }

    result.style.display = 'block';
    btn.textContent = '🔗 Test kết nối';
    btn.disabled = false;
});
</script>
