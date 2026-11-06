<?php
/**
 * VinFast Universal Product Template
 * 
 * Template DUY NHẤT cho TẤT CẢ xe VinFast.
 * Mọi dữ liệu (tên, giá, thông số, ảnh, màu sắc) được đọc từ Custom Fields.
 * Thêm xe mới = tạo product + điền custom fields → tự động có trang đẹp.
 */
defined('ABSPATH') || exit;

global $post, $product;

$post_id   = $post->ID;
$img_folder = get_post_meta($post_id, '_vf_img_folder', true);
if (!$img_folder) $img_folder = str_replace('vinfast-', '', $post->post_name);

// Nếu img_folder đã có prefix 'vinfast-' thì dùng luôn, nếu không thì thêm vào
if (strpos($img_folder, 'vinfast-') === 0) {
    $img_base = get_site_url() . '/wp-content/uploads/' . $img_folder;
} else {
    $img_base = get_site_url() . '/wp-content/uploads/vinfast-' . $img_folder;
}

// ===== ĐỌC DỮ LIỆU TỪ CUSTOM FIELDS =====
$car_name    = get_the_title();
$car_price   = get_post_meta($post_id, '_price', true);
$car_price_f = number_format((float)$car_price, 0, ',', '.');

// Thông số kỹ thuật cơ bản (hiển thị ở Hero)
$hero_specs = get_post_meta($post_id, '_vf_hero_specs', true);
if (!$hero_specs || !is_array($hero_specs)) {
    $hero_specs = array(
        array('label' => 'Động cơ', 'value' => 'Điện - 01 Motor'),
        array('label' => 'Công suất tối đa (kW)', 'value' => '30'),
        array('label' => 'Mô men xoắn cực đại (Nm)', 'value' => '110'),
    );
}

// Màu sắc xe
$car_colors = get_post_meta($post_id, '_vf_colors', true);
if (!$car_colors || !is_array($car_colors)) {
    $car_colors = array(
        array('name' => 'Default', 'hex' => '#87ceeb', 'img' => 'default.png'),
    );
}

// Mô tả tổng quan
$overview_title = get_post_meta($post_id, '_vf_overview_title', true);
$overview_text  = get_post_meta($post_id, '_vf_overview_text', true);
if (!$overview_title) $overview_title = $car_name . ' - Tổng quan';
if (!$overview_text) $overview_text = get_the_excerpt();

// Ngoại thất
$exterior_text  = get_post_meta($post_id, '_vf_exterior_text', true);
$exterior_img   = get_post_meta($post_id, '_vf_exterior_img', true);
$exterior_gallery = get_post_meta($post_id, '_vf_exterior_gallery', true);

// Nội thất
$interior_text  = get_post_meta($post_id, '_vf_interior_text', true);
$interior_img   = get_post_meta($post_id, '_vf_interior_img', true);
$interior_gallery = get_post_meta($post_id, '_vf_interior_gallery', true);

// Vận hành features
$performance_features = get_post_meta($post_id, '_vf_performance', true);

// An toàn features  
$safety_features = get_post_meta($post_id, '_vf_safety', true);

// Thông số kỹ thuật chi tiết (tabs)
$spec_tabs = get_post_meta($post_id, '_vf_spec_tabs', true);

// Thư viện ảnh
$gallery_images = get_post_meta($post_id, '_vf_gallery', true);

// Video banner
$video_banner = get_post_meta($post_id, '_vf_video_banner', true);

// Helper: resolve image URL (uses $img_base set above)
if (!function_exists('vf_img_url_base')) {
    function vf_img_url_base($img, $base) {
        if (strpos($img, 'http') === 0) return $img;
        return $base . '/' . $img;
    }
}
$ib = $img_base; // shorthand for use in template
?>

<!-- ====== HERO SECTION ====== -->
<div class="vf-hero-section">
  <div class="vf-hero-gallery">
    <div class="vf-hero-main-image">
      <img id="vf-main-img" src="<?php echo esc_url(vf_img_url_base($car_colors[0]['img'], $ib)); ?>" alt="<?php echo esc_attr($car_name); ?>">
    </div>
    <div class="vf-hero-colors">
      <p class="label">Màu sắc</p>
      <div class="vf-color-dots">
        <?php foreach ($car_colors as $i => $color): ?>
        <span class="vf-color-dot<?php echo $i === 0 ? ' active' : ''; ?>" 
              style="background:<?php echo esc_attr($color['hex']); ?><?php echo strtolower($color['hex']) === '#ffffff' ? '; border-color:#ccc' : ''; ?>" 
              data-img="<?php echo esc_url(vf_img_url_base($color['img'], $ib)); ?>" 
              data-name="<?php echo esc_attr($color['name']); ?>" 
              title="<?php echo esc_attr($color['name']); ?>"></span>
        <?php endforeach; ?>
      </div>
      <p class="vf-color-name" id="vf-color-name"><?php echo esc_html($car_colors[0]['name']); ?></p>
    </div>
  </div>

  <div class="vf-hero-info">
    <h1><?php echo esc_html($car_name); ?></h1>
    <p class="vf-car-specs-label">Thông tin khác:</p>
    <ul class="vf-car-specs">
      <?php foreach ($hero_specs as $spec): ?>
      <li><strong><?php echo esc_html($spec['label']); ?>:</strong> <?php echo esc_html($spec['value']); ?></li>
      <?php endforeach; ?>
    </ul>

    <div class="vf-price-box">
      <p class="label">Giá xe</p>
      <p class="price"><?php echo esc_html($car_price_f); ?> <span class="currency">₫</span></p>
    </div>

    <div class="vf-cta-buttons">
      <a href="/du-toan-chi-phi/" class="vf-btn-primary">Dự toán chi phí →</a>
      <a href="/dang-ky-lai-thu/" class="vf-btn-secondary">Đăng ký lái thử →</a>
    </div>
  </div>
</div>

<!-- ====== VIDEO BANNER ====== -->
<?php if ($video_banner): ?>
<div class="vf-video-banner" style="background-image: url('<?php echo esc_url(vf_img_url_base($video_banner, $ib)); ?>')">
  <div class="play-btn"></div>
</div>
<?php endif; ?>

<!-- ====== TỔNG QUAN ====== -->
<div class="vf-section vf-section-light" id="tong-quan">
  <div class="container">
    <div class="vf-section-title"><h3>Tổng quan</h3></div>
    <hr class="vf-divider">
    <div class="vf-overview-text">
      <h3><?php echo wp_kses_post($overview_title); ?></h3>
      <?php echo wp_kses_post($overview_text); ?>
    </div>
  </div>
</div>

<!-- ====== THƯ VIỆN ====== -->
<?php if ($gallery_images && is_array($gallery_images)): ?>
<div class="vf-section vf-section-light" id="thu-vien-hinh-anh">
  <div class="container">
    <div class="vf-section-title"><h3>Thư viện</h3></div>
    <hr class="vf-divider">
    <div class="vf-gallery-grid">
      <?php foreach ($gallery_images as $img): ?>
      <img src="<?php echo esc_url(vf_img_url_base($img, $ib)); ?>" alt="<?php echo esc_attr($car_name); ?>">
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ====== NGOẠI THẤT ====== -->
<?php if ($exterior_text): ?>
<div class="vf-section" id="ngoai-that">
  <div class="vf-split-section">
    <div class="vf-split-text">
      <div class="vf-section-title"><h3>Ngoại thất</h3></div>
      <hr class="vf-divider">
      <h2><strong>Ngoại Thất</strong></h2>
      <?php echo wp_kses_post($exterior_text); ?>
    </div>
    <div class="vf-split-image">
      <?php if ($exterior_img): ?>
      <img src="<?php echo esc_url(vf_img_url_base($exterior_img, $ib)); ?>" alt="<?php echo esc_attr($car_name); ?> Ngoại thất">
      <?php endif; ?>
    </div>
  </div>
  <?php if ($exterior_gallery && is_array($exterior_gallery)): ?>
  <div class="vf-sub-gallery">
    <?php foreach ($exterior_gallery as $img): ?>
    <img src="<?php echo esc_url(vf_img_url_base($img, $ib)); ?>" alt="">
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- ====== NỘI THẤT ====== -->
<?php if ($interior_text): ?>
<div class="vf-section" id="noi-that">
  <div class="vf-split-section">
    <div class="vf-split-text">
      <div class="vf-section-title"><h3>Nội thất</h3></div>
      <hr class="vf-divider">
      <h2><strong>Nội Thất</strong></h2>
      <?php echo wp_kses_post($interior_text); ?>
    </div>
    <div class="vf-split-image">
      <?php if ($interior_img): ?>
      <img src="<?php echo esc_url(vf_img_url_base($interior_img, $ib)); ?>" alt="<?php echo esc_attr($car_name); ?> Nội thất">
      <?php endif; ?>
    </div>
  </div>
  <?php if ($interior_gallery && is_array($interior_gallery)): ?>
  <div class="vf-sub-gallery">
    <?php foreach ($interior_gallery as $img): ?>
    <img src="<?php echo esc_url(vf_img_url_base($img, $ib)); ?>" alt="">
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

<!-- ====== VẬN HÀNH ====== -->
<?php if ($performance_features && is_array($performance_features)): ?>
<div class="vf-section vf-section-light" id="van-hanh">
  <div class="container">
    <div class="vf-section-title"><h3>Vận hành</h3></div>
    <hr class="vf-divider">
    <div class="vf-feature-grid">
      <?php foreach ($performance_features as $feat): ?>
      <div class="vf-feature-card">
        <?php if (!empty($feat['img'])): ?>
        <img src="<?php echo esc_url(vf_img_url_base($feat['img'], $ib)); ?>" alt="<?php echo esc_attr($feat['title']); ?>">
        <?php endif; ?>
        <div class="card-body">
          <h4><?php echo esc_html($feat['title']); ?></h4>
          <p><?php echo esc_html($feat['desc']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ====== AN TOÀN ====== -->
<?php if ($safety_features && is_array($safety_features)): ?>
<div class="vf-section vf-section-light" id="an-toan">
  <div class="container">
    <div class="vf-section-title"><h3>An toàn</h3></div>
    <hr class="vf-divider">
    <div class="vf-feature-grid">
      <?php foreach ($safety_features as $feat): ?>
      <div class="vf-feature-card">
        <?php if (!empty($feat['img'])): ?>
        <img src="<?php echo esc_url(vf_img_url_base($feat['img'], $ib)); ?>" alt="<?php echo esc_attr($feat['title']); ?>">
        <?php endif; ?>
        <div class="card-body">
          <h4><?php echo esc_html($feat['title']); ?></h4>
          <p><?php echo esc_html($feat['desc']); ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ====== THÔNG SỐ KỸ THUẬT ====== -->
<?php if ($spec_tabs && is_array($spec_tabs)): ?>
<div class="vf-specs-section" id="thong-so-ky-thuat">
  <div class="container">
    <div class="vf-section-title"><h3>Thông số kỹ thuật</h3></div>
    <hr class="vf-divider">

    <div class="vf-specs-tabs">
      <?php foreach ($spec_tabs as $i => $tab): ?>
      <button class="<?php echo $i === 0 ? 'active' : ''; ?>" data-tab="spec-tab-<?php echo $i; ?>"><?php echo esc_html($tab['title']); ?></button>
      <?php endforeach; ?>
    </div>

    <div class="vf-specs-content">
      <?php foreach ($spec_tabs as $i => $tab): ?>
      <div class="vf-specs-panel<?php echo $i === 0 ? ' active' : ''; ?>" id="spec-tab-<?php echo $i; ?>">
        <h3><?php echo esc_html($tab['title']); ?></h3>
        <ul>
          <?php foreach ($tab['items'] as $item): ?>
          <li><strong><?php echo esc_html($item['label']); ?>:</strong> <?php echo esc_html($item['value']); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ====== JavaScript ====== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Color selector
  document.querySelectorAll('.vf-color-dot').forEach(function(dot) {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf-color-dot').forEach(function(d) { d.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById('vf-main-img').src = this.dataset.img;
      document.getElementById('vf-color-name').textContent = this.dataset.name;
    });
  });
  // Specs tabs
  document.querySelectorAll('.vf-specs-tabs button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.vf-specs-tabs button').forEach(function(b) { b.classList.remove('active'); });
      document.querySelectorAll('.vf-specs-panel').forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById(this.dataset.tab).classList.add('active');
    });
  });
});
</script>
