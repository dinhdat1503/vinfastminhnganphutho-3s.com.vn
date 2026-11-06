<?php
/**
 * Flatsome functions and definitions
 *
 * @package flatsome
 */

require get_template_directory() . '/inc/init.php';

flatsome()->init();

/**
 * It's not recommended to add any custom code here. Please use a child theme
 * so that your customizations aren't lost during updates.
 *
 * Learn more here: https://developer.wordpress.org/themes/advanced-topics/child-themes/
 */

// Custom CSS for better UI (Header Logo fix)
add_action('wp_head', 'vf_custom_header_css');
function vf_custom_header_css() {
    echo '<style>
        /* Restored Hanging Badge with Seamless Image Blending */
        .header-main {
            overflow: visible !important;
        }
        #logo {
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        #logo a {
            background-color: #ffffff !important;
            padding: 5px 25px 25px 25px !important; /* Neatly wrap the logo */
            border-radius: 0 0 20px 20px !important; /* Smooth rounded corners */
            box-shadow: 0 6px 16px rgba(0,0,0,0.15) !important;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 100;
            top: 0;
            transition: transform 0.3s ease;
        }
        #logo img {
            /* Boost brightness/contrast to force off-white to pure white, then multiply to erase it */
            filter: contrast(1.2) brightness(1.1) !important;
            mix-blend-mode: multiply !important; 
            max-height: 95px !important; /* Kept text large */
            width: auto;
            object-fit: contain;
        }
        #logo a:hover {
            transform: translateY(3px); /* Subtle press effect */
        }
        /* ============================================ */
        /* TRANG SAN PHAM - Full-width slider + animations */
        /* ============================================ */
        
        /* Full-width slider - xoa khoang trong 2 ben */
        .page-id-133 .page-wrapper .row.row-main,
        .page-id-133 .page-wrapper .col.large-12 {
            max-width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .page-id-133 .slider-wrapper {
            max-width: 100vw !important;
            margin-left: calc(-50vw + 50%) !important;
            width: 100vw !important;
        }
        .page-id-133 .custom-page-title {
            max-width: 100% !important;
            padding: 0 !important;
        }
        
        /* Background cheo (diagonal cut) giong trang mau */
        .page-id-133 .banner-has-effect {
            position: relative;
            overflow: hidden;
        }
        .page-id-133 .banner-has-effect::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 55%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.08) 0%, transparent 60%);
            clip-path: polygon(0 0, 60% 0, 40% 100%, 0% 100%);
            z-index: 1;
        }

        /* CSS Animations cho banner */
        @keyframes vfSlideInRight {
            from { opacity: 0; transform: translateX(150px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes vfSlideInLeft {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes vfFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Mac dinh an, chi animate khi slide active */
        .page-id-133 .flickity-slider .is-selected .banner-text-animate {
            animation: vfSlideInLeft 1.8s ease forwards;
        }
        .page-id-133 .flickity-slider .is-selected .banner-car-animate {
            animation: vfSlideInRight 1.8s ease forwards;
        }
        .page-id-133 .flickity-slider .banner-text-animate,
        .page-id-133 .flickity-slider .banner-car-animate {
            opacity: 0;
        }

        /* Sidebar hover effects */
        .vf-cat-link:hover {
            background: #f5f5f5 !important;
            padding-left: 22px !important;
        }
    </style>';
}


// ============================================
// VINFAST CUSTOM PRODUCT PAGES
// ============================================

/**
 * Check if a product is a VinFast vehicle (has _vf_is_vinfast meta)
 */
function is_vinfast_product() {
    if (!is_product()) return false;
    global $post;
    return get_post_meta($post->ID, '_vf_is_vinfast', true) === 'yes';
}

/**
 * Get the universal VinFast template path
 */
function vinfast_get_product_template($slug = '') {
    // One template for ALL VinFast products
    return 'template-parts/product/vinfast-product.php';
}

/**
 * Enqueue VinFast product CSS
 */
add_action('wp_enqueue_scripts', function() {
    if (is_product()) {
        wp_enqueue_style(
            'vinfast-product',
            get_template_directory_uri() . '/assets/css/vinfast-product.css',
            array(),
            '1.0.2'
        );
    }
});

/**
 * Add body class
 */
add_filter('body_class', function($classes) {
    if (is_vinfast_product()) {
        $classes[] = 'vinfast-product';
    }
    return $classes;
});

// Hiển thị thông số kỹ thuật (Specs) ra ngoài trang danh mục sản phẩm (Catalog)
add_action('woocommerce_after_shop_loop_item_title', 'vf_show_specs_in_catalog', 15);
function vf_show_specs_in_catalog() {
    global $product;
    if (!$product) return;
    
    $specs = get_post_meta($product->get_id(), '_vf_hero_specs', true);
    if (!empty($specs) && is_array($specs)) {
        echo '<div class="vf-catalog-specs" style="font-size:12px; color:#666; text-align:left; margin-top:10px; border-top: 1px solid #eee; padding-top: 10px;">';
        echo '<ul style="list-style: none; padding: 0; margin: 0;">';
        $count = 0;
        foreach ($specs as $spec) {
            if ($count >= 5) break; // Chỉ hiển thị tối đa 5 thông số
            echo '<li style="margin-bottom:5px; line-height: 1.4;">• ' . esc_html($spec['label']) . ': <strong>' . esc_html($spec['value']) . '</strong></li>';
            $count++;
        }
        echo '</ul>';
        echo '</div>';
    }
}

// Thêm floating sidebar (menuFixed) vào wp_footer - giống trang mẫu vinfasttanuyen.vn
add_action('wp_footer', function() {
    $img_base = get_template_directory_uri() . '/images';
    ?>
    <style>
    /* ===== FLOATING SIDEBAR - MENUFIXED ===== */
    /* Hover vào toàn bộ thanh => tất cả text trượt ra */
    #menuFixed:hover li .divText {
        transform: translateX(0%) !important;
        -webkit-transform: translateX(0%) !important;
    }
    .menuFixed {
        position: fixed;
        top: 40%;
        right: 0px;
        transform: translate(0%, -50%);
        z-index: 999999;
        cursor: pointer;
        pointer-events: none;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .menuFixed li {
        display: block;
        position: relative;
        transition: all 0.5s ease;
        color: #ffffff;
        width: 100%;
        height: 0px;
        right: 0;
        clear: both;
    }
    .menuFixed li a {
        color: #ffffff;
        text-decoration: none !important;
    }
    /* Phần text - ẩn mặc định, trượt ra khi hover */
    .menuFixed li .divText {
        display: block;
        position: relative;
        float: left;
        width: 100%;
        height: 50px;
        padding-right: 50px;
        z-index: 1;
        background-color: #4d4d4d;
        border-top: solid 1px #666666;
        transform: translateX(100%);
        -webkit-transform: translateX(100%);
        transition: all 0.5s ease;
        pointer-events: auto;
    }
    .menuFixed li:hover .divText {
        background-color: #c8102e;
    }
    .menuFixed li .divText span {
        color: #ffffff;
    }
    .menuFixed li .divText > span {
        display: block;
        font-size: 14px;
        line-height: 23px;
        padding: 13px 10px 0px 25px;
    }
    /* Phần icon - luôn hiển thị */
    .menuFixed li .divIcon {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        width: 49px;
        height: 50px;
        top: 0;
        right: 0;
        background-color: #4d4d4d;
        border-top: solid 1px #666666;
        transition: all 0.5s ease;
        background-repeat: no-repeat;
        background-position: 50% 50%;
        pointer-events: auto;
        font-size: 22px;
        line-height: 30px;
    }
    .menuFixed li .divIcon img {
        max-width: 24px;
        max-height: 24px;
        filter: brightness(0) invert(1);
    }
    .menuFixed li:hover .divIcon {
        background-color: #c8102e;
    }
    /* Nút "Lên top" */
    .menuFixed li .go_top .divIcon i {
        color: #fff;
        font-size: 22px;
    }
    @media (max-width: 849px) {
        .menuFixed {
            display: none;
        }
    }
    </style>

    <ul id="menuFixed" class="menuFixed">
        <li>
            <a title="Yêu cầu báo giá" href="<?php echo home_url('/yeu-cau-bao-gia/'); ?>">
                <span class="divText"><span>Yêu cầu báo giá</span></span>
                <span class="divIcon"><img src="<?php echo $img_base; ?>/baogia.png" alt="Yêu cầu báo giá"></span>
            </a>
        </li>
        <li>
            <a title="Đặt hẹn dịch vụ" href="<?php echo home_url('/dat-hen-dich-vu/'); ?>">
                <span class="divText"><span>Đặt hẹn dịch vụ</span></span>
                <span class="divIcon"><img src="<?php echo $img_base; ?>/i-1.png" alt="Đặt hẹn dịch vụ"></span>
            </a>
        </li>
        <li>
            <a title="Mua xe trả góp" href="<?php echo home_url('/mua-xe-tra-gop/'); ?>">
                <span class="divText"><span>Mua xe trả góp</span></span>
                <span class="divIcon"><img src="<?php echo $img_base; ?>/i-2.png" alt="Mua xe trả góp"></span>
            </a>
        </li>
        <li>
            <a title="Dự toán chi phí" href="<?php echo home_url('/du-toan-chi-phi/'); ?>">
                <span class="divText"><span>Dự toán chi phí</span></span>
                <span class="divIcon"><img src="<?php echo $img_base; ?>/i-3.png" alt="Dự toán chi phí"></span>
            </a>
        </li>
        <li>
            <a title="Đăng ký lái thử" href="<?php echo home_url('/dang-ky-lai-thu/'); ?>">
                <span class="divText"><span>Đăng ký lái thử</span></span>
                <span class="divIcon"><img src="<?php echo $img_base; ?>/i-4.png" alt="Đăng ký lái thử"></span>
            </a>
        </li>
        <li>
            <a title="Lên top" class="go_top" href="javascript:void(0)" onclick="jQuery('html,body').animate({scrollTop: 0},1000);">
                <span class="divText"><span>LÊN TOP</span></span>
                <span class="divIcon"><i class="fa fa-angle-up"></i></span>
            </a>
        </li>
    </ul>
    <?php
});

