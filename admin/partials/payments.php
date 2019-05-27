<?php
	class Square_Payments_List_Table extends WP_List_Table {
		function __construct() {
			parent::__construct(array(
				'singular' => 'Square Payment',
				'plural' => 'Square Payments',
			));
		}

		function column_default($item, $column_name) {
			return $item[$column_name];
		}
		function column_cb($item) {
			return sprintf(
				'<input type="checkbox" name="id[]" value="%s" />',
				$item['pay_id']
			);
		}
		function get_columns() {
			$columns = array(
				'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
				'timestamp' => __('TXN Date', 's2w-payments'),
				'amount' =>  __('Amount', 's2w-payments'),
				'customer_name' =>  __('Custome', 's2w-payments'),
				'items' =>  __('Items', 's2w-payments'),
			);
			return $columns;
		}
		function get_sortable_columns() {
			$sortable_columns = array(
				'timestamp' => array('Transaction Date', true),
				'amount' => array('Amount', true),
				'customer_name' => array('Customer', true),
			);

			return $sortable_columns;
		}

		function get_bulk_actions() {
			$actions = array(
				'import2wc' => 'Import to WooCommerce'
			);
			return $actions;
		}
		function process_bulk_action() {
			if ('import2wc' === $this->current_action()) {	
				$ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
				if (is_array($ids)) $ids = implode(',', $ids);
	
				if (!empty($ids)) {
				}	
			}
		}

		function prepare_items($results = array()) {
			if (is_array($results) && count($results)) {
				$items_per_page = 25;

				$columns = $this->get_columns();
				$hidden = array();
				$sortable = $this->get_sortable_columns();

				$paged = isset($_REQUEST['paged']) ? (max(0, intval($_REQUEST['paged']) - 1)) : 0;
				$orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'timestamp';
				$order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';
				$sort_order = ($order == 'asc') ? SORT_ASC : SORT_DESC;

				//sort the array
				$array = array_column($results, $orderby);
				array_multisort($array, $sort_order, $results);


				// here we configure table headers, defined in our methods
				$this->_column_headers = array($columns, $hidden, $sortable);

				// [OPTIONAL] process bulk action if any
				$this->process_bulk_action();
				
				if (isset($_REQUEST['s']) && !empty($_REQUEST['s'])) {
					//$search = array_search(strtolower(sanitize_text_field($_REQUEST['s'])), array_map('strtolower', array_column($results, 'customer_name')));
					//var_dump( $search );
					$s = sanitize_text_field($_REQUEST['s']);
					$search = array();
					foreach($results as $result) {
						if (false !== stripos($result['customer_name'], $s)) {
							array_push($search, $result);
						}
					}
					$results = $search;
				}

				$pagedArray = array_chunk($results, $items_per_page, true); //chop the array into pages
				$this->items = $pagedArray[$paged]; // get the page/chunk specified
				$result_count = count($results);
				$this->set_pagination_args(array(
					'total_items' => $result_count, // total items defined above
					'per_page' => $items_per_page, // per page constant defined at top of method
					'total_pages' => ceil($result_count / $items_per_page) // calculate pages count
				));
			}
		}

		//custom columns
		function column_timestamp($item) {
			$txn_date = null;
			if (!empty($item['timestamp'])) {
				$txn_date = date('F j, Y', $item['timestamp']);
			}

			$actions = array(
				'import2wc' => sprintf('<a href="%3$s&ids=%1$s">%2$s</a>', 
										$item['pay_id'],
										__('Import to WooCommerce'),
										admin_url('admin.php?page=s2w-payments-import-to-wc')
									),
			);
	
			return sprintf(
				'%1$s<br> <small title="Transaction ID"><b>%2$s</b></small> %3$s',
				$txn_date,
				$item['txn_id'],
				$this->row_actions($actions)
			);
		}

		function column_amount($item) {
			$amount = number_format($item['amount'],2,'.',',');
			return sprintf(
				'%1$s %2$s<br> <small>%3$s : %4$s items</small><br> <small>Tax: <b>%5$s %2$s</b></small>',
				$amount,
				$item['currency'],
				$item['source'],
				$item['item_count'],
				number_format($item['tax'],2,'.',',')
			);
		}

		function column_customer_name($item) {
			if ($item['customer'] === false) {
				return 'Unknown Customer';
			} else {
				return sprintf(
					'%1$s %2$s<br> <small><a href="mailto:%3$s">%3$s</a></small><br> <small>%4$s</small>',
					$item['customer']['first_name'],
					$item['customer']['last_name'],
					$item['customer']['email'],
					$item['customer']['phone']
				);
			}
		}

		function column_items($item) {
			if (is_array($item['items']) && count($item['items'])) {
				$output = '<ul class="s2w-item0list">';
				foreach($item['items'] as $it) {
					//"{$item['quantity']}x {$item['name']} ({$item['variation_name']}) {$item['amount']} <br>";
					$output .= sprintf('<li>%3$s x %1$s (<i>%2$s</i>) - <b>%4$s %5$s</b></li>',
										$it['name'], 
										$it['variation_name'], 
										$it['quantity'], 
										number_format($it['amount'],2,'.',','), 
										$item['currency']
									);
				}
				$output .= '</ul>';

				return $output;
			} else {
				return 'No Items';
			}
		}
	}
?>
<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?> (<i><?php echo ucwords($environment); ?></i>)</h2>
	<hr class="wp-header-end">
	<?php settings_errors( $this->plugin_name . '-notices' ); ?>
	<?php settings_errors( $this->plugin_name . '-cached' ); ?>
	<br>
	<?php if ($has_credentials): ?>
		<div class="alignleft actions" style="margin-bottom:16px;">
			<form method="post" name="search-payments" id="search-payments">
				<input type="hidden" name="nonce" value="<?php echo $nonce; ?>"/>
				Filter date range
				<input type="text" id="airdatepicker" name="dates" value="<?php echo (isset($selected_dates)) ? strip_tags($selected_dates) : ''; ?>" readonly="readonly" />
				<input type="submit" name="action" id="s2w-filter-dates" class="button button-primary" value="Filter">
				<input type="submit" name="action" id="s2w-clear-cache" class="button button-secondary delete" value="Clear Cache">
			</form>
		</div>
		<form id="persons-table" method="GET">
			<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : ''; ?>"/>
			<?php
				$table = new Square_Payments_List_Table();
				$table->prepare_items($results);
				$table->search_box('search', 'search_id');
				$table->display();
			?>
		</form>
	<?php endif; ?>
</div>