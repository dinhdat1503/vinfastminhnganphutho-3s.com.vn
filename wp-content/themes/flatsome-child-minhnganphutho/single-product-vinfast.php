<?php
/**
 * Template Name: VinFast Product Page Router
 * Tự động điều phối và nạp đúng file Template mô-đun chuyên biệt cho từng xe
 */

defined('ABSPATH') || exit;

$post_id   = get_the_ID();
$slug      = strtolower(get_post_field('post_name', $post_id));
$car_name  = strtolower(get_the_title($post_id));
$theme_dir = get_stylesheet_directory() . '/template-parts/product/';

$routes = [
    'vf9'        => ['vf-9', 'vf9'],
    'vf3'        => ['vf-3', 'vf3'],
    'vf5'        => ['vf-5', 'vf5'],
    'vf6'        => ['vf-6', 'vf6'],
    'mpv7'       => ['mpv-7', 'mpv7', 'mpv'],
    'vf7'        => ['vf-7', 'vf7'],
    'vf8_allnew' => ['vf-8-all', 'all-new', 'allnew'],
    'vf8'        => ['vf-8', 'vf8'],
    'vf2'        => ['vf-2', 'vf2'],
    'vfwild'     => ['vf-wild', 'vfwild', 'wild'],
    'ecvan'      => ['ec-van', 'ecvan'],
    'minio'      => ['minio'],
    'herio'      => ['herio'],
    'nerio'      => ['nerio'],
    'limo'       => ['limo'],
];

foreach ($routes as $key => $keywords) {
    $tpl_file = $theme_dir . 'single-' . $key . '.php';
    if (file_exists($tpl_file)) {
        foreach ($keywords as $kw) {
            if (strpos($slug, $kw) !== false || strpos($car_name, $kw) !== false) {
                include $tpl_file;
                return;
            }
        }
    }
}

// Fallback to master default template
if (file_exists($theme_dir . 'single-default-car.php')) {
    include $theme_dir . 'single-default-car.php';
    return;
}
