<?php
namespace Sab\Admin;

if( ! defined( 'ABSPATH' ) ) {
    die;
}

class Requests {
    public function __construct() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'rest_api_init', array( $this, 'create_rest_endpoint' ) );
        add_action( 'wp_ajax_refresh_api_data', array( $this, 'refresh_api_data' ) );
        add_action( 'wp_ajax_nopriv_refresh_api_data', array( $this, 'refresh_api_data' ) );
    }

    public function enqueue_assets() {
        $current_screen = get_current_screen();
        if ( ! strpos( $current_screen->base, 'Sab' ) ) {
            return;
        }

        wp_enqueue_script( 'sab_ajax_script', plugins_url( '/assets/js/ajax-scripts.js', __DIR__ ), array( 'jquery' ), PLUGIN_VER, true );
        wp_localize_script( 
            'sab_ajax_script',
            'sab_ajax_object', 
            array( 
                'ajax_url' => admin_url( 'admin-ajax.php' )
            )
        );
    }

    public function create_rest_endpoint() {
        register_rest_route(
            'sab/v1',
            'data',
            array(
                'methods'             => 'GET',
                'permission_callback' => '__return_true',
                'callback'            => array( $this, 'api_json_data' ),
            )
        );
    }

    public function refresh_api_data() {
        delete_transient( 'sab_api_data_cache' );
        wp_send_json_success( $this->api_json_data() );
        die();
    }

    public function api_json_data() {
        $cache = get_transient( 'sab_api_data_cache' );
        if ( $cache !== false ) {
           return $cache;
        }

        $remote_url = 'https://miusage.com/v1/challenge/1/';

        try {
            $response = wp_safe_remote_get( $remote_url );

            if( ( ! is_wp_error( $response ) ) && ( wp_remote_retrieve_response_code( $response ) === 200 ) ) {
                $response_body = json_decode( $response['body'] );
                set_transient( 'sab_api_data_cache', $response_body, HOUR_IN_SECONDS );
                return $response_body;
            }
        } catch( Exception $e ) {
            return $e->getMessage();
        }
    }
}
