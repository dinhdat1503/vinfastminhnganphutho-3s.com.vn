<?php /* SECTION 3: XE VINFAST — Danh sách xe kèm thông số kỹ thuật */ ?>
<style>
/* ===== PRODUCTS GRID ===== */
.vf-products-wrap {
    padding: 64px 0;
    background: #fff;
}
.vf-products-head {
    text-align: center;
    margin-bottom: 40px;
}
.vf-products-head h2 {
    font-size: 2.2rem;
    font-weight: 800;
    color: #c02428;
    text-transform: uppercase;
    font-family: 'Arial Black', sans-serif;
    margin: 0;
}
.vf-btn-view-all {
    display: inline-block;
    background: #444;
    color: #fff !important;
    padding: 8px 20px;
    font-size: 0.85rem;
    font-weight: 700;
    border-radius: 3px;
    text-transform: uppercase;
    text-decoration: none;
    margin-bottom: 30px;
}
.vf-btn-view-all:hover {
    background: #222;
}
.vf-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.vf-prod-card {
    background: #fff;
    transition: transform .3s;
    display: flex;
    flex-direction: column;
}
.vf-prod-card:hover {
    transform: translateY(-5px);
}
.prod-img {
    position: relative;
    padding-top: 15px;
    background: #fff;
}
.prod-img img {
    width: 100%;
    height: auto;
    object-fit: contain;
}
.prod-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 15px;
}
.prod-name {
    font-size: 1rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #333;
}
.prod-price {
    background: #e32a2a;
    color: #fff;
    font-size: 0.9rem;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 0;
}
.prod-specs {
    font-size: 0.85rem;
    color: #666;
    line-height: 1.5;
}
.prod-specs ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.prod-specs li {
    position: relative;
    padding-left: 10px;
    margin-bottom: 8px;
}
.prod-specs li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: #999;
}

/* Responsive */
@media(max-width:1024px) {
    .vf-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media(max-width:768px) {
    .vf-products-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
}
@media(max-width:480px) {
    .vf-products-grid { grid-template-columns: 1fr; }
    .prod-header { flex-direction: column; align-items: flex-start; gap: 8px; }
}
</style>

<div class="vf-products-wrap">
  <div class="container">

    <div style="text-align:center;">
        <a href="<?php echo home_url('/san-pham/'); ?>" class="vf-btn-view-all">Xem tất cả ></a>
    </div>

    <div class="vf-products-head">
      <h2>XE VINFAST</h2>
    </div>

    <div class="vf-products-grid">

      <!-- EC VAN -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/ec-van/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/ec-van.webp" alt="EC VAN" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">EC VAN</div>
            <div class="prod-price">285.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1 motor RWD</li>
              <li>Công suất tối đa (kW): 20 kW (≈27 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 65 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): 120km (Eco) / 180km (Plus) - NEDC</li>
              <li>Thời gian nạp pin nhanh nhất: DC 12 kW (10-70%) & AC 3.3kW</li>
              <li>Dẫn động: Cầu sau (RWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- NERIO GREEN -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/nerio-green/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/nerio-green.png" alt="NERIO GREEN" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">NERIO GREEN</div>
            <div class="prod-price">668.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1 motor FWD</li>
              <li>Công suất tối đa (kW): 110 kW (~150 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 242 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): ~300km thực tế (~285km NEDC)</li>
              <li>Thời gian nạp pin nhanh nhất: 27 phút (10-70%)</li>
              <li>Dẫn động: Cầu trước (FWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- LIMO GREEN -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/limo-green/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/limo-green.png" alt="LIMO GREEN" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">LIMO GREEN</div>
            <div class="prod-price">749.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1 motor FWD (trước)</li>
              <li>Công suất tối đa (kW): ~150 kW (201 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 280 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): ~450km (NEDC/WLTP)</li>
              <li>Thời gian nạp pin nhanh nhất: 30 phút (10-70%)</li>
              <li>Dẫn động: Cầu trước (FWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- HERIO GREEN -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/herio-green/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/herio-green.png" alt="HERIO GREEN" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">HERIO GREEN</div>
            <div class="prod-price">499.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1 motor FWD</li>
              <li>Công suất tối đa (kW): 100 kW (~134 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 135 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): 326 km (NEDC)</li>
              <li>Thời gian nạp pin nhanh nhất: 33 phút (10-70%)</li>
              <li>Dẫn động: Cầu trước (FWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- MINIO GREEN -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/minio-green/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/minio-green.png" alt="MINIO GREEN" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">MINIO GREEN</div>
            <div class="prod-price">269.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1 motor RWD</li>
              <li>Công suất tối đa (kW): 20 kW (~27 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 65 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): 120km (Eco) / 180km (Plus) - NEDC</li>
              <li>Thời gian nạp pin nhanh nhất: DC 12 kW (10-70%) & AC 3.3kW</li>
              <li>Dẫn động: Cầu sau (RWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- VINFAST VF 9 -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-9/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf9.png" alt="VINFAST VF 9" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">VINFAST VF 9</div>
            <div class="prod-price">1.499.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 2 motor AWD</li>
              <li>Công suất tối đa (kW): 300 kW</li>
              <li>Mô men xoắn cực đại (Nm): 620 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): ~505 km (WLTP Eco) / ~330 mi EPA</li>
              <li>Thời gian nạp pin nhanh nhất: ~35 phút (10-70%)</li>
              <li>Dẫn động: Toàn thời gian (AWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- VINFAST VF 8 -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-8/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf8.png" alt="VINFAST VF 8" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">VINFAST VF 8</div>
            <div class="prod-price">1.019.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 2 motor - AWD</li>
              <li>Công suất tối đa (kW): 260 kW (Eco) / 300 kW (Plus)</li>
              <li>Mô men xoắn cực đại (Nm): 500 Nm / 620 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): 457 km (Eco) / 471 km (Plus) theo WLTP</li>
              <li>Thời gian nạp pin nhanh nhất: ~31 phút (10-70%)</li>
              <li>Dẫn động: Toàn thời gian (AWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- VINFAST VF 8 THE ALL NEW -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-8-the-all-new/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf8.png" alt="VINFAST VF 8 THE ALL NEW" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">VF 8 THE ALL NEW</div>
            <div class="prod-price">999.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1 motor FWD</li>
              <li>Công suất tối đa (kW): 170 kW (~228 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 330 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): ~500 km (NEDC)</li>
              <li>Thời gian nạp pin nhanh nhất: Khoảng 30 phút (10-70%)</li>
              <li>Dẫn động: Cầu trước (FWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- VINFAST VF 7 -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-7/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/vf7.png" alt="VINFAST VF 7" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">VINFAST VF 7</div>
            <div class="prod-price">799.000.000 đ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện, 1-2 motor</li>
              <li>Công suất tối đa (kW): 150 kW (Eco) / 260 kW (354 hp - AWD)</li>
              <li>Mô men xoắn cực đại (Nm): 310 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): 431 km (AWD) - 450 km (Eco)</li>
              <li>Thời gian nạp pin nhanh nhất: ~25-30 phút (10%-70%)</li>
              <li>Dẫn động: Cầu trước (Eco) hoặc Toàn thời gian (AWD)</li>
            </ul>
          </div>
        </a>
      </div>

      <!-- VINFAST VF MPV 7 -->
      <div class="vf-prod-card">
        <a href="<?php echo home_url('/san-pham/vinfast-vf-mpv-7/'); ?>" style="text-decoration:none; color:inherit;">
          <div class="prod-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cars/mpv7.png" alt="VINFAST VF MPV 7" loading="lazy"/>
          </div>
          <div class="prod-header">
            <div class="prod-name">VINFAST VF MPV 7</div>
            <div class="prod-price">Liên hệ</div>
          </div>
          <div class="prod-specs">
            <ul>
              <li>Động cơ: Điện</li>
              <li>Công suất tối đa (kW): 150 kW (201 hp)</li>
              <li>Mô men xoắn cực đại (Nm): 280 Nm</li>
              <li>Quãng đường chạy một lần sạc đầy (km): 450 km (NEDC)</li>
              <li>Thời gian nạp pin nhanh nhất: ~30 phút (10%-70%)</li>
              <li>Dẫn động: Cầu trước (FWD)</li>
            </ul>
          </div>
        </a>
      </div>

    </div><!-- /grid -->

  </div>
</div>
