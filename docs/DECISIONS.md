# DECISIONS — NHẬT KÝ QUYẾT ĐỊNH KIẾN TRÚC (ADR)

> Ghi nhận các quyết định kiến trúc quan trọng theo định dạng rút gọn. Không xóa quyết định cũ; nếu thay đổi, tạo bản ghi mới thay thế.

---

## ADR-001: Lựa chọn mô hình Full WordPress Project cho VinFast Minh Ngân Phú Thọ 3S

- **Ngày:** 2026-11-06
- **Trạng thái:** ACCEPTED (Được phê duyệt bởi Chủ dự án)
- **Bối cảnh:**
  Dự án cần một môi trường độc lập, đầy đủ và sẵn sàng vận hành để phát triển website đại lý VinFast Minh Ngân Phú Thọ 3S dựa trên nền tảng sẵn có từ dự án tham chiếu `vinfasttanachill` và tài nguyên WordPress core từ `vinhphucvinfast.com.vn`.
- **Quyết định:**
  Triển khai mô hình **Full WordPress Project** bao gồm:
  1. Toàn bộ WordPress Core (6.x/7.x) gồm `wp-admin`, `wp-includes`, các file gốc.
  2. Parent Theme Flatsome 3.20.2 chính hãng.
  3. Child Theme chuyên biệt `flatsome-child-minhnganphutho` kế thừa toàn bộ tính năng bán ô tô điện từ `vinfasttanachill`.
  4. Bộ 10 plugins tiêu chuẩn + 3 custom plugins (`ai-writer`, `wp-insight`, `vinfast-template`).
  5. Cấu hình bảo mật phân tách qua `.env.example` và `wp-config.php.example`, ngăn chặn rò rỉ secret lên Git.
- **Hệ quả & Đánh giá rủi ro:**
  - *Thuận lợi:* Dự án có tính độc lập cao, không phụ thuộc vào cấu trúc máy dev cũ, sẵn sàng copy sang bất kỳ hosting nào (cPanel, DirectAdmin, Localhost) là có thể chạy ngay khi kết nối DB.
  - *Rủi ro & Kiểm soát:* Thư mục dự án sẽ lớn hơn so với Theme-only. Đã thiết lập `.gitignore` chuẩn WordPress để loại trừ uploads, backups, logs và file bí mật khỏi version control.
