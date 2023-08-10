<?php
/**
 * List all products
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$args = array(
	'post_type'      => array( 'product' ),
	'posts_per_page' => '-1',
	'post_status'    => array( 'publish' ),
);

if ( isset( $_GET['term_id'] ) && ! empty( $_GET['term_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
	$term_id = sanitize_text_field( wp_unslash( $_GET['term_id'] ) ); // phpcs:ignore WordPress.Security.NonceVerification

	$meta_key = 'rwpp_sortorder_' . $term_id;

	$args['tax_query'] = array( // phpcs:ignore
		array(
			'taxonomy' => 'product_cat',
			'terms'    => array( $term_id ),
			'field'    => 'id',
			'operator' => 'IN',
		),
	);

	$args['meta_query'] = array(
		'relation' => 'OR',
		array(
			'key'     => $meta_key,
			'compare' => 'EXISTS',
		),
		array(
			'key'     => $meta_key,
			'compare' => 'NOT EXISTS',
		),
	);

	$args['orderby'] = 'meta_value_num menu_order title';
	$args['order']   = 'ASC';
} else {
	$args['orderby'] = 'menu_order title';
	$args['order']   = 'ASC';
}

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>
	<div id="rwpp-products-list">
		<?php
		$serial_no = 1;
		while ( $products->have_posts() ) :
			$products->the_post();
			global $post;
			$product = wc_get_product( $post->ID ); // output escaped via WooCommerce wc_get_product().
			include '-product.php';
			$serial_no++;
endwhile;
		?>
	</div>

	<button id="rwpp-save-orders" class="button-primary"><?php esc_html_e( 'Save Changes', 'rearrange-woocommerce-products' ); ?></button>

	<div id="rwpp-response"></div>
	<?php
endif;

wp_reset_postdata();
