<?php
/**
 * Template Name: Đặt lịch dịch vụ - VinFast Vĩnh Phúc
 * Description: Trang form đặt lịch dịch vụ bảo dưỡng & sửa chữa ô tô VinFast chuẩn VinFast Official 4 bước.
 */

get_header();

// Process Form submission via PHP Mail / AJAX fallback if submitted directly
$submitted = false;
$msg_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vf_booking_nonce'])) {
    if (wp_verify_nonce($_POST['vf_booking_nonce'], 'vf_booking_submit')) {
        $fullname   = sanitize_text_field($_POST['fullname'] ?? '');
        $phone      = sanitize_text_field($_POST['phone'] ?? '');
        $email      = sanitize_email($_POST['email'] ?? '');
        $car_model  = sanitize_text_field($_POST['car_model'] ?? '');
        $mileage    = sanitize_text_field($_POST['mileage'] ?? '');
        $plate      = sanitize_text_field($_POST['plate'] ?? '');
        $services   = isset($_POST['services']) ? array_map('sanitize_text_field', (array)$_POST['services']) : [];
        $note       = sanitize_textarea_field($_POST['note'] ?? '');
        $province   = sanitize_text_field($_POST['province'] ?? '');
        $location_type = sanitize_text_field($_POST['location_type'] ?? '');
        $date       = sanitize_text_field($_POST['booking_date'] ?? '');
        $time       = sanitize_text_field($_POST['booking_time'] ?? '');

        $admin_email = get_option('admin_email');
        $subject = "[ĐẶT LỊCH DỊCH VỤ] Đơn mới từ " . $fullname . " - " . $phone;
        
        $body = "THÔNG TIN ĐẶT LỊCH DỊCH VỤ VINFAST VĨNH PHÚC\n";
        $body .= "----------------------------------------\n";
        $body .= "1. THÔNG TIN KHÁCH HÀNG:\n";
        $body .= "- Họ tên: " . $fullname . "\n";
        $body .= "- Số điện thoại: " . $phone . "\n";
        $body .= "- Email: " . $email . "\n\n";

        $body .= "2. THÔNG TIN XE:\n";
        $body .= "- Mẫu xe: " . $car_model . "\n";
        $body .= "- Số Km: " . $mileage . "\n";
        $body .= "- Biển số xe: " . $plate . "\n\n";

        $body .= "3. DỊCH VỤ YÊU CẦU:\n";
        $body .= "- Dịch vụ: " . implode(', ', $services) . "\n";
        $body .= "- Ghi chú: " . $note . "\n\n";

        $body .= "4. ĐỊA ĐIỂM & THỜI GIAN:\n";
        $body .= "- Địa điểm: " . $province . " (" . $location_type . ")\n";
        $body .= "- Thời gian: " . $date . " lúc " . $time . "\n";

        $headers = ['Content-Type: text/plain; charset=UTF-8', 'From: VinFast Tân Á Châu <no-reply@' . $_SERVER['HTTP_HOST'] . '>'];
        
        wp_mail($admin_email, $subject, $body, $headers);
        $submitted = true;
        $msg_success = true;
    }
}
?>

<div class="vf-b-page-wrapper">
  <div class="container vf-b-container">
    
    <h1 class="vf-b-main-title">ĐẶT LỊCH DỊCH VỤ</h1>

    <?php if ($submitted && $msg_success): ?>
      <div class="vf-b-alert success">
        <h3>Cảm ơn Quý khách! Đơn đặt lịch dịch vụ đã được gửi thành công.</h3>
        <p>Bộ phận Chăm sóc khách hàng VinFast Vĩnh Phúc sẽ liên hệ xác nhận trong thời gian sớm nhất.</p>
      </div>
    <?php endif; ?>

    <form method="POST" action="" class="vf-b-form" enctype="multipart/form-data" id="vfBookingForm">
      <?php wp_nonce_field('vf_booking_submit', 'vf_booking_nonce'); ?>

      <div class="vf-b-form-grid">
        
        <!-- ROW 1 - COL 1: 1. THÔNG TIN KHÁCH HÀNG -->
        <div class="vf-b-block">
          <div class="vf-b-block-header">
            <span class="vf-b-step-badge">1</span>
            <h2>Thông tin khách hàng</h2>
          </div>

          <div class="vf-b-field">
            <label>Họ tên <span>*</span></label>
            <div class="vf-b-input-wrap">
              <input type="text" name="fullname" placeholder="Nhập họ và tên" maxlength="80" required id="vfFullname">
              <span class="vf-b-char-counter"><span id="vfNameCount">0</span>/80</span>
            </div>
          </div>

          <div class="vf-b-field">
            <label>Số điện thoại <span>*</span></label>
            <input type="tel" name="phone" placeholder="Tối thiểu 10 chữ số" required pattern="[0-9]{10,11}">
          </div>

          <div class="vf-b-field">
            <label>Email <span>*</span></label>
            <input type="email" name="email" placeholder="vidu@gmail.com" required>
          </div>
        </div>

        <!-- ROW 1 - COL 2: 2. THÔNG TIN XE -->
        <div class="vf-b-block">
          <div class="vf-b-block-header">
            <span class="vf-b-step-badge">2</span>
            <h2>Thông tin xe</h2>
          </div>

          <div class="vf-b-field">
            <label>Mẫu xe <span>*</span></label>
            <select name="car_model" required>
              <option value="">Lựa chọn</option>
              <optgroup label="Ô tô điện cá nhân">
                <option value="VF 3">VF 3</option>
                <option value="VF 5">VF 5</option>
                <option value="VF 6">VF 6</option>
                <option value="VF MPV 7">VF MPV 7</option>
                <option value="VF 7">VF 7</option>
                <option value="VF 8">VF 8</option>
                <option value="VF 8 The All New">VF 8 The All New</option>
                <option value="VF 9">VF 9</option>
              </optgroup>
              <optgroup label="Dòng xe dịch vụ & Thương mại">
                <option value="Minio Green">Minio Green</option>
                <option value="Herio Green">Herio Green</option>
                <option value="Nerio Green">Nerio Green</option>
                <option value="Limo Green">Limo Green</option>
                <option value="EC Van">EC Van</option>
              </optgroup>
            </select>
          </div>

          <div class="vf-b-field">
            <label>Số Km</label>
            <input type="text" name="mileage" placeholder="Nhập số km trên phương tiện của quý khách">
          </div>

          <div class="vf-b-field">
            <label>Biển số xe <span>*</span></label>
            <input type="text" name="plate" placeholder="Nhập biển số xe" required>
          </div>
        </div>

        <!-- ROW 2 - COL 1: 3. DỊCH VỤ -->
        <div class="vf-b-block">
          <div class="vf-b-block-header">
            <span class="vf-b-step-badge">3</span>
            <h2>Dịch vụ</h2>
          </div>

          <div class="vf-b-field">
            <label>Dịch vụ <span>*</span></label>
            <div class="vf-b-checkbox-list">
              
              <label class="vf-b-checkbox-item">
                <div class="vf-b-cb-left">
                  <input type="checkbox" name="services[]" value="Bảo dưỡng" checked>
                  <span>Bảo dưỡng</span>
                </div>
                <a href="<?php echo esc_url(home_url('/dich-vu-bao-duong/')); ?>" target="_blank" class="vf-b-detail-link">Thêm chi tiết</a>
              </label>

              <label class="vf-b-checkbox-item">
                <div class="vf-b-cb-left">
                  <input type="checkbox" name="services[]" value="Sửa chữa chung">
                  <span>Sửa chữa chung</span>
                </div>
                <a href="<?php echo esc_url(home_url('/dich-vu-sua-chua/')); ?>" target="_blank" class="vf-b-detail-link">Thêm chi tiết</a>
              </label>

              <label class="vf-b-checkbox-item">
                <div class="vf-b-cb-left">
                  <input type="checkbox" name="services[]" value="Đồng sơn">
                  <span>Đồng sơn</span>
                </div>
                <a href="<?php echo esc_url(home_url('/dich-vu-sua-chua/#phan-loai')); ?>" target="_blank" class="vf-b-detail-link">Thêm chi tiết</a>
              </label>

            </div>
          </div>

          <div class="vf-b-field">
            <label>Ghi chú</label>
            <textarea name="note" placeholder="Cụ thể yêu cầu VinFast hỗ trợ" rows="3"></textarea>
          </div>

          <div class="vf-b-field">
            <label>Tải ảnh lên (tối đa 5 ảnh)</label>
            <div class="vf-b-upload-box">
              <input type="file" name="upload_photos[]" multiple accept="image/*" id="vfUploadInput" class="vf-b-file-input">
              <label for="vfUploadInput" class="vf-b-upload-label">+</label>
            </div>
          </div>
        </div>

        <!-- ROW 2 - COL 2: 4. ĐỊA ĐIỂM VÀ THỜI GIAN -->
        <div class="vf-b-block">
          <div class="vf-b-block-header">
            <span class="vf-b-step-badge">4</span>
            <h2>Địa điểm và Thời gian</h2>
          </div>

          <div class="vf-b-field">
            <label>Tại <span>*</span></label>
            <div class="vf-b-select-row">
              <select name="province" required>
                <option value="Vĩnh Phúc">Vĩnh Phúc</option>
                <option value="Hà Nội">Hà Nội</option>
                <option value="Phú Thọ">Phú Thọ</option>
                <option value="Tỉnh thành khác">Tỉnh thành khác</option>
              </select>
              <select name="district">
                <option value="TP. Vĩnh Yên">TP. Vĩnh Yên</option>
                <option value="TP. Phúc Yên">TP. Phúc Yên</option>
                <option value="Bình Xuyên">Bình Xuyên</option>
                <option value="Yên Lạc">Yên Lạc</option>
                <option value="Vĩnh Tường">Vĩnh Tường</option>
              </select>
            </div>
          </div>

          <div class="vf-b-field">
            <div class="vf-b-radio-row">
              <label class="vf-b-radio-item">
                <input type="radio" name="location_type" value="Xưởng dịch vụ VinFast Vĩnh Phúc" checked>
                <span>Xưởng dịch vụ VinFast Vĩnh Phúc</span>
              </label>
              <label class="vf-b-radio-item">
                <input type="radio" name="location_type" value="Dịch vụ sửa chữa lưu động Mobile Service">
                <span>Dịch vụ sửa chữa lưu động</span>
              </label>
            </div>
          </div>

          <div class="vf-b-field">
            <label>Thời gian <span>*</span></label>
            <div class="vf-b-time-row">
              <input type="date" name="booking_date" required min="<?php echo date('Y-m-d'); ?>">
              <input type="time" name="booking_time" required value="08:30">
            </div>
          </div>

          <div class="vf-b-field" style="margin-top: 24px;">
            <label class="vf-b-terms-label">
              <input type="checkbox" name="terms" required checked>
              <span>Tôi đồng ý cho phép Công ty TNHH Kinh doanh Thương mại và Dịch vụ VinFast xử lý dữ liệu cá nhân của tôi và các thông tin khác do tôi cung cấp cho mục đích và theo phương thức được mô tả chi tiết tại <a href="<?php echo esc_url(home_url('/chinh-sach-bao-hanh/')); ?>" target="_blank">Chính sách Bảo vệ Dữ liệu cá nhân</a>.</span>
            </label>
          </div>

          <div class="vf-b-submit-wrap">
            <button type="submit" class="vf-b-btn-submit vf-anim-btn">Gửi yêu cầu</button>
          </div>

        </div>

      </div>
    </form>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var nameInput = document.getElementById('vfFullname');
  var nameCount = document.getElementById('vfNameCount');

  if (nameInput && nameCount) {
    nameInput.addEventListener('input', function() {
      nameCount.textContent = nameInput.value.length;
    });
  }
});
</script>

<?php
get_footer();
