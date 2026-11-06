<?php
/**
 * Template Name: Dịch vụ bảo dưỡng - VinFast Vĩnh Phúc
 * Description: Trang dịch vụ bảo dưỡng xe ô tô điện VinFast chuẩn Mobile-First Responsive (Tối giản - Không icon)
 */

get_header();

$uploads_url = content_url('/uploads/official_cars/service');
?>

<div class="vf-m-page-wrapper">
  
  <!-- 1. HERO SECTION -->
  <section class="vf-m-hero">
    <div class="container vf-m-hero-inner">
      <h1 class="vf-m-hero-title">Dịch vụ bảo dưỡng</h1>
      <p class="vf-m-hero-subtitle">
        Bảo dưỡng định kỳ giúp duy trì trạng thái ổn định, kéo dài tuổi thọ của chi tiết; phát hiện sớm những hư hỏng trong quá trình sử dụng và giúp xe luôn hoạt động ổn định, an toàn, từ đó tiết kiệm chi phí và thời gian. Bảo dưỡng định kỳ được thực hiện theo một chu kỳ nhất định – quy định bằng quãng đường và thời gian sử dụng. Đây là điều kiện cần để được hưởng Chính sách Bảo hành.
      </p>
      <div class="vf-m-hero-actions">
        <button class="vf-m-btn-hero" onclick="vfOpenModal('modal-laythu')">ĐẶT LỊCH BẢO DƯỠNG</button>
      </div>
    </div>
    
    <div class="vf-m-hero-banner">
      <img src="<?php echo esc_url($uploads_url . '/service_booking_banner.png'); ?>" alt="VinFast Service Workshop">
    </div>
  </section>

  <!-- 2. MAIN LAYOUT CONTAINER (STICKY SIDEBAR + CONTENT) -->
  <div class="container vf-m-main-container">
    
    <!-- SIDEBAR NAV (DESKTOP STICKY / MOBILE HORIZONTAL SCROLL) -->
    <aside class="vf-m-sidebar">
      <nav class="vf-m-nav">
        <a href="#lich-trinh" class="vf-m-nav-link active">Lịch trình & Hạng mục bảo dưỡng</a>
        <a href="#uu-diem" class="vf-m-nav-link">Ưu điểm bảo dưỡng chính hãng</a>
        <a href="#quy-trinh" class="vf-m-nav-link">Quy trình dịch vụ bảo dưỡng</a>
        <a href="#ho-tro" class="vf-m-nav-link">Thông tin hỗ trợ</a>
      </nav>

      <div class="vf-m-sidebar-ctas hide-for-small">
        <button class="vf-m-side-btn primary" onclick="vfOpenModal('modal-laythu')">ĐẶT LỊCH BẢO DƯỠNG</button>
      </div>
    </aside>

    <!-- CONTENT COLUMN -->
    <main class="vf-m-content">

      <!-- SECTION 01: LỊCH TRÌNH & HẠNG MỤC BẢO DƯỠNG -->
      <section class="vf-m-section" id="lich-trinh">
        <div class="vf-m-section-head">
          <span class="vf-m-badge">01 · Chọn dòng xe</span>
          <h2>Lịch trình & Hạng mục bảo dưỡng</h2>
        </div>

        <!-- CATEGORY 1: ĐỘNG CƠ ĐIỆN -->
        <div class="vf-m-cat-group">
          <div class="vf-m-cat-title">Động cơ điện</div>
          <div class="vf-m-car-grid">
            
            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-3/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf3.webp'); ?>" alt="VF 3" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 3</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-5/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf5.webp'); ?>" alt="VF 5" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 5</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-6/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf6.webp'); ?>" alt="VF 6" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 6</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-mpv-7/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_mpv7.webp'); ?>" alt="VF MPV 7" class="vf-m-car-img">
              <span class="vf-m-car-name">VF MPV 7</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-7/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf7.webp'); ?>" alt="VF 7" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 7</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-8/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf8.webp'); ?>" alt="VF 8" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 8</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-8-all-new/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf8_allnew.png'); ?>" alt="VF 8 The All New" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 8 The All New</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-vf-9/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_vf9.webp'); ?>" alt="VF 9" class="vf-m-car-img">
              <span class="vf-m-car-name">VF 9</span>
            </a>

          </div>
        </div>

        <!-- CATEGORY 2: DÒNG XE DỊCH VỤ -->
        <div class="vf-m-cat-group">
          <div class="vf-m-cat-title">Dòng xe dịch vụ & Thương mại</div>
          <div class="vf-m-car-grid">
            
            <a href="<?php echo esc_url(home_url('/product/vinfast-minio-green/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_minio.webp'); ?>" alt="Minio Green" class="vf-m-car-img">
              <span class="vf-m-car-name">Minio Green</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-herio-green/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_herio.png'); ?>" alt="Herio Green" class="vf-m-car-img">
              <span class="vf-m-car-name">Herio Green</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-nerio-green/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_nerio.webp'); ?>" alt="Nerio Green" class="vf-m-car-img">
              <span class="vf-m-car-name">Nerio Green</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-limo-green/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_limo.png'); ?>" alt="Limo Green" class="vf-m-car-img">
              <span class="vf-m-car-name">Limo Green</span>
            </a>

            <a href="<?php echo esc_url(home_url('/product/vinfast-ec-van/')); ?>" class="vf-m-car-item">
              <img src="<?php echo esc_url($uploads_url . '/official_ecvan.webp'); ?>" alt="EC Van" class="vf-m-car-img">
              <span class="vf-m-car-name">EC Van</span>
            </a>

          </div>
        </div>
      </section>

      <!-- SECTION 02: ƯU ĐIỂM BẢO DƯỠNG CHÍNH HÃNG -->
      <section class="vf-m-section" id="uu-diem">
        <div class="vf-m-section-head">
          <span class="vf-m-badge">02 · Chất lượng tiêu chuẩn</span>
          <h2>Ưu điểm bảo dưỡng chính hãng</h2>
        </div>

        <div class="vf-m-adv-grid">
          <div class="vf-m-adv-card">
            <div class="vf-m-adv-img">
              <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="Bảo dưỡng tiêu chuẩn chính hãng">
            </div>
            <p class="vf-m-adv-text">
              Bảo dưỡng xe tại hệ thống Xưởng Dịch vụ VinFast Vĩnh Phúc giúp xe vận hành an toàn, bền bỉ và giữ giá trị lâu dài nhờ quy trình tiêu chuẩn chính hãng, đội ngũ kỹ thuật viên vững tay nghề được đào tạo bài bản và trang thiết bị hiện đại.
            </p>
          </div>

          <div class="vf-m-adv-card">
            <div class="vf-m-adv-img">
              <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="Kỹ thuật viên chuyên nghiệp">
            </div>
            <p class="vf-m-adv-text">
              Khách hàng hoàn toàn an tâm với chất lượng đồng bộ, chi phí minh bạch, không ảnh hưởng đến chế độ bảo hành và 100% sử dụng phụ tùng chính hãng VinFast, đảm bảo độ tương thích và an toàn tối đa trên mọi hành trình.
            </p>
          </div>
        </div>
      </section>

      <!-- SECTION 03: QUY TRÌNH DỊCH VỤ BẢO DƯỠNG -->
      <section class="vf-m-section" id="quy-trinh">
        <div class="vf-m-section-head">
          <span class="vf-m-badge">03 · Tiêu chuẩn 5 bước</span>
          <h2>Quy trình dịch vụ bảo dưỡng</h2>
        </div>

        <div class="vf-m-process-steps">
          <div class="vf-m-step-item">
            <div class="vf-m-step-num">01</div>
            <div class="vf-m-step-title">BƯỚC 1</div>
            <div class="vf-m-step-desc">Nhắc bảo dưỡng & Đặt hẹn</div>
          </div>

          <div class="vf-m-step-item">
            <div class="vf-m-step-num">02</div>
            <div class="vf-m-step-title">BƯỚC 2</div>
            <div class="vf-m-step-desc">Tiếp nhận và tư vấn</div>
          </div>

          <div class="vf-m-step-item">
            <div class="vf-m-step-num">03</div>
            <div class="vf-m-step-title">BƯỚC 3</div>
            <div class="vf-m-step-desc">Thực hiện bảo dưỡng</div>
          </div>

          <div class="vf-m-step-item">
            <div class="vf-m-step-num">04</div>
            <div class="vf-m-step-title">BƯỚC 4</div>
            <div class="vf-m-step-desc">Bàn giao xe</div>
          </div>

          <div class="vf-m-step-item">
            <div class="vf-m-step-num">05</div>
            <div class="vf-m-step-title">BƯỚC 5</div>
            <div class="vf-m-step-desc">Chăm sóc sau dịch vụ</div>
          </div>
        </div>

        <div class="vf-m-note-box">
          <ul>
            <li>Khách hàng mua xe mới và làm dịch vụ tại xưởng sẽ được hệ thống nhắc bảo dưỡng trước 10 ngày so với ngày dự kiến đến kỳ bảo dưỡng.</li>
            <li>Tặng 50 điểm VPoint cho Khách hàng đặt lịch trước qua App/Website và đến làm dịch vụ đúng hẹn (trong vòng 30 phút).</li>
          </ul>
        </div>

        <div class="vf-m-cta-box">
          <button class="vf-m-action-btn" onclick="vfOpenModal('modal-laythu')">ĐẶT LỊCH BẢO DƯỠNG NGAY</button>
        </div>

        <div class="vf-m-links-row">
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/#warranty-book-dropdown')); ?>" class="vf-m-link-card">
            <span>SỔ BẢO HÀNH Ô TÔ</span>
            <span>▾</span>
          </a>
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/#warranty-book-dropdown')); ?>" class="vf-m-link-card">
            <span>HƯỚNG DẪN SỬ DỤNG Ô TÔ</span>
            <span>↗</span>
          </a>
        </div>
      </section>

      <!-- SECTION 04: THÔNG TIN HỖ TRỢ -->
      <section class="vf-m-section" id="ho-tro">
        <div class="vf-m-section-head">
          <span class="vf-m-badge">04 · Liên hệ & Hỗ trợ</span>
          <h2>Thông tin hỗ trợ</h2>
        </div>

        <div class="vf-m-support-grid">
          
          <div class="vf-m-support-card">
            <h3>DỊCH VỤ KHÁCH HÀNG 24/7</h3>
            <a href="tel:0562256256" class="vf-m-phone-link">Hotline Tân Á Châu: 056 225 6256</a>
            <a href="tel:1900232389" class="vf-m-phone-link">Tổng đài VinFast: 1900 23 23 89 (Nhánh 1)</a>
            <a href="mailto:support.vn@vinfastauto.com" class="vf-m-email-link">Email: support.vn@vinfastauto.com</a>

            <h3 style="margin-top: 20px; color: #DC2626;">SPEAK-UP HOTLINE</h3>
            <a href="https://vinfast.ethicspoint.com/" target="_blank" rel="noopener" class="vf-m-email-link">Website: vinfast.ethicspoint.com</a>
            <a href="mailto:v.speakup@vinfast.vn" class="vf-m-email-link">Email: v.speakup@vinfast.vn</a>
          </div>

          <div class="vf-m-support-card">
            <h3>TÀI LIỆU LIÊN QUAN</h3>
            <p>Tra cứu sổ bảo hành điện tử và tài liệu kỹ thuật xe ô tô VinFast.</p>
            <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>" class="vf-m-support-banner-link">
              <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="Tra cứu tài liệu hướng dẫn">
              <div class="vf-m-banner-overlay">
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
  var navLinks = document.querySelectorAll('.vf-m-nav-link');
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
