<?php
/**
 * Template Name: Trang chủ VinFast Minh Ngân
 * Description: Giao diện Premium Showroom đạt chuẩn Concept A — VinFast Minh Ngân Phú Thọ 3S
 * The car is the hero. The experience is premium.
 */
defined('ABSPATH') || exit;

get_header();

$theme_uri = get_stylesheet_directory_uri();
$cars_uri  = $theme_uri . '/assets/images/vinfast-cars/';

// Danh sách xe điện cá nhân chính hãng VinFast (dữ liệu hiển thị chuẩn showroom)
$personal_cars = [
    [
        'name'     => 'VinFast VF 3',
        'segment'  => 'Mini SUV Đô Thị',
        'badge'    => 'BÁN CHẠY',
        'badge_bg' => '#DC2626',
        'image'    => $cars_uri . 'official_vf3.webp',
        'range'    => '210 km',
        'seats'    => '4 Chỗ',
        'price'    => '240.000.000 đ',
        'slug'     => 'vinfast-vf-3',
    ],
    [
        'name'     => 'VinFast VF 5 Plus',
        'segment'  => 'A-SUV Đa Dụng',
        'badge'    => '',
        'badge_bg' => '',
        'image'    => $cars_uri . 'official_vf5.webp',
        'range'    => '326 km',
        'seats'    => '5 Chỗ',
        'price'    => '468.000.000 đ',
        'slug'     => 'vinfast-vf-5',
    ],
    [
        'name'     => 'VinFast VF 6',
        'segment'  => 'B-SUV Thời Thượng',
        'badge'    => '',
        'badge_bg' => '',
        'image'    => $cars_uri . 'official_vf6.webp',
        'range'    => '399 km',
        'seats'    => '5 Chỗ',
        'price'    => '675.000.000 đ',
        'slug'     => 'vinfast-vf-6',
    ],
    [
        'name'     => 'VinFast VF 7',
        'segment'  => 'C-SUV Thể Thao Cao Cấp',
        'badge'    => 'NỔI BẬT',
        'badge_bg' => '#2563EB',
        'image'    => $cars_uri . 'official_vf7.webp',
        'range'    => '431 km',
        'seats'    => '5 Chỗ',
        'price'    => '850.000.000 đ',
        'slug'     => 'vinfast-vf-7',
    ],
    [
        'name'     => 'VinFast VF 8',
        'segment'  => 'D-SUV Sang Trọng',
        'badge'    => '',
        'badge_bg' => '',
        'image'    => $cars_uri . 'official_vf8_allnew.png',
        'range'    => '471 km',
        'seats'    => '5 Chỗ',
        'price'    => '1.090.000.000 đ',
        'slug'     => 'vinfast-vf-8',
    ],
    [
        'name'     => 'VinFast VF 9',
        'segment'  => 'E-SUV Flagship Đẳng Cấp',
        'badge'    => 'FLAGSHIP',
        'badge_bg' => '#111827',
        'image'    => $cars_uri . 'official_vf9.webp',
        'range'    => '602 km',
        'seats'    => '6 - 7 Chỗ',
        'price'    => '1.589.000.000 đ',
        'slug'     => 'vinfast-vf-9',
    ],
];

// Danh sách xe thương mại Green Series
$commercial_cars = [
    [
        'name'     => 'Minio Green',
        'segment'  => 'Đô Thị Vận Tải Nhỏ Gọn',
        'image'    => $cars_uri . 'official_minio.webp',
        'range'    => '220 km',
        'seats'    => '2 - 4 Chỗ',
        'price'    => 'Liên hệ nhận giá',
        'slug'     => 'minio-green',
    ],
    [
        'name'     => 'Herio Green',
        'segment'  => 'Dịch Vụ Đón Tiễn Sang Trọng',
        'image'    => $cars_uri . 'official_herio.png',
        'range'    => '350 km',
        'seats'    => '5 Chỗ',
        'price'    => 'Liên hệ nhận giá',
        'slug'     => 'herio-green',
    ],
    [
        'name'     => 'Limo Green',
        'segment'  => 'Đưa Đón Chuyên Cơ Mặt Đất',
        'image'    => $cars_uri . 'official_limo.png',
        'range'    => '450 km',
        'seats'    => '7 Chỗ VIP',
        'price'    => 'Liên hệ nhận giá',
        'slug'     => 'limo-green',
    ],
    [
        'name'     => 'EC Van',
        'segment'  => 'Xe Tải Điện Vận Chuyển Hàng',
        'image'    => $cars_uri . 'official_ecvan.webp',
        'range'    => '280 km',
        'seats'    => 'Tải trọng 950 kg',
        'price'    => 'Liên hệ nhận giá',
        'slug'     => 'ec-van',
    ],
];

// Lấy 3 bài tin tức mới nhất từ WordPress (nếu có)
$recent_posts = get_posts([
    'numberposts' => 3,
    'post_status' => 'publish',
]);

// Cấu hình Slide Hero Showcase (Hỗ trợ ACF Repeater hoặc Fallback mặc định chuẩn Showroom)
$default_hero_slides = [
    [
        'eyebrow'      => 'VINFAST VF 7 • ALL-ELECTRIC SUV',
        'badge'        => 'Tiêu điểm',
        'badge_class'  => '',
        'title'        => 'Bứt Phá Giới Hạn<br><span class="text-gradient">Công Nghệ Tương Lai</span>',
        'desc'         => 'Thiết kế phi đối xứng định hình phong cách thời thượng, công suất 349 mã lực uy lực, dẫn động 2 cầu toàn thời gian AWD và quãng đường di chuyển 496 km.',
        'btn_primary'  => ['text' => 'Khám phá VF 7', 'url' => '#collection'],
        'btn_secondary'=> ['text' => 'Đăng ký lái thử', 'url' => home_url('/dang-ky-lai-thu/')],
        'image'        => $cars_uri . 'official_vf7.webp',
        'alt'          => 'VinFast VF 7 Plus — SUV điện thể thao thời thượng',
        'specs'        => [
            ['val' => '349 <small>HP</small>', 'lbl' => 'Công suất tối đa'],
            ['val' => '496 <small>km</small>', 'lbl' => 'Tầm hoạt động'],
            ['val' => '5.8 <small>giây</small>', 'lbl' => '0-100 km/h'],
        ],
        'is_service'   => false,
    ],
    [
        'eyebrow'      => 'VINFAST VF 8 • D-SEGMENT LUXURY SUV',
        'badge'        => 'Quốc tế',
        'badge_class'  => 'badge-gold',
        'title'        => 'Tiên Phong Đẳng Cấp<br><span class="text-gradient">Sang Trọng Toàn Cầu</span>',
        'desc'         => 'Chuẩn an toàn 5 sao hàng đầu thế giới, hệ thống lái tự động thông minh ADAS cấp độ 2 và trợ lý ảo Vivi điều khiển giọng nói tiếng Việt đa vùng miền.',
        'btn_primary'  => ['text' => 'Khám phá VF 8', 'url' => '#collection'],
        'btn_secondary'=> ['text' => 'Dự toán lăn bánh', 'url' => home_url('/du-toan-chi-phi/')],
        'image'        => $cars_uri . 'official_vf8.webp',
        'alt'          => 'VinFast VF 8 — SUV điện hạng D thông minh toàn cầu',
        'specs'        => [
            ['val' => '402 <small>HP</small>', 'lbl' => 'Công suất (Plus)'],
            ['val' => '471 <small>km</small>', 'lbl' => 'Quãng đường (WLTP)'],
            ['val' => 'Level 2', 'lbl' => 'Trợ lái ADAS'],
        ],
        'is_service'   => false,
    ],
    [
        'eyebrow'      => 'VINFAST MINH NGÂN • ĐẠI LÝ ỦY QUYỀN 3S',
        'badge'        => 'Chính hãng',
        'badge_class'  => 'badge-green',
        'title'        => 'Xưởng Dịch Vụ 3S<br><span class="text-gradient">Tiêu Chuẩn Toàn Diện</span>',
        'desc'         => 'Hệ thống máy chẩn đoán kỹ thuật hiện đại, kỹ thuật viên đào tạo chuyên sâu bởi VinFast Việt Nam, dịch vụ cứu hộ pin 24/7 và cam kết bảo hành tới 10 năm.',
        'btn_primary'  => ['text' => 'Đặt lịch dịch vụ', 'url' => home_url('/dat-lich-dich-vu/')],
        'btn_secondary'=> ['text' => 'Hotline 0981 33 55 22', 'url' => 'tel:0981335522'],
        'image'        => 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&q=80&w=1200',
        'alt'          => 'Xưởng dịch vụ kỹ thuật tiêu chuẩn VinFast Minh Ngân Phú Thọ',
        'specs'        => [
            ['val' => '10 <small>năm</small>', 'lbl' => 'Bảo hành xe điện'],
            ['val' => '24/7', 'lbl' => 'Cứu hộ pin lưu động'],
            ['val' => '100%', 'lbl' => 'Phụ tùng chính hãng'],
        ],
        'is_service'   => true,
    ],
];

// Cho phép nạp từ ACF nếu quản trị viên đã cấu hình
$hero_slides = $default_hero_slides;
if (function_exists('get_field')) {
    $acf_slides = get_field('hero_slides');
    if (!empty($acf_slides) && is_array($acf_slides)) {
        // Tùy biến mapping từ ACF repeater
    }
}
$slide_duration = 8000;
?>

<div class="homepage-premium-wrapper">

  <!-- ========================================================================
       SECTION 01: CINEMATIC MOTION HERO & DYNAMIC CAR SLIDER
       ======================================================================== -->
  <section class="cinematic-hero" id="hero" role="region" aria-roledescription="carousel" aria-label="Showroom Ô Tô Điện VinFast Minh Ngân">

    <!-- STAGE BACKGROUND & AMBIENT SPOTLIGHT -->
    <div class="hero-stage-bg" id="heroStageBg">
      <div class="stage-gradient"></div>
      <div class="stage-spotlight"></div>
      <div class="stage-grid"></div>

      <!-- OPTIONAL VIDEO HERO CONTAINER (Hỗ trợ cấu hình từ Admin) -->
      <div class="hero-video-wrap" id="heroVideoWrap" aria-hidden="true">
        <video class="hero-bg-video" id="heroBgVideo" muted loop playsinline poster="<?php echo esc_url($cars_uri . 'official_vf7.webp'); ?>">
          <source src="" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
      </div>
    </div>

    <!-- SLIDES WRAPPER -->
    <div class="hero-slider-track" id="heroTrack">
      <?php foreach ($hero_slides as $index => $slide) : ?>
        <article class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>"
                 data-index="<?php echo esc_attr($index); ?>"
                 aria-label="<?php echo esc_attr(wp_strip_all_tags($slide['eyebrow'])); ?>">
          <div class="slide-container">

            <!-- Cột chữ (Eyebrow -> Heading H1 -> Description -> 2 CTAs) -->
            <div class="slide-content">
              <div class="slide-eyebrow animate-child">
                <span class="eyebrow-dot"></span>
                <span class="eyebrow-text"><?php echo esc_html($slide['eyebrow']); ?></span>
                <?php if (!empty($slide['badge'])) : ?>
                  <span class="badge-featured <?php echo esc_attr($slide['badge_class']); ?>"><?php echo esc_html($slide['badge']); ?></span>
                <?php endif; ?>
              </div>

              <h1 class="slide-title animate-child">
                <?php echo wp_kses_post($slide['title']); ?>
              </h1>

              <p class="slide-desc animate-child">
                <?php echo esc_html($slide['desc']); ?>
              </p>

              <div class="slide-actions animate-child">
                <a href="<?php echo esc_url($slide['btn_primary']['url']); ?>" class="btn-hero btn-hero-primary" role="button">
                  <span><?php echo esc_html($slide['btn_primary']['text']); ?></span>
                  <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                <a href="<?php echo esc_url($slide['btn_secondary']['url']); ?>" class="btn-hero btn-hero-secondary" role="button">
                  <?php if (strpos($slide['btn_secondary']['url'], 'tel:') !== false) : ?>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                  <?php else : ?>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 10.9 2 11.2 2 11.5V16c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><path d="M9 17h6"></path><circle cx="17" cy="17" r="2"></circle></svg>
                  <?php endif; ?>
                  <span><?php echo esc_html($slide['btn_secondary']['text']); ?></span>
                </a>
              </div>
            </div>

            <!-- Cột hình ảnh (Ảnh xe lớn -> Bảng thông số kỹ thuật bên dưới) -->
            <div class="slide-visual">
              <div class="car-stage <?php echo $slide['is_service'] ? 'service-stage' : ''; ?> animate-car">
                <img src="<?php echo esc_url($slide['image']); ?>"
                     alt="<?php echo esc_attr($slide['alt']); ?>"
                     class="car-image <?php echo $slide['is_service'] ? 'service-image' : ''; ?>"
                     width="760"
                     height="420"
                     <?php echo $index === 0 ? 'fetchpriority="high" loading="eager"' : 'loading="lazy"'; ?>>
                <?php if ($slide['is_service']) : ?>
                  <div class="service-badge-verify">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    <span>Chứng nhận Đại lý 3S Chính Thức</span>
                  </div>
                <?php else : ?>
                  <div class="car-shadow"></div>
                <?php endif; ?>
              </div>

              <!-- Spec Bar Gắn Liền Với Xe -->
              <div class="hero-spec-strip animate-specs" aria-label="Thông số kỹ thuật nổi bật">
                <?php foreach ($slide['specs'] as $s_idx => $spec) : ?>
                  <?php if ($s_idx > 0) : ?>
                    <div class="spec-divider" aria-hidden="true"></div>
                  <?php endif; ?>
                  <div class="spec-col">
                    <span class="spec-num"><?php echo wp_kses_post($spec['val']); ?></span>
                    <span class="spec-label"><?php echo esc_html($spec['lbl']); ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- SLIDER CONTROLS (Prev / Next & Pause) -->
    <div class="hero-controls" aria-label="Điều khiển trình chiếu">
      <button type="button" class="ctrl-btn ctrl-prev" id="btnPrev" aria-label="Slide trước">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
      </button>

      <button type="button" class="ctrl-btn ctrl-pause" id="btnPause" aria-label="Tạm dừng trình chiếu" title="Tạm dừng / Tiếp tục">
        <svg class="icon-pause" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><rect x="6" y="4" width="4" height="16"></rect><rect x="14" y="4" width="4" height="16"></rect></svg>
        <svg class="icon-play" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
      </button>

      <button type="button" class="ctrl-btn ctrl-next" id="btnNext" aria-label="Slide tiếp theo">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </button>
    </div>

    <!-- SLIDER INDICATORS & REAL-TIME PROGRESS TRACK -->
    <nav class="hero-indicators" aria-label="Chỉ mục các slide">
      <button type="button" class="ind-pill active" data-slide="0" aria-label="Đi đến slide 1: VinFast VF 7" aria-current="true">
        <span class="ind-title"><span class="ind-full">01 • </span>VF 7</span>
        <span class="ind-bar"><span class="ind-progress"></span></span>
      </button>
      <button type="button" class="ind-pill" data-slide="1" aria-label="Đi đến slide 2: VinFast VF 8">
        <span class="ind-title"><span class="ind-full">02 • </span>VF 8</span>
        <span class="ind-bar"><span class="ind-progress"></span></span>
      </button>
      <button type="button" class="ind-pill" data-slide="2" aria-label="Đi đến slide 3: Showroom 3S">
        <span class="ind-title"><span class="ind-full">03 • </span>Showroom 3S</span>
        <span class="ind-bar"><span class="ind-progress"></span></span>
      </button>
    </nav>

  </section>

  <!-- ========================================================================
       SECTION 02: CAR COLLECTION (SHOWROOM GALLERY)
       ======================================================================== -->
  <section class="collection-section" id="collection">
    <div class="container">
      <div class="section-header-row">
        <div class="section-header-text">
          <span class="eyebrow">BỘ SƯU TẬP XE ĐIỆN VINFAST</span>
          <h2 class="heading-section">Khám phá bộ sưu tập xe điện.</h2>
          <p class="body-regular">Đa dạng lựa chọn từ mẫu xe đô thị nhỏ gọn đến SUV cao cấp hàng đầu.</p>
        </div>
        <!-- Category Filter Tabs Responsive (Premium Pill Segmented Control) -->
        <div class="collection-tabs-wrap">
          <div class="collection-tabs" role="tablist" aria-label="Bộ lọc dòng xe">
          <button class="tab-btn active" id="tabPersonal" role="tab" aria-selected="true">
            <span class="tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/>
                <circle cx="7" cy="17" r="2"/>
                <path d="M9 17h6"/>
                <circle cx="17" cy="17" r="2"/>
              </svg>
            </span>
            <span class="tab-label">Xe Cá Nhân</span>
            <span class="tab-count"><?php echo count($personal_cars); ?></span>
          </button>
          <button class="tab-btn" id="tabCommercial" role="tab" aria-selected="false">
            <span class="tab-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13" rx="2"/>
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/>
                <circle cx="5.5" cy="18.5" r="2.5"/>
                <circle cx="18.5" cy="18.5" r="2.5"/>
              </svg>
            </span>
            <span class="tab-label">Xe Thương Mại</span>
            <span class="tab-count"><?php echo count($commercial_cars); ?></span>
          </button>
          </div>
        </div>
      </div>

      <!-- Personal Cars Grid -->
      <div class="car-grid" id="gridPersonal">
        <?php foreach ($personal_cars as $car) : ?>
        <article class="car-card">
          <div class="card-top">
            <div class="card-title-wrap">
              <h3 class="card-car-name"><?php echo esc_html($car['name']); ?></h3>
              <span class="card-car-segment"><?php echo esc_html($car['segment']); ?></span>
            </div>
            <?php if (!empty($car['badge'])) : ?>
              <span class="demo-tag" style="<?php echo !empty($car['badge_bg']) ? 'background:' . esc_attr($car['badge_bg']) . '; color:#fff;' : ''; ?>">
                <?php echo esc_html($car['badge']); ?>
              </span>
            <?php endif; ?>
          </div>
          <div class="card-image-wrap">
            <img src="<?php echo esc_url($car['image']); ?>" alt="<?php echo esc_attr($car['name']); ?>" loading="lazy">
          </div>
          <div class="card-specs-row">
            <div class="card-spec-item">
              <span class="card-spec-val"><?php echo esc_html($car['range']); ?></span>
              <span class="card-spec-lbl">Tầm di chuyển</span>
            </div>
            <div class="card-spec-item" style="text-align: right;">
              <span class="card-spec-val"><?php echo esc_html($car['seats']); ?></span>
              <span class="card-spec-lbl">Số chỗ ngồi</span>
            </div>
          </div>
          <div class="card-footer">
            <div class="card-price-group">
              <span class="card-price-lbl">Giá niêm yết (DEMO)</span>
              <span class="card-price-val"><?php echo esc_html($car['price']); ?></span>
            </div>
            <a href="<?php echo esc_url(home_url('/product/' . $car['slug'] . '/')); ?>" class="btn btn-secondary card-btn">Khám phá</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>

      <!-- Commercial Cars Grid (Green Series Tab) -->
      <div class="car-grid" id="gridCommercial" style="display: none;">
        <?php foreach ($commercial_cars as $car) : ?>
        <article class="car-card">
          <div class="card-top">
            <div class="card-title-wrap">
              <h3 class="card-car-name"><?php echo esc_html($car['name']); ?></h3>
              <span class="card-car-segment"><?php echo esc_html($car['segment']); ?></span>
            </div>
          </div>
          <div class="card-image-wrap">
            <img src="<?php echo esc_url($car['image']); ?>" alt="<?php echo esc_attr($car['name']); ?>" loading="lazy">
          </div>
          <div class="card-specs-row">
            <div class="card-spec-item">
              <span class="card-spec-val"><?php echo esc_html($car['range']); ?></span>
              <span class="card-spec-lbl">Tầm di chuyển</span>
            </div>
            <div class="card-spec-item" style="text-align: right;">
              <span class="card-spec-val"><?php echo esc_html($car['seats']); ?></span>
              <span class="card-spec-lbl">Cấu hình</span>
            </div>
          </div>
          <div class="card-footer">
            <div class="card-price-group">
              <span class="card-price-lbl">Giá dự kiến (DEMO)</span>
              <span class="card-price-val"><?php echo esc_html($car['price']); ?></span>
            </div>
            <a href="tel:0981335522" class="btn btn-secondary card-btn">Báo giá</a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ========================================================================
       SECTION 03: AFTER-SALES EXPERIENCE (3S SERVICE — CORRECTED VISUAL)
       ======================================================================== -->
  <section class="service-section" id="service">
    <div class="container">
      <div class="service-grid">
        <!-- Service Visual Left: Ảnh xưởng kỹ thuật sửa chữa bảo dưỡng xe hơi cao cấp -->
        <div class="service-visual">
          <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&q=80&w=1000"
               alt="Xưởng dịch vụ kỹ thuật tiêu chuẩn VinFast Minh Ngân Phú Thọ"
               loading="lazy">
          <div class="service-badge">
            ✓ XƯỞNG DỊCH VỤ 3S TIÊU CHUẨN TOÀN CẦU
          </div>
        </div>

        <!-- Service Content Right -->
        <div class="service-content">
          <span class="eyebrow">CHÍNH SÁCH HẬU MÃI DẪN ĐẦU</span>
          <h2 class="heading-section">Đồng hành trên mọi hành trình.</h2>
          <p class="body-regular">
            VinFast Minh Ngân Phú Thọ cam kết mang lại sự an tâm tuyệt đối với chính sách bảo hành chính hãng lên đến 10 năm hoặc 200.000 km*, cùng mạng lưới phụ tùng sẵn sàng và đội ngũ kỹ thuật viên tay nghề cao.
          </p>

          <div class="service-highlights">
            <div class="highlight-box">
              <h4 class="highlight-title">Bảo hành 10 Năm*</h4>
              <p class="highlight-desc">Thời hạn bảo hành lâu nhất thị trường cho xe và pin cao áp (theo chính sách VinFast công bố).</p>
            </div>
            <div class="highlight-box">
              <h4 class="highlight-title">Cứu hộ 24/7 Miễn phí*</h4>
              <p class="highlight-desc">Hỗ trợ kỹ thuật và cứu hộ khẩn cấp theo hotline 1900 23 23 89 suốt thời gian bảo hành.</p>
            </div>
            <div class="highlight-box">
              <h4 class="highlight-title">Phụ tùng chính hãng</h4>
              <p class="highlight-desc">100% linh kiện thay thế chuẩn nhà máy sản xuất VinFast Hải Phòng.</p>
            </div>
            <div class="highlight-box">
              <h4 class="highlight-title">Đặt hẹn thông minh</h4>
              <p class="highlight-desc">Quy trình đặt lịch 4 bước trực tuyến, chủ động khung giờ, không phải chờ đợi.</p>
            </div>
          </div>

          <div class="service-cta-wrap">
            <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="btn btn-primary">Đặt lịch bảo dưỡng trực tuyến</a>
            <span class="service-note-small">* Thông tin bảo hành và cứu hộ áp dụng theo quy định của VinFast Việt Nam tại thời điểm bàn giao xe.</span>
          </div>
          </div>
        </div>
      </div>
  </section>

  <!-- ========================================================================
       SECTION 04: GREEN FUTURE (CINEMATIC DARK BREAK)
       ======================================================================== -->
  <section class="future-section" id="future">
    <div class="container">
      <div class="future-inner">
        <span class="eyebrow future-eyebrow">MÃNH LIỆT TINH THẦN VIỆT NAM</span>
        <h2 class="heading-section future-title">Vì một tương lai giao thông xanh bền vững.</h2>
        <p class="future-desc">
          Mỗi chiếc ô tô điện VinFast lăn bánh tại Phú Thọ không chỉ là sự tiện nghi, thông minh và an toàn hàng đầu, mà còn là cam kết giảm phát thải CO2, chung tay bảo vệ môi trường sống trong lành cho thế hệ tương lai.
        </p>

        <div class="future-metrics">
          <div class="metric-item">
            <span class="metric-val">150.000+</span>
            <span class="metric-lbl">Cổng sạc phủ khắp 63 tỉnh thành*</span>
          </div>
          <div class="metric-item">
            <span class="metric-val">0%</span>
            <span class="metric-lbl">Lệ phí trước bạ ưu đãi Chính phủ*</span>
          </div>
          <div class="metric-item">
            <span class="metric-val">1/3</span>
            <span class="metric-lbl">Chi phí vận hành tiết kiệm so với xe xăng</span>
          </div>
        </div>
        <p class="future-disclaimer-small">* Số lượng cổng sạc theo quy hoạch mạng lưới V-GREEN; ưu đãi lệ phí trước bạ áp dụng theo Nghị định Chính phủ hiện hành.</p>
      </div>
    </div>
  </section>

  <!-- ========================================================================
       SECTION 05: GREEN SERIES (COMMERCIAL MOBILITY)
       ======================================================================== -->
  <section class="green-series-section" id="green-series">
    <div class="container">
      <div class="section-header-row">
        <div class="section-header-text">
          <span class="eyebrow">DÒNG XE KINH DOANH VẬN TẢI</span>
          <h2 class="heading-section">Giải pháp di chuyển cho kinh doanh.</h2>
          <p class="body-regular">Tối ưu hóa bài toán kinh tế, độ bền bỉ vượt trội và chi phí vận hành siêu tiết kiệm.</p>
        </div>
        <a href="tel:0981335522" class="btn btn-secondary section-header-btn">Tư vấn kinh doanh vận tải</a>
      </div>

      <div class="commercial-grid">
        <div class="commercial-card">
          <span class="eyebrow" style="margin-bottom: 6px;">VẬN TẢI ĐÔ THỊ</span>
          <h3 class="heading-card">Minio Green</h3>
          <p class="caption" style="margin-bottom: 16px;">Lựa chọn thông minh cho di chuyển nội đô linh hoạt.</p>
          <div class="card-image-wrap" style="height: 180px;">
            <img src="<?php echo esc_url($cars_uri . 'official_minio.webp'); ?>" alt="Minio Green" loading="lazy">
          </div>
          <a href="tel:0981335522" class="btn btn-secondary" style="margin-top: auto; width: 100%;">Nhận tư vấn doanh nghiệp</a>
        </div>

        <div class="commercial-card">
          <span class="eyebrow" style="margin-bottom: 6px;">DỊCH VỤ ĐÓN TIỄN</span>
          <h3 class="heading-card">Herio Green</h3>
          <p class="caption" style="margin-bottom: 16px;">Vận hành êm ái, khoang hành khách rộng rãi lịch sự.</p>
          <div class="card-image-wrap" style="height: 180px;">
            <img src="<?php echo esc_url($cars_uri . 'official_herio.png'); ?>" alt="Herio Green" loading="lazy">
          </div>
          <a href="tel:0981335522" class="btn btn-secondary" style="margin-top: auto; width: 100%;">Nhận tư vấn doanh nghiệp</a>
        </div>

        <div class="commercial-card">
          <span class="eyebrow" style="margin-bottom: 6px;">CHỞ HÀNG LOGISTICS</span>
          <h3 class="heading-card">EC Van</h3>
          <p class="caption" style="margin-bottom: 16px;">Thùng hàng dung tích lớn, chuyên chở 24/7 không cấm giờ.</p>
          <div class="card-image-wrap" style="height: 180px;">
            <img src="<?php echo esc_url($cars_uri . 'official_ecvan.webp'); ?>" alt="EC Van" loading="lazy">
          </div>
          <a href="tel:0981335522" class="btn btn-secondary" style="margin-top: auto; width: 100%;">Nhận tư vấn doanh nghiệp</a>
          </div>
        </div>
      </div>
  </section>

  <!-- ========================================================================
       SECTION 06: FINANCIAL TOOLS (EDITORIAL PANELS)
       ======================================================================== -->
  <section class="finance-section" id="finance">
    <div class="container">
      <div class="section-header-row">
        <div class="section-header-text">
          <span class="eyebrow">CÔNG CỤ HỖ TRỢ BÁN HÀNG</span>
          <h2 class="heading-section">Chủ động kế hoạch sở hữu xe</h2>
          <p class="body-regular">Minh bạch toàn bộ chi phí lăn bánh và kế hoạch tài chính trả góp chỉ trong vài giây.</p>
        </div>
      </div>

      <div class="finance-grid">
        <!-- Panel A: Dự toán lăn bánh -->
        <div class="finance-panel">
          <div class="finance-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
          </div>
          <h3 class="heading-card finance-title">Dự toán chi phí lăn bánh</h3>
          <p class="body-regular finance-desc">
            Tính toán chính xác tổng chi phí sở hữu xe tại Phú Thọ và các tỉnh thành, tự động áp dụng ưu đãi thuế trước bạ 0% và hỗ trợ xuất bản in PDF 1-click.
          </p>
          <div>
            <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>" class="btn btn-primary finance-btn">Tính giá lăn bánh ngay &rarr;</a>
          </div>
          <div class="finance-tags">
            <span class="tag-pill">Thuế trước bạ 0%</span>
            <span class="tag-pill">Phí biển số tỉnh</span>
            <span class="tag-pill">Xuất PDF 1-Click</span>
          </div>
        </div>

        <!-- Panel B: Tính trả góp ngân hàng -->
        <div class="finance-panel">
          <div class="finance-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="2" y="4" width="20" height="16" rx="2"/>
              <line x1="2" y1="10" x2="22" y2="10"/>
            </svg>
          </div>
          <h3 class="heading-card finance-title">Tính kế hoạch vay trả góp</h3>
          <p class="body-regular finance-desc">
            Lập bảng dự toán trả góp ngân hàng theo phương thức dư nợ giảm dần, số tiền trả trước từ 20%, chi tiết số tiền gốc và lãi phải trả từng tháng.
          </p>
          <div>
            <a href="<?php echo esc_url(home_url('/du-toan-tra-gop/')); ?>" class="btn btn-secondary finance-btn">Tính lịch trả góp &rarr;</a>
          </div>
          <div class="finance-tags">
            <span class="tag-pill">Dư nợ giảm dần</span>
            <span class="tag-pill">Vay đến 8 năm</span>
            <span class="tag-pill">Bảng chi tiết từng kỳ</span>
          </div>
          </div>
        </div>
      </div>
  </section>

  <!-- ========================================================================
       SECTION 07: NEWS & EVENTS (EDITORIAL)
       ======================================================================== -->
  <section class="news-section" id="news">
    <div class="container">
      <div class="section-header-row">
        <div class="section-header-text">
          <span class="eyebrow">TIN TỨC & CHƯƠNG TRÌNH ĐẠI LÝ</span>
          <h2 class="heading-section">Tin tức & Sự kiện.</h2>
          <p class="body-regular">Cập nhật ưu đãi giá bán, sự kiện trải nghiệm xe và đánh giá công nghệ.</p>
        </div>
        <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="btn-link section-header-link">Xem tất cả bài viết &rarr;</a>
      </div>

      <div class="news-grid">
        <?php if (!empty($recent_posts)) : ?>
          <?php
            $first_post = array_shift($recent_posts);
            $first_thumb = get_the_post_thumbnail_url($first_post->ID, 'large') ?: 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=800&q=80';
          ?>
          <!-- Featured Big News Item -->
          <article class="news-featured">
            <img src="<?php echo esc_url($first_thumb); ?>" alt="<?php echo esc_attr(get_the_title($first_post->ID)); ?>" class="news-featured-img">
            <div class="news-featured-body">
              <span class="caption" style="margin-bottom: 8px;">
                <?php echo get_the_date('d \T\h\á\n\g m, Y', $first_post->ID); ?> · TIN NỔI BẬT
              </span>
              <h3 class="heading-card" style="margin-bottom: 12px;">
                <a href="<?php echo esc_url(get_permalink($first_post->ID)); ?>" style="color: inherit; text-decoration: none;">
                  <?php echo esc_html(get_the_title($first_post->ID)); ?>
                </a>
              </h3>
              <p class="body-regular" style="margin-bottom: 20px;">
                <?php echo wp_trim_words(get_the_excerpt($first_post->ID), 26); ?>
              </p>
              <a href="<?php echo esc_url(get_permalink($first_post->ID)); ?>" class="btn-link">Đọc chi tiết bài viết &rarr;</a>
            </div>
          </article>

          <!-- Small News List -->
          <div class="news-list">
            <?php foreach ($recent_posts as $post_item) : ?>
              <?php
                $thumb = get_the_post_thumbnail_url($post_item->ID, 'medium') ?: 'https://images.unsplash.com/photo-1558441719-f0a996841893?auto=format&fit=crop&w=200&q=80';
              ?>
              <article class="news-item">
                <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr(get_the_title($post_item->ID)); ?>" class="news-item-thumb">
                <div class="news-item-info">
                  <span class="caption"><?php echo get_the_date('d \T\h\á\n\g m, Y', $post_item->ID); ?></span>
                  <h4 style="font-size: 15px; font-weight: 600; margin: 4px 0 6px; line-height: 1.35;">
                    <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>" style="color: inherit; text-decoration: none;">
                      <?php echo esc_html(get_the_title($post_item->ID)); ?>
                    </a>
                  </h4>
                  <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>" class="btn-link" style="font-size: 13px;">Xem thêm</a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php else : ?>
          <!-- Fallback khi website chưa có bài viết đăng tải -->
          <article class="news-featured">
            <img src="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=800&q=80" alt="Chương trình ưu đãi tháng" class="news-featured-img">
            <div class="news-featured-body">
              <span class="caption" style="margin-bottom: 8px;">ƯU ĐÃI ĐẶC QUYỀN TRONG THÁNG</span>
              <h3 class="heading-card" style="margin-bottom: 12px;">Đại tiệc tri ân: Ưu đãi đặc quyền dành cho khách hàng sở hữu xe điện tại Phú Thọ</h3>
              <p class="body-regular" style="margin-bottom: 20px;">
                VinFast Minh Ngân công bố gói hỗ trợ phụ kiện cao cấp, miễn phí sạc pin tại trạm công cộng cùng lãi suất vay ngân hàng đặc biệt trong tháng.
              </p>
              <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="btn-link">Đăng ký nhận báo giá ưu đãi &rarr;</a>
            </div>
          </article>

          <div class="news-list">
            <article class="news-item">
              <img src="https://images.unsplash.com/photo-1558441719-f0a996841893?auto=format&fit=crop&w=200&q=80" alt="Sự kiện lái thử" class="news-item-thumb">
              <div class="news-item-info">
                <span class="caption">SỰ KIỆN TRẢI NGHIỆM</span>
                <h4 style="font-size: 15px; font-weight: 600; margin: 4px 0 6px; line-height: 1.35;">Mời tham gia ngày hội trải nghiệm VinFast VF 7 tại TP. Việt Trì</h4>
                <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="btn-link" style="font-size: 13px;">Đăng ký ngay</a>
              </div>
            </article>

            <article class="news-item">
              <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=200&q=80" alt="Công nghệ pin" class="news-item-thumb">
              <div class="news-item-info">
                <span class="caption">CÔNG NGHỆ PIN V-GREEN</span>
                <h4 style="font-size: 15px; font-weight: 600; margin: 4px 0 6px; line-height: 1.35;">Tìm hiểu chính sách bảo hành pin 10 năm của VinFast có gì đặc biệt?</h4>
                <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>" class="btn-link" style="font-size: 13px;">Xem chính sách</a>
              </div>
            </article>

            <article class="news-item">
              <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=200&q=80" alt="Kinh nghiệm lái xe điện" class="news-item-thumb">
              <div class="news-item-info">
                <span class="caption">HƯỚNG DẪN SỬ DỤNG</span>
                <h4 style="font-size: 15px; font-weight: 600; margin: 4px 0 6px; line-height: 1.35;">Kinh nghiệm tối ưu quãng đường di chuyển cho xe điện mùa lạnh</h4>
                <a href="<?php echo esc_url(home_url('/tin-tuc/')); ?>" class="btn-link" style="font-size: 13px;">Xem hướng dẫn</a>
              </div>
            </article>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ========================================================================
       SECTION 08: SHOWROOM & CONTACT
       ======================================================================== -->
  <section class="showroom-section" id="showroom">
    <div class="container">
      <div class="showroom-grid">
        <!-- Map Left -->
        <div class="showroom-map-wrap">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d119066.41709424682!2d105.3216856!3d21.3227387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134914c62f83191%3A0x6b7724a87c10b77e!2zVmluaEZhc3QgTWluaCBOZ8OibiBQaMO6IFRo4buN!5e0!3m2!1svi!2svn!4v1714000000000"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Bản đồ chỉ đường đến Showroom VinFast Minh Ngân Phú Thọ">
          </iframe>
        </div>

        <!-- Info Right -->
        <div class="showroom-info">
          <span class="eyebrow">ĐẠI LÝ ỦY QUYỀN CHÍNH THỨC</span>
          <h2 class="heading-section" style="margin-bottom: 20px;">Trải nghiệm VinFast tại Minh Ngân</h2>
          <p class="body-regular" style="margin-bottom: 28px;">
            Chào mừng Quý khách đến với Showroom 3S VinFast Minh Ngân Phú Thọ để trực tiếp lái thử và nhận tư vấn chuyên nghiệp từ các chuyên viên của chúng tôi.
          </p>

          <div class="info-item">
            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <div>
              <strong style="font-size: 15px; color: var(--text-primary);">Địa chỉ Showroom 3S:</strong>
              <p class="caption" style="margin-top: 2px;">Đường Nguyễn Tất Thành, Phường Thanh Miếu, TP. Việt Trì, Tỉnh Phú Thọ (Sẵn sàng cổng sạc nhanh V-GREEN 250kW)</p>
            </div>
          </div>

          <div class="info-item">
            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            <div>
              <strong style="font-size: 15px; color: var(--text-primary);">Hotline tư vấn & Lái thử:</strong>
              <p class="caption" style="margin-top: 2px;"><a href="tel:0981335522" style="color: var(--accent-blue); font-weight: 700; font-size: 15px;">0981.335.522</a> (Phục vụ 24/7)</p>
            </div>
          </div>

          <div class="info-item">
            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
            <div>
              <strong style="font-size: 15px; color: var(--text-primary);">Giờ làm việc:</strong>
              <p class="caption" style="margin-top: 2px;">Thứ Hai – Chủ Nhật: 08:00 – 18:00 (Mở cửa tất cả các ngày trong tuần)</p>
            </div>
          </div>

          <div class="showroom-cta-group">
            <a href="https://maps.google.com" target="_blank" rel="noopener" class="btn btn-primary">Chỉ đường tới Showroom</a>
            <a href="tel:0981335522" class="btn btn-secondary">Gọi Hotline tư vấn</a>
          </div>
          </div>
        </div>
      </div>
  </section>

  <!-- ========================================================================
       POPUP ƯU ĐÃI TỰ ĐÓNG (PROMO POPUP)
       ======================================================================== -->
  <div class="promo-popup-backdrop" id="promoPopup" role="dialog" aria-modal="true" aria-labelledby="promoTitle">
    <div class="promo-popup-card">
      <button class="popup-close-x" id="closePopupBtn" aria-label="Đóng popup ưu đãi">&times;</button>
      <span class="eyebrow">ƯU ĐÃI ĐẶC QUYỀN TRONG THÁNG</span>
      <h3 class="heading-card" id="promoTitle" style="margin-bottom: 12px;">Nhận Báo Giá Lăn Bánh & Ưu Đãi Phụ Kiện Chính Hãng</h3>
      <p class="body-regular" style="margin-bottom: 24px; font-size: 14px;">
        Đăng ký nhận bảng dự toán lăn bánh miễn phí cùng gói quà tặng sạc pin độc quyền tại <strong>VinFast Minh Ngân Phú Thọ</strong>.
      </p>
      <div style="display: flex; flex-direction: column; gap: 10px;">
        <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="btn btn-primary" id="dismissPopupBtn">Nhận ưu đãi ngay</a>
        <button class="btn btn-secondary" onclick="document.getElementById('promoPopup').classList.remove('active')" style="min-height: 40px; font-size: 13px;">Để sau</button>
      </div>
      <p class="caption" style="text-align: center; margin-top: 14px; font-size: 11px;">Thông báo sẽ tự động đóng sau 15 giây</p>
    </div>
  </div>

</div><!-- .homepage-premium-wrapper -->

<?php
get_footer();
