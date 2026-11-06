# PHẦN 3: KIỂM TOÁN GIAO DIỆN & TRẢI NGHIỆM NGƯỜI DÙNG (UI/UX AUDIT)

## 1. Đánh Giá Trải Nghiệm & Luồng Chuyển Đổi (User Journey & Interactions)

### 1.1. Lỗi Nghiêm Trọng: Hiển Thị Thành Công Giả Khi Thất Bại (Fake Success on Failure)
- **Vị trí:** Tệp tin [footer.php](file:///d:/DinhDat/Me/vinfasttanachill/footer.php#L529-L538), hàm `handleFooterServiceSubmit()`.
- **Đoạn mã vi phạm:**
  ```javascript
  .catch(function(err) {
    if (notice) {
      notice.style.display = 'block';
      notice.style.color = '#4ADE80';
      notice.textContent = '✓ Đã nhận số điện thoại! Chuyên viên sẽ gọi tư vấn ngay.';
    } else {
      alert('Đã nhận số điện thoại! Chuyên viên sẽ gọi tư vấn ngay.');
    }
    input.value = '';
  })
  ```
- **Hành vi thực tế:** Khi kết nối mạng bị gián đoạn, server gặp sự cố 500/504 hoặc endpoint AJAX bị lỗi, khối lệnh `.catch()` lại in ra thông báo màu xanh lá cây `✓ Đã nhận số điện thoại! Chuyên viên sẽ gọi tư vấn ngay.` và xóa trắng ô nhập liệu.
- **Tác động người dùng:** Khách hàng tin rằng số điện thoại của mình đã được gửi tới đại lý và ngồi chờ cuộc gọi. Nhưng thực chất dữ liệu không hề đến máy chủ. Đại lý mất hoàn toàn khách hàng tiềm năng.
- **Quy tắc vi phạm:** AGENTS.md Mục 6: *"Có loading / empty / error / unauthorized / success khi liên quan; không hiển thị thành công giả hoặc mock data thay lỗi server."*
- **Phân loại:** **VERIFIED DEFECT (P1)**.

### 1.2. Bộ Tương Tác Nổi Trên Thiết Bị Di Động (Floating Clutter)
- **Các thành phần nổi đồng thời:**
  1. Nút Hotline lắc nhún (shake/pulse wave) cố định góc trái dưới màn hình.
  2. Nút Zalo nảy (bounce wave) cố định bên cạnh nút Hotline.
  3. Thanh công cụ Floating Action Sidebar bên phải (Lái thử, Dự toán, Trả góp, So sánh).
  4. Cửa sổ Promo Popup tự động nạp toàn màn hình từ `vfvp-modal.js`.
  5. Thanh Sticky Subnav bar khi cuộn trên trang chi tiết xe.
- **Vấn đề UX:** Trên màn hình điện thoại có chiều rộng nhỏ (320px - 390px, như iPhone SE, iPhone 13 mini), các nút nổi này chiếm dụng tới 25-35% diện tích màn hình hiển thị, che khuất nút gửi form hoặc các thông số kỹ thuật bên dưới, gây khó khăn cho việc thao tác chạm (touch target overlap).

---

## 2. Hệ Thống Thiết Kế (Design System & Typography)

### 2.1. Phá Vỡ Độ Ưu Tiên CSS Bằng `!important` Toàn Cục
- **Vị trí:** Tệp tin [style.css](file:///d:/DinhDat/Me/vinfasttanachill/style.css#L31-L33).
- **Mã nguồn:**
  ```css
  body, html, button, input, select, textarea, p, h1, h2, h3, h4, h5, h6, a, span, label, div, .vf-btn, ... {
    font-family: var(--vf-font) !important;
  }
  ```
- **Đánh giá rủi ro:**
  - Áp dụng `font-family: ... !important` lên hầu hết các thẻ HTML cơ bản (`div`, `span`, `a`, `p`, `label`).
  - Gây xung đột và **phá hỏng các icon fonts** (FontAwesome, Dashicons, icon font của Flatsome) nếu các icon này được hiển thị thông qua thẻ `<span>` hoặc `<i>` có class font icon.
  - Phá vỡ tính linh hoạt của CSS, buộc mọi thành phần con muốn sử dụng font chữ đặc thù đều phải dùng `!important` cấp cao hơn.

### 2.2. Lệch Pha Khai Báo & Nạp Font Chữ (Missing Font Enqueue)
- **Trong `style.css`:**
  `--vf-font: 'Mulish', 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;`
  Font chữ ưu tiên số 1 được đặt là **`Mulish`**.
- **Trong `functions.php` (dòng 155):**
  `wp_enqueue_style('vfvp-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap', [], null);`
- **Kết quả:** Font `Mulish` hoàn toàn **không được tải về** từ Google Fonts. Trình duyệt buộc phải bỏ qua `Mulish` và nạp `Plus Jakarta Sans` hoặc `Inter`, dẫn đến sai lệch layout giữa thiết kế mẫu và thực tế render.

---

## 3. Kiểm Toán Biểu Mẫu, Xác Thực & Phản Hồi (Forms & Validation)

1. **Form Đặt Cọc Xe (`page-dat-coc.php`):**
   - Wizard 3 bước hiển thị mượt mà.
   - Có cơ chế tạo mã QR thanh toán VietQR động với số tiền và nội dung chuyển khoản rõ ràng.
   - *Điểm trừ UX:* Khi người dùng hoàn thành bước 3 và quét mã QR chuyển khoản, hệ thống không có polling kiểm tra biến động số dư hoặc trạng thái giao dịch thật từ ngân hàng, chỉ hiển thị trạng thái "Đã gửi thông tin đơn cọc".
2. **Form Tính Chi Phí Lăn Bánh (`page-du-toan.php`):**
   - Giao diện trực quan, tính toán nhanh.
   - Hỗ trợ tốt `@media print` cho phép bấm nút In phiếu dự toán ra giấy/PDF sạch sẽ, không dính thanh menu và footer.
   - *Điểm trừ UX:* Đơn giá xe, mức phí trước bạ và phí biển số bị hardcode bằng biến JavaScript trong file template thay vì lấy động từ cấu hình quản trị, dễ bị lỗi thời khi VinFast hoặc nhà nước điều chỉnh giá/phí.
3. **Form Đăng Ký Lái Thử & Dịch Vụ (CF7):**
   - Đã nhúng shortcode Contact Form 7 chuẩn.
   - Thiếu phản hồi inline loading spinner rõ ràng khi bấm Submit; thông báo lỗi/thành công phụ thuộc vào div mặc định của CF7 thường bị trôi khuất tầm nhìn trên màn hình mobile.

---

## 4. Kiểm Toán SEO On-Page & Khả Năng Tiếp Cận (Accessibility)

- **Heading Hierarchy (Phân cấp H1 - H6):**
  - Trang chủ (`page-home.php`) sử dụng đúng 1 thẻ `<h1>` chính.
  - Các trang chi tiết xe (`single-*.php`) lặp lại nhiều thẻ `<h2>` và `<h3>` cho từng phân đoạn (Tổng quan, Ngoại thất, Nội thất).
- **Thẻ `aria-label` và Accessibility:**
  - Các nút gọi Hotline và Chat Zalo đã bổ sung `aria-label="Hotline"` và `aria-label="Chat Zalo"`.
  - Tuy nhiên các tab chọn màu xe trong bảng Color Selector chưa có thuộc tính `aria-selected` và hỗ trợ phím bấm bàn phím (Arrow keys / Spacebar) cho người dùng khiếm thị hoặc điều hướng bằng bàn phím.
- **Tôn trọng `prefers-reduced-motion`:**
  - Hiệu ứng sóng lan tỏa (`@keyframes vf-ripple`) và lắc chuông (`@keyframes vf-phone-shake`) chạy liên tục vô hạn (`infinite`) mà chưa có media query `@media (prefers-reduced-motion: reduce)` để tắt animation cho người dùng nhạy cảm với chuyển động (Vi phạm AGENTS.md Mục 12).

