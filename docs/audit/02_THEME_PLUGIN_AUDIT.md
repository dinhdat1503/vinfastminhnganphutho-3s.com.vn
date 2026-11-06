# PHẦN 2: KIỂM TOÁN THEME & PLUGINS (THEME & PLUGIN AUDIT)

## 1. Kiểm Toán Parent Theme (Flatsome v3.20.2)

### 1.1. Hiện Trạng Can Thiệp Trực Tiếp (Direct Edits)
Tệp tin [style.css](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/wp-content/themes/flatsome/style.css#L24-L118) của Theme mẹ Flatsome bị chèn trực tiếp 95 dòng CSS tùy chỉnh, bao gồm:
- Sửa lỗi tràn viền Popup Maker trên mobile (`.pum-container.popmake`).
- Đổi màu menu mobile sidebar sang màu đen và đổi màu menu con (`.mobile-sidebar .nav-sidebar`).
- Tùy biến layout flexbox cho trang ID 133 (`.page-id-133 .banner-layers`).
- Thu nhỏ kích thước logo đại lý trên thiết bị di động (`.header-main .logo`, `#logo img`).

### 1.2. Đánh Giá Tác Động & Hậu Quả
- **Vi phạm nguyên tắc:** Vi phạm trực tiếp quy tắc WordPress Coding Standards: *"Không chỉnh sửa WordPress Core hoặc trực tiếp sửa Parent Theme nếu có phương án an toàn hơn."*
- **Hậu quả trực tiếp:** Khi chủ dự án bấm "Update" Theme Flatsome trên trang quản trị WordPress, toàn bộ tệp tin của theme mẹ sẽ bị ghi đè bằng bản mới từ tác giả, khiến giao diện mobile của menu, logo và trang sản phẩm 133 lập tức bị vỡ giao diện.
- **Biện pháp khắc phục tối thiểu:** Di chuyển toàn bộ 95 dòng CSS này sang `style.css` của Child Theme và trả file `flatsome/style.css` về trạng thái nguyên bản.

---

## 2. Kiểm Toán Child Theme (`vinfasttanachill`)

### 2.1. Lệch Pha Đặt Tên Template Giữa Cơ Sở Dữ Liệu & Mã Nguồn (Template Naming Mismatch)
Kiểm tra đối chiếu giữa bảng `SERVMASK_PREFIX_postmeta` (khóa `_wp_page_template`) trong [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql) và danh sách file trong thư mục Child Theme phát hiện các sai lệch nghiêm trọng:

| ID Trang | Tiêu đề Trang trong DB | Đường dẫn (Slug) | File Template Ghi Trong DB | Tình Trạng File Trong Child Theme | Hậu Quả Thực Tế |
| :---: | :--- | :--- | :--- | :--- | :--- |
| **67** | Home | `/home/` | `''` (Rỗng) | Có file `page-home.php` | WordPress không tự nạp `page-home.php` mà dùng `page.php` mặc định |
| **102** | Đặt hẹn dịch vụ | `/dat-hen-dich-vu/` | `page-dat-hen.php` | **KHÔNG TỒN TẠI** (Theme đặt tên là `page-dat-lich-dich-vu.php`) | Lỗi 404 template, rơi về giao diện rỗng của Flatsome |
| **123** | Tin tức | `/tin-tuc/` | `page-news.php` | **KHÔNG TỒN TẠI** (Theme đặt tên là `page-tin-tuc.php`) | Rơi về giao diện blog mặc định không có bộ lọc chuyên biệt |
| **110** | Liên hệ | `/lien-he/` | `page-lien-he.php` | **KHÔNG TỒN TẠI** (Theme hoàn toàn thiếu file này) | Không nạp được layout liên hệ tùy biến |

### 2.2. Sự Trùng Lặp Khổng Lồ Trong 16 Template Xe (`template-parts/product/single-*.php`)
- Thư mục chứa 16 tệp tin template độc lập cho từng dòng xe (`single-vf3.php`, `single-vf5.php`, `single-vf6.php`, `single-vf7.php`, `single-vf8.php`, `single-vf8_allnew.php`, `single-vf9.php`, `single-ecvan.php`, `single-herio.php`, `single-limo.php`, `single-minio.php`, `single-mpv7.php`, `single-nerio.php`, `single-vf2.php`, `single-vfwild.php`, `single-default-car.php`).
- **Tổng dung lượng:** Hơn 720 KB mã nguồn.
- **Vấn đề phát hiện:**
  - Mỗi file đều nhúng trực tiếp một khối `<style>` riêng từ **10 KB đến 17 KB** vào giữa mã HTML (Ví dụ: `single-vf3.php` nhúng 10.641 ký tự CSS, `single-vf7.php` nhúng 17.316 ký tự CSS).
  - Mỗi file nhúng độc lập 3 khối `<script>` (từ 3.800 đến 6.500 ký tự JS) lặp đi lặp lại logic chọn màu, sticky subnav, modal lái thử.
  - **Tác hại:** Trình duyệt không thể cache CSS/JS này, làm phình to kích thước HTML của mỗi lượt tải trang lên gấp 5-10 lần, đồng thời gây ác mộng bảo trì khi cần thay đổi bất kỳ nút bấm hoặc màu sắc thương hiệu nào.

### 2.3. Tự Động Chèn Bài Viết Mẫu Khi Chạy Hook `init`
- Trong file `functions.php` (dòng 2872-2950):
  - Theme kích hoạt hook `init` tự động gọi hàm `wp_insert_post()` để sinh ra các bài viết demo: *"Ưu Đãi Tháng 7/2026"*, *"Camera Hành Trình 4K"*, *"Mãnh liệt Tinh thần Việt Nam"* và trang *"Tin tức & Sự kiện"*.
  - Điều kiện kiểm tra dựa vào transient `vfvp_demo_content_created_v1` có thời hạn 1 ngày (`DAY_IN_SECONDS`).
  - **Tác hại:** Khi quản trị viên xóa bài viết demo hoặc sửa tiêu đề bài viết, sau 24h transient hết hạn, hệ thống sẽ **tự động chèn lại các bài viết rác vào database** trên mỗi request của người dùng ghé thăm website!

---

## 3. Kiểm Toán Xung Đột & Trùng Lặp Giữa Các Plugins

### 3.1. Xung Đột Page Builder: Elementor vs Flatsome UX Builder
- Theme Flatsome tích hợp sẵn UX Builder nhẹ, tương thích 100% với cấu trúc header/footer và hệ thống shortcode của theme.
- Plugin `elementor` (v4.0.8) được cài đặt và kích hoạt nhưng toàn bộ bài viết không chứa dữ liệu layout Elementor (`_elementor_data` = 0).
- **Rủi ro:** Elementor vẫn tự động tải các tài nguyên CSS (`frontend.min.css`), JS thư viện (`webpack.runtime.min.js`, `frontend-modules.min.js`) trên mọi trang, làm chậm tốc độ tải từ 300ms - 800ms mà không mang lại giá trị sử dụng.

### 3.2. Trùng Lặp Quản Lý Slider: Smart Slider 3 vs Swiper.js
- Plugin `smart-slider-3` (v3.5.1.34) tạo riêng 6 bảng cơ sở dữ liệu (`nextend2_*`).
- Tuy nhiên trong Child Theme, toàn bộ banner trang chủ và thư viện xe đã được code thuần bằng thư viện `Swiper.js` v11 nạp từ CDN qua `vfvp_enqueue_assets()`.
- Việc duy trì Smart Slider 3 là hoàn toàn thừa thãi, gây overhead cho database và tiêu tốn bộ nhớ server.

### 3.3. Trùng Lặp Cửa Sổ Báo Giá: Popup Maker vs `vfvp-modal.js`
- Plugin `popup-maker` (v1.22.0) được cài đặt trước đó để hiện popup nhận bảng giá.
- Trong Child Theme hiện tại, lập trình viên đã viết riêng file `assets/js/vfvp-modal.js` tự động hiện modal và tự động đóng sau 15 giây.
- Cả hai cơ chế popup cùng tồn tại có thể gây xung đột hiển thị đè nhau trên màn hình di động.

### 3.4. Trùng Lặp Cơ Chế Ghi Đè Giao Diện: `vinfast-template` vs Theme Router
- Plugin `custom-plugins/vinfast-template` can thiệp hook `template_include` (priority 20) để ép file `templates/single-product-vinfast.php`.
- Trong khi đó, Child Theme `vinfasttanachill` cũng có file `single-product-vinfast.php` đóng vai trò router chia nhánh theo từ khóa model xe.
- Hai thành phần này đang cạnh tranh quyền nạp template cho sản phẩm WooCommerce, gây khó kiểm soát luồng hiển thị.

