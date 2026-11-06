<?php /* SECTION 5: TIN TỨC - SỰ KIỆN */ ?>
<style>
.vf-news-wrap {
    padding: 70px 0;
    background: #fff;
}
.vf-news-head {
    text-align: center;
    margin-bottom: 40px;
}
.vf-news-head h2 {
    font-size: 1.8rem;
    font-weight: 500;
    color: #444;
    text-transform: uppercase;
    margin: 0;
    letter-spacing: 1px;
}
.vf-news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}
.vf-news-card {
    display: flex;
    flex-direction: column;
    text-decoration: none;
}
.vf-news-img {
    overflow: hidden;
    aspect-ratio: 16/9;
    margin-bottom: 15px;
    background: #f5f5f5;
}
.vf-news-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.vf-news-card:hover .vf-news-img img {
    transform: scale(1.05);
}
.vf-news-title {
    font-size: 1.05rem;
    font-weight: 600;
    color: #333;
    text-transform: uppercase;
    margin: 0 0 10px;
    line-height: 1.4;
    transition: color 0.3s;
}
.vf-news-card:hover .vf-news-title {
    color: #c02428;
}
.vf-news-excerpt {
    font-size: 0.9rem;
    color: #777;
    line-height: 1.6;
    margin: 0;
}
.vf-btn-dark {
    display: inline-block;
    background: #444;
    color: #fff !important;
    padding: 10px 30px;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    border-radius: 3px;
    transition: background 0.3s;
}
.vf-btn-dark:hover {
    background: #222;
}

/* Responsive */
@media(max-width: 992px) {
    .vf-news-grid { grid-template-columns: repeat(2, 1fr); }
}
@media(max-width: 576px) {
    .vf-news-grid { grid-template-columns: 1fr; }
    .vf-news-img { aspect-ratio: 3/2; }
}
</style>

<div class="vf-news-wrap">
  <div class="container">

    <div class="vf-news-head">
      <h2>TIN TỨC - SỰ KIỆN</h2>
    </div>

    <div class="vf-news-grid">
      <?php
      $news_query = new WP_Query(array(
          'post_type'      => 'post',
          'posts_per_page' => 3,
          'orderby'        => 'date',
          'order'          => 'DESC'
      ));

      if ($news_query->have_posts()) :
          while ($news_query->have_posts()) : $news_query->the_post();
              $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
              if (!$thumb_url) {
                  // Fallback to custom meta if set by our script
                  $thumb_url = get_post_meta(get_the_ID(), '_thumbnail_ext_url', true);
              }
              if (!$thumb_url) {
                  $thumb_url = 'https://images.unsplash.com/photo-1593941707882-a5bba14938cb?auto=format&fit=crop&q=80&w=600';
              }
      ?>
      <!-- News Item -->
      <a href="<?php the_permalink(); ?>" class="vf-news-card">
        <div class="vf-news-img">
          <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>">
        </div>
        <h3 class="vf-news-title"><?php the_title(); ?></h3>
        <p class="vf-news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
      </a>
      <?php
          endwhile;
          wp_reset_postdata();
      endif;
      ?>
    </div>

    <div style="text-align:center;">
      <a href="<?php echo home_url('/tin-tuc/'); ?>" class="vf-btn-dark">XEM TẤT CẢ ></a>
    </div>

  </div>
</div>
