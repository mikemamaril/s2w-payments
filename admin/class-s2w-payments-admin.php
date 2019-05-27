<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://mikemamaril.com
 * @since      1.0.0
 *
 * @package    S2w_Payments
 * @subpackage S2w_Payments/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    S2w_Payments
 * @subpackage S2w_Payments/admin
 * @author     Mike Mamaril <root@mikemamaril.com>
 */
class S2w_Payments_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $s2w_payments   The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The transient labels used for saving data for each user.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $transient_labels    The current version of this plugin.
	 */
	private $transient_labels;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $s2w_payments      The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$current_user_id = get_current_user_id();

		$this->transient_labels = array(
			'results' => $plugin_name . '-results' . '-' . $current_user_id,
			'dates' => $plugin_name . '-dates' . '-' . $current_user_id
		);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in S2w_Payments_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The S2w_Payments_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name . '-datepicker', plugin_dir_url( __FILE__ ) . 'css/datepicker.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in S2w_Payments_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The S2w_Payments_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name . '-datepicker', plugin_dir_url( __FILE__ ) . 'js/datepicker.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-datepicker-i8n', plugin_dir_url( __FILE__ ) . 'js/datepicker.en.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/script.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Create Admin pages and links
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_menu_page( 
			'S2W Payments', //page title
			'S2W Payments',   //menu title
			'manage_options',  //capability
			$this->plugin_name, //slug
			array($this,'display_payments'), //function
			'dashicons-calendar', //icon url
			'55.5'  // position
		);

		add_submenu_page( 
			$this->plugin_name, //parent slug
			'List Square Payments', // page title 
			'Search Payments', //menu title
			'manage_options', //capabilities
			$this->plugin_name, //menu slug
			array($this,'display_payments') //function
		);
		add_submenu_page( 
			$this->plugin_name, 
			'Square to WooCommerce Settings',
			'Settings',
			'manage_options', 
			$this->plugin_name . '-settings',
			array($this,'display_settings')
		);

		add_submenu_page( 
			$this->plugin_name, 
			'Imported Square to WooCommerce orders',
			'Import to WooCommerce',
			'manage_options', 
			$this->plugin_name . '-import-to-wc',
			array($this,'display_import_to_wc')
		);
	}

	/**
	 * Hide submenu pages from the menu
	 *
	 * @since    1.0.2
	 */
	public function hide_plugin_admin_menu_items() {
		remove_submenu_page( $this->plugin_name , $this->plugin_name . '-import-to-wc' );
	}

	/**
	 * Adds settings link to the plugin page
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name . '-settings' ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);
		return array_merge( $settings_link, $links );
	}

	/**
	 * Create plugin settings page using the settings API
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_settings() {
		if (isset($_GET['settings-updated'])) {
			add_settings_error( $this->plugin_name . '-notices', 'settings-updated', 'Settings Updated', 'updated' );
		}
		
		add_settings_section(
			$this->plugin_name . '_general_settings',  // ID used to identify this section and with which to register options
			'General Settings',  // Title to be displayed on the administration page
			false,    // Callback used to render the description of the section
			$this->plugin_name   // Page on which to add this section of options            
		);

		add_settings_section(
			$this->plugin_name . '_production_settings',  
			'Square Production Settings',  
			false,  
			$this->plugin_name
		);

		add_settings_section(
			$this->plugin_name . '_sandbox_settings',
			'Square Sandbox Settings', 
			false,
			$this->plugin_name     
		);

		$gateways = array();
		$payment_gateways = WC()->payment_gateways->payment_gateways();
		if (is_array($payment_gateways)) {
			foreach($payment_gateways as $gateway_name => $gateway_obj) {
				$gateways[$gateway_name] = ucwords($gateway_name);
			}
		}

		$statuses = array();
		$order_statuses = wc_get_order_statuses();
		if (is_array($order_statuses)) {
			foreach($order_statuses as $k => $v) {
				$statuses[$v] = ucwords($v);
			}
		}

		$fields = array(
			array(
				'uid' => $this->plugin_name . '_environment',
				'label' => __('Environment', $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'select',
				'options' => array(
					'sandbox' => __('Sandbox', $this->plugin_name),
					'production' => __('Production', $this->plugin_name)
				),
				'default' => array( 'sandbox' ),
				'supplemental' => __("Make sure to fill out the required credentials below for the selected environment.", $this->plugin_name)
			),
			array(
				'uid' => $this->plugin_name . '_cache_lifetime',
				'label' => __('Cache Lifetime', $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'select',
				'options' => array(
					'1' => __('1 hour', $this->plugin_name),
					'6' => __('6 hours', $this->plugin_name),
					'12' => __('12 hours', $this->plugin_name),
					'24' => __('24 hours', $this->plugin_name),
					'48' => __('48 hours', $this->plugin_name),
				),
				'helper' => 'hours',
				'default' => array( '1' ),
				'supplemental' => __("Number of hours to keep the cached results.", $this->plugin_name)
			),
			array(
				'uid' => $this->plugin_name . '_disable_ssl_verification',
				'label' => __('SSL Verification', $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'checkbox',
				'options' => array(
					'1' => __('Disable', $this->plugin_name),
				),
				'default' => array( '1' ),
				'helper' => 'Verify SSL when connecting to Square API.',
				'supplemental' => __("Disable this if you do not have an SSL certificate on your domain", $this->plugin_name),
			),
			array(
				'uid' => $this->plugin_name . '_create_customer',
				'label' => __("Imported Customer does't exist", $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'checkbox',
				'options' => array(
					'1' => __('Create Customer', $this->plugin_name),
				),
				'default' => array( '1' ),
				'supplemental' => __("Create a new customer if the customer doesn't exist when importing orders. Orders will <b>not be imported</b> if a user is not found and <i>Allow guest orders</i> is not enabled.", $this->plugin_name),
			),
			array(
				'uid' => $this->plugin_name . '_allow_guest_orders',
				'label' => __("Allow guest orders", $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'checkbox',
				'options' => array(
					'1' => __('Enable', $this->plugin_name),
				),
				'default' => array( '0' ),
				'supplemental' => __("Allow imported orders for non-existent users", $this->plugin_name),
			),
			array(
				'uid' => $this->plugin_name . '_partial_item_match',
				'label' => __("Import a transaction even if not all SKU's are found", $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'checkbox',
				'options' => array(
					'1' => __('Enable', $this->plugin_name),
				),
				'default' => array( '1' ),
				'supplemental' => __("If disabled, a transaction will <b>not be imported</b> if not all SKU's in the Square transaction match with your WooCommerce products", $this->plugin_name)
			),
			array(
				'uid' => $this->plugin_name . '_payment_gateway',
				'label' => __('Payment Gateway', $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'select',
				'options' => $gateways,
				'default' => array( 'square' ),
				'supplemental' => __("The payment gateway used when creating orders.", $this->plugin_name)
			),
			array(
				'uid' => $this->plugin_name . '_order_status',
				'label' => __('Order Status', $this->plugin_name),
				'section' => $this->plugin_name . '_general_settings',
				'type' => 'select',
				'options' => $statuses,
				'default' => array( 'Processing' ),
				'supplemental' => __("The order status used when creating orders.", $this->plugin_name)
			),

			array(
				'uid' => $this->plugin_name . '_production_app_id',
				'label' => __('Application ID', $this->plugin_name),
				'section' => $this->plugin_name . '_production_settings',
				'type' => 'text',
			),
			array(
				'uid' => $this->plugin_name . '_production_access_token',
				'label' => __('Access Token', $this->plugin_name),
				'section' => $this->plugin_name . '_production_settings',
				'type' => 'text',
			),
			array(
				'uid' => $this->plugin_name . '_production_location_id',
				'label' => __('Location ID', $this->plugin_name),
				'section' => $this->plugin_name . '_production_settings',
				'type' => 'text',
			),

			array(
				'uid' => $this->plugin_name . '_sandbox_app_id',
				'label' => __('Application ID', $this->plugin_name),
				'section' => $this->plugin_name . '_sandbox_settings',
				'type' => 'text',
			),
			array(
				'uid' => $this->plugin_name . '_sandbox_access_token',
				'label' => __('Access Token', $this->plugin_name),
				'section' => $this->plugin_name . '_sandbox_settings',
				'type' => 'text',
			),
			array(
				'uid' => $this->plugin_name . '_sandbox_location_id',
				'label' => __('Location ID', $this->plugin_name),
				'section' => $this->plugin_name . '_sandbox_settings',
				'type' => 'text',
			),
		);

		foreach( $fields as $field ){
			add_settings_field( 
				$field['uid'], // ID used to identify the field throughout the plugin
				$field['label'], // label
				array( $this, 'settings_field_callback' ), // callback to render the html
				$this->plugin_name,  // The page on which this option will be displayed
				$field['section'], // section to display the setting
				$field // arguements sent to the callback
			);

			register_setting( 
				$this->plugin_name, // The page on which this option will be displayed
				$field['uid'] // ID used to identify the field throughout the plugin
			);
		}
	}

	/**
	 * Generate the HTML fields for each setting
	 *
	 * @since    1.0.0
	 */
	public function settings_field_callback( $arguments ) {
		$optional_keys = array(
			'options' => false,
			'placeholder' => '',
			'helper' => '',
			'supplemental' => '',
			'default' => '',
		);

		foreach($optional_keys as $key => $val) {
			if (!isset($arguments[$key])) {
				$arguments[$key] = $val;
			}
		}

		$value = get_option( $arguments['uid'] ); // Get the current value, if there is one
		if( ! $value ) { // If no value exists
			$value = $arguments['default']; // Set to our default
		}
	
		// Check which type of field we want
		switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number': {
                printf( '<input size="40" name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
				break;
			}
            case 'textarea': {
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
				break;
			}
            case 'select':
            case 'multiselect': {
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
                }
				break;
			}
            case 'radio':
            case 'checkbox': {
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
				break;
			}
        }
	
		// If there is help text
		if( $helper = $arguments['helper'] ){
			printf( '<span class="helper"> %s</span>', $helper ); // Show it
		}
	
		// If there is supplemental text
		if( $supplimental = $arguments['supplemental'] ){
			printf( '<p class="description">%s</p>', $supplimental ); // Show it
		}
	}


	/**
	 * Render payments page
	 *
	 * @since    1.0.0
	 */
	public function display_payments() {
		$option = get_option($this->plugin_name . '_environment', 'sandbox');
		$environment = (is_array($option)) ? array_pop($option) : $option;

		$environment = ($option = array_reverse(get_option($this->plugin_name . '_environment'))) ? array_pop($option) : 'sandbox';
		$app_id = get_option($this->plugin_name . "_{$environment}_app_id");
		$access_token = get_option($this->plugin_name . "_{$environment}_access_token");
		$location_id = get_option($this->plugin_name . "_{$environment}_location_id");

		$option = get_option($this->plugin_name . '_cache_lifetime', 24);
		$cache_lifetime = (is_array($option)) ? array_pop($option) : $option;

		$option = get_option($this->plugin_name . '_disable_ssl_verification', 0);
		$disable_ssl_verfication = (is_array($option)) ? array_pop($option) : $option;

		$has_credentials = true;

		if (empty($app_id)) { 
			add_settings_error( $this->plugin_name . '-notices', 'invalid-app-id', "No <i>{$environment}</i> Application ID specified", 'error' ); 
			$has_credentials = false;
		}
		if (empty($access_token)) { 
			add_settings_error( $this->plugin_name . '-notices', 'invalid-access-token', "No <i>{$environment}</i> Access Token specified", 'error' ); 
			$has_credentials = false;
		}
		if (empty($location_id)) { 
			add_settings_error( $this->plugin_name . '-notices', 'invalid-location-id', "No <i>{$environment}</i> Location ID specified", 'error' ); 
			$has_credentials = false;
		}

		if ($has_credentials) {
			$plugin_path = trailingslashit(dirname(plugin_dir_path( __FILE__ )));
			require($plugin_path.'includes/vendor/autoload.php');
	
			$defaultApiConfig = new \SquareConnect\Configuration();
			if ($disable_ssl_verfication == 1) {
				$defaultApiConfig->setSSLVerification(FALSE);
			}
			$defaultApiConfig->setAccessToken($access_token);
			$defaultApiClient = new \SquareConnect\ApiClient($defaultApiConfig) ;
	
			$transactionsApiV1 = new \SquareConnect\Api\V1TransactionsApi($defaultApiClient);
			$transactionsApi = new \SquareConnect\Api\TransactionsApi($defaultApiClient);
			$customerssApi = new \SquareConnect\Api\CustomersApi($defaultApiClient);
			
			$results = array();
			
			//make sure we aren't doing any post actions
			if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
				if ( false !== ( $transient = get_transient( $this->transient_labels['results'] ) ) ) {
					$results = $transient;
					//renew cache
					delete_transient( $this->transient_labels['results'] );
					set_transient( $this->transient_labels['results'], $results, $cache_lifetime * HOUR_IN_SECONDS );
				}
				if ( false !== ( $selected_dates = get_transient( $this->transient_labels['dates'] ) ) ) {
					add_settings_error( $this->plugin_name . '-cached', 'cached-results', "Displaying cached results for: {$selected_dates}", 'updated' ); 
					//save dates
					delete_transient( $this->transient_labels['dates'] );
					set_transient( $this->transient_labels['dates'], $selected_dates, $cache_lifetime * HOUR_IN_SECONDS );
				}
			}

			if (isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__))) {
				if (isset($_POST['action'])) {
					switch (strtolower($_POST['action'])) {
						case 'clear cache': {
							$results = array();
							$selected_dates = false;

							delete_transient( $this->transient_labels['results'] );
							delete_transient( $this->transient_labels['dates'] );
							add_settings_error( $this->plugin_name . '-cached', 'cached-results', "Cleared cache.", 'updated' ); 
							break;
						}
						case 'filter': {
							if (isset($_POST['dates']) && !empty($_POST['dates'])) {
								$selected_dates = $_POST['dates'];
								$inputs = array_map('trim', explode('-', $selected_dates));
								
								$start_date = date("Y-m-d 00:00:00", strtotime($inputs[0])); //set start of day
								//set end of day
								$end_date = date("Y-m-d 23:59:59", strtotime($inputs[0])); 
								if (count($inputs) >= 2) { $end_date = date("Y-m-d 23:59:59", strtotime($inputs[1])); }
								
								//set the propoer format for the api
								$start_date = date('c', strtotime($start_date));
								$end_date = date('c', strtotime($end_date));

								try {
									set_time_limit(0);
			
									$payments = array();
									$batch_token = null;
									$stop_loop = false;
									$limit = 150;
			
									while ($stop_loop === false) {				
										list($response, $statusCode, $httpHeader) = $transactionsApiV1->listPaymentsWithHttpInfo($location_id, 'DESC', $start_date, $end_date, $limit, $batch_token);
										if (is_array($response)) {
											$payments = array_merge($payments, $response);
										
											$stop_loop = true;
											
											if (array_key_exists('Link', $httpHeader)) {
												preg_match_all('/<(.*)>/', $httpHeader['Link'], $matches);
												if (isset($matches[1])) {
													$url_parts = parse_url($matches[1][0]);
													if (array_key_exists('query', $url_parts) && !empty($url_parts['query'])) {
														parse_str($url_parts['query'], $query);
														if (array_key_exists('batch_token', $query)) {
															$batch_token = $query['batch_token'];
															$start_date = $query['begin_time'];
															$end_date = $query['end_time'];
															$stop_loop = false;
														}
													}
												}
											}
										} else {
											$stop_loop = true;
										}
									}
			
									$result_count = count($payments);
			
									foreach($payments as $i => $payment) {
										$pay_id = $payment->getId();
			
										$money = $payment->getTotalCollectedMoney();
										$amount = ($money->getAmount() / pow(10, 2));

										$tax_money = $payment->getTaxMoney();
										$tax = ($tax_money->getAmount() / pow(10, 2));
										
										$currency = $money->getCurrencyCode();
										$timestamp = strtotime($payment->getCreatedAt());
								
										$device = $payment->getDevice();
										$source = 'Invoice';
										if (method_exists($device, 'getId') && !empty($device->getId())) {
											$source = 'Point of Sales';
										}
								
										$items = array();
										foreach($payment->getItemizations() as $item) {
											$items[] = array(
												'name' => $item->getName(),
												'quantity' => $item->getQuantity(),
												'sku' => $item->getItemDetail()->getSku(),
												'variation_name' => $item->getItemVariationName(),
												'amount' => $item->getGrossSalesMoney()->getAmount() / pow(10,2),
											);
										}
										$item_count = count($items);;
										
										//get transaction id from payment url
										$txn_id = basename(parse_url($payment->getPaymentUrl(), PHP_URL_PATH));
			
										//get the customer id from the transaction tenders
										$customer = false;
										$customer_name = 'Unknown Customer';
										try {
											$transaction = $transactionsApi->retrieveTransaction($location_id, $txn_id);
											foreach($transaction->getTransaction()->getTenders() as $tender) {
												$customer_id = $tender->getCustomerId();
				
												if (!empty($customer_id)) {
													try {
														$_customer = $customerssApi->retrieveCustomer( $customer_id );
														$_address = $_customer->getCustomer()->getAddress();
														$address = false;
														if (is_object($_address)) {
															$address = array(
																'address_1' => $_address->getAddressLine1(),
																'address_2' => $_address->getAddressLine2() . ' ' . $_address->getAddressLine3(),
																'postcode' => $_address->getPostalCode(),
																'country' => $_address->getCountry(),
																'state' => $_address->getAdministrativeDistrictLevel1(),
																'city' => $_address->getLocality(),
																'company' => $_address->getOrganization(),
																'first_name' => (!empty($_address->getFirstName())) ? $_address->getFirstName() : $_customer->getCustomer()->getGivenName(),
																'last_name' => (!empty($_address->getLastName())) ? $_address->getLastName() : $_customer->getCustomer()->getFamilyName(),
															);
														}
														$customer = array(
															'customer_id' => $customer_id,
															'first_name' => $_customer->getCustomer()->getGivenName(),
															'last_name' => $_customer->getCustomer()->getFamilyName(),
															'nick_name' => $_customer->getCustomer()->getNickname(),
															'email' => $_customer->getCustomer()->getEmailAddress(),
															'phone' => $_customer->getCustomer()->getPhoneNumber(),
															'address' => $address
														);
														$customer_name = sprintf('%s %s', $customer['first_name'], $customer['last_name']);
														break;
													} catch (\SquareConnect\ApiException $e) {
														s2w_log('retrieveCustomer', $e->getResponseBody());
														add_settings_error( $this->plugin_name . '-notices', 'api-error', "Unable to retrieve Square Customer #{$customer_id}.", 'error' ); 
													}
												}
											}
										} catch (\SquareConnect\ApiException $e) {
											s2w_log('retrieveTransaction', $e->getResponseBody());
											add_settings_error( $this->plugin_name . '-notices', 'api-error', "Unable to retrieve Square Transtion #{$txn_id}.", 'error' ); 
										}

										$results[$pay_id] = array(
											'pay_id' => $pay_id,
											'txn_id' => $txn_id,
											'timestamp' => $timestamp,
											'currency' => $currency,
											'amount' => $amount,
											'tax' => $tax,
											'source' => $source,
											
											'items' => $items,
											'item_count' => $item_count,
			
											'customer' => $customer,
											'customer_name' => $customer_name,
										);
									}
			
									//save results
									delete_transient( $this->transient_labels['results'] );
									set_transient( $this->transient_labels['results'], $results, $cache_lifetime * HOUR_IN_SECONDS );
									//save dates
									delete_transient( $this->transient_labels['dates'] );
									set_transient( $this->transient_labels['dates'], $selected_dates, $cache_lifetime * HOUR_IN_SECONDS );
								} catch (\SquareConnect\ApiException $e) {
									s2w_log('listPaymentsWithHttpInfo', $e->getResponseBody());
									add_settings_error( $this->plugin_name . '-notices', 'api-error', "Unable to connect to Square Payments API. Please try again after a few minutes>", 'error' ); 
								}
							} else {
								add_settings_error( $this->plugin_name . '-notices', 'no-input', "No date range specified.", 'error' ); 
							}
							break;
						}
					}
				}
			}
		}

		$nonce = wp_create_nonce(basename(__FILE__));
		include_once( 'partials/payments.php' );
	}

	/**
	 * Render settings page
	 *
	 * @since    1.0.0
	 */
	public function display_settings() {
		include_once( 'partials/settings.php' );
	}

	/**
	 * Render imports page
	 *
	 * @since    1.0.2
	 */
	public function display_import_to_wc() {
		$option = get_option($this->plugin_name . '_create_customer', 1);
		$create_customer = (is_array($option)) ? array_pop($option) : $option;

		$option = get_option($this->plugin_name . '_partial_item_match', 1);
		$partial_item_match = (is_array($option)) ? array_pop($option) : $option;
		
		$option = get_option($this->plugin_name . '_allow_guest_orders', 0);
		$allow_guest_orders = (is_array($option)) ? array_pop($option) : $option;
		
		$option = get_option($this->plugin_name . '_payment_gateway', 'square');
		$payment_gateway_key = (is_array($option)) ? array_pop($option) : $option;
		$payment_gateway = false;
		$payment_gateways = WC()->payment_gateways->payment_gateways();
		if (is_array($payment_gateways) && array_key_exists($payment_gateway_key,$payment_gateways)) {
			$payment_gateway = $payment_gateways[$payment_gateway_key];
		}

		$option = get_option($this->plugin_name . '_order_status', 'Processing');
		$order_status = (is_array($option)) ? array_pop($option) : $option;
		
		$results = get_transient( $this->transient_labels['results'] );
		$response = array();
		if (is_array($results) && count($results)) {
			if (!empty(trim($_GET['ids']))) {
				$ids = array_unique(array_filter(explode(',',$_GET['ids'])));
				if (count($ids)) {
					foreach($ids as $id) {
						$process = array(
							'id' => $id,
							'status' => 'Fail',
							'msg' => array()
						);
						if (array_key_exists($id,$results)) {
							$result = $results[$id];
							$create_order = false;
							$has_customer = false;

							//check if we already imported the order
							$s2w_query = new WP_Query(array(
								'posts_per_page' => '1',
								'post_type' => 'shop_order',
								'post_status' => 'any',
								'meta_query' => array(
									'relation' => 'AND',
									array(
										'key' => '_s2w_square_pay_id',
										'value' => $result['pay_id'],
										'compare' => 'LIKE',
									)
								)
							));
							if ($s2w_query->have_posts()) {
								while ($s2w_query->have_posts()) {
									$s2w_query->the_post();
									$order_id = get_the_id();
									$process['msg'][] = __("Transaction <b>{$result['pay_id']}</b> already exists with order #{$order_id} already exists", $this->plugin_name);
									$process['status'] = __("Exists", $this->plugin_name);
								}
							} else {
								//check products by sku first
								$product_ids = array();
								if (count($result['items'])) {
									foreach($result['items'] as $item) {
										if (!empty($item['sku'])) {
											$product_id = wc_get_product_id_by_sku( $item['sku'] );
											if ($product_id) {
												$product_ids[$product_id] = $item['quantity'];
											} else {
												$process['msg'][] = __("No matching SKU (<i>{$item['name']}</i>) found for product: {$item['name']}", $this->plugin_name);	
											}
										} else {
											$process['msg'][] = __("No SKU returned for: {$item['name']}", $this->plugin_name);
										}
									}

									//we have matching wc products, let's create an order
									if (count($product_ids)) { 
										$create_order = true;
										//or not, we if want all items matched
										if (count($result['items']) != count($product_ids) && $partial_item_match != '1') {
											$create_order = false;
											$process['msg'][] = __("Not all SKU's were matched, halting with import. <i>Import a transaction even if not all SKU's are found</i> setting is not enabled. ", $this->plugin_name);
											$process['status'] = __("Fail", $this->plugin_name);
										} else {
											$process['msg'][] = __("Only ".count($product_ids)." SKU's were matched, proceeding with import.", $this->plugin_name);
										}
									} else {
										$process['msg'][] = __("No matching WooCommerce products matched", $this->plugin_name);
									}
								} else {
									$process['msg'][] = __("No items returned for this transaction", $this->plugin_name);
								}

								if ($create_order) {
									//check if we have a square customer
									if (is_array($result['customer'])) {
										$user = get_user_by('email', $result['customer']['email']);
										
										//create a user if we don't find any
										if ($user === false && $create_customer == 1) {
											// random password with 12 chars
											$random_password = wp_generate_password();

											// create new user with email as username & newly created pw
											$user_id = wp_insert_user(array(
												'user_pass' => $random_password,
												'user_login' => $result['customer']['email'],
												'user_email' => $result['customer']['email'],
												'first_name' => $result['customer']['first_name'],
												'last_name' => $result['customer']['last_name'],
												'display_name' => $result['customer']['first_name'] . ' ' .  $result['customer']['last_name'],
												'role' => 'customer', // woocommerce user role
											));

											if (is_numeric($user_id)) {
												$address_fields = array(
													'address_1',
													'address_2',
													'postcode',
													'country',
													'state',
													'city',
													'company',
													'first_name',
													'last_name',

													'email',
													'phone',
												);
												if (is_array($result['customer']['address'])) {
													//append address info from make customer info
													$result['customer']['address']['email'] = $result['customer']['email'];
													$result['customer']['address']['phone'] = $result['customer']['phone'];

													foreach(array('billing','shipping') as $type) {
														foreach($address_fields as $field) {
															update_user_meta( $user_id, "{$type}_{$field}", $result['customer']['address'][$field] );
														}
													}
												}

												$user = get_user_by('ID', $user_id);
												$process['msg'][] = __("Created user id #{$user_id}", $this->plugin_name);
											} else {
												$process['msg'][] = __("unable to create user: {$result['customer']['email']}", $this->plugin_name);
												s2w_log('wp_insert_user', $user_id);
											}
										}

										if ($user === false) {
											if ($allow_guest_orders == '1') {
												$has_customer = true;
												$process['msg'][] = __("No user found for email: {$result['customer']['email']}. Processing as a guest order.", $this->plugin_name);
											} else {
												$process['msg'][] = __("No user found for email: {$result['customer']['email']}. Allow guest orders setting is disabled.", $this->plugin_name);
											}
										} else {
											$has_customer = true;
											$process['msg'][] = __("User {$result['customer']['email']} found with id #{$user->ID}.", $this->plugin_name);
										}
									} else {
										$process['msg'][] = __("No Square customer returned for this transactions", $this->plugin_name);
									}
								}

								//we have our prodcts and user now we can create the order
								if ($has_customer) {
									$user_id = ($user === false) ? null : $user->ID;
									$order = wc_create_order(array(
										'status' => strtolower($order_status),
										'customer_id' => $user_id
									));

									if (is_array($result['customer']['address'])) {
										$address = array(
											'first_name' => $result['customer']['address']['first_name'],
											'last_name'  => $result['customer']['address']['last_name'],
											'company'    => $result['customer']['address']['company'],
											'email'      => $result['customer']['email'],
											'phone'      => $result['customer']['phone'],
											'address_1'  => $result['customer']['address']['address_1'],
											'address_2'  => $result['customer']['address']['address_2'],
											'city'       => $result['customer']['address']['city'],
											'state'      => $result['customer']['address']['state'],
											'postcode'   => $result['customer']['address']['postcode'],
											'country'    => $result['customer']['address']['country'],
										);
										$order->set_address( $address, 'billing' );
										$order->set_address( $address, 'shipping' );
									}
									foreach($product_ids as $product_id => $quantity) {
										$order->add_product( get_product( $product_id ), $quantity); // Use the product IDs to add
									}
									$order->calculate_totals();
									$order->update_meta_data( '_s2w_square_pay_id', $result['pay_id'] );
									//$order->update_status( strtolower($order_status), 'Order created by S2W-Payments - ', TRUE);

									$order_id = $order->save();

									$process['msg'][] = __("Order #{$order_id} created with status: {$order_status}", $this->plugin_name);
									$process['status'] = __("Ok", $this->plugin_name);
								}
							}
						} else {
							$process['msg'][] = __("Transaction not found in search results", $this->plugin_name);
						}
						array_push($response, $process);
					}
				}
			} else {
				add_settings_error( $this->plugin_name . '-import', 'no-results', __("No transactions given.", $this->plugin_name) ); 
			}
		} else {
			add_settings_error( $this->plugin_name . '-import', 'no-results', __("No cached results found.", $this->plugin_name) ); 
		}

		include_once( 'partials/import-to-wc.php' );
	}
}