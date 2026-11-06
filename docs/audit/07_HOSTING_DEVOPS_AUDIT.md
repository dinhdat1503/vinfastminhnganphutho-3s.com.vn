# PHẦN 7: KIỂM TOÁN HẠ TẦNG, LƯU TRỮ & DEVOPS (HOSTING & DEVOPS AUDIT)

## 1. Môi Trường Máy Chủ & Web Server (Server Environment)

- **Hệ điều hành máy chủ:** Linux (dựa trên cấu trúc đường dẫn `/home/hkruxcnchosting/...` và socket MySQL `/var/lib/mysql/mysql.sock`).
- **Web Server:** LiteSpeed Web Server (LSWS).
- **Cấu hình .htaccess:**
  ```apache
  # BEGIN LiteSpeed
  <IfModule Litespeed>
      SetEnv noabort 1
  </IfModule>
  # END LiteSpeed
  ```
  Chỉ thị `SetEnv noabort 1` được cấu hình để ngăn chặn LiteSpeed ngắt tiến trình PHP giữa chừng khi thực hiện các tác vụ di chuyển dữ liệu (All-in-One WP Migration).
- **Đánh giá Web Server:** LiteSpeed Web Server là lựa chọn tối ưu cho WordPress về tốc độ phục vụ file tĩnh và khả năng chịu tải thông qua LiteSpeed Cache (LSCache).

---

## 2. Kiểm Toán Cơ Chế Sao Lưu & Khôi Phục (Backup & Restore Integrity)

### 2.1. Lỗi Lệch Tiền Tố Bảng Giữa File Dump & File Cấu Hình (Prefix Incompatibility)
- **Trong file cấu hình [wp-config.php](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/wp-config.php#L69):**
  `$table_prefix = 'v5E_default';`
- **Trong file dump cơ sở dữ liệu [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql#L9-L10):**
  `CREATE TABLE SERVMASK_PREFIX_actionscheduler_actions ...`
  Toàn bộ 59 bảng dữ liệu đều mang tiền tố `SERVMASK_PREFIX_`.
- **Rủi ro phục hồi thực tế (CRITICAL DEVOPS DEFECT):**
  - Nếu kỹ sư DevOps hoặc lập trình viên thực hiện khôi phục website trên môi trường mới bằng lệnh MySQL tiêu chuẩn (`mysql -u user -p database < database.sql`), cơ sở dữ liệu sẽ chứa các bảng có tên dạng `SERVMASK_PREFIX_options`, `SERVMASK_PREFIX_posts`.
  - Khi WordPress khởi động, nó tìm kiếm bảng theo tiền tố `$table_prefix = 'v5E_default'` (tức bảng `v5E_default_options`), dẫn đến việc WordPress **không tìm thấy bảng và lập tức hiển thị màn hình cài đặt WordPress mới từ đầu** (WordPress Installation Wizard) hoặc lỗi `Error establishing a database connection`.
  - File dump này bắt buộc phải được xử lý thay thế chuỗi (Search & Replace) từ `SERVMASK_PREFIX_` sang `v5E_default_` trước khi import, hoặc chỉ có thể import thông qua plugin All-in-One WP Migration.
- **Phân loại:** **VERIFIED DEFECT (P0)**.

### 2.2. Toàn Bộ Plugins Bị Tắt Trong File Dump Cơ Sở Dữ Liệu
- Trong [database.sql](file:///d:/DinhDat/Me/vinhphucvinfast.com.vn/vinhphucvinfast.com.vn/database.sql) bảng `SERVMASK_PREFIX_options`, dòng 34:
  `INSERT INTO SERVMASK_PREFIX_options VALUES (34, 'active_plugins', 'a:0:{}', 'on');`
- **Hành vi:** Giá trị `active_plugins` là một mảng rỗng `a:0:{}`.
- **Tác động:** Khi khôi phục website từ bản dump này, toàn bộ 10 plugin (bao gồm cả ACF, WooCommerce, Contact Form 7) đều ở trạng thái **Deactivated (Bị tắt)**. Khách hàng ghé thăm website sẽ thấy toàn bộ shortcode bị lộ dạng text thô (`[du_toan_chi_phi]`, `[contact-form-7 ...]`) và các tính năng đặt cọc, tính phí bị tê liệt hoàn toàn.

---

## 3. Quy Trình Triển Khai Tự Động CI/CD & Rollback (Deployment Pipeline)

- **Quy trình GitHub Actions:** Tệp `.github/workflows/deploy.yml` được cấu hình để tự động đồng bộ mã nguồn lên hosting khi có commit mới vào nhánh chính.
- **Lỗ hổng quy trình DevOps:**
  1. **Thiếu Môi Trường Staging:** Quy trình đẩy trực tiếp code vào thư mục theme/plugin của máy chủ production mà không qua môi trường staging thử nghiệm.
  2. **Thiếu Automated Test Gate:** Không có bước chạy linter PHP (`php -l`), kiểm tra cú pháp hoặc kiểm tra lỗi bảo mật trước khi rsync/FTP mã nguồn lên hosting.
  3. **Thiếu Cơ Chế Tự Động Snapshot & Rollback:** Nếu code mới chứa lỗi cú pháp PHP (Fatal Error), website production sẽ bị sập màn hình trắng (White Screen of Death) mà không có cơ chế tự động khôi phục về bản phát hành trước đó.

---

## 4. Kiểm Toán Nhật Ký Lỗi & Giám Sát (Logging & Monitoring)

- Trong `wp-config.php`:
  - `WP_DEBUG` đang đặt là `false`.
  - Hằng số `WP_DEBUG_LOG` và `WP_DEBUG_DISPLAY` **chưa được khai báo**.
- **Hệ quả:** Khi website phát sinh lỗi Fatal Error, Warning hoặc lỗi gửi mail/Telegram, hệ thống không ghi nhận log vào tệp `wp-content/debug.log`, khiến việc điều tra sự cố của ban quản trị trở nên mù mờ, không có bằng chứng kỹ thuật để khắc phục.

