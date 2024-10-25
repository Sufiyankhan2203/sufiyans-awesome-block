<?php
namespace Sab\Includes\Blocks;

if( ! defined( 'ABSPATH' ) ) {
    die;
}

class Blocks {
    public function __construct() {
        add_action( 'init', array( $this, 'register_block' ) );
    }

    public function register_block() {
        register_block_type( __DIR__ . '/sab/build' );
    }
}