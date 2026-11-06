# BÁO CÁO THIẾT KẾ & PHƯƠNG ÁN KỸ THUẬT — TASK HOME-02.2
## CINEMATIC MOTION HERO & DYNAMIC CAR SLIDER
**Dự án:** Website VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)  
**Mã nhiệm vụ:** `TASK ID: HOME-02.2`  
**Ngày thực hiện:** 06/11/2026  
**Chuyên môn:** Senior Automotive Web Designer, Frontend Architect & WordPress/Flatsome Specialist  
**Tình trạng:** SẴN SÀNG DUYỆT THIẾT KẾ (DESIGN PREVIEW READY — CHƯA SỬA PRODUCTION)

---

## 1. MỤC TIÊU & ĐỊNH HƯỚNG THIẾT KẾ

Nâng cấp khu vực Hero Banner Trang chủ VinFast Minh Ngân Phú Thọ từ hình ảnh tĩnh sang **Premium Cinematic Motion Hero + Dynamic Car Slider**, bám sát triết lý cốt lõi:

> **"THE CAR IS THE HERO. THE EXPERIENCE IS PREMIUM."**

### Các nguyên tắc thẩm mỹ bắt buộc đã tuân thủ:
1. **Không giật cục, không nhảy cảnh liên tục:** Chuyển động được tính toán theo đường cong điện ảnh `cubic-bezier(0.16, 1, 0.3, 1)`, tạo cảm giác chiếc xe điện lướt êm ái trên sân khấu showroom quốc tế.
2. **Ổn định sau Entrance:** Sau khi hoàn thành chuyển động xuất hiện 1.8 giây, toàn bộ nội dung (chữ, xe, nút bấm, thông số) hoàn toàn đứng yên cố định, giúp khách hàng tập trung tối đa vào thông điệp sản phẩm mà không bị xao nhãng.
3. **Tôn trọng quyền kiểm soát của người dùng:** Tự động dừng đếm ngược khi hover chuột hoặc focus bàn phím; đặc biệt nếu người dùng đã bấm nút **Tạm dừng (Pause)**, slider sẽ giữ nguyên trạng thái dừng, không tự ý chạy lại trái ý khách hàng.

---

## 2. KIẾN TRÚC CHUYỂN ĐỘNG (CINEMATIC MOTION SPECIFICATION)

### 2.1. Entrance Animation (Chuyển động xuất hiện mở đầu: 1.8 giây)
- **T = 0.0s – 0.5s:** Ánh sáng nền (Ambient Spotlight Glow) tỏa nhẹ từ tâm lưng xe với độ mờ 60px.
- **T = 0.15s – 0.85s:** Nhãn Eyebrow trượt nhẹ lên 22px và hiện rõ (`translateY: 22px -> 0`, `opacity: 0 -> 1`).
- **T = 0.35s – 1.1s:** Tiêu đề H1 trượt lên uyển chuyển với dải màu gradient trắng sáng sang xanh nhạt.
- **T = 0.55s – 1.3s:** Đoạn mô tả dòng xe xuất hiện.
- **T = 0.75s – 1.5s:** Cặp nút CTA (Xem chi tiết & Đăng ký lái thử) trượt lên.
- **T = 0.25s – 1.6s:** Hình ảnh xe lướt nhẹ từ phải qua trái (dịch chuyển 40px) kết hợp độ phóng to tinh tế từ `0.96` lên `1.0` với bóng đổ `drop-shadow` êm ái.
- **T = 0.95s – 1.8s:** Khối thông số kỹ thuật nổi (Spec Bar) trượt nhẹ lên từ dưới xe và khóa vị trí tĩnh.

### 2.2. Dynamic Slider & Slide Transition
- **Thời gian giữ mỗi slide:** Mặc định **8.0 giây** (có thể cấu hình trong WordPress Admin từ 5s đến 12s).
- **Thời gian chuyển cảnh (Transition):** **700ms – 850ms**, kết hợp so le giữa slide cũ trượt nhẹ sang trái và slide mới xuất hiện từ bên phải.
- **Thanh tiến trình (Real-time Progress Indicator):** Chạy mượt mà 60fps qua `requestAnimationFrame`, hiển thị trực tiếp bên trong 3 indicator pills ở chân slide.
- **3 Slide mẫu được chuẩn hóa:**
  1. **Slide 1 — VinFast VF 7:** "Bứt Phá Giới Hạn Công Nghệ Tương Lai" (349 HP, 496 km, 0-100: 5.8s).
  2. **Slide 2 — VinFast VF 8:** "Tiên Phong Đẳng Cấp Sang Trọng Toàn Cầu" (402 HP, 471 km, ADAS Cấp độ 2).
  3. **Slide 3 — Showroom & Xưởng dịch vụ 3S Minh Ngân Phú Thọ:** "Xưởng Dịch Vụ 3S Tiêu Chuẩn Toàn Diện" (Bảo hành 10 năm, Cứu hộ pin 24/7 toàn tỉnh, 100% Phụ tùng chính hãng).

---

## 3. KẾT QUẢ ĐO KIỂM THỰC TẾ TRÊN TRÌNH DUYỆT (EDGE HEADLESS CDP)

Kiểm định tự động qua script CDP `scratch/test_cinematic_hero.js` chạy trên máy chủ local và Microsoft Edge thật:

| Viewport | Thiết bị đại diện | Viewport W | Scroll W | Max Scroll | Tràn ngang (Overflow) | Trạng thái |
|:---:|:---|:---:|:---:|:---:|:---:|:---:|
| **320 x 740** | Small Mobile (Fold, iPhone SE1) | 320px | 320px | 320px | **0px** | **PASS (100%)** |
| **375 x 812** | iPhone SE Gen 2/3, iPhone Mini | 375px | 375px | 375px | **0px** | **PASS (100%)** |
| **390 x 844** | iPhone 13/14/15/16 Pro | 390px | 390px | 390px | **0px** | **PASS (100%)** |
| **768 x 1024** | iPad / Tablet dọc | 768px | 768px | 768px | **0px** | **PASS (100%)** |
| **1024 x 768** | Small Desktop / Tablet ngang | 1024px | 1009px | 1009px | **0px** | **PASS (100%)** |
| **1440 x 900** | Desktop Standard 1440px | 1440px | 1425px | 1425px | **0px** | **PASS (100%)** |

- **Cumulative Layout Shift (CLS):** `0.000` (Không có hiện tượng giật cục layout hay xô lệch vị trí nút bấm khi animation chạy).
- **Touch Targets:** Nút CTA và Controls trên mobile đạt tối thiểu `46px` (chuẩn Apple HIG).
- **Hỗ trợ Accessibility (`prefers-reduced-motion`):** Khi kích hoạt, loại bỏ hoàn toàn dịch chuyển `translateX`/`scale`, chỉ dùng hiệu ứng mờ dần nhẹ 0.15s để bảo vệ người dùng nhạy cảm tiền đình.

---

## 4. TÀI NGUYÊN KIỂM CHỨNG TRỰC QUAN (VISUAL ASSETS)

Tất cả đã được khởi tạo và lưu trữ đầy đủ tại thư mục [`design-preview/cinematic-hero/screenshots/`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/):
1. **Ảnh GIF chuyển động:** [`screenshots/cinematic_hero_motion_demo.gif`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_motion_demo.gif) (910 KB) — Ghi lại toàn bộ chuỗi Entrance 1.8s và chuyển cảnh qua các slide.
2. **Video MP4 chuyển động:** [`screenshots/cinematic_hero_motion_demo.mp4`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_motion_demo.mp4) (320 KB) — Video độ nét cao kiểm chứng chuyển động 60fps.
3. **Chuỗi frame phân rã Entrance Animation:**
   - [`screenshots/entrance_frame_1_200ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_1_200ms.png) — Khởi đầu ánh sáng stage (0.2s)
   - [`screenshots/entrance_frame_2_600ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_2_600ms.png) — Chữ trượt lên uyển chuyển (0.6s)
   - [`screenshots/entrance_frame_3_1100ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_3_1100ms.png) — Xe lướt vào từ bên phải (1.1s)
   - [`screenshots/entrance_frame_4_1800ms.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/entrance_frame_4_1800ms.png) — Thông số nổi hoàn tất (1.8s)
4. **Ảnh chụp hoàn chỉnh từng Slide:**
   - [`screenshots/cinematic_hero_desktop_1440.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_desktop_1440.png) — Slide 1: VinFast VF 7
   - [`screenshots/cinematic_hero_slide2_vf8.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_slide2_vf8.png) — Slide 2: VinFast VF 8
   - [`screenshots/cinematic_hero_slide3_showroom.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_slide3_showroom.png) — Slide 3: Showroom & Xưởng dịch vụ 3S
5. **Ảnh chụp Responsive Viewports:**
   - [`screenshots/cinematic_hero_desktop_1024.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_desktop_1024.png) — Small Desktop 1024px
   - [`screenshots/cinematic_hero_tablet_768.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_tablet_768.png) — Tablet 768px
   - [`screenshots/cinematic_hero_mobile_390.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_mobile_390.png) — Mobile 390px
   - [`screenshots/cinematic_hero_mobile_320.png`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/screenshots/cinematic_hero_mobile_320.png) — Small Mobile 320px

---

## 5. PHƯƠNG ÁN QUẢN TRỊ TRÊN WORDPRESS ADMIN (ACF ARCHITECTURE)

Nhằm đảm bảo **không hardcode nội dung thương mại** trong giao diện, đề xuất phương án quản lý qua ACF (Advanced Custom Fields) Pro đã được cài sẵn trong website:

### 5.1. Vị trí quản trị trong WordPress Admin
- Đăng ký một trang tùy chọn con trong trang quản trị:  
  **Giao diện > Hero Slider (VinFast Showcase)** hoặc tích hợp trực tiếp vào **Trang chủ (Edit Page Home)** qua metabox ACF.

### 5.2. Cấu trúc trường dữ liệu (ACF Field Group)
1. **Cấu hình chung (Global Settings):**
   - `hero_slide_duration`: Số nguyên (mặc định 8000ms, cho phép quản trị viên nhập 5000, 8000, 10000ms...).
   - `hero_enable_autoplay`: True/False (Bật/Tắt tự động chạy).
   - `hero_enable_video_bg`: True/False (Kích hoạt kiến trúc video nền nếu có video chính hãng).
2. **Danh sách Slides (`hero_slides` — Repeater Field):**
   - `slide_status`: True/False (Cho phép Bật / Tắt từng slide mà không cần xóa).
   - `eyebrow_text`: Text (Ví dụ: `VINFAST VF 7 • ALL-ELECTRIC SUV`).
   - `badge_text`: Text (Ví dụ: `Tiêu điểm`, `Quốc tế`, `Chính hãng`).
   - `slide_title`: Text / Textarea (Hỗ trợ ngắt dòng và thẻ span highlight).
   - `slide_desc`: Textarea (Đoạn mô tả ngắn gọn 2 dòng).
   - `btn_primary_text` & `btn_primary_link`: Nút CTA chính (Ví dụ: "Khám phá VF 7", URL dẫn đến trang chi tiết xe).
   - `btn_secondary_text` & `btn_secondary_link`: Nút CTA phụ (Ví dụ: "Đăng ký lái thử", mở popup).
   - `car_image_desktop`: Image Upload (Ảnh xe nền trong suốt PNG hoặc WebP, độ phân giải cao).
   - `car_image_mobile`: Image Upload (Tùy chọn ảnh xe crop riêng cho mobile nếu cần).
   - `video_bg_url`: File / URL Upload (Chỉ dùng nếu có video MP4 ngắn được VinFast cho phép, tự động mute, playsinline).
   - `spec_items` (Repeater 3 cột thông số):
     - `spec_num`: Giá trị số (Ví dụ: `349`, `496`, `5.8`).
     - `spec_unit`: Đơn vị (Ví dụ: `HP`, `km`, `giây`).
     - `spec_label`: Nhãn mô tả (Ví dụ: `Công suất tối đa`, `Tầm hoạt động`, `0-100 km/h`).
   - `slide_order`: Thứ tự sắp xếp (hỗ trợ kéo thả Re-order trực tiếp trên giao diện ACF).

---

## 6. PHƯƠNG ÁN TÍCH HỢP VÀ DANH SÁCH FILE DỰ KIẾN THAY ĐỔI

Khi được Chủ dự án duyệt thiết kế, việc tích hợp sẽ được thực hiện bài bản vào Flatsome Child Theme:

| File sẽ sửa / thêm | Phạm vi thay đổi kỹ thuật |
|:---|:---|
| `wp-content/themes/flatsome-child-minhnganphutho/page-home.php` | Thay thế Section 1 tĩnh bằng template Hero Slider lặp qua dữ liệu ACF `get_field('hero_slides')` (hoặc fallback mảng PHP chuẩn nếu ACF chưa nhập liệu). |
| `wp-content/themes/flatsome-child-minhnganphutho/assets/css/homepage-premium.css` | Tích hợp hệ thống keyframes cinematic entrance, layout grid 44%-56%, controls glassmorphism và media queries chống overflow. |
| `wp-content/themes/flatsome-child-minhnganphutho/assets/js/homepage-premium.js` | Tích hợp controller quản lý timer 60fps, touch swipe, hover/focus pause và phím tắt accessibility. |
| `wp-content/themes/flatsome-child-minhnganphutho/functions.php` | Đăng ký ACF Field Group bằng mã nguồn PHP an toàn (ACF Local JSON hoặc `acf_add_local_field_group`) để tự động tạo trường trong Admin mà không cần thao tác thủ công. |

---

## 7. KẾT LUẬN & ĐỀ XUẤT

- **Bản preview tương tác độc lập đã sẵn sàng 100% tại:**  
  [`design-preview/cinematic-hero/index.html`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/index.html)
- **Tài liệu hướng dẫn trải nghiệm:**  
  [`design-preview/cinematic-hero/README.md`](file:///d:/DinhDat/Me/vinfastminhnganphutho-3s.com.vn/design-preview/cinematic-hero/README.md)
- **Kiểm định visual & overflow:** Đạt **100% PASS trên 6 viewports** (0px overflow, CLS = 0).
- **Tình trạng:** **DỪNG — CHỜ CHỦ DỰ ÁN PHÊ DUYỆT THIẾT KẾ TRƯỚC KHI TÍCH HỢP VÀO WORDPRESS PRODUCTION**.

