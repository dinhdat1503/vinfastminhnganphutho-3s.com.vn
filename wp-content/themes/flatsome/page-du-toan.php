<?php
/* Template Name: Dự toán chi phí lăn bánh */
get_header(); ?>

<style>
    .estimate-page {
        padding: 60px 0;
        background: #f4f6f8;
        font-family: "Inter", sans-serif;
    }
    .estimate-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #fff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .section-title {
        text-align: center;
        text-transform: uppercase;
        font-weight: 800;
        margin-bottom: 40px;
        color: #1a1a1a;
        letter-spacing: 1px;
    }
    .estimate-top {
        display: grid;
        grid-template-columns: 1.2fr 1fr 0.8fr;
        gap: 30px;
        margin-bottom: 50px;
    }
    @media (max-width: 992px) {
        .estimate-top { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .estimate-container {
            padding: 20px;
        }
        .estimate-page {
            padding: 30px 0;
        }
    }
    
    /* Left: Vehicle Image */
    .estimate-vehicle-img {
        text-align: center;
        background: #fff;
        padding: 20px;
        border-radius: 15px;
    }
    .estimate-vehicle-img img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .vehicle-name-label {
        margin-top: 15px;
        font-size: 18px;
        font-weight: 700;
        color: #333;
    }

    /* Middle: Form */
    .estimate-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .estimate-form select {
        width: 100%;
        height: 45px;
        padding: 0 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        background: #fff;
    }
    .btn-estimate {
        background: #444;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-transform: uppercase;
        transition: 0.3s;
    }
    .btn-estimate:hover {
        background: #000;
    }

    /* Right: Info Panel */
    .info-panel {
        background: #da251d; /* VinFast Red */
        color: #fff;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .info-panel-header {
        padding: 15px;
        text-align: center;
        font-weight: 700;
        border-bottom: 1px solid rgba(255,255,255,0.2);
        background: rgba(0,0,0,0.1);
    }
    .info-panel-body {
        padding: 20px;
        flex-grow: 1;
        font-size: 13px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding-bottom: 10px;
    }
    .info-panel-footer {
        padding: 20px;
        text-align: center;
        font-size: 22px;
        font-weight: 800;
        background: rgba(0,0,0,0.2);
    }

    /* Bottom: Table */
    .estimate-bottom {
        display: none;
    }
    .result-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .result-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        font-size: 15px;
    }
    .result-table td:last-child {
        text-align: right;
        font-weight: 600;
    }
    .result-table tr.total-row td {
        color: #da251d;
        font-weight: 800;
        font-size: 18px;
        border-top: 2px solid #da251d;
    }
    .result-table tr.discount-row td {
        color: #28a745;
        font-weight: 700;
        background-color: rgba(40, 167, 69, 0.05);
    }
    .discount-options {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border: 1px dashed #ccc;
    }
    .discount-options label {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }
    .discount-options label:last-child {
        margin-bottom: 0;
    }
    .discount-options input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>

<div class="estimate-page">
    <div class="estimate-container">
        <h1 class="section-title">Dự toán chi phí lăn bánh</h1>

        <div class="estimate-top">
            <!-- 1. Vehicle Image -->
            <div class="estimate-vehicle-img">
                <img id="est_car_img" src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="VinFast">
                <div class="vehicle-name-label" id="est_car_name">Vui lòng chọn xe</div>
            </div>

            <!-- 2. Select Form -->
            <div class="estimate-form">
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
                $v_list = array();
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        $p = wc_get_product(get_the_ID());
                        $img_folder = get_post_meta(get_the_ID(), '_vf_img_folder', true);
                        $colors = get_post_meta(get_the_ID(), '_vf_colors', true);
                        $folder_path = (strpos($img_folder, 'vinfast-') === false && $img_folder !== 'ec-van') ? 'vinfast-' . $img_folder : $img_folder;
                        $img_url = wp_upload_dir()['baseurl'] . '/' . $folder_path . '/' . $colors[0]['img'];
                        
                        $v_list[] = array(
                            'id' => get_the_ID(),
                            'name' => get_the_title(),
                            'price' => $p->get_price(),
                            'image' => $img_url
                        );
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                <select id="est_vehicle">
                    <option value="">-- Chọn dòng xe --</option>
                    <?php foreach($v_list as $v) : ?>
                        <option value="<?php echo $v['id']; ?>" data-price="<?php echo $v['price']; ?>" data-img="<?php echo $v['image']; ?>">
                            <?php echo $v['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select id="est_region">
                    <option value="HN">Hà Nội</option>
                    <option value="HCM">TP. Hồ Chí Minh</option>
                    <option value="OTHER">Các tỉnh thành khác</option>
                </select>

                <div class="discount-options">
                    <div style="font-size: 13px; color: #da251d; font-weight: 700; margin-bottom: 10px;">CÁC ƯU ĐÃI KÈM THEO:</div>
                    <label>
                        <input type="checkbox" id="chk_cabd" value="0.05"> Khách hàng Công An, Bộ Đội (5%)
                    </label>
                    <label>
                        <input type="checkbox" id="chk_txsd" value="0.03"> Chương trình Thu Xăng Sang Điện (3%)
                    </label>
                </div>

                <button class="btn-estimate" id="btn_tinh_phi">
                    TÍNH CHI PHÍ <i class="icon-angle-right"></i>
                </button>
            </div>

            <!-- 3. Info Panel -->
            <div class="info-panel">
                <div class="info-panel-header">THÔNG TIN</div>
                <div class="info-panel-body">
                    <div class="info-row">
                        <span>Dòng xe:</span>
                        <span id="panel_name">---</span>
                    </div>
                    <div class="info-row">
                        <span>Giá xe:</span>
                        <span id="panel_price">0 ₫</span>
                    </div>
                    <div class="info-row">
                        <span>Nơi đăng ký:</span>
                        <span id="panel_region">---</span>
                    </div>
                </div>
                <div class="info-panel-footer" id="panel_total">0 ₫</div>
            </div>
        </div>

        <!-- 4. Result Table -->
        <div class="estimate-bottom" id="est_results">
            <h2 class="section-title" style="font-size: 20px;">Chi tiết chi phí lăn bánh</h2>
            <table class="result-table">
                <tbody id="est_tbody">
                    <!-- JS inject -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const vSelect = document.getElementById('est_vehicle');
    const rSelect = document.getElementById('est_region');
    const carImg = document.getElementById('est_car_img');
    const carName = document.getElementById('est_car_name');
    
    const panelName = document.getElementById('panel_name');
    const panelPrice = document.getElementById('panel_price');
    const panelRegion = document.getElementById('panel_region');
    const panelTotal = document.getElementById('panel_total');

    const formatVND = (n) => new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(n);

    // Khi chọn xe
    vSelect.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        if (!opt.value) return;
        
        carImg.src = opt.getAttribute('data-img');
        carName.innerText = opt.text;
        panelName.innerText = opt.text;
        panelPrice.innerText = formatVND(opt.getAttribute('data-price'));
    });

    // Khi chọn khu vực
    rSelect.addEventListener('change', function() {
        panelRegion.innerText = this.options[this.selectedIndex].text;
    });

    document.getElementById('btn_tinh_phi').addEventListener('click', function() {
        const opt = vSelect.options[vSelect.selectedIndex];
        if (!opt.value) { alert('Vui lòng chọn xe!'); return; }

        const giaXe = parseFloat(opt.getAttribute('data-price'));
        const region = rSelect.value;
        const regionText = rSelect.options[rSelect.selectedIndex].text;
        const carName = opt.text.toUpperCase();

        // 1. Tính toán Ưu đãi
        let mlvtlxPercent = 0;
        let mlvtlxLabel = '';
        
        // Kiểm tra dòng xe để áp dụng % Mãnh Liệt Vì Tương Lai Xanh
        if (carName.includes('VF 8') || carName.includes('VF 9')) {
            mlvtlxPercent = 0.09;
            mlvtlxLabel = 'Mãnh Liệt Vì Tương Lai Xanh (9%)';
        } else {
            // Mặc định VF 3, 5, 6, 7 hoặc xe dịch vụ áp dụng 6%
            mlvtlxPercent = 0.06;
            mlvtlxLabel = 'Mãnh Liệt Vì Tương Lai Xanh (6%)';
        }

        let totalDiscountPercent = mlvtlxPercent;
        let discountRows = [];
        
        if (mlvtlxPercent > 0) {
            discountRows.push([`+ Ưu đãi ${mlvtlxLabel}`, `-${formatVND(giaXe * mlvtlxPercent)}`, '']);
        }

        if (document.getElementById('chk_cabd').checked) {
            totalDiscountPercent += 0.05;
            discountRows.push(['+ Ưu đãi Công An, Bộ Đội (5%)', `-${formatVND(giaXe * 0.05)}`, '']);
        }
        if (document.getElementById('chk_txsd').checked) {
            totalDiscountPercent += 0.03;
            discountRows.push(['+ Ưu đãi Thu Xăng Sang Điện (3%)', `-${formatVND(giaXe * 0.03)}`, '']);
        }

        const totalDiscountAmt = giaXe * totalDiscountPercent;

        // 2. Tính toán Phí lăn bánh
        let tyLeTruocBa = 0;
        let phiTruocBa = 0; // Xe điện VinFast được miễn 100% lệ phí trước bạ
        
        let phiBienSo = (region === 'HN' || region === 'HCM') ? 20000000 : 1000000;
        let phiKiemDinh = 340000;
        let phiDuongBo = 1560000;
        let phiTNDS = 480000;
        let phiVatChat = giaXe * 0.015;

        const tongPhi = phiTruocBa + phiBienSo + phiKiemDinh + phiDuongBo + phiTNDS + phiVatChat;
        const tongCong = giaXe - totalDiscountAmt + tongPhi;

        // Render bảng
        const rows = [
            ['Giá xe niêm yết (1)', formatVND(giaXe)],
            ...discountRows,
            ['TỔNG ƯU ĐÃI (2)', `-${formatVND(totalDiscountAmt)}`, 'discount-row'],
            ['Nơi đăng ký trước bạ', regionText],
            [`Phí trước bạ (0% - Miễn phí cho xe điện)`, formatVND(phiTruocBa)],
            ['Lệ phí đăng ký (Biển số)', formatVND(phiBienSo)],
            ['Lệ phí kiểm định', formatVND(phiKiemDinh)],
            ['Lệ phí sử dụng đường bộ/năm', formatVND(phiDuongBo)],
            ['Bảo hiểm TNDS bắt buộc/năm', formatVND(phiTNDS)],
            ['Bảo hiểm vật chất xe (tạm tính 1.5%)', formatVND(phiVatChat)],
            ['Tổng chi phí đăng ký (3)', formatVND(tongPhi)],
            ['TỔNG CHI PHÍ LĂN BÁNH (1 - 2 + 3)', formatVND(tongCong), 'total-row']
        ];

        let html = '';
        rows.forEach(r => {
            html += `<tr class="${r[2] || ''}"><td>${r[0]}</td><td>${r[1]}</td></tr>`;
        });

        document.getElementById('est_tbody').innerHTML = html;
        document.getElementById('est_results').style.display = 'block';
        panelTotal.innerText = formatVND(tongCong);
        panelRegion.innerText = regionText;

        window.scrollTo({ top: document.getElementById('est_results').offsetTop - 50, behavior: 'smooth' });
    });
});
</script>

<?php get_footer(); ?>
