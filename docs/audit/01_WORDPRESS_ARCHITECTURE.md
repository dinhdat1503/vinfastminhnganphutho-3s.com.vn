# PHẦN 1: KIỂM TOÁN KIẾN TRÚC WORDPRESS (WORDPRESS ARCHITECTURE)

## 1. Thông Tin Phiên Bản Cốt Lõi (Core & Runtime Environment)

- **WordPress Core:** `7.1.2` (Xác minh từ file [version.php](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/wp-includes/version.php#L19)).
- **WordPress DB Version:** `61833`.
- **Yêu cầu PHP tối thiểu của Core:** PHP `7.4` (Core yêu cầu tối thiểu 7.4; môi trường hosting thực tế sử dụng PHP 8.x).
- **Yêu cầu PHP Extensions:** `json`, `hash`, `gd` / `imagick`, `mysqli`, `curl`, `mbstring`.
- **Hệ quản trị cơ sở dữ liệu:** MariaDB (Xác minh từ header dump `Ai1wm_Database_Mariadb` trong [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql#L6)). Phiên bản tương thích tối thiểu: MySQL 5.5.5 / MariaDB 10.3+.
- **Web Server:** LiteSpeed Web Server (Xác minh từ khối chỉ thị `<IfModule Litespeed>` trong file [.htaccess](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/.htaccess#L6-L8)).
- **Môi trường Hosting thực tế:** Linux cPanel/DirectAdmin hosting, đường dẫn tuyệt đối máy chủ: `/home/hkruxcnchosting/domains/vinhphucvinfast.com.vn/` (Xác minh từ bảng `SERVMASK_PREFIX_options` key `recently_edited`).

---

## 2. Kiến Trúc Theme & Tình Trạng Kế Thừa (Theme Hierarchy)

### 2.1. Parent Theme (Theme Mẹ)
- **Tên Theme:** Flatsome (Classic WooCommerce Theme có UX Builder tích hợp).
- **Phiên bản:** `3.20.2` (Xác minh từ [style.css](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/wp-content/themes/flatsome/style.css#L7)).
- **Tác giả:** UX-Themes.
- **Tình trạng kiểm toán (STATIC RISK):** Parent theme đã bị chỉnh sửa trực tiếp vào file cốt lõi [style.css](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/wp-content/themes/flatsome/style.css#L24-L118) (các đoạn mã ghi đè responsive cho Popup Maker, chỉnh màu menu mobile sidebar, padding banner trang ID 133 và max-width logo). Mọi thay đổi này sẽ bị **ghi đè và mất sạch** khi theme Flatsome được cập nhật phiên bản mới.

### 2.2. Child Theme (Theme Con)
- **Tên Theme:** Flatsome Child - VinFast Vĩnh Phúc (`flatsome-child`).
- **Phiên bản:** `1.0.0` (Xác minh từ header [style.css](file:///d:/DinhDat/Me/vinfasttanachill/style.css#L1-L9)).
- **Thư mục phát triển nâng cao:** `D:\DinhDat\Me\vinfasttanachill`.
- **Cấu trúc Template:**
  - `page-home.php`: Template trang chủ với Swiper Hero và lưới phân loại xe.
  - `page-dat-coc.php`: Wizard đặt cọc 3 bước tích hợp tạo mã VietQR.
  - `page-du-toan.php` / `page-du-toan-chi-phi.php`: Bộ công cụ tính phí lăn bánh theo luật thuế 0% xe điện.
  - `page-tra-gop.php` / `page-du-toan-tra-gop.php`: Bảng tính khấu hao và lịch trả nợ vay ngân hàng.
  - `page-so-sanh-xe.php`: Bộ công cụ so sánh trực quan đối đầu 2 - 3 mẫu xe.
  - `page-tim-kiem-showroom-tram-sac.php`: Tra cứu hệ sinh thái trạm sạc và xưởng dịch vụ 3S.
  - 16 template dòng xe chuyên biệt đặt trong thư mục `template-parts/product/single-*.php`.

### 2.3. Trạng Thái Cấu Hình Theme Trong Cơ Sở Dữ Liệu
- Trong [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql) bảng `SERVMASK_PREFIX_options`:
  - `template`: Giá trị đang rỗng `''`.
  - `stylesheet`: Giá trị đang rỗng `''`.
  - `current_theme`: Đang trỏ về `'Flatsome'`.
- **Rủi ro:** Khi website khởi động với giá trị `template` và `stylesheet` bị rỗng, WordPress sẽ rơi vào chế độ fallback theme mặc định (Twenty Twenty-Five) hoặc phát sinh cảnh báo theme hỏng, không nạp được Child Theme nếu chưa được cấu hình lại qua WP Admin.

---

## 3. Danh Sách Plugin & Mức Độ Phụ Thuộc (Plugin Inventory)

### 3.1. Plugins Tiêu Chuẩn Trong Thư Mục `wp-content/plugins`
1. **Advanced Custom Fields (v6.8.1) — WP Engine:** Plugin quản lý Custom Fields cho dữ liệu thông số kỹ thuật xe (`dung_luong_pin`, `quang_duong`, `cong_suat`, `so_cho_ngoi`). Phụ thuộc cao.
2. **WooCommerce (v10.7.0) — Automattic:** Quản lý danh mục sản phẩm xe, cổng thanh toán và kho hàng.
3. **Contact Form 7 (v6.1.6) — Rock Lobster Inc.:** Cung cấp các form liên hệ, lái thử và hẹn dịch vụ.
4. **Redirection for Contact Form 7 (v3.2.10) — Themeisle:** Điều hướng trang sau khi gửi form CF7.
5. **Elementor (v4.0.8) — Elementor.com:** Page Builder bên ngoài. Hiện có 7 bài viết/trang có cờ `_elementor_edit_mode = 'builder'` nhưng trường `_elementor_data` hoàn toàn rỗng. Đang gây xung đột tài nguyên với Flatsome UX Builder.
6. **Smart Slider 3 (v3.5.1.34) — Nextend:** Plugin tạo slider. Thừa thãi vì Child Theme đã tự tích hợp Swiper.js chuẩn.
7. **Popup Maker (v1.22.0) — Popup Maker:** Quản lý popup báo giá cũ. Child Theme hiện đã có `assets/js/vfvp-modal.js` độc lập.
8. **WP Mail SMTP (v4.8.0) — WP Mail SMTP:** Cấu hình gửi mail qua SMTP Google/Gmail.
9. **All-in-One WP Migration and Backup (v7.105) — ServMask:** Công cụ sao lưu và di chuyển website.
10. **Akismet Anti-spam (v5.6) — Automattic:** Chống spam bình luận (Không cần thiết cho website bán ô tô không mở comment).

### 3.2. Custom Plugins Độc Quyền Trong Thư Mục `custom-plugins`
1. **AI Writer - Trợ Lý Viết Bài (v1.0.0):**
   - Vị trí: `custom-plugins/ai-writer/ai-writer.php`.
   - Kết nối Google Gemini API (`gemini-2.0-flash`) tạo tiêu đề, meta description, từ khóa chuẩn SEO.
   - Đăng ký REST API namespace `ai-writer/v1` với quyền `edit_posts`.
2. **WP Insight – Thống Kê Truy Cập (v1.0.0):**
   - Vị trí: `custom-plugins/wp-insight/wp-insight.php`.
   - Tự tạo bảng riêng `wpinsight_hits` và `wpinsight_sessions` đo lường pageviews, unique visitors, thiết bị, quốc gia.
   - Xung đột kiến trúc: Lắng nghe hook `wp` để ghi DB đồng bộ trên mỗi lượt tải trang, sẽ bị vô hiệu hóa khi bật LiteSpeed Cache / WP Rocket.
3. **VinFast Product Template (v1.0.0):**
   - Vị trí: `custom-plugins/vinfast-template/vinfast-template.php`.
   - Can thiệp hook `template_include` để nạp template ô tô điện cho sản phẩm WooCommerce có meta `_vf_is_vinfast = yes`.
   - Trùng lặp chức năng: Child Theme đã có sẵn bộ router `single-product-vinfast.php` riêng.

---

## 4. Phân Tích Page Builder: Tranh Chấp Tài Nguyên (Builder Conflict)

- Cơ sở dữ liệu ghi nhận **63 shortcodes UX Builder** (`[ux_products]`, `[ux_banner]`, `[ux_slider]`, `[ux_image]`, `[ux_html]`).
- Đồng thời plugin **Elementor v4.0.8** đang được cài đặt trong thư mục plugins và gắn cờ builder trên 7 post ID.
- **Đánh giá kiến trúc:** Website đang chịu tải kép từ cả UX Builder của Flatsome lẫn thư viện JS/CSS nặng nề của Elementor mà không tận dụng tính năng nào của Elementor. Nên gỡ bỏ hoặc đóng băng Elementor để giảm tối thiểu 300KB JS/CSS thừa trên frontend.

---

## 5. Custom Code, Custom Post Types & REST API

### 5.1. Custom Post Types & Taxonomies
- Đăng ký trong `functions.php`:
  - CPT `car_model` (Mẫu xe VinFast): Phục vụ trưng bày và thông số kỹ thuật.
  - CPT `phu_kien` (Phụ kiện chính hãng): Sạc di động, tấm che pin, thảm sàn...
  - Taxonomy `car_category` (Xe cá nhân / Xe dịch vụ).
- Dữ liệu thực tế trong DB: Hiện có 17 bài viết được lưu trữ dưới post type mặc định `product` của WooCommerce. Child Theme đang phải hỗ trợ song song cả `product` và `car_model` qua bộ lọc `['product', 'car_model']`.

### 5.2. REST API Endpoints
- Namespace `ai-writer/v1`:
  - `POST /wp-json/ai-writer/v1/titles`: Tạo tiêu đề bài viết.
  - `POST /wp-json/ai-writer/v1/meta`: Tạo mô tả meta.
  - `POST /wp-json/ai-writer/v1/keywords`: Gợi ý tags/keywords.
  - `POST /wp-json/ai-writer/v1/improve`: Cải thiện văn phong.
  - `GET /wp-json/ai-writer/v1/test`: Kiểm tra kết nối Gemini API.
- Toàn bộ endpoints REST API của `ai-writer` đã cấu hình `permission_callback => current_user_can('edit_posts')`, đảm bảo an toàn truy cập.

