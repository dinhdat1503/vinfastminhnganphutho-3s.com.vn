# PHẦN 6: KIỂM TOÁN HIỆU NĂNG & SEO (SEO & PERFORMANCE AUDIT)

## 1. Kiểm Toán Hiệu Năng & Tải Tài Nguyên (Core Web Vitals & Assets)

### 1.1. Tải Tài Nguyên Không Điều Kiện Trên Mọi Trang (Unconditional Asset Loading)
- **Vị trí:** Tệp tin [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L138-L168), hàm `vfvp_enqueue_assets()`.
- **Hành vi thực tế:** Các thư viện bên thứ ba và script nội bộ:
  - `swiper-bundle.min.css` & `swiper-bundle.min.js` (~150 KB)
  - `glightbox.min.css` & `glightbox.min.js` (~80 KB)
  - `vfvp-main.js` (~8 KB) & `vfvp-modal.js` (~7 KB)
  Được nạp **trên 100% tất cả các trang** của website (kể cả các trang tĩnh đơn giản như Chính sách bảo hành, Chính sách bảo mật, Tuyển dụng, Điều khoản sử dụng).
- **Tác hại:** Làm phình to dung lượng tải trang ban đầu, làm tăng Total Blocking Time (TBT) và Largest Contentful Paint (LCP) trên thiết bị di động kết nối 3G/4G yếu.
- **Giải pháp:** Chỉ enqueue `swiper` trên trang chủ (`is_front_page()`), chỉ enqueue `glightbox` trên các trang xe (`single-car_model.php` hoặc `is_singular('product')`).

### 1.2. Kích Thước File CSS Quá Lớn & Chưa Được Minify (CSS Bloat)
- Tệp tin [style.css](file:///d:/DinhDat/Me/vinfasttanachill/style.css) của Child Theme có kích thước **279 KB** với **12.291 dòng mã**.
- File hoàn toàn chưa qua quá trình biên dịch rút gọn (Minification), chứa nhiều đoạn comment và khoảng trắng thừa.
- Trình duyệt phải tải và parse một tệp CSS 279 KB trước khi có thể render First Contentful Paint (FCP).

### 1.3. Xung Đột Giữa Plugin Thống Kê Nội Bộ `wp-insight` & Bộ Nhớ Đệm LiteSpeed Cache
- Plugin `custom-plugins/wp-insight` ghi nhận lượt xem trang bằng cách lắng nghe hook `add_action('wp', [$this, 'track_hit'])` và thực hiện đồng bộ 3 truy vấn SQL (`$wpdb->insert`, `$wpdb->get_row`, `$wpdb->update`) vào bảng `wpinsight_hits` và `wpinsight_sessions`.
- **Nghịch lý kiến trúc:**
  - Nếu máy chủ bật tính năng Page Caching của LiteSpeed Web Server, trang HTML được phục vụ trực tiếp từ bộ nhớ đệm RAM mà không kích hoạt PHP engine, dẫn đến việc `wp-insight` **không ghi nhận được lượt truy cập** (số liệu thống kê bị sai lệch 80-90%).
  - Nếu tắt Page Caching để phục vụ `wp-insight`, mỗi lượt truy cập đều phải khởi động toàn bộ WordPress Core và chạy 3 truy vấn ghi database, khiến thời gian phản hồi máy chủ (TTFB) tăng vọt và server dễ sập khi có lượng truy cập đột biến.

### 1.4. Hotlinking Hình Ảnh Băng Thông Ngoài (Hotlinking Dependency)
- Tại [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L837):
  ```php
  return 'https://static-cms-prod.vinfastauto.com/banner-mlttvn.jpg';
  ```
- Việc hotlink trực tiếp vào CDN máy chủ CMS chính của VinFast Auto khiến website phụ thuộc vào chính sách Referrer / CORS của VinFast. Khi VinFast kích hoạt chặn hotlink hoặc thay đổi link ảnh, banner trang chủ của đại lý sẽ biến thành hình ảnh lỗi màu trắng.

---

## 2. Kiểm Toán Cơ Sở Dữ Liệu & Rác Dữ Liệu (Database Overhead)

- **Bảng `SERVMASK_PREFIX_actionscheduler_*`:** Bảng lịch trình Action Scheduler ghi nhận **415 actions** và **1.217 log entries** tích lũy từ WooCommerce và các plugin cũ. Cần được dọn dẹp để giảm kích thước file database dump.
- **Bảng `SERVMASK_PREFIX_options`:** Hiện có 539 tùy chọn được tải, trong đó nhiều option của các plugin đã gỡ bỏ hoặc không dùng (như Smart Slider 3, Elementor) vẫn tồn tại trong database với thuộc tính `autoload = 'on'`, tiêu tốn bộ nhớ RAM mỗi khi WordPress khởi động.

---

## 3. Kiểm Toán SEO On-Page & Dữ Liệu Cấu Trúc (Structured Data)

- **Tình trạng Schema / Structured Data:** Chưa có dữ liệu cấu trúc Schema `AutoDealer`, `Product`, `Vehicle` theo chuẩn schema.org cho các dòng ô tô điện (VF 3, VF 7, VF 8...).
- **OpenGraph & Social Sharing:** Thiếu các thẻ meta OpenGraph (`og:image`, `og:title`, `og:description`) tùy biến cho từng mẫu xe trên mạng xã hội Facebook, Zalo.
- **Đường dẫn tĩnh (Permalinks):** Các trang xe hiện đang nằm rải rác giữa slug WooCommerce (`/product/vinfast-vf-3/`) và trang tùy biến (`/vf3/`), cần quy hoạch đồng nhất để tránh trùng lặp nội dung (Duplicate Content) trong mắt Google Bot.

