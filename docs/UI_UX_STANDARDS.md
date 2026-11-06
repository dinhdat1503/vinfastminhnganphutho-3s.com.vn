# UI/UX Standards — Professional, Responsive, Motion-aware

## 1. Design audit per screen

Với từng màn: mục tiêu, vai trò, đường vào, task chính, thứ tự thông tin, CTA chính/phụ, form và feedback, mobile, accessibility, lỗi, conversion friction, giữ/đổi. Chụp ảnh runtime khi có quyền; không chỉ đánh giá từ CSS.

## 2. Design tokens

Ưu tiên dùng hệ thống đang có: semantic colors, typography scale, spacing, radius, elevation, component states, icon size, z-index, breakpoints. Không áp màu/tông thương hiệu mới nếu chưa được duyệt. Ghi rõ token đề xuất trước khi redesign.

## 3. Components/states

- Button: normal/hover/focus/pressed/loading/disabled; phân biệt CTA chính và secondary, tránh giả disabled chỉ bằng opacity.
- Form: label thật, helper text, inline validation, keyboard, autocomplete, thông báo lỗi có cách khắc phục; lưu nháp khi thao tác dễ mất dữ liệu.
- Modal/drawer: focus trap, ESC/close, scroll control, không che nội dung màn hình nhỏ.
- Table: horizontal overflow có chủ ý hoặc card view mobile, sort/filter/page trạng thái server hợp lệ.
- Data UX: empty/error/skeleton/success/unauthorized, timezone, units, nguồn xác minh, trạng thái cache/outdated.

## 4. Responsive/a11y

Kiểm tra breakpoint đại diện theo sản phẩm, ví dụ 320, 375/390, 768, 1024, 1366, 1440. Touch target phù hợp, không tràn ngang, không cắt chữ, zoom đến 200%, keyboard tab order, visible focus, semantic labels, contrast WCAG 2.2 AA khi khả thi.

## 5. Motion & Microinteractions (khi phù hợp thương hiệu)

Lập **Motion Inventory** cho: page transitions, reveal-on-scroll, tabs, hover, press feedback, modals/drawers, toast, loading/skeleton, drag/swipe (nếu thực sự có task).

Với mỗi hiệu ứng khai báo: trigger, đối tượng, duration (định hướng ~120–250ms microinteraction; ~250–450ms chuyển cảnh, phải đo và tinh chỉnh), easing, transform/opacity, accessibility fallback, mobile perf và cách tắt.

- Tôn trọng `prefers-reduced-motion: reduce` (giảm hoặc loại bỏ hoạt ảnh không thiết yếu).
- Tránh animation vô hạn lôi kéo chú ý, parallax gây khó đọc, scroll hijacking, animation layout gây giật.
- Ưu tiên composited transforms/opacity, không animation trên hàng nghìn item hoặc dữ liệu dài.
- **Không phải trang nào cũng cần animation nhiều**; ưu tiên task completion và hiệu suất.

## 6. Deliverable chuyên nghiệp

Cho từng screen ghi: `SCREEN-ID`, vấn đề có bằng chứng, current flow, target flow, wireframe dạng văn bản, component list, responsive behavior, motion spec, validation states, a11y, acceptance criteria, không tự code nếu còn ở AUDIT ONLY.

Ưu tiên bổ sung/giữ nguyên phần UI đang đạt; không redesign toàn bộ chỉ vì template khác đẹp hơn.
