<?php
/**
 * Admin Class
 *
 * @package Sab
 */

namespace Sab\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

use Sab\Admin\Requests;

/**
 * Admin Class for admin functionalities
 */
class Admin {
	/**
	 * Constructor for the Admin Class
	 * Enqueue assets, add admin pages, add action links, add admin header and footer
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		add_filter( 'plugin_action_links_' . PLUGIN_FOLDER, array( $this, 'action_links' ), 10, 1 );
		add_action( 'in_admin_header', array( $this, 'admin_header' ) );
		add_action( 'in_admin_footer', array( $this, 'admin_footer' ) );
	}

	/**
	 * Enqueue assets
	 */
	public function enqueue_assets() {
		$current_screen = get_current_screen();
		if ( ! strpos( $current_screen->base, 'Sab' ) ) {
			return;
		}

		wp_enqueue_style( 'sab_style', plugins_url( '/assets/css/admin-style.css', __DIR__ ), array(), PLUGIN_VER );
	}

	/**
	 * Add admin pages
	 */
	public function add_admin_pages() {
		add_menu_page(
			esc_html__( 'Sufiyan\'s Awesome Block', 'Sab' ),
			esc_html__( 'Sufiyan\'s Awesome Block', 'Sab' ),
			'read',
			'Sab',
			array( $this, 'admin_index' ),
			'dashicons-rest-api',
			110
		);
	}

	/**
	 * Admin index page
	 */
	public function admin_index() {
		$api_request   = new Requests();
		$api_json_data = $api_request->api_json_data();
		?>
		<div class="lds-roller">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
		<div id="sab-admin-content" class="wrap">
			<form method="post" action="options.php">
				<div class="sab-section-heading">
					<h2>
						<?php esc_html_e( 'Listing Data', 'Sab' ); ?>
					</h2>
				</div>

				<?php if ( $api_json_data ) { ?>
					<div class="sab-section-row">
						<table class="form-table sab-list-table">
							<tr valign="top">
								<?php
								foreach ( $api_json_data->data->headers as $header ) {
									?>
									<th scope="row">
										<?php echo esc_html( $header ); ?>
									</th>
									<?php
								}
								?>
							</tr>
							<?php
							$max_items = count( (array) $api_json_data->data->rows );
							for ( $i = 1; $i <= $max_items; $i++ ) {
								?>
								<tr valign="top" class="<?php echo esc_attr( 'row ' . $i ); ?>">
									<?php
									foreach ( $api_json_data->data->rows->$i as $key => $row ) {
										?>
										<td class="<?php echo esc_attr( $key . '-' . $i ); ?>">
											<?php echo esc_html( $row ); ?>
										</td>
										<?php
									}
									?>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
					<?php
				} else {
					esc_html_e( 'No data available. Plase, update the API URL', 'Sab' );
				}
				?>
				<div class="sab-section-heading">
					<h2>
						<?php esc_html_e( 'API Data', 'Sab' ); ?>
					</h2>
				</div>
				<div class="sab-section-row">
					<table class="form-table ">
						<tr valign="top">
							<th scope="row">
								<?php esc_html_e( 'Refresh API data', 'Sab' ); ?>
							</th>
							<td>
								<button id="sab-refresh-data" class="button button-primary">
									<?php esc_html_e( 'Refresh', 'Sab' ); ?>
								</button>
							</td>
						</tr>
					</table>
				</div>
			</form>
		</div>
		<?php
	}

	/**
	 * Admin header
	 */
	public function admin_header() {
		$current_screen = get_current_screen();
		if ( ! strpos( $current_screen->base, 'Sab' ) ) {
			return;
		}
		?>

		<div id="sab-admin-header">
			<h1>
				<?php esc_html_e( 'API Plugin', 'Sab' ); ?>
			</h1>
		</div>
		<?php
	}

	/**
	 * Admin footer
	 */
	public function admin_footer() {
		$current_screen = get_current_screen();
		if ( ! strpos( $current_screen->base, 'Sab' ) ) {
			return;
		}
		?>

		<div class="sab-admin-footer">
			<p>
				<?php esc_html_e( 'Made by Sufiyan Khan', 'Sab' ); ?>
			</p>
			<ul class="sab-admin-footer__links">
				<li>
					<a href="https://www.linkedin.com/in/sufiyan-khan-76b77291/" target="_Blank">LinkedIn</a>
				</li>
				<li> / </li>
				<li>
					<a href="https://github.com/Sufiyankhan2203" target="_Blank">Github</a>
				</li>
			</ul>
		</div>
		<?php
	}

	/**
	 * Add action links
	 *
	 * @param array $links Plugin action links.
	 * @return array
	 */
	public function action_links( $links ) {
		$url           = 'admin.php?page=Sab';
		$settings_link = '<a href="' . esc_url( $url ) . '">' . esc_html__( 'API Data', 'Sab' ) . '</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}
