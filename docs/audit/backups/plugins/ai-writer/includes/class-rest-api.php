<?php
/**
 * REST API Endpoints cho AI Writer
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class AI_Writer_REST_API {

    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }

    public function register_routes() {
        $namespace = 'ai-writer/v1';

        register_rest_route( $namespace, '/titles', [
            'methods'             => 'POST',
            'callback'            => [ $this, 'get_titles' ],
            'permission_callback' => [ $this, 'check_permission' ],
            'args'                => [
                'topic' => [ 'required' => true, 'type' => 'string', 'sanitize_callback' => 'sanitize_text_field' ],
            ],
        ] );

        register_rest_route( $namespace, '/meta', [
            'methods'             => 'POST',
            'callback'            => [ $this, 'get_meta' ],
            'permission_callback' => [ $this, 'check_permission' ],
            'args'                => [
                'content' => [ 'required' => true, 'type' => 'string' ],
            ],
        ] );

        register_rest_route( $namespace, '/keywords', [
            'methods'             => 'POST',
            'callback'            => [ $this, 'get_keywords' ],
            'permission_callback' => [ $this, 'check_permission' ],
            'args'                => [
                'content'  => [ 'required' => true, 'type' => 'string' ],
                'is_topic' => [ 'required' => false, 'type' => 'boolean', 'default' => false ],
            ],
        ] );

        register_rest_route( $namespace, '/improve', [
            'methods'             => 'POST',
            'callback'            => [ $this, 'improve_text' ],
            'permission_callback' => [ $this, 'check_permission' ],
            'args'                => [
                'text'  => [ 'required' => true, 'type' => 'string' ],
                'style' => [ 'required' => false, 'type' => 'string', 'default' => 'professional' ],
            ],
        ] );

        register_rest_route( $namespace, '/test', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'test_connection' ],
            'permission_callback' => [ $this, 'check_permission' ],
        ] );
    }

    public function check_permission(): bool {
        return current_user_can( 'edit_posts' );
    }

    public function get_titles( WP_REST_Request $request ): WP_REST_Response {
        $api    = new AI_Writer_Gemini_API();
        $result = $api->generate_titles( $request->get_param( 'topic' ) );
        return $this->respond( $result );
    }

    public function get_meta( WP_REST_Request $request ): WP_REST_Response {
        $api    = new AI_Writer_Gemini_API();
        $result = $api->generate_meta( $request->get_param( 'content' ) );
        return $this->respond( $result );
    }

    public function get_keywords( WP_REST_Request $request ): WP_REST_Response {
        $api    = new AI_Writer_Gemini_API();
        $result = $api->suggest_keywords(
            $request->get_param( 'content' ),
            (bool) $request->get_param( 'is_topic' )
        );
        return $this->respond( $result );
    }

    public function improve_text( WP_REST_Request $request ): WP_REST_Response {
        $api    = new AI_Writer_Gemini_API();
        $result = $api->improve_text(
            $request->get_param( 'text' ),
            $request->get_param( 'style' )
        );
        return $this->respond( $result );
    }

    public function test_connection( WP_REST_Request $request ): WP_REST_Response {
        $api    = new AI_Writer_Gemini_API();
        $result = $api->test_connection();
        return new WP_REST_Response( $result, 200 );
    }

    private function respond( $result ): WP_REST_Response {
        if ( is_wp_error( $result ) ) {
            return new WP_REST_Response(
                [ 'success' => false, 'message' => $result->get_error_message() ],
                400
            );
        }
        return new WP_REST_Response(
            [ 'success' => true, 'data' => $result ],
            200
        );
    }
}
