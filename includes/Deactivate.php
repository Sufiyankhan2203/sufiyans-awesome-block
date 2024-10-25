<?php
/**
 * Deactivates the plugin
 *
 * @package Sab
 */

namespace Sab\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Deactivate class
 */
class Deactivate {
	/**
	 * Deactivate the plugin
	 *
	 * @return void
	 */
	public static function deactivate() { // phpcs:ignore
		flush_rewrite_rules(); // phpcs:ignore
	}
}
