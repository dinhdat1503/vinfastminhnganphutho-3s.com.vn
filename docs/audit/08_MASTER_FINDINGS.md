# PHẦN 8: DANH MỤC LỖI TỔNG HỢP (MASTER FINDINGS REGISTRY)

> Bảng theo dõi duy nhất có mã định danh ổn định (ID), phân loại theo chuẩn AGENTS.md Mục 11 & WordPress Project Profile.

---

## 1. Bảng Tổng Hợp Danh Mục Lỗi (Master Registry Table)

| ID | Tiêu đề | Phân loại | Mức độ | Trạng thái | Vị trí file / Bằng chứng |
| :--- | :--- | :---: | :---: | :---: | :--- |
| **OPS-01** | Lệch tiền tố bảng giữa file dump SQL và file cấu hình | VERIFIED DEFECT | **P0** | OPEN | `wp-config.php:69` vs `database.sql:9-10` |
| **CODE-01** | Hardcoded đường dẫn tuyệt đối máy tính lập trình viên | VERIFIED DEFECT | **P0** | OPEN | `functions.php:65, 303, 307, 738, 825` |
| **OPS-02** | Toàn bộ plugin bị tắt và theme option rỗng trong DB | VERIFIED DEFECT | **P0** | OPEN | `database.sql:34, 41, 42` |
| **UI-01** | Báo thành công giả khi gửi SĐT thất bại | VERIFIED DEFECT | **P1** | OPEN | `footer.php:529-538` |
| **SEC-01** | Thiếu Nonce validation tại AJAX đăng ký tư vấn footer | VERIFIED DEFECT | **P1** | OPEN | `functions.php:3126-3135` |
| **SEC-02** | Dữ liệu người dùng chưa escape gây lỗi Telegram API | VERIFIED DEFECT | **P1** | OPEN | `functions.php:3071-3082, 3159-3163` |
| **ARCH-01** | Chỉnh sửa trực tiếp file style.css của Parent Theme | STATIC CODE RISK | **P1** | OPEN | `flatsome/style.css:24-118` |
| **ARCH-02** | Lệch tên template giữa DB và file Child Theme | STATIC CODE RISK | **P1** | OPEN | `database.sql` (posts 67, 102, 110, 123) |
| **CODE-02** | Xử lý điểm ảnh GD nặng chạy trên hook init | STATIC CODE RISK | **P1** | OPEN | `functions.php:226-292` |
| **CODE-03** | Tự động chèn bài viết demo vào DB khi chạy hook init | VERIFIED DEFECT | **P1** | OPEN | `functions.php:2872-2950` |
| **SEC-03** | Giao thức HTTP không an toàn & Mixed Content | STATIC CODE RISK | **P2** | OPEN | `database.sql:siteurl` & CF7 forms |
| **SEC-04** | Tồn dư 27 liên kết tuyệt đối tên miền cũ | STATIC CODE RISK | **P2** | OPEN | `database.sql:vinfasttanuyen.vn` |
| **SEC-05** | Hardcode STK ngân hàng và tạo VietQR client-side | STATIC CODE RISK | **P2** | OPEN | `page-dat-coc.php:1243, 1671` |
| **ARCH-03** | Trùng lặp Page Builder: Elementor vs UX Builder | STATIC CODE RISK | **P2** | OPEN | `plugins/elementor` vs UX shortcodes |
| **ARCH-04** | Trùng lặp Slider plugin: Smart Slider 3 vs Swiper | STATIC CODE RISK | **P2** | OPEN | `plugins/smart-slider-3` vs Swiper.js |
| **CODE-04** | Trùng lặp mã nguồn trong 16 template xe (>700KB) | STATIC CODE RISK | **P2** | OPEN | `template-parts/product/single-*.php` |
| **PERF-01** | Enqueue Swiper/GLightbox trên 100% trang web | STATIC CODE RISK | **P2** | OPEN | `functions.php:138-168` |
| **PERF-02** | File style.css quá lớn (279 KB) chưa được minify | STATIC CODE RISK | **P2** | OPEN | `vinfasttanachill/style.css` |
| **PERF-03** | Xung đột ghi DB của wp-insight với LiteSpeed Cache | STATIC CODE RISK | **P2** | OPEN | `wp-insight/includes/class-tracker.php` |
| **PERF-04** | Hotlinking hình ảnh trực tiếp sang CDN bên ngoài | STATIC CODE RISK | **P2** | OPEN | `functions.php:837` |
| **UI-02** | Ép font `!important` toàn cục phá vỡ icon fonts | UX IMPROVEMENT | **P2** | OPEN | `style.css:31-33` |
| **UI-03** | Khai báo font Mulish nhưng không nạp từ Google Fonts | UX IMPROVEMENT | **P3** | OPEN | `style.css:15` vs `functions.php:155` |
| **UI-04** | Quá nhiều nút nổi trên mobile và thiếu reduced-motion | UX IMPROVEMENT | **P3** | OPEN | `footer.php:457-486` |

---

## 2. Chi Tiết Từng Finding Theo Tiêu Chuẩn AGENTS.md

### FINDING — OPS-01
- **Title:** Lệch tiền tố bảng cơ sở dữ liệu giữa bản dump SQL và wp-config.php.
- **Classification:** VERIFIED DEFECT.
- **Severity:** P0 (Chặn Release / Chặn Khôi Phục).
- **Confidence:** CONFIRMED.
- **Status:** OPEN.
- **Owner/User Impact:** Quản trị viên và kỹ sư DevOps không thể khôi phục website trên máy chủ mới; website sẽ báo lỗi cơ sở dữ liệu hoặc kích hoạt màn hình cài đặt mới.
- **Affected Area:** DevOps / Database Migration (`database.sql`, `wp-config.php`).
- **Evidence:** [wp-config.php:69](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/wp-config.php#L69) ghi `$table_prefix = 'v5E_default';`; [database.sql:9-10](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql#L9-L10) tạo bảng dạng `SERVMASK_PREFIX_actionscheduler_actions`.
- **Current Behavior:** Import SQL trực tiếp vào MySQL tạo ra 59 bảng `SERVMASK_PREFIX_*`, không khớp với `$table_prefix`.
- **Expected Behavior:** Tên bảng trong cơ sở dữ liệu phải khớp chính xác với tiền tố `$table_prefix`.
- **Minimal Recommended Fix:** Chạy script thay thế chuỗi tự động `SERVMASK_PREFIX_` thành `v5E_default_` trên file `database.sql` trước khi import, hoặc cập nhật tài liệu hướng dẫn khôi phục qua plugin All-in-One WP Migration.
- **Verification:** Kiểm tra khớp tên bảng sau khi import: `SHOW TABLES LIKE 'v5E_default_%'`.

---

### FINDING — CODE-01
- **Title:** Hardcoded đường dẫn tuyệt đối ổ cứng Windows của lập trình viên trong functions.php.
- **Classification:** VERIFIED DEFECT.
- **Severity:** P0 (Chặn Release).
- **Confidence:** CONFIRMED.
- **Status:** OPEN.
- **Owner/User Impact:** Hệ thống bị lỗi hoặc không thể tự động đồng bộ logo, banner, ảnh xe khi đưa lên hosting Linux; làm lộ thư mục riêng tư cá nhân.
- **Affected Area:** Backend / Child Theme Core ([functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php)).
- **Evidence:** Dòng 65, 303, 307, 738, 825-827 chứa `C:/Users/ngodi/...`.
- **Current Behavior:** PHP cố gắng gọi `file_exists()` và `copy()` các file trong ổ `C:` ngay trên môi trường hosting Linux `/home/...`.
- **Expected Behavior:** Toàn bộ đường dẫn tệp tin phải sử dụng hàm động của WordPress: `get_stylesheet_directory()`, `wp_upload_dir()['basedir']`.
- **Minimal Recommended Fix:** Xóa bỏ toàn bộ các biến chứa đường dẫn ổ `C:` cục bộ; chuyển các file tài nguyên tĩnh này vào thư mục `assets/` của Child Theme và tham chiếu qua `get_stylesheet_directory_uri()`.
- **Verification:** Chạy regex scan toàn bộ thư mục Child Theme không còn chuỗi `C:/Users/`.

---

### FINDING — UI-01
- **Title:** Form đăng ký tư vấn chân trang hiển thị thông báo thành công giả khi request thất bại.
- **Classification:** VERIFIED DEFECT.
- **Severity:** P1.
- **Confidence:** CONFIRMED.
- **Status:** OPEN.
- **Owner/User Impact:** Khách hàng bị mất thông tin tư vấn; đại lý mất khách hàng tiềm năng.
- **Affected Area:** Frontend / Chân trang ([footer.php](file:///d:/DinhDat/Me/vinfasttanachill/footer.php)).
- **Evidence:** [footer.php dòng 529-538](file:///d:/DinhDat/Me/vinfasttanachill/footer.php#L529-L538) trong khối `.catch(function(err))`:
  `notice.textContent = '✓ Đã nhận số điện thoại! Chuyên viên sẽ gọi tư vấn ngay.';`
- **Current Behavior:** Khi lỗi mạng hoặc HTTP 500, form báo thành công màu xanh lá.
- **Expected Behavior:** Phải hiển thị thông báo lỗi màu đỏ rõ ràng: *"Không thể gửi yêu cầu lúc này, vui lòng liên hệ hotline..."*
- **Minimal Recommended Fix:** Sửa nội dung trong khối `.catch()` thành thông báo lỗi trung thực và không xóa trắng số điện thoại của khách để họ có thể thử lại.
- **Verification:** Ngắt kết nối mạng hoặc chặn URL admin-ajax.php, bấm gửi form và quan sát thông báo hiển thị.

---

### FINDING — SEC-01
- **Title:** Thiếu Nonce Verification tại endpoint AJAX `vf_submit_footer_service_form`.
- **Classification:** VERIFIED DEFECT.
- **Severity:** P1.
- **Confidence:** CONFIRMED.
- **Status:** OPEN.
- **Owner/User Impact:** Nguy cơ bị spammer và bot tự động tấn công làm tràn ngập hòm thư và kênh Telegram.
- **Affected Area:** Backend AJAX Handlers ([functions.php dòng 3126-3135](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L3126-L3135)).
- **Evidence:** Hàm `vfvp_handle_footer_service_form()` trực tiếp đọc `$_POST['phone']` mà không gọi `check_ajax_referer()`.
- **Current Behavior:** Bất kỳ request POST nào đến admin-ajax.php có action này đều được xử lý và gửi mail/Telegram.
- **Expected Behavior:** Phải gửi kèm `nonce` token tạo bởi `wp_create_nonce('vfvp_ajax_nonce')` và kiểm tra qua `check_ajax_referer('vfvp_ajax_nonce', 'nonce')`.
- **Minimal Recommended Fix:** Bổ sung tham số `nonce` vào `FormData` trong `footer.php` và thêm lệnh `check_ajax_referer('vfvp_ajax_nonce', 'nonce');` vào đầu hàm `vfvp_handle_footer_service_form()`.
- **Verification:** Gửi request POST không có nonce token, server trả về mã lỗi 403 `Forbidden`.

---

### FINDING — SEC-02
- **Title:** Dữ liệu người dùng chưa escape gây lỗi cú pháp Telegram HTML API và làm rớt đơn cọc.
- **Classification:** VERIFIED DEFECT.
- **Severity:** P1.
- **Confidence:** CONFIRMED.
- **Status:** OPEN.
- **Owner/User Impact:** Khách đặt cọc hoặc để lại ghi chú có chứa ký tự `<` hoặc `&` sẽ khiến Telegram Bot không gửi được tin báo, nhân viên không biết có đơn cọc mới.
- **Affected Area:** Telegram Automation ([functions.php dòng 3071-3082, 3159-3163](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L3071-L3082)).
- **Evidence:** Biến `$name`, `$note`, `$phone` được nối chuỗi trực tiếp vào văn bản HTML mà không dùng `htmlspecialchars()`.
- **Current Behavior:** Người dùng nhập `Nguyễn Văn A <Vinh Phuc>` khiến Telegram trả về lỗi HTTP 400 và không đẩy tin.
- **Expected Behavior:** Mọi trường dữ liệu người dùng phải được escape qua `htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')`.
- **Minimal Recommended Fix:** Bọc toàn bộ biến người dùng bằng `htmlspecialchars()` trước khi ghép chuỗi vào `$tg_msg`.
- **Verification:** Gửi đơn đặt cọc thử nghiệm với tên `Test <Script> & Co`, tin nhắn vẫn đến Telegram bình thường với ký tự hiển thị an toàn.

