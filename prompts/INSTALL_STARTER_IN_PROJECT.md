# PROMPT — Gắn AI Project Starter V2 vào dự án bất kỳ

Tôi đã cung cấp bộ **AI_PROJECT_STARTER_V2** và source dự án hiện tại (ZIP hoặc repository).

MỤC TIÊU: Giúp coding agent có quy tắc nhất quán từ hôm nay trở đi, không phải viết lại AGENTS.md, không làm mất file hiện có.

**Mode: PLAN ONLY / SAFE BOOTSTRAP.**

1. Xác định chính xác thư mục gốc của dự án, loại framework, có/không có Git, file nào đang tồn tại; bảo toàn tracked + untracked và mọi secrets.
2. Nếu code là ZIP, kiểm tra và giải nén trong workspace riêng an toàn; không tự chạy scripts từ ZIP.
3. So sánh `AGENTS.md`, `README.md`, `docs/*`, `prompts/*` đã tồn tại với starter mới. **KHÔNG ghi đè file trùng tên**. Nếu có collision, trình bày khác biệt và đề xuất cách merge; chờ xác nhận trước khi thay đổi.
4. Với file chưa tồn tại, có thể đề xuất chép nguyên template V2 không chỉnh business logic. **Mọi nội dung riêng dự án** điền vào `docs/PROJECT_PLAN.md`, `docs/AI_HANDOFF.md` sau khi đọc source; không sửa các quy tắc chung chỉ để thêm tên dự án.
5. Không mang tên miền/giá/stack/secret/module của dự án cũ sang dự án mới.
6. Nếu đây là dự án mới, chọn `prompts/START_PROJECT.md`. Nếu đã có code, chọn `prompts/AUDIT_FULL_PROJECT.md` để audit trước.
7. Báo cáo file muốn tạo/sửa, những xung đột, phương án backup và một hành động tiếp theo; không tự commit/push/deploy.

KẾT THÚC THÌ DỪNG CHỜ TÔI DUYỆT.
