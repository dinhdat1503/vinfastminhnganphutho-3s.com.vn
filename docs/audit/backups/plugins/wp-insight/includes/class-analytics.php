<?php
/**
 * Analytics: query và tổng hợp dữ liệu cho dashboard
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class WPInsight_Analytics {

    private string $hits_table;
    private string $sessions_table;

    public function __construct() {
        global $wpdb;
        $this->hits_table     = $wpdb->prefix . WPINSIGHT_TABLE_HITS;
        $this->sessions_table = $wpdb->prefix . WPINSIGHT_TABLE_SESSIONS;
    }

    public function get_date_range( string $range = '7d', string $from = '', string $to = '' ): array {
        if ( $range === 'custom' && $from && $to ) {
            return [
                'from' => sanitize_text_field( $from ) . ' 00:00:00',
                'to'   => sanitize_text_field( $to )   . ' 23:59:59',
            ];
        }

        $days_map = [ 'today' => 0, '1d' => 1, '7d' => 7, '30d' => 30, '90d' => 90, '365d' => 365 ];
        $days = $days_map[ $range ] ?? 7;

        return [
            'from' => gmdate( 'Y-m-d 00:00:00', strtotime( "-{$days} days" ) ),
            'to'   => gmdate( 'Y-m-d 23:59:59' ),
        ];
    }

    public function get_kpi( array $date ): array {
        global $wpdb;

        $pageviews = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM {$this->hits_table} WHERE hit_time BETWEEN %s AND %s",
            $date['from'], $date['to']
        ) );

        $unique_visitors = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(DISTINCT session_id) FROM {$this->hits_table} WHERE hit_time BETWEEN %s AND %s",
            $date['from'], $date['to']
        ) );

        $bounce_data = $wpdb->get_row( $wpdb->prepare(
            "SELECT COUNT(*) as total, SUM(is_bounce) as bounced FROM {$this->sessions_table} WHERE first_seen BETWEEN %s AND %s",
            $date['from'], $date['to']
        ) );
        $bounce_rate = ( $bounce_data && $bounce_data->total > 0 )
            ? round( ( $bounce_data->bounced / $bounce_data->total ) * 100, 1 ) : 0;

        $pages_per_session = $unique_visitors > 0 ? round( $pageviews / $unique_visitors, 2 ) : 0;

        $top_country = $wpdb->get_row( $wpdb->prepare(
            "SELECT country, country_name, COUNT(*) as cnt FROM {$this->hits_table}
             WHERE hit_time BETWEEN %s AND %s AND country != '??'
             GROUP BY country, country_name ORDER BY cnt DESC LIMIT 1",
            $date['from'], $date['to']
        ) );

        $realtime = (int) $wpdb->get_var(
            "SELECT COUNT(*) FROM {$this->hits_table} WHERE hit_time >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)"
        );

        return compact( 'pageviews', 'unique_visitors', 'bounce_rate', 'pages_per_session', 'top_country', 'realtime' );
    }

    public function get_daily_stats( array $date ): array {
        global $wpdb;

        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT DATE(hit_time) as day, COUNT(*) as pageviews, COUNT(DISTINCT session_id) as unique_visitors
             FROM {$this->hits_table} WHERE hit_time BETWEEN %s AND %s
             GROUP BY DATE(hit_time) ORDER BY day ASC",
            $date['from'], $date['to']
        ) );

        $labels = []; $views = []; $uniques = [];
        foreach ( $rows as $row ) {
            $labels[]  = $row->day;
            $views[]   = (int) $row->pageviews;
            $uniques[] = (int) $row->unique_visitors;
        }
        return compact( 'labels', 'views', 'uniques' );
    }

    public function get_top_pages( array $date, int $limit = 10 ): array {
        global $wpdb;
        return $wpdb->get_results( $wpdb->prepare(
            "SELECT url, page_title, post_id, COUNT(*) as pageviews, COUNT(DISTINCT session_id) as unique_views
             FROM {$this->hits_table} WHERE hit_time BETWEEN %s AND %s
             GROUP BY url, page_title, post_id ORDER BY pageviews DESC LIMIT %d",
            $date['from'], $date['to'], $limit
        ) );
    }

    public function get_device_stats( array $date ): array {
        global $wpdb;
        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT device, COUNT(*) as cnt FROM {$this->hits_table}
             WHERE hit_time BETWEEN %s AND %s GROUP BY device ORDER BY cnt DESC",
            $date['from'], $date['to']
        ) );
        $labels = []; $data = [];
        foreach ( $rows as $row ) { $labels[] = ucfirst( $row->device ); $data[] = (int) $row->cnt; }
        return compact( 'labels', 'data' );
    }

    public function get_top_referrers( array $date, int $limit = 10 ): array {
        global $wpdb;
        return $wpdb->get_results( $wpdb->prepare(
            "SELECT ref_source, COUNT(*) as cnt FROM {$this->hits_table}
             WHERE hit_time BETWEEN %s AND %s GROUP BY ref_source ORDER BY cnt DESC LIMIT %d",
            $date['from'], $date['to'], $limit
        ) );
    }

    public function get_top_countries( array $date, int $limit = 10 ): array {
        global $wpdb;
        return $wpdb->get_results( $wpdb->prepare(
            "SELECT country, country_name, COUNT(*) as cnt FROM {$this->hits_table}
             WHERE hit_time BETWEEN %s AND %s AND country != '??'
             GROUP BY country, country_name ORDER BY cnt DESC LIMIT %d",
            $date['from'], $date['to'], $limit
        ) );
    }

    public function get_browser_stats( array $date ): array {
        global $wpdb;
        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT browser, COUNT(*) as cnt FROM {$this->hits_table}
             WHERE hit_time BETWEEN %s AND %s GROUP BY browser ORDER BY cnt DESC LIMIT 8",
            $date['from'], $date['to']
        ) );
        $labels = []; $data = [];
        foreach ( $rows as $row ) { $labels[] = $row->browser ?: 'Other'; $data[] = (int) $row->cnt; }
        return compact( 'labels', 'data' );
    }

    public function get_recent_hits( int $limit = 20 ): array {
        global $wpdb;
        return $wpdb->get_results( $wpdb->prepare(
            "SELECT page_title, url, device, browser, country, country_name, ref_source, hit_time
             FROM {$this->hits_table} ORDER BY hit_time DESC LIMIT %d",
            $limit
        ) );
    }

    public function get_widget_data(): array {
        $date = $this->get_date_range( '7d' );
        $daily = $this->get_daily_stats( $date );
        return [
            'daily'     => $daily,
            'pageviews' => array_sum( $daily['views'] ),
            'visitors'  => array_sum( $daily['uniques'] ),
        ];
    }

    public function get_post_views( int $post_id ): int {
        global $wpdb;
        return (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM {$this->hits_table} WHERE post_id = %d", $post_id
        ) );
    }

    public function export_csv( array $date ): void {
        global $wpdb;
        $rows = $wpdb->get_results( $wpdb->prepare(
            "SELECT hit_time, page_title, url, device, browser, os, country_name, ref_source
             FROM {$this->hits_table} WHERE hit_time BETWEEN %s AND %s ORDER BY hit_time DESC",
            $date['from'], $date['to']
        ), ARRAY_A );

        $filename = 'wp-insight-' . gmdate( 'Y-m-d' ) . '.csv';
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
        $out = fopen( 'php://output', 'w' );
        fputs( $out, "\xEF\xBB\xBF" );
        fputcsv( $out, [ 'Thời gian', 'Tiêu đề trang', 'URL', 'Device', 'Browser', 'OS', 'Quốc gia', 'Nguồn' ] );
        foreach ( $rows as $row ) { fputcsv( $out, array_values( $row ) ); }
        fclose( $out );
        exit;
    }
}
