<?php
/**
 * Template Name: Dịch vụ Pin và Trạm sạc Ô tô điện - VinFast Vĩnh Phúc
 * Description: Trang Dịch vụ Pin và Trạm sạc Ô tô điện VinFast chuẩn Mobile-First Responsive từ mẫu 6.html
 */

get_header();

$uploads_url = content_url('/uploads/official_cars/service');
?>

<div class="vf-p-page-wrapper">
  
  <!-- 1. SERVICE ALERT -->
  <div class="container vf-p-alert-container">
    <div class="vf-p-alert-box">
      <span class="vf-p-alert-tag">Thông báo dịch vụ pin</span>
      <p>Kể từ ngày 01/03/2025, VinFast chính thức dừng cung cấp dịch vụ cho thuê pin đối với ô tô điện mua mới. Các khách hàng hiện đang sử dụng dịch vụ thuê pin vẫn tiếp tục sử dụng bình thường theo Hợp đồng.</p>
      <p>Đồng thời, kể từ ngày 01/05/2026, VinFast chấm dứt hỗ trợ chương trình chuyển đổi từ hình thức thuê pin sang mua pin. Các khách hàng đang tham gia chương trình trả góp mua pin sẽ không bị ảnh hưởng bởi thay đổi này.</p>
    </div>
  </div>

  <!-- 2. HERO 1: THUÊ PIN -->
  <section class="vf-p-hero section-padding">
    <div class="container">
      <div class="vf-p-hero-flex">
        <div class="vf-p-hero-text">
          <span class="vf-p-badge">Tiết kiệm chi phí</span>
          <h1>Thuê pin ô tô điện linh hoạt</h1>
          <p>Với phương châm luôn đặt lợi ích Khách hàng lên hàng đầu, VinFast áp dụng chính sách cho thuê pin độc đáo, ưu việt và khác biệt với tất cả các mô hình cho thuê pin từ trước tới nay trên thế giới.</p>
          <div class="vf-p-hero-actions">
            <a href="#chinh-sach" class="vf-p-btn primary vf-anim-btn">CHÍNH SÁCH THUÊ PIN</a>
          </div>
        </div>
        <div class="vf-p-hero-img">
          <img src="<?php echo esc_url($uploads_url . '/service_booking_banner.png'); ?>" alt="Trạm sạc ô tô điện VinFast">
        </div>
      </div>
    </div>
  </section>

  <!-- 3. HERO 2: ĐA DẠNG GIẢI PHÁP SẠC -->
  <section class="vf-p-hero section-padding bg-light">
    <div class="container">
      <div class="vf-p-hero-flex reverse">
        <div class="vf-p-hero-text">
          <span class="vf-p-badge">Thuận tiện tuyệt đối</span>
          <h1>Đa dạng giải pháp sạc ô tô điện</h1>
          <p>VinFast cung cấp hệ sinh thái giải pháp sạc toàn diện bao gồm hệ thống trạm sạc công cộng phủ rộng toàn quốc và bộ thiết bị sạc tại nhà thông minh, giúp trải nghiệm xe điện luôn tiện lợi trên mọi hành trình.</p>
          <div class="vf-p-hero-actions">
            <a href="#tru-sac" class="vf-p-btn primary vf-anim-btn">TRẠM SẠC CÔNG CỘNG</a>
            <a href="#sac-tai-nha" class="vf-p-btn outline vf-anim-btn">THIẾT BỊ SẠC TẠI NHÀ</a>
          </div>
        </div>
        <div class="vf-p-hero-img">
          <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="Trạm sạc ô tô điện VinFast Vĩnh Phúc">
        </div>
      </div>
    </div>
  </section>

  <!-- 4. LỢI ÍCH THUÊ PIN -->
  <section class="vf-p-section section-padding">
    <div class="container">
      <div class="vf-p-section-head text-center">
        <h2>Lợi ích của thuê pin ô tô điện</h2>
      </div>

      <div class="vf-p-benefits-grid">
        <div class="vf-p-benefit-card">
          <div class="vf-p-benefit-num">01</div>
          <h3>Không tốn chi phí sửa chữa pin</h3>
          <p>Khách hàng hoàn toàn không phải tốn tiền sửa chữa, bảo dưỡng hay thay thế pin trong suốt quá trình thuê pin chính hãng.</p>
        </div>

        <div class="vf-p-benefit-card">
          <div class="vf-p-benefit-num">02</div>
          <h3>Vận hành tiết kiệm tối đa</h3>
          <p>Khách hàng sử dụng hệ thống điều hòa, sưởi ấm hoàn toàn bằng điện với chi phí tối ưu hơn hẳn so với xe chạy động cơ xăng.</p>
        </div>

        <div class="vf-p-benefit-card">
          <div class="vf-p-benefit-num">03</div>
          <h3>Chi phí cố định ưu việt</h3>
          <p>Nếu di chuyển nhiều hàng tháng, chi phí thuê pin gói cố định cộng tiền sạc điện vẫn tiết kiệm hơn nhiều so với tiền xăng khi dùng xe xăng cùng phân khúc.</p>
        </div>
      </div>

      <div class="vf-p-large-banner">
        <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="Hệ sinh thái xe ô tô điện VinFast">
      </div>
    </div>
  </section>

  <!-- 5. CHÍNH SÁCH THUÊ PIN (TÁCH THÀNH CÁC THẺ HÀNG NGANG 100% RỘNG TRANG - FULL WIDTH) -->
  <section class="vf-p-section section-padding bg-light" id="chinh-sach">
    <div class="container">
      
      <div class="vf-p-section-head text-center">
        <h2>Chính sách thuê pin ô tô điện</h2>
        <p class="vf-p-sub-text">Thông tin chi tiết quy định chốt ODO, chế tài nợ cước, cam kết thay pin & bảng giá thuê pin chính hãng qua các thời kỳ</p>
      </div>

      <!-- PHÂN ĐOẠN 1: TỔNG QUAN PHÍ THUÊ PIN & THỜI HẠN HỢP ĐỒNG -->
      <div class="vf-p-policy-block-card">
        <div class="vf-p-policy-grid">
          
          <div class="vf-p-policy-col">
            <h3>Phí thuê pin hàng tháng & Quy định chốt ODO</h3>
            <p><strong>Chu kỳ tính cước:</strong> Từ ngày 26 của tháng trước đến ngày 25 của tháng hiện tại.</p>
            <p><strong>Chi tiết cách lấy dữ liệu ODO để chốt cước thuê pin:</strong></p>
            <p>Thời điểm lấy dữ liệu ODO: <strong>22h00 ngày 25 hàng tháng</strong>. Dữ liệu ODO ghi nhận sau thời điểm này sẽ được tính vào kỳ cước của tháng tiếp theo.</p>
            <p>Trường hợp đặc biệt: Nếu xe không có kết nối, nằm trong vùng không có sóng, hoặc dữ liệu cuối cùng trong ngày được gửi lên hệ thống trước 22h00 (ví dụ lúc 20h00), thì dữ liệu ODO tại thời điểm cập nhật cuối cùng (ví dụ 20h00) sẽ được sử dụng để chốt cước. Các dữ liệu ODO phát sinh sau thời điểm này sẽ được tính vào kỳ cước kế tiếp.</p>
            <p><em>Lưu ý: Quý khách có thể kiểm tra thời gian chốt dữ liệu ODO chi tiết trong phần Hóa đơn thuê pin trên ứng dụng VinFast.</em></p>
            <p>Khách hàng có thể thuê pin trọn đời đến khi Khách hàng hết nhu cầu sử dụng xe. Trường hợp chuyển nhượng xe thì Khách hàng mới chỉ cần ký xác nhận tiếp tục thực hiện hợp đồng thuê pin.</p>
            <p>Giá thuê pin được cố định suốt vòng đời sản phẩm theo giá thuê pin thời điểm khách hàng nhận xe, không phụ thuộc vào chủ sở hữu. (Áp dụng với các Khách hàng ký Hợp đồng thuê pin trước ngày 01.11.2023).</p>
          </div>

          <div class="vf-p-policy-col">
            <h3>Thời hạn hợp đồng, Phí đặt cọc & Chế tài</h3>
            <ul>
              <li>Thời hạn Hợp đồng thuê pin là vô thời hạn đến khi Khách hàng hết nhu cầu hoặc hủy xe.</li>
              <li>Khách hàng không phải đặt cọc khi thuê pin (Áp dụng với Khách hàng ký Hợp đồng thuê pin trước ngày 01.11.2023).</li>
              <li>Các Khách hàng ký Hợp đồng thuê pin từ ngày 01.11.2023 trở đi cần đặt cọc thuê pin, phí đặt cọc áp dụng theo từng dòng xe.</li>
            </ul>

            <h4 style="margin-top: 20px; font-weight:700;">Phí chuyển đổi gói cước:</h4>
            <div class="vf-p-price-highlight">4.120.000 VNĐ / lần (đã bao gồm VAT)</div>

            <h4 style="margin-top: 16px; font-weight:700;">Phí trả chậm & Chế tài nợ cước:</h4>
            <p>Tỷ lệ phí thanh toán chậm là <strong>10%/năm</strong>, áp dụng cho phí thuê pin và phí đền bù pin hỏng quá hạn thanh toán.</p>
            <p style="color: #DC2626; font-weight: 600;">VinFast sẽ chặn sạc pin 50% cho tháng đầu nợ cước, từ tháng thứ 2 chặn 70% dung lượng pin (SOC). Hệ thống tự động mở khóa ngay sau khi hoàn tất công nợ.</p>

            <h4 style="margin-top: 20px; font-weight:700;">Thay thế / Sửa chữa / Bảo dưỡng pin:</h4>
            <p>Khách hàng được <strong>thay mới hoặc sửa chữa Pin miễn phí 100%</strong> khi dung lượng tối đa của pin (SOH) xuống <strong>dưới 70%</strong> hoặc lỗi do Nhà sản xuất.</p>
          </div>

        </div>
      </div>

      <!-- PHÂN ĐOẠN 2: CHÍNH SÁCH THUÊ PIN TỪ 01/01/2025 -->
      <div class="vf-p-policy-block-card">
        <h3 class="vf-p-block-title">Chính sách thuê pin từ 01/01/2025 cho các dòng xe Ô tô điện (Áp dụng mới nhất)</h3>
        <p class="vf-p-block-desc">Đối với mốc thuê pin ≤ 1.500 km/tháng, Khách hàng đang sử dụng các gói cũ có thể được chuyển sang gói mới và miễn phí chuyển đổi (*). Các gói thuê pin cũ sẽ hết hiệu lực sau khi đăng ký chuyển đổi.</p>

        <div class="vf-p-table-responsive">
          <table class="vf-p-price-table full-width">
            <thead>
              <tr>
                <th>Dòng xe</th>
                <th>Thuê pin ≤ 1.500 km</th>
                <th>Thuê pin 1.500 - 3.000 km</th>
                <th>Thuê pin > 3.000 km</th>
                <th>Phí cọc thuê pin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>VF 3</strong></td>
                <td>1.100.000 VNĐ</td>
                <td>1.400.000 VNĐ (tới 2.500 km)</td>
                <td>3.000.000 VNĐ (> 2.500 km)</td>
                <td>7.000.000 VNĐ</td>
              </tr>
              <tr>
                <td><strong>VF 5</strong></td>
                <td>1.400.000 VNĐ</td>
                <td>1.900.000 VNĐ</td>
                <td>3.200.000 VNĐ</td>
                <td>15.000.000 VNĐ</td>
              </tr>
              <tr>
                <td><strong>VF 6</strong></td>
                <td>1.700.000 VNĐ</td>
                <td>2.200.000 VNĐ</td>
                <td>3.600.000 VNĐ</td>
                <td>25.000.000 VNĐ</td>
              </tr>
              <tr>
                <td><strong>VF 7</strong></td>
                <td>2.000.000 VNĐ</td>
                <td>3.500.000 VNĐ</td>
                <td>5.800.000 VNĐ</td>
                <td>41.000.000 VNĐ</td>
              </tr>
              <tr>
                <td><strong>VF 8</strong></td>
                <td>2.300.000 VNĐ</td>
                <td>3.500.000 VNĐ</td>
                <td>5.800.000 VNĐ</td>
                <td>41.000.000 VNĐ</td>
              </tr>
              <tr>
                <td><strong>VF 9</strong></td>
                <td>3.200.000 VNĐ</td>
                <td>5.400.000 VNĐ (tới 3.500 km)</td>
                <td>8.300.000 VNĐ (> 3.500 km)</td>
                <td>60.000.000 VNĐ</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- PHÂN ĐOẠN 3: BẢNG GIÁ THUÊ PIN THEO CÁC MỐC THỜI GIAN LỊCH SỬ -->
      <div class="vf-p-policy-block-card">
        <h3 class="vf-p-block-title">Chính sách thuê pin theo các mốc thời gian trước đây</h3>

        <!-- BẢNG 18/08/2024 (VF 3) -->
        <h4 class="vf-p-sub-table-title">1. Chính sách thuê pin VF 3 từ 18/08/2024</h4>
        <div class="vf-p-table-responsive">
          <table class="vf-p-price-table full-width">
            <thead>
              <tr>
                <th>Dòng xe</th>
                <th>≤ 1.500 km</th>
                <th>1.500 - 2.500 km</th>
                <th>> 2.500 km</th>
                <th>Phí cọc thuê pin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>VF 3</strong></td>
                <td>900.000 VNĐ</td>
                <td>1.200.000 VNĐ</td>
                <td>2.500.000 VNĐ</td>
                <td>7.000.000 VNĐ</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- BẢNG 05/06/2024 -->
        <h4 class="vf-p-sub-table-title">2. Chính sách thuê pin từ 05/06/2024 cho các dòng xe Ô tô điện</h4>
        <div class="vf-p-table-responsive">
          <table class="vf-p-price-table full-width">
            <thead>
              <tr>
                <th>Dòng xe</th>
                <th>≤ 1.500 km</th>
                <th>1.500 - 3.000 km</th>
                <th>> 3.000 km</th>
                <th>Phí cọc thuê pin</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>VF 3</strong></td><td>900.000 VNĐ</td><td>1.200.000 VNĐ (tới 2.500km)</td><td>2.000.000 VNĐ (> 2.500km)</td><td>7.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 5</strong></td><td>1.200.000 VNĐ</td><td>1.600.000 VNĐ</td><td>2.700.000 VNĐ</td><td>15.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 6</strong></td><td>1.400.000 VNĐ</td><td>1.800.000 VNĐ</td><td>3.000.000 VNĐ</td><td>25.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 7</strong></td><td>1.700.000 VNĐ</td><td>2.900.000 VNĐ</td><td>4.800.000 VNĐ</td><td>41.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 8</strong></td><td>1.900.000 VNĐ</td><td>2.900.000 VNĐ</td><td>4.800.000 VNĐ</td><td>41.000.000 VNĐ</td></tr>
              <tr><td><strong>Nerio Green</strong></td><td>2.100.000 VNĐ (tới 3.000km)</td><td>-</td><td>3.500.000 VNĐ (> 3.000km)</td><td>30.000.000 VNĐ</td></tr>
            </tbody>
          </table>
        </div>

        <!-- BẢNG 01/06/2024 (VF 9) -->
        <h4 class="vf-p-sub-table-title">3. Chính sách thuê pin dòng xe VF 9 áp dụng từ 01/06/2024</h4>
        <div class="vf-p-table-responsive">
          <table class="vf-p-price-table full-width">
            <thead>
              <tr>
                <th>Dòng xe</th>
                <th>≤ 1.500 km</th>
                <th>1.500 - 3.500 km</th>
                <th>> 3.500 km</th>
                <th>Phí cọc thuê pin</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>VF 9</strong></td><td>2.700.000 VNĐ</td><td>4.500.000 VNĐ</td><td>6.900.000 VNĐ</td><td>60.000.000 VNĐ</td></tr>
            </tbody>
          </table>
        </div>

        <!-- BẢNG 01/11/2023 -->
        <h4 class="vf-p-sub-table-title">4. Chính sách thuê pin áp dụng từ 01/11/2023</h4>
        <div class="vf-p-table-responsive">
          <table class="vf-p-price-table full-width">
            <thead>
              <tr>
                <th>Dòng xe</th>
                <th>Dưới 3.000 km</th>
                <th>Từ 3.000 km trở lên</th>
                <th>Phí cọc thuê pin</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>VF 5</strong></td><td>1.600.000 VNĐ</td><td>2.700.000 VNĐ</td><td>15.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 6</strong></td><td>1.800.000 VNĐ</td><td>3.000.000 VNĐ</td><td>25.000.000 VNĐ</td></tr>
              <tr><td><strong>Nerio Green</strong></td><td>2.100.000 VNĐ</td><td>3.500.000 VNĐ</td><td>30.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 7</strong></td><td>2.900.000 VNĐ</td><td>4.800.000 VNĐ</td><td>41.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 8</strong></td><td>2.900.000 VNĐ</td><td>4.800.000 VNĐ</td><td>41.000.000 VNĐ</td></tr>
              <tr><td><strong>VF 9</strong></td><td>4.100.000 VNĐ (dưới 3.500km)</td><td>6.500.000 VNĐ (trên 3.500km)</td><td>60.000.000 VNĐ</td></tr>
            </tbody>
          </table>
        </div>

        <!-- BẢNG TRƯỚC 01/09/2022 -->
        <h4 class="vf-p-sub-table-title">5. Chính sách thuê pin cọc mua xe trước 01/09/2022</h4>
        <div class="vf-p-table-responsive">
          <table class="vf-p-price-table full-width">
            <thead>
              <tr>
                <th>Dòng xe</th>
                <th>Gói linh hoạt (500 km/tháng)</th>
                <th>Đơn giá vượt (VNĐ/km)</th>
                <th>Gói cố định (Không giới hạn km)</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><strong>Nerio Green</strong></td><td>657.500 VNĐ</td><td>1.315 VNĐ</td><td>1.805.000 VNĐ</td></tr>
              <tr><td><strong>VF 8</strong></td><td>990.000 VNĐ</td><td>1.980 VNĐ</td><td>2.189.000 VNĐ</td></tr>
              <tr><td><strong>VF 9</strong></td><td>1.100.000 VNĐ</td><td>2.200 VNĐ</td><td>3.091.000 VNĐ</td></tr>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </section>

  <!-- 6. QUY ĐỊNH SỬ DỤNG PIN -->
  <section class="vf-p-section section-padding">
    <div class="container">
      <div class="vf-p-section-head text-center">
        <h2>Quy định sử dụng pin ô tô điện</h2>
      </div>

      <div class="vf-p-rules-box">
        <div class="vf-p-rules-content">
          <h3>Quy định an toàn vận hành & Bảo quản Pin</h3>
          
          <div class="vf-p-scroll-rules">
            <ul>
              <li>Không tự ý tháo rời, sửa chữa hoặc thay thế các bộ phận, dây cáp hoặc đầu nối điện áp cao trên xe.</li>
              <li>Chỉ được sử dụng nguồn sạc tiêu chuẩn theo khuyến cáo chính thức từ nhà sản xuất VinFast.</li>
              <li>Không sử dụng Pin làm nguồn cấp điện để vận hành các thiết bị ngoài xe khi không được chỉ định.</li>
              <li>Không tự ý can thiệp phần mềm điều khiển Pin (BMS) hoặc cập nhật phần mềm trái phép. Bất kỳ sự can thiệp nào cũng có thể làm mất hiệu lực bảo hành.</li>
              <li>Không để xe ở nơi có nguy cơ ngập lụt. Trường hợp xe đã bị ngập nước, tuyệt đối không khởi động lại và gọi ngay cho hotline Cứu hộ VinFast Tân Á Châu 056 225 6256.</li>
              <li>Tránh để xe tiếp xúc môi trường nhiệt độ trên 55°C hoặc dưới -20°C quá 24 giờ liên tục để tránh suy giảm dung lượng pin.</li>
              <li>Khi dung lượng Pin còn lại dưới 5% (hiển thị màu đỏ trên màn hình), cần cắm sạc ngay lập tức để bảo vệ tế bào pin (cell pin).</li>
              <li>Trường hợp đỗ xe không sử dụng trên 30 ngày, vui lòng duy trì dung lượng pin ở mức 40% - 60% để đảm bảo tuổi thọ tối ưu.</li>
              <li>Không sử dụng các thiết bị kích điện không tương thích hoặc câu bình 12V sai quy cách gây hư hỏng bộ điều khiển Pin.</li>
              <li>Trong trường hợp xảy ra va chạm mạnh, ngắt nguồn xe và lập tức di tản khỏi xe, gọi ngay tổng đài khẩn cấp VinFast 1900 23 23 89.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 7. QUY HOẠCH TRẠM SẠC -->
  <section class="vf-p-section section-padding bg-light">
    <div class="container">
      <div class="vf-p-planning-flex">
        <div class="vf-p-planning-text">
          <span class="vf-p-badge">Hệ mạng lưới toàn quốc</span>
          <h2>Quy hoạch trạm sạc VinFast</h2>
          <p>Nhằm phát triển giao thông xanh bền vững, VinFast tiên phong đầu tư hệ thống trạm sạc quy mô với hơn 150.000 cổng sạc phủ khắp 63 tỉnh thành trên toàn quốc, trong đó có mạng lưới trạm sạc hiện đại tại tỉnh Vĩnh Phúc.</p>
          
          <div class="vf-p-stats-row">
            <div class="vf-p-stat-item">
              <span class="vf-p-stat-num">63</span>
              <span class="vf-p-stat-label">Tỉnh thành phủ sóng</span>
            </div>
            <div class="vf-p-stat-item">
              <span class="vf-p-stat-num">150.000+</span>
              <span class="vf-p-stat-label">Cổng sạc trên toàn quốc</span>
            </div>
          </div>

          <a href="<?php echo esc_url(home_url('/tim-kiem-showroom-tram-sac/')); ?>" class="vf-p-btn primary vf-anim-btn">XEM BẢN ĐỒ TRẠM SẠC</a>
        </div>
        
        <div class="vf-p-planning-img">
          <img src="<?php echo esc_url($uploads_url . '/service_workshop_banner.png'); ?>" alt="Trạm sạc VinFast phủ rộng 63 tỉnh thành">
        </div>
      </div>

      <div class="vf-p-locations-grid">
        <div class="vf-p-loc-card">
          <span class="vf-p-loc-title">Bãi đỗ xe & Bến xe</span>
          <span class="vf-p-loc-sub">Điểm sạc công cộng tiện lợi</span>
        </div>
        <div class="vf-p-loc-card">
          <span class="vf-p-loc-title">Trạm dừng nghỉ & Trạm xăng</span>
          <span class="vf-p-loc-sub">Sạc nhanh đường dài</span>
        </div>
        <div class="vf-p-loc-card">
          <span class="vf-p-loc-title">Trung tâm thương mại & Tòa nhà</span>
          <span class="vf-p-loc-sub">Sạc trong lúc làm việc & mua sắm</span>
        </div>
        <div class="vf-p-loc-card">
          <span class="vf-p-loc-title">Chung cư & Khu đô thị</span>
          <span class="vf-p-loc-sub">Sạc qua đêm an toàn</span>
        </div>
        <div class="vf-p-loc-card">
          <span class="vf-p-loc-title">Cao tốc & Quốc lộ</span>
          <span class="vf-p-loc-sub">Trụ sạc siêu nhanh DC</span>
        </div>
      </div>

    </div>
  </section>

  <!-- 8. CÁC LOẠI TRỤ SẠC CÔNG CỘNG -->
  <section class="vf-p-section section-padding" id="tru-sac">
    <div class="container">
      <div class="vf-p-section-head text-center">
        <h2>Các loại trụ sạc công cộng cho Ô tô điện</h2>
        <p class="vf-p-sub-text">VinFast trang bị đa dạng các công suất trụ sạc chuẩn quốc tế phục vụ tối đa nhu cầu của Khách hàng</p>
      </div>

      <div class="vf-p-chargers-grid">
        
        <!-- TRỤ 150kW -->
        <div class="vf-p-charger-card">
          <div class="vf-p-charger-badge">Sạc siêu nhanh</div>
          <h3>Trụ sạc DC 150kW</h3>
          <p>Thiết kế dạng tủ đứng, trang bị 2 súng sạc công suất siêu nhanh lên đến 150kW/cổng sạc.</p>
          
          <div class="vf-p-specs-table">
            <div class="vf-p-spec-row"><span>Kiểu dáng</span><span>Tủ đứng</span></div>
            <div class="vf-p-spec-row"><span>Điện áp hoạt động</span><span>3 pha, 304 - 456 VAC</span></div>
            <div class="vf-p-spec-row"><span>Điện áp ngõ ra</span><span>200 - 1000 VDC</span></div>
            <div class="vf-p-spec-row"><span>Công suất tối đa</span><span>150 kW / cổng sạc</span></div>
          </div>
        </div>

        <!-- TRỤ 60kW -->
        <div class="vf-p-charger-card">
          <div class="vf-p-charger-badge">Sạc nhanh</div>
          <h3>Trụ sạc DC 60kW</h3>
          <p>Thiết kế dạng tủ đứng, trang bị 2 súng sạc công suất 60kW/cổng sạc tại trạm đỗ công cộng.</p>
          
          <div class="vf-p-specs-table">
            <div class="vf-p-spec-row"><span>Kiểu dáng</span><span>Tủ đứng</span></div>
            <div class="vf-p-spec-row"><span>Điện áp hoạt động</span><span>3 pha, 304 - 456 VAC</span></div>
            <div class="vf-p-spec-row"><span>Điện áp ngõ ra</span><span>200 - 1000 VDC</span></div>
            <div class="vf-p-spec-row"><span>Công suất tối đa</span><span>60 kW / cổng sạc</span></div>
          </div>
        </div>

        <!-- TRỤ 30kW -->
        <div class="vf-p-charger-card">
          <div class="vf-p-charger-badge">Sạc nhanh linh hoạt</div>
          <h3>Trụ sạc DC 30kW</h3>
          <p>Thiết kế treo tường hoặc tủ đứng gọn gàng, sạc nhanh DC thích hợp điểm dừng ngắn.</p>
          
          <div class="vf-p-specs-table">
            <div class="vf-p-spec-row"><span>Kiểu dáng</span><span>Treo tường & Tủ đứng</span></div>
            <div class="vf-p-spec-row"><span>Điện áp hoạt động</span><span>3 pha, 304 - 456 VAC</span></div>
            <div class="vf-p-spec-row"><span>Công suất tối đa</span><span>30 kW / cổng sạc</span></div>
            <div class="vf-p-spec-row"><span>Giao thức kết nối</span><span>CAN Protocol</span></div>
          </div>
        </div>

        <!-- TRỤ 11kW -->
        <div class="vf-p-charger-card">
          <div class="vf-p-charger-badge">Sạc thường AC</div>
          <h3>Trụ sạc AC 11kW</h3>
          <p>Trụ sạc nguồn điện xoay chiều AC công suất 11kW phù hợp sạc qua đêm hoặc đỗ thời gian dài.</p>
          
          <div class="vf-p-specs-table">
            <div class="vf-p-spec-row"><span>Kiểu dáng</span><span>Treo tường & Tủ đứng</span></div>
            <div class="vf-p-spec-row"><span>Điện áp hoạt động</span><span>3 pha, 304 - 456 VAC</span></div>
            <div class="vf-p-spec-row"><span>Công suất tối đa</span><span>11 kW / cổng sạc</span></div>
            <div class="vf-p-spec-row"><span>Giao thức kết nối</span><span>CAN Protocol</span></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 9. THIẾT BỊ SẠC TẠI NHÀ -->
  <section class="vf-p-section section-padding bg-light" id="sac-tai-nha">
    <div class="container">
      <div class="vf-p-section-head text-center">
        <h2>Thiết bị sạc tại nhà thông minh</h2>
        <p class="vf-p-sub-text">Giải pháp sạc ô tô điện tiện lợi ngay tại gara hoặc gia đình</p>
      </div>

      <div class="vf-p-home-chargers">
        
        <!-- HOME CHARGER 1 -->
        <div class="vf-p-home-card">
          <div class="vf-p-home-info">
            <h3>Bộ sạc treo tường AC 7,4 kW</h3>
            <p>Bộ sạc treo tường AC 7,4kW cung cấp nguồn điện xoay chiều an toàn tại nhà với 1 đầu ra công suất 7,4kW, tích hợp đầy đủ tính năng chống cháy nổ và rò điện.</p>
            
            <div class="vf-p-home-specs">
              <div class="vf-p-hspec-row"><span>Chế độ sạc</span><span>Sạc AC Mức 2</span></div>
              <div class="vf-p-hspec-row"><span>Điện áp đầu vào</span><span>1 pha - 230VAC ± 10%</span></div>
              <div class="vf-p-hspec-row"><span>Tần số đầu vào</span><span>50Hz / 60Hz</span></div>
              <div class="vf-p-hspec-row"><span>Công suất ngõ ra</span><span>7,4 kW</span></div>
              <div class="vf-p-hspec-row"><span>Tính năng bảo vệ</span><span>Quá áp, thấp áp, dòng rò, quá nhiệt</span></div>
            </div>

            <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-p-btn primary vf-anim-btn">ĐẶT MUA BỘ SẠC</a>
          </div>
          
          <div class="vf-p-home-img">
            <img src="<?php echo esc_url($uploads_url . '/service_manual_banner.png'); ?>" alt="Bộ sạc treo tường AC 7.4 kW">
          </div>
        </div>

        <!-- HOME CHARGER 2 -->
        <div class="vf-p-home-card reverse">
          <div class="vf-p-home-info">
            <h3>Bộ sạc di động AC 2,2 kW</h3>
            <p>Thiết bị sạc cầm tay di động nhỏ gọn, cắm trực tiếp vào ổ cắm điện gia dụng 220V, dễ dàng mang theo cốp xe ô tô điện trên mọi chuyến đi xa.</p>
            
            <div class="vf-p-home-specs">
              <div class="vf-p-hspec-row"><span>Chế độ sạc</span><span>Sạc di động cắm ổ dân dụng</span></div>
              <div class="vf-p-hspec-row"><span>Điện áp đầu vào</span><span>1 pha - 220VAC</span></div>
              <div class="vf-p-hspec-row"><span>Công suất tối đa</span><span>2,2 kW</span></div>
              <div class="vf-p-hspec-row"><span>Chuẩn kháng nước</span><span>IP55 (Chống bụi & nước bắn)</span></div>
            </div>

            <a href="<?php echo esc_url(home_url('/dat-lich-dich-vu/')); ?>" class="vf-p-btn primary vf-anim-btn">ĐẶT MUA BỘ SẠC</a>
          </div>
          
          <div class="vf-p-home-img">
            <img src="<?php echo esc_url($uploads_url . '/service_booking_banner.png'); ?>" alt="Bộ sạc di động AC 2.2 kW">
          </div>
        </div>

      </div>
    </div>
  </section>

</div>

<?php
get_footer();
