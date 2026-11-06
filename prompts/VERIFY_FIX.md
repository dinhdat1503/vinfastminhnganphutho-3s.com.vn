# PROMPT — Verify fix without endless loops

Finding ID: [ID]. Bug report/evidence: [MÔ TẢ]. Đã sửa ở commit/diff: [SHA/FILE].

Đọc AGENTS.md, finding trong `docs/audit/10_MASTER_FINDINGS.md`, docs/AI_HANDOFF.md. Kiểm chứng bằng đúng tình huống tái hiện đã nêu và regression quanh phạm vi sửa. Không refactor thêm để đẹp code.

Trả lời:
1. Bug cũ còn tái hiện không? Bằng chứng.
2. Fix có đúng root cause không, có rủi ro mới không?
3. Tests thật, commands, exit code, E2E nếu UI.
4. `DONE`, `BLOCKED`, hoặc `FAILED` với lý do.
5. Nếu DONE, đóng finding; không tự mở thêm một vòng polish.

Không commit/push/deploy hoặc sửa ngoài lỗi xác nhận khi chưa được duyệt. Dừng.
