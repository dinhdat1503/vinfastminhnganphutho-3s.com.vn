<?php
/**
 * Plugin Name: WP Insight – Thống Kê Truy Cập
 * Plugin URI:  https://github.com/your-repo/wp-insight
 * Description: Đo lường lượng truy cập website ngay trong WordPress — không cần Google Analytics. Hỗ trợ pageviews, unique visitors, bounce rate, geolocation, device stats và hơn thế nữa.
 * Version:     1.0.0
 * Author:      Your Name
 * License:     GPL-2.0+
 * Text Domain: wp-insight
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Constants
define( 'WPINSIGHT_VERSION',    '1.0.0' );
define( 'WPINSIGHT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPINSIGHT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WPINSIGHT_TABLE_HITS',     'wpinsight_hits' );
define( 'WPINSIGHT_TABLE_SESSIONS', 'wpinsight_sessions' );

// Load includes
require_once WPINSIGHT_PLUGIN_DIR . 'includes/class-database.php';
require_once WPINSIGHT_PLUGIN_DIR . 'includes/class-bot-filter.php';
require_once WPINSIGHT_PLUGIN_DIR . 'includes/class-geo.php';
require_once WPINSIGHT_PLUGIN_DIR . 'includes/class-tracker.php';
require_once WPINSIGHT_PLUGIN_DIR . 'includes/class-analytics.php';
require_once WPINSIGHT_PLUGIN_DIR . 'includes/class-admin-page.php';

// Boot
add_action( 'plugins_loaded', function () {
    new WPInsight_Tracker();
    new WPInsight_Admin_Page();
} );

// Activation
register_activation_hook( __FILE__, function () {
    WPInsight_Database::create_tables();
    if ( ! get_option( 'wpinsight_ip_salt' ) ) {
        add_option( 'wpinsight_ip_salt', wp_generate_password( 64, true, true ) );
    }
    add_option( 'wpinsight_exclude_roles',      [ 'administrator' ] );
    add_option( 'wpinsight_exclude_ips',        '' );
    add_option( 'wpinsight_enable_geo',         '1' );
    add_option( 'wpinsight_enable_bot_filter',  '1' );
    add_option( 'wpinsight_data_retention',     365 );
    add_option( 'wpinsight_sampling',           100 );
} );

// Deactivation
register_deactivation_hook( __FILE__, function () {
    wp_clear_scheduled_hook( 'wpinsight_cleanup_cron' );
} );

// Cron cleanup hàng ngày
add_action( 'wpinsight_cleanup_cron', [ 'WPInsight_Database', 'cleanup_old_data' ] );
add_action( 'plugins_loaded', function () {
    if ( ! wp_next_scheduled( 'wpinsight_cleanup_cron' ) ) {
        wp_schedule_event( time(), 'daily', 'wpinsight_cleanup_cron' );
    }
} );
