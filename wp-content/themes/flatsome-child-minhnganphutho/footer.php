<?php
/**
 * Custom Footer Template cho VinFast Vĩnh Phúc
 */
defined('ABSPATH') || exit;
$uploads_url = content_url('/uploads/official_cars/common');
?>

</main><!-- #main -->

<footer id="vf-footer" class="vf-footer">

  <!-- FOOTER TOP: ĐĂNG KÝ NHẬN BÁO GIÁ & LÁI THỬ -->
  <div class="vf-footer-top">
    <div class="container">
      <div class="vf-footer-cta-box">
        <div class="vf-footer-cta-text">
          <span class="vf-footer-cta-sub">ƯU ĐÃI ĐẶC BIỆT THÁNG NÀY</span>
          <h3 class="vf-footer-cta-title">Đăng Ký Nhận Báo Giá & Lái Thử Xe VinFast Tân Á Châu</h3>
          <p class="vf-footer-cta-desc">Nhận bảng tính chi phí lăn bánh, ưu đãi chính hãng & lịch lái thử tận nhà miễn
            phí.</p>
        </div>
        <form class="vf-footer-cta-form"
          onsubmit="event.preventDefault(); var n=this.querySelector('input[type=text]').value; var t=this.querySelector('input[type=tel]').value; if(window.vfOpenQuoteModal){window.vfOpenQuoteModal(); var mN=document.querySelector('#vfQuoteModal input[name=\'your-name\']'); if(mN)mN.value=n; var mT=document.querySelector('#vfQuoteModal input[name=\'your-tel\']'); if(mT)mT.value=t;}else{alert('Cảm ơn bạn! Chuyên viên VinFast Tân Á Châu sẽ liên hệ lại ngay.');}">
          <input type="text" placeholder="Họ và tên của bạn..." required class="vf-footer-input">
          <input type="tel" placeholder="Số điện thoại liên hệ..." required class="vf-footer-input">
          <button type="submit" class="vf-btn vf-btn-primary">ĐĂNG KÝ NGAY</button>
        </form>
      </div>
    </div>
  </div>

  <!-- FOOTER MAIN: 4 CỘT THÔNG TIN (MẪU GỐC THEME) -->
  <div class="vf-footer-main">
    <div class="container">
      <div class="vf-footer-grid">

        <!-- CỘT 1: THÔNG TIN ĐẠI LÝ -->
        <div class="vf-footer-col">
          <div class="vf-footer-brand">
            <img src="<?php echo esc_url($uploads_url . '/logo-tac-den.png'); ?>"
              alt="VinFast Tân Á Châu" class="vf-footer-logo"
              onerror="this.src='<?php echo esc_url($uploads_url . '/logo-tac-trang.png'); ?>'">
          </div>
          <h4 class="vf-footer-company-name">VINFAST TÂN Á CHÂU</h4>
          <p class="vf-footer-company-sub">Đại lý uỷ quyền chính thức của VinFast Việt Nam</p>
          <ul class="vf-footer-info-list">
            <li>
              <span class="vf-info-icon">📍</span>
              <span><strong>Địa chỉ:</strong> 191 Đường Hùng Vương, Phường Vĩnh Yên, Tỉnh Phú Thọ , Vinh Yen, Vietnam</span>
            </li>
            <li>
              <span class="vf-info-icon">📞</span>
              <span><strong>Hotline bán hàng:</strong> <a href="tel:0562256256" class="vf-footer-phone">056 225 6256</a></span>
            </li>
            <li>
              <span class="vf-info-icon">✉️</span>
              <span><strong>Email:</strong> <a
                  href="mailto:phuocvandangdilam@gmail.com">phuocvandangdilam@gmail.com</a></span>
            </li>
            <li>
              <span class="vf-info-icon">⏰</span>
              <span><strong>Giờ làm việc:</strong> 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</span>
            </li>
          </ul>
        </div>

        <!-- CỘT 2: CÁC DÒNG XE Ô TÔ ĐIỆN -->
        <div class="vf-footer-col">
          <h4 class="vf-footer-col-title">CÁC DÒNG XE</h4>
          <ul class="vf-footer-links">
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-2/')); ?>">VinFast VF 2 - Mini Electric</a>
            </li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-3/')); ?>">VinFast VF 3 - SUV Cỡ Nhỏ</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-5/')); ?>">VinFast VF 5 - A-SUV Năng Động</a>
            </li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-6/')); ?>">VinFast VF 6 - B-SUV Thời
                Thượng</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-mpv-7/')); ?>">VinFast VF MPV 7 - 7 Chỗ Đa
                Dụng</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-7/')); ?>">VinFast VF 7 - C-SUV Đẳng Cấp</a>
            </li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-8/')); ?>">VinFast VF 8 - D-SUV Đỉnh Cao</a>
            </li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-8-all-new/')); ?>">VinFast VF 8 The All
                New</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-9/')); ?>">VinFast VF 9 - E-SUV Sang Trọng</a>
            </li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-wild/')); ?>">VinFast VF Wild - Bán Tải Điện</a>
            </li>
          </ul>
        </div>

        <!-- CỘT 3: XE DỊCH VỤ & THƯƠNG MẠI -->
        <div class="vf-footer-col">
          <h4 class="vf-footer-col-title">DỊCH VỤ KHÁCH HÀNG</h4>
          <ul class="vf-footer-links">
            <li><a href="tel:0562256256">Hotline CSKH: <strong>056 225 6256</strong></a></li>
            <li><a href="mailto:phuocvandangdilam@gmail.com">Email: <strong>phuocvandangdilam@gmail.com</strong></a></li>
            <li><a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>">Đăng Ký Lái Thử Tận Nhà</a></li>
            <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>">Chính Sách Bảo Hành Chính Hãng</a>
            </li>
            <li><a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>">Mạng Lưới Pin & Trạm Sạc V-GREEN</a>
            </li>
          </ul>
        </div>

        <!-- CỘT 4: ĐĂNG KÝ TƯ VẤN DỊCH VỤ WEB -->
        <div class="vf-footer-col vf-footer-col-catchie">
          <h4 class="vf-footer-col-title vf-footer-col-title-full">ĐĂNG KÝ TƯ VẤN DỊCH VỤ WEB</h4>

          <form class="vf-footer-phone-form" id="vfFooterServiceForm" onsubmit="handleFooterServiceSubmit(event)">
            <div class="vf-footer-phone-input-wrap">
              <input type="tel" name="phone" id="vfFooterServicePhone" placeholder="Nhập số điện thoại..." required class="vf-footer-phone-input" pattern="[0-9]{10,11}">
              <button type="submit" id="btnFooterServiceSubmit" class="vf-footer-phone-btn">ĐĂNG KÝ</button>
            </div>
          </form>
          <div id="vfFooterServiceNotice" style="display:none; font-size:12px; margin-top:8px; line-height:1.4;"></div>

          <div class="vf-footer-catchie">
            Thiết kế bởi <a href="https://zalo.me/0971692675" target="_blank" rel="noopener noreferrer" title="Chat Zalo CATCHIE: 0971.69.2675"><strong>CATCHIE</strong></a>
          </div>

          <p class="vf-footer-disclaimer">
            * Website được vận hành bởi đại lý uỷ quyền của VinFast Việt Nam. Hình ảnh và thông số chỉ mang tính chất
            tham khảo.
          </p>
        </div>

      </div>
    </div>
  </div>

  <!-- FOOTER BOTTOM: COPYRIGHT & LEGAL -->
  <div class="vf-footer-bottom">
    <div class="container">
      <div class="vf-footer-bottom-inner">
        <p class="vf-copyright">© 2026 VinFast Tân Á Châu. Tất cả các quyền được bảo lưu.</p>
        <div class="vf-footer-legal-links">
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>">Chính sách bảo mật</a>
          <span class="dot">•</span>
          <a href="<?php echo esc_url(home_url('/dieu-khoan-su-dung/')); ?>">Điều khoản sử dụng</a>
        </div>
      </div>
    </div>
  </div>

</footer>

<!-- FLOATING CIRCULAR CONTACT BUTTONS (HOTLINE & ZALO) -->
<style id="vf-floating-contacts-style">
  .vf-floating-contacts {
    position: fixed !important;
    bottom: 30px !important;
    left: 24px !important;
    z-index: 999999 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 16px !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  .vf-float-btn {
    position: relative !important;
    width: 52px !important;
    height: 52px !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-decoration: none !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25) !important;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease !important;
    cursor: pointer !important;
  }

  .vf-float-btn:hover {
    transform: scale(1.12) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35) !important;
  }

  .vf-btn-hotline {
    background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%) !important;
  }

  .vf-btn-zalo {
    background: linear-gradient(135deg, #0088FF 0%, #0052CC 100%) !important;
  }

  .vf-float-icon-wrap {
    position: relative !important;
    z-index: 3 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    height: 100% !important;
  }

  .vf-btn-hotline .vf-float-svg {
    width: 24px !important;
    height: 24px !important;
    stroke: #ffffff !important;
    fill: none !important;
    animation: vf-phone-shake 2.5s infinite ease-in-out !important;
  }

  .vf-btn-zalo .vf-float-svg {
    width: 28px !important;
    height: 28px !important;
    fill: #ffffff !important;
    animation: vf-zalo-bounce 3s infinite ease-in-out !important;
  }

  .vf-float-tooltip {
    position: absolute !important;
    left: 64px !important;
    top: 50% !important;
    transform: translateY(-50%) translateX(-8px) !important;
    background: #0F172A !important;
    color: #ffffff !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    padding: 6px 14px !important;
    border-radius: 20px !important;
    white-space: nowrap !important;
    opacity: 0 !important;
    visibility: hidden !important;
    transition: all 0.25s ease !important;
    pointer-events: none !important;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2) !important;
    z-index: 4 !important;
  }

  .vf-float-btn:hover .vf-float-tooltip {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(-50%) translateX(0) !important;
  }

  .vf-pulse-wave {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    border-radius: 50% !important;
    pointer-events: none !important;
    z-index: 1 !important;
    animation: vf-ripple 2s infinite ease-out !important;
  }

  .vf-btn-hotline .vf-pulse-wave {
    border: 2px solid rgba(239, 68, 68, 0.6) !important;
  }

  .vf-btn-zalo .vf-pulse-wave {
    border: 2px solid rgba(0, 136, 255, 0.6) !important;
  }

  .vf-pulse-wave.wave-delay {
    animation-delay: 0.8s !important;
  }

  @keyframes vf-ripple {
    0% {
      transform: scale(1);
      opacity: 0.8;
    }

    100% {
      transform: scale(1.7);
      opacity: 0;
    }
  }

  @keyframes vf-phone-shake {

    0%,
    100% {
      transform: rotate(0deg);
    }

    10%,
    30% {
      transform: rotate(-15deg);
    }

    20%,
    40% {
      transform: rotate(15deg);
    }

    50% {
      transform: rotate(0deg);
    }
  }

  @keyframes vf-zalo-bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
      transform: translateY(0);
    }

    40% {
      transform: translateY(-4px);
    }

    60% {
      transform: translateY(-2px);
    }
  }

  #top-link,
  .back-to-top,
  .vf-back-to-top,
  a.back-to-top {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
  }

  /* FLOATING SIDEBAR (RIGHT) */
  #vf-float-sidebar {
    position: fixed !important;
    top: 50% !important;
    right: 0 !important;
    transform: translateY(-50%) !important;
    z-index: 99999 !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 6px !important;
  }

  #vf-float-sidebar li {
    margin: 0 !important;
    display: block !important;
  }

  #vf-float-sidebar a {
    display: flex !important;
    align-items: center !important;
    justify-content: flex-end !important;
    text-decoration: none !important;
    color: #fff !important;
  }

  #vf-float-sidebar .vf-float-icon {
    width: 44px !important;
    height: 44px !important;
    background: #0F172A !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    border-right: none !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
    box-shadow: -3px 4px 14px rgba(0, 0, 0, 0.2) !important;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    color: #ffffff !important;
  }

  #vf-float-sidebar .vf-float-icon svg {
    stroke: #ffffff !important;
    transition: transform 0.3s ease !important;
  }

  #vf-float-sidebar .vf-float-text {
    background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
    color: #fff !important;
    height: 44px !important;
    line-height: 44px !important;
    padding: 0 !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    font-family: 'VinFast Sans', 'Plus Jakarta Sans', -apple-system, sans-serif !important;
    letter-spacing: 0.3px !important;
    white-space: nowrap !important;
    max-width: 0 !important;
    opacity: 0 !important;
    overflow: hidden !important;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    border-top-left-radius: 8px !important;
    border-bottom-left-radius: 8px !important;
    box-shadow: -6px 6px 20px rgba(37, 99, 235, 0.35) !important;
  }

  #vf-float-sidebar li:hover .vf-float-text {
    max-width: 200px !important;
    opacity: 1 !important;
    padding: 0 16px 0 18px !important;
  }

  #vf-float-sidebar li:hover .vf-float-icon {
    background: #2563EB !important;
    border-color: #2563EB !important;
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4) !important;
  }

  #vf-float-sidebar li:hover .vf-float-icon svg {
    transform: scale(1.15) !important;
  }

  /* MOBILE & TABLET RESPONSIVE RULES */
  @media (max-width: 1024px),
  (hover: none) {
    #vf-float-sidebar {
      display: none !important;
    }
  }

  @media (max-width: 768px) {
    #vf-float-sidebar {
      display: none !important;
    }

    .vf-floating-contacts {
      bottom: calc(68px + env(safe-area-inset-bottom, 0px)) !important;
      left: 14px !important;
      gap: 10px !important;
    }

    .vf-float-btn {
      width: 44px !important;
      height: 44px !important;
    }

    .vf-btn-hotline .vf-float-svg {
      width: 20px !important;
      height: 20px !important;
    }

    .vf-btn-zalo .vf-float-svg {
      width: 22px !important;
      height: 22px !important;
    }

    .vf-float-tooltip {
      display: none !important;
    }

  }
</style>

<div class="vf-floating-contacts" id="vfFloatingContacts">
  <!-- Hotline Button -->
  <a href="tel:0562256256" class="vf-float-btn vf-btn-hotline" title="Gọi ngay Hotline 056 225 6256"
    aria-label="Hotline">
    <div class="vf-float-icon-wrap">
      <svg class="vf-float-svg" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path
          d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
        </path>
      </svg>
    </div>
    <span class="vf-float-tooltip">Hotline: 056 225 6256</span>
    <span class="vf-pulse-wave"></span>
    <span class="vf-pulse-wave wave-delay"></span>
  </a>

  <!-- Zalo Button -->
  <a href="https://zalo.me/0562256256" target="_blank" rel="noopener noreferrer" class="vf-float-btn vf-btn-zalo"
    title="Chat Zalo tư vấn miễn phí" aria-label="Chat Zalo">
    <div class="vf-float-icon-wrap">
      <svg class="vf-float-svg" viewBox="0 0 48 48">
        <path
          d="M24 4C12.95 4 4 12.51 4 23.01c0 5.4 2.34 10.28 6.13 13.73-.25 3.32-1.46 7.42-3.8 10.02a1 1 0 00.95 1.63c5.68-.34 10.45-3.08 13.06-4.94 1.18.23 2.4.36 3.66.36 11.05 0 20-8.51 20-19.01S35.05 4 24 4zm-9.5 24.5a2 2 0 110-4 2 2 0 010 4zm9.5 0a2 2 0 110-4 2 2 0 010 4zm9.5 0a2 2 0 110-4 2 2 0 010 4z" />
      </svg>
    </div>
    <span class="vf-float-tooltip">Chat Zalo</span>
    <span class="vf-pulse-wave"></span>
    <span class="vf-pulse-wave wave-delay"></span>
  </a>
</div><!-- .vf-floating-contacts -->

</div><!-- #wrapper -->

<script>
function handleFooterServiceSubmit(e) {
  e.preventDefault();
  var input = document.getElementById('vfFooterServicePhone');
  var btn = document.getElementById('btnFooterServiceSubmit');
  var notice = document.getElementById('vfFooterServiceNotice');
  var phone = input ? input.value.trim() : '';

  if (!phone) return;

  btn.disabled = true;
  var origText = btn.textContent;
  btn.textContent = '...';

  var formData = new FormData();
  formData.append('action', 'vf_submit_footer_service_form');
  formData.append('phone', phone);

  fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
    method: 'POST',
    body: formData
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    if (notice) {
      notice.style.display = 'block';
      if (data.success) {
        notice.style.color = '#4ADE80';
        notice.textContent = '✓ ' + (data.data && data.data.message ? data.data.message : 'Đã nhận số điện thoại! Sẽ liên hệ tư vấn ngay.');
        input.value = '';
      } else {
        notice.style.color = '#F87171';
        notice.textContent = (data.data && data.data.message) ? data.data.message : 'Có lỗi xảy ra, vui lòng thử lại.';
      }
    } else {
      alert('Đã gửi số điện thoại thành công! Chúng tôi sẽ liên hệ lại ngay.');
      input.value = '';
    }
  })
  .catch(function(err) {
    if (notice) {
      notice.style.display = 'block';
      notice.style.color = '#4ADE80';
      notice.textContent = '✓ Đã nhận số điện thoại! Chuyên viên sẽ gọi tư vấn ngay.';
    } else {
      alert('Đã nhận số điện thoại! Chuyên viên sẽ gọi tư vấn ngay.');
    }
    input.value = '';
  })
  .finally(function() {
    btn.disabled = false;
    btn.textContent = origText;
  });
}
</script>

<?php wp_footer(); ?>

</body>

</html>