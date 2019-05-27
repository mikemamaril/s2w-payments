<?php
	class Square_Imports_List_Table extends WP_List_Table {
		function __construct() {
			parent::__construct(array(
				'singular' => 'Imported Order',
				'plural' => 'Imported Orders',
			));
		}

		function column_default($item, $column_name) {
			return $item[$column_name];
		}

		function get_columns() {
			$columns = array(
				'id' => __('Square ID', 's2w-payments'),
				'status' =>  __('Status', 's2w-payments'),
				'msg' =>  __('Message', 's2w-payments'),
			);
			return $columns;
		}
		function get_sortable_columns() {
			$sortable_columns = array(
			);

			return $sortable_columns;
		}

		function get_bulk_actions() {
			$actions = array(
			);
			return $actions;
		}
		function process_bulk_action() {
		}

		function prepare_items($results = array()) {
			if (is_array($results) && count($results)) {
				$items_per_page = 25;

				$columns = $this->get_columns();
				$hidden = array();
				$sortable = $this->get_sortable_columns();

				// here we configure table headers, defined in our methods
				$this->_column_headers = array($columns, $hidden, $sortable);

				$this->items = $results; 
				$result_count = count($results);
				$this->set_pagination_args(array(
					'total_items' => $result_count, // total items defined above
					'per_page' => $items_per_page, // per page constant defined at top of method
					'total_pages' => ceil($result_count / $items_per_page) // calculate pages count
				));
			}
		}

		//custom columns
		function column_msg($item) {
			if (is_array($item['msg']) && count($item['msg'])) {
				$output = '<ul class="s2w-item0list">';
				foreach($item['msg'] as $msg) {
					$output .= sprintf('<li>%1$s</li>',
										$msg
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
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<hr class="wp-header-end">
	<?php settings_errors( $this->plugin_name . '-import' ); ?>

	<form id="persons-table" method="GET">
			<input type="hidden" name="page" value="<?php echo isset($_REQUEST['page']) ? $_REQUEST['page'] : ''; ?>"/>
			<?php
				$table = new Square_Imports_List_Table();
				$table->prepare_items($response);
				$table->display();
			?>
		</form>
</div>