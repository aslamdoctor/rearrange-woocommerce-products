<?php
/**
 * Page Header
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div id="rwpp-container">

	<h1><?php esc_html_e( 'Rearrange Woocommerce Products', 'rearrange-woocommerce-products' ); ?></h1>

	<h2 class="nav-tab-wrapper">
		<a href="<?php echo esc_attr( admin_url( 'edit.php?post_type=product&page=rwpp-page' ) ); ?>" class="nav-tab <?php echo ( ! isset( $_GET['current_tab'] ) || empty( $_GET['current_tab'] ) ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Sort by Products', 'rearrange-woocommerce-products' ); ?></a>

		<a href="<?php echo esc_attr( admin_url( 'edit.php?post_type=product&page=rwpp-page&current_tab=sortby-categories' ) ); ?>" class="nav-tab <?php echo ( isset( $_GET['current_tab'] ) && ! empty( $_GET['current_tab'] ) && 'sortby-categories' === $_GET['current_tab'] ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Sort by Categories', 'rearrange-woocommerce-products' ); ?></a>
		
		<a href="<?php echo esc_attr( admin_url( 'edit.php?post_type=product&page=rwpp-page&current_tab=troubleshooting' ) ); ?>" class="nav-tab <?php echo ( isset( $_GET['current_tab'] ) && ! empty( $_GET['current_tab'] ) && 'troubleshooting' === $_GET['current_tab'] ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Troubleshooting', 'rearrange-woocommerce-products' ); ?></a>
		
		<a href="http://paypal.me/aslamdoctor" target="_blank" class="nav-tab"><img src="<?php echo plugin_dir_url( __DIR__ ) . '../img/icon-tea.png'; ?>." alt=""><?php esc_html_e( 'Buy me a Chai', 'rearrange-woocommerce-products' ); ?></a>
	</h2>
