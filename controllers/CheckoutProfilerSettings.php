<?php
namespace CON\CheckoutProfiler\Controllers;

if ( ! defined( 'WPINC' ) ) {
	die; }


/**
 * Class CheckoutProfilerSettings
 *
 * @package CON\CheckoutProfiler\Controllers
 */
class CheckoutProfilerSettings {
	/**
	 * Add settings tab to WooCommerce settings
	 *
	 * @param array $settings_tabs
	 * @return array
	 */
	public function chprfw_add_settings_tab( $settings_tabs ) {
		$settings_tabs['chprfw_profiler'] = __( 'Profiler', 'chprfwlang' );
		return $settings_tabs;
	}

	/**
	 * Render settings tab content
	 */
	public function chprfw_settings_tab() {
		woocommerce_admin_fields( $this->chprfw_get_settings() );
	}

	/**
	 * Update settings
	 */
	public function chprfw_update_settings() {
		woocommerce_update_options( $this->chprfw_get_settings() );
	}

	/**
	 * Get settings fields
	 *
	 * @return array
	 */
	public function chprfw_get_settings() {
		$settings = array(
			'section_title'     => array(
				'name' => __( 'Checkout Profiler Settings', 'chprfwlang' ),
				'type' => 'title',
				'desc' => 'The Checkout Profiler supports WooCommerce Blocks Checkout and WooCommerce Classic Checkout.',
				'id'   => 'chprfw_section_title',
			),
			'section_description_blocks' => array(
				'name' => __( 'WooCommerce Blocks Checkout', 'chprfwlang' ),
				'type' => 'subtitle',
				'desc' => __( 'WooCommerce Blocks Checkout is automatically detected and uses Javascript Event Listeners, not hooks.<br>You can disregard the below settings. It does not matter what is set.', 'chprfwlang' ),
				'id'   => 'chprfw_section_description_blocks',
			),
			'start_hook'        => array(
				'name'     => __( 'Start Hook', 'chprfwlang' ),
				'type'     => 'select',
				'desc'     => __( 'Select the hook to start with or enter a custom one.', 'chprfwlang' ),
				'id'       => 'chprfw_start_hook',
				'options'  => array(
					'woocommerce_checkout_process' => 'woocommerce_checkout_process (default)',
					'custom'                       => __( 'Custom (Enter below)', 'chprfwlang' ),
				),
				'default'  => 'woocommerce_checkout_process',
				'desc_tip' => true,
				'class'    => 'wc-enhanced-select',
			),
			'custom_start_hook' => array(
				'name'              => __( 'Custom Start Hook', 'chprfwlang' ),
				'type'              => 'text',
				'desc'              => __( 'Enter the custom hook name.', 'chprfwlang' ),
				'id'                => 'chprfw_custom_start_hook',
				'class'             => 'chprfw-custom-hook-field',
				'custom_attributes' => array(
					'data-show-if' => 'custom',
				),
			),
			'end_hook'          => array(
				'name'     => __( 'End Hook', 'chprfwlang' ),
				'type'     => 'select',
				'desc'     => __( 'Select the hook to end with or enter a custom one.', 'chprfwlang' ),
				'id'       => 'chprfw_end_hook',
				'options'  => array(
					'woocommerce_new_order'                 => 'woocommerce_new_order',
					'woocommerce_thankyou'                  => 'woocommerce_thankyou',
					'woocommerce_checkout_order_processed'  => 'woocommerce_checkout_order_processed (default)',
					'custom' => __( 'Custom (Enter below)', 'chprfwlang' ),
				),
				'default'  => 'woocommerce_checkout_update_order_meta',
				'desc_tip' => true,
				'class'    => 'wc-enhanced-select',
			),
			'custom_end_hook'   => array(
				'name'              => __( 'Custom End Hook', 'chprfwlang' ),
				'type'              => 'text',
				'desc'              => __( 'Enter the custom hook name.', 'chprfwlang' ),
				'id'                => 'chprfw_custom_end_hook',
				'class'             => 'chprfw-custom-hook-field',
				'custom_attributes' => array(
					'data-show-if' => 'custom',
				),
			),
			'section_description_classic' => array(
				'name' => __( 'Classic Checkout Hook Settings', 'chprfwlang' ),
				'type' => 'title',
				'desc' => __( 'For the Classic Checkout page. Below is a description of the available PHP hooks.', 'chprfwlang' ),
				'id'   => 'chprfw_section_description_classic',
			),
			'start_hooks_information' => array(
				'name' => __( 'Start Hooks Information', 'chprfwlang' ),
				'type' => 'title',
				'desc' => __( "The <code>woocommerce_checkout_process</code> hook is an action that fires during the checkout process, specifically when the form is being submitted but before the order is created and payment is processed.<br>", 'chprfwlang' ),
				'id'   => 'chprfw_start_hooks_information',
			),
			'end_hooks_information' => array(
				'name' => __( 'End Hooks Information', 'chprfwlang' ),
				'type' => 'title',
				'desc' => __( "<code>woocommerce_new_order</code>: This action hook fires when a new order is created in WooCommerce.<br>It happens just after the order is inserted into the database, but before the order data is saved.<br><br><code>woocommerce_thankyou</code>: This action hook is executed when the thank you page is displayed after an order is completed.<br>It is triggered after the payment has been processed and the order is marked as complete.<br><br><code>woocommerce_checkout_order_processed</code>: This action hook fires after the checkout process is completed and the order is processed, but before the order is transitioned to its final status (e.g., 'processing' or 'completed').<br>", 'chprfwlang' ),
				'id'   => 'chprfw_end_hooks_information',
			),
			'section_end'       => array(
				'type' => 'sectionend',
				'id'   => 'chprfw_section_end',
			),
		);

		return apply_filters( 'chprfw_profiler_settings', $settings );
	}
}
