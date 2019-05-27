<?php

/**
 * Square To WooCommerce Payments
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://mikemamaril.com
 * @since             1.0.0
 * @package           S2w_Payments
 *
 * @wordpress-plugin
 * Plugin Name:       Square To WooCommerce Payments
 * Plugin URI:        https://github.com/mikemamaril/s2w-payments
 * Description:       Search fullfilled payments from Square and import them to WooCommerce
 * Version:           1.0.5
 * Author:            Mike Mamaril
 * Author URI:        http://mikemamaril.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       s2w-payments
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'S2W_PAYMENTS_VERSION', '1.0.5' );

/**
 * @param type $data
 * global error logging for the plugin
 */
function s2w_log($type, $data) {
    error_log("[$type] [" . date("Y-m-d H:i:s") . "] " . print_r($data, true) . "\n", 3, dirname(__FILE__) . '/logs.log');
}

if( ! class_exists( 'S2W_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}
$updater = new S2W_Updater( __FILE__ );
$updater->set_username( 'mikemamaril' );
$updater->set_repository( 's2w-payments' );
$updater->initialize();

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-s2w-payments-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-s2w-payments-activator.php';
	S2w_Payments_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-s2w-payments-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-s2w-payments-deactivator.php';
	S2w_Payments_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-s2w-payments.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new S2w_Payments();
	$plugin->run();

}
run_plugin_name();
