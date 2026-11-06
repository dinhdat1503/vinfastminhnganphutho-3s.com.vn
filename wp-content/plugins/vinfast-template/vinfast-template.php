<?php
/**
 * Plugin Name: VinFast Product Template
 * Description: Ghi đè giao diện trang chi tiết sản phẩm cho các xe VinFast (sản phẩm có meta _vf_is_vinfast = yes), theo bố cục giống trang mẫu shop.vinfastauto.com. Hoạt động trên theme Storefront (hoặc bất kỳ theme WooCommerce chuẩn nào).
 * Version: 1.0.0
 * Author: (bạn)
 *
 * CÀI ĐẶT:
 * 1. Tải toàn bộ thư mục "vinfast-template" vào /wp-content/plugins/
 * 2. Vào WP Admin → Plugins → Kích hoạt "VinFast Product Template"
 * 3. Chạy lại create-all-vinfast.php như bình thường để tạo/cập nhật sản phẩm
 * 4. Mở trang chi tiết 1 xe VinFast bất kỳ để xem kết quả
 */

if (!defined('ABSPATH')) exit;

define('VF_TPL_DIR', plugin_dir_path(__FILE__));
define('VF_TPL_URL', plugin_dir_url(__FILE__));

// Disable WooCommerce 9+ Coming Soon feature completely
add_filter('woocommerce_is_coming_soon', '__return_false', 9999);
add_filter('woocommerce_coming_soon_mode', '__return_false', 9999);

/**
 * ============================================================
 * 1) GHI ĐÈ TEMPLATE cho sản phẩm VinFast
 * ============================================================
 * Chỉ áp dụng khi đang xem trang single product VÀ sản phẩm đó
 * có meta _vf_is_vinfast = yes. Các sản phẩm khác (không phải
 * VinFast) vẫn dùng template mặc định của theme/WooCommerce.
 */
add_filter('template_include', function ($template) {
    if (!is_singular('product')) {
        return $template;
    }

    global $post;
    $is_vinfast = get_post_meta($post->ID, '_vf_is_vinfast', true);

    if ($is_vinfast === 'yes') {
        $custom_template = VF_TPL_DIR . 'templates/single-product-vinfast.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    return $template;
}, 20);

/**
 * ============================================================
 * 2) ENQUEUE CSS / JS — chỉ load trên trang sản phẩm VinFast
 * ============================================================
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_singular('product')) return;

    global $post;
    if (get_post_meta($post->ID, '_vf_is_vinfast', true) !== 'yes') return;

    wp_enqueue_style('flatsome-child-style', get_stylesheet_directory_uri() . '/style.css', array(), time());
    wp_enqueue_style('vf-template-style', VF_TPL_URL . 'assets/vf-style.css', array(), '1.0.0');
    wp_enqueue_script('vf-template-script', VF_TPL_URL . 'assets/vf-script.js', array(), '1.0.0', true);
});

/**
 * ============================================================
 * 3) HELPER: Lấy URL ảnh từ img_folder + tên file
 * ============================================================
 * Ảnh được tải/đặt sẵn trong /wp-content/uploads/{img_folder}/{filename}
 * (đúng như create-all-vinfast.php đã tải về)
 */
function vf_img_url($img_folder, $filename) {
    if (empty($filename)) return '';
    if (preg_match('#^https?://#i', $filename)) {
        return $filename;
    }

    $upload_dir = wp_upload_dir();
    $relative = trailingslashit($img_folder) . ltrim($filename, '/');
    $absolute = trailingslashit($upload_dir['basedir']) . $relative;

    if (file_exists($absolute) && filesize($absolute) > 0) {
        return trailingslashit($upload_dir['baseurl']) . $relative;
    }

    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
    if ($thumbnail_id) {
        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
        if ($thumbnail_url) {
            return $thumbnail_url;
        }
    }

    if (function_exists('wc_placeholder_img_src')) {
        return wc_placeholder_img_src('full');
    }

    return '';
}

/**
 * ============================================================
 * 4) HELPER: Lấy toàn bộ custom field của 1 xe dưới dạng mảng
 * ============================================================
 */
function vf_get_vehicle_data($post_id) {
    return array(
        'img_folder'        => get_post_meta($post_id, '_vf_img_folder', true),
        'hero_specs'        => get_post_meta($post_id, '_vf_hero_specs', true) ?: array(),
        'colors'            => get_post_meta($post_id, '_vf_colors', true) ?: array(),
        'overview_title'    => get_post_meta($post_id, '_vf_overview_title', true),
        'overview_text'     => get_post_meta($post_id, '_vf_overview_text', true),
        'video_banner'      => get_post_meta($post_id, '_vf_video_banner', true),
        'gallery'           => get_post_meta($post_id, '_vf_gallery', true) ?: array(),
        'exterior_text'     => get_post_meta($post_id, '_vf_exterior_text', true),
        'exterior_img'      => get_post_meta($post_id, '_vf_exterior_img', true),
        'exterior_gallery'  => get_post_meta($post_id, '_vf_exterior_gallery', true) ?: array(),
        'interior_text'     => get_post_meta($post_id, '_vf_interior_text', true),
        'interior_img'      => get_post_meta($post_id, '_vf_interior_img', true),
        'interior_gallery'  => get_post_meta($post_id, '_vf_interior_gallery', true) ?: array(),
        'performance'       => get_post_meta($post_id, '_vf_performance', true) ?: array(),
        'safety'            => get_post_meta($post_id, '_vf_safety', true) ?: array(),
        'spec_tabs'         => get_post_meta($post_id, '_vf_spec_tabs', true) ?: array(),
        // Thông số dùng cho công cụ so sánh chi phí (có default nếu chưa khai báo)
        'ev_consumption_kwh_100km' => get_post_meta($post_id, '_vf_ev_consumption_kwh_100km', true) ?: '15',
        'elec_price_per_kwh'       => get_post_meta($post_id, '_vf_elec_price_per_kwh', true) ?: '3500',
    );
}
