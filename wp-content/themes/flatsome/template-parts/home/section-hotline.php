<?php /* SECTION 6: HOTLINE HỖ TRỢ */ ?>
<style>
.vf-hotline-wrap {
    padding: 70px 0;
    background: #fcfcfc;
    border-top: 1px solid #eaeaea;
}
.vf-hotline-grid {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 40px;
}
.vf-hotline-left {
    flex: 1;
    min-width: 300px;
    padding-right: 20px;
}
.vf-hotline-right {
    flex: 1;
    min-width: 300px;
}
.vf-hl-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #c02428;
    margin: 0 0 5px;
}
.vf-hl-sub {
    font-size: 0.95rem;
    color: #666;
    margin-bottom: 30px;
}
.vf-hl-item {
    font-size: 1.1rem;
    color: #333;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.vf-hl-phone {
    font-size: 1.4rem;
    font-weight: 700;
    color: #c02428;
    margin-left: 4px;
    text-decoration: none;
}
.vf-hl-email {
    font-size: 1.1rem;
    font-weight: 700;
    color: #c02428;
    margin-left: 4px;
    text-decoration: none;
}
.vf-hotline-right img {
    width: 100%;
    height: auto;
    border-radius: 4px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

/* Responsive */
@media(max-width: 768px) {
    .vf-hotline-grid { flex-direction: column; gap: 30px; }
    .vf-hotline-left { padding-right: 0; text-align: center; }
    .vf-hl-item { 
        justify-content: center; 
        font-size: 0.95rem;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    .vf-hl-phone {
        font-size: 1.15rem;
        margin-left: 4px;
    }
    .vf-hl-email {
        font-size: 0.95rem;
        margin-left: 4px;
    }
}
</style>

<div class="vf-hotline-wrap">
  <div class="container">
    <div class="vf-hotline-grid">

      <div class="vf-hotline-left">
        <h2 class="vf-hl-title">Hotline hỗ trợ</h2>
        <p class="vf-hl-sub">Gọi để được tư vấn về sản phẩm, dịch vụ</p>

        <div class="vf-hl-item">
          <i class="fas fa-user-tie" style="width: 20px; color: #c02428;"></i> Sales Executive: <strong style="margin-left: 8px;">Mr. Toàn</strong>
        </div>

        <div class="vf-hl-item">
          <i class="fas fa-phone-volume" style="width: 20px; color: #c02428;"></i> Hotline Kinh doanh: <a href="tel:0971569093" class="vf-hl-phone">0971.569.093</a>
        </div>
        
        <div class="vf-hl-item">
          <i class="fas fa-envelope" style="width: 20px; color: #c02428;"></i> Email: <a href="mailto:Thetoan19.tn@gmail.com" class="vf-hl-email">Thetoan19.tn@gmail.com</a>
        </div>
      </div>

      <div class="vf-hotline-right">
        <!-- Chèn ảnh banner sự kiện/khuyến mãi -->
        <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/slides/banner-vf8.webp" alt="48H Trải nghiệm miễn phí VF8" loading="lazy">
        </a>
      </div>

    </div>
  </div>
</div>
