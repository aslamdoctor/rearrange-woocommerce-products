<?php
/**
 * Master Template
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php require 'template-parts/-header.php'; ?>

<div class="notice notice-warning inline top-notice">
	<ul>
		<li><strong>Important Notes</strong></li>
		<li>- <?php _e( 'Use "single click" to select multiple products and drag them.', 'rwpp' ); // phpcs:ignore ?></li>
		<?php if ( isset( $_GET['current_tab'] ) && ! empty( $_GET['current_tab'] ) && 'sortby-categories' === $_GET['current_tab'] ) {  // phpcs:ignore WordPress.Security.NonceVerification ?>
			<li>- <?php _e( 'Products arranged below <strong>will be reset</strong> after deactivating or deleting the plugin.', 'rwpp' ); // phpcs:ignore ?></li>
			<?php
		} else {
			;
			?>
			<li>- <?php _e( 'Products arranged below <strong>can not be undone</strong> after deactivating or deleting the plugin.', 'rwpp' ); // phpcs:ignore ?></li>
		<?php } ?>
		<li>- <?php _e( 'If you are facing any issues, try the <a href="https://wordpress.org/plugins/rearrange-woocommerce-products/" target="_blank">troubleshooting</a> steps first.', 'rwpp' ); // phpcs:ignore ?></li>
	</ul>
</div>

<input type="hidden" name="rwpp_current_page_url" id="rwpp_current_page_url" value="<?php echo isset( $_SERVER['REQUEST_URI'] ) ? esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized ?>">

<?php
if ( isset( $_GET['current_tab'] ) && ! empty( $_GET['current_tab'] ) && 'sortby-categories' === $_GET['current_tab'] ) { // phpcs:ignore WordPress.Security.NonceVerification
	include 'template-parts/-tab-category-products.php';
	if ( isset( $_GET['term_id'] ) && ! empty( $_GET['term_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		include 'template-parts/-tab-all-products.php';
	}
} else {
	include 'template-parts/-tab-all-products.php';
}
?>

<?php require 'template-parts/-footer.php'; ?>
