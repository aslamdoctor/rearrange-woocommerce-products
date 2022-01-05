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
		<span class="rwpp-product-title"><?php echo esc_html( $serial_no ); ?>. <?php echo esc_html( $post->post_title ); ?></span>
		<span class="rwpp-product-movement">
			<span class="move-top dashicons dashicons-arrow-up-alt" title="Move to top of list"></span>
			<span class="move-bottom dashicons dashicons-arrow-down-alt" title="Move to bottom of list"></span>
			<span class="move-up dashicons dashicons-arrow-up-alt2" title="Move one step up"></span>
			<span class="move-down dashicons dashicons-arrow-down-alt2" title="Move one step down"></span>
			<span class="view-product-info dashicons dashicons-info" title="View product info"></span>
		</span>
	</div>
	<!-- .rwpp-product-main -->

	<div class="rwpp-product-info">
		<?php echo $product->get_image(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<div class="rwpp-product-details">
			<div class="rwpp-product-name"><strong><?php echo esc_html( $post->post_title ); ?></strong> (ID: <?php echo esc_html( $post->ID ); ?>)</div>
			<div class="rwpp-product-sku">SKU: <?php echo $product->get_sku(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<div class="rwpp-product-price"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<a href="<?php the_permalink(); ?>" class="button" target="_blank">View Product</a>
			<a href="<?php echo esc_attr( get_edit_post_link() ); ?>" class="button" target="_blank">Edit Product</a>
		</div>
	</div>
	<!-- .rwpp-product-info -->
</div>
