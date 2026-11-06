# DevOps & SRE Standards — Deployment có thể tái hiện

## Source control

- Reproducible commit, branch/version/tag rõ; kiểm tra tracked + untracked, secrets trước push.
- Không `reset --hard`, `clean -fd`, force push hoặc merge khi chưa được phê duyệt.
- Không bắt buộc mọi dự án phải dùng GitFlow; chọn chiến lược đơn giản vừa đủ.

## CI/CD

- Mọi merge/release chạy lint/typecheck, tests, build theo stack; có provenance/artifact, không build trực tiếp từ worktree không kiểm soát.
- Production có approval gates, secrets tách repo, bảo vệ môi trường và permission tối thiểu.
- Không cho bypass tests/security chỉ để nhanh deploy.

## Hosting & Runtime

- Giải thích lựa chọn VPS/PaaS/serverless theo workload, stateful DB, scale và chi phí; không mặc định cần Kubernetes.
- Runtime không phụ thuộc devDependency khi production install bỏ devDeps; xác minh start command qua mô phỏng prod.
- HTTP app bind đúng port/interface; health vs readiness tách khi cần; graceful shutdown và request timeout.
- HTTPS, domain/DNS, CORS/cookie/CSRF/trust proxy, cache của API có auth, quan sát lỗi client/server.
- Persistent DB/storage, chiến lược migration phù hợp runtime; **build-time không tự động có volume** trên mọi PaaS.

## Data/Backup/Recovery

- Backup nhất quán theo DB engine, lưu bản độc lập ngoài nơi dữ liệu chính, kiểm tra checksum/integrity và thử restore cô lập.
- Rollback app ≠ rollback DB; không tự phục hồi DB cũ lên dữ liệu mới phát sinh nếu chưa đối soát.
- Có RPO/RTO mục tiêu khi dự án thực sự có yêu cầu SLA.

## Monitoring & Cost

- Logs có context, metrics health/latency/error, alert kịp thời, không chứa PII hoặc tokens.
- Tài nguyên cloud, payment provider, domain/DNS, migration production và feature flag mở giao dịch phải được chủ dự án phê duyệt.
- Tách `PREPARED`, `DEPLOYED`, `PRODUCTION VERIFIED`, `BUSINESS INTEGRATION VERIFIED`; không đánh đồng.
