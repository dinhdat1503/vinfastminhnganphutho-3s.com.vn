# PROMPT — TIẾP TỤC ĐÚNG MỘT SLICE (IMPLEMENT ONE SLICE) (IMPLEMENT ONE SLICE)

Tiếp tục dự án **[TÊN DỰ ÁN]** tại repository hiện tại.

**TASK:** [SLICE-ID] — [MỤC TIÊU CỤ THỂ]
**Baseline báo cáo:** [SỐ TESTS / BUILD / CÁC SLICE TRƯỚC]
**Điều tôi muốn nghiệm thu:** [HÀNH VI QUAN SÁT ĐƯỢC]
**Không được thay đổi:** [FILE/MODULE/DỮ LIỆU]

Quy trình bắt buộc:

1. Đọc AGENTS.md, docs/PROJECT_PLAN.md, docs/AI_HANDOFF.md, docs/QUALITY_GATES.md và docs/DECISIONS.md.
2. Kiểm tra Git branch, HEAD, `git status --short`, diff và untracked files; bảo toàn toàn bộ thay đổi chưa commit.
3. Đọc source và API/schema/test thực tế; không đoán tên file, dữ liệu hoặc script.
4. Xác nhận đúng phạm vi một Slice; ghi assumptions và dependencies.
5. Triển khai tối thiểu, an toàn; không tạo mock thành công giả hoặc sửa nghiệp vụ ngoài phạm vi.
6. Chạy tests, typecheck/build và security checks có liên quan. Nếu Slice thay đổi UI, kiểm tra browser thật, ảnh chụp desktop/mobile; nếu không chạy được ghi NOT RUN.
7. Chạy `git diff --check`, tự review thay đổi, cập nhật docs/AI_HANDOFF.md.
8. Báo cáo file đã sửa, kết quả từng gate, lỗi/giới hạn, đề xuất đúng một Slice tiếp theo.

Không reset/clean/stash làm mất trạng thái. Không commit/push/merge/deploy nếu tôi chưa yêu cầu. **Hoàn thành thì DỪNG CHỜ DUYỆT.**

**V2:** Nếu Slice đến từ audit, nêu Finding ID và đọc `docs/audit/10_MASTER_FINDINGS.md` cùng `templates/SLICE_PLAN.md`. Chỉ sửa lỗi có evidence và báo Definition of Done, không phát sinh vòng sửa vô hạn.

**V2:** Nếu Slice đến từ audit, nêu Finding ID và đọc `docs/audit/10_MASTER_FINDINGS.md` cùng `templates/SLICE_PLAN.md`. Chỉ sửa lỗi có evidence và báo Definition of Done, không phát sinh vòng sửa vô hạn.
