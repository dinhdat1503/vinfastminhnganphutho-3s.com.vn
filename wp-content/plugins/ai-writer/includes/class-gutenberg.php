<?php
/**
 * Tích hợp Gutenberg Editor Sidebar
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class AI_Writer_Gutenberg {

    public function __construct() {
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
    }

    public function enqueue_editor_assets() {
        wp_enqueue_script(
            'ai-writer-sidebar',
            AI_WRITER_PLUGIN_URL . 'assets/js/ai-sidebar.js',
            [ 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data', 'wp-api-fetch', 'wp-i18n' ],
            AI_WRITER_VERSION,
            true
        );

        wp_localize_script( 'ai-writer-sidebar', 'aiWriterConfig', [
            'restUrl'  => esc_url_raw( rest_url( 'ai-writer/v1/' ) ),
            'nonce'    => wp_create_nonce( 'wp_rest' ),
            'hasApiKey' => ! empty( get_option( 'ai_writer_gemini_api_key' ) ),
            'settingsUrl' => admin_url( 'options-general.php?page=ai-writer-settings' ),
            'language' => get_option( 'ai_writer_language', 'vi' ),
        ] );

        wp_enqueue_style(
            'ai-writer-editor',
            AI_WRITER_PLUGIN_URL . 'assets/css/admin.css',
            [],
            AI_WRITER_VERSION
        );
    }
}
