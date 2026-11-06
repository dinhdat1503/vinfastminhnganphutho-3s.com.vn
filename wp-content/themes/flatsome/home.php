<?php
/**
 * Custom News Archive Template
 */

get_header(); ?>

<style>
    .news-archive-page {
        padding: 60px 0;
        background: #fdfdfd;
        min-height: 600px;
    }
    .news-banner {
        background: #c8102e;
        color: #fff;
        padding: 60px 0;
        text-align: center;
        margin-bottom: 50px;
    }
    .news-banner h1 {
        font-size: 32px;
        font-weight: 800;
        text-transform: uppercase;
        margin: 0;
    }
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .news-item {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        display: flex;
        flex-direction: column;
        text-decoration: none !important;
        color: inherit !important;
    }
    .news-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }
    .news-img {
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #eee;
    }
    .news-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .news-body {
        padding: 25px;
        flex-grow: 1;
    }
    .news-cat {
        display: inline-block;
        color: #c8102e;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }
    .news-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        line-height: 1.4;
        color: #333;
    }
    .news-excerpt {
        font-size: 14px;
        color: #777;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .news-more {
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        color: #c8102e;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    @media (max-width: 992px) {
        .news-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .news-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="news-archive-page">
    <div class="news-banner">
        <div class="container">
            <h1>Tin tức & Sự kiện</h1>
        </div>
    </div>

    <div class="container">
        <div class="news-grid">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                if (!$thumb_url) {
                    $thumb_url = get_post_meta(get_the_ID(), '_thumbnail_ext_url', true);
                }
                if (!$thumb_url) {
                    $thumb_url = 'https://images.unsplash.com/photo-1593941707882-a5bba14938cb?auto=format&fit=crop&q=80&w=600';
                }
            ?>
            <a href="<?php the_permalink(); ?>" class="news-item">
                <div class="news-img">
                    <img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>">
                </div>
                <div class="news-body">
                    <span class="news-cat">Tin VinFast</span>
                    <h2 class="news-title"><?php the_title(); ?></h2>
                    <p class="news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                    <div class="news-more">Xem chi tiết <i class="fas fa-chevron-right" style="font-size: 10px;"></i></div>
                </div>
            </a>
            <?php endwhile; endif; ?>
        </div>

        <div class="pagination-wrap" style="text-align: center; margin-top: 50px;">
            <?php echo paginate_links(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
