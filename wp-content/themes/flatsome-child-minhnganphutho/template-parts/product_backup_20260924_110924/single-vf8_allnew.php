<?php
/**
 * Dedicated Authentic Product Template for VinFast VF 8 The All New
 * Location: template-parts/product/single-vf8_allnew.php
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
    get_header();
}

$uploads_url = content_url('/uploads/official_cars/vf8_allnew');
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

<style>
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
  .vf9-stage-car-img { position: relative; z-index: 2; width: 100%; max-width: 960px; height: auto; max-height: 460px; object-fit: contain; transform: scale(1.1); transition: opacity 0.35s ease, transform 0.4s ease; filter: drop-shadow(0 20px 36px rgba(15,23,42,0.12)); }
  .vf9-stage-car-img.changing { opacity: 0; transform: scale(1.05); }
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

  /* Fuel Calculator Styles */
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

  @media (max-width: 992px) {
    .vf9-controls-grid, .vf9-grid-3, .vf9-tech-grid, .vf9-privilege-banner { grid-template-columns: 1fr; }
    .vf9-perf-stats-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 768px) {
    .vf-calc-grid { grid-template-columns: 1fr; }
    .vf-calc-left { border-right: none; border-bottom: 1px solid #E2E8F0; padding: 28px 20px; }
    .vf-calc-right { padding: 28px 20px; }
  }
</style>

<!-- Sticky Subnav Bar -->
<div class="vf-subnav" id="vf8ANStickySubnav">
  <div class="vf-subnav-inner">
    <div class="vf-subnav-title">VinFast VF 8 The All New</div>
    <ul class="vf-subnav-links">
      <li><a href="#tong-quan" class="active">Tổng quan</a></li>
      <li><a href="#ngoai-that">Ngoại thất</a></li>
      <li><a href="#noi-that">Nội thất</a></li>
      <li><a href="#van-hanh">Vận hành</a></li>
      <li><a href="#an-toan">An toàn & ADAS</a></li>
      <li><a href="#so-sanh-chi-phi">So sánh chi phí</a></li>
      <li><a href="#thong-so">Thông số kỹ thuật</a></li>
    </ul>
    <div class="vf-subnav-actions">
      <div class="vf-subnav-price-wrap">
        <span class="vf-subnav-price-label" style="font-size:11px; color:#64748B;">Giá niêm yết từ</span>
        <span class="vf-subnav-price-val" id="subnav-price-display-vf8an">899.000.000 VNĐ</span>
      </div>
      <a href="#configurator" class="vf-btn vf-btn-primary">ĐẶT CỌC NGAY</a>
    </div>
  </div>
</div>

<!-- 1. HERO BANNER CHÍNH HÃNG VF 8 ALL NEW -->
<section class="vf9-hero" id="tong-quan">
  <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_banner-vf8-20250529-scaled.webp'); ?>" 
       alt="VinFast VF 8 The All New Banner" 
       class="vf9-hero-bg"
       onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
  <div class="vf9-hero-overlay"></div>
  <div class="vf9-hero-content" data-aos="fade-up">
    <span class="vf9-hero-badge">D-SUV THẾ HỆ MỚI ĐẮC LỰC & SANG TRỌNG</span>
    <h1 class="vf9-hero-title">VINFAST VF 8 THE ALL NEW<br>BỨT PHÁ TẦM CAO MỚI</h1>
    <p class="vf9-hero-desc">VinFast VF 8 The All New — Phiên bản thế hệ mới nâng cấp toàn diện với chip xử lý ADAS mới nhất, pin LFP dung lượng cao di chuyển tới 500 km và hệ thống trang bị sang trọng vượt cấp.</p>
    <div style="display: flex; gap: 16px;">
      <a href="#configurator" class="vf-btn vf-btn-primary">TÙY CHỈNH CẤU HÌNH XE</a>
      <a href="<?php echo esc_url(home_url('/du-toan-tra-gop/')); ?>" class="vf-btn vf-btn-outline" style="color:#fff; border-color:#fff;">DỰ TOÁN TRẢ GÓP</a>
    </div>
  </div>
</section>

<!-- 2. TRÌNH CẤU HÌNH VÀ ĐỔI MÀU XE VF 8 ALL NEW STUDIO -->
<section class="vf9-configurator" id="configurator">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Trình tùy chỉnh trực quan</span>
      <h2 class="vf9-sec-title">Khám Phá Cấu Hình VF 8 The All New</h2>
      <p class="vf9-sec-desc">Tùy chọn màu sắc ngoại thất chính hãng, phiên bản trang bị và hình thức sở hữu pin</p>
    </div>

    <!-- Canvas Xe Studio VF 8 All New -->
    <div class="vf9-stage-wrap">
      <img id="vf8anCarStageImg" 
           src="<?php echo esc_url($uploads_url . '/cutout_vf8_allnew.png'); ?>" 
           alt="VinFast VF 8 The All New Studio Render" 
           class="vf9-stage-car-img">
    </div>

    <!-- Bảng Điều Khiển Cấu Hình -->
    <div class="vf9-controls-panel" data-aos="fade-up">
      <div class="vf9-controls-grid">
        
        <!-- Chọn Màu Ngoại Thất Chính Hãng VF 8 All New -->
        <div>
          <div class="vf9-option-group-title">Chọn màu ngoại thất chính hãng:</div>
          <div class="vf9-color-dots-row">
            <button class="vf9-color-dot active" style="background: #ffffff;" data-img="<?php echo esc_url($uploads_url . '/cutout_vf8_allnew.png'); ?>" data-color="Trắng Brahmini White"></button>
            <button class="vf9-color-dot" style="background: #94a3b8;" data-img="<?php echo esc_url($uploads_url . '/vf8_allnew_50_ex-ex4.png'); ?>" data-color="Bạc DeSat Silver"></button>
            <button class="vf9-color-dot" style="background: #8b0000;" data-img="<?php echo esc_url($uploads_url . '/vf8_allnew_51_ex-ex5-e.png'); ?>" data-color="Đỏ Crimson Red"></button>
            <button class="vf9-color-dot" style="background: #1e3a8a;" data-img="<?php echo esc_url($uploads_url . '/vf8_allnew_53_ex-right.png'); ?>" data-color="Xanh Deep Ocean"></button>
            <button class="vf9-color-dot" style="background: #0f172a;" data-img="<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>" data-color="Đen Jet Black"></button>
          </div>
          <div class="vf9-selected-color-label" id="vf8anColorLabel">Màu đang chọn: Trắng Brahmini White</div>
        </div>

        <!-- Chọn Phiên Bản & Pin -->
        <div>
          <div class="vf9-option-group-title">Chọn phiên bản trang bị:</div>
          <div class="vf9-toggle-group" style="margin-bottom: 16px;">
            <button class="vf9-toggle-btn active" onclick="setVF8ANVersion('eco', this)">VF 8 All-New Eco</button>
            <button class="vf9-toggle-btn" onclick="setVF8ANVersion('plus', this)">VF 8 All-New Plus (AWD)</button>
          </div>

          <div class="vf9-option-group-title">Hình thức sở hữu Pin:</div>
          <div class="vf9-toggle-group">
            <button class="vf9-toggle-btn active" onclick="setVF8ANBattery('thue', this)">Thuê Pin Hàng Tháng</button>
            <button class="vf9-toggle-btn" onclick="setVF8ANBattery('mua', this)">Mua Đứt Pin</button>
          </div>
        </div>

      </div>

      <!-- Tính Giá Động Real-time -->
      <div class="vf9-config-price-bar">
        <div>
          <div class="vf9-sec-label" style="margin: 0;">Giá niêm yết xe (Đã bao gồm VAT):</div>
          <div class="vf9-price-amount" id="vf8anDynamicPrice">899.000.000 VNĐ</div>
          <div style="font-size: 12px; color: #64748B;">*Miễn 100% lệ phí trước bạ, nâng cấp gói phần mềm Smart Services miễn phí</div>
        </div>
        <div style="display: flex; gap: 12px;">
          <a href="<?php echo esc_url(home_url('/du-toan-tra-gop/')); ?>" class="vf-btn vf-btn-outline">DỰ TOÁN CHI PHÍ</a>
          <button class="vf-btn vf-btn-primary" onclick="alert('Đã gửi yêu cầu tư vấn đặt cọc VF 8 The All New!')">ĐẶT CỌC ONLINE</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3. NGOẠI THẤT CHÍNH HÃNG VF 8 ALL NEW -->
<section class="vf9-section vf9-section-alt" id="ngoai-that">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Ngoại thất cải tiến</span>
      <h2 class="vf9-sec-title">Diện Mạo Thể Thao & Đẳng Cấp Thế Hệ Mới</h2>
      <p class="vf9-sec-desc">Đường nét góc cạnh sắc sảo hơn, mâm xe thiết kế khí động học mới cùng hệ thống đèn pha matrix thông minh.</p>
    </div>

    <div class="vf9-grid-3">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_54_tech-t1.png'); ?>" 
             alt="Cụm đèn LED thế hệ mới" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Đèn Pha LED Matrix Thông Minh</h3>
          <p class="vf9-card-desc">Tự động điều chỉnh vùng sáng chống chói mắt người đi ngược chiều mà vẫn tối ưu tầm nhìn xa.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_55_tech-t2.png'); ?>" 
             alt="Mâm 20 inch thế hệ mới" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Mâm Xe Phay 2 Màu Đẳng Cấp</h3>
          <p class="vf9-card-desc">Thiết kế mâm phay đa chấu thể thao thế hệ mới tăng diện mạo cá tính cho D-SUV.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_56_tech-t3.png'); ?>" 
             alt="Đuôi xe VF 8 All New" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Dải Đèn Cánh Nhạn Nhận Diện 3D</h3>
          <p class="vf9-card-desc">Dải đèn LED nhận diện thương hiệu dạng 3D nổi bật kiêu hãnh kiên cố trên mọi cung đường.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. NỘI THẤT KHOANG LÁI VF 8 ALL NEW -->
<section class="vf9-section" id="noi-that">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Nội thất nâng cấp</span>
      <h2 class="vf9-sec-title">Khoang Lái Thông Minh & Tiện Nghi Đỉnh Cao</h2>
      <p class="vf9-sec-desc">Màn hình giải trí 15.6-inch chip cao cấp mượt mà, cửa sổ trời panorama và da Vegan mềm mại.</p>
    </div>

    <!-- Interior Hero Photo -->
    <div class="vf9-interior-hero" data-aos="fade-up">
      <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_48_car-left.png'); ?>" 
           alt="Nội thất khoang lái VF 8 The All New" 
           class="vf9-interior-hero-img"
           onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
      <div class="vf9-interior-overlay">
        <div>
          <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 12px;">Màn Hình Cảm Ứng 15.6 Inch Chip Snapdragon Mới</h3>
          <p style="max-width: 640px;">Tốc độ xử lý mượt mà gấp 2 lần, hỗ trợ kết nối không dây mượt mượt cùng dàn âm thanh 10 loa sống động.</p>
        </div>
      </div>
    </div>

    <!-- 3 Interior Detail Cards -->
    <div class="vf9-grid-3" style="margin-top: 36px;">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_57_tech-t4.png'); ?>" 
             alt="Màn hình 15.6 inch" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Màn Hình Giải Trí 15.6 Inch 2K</h3>
          <p class="vf9-card-desc">Cấu hình chip Snapdragon xử lý tác vụ thông minh mượt mà, kho ứng dụng xem video đỉnh cao.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_58_s1.png'); ?>" 
             alt="Ghế da bọc cao cấp" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Ghế Da Nappa / Vegan Cao Cấp</h3>
          <p class="vf9-card-desc">Tích hợp sưởi, thông gió và sưởi vô lăng mang lại sự thoải mái trọn vẹn mọi mùa trong năm.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/vf8_allnew_45_tech1.png'); ?>" 
             alt="HUD kính lái thông minh" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Màn Hình HUD Chiếu Kính Lái</h3>
          <p class="vf9-card-desc">Hiển thị đồ họa màu chỉ đường thực tế ảo AR-HUD đưa công nghệ lái xe lên tầm cao mới.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 5. HIỆU NĂNG VẬN HÀNH & TRẠM SẠC CHÍNH HÃNG -->
<section class="vf9-section vf9-section-alt" id="van-hanh">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Hiệu năng bứt phá</span>
      <h2 class="vf9-sec-title">Động Cơ Điện 402 HP — Tầm Hoạt Động 500 KM</h2>
      <p class="vf9-sec-desc">Công nghệ pin LFP thế hệ mới nâng mật độ năng lượng giúp quãng đường di chuyển đạt 500 km cho 1 lần sạc đầy.</p>
    </div>

    <!-- Stats Box -->
    <div class="vf9-perf-stats-grid" data-aos="zoom-in">
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">402</div>
        <div class="vf9-stat-lbl">Mã Lực (HP)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">5.3s</div>
        <div class="vf9-stat-lbl">Tăng Tốc 0-100 km/h</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">500</div>
        <div class="vf9-stat-lbl">Tầm Hoạt Động (KM)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">28m</div>
        <div class="vf9-stat-lbl">Sạc Nhanh 10-70%</div>
      </div>
    </div>

    <!-- Charging Solutions Grid -->
    <div class="vf9-grid-3" style="margin-top: 48px;">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/charging_station_vgreen.jpg'); ?>" 
             alt="Trạm sạc siêu nhanh V-GREEN" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Mạng Lưới Sạc Siêu Nhanh 360kW</h3>
          <p class="vf9-card-desc">Cổng sạc chuẩn quốc tế CCS2 tương thích hoàn toàn trụ sạc công suất cực lớn V-GREEN.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/portable_charger.png'); ?>" 
             alt="Bộ sạc gia đình thế hệ mới" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Bộ Sạc Treo Tường Thông Minh 11 kW</h3>
          <p class="vf9-card-desc">Tự động hẹn giờ sạc qua đêm và điều khiển ngắt dòng điện an toàn qua VinFast App.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/quang-duong.jpg'); ?>" 
             alt="Tiết kiệm tối ưu" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Tối Ưu Chi Phí Sử Dụng</h3>
          <p class="vf9-card-desc">Tiết kiệm nhiên liệu và chi phí bảo dưỡng định kỳ gần như bằng 0 so với xe xăng cùng dung tích.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- 6. AN TOÀN & TIỆN NGHI THÔNG MINH -->
<section class="vf9-section" id="an-toan">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">An toàn tiêu chuẩn 5 sao</span>
      <h2 class="vf9-sec-title">Gói Trợ Lái Nâng Cao ADAS Cấp Độ 2+</h2>
      <p class="vf9-sec-desc">Đạt tiêu chuẩn an toàn cao nhất 5 sao NHTSA & EURO NCAP với hệ thống cảm biến Radar & Camera HD thế hệ mới.</p>
    </div>

    <div class="vf9-tech-grid" data-aos="fade-up">
      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🛡️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">11 Túi Khí An Toàn Toàn Diện</h4>
          <p style="font-size: 14px; color: #64748B;">Hệ thống túi khí đa điểm bảo vệ toàn bộ hành khách mọi vị trí trên xe.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🚗</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Hỗ Trợ Tự Động Chuyển Làn Đường</h4>
          <p style="font-size: 14px; color: #64748B;">Ra tín hiệu xi nhan xe sẽ tự đánh lái chuyển làn an toàn khi đủ khoảng cách.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🅿️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Tự Động Đỗ Xe Triệu Hồi (Summon)</h4>
          <p style="font-size: 14px; color: #64748B;">Điều khiển xe tự tiến/lùi đỗ vào vị trí hẹp thông qua điện thoại thông minh.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🗣️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Trợ Lý Ảo Tiếng Việt ViVi AI Hỗ Trợ AI</h4>
          <p style="font-size: 14px; color: #64748B;">Tích hợp trí tuệ nhân tạo AI học thói quen người dùng và giao tiếp tự nhiên.</p>
        </div>
      </div>
    </div>

    <!-- Banner Đặc Quyền Bảo Hành -->
    <div class="vf9-privilege-banner" data-aos="fade-up">
      <div>
        <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #60a5fa;">Đặc quyền sở hữu VF 8 The All New</span>
        <h3 style="font-size: 2.2rem; font-weight: 900; margin-top: 8px;">Bảo Hành Chính Hãng 10 Năm</h3>
        <p style="color: rgba(255,255,255,0.8); margin-top: 12px; font-size: 15px;">VF 8 The All New được bảo hành 10 năm hoặc 200.000 km, bảo hành Pin 10 năm không giới hạn km và dịch vụ cứu hộ 24/7 toàn quốc.</p>
      </div>
      <div>
        <ul class="vf9-privilege-list">
          <li>Bảo hành xe 10 năm / 200.000 km</li>
          <li>Bảo hành Pin 10 năm không giới hạn km</li>
          <li>Cứu hộ 24/7 miễn phí trên toàn quốc</li>
          <li>Đổi xe cũ lấy xe điện mới nhận trợ giá đặc biệt</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<!-- 7. SO SÁNH CHI PHÍ NHIÊN LIỆU VF 8 ALL NEW VS XE ĐỘNG CƠ ĐỐT TRONG -->
<section id="so-sanh-chi-phi" style="background: #F8FAFC; padding: 80px 0;">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Tiết kiệm vượt trội</span>
      <h2 class="vf9-sec-title">So Sánh Giữa Xe VinFast VF 8 The All New Và Xe Động Cơ Đốt Trong</h2>
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
                <input type="radio" name="vf8an_fuel_type" id="vf8an_fuel_xang" value="xang" checked>
                Xăng
              </label>
              <label>
                <input type="radio" name="vf8an_fuel_type" id="vf8an_fuel_dau" value="dau">
                Dầu
              </label>
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập mức tiêu thụ nhiên liệu:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Mức tiêu thụ nhiên liệu/100km *</span>
            <div class="vf-input-unit" data-unit="lít">
              <input type="number" id="vf8an_fuel_consumption" class="vf-number-input" value="11" min="1" max="40" step="0.1" placeholder="11">
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập quãng đường di chuyển mỗi tháng:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Quãng đường di chuyển/tháng *</span>
            <div class="vf-input-unit" data-unit="km">
              <input type="number" id="vf8an_distance_month" class="vf-number-input" value="1500" min="100" max="10000" step="50" placeholder="1500">
            </div>
          </div>

          <p class="vf-hint">(*) Nhập số, dùng dấu chấm "." cho phần thập phân (không dùng dấu phân cách hàng nghìn). Ví dụ: 11 lít; 1500 km.</p>

          <button class="vf-btn-compare" onclick="calcVF8ANCompare()">SO SÁNH</button>
        </div>

        <!-- RIGHT: Result Panel -->
        <div class="vf-calc-right">
          <div class="vf-result-header">
            <div class="vf-result-icon">🌿</div>
            <div class="vf-result-header-text">
              <h4>Lợi thế chi phí nhiên liệu của VF 8 All New</h4>
              <p class="vf-result-placeholder" id="vf8an_result_placeholder">(*) Chưa có dữ liệu so sánh. Vui lòng nhập thông tin!</p>
            </div>
            <img src="<?php echo esc_url($uploads_url . '/cutout_vf8_allnew.png'); ?>"
                 alt="VinFast VF 8 The All New"
                 onerror="this.style.display='none'">
          </div>

          <div id="vf8an_result_body" style="display:none;">
            <table class="vf-result-table">
              <tr>
                <td class="lbl">⚡ Chi phí điện VF 8 All New / tháng</td>
                <td class="vf-val" id="vf8an_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl" id="vf8an_fuel_label_month">⛽ Chi phí xăng / tháng</td>
                <td class="gas-val" id="vf8an_gas_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl">⚡ Chi phí điện VF 8 All New / năm</td>
                <td class="vf-val" id="vf8an_cost_year"></td>
              </tr>
              <tr>
                <td class="lbl" id="vf8an_fuel_label_year">⛽ Chi phí xăng / năm</td>
                <td class="gas-val" id="vf8an_gas_cost_year"></td>
              </tr>
            </table>

            <div class="vf-result-save">
              <div class="save-label">Bạn tiết kiệm được mỗi năm</div>
              <div class="save-amount" id="vf8an_save_year"></div>
              <div class="save-period" id="vf8an_save_note"></div>
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

<!-- 8. BẢNG THÔNG SỐ KỸ THUẬT VF 8 ALL NEW CHÍNH HÃNG -->
<section class="vf9-section vf9-section-alt" id="thong-so">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Thông số chi tiết</span>
      <h2 class="vf9-sec-title">Thông Số Kỹ Thuật VinFast VF 8 The All New</h2>
    </div>

    <div class="vf9-specs-tabs-nav">
      <button class="vf9-spec-tab-btn active" onclick="switchVF8ANSpecTab('kich-thuoc', this)">Kích Thước & Động Cơ</button>
      <button class="vf9-spec-tab-btn" onclick="switchVF8ANSpecTab('pin-sac', this)">Pin & Trạm Sạc</button>
      <button class="vf9-spec-tab-btn" onclick="switchVF8ANSpecTab('an-toan-tab', this)">An Toàn & Công Nghệ ADAS</button>
    </div>

    <div class="vf9-specs-table-wrap" data-aos="fade-up">
      <table class="vf9-specs-table" id="vf8anSpecTabKichThuoc">
        <tr><td>Dài x Rộng x Cao (mm)</td><td>4.750 x 1.934 x 1.667</td></tr>
        <tr><td>Chiều dài cơ sở (mm)</td><td>2.950 mm</td></tr>
        <tr><td>Khoảng sáng gầm xe (mm)</td><td>179 mm</td></tr>
        <tr><td>Số chỗ ngồi</td><td>5 chỗ rộng rãi</td></tr>
        <tr><td>Động cơ điện</td><td>2 Motor (AWD 2 cầu thông minh)</td></tr>
        <tr><td>Công suất tối đa</td><td>402 HP</td></tr>
        <tr><td>Mô-men xoắn cực đại</td><td>620 Nm</td></tr>
      </table>

      <table class="vf9-specs-table" id="vf8anSpecTabPinSac" style="display: none;">
        <tr><td>Dung lượng pin khả dụng</td><td>87.7 kWh (LFP Thế Hệ Mới)</td></tr>
        <tr><td>Quãng đường di chuyển (WLTP)</td><td>~ 500 km / 1 lần sạc đầy</td></tr>
        <tr><td>Thời gian sạc nhanh (10-70%)</td><td>~ 28 phút (Trạm sạc 360kW DC)</td></tr>
        <tr><td>Bộ sạc di động theo xe</td><td>Portable AC 3.5 kW / Treo tường 11 kW</td></tr>
        <tr><td>Mạng lưới trạm sạc</td><td>V-GREEN phủ rộng 63 tỉnh thành Việt Nam</td></tr>
      </table>

      <table class="vf9-specs-table" id="vf8anSpecTabAnToan" style="display: none;">
        <tr><td>Tiêu chuẩn an toàn</td><td>5 sao NHTSA (Mỹ) & EURO NCAP (Châu Âu)</td></tr>
        <tr><td>Số túi khí</td><td>11 túi khí an toàn toàn diện</td></tr>
        <tr><td>Hệ thống trợ lái nâng cao ADAS</td><td>Cấp độ 2+ (Triệu hồi đỗ xe, Tự chuyển làn...)</td></tr>
        <tr><td>Hiển thị HUD kính lái AR-HUD</td><td>Có (AR-HUD thực tế ảo)</td></tr>
        <tr><td>Trợ lý ảo tiếng Việt ViVi AI</td><td>Có (Tích hợp AI trí tuệ nhân tạo)</td></tr>
      </table>
    </div>

  </div>
</section>

<!-- Scripts cho VF 8 All New Template -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  const vf8anPrices = {
    eco:  { thue: '899.000.000 VNĐ', mua: '1.350.000.000 VNĐ' },
    plus: { thue: '1.330.000.000 VNĐ', mua: '1.530.000.000 VNĐ' }
  };

  let currentVF8ANVersion = 'eco';
  let currentVF8ANBattery = 'thue';

  function updateVF8ANPrice() {
    const priceText = vf8anPrices[currentVF8ANVersion][currentVF8ANBattery];
    document.getElementById('vf8anDynamicPrice').textContent = priceText;
    document.getElementById('subnav-price-display-vf8an').textContent = priceText;
  }

  function setVF8ANVersion(ver, btn) {
    currentVF8ANVersion = ver;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateVF8ANPrice();
  }

  function setVF8ANBattery(bat, btn) {
    currentVF8ANBattery = bat;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateVF8ANPrice();
  }

  // Đổi màu xe VF 8 All New Real-time Cutouts
  document.querySelectorAll('.vf9-color-dot').forEach(dot => {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf9-color-dot').forEach(d => d.classList.remove('active'));
      this.classList.add('active');

      const imgSrc = this.getAttribute('data-img');
      const colorName = this.getAttribute('data-color');
      const stageImg = document.getElementById('vf8anCarStageImg');

      stageImg.classList.add('changing');
      setTimeout(() => {
        stageImg.src = imgSrc;
        stageImg.classList.remove('changing');
      }, 200);

      document.getElementById('vf8anColorLabel').textContent = 'Màu đang chọn: ' + colorName;
    });
  });

  // Sticky Subnav Scroll
  window.addEventListener('scroll', function() {
    const subnav = document.getElementById('vf8ANStickySubnav');
    if (window.scrollY > 480) {
      subnav.classList.add('active');
    } else {
      subnav.classList.remove('active');
    }
  });

  // Tabs Thông số VF 8 All New
  function switchVF8ANSpecTab(tabKey, btn) {
    document.querySelectorAll('.vf9-spec-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.getElementById('vf8anSpecTabKichThuoc').style.display = 'none';
    document.getElementById('vf8anSpecTabPinSac').style.display = 'none';
    document.getElementById('vf8anSpecTabAnToan').style.display = 'none';

    if (tabKey === 'kich-thuoc') document.getElementById('vf8anSpecTabKichThuoc').style.display = 'table';
    if (tabKey === 'pin-sac') document.getElementById('vf8anSpecTabPinSac').style.display = 'table';
    if (tabKey === 'an-toan-tab') document.getElementById('vf8anSpecTabAnToan').style.display = 'table';
  }

  // So sánh chi phí nhiên liệu VF 8 All New
  (function() {
    // VF 8 All New: điện tiêu thụ 18.5 kWh/100km, giá điện 3.000 VNĐ/kWh
    var VF8AN_KWH_PER_100KM = 18.5;
    var VF8AN_ELEC_PRICE_PER_KWH = 3000;
    var VF8AN_XANG_PRICE = 24000;
    var VF8AN_DAU_PRICE  = 21000;

    window.calcVF8ANCompare = function() {
      var fuelType    = document.querySelector('input[name="vf8an_fuel_type"]:checked').value;
      var consumption = parseFloat(document.getElementById('vf8an_fuel_consumption').value);
      var distance    = parseFloat(document.getElementById('vf8an_distance_month').value);

      if (isNaN(consumption) || consumption <= 0 || isNaN(distance) || distance <= 0) {
        alert('Vui lòng nhập đầy đủ và hợp lệ mức tiêu thụ và quãng đường!');
        return;
      }

      var fuelPrice    = fuelType === 'dau' ? VF8AN_DAU_PRICE : VF8AN_XANG_PRICE;
      var fuelLabel    = fuelType === 'dau' ? 'Dầu' : 'Xăng';

      var elecCostMonth = (distance / 100) * VF8AN_KWH_PER_100KM * VF8AN_ELEC_PRICE_PER_KWH;
      var elecCostYear  = elecCostMonth * 12;
      var gasCostMonth  = (distance / 100) * consumption * fuelPrice;
      var gasCostYear   = gasCostMonth * 12;
      var saveYear      = gasCostYear - elecCostYear;

      document.getElementById('vf8an_result_placeholder').style.display = 'none';
      document.getElementById('vf8an_result_body').style.display = 'block';

      document.getElementById('vf8an_cost_month').textContent      = formatVND(elecCostMonth) + ' VNĐ';
      document.getElementById('vf8an_gas_cost_month').textContent  = formatVND(gasCostMonth)  + ' VNĐ';
      document.getElementById('vf8an_cost_year').textContent       = formatVND(elecCostYear)  + ' VNĐ';
      document.getElementById('vf8an_gas_cost_year').textContent   = formatVND(gasCostYear)   + ' VNĐ';
      document.getElementById('vf8an_fuel_label_month').textContent = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / tháng';
      document.getElementById('vf8an_fuel_label_year').textContent  = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / năm';
      document.getElementById('vf8an_save_year').textContent       = formatVND(saveYear) + ' VNĐ';
      document.getElementById('vf8an_save_note').textContent       = 'Dựa trên ' + Math.round(distance).toLocaleString('vi-VN') + ' km/tháng với ' + consumption + ' lít ' + fuelLabel.toLowerCase() + '/100km';
    };

    function formatVND(num) {
      return Math.round(num).toLocaleString('vi-VN');
    }
  })();
</script>

<?php get_footer(); ?>
