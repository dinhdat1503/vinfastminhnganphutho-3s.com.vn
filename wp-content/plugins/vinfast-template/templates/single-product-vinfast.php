<?php
/**
 * Template Name: VinFast Product Page Template
 * Template hiển thị chi tiết sản phẩm ô tô VinFast (WooCommerce Product)
 * Khớp chuẩn 100% bố cục trang mẫu shop.vinfastauto.com với thiết kế Wow & Premium
 */

if (!defined('ABSPATH')) exit;

global $post, $product;
if (!$product || !is_a($product, 'WC_Product')) {
    $product = wc_get_product($post->ID);
}

$post_id  = $post->ID;
$car_name = get_the_title($post_id);

// Lấy custom fields (_vf_*)
$img_folder     = get_post_meta($post_id, '_vf_img_folder', true) ?: 'vinfast-' . sanitize_title($car_name);
$hero_specs     = get_post_meta($post_id, '_vf_hero_specs', true) ?: array();
$colors         = get_post_meta($post_id, '_vf_colors', true) ?: array();
$overview_title = get_post_meta($post_id, '_vf_overview_title', true) ?: '';
$overview_text  = get_post_meta($post_id, '_vf_overview_text', true) ?: '';
$video_banner   = get_post_meta($post_id, '_vf_video_banner', true) ?: '';
$gallery        = get_post_meta($post_id, '_vf_gallery', true) ?: array();
$exterior_text  = get_post_meta($post_id, '_vf_exterior_text', true) ?: '';
$exterior_img   = get_post_meta($post_id, '_vf_exterior_img', true) ?: '';
$exterior_gal   = get_post_meta($post_id, '_vf_exterior_gallery', true) ?: array();
$interior_text  = get_post_meta($post_id, '_vf_interior_text', true) ?: '';
$interior_img   = get_post_meta($post_id, '_vf_interior_img', true) ?: '';
$interior_gal   = get_post_meta($post_id, '_vf_interior_gallery', true) ?: array();
$performance    = get_post_meta($post_id, '_vf_performance', true) ?: array();
$safety         = get_post_meta($post_id, '_vf_safety', true) ?: array();
$spec_tabs      = get_post_meta($post_id, '_vf_spec_tabs', true) ?: array();
$versions       = get_post_meta($post_id, '_vf_versions', true) ?: array();

// Giá WooCommerce
$regular_price  = $product ? $product->get_regular_price() : get_post_meta($post_id, '_regular_price', true);

// Ảnh Hero Banner
$hero_image_url = get_the_post_thumbnail_url($post_id, 'full');
if (!$hero_image_url && $video_banner) {
    $hero_image_url = vf_img_url($img_folder, $video_banner);
}
if (!$hero_image_url && !empty($colors[0]['img'])) {
    $hero_image_url = vf_img_url($img_folder, $colors[0]['img']);
}

$deposit_url = home_url('/dat-coc/');
get_header(); 
?>

<div class="vf-product-vinfast-page">

  <!-- ============================================================
       STICKY SUBNAV
       ============================================================ -->
  <nav class="vf-car-subnav" id="vf-car-subnav">
    <div class="container vf-subnav-inner">
      <a class="vf-car-subnav-logo" href="<?php the_permalink(); ?>">
        <span class="vf-subnav-vlogo">⚡</span> <?php echo esc_html($car_name); ?>
      </a>

      <div class="vf-car-subnav-tabs" role="tablist">
        <a class="vf-car-subnav-tab active" href="#tong-quan">Tổng quan</a>
        <a class="vf-car-subnav-tab" href="#mau-sac">Màu sắc</a>
        <a class="vf-car-subnav-tab" href="#ngoai-that">Ngoại thất</a>
        <a class="vf-car-subnav-tab" href="#noi-that">Nội thất</a>
        <a class="vf-car-subnav-tab" href="#van-hanh">Vận hành</a>
        <a class="vf-car-subnav-tab" href="#an-toan">An toàn</a>
        <a class="vf-car-subnav-tab" href="#thong-so">Thông số</a>
      </div>

      <div class="vf-car-subnav-cta">
        <a href="<?php echo esc_url($deposit_url); ?>" class="vf-btn vf-btn-primary">
          ĐẶT CỌC NGAY
        </a>
      </div>
    </div>
  </nav>

  <!-- ============================================================
       1. HERO BANNER SECTION (High Impact)
       ============================================================ -->
  <section class="vf-hero-banner" id="hero">
    <div class="vf-hero-bg">
      <?php if ($hero_image_url): ?>
        <img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($car_name); ?>" loading="eager">
      <?php endif; ?>
      <div class="vf-hero-overlay"></div>
    </div>

    <div class="container vf-hero-content">
      <div class="vf-hero-badge">Ô TÔ ĐIỆN THÔNG MINH VINFAST</div>
      <h1 class="vf-hero-title"><?php echo esc_html($car_name); ?></h1>
      
      <?php if ($overview_title): ?>
        <p class="vf-hero-subtitle"><?php echo esc_html($overview_title); ?></p>
      <?php endif; ?>

      <div class="vf-hero-price-tag">
        <span class="lbl">Giá bán từ</span>
        <span class="val"><?php echo vfvp_format_price($regular_price); ?></span>
      </div>

      <div class="vf-hero-actions">
        <a href="<?php echo esc_url($deposit_url); ?>" class="vf-btn vf-btn-primary vf-btn-lg">
          ĐẶT CỌC (15.000.000 VNĐ)
        </a>
        <button class="vf-btn vf-btn-outline-light vf-btn-lg" onclick="vfOpenModal('modal-laythu')">
          ĐĂNG KÝ LÁI THỬ
        </button>
      </div>

      <?php if (!empty($hero_specs)): ?>
      <div class="vf-hero-stats-bar">
        <?php foreach (array_slice($hero_specs, 0, 4) as $hs): ?>
          <div class="vf-hero-stat-item">
            <span class="vf-stat-val"><?php echo esc_html($hs['value']); ?></span>
            <span class="vf-stat-lbl"><?php echo esc_html($hs['label']); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ============================================================
       2. TỔNG QUAN & PHIÊN BẢN (PRICING & VERSIONS)
       ============================================================ -->
  <section class="vf-section vf-overview-section" id="tong-quan">
    <div class="container">
      <div class="vf-section-header">
        <h2 class="vf-section-title"><?php echo esc_html($car_name); ?> - Tổng Quan & Giá Bán</h2>
        <div class="vf-section-desc">
          <?php echo $overview_text ? $overview_text : '<p>Mẫu xe điện tiên phong công nghệ với khả năng vận hành mạnh mẽ và thiết kế hiện đại.</p>'; ?>
        </div>
      </div>

      <!-- Multi-version Pricing Grid -->
      <div class="vf-versions-wrapper">
        <?php if (!empty($versions)): ?>
          <div class="vf-versions-grid">
            <?php foreach ($versions as $v):
              $vname   = $v['name'] ?? '';
              $vp_rent = $v['price_rent'] ?? 0;
              $vp_buy  = $v['price_buy'] ?? $regular_price;
              $vimg    = !empty($v['img']) ? vf_img_url($img_folder, $v['img']) : $hero_image_url;
            ?>
            <div class="vf-version-card">
              <div class="vf-version-badge">PHIÊN BẢN</div>
              <h3 class="vf-version-title"><?php echo esc_html($car_name . ' ' . $vname); ?></h3>
              <div class="vf-version-img">
                <img src="<?php echo esc_url($vimg); ?>" alt="<?php echo esc_attr($vname); ?>" loading="lazy">
              </div>
              <div class="vf-version-pricing">
                <?php if ($vp_rent > 0): ?>
                  <div class="price-row">
                    <span class="p-type">Thuê pin:</span>
                    <span class="p-val"><?php echo vfvp_format_price($vp_rent); ?></span>
                  </div>
                <?php endif; ?>
                <div class="price-row highlight">
                  <span class="p-type">Mua pin (kèm pin):</span>
                  <span class="p-val"><?php echo vfvp_format_price($vp_buy); ?></span>
                </div>
              </div>
              <div class="vf-version-cta">
                <a href="<?php echo esc_url($deposit_url); ?>" class="vf-btn vf-btn-primary block">
                  ĐẶT CỌC NGAY
                </a>
                <button class="vf-btn vf-btn-outline block" onclick="vfOpenModal('modal-laythu')">
                  NHẬN TƯ VẤN ƯU ĐÃI
                </button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <!-- Default single version view -->
          <div class="vf-versions-grid single-v">
            <div class="vf-version-card featured">
              <div class="vf-version-badge">GIÁ BÁN NIÊM YẾT CHÍNH THỨC</div>
              <h3 class="vf-version-title"><?php echo esc_html($car_name); ?></h3>
              <div class="vf-version-price-large">
                <?php echo vfvp_format_price($regular_price); ?>
              </div>
              <p style="color: #64748B; font-size: 14px; margin-bottom: 24px;">
                * Giá đã bao gồm VAT. Ưu đãi miễn phí 100% lệ phí trước bạ & ưu đãi pin chính hãng VinFast.
              </p>
              <div class="vf-version-cta flex-cta">
                <a href="<?php echo esc_url($deposit_url); ?>" class="vf-btn vf-btn-primary vf-btn-lg">
                  ĐẶT CỌC NGAY
                </a>
                <button class="vf-btn vf-btn-outline vf-btn-lg" onclick="vfOpenModal('modal-laythu')">
                  ĐĂNG KÝ LÁI THỬ & TƯ VẤN
                </button>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================================================
       3. COLOR VISUALIZER (MÀU SẮC PHIÊN BẢN)
       ============================================================ -->
  <?php if (!empty($colors)): ?>
  <section class="vf-section vf-color-section" id="mau-sac">
    <div class="container">
      <div class="vf-section-header text-center">
        <h2 class="vf-section-title">Bảng Màu Sắc Ngoại Thất</h2>
        <p class="vf-section-desc">Khám phá các sắc màu thời thượng thể hiện cá tính riêng của bạn cùng <?php echo esc_html($car_name); ?></p>
      </div>

      <!-- Visualizer Stage -->
      <div class="vf-visualizer-stage">
        <div class="vf-visualizer-img-wrap">
          <?php 
            $first_color_img = vf_img_url($img_folder, $colors[0]['img'] ?? '');
            if (!$first_color_img) $first_color_img = $hero_image_url;
          ?>
          <img src="<?php echo esc_url($first_color_img); ?>" 
               alt="<?php echo esc_attr($colors[0]['name'] ?? $car_name); ?>" 
               id="vf-active-color-img"
               loading="lazy">
        </div>

        <div class="vf-color-badge-wrap">
          <span class="vf-color-badge" id="vf-active-color-name">
            <?php echo esc_html($colors[0]['name'] ?? ''); ?>
          </span>
        </div>

        <!-- Color Swatches Dots -->
        <div class="vf-color-dots-bar">
          <?php foreach ($colors as $idx => $c):
            $c_name = $c['name'] ?? 'Màu ' . ($idx + 1);
            $c_hex  = $c['hex'] ?? '#CCCCCC';
            $c_img  = vf_img_url($img_folder, $c['img'] ?? '');
          ?>
          <button class="vf-color-dot <?php echo $idx === 0 ? 'active' : ''; ?>"
                  style="background-color: <?php echo esc_attr($c_hex); ?>;"
                  data-img="<?php echo esc_attr($c_img); ?>"
                  data-name="<?php echo esc_attr($c_name); ?>"
                  title="<?php echo esc_attr($c_name); ?>"
                  aria-label="<?php echo esc_attr($c_name); ?>">
          </button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============================================================
       4. NGOẠI THẤT & NỘI THẤT HIGHLIGHTS
       ============================================================ -->
  <?php if ($exterior_text || $exterior_img || !empty($exterior_gal)): ?>
  <section class="vf-section vf-gallery-section" id="ngoai-that">
    <div class="container">
      <div class="vf-section-header">
        <h2 class="vf-section-title">Thiết Kế Ngoại Thất Bold & Modern</h2>
        <div class="vf-section-desc"><?php echo $exterior_text; ?></div>
      </div>

      <?php if ($exterior_img): ?>
      <div class="vf-big-feature-banner">
        <img src="<?php echo esc_url(vf_img_url($img_folder, $exterior_img)); ?>" alt="Ngoại thất <?php echo esc_attr($car_name); ?>" loading="lazy">
      </div>
      <?php endif; ?>

      <?php if (!empty($exterior_gal)): ?>
      <div class="vf-grid-gallery">
        <?php foreach ($exterior_gal as $gimg): 
          $gurl = vf_img_url($img_folder, $gimg);
          if (!$gurl) continue;
        ?>
        <div class="vf-gallery-card">
          <a href="<?php echo esc_url($gurl); ?>" class="glightbox" data-gallery="exterior">
            <img src="<?php echo esc_url($gurl); ?>" alt="Ngoại thất <?php echo esc_attr($car_name); ?>" loading="lazy">
            <div class="vf-gallery-overlay"><span class="icon">🔍</span></div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <?php if ($interior_text || $interior_img || !empty($interior_gal)): ?>
  <section class="vf-section vf-section-alt vf-gallery-section" id="noi-that">
    <div class="container">
      <div class="vf-section-header">
        <h2 class="vf-section-title">Không Gian Nội Thất Tiện Nghi & Số Hóa</h2>
        <div class="vf-section-desc"><?php echo $interior_text; ?></div>
      </div>

      <?php if ($interior_img): ?>
      <div class="vf-big-feature-banner">
        <img src="<?php echo esc_url(vf_img_url($img_folder, $interior_img)); ?>" alt="Nội thất <?php echo esc_attr($car_name); ?>" loading="lazy">
      </div>
      <?php endif; ?>

      <?php if (!empty($interior_gal)): ?>
      <div class="vf-grid-gallery">
        <?php foreach ($interior_gal as $gimg): 
          $gurl = vf_img_url($img_folder, $gimg);
          if (!$gurl) continue;
        ?>
        <div class="vf-gallery-card">
          <a href="<?php echo esc_url($gurl); ?>" class="glightbox" data-gallery="interior">
            <img src="<?php echo esc_url($gurl); ?>" alt="Nội thất <?php echo esc_attr($car_name); ?>" loading="lazy">
            <div class="vf-gallery-overlay"><span class="icon">🔍</span></div>
          </a>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============================================================
       5. VẬN HÀNH & HIỆU NĂNG
       ============================================================ -->
  <?php if (!empty($performance)): ?>
  <section class="vf-section" id="van-hanh">
    <div class="container">
      <div class="vf-section-header text-center">
        <h2 class="vf-section-title">Khả Năng Vận Hành Đỉnh Cao</h2>
        <p class="vf-section-desc">Sẵn sàng vượt qua mọi hành trình cùng công nghệ động cơ điện tiên phong</p>
      </div>

      <div class="vf-perf-grid">
        <?php foreach ($performance as $p): 
          $pimg = !empty($p['img']) ? vf_img_url($img_folder, $p['img']) : '';
        ?>
        <div class="vf-perf-card">
          <?php if ($pimg): ?>
            <div class="vf-perf-card-img">
              <img src="<?php echo esc_url($pimg); ?>" alt="<?php echo esc_attr($p['title'] ?? ''); ?>" loading="lazy">
            </div>
          <?php endif; ?>
          <div class="vf-perf-card-body">
            <h3 class="vf-perf-card-title"><?php echo esc_html($p['title'] ?? ''); ?></h3>
            <p class="vf-perf-card-desc"><?php echo esc_html($p['desc'] ?? ''); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============================================================
       6. AN TOÀN VƯỢT TRỘI
       ============================================================ -->
  <?php if (!empty($safety)): ?>
  <section class="vf-section vf-section-alt" id="an-toan">
    <div class="container">
      <div class="vf-section-header text-center">
        <h2 class="vf-section-title">An Toàn Tuyệt Đối Cho Mọi Hành Trình</h2>
        <p class="vf-section-desc">Đáp ứng tiêu chuẩn an toàn cao nhất từ các tổ chức đánh giá uy tín quốc tế</p>
      </div>

      <div class="vf-safety-grid">
        <?php foreach ($safety as $s): 
          $simg = !empty($s['img']) ? vf_img_url($img_folder, $s['img']) : '';
        ?>
        <div class="vf-safety-card">
          <?php if ($simg): ?>
            <div class="vf-safety-img">
              <img src="<?php echo esc_url($simg); ?>" alt="<?php echo esc_attr($s['title'] ?? ''); ?>" loading="lazy">
            </div>
          <?php endif; ?>
          <h3 class="vf-safety-title"><?php echo esc_html($s['title'] ?? ''); ?></h3>
          <p class="vf-safety-desc"><?php echo esc_html($s['desc'] ?? ''); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ============================================================
       7. THÔNG SỐ KỸ THUẬT CHI TIẾT
       ============================================================ -->
  <section class="vf-section" id="thong-so">
    <div class="container">
      <div class="vf-section-header text-center">
        <h2 class="vf-section-title">Thông Số Kỹ Thuật Chi Tiết</h2>
        <p class="vf-section-desc">Bảng tra cứu thông số đầy đủ của <?php echo esc_html($car_name); ?></p>
      </div>

      <?php if (!empty($hero_specs)): ?>
      <div class="vf-specs-summary-grid">
        <?php foreach ($hero_specs as $hs): ?>
        <div class="vf-spec-box">
          <span class="vf-spec-val"><?php echo esc_html($hs['value']); ?></span>
          <span class="vf-spec-lbl"><?php echo esc_html($hs['label']); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <?php if (!empty($spec_tabs)): ?>
      <div class="vf-spec-tabs-wrapper">
        <div class="vf-spec-tabs-nav" role="tablist">
          <?php foreach ($spec_tabs as $ti => $st): ?>
          <button class="vf-spec-tab-btn <?php echo $ti === 0 ? 'active' : ''; ?>"
                  data-target="spec-tab-<?php echo $ti; ?>" role="tab">
            <?php echo esc_html($st['title'] ?? 'Hạng mục ' . ($ti + 1)); ?>
          </button>
          <?php endforeach; ?>
        </div>

        <?php foreach ($spec_tabs as $ti => $st): ?>
        <div class="vf-spec-tab-panel <?php echo $ti === 0 ? 'active' : ''; ?>" id="spec-tab-<?php echo $ti; ?>">
          <table class="vf-spec-table">
            <tbody>
              <?php foreach (($st['items'] ?? array()) as $item): ?>
              <tr>
                <td class="lbl"><?php echo esc_html($item['label'] ?? ''); ?></td>
                <td class="val"><?php echo esc_html($item['value'] ?? ''); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ============================================================
       8. CTA CUỐI TRANG & FORM ĐĂNG KÝ
       ============================================================ -->
  <section class="vf-cta-banner-bottom">
    <div class="container text-center">
      <h2 class="vf-cta-heading">Sẵn Sàng Trải Nghiệm <?php echo esc_html($car_name); ?>?</h2>
      <p class="vf-cta-subheading">Liên hệ ngay Showroom VinFast Vĩnh Phúc để nhận tư vấn, báo giá và ưu đãi độc quyền.</p>
      <div class="vf-cta-btns">
        <a href="<?php echo esc_url($deposit_url); ?>" class="vf-btn vf-btn-primary vf-btn-lg">
          ĐẶT CỌC NGAY
        </a>
        <button class="vf-btn vf-btn-outline-light vf-btn-lg" onclick="vfOpenModal('modal-laythu')">
          ĐĂNG KÝ TƯ VẤN & LÁI THỬ
        </button>
      </div>
    </div>
  </section>

  <!-- MODAL FORM -->
  <div class="vf-modal-overlay" id="modal-laythu" onclick="if(event.target===this)vfCloseModal('modal-laythu')">
    <div class="vf-modal" role="dialog" aria-modal="true" aria-label="Đăng ký tư vấn">
      <button class="vf-modal-close" onclick="vfCloseModal('modal-laythu')" aria-label="Đóng">×</button>
      <div class="vf-modal-header">
        <h3 class="vf-modal-title">Đăng Ký Nhận Báo Giá & Ưu Đãi</h3>
        <p class="vf-modal-subtitle">VinFast Vĩnh Phúc sẽ liên hệ hỗ trợ bạn ngay lập tức</p>
      </div>
      <div class="vf-modal-body">
        <form id="vf-quick-form" onsubmit="event.preventDefault(); alert('Cảm ơn bạn! Thông tin đã được gửi tới Showroom VinFast Vĩnh Phúc.'); vfCloseModal('modal-laythu');">
          <input type="hidden" name="car_model" value="<?php echo esc_attr($car_name); ?>">
          <div style="margin-bottom:14px;">
            <label style="display:block; font-size:12px; font-weight:600; color:#475569; margin-bottom:4px;">Họ và tên *</label>
            <input type="text" placeholder="Nguyễn Văn A" required style="width:100%; padding:10px 14px; border:1px solid #CBD5E1; border-radius:6px; font-size:14px;">
          </div>
          <div style="margin-bottom:14px;">
            <label style="display:block; font-size:12px; font-weight:600; color:#475569; margin-bottom:4px;">Số điện thoại *</label>
            <input type="tel" placeholder="0900 000 000" required style="width:100%; padding:10px 14px; border:1px solid #CBD5E1; border-radius:6px; font-size:14px;">
          </div>
          <div style="margin-bottom:14px;">
            <label style="display:block; font-size:12px; font-weight:600; color:#475569; margin-bottom:4px;">Dòng xe quan tâm</label>
            <input type="text" value="<?php echo esc_attr($car_name); ?>" readonly style="width:100%; padding:10px 14px; border:1px solid #E2E8F0; background:#F8FAFC; border-radius:6px; font-size:14px;">
          </div>
          <button type="submit" class="vf-btn vf-btn-primary" style="width:100%; padding:12px; font-size:15px; margin-top:10px;">
            GỬI YÊU CẦU BÁO GIÁ
          </button>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- INLINE SCRIPT -->
<script>
(function() {
  const dots = document.querySelectorAll('.vf-color-dot');
  const img  = document.getElementById('vf-active-color-img');
  const lbl  = document.getElementById('vf-active-color-name');

  dots.forEach(dot => {
    dot.addEventListener('click', function() {
      dots.forEach(d => d.classList.remove('active'));
      this.classList.add('active');
      if (img && this.dataset.img) {
        img.style.opacity = '0.3';
        img.style.transform = 'scale(0.98)';
        setTimeout(() => {
          img.src = this.dataset.img;
          img.style.opacity = '1';
          img.style.transform = 'scale(1)';
        }, 200);
      }
      if (lbl) lbl.textContent = this.dataset.name || '';
    });
  });
})();

(function() {
  const btns = document.querySelectorAll('.vf-spec-tab-btn');
  btns.forEach(btn => {
    btn.addEventListener('click', function() {
      btns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      document.querySelectorAll('.vf-spec-tab-panel').forEach(p => p.classList.remove('active'));
      const target = document.getElementById(this.dataset.target);
      if (target) target.classList.add('active');
    });
  });
})();

function vfOpenModal(id) {
  const m = document.getElementById(id);
  if (m) {
    m.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
}
function vfCloseModal(id) {
  const m = document.getElementById(id);
  if (m) {
    m.classList.remove('open');
    document.body.style.overflow = '';
  }
}

(function() {
  const tabs = document.querySelectorAll('.vf-car-subnav-tab');
  tabs.forEach(t => {
    t.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const elem = document.getElementById(targetId);
      if (elem) {
        const offset = 80;
        const bodyRect = document.body.getBoundingClientRect().top;
        const elemRect = elem.getBoundingClientRect().top;
        const elemPosition = elemRect - bodyRect;
        const offsetPosition = elemPosition - offset;

        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });
})();
</script>

<?php get_footer(); ?>
