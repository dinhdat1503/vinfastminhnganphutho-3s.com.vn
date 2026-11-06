# PHẦN 4: KIỂM TOÁN CHẤT LƯỢNG MÃ NGUỒN PHP (PHP & CODE QUALITY)

## 1. Các Lỗi Nghiêm Trọng Về Mã Nguồn (Critical Defects)

### 1.1. Lỗi Đường Dẫn Tuyệt Đối Cục Bộ Của Lập Trình Viên (Hardcoded Developer Paths)
- **Vị trí phát hiện:** Tệp tin [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php) tại các dòng:
  - **Dòng 65:** `$vfg_logo_src = 'C:/Users/ngodi/Job Freelancer/Local Sites/vftanuyen/app/public/wp-content/uploads/2026/05/logovinf.jpg';`
  - **Dòng 303:** `$brain_bg = 'C:/Users/ngodi/.gemini/antigravity-ide/brain/00c81ea2-91f8-4ba9-95f1-4d32d81893ce/media__1784893832596.png';`
  - **Dòng 307:** `$tanuyen_vf9 = 'C:/Users/ngodi/Job Freelancer/Local Sites/vftanuyen/app/public/wp-content/uploads/2026/05/vf9-1.png';`
  - **Dòng 738:** `$gallery_base = 'C:/Users/ngodi/.gemini/antigravity-ide/scratch/vinfast-image-downloader/vinfast_full_gallery';`
  - **Dòng 825-827:**
    `'C:/Users/ngodi/Downloads/VinFast_Images/banner/banner.jpg'`,
    `'C:/Users/ngodi/Downloads/VinFast_Dataset_Complete/2026/05/banner.jpg'`,
    `'C:/Users/ngodi/Job Freelancer/Local Sites/vftanuyen/app/public/wp-content/uploads/banner.jpg'`
- **Hành vi:**
  - Mã nguồn thực hiện kiểm tra `file_exists()` và sao chép tệp tin (`@copy()`) từ thư mục ổ đĩa `C:/Users/ngodi/...` sang thư mục uploads của WordPress.
  - Đoạn mã dòng 65 chạy **ngay tại phạm vi toàn cục (global scope)** của `functions.php` trong mọi lượt tải trang; các dòng 303-312 gắn vào hook `init` với priority 3 và 4.
- **Tác động:**
  - Trên môi trường hosting Linux thực tế (`/home/hkruxcnchosting/...`), toàn bộ các đường dẫn ổ `C:` này đều không tồn tại, khiến các tác vụ đồng bộ logo, banner và ảnh thư viện xe thất bại âm thầm.
  - Làm lộ cấu trúc thư mục riêng tư và tài khoản cá nhân của lập trình viên trong mã nguồn dự án.
- **Phân loại:** **VERIFIED DEFECT (P0)**.

### 1.2. Thuật Toán Xử Lý Điểm Ảnh Bằng GD Chạy Trên Hook Khởi Tạo (CPU / Memory Exhaustion)
- **Vị trí:** Tệp tin [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php#L226-L292).
- **Mã nguồn:**
  ```php
  function vfvp_remove_white_bg_php($src, $dst) {
      ...
      for ($x = 0; $x < $w; $x++) {
          for ($y = 0; $y < $h; $y++) {
              $rgb = imagecolorat($img, $x, $y);
              ...
              if ($r > 215 && $g > 215 && $b > 215) {
                  imagesetpixel($transparent_img, $x, $y, $transparent_color);
              }
          }
      }
      imagepng($transparent_img, $dst);
  }
  ```
- **Hành vi:**
  - Sử dụng 2 vòng lặp lồng nhau duyệt qua từng điểm ảnh ($w \times h$) của các file ảnh xe độ phân giải cao bằng thư viện GD và ghi đè lại file ảnh.
  - Hàm `vfvp_clean_all_car_cutouts()` duyệt qua toàn bộ file `cutout_*.png` trong thư mục uploads và chạy trên hook `init` priority 3.
- **Tác động:**
  - Với một bức ảnh kích thước 1920x1080, vòng lặp phải thực hiện **2.073.600 lần gọi hàm** `imagecolorat()` và `imagesetpixel()`.
  - Thao tác này tiêu tốn lượng RAM rất lớn (50MB - 128MB) và thời gian thực thi CPU kéo dài từ 5 - 15 giây.
  - Nếu file cờ `.cutouts_cleaned_v4` bị xóa hoặc không ghi được (do phân quyền thư mục), **mọi request của người dùng ghé thăm web đều bị nghẽn (freeze)**, dẫn đến lỗi Fatal Error: `Maximum execution time of 30 seconds exceeded` hoặc `Allowed memory size exhausted`.
- **Phân loại:** **STATIC CODE RISK / PERFORMANCE DEFECT (P1)**.

---

## 2. Đánh Giá Cấu Trúc Mã Nguồn (Code Architecture & Maintainability)

### 2.1. File `functions.php` Monolithic Quá Lớn (3.168 dòng)
- Toàn bộ logic của hệ thống được nhồi nhét trong một tệp duy nhất [functions.php](file:///d:/DinhDat/Me/vinfasttanachill/functions.php) có dung lượng gần 150 KB.
- Không áp dụng chuẩn tách module (Separation of Concerns): CPT, AJAX handlers, Email SMTP, Cron jobs, CSS custom, Shortcodes và Image processing trộn lẫn vào nhau.
- Không có namespace, không dùng Autoloader chuẩn PSR-4, các hàm định nghĩa toàn cục dùng tiền tố `vfvp_` hoặc `vf_` không nhất quán.

### 2.2. Kiến Trúc Truy Vấn Cơ Sở Dữ Liệu
- **Điểm tích cực:** Toàn bộ các truy vấn tuỳ biến trong Child Theme đều sử dụng API chuẩn của WordPress (`get_posts()`, `wp_get_post_terms()`, `get_post_meta()`). Không phát hiện câu lệnh `$wpdb->query()` trần hay ghép chuỗi SQL nguy hiểm trong `functions.php`.
- **Điểm cần tối ưu:**
  - Hàm `vfvp_ajax_get_cars_list()` (dòng 1405) sử dụng `'posts_per_page' => -1` để lấy toàn bộ xe. Khi số lượng xe và biến thể tăng lên, việc truy vấn không giới hạn kèm lấy terms bằng vòng lặp `foreach` sẽ gây N+1 queries làm chậm database.

### 2.3. Tương Thích PHP 8.x
- Mã nguồn nhìn chung tương thích tốt với cú pháp PHP 8.1 - 8.2 (đã dùng toán tử null coalescing `??`, type hinting trong custom plugin).
- Tuy nhiên việc dùng `@copy()`, `@imagecreatefrompng()`, `@getimagesize()` để đàn áp lỗi (error suppression operator `@`) là thói quen xấu, che giấu các nguyên nhân lỗi tiềm ẩn trong quá trình vận hành máy chủ.

