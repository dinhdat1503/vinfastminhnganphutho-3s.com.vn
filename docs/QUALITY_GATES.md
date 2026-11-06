# QUALITY GATES — CHUẨN KIỂM THỬ CHUNG

> Áp dụng theo mức độ rủi ro; không bắt dự án nhỏ chạy các công cụ không có. Mọi kết quả phải trung thực: `PASS` / `FAIL` / `NOT RUN` / `BLOCKED`.

| Gate | Bắt buộc kiểm tra | Bằng chứng cần báo |
|---|---|---|
| G0 Baseline | Branch, HEAD, modified + untracked files | `git status --short`, phạm vi thay đổi |
| G1 Scope | Chỉ sửa file liên quan một Slice | Diff và giải thích file ngoài dự kiến |
| G2 Logic | Unit + integration + regression | Lệnh chạy, số bài test, exit code |
| G3 Build | Typecheck/build/lint nếu có | Script thực tế và kết quả |
| G4 Security | Auth, RBAC, validation, secret, PII | Test trường hợp từ chối/lỗi |
| G5 Data | DB transaction, rollback, concurrency, migration nếu liên quan | Test và kế hoạch backup/rollback |
| G6 Visual | Browser thật cho thay đổi UI | Viewport, screenshots, tương tác |
| G7 Integration | API và provider/sandbox nếu liên quan | Request/response thật, giới hạn môi trường |
| G8 Review | `git diff --check`, tự review | Bằng chứng, rủi ro còn lại |
| G9 Docs | Handoff, plan, decisions | File đã cập nhật |
| G10 Approval | Chủ dự án duyệt | `CHỜ DUYỆT` nếu chưa nhận |

## Mức độ nghiệm thu

- **Unit PASS** không có nghĩa là **browser PASS**.
- **Integration PASS với fixture** không có nghĩa là **production verified**.
- **UI screenshot** không chứng minh mọi chức năng nghiệp vụ đúng.
- **Build PASS** không chứng minh tính đúng đắn của số tiền/quyền truy cập.
- **Nghiệm thu của chủ dự án** là bước riêng, không được AI tự tuyên bố đã duyệt.

## Mức ưu tiên lỗi

- **P0:** Mất dữ liệu, sai quyền nghiêm trọng, cấp quyền/số dư không hợp lệ, lộ secret, rủi ro thanh toán trực tiếp. NO-GO.
- **P1:** Luồng chính bị chặn, kết quả nghiệp vụ sai, không phục hồi được thao tác quan trọng. Thường NO-GO.
- **P2:** Lỗi UI/UX hoặc chức năng phụ có giải pháp tạm chấp nhận được.
- **P3:** Cải tiến/điều chỉnh nhỏ không ảnh hưởng chức năng chính.

## Browser E2E tối thiểu (khi có UI)

1. Tải trang, không có lỗi Console nghiêm trọng.
2. Một luồng thành công, một luồng lỗi, một luồng không có dữ liệu.
3. Đăng nhập và quyền truy cập nếu có auth.
4. Modal/Drawer, bàn phím, ESC, focus, aria-label.
5. Viewport tham khảo: 320×700; 390×844; 768×1024; 1366×768; 1440×900.
6. Ảnh chụp thực **từ ứng dụng** (không phải mockup) và môi trường test được ghi rõ.

## Release GO / NO-GO

**Beta GO:** Không có P0, các luồng MVP chính có bằng chứng chạy, giới hạn được ghi rõ.

**Production GO:** Thêm bảo mật, dữ liệu/migration, backup-restore đã thử, HTTPS, monitoring, alerting, secrets, nghiệm thu tích hợp thật nếu có; chủ dự án phê duyệt rõ.

**NO-GO:** Lỗi P0 chưa khắc phục, không biết nguồn dữ liệu quyền lợi/tiền, không có phương án khôi phục, hoặc chỉ có mô phỏng mà tuyên bố vận hành thật.
