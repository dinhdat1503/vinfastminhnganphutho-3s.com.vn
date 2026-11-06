# PROMPT — UI/UX DEEP AUDIT & MOTION DESIGN (AUDIT ONLY)

Tôi muốn đánh giá và đề xuất thiết kế UI/UX toàn diện từ source và browser hiện có; **chưa code, chưa chỉnh ảnh**.

Đọc AGENTS.md, docs/PROJECT_PLAN.md, docs/UI_UX_STANDARDS.md và docs/AUDIT_METHOD.md. Kiểm kê mọi route/page/modal/drawer. Nếu browser có thể chạy an toàn, chụp screenshot desktop/mobile tại các viewport 320/390/768/1024/1366/1440 và thử tương tác; nếu không, ghi STATIC REVIEW / NOT RUN.

Đánh giá: information architecture, business goal, conversion funnel, visual hierarchy, design tokens, spacing/typography/colors, layout/grid, responsive, touch/keyboard, WCAG 2.2 AA, forms/errors, skeletons, navigation, scroll behavior, dark mode nếu có.

Đặc biệt đề xuất hệ thống **animation/microinteractions hiện đại và có chủ đích**:
- Hover/press/focus, buttons, loading, tabs, cards, modal/drawer, page transition, scroll reveals, swipe/drag (nếu phù hợp), feedback và reduced motion.
- Ghi trigger, property (ưu tiên transform/opacity), duration/easing, trạng thái vào/ra, mobile/battery cost, no-motion fallback; không lạm dụng animation.

Bàn giao theo từng screen: `SCREEN-ID`, current, vấn đề có bằng chứng, nên giữ, target layout desktop/tablet/mobile, component specs, interaction states, motion specs, accessibility, priority P0..P3, implementation notes, acceptance.

Lập một **UI Redesign Blueprint** đủ chi tiết để AI coding agent có thể triển khai từng màn hình. Mô tả data/API states; không dựng màn hình hoạt động giả khi backend chưa có.

Tạo `docs/audit/03_UI_UX_AUDIT.md` và `docs/audit/UI_REDESIGN_BLUEPRINT.md` (chỉ khi được phép ghi tài liệu). Không sửa source; dừng chờ duyệt.
