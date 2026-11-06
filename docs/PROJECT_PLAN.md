# PROJECT PLAN — VINFAST MINH NGÂN

> **Tài liệu chiến lược & Kế hoạch triển khai chính thức**
> Cập nhật theo Đặc tả chi tiết & Báo giá được phê duyệt bởi Chủ dự án (2026-11-06).
> Tuân thủ nghiêm ngặt `AGENTS.md`, `docs/QUALITY_GATES.md`, `docs/SECURITY_STANDARDS.md`.

---

## 1. Thông tin chung & Mục tiêu dự án

- **Tên dự án:** Website Đại Lý Ô Tô Điện VinFast Minh Ngân (`vinfastminhnganphutho-3s.com.vn`)
- **Chủ dự án / Người phê duyệt:** Anh Đạt
- **Màu sắc chủ đạo (Brand Identity):** Xanh VinFast `#2563EB`
- **Sứ mệnh:**
  1. Số hóa toàn bộ hành trình mua xe ô tô điện VinFast (từ tìm hiểu, dự toán lăn bánh đến đăng ký lái thử tận nhà 24/7).
  2. Minh bạch hóa chi phí: Tự động tính giá lăn bánh theo tỉnh thành (ưu đãi trước bạ 0%), bảng tính lãi suất trả góp dư nợ giảm dần, in báo giá PDF 1-click.
  3. Tối ưu tỷ lệ chuyển đổi khách hàng (Lead Conversion): Chuẩn Mobile-First 100%, tích hợp Dual-Recipient SMTP gửi đồng thời 2 email chính thức và thông báo đa kênh.

---

## 2. Phạm vi sản phẩm & Bảng tính năng hợp đồng (Gói Cơ Bản - 4.000.000 VNĐ)

| STT | Phân hệ / Hạng mục | Template / Quy chuẩn | Nội dung đặc tả chi tiết | Trạng thái |
|---|---|---|---|---|
| **1** | **Nền tảng & Theme** | Flatsome Child Theme | Tối ưu tốc độ, chuẩn hóa cấu trúc sạch, tích hợp CI/CD tự động deploy qua GitHub Webhook lên VPS | **HOÀN THÀNH (Slice 1)** |
| **2** | **Trang Chủ** | `page-home.php` | Đầy đủ 8 mục: Hero Slider banner, Car Showcase (VF 2 - VF 9 tóm tắt 4 thông số), Xưởng dịch vụ & Bảo hành 10 năm, Chiến dịch tương lai xanh, Green Series xe dịch vụ, 2 khối công cụ tài chính, Tin tức tự đẩy mới lên đầu, Bản đồ Google Maps Showroom | **SLICE 3** |
| **3** | **Trang Chi Tiết Xe** | `single-car_model.php` / `single-product-vinfast.php` | Thông số kỹ thuật (quãng đường NEDC/WLTP, pin, sạc nhanh), công nghệ ADAS, trợ lý Vivu, CTA Lăn bánh / Lái thử / Tải Brochure PDF (triển khai mẫu 2 dòng xe trước) | **SLICE 4** |
| **4** | **Dự toán lăn bánh & In PDF** | `page-du-toan.php` (Tab A) | Tự động tính lăn bánh theo tỉnh thành, áp dụng Lệ phí trước bạ 0%, bóc tách phí biển số, đăng kiểm, đường bộ, TNDS; Nút `TẢI PDF` 1-click xuất bản in chuẩn mẫu | **SLICE 5** |
| **5** | **Tính vay trả góp ngân hàng** | `page-du-toan.php` (Tab B) | Tính dư nợ giảm dần (trả trước 20-80%, vay 1-8 năm), xuất bảng chi tiết từng tháng (kỳ hạn, gốc, lãi, tổng trả, dư nợ) | **SLICE 5** |
| **6** | **Đăng ký lái thử** | `page-lai-thu.php` | Form chọn xe (VF 3 đến VF 9), tùy chọn tại Showroom hoặc tại nhà; gửi AJAX không reload trang, bắn thông báo về 2 email chính | **SLICE 6** |
| **7** | **Đặt lịch bảo dưỡng 4 bước** | `page-dat-lich-dich-vu.php` | Quy trình đặt lịch dịch vụ online 4 bước, cam kết bảo hành chính hãng 10 năm hoặc 200.000 km | **SLICE 6** |
| **8** | **Thu thập Lead & Điều hướng Mobile** | Header, Footer, Sticky Bar | Sticky Quick Action Bar 3 nút đáy màn hình Mobile (📞 Gọi ngay, 🧮 Dự toán, 🚗 Lái thử); Nút nổi Hotline/Zalo + Popup ưu đãi tự đóng | **SLICE 2** |

---

## 3. Kiến trúc kỹ thuật & Dữ liệu cốt lõi

### 3.1. Dải sản phẩm xe điện hỗ trợ
- **Xe cá nhân:** VF 2, VF 3, VF 5 Plus, VF 6, VF 7, VF 8, VF 8 The All New, VF 9, VF MPV 7, VF Wild.
- **Xe thương mại & dịch vụ (Green Series):** Minio Green, Herio Green, Nerio Green, Limo Green, EC Van, eBus.

### 3.2. Cấu trúc Navigation & Nhận diện
- **Header:** Logo VinFast Minh Ngân sắc nét vector (height: 64px, căn giữa); Mega Menu phân tầng; Nút CTA ĐĂNG KÝ LÁI THỬ màu `#2563EB`.
- **Mobile Navigation:** Off-canvas Drawer kèm tìm kiếm thông minh; Thanh điều hướng cố định 3 nút (Gọi / Dự toán / Lái thử).
- **Hệ thống gửi thư Dual-Recipient SMTP:**
  - Gửi đồng thời tới 2 email nhận chính thức (`To:`) qua máy chủ `smtp.gmail.com:587` (STARTTLS).
  - Tên người gửi định danh: **VinFast Minh Ngân**.
  - Áp dụng tự động cho toàn bộ biểu mẫu Contact Form 7 và `wp_mail()`.

### 3.3. Tự động hóa nội dung & CI/CD
- Tin tức hiển thị giảm dần theo ngày đăng (`ORDER BY post_date DESC`), bài mới nhất tự động chiếm vị trí số 1.
- Quản lý mã nguồn trên GitHub repository `dinhdat1503/vinfastminhnganphutho-3s.com.vn`.
- Tự động deploy qua Webhook aaPanel VPS khi push nhánh `main`.

---

## 4. Lộ trình thực hiện chi tiết theo từng Slice

- [x] **SLICE-01: Khởi tạo bộ khung Full WordPress & Dọn sạch lỗi P0** (Hoàn thành & đã push GitHub).
- [ ] **SLICE-02: Chuẩn hóa Header, Logo, Sticky Mobile Bar & Dual-Recipient SMTP VinFast Minh Ngân**.
- [ ] **SLICE-03: Xây dựng hoàn chỉnh Trang chủ `page-home.php` theo 8 phân khu đặc tả**.
- [ ] **SLICE-04: Xây dựng Template Trang chi tiết xe `single-car_model.php` (2 mẫu xe chuẩn)**.
- [ ] **SLICE-05: Hoàn thiện Công cụ Dự toán lăn bánh (Thuế 0%), Bảng tính trả góp & Xuất PDF 1-Click**.
- [ ] **SLICE-06: Hoàn thiện Form Đăng ký lái thử, Đặt lịch bảo dưỡng 4 bước, Nút nổi Hotline/Zalo & Popup ưu đãi**.
- [ ] **SLICE-07: Kiểm thử tổng thể Quality Gates, tối ưu Mobile PageSpeed và bàn giao nghiệm thu**.
