<?php
/**
 * Dedicated Authentic Product Template for VinFast VF 9
 * Location: template-parts/product/single-vf9.php
 * 100% Authentic VF 9 Cutouts, Real Gallery Photos & Exact Specs
 */

defined('ABSPATH') || exit;

// Remove WooCommerce & database post_content overlap
remove_all_actions('woocommerce_single_product_summary');
remove_all_actions('woocommerce_before_single_product');
remove_all_actions('woocommerce_after_single_product');
remove_all_actions('woocommerce_before_single_product_summary');
remove_all_actions('woocommerce_after_single_product_summary');
add_filter('the_content', '__return_empty_string', 9999);

if (!did_action('get_header')) {
    if (!did_action('get_header')) {
    get_header();
}
}

$uploads_url = content_url('/uploads/official_cars/vf9');
?>

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

  /* Sticky Subnav Bar */
  .vf-subnav {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 60px;
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid #E2E8F0;
    z-index: 999;
    display: flex; align-items: center;
    transform: translateY(-100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
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
  .vf9-hero {
    position: relative; width: 100%; height: 85vh; min-height: 550px; background: #000000; overflow: hidden; display: flex; align-items: flex-end;
  }
  .vf9-hero-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.88; }
  .vf9-hero-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15, 23, 42, 0.25) 0%, rgba(15, 23, 42, 0.75) 75%, rgba(15, 23, 42, 0.94) 100%); }
  .vf9-hero-content { position: relative; z-index: 10; padding-bottom: 60px; color: #ffffff; max-width: 1280px; margin: 0 auto; padding-left: 24px; padding-right: 24px; width: 100%; }
  .vf9-hero-badge { display: inline-block; background: #2563EB; color: #ffffff; font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; padding: 6px 16px; border-radius: 4px; margin-bottom: 16px; }
  .vf9-hero-title { font-family: 'Mulish', 'Inter', sans-serif; font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; line-height: 1.1; margin-bottom: 12px; text-transform: uppercase; letter-spacing: -1px; }
  .vf9-hero-desc { font-size: 1.1rem; color: rgba(255,255,255,0.9); max-width: 640px; margin-bottom: 28px; }

  /* Interactive Studio Configurator */
  .vf9-configurator { padding: 50px 0 70px; background: #ffffff; }
  .vf9-stage-wrap { position: relative; width: 100%; max-width: 1100px; margin: 0 auto; display: flex; align-items: center; justify-content: center; padding: 20px 0 10px; overflow: hidden; }
  .vf9-stage-car-img { position: relative; z-index: 2; width: 100%; max-width: 960px; height: auto; max-height: 460px; object-fit: contain; transform: scale(1.15); transition: opacity 0.35s ease, transform 0.4s ease; filter: drop-shadow(0 20px 36px rgba(15,23,42,0.12)); }
  .vf9-stage-car-img.changing { opacity: 0; transform: scale(1.08); }
  .vf9-controls-panel { position: relative; z-index: 10; max-width: 1050px; margin: 40px auto 0; background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 40px 48px; box-shadow: 0 10px 36px rgba(15,23,42,0.08); }
  .vf9-controls-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center; }
  .vf9-option-group-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748B; margin-bottom: 12px; }
  .vf9-toggle-group { display: flex; background: #F8FAFC; padding: 4px; border-radius: 8px; border: 1px solid #E2E8F0; }
  .vf9-toggle-btn { flex: 1; padding: 10px 16px; font-size: 14px; font-weight: 700; border: none; background: transparent; color: #64748B; border-radius: 6px; cursor: pointer; transition: all 0.2s ease; text-align: center; }
  .vf9-toggle-btn.active { background: #ffffff; color: #2563EB; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .vf9-color-dots-row { display: flex; gap: 14px; align-items: center; flex-wrap: wrap; }
  .vf9-color-dot { width: 38px; height: 38px; border-radius: 50%; border: 3px solid #ffffff; box-shadow: 0 0 0 1px #E2E8F0, 0 4px 8px rgba(0,0,0,0.12); cursor: pointer; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
  .vf9-color-dot.active, .vf9-color-dot:hover { transform: scale(1.15); box-shadow: 0 0 0 3px #2563EB, 0 6px 14px rgba(37,99,235,0.3); }
  .vf9-selected-color-label { font-size: 14px; font-weight: 600; color: #0F172A; margin-top: 8px; }
  .vf9-config-price-bar { margin-top: 28px; padding-top: 24px; border-top: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between; }
  .vf9-price-amount { font-size: 2.2rem; font-weight: 900; color: #2563EB; line-height: 1.1; }

  /* Buttons */
  .vf-btn { height: 44px; line-height: 44px; padding: 0 24px; font-size: 13px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; transition: all 0.2s ease; white-space: nowrap; border: none; }
  .vf-btn-primary { background: #2563EB; color: #ffffff; box-shadow: 0 4px 14px rgba(37,99,235,0.25); }
  .vf-btn-primary:hover { background: #1D4ED8; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }
  .vf-btn-outline { background: #ffffff; color: #2563EB; border: 1.5px solid #2563EB; }
  .vf-btn-outline:hover { background: #EFF6FF; }

  /* Sections & Cards */
  .vf9-section { padding: 90px 0; }
  .vf9-section-alt { background-color: #F8FAFC; }
  .vf9-sec-head { text-align: center; max-width: 760px; margin: 0 auto 56px; }
  .vf9-sec-label { font-size: 12px; font-weight: 800; letter-spacing: 3px; text-transform: uppercase; color: #2563EB; margin-bottom: 12px; display: block; }
  .vf9-sec-title { font-family: 'Mulish', 'Inter', sans-serif; font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; line-height: 1.2; margin-bottom: 16px; }
  .vf9-sec-desc { font-size: 16px; color: #64748B; line-height: 1.7; }
  .vf9-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
  .vf9-card { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column; height: 100%; }
  .vf9-card:hover { transform: translateY(-6px); box-shadow: 0 20px 48px rgba(15,23,42,0.12); }
  .vf9-card-img { width: 100%; height: 260px; object-fit: cover; flex-shrink: 0; }
  .vf9-card-body { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .vf9-card-title { font-size: 1.2rem; font-weight: 800; margin-bottom: 8px; }
  .vf9-card-desc { font-size: 14px; color: #64748B; line-height: 1.6; }

  /* Interior Hero */
  .vf9-interior-hero { position: relative; width: 100%; height: 600px; border-radius: 16px; overflow: hidden; margin-top: 32px; }
  .vf9-interior-hero-img { width: 100%; height: 100%; object-fit: cover; }
  .vf9-interior-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15,23,42,0.1) 0%, rgba(15,23,42,0.85) 100%); display: flex; align-items: flex-end; padding: 48px; color: #ffffff; }

  /* Performance Stats */
  .vf9-perf-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 48px; }
  .vf9-stat-box { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 36px 24px; text-align: center; box-shadow: 0 4px 14px rgba(0,0,0,0.05); }
  .vf9-stat-val { font-size: 3.5rem; font-weight: 900; color: #2563EB; line-height: 1; margin-bottom: 8px; }
  .vf9-stat-lbl { font-size: 13px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; }

  /* ADAS Grid */
  .vf9-tech-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; margin-top: 40px; }
  .vf9-tech-item { display: flex; gap: 20px; background: #ffffff; padding: 24px; border-radius: 12px; border: 1px solid #E2E8F0; box-shadow: 0 4px 14px rgba(0,0,0,0.05); }
  .vf9-tech-icon { width: 48px; height: 48px; background: #EFF6FF; color: #2563EB; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; }

  /* Privilege Banner */
  .vf9-privilege-banner { background: linear-gradient(135deg, #0F172A 0%, #1e293b 100%); color: #ffffff; border-radius: 20px; padding: 60px; margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
  .vf9-privilege-list { list-style: none; display: flex; flex-direction: column; gap: 16px; margin-top: 24px; padding: 0; }
  .vf9-privilege-list li { display: flex; align-items: center; gap: 12px; font-size: 15px; }
  .vf9-privilege-list li::before { content: '✓'; display: inline-block; width: 24px; height: 24px; background: #2563EB; color: #fff; border-radius: 50%; text-align: center; line-height: 24px; font-weight: 800; font-size: 12px; }

  /* Specs Table */
  .vf9-specs-tabs-nav { display: flex; justify-content: center; gap: 12px; margin-bottom: 36px; }
  .vf9-spec-tab-btn { padding: 12px 28px; font-size: 14px; font-weight: 700; border: 1px solid #E2E8F0; background: #ffffff; color: #64748B; border-radius: 30px; cursor: pointer; transition: all 0.2s ease; }
  .vf9-spec-tab-btn.active, .vf9-spec-tab-btn:hover { background: #2563EB; color: #ffffff; border-color: #2563EB; }
  .vf9-specs-table-wrap { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(0,0,0,0.05); max-width: 1000px; margin: 0 auto; }
  .vf9-specs-table { width: 100%; border-collapse: collapse; }
  .vf9-specs-table tr:nth-child(even) { background-color: #F8FAFC; }
  .vf9-specs-table td { padding: 16px 24px; border-bottom: 1px solid #E2E8F0; font-size: 14px; }
  .vf9-specs-table td:first-child { width: 40%; color: #64748B; font-weight: 600; }
  .vf9-specs-table td:last-child { font-weight: 700; color: #0F172A; }

  @media (max-width: 992px) {
    .vf9-controls-grid, .vf9-grid-3, .vf9-tech-grid, .vf9-privilege-banner { grid-template-columns: 1fr; }
    .vf9-perf-stats-grid { grid-template-columns: 1fr 1fr; }
  }
</style>

<!-- Sticky Subnav Bar -->
<div class="vf-subnav" id="vf9StickySubnav">
  <div class="vf-subnav-inner">
    <div class="vf-subnav-title">VinFast VF 9</div>
    <ul class="vf-subnav-links">
      <li><a href="#tong-quan" class="active">Tổng quan</a></li>
      <li><a href="#ngoai-that">Ngoại thất</a></li>
      <li><a href="#noi-that">Nội thất</a></li>
      <li><a href="#van-hanh">Vận hành</a></li>
      <li><a href="#an-toan">An toàn & ADAS</a></li>
      <li><a href="#thong-so">Thông số kỹ thuật</a></li>
    </ul>
    <div class="vf-subnav-actions">
      <div class="vf-subnav-price-wrap">
        <span class="vf-subnav-price-label" style="font-size:11px; color:#64748B;">Giá niêm yết từ</span>
        <span class="vf-subnav-price-val" id="subnav-price-display-vf9">1.348.000.000 VNĐ</span>
      </div>
      <a href="#configurator" class="vf-btn vf-btn-primary">ĐẶT CỌC NGAY</a>
    </div>
  </div>
</div>

<!-- 1. HERO BANNER CHÍNH HÃNG VF 9 -->
<section class="vf9-hero" id="tong-quan">
  <img src="<?php echo esc_url($uploads_url . '/vf9_42_hero.webp'); ?>" 
       alt="VinFast VF 9 Banner" 
       class="vf9-hero-bg"
       onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
  <div class="vf9-hero-overlay"></div>
  <div class="vf9-hero-content" data-aos="fade-up">
    <span class="vf9-hero-badge">E-SUV ĐIỆN HẠNG SANG</span>
    <h1 class="vf9-hero-title">KIỆT TÁC HẠNG SANG<br>ĐẲNG CẤP THƯƠNG GIA</h1>
    <p class="vf9-hero-desc">VinFast VF 9 là mẫu E-SUV điện 7 chỗ cỡ lớn cao cấp nhất, khẳng định vị thế chủ nhân với trần kính Panorama toàn cảnh, ghế thương gia bọc da Nappa massage và động cơ 402 mã lực 2 cầu AWD.</p>
    <div style="display: flex; gap: 16px;">
      <a href="#configurator" class="vf-btn vf-btn-primary">TÙY CHỈNH CẤU HÌNH XE</a>
      <a href="<?php echo esc_url(home_url('/mua-xe-tra-gop/')); ?>" class="vf-btn vf-btn-outline" style="color:#fff; border-color:#fff;">DỰ TOÁN TRẢ GÓP</a>
    </div>
  </div>
</section>

<!-- 2. TRÌNH CẤU HÌNH VÀ ĐỔI MÀU XE VF 9 STUDIO -->
<section class="vf9-configurator" id="configurator">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Trình tùy chỉnh trực quan</span>
      <h2 class="vf9-sec-title">Khám Phá Cấu Hình VinFast VF 9</h2>
      <p class="vf9-sec-desc">Tùy chọn màu sắc ngoại thất chính hãng, phiên bản trang bị và hình thức sở hữu pin</p>
    </div>

    <!-- Canvas Xe Studio VF 9 -->
    <div class="vf9-stage-wrap">
      <img id="vf9CarStageImg" 
           src="<?php echo esc_url($uploads_url . '/vf9_cutout_white.png'); ?>" 
           alt="VinFast VF 9 Studio Render" 
           class="vf9-stage-car-img">
    </div>

    <!-- Bảng Điều Khiển Cấu Hình -->
    <div class="vf9-controls-panel" data-aos="fade-up">
      <div class="vf9-controls-grid">
        
        <!-- Chọn Màu Ngoại Thất Chính Hãng VF 9 -->
        <div>
          <div class="vf9-option-group-title">Chọn màu ngoại thất chính hãng:</div>
          <div class="vf9-color-dots-row">
            <button class="vf9-color-dot active" style="background: #ffffff;" data-img="<?php echo esc_url($uploads_url . '/vf9_cutout_white.png'); ?>" data-color="Trắng Brahminy White"></button>
            <button class="vf9-color-dot" style="background: #0f172a;" data-img="<?php echo esc_url($uploads_url . '/vf9_cutout_black.png'); ?>" data-color="Đen Jet Black"></button>
            <button class="vf9-color-dot" style="background: #991b1b;" data-img="<?php echo esc_url($uploads_url . '/vf9_cutout_red.png'); ?>" data-color="Đỏ Crimson Red"></button>
            <button class="vf9-color-dot" style="background: #1e3a8a;" data-img="<?php echo esc_url($uploads_url . '/vf9_cutout_blue.png'); ?>" data-color="Xanh Deep Ocean"></button>
            <button class="vf9-color-dot" style="background: #475569;" data-img="<?php echo esc_url($uploads_url . '/vf9_cutout_grey.png'); ?>" data-color="Xám Neptun Grey"></button>
            <button class="vf9-color-dot" style="background: #94a3b8;" data-img="<?php echo esc_url($uploads_url . '/vf9_cutout_silver.png'); ?>" data-color="Bạc Desat Silver"></button>
          </div>
          <div class="vf9-selected-color-label" id="vf9ColorLabel">Màu đang chọn: Trắng Brahminy White</div>
        </div>

        <!-- Chọn Phiên Bản & Pin -->
        <div>
          <div class="vf9-option-group-title">Chọn phiên bản trang bị:</div>
          <div class="vf9-toggle-group" style="margin-bottom: 16px;">
            <button class="vf9-toggle-btn active" onclick="setVF9Version('eco', this)">Phiên bản ECO</button>
            <button class="vf9-toggle-btn" onclick="setVF9Version('plus', this)">Phiên bản PLUS</button>
          </div>

          <div class="vf9-option-group-title">Hình thức sở hữu Pin:</div>
          <div class="vf9-toggle-group">
            <button class="vf9-toggle-btn active" onclick="setVF9Battery('thue', this)">Thuê Pin Hàng Tháng</button>
            <button class="vf9-toggle-btn" onclick="setVF9Battery('mua', this)">Mua Đứt Pin</button>
          </div>
        </div>

      </div>

      <!-- Tính Giá Động Real-time -->
      <div class="vf9-config-price-bar">
        <div>
          <div class="vf9-sec-label" style="margin: 0;">Giá niêm yết xe (Đã bao gồm VAT):</div>
          <div class="vf9-price-amount" id="vf9DynamicPrice">1.348.000.000 VNĐ</div>
          <div style="font-size: 12px; color: #64748B;">*Ưu đãi hỗ trợ chi phí chuyển đổi xe xăng sang xe điện VinFast chính hãng</div>
        </div>
        <div style="display: flex; gap: 12px;">
          <a href="<?php echo esc_url(home_url('/mua-xe-tra-gop/')); ?>" class="vf-btn vf-btn-outline">DỰ TOÁN CHI PHÍ</a>
          <button class="vf-btn vf-btn-primary" onclick="alert('Đã gửi yêu cầu tư vấn đặt cọc VinFast VF 9!')">ĐẶT CỌC ONLINE</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3. NGOẠI THẤT CHÍNH HÃNG VF 9 -->
<section class="vf9-section vf9-section-alt" id="ngoai-that">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Ngoại thất khí động học</span>
      <h2 class="vf9-sec-title">Kiệt Tác Thiết Kế Ý — Pininfarina</h2>
      <p class="vf9-sec-desc">Vẻ uy nghi bề thế chuẩn mực E-SUV kết hợp khí động học đỉnh cao vươn tầm thế giới.</p>
    </div>

    <div class="vf9-grid-3">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/vf9_999.webp'); ?>" 
             alt="Đèn Full-LED Matrix VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Hệ Thống Đèn Full-LED Matrix</h3>
          <p class="vf9-card-desc">Dải LED nhận diện cánh nhạn thương hiệu VinFast nổi bật phía trước và sau tích hợp công nghệ chiếu sáng thông minh.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/vf9_9assd.webp'); ?>" 
             alt="Tay nắm cửa ẩn VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Tay Nắm Cửa Ẩn Khí Động Học</h3>
          <p class="vf9-card-desc">Thiết kế tay nắm cửa ẩn phẳng mượt với thân xe giúp tối ưu hóa hệ số cản gió và tạo phong cách hiện đại.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/vf9_82_cs-battery-lease-solution.webp'); ?>" 
             alt="Mâm 21 inch VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Mâm Hợp Kim 21 Inch Phay 2 Màu</h3>
          <p class="vf9-card-desc">Bộ la-zăng đúc kích thước lớn 21-inch phay 2 màu thể thao tôn lên vẻ sang trọng uy nghi của mẫu xe chủ lực.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. NỘI THẤT KHOANG LÁI VF 9 -->
<section class="vf9-section" id="noi-that">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Nội thất & Tiện nghi</span>
      <h2 class="vf9-sec-title">Không Gian Khoang Lái Đẳng Cấp Thương Gia</h2>
      <p class="vf9-sec-desc">Nội thất da Nappa cao cấp tích hợp chế độ massage 8 điểm, làm mát và trần kính toàn cảnh Panorama.</p>
    </div>

    <!-- Interior Hero Photo -->
    <div class="vf9-interior-hero" data-aos="fade-up">
      <img src="<?php echo esc_url($uploads_url . '/vf9_67_interior-first-sight.webp'); ?>" 
           alt="Nội thất khoang lái VinFast VF 9" 
           class="vf9-interior-hero-img"
           onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
      <div class="vf9-interior-overlay">
        <div>
          <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 12px;">Trần Kính Toàn Cảnh Panorama Chống Tia UV</h3>
          <p style="max-width: 640px;">Không gian khoang cabin rộng mở chan hòa ánh sáng tự nhiên với kính trần Panorama tích hợp lớp phủ chống tia cực tím và cách nhiệt cao cấp.</p>
        </div>
      </div>
    </div>

    <!-- 3 Interior Detail Cards -->
    <div class="vf9-grid-3" style="margin-top: 36px;">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/vf9_70_int-preview-2.webp'); ?>" 
             alt="Màn hình 15.6 inch VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/91a.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Màn Hình Trung Tâm 15.6 Inch</h3>
          <p class="vf9-card-desc">Màn hình cảm ứng độ phân giải Full HD tích hợp toàn bộ tính năng giải trí, bản đồ vệ tinh chỉ đường và điều khiển không gian khoang lái.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/vf9_68_int-preview-1.webp'); ?>" 
             alt="Ghế thương gia VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/91e.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Ghế Thương Gia Hàng 2 Tích Hợp Massage</h3>
          <p class="vf9-card-desc">Hàng ghế thương gia bọc da Nappa cao cấp tích hợp chế độ massage 8 điểm, sưởi ấm và thông gió làm mát đa tầng.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/vf9_66_interior-first-sight-mb.webp'); ?>" 
             alt="Màn hình HUD & Loa VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/91d.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Màn Hình HUD & Âm Thanh 13 Loa</h3>
          <p class="vf9-card-desc">Màn hình hiển thị thông tin kính lái HUD sắc nét kết hợp cùng dàn âm thanh vòm 13 loa sống động như rạp hát thu nhỏ.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 5. HIỆU NĂNG VẬN HÀNH & TRẠM SẠC CHÍNH HÃNG -->
<section class="vf9-section vf9-section-alt" id="van-hanh">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Sức mạnh động cơ điện</span>
      <h2 class="vf9-sec-title">Vận Hành Uy Nghi — Tầm Bay 602 KM</h2>
      <p class="vf9-sec-desc">Động cơ điện đôi AWD 2 cầu cho công suất 402 HP bứt tốc từ 0-100 km/h chỉ trong 6.5 giây mượt mà tĩnh lặng.</p>
    </div>

    <!-- Stats Box -->
    <div class="vf9-perf-stats-grid" data-aos="zoom-in">
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">402</div>
        <div class="vf9-stat-lbl">Mã Lực (HP)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">602</div>
        <div class="vf9-stat-lbl">Tầm Hoạt Động (KM)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">123.0</div>
        <div class="vf9-stat-lbl">Dung Lượng Pin (kWh)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">AWD</div>
        <div class="vf9-stat-lbl">Hệ Dẫn Động 2 Cầu</div>
      </div>
    </div>

    <!-- Charging Solutions Grid -->
    <div class="vf9-grid-3" style="margin-top: 48px;">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/vf9_80_cs-charging-station.webp'); ?>" 
             alt="Trạm sạc V-GREEN VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Mạng Lưới Trạm Sạc V-GREEN</h3>
          <p class="vf9-card-desc">Phủ sóng 63 tỉnh thành toàn quốc với trạm sạc siêu nhanh DC sạc từ 10% đến 70% dung lượng pin chỉ trong ~35 phút.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/vf9_81_cs-home-charger.webp'); ?>" 
             alt="Bộ sạc tại nhà VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Bộ Sạc Tại Nhà Thông Minh</h3>
          <p class="vf9-card-desc">Cung cấp giải pháp bộ sạc di động Portable AC 3.5 kW và bộ sạc treo tường Home Charger 11 kW sạc tiện lợi qua đêm tại gia.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/vf9_82_cs-battery-lease-solution.webp'); ?>" 
             alt="Giải pháp thuê pin VF 9" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Giải Pháp Thuê Pin Tiết Kiệm</h3>
          <p class="vf9-card-desc">Chính sách thuê pin độc hãn giúp tối ưu chi phí đầu tư ban đầu và được VinFast bảo dưỡng, thay pin miễn phí khi chai dưới 70%.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- 6. AN TOÀN & ADAS CHÍNH HÃNG VF 9 -->
<section class="vf9-section" id="an-toan">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">An toàn & Trợ lý thông minh</span>
      <h2 class="vf9-sec-title">Hệ Thống Trợ Lái ADAS Cấp Độ 2 & 11 Túi Khí</h2>
      <p class="vf9-sec-desc">Trang bị 11 túi khí an toàn toàn cảnh cùng gói công nghệ ADAS hỗ trợ di chuyển cao tốc, tự động chuyển làn và trợ lý ảo ViVi.</p>
    </div>

    <div class="vf9-tech-grid" data-aos="fade-up">
      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🛡️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Hệ Thống 11 Túi Khí An Toàn Toàn Cảnh</h4>
          <p style="font-size: 14px; color: #64748B;">Trang bị túi khí hàng ghế trước, túi khí rèm, túi khí bên hông và túi khí trung tâm bảo vệ tối đa người ngồi.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🚗</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Hỗ Trợ Lái Trên Đường Cao Tốc (Highway Assist)</h4>
          <p style="font-size: 14px; color: #64748B;">Giữ làn đường thông minh, tự động điều chỉnh tốc độ thích ứng và bám đuôi phương tiện phía trước.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🅿️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Triệu Tập Xe Thông Minh (Smart Summon)</h4>
          <p style="font-size: 14px; color: #64748B;">Điều khiển xe di chuyển ra khỏi vị trí đỗ hẹp tự động thông qua thao tác trên ứng dụng smartphone.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🗣️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Trợ Lý Ảo Tiếng Việt 3 Miền (ViVi Assistant)</h4>
          <p style="font-size: 14px; color: #64748B;">Nhận diện giọng nói tự nhiên 3 miền điều khiển điều hòa, mở cửa trần kính và hỏi đáp thông tin giao thông.</p>
        </div>
      </div>
    </div>

    <!-- Banner Đặc Quyền Bảo Hành -->
    <div class="vf9-privilege-banner" data-aos="fade-up">
      <div>
        <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #60a5fa;">Đặc quyền sở hữu xe VinFast VF 9</span>
        <h3 style="font-size: 2.2rem; font-weight: 900; margin-top: 8px;">Bảo Hành Chính Hãng 10 Năm</h3>
        <p style="color: rgba(255,255,255,0.8); margin-top: 12px; font-size: 15px;">VinFast cam kết chất lượng hàng đầu với chính sách bảo hành 10 năm hoặc 200.000 km, cùng dịch vụ cứu hộ 24/7 toàn quốc.</p>
      </div>
      <div>
        <ul class="vf9-privilege-list">
          <li>Bảo hành chính hãng 10 năm cho xe và Pin</li>
          <li>Dịch vụ Cứu hộ 24/7 miễn phí toàn quốc</li>
          <li>Sửa chữa lưu động Mobile Service tận nơi</li>
          <li>Mạng lưới trạm sạc phủ rộng 63 tỉnh thành</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<!-- 7. BẢNG THÔNG SỐ KỸ THUẬT VF 9 CHÍNH HÃNG -->
<section class="vf9-section vf9-section-alt" id="thong-so">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Thông số chi tiết</span>
      <h2 class="vf9-sec-title">Thông Số Kỹ Thuật VinFast VF 9</h2>
    </div>

    <div class="vf9-specs-tabs-nav">
      <button class="vf9-spec-tab-btn active" onclick="switchVF9SpecTab('kich-thuoc', this)">Kích Thước & Động Cơ</button>
      <button class="vf9-spec-tab-btn" onclick="switchVF9SpecTab('pin-sac', this)">Pin & Trạm Sạc</button>
      <button class="vf9-spec-tab-btn" onclick="switchVF9SpecTab('an-toan', this)">An Toàn & ADAS</button>
    </div>

    <div class="vf9-specs-table-wrap" data-aos="fade-up">
      <table class="vf9-specs-table" id="vf9SpecTabKichThuoc">
        <tr><td>Dài x Rộng x Cao (mm)</td><td>5.118 x 1.967 x 1.696</td></tr>
        <tr><td>Chiều dài cơ sở (mm)</td><td>3.150 mm</td></tr>
        <tr><td>Khoảng sáng gầm xe (mm)</td><td>197 mm</td></tr>
        <tr><td>Số chỗ ngồi</td><td>6 chỗ / 7 chỗ thương gia</td></tr>
        <tr><td>Động cơ điện</td><td>2 Motor (AWD 2 Cầu)</td></tr>
        <tr><td>Công suất tối đa</td><td>402 mã lực (300 kW)</td></tr>
        <tr><td>Mô-men xoắn cực đại</td><td>620 Nm</td></tr>
      </table>

      <table class="vf9-specs-table" id="vf9SpecTabPinSac" style="display: none;">
        <tr><td>Dung lượng pin khả dụng</td><td>123.0 kWh (CATL)</td></tr>
        <tr><td>Quãng đường di chuyển (WLTP)</td><td>602 km / 1 lần sạc đầy</td></tr>
        <tr><td>Thời gian sạc nhanh (10-70%)</td><td>~ 35 phút (Trạm sạc DC)</td></tr>
        <tr><td>Bộ sạc di động theo xe</td><td>Portable AC 3.5 kW / Home Charger 11 kW</td></tr>
        <tr><td>Mạng lưới trạm sạc</td><td>V-GREEN phủ rộng 63 tỉnh thành Việt Nam</td></tr>
      </table>

      <table class="vf9-specs-table" id="vf9SpecTabAnToan" style="display: none;">
        <tr><td>Số túi khí an toàn</td><td>11 túi khí toàn cảnh</td></tr>
        <tr><td>Hệ thống trợ lái ADAS</td><td>Cấp độ 2 (Hỗ trợ lái cao tốc, Chuyển làn tự động)</td></tr>
        <tr><td>Hệ thống phanh</td><td>Đĩa tản nhiệt 4 bánh (ABS, EBD, BA, ESC, TCS)</td></tr>
        <tr><td>Triệu tập xe thông minh</td><td>Có (Smart Summon qua Smartphone)</td></tr>
        <tr><td>Thời gian bảo hành xe</td><td>10 năm hoặc 200.000 km</td></tr>
      </table>
    </div>

  </div>
</section>

<!-- Scripts cho VF 9 Template -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  const vf9Prices = {
    eco:  { thue: '1.348.000.000 VNĐ', mua: '1.999.000.000 VNĐ' },
    plus: { thue: '1.529.000.000 VNĐ', mua: '2.199.000.000 VNĐ' }
  };

  let currentVF9Version = 'eco';
  let currentVF9Battery = 'thue';

  function updateVF9Price() {
    const priceText = vf9Prices[currentVF9Version][currentVF9Battery];
    document.getElementById('vf9DynamicPrice').textContent = priceText;
    document.getElementById('subnav-price-display-vf9').textContent = priceText;
  }

  function setVF9Version(ver, btn) {
    currentVF9Version = ver;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateVF9Price();
  }

  function setVF9Battery(bat, btn) {
    currentVF9Battery = bat;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateVF9Price();
  }

  // Đổi màu xe VF 9 Real-time Cutouts
  document.querySelectorAll('.vf9-color-dot').forEach(dot => {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf9-color-dot').forEach(d => d.classList.remove('active'));
      this.classList.add('active');

      const imgSrc = this.getAttribute('data-img');
      const colorName = this.getAttribute('data-color');
      const stageImg = document.getElementById('vf9CarStageImg');

      stageImg.classList.add('changing');
      setTimeout(() => {
        stageImg.src = imgSrc;
        stageImg.classList.remove('changing');
      }, 200);

      document.getElementById('vf9ColorLabel').textContent = 'Màu đang chọn: ' + colorName;
    });
  });

  // Sticky Subnav Scroll
  window.addEventListener('scroll', function() {
    const subnav = document.getElementById('vf9StickySubnav');
    if (window.scrollY > 480) {
      subnav.classList.add('active');
    } else {
      subnav.classList.remove('active');
    }
  });

  // Tabs Thông số VF 9
  function switchVF9SpecTab(tabKey, btn) {
    document.querySelectorAll('.vf9-spec-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.getElementById('vf9SpecTabKichThuoc').style.display = 'none';
    document.getElementById('vf9SpecTabPinSac').style.display = 'none';
    document.getElementById('vf9SpecTabAnToan').style.display = 'none';

    if (tabKey === 'kich-thuoc') document.getElementById('vf9SpecTabKichThuoc').style.display = 'table';
    if (tabKey === 'pin-sac') document.getElementById('vf9SpecTabPinSac').style.display = 'table';
    if (tabKey === 'an-toan') document.getElementById('vf9SpecTabAnToan').style.display = 'table';
  }
</script>

<!-- SO SÁNH CHI PHÍ NHIÊN LIỆU VF 9 VS XE ĐỘNG CƠ ĐỐT TRONG -->
<section id="so-sanh-chi-phi" style="background: #F8FAFC; padding: 80px 0;">
<style>
  /* Fuel Calculator Styles — shared with VF2/VF3 */
  .vf-calc-wrap { background: #fff; border-radius: 20px; box-shadow: 0 4px 32px rgba(0,0,0,0.07); overflow: hidden; }
  .vf-calc-grid { display: grid; grid-template-columns: 1fr 1fr; }
  .vf-calc-left { padding: 40px 48px; border-right: 1px solid #E2E8F0; }
  .vf-calc-right { padding: 40px 48px; background: #F8FAFC; }
  .vf-calc-subtitle { color: #64748B; font-size: 15px; margin-bottom: 28px; }
  .vf-field-label { font-size: 14px; font-weight: 700; color: #2563EB; margin-bottom: 10px; display: block; }
  .vf-field-group { margin-bottom: 24px; }
  .vf-field-note { font-size: 13px; color: #64748B; margin-bottom: 6px; }
  .vf-radio-group { display: flex; gap: 24px; align-items: center; }
  .vf-radio-group label { display: flex; align-items: center; gap: 7px; font-size: 15px; font-weight: 600; cursor: pointer; color: #1E293B; }
  .vf-radio-group input[type="radio"] { accent-color: #2563EB; width: 18px; height: 18px; cursor: pointer; }
  .vf-number-input { width: 100%; border: 1.5px solid #E2E8F0; border-radius: 10px; padding: 12px 16px; font-size: 15px; font-weight: 600; color: #1E293B; background: #F8FAFC; text-align: right; transition: border-color 0.2s; outline: none; }
  .vf-number-input:focus { border-color: #2563EB; background: #fff; }
  .vf-input-unit { position: relative; }
  .vf-input-unit::after { content: attr(data-unit); position: absolute; right: 14px; top: 50%; transform: translateY(-50%); font-size: 13px; color: #94A3B8; font-weight: 600; pointer-events: none; }
  .vf-input-unit input { padding-right: 40px; }
  .vf-hint { font-size: 12px; color: #94A3B8; margin-top: 20px; line-height: 1.6; }
  .vf-btn-compare { background: #2563EB; color: #fff; border: none; border-radius: 10px; padding: 0 36px; height: 48px; font-size: 13px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; margin-top: 28px; transition: background 0.2s, transform 0.1s; width: 100%; }
  .vf-btn-compare:hover { background: #1D4ED8; transform: translateY(-1px); }
  .vf-result-header { display: flex; align-items: center; gap: 14px; margin-bottom: 24px; }
  .vf-result-header img { width: 90px; object-fit: contain; }
  .vf-result-header-text h4 { font-size: 1rem; font-weight: 800; color: #1E293B; margin-bottom: 4px; }
  .vf-result-placeholder { color: #94A3B8; font-size: 14px; }
  .vf-result-icon { width: 44px; height: 44px; background: #EFF6FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
  .vf-result-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
  .vf-result-table tr td { padding: 12px 0; border-bottom: 1px solid #E2E8F0; font-size: 14px; }
  .vf-result-table tr:last-child td { border-bottom: none; }
  .vf-result-table .lbl { color: #64748B; }
  .vf-result-table .vf-val { font-weight: 800; color: #16A34A; text-align: right; }
  .vf-result-table .gas-val { font-weight: 800; color: #EF4444; text-align: right; }
  .vf-result-save { margin-top: 20px; background: linear-gradient(135deg, #2563EB, #1E40AF); border-radius: 14px; padding: 20px 24px; color: #fff; text-align: center; }
  .vf-result-save .save-label { font-size: 12px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: rgba(255,255,255,0.7); margin-bottom: 6px; }
  .vf-result-save .save-amount { font-size: 1.8rem; font-weight: 900; color: #FCD34D; }
  .vf-result-save .save-period { font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px; }
  .vf-result-cta { display: flex; gap: 12px; margin-top: 20px; flex-wrap: wrap; }
  .vf-result-cta a { flex: 1; min-width: 130px; text-align: center; height: 44px; line-height: 44px; border-radius: 8px; font-size: 12px; font-weight: 800; letter-spacing: 0.5px; text-transform: uppercase; text-decoration: none; transition: opacity 0.2s; }
  .vf-result-cta .btn-laithu { background: #2563EB; color: #fff; }
  .vf-result-cta .btn-dutoan { background: #E0EDFF; color: #2563EB; }
  @media (max-width: 768px) {
    .vf-calc-grid { grid-template-columns: 1fr; }
    .vf-calc-left { border-right: none; border-bottom: 1px solid #E2E8F0; padding: 28px 20px; }
    .vf-calc-right { padding: 28px 20px; }
  }
</style>

  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Tiết kiệm vượt trội</span>
      <h2 class="vf9-sec-title">So Sánh Giữa Xe VinFast VF 9 Và Xe Động Cơ Đốt Trong</h2>
    </div>

    <div class="vf-calc-wrap" data-aos="fade-up" style="margin-top: 40px;">
      <div class="vf-calc-grid">

        <!-- LEFT: Input Form -->
        <div class="vf-calc-left">
          <p class="vf-calc-subtitle">Vui lòng nhập thông tin xe động cơ đốt trong cần so sánh:</p>

          <div class="vf-field-group">
            <span class="vf-field-label">Loại nhiên liệu sử dụng</span>
            <div class="vf-radio-group">
              <label>
                <input type="radio" name="vf9_fuel_type" id="vf9_fuel_xang" value="xang" checked>
                Xăng
              </label>
              <label>
                <input type="radio" name="vf9_fuel_type" id="vf9_fuel_dau" value="dau">
                Dầu
              </label>
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập mức tiêu thụ nhiên liệu:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Mức tiêu thụ nhiên liệu/100km *</span>
            <div class="vf-input-unit" data-unit="lít">
              <input type="number" id="vf9_fuel_consumption" class="vf-number-input" value="12" min="1" max="50" step="0.1" placeholder="12">
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập quãng đường di chuyển mỗi tháng:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Quãng đường di chuyển/tháng *</span>
            <div class="vf-input-unit" data-unit="km">
              <input type="number" id="vf9_distance_month" class="vf-number-input" value="1500" min="100" max="10000" step="50" placeholder="1500">
            </div>
          </div>

          <p class="vf-hint">(*) Nhập số, dùng dấu chấm "." cho phần thập phân (không dùng dấu phân cách hàng nghìn). Ví dụ: 12.5 lít; 1500 km.</p>

          <button class="vf-btn-compare" onclick="calcVF9Compare()">SO SÁNH</button>
        </div>

        <!-- RIGHT: Result Panel -->
        <div class="vf-calc-right">
          <div class="vf-result-header">
            <div class="vf-result-icon">🌿</div>
            <div class="vf-result-header-text">
              <h4>Lợi thế chi phí nhiên liệu của VF 9</h4>
              <p class="vf-result-placeholder" id="vf9_result_placeholder">(*) Chưa có dữ liệu so sánh. Vui lòng nhập thông tin!</p>
            </div>
            <img src="<?php echo esc_url($uploads_url . '/vf9_cutout_white.webp'); ?>"
                 alt="VinFast VF 9"
                 onerror="this.style.display='none'">
          </div>

          <div id="vf9_result_body" style="display:none;">
            <table class="vf-result-table">
              <tr>
                <td class="lbl">⚡ Chi phí điện VF 9 / tháng</td>
                <td class="vf-val" id="vf9_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl" id="vf9_fuel_label_month">⛽ Chi phí xăng / tháng</td>
                <td class="gas-val" id="vf9_gas_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl">⚡ Chi phí điện VF 9 / năm</td>
                <td class="vf-val" id="vf9_cost_year"></td>
              </tr>
              <tr>
                <td class="lbl" id="vf9_fuel_label_year">⛽ Chi phí xăng / năm</td>
                <td class="gas-val" id="vf9_gas_cost_year"></td>
              </tr>
            </table>

            <div class="vf-result-save">
              <div class="save-label">Bạn tiết kiệm được mỗi năm</div>
              <div class="save-amount" id="vf9_save_year"></div>
              <div class="save-period" id="vf9_save_note"></div>
            </div>

            <div class="vf-result-cta">
              <a href="/dat-lich-lai-thu/" class="btn-laithu">🚗 Đặt Lịch Lái Thử</a>
              <a href="/du-toan-tra-gop/" class="btn-dutoan">📊 Dự Toán Trả Góp</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<script>
(function() {
  // VF 9: điện tiêu thụ 23 kWh/100km, giá điện 3.000 VNĐ/kWh
  var VF9_KWH_PER_100KM = 23;
  var VF9_ELEC_PRICE_PER_KWH = 3000;
  var VF9_XANG_PRICE = 24000;
  var VF9_DAU_PRICE  = 21000;

  window.calcVF9Compare = function() {
    var fuelType    = document.querySelector('input[name="vf9_fuel_type"]:checked').value;
    var consumption = parseFloat(document.getElementById('vf9_fuel_consumption').value);
    var distance    = parseFloat(document.getElementById('vf9_distance_month').value);

    if (isNaN(consumption) || consumption <= 0 || isNaN(distance) || distance <= 0) {
      alert('Vui lòng nhập đầy đủ và hợp lệ mức tiêu thụ và quãng đường!');
      return;
    }

    var fuelPrice    = fuelType === 'dau' ? VF9_DAU_PRICE : VF9_XANG_PRICE;
    var fuelLabel    = fuelType === 'dau' ? 'Dầu' : 'Xăng';

    var elecCostMonth = (distance / 100) * VF9_KWH_PER_100KM * VF9_ELEC_PRICE_PER_KWH;
    var elecCostYear  = elecCostMonth * 12;
    var gasCostMonth  = (distance / 100) * consumption * fuelPrice;
    var gasCostYear   = gasCostMonth * 12;
    var saveYear      = gasCostYear - elecCostYear;

    document.getElementById('vf9_result_placeholder').style.display = 'none';
    document.getElementById('vf9_result_body').style.display = 'block';

    document.getElementById('vf9_cost_month').textContent      = formatVND(elecCostMonth) + ' VNĐ';
    document.getElementById('vf9_gas_cost_month').textContent  = formatVND(gasCostMonth)  + ' VNĐ';
    document.getElementById('vf9_cost_year').textContent       = formatVND(elecCostYear)  + ' VNĐ';
    document.getElementById('vf9_gas_cost_year').textContent   = formatVND(gasCostYear)   + ' VNĐ';
    document.getElementById('vf9_fuel_label_month').textContent = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / tháng';
    document.getElementById('vf9_fuel_label_year').textContent  = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / năm';
    document.getElementById('vf9_save_year').textContent       = formatVND(saveYear) + ' VNĐ';
    document.getElementById('vf9_save_note').textContent       = 'Dựa trên ' + Math.round(distance).toLocaleString('vi-VN') + ' km/tháng với ' + consumption + ' lít ' + fuelLabel.toLowerCase() + '/100km';
  };

  function formatVND(num) {
    return Math.round(num).toLocaleString('vi-VN');
  }
})();
</script>

<?php get_footer(); ?>


    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; margin-top: 48px;" class="vf9-compare-grid">

      <!-- Xe Điện VF 9 -->
      <div style="background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 100%); border-radius: 24px; padding: 40px; color: #fff; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
        <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(37,99,235,0.3); border: 1px solid rgba(96,165,250,0.4); border-radius: 20px; padding: 6px 16px; margin-bottom: 24px;">
          <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #60a5fa;">⚡ Xe Điện</span>
        </div>
        <h3 style="font-size: 1.6rem; font-weight: 900; margin-bottom: 8px;">VinFast VF 9</h3>
        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin-bottom: 32px;">SUV 7 chỗ hạng sang — chi phí vận hành tiết kiệm</p>

        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">⚡ Chi phí điện / 100km</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">~30.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">📅 Chi phí / tháng (1.500km)</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">~450.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">📆 Chi phí / năm (18.000km)</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">~5.400.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0;">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">🔧 Bảo dưỡng định kỳ</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">Gần như bằng 0</span>
          </div>
        </div>

        <div style="margin-top: 28px; padding: 16px; background: rgba(52,211,153,0.15); border: 1px solid rgba(52,211,153,0.3); border-radius: 12px; text-align: center;">
          <span style="font-size: 13px; color: #34d399; font-weight: 700;">🌱 Không khí thải CO₂ — Thân thiện môi trường</span>
        </div>
      </div>

      <!-- Xe Xăng Hạng Sang Tương Đương -->
      <div style="background: #fff; border-radius: 24px; padding: 40px; border: 2px solid #E2E8F0; position: relative;">
        <div style="display: inline-flex; align-items: center; gap: 8px; background: #FEF3C7; border: 1px solid #FDE68A; border-radius: 20px; padding: 6px 16px; margin-bottom: 24px;">
          <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #92400E;">⛽ Xe Xăng</span>
        </div>
        <h3 style="font-size: 1.6rem; font-weight: 900; color: #1E293B; margin-bottom: 8px;">SUV Hạng Sang Xăng Cùng Phân Khúc</h3>
        <p style="color: #64748B; font-size: 14px; margin-bottom: 32px;">Chi phí vận hành rất cao</p>

        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #E2E8F0;">
            <span style="font-size: 14px; color: #64748B;">⛽ Chi phí xăng / 100km</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">~130.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #E2E8F0;">
            <span style="font-size: 14px; color: #64748B;">📅 Chi phí / tháng (1.500km)</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">~1.950.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #E2E8F0;">
            <span style="font-size: 14px; color: #64748B;">📆 Chi phí / năm (18.000km)</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">~23.400.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0;">
            <span style="font-size: 14px; color: #64748B;">🔧 Bảo dưỡng định kỳ</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">5–8 triệu/lần</span>
          </div>
        </div>

        <div style="margin-top: 28px; padding: 16px; background: #FEF2F2; border: 1px solid #FCA5A5; border-radius: 12px; text-align: center;">
          <span style="font-size: 13px; color: #DC2626; font-weight: 700;">🏭 Phát thải CO₂ cao — Ô nhiễm môi trường</span>
        </div>
      </div>
    </div>

    <!-- Kết Luận Tiết Kiệm -->
    <div data-aos="fade-up" style="margin-top: 48px; background: linear-gradient(135deg, #2563EB, #1E40AF); border-radius: 20px; padding: 40px; text-align: center; color: #fff;">
      <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 12px;">Tiết kiệm đến <span style="color: #FCD34D;">~18.000.000 VNĐ/năm</span></h3>
      <p style="color: rgba(255,255,255,0.8); font-size: 16px; max-width: 600px; margin: 0 auto 28px;">Chỉ tính riêng chi phí nhiên liệu, VF 9 tiết kiệm hơn SUV xăng hạng sang cùng phân khúc từ 3–4 lần. Đó là chưa tính chi phí bảo dưỡng và ưu đãi đặc biệt.</p>
      <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="/dat-lich-lai-thu/" class="vf-btn" style="background: #fff; color: #2563EB;">🚗 Đặt Lịch Lái Thử</a>
        <a href="/du-toan-tra-gop/" class="vf-btn" style="background: transparent; border: 2px solid rgba(255,255,255,0.5); color: #fff;">📊 Dự Toán Trả Góp</a>
      </div>
    </div>
  </div>
</section>

<style>
  @media (max-width: 768px) {
    .vf9-compare-grid { grid-template-columns: 1fr !important; }
  }
</style>

<?php get_footer(); ?>

<!-- SO SÁNH GIỮA XE VINFAST VÀ XE ĐỘNG CƠ ĐỐT TRONG (CUỐI TRANG PDP) -->
<section class="vf-official-compare-sec" id="so-sanh">
  <div class="container">
    <h2 class="vf-compare-main-title">So sánh giữa xe VinFast VF 9 và xe động cơ đốt trong</h2>

    <div class="vf-compare-row-grid">
      
      <!-- Cột Trái: Input Form -->
      <div class="vf-compare-left-col">
        <div class="vf-compare-guide-txt">Vui lòng nhập thông tin xe động cơ đốt trong cần so sánh:</div>

        <div class="vf-compare-field-group">
          <div class="vf-compare-field-row">
            <span class="vf-compare-field-lbl">Loại nhiên liệu sử dụng</span>
            <div class="vf-compare-radios">
              <label class="vf-compare-radio-item">
                <input type="radio" name="radio_fuel_vf9" value="xang" checked> Xăng
              </label>
              <label class="vf-compare-radio-item">
                <input type="radio" name="radio_fuel_vf9" value="dau"> Dầu
              </label>
            </div>
          </div>
        </div>

        <div class="vf-compare-field-group">
          <div class="vf-compare-field-lbl" style="margin-bottom: 8px;">Mức tiêu thụ nhiên liệu/100km *</div>
          <div class="vf-compare-input-box">
            <input type="number" id="cons_vf9" class="vf-compare-input-elem" value="10" step="0.5" min="1">
            <span class="vf-compare-input-unit">lít</span>
          </div>
        </div>

        <div class="vf-compare-guide-txt" style="margin-top: 24px;">Vui lòng nhập quãng đường di chuyển mỗi tháng:</div>

        <div class="vf-compare-field-group">
          <div class="vf-compare-field-lbl" style="margin-bottom: 8px;">Quãng đường di chuyển/tháng *</div>
          <div class="vf-compare-input-box">
            <input type="number" id="dist_vf9" class="vf-compare-input-elem" value="1000" step="100" min="100">
            <span class="vf-compare-input-unit">km</span>
          </div>
        </div>

        <div class="vf-compare-note-txt">
          (*) Nhập số, dùng dấu chấm "." cho phần thập phân (không dùng dấu phân cách hàng nghìn). Ví dụ: 8.56 lít, 1023.56 km.
        </div>

        <button type="button" class="vf-btn vf-btn-primary" style="width: 140px;" onclick="calculateVFCompare_vf9()">SO SÁNH</button>
      </div>

      <!-- Cột Phải: Card Kết Quả Tint #EBF3F8 -->
      <div class="vf-compare-right-card">
        <img src="<?php echo esc_url($uploads_url . '/vf9_cutout_white.png'); ?>" alt="VinFast VF 9" class="vf-compare-top-car-img">
        
        <div class="vf-compare-card-head">
          <div class="vf-compare-leaf-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M17 8C17 10.76 14.76 13 12 13C9.24 13 7 10.76 7 8C7 5.24 9.24 3 12 3C14.76 3 17 5.24 17 8Z" fill="#10B981"/>
              <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2Z" stroke="#10B981" stroke-width="2"/>
            </svg>
          </div>
          <h3 class="vf-compare-card-title-txt">Lợi thế chi phí nhiên liệu của VF 9</h3>
        </div>

        <div id="res_output_vf9">
          <div class="vf-compare-empty-msg">(*) Chưa có dữ liệu so sánh. Vui lòng nhập thông tin!</div>
        </div>
      </div>

    </div>
  </div>
</section>

<script>
  function calculateVFCompare_vf9() {
    const dist = parseFloat(document.getElementById('dist_vf9').value) || 0;
    const cons = parseFloat(document.getElementById('cons_vf9').value) || 0;

    if (dist <= 0 || cons <= 0) {
      document.getElementById('res_output_vf9').innerHTML = '<div class="vf-compare-empty-msg">(*) Chưa có dữ liệu so sánh. Vui lòng nhập thông tin!</div>';
      return;
    }

    let fuelPrice = 23500;
    const radios = document.getElementsByName('radio_fuel_vf9');
    for (let r of radios) {
      if (r.checked && r.value === 'dau') {
        fuelPrice = 20500;
        break;
      }
    }

    const iceCostMonthly = (dist / 100) * cons * fuelPrice;
    const evKwhPer100 = 21.0;
    const evPricePerKwh = 3858;
    const evCostMonthly = (dist / 100) * evKwhPer100 * evPricePerKwh;
    const monthlySave = iceCostMonthly - evCostMonthly;
    const yearlySave = monthlySave * 12;

    const fmt = num => new Intl.NumberFormat('vi-VN').format(Math.round(num)) + ' VNĐ';

    const html = `
      <div class="vf-compare-res-list">
        <div class="vf-compare-res-item">
          <span class="vf-compare-res-lbl">⛽ Chi phí nhiên liệu xe Xăng/Dầu / tháng:</span>
          <span class="vf-compare-res-val" style="color: #EF4444;">${fmt(iceCostMonthly)}</span>
        </div>
        <div class="vf-compare-res-item">
          <span class="vf-compare-res-lbl">⚡ Chi phí sạc điện VinFast VF 9 / tháng:</span>
          <span class="vf-compare-res-val" style="color: #10B981;">${fmt(evCostMonthly)}</span>
        </div>
        <div class="vf-compare-res-item">
          <span class="vf-compare-res-lbl">💰 Tiết kiệm chi phí mỗi tháng:</span>
          <span class="vf-compare-res-val" style="color: #2563EB;">${fmt(monthlySave)}</span>
        </div>
        <div class="vf-compare-highlight-box">
          <div style="font-size: 12px; opacity: 0.9; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">TỔNG TIẾT KIỆM SAU 1 NĂM</div>
          <div style="font-size: 1.8rem; font-weight: 900;">${fmt(yearlySave)}</div>
        </div>
      </div>
    `;

    document.getElementById('res_output_vf9').innerHTML = html;
  }
</script>

<?php get_footer(); ?>
