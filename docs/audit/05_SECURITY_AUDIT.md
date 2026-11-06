# PHẦN 5: KIỂM TOÁN AN TOÀN & BẢO MẬT (SECURITY AUDIT)

## 1. Các Lỗ Hổng Bảo Mật Đã Xác Minh (Verified Vulnerabilities)

### 1.1. Thiếu Kiểm Tra Nonce Token Tại Endpoint Tiếp Nhận SĐT Tư Vấn (Missing Nonce CSRF)
- **Vị trí:** Tệp tin [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L3126-L3135), hàm `vfvp_handle_footer_service_form()`.
- **Đoạn mã vi phạm:**
  ```php
  add_action('wp_ajax_vf_submit_footer_service_form', 'vfvp_handle_footer_service_form');
  add_action('wp_ajax_nopriv_vf_submit_footer_service_form', 'vfvp_handle_footer_service_form');
  function vfvp_handle_footer_service_form() {
      $phone = sanitize_text_field($_POST['phone'] ?? '');
      ...
  ```
- **Hành vi thực tế:** Trong khi các endpoint khác (`vf_submit_acc_order`, `vf_submit_deposit_form`) đều gọi `check_ajax_referer()` để kiểm tra Nonce hợp lệ, thì endpoint `vf_submit_footer_service_form` hoàn toàn **không có bất kỳ kiểm tra Nonce nào**.
- **Tác động:** Kẻ tấn công hoặc các script bot tự động có thể gửi hàng nghìn request POST giả mạo đến `wp-admin/admin-ajax.php?action=vf_submit_footer_service_form` mà không cần truy cập website, gây ngập lụt hòm thư ban quản lý và làm nghẽn nhóm Telegram của phòng bán hàng (Spam DoS).
- **Phân loại:** **VERIFIED DEFECT (P1)**.

### 1.2. Lỗi Chèn Chuỗi Làm Hỏng Định Dạng Telegram HTML (Telegram Entity Breakage)
- **Vị trí:** Tệp tin [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L3071-L3082) và [dòng 3159-3163](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L3159-L3163).
- **Mã nguồn:**
  ```php
  $tg_msg  = "🚗 <b>[YÊU CẦU ĐẶT CỌC XE VINFAST]</b>\n";
  $tg_msg .= "👤 <b>Khách hàng:</b> {$name}\n";
  $tg_msg .= "📝 <b>Ghi chú:</b> {$note}\n";
  vfvp_send_telegram($tg_msg);
  ```
  Và tại `vfvp_send_telegram()`:
  ```php
  'body' => [
      'chat_id'    => $chat_id,
      'text'       => $text,
      'parse_mode' => 'HTML',
  ]
  ```
- **Hành vi thực tế:** Giá trị `$name`, `$note` là dữ liệu do người dùng tự nhập từ form đặt cọc hoặc form phụ kiện, chỉ qua `sanitize_text_field()` mà **chưa qua `htmlspecialchars()`**.
- **Tác động:** Khi khách hàng vô tình hoặc cố ý nhập tên/ghi chú chứa các ký tự đặc biệt như `<`, `>`, `&` (Ví dụ: `Nguyễn Văn A <VinFast>` hoặc `Mua xe & phụ kiện`), Telegram Bot API sẽ phát hiện lỗi cú pháp thẻ HTML chưa đóng và trả về mã lỗi HTTP `400 Bad Request: can't parse entities`. Kết quả là **tin nhắn thông báo đặt cọc bị hủy bỏ âm thầm**, nhân viên trực bán hàng hoàn toàn không nhận được tin báo về đơn cọc này!
- **Phân loại:** **VERIFIED DEFECT (P1)**.

---

## 2. Kiểm Toán Giao Thức & Dữ Liệu Miền (Protocol & Domain Integrity)

### 2.1. Cấu Hình Giao Thức HTTP Không An Toàn (Mixed Content & Insecure Siteurl)
- **Trong cơ sở dữ liệu [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql):**
  - Tùy chọn `siteurl` và `home` được cấu hình là: `http://vinhphucvinfast.com.vn` (giao thức `http://` không mã hóa thay vì `https://`).
  - Ghi nhận **57 đường dẫn `http://`** trỏ tới các tài nguyên nội bộ, ảnh đại diện và form Contact Form 7 (Ví dụ: `<img id="td_car_img" src="http://vinhphucvinfast.com.vn/.../c64.png">`).
- **Tác động:** Khi website chạy trên chứng chỉ SSL/HTTPS của LiteSpeed, trình duyệt sẽ cảnh báo ổ khóa đỏ hoặc lỗi "Mixed Content" (nội dung hỗn hợp không an toàn), chặn các ảnh và script tải qua HTTP.

### 2.2. Tồn Dư Tên Miền Cũ Của Đơn Vị Khác (`vinfasttanuyen.vn`)
- Trong [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql) ghi nhận **27 liên kết tuyệt đối trỏ tới tên miền bên ngoài:** `https://vinfasttanuyen.vn/...`.
- **Rủi ro:** Khi domain `vinfasttanuyen.vn` hết hạn hoặc thay đổi cấu trúc thư mục, các hình ảnh và tài nguyên này sẽ bị lỗi hình ảnh vỡ (broken images) trên trang người dùng.

---

## 3. Quản Trị Cấu Hình Nhận Tiền & Tài Khoản Ngân Hàng (Financial Security)

- **Vấn đề phát hiện:**
  - Thông tin số tài khoản nhận đặt cọc xe (`118002889999` — VietinBank CN Vĩnh Phúc) và API URL sinh mã VietQR (`https://img.vietqr.io/image/vietinbank-118002889999-compact2.png`) được hardcode trực tiếp vào mã JavaScript và HTML của trang [page-dat-coc.php](file:///d:/DinhDat/Me/vinfasttanachill/page-dat-coc.php#L1243-L1671).
  - Không có giao diện cấu hình quản trị trong WP Admin (khi đại lý đổi số tài khoản hoặc đổi ngân hàng ủy quyền, bắt buộc phải mở file PHP/JS sửa trực tiếp).
  - Không có bản ghi lưu trữ giao dịch (Order Transaction) có hiệu lực ở backend; đơn cọc phụ thuộc hoàn toàn vào luồng gửi email và Telegram. Nếu email/Telegram gặp sự cố mạng, đại lý không thể tra cứu lại thông tin đơn cọc trong database.

---

## 4. Kiểm Toán Cấu Hình Bảo Mật `wp-config.php`

- **Kiểm tra tiền tố bảng (Table Prefix):** Khai báo `$table_prefix = 'v5E_default';` — Giúp phòng chống các cuộc tấn công SQL Injection tự động nhắm vào tiền tố mặc định `wp_`.
- **Kiểm tra chế độ gỡ lỗi (WP_DEBUG):** Khai báo `define('WP_DEBUG', false);` — Đảm bảo an toàn không hiển thị stack trace hoặc đường dẫn file nội bộ ra màn hình người dùng. Tuy nhiên thiếu hằng số `WP_DEBUG_LOG` để ghi nhận lỗi âm thầm phục vụ bảo trì.
- **Tự động cập nhật Core (WP_AUTO_UPDATE_CORE):** Đang bật `define('WP_AUTO_UPDATE_CORE', true);` — Cần lưu ý việc tự động nâng cấp phiên bản WordPress Core lớn (Major release) có thể gây xung đột với theme Flatsome hoặc các plugin chưa tương thích.
- **Bảo vệ Secrets:** Toàn bộ mật khẩu cơ sở dữ liệu, Salt keys và Auth keys trong `wp-config.php` đã được kiểm tra tính bảo mật và **không bị hiển thị hay lưu vết trong báo cáo này** theo đúng nguyên tắc AGENTS.md Mục 3.

