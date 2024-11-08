<?php
namespace CON\CheckoutProfiler\Controllers\App;

use CON\CheckoutProfiler\Controllers\App\CheckoutProfilerLoader; // All actions and filters
use CON\CheckoutProfiler\Controllers\App\CheckoutProfilerI18n; // language
use CON\CheckoutProfiler\Views\CheckoutProfilerAdmin; // admin settings
use CON\CheckoutProfiler\Views\CheckoutProfilerPublic; // views output
use CON\CheckoutProfiler\Controllers\CheckoutProfilerSettings; // settings
use CON\CheckoutProfiler\Controllers\CheckoutProfilerTimer; // timer
use CON\CheckoutProfiler\Controllers\CheckoutProfilerAjaxHandler; // ajax handler

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    CheckoutProfiler
 * @author     oacsTudio <oacsTudio>
 */
class CheckoutProfilerPlugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      CheckoutProfilerLoader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'checkout_profiler_VERSION' ) ) {
			$this->version = checkout_profiler_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'checkout-profiler';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - checkout_profiler_Loader. Orchestrates the hooks of the plugin.
	 * - checkout_profiler_i18n. Defines internationalization functionality.
	 * - checkout_profiler_Admin. Defines all hooks for the admin area.
	 * - checkout_profiler_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		$this->loader = new CheckoutProfilerLoader(); // get Loader instance to make hooks work.
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the CheckoutProfilerI18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new CheckoutProfilerI18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new CheckoutProfilerAdmin( $this->get_plugin_name(), $this->get_version() );
		// Load admin settings
		$checkout_profiler_admin = new CheckoutProfilerSettings();
		$this->loader->add_filter( 'woocommerce_settings_tabs_array', $checkout_profiler_admin, 'chprfw_add_settings_tab', 50 );
		$this->loader->add_filter( 'woocommerce_settings_tabs_chprfw_profiler', $checkout_profiler_admin, 'chprfw_settings_tab' );
		$this->loader->add_filter( 'woocommerce_update_options_chprfw_profiler', $checkout_profiler_admin, 'chprfw_update_settings' );

		// Load timer
		$checkout_profiler_timer = new CheckoutProfilerTimer();
		// get start hook
		$start_hook = get_option( 'chprfw_start_hook' );
		// check if custom hook is set
		if ( 'custom' === $start_hook ) {
			// get custom hook
			$start_hook = get_option( 'chprfw_custom_start_hook' );
		}
		// add start hook
		$this->loader->add_action( $start_hook, $checkout_profiler_timer, 'chprfw_start_checkout_timer' );
		// get end hook
		$end_hook = get_option( 'chprfw_end_hook' );
		// check if custom hook is set
		if ( 'custom' === $end_hook ) {
			// get custom hook
			$end_hook = get_option( 'chprfw_custom_end_hook' );
		}
		// add end hook
		$this->loader->add_action( $end_hook, $checkout_profiler_timer, 'chprfw_end_checkout_timer' );

		// Load admin styles and scripts
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new CheckoutProfilerPublic( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$ajax_handler = new CheckoutProfilerAjaxHandler();
		$this->loader->add_action( 'wp_ajax_chprfw_get_checkout_profiler_data', $ajax_handler, 'chprfw_get_checkout_profiler_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_chprfw_get_checkout_profiler_data', $ajax_handler, 'chprfw_get_checkout_profiler_data' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    CheckoutProfilerLoader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
