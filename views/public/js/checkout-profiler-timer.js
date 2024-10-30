(function($) {
	'use strict';

	$(document).ready(function() {
		var $startHookSelect = $('#chprfw_start_hook');
		var $customStartHookField = $('#chprfw_custom_start_hook').closest('tr');
		var $endHookSelect = $('#chprfw_end_hook');
		var $customEndHookField = $('#chprfw_custom_end_hook').closest('tr');

		function toggleCustomHookField() {
			if ($startHookSelect.val() === 'custom') {
				$customStartHookField.show();
			} else {
				$customStartHookField.hide();
			}
		}

		function toggleCustomEndHookField() {
			if ($endHookSelect.val() === 'custom') {
				$customEndHookField.show();
			} else {
				$customEndHookField.hide();
			}
		}

		// Run on page load
		toggleCustomHookField();
		toggleCustomEndHookField();

		// Run on change of dropdown
		$startHookSelect.change(function() {
			toggleCustomHookField();
		});

		$endHookSelect.change(function() {
			toggleCustomEndHookField();
		});
	});

})(jQuery);

(function($) {
    // Define the class that handles the timer.
    class CheckoutProfilerTimer {
        constructor() {
            this.startTime = null;
        }

        // Function to start the timer.
        startCheckoutTimer() {
            this.startTime = new Date().getTime();
        }

        // Function to end the timer and calculate the duration.
        endCheckoutTimer(orderId) {
            if (this.startTime) {
                const endTime = new Date().getTime();
                const duration = (endTime - this.startTime) / 1000;

                // Send the checkout duration to the server for logging.
                $.ajax({
                    url: chprfw_ajax_object.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'chprfw_log_checkout_duration',
                        order_id: orderId,
                        duration: duration,
                        security: chprfw_ajax_object.nonce
                    },
                    success: function(response) {
                        console.log('Checkout duration logged successfully.');
                    },
                    error: function(error) {
                        console.error('Failed to log checkout duration:', error);
                    }
                });

                // Reset the start time.
                this.startTime = null;
            }
        }
    }

    // Create an instance of the timer class.
    const checkoutProfilerTimer = new CheckoutProfilerTimer();

    // Hook into the checkout events.
    $(document).ready(function() {
        const { onCheckoutBeforeProcessing, onCheckoutSuccess } = window.wc.wcBlocksCheckout;

        // Subscribe to the before processing event to start the timer.
        onCheckoutBeforeProcessing.subscribe(() => {
            checkoutProfilerTimer.startCheckoutTimer();
            return true; // Must return true to indicate successful observer execution.
        });

        // Subscribe to the checkout success event to end the timer.
        onCheckoutSuccess.subscribe((checkoutData) => {
            const orderId = checkoutData.orderId;
            checkoutProfilerTimer.endCheckoutTimer(orderId);
            return true; // Must return true to indicate successful observer execution.
        });
    });
})(jQuery);
