<?php
/**
 * Custom Single Post Template
 */

get_header(); ?>

<style>
    .single-news-page {
        padding: 60px 0;
        background: #fff;
    }
    .news-header {
        max-width: 900px;
        margin: 0 auto 40px;
        text-align: center;
    }
    .news-meta {
        font-size: 13px;
        color: #c8102e;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
        letter-spacing: 1px;
    }
    .news-h1 {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.3;
        color: #1a1a2e;
        margin-bottom: 20px;
    }
    .news-date-bar {
        font-size: 14px;
        color: #888;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }
    .news-featured-img {
        max-width: 1000px;
        margin: 0 auto 50px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
    }
    .news-featured-img img {
        width: 100%;
        height: auto;
        display: block;
    }
    .news-content-wrap {
        max-width: 800px;
        margin: 0 auto;
        font-size: 18px;
        line-height: 1.8;
        color: #444;
    }
    .news-content-wrap p {
        margin-bottom: 25px;
    }
    .news-content-wrap img {
        border-radius: 10px;
        margin: 20px 0;
    }
    .news-share {
        margin-top: 50px;
        padding-top: 30px;
        border-top: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .share-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        transition: all 0.3s;
    }
    .share-btn:hover {
        background: #c8102e;
        color: #fff;
    }

    @media (max-width: 768px) {
        .news-h1 { font-size: 26px; }
        .news-content-wrap { font-size: 16px; padding: 0 20px; }
    }
</style>

<div class="single-news-page">
    <article <?php post_class(); ?>>
        <div class="container">
            <div class="row">
                <div class="large-9 col">
                    <header class="news-header">
                        <span class="news-meta">Tin tức & Sự kiện</span>
                        <h1 class="news-h1"><?php the_title(); ?></h1>
                        <div class="news-date-bar">
                            Đăng bởi <strong>Admin</strong> vào ngày <?php echo get_the_date('d/m/Y'); ?>
                        </div>
                    </header>

                    <?php 
                    $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    if (!$thumb_url) {
                        $thumb_url = get_post_meta(get_the_ID(), '_thumbnail_ext_url', true);
                    }
                    if ($thumb_url) : ?>
                    <div class="news-featured-img">
                        <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>">
                    </div>
                    <?php endif; ?>

                    <div class="news-content-wrap">
                        <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
                        
                        <div class="news-share">
                            <strong>Chia sẻ:</strong>
                            <a href="#" class="share-btn"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="share-btn"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="share-btn"><i class="fas fa-link"></i></a>
                        </div>
                    </div>
                </div> <!-- .large-9 -->

                <div class="large-3 col">
                    <div class="news-sidebar" style="padding-left: 15px;">
                        <?php get_sidebar(); ?>
                    </div>
                </div> <!-- .large-3 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </article>
</div>

<?php get_footer(); ?>
