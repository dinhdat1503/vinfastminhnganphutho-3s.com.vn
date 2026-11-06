<?php /* SECTION 1: HERO BANNER SLIDER — sửa file này để chỉnh banner */ ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<style>
/* ===== HERO BANNER ===== */
.vf-hero {
    position: relative;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.vf-hero .swiper {
    width: 100%;
    height: auto;
}

.vf-hero .swiper-wrapper {
    align-items: stretch;
}

.vf-hero .swiper-slide {
    position: relative;
    width: 100% !important;
    line-height: 0;
    /* KHÔNG overflow:hidden — tránh cắt ảnh */
}

/* ===== ẢNH — hiển thị 100% toàn bộ ảnh, không cắt ===== */
.vf-hero .swiper-slide img.vf-slide-img {
    display: block;
    width: 100%;
    height: auto; /* chiều cao tự động theo tỷ lệ ảnh gốc */
}

/* ===== OVERLAY & NỘI DUNG CHỮ ===== */
.vf-slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(0,0,0,.35) 0%, rgba(0,0,0,0) 60%);
    z-index: 1;
}

.vf-slide-content {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    z-index: 2;
    max-width: 520px;
    padding: 0 60px;
    color: #fff;
    line-height: 1.4;
}

.vf-slide-tag {
    display: inline-block;
    background: #c02428;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 4px 14px;
    border-radius: 2px;
    margin-bottom: 14px;
}

.vf-slide-title {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.2;
    margin: 0 0 12px;
    text-shadow: 0 2px 8px rgba(0,0,0,.4);
}

.vf-slide-sub {
    font-size: 1rem;
    margin-bottom: 24px;
    opacity: .9;
}

.vf-slide-btns {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.vf-slide-btns a {
    padding: 12px 28px;
    border-radius: 4px;
    font-weight: 700;
    font-size: .9rem;
    text-decoration: none;
    transition: all .3s;
}

.vs-fill { background: #c02428; color: #fff; border: 2px solid #c02428; }
.vs-fill:hover { background: #9b1b1e !important; border-color: #9b1b1e; }
.vs-out  { background: transparent; color: #fff; border: 2px solid #fff; }
.vs-out:hover { background: #fff !important; color: #c02428 !important; }

/* ===== SWIPER UI ===== */
.vf-hero .swiper-pagination {
    bottom: 16px;
}
.vf-hero .swiper-pagination-bullet {
    background: #fff;
    opacity: .6;
}
.vf-hero .swiper-pagination-bullet-active {
    opacity: 1;
    background: #c02428;
    width: 22px;
    border-radius: 3px;
}
.vf-hero .swiper-button-prev,
.vf-hero .swiper-button-next {
    color: #fff;
    background: rgba(0,0,0,.3);
    width: 42px;
    height: 42px;
    border-radius: 50%;
}
.vf-hero .swiper-button-prev::after,
.vf-hero .swiper-button-next::after { font-size: 16px; }

/* ===== RESPONSIVE ===== */
@media(max-width:1024px) {
    .vf-slide-title { font-size: 2.2rem; }
}

@media(max-width:768px) {
    .vf-slide-title { font-size: 1.6rem; }
    .vf-slide-content { padding: 0 20px; max-width: 80%; }
    .vf-slide-sub { font-size: .88rem; margin-bottom: 12px; }
    .vf-slide-btns a { padding: 8px 16px; font-size: .82rem; }
    .vf-hero .swiper-button-prev,
    .vf-hero .swiper-button-next { display: none; }
}

@media(max-width:480px) {
    .vf-slide-title { font-size: 1.2rem; }
    .vf-slide-tag { font-size: 9px; padding: 3px 10px; margin-bottom: 8px; }
    .vf-slide-sub { display: none; }
    .vf-slide-btns { gap: 6px; }
    .vf-slide-btns a { padding: 7px 12px; font-size: .78rem; }
}
</style>

<div class="vf-hero">
  <div class="swiper vf-swiper-hero">
    <div class="swiper-wrapper">

      <!-- ===== SLIDE 1 ===== -->
      <div class="swiper-slide">
        <a href="<?php echo home_url('/dong-xe/dong-co-dien/vinfast-vf-9/'); ?>" style="display: block;">
            <img class="vf-slide-img"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/slides/banner-1.webp"
                 alt="VinFast VF 9">
        </a>
      </div>

      <!-- ===== SLIDE 2 ===== -->
      <div class="swiper-slide">
        <a href="<?php echo home_url('/dong-xe/dong-co-dien/vinfast-vf-8/'); ?>" style="display: block;">
            <img class="vf-slide-img"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/slides/banner-vf8.webp"
                 alt="VinFast VF 8">
        </a>
      </div>

      <!-- ===== SLIDE 3 ===== -->
      <div class="swiper-slide">
        <a href="<?php echo home_url('/dong-xe/dong-co-dien/vinfast-vf-6/'); ?>" style="display: block;">
            <img class="vf-slide-img"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/slides/banner-2.webp"
                 alt="VinFast VF 6">
        </a>
      </div>

      <!-- ===== SLIDE 4 ===== -->
      <div class="swiper-slide">
        <a href="<?php echo home_url('/dong-xe/dong-co-dien/vinfast-vf-3/'); ?>" style="display: block;">
            <img class="vf-slide-img"
                 src="<?php echo get_template_directory_uri(); ?>/assets/images/slides/banner-3.webp"
                 alt="VinFast VF 3">
        </a>
      </div>

    </div><!-- /.swiper-wrapper -->

    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div><!-- /.swiper -->
</div><!-- /.vf-hero -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
new Swiper('.vf-swiper-hero', {
    loop: true,
    speed: 800,
    autoplay: { delay: 5000, disableOnInteraction: false },
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    effect: 'fade',
    fadeEffect: { crossFade: true }
});
</script>