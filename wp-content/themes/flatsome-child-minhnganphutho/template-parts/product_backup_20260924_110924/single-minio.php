<?php
/**
 * Dedicated Authentic Product Template for VinFast Minio Green
 * Location: template-parts/product/single-minio.php
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

$uploads_url = content_url('/uploads/official_cars/minio');
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

<style>
  #wrapper, #main, .content-area, .page-header {
    padding: 0 !important; margin: 0 !important; max-width: 100% !important; width: 100% !important;
  }
  .page-title, .breadcrumbs { display: none !important; }

  .vf-subnav {
    position: fixed; top: 0; left: 0; right: 0; height: 60px;
    background: rgba(255, 255, 255, 0.96); backdrop-filter: blur(10px);
    border-bottom: 1px solid #E2E8F0; z-index: 999; display: flex; align-items: center;
    transform: translateY(-100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
  }
  .vf-subnav.active { transform: translateY(0); }
  .vf-subnav-inner { display: flex; align-items: center; justify-content: space-between; width: 100%; max-width: 1280px; margin: 0 auto; padding: 0 24px; }
  .vf-subnav-title { font-size: 18px; font-weight: 800; font-style: italic; color: #0F172A; }
  .vf-subnav-links { display: flex; gap: 24px; list-style: none; margin: 0; padding: 0; }
  .vf-subnav-links a { text-decoration: none; color: #64748B; font-size: 13.5px; font-weight: 600; padding: 6px 0; border-bottom: 2px solid transparent; transition: all 0.2s; }
  .vf-subnav-links a.active, .vf-subnav-links a:hover { color: #2563EB; border-bottom-color: #2563EB; }
  .vf-subnav-actions { display: flex; align-items: center; gap: 16px; }
  .vf-subnav-price-val { font-size: 16px; font-weight: 800; color: #2563EB; }

  .vf9-hero { position: relative; width: 100%; height: 85vh; min-height: 550px; background: #000000; overflow: hidden; display: flex; align-items: flex-end; }
  .vf9-hero-bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.88; }
  .vf9-hero-overlay { position: absolute; inset: 0; background: linear-gradient(180deg, rgba(15, 23, 42, 0.25) 0%, rgba(15, 23, 42, 0.75) 75%, rgba(15, 23, 42, 0.94) 100%); }
  .vf9-hero-content { position: relative; z-index: 10; padding-bottom: 60px; color: #ffffff; max-width: 1280px; margin: 0 auto; padding-left: 24px; padding-right: 24px; width: 100%; }
  .vf9-hero-badge { display: inline-block; background: #10B981; color: #ffffff; font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; padding: 6px 16px; border-radius: 4px; margin-bottom: 16px; }
  .vf9-hero-title { font-family: 'Mulish', 'Inter', sans-serif; font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; line-height: 1.1; margin-bottom: 12px; text-transform: uppercase; letter-spacing: -1px; }
  .vf9-hero-desc { font-size: 1.1rem; color: rgba(255,255,255,0.9); max-width: 640px; margin-bottom: 28px; }

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

  .vf-btn { height: 44px; line-height: 44px; padding: 0 24px; font-size: 13px; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; transition: all 0.2s ease; white-space: nowrap; border: none; }
  .vf-btn-primary { background: #2563EB; color: #ffffff; box-shadow: 0 4px 14px rgba(37,99,235,0.25); }
  .vf-btn-primary:hover { background: #1D4ED8; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(37,99,235,0.35); }
  .vf-btn-outline { background: #ffffff; color: #2563EB; border: 1.5px solid #2563EB; }
  .vf-btn-outline:hover { background: #EFF6FF; }

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

  .vf9-perf-stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 48px; }
  .vf9-stat-box { background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 36px 24px; text-align: center; box-shadow: 0 4px 14px rgba(0,0,0,0.05); }
  .vf9-stat-val { font-size: 3.5rem; font-weight: 900; color: #2563EB; line-height: 1; margin-bottom: 8px; }
  .vf9-stat-lbl { font-size: 13px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.5px; }

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
    .vf9-controls-grid, .vf9-grid-3, .vf9-tech-grid { grid-template-columns: 1fr; }
    .vf9-perf-stats-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 768px) {
    .vf-calc-grid { grid-template-columns: 1fr; }
    .vf-calc-left { border-right: none; border-bottom: 1px solid #E2E8F0; padding: 28px 20px; }
    .vf-calc-right { padding: 28px 20px; }
  }
</style>

<!-- Sticky Subnav Bar -->
<div class="vf-subnav" id="minioStickySubnav">
  <div class="vf-subnav-inner">
    <div class="vf-subnav-title">VinFast Minio Green</div>
    <ul class="vf-subnav-links">
      <li><a href="#tong-quan" class="active">Tổng quan</a></li>
      <li><a href="#tinh-nang">Tính năng dịch vụ</a></li>
      <li><a href="#van-hanh">Vận hành</a></li>
      <li><a href="#so-sanh-chi-phi">So sánh chi phí</a></li>
      <li><a href="#thong-so">Thông số kỹ thuật</a></li>
    </ul>
    <div class="vf-subnav-actions">
      <div class="vf-subnav-price-wrap">
        <span class="vf-subnav-price-label" style="font-size:11px; color:#64748B;">Giá niêm yết từ</span>
        <span class="vf-subnav-price-val" id="subnav-price-display-minio">239.000.000 VNĐ</span>
      </div>
      <a href="#configurator" class="vf-btn vf-btn-primary">ĐẶT CỌC NGAY</a>
    </div>
  </div>
</div>

<!-- 1. HERO BANNER CHÍNH HÃNG MINIO GREEN -->
<section class="vf9-hero" id="tong-quan">
  <img src="<?php echo esc_url($uploads_url . '/minio_vinfast-minio-green.jpg'); ?>" 
       alt="VinFast Minio Green Banner" 
       class="vf9-hero-bg"
       onerror="this.src='<?php echo esc_url($uploads_url . '/official_minio.webp'); ?>'">
  <div class="vf9-hero-overlay"></div>
  <div class="vf9-hero-content" data-aos="fade-up">
    <span class="vf9-hero-badge">XE ĐIỆN DỊCH VỤ ĐÔ THỊ COMPACT</span>
    <h1 class="vf9-hero-title">VINFAST MINIO GREEN<br>GIẢI PHÁP DI CHUYỂN XANH TIẾT KIỆM</h1>
    <p class="vf9-hero-desc">Minio Green là mẫu xe điện dịch vụ chở khách đô thị nhỏ gọn thiết kế trên nền VF 3, mang lại hiệu quả kinh doanh dịch vụ chạy xe công nghệ với chi phí vận hành siêu thấp.</p>
    <div style="display: flex; gap: 16px;">
      <a href="#configurator" class="vf-btn vf-btn-primary">TÙY CHỈNH CẤU HÌNH XE</a>
      <a href="<?php echo esc_url(home_url('/du-toan-tra-gop/')); ?>" class="vf-btn vf-btn-outline" style="color:#fff; border-color:#fff;">DỰ TOÁN TRẢ GÓP</a>
    </div>
  </div>
</section>

<!-- 2. TRÌNH CẤU HÌNH VÀ ĐỔI MÀU XE MINIO GREEN STUDIO -->
<section class="vf9-configurator" id="configurator">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Trình tùy chỉnh trực quan</span>
      <h2 class="vf9-sec-title">Khám Phá Cấu Hình Minio Green</h2>
      <p class="vf9-sec-desc">Tùy chọn màu sắc ngoại thất chính hãng cho tài xế và doanh nghiệp vận tải</p>
    </div>

    <!-- Canvas Xe Studio Minio Green -->
    <div class="vf9-stage-wrap">
      <img id="minioCarStageImg" 
           src="<?php echo esc_url($uploads_url . '/cutout_minio.png'); ?>" 
           alt="VinFast Minio Green Studio Render" 
           class="vf9-stage-car-img">
    </div>

    <!-- Bảng Điều Khiển Cấu Hình -->
    <div class="vf9-controls-panel" data-aos="fade-up">
      <div class="vf9-controls-grid">
        
        <!-- Chọn Màu Ngoại Thất Chính Hãng Minio Green -->
        <div>
          <div class="vf9-option-group-title">Chọn màu nhận diện taxi / dịch vụ:</div>
          <div class="vf9-color-dots-row">
            <button class="vf9-color-dot active" style="background: #10b981;" data-img="<?php echo esc_url($uploads_url . '/cutout_minio.png'); ?>" data-color="Xanh Green Taxi"></button>
            <button class="vf9-color-dot" style="background: #f59e0b;" data-img="<?php echo esc_url($uploads_url . '/Minio-green-mau-vang-540x282-1.png'); ?>" data-color="Vàng Taxi Yellow"></button>
            <button class="vf9-color-dot" style="background: #dc2626;" data-img="<?php echo esc_url($uploads_url . '/Minio-green-mau-do-540x282-1.png'); ?>" data-color="Đỏ Crimson Red"></button>
            <button class="vf9-color-dot" style="background: #0f172a;" data-img="<?php echo esc_url($uploads_url . '/Minio-green-mau-den-540x282-1.png'); ?>" data-color="Đen Jet Black"></button>
          </div>
          <div class="vf9-selected-color-label" id="minioColorLabel">Màu đang chọn: Xanh Green Taxi</div>
        </div>

        <!-- Chọn Phiên Bản & Pin -->
        <div>
          <div class="vf9-option-group-title">Phiên bản trang bị:</div>
          <div class="vf9-toggle-group" style="margin-bottom: 16px;">
            <button class="vf9-toggle-btn active" onclick="setMinioVersion('taxi', this)">Minio Green Chạy Dịch Vụ</button>
          </div>

          <div class="vf9-option-group-title">Hình thức sở hữu Pin:</div>
          <div class="vf9-toggle-group">
            <button class="vf9-toggle-btn active" onclick="setMinioBattery('thue', this)">Thuê Pin Ưu Đãi Dịch Vụ</button>
            <button class="vf9-toggle-btn" onclick="setMinioBattery('mua', this)">Mua Đứt Pin</button>
          </div>
        </div>

      </div>

      <!-- Tính Giá Động Real-time -->
      <div class="vf9-config-price-bar">
        <div>
          <div class="vf9-sec-label" style="margin: 0;">Giá niêm yết xe (Đã bao gồm VAT):</div>
          <div class="vf9-price-amount" id="minioDynamicPrice">239.000.000 VNĐ</div>
          <div style="font-size: 12px; color: #64748B;">*Hỗ trợ thủ tục đăng ký xe biển vàng dịch vụ giao xe nhanh</div>
        </div>
        <div style="display: flex; gap: 12px;">
          <a href="<?php echo esc_url(home_url('/du-toan-tra-gop/')); ?>" class="vf-btn vf-btn-outline">DỰ TOÁN CHI PHÍ</a>
          <button class="vf-btn vf-btn-primary" onclick="alert('Đã gửi yêu cầu tư vấn xe Minio Green!')">ĐẶT MUA XE DỊCH VỤ</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3. TÍNH NĂNG CHẠY DỊCH VỤ MINIO GREEN -->
<section class="vf9-section vf9-section-alt" id="tinh-nang">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Tối ưu cho tài xế công nghệ</span>
      <h2 class="vf9-sec-title">Linh Hoạt Đô Thị — Tiết Kiệm Tối Đa</h2>
      <p class="vf9-sec-desc">Kích thước nhỏ gọn luồn lách ngõ ngách, màn hình 10-inch hiển thị ứng dụng đón trả khách tiện lợi.</p>
    </div>

    <div class="vf9-grid-3">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/official_minio.webp'); ?>" 
             alt="Minio Green đón khách" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Bán Kính Quay Vòng Nhỏ</h3>
          <p class="vf9-card-desc">Dễ dàng quay đầu trong phố hẹp, đón trả khách linh hoạt vào giờ cao điểm.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/noi-that-1.webp'); ?>" 
             alt="Màn hình ứng dụng tài xế" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Màn Hình Giải Trí 10 Inch</h3>
          <p class="vf9-card-desc">Tích hợp định vị dẫn đường GPS chính xác, kết nối app tài xế chạy xe nhận chuyến mượt mà.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/quang-duong.jpg'); ?>" 
             alt="Sạc điện nhanh Minio" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Sạc Nhanh 36 Phút Trạm V-GREEN</h3>
          <p class="vf9-card-desc">Nạp năng lượng tranh thủ lúc nghỉ ca tại trạm sạc phủ khắp phố giúp sẵn sàng nổ chuyến liên tục.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. HIỆU NĂNG VẬN HÀNH MINIO GREEN -->
<section class="vf9-section" id="van-hanh">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Sức mạnh vận hành dịch vụ</span>
      <h2 class="vf9-sec-title">Quãng Đường 210 KM Cho Mỗi Lần Sạc</h2>
      <p class="vf9-sec-desc">Động cơ điện bền bỉ ít hỏng hóc vặt, bảo dưỡng định kỳ cực thấp gia tăng lợi nhuận thu nhập dòng tiền.</p>
    </div>

    <!-- Stats Box -->
    <div class="vf9-perf-stats-grid" data-aos="zoom-in">
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">43</div>
        <div class="vf9-stat-lbl">Mã Lực (HP)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">210</div>
        <div class="vf9-stat-lbl">Tầm Di Chuyển (KM)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">18.6</div>
        <div class="vf9-stat-lbl">Dung Lượng Pin (kWh)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">4 chỗ</div>
        <div class="vf9-stat-lbl">Chở Khách Đô Thị</div>
      </div>
    </div>
  </div>
</section>

<!-- 5. SO SÁNH CHI PHÍ NHIÊN LIỆU MINIO GREEN VS XE XĂNG CHẠY DỊCH VỤ -->
<section id="so-sanh-chi-phi" style="background: #F8FAFC; padding: 80px 0;">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Tiết kiệm nhiên liệu dịch vụ</span>
      <h2 class="vf9-sec-title">So Sánh Giữa Minio Green Và Xe Xăng Chạy Dịch Vụ Cùng Phân Khúc</h2>
    </div>

    <div class="vf-calc-wrap" data-aos="fade-up" style="margin-top: 40px;">
      <div class="vf-calc-grid">

        <!-- LEFT: Input Form -->
        <div class="vf-calc-left">
          <p class="vf-calc-subtitle">Vui lòng nhập thông tin xe xăng chạy dịch vụ cần so sánh:</p>

          <div class="vf-field-group">
            <span class="vf-field-label">Loại nhiên liệu sử dụng</span>
            <div class="vf-radio-group">
              <label>
                <input type="radio" name="minio_fuel_type" id="minio_fuel_xang" value="xang" checked>
                Xăng
              </label>
              <label>
                <input type="radio" name="minio_fuel_type" id="minio_fuel_dau" value="dau">
                Dầu
              </label>
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập mức tiêu thụ nhiên liệu:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Mức tiêu thụ nhiên liệu/100km *</span>
            <div class="vf-input-unit" data-unit="lít">
              <input type="number" id="minio_fuel_consumption" class="vf-number-input" value="7" min="1" max="30" step="0.1" placeholder="7">
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập quãng đường di chuyển mỗi tháng:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Quãng đường di chuyển/tháng *</span>
            <div class="vf-input-unit" data-unit="km">
              <input type="number" id="minio_distance_month" class="vf-number-input" value="3000" min="100" max="10000" step="50" placeholder="3000">
            </div>
          </div>

          <p class="vf-hint">(*) Nhập số, dùng dấu chấm "." cho phần thập phân (không dùng dấu phân cách hàng nghìn). Ví dụ: 7 lít; 3000 km chạy taxi.</p>

          <button class="vf-btn-compare" onclick="calcMinioCompare()">SO SÁNH</button>
        </div>

        <!-- RIGHT: Result Panel -->
        <div class="vf-calc-right">
          <div class="vf-result-header">
            <div class="vf-result-icon">🚖</div>
            <div class="vf-result-header-text">
              <h4>Lợi thế thu nhập của Minio Green</h4>
              <p class="vf-result-placeholder" id="minio_result_placeholder">(*) Chưa có dữ liệu so sánh. Vui lòng nhập thông tin!</p>
            </div>
            <img src="<?php echo esc_url($uploads_url . '/cutout_minio.png'); ?>"
                 alt="VinFast Minio Green"
                 onerror="this.style.display='none'">
          </div>

          <div id="minio_result_body" style="display:none;">
            <table class="vf-result-table">
              <tr>
                <td class="lbl">⚡ Chi phí điện Minio Green / tháng</td>
                <td class="vf-val" id="minio_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl" id="minio_fuel_label_month">⛽ Chi phí xăng xe taxi xăng / tháng</td>
                <td class="gas-val" id="minio_gas_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl">⚡ Chi phí điện Minio Green / năm</td>
                <td class="vf-val" id="minio_cost_year"></td>
              </tr>
              <tr>
                <td class="lbl" id="minio_fuel_label_year">⛽ Chi phí xăng xe taxi xăng / năm</td>
                <td class="gas-val" id="minio_gas_cost_year"></td>
              </tr>
            </table>

            <div class="vf-result-save">
              <div class="save-label">Tài xế bỏ túi thêm mỗi năm</div>
              <div class="save-amount" id="minio_save_year"></div>
              <div class="save-period" id="minio_save_note"></div>
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

<!-- 6. BẢNG THÔNG SỐ KỸ THUẬT MINIO GREEN CHÍNH HÃNG -->
<section class="vf9-section vf9-section-alt" id="thong-so">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Thông số kỹ thuật dịch vụ</span>
      <h2 class="vf9-sec-title">Thông Số Kỹ Thuật Minio Green</h2>
    </div>

    <div class="vf9-specs-table-wrap" data-aos="fade-up">
      <table class="vf9-specs-table">
        <tr><td>Dài x Rộng x Cao (mm)</td><td>3.190 x 1.679 x 1.622</td></tr>
        <tr><td>Số chỗ ngồi</td><td>4 chỗ</td></tr>
        <tr><td>Khoảng sáng gầm xe (mm)</td><td>191 mm</td></tr>
        <tr><td>Động cơ điện</td><td>1 Motor RWD (Dẫn động cầu sau)</td></tr>
        <tr><td>Dung lượng pin khả dụng</td><td>18.64 kWh</td></tr>
        <tr><td>Quãng đường di chuyển (NEDC)</td><td>210 km / 1 lần sạc đầy</td></tr>
        <tr><td>Thời gian sạc nhanh (10-70%)</td><td>36 phút (Cổng DC)</td></tr>
      </table>
    </div>

  </div>
</section>

<!-- Scripts cho Minio Green Template -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  const minioPrices = {
    taxi: { thue: '239.000.000 VNĐ', mua: '321.000.000 VNĐ' }
  };

  let currentMinioVersion = 'taxi';
  let currentMinioBattery = 'thue';

  function updateMinioPrice() {
    const priceText = minioPrices[currentMinioVersion][currentMinioBattery];
    document.getElementById('minioDynamicPrice').textContent = priceText;
    document.getElementById('subnav-price-display-minio').textContent = priceText;
  }

  function setMinioVersion(ver, btn) {
    currentMinioVersion = ver;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateMinioPrice();
  }

  function setMinioBattery(bat, btn) {
    currentMinioBattery = bat;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateMinioPrice();
  }

  document.querySelectorAll('.vf9-color-dot').forEach(dot => {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf9-color-dot').forEach(d => d.classList.remove('active'));
      this.classList.add('active');

      const imgSrc = this.getAttribute('data-img');
      const colorName = this.getAttribute('data-color');
      const stageImg = document.getElementById('minioCarStageImg');

      stageImg.classList.add('changing');
      setTimeout(() => {
        stageImg.src = imgSrc;
        stageImg.classList.remove('changing');
      }, 200);

      document.getElementById('minioColorLabel').textContent = 'Màu đang chọn: ' + colorName;
    });
  });

  window.addEventListener('scroll', function() {
    const subnav = document.getElementById('minioStickySubnav');
    if (window.scrollY > 480) {
      subnav.classList.add('active');
    } else {
      subnav.classList.remove('active');
    }
  });

  (function() {
    var MINIO_KWH_PER_100KM = 14;
    var MINIO_ELEC_PRICE_PER_KWH = 3000;
    var MINIO_XANG_PRICE = 24000;
    var MINIO_DAU_PRICE  = 21000;

    window.calcMinioCompare = function() {
      var fuelType    = document.querySelector('input[name="minio_fuel_type"]:checked').value;
      var consumption = parseFloat(document.getElementById('minio_fuel_consumption').value);
      var distance    = parseFloat(document.getElementById('minio_distance_month').value);

      if (isNaN(consumption) || consumption <= 0 || isNaN(distance) || distance <= 0) {
        alert('Vui lòng nhập đầy đủ và hợp lệ mức tiêu thụ và quãng đường!');
        return;
      }

      var fuelPrice    = fuelType === 'dau' ? MINIO_DAU_PRICE : MINIO_XANG_PRICE;
      var fuelLabel    = fuelType === 'dau' ? 'Dầu' : 'Xăng';

      var elecCostMonth = (distance / 100) * MINIO_KWH_PER_100KM * MINIO_ELEC_PRICE_PER_KWH;
      var elecCostYear  = elecCostMonth * 12;
      var gasCostMonth  = (distance / 100) * consumption * fuelPrice;
      var gasCostYear   = gasCostMonth * 12;
      var saveYear      = gasCostYear - elecCostYear;

      document.getElementById('minio_result_placeholder').style.display = 'none';
      document.getElementById('minio_result_body').style.display = 'block';

      document.getElementById('minio_cost_month').textContent      = formatVND(elecCostMonth) + ' VNĐ';
      document.getElementById('minio_gas_cost_month').textContent  = formatVND(gasCostMonth)  + ' VNĐ';
      document.getElementById('minio_cost_year').textContent       = formatVND(elecCostYear)  + ' VNĐ';
      document.getElementById('minio_gas_cost_year').textContent   = formatVND(gasCostYear)   + ' VNĐ';
      document.getElementById('minio_fuel_label_month').textContent = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / tháng';
      document.getElementById('minio_fuel_label_year').textContent  = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / năm';
      document.getElementById('minio_save_year').textContent       = formatVND(saveYear) + ' VNĐ';
      document.getElementById('minio_save_note').textContent       = 'Dựa trên ' + Math.round(distance).toLocaleString('vi-VN') + ' km/tháng với ' + consumption + ' lít ' + fuelLabel.toLowerCase() + '/100km';
    };

    function formatVND(num) {
      return Math.round(num).toLocaleString('vi-VN');
    }
  })();
</script>

<?php get_footer(); ?>
