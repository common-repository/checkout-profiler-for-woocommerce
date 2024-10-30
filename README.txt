=== Checkout Profiler for WooCommerce  ===
Contributors: conschneider
Tags: checkout, performance, profiler, speed, debug
Requires at least: 5.2
Tested up to: 6.5
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Wondering whether your WooCommerce checkout is slow? This plugin will tell you.

== Description ==

This plugin measures the time it takes your checkout to load using hooks. All events are logged to files via the WooCommerce Logger Class. View them via WooCommerce >> Status >> Logs.
The WooCommerce Block Checkout is not yet supported. You must use the classic shortcode based checkout for now.

## Feature list

* Timer function for WooCommerce Shortcode Checkout aka Classic Checkout.

## Roadmap

* Timer function for WooCommerce Blocks Checkout

### Documentation and Support

More documentation at my website. https://conschneider.de/checkout-profiler-for-woocommerce/

== Installation ==

1. Upload `checkout-profiler.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to the new main menu item to configure: WooCommerce >> Settings >> Profiler.
4. Do a test purchase and go to WooCommerce >> Status >> Logs to see the results.

== Frequently Asked Questions ==

= Does this slow down my website? =

This plugin uses hooks to measure the time it takes to load the checkout for the classic checkout. It then writes the result to the file system. From what I know this has close to zero impact on your website performance.

= Is there block support? =

No. I will try and add this once I have time. Any input welcome.

= Will this work with my theme/pagebuilder/custom checkout? =

You tell me :). As long as the respective hooks are available and fired, this should work.

= Is this like New Relic? =

Of course not. But it pursues a similar goal. New Relic and other APM tools use extensive server side agents to measure the performance of your website and generate reports for you to analyze and find bottlenecks. This plugin is a simple tool to measure the time it takes to load the checkout.

== Screenshots ==

1. Settings.
2. Log file.
3. Log entry.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =

None yet. This is the beginning :).
