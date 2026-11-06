# PROMPT — Implement một UI/UX Slice đã duyệt

TASK: [UI-ID] — [1 màn hình/nhóm nhỏ]
Nguồn chuẩn: AGENTS.md, docs/UI_UX_STANDARDS.md, docs/PROJECT_PLAN.md, docs/AI_HANDOFF.md, docs/audit/UI_REDESIGN_BLUEPRINT.md nếu có.

Mục tiêu có thể quan sát: [CHI TIẾT]. Design direction đã duyệt: [TOKEN/MOCKUP/REFERENCE]. Ngoài phạm vi: [CÁC MODULE CHƯA ĐƯỢC SỬA].

Trước code: xác minh real API/data/status; Git baseline, untracked files. Giữ lại các phần UI đang tốt, không tự redesign toàn app.

Triển khai:
- Responsive mobile/tablet/desktop; component states: loading, error, empty, success, disabled.
- Motion microinteractions có thông số duration/easing và reduced-motion fallback, tránh scroll hijack.
- A11y semantic labels/keyboard/focus/contrast; không fake success hoặc fake backend data.
- Không sửa business logic/API/DB không thuộc phạm vi.

Kiểm thử thật: browser interactions, screenshots viewport đại diện, keyboard, overflow, network failures, unit/build/regression liên quan; ghi NOT RUN nếu thiếu browser.

Bàn giao file sửa, screenshots, gates, before/after, risks. Cập nhật AI_HANDOFF, **dừng chờ duyệt**. Không tự commit/push/deploy.
