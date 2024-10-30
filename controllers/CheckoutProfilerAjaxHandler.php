<?php
namespace CON\CheckoutProfiler\Controllers;

if ( ! defined( 'WPINC' ) ) {
	die; }


/**
 * Class CheckoutProfilerAjaxHandler
 *
 * @package CON\CheckoutProfiler\Controllers
 */
class CheckoutProfilerAjaxHandler {

	/**
	 * Function to handle Ajax requests from checkout-profiler-timer.js for the WooCommerce Checkout Block
	 * Some day in the future. Not currently used.
	 */
	public function chprfw_log_checkout_duration() {
        check_ajax_referer('chprfw_checkout_nonce', 'security');

        $order_id = isset($_POST['order_id']) ? sanitize_text_field($_POST['order_id']) : '';
        $duration = isset($_POST['duration']) ? sanitize_text_field($_POST['duration']) : '';

        if ($order_id && $duration) {
            $logger = wc_get_logger();
            $context = array('source' => 'chprfw_checkout_profiler');
            $logger->info("Checkout for order {$order_id} took {$duration} seconds.", $context);
        }

        wp_send_json_success('Checkout duration logged.');
    }
}
