<?php
/**
 * Product Box
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="rwpp-product" data-id="<?php echo esc_attr( $post->ID ); ?>">

	<div class="rwpp-product-main">
		<span class="rwpp-product-title"><?php echo esc_html( $serial_no ); ?>. <?php the_title(); ?></span>
		<span class="rwpp-product-movement">
			<span class="move-top dashicons dashicons-arrow-up-alt" title="<?php echo esc_attr_e( 'Move to top of list', 'rearrange-woocommerce-products' ); ?>"></span>
			<span class="move-bottom dashicons dashicons-arrow-down-alt" title="<?php echo esc_attr_e( 'Move to bottom of list', 'rearrange-woocommerce-products' ); ?>"></span>
			<span class="move-up dashicons dashicons-arrow-up-alt2" title="<?php echo esc_attr_e( 'Move one step up', 'rearrange-woocommerce-products' ); ?>"></span>
			<span class="move-down dashicons dashicons-arrow-down-alt2" title="<?php echo esc_attr_e( 'Move one step down', 'rearrange-woocommerce-products' ); ?>"></span>
			<span class="view-product-info dashicons dashicons-info" title="<?php echo esc_attr_e( 'View product info', 'rearrange-woocommerce-products' ); ?>"></span>
		</span>
	</div>
	<!-- .rwpp-product-main -->

	<div class="rwpp-product-info">
		<?php echo $product->get_image(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div class="rwpp-product-details">
			<div class="rwpp-product-name"><strong><?php the_title(); ?></strong> (ID: <?php echo esc_html( $post->ID ); ?>)</div>
			<div class="rwpp-product-sku">SKU: <?php echo $product->get_sku(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<div class="rwpp-product-price"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<a href="<?php the_permalink(); ?>" class="button" target="_blank"><?php echo esc_html_e( 'View Product', 'rearrange-woocommerce-products' ); ?></a>
			<a href="<?php echo esc_attr( get_edit_post_link() ); ?>" class="button" target="_blank"><?php echo esc_html_e( 'Edit Product', 'rearrange-woocommerce-products' ); ?></a>
		</div>
	</div>
	<!-- .rwpp-product-info -->
</div>
