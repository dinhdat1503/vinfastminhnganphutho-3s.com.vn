<?php
/**
 * Template Name: Chính sách bảo hành - VinFast Vĩnh Phúc
 * Description: Trang chính sách bảo hành xe ô tô điện VinFast chuẩn Mobile-First Responsive
 */

get_header();

$uploads_url = content_url('/uploads/official_cars/service');
?>

<div class="vf-w-page-wrapper">
  
  <!-- 1. HERO SECTION -->
  <section class="vf-w-hero">
    <div class="container vf-w-hero-inner">
      <h1 class="vf-w-hero-title">Chính sách bảo hành</h1>
      <p class="vf-w-hero-subtitle">
        Vững vàng lăn bánh trên mọi hành trình với chính sách bảo hành dài lâu từ VinFast - bảo vệ trọn vẹn quyền lợi và mang đến sự an tâm cho Quý khách.
      </p>
      <div class="vf-w-hero-actions">
        <a href="#warranty-book-dropdown" class="vf-w-btn-hero">SỔ BẢO HÀNH Ô TÔ</a>
      </div>
    </div>
    
    <div class="vf-w-hero-banner">
      <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="VinFast Service Workshop">
    </div>
  </section>

  <!-- 2. MAIN LAYOUT (STICKY SIDEBAR + CONTENT) -->
  <div class="container vf-w-main-container">
    
    <!-- SIDEBAR NAV (DESKTOP STICKY / MOBILE HORIZONTAL SCROLL) -->
    <aside class="vf-w-sidebar">
      <nav class="vf-w-nav">
        <a href="#pham-vi" class="vf-w-nav-link active">Phạm vi bảo hành</a>
        <a href="#thoi-han" class="vf-w-nav-link">Thời hạn bảo hành</a>
        <a href="#phu-tung-moi" class="vf-w-nav-link">Phụ tùng xe mới bảo hành giới hạn</a>
        <a href="#phu-tung" class="vf-w-nav-link">Bảo hành phụ tùng</a>
        <a href="#phu-kien" class="vf-w-nav-link">Bảo hành phụ kiện</a>
        <a href="#loai-tru" class="vf-w-nav-link">Các hạng mục không thuộc phạm vi bảo hành</a>
        <a href="#faq" class="vf-w-nav-link">Câu hỏi thường gặp</a>
        <a href="#ho-tro" class="vf-w-nav-link">Thông tin hỗ trợ</a>
      </nav>

      <div class="vf-w-sidebar-ctas hide-for-small">
        <a href="#warranty-book-dropdown" class="vf-w-side-btn primary">SỔ BẢO HÀNH Ô TÔ</a>
        <a href="#warranty-book-dropdown" class="vf-w-side-btn outline">HƯỚNG DẪN SỬ DỤNG Ô TÔ</a>
      </div>
    </aside>

    <!-- CONTENT COLUMN -->
    <main class="vf-w-content">

      <!-- SECTION 01: PHẠM VI BẢO HÀNH -->
      <section class="vf-w-section" id="pham-vi">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">01 · Điều kiện áp dụng</span>
          <h2>Phạm vi bảo hành</h2>
        </div>
        <ul class="vf-w-bullet-list">
          <li>Áp dụng cho các hư hỏng phát sinh từ lỗi phần mềm, lỗi linh kiện hoặc lỗi lắp ráp trong quá trình sản xuất, với điều kiện xe được sử dụng và bảo dưỡng đúng khuyến nghị.</li>
          <li>Phụ tùng dùng để thay thế trong bảo hành là hàng chính hãng, ở cấp độ chi tiết nhỏ nhất có thể cung cấp.</li>
          <li>Hiệu lực trên toàn quốc, chỉ được thực hiện tại xưởng dịch vụ và đại lý ủy quyền chính hãng VinFast.</li>
          <li>Toàn bộ công việc bảo hành hợp lệ được thực hiện hoàn toàn miễn phí.</li>
          <li>Hãng có quyền lựa chọn sửa chữa thay vì đổi mới sản phẩm, nếu lỗi có thể khắc phục được bằng sửa chữa kỹ thuật.</li>
        </ul>
      </section>

      <!-- SECTION 02: THỜI HẠN BẢO HÀNH & SỔ BẢO HÀNH Ô TÔ -->
      <section class="vf-w-section" id="thoi-han">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">02 · Quy định thời hạn</span>
          <h2>Thời hạn bảo hành</h2>
        </div>
        <p class="vf-w-desc">
          Toàn bộ sổ bảo hành đã chuyển sang hình thức điện tử. Khi bàn giao xe, đại lý VinFast Vĩnh Phúc sẽ hướng dẫn khách hàng xác nhận và tra cứu sổ bảo hành trực tuyến. Thời hạn áp dụng khác nhau giữa xe sử dụng tiêu chuẩn và xe từng dùng cho mục đích thương mại (taxi, xe công nghệ, cho thuê, giao hàng...) — chính sách thương mại vẫn duy trì kể cả khi xe được sang tên.
        </p>

        <div class="vf-w-note-box">
          <p><strong>(*) Dịch vụ thương mại:</strong> Là đối tượng khách hàng kinh doanh, bao gồm nhưng không giới hạn, đang hoặc đã từng sử dụng xe làm taxi, xe sử dụng cho dịch vụ chở khách (Grab, Be...), xe cho thuê, xe đưa đón, xe giao hàng.</p>
        </div>

        <!-- SỔ BẢO HÀNH Ô TÔ DROPDOWN BLOCK (THEO MẪU ẢNH NGƯỜI DÙNG) -->
        <div class="vf-w-warranty-docs-wrapper" id="warranty-book-dropdown">
          
          <div class="vf-w-doc-card active">
            <div class="vf-w-doc-header" onclick="vfToggleDocAccordion(this)">
              <h3>SỔ BẢO HÀNH Ô TÔ</h3>
              <span class="vf-w-chevron">▲</span>
            </div>
            <div class="vf-w-doc-body">
              <ul class="vf-w-download-list">
                <li>
                  <a href="/#" title="Tải Sổ bảo hành VF 3">
                    <span>Sổ bảo hành VF 3</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
                <li>
                  <a href="/#" title="Tải Sổ bảo hành VF 5">
                    <span>Sổ bảo hành VF 5</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
                <li>
                  <a href="/#" title="Tải Sổ bảo hành VF 6">
                    <span>Sổ bảo hành VF 6</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
                <li>
                  <a href="/#" title="Tải Sổ bảo hành VF 7">
                    <span>Sổ bảo hành VF 7</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
                <li>
                  <a href="/#" title="Tải Sổ bảo hành VF 8">
                    <span>Sổ bảo hành VF 8</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
                <li>
                  <a href="/#" title="Tải Sổ bảo hành VF 9">
                    <span>Sổ bảo hành VF 9</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
                <li>
                  <a href="/#" title="Tải Sổ bảo hành dòng xe Thương mại Green / Limo / EC Van">
                    <span>Sổ bảo hành dòng xe Green / Limo / EC Van</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="vf-w-doc-card">
            <div class="vf-w-doc-header" onclick="vfToggleDocAccordion(this)">
              <h3>HƯỚNG DẪN SỬ DỤNG Ô TÔ</h3>
              <span class="vf-w-chevron">↗</span>
            </div>
            <div class="vf-w-doc-body" style="display:none;">
              <ul class="vf-w-download-list">
                <li>
                  <a href="/#" title="Xem HDSD VinFast">
                    <span>Tài liệu hướng dẫn sử dụng xe điện VinFast</span>
                    <span class="vf-w-dl-icon">📥</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </section>

      <!-- SECTION 03: PHỤ TÙNG XE MỚI BẢO HÀNH GIỚI HẠN -->
      <section class="vf-w-section" id="phu-tung-moi">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">03 · Trang bị theo xe</span>
          <h2>Phụ tùng xe mới bảo hành giới hạn</h2>
          <p>Thời hạn tiêu biểu cho dòng xe điện phổ thông (VF 3/5/6/7, dòng Green...), sử dụng tiêu chuẩn. Xe dùng cho mục đích thương mại có thời hạn ngắn hơn.</p>
        </div>

        <div class="vf-w-parts-grid">
          
          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🔋</div>
            <h3>Pin cao áp</h3>
            <div class="vf-w-part-row"><span>Tiêu chuẩn</span><strong>8 - 10 năm / 160.000 - 200.000 km</strong></div>
            <div class="vf-w-part-row"><span>Thương mại</span><strong>3 năm / 100.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🔌</div>
            <h3>Ắc quy 12V</h3>
            <div class="vf-w-part-row"><span>Xe điện</span><strong>1 năm, không giới hạn km</strong></div>
            <div class="vf-w-part-row"><span>Xe xăng</span><strong>1 năm / 20.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🛡️</div>
            <h3>Gỉ sét thân vỏ</h3>
            <div class="vf-w-part-row"><span>Nhóm phổ thông</span><strong>7 - 10 năm, không giới hạn km</strong></div>
            <div class="vf-w-part-row"><span>Thương mại</span><strong>3 năm / 100.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🎨</div>
            <h3>Sơn ngoại thất</h3>
            <div class="vf-w-part-row"><span>Nhóm phổ thông</span><strong>7 - 10 năm, không giới hạn km</strong></div>
            <div class="vf-w-part-row"><span>Thương mại</span><strong>3 năm / 100.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🔧</div>
            <h3>Hệ thống treo</h3>
            <div class="vf-w-part-row"><span>Tiêu chuẩn</span><strong>5 năm / 130.000 km</strong></div>
            <div class="vf-w-part-row"><span>Thương mại</span><strong>3 năm / 100.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🛞</div>
            <h3>Lốp xe</h3>
            <div class="vf-w-part-row"><span>Xe điện</span><strong>Theo chính sách hãng lốp</strong></div>
            <div class="vf-w-part-row"><span>Loại trừ</span><strong>Hao mòn, sai áp suất, tai nạn</strong></div>
          </div>

        </div>
      </section>

      <!-- SECTION 04: BẢO HÀNH PHỤ TÙNG THAY THẾ -->
      <section class="vf-w-section" id="phu-tung">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">04 · Thay thế định kỳ & Sửa chữa</span>
          <h2>Bảo hành phụ tùng thay thế</h2>
          <p>Áp dụng cho phụ tùng chính hãng được thay thế tại xưởng dịch vụ VinFast Vĩnh Phúc / đại lý ủy quyền. Cần lưu giữ hồ sơ sửa chữa (lệnh sửa chữa, hóa đơn) để được áp dụng bảo hành.</p>
        </div>

        <div class="vf-w-parts-grid">
          
          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">⚙️</div>
            <h3>Phụ tùng chung</h3>
            <div class="vf-w-part-row"><span>Xe điện</span><strong>2 năm / 40.000 km</strong></div>
            <div class="vf-w-part-row"><span>Xe xăng</span><strong>12 tháng / 20.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🔋</div>
            <h3>Pin cao áp mua thêm</h3>
            <div class="vf-w-part-row"><span>Lắp sau giao xe</span><strong>4 năm / 80.000 km</strong></div>
          </div>

          <div class="vf-w-part-card">
            <div class="vf-w-part-icon">🔌</div>
            <h3>Ắc quy 12V thay thế</h3>
            <div class="vf-w-part-row"><span>Xe điện</span><strong>1 năm, không giới hạn km</strong></div>
          </div>

        </div>
      </section>

      <!-- SECTION 05: BẢO HÀNH PHỤ KIỆN -->
      <section class="vf-w-section" id="phu-kien">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">05 · Phụ kiện trang bị thêm</span>
          <h2>Bảo hành phụ kiện chính hãng</h2>
        </div>
        <ul class="vf-w-bullet-list">
          <li>Phụ kiện chính hãng nói chung: 2 năm, không giới hạn số km kể từ ngày mua.</li>
          <li>Riêng móc kéo (kể cả loại điện), bậc lên xuống, giá đỡ hành lý: 5 năm tiêu chuẩn, hoặc 3 năm nếu dùng cho mục đích thương mại.</li>
          <li>Phụ kiện rời không lắp cố định (bộ sạc di động, bộ vá lốp, thảm sàn...): 2 năm kể từ ngày mua.</li>
        </ul>
      </section>

      <!-- SECTION 06: KHÔNG THUỘC PHẠM VI BẢO HÀNH -->
      <section class="vf-w-section" id="loai-tru">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">06 · Lưu ý quan trọng</span>
          <h2>Các hạng mục không thuộc phạm vi bảo hành</h2>
          <p>Nhấp vào từng nhóm dưới đây để xem chi tiết các trường hợp bị từ chối bảo hành.</p>
        </div>

        <div class="vf-w-accordion">
          
          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Độ, hoán cải trái phép hoặc lắp phụ kiện không chính hãng</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Bao gồm thay đổi công suất, hệ thống điện, cấu trúc khung gầm hoặc động cơ so với thiết kế nguyên bản của nhà sản xuất VinFast.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Sử dụng sai mục đích hoặc lạm dụng xe</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Đua xe, vận hành đường địa hình cực đoan, chở quá tải trọng cho phép, không tuân thủ hướng dẫn vận hành trong sách hướng dẫn.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Hao mòn tự nhiên theo thời gian</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Gỉ sét thông thường, bạc màu sơn, cao su lão hóa, dầu mỡ biến chất theo thời gian — không thuộc diện lỗi kỹ thuật nhà sản xuất.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Thiên tai và yếu tố bất khả kháng</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Hỏa hoạn, động đất, lũ lụt, ngập nước, sét đánh, thiệt hại do động vật gặm nhấm hoặc tác động hóa chất môi trường.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Tai nạn hoặc ngoại vật tác động</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Va chạm giao thông, đá văng, cạ gầm, đâm đụng, ngập nước khi di chuyển vào vùng ngập sâu.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Chi tiết hao mòn định kỳ</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Má phanh, đĩa phanh, cần gạt mưa, cầu chì, bóng đèn, dầu/mỡ, các loại lọc bảo dưỡng cần thay định kỳ.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Không tuân thủ lịch bảo dưỡng định kỳ</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Bỏ qua lịch bảo dưỡng khuyến cáo hoặc sửa chữa tại các cơ sở ngoài không được VinFast ủy quyền dẫn đến hư hỏng.</p>
            </div>
          </div>

          <div class="vf-w-acc-item warn">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>⚠ Không xác định được số km / cạy phá đồng hồ</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Đồng hồ công-tơ-mét bị chỉnh sửa, tháo rời hoặc hư hỏng không xác định được quãng đường thực tế.</p>
            </div>
          </div>

        </div>
      </section>

      <!-- SECTION 07: CÂU HỎI THƯỜNG GẶP -->
      <section class="vf-w-section" id="faq">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">07 · Giải đáp thắc mắc</span>
          <h2>Câu hỏi thường gặp</h2>
        </div>

        <div class="vf-w-accordion">
          
          <div class="vf-w-acc-item">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>Chính sách bảo hành mới có áp dụng cho xe đã mua trước đây không?</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Chính sách bảo hành mới áp dụng cho xe mua từ ngày chính sách có hiệu lực. Đối với xe mua trước đó, chính sách tại thời điểm ký hợp đồng mua bán vẫn được giữ nguyên hiệu lực.</p>
            </div>
          </div>

          <div class="vf-w-acc-item">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>Pin bị chai hoặc suy giảm dung lượng có được bảo hành không?</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>VinFast áp dụng chính sách bảo hành pin khi dung lượng suy giảm dưới mức tiêu chuẩn kỹ thuật (SOH dưới 70%). Khách hàng mang xe đến Xưởng dịch vụ VinFast Vĩnh Phúc để kỹ thuật viên đo đạc và thực hiện quy trình bảo hành.</p>
            </div>
          </div>

          <div class="vf-w-acc-item">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>Phụ tùng mua tại đại lý nhưng tự lắp hoặc lắp ở ngoài có được bảo hành không?</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Không. Phụ tùng chính hãng bắt buộc phải được quy trình kỹ thuật viên tại Xưởng dịch vụ ủy quyền VinFast trực tiếp lắp đặt mới đủ điều kiện áp dụng bảo hành phụ tùng.</p>
            </div>
          </div>

          <div class="vf-w-acc-item">
            <button class="vf-w-acc-trigger" onclick="vfToggleAccordion(this)">
              <span>Xe điện VinFast bị ngập nước có được bảo hành không?</span>
              <span class="vf-w-acc-arrow">▾</span>
            </button>
            <div class="vf-w-acc-content">
              <p>Hư hỏng do ngập nước hoặc di chuyển vào vùng nước ngập vượt quá khuyến cáo của nhà sản xuất thuộc trường hợp loại trừ. Khách hàng nên đăng ký Bảo hiểm vật chất xe ô tô để được hỗ trợ bồi thường thủy kích.</p>
            </div>
          </div>

        </div>
      </section>

      <!-- SECTION 08: THÔNG TIN HỖ TRỢ & XƯỞNG DỊCH VỤ -->
      <section class="vf-w-section" id="ho-tro">
        <div class="vf-w-section-head">
          <span class="vf-w-badge">08 · Liên hệ xưởng dịch vụ</span>
          <h2>Thông tin hỗ trợ & Đặt lịch dịch vụ</h2>
        </div>

        <div class="vf-w-support-grid">
          
          <div class="vf-w-support-card">
            <h3>Hotline Hỗ trợ 24/7</h3>
            <a href="tel:0562256256" class="vf-w-phone-link">📞 Hotline Tân Á Châu: 056 225 6256</a>
            <a href="tel:1900232389" class="vf-w-phone-link">📞 Tổng đài VinFast: 1900 23 23 89</a>
          </div>

          <div class="vf-w-support-card">
            <h3>Xưởng dịch vụ VinFast Tân Á Châu</h3>
            <p>Đội ngũ kỹ thuật viên chứng chỉ chính hãng, máy chẩn đoán chuyên dụng tiêu chuẩn toàn cầu.</p>
            <button class="vf-w-action-btn" onclick="vfOpenModal('modal-laythu')">🚗 ĐẶT LỊCH DỊCH VỤ NGAY</button>
          </div>

          <div class="vf-w-support-card">
            <h3>Sổ bảo hành & HDSD</h3>
            <p>Tải xuống sổ bảo hành điện tử và tài liệu kỹ thuật trực tiếp cho chiếc xe của bạn.</p>
            <a href="#warranty-book-dropdown" class="vf-w-link-btn">📥 TẢI SỔ BẢO HÀNH Ô TÔ</a>
          </div>

        </div>
      </section>

    </main>

  </div>
</div>

<script>
// Toggle Doc Accordion (Sổ bảo hành ô tô)
function vfToggleDocAccordion(headerElem) {
  var card = headerElem.closest('.vf-w-doc-card');
  var body = card.querySelector('.vf-w-doc-body');
  var chevron = headerElem.querySelector('.vf-w-chevron');
  
  if (body.style.display === 'none' || !body.style.display) {
    body.style.display = 'block';
    card.classList.add('active');
    if (chevron) chevron.textContent = '▲';
  } else {
    body.style.display = 'none';
    card.classList.remove('active');
    if (chevron) chevron.textContent = '▼';
  }
}

// Toggle Standard Accordion (Loại trừ & FAQ)
function vfToggleAccordion(btnElem) {
  var item = btnElem.closest('.vf-w-acc-item');
  var isOpened = item.classList.contains('open');
  
  item.classList.toggle('open', !isOpened);
}

// Active Nav Link on Scroll
document.addEventListener('DOMContentLoaded', function() {
  var navLinks = document.querySelectorAll('.vf-w-nav-link');
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
