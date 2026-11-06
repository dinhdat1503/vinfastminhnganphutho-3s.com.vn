<?php
/**
 * Tracker: ghi nhận mỗi pageview vào database
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class WPInsight_Tracker {

    public function __construct() {
        add_action( 'wp', [ $this, 'track_hit' ] );
    }

    public function track_hit(): void {
        if ( is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
            return;
        }

        if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
            return;
        }

        if ( is_feed() || is_robots() ) {
            return;
        }

        if ( get_option( 'wpinsight_enable_bot_filter', '1' ) === '1' ) {
            if ( WPInsight_Bot_Filter::is_bot() ) {
                return;
            }
        }

        if ( WPInsight_Bot_Filter::is_excluded_role() ) {
            return;
        }

        $ip = WPInsight_Geo::get_real_ip();

        if ( WPInsight_Bot_Filter::is_excluded_ip( $ip ) ) {
            return;
        }

        $sampling = (int) get_option( 'wpinsight_sampling', 100 );
        if ( $sampling < 100 && wp_rand( 1, 100 ) > $sampling ) {
            return;
        }

        $salt       = get_option( 'wpinsight_ip_salt', '' );
        $ua         = isset( $_SERVER['HTTP_USER_AGENT'] )
                      ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) )
                      : '';
        $ip_hash    = hash( 'sha256', $ip . $salt );
        $session_id = hash( 'sha256', $ip . $ua . $salt . gmdate( 'Y-m-d' ) );

        $referrer   = isset( $_SERVER['HTTP_REFERER'] )
                      ? esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) )
                      : '';
        $ref_source = $this->parse_ref_source( $referrer );

        $device_info = $this->parse_device( $ua );
        $post_id     = get_queried_object_id() ?: 0;
        $page_title  = wp_get_document_title();
        $url         = esc_url_raw( ( is_ssl() ? 'https' : 'http' ) . '://' . ( $_SERVER['HTTP_HOST'] ?? '' ) . ( $_SERVER['REQUEST_URI'] ?? '' ) );

        $geo = WPInsight_Geo::get_country( $ip );

        global $wpdb;
        $hits_table     = $wpdb->prefix . WPINSIGHT_TABLE_HITS;
        $sessions_table = $wpdb->prefix . WPINSIGHT_TABLE_SESSIONS;
        $now            = current_time( 'mysql', true );

        $wpdb->insert(
            $hits_table,
            [
                'session_id'   => $session_id,
                'post_id'      => $post_id,
                'url'          => mb_substr( $url, 0, 500 ),
                'page_title'   => mb_substr( $page_title, 0, 255 ),
                'referrer'     => mb_substr( $referrer, 0, 500 ),
                'ref_source'   => $ref_source,
                'device'       => $device_info['device'],
                'browser'      => $device_info['browser'],
                'os'           => $device_info['os'],
                'country'      => $geo['country'],
                'country_name' => $geo['country_name'],
                'ip_hash'      => $ip_hash,
                'hit_time'     => $now,
            ],
            [ '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
        );

        $existing = $wpdb->get_row(
            $wpdb->prepare( "SELECT session_id, hits FROM {$sessions_table} WHERE session_id = %s", $session_id )
        );

        if ( $existing ) {
            $new_hits = (int) $existing->hits + 1;
            $wpdb->update(
                $sessions_table,
                [
                    'last_seen' => $now,
                    'hits'      => $new_hits,
                    'is_bounce' => $new_hits > 1 ? 0 : 1,
                    'country'   => $geo['country'],
                ],
                [ 'session_id' => $session_id ],
                [ '%s', '%d', '%d', '%s' ],
                [ '%s' ]
            );
        } else {
            $wpdb->insert(
                $sessions_table,
                [
                    'session_id' => $session_id,
                    'first_seen' => $now,
                    'last_seen'  => $now,
                    'hits'       => 1,
                    'country'    => $geo['country'],
                    'is_bounce'  => 1,
                ],
                [ '%s', '%s', '%s', '%d', '%s', '%d' ]
            );
        }
    }

    private function parse_ref_source( string $referrer ): string {
        if ( empty( $referrer ) ) {
            return 'Direct';
        }

        $host = strtolower( wp_parse_url( $referrer, PHP_URL_HOST ) ?? '' );
        $host = preg_replace( '/^www\./', '', $host );

        $social = [
            'facebook.com' => 'Facebook', 'fb.com' => 'Facebook',
            'instagram.com' => 'Instagram',
            'tiktok.com' => 'TikTok',
            'youtube.com' => 'YouTube', 'youtu.be' => 'YouTube',
            'twitter.com' => 'Twitter', 'x.com' => 'Twitter',
            'linkedin.com' => 'LinkedIn',
            'pinterest.com' => 'Pinterest',
            'reddit.com' => 'Reddit',
            'zalo.me' => 'Zalo',
        ];

        foreach ( $social as $domain => $name ) {
            if ( str_contains( $host, $domain ) ) {
                return $name;
            }
        }

        $search = [
            'google' => 'Google', 'bing' => 'Bing',
            'yahoo' => 'Yahoo', 'duckduckgo' => 'DuckDuckGo',
            'coccoc' => 'CocCoc', 'baidu' => 'Baidu',
        ];

        foreach ( $search as $keyword => $name ) {
            if ( str_contains( $host, $keyword ) ) {
                return $name;
            }
        }

        return $host ?: 'Other';
    }

    private function parse_device( string $ua ): array {
        $device = 'desktop';
        if ( preg_match( '/(tablet|ipad|playbook|silk)/i', $ua ) ) {
            $device = 'tablet';
        } elseif ( preg_match( '/(mobile|android(?!.*tablet)|iphone|ipod|blackberry|windows phone|opera mini|iemobile)/i', $ua ) ) {
            $device = 'mobile';
        }

        $browser = 'Other';
        $browsers = [
            'Edg' => 'Edge', 'OPR' => 'Opera', 'Opera' => 'Opera',
            'Chrome' => 'Chrome', 'Safari' => 'Safari',
            'Firefox' => 'Firefox', 'MSIE' => 'IE', 'Trident' => 'IE',
        ];
        foreach ( $browsers as $pattern => $name ) {
            if ( str_contains( $ua, $pattern ) ) {
                $browser = $name;
                break;
            }
        }

        $os = 'Other';
        $oses = [
            'Windows NT 10' => 'Windows 10/11', 'Windows NT 6' => 'Windows 7/8',
            'Windows' => 'Windows', 'Android' => 'Android',
            'iPhone' => 'iOS', 'iPad' => 'iPadOS',
            'Mac OS X' => 'macOS', 'Linux' => 'Linux',
        ];
        foreach ( $oses as $pattern => $name ) {
            if ( str_contains( $ua, $pattern ) ) {
                $os = $name;
                break;
            }
        }

        return compact( 'device', 'browser', 'os' );
    }
}
