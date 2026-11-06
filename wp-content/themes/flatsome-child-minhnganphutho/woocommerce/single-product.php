<?php
/**
 * WooCommerce Single Product Template Override
 */
if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_the_ID();
$is_vinfast = get_post_meta($post_id, '_vf_is_vinfast', true);

$post_id  = get_the_ID();
$slug     = strtolower(get_post_field('post_name', $post_id));
$car_name = strtolower(get_the_title($post_id));

if (strpos($slug, 'vf-9') !== false || strpos($slug, 'vf9') !== false || strpos($car_name, 'vf 9') !== false || strpos($car_name, 'vf9') !== false) {
    include get_stylesheet_directory() . '/template-parts/product/single-vf9.php';
    return;
}

include get_stylesheet_directory() . '/single-product-vinfast.php';
