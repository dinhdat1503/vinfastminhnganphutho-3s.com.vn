<?php
/**
 * Template Name: Tìm kiếm Showroom & Trạm sạc - VinFast Vĩnh Phúc
 * Description: Trang tra cứu Showroom 3S, Xưởng dịch vụ và Trạm sạc Ô tô điện VinFast chuẩn Mobile-First Responsive, hỗ trợ API Hành chính & Định vị GPS
 */

get_header();

$uploads_url = content_url('/uploads/official_cars/common');
?>

<div class="vf-map-page-wrapper">
  
  <!-- 1. HERO SECTION -->
  <section class="vf-map-hero">
    <div class="container vf-map-hero-inner">
      <h1 class="vf-map-hero-title">Mạng lưới Showroom & Trạm sạc</h1>
      <p class="vf-map-hero-subtitle">
        Tra cứu hệ thống Showroom 3S, Xưởng dịch vụ ủy quyền và mạng lưới Trạm sạc xe ô tô điện VinFast chính hãng trên toàn quốc và khu vực Vĩnh Phúc.
      </p>
    </div>
  </section>

  <!-- 2. FILTER SEARCH BAR -->
  <section class="vf-map-filter-section">
    <div class="container">
      <div class="vf-map-filter-box">
        
        <div class="vf-map-filter-item">
          <label for="vfFilterProvince">Tỉnh / Thành phố</label>
          <select id="vfFilterProvince">
            <option value="all">Tất cả Tỉnh/Thành (Toàn quốc)</option>
          </select>
        </div>

        <div class="vf-map-filter-item">
          <label for="vfFilterDistrict">Quận / Huyện</label>
          <select id="vfFilterDistrict">
            <option value="all">Tất cả Quận/Huyện</option>
          </select>
        </div>

        <div class="vf-map-filter-item">
          <label for="vfFilterWard">Phường / Xã</label>
          <select id="vfFilterWard">
            <option value="all">Tất cả Phường/Xã</option>
          </select>
        </div>

        <div class="vf-map-filter-item">
          <label for="vfFilterType">Loại hình</label>
          <select id="vfFilterType">
            <option value="all">Tất cả Loại hình</option>
            <option value="showroom">Showroom 3S & Xưởng Dịch vụ</option>
            <option value="charging">Trạm sạc ô tô điện 24/7</option>
          </select>
        </div>

        <div class="vf-map-filter-item vf-search-input-wrap">
          <label for="vfFilterKeyword">Tìm từ khóa</label>
          <input type="text" id="vfFilterKeyword" placeholder="Nhập tên đường, địa chỉ hoặc cơ sở...">
        </div>

        <div class="vf-map-filter-actions">
          <button type="button" id="vfBtnGps" class="vf-map-btn-gps vf-anim-btn" title="Tìm các điểm gần vị trí của bạn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
            </svg>
            <span>GẦN TÔI</span>
          </button>
          <button type="button" id="vfBtnSearch" class="vf-map-btn-search vf-anim-btn">TÌM KIẾM</button>
        </div>

      </div>

      <!-- GPS STATUS BANNER -->
      <div id="vfGpsNotice" class="vf-gps-notice" style="display: none;">
        <span class="vf-gps-icon">📍</span>
        <span id="vfGpsMessage">Đang định vị tọa độ của bạn...</span>
        <button type="button" id="vfBtnClearGps" class="vf-gps-clear-btn" title="Bỏ lọc vị trí">×</button>
      </div>
    </div>
  </section>

  <!-- 3. MAIN CONTENT: LOCATION CARDS & GOOGLE MAPS -->
  <section class="vf-map-main-section">
    <div class="container vf-map-grid-container">
      
      <!-- LEFT COLUMN: LOCATIONS LIST -->
      <div class="vf-map-list-col">
        
        <div class="vf-map-list-header">
          <h2>Địa điểm được tìm thấy (<span id="vfCountLocs">0</span>)</h2>
          <span class="vf-sort-hint" id="vfSortHint" style="display:none;">⚡ Đã sắp xếp từ gần đến xa</span>
        </div>

        <div class="vf-map-locations-list" id="vfLocationsList">
          
          <!-- ITEM 1: VINFAST TÂN Á CHÂU 3S -->
          <div class="vf-map-card is-active" 
               data-id="loc-vp-3s"
               data-province="vinh-phuc" 
               data-district="vinh-yen" 
               data-type="showroom"
               data-lat="21.31295" 
               data-lng="105.590112"
               data-title="VinFast Tân Á Châu - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="191+Đường+Hùng+Vương+Vĩnh+Yên">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ Chính Hãng</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Tân Á Châu - Showroom 3S & Xưởng Dịch Vụ</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> 191 Đường Hùng Vương, Phường Vĩnh Yên, Tỉnh Phú Thọ , Vinh Yen, Vietnam</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline Kinh doanh: <strong>056 225 6256</strong></p>
              <p class="vf-map-phone"><span class="vf-info-icon">✉️</span> Email: <strong>phuocvandangdilam@gmail.com</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.31295,105.590112" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 2: TRẠM SẠC NAM VĨNH YÊN -->
          <div class="vf-map-card" 
               data-id="loc-vp-ts-namvinhyen"
               data-province="vinh-phuc" 
               data-district="vinh-yen" 
               data-type="charging"
               data-lat="21.30560" 
               data-lng="105.59250"
               data-title="Trạm sạc Ô tô điện VinFast Nam Vĩnh Yên"
               data-mapquery="21.30560,105.59250">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag charging">Trạm sạc ô tô điện 24/7</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">Trạm sạc Ô tô điện VinFast Nam Vĩnh Yên</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Khu đô thị Nam Vĩnh Yên, Đường Nguyễn Tất Thành, TP. Vĩnh Yên, Vĩnh Phúc</p>
              <p class="vf-map-specs"><span class="vf-info-icon">⚡</span> Trang bị: 4 trụ sạc DC 150kW + 8 trụ sạc DC 60kW + 4 trụ AC 11kW</p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: Phục vụ 24/7 toàn bộ xe ô tô điện VinFast</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.30560,105.59250" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>" class="vf-map-btn secondary vf-anim-btn">
                <span>Chi tiết trụ sạc</span>
              </a>
            </div>
          </div>

          <!-- ITEM 3: TRẠM SẠC GO! VĨNH PHÚC -->
          <div class="vf-map-card" 
               data-id="loc-vp-ts-go"
               data-province="vinh-phuc" 
               data-district="vinh-yen" 
               data-type="charging"
               data-lat="21.31750" 
               data-lng="105.61200"
               data-title="Trạm sạc Ô tô điện VinFast GO! Vĩnh Phúc"
               data-mapquery="GO!+Vĩnh+Phúc">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag charging">Trạm sạc ô tô điện 24/7</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">Trạm sạc Ô tô điện VinFast GO! Vĩnh Phúc</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Trung tâm thương mại GO! Vĩnh Phúc, Đường Mê Linh, Phường Khai Quang, TP. Vĩnh Yên</p>
              <p class="vf-map-specs"><span class="vf-info-icon">⚡</span> Trang bị: 6 trụ sạc DC 60kW + 6 trụ sạc AC 11kW</p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 06:00 - 22:00 (Theo giờ mở cửa TTTM)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.31750,105.61200" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>" class="vf-map-btn secondary vf-anim-btn">
                <span>Chi tiết trụ sạc</span>
              </a>
            </div>
          </div>

          <!-- ITEM 4: TRẠM SẠC PHÚC YÊN -->
          <div class="vf-map-card" 
               data-id="loc-vp-ts-phucyen"
               data-province="vinh-phuc" 
               data-district="phuc-yen" 
               data-type="charging"
               data-lat="21.29950" 
               data-lng="105.74820"
               data-title="Trạm sạc Ô tô điện VinFast Phúc Yên"
               data-mapquery="21.29950,105.74820">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag charging">Trạm sạc ô tô điện 24/7</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">Trạm sạc Ô tô điện VinFast Phúc Yên</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Đường Trần Hưng Đạo (Cạnh QL2), Phường Tiền Châu, TP. Phúc Yên, Vĩnh Phúc</p>
              <p class="vf-map-specs"><span class="vf-info-icon">⚡</span> Trang bị: 2 trụ sạc DC 150kW + 4 trụ sạc DC 60kW</p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: Phục vụ 24/7</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.29950,105.74820" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>" class="vf-map-btn secondary vf-anim-btn">
                <span>Chi tiết trụ sạc</span>
              </a>
            </div>
          </div>

          <!-- ITEM 5: TRẠM SẠC BÌNH XUYÊN -->
          <div class="vf-map-card" 
               data-id="loc-vp-ts-binhxuyen"
               data-province="vinh-phuc" 
               data-district="binh-xuyen" 
               data-type="charging"
               data-lat="21.36500" 
               data-lng="105.69800"
               data-title="Trạm sạc Ô tô điện VinFast Bình Xuyên - KCN Bá Thiện"
               data-mapquery="21.36500,105.69800">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag charging">Trạm sạc ô tô điện 24/7</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">Trạm sạc Ô tô điện VinFast KCN Bá Thiện</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Cổng KCN Bá Thiện 2, Huyện Bình Xuyên, Tỉnh Vĩnh Phúc</p>
              <p class="vf-map-specs"><span class="vf-info-icon">⚡</span> Trang bị: 4 trụ sạc DC 60kW + 4 trụ sạc AC 11kW</p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: Phục vụ 24/7</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.36500,105.69800" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>" class="vf-map-btn secondary vf-anim-btn">
                <span>Chi tiết trụ sạc</span>
              </a>
            </div>
          </div>

          <!-- ITEM 6: SHOWROOM 3S VINFAST PHÚ THỌ -->
          <div class="vf-map-card" 
               data-id="loc-pt-3s"
               data-province="phu-tho" 
               data-district="viet-tri" 
               data-type="showroom"
               data-lat="21.32890" 
               data-lng="105.40120"
               data-title="VinFast Phú Thọ - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="VinFast+Việt+Trì+Phú+Thọ">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Phú Thọ - Showroom 3S & Xưởng Dịch Vụ</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Đại lộ Hùng Vương, Phường Gia Cẩm, TP. Việt Trì, Tỉnh Phú Thọ</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline Dịch vụ: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.32890,105.40120" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 7: SHOWROOM 3S VINFAST SMART CITY HÀ NỘI -->
          <div class="vf-map-card" 
               data-id="loc-hn-smartcity"
               data-province="ha-noi" 
               data-district="nam-tu-liem" 
               data-type="showroom"
               data-lat="20.99950" 
               data-lng="105.74500"
               data-title="VinFast Smart City - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="VinFast+Smart+City">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Smart City Hà Nội - Showroom 3S</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> TTTM Vincom Mega Mall Smart City, Phường Tây Mỗ, Quận Nam Từ Liêm, Hà Nội</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 21:00 (Hàng ngày)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=20.99950,105.74500" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 8: SHOWROOM VINFAST PHẠM HÙNG HÀ NỘI -->
          <div class="vf-map-card" 
               data-id="loc-hn-phamhung"
               data-province="ha-noi" 
               data-district="nam-tu-liem" 
               data-type="showroom"
               data-lat="21.02550" 
               data-lng="105.78200"
               data-title="VinFast Phạm Hùng - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="VinFast+Phạm+Hùng">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Phạm Hùng - Showroom 3S & Xưởng Dịch Vụ</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Số 1 Phạm Hùng, Phường Mỹ Đình 2, Quận Nam Từ Liêm, Hà Nội</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.02550,105.78200" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 9: SHOWROOM 3S VINFAST TUYÊN QUANG -->
          <div class="vf-map-card" 
               data-id="loc-tq-3s"
               data-province="tuyen-quang" 
               data-district="tuyen-quang-tp" 
               data-type="showroom"
               data-lat="21.82360" 
               data-lng="105.21540"
               data-title="VinFast Tuyên Quang - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="Vincom+Plaza+Tuyên+Quang">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Tuyên Quang - Showroom 3S & Xưởng Dịch Vụ</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> TTTM Vincom Plaza Tuyên Quang, Đường Quang Trung, Phường Phan Thiết, TP. Tuyên Quang</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.82360,105.21540" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 10: TRẠM SẠC Ô TÔ ĐIỆN VINFAST TUYÊN QUANG -->
          <div class="vf-map-card" 
               data-id="loc-tq-ts"
               data-province="tuyen-quang" 
               data-district="tuyen-quang-tp" 
               data-type="charging"
               data-lat="21.81900" 
               data-lng="105.22100"
               data-title="Trạm sạc Ô tô điện VinFast Vincom Tuyên Quang"
               data-mapquery="21.81900,105.22100">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag charging">Trạm sạc ô tô điện 24/7</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">Trạm sạc Ô tô điện VinFast Vincom Tuyên Quang</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Bãi đỗ xe Vincom Plaza, Đường Quang Trung, TP. Tuyên Quang</p>
              <p class="vf-map-specs"><span class="vf-info-icon">⚡</span> Trang bị: 4 trụ sạc DC 60kW + 4 trụ sạc AC 11kW</p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: Phục vụ 24/7</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.81900,105.22100" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/pin-va-tram-sac/')); ?>" class="vf-map-btn secondary vf-anim-btn">
                <span>Chi tiết trụ sạc</span>
              </a>
            </div>
          </div>

          <!-- ITEM 11: SHOWROOM 3S VINFAST THÁI NGUYÊN -->
          <div class="vf-map-card" 
               data-id="loc-tn-3s"
               data-province="thai-nguyen" 
               data-district="thai-nguyen-tp" 
               data-type="showroom"
               data-lat="21.59280" 
               data-lng="105.84420"
               data-title="VinFast Thái Nguyên - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="VinFast+Thái+Nguyên">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Thái Nguyên - Showroom 3S & Xưởng Dịch Vụ</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Đường Quang Trung, Phường Đồng Quang, TP. Thái Nguyên</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.59280,105.84420" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 12: SHOWROOM 3S VINFAST BẮC NINH -->
          <div class="vf-map-card" 
               data-id="loc-bn-3s"
               data-province="bac-ninh" 
               data-district="bac-ninh-tp" 
               data-type="showroom"
               data-lat="21.18610" 
               data-lng="106.07630"
               data-title="VinFast Bắc Ninh - Showroom 3S & Xưởng Dịch Vụ"
               data-mapquery="VinFast+Bắc+Ninh">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Bắc Ninh - Showroom 3S & Xưởng Dịch Vụ</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Đường Lê Thái Tổ, Phường Võ Cường, TP. Bắc Ninh</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 18:00 (Thứ 2 - Chủ Nhật)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=21.18610,106.07630" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 13: SHOWROOM 3S VINFAST ĐÀ NẴNG -->
          <div class="vf-map-card" 
               data-id="loc-dn-3s"
               data-province="da-nang" 
               data-district="hai-chau" 
               data-type="showroom"
               data-lat="16.06820" 
               data-lng="108.22300"
               data-title="VinFast Ngô Quyền Đà Nẵng - Showroom 3S"
               data-mapquery="Vincom+Đà+Nẵng">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Ngô Quyền Đà Nẵng - Showroom 3S</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> TTTM Vincom Plaza Ngô Quyền, Quận Sơn Trà, TP. Đà Nẵng</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 08:00 - 21:00 (Hàng ngày)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=16.06820,108.22300" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- ITEM 14: SHOWROOM 3S VINFAST LANDMARK 81 TP.HCM -->
          <div class="vf-map-card" 
               data-id="loc-hcm-landmark"
               data-province="ho-chi-minh" 
               data-district="binh-thanh" 
               data-type="showroom"
               data-lat="10.79500" 
               data-lng="106.72180"
               data-title="VinFast Landmark 81 - Showroom 3S TP.HCM"
               data-mapquery="VinFast+Landmark+81">
            <div class="vf-map-card-top">
              <div class="vf-map-card-tag showroom">Showroom 3S & Xưởng Dịch vụ</div>
              <div class="vf-map-card-distance" style="display:none;"></div>
            </div>
            <h3 class="vf-map-card-name">VinFast Landmark 81 - Showroom 3S TP.HCM</h3>
            
            <div class="vf-map-card-info">
              <p class="vf-map-addr"><span class="vf-info-icon">📍</span> Tầng B1, TTTM Vincom Center Landmark 81, 720A Điện Biên Phủ, Quận Bình Thạnh, TP.HCM</p>
              <p class="vf-map-phone"><span class="vf-info-icon">📞</span> Hotline: <strong>1900 23 23 89</strong></p>
              <p class="vf-map-hours"><span class="vf-info-icon">🕒</span> Giờ làm việc: 09:00 - 22:00 (Hàng ngày)</p>
            </div>

            <div class="vf-map-card-actions">
              <a href="https://www.google.com/maps/dir/?api=1&destination=10.79500,106.72180" target="_blank" rel="noopener" class="vf-map-btn outline vf-anim-btn vf-btn-direct">
                <span>Chỉ đường Maps</span>
              </a>
              <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-map-btn primary vf-anim-btn">
                <span>Đặt lịch dịch vụ</span>
              </a>
            </div>
          </div>

          <!-- EMPTY STATE WHEN 0 RESULTS FOUND -->
          <div id="vfEmptyResults" class="vf-map-empty-box" style="display:none;">
            <div class="vf-empty-icon">🔍</div>
            <h3>Không tìm thấy cơ sở tại khu vực này</h3>
            <p>Hiện tại hệ thống chưa có dữ liệu Showroom hoặc Trạm sạc tại khu vực bạn vừa chọn.</p>
            <p class="vf-empty-hint">Vui lòng chọn <strong>"Tất cả Tỉnh/Thành"</strong> hoặc bấm nút <strong>"GẦN TÔI"</strong> để tìm các trạm sạc gần bạn nhất.</p>
            <div class="vf-empty-actions">
              <button type="button" id="vfBtnResetFilter" class="vf-map-btn primary vf-anim-btn">XEM TẤT CẢ ĐỊA ĐIỂM</button>
              <a href="tel:1900232389" class="vf-map-btn outline vf-anim-btn">HOTLINE: 1900 23 23 89</a>
            </div>
          </div>

        </div>
      </div>

      <!-- RIGHT COLUMN: GOOGLE MAPS EMBED IFRAME -->
      <div class="vf-map-iframe-col">
        <div class="vf-map-sticky-wrap">
          <div class="vf-map-current-target" id="vfMapTargetBar">
            <span class="vf-target-dot"></span>
            <span id="vfTargetTitle">VinFast Tân Á Châu - Showroom 3S & Xưởng Dịch Vụ</span>
          </div>
          <iframe 
            id="vfMapIframe"
            src="https://maps.google.com/maps?q=21.31295,105.590112&hl=vi&z=15&output=embed" 
            width="100%" 
            height="620" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

    </div>
  </section>

</div>

<script>
(function() {
  // Danh sách toàn bộ 63 Tỉnh / Thành phố Việt Nam (Kèm tọa độ trung tâm & mã GSO)
  var ALL_VIETNAM_PROVINCES = [
    { code: '26', slug: 'vinh-phuc', name: 'Vĩnh Phúc', lat: 21.3129, lng: 105.5901, featured: true },
    { code: '01', slug: 'ha-noi', name: 'Hà Nội', lat: 21.0285, lng: 105.8542, featured: true },
    { code: '79', slug: 'ho-chi-minh', name: 'TP. Hồ Chí Minh', lat: 10.7950, lng: 106.7218, featured: true },
    { code: '25', slug: 'phu-tho', name: 'Phú Thọ', lat: 21.3289, lng: 105.4012, featured: true },
    { code: '27', slug: 'bac-ninh', name: 'Bắc Ninh', lat: 21.1861, lng: 106.0763 },
    { code: '24', slug: 'bac-giang', name: 'Bắc Giang', lat: 21.2731, lng: 106.1946 },
    { code: '19', slug: 'thai-nguyen', name: 'Thái Nguyên', lat: 21.5928, lng: 105.8442 },
    { code: '08', slug: 'tuyen-quang', name: 'Tuyên Quang', lat: 21.8236, lng: 105.2154 },
    { code: '31', slug: 'hai-phong', name: 'Hải Phòng', lat: 20.8449, lng: 106.6881 },
    { code: '30', slug: 'hai-duong', name: 'Hải Dương', lat: 20.9373, lng: 106.3155 },
    { code: '33', slug: 'hung-yen', name: 'Hưng Yên', lat: 20.6464, lng: 106.0511 },
    { code: '34', slug: 'thai-binh', name: 'Thái Bình', lat: 20.4463, lng: 106.3366 },
    { code: '35', slug: 'ha-nam', name: 'Hà Nam', lat: 20.5835, lng: 105.9229 },
    { code: '36', slug: 'nam-dinh', name: 'Nam Định', lat: 20.4344, lng: 106.1773 },
    { code: '37', slug: 'ninh-binh', name: 'Ninh Bình', lat: 20.2506, lng: 105.9745 },
    { code: '22', slug: 'quang-ninh', name: 'Quảng Ninh', lat: 20.9505, lng: 107.0734 },
    { code: '38', slug: 'thanh-hoa', name: 'Thanh Hóa', lat: 19.8067, lng: 105.7852 },
    { code: '40', slug: 'nghe-an', name: 'Nghệ An', lat: 18.6796, lng: 105.6813 },
    { code: '42', slug: 'ha-tinh', name: 'Hà Tĩnh', lat: 18.3429, lng: 105.9059 },
    { code: '44', slug: 'quang-binh', name: 'Quảng Bình', lat: 17.4690, lng: 106.6225 },
    { code: '45', slug: 'quang-tri', name: 'Quảng Trị', lat: 16.8163, lng: 107.1001 },
    { code: '46', slug: 'thua-thien-hue', name: 'Thừa Thiên Huế', lat: 16.4637, lng: 107.5909 },
    { code: '48', slug: 'da-nang', name: 'Đà Nẵng', lat: 16.0682, lng: 108.2230 },
    { code: '49', slug: 'quang-nam', name: 'Quảng Nam', lat: 15.5992, lng: 108.4756 },
    { code: '51', slug: 'quang-ngai', name: 'Quảng Ngãi', lat: 15.1205, lng: 108.7923 },
    { code: '52', slug: 'binh-dinh', name: 'Bình Định', lat: 13.7820, lng: 109.2197 },
    { code: '54', slug: 'phu-yen', name: 'Phú Yên', lat: 13.0882, lng: 109.3000 },
    { code: '56', slug: 'khanh-hoa', name: 'Khánh Hòa', lat: 12.2388, lng: 109.1967 },
    { code: '58', slug: 'ninh-thuan', name: 'Ninh Thuận', lat: 11.5645, lng: 108.9882 },
    { code: '60', slug: 'binh-thuan', name: 'Bình Thuận', lat: 10.9273, lng: 108.1021 },
    { code: '62', slug: 'kon-tum', name: 'Kon Tum', lat: 14.3497, lng: 108.0005 },
    { code: '64', slug: 'gia-lai', name: 'Gia Lai', lat: 13.9833, lng: 108.0000 },
    { code: '66', slug: 'dak-lak', name: 'Đắk Lắk', lat: 12.6667, lng: 108.0500 },
    { code: '67', slug: 'dak-nong', name: 'Đắk Nông', lat: 12.0000, lng: 107.6833 },
    { code: '68', slug: 'lam-dong', name: 'Lâm Đồng', lat: 11.9404, lng: 108.4583 },
    { code: '70', slug: 'binh-phuoc', name: 'Bình Phước', lat: 11.7511, lng: 106.9038 },
    { code: '72', slug: 'tay-ninh', name: 'Tây Ninh', lat: 11.3351, lng: 106.1099 },
    { code: '74', slug: 'binh-duong', name: 'Bình Dương', lat: 10.9804, lng: 106.6519 },
    { code: '75', slug: 'dong-nai', name: 'Đồng Nai', lat: 10.9574, lng: 106.8427 },
    { code: '77', slug: 'ba-ria-vung-tau', name: 'Bà Rịa - Vũng Tàu', lat: 10.4114, lng: 107.1362 },
    { code: '80', slug: 'long-an', name: 'Long An', lat: 10.5333, lng: 106.4000 },
    { code: '82', slug: 'tien-giang', name: 'Tiền Giang', lat: 10.4494, lng: 106.3421 },
    { code: '83', slug: 'ben-tre', name: 'Bến Tre', lat: 10.2433, lng: 106.3758 },
    { code: '84', slug: 'tra-vinh', name: 'Trà Vinh', lat: 9.9347, lng: 106.3455 },
    { code: '86', slug: 'vinh-long', name: 'Vĩnh Long', lat: 10.2537, lng: 105.9722 },
    { code: '87', slug: 'dong-thap', name: 'Đồng Tháp', lat: 10.4578, lng: 105.6331 },
    { code: '89', slug: 'an-giang', name: 'An Giang', lat: 10.5216, lng: 105.1259 },
    { code: '91', slug: 'kien-giang', name: 'Kiên Giang', lat: 10.0125, lng: 105.0809 },
    { code: '92', slug: 'can-tho', name: 'Cần Thơ', lat: 10.0452, lng: 105.7469 },
    { code: '93', slug: 'hau-giang', name: 'Hậu Giang', lat: 9.7845, lng: 105.4701 },
    { code: '94', slug: 'soc-trang', name: 'Sóc Trăng', lat: 9.6033, lng: 105.9800 },
    { code: '95', slug: 'bac-lieu', name: 'Bạc Liêu', lat: 9.2940, lng: 105.7244 },
    { code: '96', slug: 'ca-mau', name: 'Cà Mau', lat: 9.1769, lng: 105.1524 },
    { code: '02', slug: 'ha-giang', name: 'Hà Giang', lat: 22.8233, lng: 104.9839 },
    { code: '04', slug: 'cao-bang', name: 'Cao Bằng', lat: 22.6667, lng: 106.2500 },
    { code: '06', slug: 'bac-kan', name: 'Bắc Kạn', lat: 22.1470, lng: 105.8348 },
    { code: '10', slug: 'lao-cai', name: 'Lào Cai', lat: 22.4856, lng: 103.9707 },
    { code: '11', slug: 'dien-bien', name: 'Điện Biên', lat: 21.3869, lng: 103.0234 },
    { code: '12', slug: 'lai-chau', name: 'Lai Châu', lat: 22.3964, lng: 103.4684 },
    { code: '14', slug: 'son-la', name: 'Sơn La', lat: 21.3283, lng: 103.9148 },
    { code: '15', slug: 'yen-bai', name: 'Yên Bái', lat: 21.7168, lng: 104.8973 },
    { code: '17', slug: 'hoa-binh', name: 'Hòa Bình', lat: 20.8172, lng: 105.3376 },
    { code: '20', slug: 'lang-son', name: 'Lạng Sơn', lat: 21.8537, lng: 106.7621 }
  ];

  // Built-in Districts Dataset
  var FALLBACK_DISTRICTS = {
    'vinh-phuc': [
      { code: 'vinh-yen', name: 'TP. Vĩnh Yên', lat: 21.3090, lng: 105.6049 },
      { code: 'phuc-yen', name: 'TP. Phúc Yên', lat: 21.3216, lng: 105.7077 },
      { code: 'binh-xuyen', name: 'Huyện Bình Xuyên', lat: 21.3417, lng: 105.6833 },
      { code: 'yen-lac', name: 'Huyện Yên Lạc', lat: 21.2333, lng: 105.5833 },
      { code: 'vinh-tuong', name: 'Huyện Vĩnh Tường', lat: 21.2667, lng: 105.5167 },
      { code: 'lap-thach', name: 'Huyện Lập Thạch', lat: 21.4167, lng: 105.4500 },
      { code: 'song-lo', name: 'Huyện Sông Lô', lat: 21.4333, lng: 105.3500 },
      { code: 'tam-dao', name: 'Huyện Tam Đảo', lat: 21.4500, lng: 105.6333 },
      { code: 'tam-duong', name: 'Huyện Tam Dương', lat: 21.3833, lng: 105.5667 }
    ],
    'ha-noi': [
      { code: 'nam-tu-liem', name: 'Quận Nam Từ Liêm', lat: 21.0133, lng: 105.7667 },
      { code: 'bac-tu-liem', name: 'Quận Bắc Từ Liêm', lat: 21.0667, lng: 105.7667 },
      { code: 'cau-giay', name: 'Quận Cầu Giấy', lat: 21.0333, lng: 105.7917 },
      { code: 'dong-da', name: 'Quận Đống Đa', lat: 21.0167, lng: 105.8250 },
      { code: 'thanh-xuan', name: 'Quận Thanh Xuân', lat: 20.9944, lng: 105.8111 },
      { code: 'ba-dinh', name: 'Quận Ba Đình', lat: 21.0333, lng: 105.8333 },
      { code: 'hoan-kiem', name: 'Quận Hoàn Kiếm', lat: 21.0285, lng: 105.8542 },
      { code: 'hai-ba-trung', name: 'Quận Hai Bà Trưng', lat: 21.0083, lng: 105.8583 },
      { code: 'ha-dong', name: 'Quận Hà Đông', lat: 20.9722, lng: 105.7778 },
      { code: 'long-bien', name: 'Quận Long Biên', lat: 21.0333, lng: 105.8833 },
      { code: 'tay-ho', name: 'Quận Tây Hồ', lat: 21.0667, lng: 105.8167 },
      { code: 'hoang-mai', name: 'Quận Hoàng Mai', lat: 20.9750, lng: 105.8583 },
      { code: 'gia-lam', name: 'Huyện Gia Lâm', lat: 21.0167, lng: 105.9500 },
      { code: 'dong-anh', name: 'Huyện Đông Anh', lat: 21.1333, lng: 105.8500 },
      { code: 'soc-son', name: 'Huyện Sóc Sơn', lat: 21.2667, lng: 105.8500 },
      { code: 'me-linh', name: 'Huyện Mê Linh', lat: 21.1833, lng: 105.7167 }
    ],
    'phu-tho': [
      { code: 'viet-tri', name: 'TP. Việt Trì', lat: 21.3289, lng: 105.4012 },
      { code: 'phu-tho-tx', name: 'Thị xã Phú Thọ', lat: 21.4000, lng: 105.2167 },
      { code: 'phu-ninh', name: 'Huyện Phù Ninh', lat: 21.4333, lng: 105.3167 },
      { code: 'lam-thao', name: 'Huyện Lâm Thao', lat: 21.3333, lng: 105.3000 },
      { code: 'tam-nong', name: 'Huyện Tam Nông', lat: 21.2667, lng: 105.2500 },
      { code: 'thanh-ba', name: 'Huyện Thanh Ba', lat: 21.4667, lng: 105.1833 }
    ],
    'tuyen-quang': [
      { code: 'tuyen-quang-tp', name: 'TP. Tuyên Quang', lat: 21.8236, lng: 105.2154 },
      { code: 'son-duong', name: 'Huyện Sơn Dương', lat: 21.7167, lng: 105.4000 },
      { code: 'yen-son', name: 'Huyện Yên Sơn', lat: 21.9000, lng: 105.2500 }
    ],
    'thai-nguyen': [
      { code: 'thai-nguyen-tp', name: 'TP. Thái Nguyên', lat: 21.5928, lng: 105.8442 },
      { code: 'song-cong', name: 'TP. Sông Công', lat: 21.4833, lng: 105.8167 },
      { code: 'pho-yen', name: 'TP. Phổ Yên', lat: 21.4167, lng: 105.8500 }
    ],
    'bac-ninh': [
      { code: 'bac-ninh-tp', name: 'TP. Bắc Ninh', lat: 21.1861, lng: 106.0763 },
      { code: 'tu-son', name: 'TP. Từ Sơn', lat: 21.1167, lng: 105.9667 },
      { code: 'que-vo', name: 'Thị xã Quế Võ', lat: 21.1500, lng: 106.1833 },
      { code: 'yen-phong', name: 'Huyện Yên Phong', lat: 21.2000, lng: 105.9833 }
    ]
  };

  // State
  var userLocation = null;
  var isGpsActive = false;
  var showAllLocations = false;

  document.addEventListener('DOMContentLoaded', function() {
    var selectProvince = document.getElementById('vfFilterProvince');
    var selectDistrict = document.getElementById('vfFilterDistrict');
    var selectWard = document.getElementById('vfFilterWard');
    var selectType = document.getElementById('vfFilterType');
    var inputKeyword = document.getElementById('vfFilterKeyword');
    var btnSearch = document.getElementById('vfBtnSearch');
    var btnGps = document.getElementById('vfBtnGps');
    var btnClearGps = document.getElementById('vfBtnClearGps');
    var gpsNotice = document.getElementById('vfGpsNotice');
    var gpsMessage = document.getElementById('vfGpsMessage');
    var countLocs = document.getElementById('vfCountLocs');
    var sortHint = document.getElementById('vfSortHint');
    var mapIframe = document.getElementById('vfMapIframe');
    var targetTitle = document.getElementById('vfTargetTitle');
    var listContainer = document.getElementById('vfLocationsList');

    // 1. Populate all 63 Provinces
    function initProvinces() {
      selectProvince.innerHTML = '<option value="all">Tất cả Tỉnh/Thành (Toàn quốc)</option>';
      ALL_VIETNAM_PROVINCES.forEach(function(p) {
        var opt = document.createElement('option');
        opt.value = p.slug;
        opt.setAttribute('data-code', p.code);
        opt.setAttribute('data-lat', p.lat);
        opt.setAttribute('data-lng', p.lng);
        opt.textContent = p.name;
        if (p.slug === 'vinh-phuc') {
          opt.selected = true;
        }
        selectProvince.appendChild(opt);
      });
    }

    // 2. Haversine formula to compute distance in KM
    function calcDistanceKm(lat1, lon1, lat2, lon2) {
      var R = 6371; // km
      var dLat = (lat2 - lat1) * Math.PI / 180;
      var dLon = (lon2 - lon1) * Math.PI / 180;
      var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      return R * c;
    }

    // 3. Load Districts dynamically based on selected Province
    function updateDistrictOptions(provinceVal) {
      selectDistrict.innerHTML = '<option value="all">Tất cả Quận/Huyện</option>';
      selectWard.innerHTML = '<option value="all">Tất cả Phường/Xã</option>';
      if (provinceVal === 'all') return;

      var selectedOpt = selectProvince.options[selectProvince.selectedIndex];
      var provinceCode = selectedOpt ? selectedOpt.getAttribute('data-code') : null;

      // Fallback
      if (FALLBACK_DISTRICTS[provinceVal]) {
        FALLBACK_DISTRICTS[provinceVal].forEach(function(d) {
          var opt = document.createElement('option');
          opt.value = d.code;
          opt.setAttribute('data-lat', d.lat || '');
          opt.setAttribute('data-lng', d.lng || '');
          opt.textContent = d.name;
          selectDistrict.appendChild(opt);
        });
      }

      // Fetch API v2
      if (provinceCode) {
        fetch('https://provinces.open-api.vn/api/v2/p/' + provinceCode + '?depth=2')
          .then(function(res) { return res.json(); })
          .then(function(data) {
            if (data && data.districts && data.districts.length > 0) {
              selectDistrict.innerHTML = '<option value="all">Tất cả Quận/Huyện</option>';
              data.districts.forEach(function(d) {
                var opt = document.createElement('option');
                var slug = d.name.toLowerCase()
                  .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                  .replace(/đ/g, 'd')
                  .replace(/[^a-z0-9]/g, '-')
                  .replace(/-+/g, '-').replace(/^-|-$/g, '');
                opt.value = slug;
                opt.setAttribute('data-code', d.code);
                opt.textContent = d.name;
                selectDistrict.appendChild(opt);
              });
            }
          })
          .catch(function(err) {});
      }
    }

    // 4. Load Wards dynamically based on selected District
    function updateWardOptions(districtVal) {
      selectWard.innerHTML = '<option value="all">Tất cả Phường/Xã</option>';
      if (districtVal === 'all') return;

      var selectedDistOpt = selectDistrict.options[selectDistrict.selectedIndex];
      var districtCode = selectedDistOpt ? selectedDistOpt.getAttribute('data-code') : null;

      if (districtCode) {
        fetch('https://provinces.open-api.vn/api/v2/d/' + districtCode + '?depth=2')
          .then(function(res) { return res.json(); })
          .then(function(data) {
            if (data && data.wards && data.wards.length > 0) {
              selectWard.innerHTML = '<option value="all">Tất cả Phường/Xã</option>';
              data.wards.forEach(function(w) {
                var opt = document.createElement('option');
                var slug = w.name.toLowerCase()
                  .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                  .replace(/đ/g, 'd')
                  .replace(/[^a-z0-9]/g, '-')
                  .replace(/-+/g, '-').replace(/^-|-$/g, '');
                opt.value = slug;
                opt.textContent = w.name;
                selectWard.appendChild(opt);
              });
            }
          })
          .catch(function(err) {});
      }
    }

    // 5. Cập nhật trực tiếp khung Google Maps theo khu vực tìm kiếm
    function updateLiveGoogleMap() {
      var pText = selectProvince.options[selectProvince.selectedIndex] ? selectProvince.options[selectProvince.selectedIndex].text : '';
      var dText = selectDistrict.options[selectDistrict.selectedIndex] ? selectDistrict.options[selectDistrict.selectedIndex].text : '';
      var wText = selectWard.options[selectWard.selectedIndex] ? selectWard.options[selectWard.selectedIndex].text : '';
      var typeVal = selectType.value;
      var kw = inputKeyword.value.trim();

      var areaParts = [];
      if (kw) areaParts.push(kw);
      if (wText && wText !== 'Tất cả Phường/Xã') areaParts.push(wText);
      if (dText && dText !== 'Tất cả Quận/Huyện') areaParts.push(dText);
      if (pText && pText.indexOf('Tất cả') === -1) areaParts.push(pText);

      var typePrefix = 'Trạm sạc Showroom VinFast';
      if (typeVal === 'showroom') typePrefix = 'Showroom ô tô VinFast';
      if (typeVal === 'charging') typePrefix = 'Trạm sạc ô tô điện VinFast';

      var fullQuery = typePrefix;
      if (areaParts.length > 0) {
        fullQuery += ' tại ' + areaParts.join(', ');
      } else {
        fullQuery += ' Vĩnh Phúc';
      }

      if (mapIframe) {
        mapIframe.src = 'https://maps.google.com/maps?q=' + encodeURIComponent(fullQuery) + '&hl=vi&z=13&output=embed';
      }

      if (targetTitle) {
        targetTitle.textContent = fullQuery;
      }
    }

    // 6. Filter & Rank Top 5 nearest locations
    function renderAndFilterLocations() {
      var provVal = selectProvince.value;
      var typeVal = selectType.value;
      var kwVal = inputKeyword.value.toLowerCase().trim();

      // Xác định tọa độ gốc tham chiếu (GPS hoặc Tâm khu vực lọc)
      var refOrigin = null;
      var refLabel = '';

      if (userLocation) {
        refOrigin = { lat: userLocation.lat, lng: userLocation.lng };
        refLabel = 'vị trí của bạn';
      } else {
        var selectedProvOpt = selectProvince.options[selectProvince.selectedIndex];
        var pLat = selectedProvOpt ? parseFloat(selectedProvOpt.getAttribute('data-lat')) : null;
        var pLng = selectedProvOpt ? parseFloat(selectedProvOpt.getAttribute('data-lng')) : null;
        var pName = selectedProvOpt ? selectedProvOpt.text : '';

        if (!isNaN(pLat) && !isNaN(pLng) && pLat && pLng) {
          refOrigin = { lat: pLat, lng: pLng };
          refLabel = pName;
        } else {
          // Default Vĩnh Phúc
          refOrigin = { lat: 21.31295, lng: 105.590112 };
          refLabel = 'Vĩnh Phúc';
        }
      }

      var cards = Array.from(document.querySelectorAll('.vf-map-card'));
      var matchingCards = [];

      cards.forEach(function(card) {
        var cardProv = card.getAttribute('data-province');
        var cardType = card.getAttribute('data-type');
        var cardText = card.textContent.toLowerCase();
        var cardLat = parseFloat(card.getAttribute('data-lat'));
        var cardLng = parseFloat(card.getAttribute('data-lng'));

        // Kiểm tra loại hình và từ khóa
        var matchType = (typeVal === 'all' || cardType === typeVal);
        var matchKw = (kwVal === '' || cardText.indexOf(kwVal) !== -1);

        if (!matchType || !matchKw) {
          card.style.display = 'none';
          return;
        }

        // Tính khoảng cách từ điểm tham chiếu (GPS hoặc tâm Tỉnh)
        var dist = 999999;
        if (refOrigin && !isNaN(cardLat) && !isNaN(cardLng)) {
          dist = calcDistanceKm(refOrigin.lat, refOrigin.lng, cardLat, cardLng);
        }
        card.setAttribute('data-distance', dist.toFixed(2));

        // Điểm ưu tiên nếu trùng đúng Tỉnh đã chọn
        var isExactProvince = (provVal !== 'all' && cardProv === provVal);
        card.setAttribute('data-exact-prov', isExactProvince ? '1' : '0');

        matchingCards.push({
          element: card,
          distance: dist,
          isExactProvince: isExactProvince
        });
      });

      // Sắp xếp: Ưu tiên cơ sở trùng đúng Tỉnh trước (xếp theo khoảng cách), sau đó đến các cơ sở gần nhất ở tỉnh lân cận
      matchingCards.sort(function(a, b) {
        if (!userLocation && provVal !== 'all') {
          if (a.isExactProvince && !b.isExactProvince) return -1;
          if (!a.isExactProvince && b.isExactProvince) return 1;
        }
        return a.distance - b.distance;
      });

      // Lấy TOP 5 gần nhất (hoặc tất cả nếu bấm xem thêm)
      var maxDisplay = showAllLocations ? matchingCards.length : Math.min(5, matchingCards.length);
      var visibleCount = 0;

      matchingCards.forEach(function(item, index) {
        var card = item.element;
        var dist = item.distance;
        var distEl = card.querySelector('.vf-map-card-distance');

        if (index < maxDisplay) {
          card.style.display = 'block';
          visibleCount++;
          listContainer.appendChild(card);

          if (distEl && dist < 900000) {
            var formattedDist = dist < 1 ? (Math.round(dist * 1000) + ' m') : (dist.toFixed(1) + ' km');
            var badgeText = userLocation ? ('Cách bạn ' + formattedDist) : ('Cách ' + refLabel + ' ' + formattedDist);
            distEl.innerHTML = '<span class="vf-dist-badge"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg> ' + badgeText + '</span>';
            distEl.style.display = 'block';
          }
        } else {
          card.style.display = 'none';
        }
      });

      // Hiển thị nút Xem thêm nếu có nhiều hơn 5 địa điểm
      var toggleBtn = document.getElementById('vfBtnToggleMore');
      if (!toggleBtn && matchingCards.length > 5) {
        toggleBtn = document.createElement('div');
        toggleBtn.id = 'vfBtnToggleMore';
        toggleBtn.className = 'vf-toggle-more-wrap';
        toggleBtn.innerHTML = '<button type="button" class="vf-map-btn secondary vf-anim-btn" style="width:100%; height:44px; margin-top:12px;">XEM THÊM CÁC ĐỊA ĐIỂM KHÁC (' + matchingCards.length + ' ĐỊA ĐIỂM)</button>';
        toggleBtn.querySelector('button').addEventListener('click', function() {
          showAllLocations = !showAllLocations;
          this.textContent = showAllLocations ? 'THU GỌN TOP 5 ĐỊA ĐIỂM GẦN NHẤT' : ('XEM THÊM CÁC ĐỊA ĐIỂM KHÁC (' + matchingCards.length + ' ĐỊA ĐIỂM)');
          renderAndFilterLocations();
        });
        listContainer.parentNode.appendChild(toggleBtn);
      } else if (toggleBtn) {
        toggleBtn.style.display = matchingCards.length > 5 ? 'block' : 'none';
      }

      var emptyBox = document.getElementById('vfEmptyResults');
      if (emptyBox) {
        emptyBox.style.display = visibleCount === 0 ? 'block' : 'none';
      }

      // Cập nhật Header
      if (countLocs) {
        countLocs.textContent = visibleCount;
      }
      if (sortHint) {
        sortHint.style.display = visibleCount > 0 ? 'inline-block' : 'none';
        sortHint.textContent = userLocation ? '⚡ 5 địa điểm gần vị trí của bạn nhất' : ('⚡ 5 địa điểm gần ' + refLabel + ' nhất');
      }

      // Cập nhật Google Map
      updateLiveGoogleMap();
    }

    // Set map iframe view when clicking or selecting a card
    function selectCardMap(card) {
      document.querySelectorAll('.vf-map-card').forEach(function(c) {
        c.classList.remove('is-active');
      });
      card.classList.add('is-active');

      var lat = card.getAttribute('data-lat');
      var lng = card.getAttribute('data-lng');
      var title = card.getAttribute('data-title');

      if (targetTitle && title) {
        targetTitle.textContent = title;
      }

      if (mapIframe && lat && lng) {
        mapIframe.src = 'https://maps.google.com/maps?q=' + lat + ',' + lng + '&hl=vi&z=15&output=embed';
      }
    }

    // Card click event
    listContainer.addEventListener('click', function(e) {
      var card = e.target.closest('.vf-map-card');
      if (card && !e.target.closest('a')) {
        selectCardMap(card);
      }
    });

    // Trigger GPS Locate
    function handleGpsLocate() {
      var isSecure = (location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1');

      if (!navigator.geolocation) {
        gpsNotice.style.display = 'flex';
        gpsNotice.className = 'vf-gps-notice error';
        gpsMessage.innerHTML = 'Trình duyệt hoặc thiết bị của bạn không hỗ trợ định vị GPS.';
        return;
      }

      if (!isSecure) {
        gpsNotice.style.display = 'flex';
        gpsNotice.className = 'vf-gps-notice error';
        gpsMessage.innerHTML = '⚠️ <strong>Lưu ý:</strong> Trình duyệt di động (iOS Safari/Android Chrome) bắt buộc kết nối bảo mật <strong>HTTPS</strong> để bật GPS. Bạn đang truy cập qua HTTP nội bộ, vui lòng dùng bộ lọc chọn Tỉnh/Thành phố ở trên.';
        return;
      }

      btnGps.classList.add('loading');
      btnGps.innerHTML = '<span>ĐANG ĐỊNH VỊ...</span>';
      gpsNotice.style.display = 'flex';
      gpsNotice.className = 'vf-gps-notice';
      gpsMessage.innerHTML = 'Đang lấy tọa độ GPS từ thiết bị của bạn...';

      navigator.geolocation.getCurrentPosition(
        function(position) {
          userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          isGpsActive = true;

          btnGps.classList.remove('loading');
          btnGps.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="8"/></svg><span>GẦN TÔI</span>';
          btnGps.classList.add('active');

          gpsNotice.style.display = 'flex';
          gpsNotice.className = 'vf-gps-notice success';
          
          var accuracy = Math.round(position.coords.accuracy || 0);
          var accText = accuracy > 1000 ? ' (Định vị qua mạng IP, sai số ~' + (accuracy/1000).toFixed(1) + 'km)' : ' (Độ chính xác GPS: ±' + accuracy + 'm)';
          gpsMessage.innerHTML = '<strong>Đã định vị thành công!</strong>' + accText + ' — Đang hiển thị 5 cơ sở VinFast gần bạn nhất.';

          selectProvince.value = 'all';
          updateDistrictOptions('all');
          renderAndFilterLocations();
        },
        function(error) {
          btnGps.classList.remove('loading');
          btnGps.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg><span>GẦN TÔI</span>';
          
          var msg = 'Không thể lấy vị trí. Vui lòng cho phép quyền truy cập vị trí trên trình duyệt.';
          if (error.code === error.PERMISSION_DENIED) {
            msg = 'Bạn đã từ chối chia sẻ vị trí. Vui lòng bật quyền Vị trí (Location) trong cài đặt trình duyệt để tìm trạm sạc gần nhất.';
          }
          gpsNotice.style.display = 'flex';
          gpsNotice.className = 'vf-gps-notice error';
          gpsMessage.textContent = msg;
        },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
      );
    }

    // Clear GPS mode
    if (btnClearGps) {
      btnClearGps.addEventListener('click', function() {
        userLocation = null;
        isGpsActive = false;
        btnGps.classList.remove('active');
        gpsNotice.style.display = 'none';
        renderAndFilterLocations();
      });
    }

    // Reset filter button in empty state box
    var btnResetFilter = document.getElementById('vfBtnResetFilter');
    if (btnResetFilter) {
      btnResetFilter.addEventListener('click', function() {
        selectProvince.value = 'all';
        selectDistrict.value = 'all';
        selectWard.value = 'all';
        selectType.value = 'all';
        inputKeyword.value = '';
        updateDistrictOptions('all');
        renderAndFilterLocations();
      });
    }

    // Event Listeners
    if (selectProvince) {
      selectProvince.addEventListener('change', function() {
        updateDistrictOptions(this.value);
        renderAndFilterLocations();
      });
    }

    if (selectDistrict) {
      selectDistrict.addEventListener('change', function() {
        updateWardOptions(this.value);
        renderAndFilterLocations();
      });
    }

    if (selectWard) {
      selectWard.addEventListener('change', function() {
        renderAndFilterLocations();
      });
    }

    if (selectType) {
      selectType.addEventListener('change', renderAndFilterLocations);
    }

    if (inputKeyword) {
      inputKeyword.addEventListener('input', renderAndFilterLocations);
    }

    if (btnSearch) {
      btnSearch.addEventListener('click', renderAndFilterLocations);
    }

    if (btnGps) {
      btnGps.addEventListener('click', handleGpsLocate);
    }

    // Khởi tạo
    initProvinces();
    updateDistrictOptions('vinh-phuc');
    renderAndFilterLocations();
  });
})();
</script>

<?php
get_footer();

