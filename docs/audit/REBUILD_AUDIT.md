# BÁO CÁO KIỂM TOÁN KỸ THUẬT TOÀN DIỆN (REBUILD TECHNICAL AUDIT)
## DỰ ÁN: WEBSITE ĐẠI LÝ VINFAST MINH NGÂN PHÚ THỌ 3S

- **Ngày thực hiện:** 2026-11-06 | **Múi giờ:** Asia/Ho_Chi_Minh
- **Cơ quan kiểm toán:** Senior Technical Audit Team (Solution Architect, Senior WP Dev, UI/UX Designer, DevSecOps, QA)
- **Tài nguyên đối chiếu:** 
  - `docs/requirements/DAC_TA_CHUC_NANG_WEBSITE_VINFAST_MINH_NGAN.docx`
  - `docs/requirements/BAO_GIA_WEBSITE_VINFAST_MINH_NGAN.xlsx`
  - Git repository: `dinhdat1503/vinfastminhnganphutho-3s.com.vn` (Branch `main @ 5fea9240`)
  - Môi trường chạy thực tế: LocalWP (PHP 8.2.29, Nginx 1.26.1, MySQL 8.4.0 tại `http://localhost:10004`)

---

### 1. KIỂM TOÁN TỔNG THỂ REPOSITORY VÀ HẠ TẦNG HIỆN HỮU

1. **WordPress Core:** Phiên bản 6.7.x / 7.1.x, tính toàn vẹn 100% không bị can thiệp file lõi.
2. **Parent Theme:** Flatsome 3.20.2 (`wp-content/themes/flatsome/`), hỗ trợ UX Builder và cấu trúc responsive chuẩn e-commerce.
3. **Child Theme:** `wp-content/themes/flatsome-child-minhnganphutho/`, kế thừa toàn bộ tính năng bán ô tô điện từ `vinfasttanachill`. Đã loại bỏ hoàn toàn 6/6 hardcoded paths `C:/Users/ngodi/...` trong Slice 1.
4. **Plugins tiêu chuẩn (10 plugins):**
   - `advanced-custom-fields`: Quản lý trường dữ liệu xe điện (phiên bản, giá, pin, trang bị).
   - `woocommerce`: Hệ thống quản lý sản phẩm.
   - `contact-form-7`: Xử lý biểu mẫu.
   - `smart-slider-3`: Trình chiếu Hero Banner trang chủ.
   - `popup-maker`: Hiển thị popup ưu đãi tự đóng.
   - `wp-mail-smtp`: Cấu hình gửi mail qua SMTP.
   - `wpcf7-redirect`: Hỗ trợ chuyển hướng trang cảm ơn.
   - `elementor`, `akismet`, `all-in-one-wp-migration`: Tiện ích đi kèm.
5. **Custom Plugins (3 plugins):**
   - `ai-writer`: Tự động tạo bài viết chuẩn SEO bằng AI.
   - `wp-insight`: Theo dõi và phân tích lượt truy cập nội bộ.
   - `vinfast-template`: Override bố cục chi tiết mẫu xe và bộ lọc catalog.
6. **Custom Post Type & Dữ liệu:**
   - CPT `car_model` đăng ký tại `functions.php:847`.
   - Taxonomy `car_category` (Xe cá nhân, Xe dịch vụ).
7. **Cơ sở dữ liệu & Môi trường:**
   - Cơ sở dữ liệu mẫu thừa kế từ dự án cũ chứa tiền tố bảng `SERVMASK_PREFIX_` và các tùy chọn rỗng cần được đồng bộ sạch về `wp_`.

---

### 2. PHÂN LOẠI VÀ ĐÁNH GIÁ TÍNH NĂNG THEO MẪU SỐ ĐẶC TẢ

Tổng số chức năng yêu cầu cốt lõi theo đặc tả: **16 chức năng**.

| Trạng thái phân loại | Số lượng | Tỷ lệ (%) | Danh sách chức năng cụ thể |
|:---|:---:|:---:|:---|
| **EXISTING & WORKING** | **2** | 12.5% | Công cụ tính lịch trả góp dư nợ giảm dần (`page-du-toan.php`); Cơ chế sắp xếp bài viết tin tức mới nhất lên đầu (`page-home.php`). |
| **EXISTING BUT BROKEN** | **5** | 31.25% | Đăng ký lái thử thiếu Nonce CSRF (`page-lai-thu.php`); Form footer báo thành công giả (`footer.php`); Logo và nhãn Mega Menu chưa đúng thương hiệu Minh Ngân; Dự toán lăn bánh bị dán nhãn Vĩnh Phúc; SMTP chứa tên người gửi cũ và secret hardcode. |
| **PARTIAL** | **5** | 31.25% | Trang chủ 8 sections (đã có khung nhưng thông tin showroom và banner chưa trỏ về Minh Ngân Phú Thọ); Trang chi tiết xe (mới có khung dùng chung, chưa hoàn thiện 2 mẫu xe chuẩn); Đặt lịch bảo dưỡng (đã có 4 bước nhưng chưa tối ưu UX mobile); Thanh điều hướng đáy mobile (đang là 5 nút cũ thay vì 3 nút đặc tả); Nút nổi Hotline/Zalo & Popup Maker. |
| **MISSING** | **1** | 6.25% | Nút `TẢI PDF` 1-click xuất bản in báo giá dự toán chuẩn mẫu tiếng Việt trên `page-du-toan.php`. |
| **LEGACY / RETIRED** | **2** | 12.5% | Trang đặt cọc trực tuyến VietQR số tài khoản cũ Tân Á Châu (`page-dat-coc.php`); Tích hợp Telegram Bot gửi Lead về chat cá nhân dev cũ (`functions.php`). |
| **NOT VERIFIED** | **1** | 6.25% | Quy trình WebHook CI/CD tự động deploy lên VPS aaPanel khi push Git (cần môi trường máy chủ staging/production thực tế). |
| **TỔNG CỘNG** | **16** | **100%** | **Mẫu số: 16 hạng mục nghiệp vụ & kỹ thuật** |

---

### 3. KIỂM TOÁN CHI TIẾT BẰNG CHỨNG THƯƠNG HIỆU CŨ VÀ DỮ LIỆU RÁC (AUDIT FINDINGS)

Dưới đây là các bằng chứng kiểm toán được trích xuất trực tiếp bằng công cụ phân tích tĩnh:

1. **Vết tích "Catchie" (12 vị trí):**
   - Bằng chứng: `footer.php:109, 120, 121` hiển thị dòng chữ: `Thiết kế bởi <a href="https://zalo.me/0971692675">Catchie</a>`.
   - Bằng chứng: `functions.php:3145, 3154` định danh email gửi đi là: `'From: Catchie Service <...>'` và `'🎯 Mục yêu cầu: Đăng Ký Tư Vấn Dịch Vụ Web (Catchie)'`.
   - Tác động: Gây nhầm lẫn nghiêm trọng về thương hiệu đại lý VinFast chính hãng, làm khách hàng nghi ngờ tính xác thực của website.

2. **Vết tích "Tân Á Châu" (1 vị trí):**
   - Bằng chứng: `page-dat-coc.php:1674`: sinh mã VietQR với tham số ngân hàng `&accountName=CONG%20TY%20TNHH%20TAN%20A%20CHAU`.
   - Tác động: Tiềm ẩn rủi ro chuyển khoản sai đối tượng thụ hưởng nếu khách hàng quét cọc (mặc dù tính năng đặt cọc trực tuyến nằm ngoài gói cơ bản).

3. **Vết tích "Vĩnh Phúc" (7 vị trí):**
   - Bằng chứng: `page-du-toan.php:736-737`: Nút chọn địa phương mang nhãn `id="province-vinhphuc"`, nhãn hiển thị `<label for="province-vinhphuc">Vĩnh Phúc & Các Tỉnh</label>`.
   - Bằng chứng: `style.css:126, 136, 2712`: Sử dụng class CSS `.vf-official-vinhphuc-logo-img`.
   - Tác động: Sai lệch thông tin đại diện của VinFast Minh Ngân tại tỉnh Phú Thọ.

4. **Số điện thoại & Email cá nhân cũ (19 vị trí):**
   - Bằng chứng: `footer.php:59, 99` chứa email `phuocvandangdilam@gmail.com`.
   - Bằng chứng: `template-parts/.../single-vfwild.php:635, 646` chứa số hotline `0981335522`.
   - Bằng chứng: `footer.php:121` chứa Zalo cá nhân `0971692675`.
   - Tác động: Lead của khách hàng bị gửi sai địa chỉ hoặc thất thoát sang nhân sự không liên quan.

---

### 4. BẢNG TỔNG HỢP LỖI THEO MỨC ĐỘ NGHIÊM TRỌNG (SEVERITY)

| ID | Mức độ | Loại phát hiện | Mô tả chi tiết & Vị trí | Hướng giải quyết kỹ thuật |
|:---|:---:|:---:|:---|:---|
| **P0-01** | **P0** | **VERIFIED DEFECT** | **Hardcoded Path máy lập trình cũ:** (ĐÃ XỬ LÝ) 6 đường dẫn `C:/Users/ngodi/...` trong `functions.php` | Đã thay thế hoàn toàn bằng `get_stylesheet_directory()` trong Slice 1. Trạng thái: **RESOLVED**. |
| **P1-01** | **P1** | **VERIFIED DEFECT** | **Thông báo thành công giả mạo (Fake Success UI):** Tại `footer.php:529-538`, khi AJAX gửi Lead lỗi mạng hoặc server 500, khối `.catch()` vẫn đổi nút bấm sang màu xanh và báo "Đăng ký thành công!" | Sửa lại handler JavaScript, phân biệt rõ trạng thái success (200) và error (500/network error), hiển thị cảnh báo đỏ trung thực. |
| **P1-02** | **P1** | **STATIC RISK** | **Thiếu Nonce Token bảo vệ form:** Tại `page-lai-thu.php` và `functions.php:3126-3135` (`vf_submit_footer_service_form`), endpoint tiếp nhận form không có hàm `check_ajax_referer` | Bổ sung `wp_nonce_field` và `check_ajax_referer('vf_lead_nonce', 'security')` để triệt tiêu bot spam và tấn công CSRF. |
| **P1-03** | **P1** | **STATIC RISK** | **Rò rỉ Lead và sai thương hiệu người gửi:** Email người gửi đang để `Catchie Service`, danh sách nhận chứa email cũ | Chuẩn hóa hằng số `VFVP_CONTACT_EMAILS` đọc từ cấu hình và định danh người gửi thành **VinFast Minh Ngân**. |
| **P1-04** | **P1** | **UX DEFECT** | **Nút Mobile Bar sai quy chuẩn đặc tả:** Đang hiển thị 5 nút hỗn tạp (có cả đặt cọc, so sánh) thay vì đúng 3 nút đặc tả: Gọi ngay, Dự toán, Lái thử | Tái cấu trúc component `mobile-action-bar` thành đúng 3 nút chuẩn tỷ lệ ngón tay cái, màu sắc nhận diện `#2563EB`. |
| **P2-01** | **P2** | **MISSING FEATURE** | **Thiếu tính năng Tải PDF Báo giá 1-Click:** Trên `page-du-toan.php` chưa có thư viện tạo PDF trực tiếp từ bảng tính | Tích hợp module JavaScript xuất PDF gọn nhẹ (hoặc chế độ in CSS Print chuẩn hóa bản in A4) mang đầy đủ logo và bảng biểu Minh Ngân. |
| **P2-02** | **P2** | **UX DEFECT** | **Vết thương hiệu cũ trên form dự toán:** `page-du-toan.php` hiển thị radio button Vĩnh Phúc | Sửa thành Phú Thọ & Các Tỉnh, đồng thời cập nhật đúng bảng phí biển số và trước bạ. |
| **P3-01** | **P3** | **STATIC RISK** | **File template rác và backup:** Tồn tại các file `.bak` và thư mục backup `template-parts/product_backup_...` | Dọn dẹp các file rác ra khỏi cấu trúc active theme để giảm kích thước repo và loại bỏ nguy cơ đọc nhầm code cũ. |

