<?php
/**
 * Quản lý database: tạo bảng, migration, cleanup
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class WPInsight_Database {

    public static function create_tables(): void {
        global $wpdb;
        $charset = $wpdb->get_charset_collate();

        $hits_table     = $wpdb->prefix . WPINSIGHT_TABLE_HITS;
        $sessions_table = $wpdb->prefix . WPINSIGHT_TABLE_SESSIONS;

        $sql_hits = "CREATE TABLE IF NOT EXISTS {$hits_table} (
            id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            session_id  VARCHAR(64)  NOT NULL DEFAULT '',
            post_id     BIGINT UNSIGNED NOT NULL DEFAULT 0,
            url         VARCHAR(500) NOT NULL DEFAULT '',
            page_title  VARCHAR(255) NOT NULL DEFAULT '',
            referrer    VARCHAR(500) NOT NULL DEFAULT '',
            ref_source  VARCHAR(100) NOT NULL DEFAULT 'Direct',
            device      VARCHAR(20)  NOT NULL DEFAULT 'desktop',
            browser     VARCHAR(50)  NOT NULL DEFAULT '',
            os          VARCHAR(50)  NOT NULL DEFAULT '',
            country     VARCHAR(5)   NOT NULL DEFAULT '??',
            country_name VARCHAR(100) NOT NULL DEFAULT '',
            ip_hash     VARCHAR(64)  NOT NULL DEFAULT '',
            hit_time    DATETIME     NOT NULL,
            PRIMARY KEY (id),
            KEY idx_hit_time   (hit_time),
            KEY idx_post_id    (post_id),
            KEY idx_session_id (session_id),
            KEY idx_country    (country)
        ) {$charset};";

        $sql_sessions = "CREATE TABLE IF NOT EXISTS {$sessions_table} (
            session_id  VARCHAR(64)  NOT NULL,
            first_seen  DATETIME     NOT NULL,
            last_seen   DATETIME     NOT NULL,
            hits        INT UNSIGNED NOT NULL DEFAULT 1,
            country     VARCHAR(5)   NOT NULL DEFAULT '??',
            is_bounce   TINYINT(1)   NOT NULL DEFAULT 1,
            PRIMARY KEY (session_id),
            KEY idx_first_seen (first_seen)
        ) {$charset};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql_hits );
        dbDelta( $sql_sessions );

        update_option( 'wpinsight_db_version', WPINSIGHT_VERSION );
    }

    public static function cleanup_old_data(): void {
        global $wpdb;
        $days           = (int) get_option( 'wpinsight_data_retention', 365 );
        $hits_table     = $wpdb->prefix . WPINSIGHT_TABLE_HITS;
        $sessions_table = $wpdb->prefix . WPINSIGHT_TABLE_SESSIONS;

        $wpdb->query(
            $wpdb->prepare(
                "DELETE FROM {$hits_table} WHERE hit_time < DATE_SUB(NOW(), INTERVAL %d DAY)",
                $days
            )
        );

        $wpdb->query(
            "DELETE s FROM {$sessions_table} s
             LEFT JOIN {$hits_table} h ON s.session_id = h.session_id
             WHERE h.session_id IS NULL"
        );
    }

    public static function purge_all_data(): void {
        global $wpdb;
        $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}" . WPINSIGHT_TABLE_HITS );
        $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}" . WPINSIGHT_TABLE_SESSIONS );
    }
}
