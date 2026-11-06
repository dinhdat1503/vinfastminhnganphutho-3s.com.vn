<?php
/**
 * Geolocation: xác định quốc gia từ IP qua ip-api.com (cached)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class WPInsight_Geo {

    public static function get_country( string $ip ): array {
        if ( get_option( 'wpinsight_enable_geo', '1' ) !== '1' ) {
            return [ 'country' => '??', 'country_name' => '' ];
        }

        if ( self::is_private_ip( $ip ) ) {
            return [ 'country' => 'LO', 'country_name' => 'Local' ];
        }

        $cache_key = 'wpinsight_geo_' . md5( $ip );
        $cached    = get_transient( $cache_key );

        if ( $cached !== false ) {
            return $cached;
        }

        $response = wp_remote_get(
            'http://ip-api.com/json/' . rawurlencode( $ip ) . '?fields=status,country,countryCode',
            [ 'timeout' => 5, 'sslverify' => false ]
        );

        $result = [ 'country' => '??', 'country_name' => '' ];

        if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
            $data = json_decode( wp_remote_retrieve_body( $response ), true );
            if ( isset( $data['status'] ) && $data['status'] === 'success' ) {
                $result = [
                    'country'      => sanitize_text_field( $data['countryCode'] ?? '??' ),
                    'country_name' => sanitize_text_field( $data['country'] ?? '' ),
                ];
            }
        }

        set_transient( $cache_key, $result, DAY_IN_SECONDS );
        return $result;
    }

    public static function get_real_ip(): string {
        $headers = [
            'HTTP_CF_CONNECTING_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_REAL_IP',
            'HTTP_CLIENT_IP',
            'REMOTE_ADDR',
        ];

        foreach ( $headers as $header ) {
            if ( ! empty( $_SERVER[ $header ] ) ) {
                $ip = sanitize_text_field( wp_unslash( $_SERVER[ $header ] ) );
                if ( str_contains( $ip, ',' ) ) {
                    $ip = trim( explode( ',', $ip )[0] );
                }
                if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
                    return $ip;
                }
            }
        }

        return '127.0.0.1';
    }

    private static function is_private_ip( string $ip ): bool {
        return ! filter_var(
            $ip,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
    }
}
