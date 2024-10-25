<?php
/**
 * Register Custom Blocks
 *
 * @package Sab
 */

namespace Sab\Includes\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Blocks Class
 */
class Blocks {

	/**
	 * Constructor for the Blocks Class
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_block' ) );
	}

	/**
	 * Register Custom Blocks
	 *
	 * @return void
	 */
	public function register_block() {
		register_block_type( __DIR__ . '/sab/build' );
	}
}
