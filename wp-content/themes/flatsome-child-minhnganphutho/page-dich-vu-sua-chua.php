<?php
/**
 * Template Name: Dịch vụ sửa chữa - VinFast Vĩnh Phúc
 * Description: Trang dịch vụ sửa chữa xe ô tô điện VinFast chuẩn Mobile-First Responsive (Tối giản - Animation nút mượt mạ)
 */

get_header();

$uploads_url = content_url('/uploads/official_cars/service');
?>

<div class="vf-s-page-wrapper">
  
  <!-- 1. HERO SECTION -->
  <section class="vf-s-hero">
    <div class="container vf-s-hero-inner">
      <h1 class="vf-s-hero-title">Dịch vụ sửa chữa</h1>
      <p class="vf-s-hero-subtitle">
        Hệ thống Xưởng Dịch vụ VinFast Tân Á Châu trang bị máy móc, thiết bị chẩn đoán hiện đại theo tiêu chuẩn toàn cầu từ Ý, Đức, Nhật; sẵn sàng phục vụ và đáp ứng mọi nhu cầu sửa chữa chung, sửa chữa đồng sơn và khắc phục sự cố kỹ thuật cho chiếc xe của Quý khách.
      </p>
      <div class="vf-s-hero-actions">
        <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-s-btn-hero vf-anim-btn">ĐẶT LỊCH SỬA CHỮA</a>
      </div>
    </div>
    
    <div class="vf-s-hero-banner">
      <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="VinFast Repair Workshop">
    </div>
  </section>

  <!-- 2. MAIN LAYOUT CONTAINER (STICKY SIDEBAR + CONTENT) -->
  <div class="container vf-s-main-container">
    
    <!-- SIDEBAR NAV (DESKTOP STICKY / MOBILE HORIZONTAL SCROLL) -->
    <aside class="vf-s-sidebar">
      <nav class="vf-s-nav">
        <a href="#quy-trinh" class="vf-s-nav-link active">Quy trình dịch vụ sửa chữa</a>
        <a href="#phan-loai" class="vf-s-nav-link">Phân loại dịch vụ sửa chữa</a>
        <a href="#cam-ket" class="vf-s-nav-link">Cam kết thời gian sửa chữa</a>
        <a href="#phu-tung" class="vf-s-nav-link">Phụ tùng chính hãng</a>
        <a href="#ho-tro" class="vf-s-nav-link">Thông tin hỗ trợ</a>
      </nav>

      <div class="vf-s-sidebar-ctas hide-for-small">
        <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-s-side-btn primary vf-anim-btn">ĐẶT LỊCH SỬA CHỮA</a>
      </div>
    </aside>

    <!-- CONTENT COLUMN -->
    <main class="vf-s-content">

      <!-- SECTION 01: QUY TRÌNH DỊCH VỤ SỬA CHỮA -->
      <section class="vf-s-section vf-anim-fadein" id="quy-trinh">
        <div class="vf-s-section-head">
          <span class="vf-s-badge">01 · Quy trình 5 bước</span>
          <h2>Quy trình dịch vụ sửa chữa</h2>
          <p class="vf-s-section-sub">Chuyên nghiệp và chu đáo với 5 bước chuẩn hóa nhà máy</p>
        </div>

        <div class="vf-s-process-steps">
          <div class="vf-s-step-item">
            <div class="vf-s-step-num">01</div>
            <div class="vf-s-step-title">BƯỚC 1</div>
            <div class="vf-s-step-desc">Đặt hẹn sửa chữa</div>
          </div>

          <div class="vf-s-step-item">
            <div class="vf-s-step-num">02</div>
            <div class="vf-s-step-title">BƯỚC 2</div>
            <div class="vf-s-step-desc">Tiếp nhận và tư vấn</div>
          </div>

          <div class="vf-s-step-item">
            <div class="vf-s-step-num">03</div>
            <div class="vf-s-step-title">BƯỚC 3</div>
            <div class="vf-s-step-desc">Thực hiện sửa chữa</div>
          </div>

          <div class="vf-s-step-item">
            <div class="vf-s-step-num">04</div>
            <div class="vf-s-step-title">BƯỚC 4</div>
            <div class="vf-s-step-desc">Bàn giao xe</div>
          </div>

          <div class="vf-s-step-item">
            <div class="vf-s-step-num">05</div>
            <div class="vf-s-step-title">BƯỚC 5</div>
            <div class="vf-s-step-desc">Chăm sóc sau sửa chữa</div>
          </div>
        </div>

        <div class="vf-s-note-box">
          <p>Tặng 50 điểm VPoint cho Khách hàng đặt lịch trước qua App/Website và đến làm dịch vụ đúng hẹn (trong vòng 30 phút).</p>
        </div>

        <div class="vf-s-cta-box">
          <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-s-action-btn vf-anim-btn">ĐẶT LỊCH SỬA CHỮA NGAY</a>
        </div>
      </section>

      <!-- SECTION 02: PHÂN LOẠI DỊCH VỤ SỬA CHỮA -->
      <section class="vf-s-section vf-anim-fadein" id="phan-loai">
        <div class="vf-s-section-head">
          <span class="vf-s-badge">02 · Hạng mục chuyên sâu</span>
          <h2>Phân loại dịch vụ sửa chữa</h2>
        </div>

        <div class="vf-s-services-grid">
          
          <div class="vf-s-service-card">
            <div class="vf-s-service-img">
              <img src="<?php echo esc_url($uploads_url . '/service_booking_banner.png'); ?>" alt="Dịch vụ Sửa chữa Chung">
            </div>
            <div class="vf-s-service-info">
              <h3>Dịch vụ Sửa chữa Chung</h3>
              <ul>
                <li>Chẩn đoán chính xác lỗi phần mềm, hệ thống pin, động cơ điện, hệ thống phanh, treo và điều hòa.</li>
                <li>Phụ tùng chính hãng VinFast luôn sẵn có, đảm bảo thời gian xử lý nhanh nhất.</li>
                <li>Trang thiết bị chẩn đoán chuyên dụng nhập khẩu từ Ý, Đức, Nhật đáp ứng tiêu chuẩn kỹ thuật khắt khe.</li>
                <li>Hệ thống quản lý lịch sử xe toàn quốc, chăm sóc Khách hàng đồng bộ tại mọi đại lý.</li>
                <li>Kỹ thuật viên VinFast được đào tạo trực tiếp tại nhà máy, đạt chứng chỉ chuyên môn cao.</li>
              </ul>
            </div>
          </div>

          <div class="vf-s-service-card">
            <div class="vf-s-service-img">
              <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="Dịch vụ Sửa chữa Đồng sơn">
            </div>
            <div class="vf-s-service-info">
              <h3>Dịch vụ Sửa chữa Đồng sơn</h3>
              <p>VinFast mang đến dịch vụ Sửa chữa đồng sơn hiện đại, đạt chuẩn nhà máy với công nghệ tiên tiến hàng đầu từ Ý, Nhật, Đức:</p>
              <ul>
                <li>Phục hồi thân vỏ, kéo nắn khung gầm bằng máy đo vi tính độ chính xác 100%.</li>
                <li>Phòng sơn sấy khép kín tiêu chuẩn quốc tế, đảm bảo hạt sơn bóng mịn, giữ màu nguyên bản.</li>
                <li>Sử dụng sơn gốc nước thân thiện môi trường, độ bền cao và bảo hành màu sơn chính hãng.</li>
              </ul>
            </div>
          </div>

        </div>
      </section>

      <!-- SECTION 03: CAM KẾT THỜI GIAN SỬA CHỮA -->
      <section class="vf-s-section vf-anim-fadein" id="cam-ket">
        <div class="vf-s-section-head">
          <span class="vf-s-badge">03 · Quyền lợi khách hàng</span>
          <h2>Cam kết thời gian sửa chữa</h2>
        </div>

        <div class="vf-s-commitment-box">
          <p class="vf-s-commitment-intro">
            VinFast cam kết minh bạch và đúng hẹn trong thời gian sửa chữa, nhằm nâng cao trải nghiệm và sự hài lòng tuyệt đối của Khách hàng.
          </p>

          <div class="vf-s-commit-grid">
            <div class="vf-s-commit-item">
              <div class="vf-s-commit-val">500.000 VNĐ / ngày</div>
              <div class="vf-s-commit-desc">Hỗ trợ cho Khách hàng nếu thời gian sửa chữa vượt quá thời hạn đã cam kết.</div>
            </div>

            <div class="vf-s-commit-item">
              <div class="vf-s-commit-val">Thẻ Taxi GSM 500k/ngày</div>
              <div class="vf-s-commit-desc">Tặng thẻ di chuyển taxi GSM 500.000 VNĐ/xe/ngày trong thời gian chờ sửa chữa động cơ hoặc PDU/POD.</div>
            </div>

            <div class="vf-s-commit-item">
              <div class="vf-s-commit-val">Hỗ trợ mượn Pin chính hãng</div>
              <div class="vf-s-commit-desc">Trường hợp sửa chữa pin, Khách hàng được hỗ trợ mượn pin miễn phí để tiếp tục di chuyển bình thường.</div>
            </div>
          </div>

          <div class="vf-s-commit-terms">
            <p><strong>Áp dụng cho:</strong> Tất cả Khách hàng sở hữu ô tô điện VinFast chính hãng.</p>
            <p><strong>Không áp dụng:</strong> Vào các ngày nghỉ lễ, Tết theo quy định của Nhà nước.</p>
          </div>
        </div>
      </section>

      <!-- SECTION 04: PHỤ TÙNG CHÍNH HÃNG -->
      <section class="vf-s-section vf-anim-fadein" id="phu-tung">
        <div class="vf-s-section-head">
          <span class="vf-s-badge">04 · Chất lượng toàn cầu</span>
          <h2>Phụ tùng chính hãng</h2>
        </div>

        <div class="vf-s-parts-banner">
          <div class="vf-s-parts-overlay">
            <h3>Kiểm soát chất lượng nghiêm ngặt PPAP</h3>
            <p>Áp dụng quy trình đánh giá PPAP (Phê duyệt linh kiện trước khi sản xuất hàng loạt từ AIAG Mỹ) trên toàn bộ linh kiện, đảm bảo độ chính xác và an toàn tuyệt đối.</p>
            
            <h3 style="margin-top: 20px;">Đối tác công nghệ toàn cầu</h3>
            <p>VinFast hợp tác cùng các tập đoàn uy tín thế giới như Bosch, ZF, CATL, Continental... Ưu tiên đối tác đạt chứng chỉ khắt khe của ngành ô tô IATF 16949 và ISO 14001.</p>
          </div>
        </div>

        <div class="vf-s-links-row" style="margin-top: 24px;">
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/#warranty-book-dropdown')); ?>" class="vf-s-link-card">
            <span>SỔ BẢO HÀNH Ô TÔ</span>
            <span>▾</span>
          </a>
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/#warranty-book-dropdown')); ?>" class="vf-s-link-card">
            <span>HƯỚNG DẪN SỬ DỤNG Ô TÔ</span>
            <span>↗</span>
          </a>
        </div>
      </section>

      <!-- SECTION 05: THÔNG TIN HỖ TRỢ -->
      <section class="vf-s-section vf-anim-fadein" id="ho-tro">
        <div class="vf-s-section-head">
          <span class="vf-s-badge">05 · Liên hệ 24/7</span>
          <h2>Thông tin hỗ trợ</h2>
        </div>

        <div class="vf-s-support-grid">
          
          <div class="vf-s-support-card">
            <h3>DỊCH VỤ KHÁCH HÀNG 24/7</h3>
            <a href="tel:0562256256" class="vf-s-phone-link">Hotline Tân Á Châu: 056 225 6256</a>
            <a href="tel:1900232389" class="vf-s-phone-link">Tổng đài VinFast: 1900 23 23 89 (Nhánh 1)</a>
            <a href="mailto:support.vn@vinfastauto.com" class="vf-s-email-link">Email: support.vn@vinfastauto.com</a>
          </div>

          <div class="vf-s-support-card">
            <h3>TÀI LIỆU LIÊN QUAN</h3>
            <p>Tra cứu sổ bảo hành điện tử và tài liệu kỹ thuật xe ô tô VinFast.</p>
            <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>" class="vf-s-support-banner-link">
              <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="Tra cứu tài liệu hướng dẫn">
              <div class="vf-s-banner-overlay">
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
  var navLinks = document.querySelectorAll('.vf-s-nav-link');
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
