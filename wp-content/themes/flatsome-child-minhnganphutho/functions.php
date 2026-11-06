<?php
/**
 * Flatsome Child - VinFast Minh Ngân Phú Thọ 3S
 * functions.php — Đăng ký CPT, ACF, Shortcodes, AJAX, Floating Sidebar
 */

defined('ABSPATH') || exit;

// =========================================================
// 🛡️ WOOCOMMERCE SAFE POLYFILLS (TRÁNH FATAL KHI WOO CHƯA BẬT)
// =========================================================
if (!function_exists('is_product')) {
    function is_product() { return false; }
}
if (!function_exists('is_cart')) {
    function is_cart() { return false; }
}
if (!function_exists('is_checkout')) {
    function is_checkout() { return false; }
}
if (!function_exists('is_account_page')) {
    function is_account_page() { return false; }
}
if (!function_exists('is_shop')) {
    function is_shop() { return false; }
}
if (!function_exists('is_product_category')) {
    function is_product_category() { return false; }
}

// =========================================================
// 📧 CẤU HÌNH EMAIL NHẬN CONTACT — VinFast Minh Ngân Phú Thọ 3S
// Thêm email vào mảng bên dưới để nhận đồng thời nhiều địa chỉ
// =========================================================
if (!defined('VFVP_CONTACT_EMAILS')) {
    define('VFVP_CONTACT_EMAILS', [
        'ngodinhdat15@gmail.com',     // Email quản lý chính
    ]);
}

// --- SMTP Gmail: cấu hình linh hoạt qua wp-config hoặc mặc định ---
if (!defined('VFVP_SMTP_HOST')) define('VFVP_SMTP_HOST', 'smtp.gmail.com');
if (!defined('VFVP_SMTP_PORT')) define('VFVP_SMTP_PORT', 587);
if (!defined('VFVP_SMTP_USERNAME')) define('VFVP_SMTP_USERNAME', 'ngodinhdat15@gmail.com');
if (!defined('VFVP_SMTP_PASSWORD')) define('VFVP_SMTP_PASSWORD', defined('SMTP_PASS') ? SMTP_PASS : '');
if (!defined('VFVP_SMTP_ENABLED'))  define('VFVP_SMTP_ENABLED', !empty(VFVP_SMTP_PASSWORD));

add_action('phpmailer_init', function($phpmailer) {
    if (!VFVP_SMTP_ENABLED || empty(VFVP_SMTP_PASSWORD)) return;
    $phpmailer->isSMTP();
    $phpmailer->Host       = VFVP_SMTP_HOST;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = VFVP_SMTP_PORT;
    $phpmailer->Username   = VFVP_SMTP_USERNAME;
    $phpmailer->Password   = VFVP_SMTP_PASSWORD;
    $phpmailer->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
    $phpmailer->From       = VFVP_SMTP_USERNAME;
    $phpmailer->FromName   = 'VinFast Minh Ngân Phú Thọ 3S';
    $phpmailer->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]];
});

// --- Đảm bảo wp_mail luôn gửi đến toàn bộ danh sách email (Tất cả đều là người nhận chính To:) ---
add_filter('wp_mail', function($args) {
    if (!empty($GLOBALS['vf_custom_mail_to'])) {
        $args['to'] = $GLOBALS['vf_custom_mail_to'];
        return $args;
    }
    $all_emails = VFVP_CONTACT_EMAILS;
    if (empty($all_emails)) return $args;

    // Đặt tất cả email đều là người nhận chính (To)
    $args['to'] = $all_emails;

    return $args;
});

// --- CF7: Ghi đè recipient của tất cả form sang danh sách email nhận chính (cách nhau bởi dấu phẩy) ---
add_filter('wpcf7_mail_components', function($components, $contact_form) {
    $all_emails = VFVP_CONTACT_EMAILS;
    if (empty($all_emails)) return $components;

    // Trong Contact Form 7, danh sách người nhận chính cách nhau bằng dấu phẩy
    $components['recipient'] = implode(', ', $all_emails);

    return $components;
}, 10, 2);

// Auto sync official logo if available in theme assets
$vfg_logo_src = get_stylesheet_directory() . '/assets/images/logo.png';
$vfg_logo_dst = WP_CONTENT_DIR . '/uploads/official_cars/common/logo-vinfast-phu-tho.jpg';
if (file_exists($vfg_logo_src) && (!file_exists($vfg_logo_dst) || filesize($vfg_logo_dst) === 0)) {
    @wp_mkdir_p(dirname($vfg_logo_dst));
    @copy($vfg_logo_src, $vfg_logo_dst);
}

// Auto flush rewrite rules once to fix 404 permalink issues
add_action('init', function() {
    if (!get_option('vfvp_rewrite_flushed_v2')) {
        flush_rewrite_rules();
        update_option('vfvp_rewrite_flushed_v2', true);
    }
});

// ============================================================
// 🚀 TỰ ĐỘNG XÓA TOÀN BỘ CACHE KHI CÓ CODE MỚI DEPLOY (AUTO PURGE CACHE)
// ============================================================
add_action('init', function() {
    $style_file = get_stylesheet_directory() . '/style.css';
    if (!file_exists($style_file)) return;
    
    $current_ver = (string) filemtime($style_file);
    $last_ver    = (string) get_option('vfvp_deployed_version', '');
    
    // Nếu phát hiện code mới được pull về (timestamp thay đổi)
    if ($current_ver !== $last_ver) {
        update_option('vfvp_deployed_version', $current_ver);
        
        // 1. Xóa WordPress Object Cache
        if (function_exists('wp_cache_flush')) {
            @wp_cache_flush();
        }
        
        // 2. Xóa LiteSpeed Cache (nếu dùng LiteSpeed trên aaPanel/server)
        if (has_action('litespeed_purge_all')) {
            do_action('litespeed_purge_all');
        }
        
        // 3. Xóa WP Rocket (nếu có)
        if (function_exists('rocket_clean_domain')) {
            @rocket_clean_domain();
        }
        
        // 4. Xóa WP Super Cache (nếu có)
        if (function_exists('wp_cache_clear_cache')) {
            @wp_cache_clear_cache();
        }
        
        // 5. Xóa W3 Total Cache (nếu có)
        if (function_exists('w3tc_flush_all')) {
            @w3tc_flush_all();
        }
        
        // 6. Reset PHP OPcache để nạp ngay các file PHP mới vào RAM
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }
    }
});

// Thêm watermark build version trong HTML <head> để kiểm tra tức thì
add_action('wp_head', function() {
    $ver = get_option('vfvp_deployed_version', '');
    if (!$ver) {
        $style_file = get_stylesheet_directory() . '/style.css';
        $ver = file_exists($style_file) ? filemtime($style_file) : time();
    }
    echo "\n<!-- [VINFAST THEME VERSION: " . esc_attr($ver) . " - DEPLOYED AT: " . esc_attr(date('Y-m-d H:i:s', (int)$ver)) . "] -->\n";
}, 1);

// 1. ENQUEUE STYLES & SCRIPTS
// ============================================================
add_action('wp_enqueue_scripts', 'vfvp_enqueue_assets');
function vfvp_enqueue_assets() {
    // Parent theme
    wp_enqueue_style('flatsome-parent', get_template_directory_uri() . '/style.css');
    // Child theme - Auto-cache-busting version based on file modification time
    $css_ver = filemtime(get_stylesheet_directory() . '/style.css');
    wp_enqueue_style('flatsome-child', get_stylesheet_directory_uri() . '/style.css', ['flatsome-parent'], $css_ver);
    
    // Inject custom inline CSS to forcefully bypass all browser caching for these specific elements
    $force_white_css = "
        .vf9-interior-overlay h3, .vf9-interior-overlay p,
        .vf9-privilege-banner h3, .vf9-privilege-banner p, .vf9-privilege-banner li {
            color: #ffffff !important;
        }
    ";
    wp_add_inline_style('flatsome-child', $force_white_css);
    // Google Fonts (Tối ưu tải nhanh, chỉ lấy trọng số cần thiết)
    wp_enqueue_style('vfvp-fonts', 'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap', [], null);

    // Enqueue Premium Homepage Showroom Assets (Concept A)
    if (is_front_page() || is_page_template('page-home.php')) {
        $hp_css_file = get_stylesheet_directory() . '/assets/css/homepage-premium.css';
        $hp_css_ver  = file_exists($hp_css_file) ? filemtime($hp_css_file) : '1.0';
        wp_enqueue_style('vf-homepage-premium', get_stylesheet_directory_uri() . '/assets/css/homepage-premium.css', ['flatsome-child'], $hp_css_ver);

        $hp_js_file  = get_stylesheet_directory() . '/assets/js/homepage-premium.js';
        $hp_js_ver   = file_exists($hp_js_file) ? filemtime($hp_js_file) : '1.0';
        wp_enqueue_script('vf-homepage-premium-js', get_stylesheet_directory_uri() . '/assets/js/homepage-premium.js', [], $hp_js_ver, true);
    }
    // Swiper.js
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true);
    // GLightbox
    wp_enqueue_style('glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', [], '3');
    wp_enqueue_script('glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', [], '3', true);
    // Child JS - Auto-cache-busting version
    $main_js_ver = filemtime(get_stylesheet_directory() . '/assets/js/main.js');
    $modal_js_ver = filemtime(get_stylesheet_directory() . '/assets/js/vfvp-modal.js');
    wp_enqueue_script('vfvp-main', get_stylesheet_directory_uri() . '/assets/js/main.js', ['jquery', 'swiper-js'], $main_js_ver, true);
    wp_enqueue_script('vfvp-modal', get_stylesheet_directory_uri() . '/assets/js/vfvp-modal.js', [], $modal_js_ver, true);

    // AJAX
    wp_localize_script('vfvp-main', 'vfvpAjax', [
        'url'   => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vfvp_nonce'),
    ]);
    wp_localize_script('vfvp-main', 'vfvp_vars', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('vfvp_ajax_nonce')
    ]);
}

// ============================================================
// 🎯 FORCE CACHE-BUSTING CHO FLATSOME STYLE & MAIN JS
// Đảm bảo mọi handle tải style.css đều tự đổi version sang timestamp file
// ============================================================
add_filter('style_loader_src', function($src, $handle) {
    if (strpos($src, 'style.css') !== false || $handle === 'flatsome-style' || $handle === 'flatsome-child') {
        $style_file = get_stylesheet_directory() . '/style.css';
        if (file_exists($style_file)) {
            $src = remove_query_arg('ver', $src);
            $src = add_query_arg('ver', filemtime($style_file), $src);
        }
    }
    return $src;
}, 9999, 2);

// ============================================================
// 🚫 TẮT TÍNH NĂNG STICKY CỦA FLATSOME TRÊN TRANG SẢN PHẨM / XE
// Tránh việc Flatsome tự gắn fixed/stuck đè lên subnav của xe
// ============================================================
add_filter('theme_mod_header_sticky', function($value) {
    if (is_singular('product') || is_singular('car_model')) {
        return 0;
    }
    return $value;
}, 9999);

add_filter('theme_mod_header_sticky_style', function($value) {
    if (is_singular('product') || is_singular('car_model')) {
        return '';
    }
    return $value;
}, 9999);

add_filter('script_loader_src', function($src, $handle) {
    if (strpos($src, 'assets/js/main.js') !== false || $handle === 'vfvp-main') {
        $js_file = get_stylesheet_directory() . '/assets/js/main.js';
        if (file_exists($js_file)) {
            $src = remove_query_arg('ver', $src);
            $src = add_query_arg('ver', filemtime($js_file), $src);
        }
    }
    return $src;
}, 9999, 2);

// ============================================================
// 1A2. ENSURE SERVICE BANNER ASSETS
// ============================================================
function vfvp_remove_white_bg_php($src, $dst) {
    if (!file_exists($src)) return;
    $info = @getimagesize($src);
    if (!$info) return;
    
    $mime = $info['mime'];
    if ($mime === 'image/png' && function_exists('imagecreatefrompng')) {
        $img = @imagecreatefrompng($src);
    } elseif ($mime === 'image/webp' && function_exists('imagecreatefromwebp')) {
        $img = @imagecreatefromwebp($src);
    } elseif (($mime === 'image/jpeg' || $mime === 'image/jpg') && function_exists('imagecreatefromjpeg')) {
        $img = @imagecreatefromjpeg($src);
    } else {
        return;
    }
    
    if (!$img) return;
    
    $w = imagesx($img);
    $h = imagesy($img);
    
    $transparent_img = imagecreatetruecolor($w, $h);
    imagealphablending($transparent_img, false);
    imagesavealpha($transparent_img, true);
    
    $transparent_color = imagecolorallocatealpha($transparent_img, 0, 0, 0, 127);
    imagefill($transparent_img, 0, 0, $transparent_color);
    
    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            
            // Remove white and off-white background pixels
            if ($r > 215 && $g > 215 && $b > 215) {
                imagesetpixel($transparent_img, $x, $y, $transparent_color);
            } else {
                imagesetpixel($transparent_img, $x, $y, $rgb);
            }
        }
    }
    
    imagepng($transparent_img, $dst);
    imagedestroy($img);
    imagedestroy($transparent_img);
}

function vfvp_clean_all_car_cutouts() {
    $upload_dir = wp_upload_dir();
    $cars_dir   = $upload_dir['basedir'] . '/official_cars';
    $flag_file  = $cars_dir . '/.cutouts_cleaned_v4';

    if (file_exists($flag_file)) return;

    if (!file_exists($cars_dir)) wp_mkdir_p($cars_dir);

    $files = glob($cars_dir . '/cutout_*.{png,jpg,webp,jpeg}', GLOB_BRACE);
    if (!empty($files)) {
        foreach ($files as $f) {
            vfvp_remove_white_bg_php($f, $f);
        }
    }
    file_put_contents($flag_file, date('Y-m-d H:i:s'));
}
add_action('init', 'vfvp_clean_all_car_cutouts', 3);

function vfvp_ensure_service_banner_assets() {
    $upload_dir = wp_upload_dir();
    $cars_dir   = $upload_dir['basedir'] . '/official_cars';
    if (!file_exists($cars_dir)) wp_mkdir_p($cars_dir);

    $tunnel_dst = $cars_dir . '/service_bg_tunnel.png';
    $vf9_dst    = $cars_dir . '/cutout_vf9_clean.png';

    if (!file_exists($tunnel_dst) || filesize($tunnel_dst) < 1000) {
        $brain_bg = get_stylesheet_directory() . '/assets/images/service_bg_tunnel.png';
        if (file_exists($brain_bg)) @copy($brain_bg, $tunnel_dst);
    }

    $tanuyen_vf9 = get_stylesheet_directory() . '/assets/images/vf9-1.png';
    if (file_exists($tanuyen_vf9)) {
        vfvp_remove_white_bg_php($tanuyen_vf9, $vf9_dst);
    }
}
add_action('init', 'vfvp_ensure_service_banner_assets', 4);
function vfvp_get_acc_image_url($key) {
    $upload_dir = wp_upload_dir();
    $acc_dir = $upload_dir['basedir'] . '/accessories';
    $acc_url = $upload_dir['baseurl'] . '/accessories';

    foreach (['png','jpg','webp','jpeg'] as $ext) {
        $f = $acc_dir . '/' . $key . '.' . $ext;
        if (file_exists($f)) {
            return $acc_url . '/' . $key . '.' . $ext . '?v=' . filemtime($f);
        }
    }

    // Fallback to car image
    return vfvp_get_car_image_url('vf3');
}

// ============================================================
// 1B2. CHARGING IMAGE HELPER
// ============================================================
function vfvp_get_charging_image_url($key) {
    $upload_dir = wp_upload_dir();
    $cars_dir   = $upload_dir['basedir'] . '/official_cars';
    $cars_url   = $upload_dir['baseurl'] . '/official_cars';

    // Check common folder first
    $common_file = $cars_dir . '/common/' . $key;
    if (file_exists($common_file) && filesize($common_file) > 1000) {
        return $cars_url . '/common/' . $key;
    }

    $dest_file = $cars_dir . '/' . $key;
    if (file_exists($dest_file) && filesize($dest_file) > 1000) {
        return $cars_url . '/' . $key;
    }

    return content_url('/uploads/official_cars/common/' . $key);
}

// ============================================================
// 1C. CAR IMAGE AUTO-SYNC HELPER (FROM LOCAL DOWNLOADS & VFTANUYEN)
// ============================================================
function vfvp_get_car_image_url($model_slug) {
    $upload_dir = wp_upload_dir();
    $cars_dir   = $upload_dir['basedir'] . '/official_cars';
    $cars_url   = wp_make_link_relative($upload_dir['baseurl'] . '/official_cars');

    if (!file_exists($cars_dir)) {
        wp_mkdir_p($cars_dir);
    }

    $raw = strtolower(trim((string)$model_slug));
    $norm = preg_replace('/[^a-z0-9]/', '', $raw);

    // Map common slug patterns to canonical vehicle key
    $slug_clean = '';
    if (strpos($norm, 'wild') !== false) {
        $slug_clean = 'vfwild';
    } elseif (strpos($norm, 'mpv7') !== false || strpos($norm, 'mpv') !== false) {
        $slug_clean = 'mpv7';
    } elseif (strpos($norm, 'ecvan') !== false || strpos($norm, 'xetaivan') !== false || (strpos($norm, 'ec') !== false && strpos($norm, 'van') !== false)) {
        $slug_clean = 'ecvan';
    } elseif (strpos($norm, 'allnew') !== false || strpos($norm, 'theallnew') !== false) {
        $slug_clean = 'vf8_allnew';
    } elseif (strpos($norm, 'minio') !== false || ($norm === 'vf3taxixanhsm')) {
        $slug_clean = 'minio';
    } elseif (strpos($norm, 'herio') !== false || ($norm === 'vf5taxixanhsm')) {
        $slug_clean = 'herio';
    } elseif (strpos($norm, 'nerio') !== false || ($norm === 'vfe34taxixanhsm')) {
        $slug_clean = 'nerio';
    } elseif (strpos($norm, 'limo') !== false || ($norm === 'vf7taxixanhsm')) {
        $slug_clean = 'limo';
    } elseif (preg_match('/vf([2-9])/', $norm, $m)) {
        $slug_clean = 'vf' . $m[1];
    }

    $official_cdn_map = [
        'vf2'        => ['url' => 'https://static-cms-prod.vinfastauto.com/vf2_home_page.png', 'file' => 'official_vf2.png'],
        'vf3'        => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/VF3.webp', 'file' => 'official_vf3.webp'],
        'vf5'        => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/VF5.webp', 'file' => 'official_vf5.webp'],
        'vf6'        => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/VF6.webp', 'file' => 'official_vf6.webp'],
        'vf7'        => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/VF7.webp', 'file' => 'official_vf7.webp'],
        'vf8'        => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/VF8.webp', 'file' => 'official_vf8.webp'],
        'vf8_allnew' => ['url' => 'https://static-cms-prod.vinfastauto.com/vf8-all-new.png', 'file' => 'official_vf8_allnew.png'],
        'vf9'        => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/VF9.webp', 'file' => 'official_vf9.webp'],
        'mpv7'       => ['url' => 'https://static-cms-prod.vinfastauto.com/pdp/vf_mpv_7/Homepage_MPV7.webp', 'file' => 'official_mpv7.webp'],
        'ecvan'      => ['url' => 'https://static-cms-prod.vinfastauto.com/ecvan-02.webp', 'file' => 'official_ecvan.webp'],
        'minio'      => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/MinioGreen.webp', 'file' => 'official_minio.webp'],
        'herio'      => ['url' => 'https://static-cms-prod.vinfastauto.com/he.png', 'file' => 'official_herio.png'],
        'nerio'      => ['url' => 'https://static-cms-prod.vinfastauto.com/statics/img/homepage-v2/car/NerioGreen.webp', 'file' => 'official_nerio.webp'],
        'limo'       => ['url' => 'https://static-cms-prod.vinfastauto.com/limo.png', 'file' => 'official_limo.png'],
        'vfwild'     => ['url' => '', 'file' => 'official_vfwild.webp'],
    ];

    $target_key = isset($official_cdn_map[$slug_clean]) ? $slug_clean : (isset($official_cdn_map[$model_slug]) ? $model_slug : '');

    if ($target_key) {
        $info = $official_cdn_map[$target_key];
        $url  = $info['url'];
        $file = $info['file'];

        return get_stylesheet_directory_uri() . '/assets/images/vinfast-cars/' . $file;
    }

    return get_stylesheet_directory_uri() . '/assets/images/vinfast-cars/official_vf3.webp';
}

// Register Custom Post Type for Accessories (Phụ kiện xe)
add_action('init', function() {
    register_post_type('phu_kien', [
        'labels' => [
            'name'               => 'Phụ kiện xe',
            'singular_name'      => 'Phụ kiện xe',
            'add_new'            => 'Thêm phụ kiện mới',
            'add_new_item'       => 'Thêm phụ kiện mới',
            'edit_item'          => 'Chỉnh sửa phụ kiện',
            'all_items'          => 'Tất cả phụ kiện',
            'menu_name'          => 'Phụ kiện xe'
        ],
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'show_in_rest'       => true,
        'menu_position'      => 6
    ]);
});

// ============================================================
// 1C. ACCESSORIES DATA HELPER (DYNAMICAL FROM WP ADMIN & LOCAL FALLBACK)
// ============================================================
function vfvp_get_accessories() {
    $db_items = [];

    // Query Custom Accessories added via WP Admin (Phụ kiện xe)
    $query = new WP_Query([
        'post_type'      => 'phu_kien',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC'
    ]);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id          = get_the_ID();
            $price       = get_post_meta($id, 'price', true) ?: 'Liên hệ báo giá';
            $category    = get_post_meta($id, 'category', true) ?: 'Ngoại thất & Tiện ích';
            $cat_slug    = get_post_meta($id, 'cat_slug', true) ?: 'ngoai-that';
            $car_model   = get_post_meta($id, 'car_model', true) ?: 'VF 3';
            $car_slug    = get_post_meta($id, 'car_slug', true) ?: 'vf3';
            $thumb_id    = get_post_thumbnail_id($id);
            $img_url     = $thumb_id ? wp_get_attachment_image_url($thumb_id, 'large') : vfvp_get_acc_image_url('acc_mo_hinh_vf3');

            $db_items[] = [
                'id'        => $id,
                'name'      => get_the_title(),
                'slug'      => get_post_field('post_name', $id),
                'price'     => $price,
                'category'  => $category,
                'cat_slug'  => $cat_slug,
                'car_model' => $car_model,
                'car_slug'  => $car_slug,
                'image'     => $img_url,
                'stock'     => 'Còn hàng',
                'desc'      => get_the_excerpt() ? get_the_excerpt() : 'Phụ kiện ô tô điện VinFast chính hãng.',
                'specs'     => [
                    'Dòng xe'  => $car_model,
                    'Bảo hành' => '12 tháng chính hãng',
                    'Xuất xứ'  => 'Chính hãng VinFast'
                ]
            ];
        }
        wp_reset_postdata();
    }

    $sample_items = [
        [
            'id' => 1,
            'name' => 'Mô Hình Xe VinFast VF 3',
            'slug' => 'mo-hinh-xe-vinfast-vf-3',
            'price' => '2.026.895 VNĐ',
            'price_num' => 2026895,
            'category' => 'Phong cách sống',
            'cat_slug' => 'mo-hinh',
            'car_model' => 'VF 3',
            'car_slug' => 'vf3',
            'image' => vfvp_get_acc_image_url('acc_mo_hinh_vf3'),
            'stock' => 'Còn hàng',
            'colors' => [
                ['name' => 'Vàng', 'code' => '#EAB308', 'img' => vfvp_get_acc_image_url('acc_mo_hinh_vf3')],
                ['name' => 'Hồng', 'code' => '#F472B6', 'img' => vfvp_get_car_image_url('vf3')],
                ['name' => 'Xanh', 'code' => '#4D7C0F', 'img' => vfvp_get_acc_image_url('acc_gia_noc_vf3')],
            ],
            'desc' => 'VinFast VF 3 là mẫu xe hiếm hoi trong phân khúc xe sở hữu la-zăng kích thước 16 inch, không chỉ tạo điểm nhấn về thiết kế mà còn góp phần gia tăng khả năng di chuyển trên địa hình đa dạng trong đô thị. Mô hình đúc tĩnh tỉ lệ 1:18 mô phỏng sắc nét chuẩn phom xe.',
            'specs' => [
                'Tỷ lệ' => '1:18 đúc tĩnh',
                'Chất liệu' => 'Hợp kim cao cấp + Nhựa ABS',
                'Kích thước' => '18 x 9.5 x 8.5 cm',
                'Màu sắc' => 'Vàng / Hồng / Xanh lá',
                'Xuất xứ' => 'Chính hãng VinFast',
                'Bảo hành' => '12 tháng chính hãng'
            ]
        ],
        [
            'id' => 2,
            'name' => 'Mô Hình Xe VinFast VF 8',
            'slug' => 'mo-hinh-xe-vinfast-vf-8',
            'price' => '1.600.000 VNĐ',
            'price_num' => 1600000,
            'category' => 'Phong cách sống',
            'cat_slug' => 'mo-hinh',
            'car_model' => 'VF 8',
            'car_slug' => 'vf8',
            'image' => vfvp_get_acc_image_url('acc_gia_noc_vf8'),
            'stock' => 'Còn hàng',
            'desc' => 'Mô hình xe điện thông minh VinFast VF 8 hợp kim tỉ lệ 1:18 sơn tĩnh điện bóng bẩy, chi tiết khoang lái nội thất được tái hiện chi tiết và sống động.',
            'specs' => [
                'Tỷ lệ' => '1:18',
                'Chất liệu' => 'Hợp kim nguyên khối',
                'Xuất xứ' => 'Chính hãng VinFast',
                'Màu sắc' => 'Xanh VinFast / Trắng'
            ]
        ],
        [
            'id' => 3,
            'name' => 'Mô Hình Xe VinFast VF 9',
            'slug' => 'mo-hinh-xe-vinfast-vf-9',
            'price' => '1.700.000 VNĐ',
            'price_num' => 1700000,
            'category' => 'Phong cách sống',
            'cat_slug' => 'mo-hinh',
            'car_model' => 'VF 9',
            'car_slug' => 'vf9',
            'image' => vfvp_get_acc_image_url('acc_tam_che_pin_vf9'),
            'stock' => 'Còn hàng',
            'desc' => 'Mô hình SUV điện cờ đầu VinFast VF 9 đẳng cấp 7 chỗ, thiết kế tỉ lệ chuẩn 1:18 thích hợp trưng bày phòng khách và bàn làm việc.',
            'specs' => [
                'Tỷ lệ' => '1:18',
                'Chất liệu' => 'Hợp kim cường lực',
                'Xuất xứ' => 'Chính hãng VinFast'
            ]
        ],
        [
            'id' => 4,
            'name' => 'Lót Cốc Sơn Mài VinFast',
            'slug' => 'lot-coc-son-mai-vinfast',
            'price' => '250.000 VNĐ',
            'price_num' => 250000,
            'category' => 'Phong cách sống',
            'cat_slug' => 'mo-hinh',
            'car_model' => 'Tất cả dòng xe',
            'car_slug' => 'all',
            'image' => vfvp_get_acc_image_url('acc_tam_che_pin_vf5'),
            'stock' => 'Tạm hết hàng',
            'desc' => 'Bộ lót cốc làm bằng chất liệu sơn mài thủ công truyền thống khắc họa tiết dòng xe điện VinFast vô cùng độc đáo.',
            'specs' => [
                'Chất liệu' => 'Sơn mài cao cấp',
                'Quy cách' => 'Bộ 4 chiếc',
                'Xuất xứ' => 'Việt Nam'
            ]
        ],
        [
            'id' => 5,
            'name' => 'Bộ Sạc Treo Tường AC 11 kW',
            'slug' => 'bo-sac-treo-tuong-ac-11kw',
            'price' => '11.781.818 VNĐ',
            'price_num' => 11781818,
            'category' => 'Thiết bị sạc',
            'cat_slug' => 'thiet-bi-sac',
            'car_model' => 'VF 6, VF 7, VF 8, VF 9',
            'car_slug' => 'vf8',
            'image' => vfvp_get_acc_image_url('acc_tam_che_pin_vf8'),
            'stock' => 'Còn hàng',
            'desc' => 'Giải pháp sạc cố định tại nhà công suất 11 kW chính hãng VinFast. Hỗ trợ tự động quản lý dòng sạc an toàn, bảo vệ chống quá tải và rò điện.',
            'specs' => [
                'Công suất' => '11 kW (3 pha)',
                'Nguồn điện' => '380V AC',
                'Chuẩn kết nối' => 'Type 2 / CCS2',
                'Chống nước' => 'Chuẩn IP65'
            ]
        ],
        [
            'id' => 6,
            'name' => 'Bộ Sạc Di Động Portable AC 3.5 kW',
            'slug' => 'bo-sac-di-dong-portable-ac-35kw',
            'price' => '5.500.000 VNĐ',
            'price_num' => 5500000,
            'category' => 'Thiết bị sạc',
            'cat_slug' => 'thiet-bi-sac',
            'car_model' => 'Tất cả dòng xe ô tô điện',
            'car_slug' => 'all',
            'image' => vfvp_get_acc_image_url('acc_tam_che_pin_nerio'),
            'stock' => 'Còn hàng',
            'desc' => 'Bộ sạc di động thông minh 3.5 kW dễ dàng cắm ổ điện dân dụng 220V tại nhà hoặc chuyến đi xa, có màn hình hiển thị thông số dòng sạc.',
            'specs' => [
                'Công suất' => '3.5 kW',
                'Điện áp' => '220V / 16A',
                'Chiều dài dây' => '5 mét',
                'Bảo hành' => '12 tháng chính hãng'
            ]
        ],
        [
            'id' => 7,
            'name' => 'VF 7 Tấm Che Pin Cao Áp Gầm Xe',
            'slug' => 'vf-7-tam-che-pin-cao-ap',
            'price' => '6.881.000 VNĐ',
            'price_num' => 6881000,
            'category' => 'Phụ kiện ô tô điện',
            'cat_slug' => 'tam-che-pin',
            'car_model' => 'VF 7',
            'car_slug' => 'vf7',
            'image' => vfvp_get_acc_image_url('acc_tam_che_pin_vf7'),
            'stock' => 'Còn hàng',
            'desc' => 'Tấm hợp kim gia cường bảo vệ gầm và cụm pin cao áp cho VinFast VF 7, chống sỏi đá va đập và giảm lực tác động khi qua đường gồ gề.',
            'specs' => [
                'Chất liệu' => 'Hợp kim nhôm siêu nhẹ cường lực 4mm',
                'Tương thích' => 'VinFast VF 7',
                'Lắp đặt' => 'Zin theo lỗ ốc gầm xe, không khoan cắt'
            ]
        ],
        [
            'id' => 8,
            'name' => 'VF 3 Tấm Che Pin Cao Áp Gầm Xe',
            'slug' => 'vf-3-tam-che-pin-cao-ap',
            'price' => '4.200.000 VNĐ',
            'price_num' => 4200000,
            'category' => 'Phụ kiện ô tô điện',
            'cat_slug' => 'tam-che-pin',
            'car_model' => 'VF 3',
            'car_slug' => 'vf3',
            'image' => vfvp_get_acc_image_url('acc_tam_che_pin_vf5'),
            'stock' => 'Còn hàng',
            'desc' => 'Tấm che pin gầm xe dành riêng cho VF 3 giúp bảo vệ toàn bộ khoang pin lithium khỏi đất đá văng và rủi ro cạ gầm.',
            'specs' => [
                'Chất liệu' => 'Hợp kim nhôm 3.5mm',
                'Tương thích' => 'VinFast VF 3',
                'Sản xuất' => 'Chính hãng VinFast'
            ]
        ],
        [
            'id' => 9,
            'name' => 'Thảm Lót Sàn TPE Cao Cấp Ô TÔ Điện',
            'slug' => 'tham-lot-san-tpe-cao-cap',
            'price' => '1.250.000 VNĐ',
            'price_num' => 1250000,
            'category' => 'Phụ kiện ô tô điện',
            'cat_slug' => 'noi-that',
            'car_model' => 'VF 3, VF 5, VF 6, VF 7, VF 8, VF 9',
            'car_slug' => 'all',
            'image' => vfvp_get_acc_image_url('acc_tham_cop_vf6'),
            'stock' => 'Còn hàng',
            'desc' => 'Bộ thảm lót sàn đúc nguyên khối bằng chất liệu TPE nguyên sinh an toàn sức khỏe, không mùi, chống ngấm nước và vệ sinh nhanh chóng.',
            'specs' => [
                'Chất liệu' => 'Nhựa TPE nguyên sinh',
                'Đặc tính' => 'Không mùi, chống nước, viền vách cao',
                'Thiết kế' => 'Scan 3D chuẩn sàn xe từng mẫu VF'
            ]
        ],
        [
            'id' => 10,
            'name' => 'Giá Nóc Thể Thao Hợp Kim VF 3',
            'slug' => 'gia-noc-the-thao-hop-kim-vf-3',
            'price' => '2.350.000 VNĐ',
            'price_num' => 2350000,
            'category' => 'Phụ kiện ô tô điện',
            'cat_slug' => 'ngoai-that',
            'car_model' => 'VF 3',
            'car_slug' => 'vf3',
            'image' => vfvp_get_acc_image_url('acc_gia_noc_vf3'),
            'stock' => 'Còn hàng',
            'desc' => 'Bộ ba-đờ-xốc nóc & giá chở đồ thể thao hợp kim nhôm định hình cao cấp sơn tĩnh điện cho VF 3, tăng tính việt dã và mở rộng không gian chở hành lý.',
            'specs' => [
                'Chất liệu' => 'Hợp kim nhôm hàng không',
                'Tải trọng' => 'Tối đa 75kg',
                'Màu sắc' => 'Đen nhám việt dã'
            ]
        ],
        [
            'id' => 11,
            'name' => 'Phim Cách Nhiệt Cao Cấp VinFast VF 3',
            'slug' => 'phim-cach-nhiet-cao-cap-vf3',
            'price' => '3.800.000 VNĐ',
            'price_num' => 3800000,
            'category' => 'Phụ kiện ô tô điện',
            'cat_slug' => 'ngoai-that',
            'car_model' => 'VF 3',
            'car_slug' => 'vf3',
            'image' => vfvp_get_acc_image_url('acc_film_cach_nhiet_vf3'),
            'stock' => 'Còn hàng',
            'desc' => 'Gói dán phim cách nhiệt nano ceramic cản 99% tia UV và 85% tia hồng ngoại, giúp khoang xe luôn mát mẻ và tiết kiệm điện cho hệ thống điều hòa.',
            'specs' => [
                'Công nghệ' => 'Nano Ceramic đa tầng',
                'Cản tia UV' => '99.9%',
                'Bảo hành' => '10 năm chính hãng'
            ]
        ],
        [
            'id' => 12,
            'name' => 'Ô Golf 2 Tầng Chống Lật VinFast',
            'slug' => 'o-golf-2-tang-chong-lat-vinfast',
            'price' => '404.000 VNĐ',
            'price_num' => 404000,
            'category' => 'Phong cách sống',
            'cat_slug' => 'mo-hinh',
            'car_model' => 'Tất cả dòng xe',
            'car_slug' => 'all',
            'image' => vfvp_get_acc_image_url('acc_film_cach_nhiet_vf7'),
            'stock' => 'Còn hàng',
            'desc' => 'Dù/Ô golf 2 tầng khung carbon dẻo dai chống lật khi có gió to, thương hiệu VinFast in logo sắc nét.',
            'specs' => [
                'Đường kính' => '135 cm',
                'Khung ô' => 'Sợi carbon dẻo chịu lực',
                'Vải ô' => '210T Pongee tráng bạc chống UV'
            ]
        ]
    ];

    return array_merge($db_items, $sample_items);
}

// ============================================================
// 1A. AUTO-SYNC: COPY GALLERY IMAGES TO WP UPLOADS ON FIRST LOAD
// ============================================================
function vfvp_sync_gallery_images() {
    $gallery_base = get_stylesheet_directory() . '/assets/gallery';
    if (!file_exists($gallery_base)) return;
    $upload_dir   = wp_upload_dir();
    $dest_acc     = $upload_dir['basedir'] . '/accessories';
    $dest_cars    = $upload_dir['basedir'] . '/official_cars';

    // Create dirs
    if (!file_exists($dest_acc))  wp_mkdir_p($dest_acc);
    if (!file_exists($dest_cars)) wp_mkdir_p($dest_cars);

    $done_flag = $dest_cars . '/.gallery_synced';
    if (file_exists($done_flag)) return; // Already synced

    // Map: [folder_in_gallery] => [dest_key, dest_dir]
    $acc_folders = [
        'Mô_Hình_Xe_VinFast_VF_3'                    => 'acc_mo_hinh_vf3',
        'VF_7_Tấm_Che_Pin_Cao_Áp'                    => 'acc_tam_che_pin_vf7',
        'VF_6_Tấm_Che_Pin_Cao_Áp'                    => 'acc_tam_che_pin_vf6',
        'VF_5_Tấm_Che_Pin_Cao_Áp'                    => 'acc_tam_che_pin_vf5',
        'VF_8_Tấm_Che_Pin_Cao_Áp'                    => 'acc_tam_che_pin_vf8',
        'VF_9_Tấm_Che_Pin_Cao_Áp'                    => 'acc_tam_che_pin_vf9',
        'Tấm_Che_Pin_Cao_Áp_VinFast_Nerio_Green'     => 'acc_tam_che_pin_nerio',
        'Thảm_Cốp_3D_VF_6'                           => 'acc_tham_cop_vf6',
        'Gói_Dán_Film_Cách_Nhiệt_VinFast_VF_3'       => 'acc_film_cach_nhiet_vf3',
        'Gói_Film_Cách_Nhiệt_Dán_Trần_VinFast_VF_7'  => 'acc_film_cach_nhiet_vf7',
        'Bộ_Thanh_Ngang_Giá_Nóc_VF_3'                => 'acc_gia_noc_vf3',
        'Thanh_Ngang_Giá_Nóc_VinFast_VF_8'           => 'acc_gia_noc_vf8',
    ];

    foreach ($acc_folders as $folder_name => $key) {
        $folder_path = $gallery_base . '/phu_kien/' . $folder_name;
        if (!is_dir($folder_path)) continue;
        $files = glob($folder_path . '/*.{png,jpg,webp,jpeg}', GLOB_BRACE);
        if (!empty($files)) {
            sort($files);
            $ext  = pathinfo($files[0], PATHINFO_EXTENSION);
            $dst  = $dest_acc . '/' . $key . '.' . $ext;
            @copy($files[0], $dst);
        }
    }

    $car_folders = [
        'VF_2'            => 'gallery_vf2',
        'VF_3'            => 'gallery_vf3',
        'VF_5'            => 'gallery_vf5',
        'VF_6'            => 'gallery_vf6',
        'VF_7'            => 'gallery_vf7',
        'VF_8'            => 'gallery_vf8',
        'VF_8_The_All_New'=> 'gallery_vf8_allnew',
        'VF_9'            => 'gallery_vf9',
        'VF_MPV_7'        => 'gallery_mpv7',
        'EC_Van'          => 'gallery_ecvan',
        'Minio_Green'     => 'gallery_minio',
        'Herio_Green'     => 'gallery_herio',
        'Nerio_Green'     => 'gallery_nerio',
        'Limo_Green'      => 'gallery_limo',
    ];

    foreach ($car_folders as $folder_name => $key) {
        $folder_path = $gallery_base . '/o_to/' . $folder_name;
        if (!is_dir($folder_path)) continue;
        $files = glob($folder_path . '/*.{png,jpg,webp,jpeg}', GLOB_BRACE);
        if (!empty($files)) {
            sort($files);
            $ext  = pathinfo($files[0], PATHINFO_EXTENSION);
            $dst  = $dest_cars . '/' . $key . '.' . $ext;
            @copy($files[0], $dst);
        }
    }

    // Mark as done
    file_put_contents($done_flag, date('Y-m-d H:i:s'));
}
add_action('init', 'vfvp_sync_gallery_images', 5);

// ============================================================
// 1D. CAMPAIGN BANNER HELPER
// ============================================================
function vfvp_get_banner_mlttvn_url() {
    $upload_dir = wp_upload_dir();
    $dest_file = $upload_dir['basedir'] . '/official_cars/banner_mlttvn.jpg';
    $dest_url  = $upload_dir['baseurl'] . '/official_cars/banner_mlttvn.jpg';

    if (file_exists($dest_file)) {
        return $dest_url;
    }

    $srcs = [
        get_stylesheet_directory() . '/assets/images/banner.jpg',
        get_template_directory() . '/assets/images/banner.jpg',
    ];

    foreach ($srcs as $src) {
        if (file_exists($src)) {
            @copy($src, $dest_file);
            return $dest_url;
        }
    }

    return 'https://static-cms-prod.vinfastauto.com/banner-mlttvn.jpg';
}

// ============================================================
// 2. CUSTOM POST TYPE — car_model
// ============================================================
add_action('init', 'vfvp_register_cpt');
function vfvp_register_cpt() {
    // CPT: Mẫu xe
    register_post_type('car_model', [
        'label'               => 'Mẫu xe',
        'labels'              => [
            'name'               => 'Mẫu xe',
            'singular_name'      => 'Mẫu xe',
            'add_new'            => 'Thêm xe mới',
            'add_new_item'       => 'Thêm mẫu xe',
            'edit_item'          => 'Chỉnh sửa xe',
            'new_item'           => 'Xe mới',
            'view_item'          => 'Xem xe',
            'search_items'       => 'Tìm xe',
            'not_found'          => 'Không tìm thấy xe',
            'menu_name'          => 'Mẫu xe',
        ],
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => ['slug' => 'xe', 'with_front' => false],
        'capability_type'     => 'post',
        'has_archive'         => 'dong-xe',
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-car',
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'        => true,
    ]);

    // Taxonomy: Phân loại xe (chỉ 2 loại: Xe cá nhân, Xe dịch vụ)
    register_taxonomy('car_category', 'car_model', [
        'label'             => 'Phân loại xe',
        'labels'            => [
            'name'          => 'Phân loại xe',
            'singular_name' => 'Phân loại',
            'search_items'  => 'Tìm loại xe',
            'all_items'     => 'Tất cả',
            'edit_item'     => 'Chỉnh sửa',
            'add_new_item'  => 'Thêm phân loại',
        ],
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'rewrite'           => ['slug' => 'phan-loai-xe'],
        'show_in_rest'      => true,
    ]);
}

// Tự động tạo 2 term mặc định
add_action('init', 'vfvp_create_default_terms', 20);
function vfvp_create_default_terms() {
    if (!term_exists('Xe cá nhân', 'car_category')) {
        wp_insert_term('Xe cá nhân', 'car_category', ['slug' => 'xe-ca-nhan']);
    }
    if (!term_exists('Xe dịch vụ', 'car_category')) {
        wp_insert_term('Xe dịch vụ', 'car_category', ['slug' => 'xe-dich-vu']);
    }
    if (!term_exists('Bàn giao xe', 'category')) {
        wp_insert_term('Bàn giao xe', 'category', ['slug' => 'ban-giao-xe']);
    }
}

// Flush rewrite rules khi activate
add_action('after_switch_theme', 'vfvp_flush_rewrite');
function vfvp_flush_rewrite() {
    vfvp_register_cpt();
    flush_rewrite_rules();
}

// ============================================================
// 3. ACF FIELDS — Đăng ký nếu ACF active
// ============================================================
add_action('acf/init', 'vfvp_register_acf_fields');
function vfvp_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'      => 'group_car_model',
        'title'    => 'Thông tin xe VinFast',
        'fields'   => [
            // ---- THÔNG TIN CƠ BẢN ----
            [
                'key'   => 'field_car_tagline',
                'label' => 'Slogan / Tagline',
                'name'  => 'car_tagline',
                'type'  => 'text',
                'instructions' => 'Ví dụ: Sẵn sàng cho mọi hành trình',
            ],
            [
                'key'     => 'field_car_segment',
                'label'   => 'Phân khúc',
                'name'    => 'car_segment',
                'type'    => 'select',
                'choices' => [
                    'VF3'         => 'VF 3 (A-segment)',
                    'VF5'         => 'VF 5 (B-segment)',
                    'VF6'         => 'VF 6 (B-segment+)',
                    'VF7'         => 'VF 7 (C-segment)',
                    'VF8'         => 'VF 8 (D-segment)',
                    'VF9'         => 'VF 9 (E-segment)',
                    'MPV7'        => 'VF MPV 7 (MPV)',
                    'Minio'       => 'Minio Green (Dịch vụ mini)',
                    'Herio'       => 'Herio Green (Dịch vụ taxi)',
                    'Nerio'       => 'Nerio Green (Dịch vụ MPV)',
                    'Limo'        => 'Limo Green (Limousine)',
                    'ECVan'       => 'EC Van (Xe tải nhỏ)',
                ],
            ],
            [
                'key'   => 'field_car_hero_image',
                'label' => 'Ảnh Hero (Fullscreen banner)',
                'name'  => 'car_hero_image',
                'type'  => 'image',
                'return_format' => 'url',
                'instructions' => 'Ảnh fullscreen, tỷ lệ 16:9, tối thiểu 1920x1080px',
            ],

            // ---- PHIÊN BẢN & GIÁ ----
            [
                'key'   => 'field_car_versions',
                'label' => 'Phiên bản & Giá',
                'name'  => 'car_versions',
                'type'  => 'repeater',
                'instructions' => 'Thêm từng phiên bản (Eco, Plus, Plus2...)',
                'min'   => 1,
                'max'   => 5,
                'layout'    => 'table',
                'button_label' => 'Thêm phiên bản',
                'sub_fields' => [
                    [
                        'key'   => 'field_version_name',
                        'label' => 'Tên phiên bản',
                        'name'  => 'version_name',
                        'type'  => 'text',
                        'placeholder' => 'Eco',
                        'wrapper' => ['width' => '20'],
                    ],
                    [
                        'key'   => 'field_version_price',
                        'label' => 'Giá (VNĐ)',
                        'name'  => 'version_price',
                        'type'  => 'number',
                        'placeholder' => '853100000',
                        'wrapper' => ['width' => '20'],
                    ],
                    [
                        'key'   => 'field_version_price_old',
                        'label' => 'Giá gốc (gạch ngang)',
                        'name'  => 'version_price_old',
                        'type'  => 'number',
                        'wrapper' => ['width' => '20'],
                    ],
                    [
                        'key'   => 'field_version_image',
                        'label' => 'Ảnh xe phiên bản',
                        'name'  => 'version_image',
                        'type'  => 'image',
                        'return_format' => 'url',
                        'wrapper' => ['width' => '20'],
                    ],
                    [
                        'key'   => 'field_version_note',
                        'label' => 'Ghi chú',
                        'name'  => 'version_note',
                        'type'  => 'text',
                        'wrapper' => ['width' => '20'],
                    ],
                ],
            ],

            // ---- THÔNG SỐ KỸ THUẬT ----
            [
                'key'   => 'field_car_seats',
                'label' => 'Số chỗ ngồi',
                'name'  => 'car_seats',
                'type'  => 'number',
                'default_value' => 5,
            ],
            [
                'key'   => 'field_car_battery',
                'label' => 'Dung lượng pin (kWh)',
                'name'  => 'car_battery',
                'type'  => 'text',
                'placeholder' => '59.6',
            ],
            [
                'key'   => 'field_car_range',
                'label' => 'Tầm hoạt động (km)',
                'name'  => 'car_range',
                'type'  => 'text',
                'placeholder' => '562 km (NEDC)',
            ],
            [
                'key'   => 'field_car_power',
                'label' => 'Công suất cực đại',
                'name'  => 'car_power',
                'type'  => 'text',
                'placeholder' => '402 hp / 300 kW',
            ],
            [
                'key'   => 'field_car_torque',
                'label' => 'Mô-men xoắn cực đại',
                'name'  => 'car_torque',
                'type'  => 'text',
                'placeholder' => '620 Nm',
            ],
            [
                'key'   => 'field_car_acceleration',
                'label' => 'Tăng tốc 0-100km/h',
                'name'  => 'car_acceleration',
                'type'  => 'text',
                'placeholder' => '5.58 giây',
            ],
            [
                'key'   => 'field_car_drive',
                'label' => 'Dẫn động',
                'name'  => 'car_drive',
                'type'  => 'select',
                'choices' => [
                    'FWD' => 'Cầu trước (FWD)',
                    'RWD' => 'Cầu sau (RWD)',
                    'AWD' => 'Toàn thời gian (AWD)',
                ],
            ],
            [
                'key'   => 'field_car_dimensions',
                'label' => 'Kích thước (DxRxC mm)',
                'name'  => 'car_dimensions',
                'type'  => 'text',
                'placeholder' => '4750 x 1900 x 1660',
            ],
            [
                'key'   => 'field_car_wheelbase',
                'label' => 'Chiều dài cơ sở (mm)',
                'name'  => 'car_wheelbase',
                'type'  => 'text',
            ],
            [
                'key'   => 'field_car_charge_time',
                'label' => 'Thời gian sạc nhanh (10-70%)',
                'name'  => 'car_charge_time',
                'type'  => 'text',
                'placeholder' => '~31 phút (DC)',
            ],

            // ---- MÀU SẮC ----
            [
                'key'    => 'field_car_colors',
                'label'  => 'Màu sắc',
                'name'   => 'car_colors',
                'type'   => 'repeater',
                'layout' => 'table',
                'button_label' => 'Thêm màu',
                'sub_fields' => [
                    [
                        'key'   => 'field_color_name',
                        'label' => 'Tên màu',
                        'name'  => 'color_name',
                        'type'  => 'text',
                        'placeholder' => 'Solar Ruby',
                        'wrapper' => ['width' => '30'],
                    ],
                    [
                        'key'   => 'field_color_hex',
                        'label' => 'Mã màu HEX',
                        'name'  => 'color_hex',
                        'type'  => 'color_picker',
                        'wrapper' => ['width' => '20'],
                    ],
                    [
                        'key'   => 'field_color_image',
                        'label' => 'Ảnh xe màu này',
                        'name'  => 'color_image',
                        'type'  => 'image',
                        'return_format' => 'url',
                        'wrapper' => ['width' => '50'],
                    ],
                ],
            ],

            // ---- GALLERY ----
            [
                'key'   => 'field_car_gallery_exterior',
                'label' => 'Gallery Ngoại thất',
                'name'  => 'car_gallery_exterior',
                'type'  => 'gallery',
                'return_format' => 'url',
                'min'   => 0,
                'max'   => 12,
            ],
            [
                'key'   => 'field_car_gallery_interior',
                'label' => 'Gallery Nội thất',
                'name'  => 'car_gallery_interior',
                'type'  => 'gallery',
                'return_format' => 'url',
                'min'   => 0,
                'max'   => 12,
            ],

            // ---- NỘI DUNG MÔ TẢ ----
            [
                'key'   => 'field_car_design_title',
                'label' => 'Tiêu đề section Thiết kế',
                'name'  => 'car_design_title',
                'type'  => 'text',
                'placeholder' => 'Thiết kế cá nhân hoá',
            ],
            [
                'key'   => 'field_car_design_desc',
                'label' => 'Mô tả Thiết kế',
                'name'  => 'car_design_desc',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'   => 'field_car_interior_title',
                'label' => 'Tiêu đề section Nội thất',
                'name'  => 'car_interior_title',
                'type'  => 'text',
                'placeholder' => 'Thăng hạng đẳng cấp',
            ],
            [
                'key'   => 'field_car_interior_desc',
                'label' => 'Mô tả Nội thất',
                'name'  => 'car_interior_desc',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'   => 'field_car_interior_image',
                'label' => 'Ảnh Nội thất (fullwidth)',
                'name'  => 'car_interior_image',
                'type'  => 'image',
                'return_format' => 'url',
            ],
            [
                'key'   => 'field_car_performance_title',
                'label' => 'Tiêu đề section Vận hành',
                'name'  => 'car_performance_title',
                'type'  => 'text',
                'placeholder' => 'Sẵn sàng cho mọi hành trình',
            ],
            [
                'key'   => 'field_car_performance_desc',
                'label' => 'Mô tả Vận hành',
                'name'  => 'car_performance_desc',
                'type'  => 'textarea',
                'rows'  => 3,
            ],
            [
                'key'   => 'field_car_performance_image',
                'label' => 'Ảnh Vận hành',
                'name'  => 'car_performance_image',
                'type'  => 'image',
                'return_format' => 'url',
            ],

            // ---- SAFETY FEATURES ----
            [
                'key'    => 'field_car_safety_features',
                'label'  => 'Tính năng An toàn',
                'name'   => 'car_safety_features',
                'type'   => 'repeater',
                'layout' => 'block',
                'button_label' => 'Thêm tính năng',
                'sub_fields' => [
                    [
                        'key'   => 'field_sf_title',
                        'label' => 'Tiêu đề',
                        'name'  => 'sf_title',
                        'type'  => 'text',
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'key'   => 'field_sf_desc',
                        'label' => 'Mô tả',
                        'name'  => 'sf_desc',
                        'type'  => 'text',
                        'wrapper' => ['width' => '50'],
                    ],
                    [
                        'key'   => 'field_sf_image',
                        'label' => 'Ảnh',
                        'name'  => 'sf_image',
                        'type'  => 'image',
                        'return_format' => 'url',
                    ],
                ],
            ],

            // ---- TECHNOLOGY TABS ----
            [
                'key'    => 'field_car_tech_image',
                'label'  => 'Ảnh Công nghệ (fullwidth)',
                'name'   => 'car_tech_image',
                'type'   => 'image',
                'return_format' => 'url',
            ],
            [
                'key'    => 'field_car_tech_tabs',
                'label'  => 'Tab Công nghệ',
                'name'   => 'car_tech_tabs',
                'type'   => 'repeater',
                'layout' => 'block',
                'button_label' => 'Thêm tab',
                'sub_fields' => [
                    [
                        'key'   => 'field_tt_title',
                        'label' => 'Tên tab',
                        'name'  => 'tt_title',
                        'type'  => 'text',
                        'wrapper' => ['width' => '30'],
                    ],
                    [
                        'key'   => 'field_tt_content',
                        'label' => 'Nội dung',
                        'name'  => 'tt_content',
                        'type'  => 'textarea',
                        'rows'  => 2,
                        'wrapper' => ['width' => '70'],
                    ],
                ],
            ],

            // ---- CTA ----
            [
                'key'   => 'field_car_deposit_url',
                'label' => 'Link trang Đặt cọc (WooCommerce)',
                'name'  => 'car_deposit_url',
                'type'  => 'url',
            ],
            [
                'key'   => 'field_car_cf7_test_drive',
                'label' => 'CF7 Shortcode "Đăng ký lái thử"',
                'name'  => 'car_cf7_test_drive',
                'type'  => 'text',
                'placeholder' => '[contact-form-7 id="xxx" title="Lái thử"]',
                'instructions' => 'Paste shortcode của form lái thử CF7',
            ],
        ],
        'location' => [[
            ['param' => 'post_type', 'operator' => '==', 'value' => 'car_model'],
        ]],
        'menu_order' => 0,
        'position'   => 'normal',
        'style'      => 'default',
    ]);
}

// ============================================================
// 4. MEGA MENU HTML (hook vào header)
// ============================================================
add_action('wp_footer', 'vfvp_mega_menu_html');
function vfvp_mega_menu_html() {
    // Lấy danh sách xe từ CPT car_model
    $xe_ca_nhan = get_posts([
        'post_type'      => 'car_model',
        'posts_per_page' => -1,
        'tax_query'      => [[
            'taxonomy' => 'car_category',
            'field'    => 'slug',
            'terms'    => 'xe-ca-nhan',
        ]],
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
    ]);

    $xe_dich_vu = get_posts([
        'post_type'      => 'car_model',
        'posts_per_page' => -1,
        'tax_query'      => [[
            'taxonomy' => 'car_category',
            'field'    => 'slug',
            'terms'    => 'xe-dich-vu',
        ]],
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
    ]);
    ?>
    <!-- Mega Menu Data (dùng bởi JS nếu cần) -->
    <script>
    window.vfMegaMenuData = {
        xeCaNhan: <?php echo json_encode(array_map(function($p) {
            $price = get_field('car_versions', $p->ID);
            $firstPrice = !empty($price) ? number_format($price[0]['version_price']/1000000, 0) . ' triệu' : 'Liên hệ';
            return [
                'name'  => $p->post_title,
                'url'   => get_permalink($p->ID),
                'price' => $firstPrice,
                'img'   => get_the_post_thumbnail_url($p->ID, 'thumbnail') ?: '',
            ];
        }, $xe_ca_nhan)); ?>,
        xeDichVu: <?php echo json_encode(array_map(function($p) {
            $price = get_field('car_versions', $p->ID);
            $firstPrice = !empty($price) ? number_format($price[0]['version_price']/1000000, 0) . ' triệu' : 'Liên hệ';
            return [
                'name'  => $p->post_title,
                'url'   => get_permalink($p->ID),
                'price' => $firstPrice,
                'img'   => get_the_post_thumbnail_url($p->ID, 'thumbnail') ?: '',
            ];
        }, $xe_dich_vu)); ?>
    };
    </script>
    <?php
}

// ============================================================
// 5. AJAX — Lấy dữ liệu xe để so sánh
// ============================================================
add_action('wp_ajax_vfvp_get_car_data', 'vfvp_ajax_get_car_data');
add_action('wp_ajax_nopriv_vfvp_get_car_data', 'vfvp_ajax_get_car_data');
function vfvp_ajax_get_car_data() {
    check_ajax_referer('vfvp_nonce', 'nonce');

    $id = intval($_POST['car_id'] ?? 0);
    $ptype = get_post_type($id);
    if (!$id || !in_array($ptype, ['car_model', 'product'])) {
        wp_send_json_error('Invalid car');
    }

    $post = get_post($id);

    // Lấy giá thấp nhất từ repeater versions hoặc regular price
    $versions = get_field('car_versions', $id) ?: [];
    $min_price = 0;
    foreach ($versions as $v) {
        $p = floatval($v['version_price'] ?? 0);
        if ($p > 0 && ($min_price === 0 || $p < $min_price)) $min_price = $p;
    }
    if ($min_price === 0) {
        $min_price = floatval(get_post_meta($id, '_price', true) ?: 0);
    }

    $car_img = get_the_post_thumbnail_url($id, 'large');
    $car_img = $car_img ? wp_make_link_relative($car_img) : vfvp_get_car_image_url($post->post_name);

    wp_send_json_success([
        'id'           => $id,
        'name'         => $post->post_title,
        'image'        => $car_img,
        'price'        => $min_price,
        'seats'        => get_field('car_seats', $id) ?: '–',
        'battery'      => get_field('car_battery', $id) ?: '–',
        'range'        => get_field('car_range', $id) ?: '–',
        'power'        => get_field('car_power', $id) ?: '–',
        'torque'       => get_field('car_torque', $id) ?: '–',
        'acceleration' => get_field('car_acceleration', $id) ?: '–',
        'drive'        => get_field('car_drive', $id) ?: '–',
        'dimensions'   => get_field('car_dimensions', $id) ?: '–',
        'charge_time'  => get_field('car_charge_time', $id) ?: '–',
    ]);
}

// AJAX — Lấy danh sách xe cho dropdown so sánh
add_action('wp_ajax_vfvp_get_cars_list', 'vfvp_ajax_get_cars_list');
add_action('wp_ajax_nopriv_vfvp_get_cars_list', 'vfvp_ajax_get_cars_list');
function vfvp_ajax_get_cars_list() {
    $cars = get_posts([
        'post_type'      => ['product', 'car_model'],
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ]);

    $result = [];
    foreach ($cars as $car) {
        $terms = wp_get_post_terms($car->ID, 'product_cat');
        if (empty($terms)) {
            $terms = wp_get_post_terms($car->ID, 'car_category');
        }
        $cat = !empty($terms) ? $terms[0]->name : 'Ô tô điện VinFast';
        $result[] = [
            'id'       => $car->ID,
            'name'     => $car->post_title,
            'category' => $cat,
        ];
    }

    wp_send_json_success($result);
}

// ============================================================
// 6. SHORTCODE — DỰ TOÁN CHI PHÍ LĂN BÁNH
// ============================================================
add_shortcode('du_toan_chi_phi', 'vfvp_shortcode_du_toan');
function vfvp_shortcode_du_toan() {
    // Lấy danh sách xe từ CPT
    $cars = get_posts([
        'post_type'      => 'car_model',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    $cars_data = [];
    foreach ($cars as $car) {
        $versions  = get_field('car_versions', $car->ID) ?: [];
        $min_price = 0;
        foreach ($versions as $v) {
            $p = floatval($v['version_price'] ?? 0);
            if ($p > 0 && ($min_price === 0 || $p < $min_price)) $min_price = $p;
        }
        if ($min_price <= 0) continue;
        $img = get_the_post_thumbnail_url($car->ID, 'medium');
        if (!$img) {
            $img = vfvp_get_car_image_url($car->post_name);
        }
        $cars_data[] = [
            'id'    => $car->ID,
            'name'  => $car->post_title,
            'price' => $min_price,
            'image' => $img,
        ];
    }

    ob_start();
    ?>
    <div class="vf-tool-page">
      <div class="vf-tool-container">
        <h1 class="vf-tool-title">Dự toán chi phí lăn bánh</h1>
        <p class="vf-tool-subtitle">Tính toán tổng chi phí sở hữu xe điện VinFast tại Vĩnh Phúc</p>

        <div class="vf-tool-grid">
          <!-- Cột trái: Form + ảnh xe -->
          <div>
            <!-- Ảnh xe -->
            <div style="text-align:center; background:var(--vf-bg-gray); border-radius:12px; padding:24px; margin-bottom:24px;">
              <img id="dt_car_img" src="<?php echo esc_url(content_url('/uploads/official_cars/common/official_vf3.webp')); ?>"
                   alt="VinFast" style="max-height:180px; object-fit:contain; width:100%;">
              <p id="dt_car_name" style="font-weight:700; margin-top:12px; color:var(--vf-text);">Vui lòng chọn xe</p>
            </div>

            <div class="vf-form-group">
              <label>Chọn dòng ô tô điện</label>
              <select id="dt_vehicle">
                <option value="">-- Chọn xe --</option>
                <?php foreach ($cars_data as $c): ?>
                <option value="<?php echo $c['id']; ?>"
                        data-price="<?php echo $c['price']; ?>"
                        data-img="<?php echo esc_attr($c['image']); ?>">
                  <?php echo esc_html($c['name']); ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="vf-form-group">
              <label>Tỉnh / thành đăng ký xe</label>
              <select id="dt_region">
                <option value="HN">Hà Nội</option>
                <option value="HCM">TP. Hồ Chí Minh</option>
                <option value="VP" selected>Vĩnh Phúc</option>
                <option value="OTHER">Tỉnh thành khác</option>
              </select>
            </div>

            <div style="background:var(--vf-bg-gray); border-radius:10px; padding:16px; margin-bottom:20px;">
              <p style="font-size:13px; color:var(--vf-blue); font-weight:700; margin-bottom:10px;">ƯU ĐÃI ĐẶC BIỆT:</p>
              <label style="display:flex; align-items:center; gap:10px; font-size:14px; cursor:pointer; margin-bottom:8px;">
                <input type="checkbox" id="dt_chk_cabd" value="0.05"> Khách hàng Công An / Bộ Đội (5%)
              </label>
              <label style="display:flex; align-items:center; gap:10px; font-size:14px; cursor:pointer;">
                <input type="checkbox" id="dt_chk_txsd" value="0.03"> Thu Xăng Sang Điện (3%)
              </label>
            </div>

            <button class="vf-btn-calc" id="dt_btn_calc">TÍNH CHI PHÍ LĂN BÁNH →</button>
          </div>

          <!-- Cột phải: Bảng kết quả nhanh -->
          <div>
            <div class="vf-result-panel">
              <div class="vf-result-panel-header">📊 THÔNG TIN TỔNG QUAN</div>
              <div class="vf-result-row"><span>Dòng xe:</span><span id="dt_p_name">–</span></div>
              <div class="vf-result-row"><span>Giá niêm yết:</span><span id="dt_p_price">0 ₫</span></div>
              <div class="vf-result-row"><span>Nơi đăng ký:</span><span id="dt_p_region">Vĩnh Phúc</span></div>
              <div class="vf-result-row"><span>Phí trước bạ:</span><span>0 ₫ (Miễn phí xe điện)</span></div>
              <div class="vf-result-row"><span>Tổng ưu đãi:</span><span id="dt_p_discount" style="color:#86efac;">0 ₫</span></div>
              <div class="vf-result-total" id="dt_p_total">0 ₫</div>
            </div>
          </div>
        </div>

        <!-- Bảng chi tiết -->
        <div class="vf-result-table-wrap" id="dt_detail">
          <h2 style="font-size:1.3rem; font-weight:800; text-align:center; margin-bottom:24px; text-transform:uppercase;">
            Chi tiết chi phí lăn bánh
          </h2>
          <div style="overflow-x:auto;">
            <table class="vf-result-table">
              <tbody id="dt_tbody"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
    (function() {
      const fmt = n => new Intl.NumberFormat('vi-VN',{style:'currency',currency:'VND'}).format(n);

      const vSelect  = document.getElementById('dt_vehicle');
      const rSelect  = document.getElementById('dt_region');
      const carImg   = document.getElementById('dt_car_img');
      const carName  = document.getElementById('dt_car_name');
      const pName    = document.getElementById('dt_p_name');
      const pPrice   = document.getElementById('dt_p_price');
      const pRegion  = document.getElementById('dt_p_region');
      const pDisc    = document.getElementById('dt_p_discount');
      const pTotal   = document.getElementById('dt_p_total');

      vSelect.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        if (!opt.value) return;
        carImg.src  = opt.dataset.img || carImg.src;
        carName.textContent = opt.text;
        pName.textContent   = opt.text;
        pPrice.textContent  = fmt(opt.dataset.price);
      });

      rSelect.addEventListener('change', function() {
        pRegion.textContent = this.options[this.selectedIndex].text;
      });

      document.getElementById('dt_btn_calc').addEventListener('click', function() {
        const opt = vSelect.options[vSelect.selectedIndex];
        if (!opt.value) { alert('Vui lòng chọn xe!'); return; }

        const giaXe    = parseFloat(opt.dataset.price);
        const region   = rSelect.value;
        const regionTx = rSelect.options[rSelect.selectedIndex].text;

        // Ưu đãi
        let discPct = 0, discRows = [];
        // Mãnh Liệt Vì Tương Lai Xanh
        const mlvtlx = (opt.text.includes('VF 8') || opt.text.includes('VF 9')) ? 0.09 : 0.06;
        discPct += mlvtlx;
        discRows.push([`Ưu đãi Mãnh Liệt Vì Tương Lai Xanh (${mlvtlx*100}%)`, -giaXe * mlvtlx]);

        if (document.getElementById('dt_chk_cabd').checked) {
          discPct += 0.05; discRows.push(['Ưu đãi Công An, Bộ Đội (5%)', -giaXe * 0.05]);
        }
        if (document.getElementById('dt_chk_txsd').checked) {
          discPct += 0.03; discRows.push(['Ưu đãi Thu Xăng Sang Điện (3%)', -giaXe * 0.03]);
        }

        const totalDisc = giaXe * discPct;

        // Phí lăn bánh
        const phiTruocBa  = 0; // Xe điện: miễn 100%
        const phiBienSo   = (region === 'HN' || region === 'HCM') ? 20000000 : 1000000;
        const phiKiemDinh = 340000;
        const phiDuongBo  = 1560000;
        const phiTNDS     = 480000;
        const phiVatChat  = giaXe * 0.015;
        const tongPhi     = phiTruocBa + phiBienSo + phiKiemDinh + phiDuongBo + phiTNDS + phiVatChat;
        const tongCong    = giaXe - totalDisc + tongPhi;

        pDisc.textContent  = `-${fmt(totalDisc)}`;
        pTotal.textContent = fmt(tongCong);
        pName.textContent  = opt.text;
        pPrice.textContent = fmt(giaXe);
        pRegion.textContent = regionTx;

        const rows = [
          ['Giá xe niêm yết', fmt(giaXe), ''],
          ...discRows.map(r => [r[0], fmt(r[1]), 'discount-row']),
          ['TỔNG ƯU ĐÃI', `-${fmt(totalDisc)}`, 'discount-row'],
          [`Lệ phí trước bạ tại ${regionTx}`, `${fmt(phiTruocBa)} (Miễn 100% - Xe điện)`, ''],
          ['Lệ phí đăng ký biển số', fmt(phiBienSo), ''],
          ['Lệ phí kiểm định', fmt(phiKiemDinh), ''],
          ['Lệ phí đường bộ/năm', fmt(phiDuongBo), ''],
          ['Bảo hiểm TNDS bắt buộc/năm', fmt(phiTNDS), ''],
          ['Bảo hiểm vật chất (1.5%)', fmt(phiVatChat), ''],
          ['Tổng phí lăn bánh', fmt(tongPhi), ''],
          ['TỔNG CHI PHÍ LĂN BÁNH', fmt(tongCong), 'total-row'],
        ];

        document.getElementById('dt_tbody').innerHTML = rows.map(r =>
          `<tr class="${r[2]}"><td>${r[0]}</td><td style="text-align:right">${r[1]}</td></tr>`
        ).join('');

        const wrap = document.getElementById('dt_detail');
        wrap.classList.add('show');
        wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    })();
    </script>
    <?php
    return ob_get_clean();
}

// ============================================================
// 7. SHORTCODE — DỰ TOÁN VAY TRẢ GÓP
// ============================================================
add_shortcode('du_toan_tra_gop', 'vfvp_shortcode_tra_gop');
function vfvp_shortcode_tra_gop() {
    $cars = get_posts([
        'post_type'      => 'car_model',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);

    $cars_data = [];
    foreach ($cars as $car) {
        $versions  = get_field('car_versions', $car->ID) ?: [];
        $min_price = 0;
        foreach ($versions as $v) {
            $p = floatval($v['version_price'] ?? 0);
            if ($p > 0 && ($min_price === 0 || $p < $min_price)) $min_price = $p;
        }
        if ($min_price <= 0) continue;
        $img = get_the_post_thumbnail_url($car->ID, 'medium');
        if (!$img) {
            $img = vfvp_get_car_image_url($car->post_name);
        }
        $cars_data[] = [
            'id'    => $car->ID,
            'name'  => $car->post_title,
            'price' => $min_price,
            'image' => $img,
        ];
    }

    ob_start();
    ?>
    <div class="vf-tool-page">
      <div class="vf-tool-container">
        <h1 class="vf-tool-title">Dự toán vay trả góp</h1>
        <p class="vf-tool-subtitle">Tính toán khoản trả góp hàng tháng theo phương pháp dư nợ giảm dần</p>

        <div class="vf-tool-grid">
          <!-- Form -->
          <div>
            <div class="vf-form-group">
              <label>Chọn dòng ô tô điện</label>
              <select id="tg_vehicle">
                <option value="">-- Chọn xe --</option>
                <?php foreach ($cars_data as $c): ?>
                <option value="<?php echo $c['id']; ?>"
                        data-price="<?php echo $c['price']; ?>"
                        data-img="<?php echo esc_attr($c['image']); ?>">
                  <?php echo esc_html($c['name']); ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="vf-form-group">
              <label>Giá xe (VNĐ)</label>
              <input type="text" id="tg_price" readonly placeholder="Chọn xe để tự động điền">
            </div>

            <div class="vf-form-group">
              <label>Số tiền trả trước (VNĐ)</label>
              <input type="text" id="tg_prepay" placeholder="Nhập số tiền trả trước">
              <small id="tg_prepay_hint" style="color:var(--vf-text-muted); font-size:12px; margin-top:4px; display:block;"></small>
            </div>

            <div class="vf-form-group">
              <label>Thời hạn vay</label>
              <select id="tg_term">
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

            <div class="vf-form-group">
              <label>Lãi suất năm đầu (%/năm)</label>
              <input type="number" id="tg_rate1" value="7.0" step="0.1" min="0" max="30">
            </div>

            <div class="vf-form-group">
              <label>Lãi suất các năm tiếp theo (%/năm)</label>
              <input type="number" id="tg_rate2" value="9.5" step="0.1" min="0" max="30">
            </div>

            <button class="vf-btn-calc" id="tg_btn_calc">TÍNH SỐ TIỀN TRẢ GÓP →</button>
          </div>

          <!-- Ảnh xe -->
          <div style="position:sticky; top:120px; text-align:center;">
            <div style="background:var(--vf-bg-gray); border-radius:12px; padding:32px;">
              <img id="tg_car_img" src="<?php echo esc_url(content_url('/uploads/official_cars/common/official_vf3.webp')); ?>"
                   style="max-height:200px; object-fit:contain; width:100%; transition:all 0.4s;" alt="VinFast">
              <p id="tg_car_display_price" style="font-size:1.4rem; font-weight:800; color:var(--vf-blue); margin-top:16px;">0 ₫</p>
            </div>

            <!-- Summary cards -->
            <div id="tg_summary" style="display:none; margin-top:24px; display:none;">
              <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-top:24px;">
                <div style="background:#fff; border:1px solid var(--vf-border); border-radius:8px; padding:16px; text-align:center;">
                  <span style="font-size:11px; text-transform:uppercase; color:var(--vf-text-muted);">Số tiền vay</span>
                  <strong id="tg_sum_loan" style="display:block; font-size:1rem; color:var(--vf-text); margin-top:4px;">0</strong>
                </div>
                <div style="background:#fff; border:1px solid var(--vf-border); border-radius:8px; padding:16px; text-align:center;">
                  <span style="font-size:11px; text-transform:uppercase; color:var(--vf-text-muted);">Gốc hàng tháng</span>
                  <strong id="tg_sum_principal" style="display:block; font-size:1rem; color:var(--vf-text); margin-top:4px;">0</strong>
                </div>
                <div style="background:var(--vf-blue); border-radius:8px; padding:16px; text-align:center; grid-column:1/-1;">
                  <span style="font-size:11px; text-transform:uppercase; color:rgba(255,255,255,0.7);">Tổng lãi phải trả</span>
                  <strong id="tg_sum_interest" style="display:block; font-size:1.1rem; color:#fff; margin-top:4px;">0</strong>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Bảng kết quả -->
        <div class="vf-result-table-wrap" id="tg_results">
          <h2 style="font-size:1.3rem; font-weight:800; text-align:center; margin-bottom:24px; text-transform:uppercase;">
            Bảng dự toán trả góp hàng tháng
          </h2>
          <div style="overflow-x:auto; border-radius:8px; border:1px solid var(--vf-border);">
            <table class="vf-result-table" id="tg_table">
              <thead>
                <tr>
                  <th>Kỳ trả</th>
                  <th>Dư nợ đầu kỳ</th>
                  <th>Gốc hàng tháng</th>
                  <th>Lãi hàng tháng</th>
                  <th><strong>Gốc + Lãi</strong></th>
                </tr>
              </thead>
              <tbody id="tg_tbody"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
    (function() {
      const fmt = n => new Intl.NumberFormat('vi-VN',{style:'currency',currency:'VND'}).format(n);
      const fmtNum = n => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

      const vSel   = document.getElementById('tg_vehicle');
      const priceI = document.getElementById('tg_price');
      const prepay = document.getElementById('tg_prepay');
      const hint   = document.getElementById('tg_prepay_hint');
      const carImg = document.getElementById('tg_car_img');
      const dispPr = document.getElementById('tg_car_display_price');

      // Format tiền khi gõ
      prepay.addEventListener('input', function() {
        let v = this.value.replace(/\./g, '');
        if (isNaN(v) || v === '') { this.value = ''; return; }
        this.value = fmtNum(v);
      });

      vSel.addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        if (!opt.value) return;
        const price = parseFloat(opt.dataset.price);
        priceI.value = fmtNum(price);
        dispPr.textContent = fmt(price);
        if (opt.dataset.img) carImg.src = opt.dataset.img;
        const minPre = Math.round(price * 0.2);
        prepay.value = fmtNum(minPre);
        hint.textContent = 'Trả trước tối thiểu 20%: ' + fmt(minPre);
      });

      document.getElementById('tg_btn_calc').addEventListener('click', function() {
        const giaXe   = parseFloat(priceI.value.replace(/\./g,''));
        const traTruc = parseFloat(prepay.value.replace(/\./g,''));
        const thoi    = parseInt(document.getElementById('tg_term').value);
        const ls1     = parseFloat(document.getElementById('tg_rate1').value)/100;
        const ls2     = parseFloat(document.getElementById('tg_rate2').value)/100;

        if (!giaXe) { alert('Vui lòng chọn dòng xe!'); return; }
        if (traTruc >= giaXe) { alert('Số tiền trả trước phải nhỏ hơn giá xe!'); return; }

        const soVay = giaXe - traTruc;
        const goc   = Math.round(soVay / thoi);
        let duNo    = soVay;
        let totalLai = 0;
        let html = '';

        for (let i = 1; i <= thoi; i++) {
          const ls   = (i <= 12 ? ls1 : ls2) / 12;
          const lai  = Math.round(duNo * ls);
          const tong = goc + lai;
          totalLai += lai;
          html += `<tr>
            <td>Tháng ${i}</td>
            <td>${fmt(duNo)}</td>
            <td>${fmt(goc)}</td>
            <td>${fmt(lai)}</td>
            <td><strong>${fmt(tong)}</strong></td>
          </tr>`;
          duNo = Math.max(0, duNo - goc);
        }

        document.getElementById('tg_tbody').innerHTML = html;
        document.getElementById('tg_sum_loan').textContent      = fmt(soVay);
        document.getElementById('tg_sum_principal').textContent = fmt(goc);
        document.getElementById('tg_sum_interest').textContent  = fmt(totalLai);

        const res = document.getElementById('tg_results');
        res.classList.add('show');
        document.getElementById('tg_summary').style.display = 'block';
        res.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    })();
    </script>
    <?php
    return ob_get_clean();
}

// ============================================================
// 8. SHORTCODE — SO SÁNH XE
// ============================================================
add_shortcode('so_sanh_xe', 'vfvp_shortcode_so_sanh');
function vfvp_shortcode_so_sanh() {
    // Lấy tất cả xe
    $cars = get_posts([
        'post_type'      => ['product', 'car_model'],
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    ]);

    ob_start();
    ?>
    <div class="vf-compare-page">
      <div class="container">
        <h1 class="vf-tool-title" style="margin-bottom:8px;">So sánh xe điện VinFast</h1>
        <p class="vf-tool-subtitle">Chọn 2 đến 3 mẫu xe để so sánh thông số kỹ thuật</p>

        <div class="vf-compare-selectors">
          <?php for ($i = 1; $i <= 3; $i++): ?>
          <div class="vf-compare-select-wrap">
            <label>Xe thứ <?php echo $i; ?></label>
            <select class="vf-compare-car-select" id="vf_compare_car_<?php echo $i; ?>" data-slot="<?php echo $i; ?>">
              <option value="">-- <?php echo $i === 1 ? 'Chọn xe (bắt buộc)' : 'Thêm xe so sánh (tuỳ chọn)'; ?> --</option>
              <?php
              foreach ($cars as $car) {
                  $img = get_the_post_thumbnail_url($car->ID, 'medium');
                  $img = $img ? wp_make_link_relative($img) : vfvp_get_car_image_url($car->post_name);
                  echo '<option value="' . $car->ID . '" data-img="' . esc_attr($img) . '">' . esc_html($car->post_title) . '</option>';
              }
              ?>
            </select>
            <div class="vf-compare-car-preview" id="vf_preview_<?php echo $i; ?>"></div>
          </div>
          <?php endfor; ?>
        </div>

        <div style="text-align:center; margin-bottom:32px;">
          <button class="vf-btn vf-btn-primary" id="vf_compare_btn" style="min-width:200px;">
            SO SÁNH NGAY →
          </button>
        </div>

        <div class="vf-compare-table-wrap" id="vf_compare_result">
          <table class="vf-compare-table" id="vf_compare_table">
            <thead><tr id="vf_compare_head_row"></tr></thead>
            <tbody id="vf_compare_body"></tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
    (function() {
      const fmt = n => n > 0 ? new Intl.NumberFormat('vi-VN',{style:'currency',currency:'VND'}).format(n) : '–';

      // Preview ảnh khi chọn xe
      document.querySelectorAll('.vf-compare-car-select').forEach(sel => {
        sel.addEventListener('change', function() {
          const slot = this.dataset.slot;
          const prev = document.getElementById('vf_preview_' + slot);
          const opt  = this.options[this.selectedIndex];
          if (!opt.value) { prev.innerHTML = ''; return; }
          const imgUrl = opt.dataset.img || '';
          prev.innerHTML = `
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:12px; margin-top:12px; text-align:center;">
              ${imgUrl ? `<img src="${imgUrl}" style="max-height:85px; width:auto; object-fit:contain; margin:0 auto 8px; display:block;" alt="${opt.text}" onerror="this.onerror=null; this.src='/wp-content/uploads/official_cars/common/official_vf3.webp';">` : ''}
              <p style="font-size:13px; font-weight:700; color:var(--vf-blue); margin:0;">${opt.text}</p>
            </div>
          `;
        });
      });

      document.getElementById('vf_compare_btn').addEventListener('click', async function() {
        const ids = [];
        document.querySelectorAll('.vf-compare-car-select').forEach(s => {
          if (s.value) ids.push(s.value);
        });

        if (ids.length < 2) { alert('Vui lòng chọn ít nhất 2 xe để so sánh!'); return; }

        this.textContent = 'Đang tải...';
        this.disabled = true;

        try {
          const results = await Promise.all(ids.map(id =>
            fetch(vfvpAjax.url, {
              method: 'POST',
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              body: `action=vfvp_get_car_data&nonce=${vfvpAjax.nonce}&car_id=${id}`
            }).then(r => r.json())
          ));

          const cars = results.filter(r => r.success).map(r => r.data);
          if (cars.length < 2) { alert('Không tải được dữ liệu xe!'); return; }

          // Build header
          let head = '<th style="width:25%;">Thông số</th>';
          cars.forEach(c => { head += `<th>${c.name}</th>`; });
          document.getElementById('vf_compare_head_row').innerHTML = head;

          // Build rows
          const rows = [
            ['Ảnh xe',                cars.map(c => c.image ? `<img src="${c.image}" style="max-height:100px; object-fit:contain;">` : '–')],
            ['Giá từ (VNĐ)',          cars.map(c => fmt(c.price))],
            ['Số chỗ ngồi',           cars.map(c => c.seats)],
            ['Dung lượng pin',         cars.map(c => c.battery)],
            ['Tầm hoạt động',          cars.map(c => c.range)],
            ['Công suất cực đại',      cars.map(c => c.power)],
            ['Mô-men xoắn',           cars.map(c => c.torque)],
            ['Tăng tốc 0-100 km/h',   cars.map(c => c.acceleration)],
            ['Dẫn động',              cars.map(c => c.drive)],
            ['Kích thước',            cars.map(c => c.dimensions)],
            ['Thời gian sạc nhanh',   cars.map(c => c.charge_time)],
          ];

          let bodyHtml = '';
          rows.forEach(r => {
            bodyHtml += `<tr><td>${r[0]}</td>${r[1].map(v => `<td>${v}</td>`).join('')}</tr>`;
          });
          document.getElementById('vf_compare_body').innerHTML = bodyHtml;

          document.getElementById('vf_compare_result').classList.add('show');
          document.getElementById('vf_compare_result').scrollIntoView({behavior:'smooth'});
        } catch(e) {
          alert('Đã có lỗi xảy ra. Vui lòng thử lại!');
          console.error(e);
        } finally {
          this.textContent = 'SO SÁNH NGAY →';
          this.disabled = false;
        }
      });
    })();
    </script>
    <?php
    return ob_get_clean();
}

// ============================================================
// 9. FLOATING SIDEBAR & GLOBAL MODAL
// ============================================================
add_action('wp_footer', 'vfvp_floating_sidebar', 100);
function vfvp_floating_sidebar() {
    ?>
    <!-- #vf-float-sidebar đã gỡ bỏ theo yêu cầu của Chủ dự án -->

    <!-- Global Modal Nhận Báo Giá / Đăng Ký Lái Thử -->
    <div class="vf-modal-overlay" id="vfQuoteModal" onclick="if(event.target===this)vfCloseModal()">
      <div class="vf-modal-card" onclick="event.stopPropagation()" role="dialog" aria-modal="true" aria-label="Nhận báo giá xe VinFast">
        
        <!-- HEADER WITH GRADIENT BANNER & CAR CUTOUT -->
        <div class="vf-modal-banner">
          <button type="button" class="vf-modal-close-btn" onclick="vfCloseModal()" aria-label="Đóng">×</button>
          
          <div class="vf-modal-banner-top">
            <?php 
              $current_promo_month = function_exists('wp_date') ? wp_date('n/Y') : date('n/Y');
            ?>
            <div class="vf-modal-brand" style="display:flex; align-items:center; gap:6px;">
              <span style="font-size:14px; font-weight:800; color:#fff; letter-spacing:0.04em;">VINFAST MINH NGÂN PHÚ THỌ</span>
            </div>
            <span class="vf-modal-badge" data-promo-badge>⚡ ƯU ĐÃI THÁNG <?php echo esc_html($current_promo_month); ?></span>
          </div>

          <div class="vf-modal-banner-body">
            <div class="vf-modal-banner-text">
              <h3 class="vf-modal-heading">NHẬN BÁO GIÁ LĂN BÁNH VINFAST</h3>
              <p class="vf-modal-subheading">Đăng ký thông tin - Nhận ngay bảng tính chi phí & ưu đãi sau 5 phút</p>
            </div>
            <div class="vf-modal-banner-car">
              <img src="<?php echo esc_url(content_url('/uploads/official_cars/common/official_vf8.webp')); ?>" alt="VinFast VF 8" class="vf-modal-car-img">
            </div>
          </div>
        </div>

        <!-- FORM BODY -->
        <div class="vf-modal-body">
          <?php echo vfvp_render_lead_form(); ?>
        </div>

      </div>
    </div>

    <?php
}

// Redirect /gioi-thieu/ to Homepage #gioi-thieu section
add_action('template_redirect', function() {
    $uri = isset($_SERVER['REQUEST_URI']) ? strtolower($_SERVER['REQUEST_URI']) : '';
    if (is_page('gioi-thieu') || strpos($uri, '/gioi-thieu') !== false) {
        wp_redirect(home_url('/#gioi-thieu'), 301);
        exit;
    }
});

// Auto-route Test Drive & Quote page templates
add_filter('template_include', function($template) {
    $uri = isset($_SERVER['REQUEST_URI']) ? strtolower($_SERVER['REQUEST_URI']) : '';

    if (is_page(['dang-ky-lai-thu', 'lai-thu', 'dang-ky-lai-thu-xe']) || strpos($uri, '/dang-ky-lai-thu') !== false || strpos($uri, '/lai-thu') !== false) {
        $lai_thu_tpl = get_stylesheet_directory() . '/page-lai-thu.php';
        if (file_exists($lai_thu_tpl)) return $lai_thu_tpl;
    }

    if (is_page(['chinh-sach-bao-mat', 'bao-mat']) || strpos($uri, '/chinh-sach-bao-mat') !== false) {
        $bm_tpl = get_stylesheet_directory() . '/page-chinh-sach-bao-mat.php';
        if (file_exists($bm_tpl)) return $bm_tpl;
    }

    // Báo giá lăn bánh / Yêu cầu báo giá
    if (is_page(['bao-gia-lan-banh', 'bao-gia', 'nhan-bao-gia', 'yeu-cau-bao-gia']) || strpos($uri, '/bao-gia-lan-banh') !== false || strpos($uri, '/bao-gia') !== false || strpos($uri, '/yeu-cau-bao-gia') !== false) {
        $bao_gia_tpl = get_stylesheet_directory() . '/page-bao-gia.php';
        if (file_exists($bao_gia_tpl)) return $bao_gia_tpl;
    }

    // Dự toán chi phí & Trả góp
    if (is_page(['du-toan-chi-phi', 'du-toan-tra-gop', 'du-toan']) || strpos($uri, '/du-toan') !== false) {
        $du_toan_tpl = get_stylesheet_directory() . '/page-du-toan.php';
        if (file_exists($du_toan_tpl)) return $du_toan_tpl;
    }

    // So sánh xe
    if (is_page(['so-sanh-xe', 'so-sanh']) || strpos($uri, '/so-sanh') !== false) {
        $so_sanh_tpl = get_stylesheet_directory() . '/page-so-sanh-xe.php';
        if (file_exists($so_sanh_tpl)) return $so_sanh_tpl;
    }

    return $template;
}, 99);

// ============================================================
// 10. SINGLE car_model & VinFast WooCommerce Product Template
// ============================================================
// Auto seed pages in WP database so /dang-ky-lai-thu/ and /bao-gia/ do NOT return 404
add_action('init', function() {
    $pages = [
        'dang-ky-lai-thu'   => 'Đăng Ký Lái Thử Xe VinFast',
        'chinh-sach-bao-mat'=> 'Chính Sách Bảo Mật VinFast Vĩnh Phúc',
        'bao-gia'           => 'Nhận Báo Giá Xe VinFast',
        'bao-gia-lan-banh'  => 'Báo Giá Lăn Bánh Xe VinFast',
        'du-toan-chi-phi'   => 'Dự Toán Chi Phí & Trả Góp',
        'so-sanh-xe'        => 'So Sánh Xe Điện VinFast'
    ];
    foreach ($pages as $slug => $title) {
        $p = get_page_by_path($slug);
        if (!$p) {
            wp_insert_post([
                'post_title'     => $title,
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed'
            ]);
        }
    }
});

add_filter('template_include', 'vfvp_car_product_template_include', 9999);
add_filter('single_template', 'vfvp_car_product_template_include', 9999);
add_filter('woocommerce_template_loader_single_product', 'vfvp_car_product_template_include', 9999);
function vfvp_car_product_template_include($template) {
    $uri = isset($_SERVER['REQUEST_URI']) ? strtolower($_SERVER['REQUEST_URI']) : '';

    if (strpos($uri, '/dang-ky-lai-thu') !== false || strpos($uri, '/lai-thu') !== false || is_page(['dang-ky-lai-thu', 'lai-thu'])) {
        $lt_tpl = get_stylesheet_directory() . '/page-lai-thu.php';
        if (file_exists($lt_tpl)) return $lt_tpl;
    }

    if (strpos($uri, '/chinh-sach-bao-mat') !== false || is_page(['chinh-sach-bao-mat', 'bao-mat'])) {
        $bm_tpl = get_stylesheet_directory() . '/page-chinh-sach-bao-mat.php';
        if (file_exists($bm_tpl)) return $bm_tpl;
    }

    // Báo giá lăn bánh / Yêu cầu báo giá
    if (strpos($uri, '/bao-gia-lan-banh') !== false || strpos($uri, '/bao-gia') !== false || strpos($uri, '/yeu-cau-bao-gia') !== false || is_page(['bao-gia-lan-banh', 'bao-gia', 'nhan-bao-gia', 'yeu-cau-bao-gia'])) {
        $bg_tpl = get_stylesheet_directory() . '/page-bao-gia.php';
        if (file_exists($bg_tpl)) return $bg_tpl;
    }

    // Dự toán chi phí & Trả góp
    if (strpos($uri, '/du-toan') !== false || is_page(['du-toan-chi-phi', 'du-toan-tra-gop', 'du-toan'])) {
        $dt_tpl = get_stylesheet_directory() . '/page-du-toan.php';
        if (file_exists($dt_tpl)) return $dt_tpl;
    }

    if (is_page()) {
        $post = get_post();
        if ($post) {
            $slug = strtolower($post->post_name);
            if (in_array($slug, ['so-sanh-xe', 'so-sanh', 'so-sanh-xe-dien'])) {
                $comp_tpl = get_stylesheet_directory() . '/page-so-sanh-xe.php';
                if (file_exists($comp_tpl)) return $comp_tpl;
            }
        }
    }

    if (is_singular('car_model') || is_singular('product')) {
        $post = get_post();
        if ($post) {
            $slug      = strtolower($post->post_name);
            $car_name  = strtolower($post->post_title);
            $theme_dir = get_stylesheet_directory() . '/template-parts/product/';

            if (($slug === 'vinfast-vf-9' || strpos($slug, 'vf9') !== false || strpos($slug, 'vf-9') !== false || strpos($car_name, 'vf 9') !== false || strpos($car_name, 'vf9') !== false) && file_exists($theme_dir . 'single-vf9.php')) {
                return $theme_dir . 'single-vf9.php';
            }

            $vf_template = get_stylesheet_directory() . '/single-product-vinfast.php';
            if (file_exists($vf_template)) {
                return $vf_template;
            }
        }
    }
    return $template;
}

// Helper to get VinFast upload image URL safely
function vfvp_get_vf_img_url($img_folder, $filename) {
    if (empty($filename)) return '';
    if (preg_match('#^https?://#i', $filename)) return $filename;
    
    $upload  = wp_upload_dir();
    $baseurl = $upload['baseurl'];
    $basedir = $upload['basedir'];
    
    $filename_clean = ltrim($filename, '/');
    $folder_clean   = !empty($img_folder) ? trim($img_folder, '/') : '';
    $folder_clean   = str_replace(['vinfast-vinfast-', 'vinfast-vf-2', 'vinfast-vf-3', 'vinfast-vf-5'], ['vinfast-', 'vinfast-vf2', 'vinfast-vf3', 'vinfast-vf5'], $folder_clean);

    // 1. Check in $folder_clean (e.g. vinfast-vf2)
    if ($folder_clean) {
        $path1 = $basedir . '/' . $folder_clean . '/' . $filename_clean;
        if (file_exists($path1) && filesize($path1) > 100) {
            return $baseurl . '/' . $folder_clean . '/' . $filename_clean;
        }
    }
    
    // 2. Check in official_cars
    $path2 = $basedir . '/official_cars/' . $filename_clean;
    if (file_exists($path2) && filesize($path2) > 100) {
        return $baseurl . '/official_cars/' . $filename_clean;
    }

    // 3. Check in vinfast-vf2
    $path3 = $basedir . '/vinfast-vf2/' . $filename_clean;
    if (file_exists($path3) && filesize($path3) > 100) {
        return $baseurl . '/vinfast-vf2/' . $filename_clean;
    }

    // 4. Check in uploads root
    $path4 = $basedir . '/' . $filename_clean;
    if (file_exists($path4) && filesize($path4) > 100) {
        return $baseurl . '/' . $filename_clean;
    }

    // 5. Check theme assets
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();
    if ($folder_clean) {
        $slug = str_replace('vinfast-', '', $folder_clean);
        $path5 = $theme_dir . '/assets/images/vinfast-cars/' . $slug . '/' . $filename_clean;
        if (file_exists($path5)) {
            return $theme_uri . '/assets/images/vinfast-cars/' . $slug . '/' . $filename_clean;
        }
    }

    return $baseurl . '/' . ($folder_clean ? $folder_clean . '/' : '') . $filename_clean;
}

// ============================================================
// 11. HELPER — Format giá VNĐ & URL sản phẩm xe
// ============================================================
function vfvp_format_price($price) {
    if (!$price) return 'Liên hệ';
    return number_format($price, 0, ',', '.') . ' VNĐ';
}

function vfvp_get_car_product_url($slug) {
    $slug_clean = strtolower(str_replace(['_allnew', '_', ' '], ['-all-new', '-', '-'], $slug));
    if (strpos($slug_clean, 'vf') === 0 && !preg_match('/^vf-/', $slug_clean)) {
        $slug_clean = preg_replace('/^vf(\d+)/', 'vf-$1', $slug_clean);
    }
    
    if (in_array($slug_clean, ['ecvan', 'ec-van'])) $slug_clean = 'ec-van';
    if (in_array($slug_clean, ['mpv7', 'mpv-7', 'vf-mpv-7'])) $slug_clean = 'vf-mpv-7';
    if (in_array($slug_clean, ['minio', 'minio-green'])) $slug_clean = 'minio-green';
    if (in_array($slug_clean, ['herio', 'herio-green'])) $slug_clean = 'herio-green';
    if (in_array($slug_clean, ['nerio', 'nerio-green'])) $slug_clean = 'nerio-green';
    if (in_array($slug_clean, ['limo', 'limo-green'])) $slug_clean = 'limo-green';
    if (in_array($slug_clean, ['vfwild', 'vf-wild', 'wild'])) $slug_clean = 'vf-wild';

    $product_slug = (strpos($slug_clean, 'vinfast-') === false) ? 'vinfast-' . $slug_clean : $slug_clean;

    // Check WooCommerce product post by slug
    $args = [
        'name'        => $product_slug,
        'post_type'   => ['product', 'car_model'],
        'post_status' => 'publish',
        'numberposts' => 1
    ];
    $posts = get_posts($args);
    if (empty($posts)) {
        $args['name'] = $slug_clean;
        $posts = get_posts($args);
    }

    if (!empty($posts)) {
        return get_permalink($posts[0]->ID);
    }

    // Dynamic relative domain fallback
    return home_url('/product/' . $product_slug . '/');
}

// Auto-seed and publish all VinFast car product posts so no link returns 404
add_action('init', 'vfvp_auto_seed_car_posts');
function vfvp_auto_seed_car_posts() {
    if (isset($_GET['run_seeder']) || !get_option('vfvp_seeder_ran_v2')) {
        update_option('vfvp_seeder_ran_v2', 1);
        $seeder = ABSPATH . 'create-all-vinfast.php';
        if (file_exists($seeder)) {
            require_once($seeder);
        }
    }
}

// (Removed) Sync script that caused 120s page hangs has been completely eliminated.

// Filter the_content cho trang Dự toán chi phí lăn bánh
add_filter('the_content', function($content) {
    if (is_page(['du-toan-chi-phi', 'du-toan-tra-gop', 'du-toan']) || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'du-toan') !== false)) {
        ob_start();
        include get_stylesheet_directory() . '/page-du-toan.php';
        return ob_get_clean();
    }
    return $content;
}, 999);

// Shortcode: [du_toan_chi_phi] & [du_toan_tra_gop]
add_shortcode('du_toan_chi_phi', function() {
    ob_start();
    include get_stylesheet_directory() . '/page-du-toan.php';
    return ob_get_clean();
});

add_shortcode('du_toan_tra_gop', function() {
    ob_start();
    include get_stylesheet_directory() . '/page-du-toan.php';
    return ob_get_clean();
});

// Auto-route /phu-kien/ and /phu-kien-xe/ to page-phu-kien.php template
add_filter('template_include', function($template) {
    if (is_page(['phu-kien', 'phu-kien-xe']) || (isset($_SERVER['REQUEST_URI']) && (strpos($_SERVER['REQUEST_URI'], '/phu-kien') !== false))) {
        $acc_tpl = get_stylesheet_directory() . '/page-phu-kien.php';
        if (file_exists($acc_tpl)) {
            return $acc_tpl;
        }
    }
    return $template;
}, 99);

// Dynamic Lead Form Helper: Auto-detects Contact Form 7 or renders VinFast Form
function vfvp_render_lead_form($selected_car = '', $custom_cf7_shortcode = '') {
    // 1. If custom CF7 shortcode is passed, render it
    if (!empty($custom_cf7_shortcode) && shortcode_exists('contact-form-7')) {
        return do_shortcode($custom_cf7_shortcode);
    }

    // 2. Render Contact Form 7 form
    if (shortcode_exists('contact-form-7')) {
        $cf7_forms = get_posts([
            'post_type'      => 'wpcf7_contact_form',
            'posts_per_page' => -1,
            'post_status'    => 'publish'
        ]);

        if (empty($cf7_forms)) {
            // Programmatically auto-create Contact Form 7 form for VinFast Lead Quote
            $form_body = '<div class="vf-cf7-quote-wrapper">
<div class="vf-cf7-field"><label>Họ và tên *</label>[text* your-name placeholder "Nguyễn Văn A"]</div>
<div class="vf-cf7-field"><label>Số điện thoại *</label>[tel* your-tel placeholder "0900 000 000"]</div>
<div class="vf-cf7-field"><label>Dòng xe quan tâm *</label>[select car-model "VinFast VF 2" "VinFast VF 3" "VinFast VF 5 Plus" "VinFast VF 6" "VinFast VF 7" "VinFast VF 8" "VinFast VF 8 The All New" "VinFast VF 9" "VinFast VF Wild" "VinFast VF MPV 7" "Minio Green" "Herio Green" "Nerio Green" "Limo Green" "EC Van" "eBus"]</div>
<div class="vf-cf7-field"><label>Phương thức thanh toán</label>[select payment-method "Trả thẳng / Tiền mặt" "Vay ngân hàng trả góp"]</div>
<div class="full-width"><label>Ghi chú / Yêu cầu thêm</label>[textarea your-message placeholder "Báo giá lăn bánh, màu xe, địa điểm lái thử..."]</div>
<div class="full-width vf-cf7-submit-wrap">[submit class:vf-btn class:vf-btn-primary "» NHẬN BÁO GIÁ NGAY"]</div>
</div>';

            $new_cf7_id = wp_insert_post([
                'post_title'   => 'Nhận Báo Giá Xe VinFast Vĩnh Phúc',
                'post_content' => $form_body,
                'post_type'    => 'wpcf7_contact_form',
                'post_status'  => 'publish'
            ]);

            if ($new_cf7_id) {
                update_post_meta($new_cf7_id, '_form', $form_body);
                update_post_meta($new_cf7_id, '_mail', [
                    'subject'   => 'Yêu cầu báo giá xe VinFast từ [your-name]',
                    'sender'    => 'VinFast Vĩnh Phúc <wordpress@' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '>',
                    'body'      => "Họ và tên: [your-name]\nSố điện thoại: [your-tel]\nDòng xe quan tâm: [car-model]\nPhương thức thanh toán: [payment-method]\nGhi chú: [your-message]",
                    'recipient' => get_option('admin_email'),
                    'additional_headers' => 'Reply-To: [your-tel]'
                ]);
                return do_shortcode('[contact-form-7 id="' . $new_cf7_id . '" title="Nhận Báo Giá Xe VinFast Vĩnh Phúc"]');
            }
        } else {
            $target_form = $cf7_forms[0];
            foreach ($cf7_forms as $f) {
                if (mb_strpos(mb_strtolower($f->post_title), 'báo giá') !== false || mb_strpos(mb_strtolower($f->post_title), 'lái thử') !== false) {
                    $target_form = $f;
                    break;
                }
            }
            return do_shortcode('[contact-form-7 id="' . $target_form->ID . '" title="' . esc_attr($target_form->post_title) . '"]');
        }
    }

    // 3. Contact Form 7 Form Fields Layout
    $ev_cars = [
        'VinFast VF 2', 'VinFast VF 3', 'VinFast VF 5 Plus', 'VinFast VF 6', 
        'VinFast VF 7', 'VinFast VF 8', 'VinFast VF 8 The All New', 'VinFast VF 9', 
        'VinFast VF Wild', 'VinFast VF MPV 7', 'Minio Green', 'Herio Green', 'Nerio Green', 'Limo Green', 'EC Van', 'eBus'
    ];
    
    ob_start();
    ?>
    <div class="wpcf7">
      <form class="wpcf7-form init" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="vf_submit_lead_form">
        <?php wp_nonce_field('vf_lead_nonce'); ?>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px 14px;">
          <div>
            <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Họ và tên *</label>
            <span class="wpcf7-form-control-wrap"><input type="text" name="your-name" placeholder="Nguyễn Văn A" required class="wpcf7-form-control wpcf7-text" style="width:100%; height:38px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;"></span>
          </div>
          <div>
            <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Số điện thoại *</label>
            <span class="wpcf7-form-control-wrap"><input type="tel" name="your-tel" placeholder="0900 000 000" required pattern="[0-9]{10,11}" class="wpcf7-form-control wpcf7-tel" style="width:100%; height:38px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;"></span>
          </div>
          <div>
            <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Dòng xe quan tâm *</label>
            <span class="wpcf7-form-control-wrap">
              <select name="car-model" class="wpcf7-form-control wpcf7-select" style="width:100%; height:38px; padding:6px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;">
                <?php foreach ($ev_cars as $car): ?>
                  <option value="<?php echo esc_attr($car); ?>" <?php selected($selected_car, $car); ?>><?php echo esc_html($car); ?></option>
                <?php endforeach; ?>
              </select>
            </span>
          </div>
          <div>
            <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Hình thức mua xe</label>
            <span class="wpcf7-form-control-wrap">
              <select name="payment-method" class="wpcf7-form-control wpcf7-select" style="width:100%; height:38px; padding:6px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;">
                <option>Trả thẳng / Tiền mặt</option>
                <option>Vay ngân hàng trả góp</option>
              </select>
            </span>
          </div>
          <div style="grid-column: 1 / -1;">
            <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Ghi chú / Yêu cầu thêm</label>
            <span class="wpcf7-form-control-wrap"><textarea name="your-message" rows="2" placeholder="Nhận báo giá lăn bánh, ưu đãi chính hãng..." class="wpcf7-form-control wpcf7-textarea" style="width:100%; height:52px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC; resize:none;"></textarea></span>
          </div>
          <div style="grid-column: 1 / -1; margin-top:2px;">
            <button type="submit" class="vf-btn vf-btn-primary wpcf7-submit" style="width:100%; height:42px; font-size:13px;">
              » NHẬN BÁO GIÁ NGAY
            </button>
          </div>
        </div>
      </form>
    </div>
    <?php
    return ob_get_clean();
}

// Filter CF7 output to ensure VinFast VF Wild is available in car-model dropdown
add_filter('wpcf7_form_elements', function($content) {
    if (strpos($content, 'name="car-model"') !== false && strpos($content, 'VinFast VF Wild') === false) {
        $content = str_replace(
            '<option value="VinFast VF 9">VinFast VF 9</option>',
            '<option value="VinFast VF 9">VinFast VF 9</option><option value="VinFast VF Wild">VinFast VF Wild</option>',
            $content
        );
    }
    return $content;
});

// Shortcode [vf_quote_popup] or [vf_quote_form] to embed form anywhere
add_shortcode('vf_quote_form', function($atts) {
    $atts = shortcode_atts([
        'car'       => '',
        'shortcode' => ''
    ], $atts, 'vf_quote_form');
    return vfvp_render_lead_form($atts['car'], $atts['shortcode']);
});

add_shortcode('vf_quote_popup', function($atts) {
    $atts = shortcode_atts([
        'btn_text' => 'NHẬN BÁO GIÁ XE',
        'car'      => '',
        'class'    => ''
    ], $atts, 'vf_quote_popup');
    
    $btn_text = esc_html($atts['btn_text']);
    $car_attr = esc_attr($atts['car']);
    $cls = esc_attr($atts['class']);
    
    return sprintf(
        '<button type="button" class="vf-btn vf-btn-primary %s" onclick="vfOpenQuoteModal(\'%s\')">%s</button>',
        $cls,
        $car_attr,
        $btn_text
    );
});

// Auto Cleanup Duplicate Pages in WP Database
add_action('init', function() {
    if (get_transient('vfvp_cleanup_duplicate_pages_v2')) return;
    
    $target_titles = [
        'Đặt lịch dịch vụ',
        'Dịch vụ bảo dưỡng',
        'Dịch vụ sửa chữa',
        'Chính sách bảo hành'
    ];
    
    foreach ($target_titles as $title) {
        $pages = get_posts([
            'post_type'      => 'page',
            'post_status'    => ['publish', 'draft', 'pending', 'trash'],
            'title'          => $title,
            'posts_per_page' => -1,
            'orderby'        => 'ID',
            'order'          => 'ASC'
        ]);
        
        if (count($pages) > 1) {
            // Keep the first (original) page, delete all duplicate copies
            for ($i = 1; $i < count($pages); $i++) {
                wp_delete_post($pages[$i]->ID, true);
            }
        }
    }
    
    set_transient('vfvp_cleanup_duplicate_pages_v2', 1, DAY_IN_SECONDS);
});

// Auto Create Official Contact Form 7 for VinFast Car Quote & Accessory Orders
add_action('init', function() {
    if (get_transient('vfvp_cf7_quote_created_v4')) return;

    if (class_exists('WPCF7_ContactForm')) {
        // 1. Quote Form
        $existing_quote = get_posts([
            'post_type'   => 'wpcf7_contact_form',
            'title'       => 'Nhận Báo Giá Xe VinFast Vĩnh Phúc',
            'post_status' => 'publish'
        ]);

        if (empty($existing_quote)) {
            $form_content = '<div class="vf-cf7-quote-wrapper">
<div class="vf-cf7-field-group">
  <label>Họ và tên *</label>
  [text* your-name placeholder "Nguyễn Văn A"]
</div>
<div class="vf-cf7-field-group">
  <label>Số điện thoại *</label>
  [tel* your-tel placeholder "0900 000 000"]
</div>
<div class="vf-cf7-field-group">
  <label>Dòng xe quan tâm *</label>
  [select* car-model "VinFast VF 2" "VinFast VF 3" "VinFast VF 5 Plus" "VinFast VF 6" "VinFast VF 7" "VinFast VF 8" "VinFast VF 8 The All New" "VinFast VF 9" "VinFast VF MPV 7" "Minio Green" "Herio Green" "Nerio Green" "Limo Green" "EC Van" "eBus"]
</div>
<div class="vf-cf7-field-group">
  <label>Hình thức mua xe</label>
  [select payment-method "Trả thẳng / Tiền mặt" "Vay ngân hàng trả góp"]
</div>
<div class="vf-cf7-field-group">
  <label>Ghi chú / Yêu cầu</label>
  [textarea your-message x3 placeholder "Nhận báo giá lăn bánh, tư vấn ưu đãi..."]
</div>
<div class="vf-cf7-submit-wrap">
  [submit class:vf-btn class:vf-btn-primary "» NHẬN BÁO GIÁ NGAY"]
</div>
</div>';

            $contact_form = WPCF7_ContactForm::get_template([
                'title' => 'Nhận Báo Giá Xe VinFast Vĩnh Phúc'
            ]);
            $contact_form->set_properties(['form' => $form_content]);
            $contact_form->save();
        }

        // 2. Accessory Order Form
        $existing_acc = get_posts([
            'post_type'   => 'wpcf7_contact_form',
            'title'       => 'Đặt Mua Phụ Kiện VinFast Vĩnh Phúc',
            'post_status' => 'publish'
        ]);

        if (empty($existing_acc)) {
            $acc_content = '<div class="vf-cf7-quote-wrapper">
<div class="vf-cf7-field-group">
  <label>Sản phẩm phụ kiện:</label>
  [text* accessory-name readonly id:vf-cf7-acc-name]
</div>
<div class="vf-cf7-field-group">
  <label>Giá tham khảo:</label>
  [text* accessory-price readonly id:vf-cf7-acc-price]
</div>
<div class="vf-cf7-field-group">
  <label>Họ và tên *</label>
  [text* your-name placeholder "Nguyễn Văn A"]
</div>
<div class="vf-cf7-field-group">
  <label>Số điện thoại *</label>
  [tel* your-tel placeholder "0900 000 000"]
</div>
<div class="vf-cf7-field-group">
  <label>Dòng xe đang sử dụng</label>
  [select car-model "VinFast VF 2" "VinFast VF 3" "VinFast VF 5 Plus" "VinFast VF 6" "VinFast VF 7" "VinFast VF 8" "VinFast VF 8 The All New" "VinFast VF 9" "VinFast VF MPV 7" "Minio Green" "Herio Green" "Nerio Green" "Limo Green" "EC Van" "Khác / Chưa mua xe"]
</div>
<div class="vf-cf7-field-group full-width">
  <label>Ghi chú / Yêu cầu thêm</label>
  [textarea your-message x2 placeholder "Nhập màu sắc, số lượng hoặc địa chỉ giao hàng..."]
</div>
<div class="vf-cf7-submit-wrap full-width">
  [submit class:vf-btn class:vf-btn-primary "» GỬI YÊU CẦU ĐẶT HÀNG NGAY"]
</div>
</div>';

            $acc_form = WPCF7_ContactForm::get_template([
                'title' => 'Đặt Mua Phụ Kiện VinFast Vĩnh Phúc'
            ]);
            $acc_form->set_properties([
                'form' => $acc_content,
                'mail' => [
                    'subject'   => 'Yêu cầu đặt mua phụ kiện [accessory-name] từ [your-name]',
                    'sender'    => 'VinFast Vĩnh Phúc <wordpress@' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '>',
                    'body'      => "YÊU CẦU ĐẶT MUA PHỤ KIỆN TỪ WEBSITE VINFAST VĨNH PHÚC\n--------------------------------------------------\nSản phẩm phụ kiện: [accessory-name]\nGiá tham khảo: [accessory-price]\nHọ và tên: [your-name]\nSố điện thoại: [your-tel]\nDòng xe đang sử dụng: [car-model]\nGhi chú: [your-message]\nThời gian gửi: [_date] [_time]",
                    'recipient' => get_option('admin_email'),
                    'additional_headers' => 'Reply-To: [your-tel]'
                ]
            ]);
            $acc_form->save();
        }

        // 3. Test Drive Form
        $existing_testdrive = get_posts([
            'post_type'   => 'wpcf7_contact_form',
            'title'       => 'Đăng Ký Lái Thử VinFast Vĩnh Phúc',
            'post_status' => 'publish'
        ]);

        if (empty($existing_testdrive)) {
            $td_content = '<div class="vf-cf7-quote-wrapper">
<div class="vf-cf7-field-group">
  <label>Họ và tên *</label>
  [text* your-name placeholder "Nguyễn Văn A"]
</div>
<div class="vf-cf7-field-group">
  <label>Số điện thoại *</label>
  [tel* your-tel placeholder "0900 000 000"]
</div>
<div class="vf-cf7-field-group">
  <label>Dòng xe muốn lái thử *</label>
  [select* car-model "VinFast VF 2" "VinFast VF 3" "VinFast VF 5 Plus" "VinFast VF 6" "VinFast VF 7" "VinFast VF 8" "VinFast VF 8 The All New" "VinFast VF 9" "VinFast VF Wild" "VinFast VF MPV 7" "Minio Green" "Herio Green" "Nerio Green" "Limo Green" "EC Van" "eBus"]
</div>
<div class="vf-cf7-field-group">
  <label>Hình thức mua xe</label>
  [select payment-method "Trả thẳng / Tiền mặt" "Vay ngân hàng trả góp"]
</div>
<div class="vf-cf7-field-group full-width">
  <label>Ghi chú / Yêu cầu lái thử</label>
  [textarea your-message x3 placeholder "Khu vực lái thử, thời gian mong muốn..."]
</div>
<div class="vf-cf7-submit-wrap full-width">
  [submit class:vf-btn class:vf-btn-primary "» ĐĂNG KÝ LÁI THỬ NGAY"]
</div>
</div>';

            $td_form = WPCF7_ContactForm::get_template([
                'title' => 'Đăng Ký Lái Thử VinFast Vĩnh Phúc'
            ]);
            $td_form->set_properties([
                'form' => $td_content,
                'mail' => [
                    'active'    => true,
                    'subject'   => '[LÁI THỬ] [your-name] - [your-tel] đăng ký lái thử [car-model]',
                    'sender'    => 'VinFast Vĩnh Phúc <wordpress@' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '>',
                    'body'      => "=== ĐĂNG KÝ LÁI THỬ XE VINFAST VĨNH PHÚC ===\n\nHọ và tên     : [your-name]\nSố điện thoại : [your-tel]\nDòng xe       : [car-model]\nHình thức mua : [payment-method]\nGhi chú       : [your-message]\n\nThời gian gửi : [_date] [_time]\nNguồn website : [_site_url]\n\n--- VinFast Vĩnh Phúc ---",
                    'recipient' => get_option('admin_email'),
                    'additional_headers' => 'Reply-To: [your-tel]'
                ]
            ]);
            $td_form->save();
        }
    }

    set_transient('vfvp_cf7_quote_created_v5', 1, DAY_IN_SECONDS);
});

// Helper function to render Accessory CF7 Form
function vfvp_render_acc_form() {
    if (shortcode_exists('contact-form-7')) {
        $cf7_forms = get_posts([
            'post_type'   => 'wpcf7_contact_form',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        ]);

        foreach ($cf7_forms as $f) {
            if (mb_strpos(mb_strtolower($f->post_title), 'phụ kiện') !== false) {
                return do_shortcode('[contact-form-7 id="' . $f->ID . '" title="' . esc_attr($f->post_title) . '"]');
            }
        }
    }

    // Fallback native HTML form
    ob_start();
    ?>
    <form class="wpcf7-form init" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
      <input type="hidden" name="action" value="vf_submit_acc_form">
      <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px 14px;">
        <div>
          <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Sản phẩm phụ kiện:</label>
          <input type="text" name="accessory-name" id="vf-cf7-acc-name" readonly class="wpcf7-form-control wpcf7-text" style="width:100%; height:38px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F1F5F9;">
        </div>
        <div>
          <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Giá tham khảo:</label>
          <input type="text" name="accessory-price" id="vf-cf7-acc-price" readonly class="wpcf7-form-control wpcf7-text" style="width:100%; height:38px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F1F5F9; font-weight:700; color:#2563EB;">
        </div>
        <div>
          <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Họ và tên *</label>
          <input type="text" name="your-name" placeholder="Nguyễn Văn A" required class="wpcf7-form-control wpcf7-text" style="width:100%; height:38px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;">
        </div>
        <div>
          <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Số điện thoại *</label>
          <input type="tel" name="your-tel" placeholder="0900 000 000" required pattern="[0-9]{10,11}" class="wpcf7-form-control wpcf7-tel" style="width:100%; height:38px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;">
        </div>
        <div style="grid-column: 1 / -1;">
          <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Dòng xe đang sử dụng</label>
          <select name="car-model" class="wpcf7-form-control wpcf7-select" style="width:100%; height:38px; padding:6px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC;">
            <option>VinFast VF 3</option>
            <option>VinFast VF 5 Plus</option>
            <option>VinFast VF 6</option>
            <option>VinFast VF 7</option>
            <option>VinFast VF 8</option>
            <option>VinFast VF 9</option>
            <option>Khác / Chưa mua xe</option>
          </select>
        </div>
        <div style="grid-column: 1 / -1;">
          <label style="display:block; font-size:12px; font-weight:700; color:#1E293B; margin-bottom:3px;">Ghi chú / Yêu cầu thêm</label>
          <textarea name="your-message" rows="2" placeholder="Nhập màu sắc, số lượng hoặc địa chỉ giao hàng..." class="wpcf7-form-control wpcf7-textarea" style="width:100%; height:52px; padding:8px 12px; border:1px solid #CBD5E1; border-radius:6px; font-size:13px; background:#F8FAFC; resize:none;"></textarea>
        </div>
        <div style="grid-column: 1 / -1; margin-top:2px;">
          <button type="submit" class="vf-btn vf-btn-primary wpcf7-submit" style="width:100%; height:42px; font-size:13px;">
            » GỬI YÊU CẦU ĐẶT HÀNG NGAY
          </button>
        </div>
      </div>
    </form>
    <?php
    return ob_get_clean();
}




// ============================================================
// AJAX HANDLERS FOR ACCESSORY ORDERS & LEAD QUOTE EMAILS
// ============================================================
add_action('wp_ajax_vf_submit_acc_order', 'vf_handle_acc_order_submission');
add_action('wp_ajax_nopriv_vf_submit_acc_order', 'vf_handle_acc_order_submission');

function vf_handle_acc_order_submission() {
    check_ajax_referer('vfvp_ajax_nonce', 'nonce');

    $prod_name  = isset($_POST['prod_name']) ? sanitize_text_field($_POST['prod_name']) : '';
    $prod_price = isset($_POST['prod_price']) ? sanitize_text_field($_POST['prod_price']) : '';
    $name       = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $phone      = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $car_model  = isset($_POST['car_model']) ? sanitize_text_field($_POST['car_model']) : '';
    $note       = isset($_POST['note']) ? sanitize_textarea_field($_POST['note']) : '';

    if (empty($name) || empty($phone)) {
        wp_send_json_error(['message' => 'Vui lòng điền đầy đủ Họ tên và Số điện thoại']);
    }

    $to = get_option('admin_email');
    $subject = '[ĐẶT MUA PHỤ KIỆN] ' . $prod_name . ' - ' . $name . ' (' . $phone . ')';

    $body = "YÊU CẦU ĐẶT MUA PHỤ KIỆN TỪ WEBSITE VINFAST MINH NGÂN PHÚ THỌ\n";
    $body .= "--------------------------------------------------\n";
    $body .= "Sản phẩm phụ kiện: " . $prod_name . "\n";
    $body .= "Giá tham khảo: " . $prod_price . "\n";
    $body .= "Họ và tên khách hàng: " . $name . "\n";
    $body .= "Số điện thoại: " . $phone . "\n";
    $body .= "Dòng xe đang sử dụng: " . $car_model . "\n";
    $body .= "Ghi chú / Yêu cầu: " . ($note ? $note : 'Không có') . "\n";
    $body .= "Thời gian gửi: " . date_i18n('Y-m-d H:i:s') . "\n";
    $body .= "--------------------------------------------------\n";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: VinFast Minh Ngân Phú Thọ 3S <wordpress@' . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . '>'
    ];

    wp_mail($to, $subject, $body, $headers);

    wp_send_json_success([
        'message' => 'Cảm ơn bạn ' . $name . '! Yêu cầu đặt mua "' . $prod_name . '" đã được gửi thành công về hệ thống VinFast Minh Ngân Phú Thọ 3S. Chuyên viên tư vấn sẽ liên hệ với bạn qua SĐT ' . $phone . ' ngay.'
    ]);
}

// Auto Create Sample Post & Sample Accessory Demo
add_action('init', function() {
    if (get_transient('vfvp_demo_content_created_v1')) return;

    // 1. Create Demo Blog Post (Post)
    $existing_post = get_posts([
        'post_type'   => 'post',
        'title'       => '🎉 Ưu Đãi Tháng 7/2026: Tặng 100% Lệ Phí Trước Bạ Cho Xe Điện VinFast',
        'post_status' => 'publish'
    ]);

    if (empty($existing_post)) {
        wp_insert_post([
            'post_title'   => '🎉 Ưu Đãi Tháng 7/2026: Tặng 100% Lệ Phí Trước Bạ Cho Xe Điện VinFast',
            'post_content' => 'VinFast Vĩnh Phúc trân trọng thông báo chương trình ưu đãi đặc biệt trong tháng 7/2026: Hỗ trợ 100% lệ phí trước bạ, tặng bộ sạc di động 3.5kW chính hãng và gói bảo dưỡng 3 năm miễn phí cho các dòng ô tô điện VF 3, VF 5 Plus, VF 6, VF 7, VF 8, VF 9.',
            'post_excerpt' => 'VinFast Vĩnh Phúc hỗ trợ 100% lệ phí trước bạ & tặng sạc chính hãng trong tháng 7/2026.',
            'post_status'  => 'publish',
            'post_type'    => 'post'
        ]);
    }

    // 2. Create Demo Accessory Post (Phụ kiện xe)
    $existing_acc_post = get_posts([
        'post_type'   => 'phu_kien',
        'title'       => '🔥 Camera Hành Trình Cao Cấp 4K VinFast VF 8 & VF 9',
        'post_status' => 'publish'
    ]);

    if (empty($existing_acc_post)) {
        $acc_id = wp_insert_post([
            'post_title'   => '🔥 Camera Hành Trình Cao Cấp 4K VinFast VF 8 & VF 9',
            'post_content' => 'Camera hành trình ghi hình 4K siêu nét trước sau, hỗ trợ cảnh báo giao thông thông minh và kết nối Wifi xem trực tiếp trên màn hình trung tâm xe VinFast.',
            'post_excerpt' => 'Camera hành trình 4K ghi hình trước sau dành riêng cho VF 8 & VF 9.',
            'post_status'  => 'publish',
            'post_type'    => 'phu_kien'
        ]);

        if ($acc_id) {
            update_post_meta($acc_id, 'price', '2.500.000 VNĐ');
            update_post_meta($acc_id, 'category', 'Phụ kiện ô tô điện');
            update_post_meta($acc_id, 'cat_slug', 'ngoai-that');
            update_post_meta($acc_id, 'car_model', 'VF 8');
            update_post_meta($acc_id, 'car_slug', 'vf8');
        }
    }

    // 3. Create Demo Campaign Post (Mãnh liệt tinh thần Việt Nam)
    $existing_camp_post = get_posts([
        'post_type'   => 'post',
        'title'       => 'Mãnh liệt Tinh thần Việt Nam - Vì Tương lai Xanh',
        'post_status' => 'publish'
    ]);

    if (empty($existing_camp_post)) {
        wp_insert_post([
            'post_title'   => 'Mãnh liệt Tinh thần Việt Nam - Vì Tương lai Xanh',
            'post_content' => 'Chiến dịch Mãnh liệt Tinh thần Việt Nam - Vì Tương lai Xanh là lời khẳng định mạnh mẽ của VinFast trong hành trình thúc đẩy cuộc cách mạng xe điện và kiến tạo một tương lai bền vững. Chiến dịch không chỉ thể hiện tinh thần tiên phong của thương hiệu Việt trên bản đồ xe điện toàn cầu mà còn kêu gọi cộng đồng cùng chung tay chuyển đổi xanh, góp phần xây dựng một Việt Nam phát triển vững bền, nơi giao thông không chỉ hiện đại mà còn thân thiện với môi trường.',
            'post_excerpt' => 'Chiến dịch Mãnh liệt Tinh thần Việt Nam - Vì Tương lai Xanh là lời khẳng định mạnh mẽ của VinFast trong hành trình thúc đẩy cuộc cách mạng xe điện và kiến tạo một tương lai bền vững.',
            'post_status'  => 'publish',
            'post_type'    => 'post'
        ]);
    }

    set_transient('vfvp_demo_content_created_v1', 1, DAY_IN_SECONDS);
});

// Auto Create Page for News Archive (/tin-tuc/)
add_action('init', function() {
    if (get_transient('vfvp_news_page_created_v1')) return;

    $existing_news_page = get_posts([
        'post_type'   => 'page',
        'title'       => 'Tin tức & Sự kiện',
        'post_status' => 'publish'
    ]);

    if (empty($existing_news_page)) {
        $news_page_id = wp_insert_post([
            'post_title'   => 'Tin tức & Sự kiện',
            'post_name'    => 'tin-tuc',
            'post_status'  => 'publish',
            'post_type'    => 'page'
        ]);

        if ($news_page_id) {
            update_post_meta($news_page_id, '_wp_page_template', 'page-tin-tuc.php');
        }
    } else {
        update_post_meta($existing_news_page[0]->ID, '_wp_page_template', 'page-tin-tuc.php');
    }

    set_transient('vfvp_news_page_created_v1', 1, DAY_IN_SECONDS);
});







// ============================================================
// 🚗 AUTO CREATE PAGE ĐẶT CỌC XE & XỬ LÝ FORM ĐẶT CỌC
// ============================================================
add_action('init', function() {
    if (get_transient('vfvp_deposit_page_created_v3')) return;

    $deposit_page = get_page_by_path('dat-coc-xe');
    if (!$deposit_page) {
        $deposit_page = get_page_by_path('dat-coc');
    }

    if (!$deposit_page) {
        $page_id = wp_insert_post([
            'post_title'     => 'Đặt Cọc Xe Điện VinFast Online',
            'post_name'      => 'dat-coc-xe',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ]);
        if ($page_id) {
            update_post_meta($page_id, '_wp_page_template', 'page-dat-coc.php');
        }
    } else {
        update_post_meta($deposit_page->ID, '_wp_page_template', 'page-dat-coc.php');
    }

    // Đảm bảo trang phu-kien tồn tại
    $phu_kien_page = get_page_by_path('phu-kien');
    if (!$phu_kien_page) {
        $p_id = wp_insert_post([
            'post_title'     => 'Phụ Kiện Xe VinFast Chính Hãng',
            'post_name'      => 'phu-kien',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ]);
        if ($p_id) {
            update_post_meta($p_id, '_wp_page_template', 'page-phu-kien.php');
        }
    } else {
        update_post_meta($phu_kien_page->ID, '_wp_page_template', 'page-phu-kien.php');
    }

    set_transient('vfvp_deposit_page_created_v3', 1, DAY_IN_SECONDS);
});

// Xử lý AJAX Form Đặt Cọc Xe
add_action('wp_ajax_vf_submit_deposit_form', 'vfvp_handle_deposit_form_ajax');
add_action('wp_ajax_nopriv_vf_submit_deposit_form', 'vfvp_handle_deposit_form_ajax');
function vfvp_handle_deposit_form_ajax() {
    check_ajax_referer('vf_deposit_nonce', 'vf_deposit_nonce_field');

    $name     = sanitize_text_field($_POST['customer_name'] ?? '');
    $phone    = sanitize_text_field($_POST['customer_phone'] ?? '');
    $email    = sanitize_email($_POST['customer_email'] ?? '');
    $car      = sanitize_text_field($_POST['car_model'] ?? '');
    $battery  = sanitize_text_field($_POST['battery_type'] ?? '');
    $color    = sanitize_text_field($_POST['car_color'] ?? '');
    $payment  = sanitize_text_field($_POST['payment_type'] ?? '');
    $location = sanitize_text_field($_POST['delivery_location'] ?? '');
    $note     = sanitize_textarea_field($_POST['customer_note'] ?? '');

    if (empty($name) || empty($phone)) {
        wp_send_json_error(['message' => 'Vui lòng điền đầy đủ họ tên và số điện thoại.']);
    }

    // Tiêu đề email
    $subject = "⚡ [YÊU CẦU ĐẶT CỌC XE] {$car} - Khách hàng: {$name} ({$phone})";

    // Nội dung email
    $body  = "Kính gửi Ban Quản Lý VinFast Minh Ngân Phú Thọ 3S,\n\n";
    $body .= "Hệ thống vừa ghi nhận một YÊU CẦU ĐẶT CỌC XE ĐIỆN mới với thông tin chi tiết như sau:\n";
    $body .= "--------------------------------------------------------\n";
    $body .= "👤 Họ và tên khách hàng: {$name}\n";
    $body .= "📞 Số điện thoại: {$phone}\n";
    $body .= "📧 Email: {$email}\n";
    $body .= "🚗 Dòng xe đặt cọc: {$car}\n";
    $body .= "🔋 Gói Pin: {$battery}\n";
    $body .= "🎨 Màu ngoại thất: {$color}\n";
    $body .= "💳 Hình thức thanh toán: {$payment}\n";
    $body .= "📍 Địa điểm nhận xe: {$location}\n";
    $body .= "📝 Ghi chú của khách: {$note}\n";
    $body .= "⏱️ Thời gian gửi: " . current_time('d/m/Y H:i:s') . "\n";
    $body .= "--------------------------------------------------------\n\n";
    $body .= "Vui lòng liên hệ lại khách hàng trong vòng 10 phút để xác nhận đơn cọc và gửi phiếu thu hợp đồng.\n\n";
    $body .= "Trân trọng,\nHệ Thống Website VinFast Minh Ngân Phú Thọ 3S";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: VinFast Minh Ngân Phú Thọ 3S <' . (defined('VFVP_SMTP_USERNAME') ? VFVP_SMTP_USERNAME : get_option('admin_email')) . '>',
    ];
    if (!empty($email)) {
        $headers[] = 'Reply-To: ' . $email;
    }

    $emails = defined('VFVP_CONTACT_EMAILS') ? VFVP_CONTACT_EMAILS : [get_option('admin_email')];
    @wp_mail($emails, $subject, $body, $headers);

    // Bắn thông báo Telegram khi có khách đặt cọc
    $tg_msg  = "🚗 <b>[YÊU CẦU ĐẶT CỌC XE VINFAST]</b>\n";
    $tg_msg .= "👤 <b>Khách hàng:</b> {$name}\n";
    $tg_msg .= "📞 <b>Số điện thoại:</b> <code>{$phone}</code>\n";
    if (!empty($email)) $tg_msg .= "📧 <b>Email:</b> {$email}\n";
    $tg_msg .= "🚙 <b>Dòng xe:</b> <b>{$car}</b>\n";
    $tg_msg .= "🎨 <b>Màu xe:</b> {$color}\n";
    $tg_msg .= "🔋 <b>Gói pin:</b> {$battery}\n";
    $tg_msg .= "💳 <b>Thanh toán:</b> {$payment}\n";
    if (!empty($location)) $tg_msg .= "📍 <b>Địa chỉ:</b> {$location}\n";
    if (!empty($note)) $tg_msg .= "📝 <b>Ghi chú:</b> {$note}\n";
    $tg_msg .= "⏱️ <b>Thời gian:</b> " . current_time('d/m/Y H:i:s');
    vfvp_send_telegram($tg_msg);

    wp_send_json_success([
        'message' => 'Gửi yêu cầu đặt cọc thành công!',
        'car'     => $car,
        'name'    => $name
    ]);
}

// ============================================================
// 🤖 TELEGRAM NOTIFICATION HELPER
// ============================================================
if (!defined('VFVP_TELEGRAM_BOT_TOKEN')) {
    define('VFVP_TELEGRAM_BOT_TOKEN', ''); // Điền Telegram Bot Token vào đây nếu muốn nhận tin nhắn Telegram
}
if (!defined('VFVP_TELEGRAM_CHAT_ID')) {
    define('VFVP_TELEGRAM_CHAT_ID', '');   // Điền Telegram Chat ID vào đây
}

function vfvp_send_telegram($text) {
    $token   = defined('VFVP_TELEGRAM_BOT_TOKEN') ? VFVP_TELEGRAM_BOT_TOKEN : '';
    $chat_id = defined('VFVP_TELEGRAM_CHAT_ID') ? VFVP_TELEGRAM_CHAT_ID : '';

    if (empty($token) || empty($chat_id)) {
        return false;
    }

    $url = "https://api.telegram.org/bot{$token}/sendMessage";
    $args = [
        'body' => [
            'chat_id'                  => $chat_id,
            'text'                     => $text,
            'parse_mode'               => 'HTML',
            'disable_web_page_preview' => true,
        ],
        'timeout' => 5,
    ];
    $res = wp_remote_post($url, $args);
    return !is_wp_error($res);
}

// ============================================================
// 📩 XỬ LÝ FORM ĐĂNG KÝ TƯ VẤN DỊCH VỤ WEB (FOOTER CỘT 4)
// Task: FOOTER-02 | Nonce, Honeypot, Rate Limit, Lead Source, Email & Telegram
// ============================================================
add_action('wp_ajax_vf_submit_footer_service_form', 'vfvp_handle_footer_service_form');
add_action('wp_ajax_nopriv_vf_submit_footer_service_form', 'vfvp_handle_footer_service_form');
function vfvp_handle_footer_service_form() {
    // 1. Kiểm tra Nonce bảo mật
    if (!isset($_POST['vf_consult_nonce']) || !wp_verify_nonce($_POST['vf_consult_nonce'], 'vf_footer_consult_nonce')) {
        wp_send_json_error([
            'message' => 'Yêu cầu không hợp lệ hoặc phiên làm việc đã hết hạn. Vui lòng tải lại trang.'
        ]);
    }

    // 2. Chống bot spam qua Honeypot field (nếu field này có dữ liệu -> bot)
    if (!empty($_POST['vf_hp_check'])) {
        wp_send_json_error([
            'message' => 'Phát hiện yêu cầu bất thường. Vui lòng thử lại.'
        ]);
    }

    // 3. Giới hạn tần suất gửi (Rate Limiting per IP — 45s cooldown)
    $client_ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $rate_key = 'vf_footer_rate_' . md5($client_ip);
    if (get_transient($rate_key)) {
        wp_send_json_error([
            'message' => 'Hệ thống đã nhận yêu cầu của bạn. Vui lòng đợi trong giây lát trước khi gửi lại.'
        ]);
    }

    // 4. Validate & Sanitize số điện thoại (Chuẩn di động Việt Nam: 10 chữ số, bắt đầu bằng 0)
    $raw_phone = sanitize_text_field($_POST['phone'] ?? '');
    $clean_phone = preg_replace('/[^0-9]/', '', $raw_phone);

    if (empty($clean_phone) || (!preg_match('/^0[35789][0-9]{8}$/', $clean_phone) && !preg_match('/^0[1-9][0-9]{8}$/', $clean_phone))) {
        wp_send_json_error([
            'message' => 'Vui lòng nhập số điện thoại hợp lệ (10 chữ số, bắt đầu bằng 0).'
        ]);
    }

    // 5. Ghi nhận nguồn lead rõ ràng (Tư vấn dịch vụ làm website Catchie)
    $lead_source = sanitize_text_field($_POST['lead_source'] ?? 'footer_web_service_consultation');
    $time = current_time('d/m/Y H:i:s');
    $subject = "⚡ [YÊU CẦU TƯ VẤN THIẾT KẾ WEB] Khách hàng SĐT: {$clean_phone}";

    $body  = "Kính gửi Ban Quản Trị / Bộ Phận Thiết Kế Website Catchie,\n\n";
    $body .= "Hệ thống vừa tiếp nhận yêu cầu ĐĂNG KÝ TƯ VẤN DỊCH VỤ WEB từ Chân trang (Footer):\n";
    $body .= "--------------------------------------------------------\n";
    $body .= "📞 Số điện thoại khách hàng: {$clean_phone}\n";
    $body .= "🎯 Mục yêu cầu: Tư Vấn Dịch Vụ Thiết Kế & Phát Triển Website\n";
    $body .= "🌐 Nguồn tiếp nhận: {$lead_source} (VinFast Minh Ngân Phú Thọ 3S)\n";
    $body .= "⏱️ Thời gian tiếp nhận: {$time}\n";
    $body .= "💻 Địa chỉ IP: {$client_ip}\n";
    $body .= "--------------------------------------------------------\n\n";
    $body .= "Vui lòng liên hệ lại khách hàng qua Zalo / Số điện thoại để tư vấn chi tiết.\n\n";
    $body .= "Trân trọng,\nHệ Thống Website VinFast Minh Ngân Phú Thọ 3S";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: VinFast Minh Ngân Phú Thọ 3S <' . (defined('VFVP_SMTP_USERNAME') ? VFVP_SMTP_USERNAME : get_option('admin_email')) . '>',
    ];

    $target_emails = defined('VFVP_CONTACT_EMAILS') ? VFVP_CONTACT_EMAILS : [get_option('admin_email')];
    $mail_sent = @wp_mail($target_emails, $subject, $body, $headers);

    // Bắn thông báo Telegram nếu cấu hình
    $tg_msg  = "⚡ <b>[YÊU CẦU TƯ VẤN DỊCH VỤ LÀM WEB]</b>\n";
    $tg_msg .= "📞 <b>Số điện thoại:</b> <code>{$clean_phone}</code>\n";
    $tg_msg .= "🎯 <b>Dịch vụ:</b> Thiết Kế & Phát Triển Website (Catchie)\n";
    $tg_msg .= "⏱️ <b>Thời gian:</b> {$time}";
    @vfvp_send_telegram($tg_msg);

    // 6. Trả kết quả: Chỉ hiển thị thành công khi mail được gửi thực tế
    if ($mail_sent) {
        // Thiết lập cooldown 45s cho IP này
        set_transient($rate_key, 1, 45);

        wp_send_json_success([
            'message' => 'Đăng ký thành công! Chuyên viên sẽ liên hệ hỗ trợ tư vấn dịch vụ web trong ít phút.'
        ]);
    } else {
        wp_send_json_error([
            'message' => 'Hệ thống đang bận. Quý khách vui lòng liên hệ Zalo 0971.69.2675 để được hỗ trợ trực tiếp.'
        ]);
    }
}

/**
 * Đăng ký ACF Field Group cho Cinematic Motion Hero & Dynamic Car Slider
 * Task: HOME-02.2 | Quản trị không hardcode nội dung thương mại
 */
add_action('acf/init', function() {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key' => 'group_hero_slider_settings',
        'title' => 'Cấu hình Cinematic Hero Slider (Showroom Trang Chủ)',
        'fields' => [
            [
                'key' => 'field_hero_slide_duration',
                'label' => 'Thời gian giữ mỗi slide (mili-giây)',
                'name' => 'hero_slide_duration',
                'type' => 'number',
                'instructions' => 'Nhập 8000 cho 8 giây (mặc định), 5000 cho 5 giây.',
                'default_value' => 8000,
                'min' => 3000,
                'max' => 20000,
                'step' => 1000,
            ],
            [
                'key' => 'field_hero_slides',
                'label' => 'Danh sách các Slide hiển thị',
                'name' => 'hero_slides',
                'type' => 'repeater',
                'instructions' => 'Quản lý các slide ô tô điện hiển thị tại banner đầu trang chủ. Tối đa 5 slide.',
                'button_label' => 'Thêm Slide mới',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_slide_status',
                        'label' => 'Trạng thái hiển thị',
                        'name' => 'slide_status',
                        'type' => 'true_false',
                        'default_value' => 1,
                        'ui' => 1,
                    ],
                    [
                        'key' => 'field_slide_eyebrow',
                        'label' => 'Dòng định vị (Eyebrow)',
                        'name' => 'eyebrow',
                        'type' => 'text',
                        'default_value' => 'VINFAST VF 7 • ALL-ELECTRIC SUV',
                    ],
                    [
                        'key' => 'field_slide_badge',
                        'label' => 'Nhãn huy hiệu (Badge)',
                        'name' => 'badge',
                        'type' => 'text',
                        'default_value' => 'Tiêu điểm',
                    ],
                    [
                        'key' => 'field_slide_title',
                        'label' => 'Tiêu đề chính (H1)',
                        'name' => 'title',
                        'type' => 'textarea',
                        'rows' => 2,
                        'default_value' => "Bứt Phá Giới Hạn\n<span class=\"text-gradient\">Công Nghệ Tương Lai</span>",
                    ],
                    [
                        'key' => 'field_slide_desc',
                        'label' => 'Mô tả ngắn',
                        'name' => 'desc',
                        'type' => 'textarea',
                        'rows' => 3,
                        'default_value' => 'Thiết kế phi đối xứng định hình phong cách thời thượng, công suất 349 mã lực uy lực, dẫn động 2 cầu toàn thời gian AWD và quãng đường di chuyển 496 km.',
                    ],
                    [
                        'key' => 'field_slide_btn_primary_text',
                        'label' => 'Chữ nút CTA chính',
                        'name' => 'btn_primary_text',
                        'type' => 'text',
                        'default_value' => 'Khám phá VF 7',
                    ],
                    [
                        'key' => 'field_slide_btn_primary_url',
                        'label' => 'Liên kết nút CTA chính',
                        'name' => 'btn_primary_url',
                        'type' => 'text',
                        'default_value' => '#collection',
                    ],
                    [
                        'key' => 'field_slide_btn_secondary_text',
                        'label' => 'Chữ nút CTA phụ',
                        'name' => 'btn_secondary_text',
                        'type' => 'text',
                        'default_value' => 'Đăng ký lái thử',
                    ],
                    [
                        'key' => 'field_slide_btn_secondary_url',
                        'label' => 'Liên kết nút CTA phụ',
                        'name' => 'btn_secondary_url',
                        'type' => 'text',
                        'default_value' => '/dang-ky-lai-thu/',
                    ],
                    [
                        'key' => 'field_slide_image',
                        'label' => 'Hình ảnh xe (PNG / WebP nền trong suốt)',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                    ],
                ]
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ],
            ],
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'page-home.php',
                ],
            ],
        ],
    ]);
});
