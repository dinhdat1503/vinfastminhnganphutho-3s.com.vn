# VinFast Product Template

Plugin nhỏ để hiển thị trang chi tiết sản phẩm xe VinFast theo bố cục
giống trang mẫu shop.vinfastauto.com, dựa hoàn toàn trên các custom
field (`_vf_*`) mà `create-all-vinfast.php` đã lưu sẵn.

## Cài đặt

1. Copy toàn bộ thư mục `vinfast-template/` vào `/wp-content/plugins/`
2. Vào **WP Admin → Plugins**, kích hoạt **"VinFast Product Template"**
3. Đảm bảo `create-all-vinfast.php` đã chạy (để các sản phẩm có
   `_vf_is_vinfast = yes` và đầy đủ custom field)
4. Mở trang chi tiết 1 xe VinFast bất kỳ, ví dụ `/san-pham/vinfast-vf-3/`

Sản phẩm KHÔNG có `_vf_is_vinfast = yes` vẫn hiển thị bằng template mặc
định của theme/WooCommerce — plugin không ảnh hưởng gì đến các sản
phẩm khác.

## Cấu trúc file

```
vinfast-template/
├── vinfast-template.php          ← file chính (hook + helper functions)
├── templates/
│   └── single-product-vinfast.php  ← markup từng section
└── assets/
    ├── vf-style.css               ← giao diện
    └── vf-script.js               ← chọn màu / tab / công cụ so sánh
```

## Các section đã dựng (theo đúng thứ tự trang mẫu)

1. Hero (banner + giá)
2. Giới thiệu tổng quan
3. Bảng thông số nhanh (hero specs)
4. Chọn màu xe (đổi ảnh theo màu)
5. Ngoại thất
6. Nội thất
7. Điểm nổi bật vận hành (performance)
8. Điểm nổi bật an toàn (safety)
9. **Công cụ so sánh chi phí xăng/dầu vs điện** (mới thêm theo yêu cầu)
10. Bảng thông số kỹ thuật đầy đủ (tabs)
11. Gallery ảnh tổng hợp
12. Form đăng ký tư vấn (CTA)

## Công cụ so sánh chi phí — cần biết

Công cụ này tính theo công thức:

```
Chi phí xăng/dầu = (quãng đường / 100) × mức tiêu thụ (lít/100km) × giá nhiên liệu
Chi phí điện     = (quãng đường / 100) × mức tiêu thụ điện (kWh/100km) × giá điện
Tiết kiệm        = Chi phí xăng/dầu − Chi phí điện
```

Mặc định mức tiêu thụ điện là `15 kWh/100km` và giá điện `3.500 VNĐ/kWh`
— đây là số liệu **ước lượng chung**, không phải số liệu chính thức
của từng xe. Để chính xác hơn cho từng mẫu xe, bạn có thể thêm 2 field
sau vào từng phần tử trong mảng `$vehicles` của `create-all-vinfast.php`:

```php
'ev_consumption_kwh_100km' => '14', // mức tiêu thụ điện thực tế của xe
'elec_price_per_kwh'       => '3500', // giá điện áp dụng
```

Và thêm 2 dòng lưu meta tương ứng trong `create-all-vinfast.php`:

```php
update_post_meta($post_id, '_vf_ev_consumption_kwh_100km', $v['ev_consumption_kwh_100km'] ?? '15');
update_post_meta($post_id, '_vf_elec_price_per_kwh', $v['elec_price_per_kwh'] ?? '3500');
```

## Form đăng ký tư vấn

Template hiện đang gọi shortcode giả định `[vf_lead_form]`. Bạn cần thay
bằng shortcode form thật của mình (Contact Form 7, WPForms, Gravity
Forms...) tại dòng cuối trong
`templates/single-product-vinfast.php`.

## Lưu ý về nội dung/hình ảnh

Toàn bộ nội dung hiển thị (`overview_text`, `exterior_text`, ảnh...) lấy
từ chính custom field bạn đã khai báo trong `create-all-vinfast.php` —
đây là nội dung do bạn tự viết/tự lưu trữ, template không tự tải hay
sao chép nội dung từ trang vinfastauto.com.
