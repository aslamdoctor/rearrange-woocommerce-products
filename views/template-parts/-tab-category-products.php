<?php
/**
 * List all products based on selected category
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$selected = 0;
if ( isset( $_GET['term_id'] ) && ! empty( $_GET['term_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
	$selected = sanitize_text_field( wp_unslash( $_GET['term_id'] ) ); // phpcs:ignore WordPress.Security.NonceVerification
}

wp_dropdown_categories(
	array(
		'name'              => 'rwpp_product_category',
		'id'                => 'rwpp_product_category',
		'value_field'       => 'term_id',
		'taxonomy'          => 'product_cat',
		'hierarchical'      => true,
		'required'          => true,
		'show_option_none'  => __( 'Select Product Category', 'rearrange-woocommerce-products' ),
		'option_none_value' => '',
		'orderby'           => 'name',
		'selected'          => $selected,
	)
);

