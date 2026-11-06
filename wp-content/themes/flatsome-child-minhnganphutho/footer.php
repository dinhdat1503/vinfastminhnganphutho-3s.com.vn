<?php
/**
 * Custom Footer Template cho VinFast Minh Ngân Phú Thọ 3S
 * Đáp ứng đầy đủ quy chuẩn thương hiệu VinFast & Thiết kế Concept A Showroom
 */
defined('ABSPATH') || exit;
?>

</main><!-- #main -->

<footer id="vf-footer" class="site-footer vf-footer" style="background:#11161F; border-top:1px solid rgba(255,255,255,0.08);">

  <!-- FOOTER MAIN: 4 CỘT THÔNG TIN -->
  <div class="footer-main-wrap" style="padding:60px 0 40px; color:#CBD5E1;">
    <div class="container">
      <div class="footer-grid">

        <!-- CỘT 1: THÔNG TIN ĐẠI LÝ -->
        <div class="footer-col">
          <div class="brand-text" style="margin-bottom:18px;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
              <svg viewBox="0 0 40 40" fill="none" width="32" height="32">
                <path d="M20 4L4 12V28L20 36L36 28V12L20 4Z" stroke="#3B82F6" stroke-width="2.5" fill="rgba(59,130,246,0.1)"/>
                <path d="M12 16L20 28L28 16L20 21L12 16Z" fill="#3B82F6"/>
              </svg>
              <span class="brand-title" style="font-size:18px; font-weight:800; color:#fff; letter-spacing:0.04em;">VINFAST MINH NGÂN</span>
            </div>
            <span class="brand-subtitle" style="color:#94A3B8; font-size:11px; letter-spacing:0.06em; font-weight:600;">ĐẠI LÝ ỦY QUYỀN CHÍNH THỨC 3S TẠI PHÚ THỌ</span>
          </div>
          <p class="caption" style="line-height:1.7; color:#94A3B8; margin-bottom:18px;">
            Đại lý ủy quyền 3S chính thức của VinFast Việt Nam tại Phú Thọ. Cam kết mang đến trải nghiệm tư vấn, mua xe và dịch vụ sau bán hàng tiêu chuẩn quốc tế.
          </p>
          <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px; font-size:13px;">
            <li style="display:flex; gap:8px;">
              <span>📍</span>
              <span><strong>Địa chỉ:</strong> Đường Nguyễn Tất Thành, Phường Thanh Miếu, TP. Việt Trì, Tỉnh Phú Thọ</span>
            </li>
            <li style="display:flex; gap:8px;">
              <span>📞</span>
              <span><strong>Hotline:</strong> <a href="tel:0981335522" style="color:#60A5FA; font-weight:700;">0981 33 55 22</a></span>
            </li>
            <li style="display:flex; gap:8px;">
              <span>✉️</span>
              <span><strong>Email:</strong> <a href="mailto:kinhdoanh@vinfastminhnganphutho-3s.com.vn" style="color:#CBD5E1;">kinhdoanh@vinfastminhnganphutho-3s.com.vn</a></span>
            </li>
            <li style="display:flex; gap:8px;">
              <span>⏰</span>
              <span><strong>Giờ mở cửa:</strong> 08:00 – 18:00 (Thứ 2 – Chủ Nhật)</span>
            </li>
          </ul>
        </div>

        <!-- CỘT 2: CÁC DÒNG XE CÁ NHÂN -->
        <div class="footer-col">
          <h4 style="color:#fff; font-size:15px; font-weight:700; margin-bottom:16px;">DÒNG XE CÁ NHÂN</h4>
          <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px; font-size:14px;">
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-3/')); ?>" style="color:#94A3B8; text-decoration:none;">VinFast VF 3 — Mini SUV</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-5/')); ?>" style="color:#94A3B8; text-decoration:none;">VinFast VF 5 Plus — A-SUV</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-6/')); ?>" style="color:#94A3B8; text-decoration:none;">VinFast VF 6 — B-SUV</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-7/')); ?>" style="color:#94A3B8; text-decoration:none;">VinFast VF 7 — C-SUV Thể Thao</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-8/')); ?>" style="color:#94A3B8; text-decoration:none;">VinFast VF 8 — D-SUV Sang Trọng</a></li>
            <li><a href="<?php echo esc_url(home_url('/product/vinfast-vf-9/')); ?>" style="color:#94A3B8; text-decoration:none;">VinFast VF 9 — E-SUV Flagship</a></li>
          </ul>
        </div>

        <!-- CỘT 3: DỊCH VỤ & TÀI CHÍNH -->
        <div class="footer-col">
          <h4 style="color:#fff; font-size:15px; font-weight:700; margin-bottom:16px;">DỊCH VỤ & TÀI CHÍNH</h4>
          <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px; font-size:14px;">
            <li><a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>" style="color:#94A3B8; text-decoration:none;">Dự toán chi phí lăn bánh</a></li>
            <li><a href="<?php echo esc_url(home_url('/du-toan-tra-gop/')); ?>" style="color:#94A3B8; text-decoration:none;">Tính kế hoạch vay trả góp</a></li>
            <li><a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" style="color:#94A3B8; text-decoration:none;">Đăng ký lái thử tận nhà</a></li>
            <li><a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" style="color:#94A3B8; text-decoration:none;">Đặt hẹn bảo dưỡng 4 bước</a></li>
            <li><a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>" style="color:#94A3B8; text-decoration:none;">Chính sách bảo hành 10 năm</a></li>
            <li><a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>" style="color:#94A3B8; text-decoration:none;">Mạng lưới trạm sạc V-GREEN</a></li>
          </ul>
        </div>

        <!-- CỘT 4: ĐĂNG KÝ TƯ VẤN DỊCH VỤ WEB -->
        <div class="footer-col footer-col-form">
          <h4 class="footer-col-title footer-col-title-web" style="color:#fff; font-size:15px; font-weight:700; text-transform:uppercase; letter-spacing:0.02em; padding-bottom:10px; margin-bottom:16px; border-bottom:2px solid #2563EB; line-height:1.4;">
            ĐĂNG KÝ TƯ VẤN DỊCH VỤ WEB
          </h4>

          <form id="vfFooterConsultForm" class="vf-footer-consult-form" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
            <?php wp_nonce_field('vf_footer_consult_nonce', 'vf_consult_nonce'); ?>
            <input type="hidden" name="action" value="vf_submit_footer_service_form">
            <input type="hidden" name="lead_source" value="footer_web_service_consultation">
            <!-- Honeypot chống bot spam -->
            <input type="text" name="vf_hp_check" value="" class="vf-hp-field" tabindex="-1" autocomplete="off" aria-hidden="true">

            <div class="footer-form-controls">
              <input type="tel"
                     name="phone"
                     id="vfFooterPhone"
                     class="footer-input-tel"
                     placeholder="Nhập số điện thoại"
                     required
                     pattern="0[0-9]{9}"
                     inputmode="tel"
                     maxlength="11"
                     aria-label="Số điện thoại tư vấn làm web">
              <button type="submit" id="vfFooterSubmitBtn" class="btn btn-footer-submit">
                <span class="btn-text">ĐĂNG KÝ</span>
                <span class="btn-spinner" aria-hidden="true" style="display:none;">⏳</span>
              </button>
            </div>

            <div id="vfFooterStatus" class="footer-form-status" style="display:none;" role="alert" aria-live="polite"></div>
          </form>

          <div class="footer-catchie-wrap" style="margin-top:20px; font-size:13.5px; color:#94A3B8;">
            Thiết kế bởi <a href="https://zalo.me/0971692675" target="_blank" rel="noopener noreferrer" class="catchie-link" title="Liên hệ Zalo Catchie: 0971.69.2675" style="color:#FFFFFF; font-weight:800; letter-spacing:0.04em; text-decoration:none; transition:color 0.2s ease;">CATCHIE</a>
          </div>

          <p class="footer-disclaimer" style="margin-top:16px; line-height:1.6; color:#64748B; font-size:11.5px; font-style:italic;">
            * Website được vận hành bởi đại lý uỷ quyền của VinFast Việt Nam. Hình ảnh và thông số chỉ mang tính chất tham khảo.
          </p>
        </div>

      </div>

      <!-- FOOTER BOTTOM: COPYRIGHT & LEGAL -->
      <div class="footer-bottom" style="margin-top:40px; padding-top:24px; border-top:1px solid rgba(255,255,255,0.08); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; font-size:12px; color:#64748B;">
        <span>&copy; <?php echo date('Y'); ?> VinFast Minh Ngân Phú Thọ 3S. Tất cả các quyền được bảo lưu.</span>
        <div style="display:flex; gap:16px;">
          <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>" style="color:#94A3B8; text-decoration:none;">Chính sách bảo mật</a>
          <span>•</span>
          <a href="<?php echo esc_url(home_url('/dieu-khoan-su-dung/')); ?>" style="color:#94A3B8; text-decoration:none;">Điều khoản sử dụng</a>
        </div>
      </div>
    </div>
  </div>

</footer>

<!-- ========================================================================
     STICKY QUICK ACTION BAR (MOBILE < 768px — ĐÚNG 3 NÚT CHUẨN ĐẶC TẢ)
     ======================================================================== -->
<aside class="sticky-mobile-bar" aria-label="Thanh thao tác nhanh di động">
  <div class="mobile-bar-inner">
    <!-- Nút 1: Gọi ngay -->
    <a href="tel:0981335522" class="bar-btn" aria-label="Gọi điện thoại trực tiếp">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
      </svg>
      <span>Gọi ngay</span>
    </a>

    <!-- Nút 2: Dự toán -->
    <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>" class="bar-btn" aria-label="Tính dự toán chi phí">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
        <rect x="4" y="2" width="16" height="20" rx="2"/>
        <line x1="8" y1="6" x2="16" y2="6"/>
        <line x1="16" y1="14" x2="16" y2="18"/>
        <path d="M16 10h.01M12 10h.01M8 10h.01M12 14h.01M8 14h.01M12 18h.01M8 18h.01"/>
      </svg>
      <span>Dự toán</span>
    </a>

    <!-- Nút 3: Lái thử (Nổi bật nhất màu #2563EB) -->
    <a href="<?php echo esc_url(home_url('/dang-ky-lai-thu/')); ?>" class="bar-btn bar-btn-primary" aria-label="Đăng ký lái thử xe">
      <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.08 3.11H5.77L6.85 7zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z"/>
        <circle cx="7.5" cy="14.5" r="1.5"/>
        <circle cx="16.5" cy="14.5" r="1.5"/>
      </svg>
      <span>LÁI THỬ</span>
    </a>
  </div>
</aside>

<!-- ========================================================================
     FLOATING HOTLINE & ZALO BUTTONS (DESKTOP & TABLET)
     ======================================================================== -->
<aside class="floating-hotline-zalo" aria-label="Nút liên hệ nhanh">
  <a href="https://zalo.me/0981335522" target="_blank" rel="noopener noreferrer" class="float-circle-btn float-zalo" aria-label="Chat Zalo tư vấn 0981 33 55 22" title="Chat Zalo: 0981 33 55 22">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
      <path d="M12 2C6.48 2 2 6.48 2 12c0 1.82.49 3.53 1.34 5L2 22l5.14-1.31C8.55 21.52 10.23 22 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/>
    </svg>
  </a>
  <a href="tel:0981335522" class="float-circle-btn float-phone" aria-label="Gọi ngay Hotline 0981 33 55 22" title="Hotline 24/7: 0981 33 55 22">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
      <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
    </svg>
  </a>
</aside>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
