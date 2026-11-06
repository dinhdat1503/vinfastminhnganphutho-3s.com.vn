# VinFast Minh Ngân Phú Thọ — 3S Website

Website đại lý ô tô điện VinFast Minh Ngân Phú Thọ chuẩn 3S (Sales - Service - Spare parts) xây dựng trên nền tảng WordPress & Theme Flatsome.

## 1. Cấu trúc thư mục

```
vinfastminhnganphutho-3s.com.vn/
├── wp-admin/                                  ← WordPress Admin Core
├── wp-includes/                               ← WordPress Includes Core
├── wp-content/
│   ├── themes/
│   │   ├── flatsome/                          ← Parent Theme Flatsome (UX Builder)
│   │   └── flatsome-child-minhnganphutho/     ← Child Theme VinFast Minh Ngân Phú Thọ 3S
│   │       ├── assets/                        ← CSS/JS/Images của đại lý
│   │       ├── template-parts/                ← Header, Footer, Subnav các dòng xe
│   │       ├── woocommerce/                   ← Giao diện đặt cọc xe
│   │       ├── functions.php                  ← CPT car_model, ACF, AJAX, shortcodes
│   │       ├── page-home.php                  ← Trang chủ đại lý 3S
│   │       ├── page-du-toan.php               ← Dự toán chi phí lăn bánh
│   │       ├── page-tra-gop.php               ← Dự toán vay trả góp
│   │       └── style.css                      ← CSS Design System (#2563EB)
│   ├── plugins/                               ← 10 Plugins tiêu chuẩn + 3 Custom Plugins
│   │   ├── advanced-custom-fields/
│   │   ├── woocommerce/
│   │   ├── contact-form-7/
│   │   ├── smart-slider-3/
│   │   ├── popup-maker/
│   │   ├── wp-mail-smtp/
│   │   ├── ai-writer/                         ← Custom: Sinh bài viết tự động
│   │   ├── wp-insight/                        ← Custom: Phân tích chỉ số
│   │   └── vinfast-template/                  ← Custom: Template xe điện
│   └── uploads/                               ← Tài nguyên đa phương tiện
├── docs/                                      ← Tài liệu kiến trúc, kế hoạch & audit
├── .env.example                               ← Mẫu cấu hình môi trường bảo mật
├── wp-config.php.example                      ← Mẫu cấu hình WordPress
└── .gitignore                                 ← Quy tắc bảo mật mã nguồn
```

## 2. Hướng dẫn khởi chạy dự án

1. **Chuẩn bị môi trường:** Máy chủ web hỗ trợ PHP 7.4+ hoặc PHP 8.1+, MySQL 5.7+ hoặc MariaDB 10.3+.
2. **Cấu hình môi trường:**
   - Sao chép `.env.example` thành `.env` và cập nhật thông số kết nối CSDL (DB_NAME, DB_USER, DB_PASSWORD, DB_HOST).
   - Sao chép `wp-config.php.example` thành `wp-config.php`.
3. **Kích hoạt Giao diện:**
   - Đăng nhập trang quản trị WordPress (`/wp-admin`).
   - Vào mục **Giao diện → Giao diện (Appearance → Themes)**, kích hoạt theme **Flatsome Child - VinFast Minh Ngân Phú Thọ 3S**.
4. **Kích hoạt Plugins:**
   - Kích hoạt các plugin bắt buộc: Advanced Custom Fields, WooCommerce, Contact Form 7, Smart Slider 3, VinFast Template.

## 3. Tiêu chuẩn tuân thủ
- Quy chuẩn code và quy tắc làm việc: xem [AGENTS.md](AGENTS.md).
- Kế hoạch dự án và lộ trình các Slice: xem [PROJECT_PLAN.md](docs/PROJECT_PLAN.md).
- Trạng thái bàn giao và nhật ký nghiệm thu: xem [AI_HANDOFF.md](docs/AI_HANDOFF.md).
