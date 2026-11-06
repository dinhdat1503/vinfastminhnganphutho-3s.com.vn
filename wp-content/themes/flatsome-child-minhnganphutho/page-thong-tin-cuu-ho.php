<?php
/**
 * Template Name: Thông tin cứu hộ - VinFast Vĩnh Phúc
 * Description: Trang thông tin cứu hộ 24/7 và Hướng dẫn ứng phó khẩn cấp xe ô tô VinFast chuẩn Mobile-First Responsive
 */

get_header();

$uploads_url = content_url('/uploads/official_cars/service');
?>

<div class="vf-r-page-wrapper">
  
  <!-- 1. HERO SECTION -->
  <section class="vf-r-hero">
    <div class="container vf-r-hero-inner">
      <h1 class="vf-r-hero-title">Thông tin cứu hộ</h1>
      <p class="vf-r-hero-subtitle">
        Dịch vụ cứu hộ 24/7 dành riêng cho xe ô tô VinFast được triển khai sẵn sàng phục vụ Quý khách trên mọi nẻo đường. Trong suốt thời gian bảo hành, xe được hỗ trợ cứu hộ miễn phí về Xưởng dịch vụ VinFast Tân Á Châu hoặc trạm sạc gần nhất.
      </p>
    </div>
    
    <div class="vf-r-hero-banner">
      <img src="<?php echo esc_url($uploads_url . '/service_booking_banner.png'); ?>" alt="VinFast Emergency Rescue">
    </div>
  </section>

  <!-- 2. MAIN LAYOUT CONTAINER (STICKY SIDEBAR + CONTENT) -->
  <div class="container vf-r-main-container">
    
    <!-- SIDEBAR NAV (DESKTOP STICKY / MOBILE HORIZONTAL SCROLL) -->
    <aside class="vf-r-sidebar">
      <nav class="vf-r-nav">
        <a href="#thong-tin" class="vf-r-nav-link active">Thông tin cứu hộ 24/7</a>
        <a href="#huong-dan" class="vf-r-nav-link">Hướng dẫn ứng phó khẩn cấp</a>
        <a href="#ho-tro" class="vf-r-nav-link">Thông tin hỗ trợ</a>
      </nav>

      <div class="vf-r-sidebar-ctas hide-for-small">
        <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-r-side-btn primary vf-anim-btn">ĐẶT LỊCH DỊCH VỤ</a>
      </div>
    </aside>

    <!-- CONTENT COLUMN -->
    <main class="vf-r-content">

      <!-- SECTION 01: THÔNG TIN CỨU HỘ 24/7 -->
      <section class="vf-r-section vf-anim-fadein" id="thong-tin">
        <div class="vf-r-section-head">
          <span class="vf-r-badge">01 · An tâm mọi hành trình</span>
          <h2>Thông tin cứu hộ 24/7</h2>
        </div>

        <div class="vf-r-rescue-box">
          <div class="vf-r-rescue-img">
            <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="Dịch vụ cứu hộ VinFast">
          </div>
          <div class="vf-r-rescue-content">
            <h3>Cứu hộ 24/7 miễn phí:</h3>
            <ul>
              <li>Dịch vụ cứu hộ 24/7 dành riêng cho xe ô tô VinFast được triển khai tại các thị trường nơi VinFast cung cấp dịch vụ. Trong suốt thời gian bảo hành, xe sẽ được cứu hộ miễn phí với các dịch vụ tiêu chuẩn chính hãng.</li>
            </ul>

            <h3 style="margin-top: 18px;">Dịch vụ hỗ trợ trên đường:</h3>
            <ul>
              <li>Dịch vụ kéo xe về Xưởng dịch vụ ủy quyền VinFast Tân Á Châu gần nhất.</li>
              <li>Trường hợp xe hết năng lượng: Kéo xe về trạm sạc gần nhất hoặc nhà khách hàng (tùy điều kiện nào thuận tiện hơn).</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- SECTION 02: HƯỚNG DẪN ỨNG PHÓ KHẨN CẤP -->
      <section class="vf-r-section vf-anim-fadein" id="huong-dan">
        <div class="vf-r-section-head">
          <span class="vf-r-badge">02 · Tài liệu kỹ thuật</span>
          <h2>Hướng dẫn ứng phó khẩn cấp</h2>
        </div>

        <p class="vf-r-desc-text">
          Quý khách hàng tự chi trả chi phí cầu đường, phạt vi phạm (nếu có). Quý khách vui lòng tham khảo thông tin chi tiết về Hướng dẫn Ứng phó Khẩn cấp theo từng dòng xe trong danh sách bên dưới.
        </p>

        <div class="vf-r-accordion-card">
          <div class="vf-r-accordion-head">
            <span>HƯỚNG DẪN ỨNG PHÓ KHẨN CẤP TỪNG DÒNG XE</span>
            <span>▾</span>
          </div>

          <div class="vf-r-download-list">
            
            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF 3</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF 5</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF 6</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF MPV 7</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF 7</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF 8</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp VF 9</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

            <div class="vf-r-download-item">
              <span class="vf-r-car-label">Hướng dẫn ứng phó khẩn cấp Dòng xe Limo Green / EC Van</span>
              <a href="/#" class="vf-r-btn-download">Tải về</a>
            </div>

          </div>
        </div>
      </section>

      <!-- SECTION 03: THÔNG TIN HỖ TRỢ -->
      <section class="vf-r-section vf-anim-fadein" id="ho-tro">
        <div class="vf-r-section-head">
          <span class="vf-r-badge">03 · Liên hệ khẩn cấp 24/7</span>
          <h2>Thông tin hỗ trợ</h2>
        </div>

        <div class="vf-r-support-grid">
          
          <div class="vf-r-support-card">
            <h3>DỊCH VỤ CỨU HỘ KHẨN CẤP 24/7</h3>
            <a href="tel:0562256256" class="vf-r-phone-link">Hotline Tân Á Châu: 056 225 6256</a>
            <a href="tel:1900232389" class="vf-r-phone-link">Tổng đài Cứu hộ VinFast: 1900 23 23 89 (Nhánh 1)</a>
            <a href="mailto:support.vn@vinfastauto.com" class="vf-r-email-link">Email: support.vn@vinfastauto.com</a>

            <h3 style="margin-top: 20px; color: #DC2626;">SPEAK-UP HOTLINE</h3>
            <a href="https://vinfast.ethicspoint.com/" target="_blank" rel="noopener" class="vf-r-email-link">Website: vinfast.ethicspoint.com</a>
            <a href="mailto:v.speakup@vinfast.vn" class="vf-r-email-link">Email: v.speakup@vinfast.vn</a>
          </div>

          <div class="vf-r-support-card">
            <h3>TÀI LIỆU LIÊN QUAN</h3>
            <p>Tra cứu sổ bảo hành điện tử và tài liệu kỹ thuật xe ô tô VinFast.</p>
            <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>" class="vf-r-support-banner-link">
              <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="Tra cứu tài liệu hướng dẫn">
              <div class="vf-r-banner-overlay">
                <span>TRA CỨU TÀI LIỆU HƯỚNG DẪN</span>
              </div>
            </a>
          </div>

        </div>
      </section>

    </main>

  </div>
</div>

<script>
// Active Nav Link on Scroll
document.addEventListener('DOMContentLoaded', function() {
  var navLinks = document.querySelectorAll('.vf-r-nav-link');
  var sections = Array.from(navLinks).map(function(link) {
    var href = link.getAttribute('href');
    return href ? document.querySelector(href) : null;
  });

  window.addEventListener('scroll', function() {
    var scrollPos = window.scrollY + 140;
    var currentIndex = 0;

    sections.forEach(function(section, index) {
      if (section && section.offsetTop <= scrollPos) {
        currentIndex = index;
      }
    });

    navLinks.forEach(function(link, i) {
      if (i === currentIndex) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  });
});
</script>

<?php
get_footer();
