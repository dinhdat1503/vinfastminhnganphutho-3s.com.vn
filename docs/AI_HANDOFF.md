# AI HANDOFF — TRẠNG THÁI TIẾP NỐI
> **Cập nhật sau MỖI Slice và MỖI lần Kiểm toán.** Đây là tài liệu trạng thái tiếp nối cho AI và Chủ dự án, tuân thủ nghiêm ngặt `AGENTS.md`.

---

## 1. Snapshot mới nhất

- **Dự án:** Tái cấu trúc Website Đại Lý VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)
- **Ngày cập nhật:** 2026-11-06, Asia/Ho_Chi_Minh
- **Branch / HEAD:** `main` (Remote: `https://github.com/dinhdat1503/vinfastminhnganphutho-3s.com.vn.git`)
- **Môi trường Local:** LocalWP site `vinfastminhnganphutho-3s` đang chạy tại `http://localhost:10004` (PHP 8.2.29, Nginx, MySQL 8.4).
- **Nhiệm vụ vừa hoàn thành:** **TASK ID: HEADER-MOBILE-01 — FIX MOBILE HEADER (PREMIUM SHOWROOM)**.
- **Kết quả nghiệm thu:**
  1. **Bố cục 1 hàng ngang chuẩn CSS Grid Showroom (Left - Center - Right):**
     - **LEFT (Hamburger Menu):** Vùng chạm chuẩn 44×44px (`min-width: 44px; min-height: 44px; display: flex; align-items: center; justify-content: center;`), 3 vạch ngang màu đen tinh tế `#111827`, không sát mép màn hình, mở Drawer mượt mà.
     - **CENTER (Brand Logo):** Giữ nguyên vẹn 100% logo chính thức VinFast Minh Ngân Phú Thọ 3S. Loại bỏ triệt để khung card trắng nổi kích thước lớn, loại bỏ hoàn toàn drop-shadow nặng. Logo căn giữa quang học hoàn hảo trên toàn bộ các kích thước màn hình (`centerDelta = 0px`).
     - **RIGHT (Test Drive CTA):** Nút **LÁI THỬ** xanh `#2563EB`, text trắng in hoa nổi bật, chiều cao 40px (touch target >= 44px), bo góc 6px, padding 14px, không bị ép chữ, không xuống dòng, liên kết trực tiếp tới `/dang-ky-lai-thu/`.
     - **Header Container:** Nền trắng `#FFFFFF`, chiều cao 66px, border-bottom mỏng `1px solid rgba(0,0,0,0.08)`, shadow siêu nhẹ `0 1px 3px rgba(0,0,0,0.03)`, thanh thoát, sang trọng.
  2. **Tối ưu cực hạn cho Viewport 320px – 414px (Đặc biệt Galaxy S21+ 384px):**
     - Viewport 320px: Header 66px, Hamburger 40×40px, Logo co giãn 110×28px (tên Minh Ngân hiển thị đầy đủ, không bị cắt), CTA 66×38px, `overflow = 0px`, `overlap = false`.
     - Viewport 384px (Samsung Galaxy S21 Plus): Header 66px, Hamburger 44×44px, Logo 110×34px, CTA 78×40px, `overlap = false`, `centerDelta = 0px`, `overflow = 0px`.
     - Viewport 390px, 414px, 768px: Bố cục cân xứng tuyệt đối, khoảng cách hai bên thoáng đãng chuẩn showroom ô tô.
  3. **Bảo toàn 100% Header Desktop (1024px, 1440px):**
     - Giữ nguyên khối hanging badge của logo cho Desktop.
     - Giữ nguyên danh mục Mega Menu Desktop (Giới thiệu, Ô tô ▾, Phụ kiện, Dịch vụ ▾, Pin & Trạm sạc, Dự toán...).
     - Giữ nguyên nút "ĐĂNG KÝ LÁI THỬ" full-size trên desktop.
     - 0px layout regression trên desktop.
  4. **Kiểm thử Drawer & Tương tác:**
     - Hamburger click -> Mở Off-Canvas Drawer (`.vf-mobile-drawer.open`).
     - Nút đóng nổi '✕' có `event.stopPropagation()` đóng drawer dứt khoát, không bị bubbling kích hoạt lại overlay.
     - Phím Escape đóng drawer tức thì.
  5. **Bộ ảnh nghiệm thu trực quan (Screenshots):**
     - [`docs/audit/screenshots/after_header_mobile_320.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_header_mobile_320.png) (Mobile 320px)
     - [`docs/audit/screenshots/after_header_mobile_375.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_header_mobile_375.png) (Mobile 375px)
     - [`docs/audit/screenshots/after_header_mobile_384.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_header_mobile_384.png) (Galaxy S21 Plus 384px)
     - [`docs/audit/screenshots/after_header_mobile_390.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_header_mobile_390.png) (iPhone 12/13/14/15/16 Pro 390px)
     - [`docs/audit/screenshots/after_header_tablet_768.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_header_tablet_768.png) (Tablet 768px)
     - [`docs/audit/screenshots/after_header_desktop_1440.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_header_desktop_1440.png) (Desktop 1440px)
- **Trạng thái hiện tại:** **HOÀN THÀNH HEADER-MOBILE-01 — DỪNG ĐỂ CHỦ DỰ ÁN NGHIỆM THU**.
- **Slice tiếp theo được đề xuất:** **SLICE-03: Hoàn thiện Trang Chi Tiết Dòng Xe (PDP — Single Car Model) cho 2 mẫu tiêu điểm: VinFast VF 3 và VinFast VF 7**.

---

## 2. Đúng một Slice tiếp theo được đề xuất

- **ID:** **SLICE-03**
- **Tên:** **Hoàn thiện Trang Chi Tiết Dòng Xe (PDP — Single Car Model) cho 2 mẫu tiêu điểm: VinFast VF 3 và VinFast VF 7**
- **Mục tiêu duy nhất:** Xây dựng trang giới thiệu chi tiết sản phẩm ô tô điện chuẩn Showroom, tích hợp đầy đủ thông số kỹ thuật (ACF/Meta), bảng giá các phiên bản kèm pin / thuê pin, thư viện ảnh nội-ngoại thất và form đăng ký lái thử trực tiếp dòng xe đó.
- **Bao gồm:**
  1. Template `single-car_model.php` (hoặc `single-product.php`) tối ưu UX automotive theo chuẩn VinFast.
  2. Hero xe chi tiết với bộ chọn màu sắc tương tác, bảng thông số pin, quãng đường, thời gian sạc nhanh.
  3. Bảng giá niêm yết và nút tính dự toán lăn bánh chuyển tiếp sang trang tài chính có sẵn thông tin xe.
  4. Form đăng ký lái thử nhanh tự động điền sẵn tên dòng xe đang xem.
- **Không bao gồm:** Chưa kết nối API CRM bên ngoài, chưa xây dựng trang so sánh xe nâng cao.
- **Tiêu chí nghiệm thu:**
  - 2 dòng xe VF 3 và VF 7 hiển thị đầy đủ thông tin chuẩn catalogue VinFast chính hãng.
  - Responsive mượt mà trên desktop và mobile, không tràn viền (0px overflow).
  - Form lái thử trên trang xe ghi nhận đúng tên xe vào email thông báo.
- **Trạng thái:** **DỪNG — CHỜ CHỦ DỰ ÁN PHÊ DUYỆT ĐỂ BẮT ĐẦU SLICE 3.**
