<?php
/**
 * Universal Master Product Template for All VinFast Cars
 * Location: template-parts/product/single-default-car.php
 * 100% Authentic Photos & Specs per Car Model
 */

defined('ABSPATH') || exit;

$post_id  = get_the_ID();
$slug     = strtolower(get_post_field('post_name', $post_id));
$car_name = strtolower(get_the_title($post_id));

// Remove WooCommerce default product page hooks to prevent database post_content overlap
remove_all_actions('woocommerce_single_product_summary');
remove_all_actions('woocommerce_before_single_product');
remove_all_actions('woocommerce_after_single_product');
remove_all_actions('woocommerce_before_single_product_summary');
remove_all_actions('woocommerce_after_single_product_summary');
add_filter('the_content', '__return_empty_string', 9999);

if (!did_action('get_header')) {
    get_header();
}

$uploads_url = content_url('/uploads/official_cars/common');

// =========================================================
// AUTHENTIC CAR MODELS DATA DICTIONARY
// =========================================================
$models_data = [
    'vf3' => [
        'title'      => 'VINFAST VF 3',
        'sub'        => 'Mini e-SUV Đô Thị Cá Tính & Đột Phá',
        'desc'       => 'VinFast VF 3 sở hữu thiết kế vuông vức cá tính, nhỏ gọn tối ưu di chuyển đô thị cùng khả năng vận hành điện mạnh mẽ ấn tượng.',
        'img'        => $uploads_url . '/official_vf3.webp',
        'cutout'     => $uploads_url . '/cutout_vf3.png',
        'price_eco'  => '285.000.000 VNĐ',
        'price_buy'  => '322.000.000 VNĐ',
        'price_plus' => '296.000.000 VNĐ',
        'hp'         => '43 HP',
        'range'      => '210 KM',
        'accel'      => '19.3 kWh',
        'drive'      => 'RWD (Cầu sau)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf3.webp'],
            ['name' => 'Vàng Summer Yellow', 'hex' => '#f59e0b', 'img' => $uploads_url . '/official_vf3.webp'],
            ['name' => 'Xanh Mint Urban Mint', 'hex' => '#10b981', 'img' => $uploads_url . '/official_vf3.webp'],
            ['name' => 'Hồng Rose Pink', 'hex' => '#ec4899', 'img' => $uploads_url . '/official_vf3.webp'],
            ['name' => 'Xám Neptun Grey', 'hex' => '#475569', 'img' => $uploads_url . '/official_vf3.webp'],
            ['name' => 'Xanh Sky Blue', 'hex' => '#3b82f6', 'img' => $uploads_url . '/official_vf3.webp'],
            ['name' => 'Đỏ Crimson Red', 'hex' => '#991b1b', 'img' => $uploads_url . '/official_vf3.webp'],
        ]
    ],
    'vf5' => [
        'title'      => 'VINFAST VF 5 PLUS',
        'sub'        => 'A-SUV Điện Thông Minh Cho Mọi Gia Đình',
        'desc'       => 'VinFast VF 5 Plus là lựa chọn hàng đầu phân khúc A-SUV với không gian rộng rãi, trang bị an toàn vượt trội và chi phí vận hành siêu tiết kiệm.',
        'img'        => $uploads_url . '/official_vf5.webp',
        'cutout'     => $uploads_url . '/cutout_vf5.png',
        'price_eco'  => '496.000.000 VNĐ',
        'price_buy'  => '548.000.000 VNĐ',
        'price_plus' => '496.000.000 VNĐ',
        'hp'         => '134 HP',
        'range'      => '326 KM',
        'accel'      => '37.23 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf5.webp'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_vf5.webp'],
            ['name' => 'Đỏ Crimson Red', 'hex' => '#991b1b', 'img' => $uploads_url . '/official_vf5.webp'],
            ['name' => 'Cam Sunset Orange', 'hex' => '#ea580c', 'img' => $uploads_url . '/official_vf5.webp'],
            ['name' => 'Xanh VinFast Blue', 'hex' => '#2563eb', 'img' => $uploads_url . '/official_vf5.webp'],
            ['name' => 'Bạc Desat Silver', 'hex' => '#94a3b8', 'img' => $uploads_url . '/official_vf5.webp'],
        ]
    ],
    'vf6' => [
        'title'      => 'VINFAST VF 6',
        'sub'        => 'B-SUV Điện Crossover Thời Thượng',
        'desc'       => 'VinFast VF 6 sở hữu đường nét thiết kế tinh tế từ Torino Design, khả năng vận hành linh hoạt cùng khoang nội thất công nghệ hiện đại.',
        'img'        => $uploads_url . '/official_vf6.webp',
        'cutout'     => $uploads_url . '/cutout_vf6.png',
        'price_eco'  => '646.000.000 VNĐ',
        'price_buy'  => '765.000.000 VNĐ',
        'price_plus' => '699.000.000 VNĐ',
        'hp'         => '201 HP',
        'range'      => '399 KM',
        'accel'      => '59.6 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf6.webp'],
            ['name' => 'Xám Neptun Grey', 'hex' => '#475569', 'img' => $uploads_url . '/official_vf6.webp'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_vf6.webp'],
            ['name' => 'Đỏ Crimson Red', 'hex' => '#991b1b', 'img' => $uploads_url . '/official_vf6.webp'],
            ['name' => 'Xanh Moss Green', 'hex' => '#15803d', 'img' => $uploads_url . '/official_vf6.webp'],
        ]
    ],
    'vf7' => [
        'title'      => 'VINFAST VF 7',
        'sub'        => 'C-SUV Điện Đam Mê & Khí Động Học',
        'desc'       => 'VinFast VF 7 mang thiết kế phi thuyền tương lai cuồng nhiệt, động cơ đôi 349 mã lực và hệ dẫn động 2 cầu AWD đỉnh cao.',
        'img'        => $uploads_url . '/official_vf7.webp',
        'cutout'     => $uploads_url . '/cutout_vf7.png',
        'price_eco'  => '740.000.000 VNĐ',
        'price_buy'  => '999.000.000 VNĐ',
        'price_plus' => '920.000.000 VNĐ',
        'hp'         => '349 HP',
        'range'      => '431 KM',
        'accel'      => '75.3 kWh',
        'drive'      => 'AWD (2 Cầu)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf7.webp'],
            ['name' => 'Xám Neptun Grey', 'hex' => '#475569', 'img' => $uploads_url . '/official_vf7.webp'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_vf7.webp'],
            ['name' => 'Đỏ Crimson Red', 'hex' => '#991b1b', 'img' => $uploads_url . '/official_vf7.webp'],
            ['name' => 'Xanh Deep Ocean', 'hex' => '#1e3a8a', 'img' => $uploads_url . '/official_vf7.webp'],
        ]
    ],
    'vf8' => [
        'title'      => 'VINFAST VF 8',
        'sub'        => 'D-SUV Điện Toàn Cầu Đẳng Cấp',
        'desc'       => 'VinFast VF 8 khẳng định đẳng cấp xe điện toàn cầu với thiết kế kiệt tác Ý Pininfarina, công suất 402 HP và gói an toàn ADAS toàn diện.',
        'img'        => $uploads_url . '/official_vf8.webp',
        'cutout'     => $uploads_url . '/cutout_vf8.png',
        'price_eco'  => '898.000.000 VNĐ',
        'price_buy'  => '1.270.000.000 VNĐ',
        'price_plus' => '1.079.000.000 VNĐ',
        'hp'         => '402 HP',
        'range'      => '471 KM',
        'accel'      => '87.7 kWh',
        'drive'      => 'AWD (2 Cầu)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf8.webp'],
            ['name' => 'Xám Neptun Grey', 'hex' => '#475569', 'img' => $uploads_url . '/official_vf8.webp'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_vf8.webp'],
            ['name' => 'Đỏ Crimson Red', 'hex' => '#991b1b', 'img' => $uploads_url . '/official_vf8.webp'],
            ['name' => 'Xanh Deep Ocean', 'hex' => '#1e3a8a', 'img' => $uploads_url . '/official_vf8.webp'],
        ]
    ],
    'vf8_allnew' => [
        'title'      => 'VINFAST VF 8 THE ALL NEW',
        'sub'        => 'D-SUV Điện Hạng Sang Thế Hệ Mới',
        'desc'       => 'Phiên bản VinFast VF 8 The All New đột phá với tầm bay nâng cấp 500 km, nội thất nâng tầng sang trọng và hệ thống trợ lý ảo AI thế hệ mới.',
        'img'        => $uploads_url . '/official_vf8_allnew.png',
        'cutout'     => $uploads_url . '/cutout_vf8_allnew.png',
        'price_eco'  => '899.000.000 VNĐ',
        'price_buy'  => '1.330.000.000 VNĐ',
        'price_plus' => '1.330.000.000 VNĐ',
        'hp'         => '402 HP',
        'range'      => '500 KM',
        'accel'      => '90 kWh',
        'drive'      => 'AWD (2 Cầu)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf8_allnew.png'],
            ['name' => 'Xám Neptun Grey', 'hex' => '#475569', 'img' => $uploads_url . '/official_vf8_allnew.png'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_vf8_allnew.png'],
            ['name' => 'Đỏ Crimson Red', 'hex' => '#991b1b', 'img' => $uploads_url . '/official_vf8_allnew.png'],
        ]
    ],
    'vf2' => [
        'title'      => 'VINFAST VF 2',
        'sub'        => 'Xe Điện Đô Thị Nhỏ Gọn & Hiện Đại',
        'desc'       => 'VinFast VF 2 là mẫu xe điện đô thị siêu nhỏ gọn, thời trang, tối ưu bán kính quay đầu và cực kỳ thuận tiện cho nhu cầu di chuyển hàng ngày.',
        'img'        => $uploads_url . '/official_vf2.png',
        'cutout'     => $uploads_url . '/cutout_vf2.png',
        'price_eco'  => '188.000.000 VNĐ',
        'price_buy'  => '285.000.000 VNĐ',
        'price_plus' => '255.000.000 VNĐ',
        'hp'         => '45 HP',
        'range'      => '170 KM',
        'accel'      => '15.6 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf2.png'],
            ['name' => 'Vàng Summer Yellow', 'hex' => '#f59e0b', 'img' => $uploads_url . '/official_vf2.png'],
            ['name' => 'Hồng Rose Pink', 'hex' => '#ec4899', 'img' => $uploads_url . '/official_vf2.png'],
            ['name' => 'Xanh Sky Blue', 'hex' => '#3b82f6', 'img' => $uploads_url . '/official_vf2.png'],
        ]
    ],
    'mpv7' => [
        'title'      => 'VINFAST VF MPV 7',
        'sub'        => 'MPV Điện 7 Chỗ Rộng Rãi Cho Gia Đình & Kinh Doanh',
        'desc'       => 'VinFast VF MPV 7 mang đến giải pháp di chuyển 7 chỗ đa dụng, khoang hành khách siêu rộng rãi, tiết kiệm chi phí nhiên liệu vượt trội.',
        'img'        => $uploads_url . '/official_mpv7.webp',
        'cutout'     => $uploads_url . '/cutout_mpv7.png',
        'price_eco'  => '750.000.000 VNĐ',
        'price_buy'  => '710.000.000 VNĐ',
        'price_plus' => '680.000.000 VNĐ',
        'hp'         => '174 HP',
        'range'      => '400 KM',
        'accel'      => '60 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_mpv7.webp'],
            ['name' => 'Bạc Desat Silver', 'hex' => '#94a3b8', 'img' => $uploads_url . '/official_mpv7.webp'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_mpv7.webp'],
        ]
    ],
    'ecvan' => [
        'title'      => 'VINFAST EC VAN',
        'sub'        => 'Xe Tải Van Điện Đô Thị Tiên Phong',
        'desc'       => 'VinFast EC Van là dòng xe chở hàng điện đô thị 2 chỗ với thùng hàng rộng rãi, hoạt động 24/7 không lo cấm giờ phố cấm.',
        'img'        => $uploads_url . '/official_ecvan.webp',
        'cutout'     => $uploads_url . '/cutout_ecvan.webp',
        'price_eco'  => '286.000.000 VNĐ',
        'price_buy'  => '345.000.000 VNĐ',
        'price_plus' => '306.000.000 VNĐ',
        'hp'         => '60 HP',
        'range'      => '180 KM',
        'accel'      => '28 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Trắng Thương Mại', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_ecvan.webp'],
            ['name' => 'Bạc Desat Silver', 'hex' => '#94a3b8', 'img' => $uploads_url . '/official_ecvan.webp'],
        ]
    ],
    'minio' => [
        'title'      => 'VINFAST MINIO GREEN',
        'sub'        => 'Xe Taxi Điện Đô Thị Nhỏ Gọn Xanh SM',
        'desc'       => 'VinFast Minio Green là giải pháp giao thông xanh đô thị tối ưu kinh doanh vận tải taxi nhỏ gọn và linh hoạt.',
        'img'        => $uploads_url . '/official_minio.webp',
        'cutout'     => $uploads_url . '/cutout_minio.png',
        'price_eco'  => '199.000.000 VNĐ',
        'price_buy'  => '259.000.000 VNĐ',
        'price_plus' => '220.000.000 VNĐ',
        'hp'         => '43 HP',
        'range'      => '210 KM',
        'accel'      => '19.3 kWh',
        'drive'      => 'RWD (Cầu sau)',
        'colors'     => [
            ['name' => 'Xanh SM Cyan', 'hex' => '#06b6d4', 'img' => $uploads_url . '/official_minio.webp'],
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_minio.webp'],
        ]
    ],
    'herio' => [
        'title'      => 'VINFAST HERIO GREEN',
        'sub'        => 'Xe Taxi Điện Đô Thị Linh Hoạt Xanh SM',
        'desc'       => 'VinFast Herio Green dòng xe taxi điện đô thị 5 chỗ hiện đại, vận hành êm ái mang đến trải nghiệm tuyệt vời cho hành khách.',
        'img'        => $uploads_url . '/official_herio.png',
        'cutout'     => $uploads_url . '/cutout_herio.png',
        'price_eco'  => '468.000.000 VNĐ',
        'price_buy'  => '548.000.000 VNĐ',
        'price_plus' => '498.000.000 VNĐ',
        'hp'         => '134 HP',
        'range'      => '326 KM',
        'accel'      => '37.23 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Xanh SM Cyan', 'hex' => '#06b6d4', 'img' => $uploads_url . '/official_herio.png'],
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_herio.png'],
        ]
    ],
    'nerio' => [
        'title'      => 'VINFAST NERIO GREEN',
        'sub'        => 'Xe Taxi Điện Crossover Đô Thị Xanh SM',
        'desc'       => 'VinFast Nerio Green mang phong cách Crossover thời thượng, tầm hoạt động 399 km đáp ứng kinh doanh taxi công nghệ cao.',
        'img'        => $uploads_url . '/official_nerio.webp',
        'cutout'     => $uploads_url . '/cutout_nerio.png',
        'price_eco'  => '550.000.000 VNĐ',
        'price_buy'  => '650.000.000 VNĐ',
        'price_plus' => '600.000.000 VNĐ',
        'hp'         => '201 HP',
        'range'      => '399 KM',
        'accel'      => '59.6 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Xanh SM Cyan', 'hex' => '#06b6d4', 'img' => $uploads_url . '/official_nerio.webp'],
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_nerio.webp'],
        ]
    ],
    'limo' => [
        'title'      => 'VINFAST LIMO GREEN',
        'sub'        => 'Xe Taxi Điện Hạng Sang Đón Tiễn VIP Xanh SM',
        'desc'       => 'VinFast Limo Green là biểu tượng taxi hạng sang đón tiễn sân bay & khách sạn 5 sao với sự êm ái tuyệt đối.',
        'img'        => $uploads_url . '/official_limo.png',
        'cutout'     => $uploads_url . '/cutout_limo.png',
        'price_eco'  => '699.000.000 VNĐ',
        'price_buy'  => '920.000.000 VNĐ',
        'price_plus' => '870.000.000 VNĐ',
        'hp'         => '201 HP',
        'range'      => '450 KM',
        'accel'      => '75.3 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Xanh SM Cyan', 'hex' => '#06b6d4', 'img' => $uploads_url . '/official_limo.png'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_limo.png'],
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_limo.png'],
        ]
    ],
    'vf9' => [
        'title'      => 'VINFAST VF 9',
        'sub'        => 'E-SUV Điện Đẳng Cấp Thương Gia',
        'desc'       => 'VinFast VF 9 là mẫu SUV điện 7 chỗ hạng sang đỉnh cao của VinFast với tiện nghi vượt trội và công nghệ tối tân.',
        'img'        => $uploads_url . '/official_vf9.webp',
        'cutout'     => $uploads_url . '/cutout_vf9.png',
        'price_eco'  => '1.348.000.000 VNĐ',
        'price_buy'  => '1.984.000.000 VNĐ',
        'price_plus' => '1.529.000.000 VNĐ',
        'hp'         => '402 HP',
        'range'      => '626 KM',
        'accel'      => '123 kWh',
        'drive'      => 'AWD (2 Cầu)',
        'colors'     => [
            ['name' => 'Trắng Brahminy White', 'hex' => '#ffffff', 'img' => $uploads_url . '/official_vf9.webp'],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => $uploads_url . '/official_vf9.webp'],
        ]
    ],
    'vfwild' => [
        'title'      => 'VINFAST VF WILD',
        'sub'        => 'Bán Tải Điện REEV Thông Minh Mở Rộng Phạm Vi',
        'desc'       => 'VinFast VF Wild là mẫu xe bán tải điện thế hệ mới kết hợp động cơ điện 160 kW và máy phát 1.5L, hành trình vượt 1.000 km cùng tiện nghi cắm trại V2L.',
        'img'        => $uploads_url . '/official_vfwild.webp',
        'cutout'     => $uploads_url . '/cutout_vfwild.png',
        'price_eco'  => '860.000.000 VNĐ',
        'price_buy'  => '860.000.000 VNĐ',
        'price_plus' => '872.000.000 VNĐ',
        'hp'         => '215 HP',
        'range'      => '1.000+ KM',
        'accel'      => '46.4 kWh',
        'drive'      => 'FWD (Cầu trước)',
        'colors'     => [
            ['name' => 'Trắng Infinity Blanc', 'hex' => '#ffffff', 'img' => content_url('/uploads/official_cars/vfwild/vfwild_white.webp')],
            ['name' => 'Đen Jet Black', 'hex' => '#0f172a', 'img' => content_url('/uploads/official_cars/vfwild/vfwild_black.webp')],
            ['name' => 'Đỏ Solar Ruby', 'hex' => '#dc2626', 'img' => content_url('/uploads/official_cars/vfwild/vfwild_red.webp')],
            ['name' => 'Bạc Stealth Gray', 'hex' => '#64748b', 'img' => content_url('/uploads/official_cars/vfwild/vfwild_gray.webp')],
        ]
    ]
];

// Determine current car key
$car_key = 'vf5'; // Default fallback
if (strpos($slug, 'vf-wild') !== false || strpos($slug, 'vfwild') !== false || strpos($car_name, 'wild') !== false) $car_key = 'vfwild';
elseif (strpos($slug, 'vf-3') !== false || strpos($slug, 'vf3') !== false || strpos($car_name, 'vf 3') !== false) $car_key = 'vf3';
elseif (strpos($slug, 'vf-5') !== false || strpos($slug, 'vf5') !== false || strpos($car_name, 'vf 5') !== false) $car_key = 'vf5';
elseif (strpos($slug, 'vf-6') !== false || strpos($slug, 'vf6') !== false || strpos($car_name, 'vf 6') !== false) $car_key = 'vf6';
elseif (strpos($slug, 'vf-7') !== false || strpos($slug, 'vf7') !== false || strpos($car_name, 'vf 7') !== false) $car_key = 'vf7';
elseif (strpos($slug, 'vf-8-all') !== false || strpos($slug, 'all-new') !== false || strpos($car_name, 'all new') !== false) $car_key = 'vf8_allnew';
elseif (strpos($slug, 'vf-8') !== false || strpos($slug, 'vf8') !== false || strpos($car_name, 'vf 8') !== false) $car_key = 'vf8';
elseif (strpos($slug, 'vf-9') !== false || strpos($slug, 'vf9') !== false || strpos($car_name, 'vf 9') !== false) $car_key = 'vf9';
elseif (strpos($slug, 'vf-2') !== false || strpos($slug, 'vf2') !== false || strpos($car_name, 'vf 2') !== false) $car_key = 'vf2';
elseif (strpos($slug, 'mpv') !== false || strpos($car_name, 'mpv') !== false) $car_key = 'mpv7';
elseif (strpos($slug, 'ec-van') !== false || strpos($slug, 'ecvan') !== false || strpos($car_name, 'ec van') !== false) $car_key = 'ecvan';
elseif (strpos($slug, 'minio') !== false || strpos($car_name, 'minio') !== false) $car_key = 'minio';
elseif (strpos($slug, 'herio') !== false || strpos($car_name, 'herio') !== false) $car_key = 'herio';
elseif (strpos($slug, 'nerio') !== false || strpos($car_name, 'nerio') !== false) $car_key = 'nerio';
elseif (strpos($slug, 'limo') !== false || strpos($car_name, 'limo') !== false) $car_key = 'limo';

$car = $models_data[$car_key];
?>

<!-- Enqueue Swiper.js & AOS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

<style>
  /* Fullwidth Reset for Flatsome Container */
  #wrapper, #main, .content-area, .page-header {
    padding: 0 !important;
    margin: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
  }
  .page-title, .breadcrumbs { display: none !important; }

  /* Smooth Header Hide & Sticky Subnav Toggle */
  #header, .header-wrapper {
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
  }
  #header.vf-header-hidden, .header-wrapper.vf-header-hidden {
    transform: translateY(-100%) !important;
  }

  /* Sticky Subnav Bar */
  .vf-subnav {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 60px;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid #E2E8F0;
    z-index: 999999;
    display: flex; align-items: center;
    transform: translateY(-100%);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 18px rgba(15,23,42,0.1);
  }
  .vf-subnav.active { transform: translateY(0); }
  .vf-subnav-inner {
    display: flex; align-items: center; justify-content: space-between;
    width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px;
  }
  .vf-subnav-title { font-size: 18px; font-weight: 800; font-style: italic; color: #0F172A; }
  .vf-subnav-links { display: flex; gap: 24px; list-style: none; margin: 0; padding: 0; }
  .vf-subnav-links a { text-decoration: none; color: #64748B; font-size: 13.5px; font-weight: 600; padding: 6px 0; border-bottom: 2px solid transparent; transition: all 0.2s; }
  .vf-subnav-links a.active, .vf-subnav-links a:hover { color: #2563EB; border-bottom-color: #2563EB; }
  .vf-subnav-actions { display: flex; align-items: center; gap: 16px; }
  .vf-subnav-price-val { font-size: 16px; font-weight: 800; color: #2563EB; }

  /* Hero Banner */
  .vf-car-hero {
    position: relative; width: 100%; height: 82vh; min-height: 520px; background: #0F172A; overflow: hidden; display: flex; align-items: flex-end;
  }
  .vf-car-hero-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.88; }
  .vf-car-hero-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15, 23, 42, 0.25) 0%, rgba(15, 23, 42, 0.75) 75%, rgba(15, 23, 42, 0.94) 100%); }
  .vf-car-hero-content { position: relative; z-index: 10; padding-bottom: 60px; color: #ffffff; max-width: 1280px; margin: 0 auto; padding-left: 24px; padding-right: 24px; width: 100%; }
  .vf-car-hero-badge { display: inline-block; background: #2563EB; color: #ffffff; font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; padding: 6px 16px; border-radius: 4px; margin-bottom: 16px; }
  .vf-car-hero-title { font-family: 'Mulish', 'Inter', sans-serif; font-size: clamp(2.5rem, 5vw, 3.8rem); font-weight: 900; line-height: 1.1; margin-bottom: 12px; text-transform: uppercase; letter-spacing: -1px; }
  .vf-car-hero-desc { font-size: 1.1rem; color: rgba(255,255,255,0.9); max-width: 640px; margin-bottom: 28px; }

  /* Buttons */
  .vf-btn {
    height: 44px; line-height: 44px; padding: 0 24px; font-size: 13px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; transition: all 0.2s ease; white-space: nowrap; border: none;
  }
  .vf-btn-primary { background: #2563EB; color: #ffffff; box-shadow: 0 4px 14px rgba(37,99,235,0.25); }
  .vf-btn-primary:hover { background: #1D4ED8; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }
  .vf-btn-outline { background: #ffffff; color: #2563EB; border: 1.5px solid #2563EB; }
  .vf-btn-outline:hover { background: #EFF6FF; }

  /* Studio Configurator */
  .vf-car-configurator { padding: 50px 0 70px; background: #ffffff; }
  .vf-stage-wrap { position: relative; width: 100%; max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: center; padding: 20px 0 10px; overflow: hidden; }
  .vf-stage-car-img { position: relative; z-index: 2; width: 100%; max-width: 960px; height: auto; max-height: 460px; object-fit: contain; transform: scale(1.15); transition: opacity 0.35s ease, transform 0.4s ease; filter: drop-shadow(0 20px 36px rgba(15,23,42,0.12)); }
  .vf-controls-panel { position: relative; z-index: 10; max-width: 1050px; margin: 40px auto 0; background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 40px 48px; box-shadow: 0 10px 36px rgba(15,23,42,0.08); }
  .vf-controls-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
  .vf-option-group-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748B; margin-bottom: 12px; }
  .vf-toggle-group { display: flex; background: #F8FAFC; padding: 4px; border-radius: 8px; border: 1px solid #E2E8F0; }
  .vf-toggle-btn { flex: 1; padding: 10px 16px; font-size: 14px; font-weight: 700; border: none; background: transparent; color: #64748B; border-radius: 6px; cursor: pointer; transition: all 0.2s ease; text-align: center; }
  .vf-toggle-btn.active { background: #ffffff; color: #2563EB; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .vf-color-dots-row { display: flex; gap: 14px; align-items: center; flex-wrap: wrap; }
  .vf-color-dot { width: 38px; height: 38px; border-radius: 50%; border: 3px solid #ffffff; box-shadow: 0 0 0 1px #E2E8F0, 0 4px 8px rgba(0,0,0,0.12); cursor: pointer; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
  .vf-color-dot.active, .vf-color-dot:hover { transform: scale(1.15); box-shadow: 0 0 0 3px #2563EB, 0 6px 14px rgba(37,99,235,0.3); }
  .vf-selected-color-label { font-size: 14px; font-weight: 600; color: #0F172A; margin-top: 8px; }
  .vf-config-price-bar { margin-top: 28px; padding-top: 24px; border-top: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between; }
  .vf-price-amount { font-size: 2.2rem; font-weight: 900; color: #2563EB; line-height: 1.1; }

  /* Section & Cards */
  .vf-car-section { padding: 80px 0; }
  .vf-car-section-alt { background-color: #F8FAFC; }
  .vf-sec-head { text-align: center; max-width: 760px; margin: 0 auto 50px; }
  .vf-sec-label { font-size: 12px; font-weight: 800; letter-spacing: 3px; text-transform: uppercase; color: #2563EB; margin-bottom: 12px; display: block; }
  .vf-sec-title { font-family: 'Mulish', 'Inter', sans-serif; font-size: clamp(2rem, 4vw, 2.6rem); font-weight: 900; line-height: 1.2; margin-bottom: 16px; }
  .vf-sec-desc { font-size: 16px; color: #64748B; line-height: 1.7; }
  .vf-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
  .vf-card { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column; height: 100%; }
  .vf-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(15,23,42,0.12); }
  .vf-card-img { width: 100%; height: 240px; object-fit: cover; flex-shrink: 0; }
  .vf-card-body { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .vf-card-title { font-size: 1.15rem; font-weight: 800; margin-bottom: 8px; }
  .vf-card-desc { font-size: 14px; color: #64748B; line-height: 1.6; }

  /* Interior Hero */
  .vf-interior-hero { position: relative; width: 100%; height: 540px; border-radius: 16px; overflow: hidden; margin-top: 32px; }
  .vf-interior-hero-img { width: 100%; height: 100%; object-fit: cover; }
  .vf-interior-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.85) 100%); display: flex; align-items: flex-end; padding: 48px; color: #ffffff; }

  /* Performance Stats */
  .vf-perf-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 40px; }
  .vf-stat-box { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 32px 20px; text-align: center; box-shadow: 0 4px 14px rgba(0,0,0,0.05); }
  .vf-stat-val { font-size: 3.2rem; font-weight: 900; color: #2563EB; line-height: 1; margin-bottom: 8px; }
  .vf-stat-lbl { font-size: 13px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; }

  @media (max-width: 992px) {
    .vf-controls-grid, .vf-grid-3 { grid-template-columns: 1fr; }
    .vf-perf-stats-grid { grid-template-columns: 1fr 1fr; }
  }
</style>

<!-- Sticky Subnav Bar -->
 <div class="vf-subnav" id="carStickySubnav">
  <div class="vf-subnav-inner">
    <div class="vf-subnav-title"><?php echo esc_html($car['title']); ?></div>
    <ul class="vf-subnav-links">
      <li><a href="#tong-quan" class="active">Tổng quan</a></li>
      <li><a href="#configurator">Màu sắc & Giá</a></li>
      <li><a href="#ngoai-that">Ngoại thất</a></li>
      <li><a href="#noi-that">Nội thất</a></li>
      <li><a href="#van-hanh">Vận hành</a></li>
    </ul>
    <div class="vf-subnav-actions">
      <div class="vf-subnav-price-wrap">
        <span style="font-size:11px; color:#64748B;">Giá niêm yết từ</span>
        <span class="vf-subnav-price-val" id="subnav-price-display"><?php echo esc_html($car['price_eco']); ?></span>
      </div>
      <a href="<?php echo esc_url(home_url('/dat-coc/')); ?>" class="vf-btn vf-btn-primary">ĐẶT CỌC NGAY</a>
    </div>
  </div>
</div>

<!-- 1. HERO BANNER CHÍNH HÃNG -->
<section class="vf-car-hero" id="tong-quan">
  <img src="<?php echo esc_url($car['img']); ?>" alt="<?php echo esc_attr($car['title']); ?> Banner" class="vf-car-hero-bg">
  <div class="vf-car-hero-overlay"></div>
  <div class="vf-car-hero-content" data-aos="fade-up">
    <span class="vf-car-hero-badge"><?php echo esc_html($car['sub']); ?></span>
    <h1 class="vf-car-hero-title"><?php echo esc_html($car['title']); ?></h1>
    <p class="vf-car-hero-desc"><?php echo esc_html($car['desc']); ?></p>
    <div style="display: flex; gap: 16px;">
      <a href="#configurator" class="vf-btn vf-btn-primary">TÙY CHỈNH CẤU HÌNH XE</a>
      <a href="<?php echo esc_url(home_url('/mua-xe-tra-gop/')); ?>" class="vf-btn vf-btn-outline" style="color:#fff; border-color:#fff;">DỰ TOÁN TRẢ GÓP</a>
    </div>
  </div>
</section>

<!-- 2. TRÌNH CẤU HÌNH XE STUDIO -->
<section class="vf-car-configurator" id="configurator">
  <div class="container">
    <div class="vf-sec-head" data-aos="fade-up">
      <span class="vf-sec-label">Trình tùy chỉnh trực quan</span>
      <h2 class="vf-sec-title">Khám Phá Cấu Hình <?php echo esc_html($car['title']); ?></h2>
      <p class="vf-sec-desc">Tùy chọn màu sắc ngoại thất chính hãng, phiên bản trang bị và giá niêm yết</p>
    </div>

    <!-- Canvas Xe Studio Cutout -->
    <div class="vf-stage-wrap">
      <img id="carStageImg" src="<?php echo esc_url($car['cutout']); ?>" alt="<?php echo esc_attr($car['title']); ?> Cutout Render" class="vf-stage-car-img">
    </div>

    <!-- Bảng Điều Khiển Cấu Hình -->
    <div class="vf-controls-panel" data-aos="fade-up">
      <div class="vf-controls-grid">
        
        <!-- Chọn Màu Ngoại Thất -->
        <div>
          <div class="vf-option-group-title">Chọn màu ngoại thất chính hãng:</div>
          <div class="vf-color-dots-row">
            <?php foreach ($car['colors'] as $idx => $c): ?>
            <button class="vf-color-dot <?php echo $idx === 0 ? 'active' : ''; ?>" 
                    style="background: <?php echo esc_attr($c['hex']); ?>;" 
                    data-img="<?php echo esc_url($c['img']); ?>" 
                    data-color="<?php echo esc_attr($c['name']); ?>">
            </button>
            <?php endforeach; ?>
          </div>
          <div class="vf-selected-color-label" id="carColorLabel">Màu đang chọn: <?php echo esc_html($car['colors'][0]['name']); ?></div>
        </div>

        <!-- Chọn Phiên Bản & Pin -->
        <div>
          <div class="vf-option-group-title">Chọn phiên bản trang bị:</div>
          <div class="vf-toggle-group" style="margin-bottom: 16px;">
            <button class="vf-toggle-btn active" onclick="setCarVersion('eco', this)">Phiên bản ECO</button>
            <button class="vf-toggle-btn" onclick="setCarVersion('plus', this)">Phiên bản PLUS</button>
          </div>

          <div class="vf-option-group-title">Hình thức sở hữu Pin:</div>
          <div class="vf-toggle-group">
            <button class="vf-toggle-btn active" onclick="setCarBattery('thue', this)">Thuê Pin Hàng Tháng</button>
            <button class="vf-toggle-btn" onclick="setCarBattery('mua', this)">Mua Đứt Pin</button>
          </div>
        </div>

      </div>

      <!-- Price Counter Bar -->
      <div class="vf-config-price-bar">
        <div>
          <div class="vf-sec-label" style="margin: 0;">Giá niêm yết xe (Đã bao gồm VAT):</div>
          <div class="vf-price-amount" id="carDynamicPrice"><?php echo esc_html($car['price_eco']); ?></div>
          <div style="font-size: 12px; color: #64748B;">*Ưu đãi hỗ trợ chi phí chuyển đổi xe xăng sang xe điện VinFast chính hãng</div>
        </div>
        <div style="display: flex; gap: 12px;">
          <a href="<?php echo esc_url(home_url('/mua-xe-tra-gop/')); ?>" class="vf-btn vf-btn-outline">DỰ TOÁN CHI PHÍ</a>
          <a href="<?php echo esc_url(home_url('/dat-coc/')); ?>" class="vf-btn vf-btn-primary">ĐẶT CỌC ONLINE</a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3. NGOẠI THẤT HIGHLIGHTS -->
<section class="vf-car-section vf-car-section-alt" id="ngoai-that">
  <div class="container">
    <div class="vf-sec-head" data-aos="fade-up">
      <span class="vf-sec-label">Ngoại thất & Thiết kế</span>
      <h2 class="vf-sec-title">Kiệt Tác Thiết Kế Hiện Đại</h2>
      <p class="vf-sec-desc">Đường nét thiết kế tinh tế, dải LED cánh nhạn nhận diện thương hiệu VinFast cùng kiểu dáng khí động học vượt trội.</p>
    </div>

    <div class="vf-grid-3">
      <div class="vf-card" data-aos="fade-up">
        <img src="<?php echo esc_url($car['img']); ?>" alt="Đèn LED Matrix" class="vf-card-img">
        <div class="vf-card-body">
          <h3 class="vf-card-title">Hệ Thống Đèn Full-LED Matrix</h3>
          <p class="vf-card-desc">Dải LED nhận diện cánh nhạn thương hiệu VinFast nổi bật phía trước và sau tích hợp công nghệ chiếu sáng thông minh.</p>
        </div>
      </div>
      <div class="vf-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($car['cutout']); ?>" alt="Thân xe khí động học" class="vf-card-img">
        <div class="vf-card-body">
          <h3 class="vf-card-title">Thiết Kế Khí Động Học Tối Ưu</h3>
          <p class="vf-card-desc">Kiểu dáng thân xe tối ưu hệ số cản gió, mang đến sự êm ái tuyệt đối và tiết kiệm năng lượng trên hành trình dài.</p>
        </div>
      </div>
      <div class="vf-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($car['img']); ?>" alt="Mâm hợp kim thể thao" class="vf-card-img">
        <div class="vf-card-body">
          <h3 class="vf-card-title">Mâm Hợp Kim Thể Thao</h3>
          <p class="vf-card-desc">Bộ la-zăng hợp kim thể thao phay 2 màu hiện đại cùng lốp chất lượng cao bám đường vượt trội.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. NỘI THẤT HIGHLIGHTS -->
<section class="vf-car-section" id="noi-that">
  <div class="container">
    <div class="vf-sec-head" data-aos="fade-up">
      <span class="vf-sec-label">Nội thất & Tiện nghi</span>
      <h2 class="vf-sec-title">Không Gian Lái Tiện Nghi & Số Hóa</h2>
      <p class="vf-sec-desc">Nội thất cao cấp tích hợp màn hình trung tâm độ phân giải cao và toàn bộ tiện nghi thông minh tiên phong.</p>
    </div>

    <div class="vf-grid-3">
      <div class="vf-card" data-aos="fade-up">
        <img src="<?php echo esc_url($car['img']); ?>" alt="Màn hình trung tâm" class="vf-card-img">
        <div class="vf-card-body">
          <h3 class="vf-card-title">Màn Hình Trung Tâm Sắc Nét</h3>
          <p class="vf-card-desc">Tích hợp toàn bộ tính năng giải trí, bản đồ chỉ đường thông minh và điều khiển không gian xe.</p>
        </div>
      </div>
      <div class="vf-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($car['cutout']); ?>" alt="Ghế bọc da cao cấp" class="vf-card-img">
        <div class="vf-card-body">
          <h3 class="vf-card-title">Ghế Bọc Da Cao Cấp Ergonomic</h3>
          <p class="vf-card-desc">Ghế thiết kế ôm sát cơ thể tích hợp chỉnh điện đa hướng, mang lại cảm giác thoải mái nhất cho người lái.</p>
        </div>
      </div>
      <div class="vf-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($car['img']); ?>" alt="Âm thanh vòm" class="vf-card-img">
        <div class="vf-card-body">
          <h3 class="vf-card-title">Hệ Thống Âm Thanh Sống Động</h3>
          <p class="vf-card-desc">Dàn âm thanh vòm chất lượng cao sống động như không gian rạp hát thu nhỏ.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 5. HIỆU NĂNG VẬN HÀNH -->
<section class="vf-car-section vf-car-section-alt" id="van-hanh">
  <div class="container">
    <div class="vf-sec-head" data-aos="fade-up">
      <span class="vf-sec-label">Sức mạnh động cơ điện</span>
      <h2 class="vf-sec-title">Vận Hành Mạnh Mẽ — Tầm Bay <?php echo esc_html($car['range']); ?></h2>
      <p class="vf-sec-desc">Động cơ điện tiên phong cho khả năng bứt tốc mượt mà và chi phí bảo dưỡng tối ưu.</p>
    </div>

    <div class="vf-perf-stats-grid" data-aos="zoom-in">
      <div class="vf-stat-box">
        <div class="vf-stat-val"><?php echo esc_html($car['hp']); ?></div>
        <div class="vf-stat-lbl">Công Suất Tối Đa</div>
      </div>
      <div class="vf-stat-box">
        <div class="vf-stat-val"><?php echo esc_html($car['range']); ?></div>
        <div class="vf-stat-lbl">Quãng Đường / Sạc</div>
      </div>
      <div class="vf-stat-box">
        <div class="vf-stat-val"><?php echo esc_html($car['accel']); ?></div>
        <div class="vf-stat-lbl">Dung Lượng Pin Usable</div>
      </div>
      <div class="vf-stat-box">
        <div class="vf-stat-val"><?php echo esc_html($car['drive']); ?></div>
        <div class="vf-stat-lbl">Hệ Dẫn Động</div>
      </div>
    </div>
  </div>
</section>

<!-- JS Logic for Color & Price Counter -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  const priceEco = "<?php echo esc_js($car['price_eco']); ?>";
  const pricePlus = "<?php echo esc_js($car['price_plus']); ?>";
  const priceBuy = "<?php echo esc_js($car['price_buy']); ?>";

  let curVer = 'eco';
  let curBat = 'thue';

  function updatePrice() {
    let p = priceEco;
    if (curBat === 'mua') {
      p = priceBuy;
    } else if (curVer === 'plus') {
      p = pricePlus;
    }
    document.getElementById('carDynamicPrice').innerText = p;
    document.getElementById('subnav-price-display').innerText = p;
  }

  function setCarVersion(v, btn) {
    curVer = v;
    btn.parentElement.querySelectorAll('.vf-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updatePrice();
  }

  function setCarBattery(b, btn) {
    curBat = b;
    btn.parentElement.querySelectorAll('.vf-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updatePrice();
  }

  document.querySelectorAll('.vf-color-dot').forEach(dot => {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf-color-dot').forEach(d => d.classList.remove('active'));
      this.classList.add('active');
      const colorName = this.getAttribute('data-color');
      const colorImg  = this.getAttribute('data-img');
      document.getElementById('carColorLabel').innerText = 'Màu đang chọn: ' + colorName;
      const stageImg = document.getElementById('carStageImg');
      if (stageImg && colorImg) {
        stageImg.style.opacity = '0';
        setTimeout(() => {
          stageImg.src = colorImg;
          stageImg.style.opacity = '1';
        }, 200);
      }
    });
  });

  window.addEventListener('scroll', function() {
    const subnav = document.getElementById('carStickySubnav');
    const header = document.getElementById('header');
    const headerWrapper = document.querySelector('.header-wrapper');
    if (window.scrollY > 100) {
      if (subnav) subnav.classList.add('active');
      if (header) header.classList.add('vf-header-hidden');
      if (headerWrapper) headerWrapper.classList.add('vf-header-hidden');
    } else {
      if (subnav) subnav.classList.remove('active');
      if (header) header.classList.remove('vf-header-hidden');
      if (headerWrapper) headerWrapper.classList.remove('vf-header-hidden');
    }
  });
</script>

<?php get_footer(); ?>