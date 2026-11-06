# PROMPT — Release & Deployment với cổng an toàn

Mode: `RELEASE`, không phát triển tính năng. Đọc AGENTS.md, docs/PROJECT_PLAN.md, docs/QUALITY_GATES.md, docs/RELEASE_CHECKLIST.md, docs/DEVOPS_STANDARDS.md, docs/AI_HANDOFF.md.

Phạm vi/phương án hạ tầng được duyệt: [HOSTING/DB/DOMAIN]. Version/commit: [SHA].

Gates theo thứ tự:
1. **Source:** backup có thể phục hồi, commit/branch đúng, secret scan, dependency/runtime check.
2. **Build:** reproducible build & tests từ chính commit release.
3. **DB:** migrations rehearsal, backup nhất quán + restore test, persistent storage, rollback data plan.
4. **Infra:** chi phí/region/replicas/volume/port, domain DNS/HTTPS, reverse proxy, cookies/CORS/CSRF/health/readiness, secrets.
5. **Deployment:** chỉ thực thi sau approval tương ứng; không tự mua cloud, thay DNS hoặc mở paid integrations.
6. **Post-deploy:** smoke tests trên URL thật, logs/monitoring, restart persistence, security, backup/rollback.

Mọi Gate ghi `PASS / FAIL / NOT RUN / BLOCKED`, lệnh & bằng chứng. Nếu thiếu cloud access, báo cần phê duyệt hoặc thao tác UI chính xác, không tuyên bố deployed.

Không đưa secrets vào frontend, screenshots, repo hoặc báo cáo. Không chạy E2E ghi dữ liệu thật trên DB production. Nếu payment/email chưa cấu hình phải khóa an toàn, không giả lập fulfillment.

Bàn giao deploy runbook, actual URL/status, commit, rollback, outstanding dependencies. **Đạt release gates thì dừng; không tự refactor product.**
