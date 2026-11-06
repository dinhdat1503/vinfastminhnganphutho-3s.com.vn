# Code & Architecture Standards — Nguyên tắc thực dụng

## Architecture

- Tập trung vào nghiệp vụ đã xác định; ưu tiên **modular monolith** cho sản phẩm nhỏ/trung bình, không mặc định microservices/Kubernetes.
- Không trùng nguồn sự thật. Client state khác server-authoritative state; policy/config có nguồn, phiên bản và ngày hiệu lực nếu thay đổi theo thời gian.
- Phụ thuộc có hướng, component/service đặt ranh giới rõ. Chỉ trừu tượng hóa khi có lặp lại thực tế và lợi ích bảo trì.
- Kết quả nghiệp vụ quan trọng phải có đơn vị, timezone, precision/rounding và invariant minh bạch.

## Frontend

- Tránh component quá nhiều trách nhiệm; tách UI, business logic, remote state và validation khi có bằng chứng khó bảo trì.
- Tối ưu UX: optimistic UI chỉ khi có rollback và nguồn thật; loading/empty/error/retry, abort race, keyboard and accessibility.
- Không lưu token, secret hoặc quyền server trong client storage làm nguồn tin cậy. Đánh giá ảnh hưởng của localStorage dùng chung máy/tài khoản.
- Dynamic import/code splitting khi đo được lợi ích; không thêm thư viện state chỉ vì xu hướng.

## Backend/API

- Authentication và authorization tách rõ; server kiểm tra object ownership và role cho **từng endpoint**.
- Validate input ở boundary, giới hạn page/file/payload, allowlist DTO, xử lý errors không lộ stack/secrets.
- HTTP methods/status đúng, timeouts/retries có giới hạn, webhook idempotency và xác minh chữ ký nếu áp dụng.
- Có transaction/unique constraint/optimistic locking cho nghiệp vụ đồng thời quan trọng.

## Database

- Tài liệu hóa schema, index theo query thực tế, unique constraints, migration forward-only (đánh giá rollback), backup/restore thử được.
- Không chạy destructive migration trên production khi chưa có backup/phê duyệt.

## Maintainability & Review

- Dùng formatter/linter/typecheck của repo, naming nhất quán, không disable tests/typecheck để 'làm xanh'.
- Test trọng tâm theo rủi ro. Refactor luôn đi kèm điều kiện giữ hành vi và regression.
- Code review hỏi: vì sao thay đổi, tác động user, lỗi biên, bảo mật, migration, compatibility, tests, cách rollback.
- Không dùng số dòng, % coverage hoặc số file như thước đo chất lượng duy nhất.
