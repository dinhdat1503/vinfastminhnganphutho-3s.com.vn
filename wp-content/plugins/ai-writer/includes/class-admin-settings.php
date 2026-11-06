<?php
/**
 * Trang Admin Settings cho AI Writer
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class AI_Writer_Admin_Settings {

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_menu' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function add_menu() {
        // Top-level Menu ở Sidebar bên trái Admin
        add_menu_page(
            'AI Writer - Trợ lý viết bài',
            '✨ AI Writer',
            'edit_posts',
            'ai-writer-settings',
            [ $this, 'render_page' ],
            'dashicons-translation',
            25
        );
        // Menu phụ trong Cài đặt (Settings)
        add_options_page(
            'AI Writer Settings',
            '✨ AI Writer',
            'manage_options',
            'ai-writer-settings',
            [ $this, 'render_page' ]
        );
    }

    public function register_settings() {
        register_setting( 'ai_writer_options', 'ai_writer_gemini_api_key',  [ 'sanitize_callback' => 'sanitize_text_field' ] );
        register_setting( 'ai_writer_options', 'ai_writer_language',         [ 'sanitize_callback' => 'sanitize_text_field' ] );
        register_setting( 'ai_writer_options', 'ai_writer_model',            [ 'sanitize_callback' => 'sanitize_text_field' ] );
    }

    public function enqueue_assets( $hook ) {
        if ( $hook !== 'settings_page_ai-writer-settings' ) return;
        wp_enqueue_style( 'ai-writer-admin', AI_WRITER_PLUGIN_URL . 'assets/css/admin.css', [], AI_WRITER_VERSION );
    }

    public function render_page() {
        include AI_WRITER_PLUGIN_DIR . 'templates/settings-page.php';
    }
}
