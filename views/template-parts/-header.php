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
		<a href="<?php echo esc_attr( admin_url( 'admin.php?page=rwpp-page' ) ); ?>" class="nav-tab <?php echo ( isset( $_GET['page'] ) && !empty( $_GET['page'] ) && 'rwpp-page' === $_GET['page'] ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Sort by Products', 'rearrange-woocommerce-products' ); ?></a>

		<a href="<?php echo esc_attr( admin_url( 'admin.php?page=rwpp-sortby-categories-page' ) ); ?>" class="nav-tab <?php echo ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'rwpp-sortby-categories-page' === $_GET['page'] ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Sort by Categories', 'rearrange-woocommerce-products' ); ?></a>
		
		<a href="<?php echo esc_attr( admin_url( 'admin.php?page=rwpp-troubleshooting-page' ) ); ?>" class="nav-tab <?php echo ( isset( $_GET['page'] ) && ! empty( $_GET['page'] ) && 'rwpp-troubleshooting-page' === $_GET['page'] ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Troubleshooting', 'rearrange-woocommerce-products' ); ?></a>
		
		<a href="https://github.com/sponsors/aslamdoctor" target="_blank" class="nav-tab"><img src="<?php echo plugin_dir_url( __DIR__ ) . '../img/icon-tea.png'; ?>." alt=""><?php esc_html_e( 'Sponsor me', 'rearrange-woocommerce-products' ); ?></a>
	</h2>
