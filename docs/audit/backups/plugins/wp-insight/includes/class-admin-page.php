<?php
/**
 * Admin Page: menu, dashboard, settings, widget, AJAX, shortcode
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class WPInsight_Admin_Page {

    public function __construct() {
        add_action( 'admin_menu',            [ $this, 'add_menu' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'wp_dashboard_setup',    [ $this, 'register_dashboard_widget' ] );
        add_action( 'wp_ajax_wpinsight_get_data', [ $this, 'ajax_get_data' ] );
        add_action( 'wp_ajax_wpinsight_export',   [ $this, 'ajax_export' ] );
        add_action( 'wp_ajax_wpinsight_purge',    [ $this, 'ajax_purge' ] );
        add_action( 'admin_post_wpinsight_save_settings', [ $this, 'save_settings' ] );
        add_shortcode( 'wpinsight_counter', [ $this, 'shortcode_counter' ] );
    }

    public function add_menu(): void {
        add_menu_page( 'WP Insight – Thống Kê Truy Cập', '📊 WP Insight', 'manage_options',
            'wp-insight', [ $this, 'render_dashboard' ], 'dashicons-chart-line', 3 );
        add_submenu_page( 'wp-insight', 'Thống kê', 'Thống kê', 'manage_options', 'wp-insight', [ $this, 'render_dashboard' ] );
        add_submenu_page( 'wp-insight', 'Cài đặt', 'Cài đặt', 'manage_options', 'wp-insight-settings', [ $this, 'render_settings' ] );
    }

    public function enqueue_assets( string $hook ): void {
        $allowed = [ 'toplevel_page_wp-insight', 'wp-insight_page_wp-insight-settings', 'index.php' ];
        if ( ! in_array( $hook, $allowed, true ) ) return;

        wp_enqueue_style( 'wpinsight-dashboard', WPINSIGHT_PLUGIN_URL . 'assets/css/dashboard.css', [], WPINSIGHT_VERSION );
        wp_enqueue_script( 'chartjs', 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js', [], '4.4.0', true );
        wp_enqueue_script( 'wpinsight-dashboard', WPINSIGHT_PLUGIN_URL . 'assets/js/dashboard.js', [ 'jquery', 'chartjs' ], WPINSIGHT_VERSION, true );
        wp_localize_script( 'wpinsight-dashboard', 'wpInsightConfig', [
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'wpinsight_nonce' ),
            'page'    => $hook,
        ] );
    }

    public function render_dashboard(): void { include WPINSIGHT_PLUGIN_DIR . 'templates/dashboard.php'; }
    public function render_settings(): void  { include WPINSIGHT_PLUGIN_DIR . 'templates/settings-page.php'; }

    public function save_settings(): void {
        if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );
        check_admin_referer( 'wpinsight_save_settings' );

        update_option( 'wpinsight_exclude_ips',       sanitize_textarea_field( wp_unslash( $_POST['wpinsight_exclude_ips'] ?? '' ) ) );
        update_option( 'wpinsight_enable_geo',        isset( $_POST['wpinsight_enable_geo'] ) ? '1' : '0' );
        update_option( 'wpinsight_enable_bot_filter', isset( $_POST['wpinsight_enable_bot_filter'] ) ? '1' : '0' );
        update_option( 'wpinsight_data_retention',    (int) ( $_POST['wpinsight_data_retention'] ?? 365 ) );
        update_option( 'wpinsight_sampling',          (int) ( $_POST['wpinsight_sampling'] ?? 100 ) );
        $roles = array_map( 'sanitize_text_field', (array) ( $_POST['wpinsight_exclude_roles'] ?? [] ) );
        update_option( 'wpinsight_exclude_roles', $roles );

        wp_redirect( admin_url( 'admin.php?page=wp-insight-settings&saved=1' ) );
        exit;
    }

    public function ajax_get_data(): void {
        check_ajax_referer( 'wpinsight_nonce', 'nonce' );
        if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error( 'Unauthorized', 403 );

        $range   = sanitize_text_field( wp_unslash( $_POST['range']   ?? '7d' ) );
        $from    = sanitize_text_field( wp_unslash( $_POST['from']    ?? '' ) );
        $to      = sanitize_text_field( wp_unslash( $_POST['to']      ?? '' ) );
        $section = sanitize_text_field( wp_unslash( $_POST['section'] ?? 'all' ) );

        $analytics = new WPInsight_Analytics();
        $date      = $analytics->get_date_range( $range, $from, $to );
        $response  = [];

        if ( $section === 'all' || $section === 'kpi' )       $response['kpi']       = $analytics->get_kpi( $date );
        if ( $section === 'all' || $section === 'daily' )     $response['daily']     = $analytics->get_daily_stats( $date );
        if ( $section === 'all' || $section === 'pages' )     $response['pages']     = $analytics->get_top_pages( $date, 10 );
        if ( $section === 'all' || $section === 'device' )    $response['device']    = $analytics->get_device_stats( $date );
        if ( $section === 'all' || $section === 'referrers' ) $response['referrers'] = $analytics->get_top_referrers( $date, 10 );
        if ( $section === 'all' || $section === 'countries' ) $response['countries'] = $analytics->get_top_countries( $date, 10 );
        if ( $section === 'all' || $section === 'browsers' )  $response['browsers']  = $analytics->get_browser_stats( $date );
        if ( $section === 'all' || $section === 'recent' )    $response['recent']    = $analytics->get_recent_hits( 20 );

        wp_send_json_success( $response );
    }

    public function ajax_export(): void {
        check_ajax_referer( 'wpinsight_nonce', 'nonce' );
        if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );
        $analytics = new WPInsight_Analytics();
        $date = $analytics->get_date_range(
            sanitize_text_field( wp_unslash( $_GET['range'] ?? '30d' ) ),
            sanitize_text_field( wp_unslash( $_GET['from']  ?? '' ) ),
            sanitize_text_field( wp_unslash( $_GET['to']    ?? '' ) )
        );
        $analytics->export_csv( $date );
    }

    public function ajax_purge(): void {
        check_ajax_referer( 'wpinsight_nonce', 'nonce' );
        if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error( 'Unauthorized', 403 );
        WPInsight_Database::purge_all_data();
        wp_send_json_success( 'Đã xóa toàn bộ dữ liệu thống kê.' );
    }

    public function register_dashboard_widget(): void {
        wp_add_dashboard_widget( 'wpinsight_widget', '📊 WP Insight – Thống kê 7 ngày', [ $this, 'render_dashboard_widget' ] );
    }

    public function render_dashboard_widget(): void {
        $analytics = new WPInsight_Analytics();
        $data      = $analytics->get_widget_data();
        $daily     = $data['daily'];
        ?>
        <div class="wpinsight-widget">
            <div class="wpinsight-widget-kpi">
                <div class="wpinsight-widget-stat">
                    <span class="wpinsight-widget-number"><?php echo number_format( $data['pageviews'] ); ?></span>
                    <span class="wpinsight-widget-label">Lượt xem</span>
                </div>
                <div class="wpinsight-widget-stat">
                    <span class="wpinsight-widget-number"><?php echo number_format( $data['visitors'] ); ?></span>
                    <span class="wpinsight-widget-label">Visitors</span>
                </div>
            </div>
            <canvas id="wpinsight-widget-chart" height="80"></canvas>
        </div>
        <script>
        (function() {
            var labels = <?php echo wp_json_encode( $daily['labels'] ); ?>;
            var views  = <?php echo wp_json_encode( $daily['views'] ); ?>;
            var ctx = document.getElementById('wpinsight-widget-chart');
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{ label: 'Pageviews', data: views, borderColor: '#6366f1',
                        backgroundColor: 'rgba(99,102,241,0.1)', fill: true, tension: 0.4, pointRadius: 2 }]
                },
                options: { responsive: true, plugins: { legend: { display: false } },
                    scales: { x: { display: false }, y: { display: false } } }
            });
        })();
        </script>
        <?php
    }

    public function shortcode_counter( array $atts ): string {
        $atts    = shortcode_atts( [ 'post_id' => get_the_ID(), 'label' => 'lượt xem' ], $atts );
        $post_id = (int) $atts['post_id'];
        if ( ! $post_id ) return '';
        $analytics = new WPInsight_Analytics();
        $views     = $analytics->get_post_views( $post_id );
        return '<span class="wpinsight-counter">👁️ ' . number_format( $views ) . ' ' . esc_html( $atts['label'] ) . '</span>';
    }
}
