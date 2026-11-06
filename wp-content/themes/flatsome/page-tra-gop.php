<?php
/* Template Name: Trình tính trả góp VinFast */
get_header(); ?>

<style>
    .installment-page {
        padding: 60px 0;
        background: #f9f9f9;
        font-family: "Inter", sans-serif;
    }
    .calc-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .calc-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .calc-header h1 {
        font-weight: 800;
        color: #1a1a1a;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .calc-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
    }
    @media (max-width: 768px) {
        .calc-grid { 
            grid-template-columns: 1fr; 
            gap: 30px;
        }
        .calc-container {
            padding: 20px;
        }
        .installment-page {
            padding: 30px 0;
        }
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #444;
    }
    .form-group select, .form-group input {
        width: 100%;
        height: 45px; /* Fixed height for consistency */
        padding: 0 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 14px; /* Adjust to standard size */
        line-height: 43px;
        outline: none;
        transition: all 0.3s;
        color: #333;
        background-color: #fff;
    }
    select {
        cursor: pointer;
        appearance: auto !important; /* Ensure arrow shows */
    }
    .form-group select:focus, .form-group input:focus {
        border-color: #3348bb;
        box-shadow: 0 0 0 3px rgba(51, 72, 187, 0.1);
    }
    .form-group input[readonly] {
        background: #f1f3f5;
        cursor: not-allowed;
    }
    
    .btn-calc {
        background: #3348bb;
        color: #fff;
        border: none;
        padding: 15px 30px;
        width: 100%;
        border-radius: 10px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: transform 0.2s, background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }
    .btn-calc:hover {
        background: #283a96;
        transform: translateY(-2px);
    }
    
    /* Vehicle Display */
    .vehicle-display {
        text-align: center;
        position: sticky;
        top: 100px;
    }
    .vehicle-display img {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        transition: all 0.5s ease;
    }
    .vehicle-price-tag {
        margin-top: 20px;
        font-size: 24px;
        font-weight: 800;
        color: #3348bb;
    }
    
    /* Result Table */
    .calc-results {
        margin-top: 60px;
        display: none;
    }
    .results-title {
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
    }
    .results-title::after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background: #3348bb;
        margin: 10px auto;
    }
    .table-wrapper {
        overflow-x: auto;
        border-radius: 15px;
        border: 1px solid #eee;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        background: #3348bb;
        color: #fff;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }
    tr:nth-child(even) { background: #f8f9fa; }
    
    /* Summary Cards */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .summary-card {
        background: #f1f3f5;
        padding: 20px;
        border-radius: 15px;
        text-align: center;
    }
    .summary-card label {
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        color: #666;
        margin-bottom: 5px;
    }
    .summary-card span {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
    }
</style>

<div class="installment-page">
    <div class="calc-container">
        <div class="calc-header">
            <h1>Mua xe trả góp</h1>
            <p>Công cụ tính toán tài chính giúp bạn sở hữu xe VinFast dễ dàng hơn</p>
        </div>

        <div class="calc-grid">
            <!-- Form -->
            <div class="calc-form">
                <?php
                // Get only the active VinFast products matching the taskbar
                $active_ids = array(83, 85, 86, 87, 88, 185, 89, 126, 92, 93, 91, 94, 178);
                $args = array(
                    'post_type'      => 'product',
                    'post__in'       => $active_ids,
                    'orderby'        => 'post__in',
                    'posts_per_page' => -1,
                );
                $query = new WP_Query($args);
                $vehicles_data = array();
                
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $p_id = get_the_ID();
                        $product = wc_get_product($p_id);
                        
                        // Get image from our custom folder logic
                        $img_folder = get_post_meta($p_id, '_vf_img_folder', true);
                        $colors = get_post_meta($p_id, '_vf_colors', true);
                        $first_img = '';
                        
                        if (!empty($colors) && is_array($colors)) {
                            $first_img = $colors[0]['img'];
                        }
                        
                        // Build full URL
                        $upload_dir = wp_upload_dir();
                        $base_url = $upload_dir['baseurl'];
                        
                        // Ensure correct folder prefix if missing
                        $folder_path = (strpos($img_folder, 'vinfast-') === false && $img_folder !== 'ec-van') ? 'vinfast-' . $img_folder : $img_folder;
                        $img_url = $base_url . '/' . $folder_path . '/' . $first_img;
                        
                        $vehicles_data[] = array(
                            'id'    => $p_id,
                            'name'  => get_the_title(),
                            'price' => $product->get_price(),
                            'image' => $img_url
                        );
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>

                <div class="form-group">
                    <label>Chọn dòng xe</label>
                    <select id="vehicle_select">
                        <option value="">-- Chọn xe --</option>
                        <?php foreach($vehicles_data as $v) : ?>
                            <option value="<?php echo $v['id']; ?>" data-price="<?php echo $v['price']; ?>" data-img="<?php echo $v['image']; ?>">
                                <?php echo $v['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Giá xe (VNĐ)</label>
                    <input type="text" id="car_price" readonly placeholder="0">
                </div>

                <div class="form-group">
                    <label>Số tiền trả trước (VNĐ)</label>
                    <input type="text" id="pre_payment" placeholder="Nhập số tiền trả trước">
                    <small id="pre_payment_hint" style="color:#666; font-size:11px;"></small>
                </div>

                <div class="form-group">
                    <label>Thời hạn vay</label>
                    <select id="loan_term">
                        <option value="12">1 năm (12 tháng)</option>
                        <option value="24">2 năm (24 tháng)</option>
                        <option value="36">3 năm (36 tháng)</option>
                        <option value="48">4 năm (48 tháng)</option>
                        <option value="60">5 năm (60 tháng)</option>
                        <option value="72">6 năm (72 tháng)</option>
                        <option value="84">7 năm (84 tháng)</option>
                        <option value="96" selected>8 năm (96 tháng)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Lãi suất ưu đãi năm đầu (%)</label>
                    <input type="number" id="interest_rate_1" value="7.0" step="0.1">
                </div>

                <div class="form-group">
                    <label>Lãi suất các năm tiếp theo (%)</label>
                    <input type="number" id="interest_rate_2" value="9.5" step="0.1">
                </div>

                <button class="btn-calc" id="btn_calculate">
                    <i class="icon-search"></i> TÍNH SỐ TIỀN PHẢI TRẢ
                </button>
            </div>

            <!-- Image Display -->
            <div class="vehicle-display">
                <div id="vehicle_img_container">
                    <img id="vehicle_img" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="VinFast">
                </div>
                <div class="vehicle-price-tag" id="display_price">0 ₫</div>
            </div>
        </div>

        <!-- Results Table -->
        <div class="calc-results" id="calc_results">
            <h2 class="results-title">Bảng dự toán trả góp hàng tháng</h2>
            
            <div class="summary-grid">
                <div class="summary-card">
                    <label>Số tiền cần vay</label>
                    <span id="sum_loan">0</span>
                </div>
                <div class="summary-card">
                    <label>Gốc hàng tháng</label>
                    <span id="sum_principal">0</span>
                </div>
                <div class="summary-card">
                    <label>Tổng lãi phải trả</label>
                    <span id="sum_total_interest">0</span>
                </div>
            </div>

            <div class="table-wrapper">
                <table id="installment_table">
                    <thead>
                        <tr>
                            <th>Kỳ trả</th>
                            <th>Gốc còn lại</th>
                            <th>Gốc hằng tháng</th>
                            <th>Lãi hằng tháng</th>
                            <th>Gốc + Lãi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- JS inject here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const vSelect = document.getElementById('vehicle_select');
    const carPriceInput = document.getElementById('car_price');
    const displayPrice = document.getElementById('display_price');
    const vehicleImg = document.getElementById('vehicle_img');
    const prePaymentInput = document.getElementById('pre_payment');
    const prePaymentHint = document.getElementById('pre_payment_hint');
    
    const formatCurrency = (val) => {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(val);
    };

    const formatNumber = (val) => {
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    };

    // Tự động định dạng khi gõ số tiền trả trước
    prePaymentInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\./g, '');
        if (isNaN(value) || value === '') {
            this.value = '';
            return;
        }
        this.value = formatNumber(value);
    });

    // Khi chọn xe
    vSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        if (!option.value) {
            carPriceInput.value = '0';
            displayPrice.innerText = '0 ₫';
            return;
        }
        
        const price = option.getAttribute('data-price');
        const img = option.getAttribute('data-img');
        
        carPriceInput.value = formatNumber(price);
        displayPrice.innerText = formatCurrency(price);
        vehicleImg.src = img;
        
        // Gợi ý trả trước tối thiểu 20%
        const minPre = Math.round(price * 0.2);
        prePaymentInput.value = formatNumber(minPre);
        prePaymentHint.innerText = 'Trả trước tối thiểu 20%: ' + formatCurrency(minPre);
    });

    // Tính toán
    document.getElementById('btn_calculate').addEventListener('click', function() {
        const priceStr = carPriceInput.value.replace(/\./g, '');
        const prePayStr = prePaymentInput.value.replace(/\./g, '');
        
        const giaXe = parseFloat(priceStr);
        const traTruoc = parseFloat(prePayStr);
        const thoiHan = parseInt(document.getElementById('loan_term').value);
        const ls1 = parseFloat(document.getElementById('interest_rate_1').value) / 100;
        const ls2 = parseFloat(document.getElementById('interest_rate_2').value) / 100;

        if (!giaXe) {
            alert('Vui lòng chọn dòng xe!');
            return;
        }

        if (traTruoc >= giaXe) {
            alert('Số tiền trả trước phải nhỏ hơn giá trị xe!');
            return;
        }

        const soTienVay = giaXe - traTruoc;
        const gocHangThang = Math.round(soTienVay / thoiHan);
        
        let duNo = soTienVay;
        let html = '';
        let totalInterest = 0;

        for (let i = 1; i <= thoiHan; i++) {
            const laiSuatThang = (i <= 12 ? ls1 : ls2) / 12;
            const lai = Math.round(duNo * laiSuatThang);
            const tongPhai = gocHangThang + lai;
            totalInterest += lai;

            html += `<tr>
                <td>Tháng ${i}</td>
                <td>${formatCurrency(duNo)}</td>
                <td>${formatCurrency(gocHangThang)}</td>
                <td>${formatCurrency(lai)}</td>
                <td><strong>${formatCurrency(tongPhai)}</strong></td>
            </tr>`;
            
            duNo -= gocHangThang;
            if (duNo < 0) duNo = 0;
        }

        // Cập nhật summary
        document.getElementById('sum_loan').innerText = formatCurrency(soTienVay);
        document.getElementById('sum_principal').innerText = formatCurrency(gocHangThang);
        document.getElementById('sum_total_interest').innerText = formatCurrency(totalInterest);

        // Hiển thị kết quả
        const tbody = document.querySelector('#installment_table tbody');
        tbody.innerHTML = html;
        document.getElementById('calc_results').style.display = 'block';
        
        // Scroll mượt xuống kết quả
        window.scrollTo({
            top: document.getElementById('calc_results').offsetTop - 100,
            behavior: 'smooth'
        });
    });
});
</script>

<?php get_footer(); ?>
