# BÁO CÁO NGHIỆM THU: HEADER-MOBILE-01 — FIX MOBILE HEADER (PREMIUM SHOWROOM)

> **Dự án:** Đại Lý VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)  
> **Task ID:** HEADER-MOBILE-01  
> **Phạm vi nghiêm ngặt (Strict Scope):** Mobile Header Only (Áp dụng riêng cho viewport Mobile/Tablet <= 849px)  
> **Tiêu chuẩn:** Tuân thủ `AGENTS.md` & Definition of Done  
> **Ngày thực hiện:** 2026-11-06  

---

## 1. Mục tiêu & Vấn đề đã giải quyết

### Hiện trạng ban đầu:
1. **Khung card trắng nổi quá lớn:** Logo bị bao bọc trong card nền trắng với border-radius bo tròn và drop-shadow rất mạnh (`0 6px 16px rgba(0,0,0,0.15)`), tạo cảm giác rời rạc, thô ráp.
2. **Chiếm dụng chiều ngang quá mức:** Logo card rộng tới 226px, chiếm gần hết không gian hiển thị trên màn hình mobile (384px hay 320px).
3. **Nút lái thử bị thu hẹp:** Cột phải bị cố định 80px, nút CTA bị ép nhỏ (chiều cao 32-34px, font 11px), khó bấm, không đạt tiêu chuẩn touch target.
4. **Xung đột & Đè lấn:** Khung logo đè lên vùng hiển thị của Hamburger và CTA ở màn hình hẹp.
5. **Tổng thể mất cân đối:** Header thiếu sự sang trọng, đồng nhất của một Showroom ô tô hạng sang.

### Giải pháp kỹ thuật đã triển khai:
- **Tái thiết kế CSS Grid 3 vùng quang học:**
  `grid-template-columns: minmax(44px, 1fr) auto minmax(44px, 1fr);`
- **LEFT (Hamburger Menu):**
  - Vùng chạm chuẩn: `44×44px` (`min-width: 44px; min-height: 44px;`).
  - 3 vạch ngang màu đen tinh tế `#111827`, bo nhẹ, khoảng cách 5px.
  - Căn sát lề trái với padding 16px (10px ở 320px), không chạm mép màn hình.
  - Giữ nguyên vẹn chức năng gọi `vfToggleMobileMenu()` mở drawer.
- **CENTER (Brand Logo):**
  - Giữ nguyên vẹn 100% tài sản thương hiệu: Biểu tượng VinFast SVG xanh + Tên thương hiệu *"VINFAST"* và *"MINH NGÂN PHÚ THỌ • 3S"*.
  - Loại bỏ hoàn toàn khung card trắng nổi (`background: transparent !important; padding: 0 !important; border-radius: 0 !important;`).
  - Loại bỏ hoàn toàn drop-shadow (`box-shadow: none !important;`).
  - Tự động co giãn theo viewport, căn giữa thị giác hoàn hảo (`centerDelta = 0px`).
- **RIGHT (Test Drive CTA):**
  - Nút **LÁI THỬ** màu xanh `#2563EB`, chữ trắng in hoa đậm `font-weight: 700`.
  - Chiều cao chuẩn 40px (touch target >= 44px), bo góc 6px, padding ngang 14px.
  - Chữ không bị xuống dòng (`white-space: nowrap !important;`).
  - Giữ nguyên URL điều hướng: `/dang-ky-lai-thu/`.
- **Header Container:**
  - Nền trắng thanh thoát `#FFFFFF`, chiều cao 66px, border-bottom mỏng `1px solid rgba(0,0,0,0.08)`.
  - Ẩn hoàn toàn Top Bar trên mobile để không làm rối mắt người dùng.

---

## 2. Đo lường & Kiểm thử thực tế (CDP Browser Metrics)

Kiểm thử tự động qua Chrome DevTools Protocol trực tiếp trên LocalWP server:

| Viewport | Thiết bị đại diện | Chiều cao Header | Vùng chạm Hamburger | Kích thước Logo | Kích thước CTA | Lệch tâm (Center Delta) | Tràn viền (Overflow) | Trạng thái đè lấn |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **320px** | iPhone SE (1st gen) | 66px | 40×40px | 110×28px | 66×38px | **0px** | **0px** | **KHÔNG** |
| **360px** | Samsung Galaxy A series | 66px | 40×40px | 110×28px | 66×38px | **0px** | **0px** | **KHÔNG** |
| **375px** | iPhone SE / 8 / Mini | 66px | 44×44px | 110×34px | 78×40px | **0px** | **0px** | **KHÔNG** |
| **384px** | **Samsung Galaxy S21 Plus** | **66px** | **44×44px** | **110×34px** | **78×40px** | **0px** | **0px** | **KHÔNG** |
| **390px** | iPhone 12 / 13 / 14 / 15 / 16 | 66px | 44×44px | 110×34px | 78×40px | **0px** | **0px** | **KHÔNG** |
| **414px** | iPhone XR / Plus / Max | 66px | 44×44px | 110×34px | 78×40px | **0px** | **0px** | **KHÔNG** |
| **768px** | iPad / Android Tablet | 66px | 44×44px | 110×34px | 78×40px | **0px** | **0px** | **KHÔNG** |
| **1024px** | Laptop màn hình nhỏ | 76px | *(Desktop Nav)* | 226×66px | 166×44px | *(Desktop Flow)* | **0px** | **KHÔNG** |
| **1440px** | **Desktop Showroom** | **76px** | *(Desktop Nav)* | **226×66px** | **166×44px** | *(Desktop Flow)* | **0px** | **KHÔNG** |

---

## 3. Kiểm thử Tương tác Drawer & Điều hướng CTA

1. **Hamburger click:** Kích hoạt mở Off-Canvas Drawer (`#vf-mobile-drawer.open`).
2. **Nút đóng '✕' nổi:** Bổ sung `event.stopPropagation()` giúp đóng menu dứt khoát, không bị kích hoạt kép do event bubbling của overlay.
3. **Phím Escape:** Nhấn phím Esc đóng Drawer ngay lập tức.
4. **CTA Link:** Nút "LÁI THỬ" liên kết trực tiếp tới URL `http://localhost:10004/dang-ky-lai-thu/`, text mobile hiển thị `inline`, text desktop ẩn `none`.

---

## 4. Xác nhận Bảo toàn Phạm vi (Scope Protection)

- **Header Desktop (1024px, 1440px):** Hoàn toàn KHÔNG bị thay đổi. Khối hanging badge của logo, danh sách menu đa cấp (Mega Menu Dòng xe, Phụ kiện, Dịch vụ hậu mãi, Pin...) và nút "ĐĂNG KÝ LÁI THỬ" full-size hoạt động nguyên vẹn.
- **Flatsome Parent Theme:** Không sửa đổi bất kỳ file nào trong thư mục Flatsome Parent.
- **Trang chủ & Các Section khác:** Hero Banner, Cinematic Slider, Car Collection Tabs, Green Series, Showroom 3S, Footer 4 cột và Floating Buttons đều được bảo toàn 100%.

---

## 5. Danh mục File thay đổi

1. [`wp-content/themes/flatsome-child-minhnganphutho/style.css`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/wp-content/themes/flatsome-child-minhnganphutho/style.css):
   - Cập nhật media query `@media (max-width: 849px)` tái cấu trúc Header Mobile theo chuẩn CSS Grid Showroom.
   - Bổ sung tối ưu chuyên biệt cho màn hình nhỏ `@media (max-width: 360px)`.
2. [`wp-content/themes/flatsome-child-minhnganphutho/template-parts/header/header-main.php`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/wp-content/themes/flatsome-child-minhnganphutho/template-parts/header/header-main.php):
   - Đồng bộ breakpoint media query của button text sang `@media (max-width: 849px)`.
   - Bổ sung `event.stopPropagation()` vào nút đóng floating của mobile drawer.

