<?php
/**
 * Custom Header Main cho VinFast Vĩnh Phúc — Mobile-First Responsive
 */
defined('ABSPATH') || exit;
$uploads_url = content_url('/uploads/official_cars/common');
?>
<div id="header-main" class="header-main">
  <div class="header-inner container">

    <!-- MOBILE MENU HAMBURGER BUTTON (LEFT SIDE ON MOBILE) -->
    <div class="vf-mobile-header-left show-for-medium">
      <button class="vf-mobile-toggle" onclick="vfToggleMobileMenu()" aria-label="Menu Mobile">
        <span></span><span></span><span></span>
      </button>
    </div>

    <!-- LOGO CHÍNH CHỦ VINFAST TÂN Á CHÂU -->
    <div id="logo" class="flex-col">
      <a href="<?php echo esc_url(home_url('/')); ?>" title="VinFast Tân Á Châu" class="vf-official-img-logo-link">
        <?php 
          $theme_logo = get_stylesheet_directory_uri() . '/assets/images/logo-tac-trang.png';
        ?>
        <img src="<?php echo esc_url($theme_logo); ?>" alt="VinFast Tân Á Châu"
          class="vf-official-vinhphuc-logo-img">
      </a>
    </div>

    <!-- DESKTOP MENU MAIN WITH MEGA MENU DROPDOWN -->
    <div class="header-nav hide-for-medium">
      <ul class="header-nav-main">
        <li class="menu-item"><a href="<?php echo esc_url(home_url('/#gioi-thieu')); ?>">Giới thiệu</a></li>

        <!-- MEGA MENU DROP DOWN DÒNG XE VINFAST -->
        <li class="menu-item menu-item-has-children vf-megamenu-item">
          <a href="<?php echo esc_url(home_url('/#xe-ca-nhan')); ?>">Ô tô <span class="vf-dropdown-arrow">▾</span></a>

          <div class="vf-megamenu-dropdown">
            <div class="vf-megamenu-inner">

              <!-- TAB HEADER CHÍNH THỨC -->
              <div class="vf-megamenu-tabs">
                <button class="vf-mm-tab-btn active" onclick="vfSwitchMegaTab('ev', event)">ĐỘNG CƠ ĐIỆN</button>
                <button class="vf-mm-tab-btn" onclick="vfSwitchMegaTab('service', event)">DÒNG XE DỊCH VỤ</button>
              </div>

              <!-- TAB 1: XE Ô TÔ ĐIỆN CÁ NHÂN -->
              <div class="vf-mm-tab-content active" id="vf-mm-tab-ev">
                <div class="vf-mm-cars-grid">

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-2/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf2.png'); ?>" alt="VinFast VF 2">
                    </div>
                    <span class="vf-mm-car-name">VF 2</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-3/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf3.webp'); ?>" alt="VinFast VF 3">
                    </div>
                    <span class="vf-mm-car-name">VF 3</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-5/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf5.webp'); ?>" alt="VinFast VF 5">
                    </div>
                    <span class="vf-mm-car-name">VF 5</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-6/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf6.webp'); ?>" alt="VinFast VF 6">
                    </div>
                    <span class="vf-mm-car-name">VF 6</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-mpv-7/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_mpv7.webp'); ?>" alt="VinFast MPV 7">
                    </div>
                    <span class="vf-mm-car-name">VF MPV 7</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-7/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf7.webp'); ?>" alt="VinFast VF 7">
                    </div>
                    <span class="vf-mm-car-name">VF 7</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-8/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf8.webp'); ?>" alt="VinFast VF 8">
                    </div>
                    <span class="vf-mm-car-name">VF 8</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-8-all-new/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>"
                        alt="VinFast VF 8 The All New">
                    </div>
                    <span class="vf-mm-car-name">VF 8 The All New</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-9/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>" alt="VinFast VF 9">
                    </div>
                    <span class="vf-mm-car-name">VF 9</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-vf-wild/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_vfwild.webp'); ?>" alt="VinFast VF Wild">
                    </div>
                    <span class="vf-mm-car-name">VF Wild</span>
                  </a>

                </div>
              </div>

              <!-- TAB 2: XE DỊCH VỤ & THƯƠNG MẠI -->
              <div class="vf-mm-tab-content" id="vf-mm-tab-service">
                <div class="vf-mm-cars-grid vf-mm-cars-grid-5">

                  <a href="<?php echo esc_url(home_url('/product/vinfast-minio-green/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_minio.webp'); ?>" alt="Minio Green">
                    </div>
                    <span class="vf-mm-car-name">Minio Green</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-herio-green/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_herio.png'); ?>" alt="Herio Green">
                    </div>
                    <span class="vf-mm-car-name">Herio Green</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-nerio-green/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_nerio.webp'); ?>" alt="Nerio Green">
                    </div>
                    <span class="vf-mm-car-name">Nerio Green</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-limo-green/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_limo.png'); ?>" alt="Limo Green">
                    </div>
                    <span class="vf-mm-car-name">Limo Green</span>
                  </a>

                  <a href="<?php echo esc_url(home_url('/product/vinfast-ec-van/')); ?>" class="vf-mm-car-card">
                    <div class="vf-mm-car-img-box">
                      <img src="<?php echo esc_url($uploads_url . '/official_ecvan.webp'); ?>" alt="EC Van">
                    </div>
                    <span class="vf-mm-car-name">EC Van</span>
                  </a>

                </div>
              </div>

            </div>
          </div>
        </li>

        <!-- PHỤ KIỆN XE -->
        <li class="menu-item"><a href="<?php echo esc_url(home_url('/phu-kien/')); ?>">Phụ kiện xe</a></li>

        <!-- DỊCH VỤ HẬU MÃI (KÈM MEGA MENU DỊCH VỤ) -->
        <li class="menu-item menu-item-has-children vf-megamenu-item vf-megamenu-service-item">
          <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>">Dịch vụ hậu mãi <span class="vf-dropdown-arrow">▾</span></a>

          <div class="vf-megamenu-dropdown vf-service-megamenu-dropdown">
            <div class="vf-megamenu-inner vf-service-megamenu-inner">

              <!-- CỘT 1: SIDEBAR TABS CHỌN LOẠI PHƯƠNG TIỆN -->
              <div class="vf-service-sidebar">
                <button class="vf-service-tab-btn active" title="Dịch vụ Ô tô điện">
                  <img src="<?php echo esc_url($uploads_url . '/official_vf8.webp'); ?>" alt="Ô tô điện">
                </button>
                <button class="vf-service-tab-btn" title="Xe thương mại / Limo">
                  <img src="<?php echo esc_url($uploads_url . '/cutout_limo.png'); ?>" alt="Xe thương mại">
                </button>
                <button class="vf-service-tab-btn" title="Xe Buýt điện">
                  <img src="<?php echo esc_url($uploads_url . '/cutout_minio.png'); ?>" alt="Xe Buýt">
                </button>
              </div>

              <!-- CỘT 2: DANH SÁCH CÁC LIÊN KẾT DỊCH VỤ HẬU MÃI -->
              <div class="vf-service-links-col">
                <ul class="vf-service-links-list">
                  <li>
                    <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>">
                      Chính sách bảo hành
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo esc_url(home_url('/dich-vu-bao-duong/')); ?>">
                      Dịch vụ bảo dưỡng
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo esc_url(home_url('/dich-vu-sua-chua/')); ?>">
                      Dịch vụ sửa chữa
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo esc_url(home_url('/thong-tin-cuu-ho/')); ?>">
                      Thông tin cứu hộ
                    </a>
                  </li>
                </ul>
              </div>

              <!-- CỘT 3: 3 THẺ HÌNH ẢNH HÀNH ĐỘNG NỔI BẬT -->
              <div class="vf-service-cards-col">
                <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-service-card">
                  <img src="<?php echo esc_url($uploads_url . '/service_booking_banner.png'); ?>" alt="ĐẶT LỊCH DỊCH VỤ">
                  <div class="vf-service-card-overlay">
                    <span>ĐẶT LỊCH DỊCH VỤ</span>
                  </div>
                </a>

                <a href="<?php echo esc_url(home_url('/tim-kiem-showroom-tram-sac/')); ?>" class="vf-service-card">
                  <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="TRA CỨU XƯỞNG DỊCH VỤ">
                  <div class="vf-service-card-overlay">
                    <span>TRA CỨU XƯỞNG DỊCH VỤ</span>
                  </div>
                </a>

                <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/#warranty-book-dropdown')); ?>" class="vf-service-card">
                  <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="TRA CỨU TÀI LIỆU HƯỚNG DẪN">
                  <div class="vf-service-card-overlay">
                    <span>TRA CỨU TÀI LIỆU HƯỚNG DẪN</span>
                  </div>
                </a>
              </div>

            </div>
          </div>
        </li>

        <li class="menu-item"><a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>">Pin và trạm sạc</a></li>

        <!-- DỰ TOÁN & TRẢ GÓP -->
        <li class="menu-item"><a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>">Dự toán & Trả góp</a></li>

        <!-- SO SÁNH XE -->
        <li class="menu-item"><a href="<?php echo esc_url(home_url('/so-sanh-xe/')); ?>">So sánh xe</a></li>

        <!-- BÁO GIÁ LĂN BÁNH -->
        <li class="menu-item"><a href="<?php echo esc_url(home_url('/bao-gia-lan-banh/')); ?>">Báo giá lăn bánh</a></li>
      </ul>
    </div>

    <!-- RIGHT ACTION BUTTONS -->
    <div class="header-right">
      <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="vf-btn vf-btn-primary vf-header-btn"
        title="Đăng ký lái thử">
        <span class="vf-header-btn-text-desktop">ĐĂNG KÝ LÁI THỬ</span>
        <span class="vf-header-btn-text-mobile">LÁI THỬ</span>
      </a>
    </div>

    <style>
      /* Desktop: hiện full text, ẩn mobile text */
      .vf-header-btn-text-desktop {
        display: inline;
      }

      .vf-header-btn-text-mobile {
        display: none;
      }

      /* Mobile/Tablet: hiện text ngắn gọn, button nhỏ cân đối với logo */
      @media (max-width: 768px) {
        .vf-header-btn-text-desktop {
          display: none;
        }

        .vf-header-btn-text-mobile {
          display: inline;
        }

        .vf-header-btn {
          height: 32px !important;
          line-height: 32px !important;
          padding: 0 12px !important;
          font-size: 11px !important;
          letter-spacing: 0.3px !important;
          border-radius: 4px !important;
          white-space: nowrap !important;
        }
      }
    </style>

  </div>
</div>

<!-- OFF-CANVAS MOBILE MENU SLIDE-OUT (EXACT DESIGN MATCHING SAMPLE) -->
<div class="vf-mobile-drawer" id="vf-mobile-drawer">
  <!-- Dimmed Backdrop with top-right Floating Close '✕' Button -->
  <div class="vf-mobile-drawer-overlay" onclick="vfToggleMobileMenu()">
    <button class="vf-mobile-drawer-close-floating" onclick="vfToggleMobileMenu()" aria-label="Đóng menu">✕</button>
  </div>

  <div class="vf-mobile-drawer-content">

    <!-- SEARCH BAR BOX AT TOP OF DRAWER -->
    <div class="vf-drawer-search-box">
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="vf-drawer-search-form">
        <input type="search" name="s" placeholder="Tìm kiếm xe, phụ kiện, dịch vụ..." required class="vf-drawer-search-input">
        <button type="submit" class="vf-drawer-search-btn" aria-label="Search">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </form>
    </div>

    <!-- MENU ITEMS matching desktop menu structure -->
    <ul class="vf-mobile-menu-list">
      <li>
        <a href="<?php echo esc_url(home_url('/#gioi-thieu')); ?>">GIỚI THIỆU</a>
      </li>

      <!-- Ô TÔ (XE CÁ NHÂN & XE DỊCH VỤ) -->
      <li class="vf-has-child">
        <div class="vf-menu-item-head">
          <a href="<?php echo esc_url(home_url('/#xe-ca-nhan')); ?>">Ô TÔ</a>
          <button class="vf-submenu-toggle" onclick="vfToggleSubmenu(this)" aria-label="Mở danh mục ô tô">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>
        </div>
        <ul class="vf-submenu">
          <li class="vf-has-child-level2">
            <div class="vf-menu-item-head-sub">
              <span>Động cơ điện</span>
              <button class="vf-submenu-toggle-sub" onclick="vfToggleSubmenu(this)"
                aria-label="Mở danh mục động cơ điện">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </button>
            </div>
            <ul class="vf-submenu-sub">
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-2/')); ?>">VinFast VF 2</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-3/')); ?>">VinFast VF 3</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-5/')); ?>">VinFast VF 5</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-6/')); ?>">VinFast VF 6</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-mpv-7/')); ?>">VinFast VF MPV 7</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-7/')); ?>">VinFast VF 7</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-8/')); ?>">VinFast VF 8</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-8-all-new/')); ?>">VinFast VF 8 The All
                  New</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-9/')); ?>">VinFast VF 9</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-wild/')); ?>">VinFast VF Wild</a></li>
            </ul>
          </li>
          <li class="vf-has-child-level2">
            <div class="vf-menu-item-head-sub">
              <span>Xe dịch vụ & Thương mại</span>
              <button class="vf-submenu-toggle-sub" onclick="vfToggleSubmenu(this)" aria-label="Mở danh mục xe dịch vụ">
                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5">
                  <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
              </button>
            </div>
            <ul class="vf-submenu-sub">
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-minio-green/')); ?>">Minio Green</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-herio-green/')); ?>">Herio Green</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-nerio-green/')); ?>">Nerio Green</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-limo-green/')); ?>">Limo Green</a></li>
              <li><a href="<?php echo esc_url(home_url('/product/vinfast-ec-van/')); ?>">EC Van</a></li>
            </ul>
          </li>
        </ul>
      </li>

      <!-- PHỤ KIỆN XE -->
      <li>
        <a href="<?php echo esc_url(home_url('/phu-kien/')); ?>">PHỤ KIỆN XE</a>
      </li>

      <!-- DỊCH VỤ HẬU MÃI -->
      <li class="vf-has-child">
        <div class="vf-menu-item-head">
          <a href="<?php echo esc_url(home_url('/dich-vu/')); ?>">DỊCH VỤ HẬU MÃI</a>
          <button class="vf-submenu-toggle" onclick="vfToggleSubmenu(this)" aria-label="Mở dịch vụ hậu mãi">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>
        </div>
        <ul class="vf-submenu">
          <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>">Chính sách bảo hành</a></li>
          <li><a href="<?php echo esc_url(home_url('/dich-vu-bao-duong/')); ?>">Dịch vụ bảo dưỡng</a></li>
          <li><a href="<?php echo esc_url(home_url('/dich-vu-sua-chua/')); ?>">Dịch vụ sửa chữa</a></li>
          <li><a href="<?php echo esc_url(home_url('/thong-tin-cuu-ho/')); ?>">Thông tin cứu hộ</a></li>
          <li><a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>">Đặt lịch dịch vụ</a></li>
          <li><a href="<?php echo esc_url(home_url('/tim-kiem-showroom-tram-sac/')); ?>">Tra cứu xưởng dịch vụ</a></li>
          <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/#warranty-book-dropdown')); ?>">Tra cứu tài liệu hướng dẫn</a></li>
        </ul>
      </li>

      <!-- PIN VÀ TRẠM SẠC -->
      <li>
        <a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>">PIN VÀ TRẠM SẠC</a>
      </li>

      <!-- DỰ TOÁN & TRẢ GÓP -->
      <li>
        <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>">DỰ TOÁN & TRẢ GÓP</a>
      </li>

      <!-- SO SÁNH XE -->
      <li>
        <a href="<?php echo esc_url(home_url('/so-sanh-xe/')); ?>">SO SÁNH XE</a>
      </li>

      <!-- BÁO GIÁ LĂN BÁNH -->
      <li>
        <a href="<?php echo esc_url(home_url('/bao-gia-lan-banh/')); ?>">BÁO GIÁ LĂN BÁNH</a>
      </li>

      <!-- CHÍNH SÁCH BẢO MẬT -->
      <li>
        <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>">CHÍNH SÁCH BẢO MẬT</a>
      </li>
    </ul>

    <!-- MOBILE DRAWER FOOTER CTA -->
    <div class="vf-mobile-drawer-footer">
      <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="vf-btn vf-btn-primary vf-mobile-drawer-cta"
        onclick="vfToggleMobileMenu();">
        <span>ĐĂNG KÝ LÁI THỬ</span>
      </a>
    </div>

  </div>
</div>

<script>
  function vfToggleMobileMenu() {
    var drawer = document.getElementById('vf-mobile-drawer');
    if (drawer) {
      drawer.classList.toggle('open');
      document.body.style.overflow = drawer.classList.contains('open') ? 'hidden' : '';
    }
  }

  function vfToggleSubmenu(btn) {
    if (!btn) return;
    var parentLi = btn.closest('li');
    if (parentLi) {
      parentLi.classList.toggle('active');
    }
  }

  function vfSwitchMegaTab(tabName, evt) {
    if (evt) {
      evt.preventDefault();
      evt.stopPropagation();
    }
    var btn = evt ? (evt.currentTarget || evt.target) : null;
    if (!btn) return;
    var parent = btn.closest('.vf-megamenu-dropdown');
    if (!parent) return;

    var btns = parent.querySelectorAll('.vf-mm-tab-btn');
    for (var i = 0; i < btns.length; i++) {
      btns[i].classList.remove('active');
    }

    var contents = parent.querySelectorAll('.vf-mm-tab-content');
    for (var j = 0; j < contents.length; j++) {
      contents[j].classList.remove('active');
    }

    btn.classList.add('active');
    var targetContent = parent.querySelector('#vf-mm-tab-' + tabName);
    if (targetContent) {
      targetContent.classList.add('active');
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    var megaItems = document.querySelectorAll('.vf-megamenu-item');
    megaItems.forEach(function (item) {
      item.addEventListener('mouseenter', function () {
        this.classList.add('is-hover');
      });
      item.addEventListener('mouseleave', function () {
        this.classList.remove('is-hover');
      });
    });
  });
</script>