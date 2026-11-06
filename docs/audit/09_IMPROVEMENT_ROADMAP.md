# PHẦN 9: LỘ TRÌNH CẢI TIẾN HỮU HẠN (FINITE IMPROVEMENT ROADMAP)

> **Nguyên tắc:** Lộ trình hữu hạn, chia theo từng lát cắt (Slice) độc lập có thể nghiệm thu, kiểm thử và đảo ngược. Ưu tiên xử lý triệt để P0 và P1 trước khi làm tính năng mới. Không mở rộng vô hạn.

---

## 1. Tổng Quan Lộ Trình 4 Slices

```
┌────────────────────────────────────────────────────────────────────────┐
│ SLICE 1: KHẮC PHỤC LỖI KHẨN CẤP CHẶN RELEASE (P0 & P1 CRITICAL FIXES)  │
│ • Xóa đường dẫn cứng C:/Users • Sửa thành công giả footer             │
│ • Bổ sung Nonce AJAX footer   • Escape HTML tin Telegram               │
│ • Đồng bộ tiền tố bảng DB SQL & Kích hoạt plugin chuẩn                 │
└───────────────────────────────────┬────────────────────────────────────┘
                                    │ (Nghiệm thu & Duyệt)
                                    ▼
┌────────────────────────────────────────────────────────────────────────┐
│ SLICE 2: CHUẨN HÓA KIẾN TRÚC THEME & TEMPLATE ENGINE (P1 & P2 ARCH)   │
│ • Chuyển CSS Parent về Child Theme • Khớp tên template DB vs Theme     │
│ • Gỡ bỏ chèn bài viết rác ở init   • Tối ưu hàm GD xử lý ảnh           │
└───────────────────────────────────┬────────────────────────────────────┘
                                    │ (Nghiệm thu & Duyệt)
                                    ▼
┌────────────────────────────────────────────────────────────────────────┐
│ SLICE 3: TỐI ƯU HIỆU NĂNG, TÀI NGUYÊN & TRẢI NGHIỆM MOBILE (P2 & P3)  │
│ • Enqueue có điều kiện Swiper/GLightbox • Minify style.css (279 KB)    │
│ • Sửa font !important & nạp Mulish      • Gọn nút nổi mobile & a11y   │
└───────────────────────────────────┬────────────────────────────────────┘
                                    │ (Nghiệm thu & Duyệt)
                                    ▼
┌────────────────────────────────────────────────────────────────────────┐
│ SLICE 4: BẢO MẬT TÀI CHÍNH VIETQR, LÀM SẠCH DOMAIN & SEO (P2 & P3)    │
│ • Đưa STK ngân hàng vào Settings Admin  • Chuyển 100% HTTPS sạch       │
│ • Loại bỏ liên kết vinfasttanuyen.vn    • Bổ sung Schema AutoDealer   │
└────────────────────────────────────────────────────────────────────────┘
```

---

## 2. Chi Tiết Lát Cắt Khuyến Nghị Thực Hiện Đầu Tiên

### SLICE 1: Khắc Phục Lỗi Khẩn Cấp Chặn Release (P0 & P1 Critical Fixes)

- **Mục tiêu:** Loại bỏ 100% các rủi ro hệ thống bị sập, lộ thông tin cá nhân, mất khách hàng tiềm năng và không gửi được tin báo Telegram.
- **Phạm vi (In Scope):**
  1. `functions.php`: Xóa bỏ toàn bộ các biến chứa đường dẫn ổ `C:/Users/ngodi/...`; chuyển ảnh cục bộ vào `assets/` nếu cần (Khắc phục **CODE-01**).
  2. `footer.php`: Viết lại khối `.catch()` hiển thị thông báo lỗi trung thực màu đỏ và giữ lại số điện thoại để khách có thể gửi lại (Khắc phục **UI-01**).
  3. `functions.php`: Bổ sung kiểm tra `check_ajax_referer('vfvp_ajax_nonce', 'nonce')` cho hàm `vfvp_handle_footer_service_form` và truyền token tương ứng từ footer (Khắc phục **SEC-01**).
  4. `functions.php`: Bọc toàn bộ biến người dùng nhập (`$name`, `$note`, `$phone`) qua `htmlspecialchars()` trước khi ghép chuỗi gửi sang Telegram (Khắc phục **SEC-02**).
  5. `database.sql`: Cung cấp script chuyển đổi tiền tố `SERVMASK_PREFIX_` sang `v5E_default_` và cập nhật bản ghi `active_plugins`, `template`, `stylesheet` hợp lệ (Khắc phục **OPS-01**, **OPS-02**).
- **Ngoài phạm vi (Out of Scope):** Không đổi giao diện các trang khác, không tái cấu trúc 16 template dòng xe, không cài thêm plugin mới.
- **Tiêu chí chấp nhận (Acceptance Criteria):**
  - Quét regex toàn bộ theme không còn bất kỳ ký tự nào của đường dẫn `C:/Users/`.
  - Form chân trang khi ngắt mạng hiển thị thông báo lỗi rõ ràng, không báo "Thành công" giả.
  - Request AJAX không kèm Nonce bị chặn với HTTP 403.
  - Gửi đơn đặt cọc với tên hoặc ghi chú chứa `<test> & "quotes"` vẫn đẩy tin nhắn Telegram về bình thường mà không bị lỗi API 400.
  - File database sau khi chuyển đổi import vào MySQL nhận diện đúng tiền tố `$table_prefix = 'v5E_default'`.
- **Rủi ro & Kế hoạch đảo ngược:** Thay đổi nhỏ, có thể revert qua Git trong vòng 30 giây nếu có phát sinh ngoài ý muốn.

---

## 3. Điểm Dừng Bắt Buộc (Mandatory Stop Point)

Theo quy định tại **AGENTS.md Mục 8, 9, 10, 11** và yêu cầu của chủ dự án:
> **"Giai đoạn đầu chỉ kiểm toán và lập kế hoạch. Không sửa code, cập nhật plugin, thay theme hoặc deploy. Hoàn thành thì dừng chờ phê duyệt."**

Antigravity dừng tại đây, bảo toàn toàn bộ mã nguồn hiện hữu và chuyển sang trạng thái **CHỜ CHỦ DỰ ÁN PHÊ DUYỆT**.

