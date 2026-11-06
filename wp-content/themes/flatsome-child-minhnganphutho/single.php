<?php
/**
 * Single Post Template for VinFast Vĩnh Phúc
 */
defined('ABSPATH') || exit;
get_header();

$uploads_url = content_url('/uploads/official_cars/common/');
?>

<style>
.vf-single-post-wrapper {
  background: #F8FAFC !important;
  font-family: 'Mulish', 'Plus Jakarta Sans', 'Inter', sans-serif !important;
  min-height: 100vh !important;
  padding-bottom: 80px !important;
}

.vf-single-post-hero {
  background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 60%, #2563EB 100%) !important;
  color: #ffffff !important;
  padding: 50px 20px 60px 20px !important;
  text-align: center !important;
}

.vf-single-post-hero-inner {
  max-width: 860px !important;
  margin: 0 auto !important;
}

.vf-single-post-badge {
  display: inline-block !important;
  background: rgba(255, 255, 255, 0.15) !important;
  color: #60A5FA !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  padding: 6px 16px !important;
  border-radius: 20px !important;
  margin-bottom: 12px !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
  text-transform: uppercase !important;
}

.vf-single-post-title {
  font-size: clamp(22px, 4vw, 32px) !important;
  font-weight: 900 !important;
  color: #ffffff !important;
  margin: 0 0 16px 0 !important;
  line-height: 1.3 !important;
}

.vf-single-post-meta {
  font-size: 13px !important;
  color: #94A3B8 !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 16px !important;
  flex-wrap: wrap !important;
}

.vf-single-post-container {
  max-width: 1200px !important;
  margin: -30px auto 0 auto !important;
  padding: 0 20px !important;
  position: relative !important;
  z-index: 10 !important;
  display: grid !important;
  grid-template-columns: 1fr 340px !important;
  gap: 32px !important;
}

.vf-single-post-main {
  background: #ffffff !important;
  border-radius: 20px !important;
  padding: 40px !important;
  box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08) !important;
  border: 1px solid #E2E8F0 !important;
}

.vf-single-post-thumb {
  border-radius: 12px !important;
  overflow: hidden !important;
  margin-bottom: 30px !important;
  box-shadow: 0 10px 25px rgba(0,0,0,0.06) !important;
}

.vf-single-post-thumb img {
  width: 100% !important;
  height: auto !important;
  display: block !important;
}

.vf-single-post-entry-content {
  font-size: 16px !important;
  color: #334155 !important;
  line-height: 1.8 !important;
}

.vf-single-post-entry-content p {
  margin-bottom: 20px !important;
}

.vf-single-post-entry-content h2,
.vf-single-post-entry-content h3 {
  font-size: 20px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 32px 0 16px 0 !important;
}

/* SIDEBAR STYLES */
.vf-single-post-sidebar {
  display: flex !important;
  flex-direction: column !important;
  gap: 24px !important;
}

.vf-sidebar-card {
  background: #ffffff !important;
  border-radius: 16px !important;
  padding: 24px !important;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04) !important;
  border: 1px solid #E2E8F0 !important;
}

.vf-sidebar-card h3 {
  font-size: 16px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 0 0 16px 0 !important;
  text-transform: uppercase !important;
  border-bottom: 2px solid #2563EB !important;
  padding-bottom: 8px !important;
  display: inline-block !important;
}

.vf-sidebar-post-item {
  display: flex !important;
  gap: 12px !important;
  margin-bottom: 16px !important;
  padding-bottom: 16px !important;
  border-bottom: 1px solid #F1F5F9 !important;
}

.vf-sidebar-post-item:last-child {
  margin-bottom: 0 !important;
  padding-bottom: 0 !important;
  border-bottom: none !important;
}

.vf-sidebar-post-thumb {
  width: 70px !important;
  height: 50px !important;
  border-radius: 6px !important;
  overflow: hidden !important;
  flex-shrink: 0 !important;
}

.vf-sidebar-post-thumb img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
}

.vf-sidebar-post-title {
  font-size: 13px !important;
  font-weight: 700 !important;
  line-height: 1.35 !important;
  color: #1E293B !important;
  margin: 0 !important;
}

.vf-sidebar-post-title a {
  color: inherit !important;
  text-decoration: none !important;
}

.vf-sidebar-post-title a:hover {
  color: #2563EB !important;
}

@media (max-width: 991px) {
  .vf-single-post-container {
    grid-template-columns: 1fr !important;
  }
}
</style>

<div class="vf-single-post-wrapper">
  <?php while (have_posts()): the_post(); 
    $post_thumb = get_the_post_thumbnail_url(get_the_ID(), 'full');
  ?>
  <!-- HERO HEADER -->
  <div class="vf-single-post-hero">
    <div class="vf-single-post-hero-inner">
      <span class="vf-single-post-badge">⚡ TIN TỨC VINFAST TÂN Á CHÂU</span>
      <h1 class="vf-single-post-title"><?php the_title(); ?></h1>
      <div class="vf-single-post-meta">
        <span>📅 Ngày đăng: <?php echo get_the_date('d/m/Y'); ?></span>
        <span>✍️ Tác giả: VinFast Tân Á Châu</span>
      </div>
    </div>
  </div>

  <!-- MAIN CONTAINER -->
  <div class="vf-single-post-container">
    
    <!-- LEFT MAIN CONTENT -->
    <main class="vf-single-post-main">
      <?php if ($post_thumb): ?>
      <div class="vf-single-post-thumb">
        <img src="<?php echo esc_url($post_thumb); ?>" alt="<?php the_title_attribute(); ?>">
      </div>
      <?php endif; ?>

      <div class="vf-single-post-entry-content">
        <?php the_content(); ?>
      </div>

      <!-- CTA ACTION BOX -->
      <div style="margin-top: 40px; padding: 24px; background: #EFF6FF; border-radius: 12px; border: 1px solid #BFDBFE; text-align: center;">
        <h4 style="font-size: 17px; font-weight: 800; color: #1E3A8A; margin: 0 0 8px 0;">NHẬN BÁO GIÁ & ƯU ĐÃI XE VINFAST</h4>
        <p style="font-size: 13px; color: #475569; margin: 0 0 16px 0;">Đăng ký ngay hôm nay để nhận bảng giá lăn bánh và chính sách quà tặng tốt nhất tại Vĩnh Phúc.</p>
        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
          <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="vf-btn vf-btn-primary" style="height: 44px;">
            ĐĂNG KÝ LÁI THỬ NGAY
          </a>
          <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>" class="vf-btn vf-btn-outline" style="height: 44px;">
            DỰ TOÁN CHI PHÍ
          </a>
        </div>
      </div>
    </main>

    <!-- RIGHT SIDEBAR -->
    <aside class="vf-single-post-sidebar">
      <div class="vf-sidebar-card">
        <h3>BÀI VIẾT KHÁC</h3>
        <?php
        $other_posts = get_posts([
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'post__not_in'   => [get_the_ID()],
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC'
        ]);

        foreach ($other_posts as $op):
          $op_thumb = get_the_post_thumbnail_url($op->ID, 'thumbnail');
          if (!$op_thumb) $op_thumb = content_url('/uploads/official_cars/common/official_vf8.webp');
        ?>
        <div class="vf-sidebar-post-item">
          <div class="vf-sidebar-post-thumb">
            <a href="<?php echo esc_url(get_permalink($op->ID)); ?>">
              <img src="<?php echo esc_url($op_thumb); ?>" alt="<?php echo esc_attr($op->post_title); ?>">
            </a>
          </div>
          <h4 class="vf-sidebar-post-title">
            <a href="<?php echo esc_url(get_permalink($op->ID)); ?>">
              <?php echo esc_html($op->post_title); ?>
            </a>
          </h4>
        </div>
        <?php endforeach; ?>
      </div>
    </aside>

  </div>
  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
