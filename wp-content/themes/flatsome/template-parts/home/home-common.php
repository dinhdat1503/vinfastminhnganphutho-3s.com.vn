<?php /* CSS chung + JS fix full-width cho tất cả sections */ ?>
<style>
/* =========================================
   COMMON — dùng chung toàn trang chủ
   ========================================= */
body { overflow-x: hidden; }

/* Xoá giới hạn của Flatsome container trên trang này */
#main,
#content,
.content-area,
#wrapper {
    padding: 0 !important;
    margin: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
    overflow-x: visible !important;
}

/* Full-width class — JS sẽ set width/margin chính xác */
.vf-fullwidth { position: relative; }

/* Wrapper nội dung có max-width */
.vf-wrap { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

/* Section heading */
.vf-head          { text-align: center; margin-bottom: 44px; }
.vf-head .vf-tag  {
    display: inline-block; background: #c02428; color: #fff;
    font-size: 11px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; padding: 4px 14px;
    border-radius: 2px; margin-bottom: 10px;
}
.vf-head h2       { font-size: 2rem; font-weight: 800; color: #1a1a2e; margin: 0 0 10px; }
.vf-head p        { color: #666; font-size: .95rem; line-height: 1.7; max-width: 600px; margin: 0 auto; }
.vf-head .vf-line { width: 48px; height: 3px; background: #c02428; margin: 12px auto 0; border-radius: 2px; }

/* Buttons */
.vf-btn-red  {
    display: inline-block; background: #c02428; color: #fff !important;
    padding: 12px 32px; border-radius: 4px; font-weight: 700;
    text-decoration: none; transition: background .3s;
}
.vf-btn-red:hover  { background: #9b1b1e !important; }
.vf-btn-outline {
    display: inline-block; border: 2px solid #c02428; color: #c02428 !important;
    padding: 11px 30px; border-radius: 4px; font-weight: 700;
    text-decoration: none; transition: all .3s;
}
.vf-btn-outline:hover { background: #c02428 !important; color: #fff !important; }
</style>

</style>

<style>
/* CSS fix full-width - bulletproof */
.vf-fullwidth {
    width: 100%;
}
/* Ensure wrapper inside has proper max-width */
.vf-fullwidth > .vf-wrap {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}
</style>
