<?php
/**
 * Include Functionalities and register cli commands
 *
 * @package Sab
 */

namespace Sab\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

use Sab\Admin\Admin;
use Sab\Admin\Requests;
use Sab\Includes\Blocks\Blocks;
use Sab\Includes\Commands\Refresh;

/**
 * Includes Class Wrapper Used throughout the plugin
 */
class Includes {
	
	/**
	 * Run the Includes Class
	 */
	public function run() {
		$this->load_requests();
		$this->load_admin();
		$this->load_commands();
		$this->load_blocks();
	}

	/**
	 * Load Requests Class for API Requests
	 */
	public function load_requests() {
		new Requests();
	}

	/**
	 * Load Admin Class for Admin Page
	 */
	public function load_admin() {
		new Admin();
	}

	/**
	 * Load WP CLI Commands
	 */
	public function load_commands() {
		if ( ! defined( 'WP_CLI' ) || ! WP_CLI || ! class_exists( '\WP_CLI' ) ) { // phpcs:ignore
			return;
		}
	
		$refresh_api_command = new Refresh();
		\WP_CLI::add_command( 'sab', $refresh_api_command );
	}

	/**
	 * Load Blocks Class for Custom Gutenberg Blocks
	 */
	public function load_blocks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		new Blocks();
	}
}
