<?php
/**
 * VinFast VF3 Product Template
 * Replicated from vinfasttanuyen.vn/san-pham/vinfast-vf-3/
 */
defined('ABSPATH') || exit;

$img_base = get_site_url() . '/wp-content/uploads/vinfast-vf3';
?>

<!-- ====== HERO SECTION: Color Selector + Info ====== -->
<div class="vf-hero-section">

  <!-- Left: Gallery + Color Dots -->
  <div class="vf-hero-gallery">
    <div class="vf-hero-main-image">
      <img id="vf3-main-img" src="<?php echo $img_base; ?>/Sky-Blue.png" alt="VinFast VF 3">
    </div>
    <div class="vf-hero-colors">
      <p class="label">Màu sắc</p>
      <div class="vf-color-dots">
        <span class="vf-color-dot" style="background:#ffff00" data-img="<?php echo $img_base; ?>/tai-xuong.png" data-name="Summer Yellow" title="Summer Yellow"></span>
        <span class="vf-color-dot" style="background:#ffc0cb" data-img="<?php echo $img_base; ?>/tai-xuong-1.png" data-name="Rose Pink" title="Rose Pink"></span>
        <span class="vf-color-dot" style="background:#808080" data-img="<?php echo $img_base; ?>/tai-xuong-2.png" data-name="Zenith Grey" title="Zenith Grey"></span>
        <span class="vf-color-dot" style="background:#dc143c" data-img="<?php echo $img_base; ?>/Crimson-Red.png" data-name="Crimson Red" title="Crimson Red"></span>
        <span class="vf-color-dot active" style="background:#87ceeb" data-img="<?php echo $img_base; ?>/Sky-Blue.png" data-name="Sky Blue" title="Sky Blue"></span>
        <span class="vf-color-dot" style="background:#98ff98" data-img="<?php echo $img_base; ?>/Urban-Mint.png" data-name="Urban Mint" title="Urban Mint"></span>
        <span class="vf-color-dot" style="background:#ffffff; border-color:#ccc" data-img="<?php echo $img_base; ?>/TRANG.png" data-name="Infinity Blanc" title="Infinity Blanc"></span>
      </div>
      <p class="vf-color-name" id="vf3-color-name">Sky Blue</p>
    </div>
  </div>

  <!-- Right: Product Info -->
  <div class="vf-hero-info">
    <h1>VINFAST VF 3</h1>
    <p class="vf-car-specs-label">Thông tin khác:</p>
    <ul class="vf-car-specs">
      <li><strong>Động cơ:</strong> Điện - 01 Motor</li>
      <li><strong>Công suất tối đa (kW):</strong> 30</li>
      <li><strong>Mô men xoắn cực đại (Nm):</strong> 110</li>
      <li><strong>Quãng đường chạy một lần sạc đầy (km):</strong> 215</li>
      <li><strong>Thời gian nạp pin nhanh nhất:</strong> 36 phút (10% - 70%)</li>
      <li><strong>Dẫn động:</strong> RWD/Cầu sau</li>
    </ul>

    <div class="vf-price-box">
      <p class="label">Giá xe</p>
      <p class="price">299.000.000 <span class="currency">₫</span></p>
    </div>

    <div class="vf-cta-buttons">
      <a href="/du-toan-chi-phi/" class="vf-btn-primary">Dự toán chi phí →</a>
      <a href="/dang-ky-lai-thu/" class="vf-btn-secondary">Đăng ký lái thử →</a>
    </div>
  </div>
</div>

<!-- ====== VIDEO BANNER ====== -->
<div class="vf-video-banner" style="background-image: url('<?php echo $img_base; ?>/vf3section-5-mb.jpg')">
  <div class="play-btn"></div>
</div>

<!-- ====== TỔNG QUAN ====== -->
<div class="vf-section vf-section-light" id="tong-quan">
  <div class="container">
    <div class="vf-section-title">
      <h3>Tổng quan</h3>
    </div>
    <hr class="vf-divider">
    <div class="vf-overview-text">
      <h3>VinFast VF3 là mẫu xe điện mini đầu tiên của VinFast, đánh dấu bước tiến quan trọng trong phân khúc ô tô điện cỡ nhỏ tại Việt Nam. Với thiết kế nhỏ gọn, cá tính và năng động, VF3 phù hợp với môi trường đô thị đông đúc, giúp người dùng di chuyển linh hoạt và tiết kiệm chi phí.</h3>
      <p>VF3 sở hữu ngoại hình vuông vức, đậm chất SUV, cùng hệ thống đèn LED hiện đại và la-zăng 16 inch nổi bật. Nội thất xe được tối ưu hóa không gian với 5 chỗ ngồi, vô lăng D-CUT thể thao và màn hình giải trí cảm ứng 10 inch.</p>
      <p>Động cơ điện công suất 30 kW, mô-men xoắn 110 Nm, dẫn động cầu sau, mang đến khả năng vận hành mạnh mẽ và tiết kiệm năng lượng. VF3 là lựa chọn lý tưởng cho những ai tìm kiếm một chiếc xe điện nhỏ gọn, tiện nghi và thân thiện với môi trường.</p>
    </div>
  </div>
</div>

<!-- ====== THƯ VIỆN HÌNH ẢNH ====== -->
<div class="vf-section vf-section-light" id="thu-vien-hinh-anh">
  <div class="container">
    <div class="vf-section-title"><h3>Thư viện</h3></div>
    <hr class="vf-divider">
    <div class="vf-gallery-grid">
      <img src="<?php echo $img_base; ?>/quang-duong.jpg" alt="VF3 quãng đường">
      <img src="<?php echo $img_base; ?>/che-do-lat.jpg" alt="VF3 chế độ lái">
      <img src="<?php echo $img_base; ?>/vf3-4.webp" alt="VF3 ngoại thất">
      <img src="<?php echo $img_base; ?>/vf3-3.webp" alt="VF3 góc bên">
      <img src="<?php echo $img_base; ?>/vf3-ngoai-that.webp" alt="VF3 ngoại thất 2">
      <img src="<?php echo $img_base; ?>/vf3section-5-mb.jpg" alt="VF3 banner">
      <img src="<?php echo $img_base; ?>/vf3section-4.1.jpg" alt="VF3 góc trước">
      <img src="<?php echo $img_base; ?>/Crimson-Red.png" alt="VF3 Crimson Red">
      <img src="<?php echo $img_base; ?>/Sky-Blue.png" alt="VF3 Sky Blue">
      <img src="<?php echo $img_base; ?>/Urban-Mint.png" alt="VF3 Urban Mint">
      <img src="<?php echo $img_base; ?>/TRANG.png" alt="VF3 Trắng">
      <img src="<?php echo $img_base; ?>/vf3tim.png" alt="VF3 Tím">
      <img src="<?php echo $img_base; ?>/vf3xanh.png" alt="VF3 Xanh">
      <img src="<?php echo $img_base; ?>/vf3-1.png" alt="VF3 góc trước">
      <img src="<?php echo $img_base; ?>/tai-xuong.png" alt="VF3 Vàng">
      <img src="<?php echo $img_base; ?>/tai-xuong-1.png" alt="VF3 Hồng">
    </div>
  </div>
</div>

<!-- ====== NGOẠI THẤT ====== -->
<div class="vf-section" id="ngoai-that">
  <div class="vf-split-section">
    <div class="vf-split-text">
      <div class="vf-section-title"><h3>Ngoại thất</h3></div>
      <hr class="vf-divider">
      <h2><strong>Ngoại Thất</strong></h2>
      <p><em>VinFast VF3</em> sở hữu thiết kế ngoại thất hiện đại với kích thước nhỏ gọn, phù hợp với giao thông đô thị. Xe có chiều dài tổng thể 3.190 mm, chiều rộng 1.679 mm và chiều cao 1.622 mm. Đèn pha halogen projector, la-zăng 16 inch và các đường nét thiết kế tinh tế tạo nên vẻ ngoài năng động và trẻ trung cho VF3.</p>
    </div>
    <div class="vf-split-image">
      <img src="<?php echo $img_base; ?>/vf3-ngoai-that.webp" alt="VF3 Ngoại thất">
    </div>
  </div>
  <div class="vf-sub-gallery">
    <img src="<?php echo $img_base; ?>/vf3tim.png" alt="">
    <img src="<?php echo $img_base; ?>/vf3xanh.png" alt="">
    <img src="<?php echo $img_base; ?>/vf3-1.png" alt="">
    <img src="<?php echo $img_base; ?>/vf3section-4.1.jpg" alt="">
  </div>
</div>

<!-- ====== NỘI THẤT ====== -->
<div class="vf-section" id="noi-that">
  <div class="vf-split-section">
    <div class="vf-split-text">
      <div class="vf-section-title"><h3>Nội thất</h3></div>
      <hr class="vf-divider">
      <h2><strong>Nội Thất</strong></h2>
      <p><em>VinFast VF3</em> có khoang nội thất thiết kế tối giản nhưng tiện nghi. Vô lăng 2 chấu dạng D-cut tích hợp các nút điều khiển cảm ứng. Màn hình trung tâm 10 inch hỗ trợ kết nối Apple CarPlay và Android Auto. Ghế ngồi bọc nỉ hoặc da tổng hợp, hàng ghế sau có thể gập lại để tăng không gian chứa đồ lên đến 285L, đáp ứng nhu cầu sử dụng hàng ngày.</p>
    </div>
    <div class="vf-split-image">
      <img src="<?php echo $img_base; ?>/vf3-noi-that.jpg" alt="VF3 Nội thất">
    </div>
  </div>
  <div class="vf-sub-gallery">
    <img src="<?php echo $img_base; ?>/noi-that-1.webp" alt="">
    <img src="<?php echo $img_base; ?>/noi-that-4.jpg" alt="">
    <img src="<?php echo $img_base; ?>/noi-that-5.jpg" alt="">
    <img src="<?php echo $img_base; ?>/noi-that-9.webp" alt="">
  </div>
</div>

<!-- ====== VẬN HÀNH ====== -->
<div class="vf-section vf-section-light" id="van-hanh">
  <div class="container">
    <div class="vf-section-title"><h3>Vận hành</h3></div>
    <hr class="vf-divider">
    <div class="vf-feature-grid">
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/dong-co.webp" alt="Động cơ">
        <div class="card-body">
          <h4>Động cơ mạnh mẽ</h4>
          <p>VF3 được trang bị động cơ điện công suất 32 kW, mô men xoắn 110 Nm, cho khả năng tăng tốc từ 0-50 km/h trong 5,3 giây.</p>
        </div>
      </div>
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/quang-duong.jpg" alt="Quãng đường">
        <div class="card-body">
          <h4>Quãng đường di chuyển</h4>
          <p>Xe có thể di chuyển 205 – 210 km sau mỗi lần sạc đầy, phù hợp với nhu cầu di chuyển trong đô thị.</p>
        </div>
      </div>
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/he-thong-treo-o-to-9.jpg" alt="Hệ thống treo">
        <div class="card-body">
          <h4>Hệ thống treo</h4>
          <p>VF3 sử dụng hệ thống treo trước độc lập MacPherson và treo sau phụ thuộc với thanh xoắn Panhard, mang lại cảm giác lái ổn định.</p>
        </div>
      </div>
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/che-do-lat.jpg" alt="Chế độ lái">
        <div class="card-body">
          <h4>Chế độ lái</h4>
          <p>Xe hỗ trợ các chế độ lái Eco và Normal, giúp tối ưu hiệu suất và tiết kiệm năng lượng.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ====== AN TOÀN ====== -->
<div class="vf-section vf-section-light" id="an-toan">
  <div class="container">
    <div class="vf-section-title"><h3>An toàn</h3></div>
    <hr class="vf-divider">
    <div class="vf-feature-grid">
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/can-bang-dien-tu.jpg" alt="ESC">
        <div class="card-body">
          <h4>Hệ thống cân bằng điện tử ESC</h4>
          <p>Giúp xe duy trì sự ổn định khi vào cua hoặc điều kiện đường trơn trượt.</p>
        </div>
      </div>
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/hac.jpeg" alt="HAC">
        <div class="card-body">
          <h4>Hệ thống hỗ trợ khởi hành ngang dốc HAC</h4>
          <p>Ngăn xe trôi ngược khi khởi hành trên dốc.</p>
        </div>
      </div>
      <div class="vf-feature-card">
        <img src="<?php echo $img_base; ?>/diem-mu.webp" alt="BSM">
        <div class="card-body">
          <h4>Hệ thống cảnh báo điểm mù BSM</h4>
          <p>Cảnh báo người lái về các phương tiện trong điểm mù.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ====== THÔNG SỐ KỸ THUẬT ====== -->
<div class="vf-specs-section" id="thong-so-ky-thuat">
  <div class="container">
    <div class="vf-section-title"><h3>Thông số kỹ thuật</h3></div>
    <hr class="vf-divider">

    <div class="vf-specs-tabs">
      <button class="active" data-tab="dong-co">Động cơ & Khung xe</button>
      <button data-tab="noi-that-tab">Nội thất</button>
      <button data-tab="ngoai-that-tab">Ngoại thất</button>
      <button data-tab="tien-nghi">Tiện nghi</button>
      <button data-tab="an-toan-tab">An toàn</button>
    </div>

    <div class="vf-specs-content">
      <div class="vf-specs-panel active" id="dong-co">
        <h3>Động cơ và khung xe</h3>
        <ul>
          <li><strong>Động cơ:</strong> 01 Motor điện</li>
          <li><strong>Công suất tối đa:</strong> 32 kW</li>
          <li><strong>Mô men xoắn cực đại:</strong> 110 Nm</li>
          <li><strong>Dẫn động:</strong> RWD/Cầu sau</li>
          <li><strong>Hệ thống treo trước:</strong> Độc lập, MacPherson</li>
          <li><strong>Hệ thống treo sau:</strong> Phụ thuộc, trục cứng với thanh xoắn Panlard</li>
        </ul>
      </div>
      <div class="vf-specs-panel" id="noi-that-tab">
        <h3>Nội thất</h3>
        <ul>
          <li><strong>Vô lăng:</strong> 2 chấu dạng D-cut, tích hợp nút điều khiển cảm ứng</li>
          <li><strong>Màn hình trung tâm:</strong> 10 inch, hỗ trợ Apple CarPlay và Android Auto</li>
          <li><strong>Ghế ngồi:</strong> Bọc nỉ hoặc da tổng hợp, hàng ghế sau gập được</li>
          <li><strong>Khoang hành lý:</strong> 285L khi gập hàng ghế sau</li>
        </ul>
      </div>
      <div class="vf-specs-panel" id="ngoai-that-tab">
        <h3>Ngoại thất</h3>
        <ul>
          <li><strong>Kích thước (D x R x C):</strong> 3.190 x 1.679 x 1.622 mm</li>
          <li><strong>Đèn pha:</strong> Halogen projector</li>
          <li><strong>La-zăng:</strong> 16 inch</li>
          <li><strong>Gương chiếu hậu:</strong> Chỉnh điện, gập điện</li>
        </ul>
      </div>
      <div class="vf-specs-panel" id="tien-nghi">
        <h3>Tiện nghi</h3>
        <ul>
          <li><strong>Điều hòa:</strong> Tự động</li>
          <li><strong>Cổng sạc USB:</strong> Type-C</li>
          <li><strong>Chìa khóa thông minh:</strong> Có</li>
          <li><strong>Khởi động bằng nút bấm:</strong> Có</li>
          <li><strong>Kết nối Bluetooth:</strong> Có</li>
        </ul>
      </div>
      <div class="vf-specs-panel" id="an-toan-tab">
        <h3>An toàn</h3>
        <ul>
          <li><strong>Túi khí:</strong> 2 túi khí trước</li>
          <li><strong>Hệ thống phanh ABS:</strong> Có</li>
          <li><strong>Phân phối lực phanh điện tử EBD:</strong> Có</li>
          <li><strong>Cân bằng điện tử ESC:</strong> Có</li>
          <li><strong>Hỗ trợ khởi hành ngang dốc HAC:</strong> Có</li>
          <li><strong>Cảnh báo điểm mù BSM:</strong> Có (bản Plus)</li>
          <li><strong>Camera lùi:</strong> Có</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ====== JavaScript: Color Selector + Tabs ====== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Color selector
  document.querySelectorAll('.vf-color-dot').forEach(function(dot) {
    dot.addEventListener('click', function() {
      document.querySelectorAll('.vf-color-dot').forEach(function(d) { d.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById('vf3-main-img').src = this.dataset.img;
      document.getElementById('vf3-color-name').textContent = this.dataset.name;
    });
  });

  // Specs tabs
  document.querySelectorAll('.vf-specs-tabs button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.vf-specs-tabs button').forEach(function(b) { b.classList.remove('active'); });
      document.querySelectorAll('.vf-specs-panel').forEach(function(p) { p.classList.remove('active'); });
      this.classList.add('active');
      document.getElementById(this.dataset.tab).classList.add('active');
    });
  });
});
</script>
