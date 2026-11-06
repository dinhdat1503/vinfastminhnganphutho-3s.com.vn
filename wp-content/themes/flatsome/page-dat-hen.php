<?php
/* Template Name: Đặt hẹn dịch vụ VinFast */
get_header(); ?>

<style>
    .testdrive-page {
        padding: 60px 0;
        background: #fff;
        font-family: "Inter", sans-serif;
    }
    .testdrive-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 15px;
    }
    .td-section-title {
        text-align: center;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 50px;
        letter-spacing: 1px;
    }
    .td-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 60px;
    }
    @media (max-width: 768px) {
        .td-grid { 
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .testdrive-page {
            padding: 30px 0;
        }
    }
    
    .td-column-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .td-column-title::before {
        content: '';
        width: 4px;
        height: 20px;
        background: #da251d;
        display: inline-block;
    }

    /* Left Column: Car Preview */
    .td-car-preview {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 30px;
    }
    .td-car-preview img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    /* Form Styling (Contact Form 7 overrides) */
    .wpcf7-form-control-wrap {
        display: block;
        margin-bottom: 15px;
    }
    .td-form-group select, .td-form-group input, .td-form-group textarea {
        width: 100%;
        height: 45px;
        padding: 0 15px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        background: #fff;
    }
    .td-form-group textarea {
        height: 100px;
        padding: 15px;
    }
    
    /* Checkbox Styling */
    .chon-dich-vu .wpcf7-list-item {
        display: inline-block;
        margin: 0 15px 10px 0;
    }
    @media (max-width: 768px) {
        .chon-dich-vu .wpcf7-list-item {
            display: block;
            margin: 0 0 10px 0;
        }
    }
    .chon-dich-vu label {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        font-size: 14px;
        color: #444;
    }
    .chon-dich-vu input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .btn-submit-td {
        background: #da251d;
        color: #fff;
        border: none;
        padding: 15px 40px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        transition: 0.3s;
    }
    .btn-submit-td:hover {
        background: #b01e18;
        transform: translateY(-2px);
    }
    
    /* CF7 specific response messages */
    .wpcf7-response-output {
        border: none !important;
        background: #d4edda !important;
        color: #155724 !important;
        padding: 15px !important;
        border-radius: 10px !important;
        margin-top: 20px !important;
    }
</style>

<div class="testdrive-page">
    <div class="testdrive-container">
        <h1 class="td-section-title">Đặt hẹn dịch vụ</h1>

        <!-- Nhúng Shortcode Contact Form 7 ID 101 -->
        <?php echo do_shortcode('[contact-form-7 id="101" title="Đặt hẹn dịch vụ VinFast"]'); ?>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Thêm thông báo đặt hẹn
    const noticeHTML = `
        <div style="margin-bottom: 25px; font-size: 15px; line-height: 1.6; color: #444;">
            Quý khách vui lòng đặt hẹn trước 4 tiếng làm việc để được phục vụ tốt hơn.<br>
            Trong trường hợp cần đặt hẹn gấp, vui lòng gọi đến <strong style="color: #da251d;">0971.569.093</strong> để được tư vấn và hỗ trợ.
        </div>
    `;
    
    // Tìm tiêu đề CHỌN DỊCH VỤ để chèn thông báo ngay bên dưới
    let noticeInserted = false;
    const columnTitles = document.querySelectorAll('.td-column-title');
    columnTitles.forEach(title => {
        if (title.textContent.toUpperCase().includes('CHỌN DỊCH VỤ')) {
            title.insertAdjacentHTML('afterend', noticeHTML);
            noticeInserted = true;
        }
    });
    
    // Fallback nếu không tìm thấy tiêu đề, chèn lên đầu form
    if (!noticeInserted) {
        const formWrap = document.querySelector('.wpcf7');
        if (formWrap) {
            formWrap.insertAdjacentHTML('afterbegin', noticeHTML);
        }
    }

    // Car data mapping for image update
    const carImages = {
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_query' => array(array('key' => '_vf_is_vinfast', 'value' => 'yes')),
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                if (!$img_url) {
                    $img_folder = get_post_meta(get_the_ID(), '_vf_img_folder', true);
                    $colors = get_post_meta(get_the_ID(), '_vf_colors', true);
                    if (!empty($colors) && is_array($colors) && isset($colors[0]['img'])) {
                        $folder_path = (strpos($img_folder, 'vinfast-') === false && $img_folder !== 'ec-van') ? 'vinfast-' . $img_folder : $img_folder;
                        $img_url = wp_upload_dir()['baseurl'] . '/' . $folder_path . '/' . $colors[0]['img'];
                    }
                }
                echo '"' . trim(get_the_title()) . '": "' . $img_url . '",' . "\n";
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    };

    const checkSelect = setInterval(() => {
        const carSelect = document.getElementById('td_car_select');
        const carImg = document.getElementById('td_car_img');
        
        if (carSelect && carImg) {
            clearInterval(checkSelect);

            // Tự động chuyển ảnh xuống dưới cùng của cột trái (để không đẩy form)
            const elementToMove = carImg.closest('.td-car-preview') || carImg;
            const leftCol = document.querySelector('.sv-grid > div:first-child') || document.querySelector('.td-grid > div:first-child');
            if (leftCol) {
                leftCol.appendChild(elementToMove);
            } else if (carSelect.closest('div')) {
                // Fallback nếu không có grid
                carSelect.closest('div').appendChild(elementToMove);
            }

            function updateImage(val) {
                if (!val) return;
                let matchedImg = carImages[val];
                
                // Fuzzy match if exact match fails
                if (!matchedImg) {
                    for (let key in carImages) {
                        if (val.toLowerCase().includes(key.toLowerCase()) || key.toLowerCase().includes(val.toLowerCase())) {
                            matchedImg = carImages[key];
                            break;
                        }
                    }
                }

                if (matchedImg) {
                    carImg.src = matchedImg;
                    carImg.style.display = 'block';
                    if (elementToMove !== carImg) elementToMove.style.display = 'block';
                } else {
                    console.log("No image found for: ", val);
                    carImg.style.display = 'none';
                    if (elementToMove !== carImg) elementToMove.style.display = 'none';
                }
            }

            // Set initial image
            updateImage(carSelect.value);

            // Handle image load error
            carImg.onerror = function() {
                console.error("Failed to load image:", this.src);
                this.style.display = 'none';
                if (elementToMove !== carImg) elementToMove.style.display = 'none';
            };

            carSelect.addEventListener('change', function() {
                updateImage(this.value);
            });
        }
    }, 500);
});
</script>

<?php get_footer(); ?>
