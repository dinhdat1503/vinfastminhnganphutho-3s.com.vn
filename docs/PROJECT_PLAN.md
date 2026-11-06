# PROJECT PLAN — VINFAST MINH NGÂN PHÚ THỌ 3S

> **Kế hoạch dự án:** Dựng và chuẩn hóa hệ thống website đại lý ô tô điện VinFast Minh Ngân Phú Thọ (chuẩn 3S).
> **Ngôn ngữ:** Tiếng Việt | **Tiêu chuẩn tuân thủ:** `AGENTS.md`, `docs/QUALITY_GATES.md`, `docs/SECURITY_STANDARDS.md`.

## 1. Thông tin dự án

- **Tên dự án:** Website Đại Lý VinFast Minh Ngân Phú Thọ — 3S (`vinfastminhnganphutho-3s.com.vn`)
- **Phiên bản mục tiêu:** MVP 1.0 (Bộ khung cấu trúc, Theme 3S, Trang chủ, Trang sản phẩm xe, Dự toán chi phí, Đăng ký lái thử, Báo giá)
- **Chủ dự án / người phê duyệt:** Anh Đạt
- **Mục tiêu cốt lõi:** Xây dựng website đại lý bán lẻ ô tô điện VinFast chuẩn 3S (Sales - Service - Spare parts) tại Phú Thọ: giới thiệu mẫu xe điện, tính giá lăn bánh, dự toán trả góp ngân hàng, đặt cọc giữ chỗ và quản lý thu thập khách hàng tiềm năng (Leads).
- **Nhóm người dùng:**
  - Khách hàng quan tâm và mua xe ô tô điện VinFast tại Phú Thọ & khu vực lân cận.
  - Tư vấn bán hàng & quản trị viên đại lý (nhận Lead qua Telegram/Email/Admin).
- **Môi trường phát triển & vận hành:**
  - Local / Staging: Windows / Web server (LiteSpeed/Nginx/Apache hoặc Docker).
  - Production: Hosting cPanel/DirectAdmin LiteSpeed WordPress.
- **Nguồn tài nguyên kế thừa đã xác minh:**
  - Giao diện & tính năng chuyên sâu: Kế thừa từ `D:\DinhDat\Me\vinfasttanachill` (Child Theme Flatsome + Custom Plugins cho xe VinFast).
  - Cụm WordPress Core & Plugins chuẩn: `D:\DinhDat\Me\vinhphucvinfast.com.vn\vinhphucvinfast.com.vn` (WordPress 6.x/7.x, Parent Theme Flatsome 3.20.2, ACF, WooCommerce, Contact Form 7, Smart Slider 3, Popup Maker).
  - Cơ chế nhận chuyến & bot Zalo/Telegram (nếu cần mở rộng): `D:\DinhDat\Me\vinfasttanachau`.

## 2. Phạm vi sản phẩm (Scope)

| Mức độ | Tính năng | Tiêu chí chấp nhận | Trạng thái |
|---|---|---|---|
| **MUST (MVP)** | Khung cấu trúc dự án & Theme sạch cho Minh Ngân Phú Thọ | Tách bạch Theme/Plugins, loại bỏ triệt để hardcode path Windows cũ (`C:/Users/ngodi/...`), chuẩn hóa brand Minh Ngân Phú Thọ 3S | IN PROGRESS (Slice 1) |
| **MUST (MVP)** | Trang chủ đại lý chuẩn 3S | Banner Swiper, danh mục xe điện (VF 3, VF 5, VF 6, VF 7, VF 8, VF 9...), khối dịch vụ 3S, form tư vấn | BACKLOG |
| **MUST (MVP)** | Trang chi tiết mẫu xe (`single-car_model`) | Sticky subnav, đổi màu xe realtime, bảng thông số kỹ thuật, CTA lái thử/báo giá | BACKLOG |
| **MUST (MVP)** | Bộ công cụ tài chính (Dự toán lăn bánh & Trả góp) | Tính đúng biểu phí trước bạ, bảo hiểm, biển số theo khu vực Phú Thọ; bảng trả góp ngân hàng | BACKLOG |
| **MUST (MVP)** | Form thu thập Lead & Thông báo | Xác thực Nonce CSRF, bọc HTML an toàn gửi Telegram bot, báo trạng thái lỗi/thành công trung thực | BACKLOG |
| **SHOULD** | Trang Đặt cọc trực tuyến (VietQR động) | Tạo mã VietQR tự động kèm nội dung đơn cọc, kiểm tra trạng thái thanh toán | BACKLOG |
| **SHOULD** | Trang Tìm kiếm Showroom & Trạm sạc Phú Thọ | Bản đồ tích hợp các trạm sạc VinFast tại tỉnh Phú Thọ | BACKLOG |
| **LATER** | Đồng bộ Lead đa kênh (Zalo Mini App / CRM) | Kết nối API webhook với hệ thống quản lý tập trung | BACKLOG |

**Ngoài phạm vi MVP 1.0:** Không tích hợp cổng thanh toán trực tiếp qua thẻ quốc tế (chỉ dùng VietQR và chuyển khoản ngân hàng); không sửa đổi core WordPress.

## 3. Kiến trúc và công nghệ

| Lớp | Công nghệ | Ghi chú |
|---|---|---|
| **CMS Platform** | WordPress (6.x / 7.x) | PHP 7.4+ / PHP 8.1+, MariaDB / MySQL 5.7+ |
| **Parent Theme** | Flatsome Theme (UX Builder) | Framework responsive, tối ưu thương mại điện tử |
| **Child Theme** | `flatsome-child-minhnganphutho` | Kế thừa và tùy biến toàn bộ UI/UX VinFast Phú Thọ |
| **Custom Post Types** | `car_model` (Mẫu xe), `car_category` | Quản lý danh mục xe cá nhân, xe dịch vụ |
| **Plugins tiêu chuẩn** | ACF Pro, WooCommerce, Contact Form 7, Smart Slider 3, Popup Maker | Bộ plugin vận hành cơ bản |
| **Custom Plugins** | `ai-writer`, `wp-insight`, `vinfast-template` | Tiện ích hỗ trợ nội dung & layout xe |
| **Thông báo Lead** | Telegram Bot API + WP Mail SMTP | Gửi tức thời về nhóm sale Phú Thọ |

## 4. Định hướng lộ trình theo Slice

- **SLICE-01 (Hiện tại):** Khởi tạo bộ khung dự án (Scaffolding) sạch cho VinFast Minh Ngân Phú Thọ 3S:
  - Thiết lập cấu trúc thư mục chuẩn.
  - Dựng bộ khung Theme `flatsome-child-minhnganphutho` chuẩn hóa nhận diện thương hiệu Minh Ngân Phú Thọ - 3S.
  - Fix dứt điểm các lỗi đường dẫn cứng P0 và cấu hình mẫu `.env.example` / `wp-config-sample.php`.
- **SLICE-02:** Cấu hình Core & Tích hợp Plugins tiêu chuẩn, cấu hình Custom Post Types (`car_model`) và ACF fields.
- **SLICE-03:** Hoàn thiện giao diện Trang chủ & Trang dịch vụ chuẩn 3S.
- **SLICE-04:** Công cụ Dự toán chi phí lăn bánh Phú Thọ & Trả góp ngân hàng.
- **SLICE-05:** Module Đặt cọc VietQR, Form bảo mật Nonce & Telegram Bot notification.
- **SLICE-06:** Audit nghiệm thu, tối ưu tốc độ và bàn giao release.
