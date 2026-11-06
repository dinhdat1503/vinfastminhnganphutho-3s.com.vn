<?php
/**
 * Plugin Name: AI Writer - Trợ Lý Viết Bài
 * Plugin URI:  https://github.com/your-repo/ai-writer
 * Description: Hỗ trợ viết bài WordPress bằng Google Gemini AI: gợi ý tiêu đề SEO, meta description, từ khóa và cải thiện đoạn văn.
 * Version:     1.0.0
 * Author:      Your Name
 * License:     GPL-2.0+
 * Text Domain: ai-writer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Constants
define( 'AI_WRITER_VERSION', '1.0.0' );
define( 'AI_WRITER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AI_WRITER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load includes
require_once AI_WRITER_PLUGIN_DIR . 'includes/class-gemini-api.php';
require_once AI_WRITER_PLUGIN_DIR . 'includes/class-admin-settings.php';
require_once AI_WRITER_PLUGIN_DIR . 'includes/class-rest-api.php';
require_once AI_WRITER_PLUGIN_DIR . 'includes/class-gutenberg.php';
require_once AI_WRITER_PLUGIN_DIR . 'includes/class-metabox.php';

// Boot
add_action( 'plugins_loaded', function () {
    new AI_Writer_Admin_Settings();
    new AI_Writer_REST_API();
    new AI_Writer_Gutenberg();
    new AI_Writer_Metabox();
} );

// Direct "Cài đặt" link in Plugins list table
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function ( $links ) {
    $settings_link = '<a href="' . admin_url( 'admin.php?page=ai-writer-settings' ) . '" style="font-weight:bold; color:#6366f1;">Cài đặt</a>';
    array_unshift( $links, $settings_link );
    return $links;
} );

// Activation hook
register_activation_hook( __FILE__, function () {
    add_option( 'ai_writer_gemini_api_key', '' );
    add_option( 'ai_writer_language', 'vi' );
    add_option( 'ai_writer_model', 'gemini-2.5-flash' );
} );

// Deactivation hook
register_deactivation_hook( __FILE__, function () {
    // cleanup nếu cần
} );
