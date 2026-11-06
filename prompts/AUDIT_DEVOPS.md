# PROMPT — DEVOPS, CI/CD & PRODUCTION READINESS AUDIT

Chế độ **AUDIT ONLY**. Đọc AGENTS.md, docs/DEVOPS_STANDARDS.md, docs/RELEASE_CHECKLIST.md và source/configs thực tế.

Kiểm tra: Git/branch/commit/source provenance, ignored/untracked, lockfile, reproducible build, CI jobs/test gates, artifact, runtime deps/start, ports, Docker images, cloud options, HTTP/HTTPS, CORS/cookie proxy, health/readiness, DB persistence, migration timing, backup consistency, restore, logging/monitoring, secrets, RPO/RTO khi có, rollback và billing limits.

Đưa phương án hạ tầng tối thiểu phù hợp cost/scale có trade-offs, không mặc định phải Kubernetes hoặc microservices.

Với từng finding: `OPS-ID`, severity, evidence file/line hoặc runtime, risk, remediation, verification, approval gate. Phân biệt PREPARED và DEPLOYED. Không tự tạo cloud resources, đăng ký domain, upgrade plan, push, migrate production, hoặc deploy.

Xuất `docs/audit/08_DEVOPS_AUDIT.md` và các findings liên quan vào `10_MASTER_FINDINGS.md`. Đưa checklist GO/NO-GO và dependency list, dừng chờ duyệt.
