<?php
/**
 * Template Name: Phụ kiện xe - VinFast Vĩnh Phúc
 * Description: Trang danh mục và chi tiết Phụ kiện xe ô tô điện VinFast chính hãng chuẩn Mobile-First
 */

defined('ABSPATH') || exit;
get_header();

$accessories = vfvp_get_accessories();
$uploads_url = content_url('/uploads/official_cars');
?>

<div class="vf-acc-page-wrapper">

  <!-- 1. BREADCRUMB & HERO BANNER -->
  <div class="vf-acc-hero">
    <div class="container">
      <nav class="vf-acc-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Trang chủ</a>
        <span class="sep">/</span>
        <span class="current">Phụ kiện xe</span>
      </nav>

      <div class="vf-acc-hero-card">
        <div class="vf-acc-hero-text">
          <span class="vf-acc-hero-badge">VINFAST OFFICIAL ACCESSORIES</span>
          <h1 class="vf-acc-hero-title">THÊM PHONG CÁCH — TĂNG TRẢI NGHIỆM</h1>
          <p class="vf-acc-hero-desc">
            Khám phá trọn bộ Phụ kiện & Thiết bị sạc chính hãng dành riêng cho các dòng ô tô điện VinFast. Tối ưu trải nghiệm lái, bảo vệ xe trọn vẹn và thể hiện cá tính riêng.
          </p>
          <div class="vf-acc-hero-tags">
            <span class="tag">⚡ Thiết bị sạc AC 3.5kW - 11kW</span>
            <span class="tag">🛡️ Tấm che pin cao áp</span>
            <span class="tag">🚘 Mô hình xe đúc 1:18</span>
            <span class="tag">✨ Thảm sàn TPE & Phụ kiện</span>
          </div>
        </div>
        <div class="vf-acc-hero-img-wrap">
          <img src="<?php echo esc_url(content_url('/uploads/official_cars/vf5/vf5_41_banner.webp')); ?>" 
               alt="Phụ kiện VinFast" 
               class="vf-acc-hero-img"
               onerror="this.src='<?php echo esc_url(content_url('/uploads/official_cars/common/official_vf3.webp')); ?>'">
        </div>
      </div>
    </div>
  </div>

  <!-- 2. MAIN CONTAINER WITH SIDEBAR & PRODUCTS GRID -->
  <div class="container vf-acc-main-container">

    <!-- MOBILE SCROLLABLE FILTER CHIPS -->
    <div class="vf-acc-mobile-chips show-for-medium">
      <button class="vf-chip active" onclick="vfFilterCat('all', event)">Tất cả (<?php echo count($accessories); ?>)</button>
      <button class="vf-chip" onclick="vfFilterCat('mo-hinh', event)">Phong cách sống</button>
      <button class="vf-chip" onclick="vfFilterCat('thiet-bi-sac', event)">Thiết bị sạc</button>
      <button class="vf-chip" onclick="vfFilterCat('tam-che-pin', event)">Tấm che pin gầm</button>
      <button class="vf-chip" onclick="vfFilterCat('noi-that', event)">Thảm sàn & Nội thất</button>
      <button class="vf-chip" onclick="vfFilterCat('ngoai-that', event)">Ngoại thất & Tiện ích</button>
    </div>

    <div class="vf-acc-layout">

      <!-- LEFT SIDEBAR FILTER (DESKTOP / LAPTOP) -->
      <aside class="vf-acc-sidebar hide-for-medium">
        
        <!-- BLOCK 1: DANH MỤC SẢN PHẨM (REMOVED Gasoline & 2-Wheelers) -->
        <div class="vf-acc-sidebar-box">
          <h3 class="vf-acc-sidebar-title">DANH MỤC SẢN PHẨM</h3>
          <ul class="vf-acc-cat-list">
            <li class="active">
              <a href="javascript:void(0)" onclick="vfFilterCat('all', event)" id="cat-btn-all">
                <span>Sản phẩm mới</span>
                <span class="count"><?php echo count($accessories); ?></span>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)" onclick="vfFilterCat('mo-hinh', event)" id="cat-btn-mo-hinh">
                <span>Phong cách sống</span>
              </a>
            </li>
            <li class="has-sub">
              <a href="javascript:void(0)" onclick="vfFilterCat('thiet-bi-sac', event)" id="cat-btn-thiet-bi-sac">
                <span>Thiết bị sạc & Năng lượng</span>
              </a>
            </li>
            <li class="has-sub">
              <a href="javascript:void(0)" onclick="vfFilterCat('tam-che-pin', event)" id="cat-btn-tam-che-pin">
                <span>Phụ kiện ô tô điện</span>
              </a>
              <ul class="vf-acc-sub-cat">
                <li><a href="javascript:void(0)" onclick="vfFilterCat('tam-che-pin', event)">Tấm che pin cao áp</a></li>
                <li><a href="javascript:void(0)" onclick="vfFilterCat('noi-that', event)">Thảm lót sàn TPE</a></li>
                <li><a href="javascript:void(0)" onclick="vfFilterCat('ngoai-that', event)">Giá nóc & Bơm lốp</a></li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- BLOCK 2: LỌC THEO DÒNG XE ĐIỆN VINFAST -->
        <div class="vf-acc-sidebar-box">
          <h3 class="vf-acc-sidebar-title">PHỤ KIỆN THEO DÒNG XE</h3>
          <div class="vf-acc-car-filter-grid">
            <button class="vf-car-filter-btn active" onclick="vfFilterCar('all', event)">Tất cả xe</button>
            <button class="vf-car-filter-btn" onclick="vfFilterCar('vf3', event)">VF 3</button>
            <button class="vf-car-filter-btn" onclick="vfFilterCar('vf5', event)">VF 5</button>
            <button class="vf-car-filter-btn" onclick="vfFilterCar('vf6', event)">VF 6</button>
            <button class="vf-car-filter-btn" onclick="vfFilterCar('vf7', event)">VF 7</button>
            <button class="vf-car-filter-btn" onclick="vfFilterCar('vf8', event)">VF 8</button>
            <button class="vf-car-filter-btn" onclick="vfFilterCar('vf9', event)">VF 9</button>
          </div>
        </div>

        <!-- BLOCK 3: BANNER TRỢ GIÚP / TƯ VẤN HOTLINE -->
        <div class="vf-acc-sidebar-cta">
          <div class="cta-icon">📞</div>
          <h4>Cần tư vấn phụ kiện?</h4>
          <p>Liên hệ chuyên viên VinFast Tân Á Châu để chọn đúng phụ kiện cho xe của bạn.</p>
          <a href="tel:0562256256" class="vf-btn vf-btn-primary" style="width:100%;">
            CALL: 056 225 6256
          </a>
        </div>

      </aside>

      <!-- RIGHT PRODUCT LIST CONTENT -->
      <main class="vf-acc-content">

        <!-- SEARCH & CAR FILTER BAR -->
        <div class="vf-acc-topbar">
          <div class="vf-acc-search-box">
            <input type="text" 
                   id="vf-acc-search-input" 
                   placeholder="Tìm kiếm phụ kiện (VD: Mô hình VF 3, Bộ sạc, Thảm sàn...)" 
                   onkeyup="vfSearchAccessories()">
            <span class="search-icon">🔍</span>
          </div>

          <div class="vf-acc-sort-box hide-for-small">
            <label>Hiển thị:</label>
            <select id="vf-acc-sort-select" onchange="vfSortAccessories()">
              <option value="default">Mặc định</option>
              <option value="price-asc">Giá: Thấp đến Cao</option>
              <option value="price-desc">Giá: Cao đến Thấp</option>
              <option value="name">Tên sản phẩm A-Z</option>
            </select>
          </div>
        </div>

        <!-- PRODUCT GRID SHOWCASE (2x2 on Mobile, 3 columns on Desktop) -->
        <div class="vf-acc-grid" id="vf-acc-grid-list">
          <?php foreach ($accessories as $acc): ?>
            <div class="vf-acc-card" 
                 data-id="<?php echo esc_attr($acc['id']); ?>"
                 data-cat="<?php echo esc_attr($acc['cat_slug'] ?? 'all'); ?>"
                 data-car="<?php echo esc_attr($acc['car_slug'] ?? 'all'); ?>"
                 data-name="<?php echo esc_attr(mb_strtolower($acc['name'])); ?>"
                 data-price="<?php echo esc_attr($acc['price_num'] ?? 0); ?>">
              
              <div class="vf-acc-card-badge">
                <?php echo esc_html($acc['car_model'] ?? 'VinFast EV'); ?>
              </div>

              <div class="vf-acc-img-wrap" onclick="vfOpenAccModal(<?php echo esc_attr($acc['id']); ?>)">
                <img src="<?php echo esc_url($acc['image']); ?>" 
                     alt="<?php echo esc_attr($acc['name']); ?>" 
                     loading="lazy" 
                     class="vf-acc-img">
                <div class="vf-acc-overlay-btn">
                  <span>🔍 XEM CHI TIẾT</span>
                </div>
              </div>

              <div class="vf-acc-info">
                <span class="vf-acc-cat"><?php echo esc_html($acc['category']); ?></span>
                <h3 class="vf-acc-title" onclick="vfOpenAccModal(<?php echo esc_attr($acc['id']); ?>)">
                  <?php echo esc_html($acc['name']); ?>
                </h3>

                <div class="vf-acc-price-row">
                  <span class="vf-acc-price"><?php echo esc_html($acc['price']); ?></span>
                  <span class="vf-acc-stock <?php echo ($acc['stock'] ?? '') === 'Tạm hết hàng' ? 'out-of-stock' : 'in-stock'; ?>">
                    <?php echo esc_html($acc['stock'] ?? 'Còn hàng'); ?>
                  </span>
                </div>

                <div class="vf-acc-actions">
                  <button class="vf-btn vf-btn-outline vf-acc-detail-btn" onclick="vfOpenAccModal(<?php echo esc_attr($acc['id']); ?>)">
                    XEM CHI TIẾT
                  </button>
                  <button class="vf-btn vf-btn-primary vf-acc-buy-btn" onclick="vfOpenOrderModal('<?php echo esc_js($acc['name']); ?>', '<?php echo esc_js($acc['price']); ?>')">
                    ĐẶT MUA
                  </button>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>

        <div class="vf-acc-no-results" id="vf-acc-no-results" style="display:none;">
          <div class="no-res-icon">📦</div>
          <h3>Không tìm thấy phụ kiện phù hợp</h3>
          <p>Vui lòng thử từ khóa khác hoặc chọn danh mục phụ kiện khác.</p>
          <button class="vf-btn vf-btn-outline" onclick="vfResetFilters()">XÓA BỘ LỌC</button>
        </div>

      </main>

    </div>

  </div>

</div><!-- /vf-acc-page-wrapper -->

<!-- ============================================================
     3. PRODUCT DETAIL MODAL VIEWER (Matching Screenshot 2 & 3)
     ============================================================ -->
<div class="vf-modal-backdrop" id="vf-acc-modal-backdrop" onclick="vfCloseAccModal()">
  <div class="vf-modal-container vf-acc-modal-box" onclick="event.stopPropagation()">
    <button class="vf-modal-close" onclick="vfCloseAccModal()">×</button>
    
    <div class="vf-acc-detail-body" id="vf-acc-modal-content">
      <!-- Loaded dynamically via JavaScript -->
    </div>
  </div>
</div>

<!-- ============================================================
     4. QUICK ORDER / CONSULTATION MODAL
     ============================================================ -->
<div class="vf-modal-backdrop" id="vf-order-modal-backdrop" onclick="vfCloseOrderModal()">
  <div class="vf-modal-container vf-order-modal-box" onclick="event.stopPropagation()">
    <button class="vf-modal-close" onclick="vfCloseOrderModal()">×</button>
    
    <div class="vf-order-modal-head">
      <h3>ĐĂNG KÝ TƯ VẤN & ĐẶT MUA PHỤ KIỆN</h3>
      <p>Chuyên viên VinFast Tân Á Châu sẽ liên hệ báo giá ưu đãi tốt nhất trong 5 phút.</p>
    </div>

    <div class="vf-order-modal-body">
      <?php echo vfvp_render_acc_form(); ?>
    </div>
  </div>
</div>

<!-- ============================================================
     5. STICKY QUICK ACTION BAR (MOBILE ONLY)
     ============================================================ -->
<div class="vf-acc-sticky-bar show-for-small">
  <a href="tel:0562256256" class="bar-btn call">
    <span class="icon">📞</span>
    <span>GỌI NGAY</span>
  </a>
  <a href="<?php echo esc_url(home_url('/du-toan-chi-phi/')); ?>" class="bar-btn calc">
    <span class="icon">📊</span>
    <span>DỰ TOÁN</span>
  </a>
  <button class="bar-btn order" onclick="vfOpenModal('modal-laythu')">
    <span class="icon">🚗</span>
    <span>LÁI THỬ NGAY</span>
  </button>
</div>

<script>
// RAW ACCESSORY DATA PASSED TO JS FOR DYNAMIC MODAL RENDER
var vfAccData = <?php echo json_encode($accessories, JSON_UNESCAPED_UNICODE); ?>;

function vfFilterCat(catSlug, evt) {
  if (evt) evt.preventDefault();
  
  // Update sidebar active states
  var catLinks = document.querySelectorAll('.vf-acc-cat-list a, .vf-chip');
  catLinks.forEach(function(el) { el.classList.remove('active'); });
  if (evt && evt.currentTarget) evt.currentTarget.classList.add('active');

  var cards = document.querySelectorAll('.vf-acc-card');
  var matchCount = 0;
  cards.forEach(function(card) {
    var c = card.getAttribute('data-cat');
    if (catSlug === 'all' || c === catSlug) {
      card.style.display = 'block';
      matchCount++;
    } else {
      card.style.display = 'none';
    }
  });

  document.getElementById('vf-acc-no-results').style.display = (matchCount === 0) ? 'block' : 'none';
}

function vfFilterCar(carSlug, evt) {
  if (evt) evt.preventDefault();
  
  var btns = document.querySelectorAll('.vf-car-filter-btn');
  btns.forEach(function(b) { b.classList.remove('active'); });
  if (evt && evt.currentTarget) evt.currentTarget.classList.add('active');

  var cards = document.querySelectorAll('.vf-acc-card');
  var matchCount = 0;
  cards.forEach(function(card) {
    var car = card.getAttribute('data-car');
    if (carSlug === 'all' || car === carSlug || car === 'all') {
      card.style.display = 'block';
      matchCount++;
    } else {
      card.style.display = 'none';
    }
  });

  document.getElementById('vf-acc-no-results').style.display = (matchCount === 0) ? 'block' : 'none';
}

function vfSearchAccessories() {
  var input = document.getElementById('vf-acc-search-input').value.toLowerCase().trim();
  var cards = document.querySelectorAll('.vf-acc-card');
  var matchCount = 0;

  cards.forEach(function(card) {
    var name = card.getAttribute('data-name') || '';
    if (name.indexOf(input) !== -1 || input === '') {
      card.style.display = 'block';
      matchCount++;
    } else {
      card.style.display = 'none';
    }
  });

  document.getElementById('vf-acc-no-results').style.display = (matchCount === 0) ? 'block' : 'none';
}

function vfSortAccessories() {
  var mode = document.getElementById('vf-acc-sort-select').value;
  var grid = document.getElementById('vf-acc-grid-list');
  var cards = Array.from(grid.children);

  cards.sort(function(a, b) {
    var priceA = parseInt(a.getAttribute('data-price')) || 0;
    var priceB = parseInt(b.getAttribute('data-price')) || 0;
    var nameA = a.getAttribute('data-name') || '';
    var nameB = b.getAttribute('data-name') || '';

    if (mode === 'price-asc') return priceA - priceB;
    if (mode === 'price-desc') return priceB - priceA;
    if (mode === 'name') return nameA.localeCompare(nameB);
    return parseInt(a.getAttribute('data-id')) - parseInt(b.getAttribute('data-id'));
  });

  cards.forEach(function(card) { grid.appendChild(card); });
}

function vfResetFilters() {
  document.getElementById('vf-acc-search-input').value = '';
  vfFilterCat('all');
}

// OPEN DYNAMIC ACCESSORY DETAIL MODAL (Matching Screenshot 2 & 3)
function vfOpenAccModal(accId) {
  var item = vfAccData.find(function(x) { return x.id == accId; });
  if (!item) return;

  var modalContent = document.getElementById('vf-acc-modal-content');
  
  // Render Colors swatches if available
  var colorsHtml = '';
  if (item.colors && item.colors.length > 0) {
    colorsHtml += '<div class="vf-modal-colors"><label>Chọn màu sắc:</label><div class="swatch-group">';
    item.colors.forEach(function(c, idx) {
      colorsHtml += '<button class="swatch-btn ' + (idx === 0 ? 'active' : '') + '" style="background-color:' + c.code + ';" title="' + c.name + '" onclick="vfSelectSwatch(this, \'' + c.img + '\')"></button>';
    });
    colorsHtml += '</div></div>';
  }

  // Render Specifications table
  var specsHtml = '';
  if (item.specs) {
    specsHtml += '<div class="vf-modal-specs-box"><h4>Thông số kỹ thuật sản phẩm</h4><table class="vf-modal-specs-table"><tbody>';
    for (var key in item.specs) {
      specsHtml += '<tr><th>' + key + '</th><td>' + item.specs[key] + '</td></tr>';
    }
    specsHtml += '</tbody></table></div>';
  }

  // Related products (Sản phẩm tương tự - Matching screenshot 3)
  var related = vfAccData.filter(function(x) { return x.id != accId; }).slice(0, 3);
  var relatedHtml = '<div class="vf-modal-related"><h4>Sản phẩm tương tự</h4><div class="vf-related-grid">';
  related.forEach(function(rel) {
    relatedHtml += '<div class="vf-related-card" onclick="vfOpenAccModal(' + rel.id + ')">' +
      '<div class="img-box"><img src="' + rel.image + '" alt="' + rel.name + '"></div>' +
      '<div class="title">' + rel.name + '</div>' +
      '<div class="price">' + rel.price + '</div>' +
    '</div>';
  });
  relatedHtml += '</div></div>';

  var html = 
    '<div class="vf-acc-modal-inner">' +
      '<!-- LEFT GALLERY -->' +
      '<div class="vf-modal-left">' +
        '<div class="vf-modal-main-img-box">' +
          '<img src="' + item.image + '" id="vf-modal-target-img" alt="' + item.name + '">' +
        '</div>' +
      '</div>' +

      '<!-- RIGHT DETAIL INFO -->' +
      '<div class="vf-modal-right">' +
        '<div class="vf-modal-breadcrumb">' + item.category + ' / Chi tiết sản phẩm</div>' +
        '<h2 class="vf-modal-title">' + item.name + '</h2>' +
        '<div class="vf-modal-price">' + item.price + '</div>' +
        
        colorsHtml +

        '<div class="vf-modal-desc-box">' +
          '<h4>Mô tả sản phẩm</h4>' +
          '<p>' + item.desc + '</p>' +
        '</div>' +

        '<div class="vf-modal-buy-box">' +
          '<div class="buy-head">Đặt sản phẩm</div>' +
          '<div class="buy-summary">' +
            '<img src="' + item.image + '" class="thumb">' +
            '<div class="buy-price-text">Tổng tiền: <strong>' + item.price + '</strong></div>' +
          '</div>' +
          '<div class="buy-actions">' +
            '<button class="vf-btn vf-btn-primary" style="width:100%; height:44px;" onclick="vfCloseAccModal(); vfOpenOrderModal(\'' + item.name.replace(/'/g, "\\'") + '\', \'' + item.price + '\');">' +
              'MUA NGAY' +
            '</button>' +
            '<a href="tel:0562256256" class="vf-btn vf-btn-outline" style="width:100%; height:44px; text-align:center; display:block; line-height:42px; text-decoration:none;">' +
              'TƯ VẤN HOTLINE: 056 225 6256 📞' +
            '</a>' +
          '</div>' +
        '</div>' +

      '</div>' +
    '</div>' +

    specsHtml +
    relatedHtml;

  modalContent.innerHTML = html;
  document.getElementById('vf-acc-modal-backdrop').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function vfSelectSwatch(btn, imgUrl) {
  var btns = btn.parentElement.querySelectorAll('.swatch-btn');
  btns.forEach(function(b) { b.classList.remove('active'); });
  btn.classList.add('active');
  
  var targetImg = document.getElementById('vf-modal-target-img');
  if (targetImg && imgUrl) {
    targetImg.src = imgUrl;
  }
}

function vfCloseAccModal() {
  document.getElementById('vf-acc-modal-backdrop').classList.remove('active');
  document.body.style.overflow = '';
}

function vfOpenOrderModal(name, price) {
  var nameInps = document.querySelectorAll('#vf-cf7-acc-name, input[name="accessory-name"], #vf-order-prod-name');
  nameInps.forEach(function(inp) { inp.value = name; });

  var priceInps = document.querySelectorAll('#vf-cf7-acc-price, input[name="accessory-price"], #vf-order-prod-price');
  priceInps.forEach(function(inp) { inp.value = price; });

  document.getElementById('vf-order-modal-backdrop').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function vfCloseOrderModal() {
  document.getElementById('vf-order-modal-backdrop').classList.remove('active');
  document.body.style.overflow = '';
}

function vfSubmitAccOrder(evt) {
  evt.preventDefault();
  var submitBtn = evt.target.querySelector('button[type="submit"]');
  var origText = submitBtn ? submitBtn.innerText : '';
  if (submitBtn) {
    submitBtn.innerText = 'ĐANG GỬI YÊU CẦU...';
    submitBtn.disabled = true;
  }

  var formData = new FormData();
  formData.append('action', 'vf_submit_acc_order');
  formData.append('nonce', typeof vfvp_vars !== 'undefined' ? vfvp_vars.nonce : '');
  formData.append('prod_name', document.getElementById('vf-order-prod-name').value || '');
  formData.append('prod_price', document.getElementById('vf-order-prod-price').value || '');
  formData.append('name', document.getElementById('vf-order-name').value || '');
  formData.append('phone', document.getElementById('vf-order-phone').value || '');
  formData.append('car_model', document.getElementById('vf-order-car-model').value || '');
  formData.append('note', document.getElementById('vf-order-note').value || '');

  var ajaxUrl = typeof vfvp_vars !== 'undefined' ? vfvp_vars.ajax_url : '/wp-admin/admin-ajax.php';

  fetch(ajaxUrl, {
    method: 'POST',
    body: formData
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    if (submitBtn) {
      submitBtn.innerText = origText;
      submitBtn.disabled = false;
    }
    if (data && data.data && data.data.message) {
      alert(data.data.message);
    } else {
      alert('Yêu cầu đặt mua phụ kiện đã được gửi thành công!');
    }
    vfCloseOrderModal();
  })
  .catch(function() {
    if (submitBtn) {
      submitBtn.innerText = origText;
      submitBtn.disabled = false;
    }
    alert('Đã gửi yêu cầu đặt mua phụ kiện thành công!');
    vfCloseOrderModal();
  });
}
</script>

<?php get_footer(); ?>
