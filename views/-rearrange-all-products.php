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

<?php if ( ! ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'rwpp-troubleshooting-page' === $_GET['page'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification; ?>
<div class="notice notice-warning inline top-notice">
	<ul>
		<li><strong><?php esc_html_e( 'Important Notes', 'rearrange-woocommerce-products' ); ?></strong></li>
		<li>- <?php esc_html_e( 'Use "single click" to select multiple products and drag them.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
		<?php if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'rwpp-sortby-categories-page' === $_GET['page'] ) {  // phpcs:ignore WordPress.Security.NonceVerification ?>
			<li>- <?php esc_html_e( 'Products arranged below', 'rearrange-woocommerce-products' );?> <strong><?php esc_html_e('will be reset', 'rearrange-woocommerce-products' );?></strong> <?php esc_html_e('after deactivating or deleting the plugin.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
			<?php
		} else {
			;
			?>
			<li>- <?php esc_html_e( 'Products arranged below', 'rearrange-woocommerce-products' );?> <strong><?php esc_html_e('can not be undone');?></strong> <?php esc_html_e('after deactivating or deleting the plugin.', 'rearrange-woocommerce-products' ); // phpcs:ignore ?></li>
		<?php } ?>
	</ul>
</div>
<?php endif; ?>

<input type="hidden" name="rwpp_current_page_url" id="rwpp_current_page_url" value="<?php echo isset( $_SERVER['REQUEST_URI'] ) ? esc_attr( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized ?>">

	<?php
	if ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'rwpp-sortby-categories-page' === $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification
		include 'template-parts/-tab-category-products.php';
		if ( isset( $_GET['term_id'] ) && ! empty( $_GET['term_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			include 'template-parts/-tab-all-products.php';
		}
	} elseif ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'rwpp-troubleshooting-page' === $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification
		include 'template-parts/-tab-troubleshooting.php';
	} else {
		include 'template-parts/-tab-all-products.php';
	}
	?>

	<?php require 'template-parts/-footer.php'; ?>
