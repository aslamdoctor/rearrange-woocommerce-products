<?php
/**
 * Plugin Options
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<h3>Settings</h3>

<form action="options.php" method='post'>
	<?php settings_fields( 'rwpp-settings-group' ); ?>
	<?php do_settings_sections( 'rwpp-settings-group' ); ?>


	<?php $rwpp_effected_loops = esc_attr( get_option( 'rwpp_effected_loops' ) ); ?>

	<table class="form-table" role="presentation">
		<tbody>
			<tr>
				<th scope="row"><?php esc_html_e( 'Effected Loops on Category Page', 'rearrange-woocommerce-products' ); ?></th>
				<td>
					<fieldset class="flex justify-content-start">
						<p class=mr-1>
							<label>
								<input
									name="rwpp_effected_loops"
									type="radio"
									value="0"
									class="tog"
									<?php echo ( empty( $rwpp_effected_loops ) ) ? 'checked' : ''; ?>
								/>
								<?php esc_html_e( 'Main Loop', 'rearrange-woocommerce-products' ); ?>
							</label>
						</p>
						<p>
							<label>
								<input
									name="rwpp_effected_loops"
									type="radio"
									value="1"
									class="tog"
									<?php echo ( ! empty( $rwpp_effected_loops ) ) ? 'checked' : ''; ?>
								/>
								<?php esc_html_e( 'All Loops (including shortcodes)', 'rearrange-woocommerce-products' ); ?>
							</label>
						</p>
						<p>
							e.g. <code>[product_category category="my-category-slug"]</code>
						</p>
					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="submit-btn-wrapper">
		<?php submit_button(); ?>
	</div>


	<?php if ( isset( $_GET['settings-updated'] ) ) : // phpcs:ignore ?>
		<div class="notice notice-success is-dismissible">
		<p><strong><?php esc_html_e( 'Changes have been save.', 'rearrange-woocommerce-products' ); ?></strong></p>
		</div>
	<?php endif; ?>

</form>


<br>
<br>
