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
		<li><strong><?php esc_html_e( 'Important Notes', 'rearrange-woocommerce-products' ); ?></strong></li>
		<li>- <?php esc_html_e( 'Use "single click" to select multiple products and drag them.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
		<?php if ( isset( $_GET['current_tab'] ) && ! empty( $_GET['current_tab'] ) && 'sortby-categories' === $_GET['current_tab'] ) {  // phpcs:ignore WordPress.Security.NonceVerification ?>
			<li>- <?php esc_html_e( 'Products arranged below', 'rearrange-woocommerce-products' );?> <strong><?php esc_html_e('will be reset', 'rearrange-woocommerce-products' );?></strong> <?php esc_html_e('after deactivating or deleting the plugin.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
			<?php
		} else {
			;
			?>
			<li>- <?php esc_html_e( 'Products arranged below', 'rearrange-woocommerce-products' );?> <strong><?php esc_html_e('can not be undone');?></strong> <?php esc_html_e('after deactivating or deleting the plugin.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
		<?php } ?>
		<li>- <?php esc_html_e( 'If you are facing any issues, try the ', 'rearrange-woocommerce-products' );?><a href="https://wordpress.org/plugins/rearrange-woocommerce-products/" target="_blank"><?php esc_html_e('troubleshooting', 'rearrange-woocommerce-products' );?></a> <?php esc_html_e('steps first.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
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
