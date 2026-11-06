<?php
/**
 * Dedicated Authentic Product Template for VinFast VF 3
 * Location: template-parts/product/single-vf3.php
 * 100% Authentic VF 3 Cutouts, Real Gallery Photos & Exact Specs
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

$uploads_url = content_url('/uploads/official_cars/vf3');
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
<div class="vf-subnav" id="vf3StickySubnav">
  <div class="vf-subnav-inner">
    <div class="vf-subnav-title">VinFast VF 3</div>
    <ul class="vf-subnav-links">
      <li><a href="#tong-quan" class="active">Tổng quan</a></li>
      <li><a href="#ngoai-that">Ngoại thất</a></li>
      <li><a href="#noi-that">Nội thất</a></li>
      <li><a href="#van-hanh">Vận hành</a></li>
      <li><a href="#an-toan">An toàn & Tiện nghi</a></li>
      <li><a href="#thong-so">Thông số kỹ thuật</a></li>
    </ul>
    <div class="vf-subnav-actions">
      <div class="vf-subnav-price-wrap">
        <span class="vf-subnav-price-label" style="font-size:11px; color:#64748B;">Giá niêm yết từ</span>
        <span class="vf-subnav-price-val" id="subnav-price-display-vf3">285.000.000 VNĐ</span>
      </div>
      <a href="#configurator" class="vf-btn vf-btn-primary">ĐẶT CỌC NGAY</a>
    </div>
  </div>
</div>

<!-- 1. HERO BANNER CHÍNH HÃNG VF 3 -->
<section class="vf9-hero" id="tong-quan">
  <img src="<?php echo esc_url($uploads_url . '/vf3_41_vf3.jpg'); ?>" 
       alt="VinFast VF 3 Banner" 
       class="vf9-hero-bg"
       onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
  <div class="vf9-hero-overlay"></div>
  <div class="vf9-hero-content" data-aos="fade-up">
    <span class="vf9-hero-badge">MINI E-SUV PHỐ THÔNG MINH</span>
    <h1 class="vf9-hero-title">ĐÔ THỊ NĂNG ĐỘNG<br>PHONG CÁCH CÁ TÍNH</h1>
    <p class="vf9-hero-desc">VinFast VF 3 là mẫu xe điện Mini SUV quốc dân sở hữu thiết kế vuông vức cá tính, khoảng sáng gầm 191 mm vượt trội cùng khả năng di chuyển linh hoạt trên mọi cung đường đô thị.</p>
    <div style="display: flex; gap: 16px;">
      <a href="#configurator" class="vf-btn vf-btn-primary">TÙY CHỈNH CẤU HÌNH XE</a>
      <a href="<?php echo esc_url(home_url('/mua-xe-tra-gop/')); ?>" class="vf-btn vf-btn-outline" style="color:#fff; border-color:#fff;">DỰ TOÁN TRẢ GÓP</a>
    </div>
  </div>
</section>

<!-- 2. TRÌNH CẤU HÌNH VÀ ĐỔI MÀU XE VF 3 STUDIO -->
<section class="vf9-configurator" id="configurator">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Trình tùy chỉnh trực quan</span>
      <h2 class="vf9-sec-title">Khám Phá Cấu Hình VinFast VF 3</h2>
      <p class="vf9-sec-desc">Tùy chọn màu sắc ngoại thất chính hãng, phiên bản trang bị và hình thức sở hữu pin</p>
    </div>

    <!-- Canvas Xe Studio VF 3 -->
    <div class="vf9-stage-wrap">
      <img id="vf3CarStageImg" 
           src="<?php echo esc_url($uploads_url . '/TRANG.png'); ?>" 
           alt="VinFast VF 3 Studio Render" 
           class="vf9-stage-car-img">
    </div>

    <!-- Bảng Điều Khiển Cấu Hình -->
    <div class="vf9-controls-panel" data-aos="fade-up">
      <div class="vf9-controls-grid">
        
        <!-- Chọn Màu Ngoại Thất Chính Hãng VF 3 -->
        <div>
          <div class="vf9-option-group-title">Chọn màu ngoại thất chính hãng:</div>
          <div class="vf9-color-dots-row">
            <button class="vf9-color-dot active" style="background: #ffffff;" data-img="<?php echo esc_url($uploads_url . '/TRANG.png'); ?>" data-color="Trắng"></button>
            <button class="vf9-color-dot" style="background: #f59e0b;" data-img="<?php echo esc_url($uploads_url . '/tai-xuong.png'); ?>" data-color="Vàng"></button>
            <button class="vf9-color-dot" style="background: #10b981;" data-img="<?php echo esc_url($uploads_url . '/Urban-Mint.png'); ?>" data-color="Xanh Mint"></button>
            <button class="vf9-color-dot" style="background: #ec4899;" data-img="<?php echo esc_url($uploads_url . '/tai-xuong-1.png'); ?>" data-color="Hồng"></button>
            <button class="vf9-color-dot" style="background: #94a3b8;" data-img="<?php echo esc_url($uploads_url . '/tai-xuong-2.png'); ?>" data-color="Xám"></button>
            <button class="vf9-color-dot" style="background: #3b82f6;" data-img="<?php echo esc_url($uploads_url . '/Sky-Blue.png'); ?>" data-color="Xanh Sky"></button>
            <button class="vf9-color-dot" style="background: #991b1b;" data-img="<?php echo esc_url($uploads_url . '/Crimson-Red.png'); ?>" data-color="Đỏ"></button>
            <button class="vf9-color-dot" style="background: #8b5cf6;" data-img="<?php echo esc_url($uploads_url . '/vf3tim.png'); ?>" data-color="Tím"></button>
          </div>
          <div class="vf9-selected-color-label" id="vf3ColorLabel">Màu đang chọn: Trắng</div>
        </div>

        <!-- Chọn Phiên Bản & Pin -->
        <div>
          <div class="vf9-option-group-title">Chọn phiên bản trang bị:</div>
          <div class="vf9-toggle-group" style="margin-bottom: 16px;">
            <button class="vf9-toggle-btn active" onclick="setVF3Version('eco', this)">Phiên bản Tiêu Chuẩn</button>
            <button class="vf9-toggle-btn" onclick="setVF3Version('plus', this)">Phiên bản Nâng Cao</button>
          </div>

          <div class="vf9-option-group-title">Hình thức sở hữu Pin:</div>
          <div class="vf9-toggle-group">
            <button class="vf9-toggle-btn active" onclick="setVF3Battery('thue', this)">Thuê Pin Hàng Tháng</button>
            <button class="vf9-toggle-btn" onclick="setVF3Battery('mua', this)">Mua Đứt Pin</button>
          </div>
        </div>

      </div>

      <!-- Tính Giá Động Real-time -->
      <div class="vf9-config-price-bar">
        <div>
          <div class="vf9-sec-label" style="margin: 0;">Giá niêm yết xe (Đã bao gồm VAT):</div>
          <div class="vf9-price-amount" id="vf3DynamicPrice">285.000.000 VNĐ</div>
          <div style="font-size: 12px; color: #64748B;">*Ưu đãi hỗ trợ chi phí chuyển đổi xe xăng sang xe điện VinFast chính hãng</div>
        </div>
        <div style="display: flex; gap: 12px;">
          <a href="<?php echo esc_url(home_url('/mua-xe-tra-gop/')); ?>" class="vf-btn vf-btn-outline">DỰ TOÁN CHI PHÍ</a>
          <button class="vf-btn vf-btn-primary" onclick="alert('Đã gửi yêu cầu tư vấn đặt cọc VinFast VF 3!')">ĐẶT CỌC ONLINE</button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3. NGOẠI THẤT CHÍNH HÃNG VF 3 -->
<section class="vf9-section vf9-section-alt" id="ngoai-that">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Ngoại thất khí động học</span>
      <h2 class="vf9-sec-title">Kiểu Dáng Mini SUV Vuông Vức & Khỏe Khoắn</h2>
      <p class="vf9-sec-desc">Đường nét thiết kế vuông vức hình khối nổi bật phong cách SUV cá tính, nâng tầm trải nghiệm cá nhân hóa.</p>
    </div>

    <div class="vf9-grid-3">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/51_VF3_Rear_34_Driver_Side_Wheel_Cover1.png'); ?>" 
             alt="Dáng vẻ SUV VF 3" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Dáng Vẻ SUV Mạnh Mẽ</h3>
          <p class="vf9-card-desc">Thiết kế vuông vức hình khối với cản trước khỏe khoắn và ốp vè cua lốp nhựa đen bảo vệ nổi bật.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/cutout_vf3.png'); ?>" 
             alt="Cánh chim mạ chrome VF 3" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Dải Cánh Nhạn Chrome Nổi Bật</h3>
          <p class="vf9-card-desc">Thiết kế mặt ca-lăng mạ chrome hình cánh chim ôm trọn logo VinFast kiêu hãnh nhận diện từ xa.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/51_VF3_Rear_34_Driver_Side_Wheel_Cover1.png'); ?>" 
             alt="Mâm 16 inch VF 3" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Bộ La-Zăng 16 Inch Vượt Địa Hình</h3>
          <p class="vf9-card-desc">Mâm hợp kim 16-inch kích thước lớn kết hợp khoảng sáng gầm 191 mm giúp xe leo lề và lội nước an tâm.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. NỘI THẤT KHOANG LÁI VF 3 -->
<section class="vf9-section" id="noi-that">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Nội thất & Tiện nghi</span>
      <h2 class="vf9-sec-title">Khoang Lái Tối Ưu Cho 4 Người Ngồi</h2>
      <p class="vf9-sec-desc">Bố trí không gian nội thất thông minh tối ưu diện tích cabin cùng màn hình cảm ứng trung tâm 10-inch sắc nét.</p>
    </div>

    <!-- Interior Hero Photo -->
    <div class="vf9-interior-hero" data-aos="fade-up">
      <img src="<?php echo esc_url($uploads_url . '/49_VF3_Interior_Hero.jpg'); ?>" 
           alt="Nội thất khoang lái VinFast VF 3" 
           class="vf9-interior-hero-img"
           onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
      <div class="vf9-interior-overlay">
        <div>
          <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 12px;">Màn Hình Cảm Ứng 10 Inch & Cần Số Vô Lăng</h3>
          <p style="max-width: 640px;">Bảng điều khiển trung tâm tối giản sang trọng với màn hình giải trí đa thông tin kết nối Apple CarPlay & Android Auto.</p>
        </div>
      </div>
    </div>

    <!-- 3 Interior Detail Cards -->
    <div class="vf9-grid-3" style="margin-top: 36px;">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/noi-that-1.webp'); ?>" 
             alt="Màn hình trung tâm VF 3" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Màn Hình Giải Trí 10 Inch</h3>
          <p class="vf9-card-desc">Tích hợp trung tâm điều khiển giải trí, định vị chỉ đường vệ tinh và theo dõi dung lượng pin thực tế.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/noi-that-4.jpg'); ?>" 
             alt="Ghế bọc da VF 3" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Khoang Lái 4 Chỗ Rộng Rãi</h3>
          <p class="vf9-card-desc">Ghế bọc nỉ da cao cấp ôm lưng cùng hàng ghế sau có thể gập phẳng tăng dung tích khoang chứa đồ lên 285 lít.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/noi-that-5.jpg'); ?>" 
             alt="Cần số vô lăng VF 3" 
             class="vf9-card-img"
             onerror="this.src='<?php echo esc_url($uploads_url . '/TRANG.png'); ?>'">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Cần Số Tích Hợp Vô Lăng</h3>
          <p class="vf9-card-desc">Cần số điện tử đặt phía sau vô-lăng 3 chấu thể thao giúp thao tác chuyển số mượt mà và giải phóng không gian yên ngựa.</p>
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
      <h2 class="vf9-sec-title">Vận Hành Linh Hoạt — Tầm Bay 210 KM</h2>
      <p class="vf9-sec-desc">Động cơ điện RWD cầu sau bứt tốc mượt mà, giúp di chuyển năng động với chi phí sạc điện cực rẻ.</p>
    </div>

    <!-- Stats Box -->
    <div class="vf9-perf-stats-grid" data-aos="zoom-in">
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">43</div>
        <div class="vf9-stat-lbl">Mã Lực (HP)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">210</div>
        <div class="vf9-stat-lbl">Tầm Hoạt Động (KM)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">18.6</div>
        <div class="vf9-stat-lbl">Dung Lượng Pin (kWh)</div>
      </div>
      <div class="vf9-stat-box">
        <div class="vf9-stat-val">RWD</div>
        <div class="vf9-stat-lbl">Dẫn Động Cầu Sau</div>
      </div>
    </div>

    <!-- Charging Solutions Grid -->
    <div class="vf9-grid-3" style="margin-top: 48px;">
      <div class="vf9-card" data-aos="fade-up">
        <img src="<?php echo esc_url($uploads_url . '/vf9_80_cs-charging-station.webp'); ?>" 
             alt="Trạm sạc V-GREEN VF 3" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Mạng Lưới Trạm Sạc V-GREEN</h3>
          <p class="vf9-card-desc">Hệ thống trạm sạc phủ rộng 63 tỉnh thành, sạc nhanh DC từ 10% lên 70% chỉ trong 36 phút.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="100">
        <img src="<?php echo esc_url($uploads_url . '/vf9_81_cs-home-charger.webp'); ?>" 
             alt="Bộ sạc gia đình VF 3" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Bộ Sạc Tại Nhà Di Động</h3>
          <p class="vf9-card-desc">Cung cấp bộ sạc di động cắm nguồn dân dụng 220V sạc tiện lợi qua đêm tại nhà.</p>
        </div>
      </div>

      <div class="vf9-card" data-aos="fade-up" data-aos-delay="200">
        <img src="<?php echo esc_url($uploads_url . '/quang-duong.jpg'); ?>" 
             alt="Giải pháp thuê pin VF 3" 
             class="vf9-card-img">
        <div class="vf9-card-body">
          <h3 class="vf9-card-title">Chi Phí Sử Dụng Siêu Tiết Kiệm</h3>
          <p class="vf9-card-desc">Chi phí sạc điện và vận hành hàng tháng rẻ hơn xe máy tay ga, bảo hành xe 7 năm hoặc 160.000 km.</p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- 6. AN TOÀN & TIỆN NGHI THÔNG MINH -->
<section class="vf9-section" id="an-toan">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">An toàn tiêu chuẩn đô thị</span>
      <h2 class="vf9-sec-title">An Toàn Tin Cậy — Trợ Lý Tiếng Việt ViVi</h2>
      <p class="vf9-sec-desc">Trang bị phanh ABS, EBD, trợ lực phanh khẩn cấp cùng trợ lý ảo thông minh điều khiển giọng nói 3 miền.</p>
    </div>

    <div class="vf9-tech-grid" data-aos="fade-up">
      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🛡️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Hệ Thống Phanh Chống Bó Cứng ABS & EBD</h4>
          <p style="font-size: 14px; color: #64748B;">Giúp tài xế làm chủ tay lái và duy trì hướng di chuyển khi phanh gấp trên đường trượt.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🚗</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Hệ Thống Cân Bằng Điện Tử (ESC)</h4>
          <p style="font-size: 14px; color: #64748B;">Tự động can thiệp phanh trên từng bánh xe để chống lật và mất lái khi vào cua gấp.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🅿️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Cảm Biến Hỗ Trợ Đỗ Xe Phía Sau</h4>
          <p style="font-size: 14px; color: #64748B;">Cảnh báo khoảng cách chướng ngại vật giúp tài xế lùi đỗ xe vào chuồng vô cùng an toàn.</p>
        </div>
      </div>

      <div class="vf9-tech-item">
        <div class="vf9-tech-icon">🗣️</div>
        <div>
          <h4 style="font-size: 1.1rem; font-weight: 800; margin-bottom: 6px;">Trợ Lý Ảo Tiếng Việt 3 Miền (ViVi Assistant)</h4>
          <p style="font-size: 14px; color: #64748B;">Lắng nghe và thực hiện câu lệnh bằng giọng nói Bắc - Trung - Nam tự nhiên mượt mà.</p>
        </div>
      </div>
    </div>

    <!-- Banner Đặc Quyền Bảo Hành -->
    <div class="vf9-privilege-banner" data-aos="fade-up">
      <div>
        <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #60a5fa;">Đặc quyền sở hữu xe VinFast VF 3</span>
        <h3 style="font-size: 2.2rem; font-weight: 900; margin-top: 8px;">Bảo Hành Chính Hãng 7 Năm</h3>
        <p style="color: rgba(255,255,255,0.8); margin-top: 12px; font-size: 15px;">VinFast cam kết chất lượng vượt trội với chính sách bảo hành 7 năm hoặc 160.000 km, cùng dịch vụ cứu hộ 24/7 toàn quốc.</p>
      </div>
      <div>
        <ul class="vf9-privilege-list">
          <li>Bảo hành chính hãng 7 năm cho xe và Pin</li>
          <li>Dịch vụ Cứu hộ 24/7 miễn phí toàn quốc</li>
          <li>Sửa chữa lưu động Mobile Service tận nơi</li>
          <li>Mạng lưới trạm sạc phủ rộng 63 tỉnh thành</li>
        </ul>
      </div>
    </div>

  </div>
</section>

<!-- 7. BẢNG THÔNG SỐ KỸ THUẬT VF 3 CHÍNH HÃNG -->
<section class="vf9-section vf9-section-alt" id="thong-so">
  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Thông số chi tiết</span>
      <h2 class="vf9-sec-title">Thông Số Kỹ Thuật VinFast VF 3</h2>
    </div>

    <div class="vf9-specs-tabs-nav">
      <button class="vf9-spec-tab-btn active" onclick="switchVF3SpecTab('kich-thuoc', this)">Kích Thước & Động Cơ</button>
      <button class="vf9-spec-tab-btn" onclick="switchVF3SpecTab('pin-sac', this)">Pin & Trạm Sạc</button>
    </div>

    <div class="vf9-specs-table-wrap" data-aos="fade-up">
      <table class="vf9-specs-table" id="vf3SpecTabKichThuoc">
        <tr><td>Dài x Rộng x Cao (mm)</td><td>3.190 x 1.679 x 1.622</td></tr>
        <tr><td>Chiều dài cơ sở (mm)</td><td>2.075 mm</td></tr>
        <tr><td>Khoảng sáng gầm xe (mm)</td><td>191 mm</td></tr>
        <tr><td>Số chỗ ngồi</td><td>4 chỗ</td></tr>
        <tr><td>Động cơ điện</td><td>1 Motor (RWD Cầu sau)</td></tr>
        <tr><td>Công suất tối đa</td><td>43 mã lực (32 kW)</td></tr>
        <tr><td>Mô-men xoắn cực đại</td><td>110 Nm</td></tr>
      </table>

      <table class="vf9-specs-table" id="vf3SpecTabPinSac" style="display: none;">
        <tr><td>Dung lượng pin khả dụng</td><td>18.64 kWh</td></tr>
        <tr><td>Quãng đường di chuyển (NEDC)</td><td>210 km / 1 lần sạc đầy</td></tr>
        <tr><td>Thời gian sạc nhanh (10-70%)</td><td>36 phút (Trạm sạc DC)</td></tr>
        <tr><td>Bộ sạc di động theo xe</td><td>Portable AC 2.2 kW / 220V</td></tr>
        <tr><td>Mạng lưới trạm sạc</td><td>V-GREEN phủ rộng 63 tỉnh thành Việt Nam</td></tr>
      </table>
    </div>

  </div>
</section>

<!-- Scripts cho VF 3 Template -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });

  const vf3Prices = {
    eco:  { thue: '285.000.000 VNĐ', mua: '322.000.000 VNĐ' },
    plus: { thue: '296.000.000 VNĐ', mua: '342.000.000 VNĐ' }
  };

  let currentVF3Version = 'eco';
  let currentVF3Battery = 'thue';

  function updateVF3Price() {
    const priceText = vf3Prices[currentVF3Version][currentVF3Battery];
    document.getElementById('vf3DynamicPrice').textContent = priceText;
    document.getElementById('subnav-price-display-vf3').textContent = priceText;
  }

  function setVF3Version(ver, btn) {
    currentVF3Version = ver;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateVF3Price();
  }

  function setVF3Battery(bat, btn) {
    currentVF3Battery = bat;
    btn.parentNode.querySelectorAll('.vf9-toggle-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    updateVF3Price();
  }

  // Đổi màu xe VF 3 Real-time Cutouts
  document.querySelectorAll('.vf9-color-dot').forEach(dot => {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf9-color-dot').forEach(d => d.classList.remove('active'));
      this.classList.add('active');

      const imgSrc = this.getAttribute('data-img');
      const colorName = this.getAttribute('data-color');
      const stageImg = document.getElementById('vf3CarStageImg');

      stageImg.classList.add('changing');
      setTimeout(() => {
        stageImg.src = imgSrc;
        stageImg.classList.remove('changing');
      }, 200);

      document.getElementById('vf3ColorLabel').textContent = 'Màu đang chọn: ' + colorName;
    });
  });

  // Sticky Subnav Scroll
  window.addEventListener('scroll', function() {
    const subnav = document.getElementById('vf3StickySubnav');
    if (window.scrollY > 480) {
      subnav.classList.add('active');
    } else {
      subnav.classList.remove('active');
    }
  });

  // Tabs Thông số VF 3
  function switchVF3SpecTab(tabKey, btn) {
    document.querySelectorAll('.vf9-spec-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.getElementById('vf3SpecTabKichThuoc').style.display = 'none';
    document.getElementById('vf3SpecTabPinSac').style.display = 'none';

    if (tabKey === 'kich-thuoc') document.getElementById('vf3SpecTabKichThuoc').style.display = 'table';
    if (tabKey === 'pin-sac') document.getElementById('vf3SpecTabPinSac').style.display = 'table';
  }
</script>

<!-- SO SÁNH CHI PHÍ NHIÊN LIỆU VF 3 VS XE ĐỘNG CƠ ĐỐT TRONG -->
<section id="so-sanh-chi-phi" style="background: #F8FAFC; padding: 80px 0;">

  <div class="container">
    <div class="vf9-sec-head" data-aos="fade-up">
      <span class="vf9-sec-label">Tiết kiệm vượt trội</span>
      <h2 class="vf9-sec-title">So Sánh Giữa Xe VinFast VF 3 Và Xe Động Cơ Đốt Trong</h2>
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
                <input type="radio" name="vf3_fuel_type" id="vf3_fuel_xang" value="xang" checked>
                Xăng
              </label>
              <label>
                <input type="radio" name="vf3_fuel_type" id="vf3_fuel_dau" value="dau">
                Dầu
              </label>
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập mức tiêu thụ nhiên liệu:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Mức tiêu thụ nhiên liệu/100km *</span>
            <div class="vf-input-unit" data-unit="lít">
              <input type="number" id="vf3_fuel_consumption" class="vf-number-input" value="8" min="1" max="30" step="0.1" placeholder="8">
            </div>
          </div>

          <p class="vf-field-note">Vui lòng nhập quãng đường di chuyển mỗi tháng:</p>
          <div class="vf-field-group">
            <span class="vf-field-label">Quãng đường di chuyển/tháng *</span>
            <div class="vf-input-unit" data-unit="km">
              <input type="number" id="vf3_distance_month" class="vf-number-input" value="1000" min="100" max="10000" step="50" placeholder="1000">
            </div>
          </div>

          <p class="vf-hint">(*) Nhập số, dùng dấu chấm "." cho phần thập phân (không dùng dấu phân cách hàng nghìn). Ví dụ: 8.56 lít; 1023.56 km.</p>

          <button class="vf-btn-compare" onclick="calcVF3Compare()">SO SÁNH</button>
        </div>

        <!-- RIGHT: Result Panel -->
        <div class="vf-calc-right">
          <div class="vf-result-header">
            <div class="vf-result-icon">🌿</div>
            <div class="vf-result-header-text">
              <h4>Lợi thế chi phí nhiên liệu của VF 3</h4>
              <p class="vf-result-placeholder" id="vf3_result_placeholder">(*) Chưa có dữ liệu so sánh. Vui lòng nhập thông tin!</p>
            </div>
            <img src="<?php echo esc_url($uploads_url . '/vf3_cutout_white.webp'); ?>"
                 alt="VinFast VF 3"
                 onerror="this.style.display='none'">
          </div>

          <div id="vf3_result_body" style="display:none;">
            <table class="vf-result-table">
              <tr>
                <td class="lbl">⚡ Chi phí điện VF 3 / tháng</td>
                <td class="vf-val" id="vf3_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl" id="vf3_fuel_label_month">⛽ Chi phí xăng / tháng</td>
                <td class="gas-val" id="vf3_gas_cost_month"></td>
              </tr>
              <tr>
                <td class="lbl">⚡ Chi phí điện VF 3 / năm</td>
                <td class="vf-val" id="vf3_cost_year"></td>
              </tr>
              <tr>
                <td class="lbl" id="vf3_fuel_label_year">⛽ Chi phí xăng / năm</td>
                <td class="gas-val" id="vf3_gas_cost_year"></td>
              </tr>
            </table>

            <div class="vf-result-save">
              <div class="save-label">Bạn tiết kiệm được mỗi năm</div>
              <div class="save-amount" id="vf3_save_year"></div>
              <div class="save-period" id="vf3_save_note"></div>
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
  // VF 3: điện tiêu thụ 14 kWh/100km, giá điện 3.000 VNĐ/kWh
  var VF3_KWH_PER_100KM = 14;
  var VF3_ELEC_PRICE_PER_KWH = 3000;
  var VF3_XANG_PRICE = 24000;
  var VF3_DAU_PRICE  = 21000;

  window.calcVF3Compare = function() {
    var fuelType    = document.querySelector('input[name="vf3_fuel_type"]:checked').value;
    var consumption = parseFloat(document.getElementById('vf3_fuel_consumption').value);
    var distance    = parseFloat(document.getElementById('vf3_distance_month').value);

    if (isNaN(consumption) || consumption <= 0 || isNaN(distance) || distance <= 0) {
      alert('Vui lòng nhập đầy đủ và hợp lệ mức tiêu thụ và quãng đường!');
      return;
    }

    var fuelPrice    = fuelType === 'dau' ? VF3_DAU_PRICE : VF3_XANG_PRICE;
    var fuelLabel    = fuelType === 'dau' ? 'Dầu' : 'Xăng';

    var elecCostMonth = (distance / 100) * VF3_KWH_PER_100KM * VF3_ELEC_PRICE_PER_KWH;
    var elecCostYear  = elecCostMonth * 12;
    var gasCostMonth  = (distance / 100) * consumption * fuelPrice;
    var gasCostYear   = gasCostMonth * 12;
    var saveYear      = gasCostYear - elecCostYear;

    document.getElementById('vf3_result_placeholder').style.display = 'none';
    document.getElementById('vf3_result_body').style.display = 'block';

    document.getElementById('vf3_cost_month').textContent      = formatVND(elecCostMonth) + ' VNĐ';
    document.getElementById('vf3_gas_cost_month').textContent  = formatVND(gasCostMonth)  + ' VNĐ';
    document.getElementById('vf3_cost_year').textContent       = formatVND(elecCostYear)  + ' VNĐ';
    document.getElementById('vf3_gas_cost_year').textContent   = formatVND(gasCostYear)   + ' VNĐ';
    document.getElementById('vf3_fuel_label_month').textContent = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / tháng';
    document.getElementById('vf3_fuel_label_year').textContent  = '⛽ Chi phí ' + fuelLabel.toLowerCase() + ' / năm';
    document.getElementById('vf3_save_year').textContent       = formatVND(saveYear) + ' VNĐ';
    document.getElementById('vf3_save_note').textContent       = 'Dựa trên ' + Math.round(distance).toLocaleString('vi-VN') + ' km/tháng với ' + consumption + ' lít ' + fuelLabel.toLowerCase() + '/100km';
  };

  function formatVND(num) {
    return Math.round(num).toLocaleString('vi-VN');
  }
})();
</script>


<?php get_footer(); ?>

        <div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
        <div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(37,99,235,0.3); border: 1px solid rgba(96,165,250,0.4); border-radius: 20px; padding: 6px 16px; margin-bottom: 24px;">
          <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #60a5fa;">⚡ Xe Điện</span>
        </div>
        <h3 style="font-size: 1.6rem; font-weight: 900; margin-bottom: 8px;">VinFast VF 3</h3>
        <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin-bottom: 32px;">Chi phí vận hành siêu tiết kiệm</p>

        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">⚡ Chi phí điện / 100km</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">~15.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">📅 Chi phí / tháng (1.000km)</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">~150.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <span style="font-size: 14px; color: rgba(255,255,255,0.7);">📆 Chi phí / năm (12.000km)</span>
            <span style="font-weight: 900; color: #34d399; font-size: 1.1rem;">~1.800.000 VNĐ</span>
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

      <!-- Xe Xăng Tương Đương -->
      <div style="background: #fff; border-radius: 24px; padding: 40px; border: 2px solid #E2E8F0; position: relative;">
        <div style="display: inline-flex; align-items: center; gap: 8px; background: #FEF3C7; border: 1px solid #FDE68A; border-radius: 20px; padding: 6px 16px; margin-bottom: 24px;">
          <span style="font-size: 12px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #92400E;">⛽ Xe Xăng</span>
        </div>
        <h3 style="font-size: 1.6rem; font-weight: 900; color: #1E293B; margin-bottom: 8px;">Xe Xăng Cùng Phân Khúc</h3>
        <p style="color: #64748B; font-size: 14px; margin-bottom: 32px;">Chi phí vận hành cao hơn nhiều</p>

        <div style="display: flex; flex-direction: column; gap: 16px;">
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #E2E8F0;">
            <span style="font-size: 14px; color: #64748B;">⛽ Chi phí xăng / 100km</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">~70.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #E2E8F0;">
            <span style="font-size: 14px; color: #64748B;">📅 Chi phí / tháng (1.000km)</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">~700.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #E2E8F0;">
            <span style="font-size: 14px; color: #64748B;">📆 Chi phí / năm (12.000km)</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">~8.400.000 VNĐ</span>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 0;">
            <span style="font-size: 14px; color: #64748B;">🔧 Bảo dưỡng định kỳ</span>
            <span style="font-weight: 900; color: #EF4444; font-size: 1.1rem;">2–3 triệu/lần</span>
          </div>
        </div>

        <div style="margin-top: 28px; padding: 16px; background: #FEF2F2; border: 1px solid #FCA5A5; border-radius: 12px; text-align: center;">
          <span style="font-size: 13px; color: #DC2626; font-weight: 700;">🏭 Phát thải CO₂ cao — Ô nhiễm môi trường</span>
        </div>
      </div>
    </div>

    <!-- Kết Luận Tiết Kiệm -->
    <div data-aos="fade-up" style="margin-top: 48px; background: linear-gradient(135deg, #2563EB, #1E40AF); border-radius: 20px; padding: 40px; text-align: center; color: #fff;">
      <h3 style="font-size: 2rem; font-weight: 900; margin-bottom: 12px;">Tiết kiệm đến <span style="color: #FCD34D;">~6.600.000 VNĐ/năm</span></h3>
      <p style="color: rgba(255,255,255,0.8); font-size: 16px; max-width: 600px; margin: 0 auto 28px;">Chỉ tính riêng chi phí nhiên liệu, VF 3 tiết kiệm hơn xe xăng cùng phân khúc từ 4–5 lần. Đó là chưa tính chi phí bảo dưỡng và ưu đãi lăn bánh.</p>
      <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="/dat-lich-lai-thu/" class="vf-btn" style="background: #fff; color: #2563EB;">🚗 Đặt Lịch Lái Thử</a>
        <a href="/du-toan-tra-gop/" class="vf-btn" style="background: transparent; border: 2px solid rgba(255,255,255,0.5); color: #fff;">📊 Dự Toán Trả Góp</a>
      </div>
    </div>
  </div>
</section>

<style>
  @media (max-width: 768px) {
    .vf3-compare-grid { grid-template-columns: 1fr !important; }
  }
</style>

<?php get_footer(); ?>
