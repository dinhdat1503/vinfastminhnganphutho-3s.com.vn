# BỘ TIÊU CHÍ CHẤP NHẬN & NGHIỆM THU (ACCEPTANCE CRITERIA)
## DỰ ÁN: WEBSITE ĐẠI LÝ VINFAST MINH NGÂN PHÚ THỌ 3S

> **Quy chuẩn đo kiểm:** Dùng để đối chiếu và nghiệm thu từng module chức năng trước khi bàn giao. Mỗi tiêu chí phải có phương pháp kiểm thử thực tế (Test Method) và kết quả có thể tái lặp.

---

### MODULE 01 — DESIGN SYSTEM & NAVIGATION

- [ ] **AC-01.1 (Màu sắc nhận diện):** Màu chủ đạo trên toàn bộ website là xanh VinFast `#2563EB` (được định nghĩa qua biến CSS `--vf-primary: #2563EB`). Các nút bấm chính, tab, icon nổi bật đều áp dụng màu này đồng bộ.
- [ ] **AC-01.2 (Logo đại lý):** Logo VinFast Minh Ngân hiển thị sắc nét chuẩn vector, chiều cao hiển thị trên Desktop đạt `64px`, căn giữa cân đối, không bị mờ nhòe hay méo tỷ lệ.
- [ ] **AC-01.3 (Header Mega Menu):** 
  - Desktop: Hover vào mục "Ô tô" hiển thị Mega Menu 2 nhóm rõ ràng: Xe Cá Nhân (VF 2 đến VF 9, VF Wild) và Green Series (Minio, Herio, Nerio, Limo Green, EC Van).
  - Nút CTA ĐĂNG KÝ LÁI THỬ màu `#2563EB` cố định bên phải header.
- [ ] **AC-01.4 (Sticky Mobile Bar 3 Nút):** 
  - Trên màn hình di động (< 768px), thanh điều hướng bám cố định dưới đáy màn hình với đúng **3 nút chức năng**:
    1. 📞 Gọi ngay (`tel:HOTLINE`)
    2. 🧮 Dự toán (`/du-toan-chi-phi/`)
    3. 🚗 Lái thử (`/dang-ky-lai-thu/` - Nút nổi bật `#2563EB`)
  - Không che khuất nội dung trang khi cuộn, khoảng cách chạm tối thiểu 44x44px chuẩn UX.
- [ ] **AC-01.5 (Nút nổi & Popup ưu đãi):**
  - Nút tròn Zalo & Hotline nổi góc phải, không đè lên thanh Sticky Mobile Bar.
  - Popup Maker hiển thị ưu đãi có nút đóng `X` rõ ràng, tự đóng sau khi khách bấm tắt hoặc hết thời gian chờ, không chặn thao tác duyệt web.
- [ ] **AC-01.6 (Loại bỏ vết thương hiệu cũ):** Không còn bất kỳ chữ nào liên quan đến "Catchie", "Tân Á Châu", "Vĩnh Phúc" hay số điện thoại cũ trong Header và Footer.

---

### MODULE 02 — TRANG CHỦ (`page-home.php`)

- [ ] **AC-02.1 (Cấu trúc 8 Phân khu):** Trang chủ hiển thị đầy đủ và đúng thứ tự 8 sections:
  1. Hero Banner Slider (Swiper chạy mượt mà, autoplay, có nút điều hướng).
  2. Car Showcase Carousel (Hiển thị dải xe VF 2 đến VF 9 kèm bảng 4 thông số: Dòng xe, Số chỗ, Tầm hoạt động, Giá niêm yết).
  3. Cam kết Bảo hành 10 năm / 200.000 km & Giới thiệu xưởng dịch vụ 3S.
  4. Chiến dịch tương lai xanh VinFast.
  5. Xe dịch vụ thương mại Green Series.
  6. Khối công cụ tài chính nhanh (Dẫn sang Dự toán lăn bánh & Trả góp).
  7. Tin tức & Sự kiện (Tự động hiển thị 4 bài mới nhất).
  8. Showroom & Bản đồ Google Maps chỉ đường đến VinFast Minh Ngân Phú Thọ.
- [ ] **AC-02.2 (Cơ chế bài viết mới lên đầu):** Khi quản trị viên đăng bài viết tin tức mới trong WP Admin, bài viết này tự động hiển thị ở vị trí số 1 tại Section Tin tức mà không cần sửa code giao diện.
- [ ] **AC-02.3 (Responsive):** Kiểm tra không bị tràn màn hình (horizontal scroll), không vỡ khối tại các mốc: 320px, 375px, 390px, 768px, 1024px, 1440px.

---

### MODULE 03 — TRANG CHI TIẾT MẪU XE (`single-car_model.php`)

- [ ] **AC-03.1 (Phạm vi 2 mẫu xe chuẩn):** Hoàn thiện nội dung chi tiết cho đúng 2 mẫu xe chiến lược theo báo giá: **VF 3** và **VF 7**.
- [ ] **AC-03.2 (Thông số kỹ thuật chuẩn):** Hiển thị chính xác từ nguồn VinFast:
  - Quãng đường di chuyển (NEDC / WLTP).
  - Dung lượng pin (kWh) và thời gian sạc nhanh 10% - 70%.
  - Công suất động cơ (kW / hp) và mô-men xoắn (Nm).
  - Túi khí và các tính năng an toàn.
- [ ] **AC-03.3 (Công nghệ thông minh):** Có khối giới thiệu hệ thống trợ lái ADAS và trợ lý ảo tiếng Việt Vivu.
- [ ] **AC-03.4 (Bộ đổi màu xe - Color Selector):** Khách hàng bấm chọn màu nào thì ảnh xe đổi sang màu ngoại thất tương ứng mượt mà.
- [ ] **AC-03.5 (Hành động khách hàng):** Các nút CTA: Dự toán lăn bánh, Đăng ký lái thử, Tải brochure PDF hoạt động chính xác.

---

### MODULE 04 — CÔNG CỤ DỰ TOÁN CHI PHÍ LĂN BÁNH

- [ ] **AC-04.1 (Lựa chọn & Tự động tính toán):** Cho phép chọn dòng xe, phiên bản và nơi đăng ký (Phú Thọ & Các Tỉnh / Hà Nội / TP.HCM).
- [ ] **AC-04.2 (Chính sách thuế trước bạ xe điện):** Áp dụng chính xác mức **Lệ phí trước bạ 0%** cho ô tô điện theo quy định hiện hành.
- [ ] **AC-04.3 (Bóc tách chi phí minh bạch):** Hiển thị rõ ràng từng dòng chi phí:
  - Giá xe niêm yết.
  - Lệ phí trước bạ (0 VNĐ).
  - Phí cấp biển số (Tỉnh: 1.000.000 VNĐ; HN/HCM: 20.000.000 VNĐ).
  - Phí đăng kiểm: 340.000 VNĐ.
  - Phí bảo trì đường bộ: 1.560.000 VNĐ / năm.
  - Bảo hiểm TNDS bắt buộc theo số chỗ ngồi.
- [ ] **AC-04.4 (Tính năng Xuất/Tải Báo Giá PDF 1-Click):**
  - Có nút bấm nổi bật `TẢI PDF` hoặc `IN BÁO GIÁ`.
  - Bấm vào mở hộp thoại in / tải file PDF định dạng A4 chuẩn mẫu.
  - Bản in có logo VinFast Minh Ngân, thông tin đại lý, bảng số liệu rõ nét, hỗ trợ tiếng Việt có dấu 100% không bị lỗi font hay vỡ bảng.

---

### MODULE 05 — CÔNG CỤ TÍNH TRẢ GÓP NGÂN HÀNG

- [ ] **AC-05.1 (Công thức dư nợ giảm dần):** 
  - Khách hàng điều chỉnh số tiền trả trước (20% đến 80%), thời gian vay (1 đến 8 năm), lãi suất năm.
  - Công thức tính toán chuẩn: Gốc chia đều các tháng, lãi tính trên dư nợ thực tế còn lại.
- [ ] **AC-05.2 (Bảng chi tiết lịch trả nợ từng tháng):**
  - Xuất bảng đầy đủ từng kỳ từ tháng 1 đến tháng cuối cùng.
  - Mỗi dòng có đủ: Kỳ hạn, Số tiền gốc, Số tiền lãi, Tổng phải trả, Dư nợ còn lại.
  - Kỳ cuối cùng: Dư nợ còn lại phải bằng đúng $0$ VNĐ.
- [ ] **AC-05.3 (Cảnh báo pháp lý):** Có ghi chú rõ ràng: "Bảng tính mang tính chất tham khảo, số liệu thực tế phụ thuộc vào chính sách của từng ngân hàng tại thời điểm vay".

---

### MODULE 06 — ĐĂNG KÝ LÁI THỬ

- [ ] **AC-06.1 (Trải nghiệm người dùng):** Form cho phép chọn mẫu xe (VF 3 đến VF 9) và chọn hình thức lái thử: Lái thử tại Showroom hoặc Lái thử tận nhà.
- [ ] **AC-06.2 (Bảo mật & Chống Spam):** Có trường `wp_nonce` bảo vệ CSRF; Kiểm tra server-side định dạng số điện thoại Việt Nam (10 số, đầu số hợp lệ).
- [ ] **AC-06.3 (Gửi AJAX không reload):** Khi bấm nút "Gửi yêu cầu", trang không bị tải lại; hiển thị spinner loading mượt mà.
- [ ] **AC-06.4 (Báo trạng thái trung thực):**
  - Khi server tiếp nhận thành công: Hiển thị thông báo xanh "Đăng ký thành công! Tư vấn viên VinFast Minh Ngân sẽ liên hệ trong 15 phút".
  - Khi lỗi mạng / server 500: Hiển thị cảnh báo đỏ "Gửi thất bại, vui lòng gọi Hotline để được hỗ trợ tức thì" (Tuyệt đối không báo thành công giả).

---

### MODULE 07 — ĐẶT LỊCH DỊCH VỤ BẢO DƯỠNG

- [ ] **AC-07.1 (Quy trình 4 bước):** Khách hàng thực hiện qua 4 bước logic trực quan trên cả mobile và desktop (Thông tin xe -> Chọn dịch vụ -> Chọn thời gian -> Xác nhận liên hệ).
- [ ] **AC-07.2 (Chính sách bảo hành):** Hiển thị rõ ràng cam kết bảo hành chính hãng 10 năm hoặc 200.000 km của VinFast.
- [ ] **AC-07.3 (Tiếp nhận Lead):** Dữ liệu gửi đi được chuyển phát tức thời về hòm thư đại lý qua hệ thống Dual-Recipient SMTP.

---

### MODULE 08 — HỆ THỐNG TIẾP NHẬN LEAD DUAL-RECIPIENT SMTP

- [ ] **AC-08.1 (Phân phối 2 hòm thư đồng thời):** Mọi Lead gửi từ form website đều được gửi đồng thời vào **2 email nhận chính** (`To:`), không bị gửi dạng BCC ẩn danh hay rơi rớt.
- [ ] **AC-08.2 (Bảo mật mật khẩu):** Mật khẩu Gmail App Password được cấu hình an toàn qua `wp-config.php` hoặc `.env`, tuyệt đối không lưu trong Git repository.
- [ ] **AC-08.3 (Định danh người gửi):** Tên người gửi hiển thị trong hộp thư đến là: **VinFast Minh Ngân** (thay vì Catchie Service cũ).

---

### MODULE 09 — QUẢN TRỊ CMS & DEVOPS

- [ ] **AC-09.1 (Không can thiệp Core):** Thư mục `wp-admin` và `wp-includes` được giữ nguyên bản, toàn bộ tùy biến nằm trong `wp-content/themes/flatsome-child-minhnganphutho`.
- [ ] **AC-09.2 (Đồng bộ Git):** Mọi thay đổi mã nguồn được quản lý phiên bản rõ ràng trên nhánh `main` của repository `dinhdat1503/vinfastminhnganphutho-3s.com.vn`.
- [ ] **AC-09.3 (Cơ chế triển khai Webhook):** Cung cấp tài liệu cấu hình Webhook aaPanel để tự động cập nhật mã nguồn trên VPS sau khi duyệt release.

