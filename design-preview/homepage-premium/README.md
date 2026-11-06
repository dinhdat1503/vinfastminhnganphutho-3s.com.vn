# HƯỚNG DẪN TRẢI NGHIỆM THIẾT KẾ: HOMEPAGE PREMIUM SHOWROOM
## DỰ ÁN: VINFAST MINH NGÂN PHÚ THỌ 3S

> **Triết lý thiết kế:** *"THE CAR IS THE HERO. THE EXPERIENCE IS PREMIUM."*  
> **Concept:** CONCEPT A — PREMIUM SHOWROOM (Đã được Chủ dự án phê duyệt)  
> **Nguyên tắc an toàn source:** Đây là bản Design Preview độc lập trong thư mục `design-preview/homepage-premium/`, hoàn toàn **không can thiệp** vào mã nguồn WordPress Core, Flatsome Parent hay Child Theme đang chạy.

---

### 1. CÁCH MỞ VÀ TRẢI NGHIỆM BẢN PREVIEW TƯƠNG TÁC

1. **Mở trực tiếp trên máy tính:**
   - Mở File Explorer, truy cập thư mục:  
     `D:\DinhDat\Me\vinfastminhnganphutho-3s.com.vn\design-preview\homepage-premium\`
   - Bấm đúp chuột vào file **`index.html`** để mở trên trình duyệt (Edge, Chrome, Cốc Cốc, Safari).
2. **Trải nghiệm trên điện thoại (Mobile Simulation):**
   - Trên trình duyệt, bấm `F12` để mở DevTools, click biểu tượng điện thoại (Toggle Device Toolbar).
   - Chọn kích thước **iPhone 14 Pro (390×844)** hoặc **iPhone SE (375×667)**.
   - Thao tác thực tế với **Sticky Quick Action Bar 3 nút bám đáy** và **Menu trượt Off-canvas Drawer**.

---

### 2. BẢNG DESIGN TOKENS CHUẨN XÁC

```css
:root {
  /* Bảng màu chuẩn Concept A */
  --bg-primary:     #FBFBFA; /* Nền chính ấm nhẹ, sang trọng */
  --bg-secondary:   #F3F5F7; /* Nền khối phụ, thẻ thông số */
  --bg-white:       #FFFFFF; /* Nền thẻ xe, bảng biểu */
  --bg-dark:        #11161F; /* Nền Cinematic tối cho tương lai xanh */
  --text-primary:   #111827; /* Màu chữ tiêu đề và nội dung chính */
  --text-secondary: #64748B; /* Màu chữ mô tả phụ */
  --accent-blue:    #2563EB; /* Xanh VinFast chính hãng (dùng có chọn lọc) */
  --border-color:   #E5E7EB; /* Đường viền thanh mảnh */

  /* Typography Scale (Be Vietnam Pro / Inter) */
  --font-main:      'Be Vietnam Pro', 'Inter', sans-serif;
  --h1-desktop:     56px - 64px (line-height: 1.12, weight: 600);
  --h1-mobile:      34px - 40px (weight: 600);
  --h2-desktop:     36px - 44px (weight: 600);
  --h2-mobile:      28px - 32px (weight: 600);
  --h3:             22px - 28px;
  --body-desktop:   16px - 18px;
  --body-mobile:    15px - 16px;
  --caption:        12px - 14px;

  /* Layout & Spacing */
  --container-max:  1240px;
  --spacing-desktop: 88px - 112px;
  --spacing-mobile:  56px - 72px;
  --radius-sm:      6px;
  --radius-md:      10px;
  --radius-lg:      16px;
}
```

---

### 3. CẤU TRÚC 8 PHÂN KHU (SECTIONS) THEO ĐẶC TẢ

1. **Header:** Logo vector chính hãng VinFast Minh Ngân Phú Thọ 3S sắc nét (height 64px), thanh menu tối giản, nút CTA **ĐĂNG KÝ LÁI THỬ** màu xanh `#2563EB`.
2. **Section 01 — Hero Signature Showroom:**
   - Bố cục 2 cột (Content 40% / Hình ảnh 60%). Chiều cao tham chiếu 680px.
   - Eyebrow: `VINFAST MINH NGÂN · PHÚ THỌ`.
   - H1: `Khám phá tương lai di chuyển.`
   - Thẻ thông số nổi (Floating Spec Badge): VF 7 Plus, tầm hoạt động 431 km, công suất 349 hp.
   - 2 CTA: *Khám phá các dòng xe* và *Đăng ký lái thử*.
3. **Section 02 — Car Collection (Showroom Gallery):**
   - Tiêu đề: `Khám phá bộ sưu tập xe điện.`
   - Tab chuyển đổi: **Xe cá nhân** (VF 3, VF 5, VF 6, VF 7, VF 8, VF 9) và **Xe thương mại Green Series** (Minio, Limo, EC Van).
   - Thẻ xe rộng, ảnh lớn 3/4 chính hãng, thông số số chỗ, tầm hoạt động và giá niêm yết có gắn nhãn DEMO.
4. **Section 03 — After-Sales Experience:**
   - Tiêu đề: `Đồng hành trên mọi hành trình.`
   - Editorial 2 cột: Ảnh xưởng dịch vụ 3S chất lượng cao cùng 4 cam kết cốt lõi (Bảo hành 10 năm/200.000km, Cứu hộ 24/7, Phụ tùng chính phẩm, Đặt lịch thông minh).
   - CTA: *Đặt lịch bảo dưỡng trực tuyến*.
5. **Section 04 — Green Future (Cinematic Dark Break):**
   - Nền tối `#11161F` sang trọng tạo điểm nghỉ thị giác, thông điệp "Mãnh liệt tinh thần Việt Nam" cùng 3 chỉ số ấn tượng (150.000+ cổng sạc, Thuế trước bạ 0%, Tiết kiệm 1/3 chi phí vận hành).
6. **Section 05 — Green Series:**
   - Tiêu đề: `Giải pháp di chuyển cho kinh doanh.`
   - Giới thiệu các dòng xe vận tải và dịch vụ (Minio Green, Herio Green, EC Van) kèm CTA nhận tư vấn doanh nghiệp.
7. **Section 06 — Financial Tools:**
   - Tiêu đề: `Chủ động kế hoạch sở hữu xe.`
   - 2 editorial panels: **Dự toán lăn bánh** (áp thuế 0%, phí biển số tỉnh, in PDF) và **Tính vay trả góp** (dư nợ giảm dần, xuất bảng chi tiết từng tháng).
8. **Section 07 — News & Events:**
   - Tiêu đề: `Tin tức & Sự kiện.`
   - Bố cục dạng tạp chí editorial: 1 bài viết tiêu điểm lớn bên trái và 3 tin tức khuyến mãi mới nhất bên phải.
9. **Section 08 — Showroom & Contact:**
   - Tiêu đề: `Trải nghiệm VinFast tại Minh Ngân.`
   - Tích hợp bản đồ Google Maps chỉ đường đến Showroom Phú Thọ, Hotline 24/7 (`0981.335.522`) và giờ làm việc.
10. **Thanh điều hướng Mobile (Sticky Quick Action Bar):**
    - Cố định đáy màn hình điện thoại (< 768px) với đúng 3 nút chuẩn ngón tay cái:
      - 📞 **Gọi ngay** (`tel:0981335522`)
      - 🧮 **Dự toán** (`#finance`)
      - 🚗 **LÁI THỬ** (Nút màu xanh `#2563EB` nổi bật nhất)
11. **Popup ưu đãi tự đóng:**
    - Tự động xuất hiện sau 3 giây để thông báo ưu đãi cho khách mới, tự đóng sau 15 giây hoặc khi bấm `X` / phím `ESC`, có lưu trạng thái `sessionStorage`.

---

### 4. BẰNG CHỨNG SCREENSHOT ĐÃ KIỂM CHỨNG TRÊN TRÌNH DUYỆT THẬT

- 🖥️ **Bản Desktop 1440 × 900:**  
  `screenshots/desktop_1440.png` (Dung lượng: 1.02 MB)  
  *Kiểm chứng: Bố cục 12 cột cân xứng, ảnh xe nổi bật, không lỗi tràn viền.*
- 📱 **Bản Mobile 390 × 844 (iPhone 14 Pro):**  
  `screenshots/mobile_390.png` (Dung lượng: 332 KB)  
  *Kiểm chứng: Sticky Bar 3 nút bám đáy hoàn hảo, các thẻ xe xếp dọc thoáng đãng, không đè chữ.*

---

### 5. BẢN ĐỒ ÁNH XẠ CHUYỂN ĐỔI SANG FLATSOME CHILD THEME (MAPPING)

Khi chủ dự án duyệt bản thiết kế này, quá trình đưa vào mã nguồn WordPress sẽ được thực hiện qua:
- **`style.css`:** Nhúng toàn bộ khối biến Design Tokens (`--bg-primary`, `--accent-blue: #2563EB`) và quy chuẩn typography Be Vietnam Pro.
- **`page-home.php`:** Chuyển 8 sections tĩnh thành mã nguồn PHP động, tích hợp vòng lặp `WP_Query` lấy danh sách xe từ CPT `car_model` và tin tức mới nhất từ bảng `posts`.
- **`footer.php`:** Gắn component Sticky Mobile Bar 3 nút bám đáy và nút nổi Hotline/Zalo.
