# s2w-payments

Search fullfilled payments from Square and import them to WooCommerce as orders by matching product SKU's on both Square and WooCommerce.

## Installation
- Create your Square App to get credentials for the plugin here: https://squareup.com/us/en/developers
- Set yout credentials for Sandbox and Production environments in the settings
	- Application ID
	- Access Token
	- Location ID
- **IMPORTANT** Match the item SKU's on both Square and Woocommerce, this is ho the price is calculated on WooCommerce. The payment will not be imported if no matching SKU's are found
- Make sure **set_time_limit()** can be set programmatically to prevent execution timeout errors when making API calls to square

## Requirements
- Wordpress 4.7 or higher
- Woocommerce 3.0 or higher
- PHP 5.7 or higher

## Features
- Filter payments by date range
- Cached API results
- Set Order status for imported ORders
- Create new customers from Square users
- Set different payment method for imported orders
- Allow partial or match all SKU's when importing orders