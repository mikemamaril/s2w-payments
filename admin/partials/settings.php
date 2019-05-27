<div class="wrap">
	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>
	<hr class="wp-header-end">
	<?php settings_errors( $this->plugin_name . '-notices' ); ?>
	<br>

	<form action="options.php" method="POST">
		<?php settings_fields( $this->plugin_name ); ?>
		<?php do_settings_sections( $this->plugin_name ); ?>

		<h2>About</h2>
		<table cellpadding="5" cellspacing="5">
			<tbody>
				<tr>
					<td valign="center">
						<small style="display:block; width:145px; text-align:center; padding-bottom:2px;">Paypal donation link</small>
						<a href="https://www.paypal.me/mikemamaril" target="_blank"><img src="https://www.paypalobjects.com/digitalassets/c/website/marketing/apac/C2/logos-buttons/optimize/44_Blue_PayPal_Pill_Button.png" alt="PayPal" /></a>
					</td>
					<td valign="center">
						<b>Version:</b> <?php echo S2W_PAYMENTS_VERSION; ?><br>
						<b>Author:</b> <a href="https://mikemamaril.com" target="_blank">Mikem mamaril</a>><br>
						<b>Repository:</b> <a href="https://github.com/mikemamaril/s2w-payments" target="_blank">s2w-payments</a><br>
					</td>
				</tr>
			</tbody>
		</table>

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
    </form>
</div>