<?php
/**
 * Activates the plugin
 *
 * @package Sab
 */
namespace Sab\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Activate class
 */
class Activate {

	/**
	 * Activate the plugin
	 *
	 * @return void
	 */
	public static function activate() { // phpcs:ignore
		flush_rewrite_rules(); // phpcs:ignore
	}
}
