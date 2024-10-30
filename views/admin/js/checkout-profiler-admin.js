(function($) {
	'use strict';

	$(document).ready(function() {
	   // Change the color of the <h2> element containing 'Checkout Profiler Settings'
	   $("h2").each(function() {
		if ($(this).text().indexOf('Checkout Profiler Settings') !== -1) {
			$(this).css("color", "rgb(24, 24, 113)");
		}
		});
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