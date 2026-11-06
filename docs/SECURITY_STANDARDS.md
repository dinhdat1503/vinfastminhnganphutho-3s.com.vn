# Security Standards — Risk-based, Evidence-driven

## Baseline

- Threat model theo loại sản phẩm và assets: credentials, PII, payment, upload, quyền quản trị, webhook, database.
- Xác thực và phân quyền tại server. Mỗi endpoint nhạy cảm phải kiểm tra role + ownership + CSRF khi cần. Không tin frontend flag.
- Secrets nằm trong secret manager/env được quản lý; không ở Git, browser bundle, logs, docs, chat screenshots. Secret lộ phải được rotate, không chỉ xóa file.
- Session/cookie: HttpOnly, Secure cho HTTPS, SameSite và token lifetime phù hợp; bảo vệ login brute force, session fixation, logout/revocation.
- Input: allowlist, server-side validation, giới hạn file/size/rows, chống unsafe deserialization, path traversal, formula injection ở spreadsheet exports, XSS/SQL injection theo stack.
- External APIs/webhooks: xác thực nguồn, signature, time window, replay defense, idempotency, log an toàn, xử lý lỗi retry.
- Privacy: data minimization, retention, backup encryption/access, không dùng dữ liệu production trong test.
- Dependency supply chain: lockfile, thông tin provenance, kiểm tra CVE theo mức độ thực tế; không tự chạy script ZIP lạ.

## Safe Audit

Đọc source và chạy các test được phép trong sandbox. Không quét hoặc khai thác production, hệ thống của bên thứ ba, không thử bypass tài khoản thật. Mỗi finding phải ghi `evidence + impact + remediation + safe verification`. Không công bố payload hoặc bí mật nhạy cảm.

## Release NO-GO (ví dụ)

- P0 chưa khắc phục hoặc chưa có biện pháp chặn đáng tin.
- Quyền ADMIN có thể bị cấp từ client.
- Thanh toán/quyền lợi có thể giả mạo hoặc nhân đôi.
- Dữ liệu thật có nguy cơ mất do migration/backup chưa kiểm tra.
- Session/CSRF hoặc security guard bị tắt để hệ thống 'chạy được'.
