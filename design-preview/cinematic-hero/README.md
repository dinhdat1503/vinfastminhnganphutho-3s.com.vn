# HƯỚNG DẪN TRẢI NGHIỆM CINEMATIC MOTION HERO & DYNAMIC CAR SLIDER
**Dự án:** Website VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)  
**Mã nhiệm vụ:** `TASK ID: HOME-02.2`  
**Concept thiết kế:** **CONCEPT A — PREMIUM SHOWROOM**  
**Triết lý:** *"The car is the hero. The experience is premium."*

---

## 1. Cách mở và trải nghiệm Preview tương tác

Bản preview được xây dựng độc lập hoàn toàn bằng **HTML5 / CSS3 / Vanilla JavaScript**, không phụ thuộc WordPress database, cho phép trải nghiệm trực tiếp trên mọi trình duyệt:

### Cách 1: Mở trực tiếp file HTML
- Nhấp đúp chuột vào file:  
  [`design-preview/cinematic-hero/index.html`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/index.html)  
  *(Mở bằng Google Chrome, Microsoft Edge, Safari hoặc Firefox)*.

### Cách 2: Khởi chạy Static Local Server (Khuyên dùng)
Mở PowerShell tại thư mục dự án và chạy lệnh:
```powershell
npx serve design-preview/cinematic-hero -p 8089
```
Truy cập: `http://localhost:8089`

---

## 2. Các tính năng tương tác được tích hợp trong bản Preview

### A. Thanh công cụ giả lập kiểm định (Admin / Designer Simulator Toolbar)
Nằm ở mép trên cùng của màn hình, cung cấp các nút điều khiển trực tiếp để Chủ dự án kiểm tra:
1. **Khung nhìn (Viewport Switcher):** Chuyển đổi nhanh giữa các kích thước màn hình thực tế:
   - `100% Fullscreen` (Mặc định toàn màn hình)
   - `1440px` (Desktop tiêu chuẩn)
   - `1024px` (Small Desktop / iPad Pro)
   - `768px` (iPad / Tablet dọc)
   - `390px` (iPhone 13/14/15/16 Pro)
   - `320px` (Small Mobile / Galaxy Fold gập)
2. **Thời gian slide (Duration Speed):** Lựa chọn tốc độ: 5 giây (Nhanh), 8 giây (Tiêu chuẩn đề xuất), 12 giây (Thong thả).
3. **Nút [Replay Entrance]:** Kích hoạt lại toàn bộ hiệu ứng mở đầu điện ảnh 1.8s từ giây 0 để kiểm tra từng chuyển động.
4. **Nút [Reduced Motion: ON/OFF]:** Giả lập chế độ hạn chế chuyển động (dành cho người dùng nhạy cảm thị giác hoặc cài đặt hệ điều hành `prefers-reduced-motion`).
5. **Nút [Video Mode: ON/OFF]:** Bật/Tắt mô phỏng kiến trúc Video Hero nền.

### B. Hiệu ứng mở đầu điện ảnh (Entrance Animation - 1.8 giây)
- **T = 0.0s – 0.5s:** Nền Ambient stage glow tỏa dần từ tâm lưng xe.
- **T = 0.2s – 0.7s:** Eyebrow badge trượt nhẹ lên (`translateY: 22px -> 0`, `opacity: 0 -> 1`).
- **T = 0.4s – 0.9s:** Tiêu đề H1 trượt lên uyển chuyển.
- **T = 0.6s – 1.1s:** Đoạn mô tả dòng xe xuất hiện.
- **T = 0.8s – 1.3s:** Cặp nút CTA (Khám phá & Lái thử) xuất hiện.
- **T = 0.3s – 1.6s:** Hình xe lướt nhẹ từ phải sang trái (40px) kết hợp độ phóng to tinh tế từ `0.96` lên `1.0` với đường cong chuyển động `cubic-bezier(0.16, 1, 0.3, 1)`.
- **T = 1.0s – 1.8s:** Khối thông số kỹ thuật nổi (Spec Bar) trượt nhẹ lên từ dưới.
- **Sau 1.8s:** Toàn bộ nội dung **ổn định tuyệt đối**, không rung lắc hay trôi dạt.

### C. 3 Slide chủ đạo & Điều khiển trình chiếu
- **Slide 1 — VinFast VF 7:** SUV điện thể thao thời thượng (349 HP, 496 km, 0-100: 5.8s).
- **Slide 2 — VinFast VF 8:** SUV điện hạng D thông minh toàn cầu (402 HP, 471 km, ADAS Level 2).
- **Slide 3 — Showroom & Dịch vụ 3S Minh Ngân:** Đại lý 3S chính thức tại Phú Thọ (Bảo hành 10 năm, Cứu hộ pin 24/7, 100% Phụ tùng chính hãng).
- **Tự động chuyển slide:** Mỗi slide giữ 8 giây; thanh tiến trình (progress bar) trong indicator pill chạy mượt mà 60fps.
- **Controls:**
  - Nút **Previous / Next** kính mờ sang trọng.
  - Nút **Tạm dừng / Tiếp tục (Pause / Play)**.
  - Tự động dừng khi di chuột vào (Hover Pause) hoặc khi focus bằng bàn phím.
  - **Tôn trọng lựa chọn của người dùng:** Nếu người dùng đã nhấn nút Pause, slider sẽ không tự ý phát lại cho đến khi họ nhấn Play.
  - Hỗ trợ phím mũi tên: `ArrowLeft` (Slide trước), `ArrowRight` (Slide tiếp), phím cách `Space` (Tạm dừng/Phát).
  - Hỗ trợ vuốt chạm cảm ứng (Touch Swipe) trên mobile.

---

## 3. Danh sách tài sản minh họa chuyển động (GIF & Video MP4)

Chủ dự án có thể xem trực tiếp video và ảnh động mô phỏng quá trình hoạt động:
1. **Ảnh GIF chuyển động:** [`screenshots/cinematic_hero_motion_demo.gif`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_motion_demo.gif) (910 KB)
2. **Video MP4 chuyển động:** [`screenshots/cinematic_hero_motion_demo.mp4`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_motion_demo.mp4) (320 KB)
3. **Các ảnh chụp frame chi tiết:**
   - [`screenshots/entrance_frame_1_200ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_1_200ms.png) — Bắt đầu hiệu ứng (0.2s)
   - [`screenshots/entrance_frame_2_600ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_2_600ms.png) — Chữ xuất hiện (0.6s)
   - [`screenshots/entrance_frame_3_1100ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_3_1100ms.png) — Xe lướt vào (1.1s)
   - [`screenshots/entrance_frame_4_1800ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_4_1800ms.png) — Thông số nổi lên hoàn tất (1.8s)
   - [`screenshots/cinematic_hero_desktop_1440.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_desktop_1440.png) — Toàn cảnh Slide 1 (VF 7)
   - [`screenshots/cinematic_hero_slide2_vf8.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_slide2_vf8.png) — Toàn cảnh Slide 2 (VF 8)
   - [`screenshots/cinematic_hero_slide3_showroom.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_slide3_showroom.png) — Toàn cảnh Slide 3 (Showroom 3S)
   - [`screenshots/cinematic_hero_mobile_390.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_mobile_390.png) — Giao diện mobile chuẩn mực 390px
   - [`screenshots/cinematic_hero_mobile_320.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_mobile_320.png) — Giao diện mobile nhỏ 320px

