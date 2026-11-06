# Test Strategy — Test theo rủi ro, không theo số lượng

## Test pyramid phù hợp dự án

- Unit: pure business logic, validation, formatting, timezone/number edge cases.
- Integration: API–DB, auth/RBAC, transactions, provider adapters với sandbox.
- E2E: top user journeys, negative cases, responsive and accessibility states.
- Non-functional: performance, recovery, error handling, concurrency khi có rủi ro thực tế.

## Test case specification

`ID | user journey | precondition | data | action | expected behavior | invariant | environment | evidence | result`

- Luôn có happy path + input lỗi + unauthorized + data boundary cho luồng quan trọng.
- Kiểm chứng real browser là riêng với snapshot/CSS/static review.
- Phân biệt test fixtures với production; không tự gọi 100% coverage là 100% đúng.
- Test pass phải có command, exit code, test count, ngày/môi trường. Test không chạy phải là NOT RUN.
- Với thay đổi UI: keyboard, small viewport, overflow, click/drag/touch thật (khi tool hỗ trợ), loading/error state.
- Với thay đổi tiền/quan hệ dữ liệu: transaction, idempotency, rounding, negative cases, invariants, replay/duplicate, rollback, history immutability.

## Quality bar

Yêu cầu acceptance có thể quan sát được, mỗi bug fix có regression test phù hợp. Không thêm test giả chỉ để tăng số lượng, không skip hoặc sửa assertions để che lỗi.
