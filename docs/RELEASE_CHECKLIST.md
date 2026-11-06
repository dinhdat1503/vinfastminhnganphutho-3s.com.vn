# Release Checklist — Go / No-Go

> Đây là checklist mẫu; chỉ đánh dấu khi có bằng chứng. Nếu không áp dụng ghi N/A và lý do.

## Source & provenance

- [ ] Code ở đúng branch/commit/tag; release build từ commit đó.
- [ ] Backup source + Git status verified; untracked files quan trọng đã được xét.
- [ ] Secret scan repository + git history liên quan; không chứa DB thật/credentials.
- [ ] Lockfile/versions tương thích runtime; build/start đã thử.

## Product & security

- [ ] Chức năng MVP hoàn thành theo acceptance; P0/P1 được xử lý hoặc release bị chặn.
- [ ] Auth/session/RBAC/IDOR/CSRF/rate limiting đã kiểm thử phù hợp.
- [ ] Thông báo rõ tính năng chưa cấu hình; không giả lập email/payment thật.
- [ ] Accessibility/browser E2E trên môi trường tương đương đã thực chạy.

## DB / ops

- [ ] Migrations đã thử trên DB staging / bản sao ẩn danh.
- [ ] Database persistent, backup nhất quán và restore test thành công.
- [ ] Rollback code/data plan có owner và điều kiện kích hoạt.
- [ ] HTTPS/DNS, health/readiness, monitoring/logging/alerts hoạt động.
- [ ] Environment secrets và billing/resource limit được phê duyệt.

## External integrations & go-live

- [ ] Payment/email/external provider đã được tích hợp thật nếu release đòi hỏi, hoặc được khóa hoàn toàn và công bố trạng thái.
- [ ] Smoke tests trên URL thật, bằng chứng API và browser.
- [ ] Chủ dự án phê duyệt cutover/production publish.

**Trạng thái:** `NOT STARTED | PREPARED | DEPLOYED | VERIFIED | BLOCKED`.
**Quyết định GO/NO-GO:** [Người duyệt, ngày, lý do].
