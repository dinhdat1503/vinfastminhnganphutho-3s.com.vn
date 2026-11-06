<?php
/**
 * Dedicated Authentic Product Template for VinFast VF Wild
 * Location: template-parts/product/single-vfwild.php
 * Authentic REEV Pick-up Truck Data, Studio Color Selector, Cost Comparison & Full Specs
 */

defined('ABSPATH') || exit;

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

$uploads_url = content_url('/uploads/official_cars/vfwild');
$common_url  = content_url('/uploads/official_cars/common');
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
  .vfwild-hero {
    position: relative; width: 100%; height: 88vh; min-height: 580px; background: #0B1120; overflow: hidden; display: flex; align-items: flex-end;
  }
  .vfwild-hero-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.88; }
  .vfwild-hero-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15, 23, 42, 0.2) 0%, rgba(15, 23, 42, 0.7) 65%, rgba(15, 23, 42, 0.96) 100%); }
  .vfwild-hero-content { position: relative; z-index: 10; padding-bottom: 50px; color: #ffffff; max-width: 1280px; margin: 0 auto; padding-left: 24px; padding-right: 24px; width: 100%; }
  .vfwild-hero-badge { display: inline-block; background: #2563EB; color: #ffffff; font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; padding: 6px 16px; border-radius: 4px; margin-bottom: 14px; }
  .vfwild-hero-title { font-family: 'Mulish', 'Inter', sans-serif; font-size: clamp(2.5rem, 5.5vw, 4.2rem); font-weight: 900; line-height: 1.05; margin-bottom: 12px; text-transform: uppercase; letter-spacing: -1px; }
  .vfwild-hero-desc { font-size: 1.15rem; color: rgba(255,255,255,0.92); max-width: 680px; margin-bottom: 24px; line-height: 1.6; }

  /* Quick Spec Badges in Hero */
  .vfwild-hero-specs {
    display: flex; gap: 32px; flex-wrap: wrap; margin-bottom: 30px; padding: 18px 24px; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); border-radius: 12px; border: 1px solid rgba(255,255,255,0.15); width: fit-content;
  }
  .vfwild-hspec-item { display: flex; flex-direction: column; }
  .vfwild-hspec-val { font-size: 1.5rem; font-weight: 900; color: #60A5FA; line-height: 1.1; }
  .vfwild-hspec-lbl { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.75); margin-top: 4px; }

  /* Buttons Standardized (Workspace Rule 4) */
  .vf-btn {
    height: 44px !important;
    line-height: 44px !important;
    padding: 0 24px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px !important;
    text-transform: uppercase !important;
    border-radius: 4px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    text-decoration: none !important;
    transition: all 0.2s ease !important;
    white-space: nowrap !important;
    box-sizing: border-box !important;
    border: none !important;
  }
  .vf-btn-primary { background: #2563EB !important; color: #ffffff !important; box-shadow: 0 4px 14px rgba(37,99,235,0.25) !important; }
  .vf-btn-primary:hover { background: #1D4ED8 !important; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35) !important; }
  .vf-btn-outline { background: #ffffff !important; color: #2563EB !important; border: 1.5px solid #2563EB !important; }
  .vf-btn-outline:hover { background: #EFF6FF !important; }
  .vf-btn-dark { background: #0F172A !important; color: #ffffff !important; }
  .vf-btn-dark:hover { background: #1E293B !important; }

  /* Section Styling */
  .vfwild-section { padding: 85px 0; }
  .vfwild-section-alt { background-color: #F8FAFC; }
  .vfwild-section-dark { background-color: #0F172A; color: #ffffff; }
  .vfwild-container { width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px; }
  .vfwild-sec-header { text-align: center; max-width: 800px; margin: 0 auto 50px; }
  .vfwild-sec-badge { display: inline-block; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; color: #2563EB; margin-bottom: 8px; }
  .vfwild-section-dark .vfwild-sec-badge { color: #60A5FA; }
  .vfwild-sec-title { font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 900; line-height: 1.2; text-transform: uppercase; letter-spacing: -0.5px; margin-bottom: 12px; color: #0F172A; }
  .vfwild-section-dark .vfwild-sec-title { color: #ffffff; }
  .vfwild-sec-desc { font-size: 1.05rem; color: #64748B; line-height: 1.6; }
  .vfwild-section-dark .vfwild-sec-desc { color: rgba(255,255,255,0.8); }

  /* Studio Configurator */
  .vfwild-configurator { padding: 60px 0 80px; background: radial-gradient(circle at center 40%, #ffffff 0%, #F1F5F9 100%); }
  .vfwild-stage-wrap { position: relative; width: 100%; max-width: 1050px; margin: 0 auto; display: flex; align-items: center; justify-content: center; padding: 20px 0; min-height: 380px; }
  .vfwild-stage-car-img { position: relative; z-index: 2; width: 100%; max-width: 900px; height: auto; max-height: 440px; object-fit: contain; filter: drop-shadow(0 20px 32px rgba(15,23,42,0.14)); transition: opacity 0.3s ease, transform 0.3s ease; }
  .vfwild-stage-car-img.changing { opacity: 0; transform: scale(0.98); }
  
  .vfwild-controls-panel { max-width: 980px; margin: 30px auto 0; background: #ffffff; border: 1px solid #E2E8F0; border-radius: 16px; padding: 36px 44px; box-shadow: 0 10px 30px rgba(15,23,42,0.06); }
  .vfwild-controls-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 36px; align-items: center; }
  .vfwild-option-group-title { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748B; margin-bottom: 12px; }
  .vfwild-color-dots-row { display: flex; gap: 14px; align-items: center; flex-wrap: wrap; }
  .vfwild-color-dot { width: 40px; height: 40px; border-radius: 50%; border: 3px solid #ffffff; box-shadow: 0 0 0 1px #CBD5E1, 0 4px 8px rgba(0,0,0,0.1); cursor: pointer; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); outline: none; }
  .vfwild-color-dot.active, .vfwild-color-dot:hover { transform: scale(1.15); box-shadow: 0 0 0 3px #2563EB, 0 6px 14px rgba(37,99,235,0.35); }
  .vfwild-selected-color-label { font-size: 14.5px; font-weight: 700; color: #0F172A; margin-top: 10px; }
  .vfwild-config-price-bar { margin-top: 28px; padding-top: 24px; border-top: 1px solid #E2E8F0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
  .vfwild-price-amount { font-size: 2.3rem; font-weight: 900; color: #2563EB; line-height: 1; }
  .vfwild-price-note { font-size: 13px; color: #16A34A; font-weight: 700; margin-top: 6px; }

  /* REEV Feature Highlight Cards */
  .vfwild-cards-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
  .vfwild-cards-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px; }
  .vfwild-feat-card { background: #ffffff; border-radius: 14px; overflow: hidden; border: 1px solid #E2E8F0; box-shadow: 0 4px 16px rgba(15,23,42,0.04); transition: transform 0.25s ease, box-shadow 0.25s ease; display: flex; flex-direction: column; }
  .vfwild-feat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(15,23,42,0.08); }
  .vfwild-feat-card-img { width: 100%; height: 230px; object-fit: cover; }
  .vfwild-feat-card-body { padding: 26px; flex: 1; display: flex; flex-direction: column; }
  .vfwild-feat-card-tag { font-size: 11px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; color: #2563EB; margin-bottom: 8px; }
  .vfwild-feat-card-title { font-size: 1.25rem; font-weight: 800; color: #0F172A; margin-bottom: 10px; line-height: 1.3; }
  .vfwild-feat-card-desc { font-size: 14.5px; color: #64748B; line-height: 1.6; }

  /* Cost Comparison Table */
  .vfwild-comp-box { background: #ffffff; border-radius: 16px; border: 1px solid #E2E8F0; padding: 40px; box-shadow: 0 10px 30px rgba(15,23,42,0.06); max-width: 1000px; margin: 0 auto; }
  .vfwild-comp-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
  .vfwild-comp-table th, .vfwild-comp-table td { padding: 16px 20px; text-align: left; border-bottom: 1px solid #F1F5F9; }
  .vfwild-comp-table th { background: #F8FAFC; font-weight: 800; color: #0F172A; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
  .vfwild-comp-table td { font-size: 15px; color: #334155; }
  .vfwild-comp-table tr.highlight-row { background: #EFF6FF; }
  .vfwild-comp-table tr.highlight-row td { font-weight: 800; color: #2563EB; }
  .vfwild-badge-save { display: inline-block; background: #DCFCE7; color: #16A34A; padding: 4px 10px; border-radius: 4px; font-weight: 800; font-size: 12.5px; }

  /* Specs Tabs & Table */
  .vfwild-specs-wrapper { max-width: 1050px; margin: 0 auto; }
  .vfwild-specs-tabs { display: flex; gap: 10px; border-bottom: 2px solid #E2E8F0; margin-bottom: 30px; overflow-x: auto; scrollbar-width: none; }
  .vfwild-specs-tabs::-webkit-scrollbar { display: none; }
  .vfwild-tab-btn { padding: 12px 22px; font-size: 14px; font-weight: 700; color: #64748B; background: transparent; border: none; border-bottom: 3px solid transparent; cursor: pointer; transition: all 0.2s; white-space: nowrap; }
  .vfwild-tab-btn.active { color: #2563EB; border-bottom-color: #2563EB; }
  .vfwild-specs-table { width: 100%; border-collapse: collapse; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 14px rgba(15,23,42,0.04); border: 1px solid #E2E8F0; }
  .vfwild-specs-table th, .vfwild-specs-table td { padding: 15px 22px; text-align: left; font-size: 14.5px; border-bottom: 1px solid #F1F5F9; }
  .vfwild-specs-table tr:nth-child(even) { background-color: #F8FAFC; }
  .vfwild-specs-table td:first-child { font-weight: 600; color: #475569; width: 45%; }
  .vfwild-specs-table td:last-child { font-weight: 700; color: #0F172A; width: 55%; }

  /* Gallery Grid */
  .vfwild-gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px; }
  .vfwild-gal-item { border-radius: 12px; overflow: hidden; height: 260px; }
  .vfwild-gal-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.35s ease; }
  .vfwild-gal-item:hover img { transform: scale(1.05); }

  /* Mobile Sticky Bottom Bar (Workspace Rule 1) */
  .vfwild-mobile-bar {
    display: none;
    position: fixed;
    bottom: 0; left: 0; right: 0;
    height: 60px;
    background: #ffffff;
    border-top: 1px solid #E2E8F0;
    box-shadow: 0 -4px 16px rgba(0,0,0,0.08);
    z-index: 998;
    align-items: center;
    justify-content: space-around;
    padding: 0 12px;
  }
  .vfwild-mobile-bar a {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 11px;
    font-weight: 700;
    color: #475569;
    gap: 3px;
  }
  .vfwild-mobile-bar a.btn-cta {
    background: #2563EB;
    color: #ffffff;
    height: 42px;
    border-radius: 6px;
    flex-direction: row;
    gap: 6px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Responsive Rules (Workspace Rule 1: Mobile-First) */
  @media (max-width: 992px) {
    .vfwild-cards-grid-3 { grid-template-columns: repeat(2, 1fr); }
    .vfwild-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .vfwild-controls-grid { grid-template-columns: 1fr; gap: 24px; }
  }

  @media (max-width: 768px) {
    .vf-subnav-links { display: none; }
    .vfwild-hero { height: auto; min-height: 520px; padding-top: 70px; }
    .vfwild-hero-title { font-size: 2.2rem; }
    .vfwild-hero-desc { font-size: 1rem; }
    .vfwild-hero-specs { width: 100%; gap: 16px; justify-content: space-between; }
    .vfwild-hspec-val { font-size: 1.25rem; }
    .vfwild-cards-grid-3, .vfwild-cards-grid-2 { grid-template-columns: 1fr; }
    .vfwild-gallery-grid { grid-template-columns: 1fr; }
    .vfwild-controls-panel { padding: 24px 20px; }
    .vfwild-config-price-bar { flex-direction: column; align-items: flex-start; }
    .vfwild-mobile-bar { display: flex; }
    body { padding-bottom: 60px; }
    .vfwild-comp-box { padding: 24px 16px; }
    .vfwild-comp-table th, .vfwild-comp-table td { padding: 12px 10px; font-size: 13px; }
  }
</style>

<!-- ==========================================
     1. STICKY SUBNAV BAR
     ========================================== -->
<div class="vf-subnav" id="vfwildStickySubnav">
  <div class="vf-subnav-inner">
    <div class="vf-subnav-title">VINFAST VF WILD</div>
    <ul class="vf-subnav-links">
      <li><a href="#studio">Chọn Màu Xe</a></li>
      <li><a href="#reev-dong-co">Động Cơ REEV</a></li>
      <li><a href="#thung-xe">Thùng Xe & Camping</a></li>
      <li><a href="#chi-phi">So Sánh Chi Phí</a></li>
      <li><a href="#thong-so">Thông Số Kỹ Thuật</a></li>
    </ul>
    <div class="vf-subnav-actions">
      <span class="vf-subnav-price-val" id="subnavWildPrice">860.000.000 VNĐ</span>
      <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="vf-btn vf-btn-outline" style="height:38px !important; line-height:38px !important; padding:0 16px !important;">Lái Thử</a>
      <a href="#dat-coc" class="vf-btn vf-btn-primary" style="height:38px !important; line-height:38px !important; padding:0 18px !important;">Đặt Cọc Ngay</a>
    </div>
  </div>
</div>

<!-- ==========================================
     2. HERO BANNER CINEMATIC
     ========================================== -->
<section class="vfwild-hero">
  <img src="<?php echo esc_url($uploads_url . '/hero_banner.webp'); ?>" alt="VinFast VF Wild Hero Banner" class="vfwild-hero-bg">
  <div class="vfwild-hero-overlay"></div>
  <div class="vfwild-hero-content">
    <span class="vfwild-hero-badge">Bán Tải Điện REEV Đột Phá Thế Hệ Mới</span>
    <h1 class="vfwild-hero-title">VINFAST VF WILD</h1>
    <p class="vfwild-hero-desc">
      Xe bán tải điện thông minh mở rộng phạm vi hoạt động (REEV). Mạnh mẽ chinh phục mọi địa hình với hành trình vượt 1.000 km, nhưng êm ái và tiện nghi như một chiếc SUV cao cấp dành cho cả gia đình.
    </p>

    <!-- Quick Stats -->
    <div class="vfwild-hero-specs">
      <div class="vfwild-hspec-item">
        <span class="vfwild-hspec-val">160 kW</span>
        <span class="vfwild-hspec-lbl">Công suất (280 Nm)</span>
      </div>
      <div class="vfwild-hspec-item">
        <span class="vfwild-hspec-val">> 1.000 km</span>
        <span class="vfwild-hspec-lbl">Hành trình hỗn hợp (NEDC)</span>
      </div>
      <div class="vfwild-hspec-item">
        <span class="vfwild-hspec-val">750 kg</span>
        <span class="vfwild-hspec-lbl">Tải trọng thùng</span>
      </div>
      <div class="vfwild-hspec-item">
        <span class="vfwild-hspec-val">1,2 L/100km</span>
        <span class="vfwild-hspec-lbl">Tiêu thụ nhiên liệu</span>
      </div>
    </div>

    <div style="display:flex; gap:16px; flex-wrap:wrap;">
      <a href="#dat-coc" class="vf-btn vf-btn-primary">ĐẶT CỌC SỚM (ƯU ĐÃI 61 TRIỆU)</a>
      <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="vf-btn vf-btn-outline" style="color:#ffffff !important; border-color:rgba(255,255,255,0.7) !important; background:rgba(255,255,255,0.1) !important;">ĐĂNG KÝ LÁI THỬ</a>
    </div>
  </div>
</section>

<!-- ==========================================
     3. STUDIO CONFIGURATOR (ĐỔI MÀU XE)
     ========================================== -->
<section class="vfwild-configurator" id="studio">
  <div class="vfwild-container">
    <div class="vfwild-sec-header">
      <span class="vfwild-sec-badge">Studio Trực Quan 360</span>
      <h2 class="vfwild-sec-title">Tùy Chọn Màu Ngoại Thất VF Wild</h2>
      <p class="vfwild-sec-desc">Trải nghiệm các sắc thái màu cao cấp của VinFast VF Wild với các góc nhìn chi tiết và bảng giá niêm yết tương ứng.</p>
    </div>

    <!-- Car Stage -->
    <div class="vfwild-stage-wrap">
      <img id="vfWildCarStageImg"
           src="<?php echo esc_url($uploads_url . '/vfwild_white.webp'); ?>"
           alt="VinFast VF Wild Studio"
           class="vfwild-stage-car-img">
    </div>

    <!-- Controls Panel -->
    <div class="vfwild-controls-panel">
      <div class="vfwild-controls-grid">
        <!-- Color Dots -->
        <div>
          <div class="vfwild-option-group-title">MÀU SẮC NGOẠI THẤT</div>
          <div class="vfwild-color-dots-row">
            <button class="vfwild-color-dot active" style="background:#ffffff;" data-color="Trắng (Infinity Blanc)" data-price="860.000.000 VNĐ" data-img="<?php echo esc_url($uploads_url . '/vfwild_white.webp'); ?>" title="Trắng Infinity Blanc"></button>
            <button class="vfwild-color-dot" style="background:#0F172A;" data-color="Đen (Jet Black)" data-price="860.000.000 VNĐ" data-img="<?php echo esc_url($uploads_url . '/vfwild_black.webp'); ?>" title="Đen Jet Black"></button>
            <button class="vfwild-color-dot" style="background:#DC2626;" data-color="Đỏ (Solar Ruby)" data-price="860.000.000 VNĐ" data-img="<?php echo esc_url($uploads_url . '/vfwild_red.webp'); ?>" title="Đỏ Solar Ruby"></button>
            <button class="vfwild-color-dot" style="background:#64748B;" data-color="Bạc (Stealth Gray)" data-price="872.000.000 VNĐ" data-img="<?php echo esc_url($uploads_url . '/vfwild_gray.webp'); ?>" title="Bạc Stealth Gray"></button>
          </div>
          <div class="vfwild-selected-color-label" id="vfWildColorLabel">Màu đang chọn: Trắng (Infinity Blanc)</div>
        </div>

        <!-- Version & Warranty -->
        <div>
          <div class="vfwild-option-group-title">PHIÊN BẢN CUNG CẤP</div>
          <div style="font-size:18px; font-weight:800; color:#0F172A; margin-bottom:6px;">VF WILD COMFORT (REEV)</div>
          <p style="font-size:13.5px; color:#64748B; margin:0; line-height:1.5;">
            Bảo hành xe: <strong>6 năm / 150.000 km</strong><br>
            Bảo hành pin: <strong>8 năm / 160.000 km</strong>
          </p>
        </div>
      </div>

      <!-- Price Bar -->
      <div class="vfwild-config-price-bar">
        <div>
          <div style="font-size:12px; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:1px;">GIÁ NIÊM YẾT CHÍNH THỨC</div>
          <div class="vfwild-price-amount" id="vfWildDynamicPrice">860.000.000 VNĐ</div>
          <div class="vfwild-price-note">🎁 Ưu đãi đặt cọc sớm: Giảm ngay 61.000.000 VNĐ/xe</div>
        </div>
        <div style="display:flex; gap:12px;">
          <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/?model=vfwild')); ?>" class="vf-btn vf-btn-outline">DỰ TOÁN LĂN BÁNH</a>
          <a href="#dat-coc" class="vf-btn vf-btn-primary">ĐẶT CỌC XE NGAY</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================
     4. REEV POWERTRAIN & CHASSIS (VẬN HÀNH)
     ========================================== -->
<section class="vfwild-section" id="reev-dong-co">
  <div class="vfwild-container">
    <div class="vfwild-sec-header">
      <span class="vfwild-sec-badge">Đột Phá Công Nghệ Vận Hành</span>
      <h2 class="vfwild-sec-title">Hệ Truyền Động REEV Thông Minh</h2>
      <p class="vfwild-sec-desc">Sự kết hợp hoàn hảo giữa mô-tơ điện 160 kW mạnh mẽ và động cơ xăng 1.5L đóng vai trò máy phát, mở ra kỷ nguyên bán tải không giới hạn khoảng cách.</p>
    </div>

    <div class="vfwild-cards-grid-3">
      <!-- Card 1 -->
      <div class="vfwild-feat-card">
        <img src="<?php echo esc_url($uploads_url . '/hero_road.webp'); ?>" alt="Hành trình vượt 1.000 km" class="vfwild-feat-card-img">
        <div class="vfwild-feat-card-body">
          <span class="vfwild-feat-card-tag">Hành Trình Xuyên Việt</span>
          <h3 class="vfwild-feat-card-title">> 1.000 km Không Lo Sạc</h3>
          <p class="vfwild-feat-card-desc">
            Chạy thuần điện hơn 250 km cho 2-3 ngày đi làm đô thị. Khi đi xa, động cơ xăng tự sạc pin giúp nâng tổng hành trình lên hơn 1.000 km, xóa tan hoàn toàn nỗi lo trạm sạc.
          </p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="vfwild-feat-card">
        <img src="<?php echo esc_url($uploads_url . '/detail_1.webp'); ?>" alt="Khung gầm Unibody" class="vfwild-feat-card-img">
        <div class="vfwild-feat-card-body">
          <span class="vfwild-feat-card-tag">Êm Ái Như SUV Hạng Sang</span>
          <h3 class="vfwild-feat-card-title">Khung Gầm Unibody & Treo Đa Liên Kết</h3>
          <p class="vfwild-feat-card-desc">
            Không còn sự rung xóc thô cứng của nhíp lá truyền thống. Kiến trúc thân liền khối kết hợp treo sau đa liên kết đem lại độ đầm chắc, tĩnh lặng và thoải mái cho cả gia đình.
          </p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="vfwild-feat-card">
        <img src="<?php echo esc_url($uploads_url . '/hero_front.webp'); ?>" alt="Pin LFP An toàn" class="vfwild-feat-card-img">
        <div class="vfwild-feat-card-body">
          <span class="vfwild-feat-card-tag">Sạc Nhanh Siêu Tốc</span>
          <h3 class="vfwild-feat-card-title">Pin LFP 46,4 kWh & Sạc DC 90 kW</h3>
          <p class="vfwild-feat-card-desc">
            Trang bị cell pin LFP bền bỉ, chống cháy nổ tuyệt đối. Hỗ trợ sạc nhanh DC 90 kW từ 10% đến 70% chỉ dưới 32 phút, nạp lại năng lượng nhanh chóng trên mọi trạm dừng chân.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================
     5. CARGO & V2L CAMPING (THÙNG XE & DÃ NGOẠI)
     ========================================== -->
<section class="vfwild-section vfwild-section-dark" id="thung-xe">
  <div class="vfwild-container">
    <div class="vfwild-sec-header">
      <span class="vfwild-sec-badge">Tiện Nghi Đỉnh Cao Dã Ngoại</span>
      <h2 class="vfwild-sec-title">Thùng Hàng Đa Năng & Trạm Điện V2L Di Động</h2>
      <p class="vfwild-sec-desc">Biến mỗi chuyến phiêu lưu cắm trại thành kỳ nghỉ tiện nghi bậc nhất với nguồn điện 220V ngoài trời và thùng chở hàng tải trọng 750 kg.</p>
    </div>

    <div class="vfwild-cards-grid-2">
      <div class="vfwild-feat-card" style="background:#1E293B; border-color:#334155;">
        <img src="<?php echo esc_url($uploads_url . '/hero_camping.webp'); ?>" alt="Tính năng V2L Cắm trại Camping" class="vfwild-feat-card-img" style="height:300px;">
        <div class="vfwild-feat-card-body">
          <span class="vfwild-feat-card-tag" style="color:#60A5FA;">Cấp Nguồn Điện V2L (Vehicle to Load)</span>
          <h3 class="vfwild-feat-card-title" style="color:#ffffff;">Biến VF Wild Thành Trạm Điện Camping</h3>
          <p class="vfwild-feat-card-desc" style="color:rgba(255,255,255,0.75);">
            Cung cấp điện trực tiếp cho bếp từ, máy pha cà phê, loa âm thanh, máy chiếu ngoài trời, đèn chiếu sáng hoặc các thiết bị làm việc công trình mà không cần máy nổ ồn ào.
          </p>
        </div>
      </div>

      <div class="vfwild-feat-card" style="background:#1E293B; border-color:#334155;">
        <img src="<?php echo esc_url($uploads_url . '/detail_5.webp'); ?>" alt="Thùng chở hàng đa dụng" class="vfwild-feat-card-img" style="height:300px;">
        <div class="vfwild-feat-card-body">
          <span class="vfwild-feat-card-tag" style="color:#60A5FA;">Khoang Hàng Rộng Rãi</span>
          <h3 class="vfwild-feat-card-title" style="color:#ffffff;">Thùng Xe 1.574 x 1.512 x 509 mm (Tải 750 kg)</h3>
          <p class="vfwild-feat-card-desc" style="color:rgba(255,255,255,0.75);">
            Thiết kế bệ bước chân lên thùng ở hai bên sườn xe, kết hợp cơ chế mở cửa thùng sau bằng khí nén nhẹ nhàng, trợ lực khóa điện thông minh cho việc bốc dỡ đồ đạc thuận tiện tối đa.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================
     6. COST COMPARISON WITH DIESEL PICKUPS
     ========================================== -->
<section class="vfwild-section vfwild-section-alt" id="chi-phi">
  <div class="vfwild-container">
    <div class="vfwild-sec-header">
      <span class="vfwild-sec-badge">Hiệu Quả Kinh Tế Vượt Trội</span>
      <h2 class="vfwild-sec-title">So Sánh Chi Phí Sử Dụng 5 Năm</h2>
      <p class="vfwild-sec-desc">
        Nhờ động cơ điện kết hợp cơ chế mở rộng phạm vi REEV, VF Wild có mức tiêu thụ nhiên liệu hỗn hợp chỉ 1,2 L / 100 km, tiết kiệm hàng trăm triệu đồng so với bán tải truyền thống.
      </p>
    </div>

    <div class="vfwild-comp-box">
      <table class="vfwild-comp-table">
        <thead>
          <tr>
            <th>Hạng Mục So Sánh</th>
            <th style="color:#2563EB;">VinFast VF Wild Comfort</th>
            <th>Bán Tải Dầu Cùng Cỡ (Ranger/Hilux)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Tiêu thụ nhiên liệu</strong></td>
            <td><strong>1,2 L / 100 km</strong> (Hỗn hợp NEDC)</td>
            <td>8,0 – 9,5 L / 100 km (Dầu Diesel)</td>
          </tr>
          <tr>
            <td><strong>Lệ phí trước bạ</strong></td>
            <td><span class="vfwild-badge-save">Miễn 100% (Tiết kiệm ~50–60 triệu)</span></td>
            <td>6% – 7.2% giá trị xe</td>
          </tr>
          <tr>
            <td><strong>Bảo hành chính hãng</strong></td>
            <td><strong>6 năm / 150.000 km</strong> (Pin 8 năm)</td>
            <td>3 năm / 100.000 km</td>
          </tr>
          <tr>
            <td><strong>Bảo dưỡng định kỳ</strong></td>
            <td>Rất ít chi tiết hao mòn cơ khí</td>
            <td>Thay dầu máy, lọc dầu, lọc gió định kỳ</td>
          </tr>
          <tr class="highlight-row">
            <td><strong>Tổng tiết kiệm sau 5 năm</strong></td>
            <td><span class="vfwild-badge-save" style="font-size:15px;">Tiết kiệm 97 – 133 triệu đồng (~10% - 14%)</span></td>
            <td>Chi phí vận hành và bảo dưỡng cao</td>
          </tr>
        </tbody>
      </table>
      <div style="font-size:12.5px; color:#64748B; margin-top:16px; font-style:italic;">
        * Giả định khách hàng di chuyển trung bình 1.500 km/tháng và tận dụng ưu đãi miễn lệ phí trước bạ dành cho xe điện mở rộng phạm vi (REEVeb) theo Thông tư 45.
      </div>
    </div>
  </div>
</section>

<!-- ==========================================
     7. LIFESTYLE GALLERY
     ========================================== -->
<section class="vfwild-section">
  <div class="vfwild-container">
    <div class="vfwild-sec-header">
      <span class="vfwild-sec-badge">Hình Ảnh Thực Tế</span>
      <h2 class="vfwild-sec-title">VF Wild Trên Mọi Cung Đường</h2>
      <p class="vfwild-sec-desc">Khám phá các khoảnh khắc chinh phục địa hình, cắm trại dã ngoại và vận hành mạnh mẽ của VinFast VF Wild.</p>
    </div>

    <div class="vfwild-gallery-grid">
      <div class="vfwild-gal-item"><img src="<?php echo esc_url($uploads_url . '/gallery_1.webp'); ?>" alt="VF Wild Off-road"></div>
      <div class="vfwild-gal-item"><img src="<?php echo esc_url($uploads_url . '/gallery_2.webp'); ?>" alt="VF Wild Dã ngoại"></div>
      <div class="vfwild-gal-item"><img src="<?php echo esc_url($uploads_url . '/gallery_3.webp'); ?>" alt="VF Wild Đỏ Thể thao"></div>
      <div class="vfwild-gal-item"><img src="<?php echo esc_url($uploads_url . '/gallery_4.webp'); ?>" alt="VF Wild Đen Huyền Bí"></div>
      <div class="vfwild-gal-item"><img src="<?php echo esc_url($uploads_url . '/hero_lifestyle.webp'); ?>" alt="VF Wild Camping"></div>
      <div class="vfwild-gal-item"><img src="<?php echo esc_url($uploads_url . '/gallery_5.webp'); ?>" alt="VF Wild Bạc Sang Trọng"></div>
    </div>
  </div>
</section>

<!-- ==========================================
     8. DETAILED SPECS TABS (THÔNG SỐ KỸ THUẬT)
     ========================================== -->
<section class="vfwild-section vfwild-section-alt" id="thong-so">
  <div class="vfwild-container">
    <div class="vfwild-sec-header">
      <span class="vfwild-sec-badge">Thông Số Chính Xác</span>
      <h2 class="vfwild-sec-title">Bảng Thông Số Kỹ Thuật VF Wild</h2>
      <p class="vfwild-sec-desc">Dữ liệu thông số kỹ thuật chuẩn được cung cấp từ tài liệu và thông cáo báo chí chính hãng VinFast.</p>
    </div>

    <div class="vfwild-specs-wrapper">
      <div class="vfwild-specs-tabs">
        <button class="vfwild-tab-btn active" onclick="vfSwitchWildSpecTab('tab-kich-thuoc', this)">Kích Thước & Tải Trọng</button>
        <button class="vfwild-tab-btn" onclick="vfSwitchWildSpecTab('tab-dong-co', this)">Động Cơ REEV & Pin</button>
        <button class="vfwild-tab-btn" onclick="vfSwitchWildSpecTab('tab-noi-ngoai-that', this)">Nội & Ngoại Thất</button>
        <button class="vfwild-tab-btn" onclick="vfSwitchWildSpecTab('tab-an-toan', this)">An Toàn & Thông Minh</button>
      </div>

      <!-- Tab 1: Kích thước & Tải trọng -->
      <table class="vfwild-specs-table" id="tab-kich-thuoc">
        <tbody>
          <tr><td>Dài x Rộng x Cao (mm)</td><td>5.376 x 2.069 x 1.873</td></tr>
          <tr><td>Chiều dài cơ sở (mm)</td><td>3.258</td></tr>
          <tr><td>Khoảng sáng gầm xe (mm)</td><td>222</td></tr>
          <tr><td>Kích thước khoang hàng (mm)</td><td>1.574 x 1.512 x 509</td></tr>
          <tr><td>Tải trọng khoang hàng (kg)</td><td>750 kg</td></tr>
          <tr><td>Trọng lượng không tải (kg)</td><td>2.390 kg</td></tr>
          <tr><td>Số chỗ ngồi</td><td>5 chỗ ngồi rộng rãi</td></tr>
          <tr><td>Dung tích bình xăng (L)</td><td>56 L (chuyên cấp cho máy phát điện)</td></tr>
        </tbody>
      </table>

      <!-- Tab 2: Động cơ & Pin -->
      <table class="vfwild-specs-table" id="tab-dong-co" style="display:none;">
        <tbody>
          <tr><td>Hệ truyền động</td><td>REEV (Range Extender Electric Vehicle)</td></tr>
          <tr><td>Công suất tối đa (kW)</td><td>160 kW (~215 mã lực)</td></tr>
          <tr><td>Mô-men xoắn cực đại (Nm)</td><td>280 Nm</td></tr>
          <tr><td>Hệ dẫn động</td><td>Cầu trước (FWD)</td></tr>
          <tr><td>Động cơ xăng phụ trợ</td><td>1.5L phát điện</td></tr>
          <tr><td>Loại pin cao áp</td><td>LFP (Lithium Iron Phosphate) bền bỉ</td></tr>
          <tr><td>Dung lượng pin (kWh)</td><td>46,4 kWh</td></tr>
          <tr><td>Quãng đường thuần điện (NEDC)</td><td>Trên 250 km</td></tr>
          <tr><td>Tổng quãng đường kết hợp (NEDC)</td><td>Trên 1.000 km</td></tr>
          <tr><td>Mức tiêu thụ nhiên liệu hỗn hợp</td><td>1,2 L / 100 km</td></tr>
          <tr><td>Sạc nhanh DC tối đa</td><td>90 kW (10% - 70% dưới 32 phút)</td></tr>
          <tr><td>Sạc chậm AC tối đa</td><td>6,6 kW</td></tr>
          <tr><td>Tính năng cấp nguồn ngoại vi V2L</td><td>Có (Nguồn 220V dã ngoại & làm việc)</td></tr>
          <tr><td>Chế độ lái</td><td>Tiết kiệm (Eco) / Thường (Normal) / Thể thao (Sport)</td></tr>
        </tbody>
      </table>

      <!-- Tab 3: Nội & Ngoại thất -->
      <table class="vfwild-specs-table" id="tab-noi-ngoai-that" style="display:none;">
        <tbody>
          <tr><td>Hệ thống đèn pha</td><td>LED chiếu sáng ban ngày + Đèn chờ dẫn đường</td></tr>
          <tr><td>Đèn hậu</td><td>LED nhận diện thương hiệu</td></tr>
          <tr><td>Cửa thùng hàng sau</td><td>Mở trợ lực khí nén với khóa điện thông minh</td></tr>
          <tr><td>Bệ bước chân lên thùng</td><td>Tích hợp sẵn ở hai bên sườn xe</td></tr>
          <tr><td>Tấm bảo vệ dưới thân xe</td><td>Có</td></tr>
          <tr><td>Kích thước lốp & Mâm</td><td>255/70 R18 (Mâm hợp kim 18 inch)</td></tr>
          <tr><td>Hệ thống treo trước / sau</td><td>Độc lập tay đòn kép / Treo đa liên kết êm ái</td></tr>
          <tr><td>Phanh đỗ</td><td>Điện tử tích hợp Auto-Hold</td></tr>
          <tr><td>Chất liệu bọc ghế</td><td>Ghế thể thao Da phối Nỉ cao cấp</td></tr>
          <tr><td>Ghế lái</td><td>Chỉnh điện 6 hướng</td></tr>
          <tr><td>Cần số</td><td>Cần gạt tích hợp sau vô-lăng tối ưu không gian</td></tr>
          <tr><td>Màn hình giải trí trung tâm</td><td>Cảm ứng 10 Inch</td></tr>
          <tr><td>Kết nối điện thoại</td><td>Apple CarPlay & Android Auto không dây</td></tr>
          <tr><td>Sạc điện thoại</td><td>Sạc không dây + Cổng USB Type-C kép</td></tr>
        </tbody>
      </table>

      <!-- Tab 4: An toàn & Thông minh -->
      <table class="vfwild-specs-table" id="tab-an-toan" style="display:none;">
        <tbody>
          <tr><td>Hệ thống túi khí</td><td>Túi khí cho người lái & hành khách phía trước</td></tr>
          <tr><td>Giám sát áp suất lốp</td><td>dTPMS hiển thị áp suất từng bánh</td></tr>
          <tr><td>Hệ thống phanh an toàn</td><td>ABS, EBD, BA, Cân bằng điện tử ESC</td></tr>
          <tr><td>Hỗ trợ khởi hành & xuống dốc</td><td>HAS (khởi hành ngang dốc) & HDC (hỗ trợ xuống dốc)</td></tr>
          <tr><td>Chống lật & Kiểm soát lực kéo</td><td>ROM (chống lật) & TCS (kiểm soát lực kéo)</td></tr>
          <tr><td>Hệ thống ga tự động</td><td>Cruise Control</td></tr>
          <tr><td>Camera lùi</td><td>Camera sau sắc nét</td></tr>
          <tr><td>Chế độ vận hành đặc biệt</td><td>Chế độ Cắm trại (Camp Mode), Giữ điều hòa qua đêm</td></tr>
          <tr><td>Trợ lý ảo VinFast</td><td>Trợ lý ảo tiếng Việt 3.0 với trí tuệ nhân tạo</td></tr>
          <tr><td>Cập nhật phần mềm từ xa</td><td>FOTA (Firmware Over The Air) miễn phí</td></tr>
          <tr><td>Ứng dụng điều khiển trên điện thoại</td><td>Quản lý pin, tìm trạm sạc, khóa mở cửa từ xa</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ==========================================
     9. CALL TO ACTION / ĐẶT CỌC SỚM
     ========================================== -->
<section class="vfwild-section" id="dat-coc" style="background:linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%); color:#ffffff; text-align:center;">
  <div class="vfwild-container">
    <div style="max-width:760px; margin:0 auto;">
      <span style="display:inline-block; background:rgba(255,255,255,0.2); padding:6px 16px; border-radius:4px; font-weight:800; font-size:12px; letter-spacing:2px; text-transform:uppercase; margin-bottom:16px;">CHÍNH SÁCH TIÊN PHONG</span>
      <h2 style="font-size:clamp(2rem, 4vw, 3rem); font-weight:900; line-height:1.2; text-transform:uppercase; margin-bottom:16px; color:#ffffff;">ĐẶT CỌC SỚM VINFAST VF WILD</h2>
      <p style="font-size:1.15rem; color:rgba(255,255,255,0.9); margin-bottom:30px; line-height:1.6;">
        Khách hàng đặt cọc sớm được nhận ngay ưu đãi <strong>61.000.000 VNĐ/xe</strong> trực tiếp vào giá bán cùng suất bàn giao xe sớm nhất tại VinFast Vĩnh Phúc.
      </p>
      <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
        <a href="tel:0981335522" class="vf-btn vf-btn-outline" style="background:#ffffff !important; color:#2563EB !important; border-color:#ffffff !important;">📞 GỌI HOTLINE: 0981.335.522</a>
        <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/?model=vfwild')); ?>" class="vf-btn vf-btn-dark">ĐĂNG KÝ LÁI THỬ & TƯ VẤN</a>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================
     10. MOBILE QUICK ACTION BAR (STICKY BOTTOM)
     ========================================== -->
<div class="vfwild-mobile-bar">
  <a href="tel:0981335522">
    <span>📞</span>
    <span>Gọi điện</span>
  </a>
  <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/?model=vfwild')); ?>">
    <span>📊</span>
    <span>Dự toán</span>
  </a>
  <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/?model=vfwild')); ?>">
    <span>🚗</span>
    <span>Lái thử</span>
  </a>
  <a href="#dat-coc" class="btn-cta">
    <span>⚡ Cọc Sớm</span>
  </a>
</div>

<!-- ==========================================
     11. JAVASCRIPT CONTROLS
     ========================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Sticky Subnav
  const subnav = document.getElementById('vfwildStickySubnav');
  window.addEventListener('scroll', function() {
    if (window.scrollY > 450) {
      subnav.classList.add('active');
    } else {
      subnav.classList.remove('active');
    }
  });

  // Color Selector
  const colorDots = document.querySelectorAll('.vfwild-color-dot');
  const stageImg  = document.getElementById('vfWildCarStageImg');
  const colorLabel = document.getElementById('vfWildColorLabel');
  const dynPrice  = document.getElementById('vfWildDynamicPrice');
  const subnavPrice = document.getElementById('subnavWildPrice');

  colorDots.forEach(function(dot) {
    dot.addEventListener('click', function() {
      colorDots.forEach(d => d.classList.remove('active'));
      dot.classList.add('active');

      const newImg = dot.getAttribute('data-img');
      const newColor = dot.getAttribute('data-color');
      const newPrice = dot.getAttribute('data-price');

      if (stageImg) {
        stageImg.classList.add('changing');
        setTimeout(function() {
          stageImg.src = newImg;
          stageImg.classList.remove('changing');
        }, 150);
      }

      if (colorLabel) colorLabel.textContent = 'Màu đang chọn: ' + newColor;
      if (dynPrice) dynPrice.textContent = newPrice;
      if (subnavPrice) subnavPrice.textContent = newPrice;
    });
  });
});

// Specs Tabs Switcher
function vfSwitchWildSpecTab(tabId, btn) {
  document.querySelectorAll('.vfwild-specs-table').forEach(function(tbl) {
    tbl.style.display = 'none';
  });
  document.querySelectorAll('.vfwild-tab-btn').forEach(function(b) {
    b.classList.remove('active');
  });

  const target = document.getElementById(tabId);
  if (target) {
    target.style.display = 'table';
  }
  if (btn) {
    btn.classList.add('active');
  }
}
</script>

<?php get_footer(); ?>
