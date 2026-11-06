# AI HANDOFF — TRẠNG THÁI TIẾP NỐI

> **Cập nhật sau MỖI Slice.** Đây là tài liệu trạng thái, không thay thế `AGENTS.md` hay `PROJECT_PLAN.md`.

## 1. Snapshot mới nhất

- **Dự án:** Website Đại Lý VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)
- **Ngày cập nhật:** 2026-11-06, Asia/Ho_Chi_Minh
- **Branch / HEAD:** `main @ 24b3373b` (Remote: `https://github.com/dinhdat1503/vinfastminhnganphutho-3s.com.vn.git`)
- **Worktree:** Clean (`nothing to commit, working tree clean`). Đã khởi tạo Git repo độc lập và push thành công lên GitHub.
- **Slice vừa hoàn thành:** **SLICE-01: Khởi tạo bộ khung Full WordPress cho VinFast Minh Ngân Phú Thọ 3S**
- **Trạng thái:** **HOÀN THÀNH SLICE 1 — CHỜ PHÊ DUYỆT ĐỂ BƯỚC VÀO SLICE 2**
- **Slice tiếp theo được đề xuất:** **SLICE-02: Khởi tạo CSDL, kích hoạt Child Theme & kiểm tra hiển thị Trang chủ** (Đúng một Slice duy nhất; CHƯA THỰC HIỆN).

---

## 2. Đã triển khai trong Slice này

| Slice | File/Thư mục chính | Thay đổi nghiệp vụ / Kỹ thuật | Evidence | Duyệt bởi |
|---|---|---|---|---|
| **SLICE-01** | `wp-admin/`, `wp-includes/`, `index.php`, `.htaccess` | Thiết lập nền tảng WordPress Core hoàn chỉnh kế thừa từ cụm core ổn định | Khảo sát cấu trúc file, scan tính toàn vẹn | **CHỜ DUYỆT** |
| **SLICE-01** | `wp-content/themes/flatsome` | Tích hợp Parent Theme Flatsome 3.20.2 chính hãng cho UX Builder | Thư mục theme đầy đủ | **CHỜ DUYỆT** |
| **SLICE-01** | `wp-content/themes/flatsome-child-minhnganphutho` | Dựng Child Theme riêng biệt cho VinFast Minh Ngân Phú Thọ 3S; Đổi nhận diện thương hiệu trong `style.css` & `functions.php`; **Loại bỏ 100% (6/6 vị trí) lỗi P0 hardcoded paths máy dev cũ (`C:/Users/ngodi/...`)** | Python path scan & grep scan không còn match nào | **CHỜ DUYỆT** |
| **SLICE-01** | `wp-content/plugins/*` | Tích hợp 10 plugin tiêu chuẩn (ACF, WooCommerce, Contact Form 7, Elementor, Popup Maker, Smart Slider 3, WP Mail SMTP...) + 3 custom plugins (`ai-writer`, `wp-insight`, `vinfast-template`) | 13 thư mục plugin được kiểm tra đầy đủ | **CHỜ DUYỆT** |
| **SLICE-01** | `wp-config.php.example`, `.env.example`, `.gitignore` | Chuẩn hóa cấu hình môi trường, bảo vệ an toàn secret, ngăn rò rỉ file môi trường lên version control | Secret scanner xác nhận không có credential rò rỉ | **CHỜ DUYỆT** |

---

## 3. Contracts và kiến trúc đang sử dụng

- **Mô hình kiến trúc:** Full WordPress Project (Core + Themes + Plugins + Env Config).
- **Parent Theme:** Flatsome 3.20.2 (`wp-content/themes/flatsome`).
- **Child Theme:** Flatsome Child - VinFast Minh Ngân Phú Thọ 3S (`wp-content/themes/flatsome-child-minhnganphutho`).
- **Custom Post Types:** `car_model` (Mẫu xe), taxonomy `car_category` (Xe cá nhân / Xe dịch vụ).
- **Plugins tiêu chuẩn:** Advanced Custom Fields Pro, WooCommerce, Contact Form 7, Smart Slider 3, Popup Maker, WP Mail SMTP, WPCF7-Redirect, Elementor.
- **Custom Plugins nội bộ:** `ai-writer` (tạo nội dung bài viết), `wp-insight` (phân tích chỉ số), `vinfast-template` (layout ô tô điện).
- **Bảo mật Secrets:** Secret mật khẩu và API token đã được bóc tách khỏi theme, cấu hình đọc an toàn qua môi trường (`.env` / `wp-config.php`).

---

## 4. Kiểm thử gần nhất (Quality Gates)

| Quality Gate | Nội dung kiểm thử | Lệnh / Công cụ | Kết quả thực tế | Ghi chú / Hạn chế |
|---|---|---|---|---|
| **G0** | Git baseline & bảo toàn worktree | `git status --short` | **PASS** | Không can thiệp các file ngoài phạm vi thư mục dự án |
| **G1** | Đúng Slice, không lan phạm vi | Review file list | **PASS** | Chỉ thiết lập khung thư mục WP và cấu hình child theme |
| **G2** | Kiểm tra toàn vẹn mã nguồn PHP | Python basic integrity scan | **PASS** | 0 lỗi null byte hoặc lỗi mã hóa ký tự |
| **G3** | Rà soát loại bỏ hardcoded paths (P0) | PowerShell `Select-String` | **PASS** | 0 chuỗi `C:/Users` tồn tại trong Child Theme mới |
| **G4** | Quét an toàn bảo mật & Secrets | Python Regex Secret Scanner | **PASS** | Không có secret, credential thật nào bị lộ |
| **G5** | Visual / Browser testing | Web server runner | **NOT RUN** | Slice 1 là Scaffolding/Backend cấu trúc, chưa khởi chạy web server cục bộ |
| **G6** | Review diff và cập nhật Handoff | Cập nhật `AI_HANDOFF.md` | **PASS** | Đồng bộ đầy đủ snapshot và trạng thái |

---

## 5. Bug và rủi ro mở trọng tâm cần xử lý ở các Slice kế tiếp

| ID | Mức độ | Mô tả | Vị trí / Chi tiết | Kế hoạch xử lý |
|---|---|---|---|---|
| **UI-01** | P1 | Form tư vấn footer báo thành công giả khi AJAX lỗi | `footer.php:529-538` | Sửa khối `.catch()` báo lỗi trung thực ở Slice UI/Form |
| **SEC-01** | P1 | Thiếu Nonce validation ở AJAX đăng ký tư vấn | `functions.php:3126-3135` | Bổ sung `wp_create_nonce` và `check_ajax_referer` |
| **SEC-02** | P1 | Dữ liệu người dùng chưa escape khi gửi Telegram | `functions.php:3071, 3159` | Bọc `htmlspecialchars()` trước khi gửi tin Telegram |
| **DB-01** | P1 | Chuẩn bị database mẫu cho Phú Thọ (tiền tố `wp_`) | CSDL | Chuẩn bị script import DB sạch ở Slice 2 |

---

## 6. Không được tự ý làm trong lần tiếp theo

- Không tự ý import DB thật nếu chưa được kiểm tra cấu hình tiền tố bảng.
- Không tự ý commit hoặc deploy production khi chưa có phê duyệt.
- Giữ nguyên trạng thái cấu hình an toàn, không hardcode mật khẩu vào source.

---

## 7. Đúng một Slice đề xuất tiếp theo

- **ID:** **SLICE-02**
- **Mục tiêu duy nhất:** Thiết lập CSDL mẫu (Database Schema), kết nối `wp-config.php` và kích hoạt Child Theme `flatsome-child-minhnganphutho`.
- **Bao gồm:** Chuẩn hóa file dump CSDL mẫu cho VinFast Minh Ngân Phú Thọ 3S với tiền tố bảng đồng bộ (`wp_`), kiểm tra active theme & plugins.
- **Không bao gồm:** Chưa thay đổi nội dung trang con hoặc chỉnh sửa các component nâng cao.
- **Acceptance criteria:** Kết nối thành công tới CSDL, website load được trang chủ với theme VinFast Minh Ngân Phú Thọ 3S.
- **Trạng thái:** **DỪNG — CHỜ CHỦ DỰ ÁN DUYỆT.**
