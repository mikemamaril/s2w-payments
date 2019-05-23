<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<hr class="wp-header-end">
	<?php settings_errors( $this->plugin_name . '-notices' ); ?>
	<br>

	<form action="options.php" method="POST">
		<?php settings_fields( $this->plugin_name ); ?>
		<?php do_settings_sections( $this->plugin_name ); ?>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
    </form>
</div>