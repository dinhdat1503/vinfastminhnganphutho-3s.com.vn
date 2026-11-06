# BẢNG MA TRẬN TRUY XUẤT YÊU CẦU (REQUIREMENT TRACEABILITY MATRIX - RTM)
## DỰ ÁN: WEBSITE ĐẠI LÝ VINFAST MINH NGÂN PHÚ THỌ 3S

> **Phiên bản:** 1.0 (Đối chiếu chuẩn xác giữa Đặc tả Word, Báo giá Excel 4.000.000 VNĐ và Hiện trạng Source Code)  
> **Ngày lập:** 2026-11-06 | **Người lập:** Senior Business Analyst & QA Lead  
> **Nguyên tắc quản lý phạm vi:** Gói Cơ Bản trị giá 4.000.000 VNĐ; mọi hạng mục ngoài Excel được phân loại là Phụ thuộc / Mở rộng cần phê duyệt riêng.

---

### 1. BẢNG TRUY XUẤT TOÀN DIỆN (REQUIREMENT TRACEABILITY MATRIX)

| ID Yêu Cầu | Nguồn Tài Liệu | Hạng Mục Báo Giá Excel | Mức Độ Bắt Buộc | File / Module Liên Quan | Trạng Thái Hiện Tại | Việc Cần Làm Cụ Thể | Tiêu Chí Nghiệm Thu (DoD) | Phân Loại Phạm Vi |
|:---|:---|:---|:---|:---|:---|:---|:---|:---|
| **REQ-01** | Word Mục I, III | STT 1: Nền tảng (1.300.000đ) | MUST | `style.css`, `header.php`, `functions.php` | PARTIAL | Chuẩn hóa toàn bộ CSS Design System màu `#2563EB`, logo VinFast Minh Ngân (height 64px vector căn giữa), font Mulish/Inter. | Giao diện hiển thị chuẩn màu `#2563EB`, logo Minh Ngân sắc nét, không vỡ layout trên desktop và mobile. | **TRONG PHẠM VI** |
| **REQ-02** | Word Mục III.1 | STT 1: Nền tảng | MUST | Flatsome Header, `functions.php` | EXISTING BUT BROKEN | Cấu hình Mega Menu phân tầng dải xe cá nhân & thương mại; nút CTA ĐĂNG KÝ LÁI THỬ góc phải; Mobile Hamburger Drawer. | Mega Menu hoạt động mượt mà, Drawer mở trơn tru trên mobile, nút CTA dẫn đúng trang lái thử. | **TRONG PHẠM VI** |
| **REQ-03** | Word Mục III.2 | STT 7: Thu thập lead (300.000đ) | MUST | `footer.php`, `style.css` | PARTIAL | Tái cấu trúc thanh điều hướng đáy màn hình mobile thành đúng **3 nút**: 📞 Gọi ngay, 🧮 Dự toán (`/du-toan-chi-phi/`), 🚗 Lái thử (`/dang-ky-lai-thu/`). | Thanh mobile bar bám đáy 100% thiết bị di động (<768px), click mở đúng cuộc gọi và 2 link chức năng. | **TRONG PHẠM VI** |
| **REQ-04** | Word Mục III.4 | STT 7: Thu thập lead (300.000đ) | MUST | `footer.php`, `plugins/popup-maker` | EXISTING BUT BROKEN | Tích hợp nút nổi Hotline/Zalo; Cấu hình Popup Maker hiển thị ưu đãi có nút đóng X và tự đóng sau timeout. | Nút Zalo/Hotline luôn nổi góc màn hình; Popup mở đúng thời điểm và đóng mượt mà không chặn giao diện. | **TRONG PHẠM VI** |
| **REQ-05** | Word Mục IV.1 | STT 1: Nền tảng | MUST | `page-home.php` | PARTIAL | Rà soát và hoàn thiện 8 sections: Hero Slider, Car Showcase (VF 2-9 tóm tắt 4 thông số), Bảo hành 10 năm, Chiến dịch xanh, Green Series, Khối tài chính nhanh, Tin tức mới nhất, Bản đồ Showroom Minh Ngân Phú Thọ. | Đủ 8 section theo thứ tự, thông tin đại lý trỏ đúng Minh Ngân Phú Thọ, responsive từ 320px đến 1440px. | **TRONG PHẠM VI** |
| **REQ-06** | Word Mục IV.2 | STT 2: Trang xe (160.000đ / 2 xe) | MUST | `single-car_model.php`, `single-product-vinfast.php` | PARTIAL | Hoàn thiện template chi tiết cho **đúng 2 mẫu xe trọng điểm** (VF 3 & VF 7): thông số NEDC/WLTP, pin, sạc nhanh, ADAS, Vivu, CTA Lăn bánh/Lái thử/Brochure PDF. Kiến trúc mở rộng cho xe khác. | 2 mẫu xe hiển thị đầy đủ thông số chính hãng, gallery, đổi màu xe realtime và tải brochure hợp lệ. | **TRONG PHẠM VI (Giới hạn 2 xe)** |
| **REQ-07** | Word Mục IV.3 (Tab A) | STT 3: Dự toán lăn bánh (700.000đ) | MUST | `page-du-toan.php` | EXISTING BUT BROKEN | Đổi nhãn Vĩnh Phúc sang Phú Thọ; Kiểm tra logic thuế trước bạ xe điện (0%); Bóc tách phí biển số, đăng kiểm, đường bộ, TNDS; Tích hợp nút **TẢI PDF** xuất bản in chuẩn mẫu. | Tính toán chính xác theo dòng xe/tỉnh thành; Bấm nút Tải PDF xuất file in đẹp, tiếng Việt có dấu, thông tin Minh Ngân. | **TRONG PHẠM VI** |
| **REQ-08** | Word Mục IV.3 (Tab B) | STT 4: Tính trả góp (700.000đ) | MUST | `page-du-toan.php` | EXISTING & WORKING | Kiểm tra công thức dư nợ giảm dần, trả trước 20-80%, vay 1-8 năm; Xuất bảng chi tiết từng tháng; Viết unit test kiểm chứng công thức. | Bảng lịch trả nợ đầy đủ từng kỳ, số tiền tất toán chính xác về 0đ, có cảnh báo "mang tính chất tham khảo". | **TRONG PHẠM VI** |
| **REQ-09** | Word Mục IV.4 | STT 5: Đăng ký lái thử (400.000đ) | MUST | `page-lai-thu.php`, `functions.php` | EXISTING BUT BROKEN | Bổ sung Nonce token bảo mật chống CSRF; validate server-side; Hỗ trợ chọn xe VF 3-9, tại Showroom/tại nhà; Gửi AJAX không reload. | Form submit thành công không tải lại trang, validate số điện thoại VN hợp lệ, ngăn chặn bot spam. | **TRONG PHẠM VI** |
| **REQ-10** | Word Mục IV.5 | STT 6: Đặt lịch bảo dưỡng (440.000đ) | MUST | `page-dat-lich-dich-vu.php` | PARTIAL | Chuẩn hóa quy trình đặt lịch 4 bước trên mobile; Bổ sung cam kết bảo hành chính hãng 10 năm/200.000 km; Gửi Lead về email. | Khách hoàn thành 4 bước mượt mà trên mobile, nhận thông báo xác nhận tiếp nhận lịch hẹn trung thực. | **TRONG PHẠM VI** |
| **REQ-11** | Word Mục V | STT 1: Nền tảng | MUST | `functions.php`, `wp-config.php` | EXISTING BUT BROKEN | Chuẩn hóa cơ chế **Dual-Recipient SMTP**: phân phối đồng thời tới 2 email nhận chính (`To:`), định danh người gửi "VinFast Minh Ngân", kết nối Gmail SMTP an toàn, không báo thành công giả. | Cả 2 email nhận được thông tin Lead ngay lập tức; Không hardcode password vào git; Báo lỗi trung thực khi SMTP đứt. | **TRONG PHẠM VI** |
| **REQ-12** | Word Mục VI | STT 1: Nền tảng | MUST | `page-home.php`, WP Query | EXISTING & WORKING | Cấu hình truy vấn tin tức theo `ORDER BY post_date DESC`, bài viết khuyến mãi mới nhất tự động nhảy lên vị trí số 1. | Đăng bài viết mới trong WP Admin -> Trang chủ tự động cập nhật bài mới lên đầu. | **TRONG PHẠM VI** |
| **REQ-13** | Word Mục VII | STT 1: Nền tảng | SHOULD | GitHub Repo, WebHook config | NOT VERIFIED | Quản lý mã nguồn trên GitHub `vinfastminhnganphutho-3s.com.vn`; Chuẩn bị script webhook đồng bộ mã nguồn lên VPS aaPanel khi push `main`. | Đẩy commit lên GitHub -> Webhook kích hoạt pull code không downtime (khi có môi trường VPS thực tế). | **TRONG PHẠM VI (Tầng code & doc)** |
| **REQ-14** | Word Mục II.1, II.2 | Ngoài bảng Excel | LATER | CPT `car_model` | PARTIAL | Nhập liệu đầy đủ toàn bộ 15 dòng xe cá nhân & xe thương mại (VF 2, VF Wild, Minio, Herio, Nerio, Limo, EC Van, eBus). | Chỉ tạo khung cấu trúc danh mục và 2 mẫu xe hoàn chỉnh; 13 mẫu còn lại thuộc danh mục mở rộng. | **NGOÀI PHẠM VI (Mở rộng)** |
| **REQ-15** | Mã nguồn cũ (`page-dat-coc.php`) | Không có trong Excel | LATER | `page-dat-coc.php`, VietQR | LEGACY | Chức năng Đặt cọc trực tuyến sinh mã VietQR động qua tài khoản ngân hàng Tân Á Châu cũ. | Đóng băng hoặc ẩn khỏi menu chính gói cơ bản để tránh rủi ro tài chính & pháp lý; Không thuộc gói 4.000.000đ. | **NGOÀI PHẠM VI (Đóng băng)** |
| **REQ-16** | Mã nguồn cũ (`functions.php`) | Không có trong Excel | LATER | Telegram Bot API Lead | LEGACY | Bắn thông báo Lead đặt cọc về nhóm Telegram cá nhân của dev cũ qua bot token cứng. | Phân loại thành tiện ích mở rộng; Vô hiệu hóa thông báo rò rỉ lead sang nhóm chat cũ, ưu tiên Dual-Recipient SMTP. | **NGOÀI PHẠM VI (Đóng băng)** |

---

### 2. TỔNG HỢP PHẠM VI TÀI CHÍNH & HỢP ĐỒNG (BÁO GIÁ EXCEL 4.000.000 VNĐ)

| Hạng mục Excel | Chức năng đối chiếu | Đơn giá duyệt | Tình trạng kỹ thuật tương ứng |
|:---|:---|:---:|:---|
| 1. Nền tảng | Flatsome Child Theme, tối ưu tốc độ, CI/CD tự deploy, Brand System `#2563EB`, Header/Footer/Mega Menu | 1.300.000 VNĐ | Khung mã nguồn đã sẵn sàng, cần chuẩn hóa UI/UX và loại bỏ vết brand cũ |
| 2. Trang xe | Template riêng từng dòng xe (2 mẫu xe chuẩn: VF 3 & VF 7) | 160.000 VNĐ | CPT `car_model` đã có, cần hoàn thiện thông số & gallery chuẩn cho 2 xe |
| 3. Công cụ bán hàng (A) | Dự toán chi phí lăn bánh theo tỉnh thành, nút In/Tải PDF 1-click | 700.000 VNĐ | Logic tính đã có, cần đổi vùng Phú Thọ và tối ưu định dạng in PDF tiếng Việt |
| 4. Công cụ bán hàng (B) | Tính lịch trả góp ngân hàng, dư nợ giảm dần từng tháng | 700.000 VNĐ | Đã có code, cần viết test kiểm chứng số liệu tài chính |
| 5. Dịch vụ khách hàng (A) | Đăng ký lái thử tại showroom hoặc tận nhà, gửi AJAX, email thông báo | 400.000 VNĐ | Cần bổ sung Nonce bảo mật và fix thông báo lỗi trung thực |
| 6. Dịch vụ khách hàng (B) | Đặt lịch bảo dưỡng 4 bước online, cam kết bảo hành 10 năm | 440.000 VNĐ | Đã có template 4 bước, cần chuẩn hóa form và tiếp nhận lead |
| 7. Thu thập lead | Nút nổi Hotline/Zalo + Popup ưu đãi tự đóng + Sticky Action Bar Mobile | 300.000 VNĐ | Đã có plugin Popup Maker, cần cấu hình 3 nút mobile chuẩn đặc tả |
| **TỔNG CỘNG** | **GÓI CƠ BẢN HOÀN CHỈNH** | **4.000.000 VNĐ** | **Không bao gồm chi phí hosting, tên miền và các cổng thanh toán online** |

