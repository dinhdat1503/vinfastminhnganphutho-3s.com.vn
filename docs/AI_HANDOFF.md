# AI HANDOFF — TRẠNG THÁI TIẾP NỐI
> **Cập nhật sau MỖI Slice và MỖI lần Kiểm toán.** Đây là tài liệu trạng thái tiếp nối cho AI và Chủ dự án, tuân thủ nghiêm ngặt `AGENTS.md`.

---

## 1. Snapshot mới nhất

- **Dự án:** Tái cấu trúc Website Đại Lý VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)
- **Ngày cập nhật:** 2026-11-06, Asia/Ho_Chi_Minh
- **Branch / HEAD:** `main` (Remote: `https://github.com/dinhdat1503/vinfastminhnganphutho-3s.com.vn.git`)
- **Môi trường Local:** LocalWP site `vinfastminhnganphutho-3s` đang chạy tại `http://localhost:10004` (PHP 8.2.29, Nginx, MySQL 8.4).
- **Nhiệm vụ vừa hoàn thành:** **TASK ID: HEADER-MOBILE-05 — FIX VERTICAL CENTER ALIGNMENT**.
- **Kết quả nghiệm thu:**
  1. **Căn giữa tuyệt đối trục dọc (Vertical Center) chuẩn xác 100% (verticalDeviation = 0.00px):**
     - **Nguyên nhân gốc rễ (Root Cause):** Flatsome kế thừa quy tắc clearfix `.container:after` (`content: " "; display: table;`). Trong CSS Grid 3 cột của mobile header, pseudo-element `::after` này vô tình bị browser nhận diện thành item thứ 4, tự động rớt xuống tạo Implicit Grid Row 2 (cao 7px) kèm grid-gap 8px, chiếm mất 15px khoảng trống chết ở đáy header. Do đó, cả 3 thành phần ở Row 1 bị nén lên trên với độ lệch đúng `-7.5px` (Nút CTA: top 5.5px, bottom 20.5px; Hamburger: top 3.5px, bottom 18.5px; Logo: top 8.5px, bottom 23.5px).
     - **Giải pháp triệt để:**
       - Triệt tiêu hoàn toàn pseudo-element clearfix thừa trên mobile header: `.header-main .header-inner::before, .header-main .header-inner::after { display: none !important; content: none !important; width: 0 !important; height: 0 !important; }`.
       - Khóa cứng Grid đúng 1 hàng duy nhất: `grid-template-rows: 1fr !important; align-content: center !important; column-gap: 8px !important; row-gap: 0 !important;`.
       - Di chuyển thẻ `<style>` inline trong `header-main.php` ra ngoài thẻ `.header-inner` để bảo toàn cấu trúc DOM sạch.
  2. **Bảng số liệu đo thực tế qua CDP DOM `getBoundingClientRect()` tại Viewport 384px (Samsung Galaxy S21 Plus):**
     - Header: `top: 0px`, `bottom: 66px`, `height: 66px`, `centerY: 33.00px`.
     - **Hamburger Button (Trái):** `top: 11px`, `bottom: 55px`, `height: 44px`, `topGap: 11px`, `bottomGap: 11px`, `centerY: 33.00px`, `verticalDeviation: 0.00px` (Trước sửa: `topGap: 3.5px`, `bottomGap: 18.5px`, `verticalDeviation: -7.50px`).
     - **Brand Logo (Giữa):** `top: 16px`, `bottom: 50px`, `height: 34px`, `topGap: 16px`, `bottomGap: 16px`, `centerY: 33.00px`, `verticalDeviation: 0.00px`, `horizontalDeviation: 0.00px` (Trước sửa: `topGap: 8.5px`, `bottomGap: 23.5px`, `verticalDeviation: -7.50px`).
     - **Nút CTA LÁI THỬ (Phải):** `top: 13px`, `bottom: 53px`, `height: 40px`, `topGap: 13px`, `bottomGap: 13px`, `centerY: 33.00px`, `verticalDeviation: 0.00px` (Trước sửa: `topGap: 5.5px`, `bottomGap: 20.5px`, `verticalDeviation: -7.50px`).
  3. **Kiểm thử trên toàn bộ dải Viewports (320px, 375px, 384px, 390px, 414px, 768px, 1440px):**
     - Viewport 320px: `verticalDeviation: 0.00px` (Hamburger top/bottom 13px/13px; Logo top/bottom 19px/19px; CTA top/bottom 14px/14px).
     - Viewport 375px: `verticalDeviation: 0.00px` (topGap = bottomGap cân đối tuyệt đối).
     - Viewport 384px (Galaxy S21+): `verticalDeviation: 0.00px`.
     - Viewport 390px (iPhone 12/13/14/15/16 Pro): `verticalDeviation: 0.00px`.
     - Viewport 414px (iPhone Plus/Max): `verticalDeviation: 0.00px`.
     - Viewport 768px (iPad/Tablet): `verticalDeviation: 0.00px`.
     - Viewport 1440px (Desktop): Header 76px, `centerY: 38.00px`, Logo top/bottom 5px/5px (`verticalDeviation: 0.00px`), CTA top/bottom 16px/16px (`verticalDeviation: 0.00px`) — 0px layout regression.
  4. **Bảo tồn nghiêm ngặt các thành phần ngoài phạm vi:**
     - Giữ nguyên vị trí căn giữa ngang Logo (độ lệch ngang 0.00px).
     - Không thay đổi Hero Banner, Drawer Menu, Footer, Single Car Model hay Database.
  5. **Bộ ảnh nghiệm thu trực quan (Screenshots):**
     - [`docs/audit/screenshots/before_vertical_header_384.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/before_vertical_header_384.png) (Trước khi sửa — Viewport 384px)
     - [`docs/audit/screenshots/after_vertical_header_384.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_vertical_header_384.png) (Sau khi sửa — Viewport 384px)
     - [`docs/audit/screenshots/after_vertical_header_320.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_vertical_header_320.png) (Sau khi sửa — Viewport 320px)
     - [`docs/audit/screenshots/after_vertical_header_390.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_vertical_header_390.png) (Sau khi sửa — Viewport 390px)
     - [`docs/audit/screenshots/after_vertical_header_768.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_vertical_header_768.png) (Sau khi sửa — Tablet 768px)
     - [`docs/audit/screenshots/after_vertical_header_1440.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/docs/audit/screenshots/after_vertical_header_1440.png) (Sau khi sửa — Desktop 1440px)
- **Trạng thái hiện tại:** **HOÀN THÀNH HEADER-MOBILE-05 — ĐÃ COMMIT VÀ PUSH THEO YÊU CẦU CỦA CHỦ DỰ ÁN**.
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
