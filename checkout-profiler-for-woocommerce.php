<?php
/*
 * Plugin Name:       Checkout Profiler for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/checkout-profiler-for-woocommerce/
 * Description:       This plugin tells you how fast your WooCommerce checkout is.
 * Version:           1.0.0
 * Author:            Con
 * Author URI:        https://conschneider.de
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       chprfwlang
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Friendly advice:  namespace declarations in root plugin file will eat plugin settings links functions that don't use namespaces ;). Avoid Namespaces in the plugin root file alltogether. The plugin root file = procedual code for the win.

function chprfw_myplugin_settings_link( $links ) {
    $url = get_admin_url() . 'admin.php';
    $settings_link = '<a href="' . $url . '">' . __('Settings', 'chprfwlang') . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'chprfw_myplugin_settings_link');


/**
 * Plugin version. - https://semver.org
 *
 */
define( 'checkout_profiler_VERSION', '1.0.0' );

/**
 * Activation
 */

function activate_checkout_profiler() {
	// CON\CheckoutProfiler\Controllers\App\CheckoutProfilerActivator::activate();
}


/**
 * Deactivation.
 */
function deactivate_checkout_profiler() {
	// CON\CheckoutProfiler\Controllers\App\CheckoutProfilerDeactivator::deactivate();
}

/**
 * Deinstallation.
 */
function deinstall_checkout_profiler() {

}

/**
* Watch the Namespace syntax. Shoutout:
* https://developer.wordpress.org/reference/functions/register_activation_hook/#comment-2167
*/
// register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_checkout_profiler' );
// register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_checkout_profiler' );
// register_uninstall_hook( __FILE__, __NAMESPACE__ . '\deinstall_checkout_profiler' );
/**
* Instead of: register_activation_hook( __FILE__, 'activate_checkout_profiler' );
* Using the file constant did not work for me.
*/


// include the Composer autoload file
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * Engage.
 */
function run_checkout_profiler() {

	$plugin = new CON\CheckoutProfiler\Controllers\App\CheckoutProfilerPlugin();
	$plugin->run();

}
run_checkout_profiler();