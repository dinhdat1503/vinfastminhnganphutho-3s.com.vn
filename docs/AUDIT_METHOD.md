# Audit Method — Quy tắc kiểm toán có chứng cứ

## Chế độ

**AUDIT ONLY** không sửa code, schema, dependencies, deployment, Git. Chỉ tạo/điều chỉnh báo cáo trong `docs/audit/` nếu quyền ghi được cho phép. Nếu chưa được phép test an toàn, dùng static analysis và ghi NOT RUN.

## 5 bước xác minh

1. **Map toàn repo:** manifest, framework, code roots, external integration, DB/schema, CI, deploy, phân vai; lưu danh sách file không đọc được.
2. **Trace critical user journeys:** UI → API → auth/permission → service → DB/provider → output/error. Khác biệt giữa mock và production phải được làm rõ.
3. **Evidence:** file path + line range hoặc mô tả logic/bước tái hiện, lệnh test và exit code; ảnh runtime chỉ khi thật sự chụp.
4. **Triangulate:** kiểm tra nhận định bằng test, runtime, docs chính thức hoặc logic thực tế. Chưa chứng minh ⇒ `NOT VERIFIED`.
5. **Prioritize:** phân loại và giải pháp ít phá vỡ nhất; đề xuất finite roadmap có Definition of Done.

## Mức độ & độ tin cậy

| Level | Khi nào | Quyết định |
|---|---|---|
| P0 | Rủi ro hiện hữu về mất dữ liệu, truy cập trái phép nghiêm trọng, tiền/quyền lợi sai hoặc không thể vận hành | Block release |
| P1 | Luồng cốt lõi hỏng/rủi ro nghiệp vụ cao được xác minh | Ưu tiên trước release |
| P2 | Dễ dùng, maintainability, hiệu suất vừa phải, thiếu test không tới ngưỡng P1 | Cân nhắc theo ROI |
| P3 | Optional/polish/nâng cấp dài hạn | Backlog hoặc chấp nhận |

`CONFIRMED`: tái hiện hoặc có bằng chứng trực tiếp. `HIGH/MEDIUM/LOW`: suy luận tĩnh có mức độ tin cậy tương ứng. Không tự gọi P0 chỉ vì chưa dùng một framework cụ thể.

## Trạng thái

- `PASS`: có thử nghiệm hoặc căn cứ trực tiếp.
- `FAIL`: bài kiểm tra có lỗi hoặc hành vi sai được xác minh.
- `NOT RUN`: không thực hiện.
- `BLOCKED`: thiếu quyền, môi trường, data hoặc blocker.
- `NOT VERIFIED`: không đủ bằng chứng khẳng định.
- `NOT APPLICABLE`: không liên quan đến loại dự án.

## Chứng cứ tối thiểu cho finding

`ID | category | classification | severity | confidence | file:line | repro / evidence | user impact | recommended fix | acceptance | verification | status`

**Tách số liệu thật khỏi ví dụ.** Không tự báo Lighthouse 95, 100% coverage, X bài E2E PASS hoặc compliant nếu chưa có artifact. Không tự sử dụng dịch vụ bên ngoài hoặc quét hệ thống công khai nếu không có quyền.

## File báo cáo tạo sau khi audit

```text
docs/audit/
00_EXECUTIVE_SUMMARY.md
01_PROJECT_ARCHITECTURE.md
02_FUNCTIONAL_INVENTORY.md
03_UI_UX_AUDIT.md
04_CODE_QUALITY_AUDIT.md
05_SECURITY_AUDIT.md
06_DATABASE_AUDIT.md
07_TESTING_AUDIT.md
08_DEVOPS_AUDIT.md
09_PERFORMANCE_AUDIT.md
10_MASTER_FINDINGS.md
11_IMPROVEMENT_ROADMAP.md
12_AI_HANDOFF.md
```

Không cần tạo file rỗng; phần không áp dụng phải nói rõ lý do. Các mẫu có sẵn tại `templates/`.
