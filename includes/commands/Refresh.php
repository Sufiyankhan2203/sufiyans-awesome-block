<?php
namespace Sab\Includes\Commands;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Refresh {
	public function refresh_api() {
		// Define the transient key used for caching
		$transient_key = 'sab_api_data_cache';

		// Delete the transient to force a refresh on the next AJAX request
		if ( delete_transient( $transient_key ) ) {
			\WP_CLI::success( 'Data refresh forced for the next AJAX request.' );
		} else {
			\WP_CLI::error( 'Failed to delete transient.' );
		}
	   
	}
}
