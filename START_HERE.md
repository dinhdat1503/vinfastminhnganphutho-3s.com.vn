# START HERE — Chọn đúng quy trình

## A — Dự án mới từ số 0

1. Copy bộ kit vào repo trống.
2. Mở `prompts/START_PROJECT.md`; điền tên, mục tiêu, giới hạn (có thể để `[CHƯA BIẾT]`).
3. AI điền `docs/PROJECT_PLAN.md`, đề xuất kiến trúc cân đối ngân sách, tạo roadmap ngắn, **dừng**.
4. Duyệt một Slice, gửi `prompts/NEXT_SLICE.md` mỗi lần. Update `docs/AI_HANDOFF.md` sau Slice.

## B — Dự án cũ có source hoặc file ZIP muốn kiểm toán toàn diện

1. Sao lưu ZIP gốc; giải nén an toàn trong workspace riêng.
2. Copy starter vào repo (không ghi đè `AGENTS.md` có sẵn).
3. Gửi `prompts/AUDIT_FULL_PROJECT.md` yêu cầu chế độ **AUDIT ONLY**.
4. AI phải đọc đầy đủ code trong phạm vi hoặc lập danh sách chưa xem, thu thập bằng chứng, không gán PASS tùy ý.
5. Nhận báo cáo `docs/audit/00_...12_...`; kiểm tra top findings có dẫn chứng.
6. Gửi `prompts/ROADMAP_FROM_AUDIT.md` để gộp trùng, ưu tiên P0/P1, tạo các Slice hữu hạn và điểm dừng.

## C — Chỉ muốn nâng cấp UI/UX, nhiều animation

- Gửi `prompts/AUDIT_UI_UX.md` để phân tích toàn bộ màn hình và đề xuất thiết kế có thông số khả thi.
- Duyệt màn hình/định hướng, rồi gửi `prompts/IMPLEMENT_UI_SLICE.md` cho **một màn hình hoặc nhóm nhỏ**.
- Animation phải có `prefers-reduced-motion`, hiệu suất mobile, hỗ trợ bàn phím và trạng thái loading/empty/error.

## D — Chỉ muốn code, bảo mật hoặc DevOps chuyên nghiệp

- Gửi `prompts/AUDIT_CODE_SECURITY.md` hoặc `prompts/AUDIT_DEVOPS.md`.
- Khi báo cáo đạt, `prompts/ROADMAP_FROM_AUDIT.md` giúp ưu tiên thay đổi thực sự cần thiết.

## E — Muốn nối tiếp ở AI chat mới

1. Đảm bảo `docs/AI_HANDOFF.md` phản ánh branch, commit, thay đổi chưa commit, tests đã chạy và blocker.
2. Gửi `prompts/CONTINUE_SESSION.md`.
3. Đừng yêu cầu AI “tiếp tục mọi thứ” mà không có đúng Slice hoặc gate.

## F — Chuẩn bị production

1. Chốt source/backup trước khi chuyển hạ tầng.
2. Đọc `docs/RELEASE_CHECKLIST.md` và gửi `prompts/RELEASE_DEPLOY.md`.
3. Phân biệt `BUILD PASS`, `DEPLOYED`, `PRODUCTION VERIFIED`.
4. Cấu hình secrets ngoài repository, thử restore backup và rollback, thực hiện qua cổng phê duyệt.

## Mẫu câu ngắn dùng mỗi ngày

> Đọc AGENTS.md và docs/AI_HANDOFF.md, xác định Git/source thực tế. Tiếp tục **đúng một** nhiệm vụ tôi yêu cầu, không sửa ngoài phạm vi; chạy gates liên quan và dừng chờ duyệt.
