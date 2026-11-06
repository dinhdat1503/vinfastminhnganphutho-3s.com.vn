# BÁO CÁO KẾT QUẢ TASK CLEANUP-01: GỠ PRE-FOOTER CTA & DỌN DẸP PLUGIN CUSTOM

> **Dự án:** VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)  
> **Task ID:** CLEANUP-01  
> **Ngày thực hiện:** 2026-11-06  
> **Tiêu chuẩn:** Tuân thủ nghiêm ngặt `AGENTS.md`, quy chuẩn Git Safety & Definition of Done

---

## A. Pre-Footer Cleanup (Xóa Khối Đăng Ký Báo Giá & Lái Thử)

### 1. File đã chỉnh sửa
- [`wp-content/themes/flatsome-child-minhnganphutho/footer.php`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/wp-content/themes/flatsome-child-minhnganphutho/footer.php):
  - Xóa bỏ hoàn toàn khối HTML/PHP `<div class="vf-footer-top">` (dòng 13–30 cũ).
  - Tối ưu cấu trúc wrapper: `<footer id="vf-footer" class="site-footer vf-footer" style="background:#11161F; border-top:1px solid rgba(255,255,255,0.08);">` kết hợp lớp đệm nội dung `<div class="footer-main-wrap" style="padding:60px 0 40px; color:#CBD5E1;">` loại bỏ hoàn toàn khoảng trắng thừa.
- [`wp-content/themes/flatsome-child-minhnganphutho/style.css`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/wp-content/themes/flatsome-child-minhnganphutho/style.css):
  - Dọn dẹp toàn bộ 57 dòng CSS dành riêng cho Pre-Footer CTA: `.vf-footer-top`, `.vf-footer-cta-box`, `.vf-footer-cta-sub`, `.vf-footer-cta-title`, `.vf-footer-cta-desc`, `.vf-footer-cta-form` cả ở desktop lẫn mobile media query.

### 2. Thành phần đã loại bỏ
- Tiêu đề: *"ƯU ĐÃI ĐẶC BIỆT THÁNG NÀY"* / *"Đăng Ký Nhận Báo Giá & Lái Thử Xe VinFast Minh Ngân"*.
- Đoạn mô tả: *"Nhận bảng tính chi phí lăn bánh, ưu đãi chính hãng & lịch lái thử tận nhà miễn phí."*.
- Cụm input Họ và tên, SĐT và nút "ĐĂNG KÝ" cũ.
- Card nền gradient tối `#1E293B -> #0F172A`, viền xanh `#2563EB`, box-shadow và padding của riêng card.

### 3. Bảo toàn các thành phần cốt lõi
- **Main Footer 4 cột:** Giữ nguyên vẹn 100% bố cục Grid (Cột 1: Đại lý, Cột 2: Dòng xe, Cột 3: Dịch vụ, Cột 4: Đăng ký tư vấn dịch vụ web).
- **Form Đăng Ký Tư Vấn Dịch Vụ Web (Cột 4):** Hoạt động độc lập, không bị ảnh hưởng, xác thực Nonce và gửi mail thành công 100%.
- **Thanh thao tác di động & Nút nổi:** Sticky Mobile Action Bar (3 nút) và Floating Hotline/Zalo được bảo toàn trọn vẹn.

### 4. Đối chiếu trực quan Trước / Sau (Before / After)

| Thiết bị / Màn hình | Trước khi xóa (Before) | Sau khi xóa (After) | Đánh giá |
| :--- | :--- | :--- | :---: |
| **Desktop (1440px)** | [before_cleanup_footer_desktop_1440.png](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/before_cleanup_footer_desktop_1440.png) | [after_cleanup_footer_desktop_1440.png](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_cleanup_footer_desktop_1440.png) | Khối Pre-Footer đã biến mất hoàn toàn, Footer bắt đầu gọn gàng bằng đường viền tinh tế, không có khoảng trắng thừa. |
| **Mobile (390px)** | [before_cleanup_footer_mobile_390.png](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/before_cleanup_footer_mobile_390.png) | [after_cleanup_footer_mobile_390.png](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_cleanup_footer_mobile_390.png) | Bố cục xếp dọc thanh thoát, không che khuất các nút di động, 0px tràn ngang. |

---

## B. Plugin Inventory & Dependency Analysis

### 1. Bảng kiểm kê toàn bộ Plugin trong hệ thống

| Tên thư mục | Tên Plugin (PHP Header) | Phiên bản | Phân loại | Trạng thái ban đầu | Phân tích phụ thuộc (Dependencies) | Quyết định | Kết quả thực tế |
| :--- | :--- | :---: | :---: | :---: | :--- | :---: | :---: |
| **`ai-writer`** | AI Writer — Trợ Lý Viết Bài | 1.0.0 | **Custom** | ACTIVE | Không có phụ thuộc với Child Theme (`0` references). Không tạo Custom Post Type hay bảng DB. Chỉ phục vụ gợi ý viết bài admin Gutenberg. | **REMOVE** | **REMOVED** (Đã backup & gỡ bỏ thư mục) |
| **`wp-insight`** | WP Insight – Thống Kê Truy Cập | 1.0.0 | **Custom** | ACTIVE | Không có phụ thuộc theme (`0` references). Tạo bảng nội bộ `wpinsight_hits`, `wpinsight_sessions`. Không phục vụ người dùng cuối website đại lý. | **REMOVE** | **REMOVED** (Đã backup & gỡ bỏ thư mục mã nguồn; bảo toàn bảng dữ liệu DB) |
| **`vinfast-template`** | VinFast Product Template | 1.0.0 | **Custom** | ACTIVE | Chứa template mẫu single product (`single-product-vinfast.php`). Dù Child Theme đã override ưu tiên 9999, nhưng plugin chứa các helper `vf_img_url()` và logic Coming Soon. Cần bảo toàn làm tài liệu đối chiếu cho **SLICE-03 (Rebuild PDP)** sắp tới. | **RETAIN** | **RETAINED** (Giữ nguyên hoạt động an toàn) |
| `advanced-custom-fields` | Advanced Custom Fields | 6.8.1 | Third-party | ACTIVE | Quản lý custom fields cho Hero, Car Slider, Option pages. Rất quan trọng. | **RETAIN** | **RETAINED** |
| `contact-form-7` | Contact Form 7 | 6.1.6 | Third-party | ACTIVE | Xử lý các form phụ. | **RETAIN** | **RETAINED** |
| `woocommerce` | WooCommerce | 10.7.0 | Third-party | ACTIVE | Nền tảng quản lý danh mục xe ô tô và phụ kiện. | **RETAIN** | **RETAINED** |
| `wp-mail-smtp` | WP Mail SMTP | 4.8.0 | Third-party | ACTIVE | Xử lý cấu hình SMTP gửi email lead cho đại lý. | **RETAIN** | **RETAINED** |
| `akismet` | Akismet Anti-spam | 5.6 | Third-party | INACTIVE | Chống spam bình luận (chưa kích hoạt). | **RETAIN** | **RETAINED** (Không can thiệp) |
| `all-in-one-wp-migration` | All-in-One WP Migration | 7.105 | Third-party | INACTIVE | Hỗ trợ backup/restore khi chuyển hosting. | **RETAIN** | **RETAINED** (Không can thiệp) |
| `elementor` | Elementor | 4.0.8 | Third-party | INACTIVE | Page builder (inactive, dự án dùng Flatsome UX). | **RETAIN** | **RETAINED** (Không can thiệp) |
| `popup-maker` | Popup Maker | 1.22.0 | Third-party | INACTIVE | Tạo popup (inactive). | **RETAIN** | **RETAINED** (Không can thiệp) |
| `smart-slider-3` | Smart Slider 3 | 3.5.1.34 | Third-party | INACTIVE | Slider (inactive, dự án dùng Cinematic Slider riêng). | **RETAIN** | **RETAINED** (Không can thiệp) |
| `wpcf7-redirect` | Redirection for CF7 | 3.2.10 | Third-party | INACTIVE | Chuyển trang CF7 (inactive). | **RETAIN** | **RETAINED** (Không can thiệp) |

### 2. Thư mục Backup đã tạo trước khi gỡ
- Toàn bộ source code của `ai-writer` và `wp-insight` đã được lưu trữ an toàn tại:
  [`docs/audit/backups/plugins/ai-writer/`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/backups/plugins/ai-writer/)  
  [`docs/audit/backups/plugins/wp-insight/`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/backups/plugins/wp-insight/)

---

## C. Regression Testing (Kiểm định hồi quy)

Sau khi xóa Pre-Footer CTA và gỡ bỏ 2 plugin custom (`ai-writer`, `wp-insight`), hệ thống đã được kiểm thử toàn diện trên LocalWP:

| Chức năng kiểm thử | URL / Phương thức | Kết quả mong đợi | Kết quả thực tế | Trạng thái |
| :--- | :--- | :--- | :--- | :---: |
| **Trang chủ (Homepage)** | `http://localhost:10004/` | HTTP 200, hiển thị mượt mà, không lỗi | HTTP 200 OK | **PASS** |
| **Dự toán chi phí lăn bánh** | `/du-toan-chi-phi/` | HTTP 200, công cụ tính hoạt động | HTTP 200 OK | **PASS** |
| **Đăng ký lái thử** | `/dang-ky-lai-thu/` | HTTP 200, form tải bình thường | HTTP 200 OK | **PASS** |
| **Chính sách bảo mật** | `/chinh-sach-bao-mat/` | HTTP 200, nội dung đầy đủ | HTTP 200 OK | **PASS** |
| **WordPress Login / Admin** | `/wp-login.php` | HTTP 200, đăng nhập quản trị bình thường | HTTP 200 OK | **PASS** |
| **WooCommerce Shop** | `/shop/` | HTTP 200, danh mục tải ổn định | HTTP 200 OK | **PASS** |
| **Form Đăng Ký Tư Vấn Web (Footer Cột 4)** | AJAX POST `vf_submit_footer_service_form` | Nonce hợp lệ, gửi lead thật vào Mailpit | `{"success":true,"data":{"message":"Đăng ký thành công!..."}}` | **PASS** |
| **Chống spam form Footer** | Nonce sai / Honeypot / Rate limit | Chặn triệt để và thông báo lỗi rõ ràng | 3/3 kịch bản từ chối đúng quy chuẩn | **PASS** |
| **Kiểm tra PHP Syntax** | PHP 8.2 CLI (`-l`) | Không có lỗi cú pháp trong `footer.php`, `functions.php` | `No syntax errors detected` | **PASS** |
| **Đo lường tràn viền (CDP)** | 1440px, 1024px, 768px, 390px, 320px | `overflowPx == 0` | 0px trên toàn bộ các kích thước | **PASS** |

---

## D. Git Diff & Kiểm soát phạm vi (Scope Control)

### Danh sách file thay đổi do CLEANUP-01:
1. `wp-content/themes/flatsome-child-minhnganphutho/footer.php`: Xóa bỏ khối HTML `<div class="vf-footer-top">` (Pre-Footer CTA).
2. `wp-content/themes/flatsome-child-minhnganphutho/style.css`: Xóa 57 dòng CSS dành riêng cho Pre-Footer CTA.
3. `wp-content/plugins/ai-writer/`: Đã sao lưu sang thư mục backup và xóa khỏi `wp-content/plugins/`.
4. `wp-content/plugins/wp-insight/`: Đã sao lưu sang thư mục backup và xóa khỏi `wp-content/plugins/`.

### Xác nhận tuân thủ:
- **Tuyệt đối không sửa:** Header, Hero Banner, Cinematic Slider, Car Collection Tabs, Green Series, Công cụ tài chính, Showroom 3S, Main Footer 4 cột (Cột 1, Cột 2, Cột 3, Cột 4).
- **Không phá vỡ dữ liệu:** Không xóa database options hoặc các bảng database liên quan.

---

## E. Remaining Risks & Đề xuất xử lý Database

1. **Bảng database của `wp-insight`:**
   - Trong MySQL hiện có 2 bảng dữ liệu do `wp-insight` tạo ra: `wp_wpinsight_hits` và `wp_wpinsight_sessions`.
   - Các bảng này hoàn toàn vô hại khi plugin đã bị xóa (không có mã nguồn nào đọc/ghi vào chúng nữa).
   - **Đề xuất:** Giữ nguyên các bảng này; nếu Chủ dự án muốn dọn sạch hoàn toàn database dung lượng trống, tôi sẽ gửi lệnh SQL DROP TABLE để Anh phê duyệt riêng trong task RELEASE.
2. **Kế hoạch cho `vinfast-template`:**
   - Plugin này hiện được giữ lại an toàn làm tham chiếu kiến trúc. Trong **SLICE-03 (Hoàn thiện PDP cho VF 3 và VF 7)** tiếp theo, toàn bộ logic render chi tiết xe sẽ được chuyển dịch hoàn chỉnh vào Child Theme `flatsome-child-minhnganphutho`, sau đó plugin `vinfast-template` sẽ được gỡ bỏ dứt điểm.

