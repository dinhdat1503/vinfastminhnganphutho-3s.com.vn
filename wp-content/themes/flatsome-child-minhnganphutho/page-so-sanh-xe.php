<?php
/**
 * Template Name: So sánh xe điện VinFast
 * Description: Trang so sánh thông số kỹ thuật chi tiết giữa 2 hoặc 3 dòng xe ô tô điện VinFast
 */
defined('ABSPATH') || exit;
get_header();

// Lấy danh sách toàn bộ xe car_model
$car_posts = get_posts([
    'post_type'      => 'car_model',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

// Chuẩn hóa dữ liệu thông số kỹ thuật chính hãng 15 mẫu xe ô tô điện VinFast
$official_img_base = wp_make_link_relative(content_url('/uploads/official_cars/common/'));
if (substr($official_img_base, -1) !== '/') {
    $official_img_base .= '/';
}

$cars_db = [
    'vf2' => [
        'id' => 'vf2',
        'name' => 'VinFast VF 2',
        'segment' => 'Xe đô thị 2 chỗ',
        'image' => $official_img_base . 'official_vf2.png',
        'price_text' => 'Liên hệ',
        'lease_text' => 'Đang cập nhật',
        'deposit' => '–',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '2 chỗ',
        'dimensions' => '3.190 x 1.490 x 1.620 mm',
        'wheelbase' => '2.065 mm',
        'ground_clearance' => '160 mm',
        'weight' => '–',
        'turning_radius' => '4.2 m',
        'motor_type' => 'Động cơ điện đơn',
        'power' => '30 kW (40 hp)',
        'torque' => '110 Nm',
        'drivetrain' => 'Cầu sau (RWD)',
        'accel' => '–',
        'max_speed' => '100 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '18.6 kWh',
        'range' => '210 km (NEDC)',
        'ac_charging' => '3.3 kW',
        'dc_fast_charge' => '30 phút (10 - 70%)',
        'wheels' => '14 inch',
        'headlights' => 'Halogen / LED',
        'screen' => '8 inch',
        'ac_system' => 'Chỉnh cơ',
        'sunroof' => 'Không có',
        'airbags' => '2 túi khí',
        'voice_assistant' => 'Có',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Không có',
        'lka' => 'Không có',
    ],
    'vf3' => [
        'id' => 'vf3',
        'name' => 'VinFast VF 3',
        'segment' => 'Mini eSUV đô thị',
        'image' => $official_img_base . 'official_vf3.webp',
        'price_text' => '240.000.000 VNĐ (Thuê pin)',
        'lease_text' => 'Từ 1.100.000 VNĐ / tháng',
        'deposit' => '7.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '4 chỗ',
        'dimensions' => '3.190 x 1.679 x 1.622 mm',
        'wheelbase' => '2.075 mm',
        'ground_clearance' => '191 mm',
        'weight' => '857 kg',
        'turning_radius' => '4.2 m',
        'motor_type' => 'Động cơ điện đơn',
        'power' => '32 kW (43 hp)',
        'torque' => '110 Nm',
        'drivetrain' => 'Cầu sau (RWD)',
        'accel' => '5.3 giây (0 - 50 km/h)',
        'max_speed' => '100 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '18.64 kWh',
        'range' => '210 km (NEDC)',
        'ac_charging' => '3.3 kW',
        'dc_fast_charge' => '36 phút (10 - 70%)',
        'wheels' => '16 inch thép/hợp kim',
        'headlights' => 'Halogen / LED',
        'screen' => '10 inch cảm ứng',
        'ac_system' => 'Chỉnh cơ 1 vùng',
        'sunroof' => 'Không có',
        'airbags' => '1 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast)',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Không có',
        'lka' => 'Không có',
    ],
    'vf5' => [
        'id' => 'vf5',
        'name' => 'VinFast VF 5 Plus',
        'segment' => 'A-eSUV gầm cao',
        'image' => $official_img_base . 'official_vf5.webp',
        'price_text' => '468.000.000 VNĐ (Thuê pin)',
        'lease_text' => 'Từ 1.400.000 VNĐ / tháng',
        'deposit' => '15.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '5 chỗ',
        'dimensions' => '3.967 x 1.723 x 1.578 mm',
        'wheelbase' => '2.513 mm',
        'ground_clearance' => '168 mm',
        'weight' => '1.360 kg',
        'turning_radius' => '5.0 m',
        'motor_type' => 'Động cơ điện đơn',
        'power' => '100 kW (134 hp)',
        'torque' => '135 Nm',
        'drivetrain' => 'Cầu trước (FWD)',
        'accel' => '12 giây (0 - 100 km/h)',
        'max_speed' => '130 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '37.23 kWh',
        'range' => '326 km (NEDC)',
        'ac_charging' => '6.6 kW',
        'dc_fast_charge' => '30 phút (10 - 70%)',
        'wheels' => '17 inch hợp kim',
        'headlights' => 'Halogen chiếu xạ / LED',
        'screen' => '8 inch cảm ứng',
        'ac_system' => 'Chỉnh cơ có lọc bụi PM2.5',
        'sunroof' => 'Không có',
        'airbags' => '6 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast Voice)',
        'tja' => 'Có (Cảnh báo ùn tắc)',
        'hwa' => 'Không có',
        'bsd' => 'Có (Cảnh báo điểm mù)',
        'lka' => 'Có (Cảnh báo chệch làn)',
    ],
    'vf6' => [
        'id' => 'vf6',
        'name' => 'VinFast VF 6',
        'segment' => 'B-eSUV thời thượng',
        'image' => $official_img_base . 'official_vf6.webp',
        'price_text' => '675.000.000 VNĐ (S/Plus)',
        'lease_text' => 'Từ 1.700.000 VNĐ / tháng',
        'deposit' => '25.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '5 chỗ',
        'dimensions' => '4.238 x 1.820 x 1.594 mm',
        'wheelbase' => '2.730 mm',
        'ground_clearance' => '170 mm',
        'weight' => '1.700 kg',
        'turning_radius' => '5.3 m',
        'motor_type' => 'Động cơ điện đơn',
        'power' => '130 - 150 kW (174 - 201 hp)',
        'torque' => '250 - 310 Nm',
        'drivetrain' => 'Cầu trước (FWD)',
        'accel' => '8.9 giây (0 - 100 km/h)',
        'max_speed' => '150 km/h',
        'battery_type' => 'LFP cao cấp',
        'battery_capacity' => '59.6 kWh',
        'range' => '399 - 410 km (WLTP)',
        'ac_charging' => '7.4 kW',
        'dc_fast_charge' => '24 phút (10 - 70%)',
        'wheels' => '19 inch hợp kim phay 2 màu',
        'headlights' => 'Full LED thông minh',
        'screen' => '12.9 inch sắc nét',
        'ac_system' => 'Tự động 2 vùng + Lọc PM2.5',
        'sunroof' => 'Không có',
        'airbags' => '8 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast AI)',
        'tja' => 'Có (Hỗ trợ ùn tắc TJA)',
        'hwa' => 'Có (Hỗ trợ lái cao tốc HWA)',
        'bsd' => 'Có (Cảnh báo điểm mù BSD)',
        'lka' => 'Có (Giữ làn tự động LKA)',
    ],
    'vf7' => [
        'id' => 'vf7',
        'name' => 'VinFast VF 7',
        'segment' => 'C-eSUV Đột phá đam mê',
        'image' => $official_img_base . 'official_vf7.webp',
        'price_text' => '850.000.000 VNĐ (Base/Plus)',
        'lease_text' => 'Từ 2.000.000 VNĐ / tháng',
        'deposit' => '41.000.000 VNĐ',
        'warranty' => '10 năm / 200.000 km',
        'seats' => '5 chỗ',
        'dimensions' => '4.545 x 1.890 x 1.635 mm',
        'wheelbase' => '2.840 mm',
        'ground_clearance' => '190 mm',
        'weight' => '1.950 - 2.100 kg',
        'turning_radius' => '5.6 m',
        'motor_type' => 'Đơn / Đôi (2 Động cơ điện)',
        'power' => '130 - 260 kW (174 - 349 hp)',
        'torque' => '250 - 500 Nm',
        'drivetrain' => 'FWD / 2 Cầu toàn thời gian (AWD)',
        'accel' => '5.8 giây (0 - 100 km/h)',
        'max_speed' => '175 km/h',
        'battery_type' => 'NMC / LFP',
        'battery_capacity' => '75.3 kWh',
        'range' => '431 - 496 km (WLTP)',
        'ac_charging' => '11 kW',
        'dc_fast_charge' => '24 phút (10 - 70%)',
        'wheels' => '20 inch thể thao',
        'headlights' => 'Full LED Matrix chiếu sáng',
        'screen' => '12.9 inch nghiêng người lái',
        'ac_system' => 'Tự động 2 vùng độc lập',
        'sunroof' => 'Cửa sổ trời toàn cảnh Kính trần',
        'airbags' => '8 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast AI)',
        'tja' => 'Có (Hỗ trợ di chuyển ùn tắc)',
        'hwa' => 'Có (Lái bán tự động cao tốc)',
        'bsd' => 'Có (Cảnh báo điểm mù BSD)',
        'lka' => 'Có (Hỗ trợ giữ làn LKA)',
    ],
    'vf8' => [
        'id' => 'vf8',
        'name' => 'VinFast VF 8',
        'segment' => 'D-eSUV Đẳng cấp toàn cầu',
        'image' => $official_img_base . 'official_vf8.webp',
        'price_text' => '1.090.000.000 VNĐ (Eco/Plus)',
        'lease_text' => 'Từ 2.300.000 VNĐ / tháng',
        'deposit' => '41.000.000 VNĐ',
        'warranty' => '10 năm / 200.000 km',
        'seats' => '5 chỗ',
        'dimensions' => '4.750 x 1.934 x 1.667 mm',
        'wheelbase' => '2.950 mm',
        'ground_clearance' => '179 mm',
        'weight' => '2.540 kg',
        'turning_radius' => '5.7 m',
        'motor_type' => '2 Động cơ điện (AWD)',
        'power' => '260 - 300 kW (349 - 402 hp)',
        'torque' => '500 - 620 Nm',
        'drivetrain' => '2 Cầu toàn thời gian (AWD)',
        'accel' => '5.5 giây (0 - 100 km/h)',
        'max_speed' => '200 km/h',
        'battery_type' => 'CATL NMC',
        'battery_capacity' => '87.7 kWh',
        'range' => '471 - 490 km (WLTP)',
        'ac_charging' => '11 kW',
        'dc_fast_charge' => '24 phút (10 - 70%)',
        'wheels' => '20 inch hợp kim phay bóng',
        'headlights' => 'Full LED thích ứng thông minh',
        'screen' => '15.6 inch siêu lớn + HUD',
        'ac_system' => 'Tự động 2 vùng + Lọc không khí Ion',
        'sunroof' => 'Cửa sổ trời điện',
        'airbags' => '11 túi khí cao cấp',
        'voice_assistant' => 'Có (Trợ lý VinFast AI)',
        'tja' => 'Có (Hỗ trợ lái ùn tắc TJA)',
        'hwa' => 'Có (Hỗ trợ lái cao tốc HWA)',
        'bsd' => 'Có (Cảnh báo điểm mù BSD)',
        'lka' => 'Có (Hỗ trợ giữ làn LKA)',
    ],
    'vf8_allnew' => [
        'id' => 'vf8_allnew',
        'name' => 'VF 8 The All New',
        'segment' => 'D-eSUV Đột phá thế hệ mới',
        'image' => $official_img_base . 'official_vf8_allnew.png',
        'price_text' => '1.150.000.000 VNĐ',
        'lease_text' => 'Từ 2.300.000 VNĐ / tháng',
        'deposit' => '41.000.000 VNĐ',
        'warranty' => '10 năm / 200.000 km',
        'seats' => '5 chỗ hạng sang',
        'dimensions' => '4.750 x 1.934 x 1.667 mm',
        'wheelbase' => '2.950 mm',
        'ground_clearance' => '180 mm',
        'weight' => '2.500 kg',
        'turning_radius' => '5.7 m',
        'motor_type' => '2 Động cơ điện thế hệ mới',
        'power' => '300 kW (402 hp)',
        'torque' => '620 Nm',
        'drivetrain' => '2 Cầu toàn thời gian (AWD)',
        'accel' => '5.3 giây (0 - 100 km/h)',
        'max_speed' => '200 km/h',
        'battery_type' => 'CATL NMC Đột phá',
        'battery_capacity' => '87.7 kWh',
        'range' => '500+ km (WLTP)',
        'ac_charging' => '11 kW',
        'dc_fast_charge' => '22 phút (10 - 70%)',
        'wheels' => '20 inch Đồ họa mới',
        'headlights' => 'Full LED Matrix Đột phá',
        'screen' => '15.6 inch OLED + HUD',
        'ac_system' => 'Tự động 2 vùng + Lọc bụi PM2.5 Ion',
        'sunroof' => 'Cửa sổ trời toàn cảnh',
        'airbags' => '11 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast AI thế hệ mới)',
        'tja' => 'Có (Hỗ trợ di chuyển ùn tắc TJA)',
        'hwa' => 'Có (Lái bán tự động cao tốc HWA)',
        'bsd' => 'Có (Cảnh báo điểm mù BSD)',
        'lka' => 'Có (Hỗ trợ giữ làn chủ động LKA)',
    ],
    'vf9' => [
        'id' => 'vf9',
        'name' => 'VinFast VF 9',
        'segment' => 'E-eSUV Thương gia đỉnh cao',
        'image' => $official_img_base . 'official_vf9.webp',
        'price_text' => '1.566.000.000 VNĐ (Eco/Plus)',
        'lease_text' => 'Từ 3.200.000 VNĐ / tháng',
        'deposit' => '60.000.000 VNĐ',
        'warranty' => '10 năm / 200.000 km',
        'seats' => '6 - 7 chỗ Thương gia',
        'dimensions' => '5.118 x 1.996 x 1.696 mm',
        'wheelbase' => '3.150 mm',
        'ground_clearance' => '197 mm',
        'weight' => '2.880 kg',
        'turning_radius' => '6.1 m',
        'motor_type' => '2 Động cơ điện (AWD)',
        'power' => '300 kW (402 hp)',
        'torque' => '620 Nm',
        'drivetrain' => '2 Cầu toàn thời gian (AWD)',
        'accel' => '6.5 giây (0 - 100 km/h)',
        'max_speed' => '200 km/h',
        'battery_type' => 'CATL NMC 123kWh',
        'battery_capacity' => '123 kWh',
        'range' => '580 - 626 km (WLTP)',
        'ac_charging' => '11 kW',
        'dc_fast_charge' => '26 phút (10 - 70%)',
        'wheels' => '21 inch Đẳng cấp',
        'headlights' => 'Full LED Matrix Thích ứng',
        'screen' => '15.6 inch OLED + HUD + Màn hình sau',
        'ac_system' => 'Tự động 3 vùng độc lập + Ghế Massage',
        'sunroof' => 'Cửa sổ trời toàn cảnh Panorama',
        'airbags' => '11 túi khí an toàn cao nhất',
        'voice_assistant' => 'Có (Trợ lý VinFast AI Thương gia)',
        'tja' => 'Có (TJA cao cấp)',
        'hwa' => 'Có (Lái tự động HWA)',
        'bsd' => 'Có (BSD toàn cảnh)',
        'lka' => 'Có (LKA chủ động)',
    ],
    'limo' => [
        'id' => 'limo',
        'name' => 'Limo Green',
        'segment' => 'Xe dịch vụ cao cấp',
        'image' => $official_img_base . 'official_limo.png',
        'price_text' => 'Liên hệ tư vấn',
        'lease_text' => 'Từ 2.100.000 VNĐ / tháng',
        'deposit' => '30.000.000 VNĐ',
        'warranty' => '5 năm / 150.000 km',
        'seats' => '7 chỗ rộng rãi',
        'dimensions' => '4.750 x 1.900 x 1.660 mm',
        'wheelbase' => '2.950 mm',
        'ground_clearance' => '175 mm',
        'weight' => '2.200 kg',
        'turning_radius' => '5.6 m',
        'motor_type' => 'Động cơ điện đơn',
        'power' => '150 kW (201 hp)',
        'torque' => '310 Nm',
        'drivetrain' => 'Cầu trước (FWD)',
        'accel' => '9.5 giây',
        'max_speed' => '150 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '60 kWh',
        'range' => '400 km (NEDC)',
        'ac_charging' => '7.4 kW',
        'dc_fast_charge' => '30 phút (10 - 70%)',
        'wheels' => '18 inch',
        'headlights' => 'LED',
        'screen' => '10 inch',
        'ac_system' => 'Tự động 2 dàn lạnh',
        'sunroof' => 'Không có',
        'airbags' => '4 túi khí',
        'voice_assistant' => 'Có',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Có',
        'lka' => 'Có',
    ],
    'ecvan' => [
        'id' => 'ecvan',
        'name' => 'VinFast EC Van',
        'segment' => 'Xe tải Van điện đô thị',
        'image' => $official_img_base . 'official_ecvan.webp',
        'price_text' => 'Liên hệ tư vấn',
        'lease_text' => 'Từ 2.100.000 VNĐ / tháng',
        'deposit' => '30.000.000 VNĐ',
        'warranty' => '5 năm / 150.000 km',
        'seats' => '2 chỗ + Thùng hàng 2.500L',
        'dimensions' => '4.200 x 1.760 x 1.850 mm',
        'wheelbase' => '2.700 mm',
        'ground_clearance' => '165 mm',
        'weight' => '1.450 kg (Tải trọng 750kg)',
        'turning_radius' => '5.1 m',
        'motor_type' => 'Động cơ điện đơn',
        'power' => '60 kW (80 hp)',
        'torque' => '180 Nm',
        'drivetrain' => 'Cầu sau (RWD)',
        'accel' => '–',
        'max_speed' => '110 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '42 kWh',
        'range' => '280 km (NEDC)',
        'ac_charging' => '6.6 kW',
        'dc_fast_charge' => '35 phút (10 - 70%)',
        'wheels' => '15 inch thép gia cường',
        'headlights' => 'Halogen',
        'screen' => '7 inch',
        'ac_system' => 'Chỉnh cơ',
        'sunroof' => 'Không có',
        'airbags' => '2 túi khí',
        'voice_assistant' => 'Không có',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Không có',
        'lka' => 'Không có',
    ],
    'vfwild' => [
        'id' => 'vfwild',
        'name' => 'VinFast VF Wild',
        'segment' => 'Bán tải điện địa hình REEV',
        'image' => $official_img_base . 'official_vfwild.webp',
        'price_text' => '850.000.000 VNĐ (Dự kiến)',
        'lease_text' => 'Từ 2.500.000 VNĐ / tháng',
        'deposit' => '20.000.000 VNĐ',
        'warranty' => '6 năm / 150.000 km (Pin 8 năm)',
        'seats' => '5 chỗ',
        'dimensions' => '5.376 x 2.069 x 1.873 mm',
        'wheelbase' => '3.258 mm',
        'ground_clearance' => '222 mm',
        'weight' => '2.390 kg (Tải trọng 750 kg)',
        'turning_radius' => '6.2 m',
        'motor_type' => 'Động cơ điện REEV mở rộng phạm vi',
        'power' => '160 kW (215 hp)',
        'torque' => '280 Nm',
        'drivetrain' => 'Cầu trước (FWD) / 2 Cầu (4WD)',
        'accel' => '7.9 giây (0 - 100 km/h)',
        'max_speed' => '160 km/h',
        'battery_type' => 'LFP bền bỉ chống cháy nổ',
        'battery_capacity' => '46.4 kWh',
        'range' => '250 km thuần điện (1.000+ km REEV)',
        'ac_charging' => '6.6 kW',
        'dc_fast_charge' => '32 phút (10 - 70%) - Cổng DC 90kW',
        'wheels' => '18 inch hợp kim địa hình (255/70 R18)',
        'headlights' => 'Full LED Matrix nhận diện thương hiệu',
        'screen' => '10 inch cảm ứng Apple CarPlay / Android Auto',
        'ac_system' => 'Tự động 2 vùng + Lọc PM2.5',
        'sunroof' => 'Cửa sổ trời toàn cảnh kính trần',
        'airbags' => '6 túi khí an toàn',
        'voice_assistant' => 'Có (Trợ lý ảo VinFast)',
        'tja' => 'Có (Hỗ trợ di chuyển ùn tắc TJA)',
        'hwa' => 'Có (Hỗ trợ lái cao tốc HWA)',
        'bsd' => 'Có (Cảnh báo điểm mù BSD)',
        'lka' => 'Có (Hỗ trợ giữ làn LKA)',
    ],
    'mpv7' => [
        'id' => 'mpv7',
        'name' => 'VinFast VF MPV 7',
        'segment' => 'MPV điện 7 chỗ đa dụng',
        'image' => $official_img_base . 'official_mpv7.webp',
        'price_text' => '750.000.000 VNĐ (Eco/Plus)',
        'lease_text' => 'Từ 2.000.000 VNĐ / tháng',
        'deposit' => '25.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '7 chỗ (3 hàng ghế rộng)',
        'dimensions' => '4.750 x 1.890 x 1.660 mm',
        'wheelbase' => '2.850 mm',
        'ground_clearance' => '175 mm',
        'weight' => '2.100 kg',
        'turning_radius' => '5.6 m',
        'motor_type' => 'Động cơ điện đơn công suất cao',
        'power' => '150 kW (201 hp)',
        'torque' => '310 Nm',
        'drivetrain' => 'Cầu trước (FWD)',
        'accel' => '8.8 giây (0 - 100 km/h)',
        'max_speed' => '160 km/h',
        'battery_type' => 'LFP thế hệ mới',
        'battery_capacity' => '60.0 kWh',
        'range' => '410 km (WLTP)',
        'ac_charging' => '7.4 kW',
        'dc_fast_charge' => '25 phút (10 - 70%)',
        'wheels' => '18 inch hợp kim',
        'headlights' => 'Full LED',
        'screen' => '12.9 inch cảm ứng',
        'ac_system' => 'Tự động 2 vùng độc lập + Cửa gió hàng ghế sau',
        'sunroof' => 'Không có',
        'airbags' => '6 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast)',
        'tja' => 'Có (Tùy phiên bản)',
        'hwa' => 'Có (Tùy phiên bản)',
        'bsd' => 'Có',
        'lka' => 'Có',
    ],
    'minio' => [
        'id' => 'minio',
        'name' => 'Minio Green',
        'segment' => 'Xe điện đô thị & Dịch vụ Mini',
        'image' => $official_img_base . 'official_minio.webp',
        'price_text' => '239.000.000 VNĐ (Thuê pin)',
        'lease_text' => 'Từ 1.100.000 VNĐ / tháng',
        'deposit' => '7.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '4 chỗ',
        'dimensions' => '3.190 x 1.679 x 1.622 mm',
        'wheelbase' => '2.075 mm',
        'ground_clearance' => '191 mm',
        'weight' => '860 kg',
        'turning_radius' => '4.2 m',
        'motor_type' => 'Động cơ điện đơn tối ưu dịch vụ',
        'power' => '32 kW (43 hp)',
        'torque' => '110 Nm',
        'drivetrain' => 'Cầu sau (RWD)',
        'accel' => '5.3 giây (0 - 50 km/h)',
        'max_speed' => '100 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '18.64 kWh',
        'range' => '210 km (NEDC)',
        'ac_charging' => '3.3 kW',
        'dc_fast_charge' => '36 phút (10 - 70%)',
        'wheels' => '16 inch',
        'headlights' => 'Halogen / LED',
        'screen' => '10 inch cảm ứng',
        'ac_system' => 'Chỉnh cơ',
        'sunroof' => 'Không có',
        'airbags' => '1 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast)',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Không có',
        'lka' => 'Không có',
    ],
    'herio' => [
        'id' => 'herio',
        'name' => 'Herio Green',
        'segment' => 'Sedan điện dịch vụ thông minh',
        'image' => $official_img_base . 'official_herio.png',
        'price_text' => '490.000.000 VNĐ (Thuê pin)',
        'lease_text' => 'Từ 1.400.000 VNĐ / tháng',
        'deposit' => '15.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '5 chỗ',
        'dimensions' => '3.967 x 1.723 x 1.578 mm',
        'wheelbase' => '2.513 mm',
        'ground_clearance' => '168 mm',
        'weight' => '1.360 kg',
        'turning_radius' => '5.0 m',
        'motor_type' => 'Động cơ điện đơn FWD',
        'power' => '100 kW (134 hp)',
        'torque' => '135 Nm',
        'drivetrain' => 'Cầu trước (FWD)',
        'accel' => '11.5 giây (0 - 100 km/h)',
        'max_speed' => '130 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '37.23 kWh',
        'range' => '326 km (NEDC)',
        'ac_charging' => '6.6 kW',
        'dc_fast_charge' => '30 phút (10 - 70%)',
        'wheels' => '17 inch hợp kim',
        'headlights' => 'LED',
        'screen' => '8 inch cảm ứng',
        'ac_system' => 'Chỉnh cơ có lọc PM2.5',
        'sunroof' => 'Không có',
        'airbags' => '4 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast)',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Có',
        'lka' => 'Có',
    ],
    'nerio' => [
        'id' => 'nerio',
        'name' => 'Nerio Green',
        'segment' => 'SUV điện dịch vụ cỡ vừa',
        'image' => $official_img_base . 'official_nerio.webp',
        'price_text' => '675.000.000 VNĐ (Thuê pin)',
        'lease_text' => 'Từ 1.700.000 VNĐ / tháng',
        'deposit' => '25.000.000 VNĐ',
        'warranty' => '7 năm / 160.000 km',
        'seats' => '5 chỗ',
        'dimensions' => '4.300 x 1.793 x 1.613 mm',
        'wheelbase' => '2.611 mm',
        'ground_clearance' => '170 mm',
        'weight' => '1.650 kg',
        'turning_radius' => '5.3 m',
        'motor_type' => 'Động cơ điện đơn FWD',
        'power' => '110 kW (147 hp)',
        'torque' => '250 Nm',
        'drivetrain' => 'Cầu trước (FWD)',
        'accel' => '9.2 giây (0 - 100 km/h)',
        'max_speed' => '150 km/h',
        'battery_type' => 'LFP',
        'battery_capacity' => '42.0 kWh',
        'range' => '318 km (NEDC)',
        'ac_charging' => '7.4 kW',
        'dc_fast_charge' => '18 phút nạp 180 km',
        'wheels' => '18 inch',
        'headlights' => 'Full LED',
        'screen' => '10 inch cảm ứng',
        'ac_system' => 'Tự động có lọc PM2.5',
        'sunroof' => 'Không có',
        'airbags' => '6 túi khí',
        'voice_assistant' => 'Có (Trợ lý VinFast)',
        'tja' => 'Không có',
        'hwa' => 'Không có',
        'bsd' => 'Có',
        'lka' => 'Có',
    ]
];
?>
<style>
/* ============================================================
   BỘ PREVIEW ẢNH XE CHỌN TRONG SLOT SO SÁNH
   ============================================================ */
.vf-slot-preview {
  margin-top: 14px;
}
.vf-slot-preview-card {
  display: flex;
  align-items: center;
  gap: 14px;
  background: #F8FAFC;
  border: 1.5px solid #E2E8F0;
  border-radius: 12px;
  padding: 12px 16px;
  transition: all 0.3s ease;
  min-height: 86px;
}
.vf-slot-preview-card:hover {
  border-color: #2563EB;
  background: #F0F7FF;
  box-shadow: 0 4px 14px rgba(37, 99, 235, 0.08);
}
.vf-slot-preview-thumb {
  width: 90px;
  height: 60px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}
.vf-slot-preview-thumb img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.06));
  transition: transform 0.3s ease;
}
.vf-slot-preview-card:hover .vf-slot-preview-thumb img {
  transform: scale(1.05);
}
.vf-slot-preview-meta {
  flex: 1;
  min-width: 0;
}
.vf-slot-preview-tag {
  display: inline-block;
  font-size: 11px;
  font-weight: 600;
  color: #64748B;
  background: #E2E8F0;
  padding: 2px 8px;
  border-radius: 4px;
  margin-bottom: 4px;
  text-overflow: ellipsis;
  overflow: hidden;
  white-space: nowrap;
  max-width: 100%;
}
.vf-slot-preview-price {
  font-size: 13.5px;
  font-weight: 800;
  color: #2563EB;
  line-height: 1.3;
}
.vf-slot-preview-empty {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  min-height: 86px;
  background: #F8FAFC;
  border: 1.5px dashed #CBD5E1;
  border-radius: 12px;
  padding: 12px 16px;
  color: #94A3B8;
  transition: all 0.2s ease;
}
.vf-slot-preview-empty:hover {
  border-color: #2563EB;
  color: #2563EB;
}
.vf-slot-empty-icon {
  font-size: 18px;
}
.vf-slot-empty-text {
  font-size: 12px;
  font-weight: 600;
}
@media (max-width: 768px) {
  .vf-slot-preview-card {
    padding: 10px 12px;
    gap: 10px;
  }
  .vf-slot-preview-thumb {
    width: 75px;
    height: 50px;
  }
}

/* ============================================================
   CẤU HÌNH IN ẤN / XUẤT PDF CHUẨN MẪU BÁO GIÁ SO SÁNH VINFAST
   ============================================================ */
@media print {
  /* 1. Ẩn tất cả các phần dư thừa không cần thiết khi in */
  #header,
  #footer,
  header,
  footer,
  .vf-compare-hero-wrapper,
  .vf-compare-quick-presets,
  .vf-compare-selector-card,
  .vf-compare-filter-bar,
  .vf-quick-action-bar,
  .vf-quick-bar,
  .vf-sticky-bar-mobile,
  .vf-sticky-bar,
  .vf-sticky-item,
  .vf-matrix-actions,
  #modal-laythu,
  .floating-sidebar,
  .scroll-to-top,
  .vf-btn {
    display: none !important;
  }

  /* 2. Tối ưu background và lề trang in */
  body, .container, .vf-compare-matrix-card, .table-responsive {
    background: #ffffff !important;
    padding: 0 !important;
    margin: 0 !important;
    box-shadow: none !important;
    border: none !important;
    width: 100% !important;
    max-width: 100% !important;
    overflow: visible !important;
  }

  /* 3. Thêm Header Tiêu đề Báo giá VinFast Tân Á Châu khi in */
  .vf-compare-matrix-card::before {
    content: "ĐẠI LÝ VINFAST TÂN Á CHÂU - BẢNG SO SÁNH CHI TIẾT DÒNG XE Ô TÔ ĐIỆN\A Hotline: 056 225 6256 | Địa chỉ: 191 Đường Hùng Vương, Phường Vĩnh Yên, Tỉnh Phú Thọ , Vinh Yen, Vietnam";
    white-space: pre-wrap;
    display: block;
    text-align: center;
    font-size: 15px;
    font-weight: 800;
    color: #2563eb;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #2563eb;
  }

  /* 4. Định dạng Bảng Ma trận So sánh vừa vặn trang in */
  .vf-compare-matrix-table {
    width: 100% !important;
    border-collapse: collapse !important;
    font-size: 11px !important;
  }

  .vf-compare-matrix-table th,
  .vf-compare-matrix-table td {
    border: 1px solid #cbd5e1 !important;
    padding: 8px 10px !important;
    page-break-inside: avoid !important;
  }

  /* 5. Tối ưu kích thước Ảnh Xe trong trang in */
  .vf-matrix-img {
    max-height: 110px !important;
    width: auto !important;
    object-fit: contain !important;
    margin: 0 auto 6px !important;
    display: block !important;
  }

  .vf-matrix-car-name {
    font-size: 15px !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    margin-bottom: 4px !important;
  }

  .vf-matrix-segment {
    font-size: 11px !important;
    color: #64748b !important;
  }

  .vf-matrix-price {
    font-size: 13px !important;
    font-weight: 800 !important;
    color: #2563eb !important;
    margin-top: 4px !important;
  }

  @page {
    size: A4 portrait;
    margin: 8mm;
  }
}
</style>

<div class="vf-compare-hero-wrapper">
  <div class="container text-center">
    <span class="vf-compare-badge">CÔNG CỤ SO SÁNH CHÍNH XÁC</span>
    <h1 class="vf-compare-title">So sánh các dòng Xe Ô tô điện VinFast</h1>
    <p class="vf-compare-sub">Đặt 2 hoặc 3 mẫu xe lên bàn cân để so sánh toàn bộ thông số kích thước, vận hành, dung lượng pin, thời gian sạc, trang bị ADAS & giá bán chính thức.</p>

    <!-- NÚT SO SÁNH NHANH CẶP XE PHỔ BIẾN -->
    <div class="vf-compare-quick-presets">
      <span class="vf-preset-label">So sánh nhanh:</span>
      <button class="vf-preset-btn" onclick="vfSetCompare('vf3', 'vf5', '')">VF 3 vs VF 5</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vf5', 'vf6', '')">VF 5 vs VF 6</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vf6', 'vf7', '')">VF 6 vs VF 7</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vf7', 'vf8', '')">VF 7 vs VF 8</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vf8', 'vf9', '')">VF 8 vs VF 9</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vfwild', 'vf8', '')">VF Wild vs VF 8</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vfwild', 'vf9', '')">VF Wild vs VF 9</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('mpv7', 'limo', '')">MPV 7 vs Limo</button>
      <button class="vf-preset-btn" onclick="vfSetCompare('vf5', 'vf6', 'vf7')">VF 5 vs VF 6 vs VF 7</button>
    </div>
  </div>
</div>

<div class="container section-padding">
  
  <!-- BỘ CHỌN XE 3 SLOT -->
  <div class="vf-compare-selector-card">
    <div class="vf-compare-selector-grid">
      
      <!-- SLOT 1 -->
      <div class="vf-compare-slot">
        <label for="car_select_1">Xe thứ nhất (Bắt buộc)</label>
        <select id="car_select_1" class="vf-select-car-dropdown" onchange="vfUpdateCompareMatrix()">
          <?php foreach ($cars_db as $key => $c): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($key, 'vf5'); ?>><?php echo esc_html($c['name']); ?> (<?php echo esc_html($c['segment']); ?>)</option>
          <?php endforeach; ?>
        </select>
        <div class="vf-slot-preview" id="vf_slot_preview_1"></div>
      </div>

      <!-- SLOT 2 -->
      <div class="vf-compare-slot">
        <label for="car_select_2">Xe thứ hai (Bắt buộc)</label>
        <select id="car_select_2" class="vf-select-car-dropdown" onchange="vfUpdateCompareMatrix()">
          <?php foreach ($cars_db as $key => $c): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($key, 'vf6'); ?>><?php echo esc_html($c['name']); ?> (<?php echo esc_html($c['segment']); ?>)</option>
          <?php endforeach; ?>
        </select>
        <div class="vf-slot-preview" id="vf_slot_preview_2"></div>
      </div>

      <!-- SLOT 3 -->
      <div class="vf-compare-slot">
        <label for="car_select_3">Xe thứ ba (Tuỳ chọn)</label>
        <select id="car_select_3" class="vf-select-car-dropdown" onchange="vfUpdateCompareMatrix()">
          <option value="">-- Không chọn (So sánh 2 xe) --</option>
          <?php foreach ($cars_db as $key => $c): ?>
            <option value="<?php echo esc_attr($key); ?>" <?php selected($key, ''); ?>><?php echo esc_html($c['name']); ?> (<?php echo esc_html($c['segment']); ?>)</option>
          <?php endforeach; ?>
        </select>
        <div class="vf-slot-preview" id="vf_slot_preview_3"></div>
      </div>

    </div>

    <!-- TOGGLE CHỈ XEM ĐIỂM KHÁC BIỆT & NÚT XUẤT FILE -->
    <div class="vf-compare-filter-bar" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
      <div style="display:flex; align-items:center; gap:10px;">
        <label class="vf-toggle-switch">
          <input type="checkbox" id="vf_diff_only" onchange="vfToggleDiffOnly()">
          <span class="vf-slider round"></span>
        </label>
        <span class="vf-toggle-text">Chỉ hiển thị các thông số <strong>khác biệt</strong></span>
      </div>
      <div style="display:flex; gap:10px;">
        <button type="button" class="vf-btn vf-btn-outline" onclick="vfExportCompareExcel()" style="background:#16a34a; color:#fff; border-color:#16a34a; padding:6px 16px; font-size:12px;">
          📊 TẢI EXCEL
        </button>
        <button type="button" class="vf-btn vf-btn-outline" onclick="vfExportComparePDF()" style="background:#0284c7; color:#fff; border-color:#0284c7; padding:6px 16px; font-size:12px;">
          🖨️ TẢI PDF
        </button>
      </div>
    </div>
  </div>

  <!-- BẢNG MA TRẬN SO SÁNH CHI TIẾT -->
  <div class="vf-compare-matrix-card">
    <div class="table-responsive">
      <table class="vf-compare-matrix-table" id="vf_matrix_table">
        <thead class="sticky-head" id="vf_matrix_head">
          <!-- Dynamically generated header by JS -->
        </thead>
        <tbody id="vf_matrix_body">
          <!-- Dynamically generated body rows by JS -->
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- EMBED DATA JSON CHO JS XỬ LÝ NHANH MƯỢT KHÔNG CẦN CHỜ AJAX -->
<script>
window.VF_CARS_DATA = <?php echo json_encode($cars_db, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG); ?>;

function vfSetCompare(c1, c2, c3) {
  document.getElementById('car_select_1').value = c1;
  document.getElementById('car_select_2').value = c2;
  document.getElementById('car_select_3').value = c3 || '';
  vfUpdateCompareMatrix();
  
  const el = document.querySelector('.vf-compare-matrix-card');
  if (el) el.scrollIntoView({ behavior: 'smooth' });
}

function vfUpdateCompareMatrix() {
  const c1Key = document.getElementById('car_select_1').value;
  const c2Key = document.getElementById('car_select_2').value;
  const c3Key = document.getElementById('car_select_3').value;

  const defaultFallback = '<?php echo esc_url($official_img_base . "official_vf3.webp"); ?>';

  // Cập nhật thẻ preview ảnh trực tiếp dưới mỗi dropdown slot
  function updateSlotPreview(slotId, car) {
    const el = document.getElementById(slotId);
    if (!el) return;
    if (car) {
      el.innerHTML = `
        <div class="vf-slot-preview-card">
          <div class="vf-slot-preview-thumb">
            <img src="${car.image}" alt="${car.name}" onerror="this.onerror=null; this.src='${defaultFallback}';">
          </div>
          <div class="vf-slot-preview-meta">
            <span class="vf-slot-preview-tag">${car.segment}</span>
            <div class="vf-slot-preview-price">${car.price_text}</div>
          </div>
        </div>
      `;
    } else {
      el.innerHTML = `
        <div class="vf-slot-preview-empty">
          <span class="vf-slot-empty-icon">➕</span>
          <span class="vf-slot-empty-text">Thêm xe thứ 3 để so sánh</span>
        </div>
      `;
    }
  }

  updateSlotPreview('vf_slot_preview_1', window.VF_CARS_DATA[c1Key]);
  updateSlotPreview('vf_slot_preview_2', window.VF_CARS_DATA[c2Key]);
  updateSlotPreview('vf_slot_preview_3', c3Key ? window.VF_CARS_DATA[c3Key] : null);

  const selectedKeys = [c1Key, c2Key];
  if (c3Key && c3Key !== c1Key && c3Key !== c2Key) {
    selectedKeys.push(c3Key);
  }

  const activeCars = selectedKeys.map(k => window.VF_CARS_DATA[k]).filter(Boolean);

  // 1. Build Header
  let headHtml = `<tr><th class="spec-label-col">Thông số so sánh</th>`;
  activeCars.forEach(car => {
    headHtml += `
      <th class="car-col">
        <div class="vf-matrix-car-header text-center">
          <img src="${car.image}" alt="${car.name}" class="vf-matrix-img" onerror="this.onerror=null; this.src='${defaultFallback}';">
          <h3 class="vf-matrix-car-name">${car.name}</h3>
          <span class="vf-matrix-segment">${car.segment}</span>
          <div class="vf-matrix-price">${car.price_text}</div>
          <div class="vf-matrix-actions">
            <a href="javascript:void(0)" onclick="vfOpenModal('modal-laythu')" class="vf-btn vf-btn-primary vf-anim-btn btn-sm">LÁI THỬ NGAY</a>
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="vf-btn vf-btn-outline btn-sm">DỰ TOÁN CHI PHÍ</a>
          </div>
        </div>
      </th>
    `;
  });
  headHtml += `</tr>`;
  document.getElementById('vf_matrix_head').innerHTML = headHtml;

  // 2. Build Specs Sections
  const specSections = [
    {
      groupTitle: "📸 THÔNG TIN GIÁ BÁN & BẢO HÀNH",
      rows: [
        { label: "Giá niêm yết xe", field: "price_text" },
        { label: "Chi phí thuê pin hàng tháng", field: "lease_text" },
        { label: "Phí đặt cọc thuê pin", field: "deposit" },
        { label: "Chế độ bảo hành chính hãng", field: "warranty" },
        { label: "Số chỗ ngồi", field: "seats" },
      ]
    },
    {
      groupTitle: "📐 KÍCH THƯỚC & TRỌNG LƯỢNG",
      rows: [
        { label: "Kích thước D x R x C", field: "dimensions" },
        { label: "Chiều dài cơ sở", field: "wheelbase" },
        { label: "Khoảng sáng gầm xe", field: "ground_clearance" },
        { label: "Trọng lượng bản thân", field: "weight" },
        { label: "Bán kính quay vòng tối thiểu", field: "turning_radius" },
      ]
    },
    {
      groupTitle: "⚡ ĐỘNG CƠ & HIỆU SUẤT VẬN HÀNH",
      rows: [
        { label: "Loại động cơ", field: "motor_type" },
        { label: "Công suất tối đa", field: "power" },
        { label: "Mô-men xoắn cực đại", field: "torque" },
        { label: "Hệ thống dẫn động", field: "drivetrain" },
        { label: "Tăng tốc 0 - 100 km/h", field: "accel" },
        { label: "Tốc độ tối đa", field: "max_speed" },
      ]
    },
    {
      groupTitle: "🔋 PIN & HỆ THỐNG SẠC",
      rows: [
        { label: "Loại Pin", field: "battery_type" },
        { label: "Dung lượng Pin khả dụng", field: "battery_capacity" },
        { label: "Quãng đường đi 1 lần sạc đầy", field: "range" },
        { label: "Công suất sạc AC tối đa", field: "ac_charging" },
        { label: "Thời gian sạc nhanh (10 - 70%)", field: "dc_fast_charge" },
      ]
    },
    {
      groupTitle: "🛡️ NGOẠI THẤT & NỘI THẤT",
      rows: [
        { label: "Kích thước Mâm xe / La-zăng", field: "wheels" },
        { label: "Hệ thống đèn chiếu sáng", field: "headlights" },
        { label: "Màn hình giải trí trung tâm", field: "screen" },
        { label: "Hệ thống điều hòa", field: "ac_system" },
        { label: "Cửa sổ trời", field: "sunroof" },
      ]
    },
    {
      groupTitle: "🤖 AN TOÀN & TÍNH NĂNG TRỢ LÁI ADAS",
      rows: [
        { label: "Số lượng túi khí an toàn", field: "airbags" },
        { label: "Trợ lý ảo tiếng Việt VinFast Voice", field: "voice_assistant" },
        { label: "Hỗ trợ di chuyển khi ùn tắc (TJA)", field: "tja" },
        { label: "Hỗ trợ lái trên cao tốc (HWA)", field: "hwa" },
        { label: "Cảnh báo điểm mù (BSD)", field: "bsd" },
        { label: "Hỗ trợ giữ làn đường (LKA)", field: "lka" },
      ]
    }
  ];

  let bodyHtml = "";
  specSections.forEach(sec => {
    bodyHtml += `<tr class="group-header-row"><td colspan="${activeCars.length + 1}">${sec.groupTitle}</td></tr>`;
    
    sec.rows.forEach(r => {
      const vals = activeCars.map(c => c[r.field] || '–');
      const isDiff = new Set(vals).size > 1;

      bodyHtml += `<tr class="spec-row ${isDiff ? 'has-diff' : 'same-val'}">`;
      bodyHtml += `<td class="spec-name">${r.label}</td>`;
      vals.forEach(val => {
        bodyHtml += `<td class="spec-val">${val}</td>`;
      });
      bodyHtml += `</tr>`;
    });
  });

  document.getElementById('vf_matrix_body').innerHTML = bodyHtml;
  vfToggleDiffOnly();
}

function vfToggleDiffOnly() {
  const diffOnly = document.getElementById('vf_diff_only').checked;
  const rows = document.querySelectorAll('#vf_matrix_body .spec-row');

  rows.forEach(row => {
    if (diffOnly) {
      if (row.classList.contains('has-diff')) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    } else {
      row.style.display = '';
    }
  });
}

document.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const p1 = params.get('c1') || params.get('car1') || params.get('model1');
  const p2 = params.get('c2') || params.get('car2') || params.get('model2');
  const p3 = params.get('c3') || params.get('car3') || params.get('model3');
  if (p1 && window.VF_CARS_DATA && window.VF_CARS_DATA[p1]) document.getElementById('car_select_1').value = p1;
  if (p2 && window.VF_CARS_DATA && window.VF_CARS_DATA[p2]) document.getElementById('car_select_2').value = p2;
  if (p3 && window.VF_CARS_DATA && window.VF_CARS_DATA[p3]) document.getElementById('car_select_3').value = p3;
  vfUpdateCompareMatrix();
});

function vfExportCompareExcel() {
  const table = document.getElementById('vf_matrix_table');
  if (!table) return;

  let csvContent = "\uFEFF";
  csvContent += "ĐẠI LÝ VINFAST TÂN Á CHÂU - BẢNG SO SÁNH CHI TIẾT DÒNG XE ĐIỆN VINFAST\n";
  csvContent += "Hotline: 056 225 6256 - Địa chỉ: 191 Đường Hùng Vương, Phường Vĩnh Yên, Tỉnh Phú Thọ , Vinh Yen, Vietnam\n\n";

  const rows = table.querySelectorAll('tr');
  rows.forEach(row => {
    if (row.classList.contains('group-row')) {
      const gTitle = row.innerText.trim();
      csvContent += `\n"${gTitle}"\n`;
    } else {
      const cells = row.querySelectorAll('th, td');
      if (cells.length > 0) {
        const line = Array.from(cells).map(c => {
          let text = c.innerText.replace(/\n/g, ' ').replace(/"/g, '""').trim();
          return `"${text}"`;
        }).join(',');
        csvContent += line + "\n";
      }
    }
  });

  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement("a");
  const url = URL.createObjectURL(blob);
  link.setAttribute("href", url);
  link.setAttribute("download", `So_Sanh_Xe_VinFast.csv`);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function vfExportComparePDF() {
  window.print();
}
</script>

<?php get_footer(); ?>
