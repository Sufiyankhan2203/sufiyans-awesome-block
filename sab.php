<?php
/*
 * Plugin Name:       Sab
 * Description:       API Based Plugin. Includes: HTTP Request, AJAX endpoint, Custom Gutenberg Block, Custom WP CLI Command and Admin Page
 * Version:           1.0.0
 * Author:            Sufiyan Khan
 * Author URI:        https://github.com/Sufiyankhan2203
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       Sab
 * Domain Path:       /languages
 * 
 * @package           Sab      
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_FOLDER', plugin_basename( __FILE__ ) );
define( 'PLUGIN_VER', '1.0.0' );

if ( file_exists( PLUGIN_DIR . '/vendor/autoload.php' ) ) {
    require_once PLUGIN_DIR . '/vendor/autoload.php';
}

use Sab\Includes\Includes;
use Sab\Includes\Activate;
use Sab\Includes\Deactivate;

function activate() {
    Activate::activate();
}

function deactivate() {
    Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );

if ( class_exists( 'Sab\Includes\Includes' ) ) {
    $includes = new Includes();
    $includes->run();
}
