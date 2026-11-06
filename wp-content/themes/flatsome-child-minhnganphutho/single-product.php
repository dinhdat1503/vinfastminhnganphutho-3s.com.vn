<?php
/**
 * Single Product Template Override in Flatsome Child Theme
 * Override Flatsome Parent Theme single-product.php to load dedicated VinFast car templates
 */

defined('ABSPATH') || exit;

$post_id  = get_the_ID();
$slug     = strtolower(get_post_field('post_name', $post_id));
$car_name = strtolower(get_the_title($post_id));

$theme_dir = get_stylesheet_directory() . '/template-parts/product/';

if (strpos($slug, 'vf-9') !== false || strpos($slug, 'vf9') !== false || strpos($car_name, 'vf 9') !== false || strpos($car_name, 'vf9') !== false) {
    include $theme_dir . 'single-vf9.php';
    return;
}

include get_stylesheet_directory() . '/single-product-vinfast.php';
