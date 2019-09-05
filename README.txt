=== S2W Payments ===
Contributors: mikemamaril
Donate link: https://www.paypal.me/mikemamaril
Tags: woocommerce, square, import orders
Requires at least: 4.7
Tested up to: 5.2
Stable tag: 1.0.7
Requires PHP: 5.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Search fulfilled payments from Square and import them to WooCommerce as orders by matching product SKU's on both Square and WooCommerce.

== Description ==

Connect to your Square API and filter Payments made and import them into WooCommerce as new orders. This uses 
the official V1 and V2 Square SDK and requires you to create an application to grant access.

== Installation ==

1. Upload `s2w-payments.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create your Square App to get credentials for the plugin here: https://squareup.com/us/en/developers
4. Set yout credentials for Sandbox and Production environments in the settings
	- Application ID
	- Access Token
	- Location ID
5. **IMPORTANT** Match the item SKU's on both Square and Woocommerce, this is ho the price is calculated on WooCommerce. The payment will not be imported if no matching SKU's are found
6. Make sure **set_time_limit()** can be set programmatically to prevent execution timeout errors when making API calls to square

== Frequently Asked Questions ==

= Is this plugin free to use? =

Yes, although I do accept donations.

= Do you provide support? =

No, But I'll update the plugin as my schedule permits.

== Screenshots ==

1. Settings page where you can set environment, API credentials and other settings.
2. Filtered payments page

== Changelog ==

= 1.0 =
* Initial release

= 1.0.5 =
* Submitted to Wordpress.org
* Added assets for plugin submission

= 1.0.7 =
* Plugin is now also available on Wordpress.org https://wordpress.org/plugins/s2w-payments/advanced/

== Upgrade Notice ==

= 1.0.3 =
* Updates fulled from Github

= 1.0.5 =
* Adds a custom meta data to your woocommerce orders