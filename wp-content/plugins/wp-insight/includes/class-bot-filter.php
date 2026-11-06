<?php
/**
 * Lọc bot, crawler và request không phải người thật
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class WPInsight_Bot_Filter {

    private static array $bot_patterns = [
        'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider',
        'yandexbot', 'sogou', 'exabot', 'facebot', 'ia_archiver',
        'twitterbot', 'linkedinbot', 'whatsapp', 'telegrambot',
        'applebot', 'msnbot', 'teoma', 'dotbot', 'semrushbot',
        'ahrefsbot', 'mj12bot', 'blexbot', 'serpstatbot', 'seokicks',
        'uptimerobot', 'pingdom', 'statuscake', 'gtmetrix',
        'pagespeed', 'lighthouse', 'chrome-lighthouse',
        'python-requests', 'python-urllib', 'go-http-client',
        'java/', 'wget/', 'curl/', 'libwww-perl', 'lwp-trivial',
        'httpclient', 'apache-httpclient', 'okhttp',
        'bot', 'crawl', 'spider', 'scraper', 'fetcher', 'scanner',
        'checker', 'validator', 'monitor', 'harvest', 'extract',
        'wordpress/',
    ];

    public static function is_bot(): bool {
        if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
            return true;
        }

        $ua = strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) );

        foreach ( self::$bot_patterns as $pattern ) {
            if ( str_contains( $ua, $pattern ) ) {
                return true;
            }
        }

        if ( strlen( $ua ) < 10 ) {
            return true;
        }

        return false;
    }

    public static function is_excluded_ip( string $ip ): bool {
        $exclude_list = get_option( 'wpinsight_exclude_ips', '' );
        if ( empty( $exclude_list ) ) {
            return false;
        }

        $ips = array_map( 'trim', explode( "\n", $exclude_list ) );
        return in_array( $ip, $ips, true );
    }

    public static function is_excluded_role(): bool {
        if ( ! is_user_logged_in() ) {
            return false;
        }
        $user          = wp_get_current_user();
        $exclude_roles = (array) get_option( 'wpinsight_exclude_roles', [ 'administrator' ] );

        foreach ( $exclude_roles as $role ) {
            if ( in_array( $role, (array) $user->roles, true ) ) {
                return true;
            }
        }
        return false;
    }
}
