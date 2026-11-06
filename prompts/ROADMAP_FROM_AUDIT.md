# PROMPT — Chốt roadmap hữu hạn từ báo cáo kiểm toán

Đọc AGENTS.md, docs/PROJECT_PLAN.md, docs/audit/10_MASTER_FINDINGS.md, docs/audit/11_IMPROVEMENT_ROADMAP.md và các tài liệu có liên quan. Nếu chưa có findings, không tự tạo issue vô căn cứ.

MỤC TIÊU: duyệt lại mức độ P0/P1, gộp findings trùng, xem tính phụ thuộc, tránh refactor/redesign toàn bộ khi không cần.

Phân chia:
- `MUST BEFORE RELEASE`: P0/P1 thực sự cần chặn production.
- `HIGH VALUE NEXT`: UX/code quality có giá trị và chi phí hợp lý.
- `ACCEPTED / LATER`: P2/P3 có thể không làm.
- `EXTERNAL INTEGRATION PENDING`: cần credentials/provider/approval, không sửa mã liên tục.

Mỗi Slice có `ID, outcome, prerequisites, scope, out-of-scope, likely files, tests, Definition of Done, owner approval, stop condition`. Chốt `FUNCTIONAL COMPLETE`, `READY FOR FINAL INTEGRATION`, `PRODUCTION VERIFIED` khác nhau.

Không tự implement. Tạo roadmap ưu tiên có điểm cuối, cập nhật docs/PROJECT_PLAN.md hoặc docs/audit/11_IMPROVEMENT_ROADMAP.md nếu được phép. Chọn đúng **một** Slice tiếp theo và dừng chờ phê duyệt.
