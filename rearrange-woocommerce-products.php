<?php
/**
 * Plugin Name: Rearrange Woocommerce Products
 * Plugin URI: https://wordpress.org/plugins/rearrange-woocommerce-products/
 * Description: a WordPress plugin to Rearrange Woocommerce Products listed on the Shop page
 * Version: 4.2.0
 * Author: Aslam Doctor
 * Author URI: https://aslamdoctor.com/
 * Developer: Aslam Doctor
 * Developer URI: https://aslamdoctor.com/
 * Text Domain:  rearrange-woocommerce-products
 * Domain Path: /languages
 * Requires at least: 4.6
 *
 * WC requires at least: 4.3
 * WC tested up to: 8.2.1
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define reusable paths for plugin globally
 */
define( 'RWPP_LOCATION', dirname( __FILE__ ) );
define( 'RWPP_LOCATION_URL', plugins_url( '', __FILE__ ) );
define( 'RWPP_BASENAME', plugin_basename( __FILE__ ) );

if ( ! class_exists( 'ReWooProducts' ) ) {
	/**
	 * Main plugin class
	 */
	class ReWooProducts {

		/**
		 * Setup plugin on initializing class object
		 */
		public function __construct() {
			$this->setup_actions();
		}

		/**
		 * Setup Hooks
		 */
		public function setup_actions() {
			register_activation_hook( __FILE__, array( $this, 'activate' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

			add_action( 'admin_init', array( $this, 'check_required_plugin' ) );

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'admin_menu', array( $this, 'register_admin_menus' ) );

			add_action( 'wp_ajax_save_all_order', array( $this, 'save_all_order_handler' ) );
			add_action( 'wp_ajax_save_all_order_by_category', array( $this, 'save_all_order_by_category_handler' ) );

			add_filter( 'product_cat_row_actions', array( $this, 'add_rearrange_link' ), 10, 2 );

			add_action( 'save_post_product', array( $this, 'new_product_added' ), 10, 3 );
			add_action( 'pre_get_posts', array( $this, 'sort_products_by_category' ), 999 );

			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'add_settings_link_under_plugins_page' ) );

			add_action( 'before_woocommerce_init', array( $this, 'declare_hpos_compatibility' ) );
		}

		/**
		 * Activate plugin callback
		 */
		public static function activate() {
		}

		/**
		 * Dectivate plugin callback
		 */
		public static function deactivate() {
		}

		/**
		 * Load plugin text domain for translation purpose
		 *
		 * @return void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'rearrange-woocommerce-products', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Declare HPOS compatibility for the plugin
		 */
		public function declare_hpos_compatibility() {
			if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
				\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
			}
		}


		/**
		 * Add "Rearrange" link under plugins list
		 *
		 * @param [array] $actions Array of actions.
		 * @return array
		 */
		public function add_settings_link_under_plugins_page( $actions ) {
			$plugin_links = array(
				'<a href="' . admin_url( 'admin.php?page=rwpp-page' ) . '">' . esc_html__( 'Rearrange Products', 'rearrange-woocommerce-products' ) . '</a>',
				'<a href="' . admin_url( 'admin.php?page=rwpp-sortby-categories-page' ) . '">' . esc_html__( 'Sort by Categories', 'rearrange-woocommerce-products' ) . '</a>',
			);
			$actions      = array_merge( $plugin_links, $actions );
			return $actions;
		}


		/**
		 * Enqueue CSS and JS files
		 *
		 * @param [String] $hook Standard WordPress hook.
		 */
		public function enqueue_assets( $hook ) {
			if ( ! isset( $_REQUEST['page'] ) ) {
				return;
			}

			$pagenow = sanitize_text_field( $_REQUEST['page'] );

			if ( 'rwpp-page' !== $pagenow && 'rwpp-sortby-categories-page' !== $pagenow && 'rwpp-troubleshooting-page' !== $pagenow ) {
				return;
			}

			// Stylesheets.
			wp_register_style( 'rwpp_css', ( RWPP_LOCATION_URL . '/dist/css/main.css' ), false, '3.0.8' );
			wp_enqueue_style( 'rwpp_css' );

			// Javascripts.
			wp_register_script( 'rwpp_js', ( RWPP_LOCATION_URL . '/dist/js/main.js' ), array( 'jquery', 'jquery-ui-sortable' ), '3.0.8', true );
			wp_localize_script(
				'rwpp_js',
				'rwpp_ajax_var',
				array(
					'url'   => admin_url( 'admin-ajax.php' ),
					'nonce' => wp_create_nonce( 'rwpp-ajax-nonce' ),
				)
			);
			wp_enqueue_script( 'rwpp_js' );
		}

		/**
		 * Check if required plugin is available
		 */
		public function check_required_plugin() {
			// check if woocommerce is installed.
			if ( is_admin() && current_user_can( 'activate_plugins' ) && ! class_exists( 'WooCommerce' ) ) {
				add_action( 'admin_notices', array( $this, 'plugin_notice' ) );

				deactivate_plugins( RWPP_BASENAME );

				if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
					unset( $_GET['activate'] ); // phpcs:ignore WordPress.Security.NonceVerification
				}
			}
		}

		/**
		 * Show plugin activation notice
		 */
		public function plugin_notice() {
			?> <div class="error"><p> <?php esc_html_e( 'Please activate Woocommerce plugin before using', 'rearrange-woocommerce-products' ); ?> <strong><?php esc_html_e( 'Rearrange Woocommerce Products', 'rearrange-woocommerce-products' ); ?></strong> <?php esc_html_e( 'plugin', 'rearrange-woocommerce-products' ); ?>.</p></div>
			<?php
		}

		/**
		 * Register Admin Menus
		 */
		public function register_admin_menus() {
			if ( $this->has_required_permissions() ) {
				$user = wp_get_current_user();
				$role = (array) $user->roles;
				if ( in_array( 'administrator', $role, true ) ) {
					$this->add_pages( 'manage_options' );
				} elseif ( in_array( 'shop_manager', $role, true ) ) {
					$this->add_pages( 'shop_manager' );
				} elseif ( current_user_can( 'manage_woocommerce' ) ) {
					$this->add_pages( 'manage_woocommerce' );
				}
			}
		}

		/**
		 * Add page to admin menu
		 *
		 * @param [String] $role Current User role.
		 */
		public function add_pages( $role ) {
			add_menu_page(
				__( 'Rearrange Products', 'rearrange-woocommerce-products' ),
				__( 'Rearrange Products', 'rearrange-woocommerce-products' ),
				$role,
				'rwpp-page',
				array( $this, 'add_pages_callback' ),
				'dashicons-screenoptions',
				'55.5'
			);

			add_submenu_page(
				'rwpp-page',
				__( 'Sort by Categories', 'rearrange-woocommerce-products' ),
				__( 'Sort by Categories', 'rearrange-woocommerce-products' ),
				$role,
				'rwpp-sortby-categories-page',
				array( $this, 'add_pages_callback' ),
			);

			add_submenu_page(
				'rwpp-page',
				__( 'Troubleshooting', 'rearrange-woocommerce-products' ),
				__( 'Troubleshooting', 'rearrange-woocommerce-products' ),
				$role,
				'rwpp-troubleshooting-page',
				array( $this, 'add_pages_callback' ),
			);
		}

		/**
		 * Callback to add_page
		 */
		public function add_pages_callback() {
			include 'inc/helpers.php';
			include 'views/-rearrange-all-products.php';
		}

		/**
		 * Save All Products sort order
		 */
		public function save_all_order_handler() {
			if ( $this->has_required_permissions() ) {
				if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'rwpp-ajax-nonce' ) ) {
					if ( isset( $_POST['sort_orders'] ) ) {
						$sort_orders = $this->clear_sort_orders( $_POST['sort_orders'] ); // phpcs:ignore

						if ( is_array( $sort_orders ) && count( $sort_orders ) > 0 ) {
							global $wpdb;

							$sql_query = "UPDATE {$wpdb->prefix}posts SET menu_order = ( CASE ";
							$fields_in = '';

							foreach ( $sort_orders as $new_sort_order => $product_id ) {
								$sql_query .= "WHEN ID = '" . intval( $product_id ) . "' AND post_type='product' THEN '" . esc_sql( $new_sort_order ) . "' ";
								$fields_in .= intval( $product_id ) . ',';
							}

							$fields_in = rtrim( $fields_in, ',' );

							$sql_query .= 'ELSE NULL END ) ';
							$sql_query .= "WHERE ID IN ($fields_in) ";

							/*
							echo '<pre>';
							print_r( $sql_query );
							echo '</pre>'; */

							$wpdb->query( $sql_query ); // phpcs:ignore

							echo '<div class="notice notice-success is-dismissible">
							<p><strong>' . esc_html( __( 'All products are rearranged now.', 'rearrange-woocommerce-products' ) ) . '</strong></p>
							</div>';
						}
					}
				}
			}

			wp_die();
		}

		/**
		 * Additional security to escape sort order data
		 *
		 * @param [Array] $sort_orders Sortorders to update.
		 */
		public function clear_sort_orders( $sort_orders ) {

			if ( isset( $sort_orders ) ) {
				$keys = array_keys( $sort_orders );
				if ( $keys === array_filter( $keys, 'is_numeric' ) ) {
					$sort_orders = array_combine(
						array_map( 'intval', $keys ),
						array_values( $sort_orders )
					);
				}
			}

			$sort_orders = isset( $sort_orders ) ? array_map( 'sanitize_text_field', wp_unslash( $sort_orders ) ) : array();
			$sort_orders = isset( $sort_orders ) ? array_map( 'esc_attr', wp_unslash( $sort_orders ) ) : array();
			$sort_orders = array_filter( $sort_orders, 'is_numeric' );

			return $sort_orders;
		}

		/**
		 * Save sort order by category
		 */
		public function save_all_order_by_category_handler() {
			if ( $this->has_required_permissions() ) {
				if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'rwpp-ajax-nonce' ) ) {
					if ( isset( $_POST['sort_orders'] ) && isset( $_POST['term_id'] ) ) {
						$sort_orders = $this->clear_sort_orders( $_POST['sort_orders'] ); // phpcs:ignore

						$sort_orders = isset( $_POST['sort_orders'] ) ?
						array_map( 'sanitize_text_field', wp_unslash( $_POST['sort_orders'] ) ) :
						array();

						$term_id = isset( $_POST['term_id'] ) ? sanitize_text_field( wp_unslash( $_POST['term_id'] ) ) : '';

						if ( is_array( $sort_orders ) && count( $sort_orders ) > 0 ) {
							foreach ( $sort_orders as $new_sort_order => $product_id ) {
								$meta_key   = 'rwpp_sortorder_' . $term_id;
								$meta_value = $new_sort_order;
								update_post_meta( $product_id, $meta_key, $meta_value );
							}

							echo '<div class="notice notice-success is-dismissible">
							<p><strong>' . esc_html( __( 'All products are rearranged now.', 'rearrange-woocommerce-products' ) ) . '</strong></p>
							</div>';
						}
					}
				}
			}
			wp_die();
		}

		/**
		 * Add "Rearrange" link on Product categories under admin
		 *
		 * @param [Array]  $actions Actions.
		 * @param [Object] $term Term object.
		 */
		public function add_rearrange_link( $actions, $term ) {
			$url                       = admin_url( 'admin.php?page=rwpp-page&current_tab=sortby-categories&term_id=' . $term->term_id );
			$actions['rearrange_link'] = '<a href="' . $url . '" class="rearrange_link">' . __( 'Rearrange Products' ) . '</a>';
			return $actions;
		}

		/**
		 * Modify Products loop query to sort by categories
		 *
		 * @param [Object] $query WP_Query variable.
		 */
		public function sort_products_by_category( $query ) {
			if ( isset( $_GET['orderby'] ) && 'date' === $_GET['orderby'] ) {
				return;
			}

			if ( is_tax( 'product_cat' ) && $query->is_main_query() && ! is_admin() ) {
				$term    = get_queried_object();
				$term_id = $term->term_id;
				if ( $term && $term_id ) {
					$meta_key   = 'rwpp_sortorder_' . $term_id;
					$meta_query = array(
						'meta_query' => array(
							'relation' => 'OR',
							array(
								'key'     => $meta_key,
								'compare' => 'EXISTS',
							),
							array(
								'key'     => $meta_key,
								'compare' => 'NOT EXISTS',
							),
						),
					);
					$query->set( 'meta_query', $meta_query );
					$query->set( 'orderby', 'meta_value_num menu_order title' );
					$query->set( 'order', 'ASC' );
				}
			}
		}

		/**
		 * Update products meta
		 *
		 * @param [Integer] $term_id Term ID.
		 */
		public function update_products_meta( $term_id ) {
			global $post;
			$products = new WP_Query(
				array(
					'post_type'      => array( 'product' ),
					'posts_per_page' => '-1',
					'post_status'    => array( 'publish' ),
					'tax_query'      => array( // phpcs:ignore
						array(
							'taxonomy' => 'product_cat',
							'terms'    => array( $term_id ),
							'field'    => 'id',
							'operator' => 'IN',
						),
					),
				)
			);

			if ( $products->have_posts() ) :
				while ( $products->have_posts() ) :
					$products->the_post();
					$meta_key   = 'rwpp_sortorder_' . $term_id;
					$menu_order = $post->menu_order;
					$sort_order = get_post_meta( $post->ID, $meta_key );
					if ( ! $sort_order ) {
						update_post_meta( $post->ID, $meta_key, $menu_order );
					}
				endwhile;
			endif;

			wp_reset_postdata();
		}

		/**
		 * When new product created, add its post meta for sort order (default 0)
		 *
		 * @param [Integer] $post_id Post ID.
		 * @param [Object]  $post Post Object.
		 * @param [Boolean] $update Update.
		 */
		public function new_product_added( $post_id, $post, $update ) {
			$terms = wp_get_post_terms( $post_id, 'product_cat' );

			if ( $terms ) {
				foreach ( $terms as $term ) {
					if ( ! metadata_exists( 'post', $post_id, 'rwpp_sortorder_' . $term->term_id ) ) {
						update_post_meta( $post_id, 'rwpp_sortorder_' . $term->term_id, 0 );
					}
				}
			}
		}

		/**
		 * Check if meta data exists for specific term in post_meta table
		 *
		 * @param [String] $meta_key Meta key.
		 */
		public function meta_field_exists( $meta_key ) {
			global $wpdb;
			$result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='$meta_key'" ); // phpcs:ignore
			if ( $result ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Check if user have permissions
		 */
		public function has_required_permissions() {
			if ( is_user_logged_in() ) {
				$user = wp_get_current_user();
				$role = (array) $user->roles;
				if ( in_array( 'administrator', $role, true ) || in_array( 'shop_manager', $role, true ) || current_user_can( 'manage_woocommerce' ) ) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	$rwpp_plugin_obj = new ReWooProducts();
}
