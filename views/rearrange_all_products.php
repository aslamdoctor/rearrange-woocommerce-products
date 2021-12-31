<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
?>
<?php include("template-parts/_header.php"); ?>

<div class="notice notice-warning inline top-notice">
  <ul>
    <li><strong>Important Notes</strong></li>
    <li>- <?php _e('Use "single click" to select multiple products and drag them.', 'rwpp'); ?></li>
    <?php if (isset($_GET['current_tab']) && !empty($_GET['current_tab']) && $_GET['current_tab'] == 'sortby-categories') { ?>
      <li>- <?php _e('Products arranged below <strong>will be reset</strong> after deactivating or deleting the plugin.', 'rwpp'); ?></li>
    <?php } else {; ?>
      <li>- <?php _e('Products arranged below <strong>can not be undone</strong> after deactivating or deleting the plugin.', 'rwpp'); ?></li>
    <?php } ?>
    <li>- <?php _e('If you are facing any issues, try the <a href="https://wordpress.org/plugins/rearrange-woocommerce-products/" target="_blank">troubleshooting</a> steps first.', 'rwpp'); ?></li>
  </ul>
</div>

<input type="hidden" name="rwpp_current_page_url" id="rwpp_current_page_url" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">

<?php
if (isset($_GET['current_tab']) && !empty($_GET['current_tab']) && $_GET['current_tab'] == 'sortby-categories') {
  include("template-parts/_tab_category_products.php");
  if (isset($_GET['term_id']) && !empty($_GET['term_id'])) {
    include("template-parts/_tab_all_products.php");
  }
} else {
  include("template-parts/_tab_all_products.php");
}
?>

<?php include("template-parts/_footer.php"); ?>