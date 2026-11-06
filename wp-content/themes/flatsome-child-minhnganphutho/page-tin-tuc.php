<?php
/**
 * Template Name: Tin tức & Sự kiện VinFast Vĩnh Phúc
 */
defined('ABSPATH') || exit;
get_header();

$uploads_url = content_url('/uploads/official_cars/common/');
?>

<style>
.vf-news-page-wrapper {
  background: #F8FAFC !important;
  font-family: 'Mulish', 'Plus Jakarta Sans', 'Inter', sans-serif !important;
  min-height: 100vh !important;
  padding-bottom: 80px !important;
}

.vf-news-hero {
  background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 60%, #2563EB 100%) !important;
  color: #ffffff !important;
  padding: 50px 20px 60px 20px !important;
  text-align: center !important;
}

.vf-news-hero-inner {
  max-width: 800px !important;
  margin: 0 auto !important;
}

.vf-news-badge {
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

.vf-news-hero-title {
  font-size: 32px !important;
  font-weight: 900 !important;
  color: #ffffff !important;
  margin: 0 0 12px 0 !important;
  text-transform: uppercase !important;
  letter-spacing: -0.5px !important;
}

.vf-news-hero-subtitle {
  font-size: 15px !important;
  color: #94A3B8 !important;
  margin: 0 !important;
  line-height: 1.6 !important;
}

.vf-news-container {
  max-width: 1200px !important;
  margin: -30px auto 0 auto !important;
  padding: 0 20px !important;
  position: relative !important;
  z-index: 10 !important;
}

/* FEATURED POST HERO CARD */
.vf-featured-news-card {
  background: #ffffff !important;
  border-radius: 20px !important;
  overflow: hidden !important;
  box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08) !important;
  border: 1px solid #E2E8F0 !important;
  display: grid !important;
  grid-template-columns: 1.2fr 1fr !important;
  margin-bottom: 40px !important;
}

.vf-featured-news-img {
  height: 100% !important;
  min-height: 320px !important;
  position: relative !important;
  overflow: hidden !important;
}

.vf-featured-news-img img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.5s ease !important;
}

.vf-featured-news-card:hover .vf-featured-news-img img {
  transform: scale(1.05) !important;
}

.vf-featured-news-content {
  padding: 40px !important;
  display: flex !important;
  flex-direction: column !important;
  justify-content: center !important;
}

.vf-featured-news-tag {
  display: inline-block !important;
  background: #EFF6FF !important;
  color: #2563EB !important;
  font-size: 11px !important;
  font-weight: 800 !important;
  padding: 4px 10px !important;
  border-radius: 12px !important;
  text-transform: uppercase !important;
  margin-bottom: 12px !important;
  width: fit-content !important;
}

.vf-featured-news-date {
  font-size: 13px !important;
  color: #64748B !important;
  font-weight: 600 !important;
  margin-bottom: 8px !important;
}

.vf-featured-news-title {
  font-size: 22px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  line-height: 1.35 !important;
  margin: 0 0 14px 0 !important;
}

.vf-featured-news-title a {
  color: inherit !important;
  text-decoration: none !important;
}

.vf-featured-news-title a:hover {
  color: #2563EB !important;
}

.vf-featured-news-excerpt {
  font-size: 14px !important;
  color: #475569 !important;
  line-height: 1.6 !important;
  margin: 0 0 24px 0 !important;
}

/* NEWS GRID */
.vf-news-list-title {
  font-size: 20px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 0 0 24px 0 !important;
  text-transform: uppercase !important;
  display: flex !important;
  align-items: center !important;
  gap: 10px !important;
}

.vf-news-list-title::before {
  content: '';
  display: inline-block;
  width: 4px;
  height: 20px;
  background: #2563EB;
  border-radius: 2px;
}

.vf-news-cards-grid {
  display: grid !important;
  grid-template-columns: repeat(3, 1fr) !important;
  gap: 24px !important;
}

.vf-news-card-item {
  background: #ffffff !important;
  border-radius: 16px !important;
  overflow: hidden !important;
  border: 1px solid #E2E8F0 !important;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03) !important;
  display: flex !important;
  flex-direction: column !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease !important;
}

.vf-news-card-item:hover {
  transform: translateY(-5px) !important;
  box-shadow: 0 20px 35px rgba(37, 99, 235, 0.1) !important;
  border-color: #BFDBFE !important;
}

.vf-news-card-thumb {
  height: 200px !important;
  overflow: hidden !important;
  position: relative !important;
  background: #F1F5F9 !important;
}

.vf-news-card-thumb img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  transition: transform 0.4s ease !important;
}

.vf-news-card-item:hover .vf-news-card-thumb img {
  transform: scale(1.08) !important;
}

.vf-news-card-body {
  padding: 24px !important;
  display: flex !important;
  flex-direction: column !important;
  flex: 1 !important;
}

.vf-news-card-meta {
  font-size: 12px !important;
  color: #64748B !important;
  font-weight: 600 !important;
  margin-bottom: 8px !important;
}

.vf-news-card-h3 {
  font-size: 16px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  line-height: 1.4 !important;
  margin: 0 0 10px 0 !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 2 !important;
  -webkit-box-orient: vertical !important;
  overflow: hidden !important;
}

.vf-news-card-h3 a {
  color: inherit !important;
  text-decoration: none !important;
}

.vf-news-card-h3 a:hover {
  color: #2563EB !important;
}

.vf-news-card-desc {
  font-size: 13px !important;
  color: #64748B !important;
  line-height: 1.6 !important;
  margin: 0 0 18px 0 !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 3 !important;
  -webkit-box-orient: vertical !important;
  overflow: hidden !important;
  flex: 1 !important;
}

.vf-news-card-readmore {
  font-size: 13px !important;
  font-weight: 700 !important;
  color: #2563EB !important;
  text-decoration: none !important;
  display: inline-flex !important;
  align-items: center !important;
  gap: 4px !important;
}

.vf-news-card-readmore:hover {
  color: #1D4ED8 !important;
}

@media (max-width: 991px) {
  .vf-featured-news-card {
    grid-template-columns: 1fr !important;
  }
  .vf-news-cards-grid {
    grid-template-columns: repeat(2, 1fr) !important;
  }
}

@media (max-width: 600px) {
  .vf-news-cards-grid {
    grid-template-columns: 1fr !important;
  }
  .vf-featured-news-content {
    padding: 24px !important;
  }
}
</style>

<div class="vf-news-page-wrapper">
  <!-- HERO HEADER -->
  <div class="vf-news-hero">
    <div class="vf-news-hero-inner">
      <span class="vf-news-badge">⚡ CHÍNH THỨC TỪ VINFAST TÂN Á CHÂU</span>
      <h1 class="vf-news-hero-title">TIN TỨC & SỰ KIỆN VINFAST</h1>
      <p class="vf-news-hero-subtitle">
        Cập nhật thông tin ưu đãi, chương trình khuyến mãi, sự kiện lái thử và tin tức ô tô điện VinFast mới nhất.
      </p>
    </div>
  </div>

  <!-- MAIN NEWS CONTAINER -->
  <div class="vf-news-container">
    <?php
    $all_posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => 20,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    ]);

    if (!empty($all_posts)):
      $featured_post = $all_posts[0];
      $grid_posts     = array_slice($all_posts, 1);

      $feat_thumb = get_the_post_thumbnail_url($featured_post->ID, 'full');
      if (!$feat_thumb) {
          $feat_thumb = content_url('/uploads/official_cars/common/manh_liet_tinh_than_viet_nam.png');
      }
    ?>

    <!-- 1. FEATURED HERO ARTICLE CARD -->
    <div class="vf-featured-news-card">
      <div class="vf-featured-news-img">
        <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
          <img src="<?php echo esc_url($feat_thumb); ?>" alt="<?php echo esc_attr($featured_post->post_title); ?>">
        </a>
      </div>
      <div class="vf-featured-news-content">
        <span class="vf-featured-news-tag">🔥 BÀI VIẾT NỔI BẬT</span>
        <div class="vf-featured-news-date">
          📅 <?php echo get_the_date('d/m/Y', $featured_post->ID); ?> | VinFast Tân Á Châu
        </div>
        <h2 class="vf-featured-news-title">
          <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
            <?php echo esc_html($featured_post->post_title); ?>
          </a>
        </h2>
        <p class="vf-featured-news-excerpt">
          <?php echo esc_html(get_the_excerpt($featured_post->ID) ?: wp_trim_words($featured_post->post_content, 30)); ?>
        </p>
        <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>" class="vf-btn vf-btn-primary" style="width:fit-content; height:44px;">
          ĐỌC BÀI VIẾT NÀY →
        </a>
      </div>
    </div>

    <!-- 2. OTHER ARTICLES GRID -->
    <?php if (!empty($grid_posts)): ?>
    <h3 class="vf-news-list-title">TẤT CẢ BÀI VIẾT MỚI NHẤT</h3>
    <div class="vf-news-cards-grid">
      <?php foreach ($grid_posts as $post_item): 
        $thumb = get_the_post_thumbnail_url($post_item->ID, 'medium_large');
        if (!$thumb) {
            $thumb = content_url('/uploads/official_cars/common/official_vf8.webp');
        }
      ?>
      <div class="vf-news-card-item">
        <div class="vf-news-card-thumb">
          <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>">
            <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($post_item->post_title); ?>">
          </a>
        </div>
        <div class="vf-news-card-body">
          <div class="vf-news-card-meta">
            📅 <?php echo get_the_date('d/m/Y', $post_item->ID); ?>
          </div>
          <h3 class="vf-news-card-h3">
            <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>">
              <?php echo esc_html($post_item->post_title); ?>
            </a>
          </h3>
          <p class="vf-news-card-desc">
            <?php echo esc_html(get_the_excerpt($post_item->ID) ?: wp_trim_words($post_item->post_content, 20)); ?>
          </p>
          <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>" class="vf-news-card-readmore">
            Đọc tiếp →
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php else: ?>
      <div style="text-align:center; padding:60px 20px; background:#fff; border-radius:16px;">
        <h3>Chưa có bài viết nào được xuất bản.</h3>
      </div>
    <?php endif; ?>

  </div>
</div>

<?php get_footer(); ?>
