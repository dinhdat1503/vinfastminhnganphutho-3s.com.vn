<?php /* SECTION 2: KHÁM PHÁ DÒNG XE — sửa file này để chỉnh grid xe */ ?>
<style>
/* ===== GRID XE ===== */
.vf-cars-wrap { 
    background: #f8f8f8; 
    padding: 64px 0; 
}
.vf-cars-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.vf-car-card {
    background: #fff; border-radius: 10px; overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,.07); border: 1px solid #f0f0f0;
    transition: transform .3s, box-shadow .3s;
}
.vf-car-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 36px rgba(0,0,0,.13);
}
.car-img { position: relative; overflow: hidden; aspect-ratio: 16/9; background: #f5f5f5; }
/* ↓ Đổi ảnh: thay src="" trong thẻ <img> tương ứng bên dưới */
.car-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
.vf-car-card:hover .car-img img { transform: scale(1.06); }
.car-badge {
    position: absolute; top: 10px; left: 10px;
    background: #c02428; color: #fff; font-size: 10px; font-weight: 700;
    letter-spacing: 1px; padding: 3px 10px; border-radius: 2px; text-transform: uppercase;
}
.car-body   { padding: 18px 20px; }
.car-name   { font-size: 1.1rem; font-weight: 800; text-transform: uppercase; color: #1a1a2e; margin: 0 0 4px; }
.car-price  { color: #c02428; font-weight: 700; font-size: .95rem; margin-bottom: 14px; }
.car-btns   { display: flex; gap: 10px; }
.car-btns a {
    flex: 1; text-align: center; padding: 9px 6px;
    border-radius: 4px; font-size: .82rem; font-weight: 700;
    text-decoration: none; transition: all .3s;
}
.cb-fill  { background: #c02428; color: #fff !important; }
.cb-fill:hover  { background: #9b1b1e !important; }
.cb-line  { border: 2px solid #c02428; color: #c02428 !important; }
.cb-line:hover  { background: #c02428 !important; color: #fff !important; }

/* Responsive */
@media(max-width:1024px) { .vf-cars-grid{grid-template-columns:repeat(2,1fr);} }
@media(max-width:768px)  {
    .vf-cars-grid{grid-template-columns:repeat(2,1fr); gap:16px;}
    .car-btns{flex-direction:column; gap:8px;}
}
@media(max-width:480px)  {
    .vf-cars-grid{grid-template-columns:1fr;}
    .car-btns{flex-direction:row;}
}
</style>

<div class="vf-fullwidth vf-cars-wrap">
  <div class="container">

    <div class="vf-head">
      <span class="vf-tag">Xe điện VinFast</span>
      <h2>Khám phá các dòng xe VinFast</h2>
      <p>VinFast VFG Vĩnh Phúc – Đại lý chính hãng VinFast. Địa chỉ tại Đường Đinh Tiên Hoàng, Đôn Hậu, Phường Vĩnh Phúc, Tỉnh Phú Thọ.</p>
      <div class="vf-line"></div>
    </div>

    <div class="vf-cars-grid">

      <!-- VF 3 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-3/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf3.png" alt="VinFast VF 3" />
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF 3</div>
        </a>
          <div class="car-price">Giá từ: 299.000.000 VNĐ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

      <!-- VF 5 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-5/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf5.png" alt="VinFast VF 5" loading="lazy"/>
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF 5</div>
        </a>
          <div class="car-price">Giá từ: 529.000.000 VNĐ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

      <!-- VF 6 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-6/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf6.png" alt="VinFast VF 6" loading="lazy"/>
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF 6</div>
        </a>
          <div class="car-price">Giá từ: 689.000.000 VNĐ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

      <!-- VF 7 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-7/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf7.png" alt="VinFast VF 7" loading="lazy"/>
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF 7</div>
        </a>
          <div class="car-price">Giá từ: 799.000.000 VNĐ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

      <!-- VF 8 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-8/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf8.png" alt="VinFast VF 8" loading="lazy"/>
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF 8</div>
        </a>
          <div class="car-price">Giá từ: 1.019.000.000 VNĐ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

      <!-- VF 9 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-9/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf9.png" alt="VinFast VF 9" loading="lazy"/>
            <span class="car-badge">Flagship</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF 9</div>
        </a>
          <div class="car-price">Giá từ: 1.499.000.000 VNĐ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

      <!-- VF MPV 7 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-mpv-7/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/mpv7.png" alt="VinFast VF MPV 7" loading="lazy"/>
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VinFast VF MPV 7</div>
        </a>
          <div class="car-price">Giá từ: Liên hệ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

  <!--VINFAST VF 8 THE ALL NEW
 -->
      <div class="vf-car-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-8-the-all-new/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="car-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/img.png" alt="VinFast VF 8 The All New" loading="lazy"/>
            <span class="car-badge">Điện</span>
          </div>
          <div class="car-body">
            <div class="car-name">VINFAST VF 8 THE ALL NEW</div>
        </a>
          <div class="car-price">Giá từ: Liên hệ</div>
          <div class="car-btns">
            <a href="<?php echo home_url('/du-toan-chi-phi/'); ?>" class="cb-fill">Dự toán chi phí</a>
            <a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>" class="cb-line">Lái thử</a>
          </div>
        </div>
      </div>

    </div><!-- /grid -->

  </div>
</div>
