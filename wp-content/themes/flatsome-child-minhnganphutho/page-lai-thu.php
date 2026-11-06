<?php
/* Template Name: Đăng ký lái thử VinFast Vĩnh Phúc */
get_header(); 
$uploads_url = content_url('/uploads/official_cars/common/');
?>

<style>
.vf-testdrive-wrapper {
  background: #F8FAFC !important;
  font-family: 'Mulish', 'Plus Jakarta Sans', 'Inter', sans-serif !important;
  min-height: 100vh !important;
  padding-bottom: 60px !important;
  margin: 0 !important;
  width: 100% !important;
}

.vf-td-hero {
  background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 60%, #2563EB 100%) !important;
  color: #ffffff !important;
  padding: 50px 20px 60px 20px !important;
  text-align: center !important;
  position: relative !important;
  overflow: hidden !important;
}

.vf-td-hero-inner {
  max-width: 800px !important;
  margin: 0 auto !important;
  position: relative !important;
  z-index: 2 !important;
}

.vf-td-badge {
  display: inline-block !important;
  background: rgba(255, 255, 255, 0.15) !important;
  color: #60A5FA !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  padding: 6px 14px !important;
  border-radius: 20px !important;
  margin-bottom: 12px !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

.vf-td-title {
  font-size: 30px !important;
  font-weight: 900 !important;
  color: #ffffff !important;
  margin: 0 0 12px 0 !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
}

.vf-td-subtitle {
  font-size: 15px !important;
  color: #94A3B8 !important;
  margin: 0 !important;
  line-height: 1.6 !important;
}

.vf-td-container {
  max-width: 1140px !important;
  margin: -30px auto 0 auto !important;
  padding: 0 20px !important;
  position: relative !important;
  z-index: 10 !important;
}

.vf-td-grid {
  display: grid !important;
  grid-template-columns: 1.1fr 1fr !important;
  gap: 30px !important;
  align-items: start !important;
}

.vf-td-preview-card {
  background: #ffffff !important;
  border-radius: 20px !important;
  padding: 28px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06) !important;
  border: 1px solid #E2E8F0 !important;
  margin-bottom: 24px !important;
  text-align: center !important;
}

.vf-td-preview-header {
  margin-bottom: 16px !important;
}

.vf-td-preview-tag {
  font-size: 11px !important;
  font-weight: 800 !important;
  color: #2563EB !important;
  letter-spacing: 0.8px !important;
  display: block !important;
  margin-bottom: 4px !important;
}

.vf-td-preview-title {
  font-size: 22px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 0 !important;
}

.vf-td-preview-img-wrap {
  min-height: 200px !important;
  max-height: 260px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 20px 0 !important;
  overflow: hidden !important;
}

.vf-td-car-img {
  max-width: 100% !important;
  max-height: 220px !important;
  width: auto !important;
  height: auto !important;
  object-fit: contain !important;
  filter: drop-shadow(0 12px 24px rgba(0,0,0,0.15)) !important;
  transition: opacity 0.2s ease, transform 0.3s ease !important;
}

.vf-td-preview-footer {
  display: flex !important;
  align-items: center !important;
  justify-content: space-around !important;
  background: #F8FAFC !important;
  padding: 14px !important;
  border-radius: 12px !important;
  border: 1px solid #F1F5F9 !important;
}

.vf-td-spec-item {
  display: flex !important;
  flex-direction: column !important;
  gap: 2px !important;
}

.vf-td-spec-item .spec-label {
  font-size: 12px !important;
  color: #64748B !important;
}

.vf-td-spec-item .spec-val {
  font-size: 14px !important;
  font-weight: 700 !important;
  color: #0F172A !important;
}

.vf-td-spec-item .spec-val.highlight {
  color: #16A34A !important;
}

.vf-td-features {
  display: grid !important;
  grid-template-columns: 1fr 1fr !important;
  gap: 16px !important;
}

.vf-td-feat-card {
  background: #ffffff !important;
  border-radius: 16px !important;
  padding: 18px !important;
  border: 1px solid #E2E8F0 !important;
  display: flex !important;
  gap: 14px !important;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03) !important;
}

.vf-td-feat-card .feat-icon {
  font-size: 24px !important;
  flex-shrink: 0 !important;
}

.vf-td-feat-card .feat-text h4 {
  font-size: 14px !important;
  font-weight: 700 !important;
  color: #0F172A !important;
  margin: 0 0 4px 0 !important;
}

.vf-td-feat-card .feat-text p {
  font-size: 12px !important;
  color: #64748B !important;
  margin: 0 !important;
  line-height: 1.4 !important;
}

.vf-td-form-card {
  background: #ffffff !important;
  border-radius: 20px !important;
  padding: 32px !important;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06) !important;
  border: 1px solid #E2E8F0 !important;
}

.vf-td-form-head {
  margin-bottom: 24px !important;
  border-bottom: 1px solid #F1F5F9 !important;
  padding-bottom: 16px !important;
}

.vf-td-form-head h2 {
  font-size: 20px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 0 0 6px 0 !important;
  text-transform: uppercase !important;
}

.vf-td-form-head p {
  font-size: 13px !important;
  color: #64748B !important;
  margin: 0 !important;
}

.vf-td-form-body .vf-cf7-quote-wrapper {
  display: grid !important;
  grid-template-columns: 1fr 1fr !important;
  gap: 16px !important;
}

.vf-td-form-body .vf-cf7-field-group {
  display: flex !important;
  flex-direction: column !important;
}

.vf-td-form-body .full-width,
.vf-td-form-body .vf-cf7-submit-wrap {
  grid-column: 1 / -1 !important;
}

.vf-td-form-body .vf-cf7-quote-wrapper p {
  margin: 0 !important;
}

.vf-td-form-body .vf-cf7-quote-wrapper br {
  display: none !important;
}

.vf-td-form-body label {
  display: block !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  color: #1E293B !important;
  margin-bottom: 6px !important;
}

.vf-td-form-body input[type="text"],
.vf-td-form-body input[type="tel"],
.vf-td-form-body input[type="email"],
.vf-td-form-body select,
.vf-td-form-body textarea {
  width: 100% !important;
  padding: 10px 14px !important;
  height: 42px !important;
  border: 1.5px solid #CBD5E1 !important;
  border-radius: 8px !important;
  font-size: 13.5px !important;
  color: #0F172A !important;
  background: #F8FAFC !important;
  transition: all 0.2s ease !important;
  box-sizing: border-box !important;
  box-shadow: none !important;
  font-family: inherit !important;
}

.vf-td-form-body textarea {
  height: 80px !important;
  min-height: 80px !important;
  resize: vertical !important;
}

.vf-td-form-body input:focus,
.vf-td-form-body select:focus,
.vf-td-form-body textarea:focus {
  outline: none !important;
  background: #ffffff !important;
  border-color: #2563EB !important;
  box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.15) !important;
}

.vf-td-form-body .vf-cf7-submit-wrap {
  margin-top: 4px !important;
}

.vf-td-form-body input[type="submit"],
.vf-td-form-body .wpcf7-submit {
  height: 44px !important;
  line-height: 44px !important;
  padding: 0 24px !important;
  font-size: 13px !important;
  font-weight: 700 !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
  color: #ffffff !important;
  border: none !important;
  border-radius: 8px !important;
  width: 100% !important;
  cursor: pointer !important;
  transition: all 0.25s ease !important;
  box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35) !important;
  display: inline-block !important;
  text-align: center !important;
}

.vf-td-form-body input[type="submit"]:hover,
.vf-td-form-body .wpcf7-submit:hover {
  background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%) !important;
  box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5) !important;
  transform: translateY(-1px) !important;
}

@media (max-width: 768px) {
  .vf-td-grid {
    grid-template-columns: 1fr !important;
    gap: 20px !important;
  }
  .vf-td-title {
    font-size: 22px !important;
  }
  .vf-td-features {
    grid-template-columns: 1fr !important;
  }
  .vf-td-form-card {
    padding: 20px !important;
  }
  .vf-td-form-body .vf-cf7-quote-wrapper {
    grid-template-columns: 1fr !important;
    gap: 12px !important;
  }
}
</style>

<div class="vf-testdrive-wrapper">
  
  <!-- HERO BANNER SECTION -->
  <div class="vf-td-hero">
    <div class="vf-td-hero-inner">
      <span class="vf-td-badge">⚡ VINFAST TÂN Á CHÂU</span>
      <h1 class="vf-td-title">ĐĂNG KÝ LÁI THỬ XE ĐIỆN VINFAST</h1>
      <p class="vf-td-subtitle">
        Trải nghiệm trực tiếp khả năng vận hành êm ái, tăng tốc ấn tượng & công nghệ thông minh trên các dòng ô tô điện VinFast chính hãng
      </p>
    </div>
  </div>

  <!-- MAIN CONTAINER -->
  <div class="vf-td-container">
    <div class="vf-td-grid">
      
      <!-- LEFT COLUMN: CAR PREVIEW & SERVICE PROMISES -->
      <div class="vf-td-left">
        
        <!-- CAR PREVIEW CARD -->
        <div class="vf-td-preview-card">
          <div class="vf-td-preview-header">
            <span class="vf-td-preview-tag">DÒNG XE CHỌN LÁI THỬ</span>
            <h3 id="vf-td-car-name" class="vf-td-preview-title">VinFast VF 8</h3>
          </div>
          <div class="vf-td-preview-img-wrap">
            <img id="vf-td-car-img" src="<?php echo esc_url($uploads_url . '/official_vf8.webp'); ?>" alt="VinFast VF 8" class="vf-td-car-img">
          </div>
          <div class="vf-td-preview-footer">
            <div class="vf-td-spec-item">
              <span class="spec-label">Loại động cơ</span>
              <span class="spec-val">Thuần điện 100%</span>
            </div>
            <div class="vf-td-spec-item">
              <span class="spec-label">Chi phí lái thử</span>
              <span class="spec-val highlight">MIỄN PHÍ 100%</span>
            </div>
          </div>
        </div>

        <!-- SERVICE HIGHLIGHTS GRID -->
        <div class="vf-td-features">
          <div class="vf-td-feat-card">
            <span class="feat-icon">🏠</span>
            <div class="feat-text">
              <h4>Lái thử tận nhà</h4>
              <p>Hỗ trợ mang xe đến tận địa chỉ của quý khách tại Vĩnh Phúc & khu vực lân cận</p>
            </div>
          </div>
          <div class="vf-td-feat-card">
            <span class="feat-icon">🏎️</span>
            <div class="feat-text">
              <h4>Trải nghiệm thực tế</h4>
              <p>Thử nghiệm tính năng trợ lái thông minh ADAS & trợ lý ảo VinFast</p>
            </div>
          </div>
          <div class="vf-td-feat-card">
            <span class="feat-icon">📊</span>
            <div class="feat-text">
              <h4>Báo giá & Dự toán</h4>
              <p>Tư vấn chi tiết giá lăn bánh, quà tặng & phương án vay ngân hàng trả góp 80%</p>
            </div>
          </div>
          <div class="vf-td-feat-card">
            <span class="feat-icon">📞</span>
            <div class="feat-text">
              <h4>Tư vấn 24/7</h4>
              <p>Chuyên viên tư vấn VinFast hỗ trợ tận tâm trước và sau khi lái thử</p>
            </div>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: TEST DRIVE REGISTRATION FORM -->
      <div class="vf-td-right">
        <div class="vf-td-form-card">
          <div class="vf-td-form-head">
            <h2>ĐIỀN THÔNG TIN ĐĂNG KÝ</h2>
            <p>Vui lòng điền thông tin bên dưới, VinFast Tân Á Châu sẽ gọi xác nhận lịch hẹn trong 15 phút</p>
          </div>

          <div class="vf-td-form-body">
            <?php echo vfvp_render_lead_form('', '[contact-form-7 id="88" title="Đăng Ký Lái Thử VinFast Vĩnh Phúc"]'); ?>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var uploadsUrl = "<?php echo esc_url(content_url('/uploads/official_cars/common/')); ?>";
  var carMap = {
    'vinfast vf 2': uploadsUrl + 'official_vf2.png',
    'vf 2': uploadsUrl + 'official_vf2.png',
    'vinfast vf 3': uploadsUrl + 'official_vf3.webp',
    'vf 3': uploadsUrl + 'official_vf3.webp',
    'vinfast vf 5 plus': uploadsUrl + 'official_vf5.webp',
    'vinfast vf 5': uploadsUrl + 'official_vf5.webp',
    'vf 5': uploadsUrl + 'official_vf5.webp',
    'vinfast vf 6': uploadsUrl + 'official_vf6.webp',
    'vf 6': uploadsUrl + 'official_vf6.webp',
    'vinfast vf 7': uploadsUrl + 'official_vf7.webp',
    'vf 7': uploadsUrl + 'official_vf7.webp',
    'vinfast vf 8': uploadsUrl + 'official_vf8.webp',
    'vf 8': uploadsUrl + 'official_vf8.webp',
    'vinfast vf 8 the all new': uploadsUrl + 'official_vf8_allnew.png',
    'vf 8 the all new': uploadsUrl + 'official_vf8_allnew.png',
    'vinfast vf 9': uploadsUrl + 'official_vf9.webp',
    'vf 9': uploadsUrl + 'official_vf9.webp',
    'vinfast vf wild': uploadsUrl + 'official_vfwild.webp',
    'vf wild': uploadsUrl + 'official_vfwild.webp',
    'vinfast vf mpv 7': uploadsUrl + 'official_mpv7.webp',
    'vf mpv 7': uploadsUrl + 'official_mpv7.webp',
    'mpv 7': uploadsUrl + 'official_mpv7.webp',
    'minio green': uploadsUrl + 'official_minio.webp',
    'herio green': uploadsUrl + 'official_herio.png',
    'nerio green': uploadsUrl + 'official_nerio.webp',
    'limo green': uploadsUrl + 'official_limo.png',
    'ec van': uploadsUrl + 'official_ecvan.webp',
    'ebus': uploadsUrl + 'official_ecvan.webp'
  };

  var carImg = document.getElementById('vf-td-car-img');
  var carName = document.getElementById('vf-td-car-name');
  var select = document.querySelector('.vf-td-form-body select[name="car-model"], .vf-td-form-body select');

  if (select && carImg && carName) {
    function updatePreview() {
      var val = select.value.toLowerCase().trim();
      var foundImg = null;
      for (var key in carMap) {
        if (val.indexOf(key) !== -1 || key.indexOf(val) !== -1) {
          foundImg = carMap[key];
          break;
        }
      }
      if (foundImg) {
        carImg.style.opacity = '0';
        setTimeout(function() {
          carImg.src = foundImg;
          carImg.style.opacity = '1';
        }, 150);
      }
      carName.textContent = select.value || 'VinFast XE ĐIỆN';
    }

    // Auto-select based on URL params (?model=vfwild or ?car=...)
    var urlParams = new URLSearchParams(window.location.search);
    var pModel = urlParams.get('model') || urlParams.get('car');
    if (pModel) {
      var pLower = pModel.toLowerCase();
      for (var i = 0; i < select.options.length; i++) {
        var optVal = select.options[i].value.toLowerCase();
        if (optVal.indexOf(pLower) !== -1 || (pLower.indexOf('wild') !== -1 && optVal.indexOf('wild') !== -1)) {
          select.selectedIndex = i;
          break;
        }
      }
    }

    select.addEventListener('change', updatePreview);
    updatePreview();
  }
});
</script>

<?php get_footer(); ?>
