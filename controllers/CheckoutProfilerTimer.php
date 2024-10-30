<?php
namespace CON\CheckoutProfiler\Controllers;

if ( ! defined( 'WPINC' ) ) {
	die; }


/**
 * Class chprfw_CheckoutProfilerTimer
 *
 * @package CON\CheckoutProfiler\Controllers
 */
class CheckoutProfilerTimer {

	// Function to start the timer.
	public function chprfw_start_checkout_timer() {
		// Start the timer and save the start time in the session.
		WC()->session->set( 'checkout_start_time', microtime( true ) );
	}

	// Function to end the timer and calculate the duration.
	public function chprfw_end_checkout_timer( $order_id ) {
		// Check if we have a start time in the session.
		$start_time = WC()->session->get( 'checkout_start_time' );
		if ( $start_time ) {
			// Calculate the checkout duration.
			$end_time = microtime( true );
			$duration = $end_time - $start_time;

			// Get an instance of the WC_Logger.
			$logger = wc_get_logger();

			// The context for the log.
			$context = array( 'source' => 'checkout-performance' );

			// Check if order_id is an object. If so, get the ID.
			if ( is_object( $order_id ) ) {
                $order_id = $order_id->get_id();
            }

			// Log the checkout duration.
			$logger->info( "Classic Checkout for order {$order_id} took {$duration} seconds.", $context );

			// Optionally, clear the start time from the session.
			WC()->session->__unset( 'checkout_start_time' );
		}
	}
}
