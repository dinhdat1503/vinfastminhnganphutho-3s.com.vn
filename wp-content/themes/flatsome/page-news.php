<?php
/*
Template Name: Tin tức VinFast
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
        padding: 40px 0; /* Reduced from 60px */
        text-align: center;
        margin-bottom: 40px;
    }
    .news-banner h1 {
        font-size: 28px; /* Reduced from 36px */
        font-weight: 800;
        text-transform: uppercase;
        margin: 0;
        letter-spacing: 1.5px;
    }
    .news-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Changed to 2 columns to fit the sidebar */
        gap: 30px;
    }
    .news-item {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        text-decoration: none !important;
        color: inherit !important;
        border: 1px solid #eee;
    }
    .news-item:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(200, 16, 46, 0.15);
        border-color: #c8102e;
    }
    .news-img {
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #f5f5f5;
        position: relative;
    }
    .news-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .news-item:hover .news-img img {
        transform: scale(1.1);
    }
    .news-body {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .news-cat {
        display: inline-block;
        color: #c8102e;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
        letter-spacing: 1.5px;
    }
    .news-title {
        font-size: 19px;
        font-weight: 800;
        margin-bottom: 15px;
        line-height: 1.4;
        color: #1a1a2e;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-excerpt {
        font-size: 14px;
        color: #666;
        line-height: 1.7;
        margin-bottom: 25px;
        flex-grow: 1;
    }
    .news-footer {
        border-top: 1px solid #f0f0f0;
        padding-top: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .news-more {
        font-weight: 800;
        font-size: 12px;
        text-transform: uppercase;
        color: #c8102e;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .news-date {
        font-size: 12px;
        color: #999;
    }

    @media (max-width: 1024px) {
        .news-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 650px) {
        .news-grid { grid-template-columns: 1fr; }
        .news-banner h1 { font-size: 28px; }
    }
</style>

<div class="news-archive-page">
    <div class="news-banner">
        <div class="container">
            <h1>Tin tức & Sự kiện VinFast</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="large-9 col">
                <div class="news-grid">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 8, // Changed to 8 to keep grid even
                        'paged' => $paged
                    );
                    $query = new WP_Query($args);

                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
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
                            <span class="news-cat">VinFast VFG Vĩnh Phúc</span>
                            <h2 class="news-title"><?php the_title(); ?></h2>
                            <p class="news-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                            <div class="news-footer">
                                <div class="news-more">Xem chi tiết <i class="fas fa-arrow-right"></i></div>
                                <div class="news-date"><?php echo get_the_date('d/m/Y'); ?></div>
                            </div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); else : ?>
                        <p>Chưa có tin tức nào được đăng tải.</p>
                    <?php endif; ?>
                </div>

                <div class="pagination-wrap" style="text-align: center; margin-top: 60px;">
                    <?php 
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                    )); 
                    ?>
                </div>
            </div> <!-- .large-9 -->

            <div class="large-3 col">
                <div class="news-sidebar" style="padding-left: 15px;">
                    <?php get_sidebar(); ?>
                </div>
            </div> <!-- .large-3 -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</div>

<?php get_footer(); ?>
