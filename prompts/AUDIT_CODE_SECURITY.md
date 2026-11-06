# PROMPT — CODE, ARCHITECTURE, SECURITY & DATABASE AUDIT

Chế độ **AUDIT ONLY**. Đọc AGENTS.md, docs/AUDIT_METHOD.md, CODE_STANDARDS.md, SECURITY_STANDARDS.md, TEST_STRATEGY.md và source thực tế.

- Kiểm kê data flows theo user journeys, frontend/backend API contracts, architecture boundaries, duplicated/hardcoded business logic, DB migrations/indexes, state/cache, concurrency/error handling.
- Xác minh auth/session/RBAC/IDOR/CSRF, validation, SSRF/XSS/injection/upload, secrets, webhook/payment nếu có, data integrity/transactions, backup, negative tests. Không khai thác hệ thống thật.
- Chạy lệnh build/tests có thật **chỉ khi an toàn và được phép**, ghi exit code; không dùng mock pass hoặc sửa tests.
- Liệt kê các vấn đề có file:line/bước tái hiện, severity, confidence, impact, fix nhỏ nhất và acceptance; ghi phần chưa xác minh.
- Phân biệt bug thực tế với pattern preference, finding không trùng.

Bàn giao `docs/audit/04_CODE_QUALITY_AUDIT.md`, `05_SECURITY_AUDIT.md`, `06_DATABASE_AUDIT.md`, `10_MASTER_FINDINGS.md` hoặc báo cáo bổ sung nếu đã có. Không sửa source, commit, push, deploy; dừng chờ duyệt.
