# BÁO CÁO KIỂM THỬ VÀ NGHIỆM THU CHẤT LƯỢNG — TASK HOME-02.1
## PREMIUM SHOWROOM — RESPONSIVE & VISUAL QUALITY FIX
**Dự án:** Website VinFast Minh Ngân Phú Thọ 3S (`vinfastminhnganphutho-3s.com.vn`)  
**Mã kiểm thử:** `TASK ID: HOME-02.1`  
**Ngày thực hiện:** 06/11/2026  
**Môi trường:** LocalWP (`http://localhost:10004`), Nginx 1.26.1, PHP 8.2.29, MySQL 8.4  
**Trình duyệt kiểm định:** Microsoft Edge Headless (Chromium 131+) qua Chrome DevTools Protocol (CDP)  
**Tình trạng:** SẴN SÀNG NGHIỆM THU (READY FOR APPROVAL)

---

## 1. MỤC TIÊU VÀ BỐI CẢNH KIỂM THỬ

Sau khi Slice 2 bàn giao, Chủ dự án chỉ ra 3 lỗi nghiêm trọng cần khắc phục trước khi nghiệm thu:
1. **Lỗi P0 Mobile Overflow:** Ảnh `wp_mobile_390.png` trước đó bị cắt nội dung ở mép phải (hero car, floating specs box, tab xe, thẻ xe tràn viewport ngang).
2. **Lỗi Hero Mobile Hierarchy:** Bố cục Hero trên màn hình nhỏ chưa tối ưu; khối thông số kỹ thuật dạng absolute nổi đè lên xe và che khuất ảnh xe.
3. **Lỗi Aftersales Imagery:** Ảnh minh họa khu vực hậu mãi Section 3 ("Đồng hành trên mọi hành trình") là ảnh du thuyền thể thao Unsplash không phù hợp với chuẩn mực xưởng dịch vụ 3S của VinFast.
4. **Lỗi Quick Action Bar:** Cần chuẩn hóa Sticky Mobile Action Bar thành đúng 3 nút hành động chuẩn: Gọi ngay (Hotline `0981 33 55 22`), Dự toán, Lái thử (#2563EB).

---

## 2. BẢNG ĐO ĐẠC DOM THỰC TẾ TRÊN 6 VIEWPORTS

Kiểm định tự động qua CDP script (`run_qa_suite.js`), đo lường trực tiếp `window.innerWidth`, `document.documentElement.scrollWidth`, `document.body.scrollWidth` và bounding box của từng phần tử DOM:

| Viewport | Thiết bị đại diện | Viewport W | Scroll W | Max Scroll | Tràn ngang (Overflow) | Trạng thái |
| :--- | :--- | :---: | :---: | :---: | :---: | :---: |
| **320 x 740** | Small Mobile (Galaxy Fold gập, iPhone 5/SE cũ) | 320px | 320px | 320px | **KHÔNG (0px)** | **PASS (100%)** |
| **375 x 812** | iPhone SE Gen 2/3, iPhone 12/13 Mini | 375px | 375px | 375px | **KHÔNG (0px)** | **PASS (100%)** |
| **390 x 844** | iPhone 13 / 14 / 15 / 16 tiêu chuẩn | 390px | 390px | 390px | **KHÔNG (0px)** | **PASS (100%)** |
| **768 x 1024** | iPad Mini, iPad 9.7", Tablet dọc | 768px | 768px | 768px | **KHÔNG (0px)** | **PASS (100%)** |
| **1024 x 768** | iPad Pro ngang, Small Laptop | 1024px | 1009px | 1009px | **KHÔNG (0px)** | **PASS (100%)** |
| **1440 x 900** | Desktop màn hình tiêu chuẩn | 1440px | 1425px | 1425px | **KHÔNG (0px)** | **PASS (100%)** |

> **Kết luận:** Tỷ lệ tràn ngang đạt **0% trên toàn bộ 6 viewports**. Website hoàn toàn không xuất hiện thanh cuộn ngang (horizontal scrollbar) hay nội dung bị che khuất ở mép phải.

---

## 3. CHI TIẾT CÁC HẠNG MỤC ĐÃ KHẮC PHỤC

### 3.1. Hero Section Mobile Optimization
- **Thứ tự phân cấp thị giác (Visual Hierarchy):**  
  `Eyebrow -> Tiêu đề H1 -> Mô tả đại lý -> 2 nút CTA (Xem bảng giá & Đăng ký lái thử) -> Ảnh xe lớn -> Khối thông số kỹ thuật`.
- **Hero Spec Box:**  
  Trên màn hình `< 768px`, loại bỏ hoàn toàn `position: absolute` và transform 3D gây tràn lề. Chuyển thành khối grid tĩnh 3 cột cân đối (`grid-template-columns: 1fr 1px 1fr 1px 1fr`), nền xám dịu sang trọng, hiển thị 100% trọn vẹn dưới xe.
- **Bounding Box tại 320px:** Chiều rộng xe: `290px`, Lề phải: `305px` (nằm an toàn trong lề 320px).

### 3.2. Car Collection & Tabs
- **Tabs điều hướng:** Co giãn `flex: 1 1 50%` với `white-space: normal`, tự động xuống dòng mượt mà trên 320px mà không bị trượt khỏi mép màn hình.
- **Card xe:** Bố cục 1 cột full-width thoáng đãng trên mobile, lưới thông số 3 cột hiển thị rõ tầm vận hành, công suất, số chỗ ngồi.
- **Touch Target:** Nút "Khám phá chi tiết" có chiều cao 46px (đáp ứng chuẩn tối thiểu 44-48px của Apple HIG & Google Material).

### 3.3. Xử lý hình ảnh Hậu mãi & Xưởng dịch vụ 3S
- **Trước đây:** Ảnh du thuyền Unsplash không liên quan đến ô tô điện.
- **Hiện tại:** Thay thế bằng ảnh xưởng kỹ thuật sửa chữa bảo dưỡng xe hơi chuyên nghiệp hiện đại:  
  `https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&q=80&w=1000`
- **Nhãn xác minh:** Bổ sung badge xác nhận *"Hình ảnh minh họa định hướng — Sẽ thay bằng ảnh thực tế Xưởng dịch vụ VinFast Minh Ngân Phú Thọ khi bàn giao"*.

### 3.4. Chuẩn hóa Sticky Quick Action Bar (< 768px)
- **Cấu trúc đúng 3 nút theo yêu cầu:**
  1. **Gọi ngay:** Nút trắng viền mảnh, icon điện thoại, gọi trực tiếp tới Hotline `tel:0981335522`.
  2. **Dự toán:** Nút trắng viền mảnh, icon máy tính tài chính, liên kết tới `#du-toan`.
  3. **LÁI THỬ:** Nút xanh thương hiệu `#2563EB`, icon xe điện, chữ in hoa nổi bật, mở modal lái thử.
- **Kích thước Touch Target:**
  - Viewport 320px: Gọi ngay (85x46px), Dự toán (85x46px), Lái thử (114x46px) — Đạt chuẩn WCAG 2.1 AAA.
  - Viewport 390px: Gọi ngay (106x46px), Dự toán (106x46px), Lái thử (143x46px).
- **Tránh che khuất nội dung:** Thêm `padding-bottom: 76px` cho footer và toàn trang trên mobile, hỗ trợ `env(safe-area-inset-bottom)`.

### 3.5. Header & Navigation trên Tablet / Small Desktop
- Tại breakpoint `<= 1099px`, chuyển đổi tự động sang hamburger mobile menu drawer, tránh việc dồn 8 menu items khiến header bị tràn ngang như trước.

---

## 4. DANH SÁCH BẰNG CHỨNG HÌNH ẢNH ĐÃ CHỤP THỰC TẾ

Tất cả ảnh chụp từ Edge Headless đã được lưu trữ tại `docs/audit/screenshots/`:
1. `docs/audit/screenshots/wp_mobile_320.png` — Giao diện mobile nhỏ 320px (Fold/SE) trọn vẹn, không cắt lề.
2. `docs/audit/screenshots/wp_mobile_375.png` — Giao diện iPhone SE 375px chuẩn mực.
3. `docs/audit/screenshots/wp_mobile_390.png` — Giao diện iPhone 13/14/15/16 390px chuẩn mực.
4. `docs/audit/screenshots/wp_tablet_768.png` — Giao diện iPad dọc 768px.
5. `docs/audit/screenshots/wp_desktop_1024.png` — Giao diện màn hình 1024px đã tối ưu header.
6. `docs/audit/screenshots/wp_desktop_1440.png` — Giao diện Desktop tiêu chuẩn 1440px cao cấp.
7. `docs/audit/screenshots/wp_mobile_390_cars.png` — Chi tiết Section 2 Danh mục xe trên màn hình 390px.
8. `docs/audit/screenshots/wp_mobile_390_service.png` — Chi tiết Section 3 Xưởng dịch vụ 3S trên màn hình 390px.

---

## 5. TỔNG HỢP QUALITY GATES (THEO AGENTS.MD MỤC 7)

- **G0 — Git Baseline & An toàn mã nguồn:** PASS. Không sửa Core WordPress, không can thiệp Parent Theme Flatsome, mọi can thiệp đều nằm trong `flatsome-child-minhnganphutho`.
- **G1 — Đúng Slice, không lan phạm vi:** PASS. Tập trung 100% vào việc fix responsive mobile, bố cục Hero, ảnh dịch vụ và sticky mobile bar.
- **G2 — Regression & Unit Tests:** PASS. Trang chủ WordPress load HTTP 200 OK, các chức năng modal lái thử, toggle tab, chuyển đổi giá lăn bánh hoạt động trơn tru.
- **G3 — Build / Typecheck / CSS Linter:** PASS. Không có lỗi cú pháp PHP/CSS/JS.
- **G4 — Security & Data Integrity:** PASS. Không lưu trữ thông tin nhạy cảm, số hotline và thông số kỹ thuật được cấu hình nhất quán.
- **G5 — Visual & Real Browser Test:** PASS. Kiểm thử trên Microsoft Edge Chromium thật qua CDP tại 6 viewports, lưu trữ đầy đủ 8 file ảnh chụp thực tế.
- **G6 — Review diff & AI Handoff:** PASS. Đã cập nhật đầy đủ tài liệu bàn giao `AI_HANDOFF.md`.

