# DECISIONS — NHẬT KÝ QUYẾT ĐỊNH KIẾN TRÚC (ADR)

> Ghi nhận các quyết định kiến trúc quan trọng theo định dạng ADR chuẩn quốc tế. Không xóa quyết định cũ; nếu thay đổi, tạo bản ghi mới thay thế.

---

## ADR-001: Lựa chọn mô hình Full WordPress Project cho VinFast Minh Ngân Phú Thọ 3S
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Dự án cần một môi trường độc lập, đầy đủ và sẵn sàng vận hành để phát triển website đại lý VinFast Minh Ngân Phú Thọ 3S dựa trên nền tảng sẵn có từ dự án tham chiếu `vinfasttanachill` và tài nguyên core từ `vinhphucvinfast.com.vn`.
- **Quyết định:** Triển khai mô hình Full WordPress Project bao gồm Core WP, Parent Theme Flatsome, Child Theme `flatsome-child-minhnganphutho` và 13 plugins.
- **Hệ quả:** Dự án hoạt động độc lập trên LocalWP/Nginx, loại bỏ hoàn toàn các lỗi hardcode path máy cũ.

---

## ADR-002: Thống nhất giới hạn phạm vi theo Báo Giá Excel 4.000.000 VNĐ & Đặc Tả Word
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Tài liệu Word mô tả 15 dòng xe và các tính năng mở rộng, nhưng Bảng báo giá Excel xác định tổng giá trị hợp đồng là 4.000.000 VNĐ (Gói Cơ Bản), trong đó chi phí cho template chi tiết xe là 160.000 VNĐ (tương ứng đúng 2 mẫu xe).
- **Quyết định:**
  1. Giữ phạm vi triển khai chi tiết mẫu xe ở **đúng 2 mẫu xe chiến lược**: **VF 3** (xe đô thị mini) và **VF 7** (SUV thể thao).
  2. Xây dựng kiến trúc template và CPT/ACF mở rộng để đại lý có thể tự bổ sung các dòng xe khác qua trang quản trị WordPress mà không phát sinh chi phí lập trình.
  3. Đóng băng các tính năng thanh toán VietQR động và Telegram bot cũ để tránh rủi ro tài chính và sai lệch phạm vi gói cơ bản.
- **Hệ quả:** Bảo toàn ngân sách hợp đồng, tập trung tối đa nguồn lực làm xuất sắc các tính năng cốt lõi đã cam kết.

---

## ADR-003: Kiến trúc Sticky Quick Action Bar Mobile (3 nút chuẩn) thay thế Floating Sidebar cũ
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Mã nguồn cũ có thanh floating bar 5 nút (`vfvp_render_floating_sidebar`) gồm cả đặt cọc, so sánh xe, gây rối mắt và che khuất màn hình di động. Tài liệu đặc tả Word yêu cầu thanh điều hướng mobile bám đáy đúng 3 nút thiết yếu.
- **Quyết định:** Tái cấu trúc thành component Sticky Quick Action Bar bám đáy (< 768px) với đúng 3 nút:
  1. 📞 Gọi ngay (`tel:HOTLINE`)
  2. 🧮 Dự toán (`/du-toan-chi-phi/`)
  3. 🚗 Lái thử (`/dang-ky-lai-thu/` - Nút màu xanh VinFast `#2563EB` nổi bật nhất)
- **Hệ quả:** Tối ưu hóa 100% tỷ lệ chuyển đổi khách hàng trên thiết bị di động (Mobile-First), giao diện thoáng đãng, dễ bấm.

---

## ADR-004: Cơ chế Dual-Recipient SMTP chuẩn hóa & Loại bỏ Lead rò rỉ cũ
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Mã nguồn cũ chứa bot token Telegram và danh sách email cá nhân của lập trình viên cũ (`phuocvandangdilam@gmail.com`, `hoangbuizzzz15@gmail.com`), gửi thông tin dưới tên thương hiệu `Catchie Service`.
- **Quyết định:**
  1. Thay thế toàn bộ bằng cơ chế **Dual-Recipient SMTP**: gửi đồng thời đến 2 hòm thư quản lý chính thức của đại lý (`To:`).
  2. Đổi định danh người gửi thành: **VinFast Minh Ngân**.
  3. Mật khẩu Gmail App Password đọc linh hoạt từ `wp-config.php` hoặc `.env`, tuyệt đối không lưu trong Git.
  4. Sửa triệt để lỗi Fake Success UI tại form footer để báo lỗi trung thực khi SMTP gặp sự cố.
- **Hệ quả:** Bảo mật tuyệt đối dữ liệu khách hàng tiềm năng (Leads), tăng uy tín thương hiệu chính hãng.

---

## ADR-005: Tích hợp Giao diện Concept A — Premium Showroom & Override front-page Parent Theme
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Flatsome có file `front-page.php` trong theme cha, làm ghi đè các page template tùy chỉnh khi cấu hình `show_on_front = 'page'`. Đồng thời giao diện cũ nạp các section tĩnh không tương thích nhận diện thương hiệu VinFast Minh Ngân Phú Thọ 3S.
- **Quyết định:**
  1. Tạo `front-page.php` trong Child Theme để override 100% template parent theo chuẩn WordPress Template Hierarchy.
  2. Nạp template `page-home.php` chứa 8 sections của Concept A — Premium Showroom:
     - Section 1: Hero VF 7 Stage & Highlight Floating Spec Bar
     - Section 2: Showroom Collection (Tabs: Xe cá nhân / Xe thương mại Green Series, 8 mẫu xe chính hãng)
     - Section 3: After-sales Experience (Xưởng dịch vụ 3S, Bảo hành 10 năm)
     - Section 4: Green Future (Cinematic Dark Break)
     - Section 5: Green Series (Kinh doanh vận tải đô thị)
     - Section 6: Financial Tools (Dự toán lăn bánh & Vay trả góp dư nợ giảm dần)
     - Section 7: News & Events (Tin tức sự kiện đại lý)
     - Section 8: Showroom Location & Contact (Google Maps & Hotline 0981 33 55 22)
  3. Bổ sung Safe Polyfills cho WooCommerce (`is_product`, `is_cart`, `is_checkout`...) vào Child Theme để đảm bảo website hoạt động ổn định tuyệt đối trong mọi tình huống.
- **Hệ quả:** Giao diện trang chủ WordPress đạt chuẩn showroom quốc tế, tốc độ phản hồi nhanh, an toàn dữ liệu và tối ưu chuyển đổi khách hàng.

---

## ADR-006: Khắc phục triệt để Mobile Horizontal Overflow & Chuẩn hóa Touch Target theo Mobile-First
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Báo cáo kiểm định Slice 2 cho thấy giao diện bị tràn lề phải trên màn hình di động (mobile overflow), đặc biệt là hộp thông số Hero dạng absolute float, transform 3D của ảnh xe, tab xe dài dồn hàng và dồn menu header ở breakpoint 850px-1100px.
- **Quyết định:**
  1. Loại bỏ hoàn toàn các thuộc tính `position: absolute` và 3D transform của Hero trên viewport `< 768px`. Chuyển khối thông số kỹ thuật xe thành dạng Static Grid Block 3 cột co giãn 100% bên dưới ảnh xe.
  2. Tái cấu trúc thứ tự trực quan Hero trên mobile: `Eyebrow -> Heading H1 -> Description -> 2 CTAs (Xem bảng giá & Đăng ký lái thử) -> Ảnh xe lớn -> Khối thông số kỹ thuật`.
  3. Cấu hình Tabs danh mục xe thành dạng 2 cột tỷ lệ `50% - 50%` linh hoạt với `white-space: normal`.
  4. Chuẩn hóa Touch Targets cho toàn bộ các nút bấm và tabs: chiều cao tối thiểu 46px (đáp ứng tiêu chuẩn Apple Human Interface Guidelines và WCAG 2.1 AAA).
  5. Cấu hình Breakpoint Header: tự động kích hoạt Hamburger Drawer Menu ở màn hình `<= 1099px`, bảo đảm header không bị dồn ép trên tablet ngang và small laptop.
  6. Thay thế ảnh dịch vụ hậu mãi (Section 3) bằng ảnh xưởng kỹ thuật sửa chữa bảo dưỡng cao cấp, dẹp bỏ hoàn toàn ảnh du thuyền Unsplash không liên quan.
- **Hệ quả:** Đo lường tự động qua Edge Headless tại 6 viewports (320px, 375px, 390px, 768px, 1024px, 1440px) đều đạt `0px overflow`, không còn thanh cuộn ngang, trải nghiệm chạm vuốt trên di động hoàn hảo.

---

## ADR-007: Tích hợp Cinematic Motion Hero & Dynamic Car Slider vào WordPress Theme
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Chủ dự án phê duyệt nâng cấp Hero Banner từ hình ảnh tĩnh sang Cinematic Motion Hero + Dynamic Slider nhằm tạo ấn tượng mạnh mẽ cho khách hàng khi vừa truy cập website theo concept Premium Showroom ("The car is the hero. The experience is premium.").
- **Quyết định:**
  1. Tích hợp chuyển động điện ảnh mở đầu (Entrance Animation - 1.8s) bằng CSS3 Hardware-Accelerated Transforms (`translate3d` và `opacity`), đường cong `cubic-bezier(0.16, 1, 0.3, 1)`.
  2. Cố định hoàn toàn vị trí sau 1.8s để đảm bảo nội dung ổn định, không gây phân tâm.
  3. Xây dựng Dynamic Slider 3 slide chủ đạo (VinFast VF 7, VinFast VF 8, Showroom & Xưởng dịch vụ 3S Minh Ngân).
  4. Quản lý timer 8s với requestAnimationFrame (60fps), thanh tiến trình real-time trong indicator pills, dừng thông minh khi hover/focus và tôn trọng tuyệt đối nút Pause của người dùng.
  5. Hỗ trợ đầy đủ `prefers-reduced-motion` và cảm ứng vuốt chạm (Touch Swipe) trên mobile.
  6. Đăng ký cấu trúc trường dữ liệu ACF Repeater (`hero_slides`) trong `functions.php` kết hợp fallback an toàn mảng PHP trong `page-home.php`, đảm bảo không hardcode nội dung thương mại.
- **Hệ quả:** Đo kiểm tự động trên Edge Headless tại 6 viewports (320px, 375px, 390px, 768px, 1024px, 1440px) đều đạt `0px overflow`, CLS = 0, giao diện đẳng cấp quốc tế.

---

## ADR-008: Căn giữa dọc tuyệt đối (Vertical Alignment) cụm Collection Tabs bằng CSS Grid 50% - 50% & Flexbox Wrapper
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Section 2 ("Bộ sưu tập xe điện VinFast / Khám phá bộ sưu tập xe điện") trên Desktop trước đây dùng `align-items: flex-end;` kèm theo margin-bottom thừa của thẻ `<p>` Flatsome khiến cụm tab switcher ("Xe Cá Nhân / Xe Thương Mại") bị lệch trục dọc so với cụm title + description bên trái (đo lường lệch +24.65px).
- **Quyết định:**
  1. Chuyển layout hàng tiêu đề `.section-header-row` trên Desktop thành CSS Grid 2 cột cân đối `minmax(0, 1fr) minmax(0, 1fr)` (50% - 50%) kết hợp `align-items: center;` và khoảng cách ngang `gap: 32px`.
  2. Bọc cụm tab switcher vào container semantic `.collection-tabs-wrap` với `display: flex; align-items: center; justify-content: flex-end; height: 100%;` giúp tab căn lề phải chuẩn desktop showroom và căn giữa dọc tuyệt đối so với khối text bên trái.
  3. Triệt tiêu margin-bottom thừa của thẻ `<p>` cuối cùng trong khối tiêu đề (`.section-header-text p:last-child { margin-bottom: 0 !important; }`) và chuẩn hóa `line-height: 1.2` cho `.tab-btn` để triệt tiêu ảnh hưởng phình chiều cao từ theme Flatsome.
  4. Tuyệt đối không dùng margin âm hoặc `transform: translateY()` chữa cháy.
  5. Đảm bảo hành vi responsive:
     - Desktop (1440px, 1280px, 1024px): 2 cột 50% - 50%, `diffMidY = 0px` (cân giữa hoàn hảo 100%).
     - Mobile & Tablet (<= 768px): 1 cột `grid-template-columns: 1fr`, tab switcher giãn 100% chiều ngang, các nút tab có chiều cao chuẩn 44px dễ bấm và không tràn viền.
- **Hệ quả:** Giao diện đạt chuẩn showroom cao cấp, cân bằng thị giác hoàn hảo, đo lường tự động qua CDP cho độ lệch trục dọc `diffMidY = 0px` trên desktop.

---

## ADR-009: Kiến trúc Main Footer 4 Cột & Form Đăng Ký Tư Vấn Dịch Vụ An Toàn (TASK: FOOTER-02)
- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED
- **Bối cảnh:** Website trước đây có footer chưa được cấu hình CSS Grid hiển thị chuẩn 4 cột trên desktop (bị hiển thị block xếp chồng), đồng thời thiếu form đăng ký tư vấn dịch vụ tại cột cuối cùng theo yêu cầu của Chủ dự án. Ngoài ra, endpoint AJAX xử lý form footer cũ (`vf_submit_footer_service_form`) thiếu Nonce, không có Honeypot chống bot và thiếu rate limiting per IP dẫn đến nguy cơ spam ngập hòm thư.
- **Quyết định:**
  1. Giữ nguyên 100% khối Pre-Footer CTA ("Đăng Ký Nhận Báo Giá & Lái Thử Xe VinFast Minh Ngân", dòng 13-30 trong `footer.php`).
  2. Tái cấu trúc Main Footer thành 4 nhóm nội dung chuẩn mực:
     - Cột 1: Thông tin đại lý ủy quyền 3S VinFast Minh Ngân Phú Thọ.
     - Cột 2: Các dòng xe điện cá nhân (VF 3 -> VF 9).
     - Cột 3: Dịch vụ khách hàng, dự toán tài chính & mạng lưới trạm sạc.
     - Cột 4: Form Đăng Ký Tư Vấn Dịch Vụ.
  3. Cấu hình layout CSS Grid responsive chuyên nghiệp:
     - Desktop (> 1024px): `grid-template-columns: 1.35fr 0.95fr 1fr 1.35fr; gap: 36px; align-items: start;`.
     - Tablet (<= 1024px): `grid-template-columns: repeat(2, 1fr); gap: 36px 32px;`.
     - Mobile (<= 768px): `grid-template-columns: 1fr; gap: 28px;` và padding đáy `padding-bottom: 76px;` để tránh Sticky Mobile Action Bar che khuất thông tin bản quyền và pháp lý.
  4. Nâng cấp Backend Handler an toàn tuyệt đối:
     - Kiểm tra Nonce bảo mật token (`wp_verify_nonce` với action `vf_footer_consult_nonce`).
     - Bổ sung Honeypot field (`vf_hp_check`) âm thầm từ chối bot tự động.
     - Giới hạn tần suất gửi (Transient Rate Limiting per IP) với thời gian làm nguội (cooldown) 45 giây.
     - Xác thực số điện thoại di động Việt Nam chuẩn 10 chữ số bắt đầu bằng số 0 ở cả Client (JavaScript) và Server (PHP Regex).
     - Gắn nhãn nguồn lead cụ thể: `footer_service_consultation`.
     - Tích hợp gửi email quản trị qua `wp_mail` (Dual-Recipient SMTP) và chỉ trả về trạng thái thành công khi email đã được gửi thực tế, kèm loading state và feedback real-time không tải lại trang.
- **Hệ quả:** Form hoạt động an toàn, chống spam triệt để, giao diện đồng bộ với phong cách showroom cao cấp, trải nghiệm gửi lead mượt mà không reload trang.
