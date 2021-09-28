<?php include("template-parts/_header.php");?>

<div class="notice notice-warning inline top-notice">
  <ul>
    <li><strong>Important Notes</strong></li>
	  <li><?php _e('Press "single click" to select multiple products and drag them.', 'rwpp');?></li>
	  <li><?php _e('Products rearranging can not be undone after deactivating or deleting the plugin.', 'rwpp');?></li>
  </ul>
</div>

<input type="hidden" name="rwpp_current_page_url" id="rwpp_current_page_url" value="<?php echo esc_attr($_SERVER['REQUEST_URI']);?>">

<?php 
if(isset($_GET['current_tab']) && !empty($_GET['current_tab']) && $_GET['current_tab']=='sortby-categories'){
  include("template-parts/_tab_category_products.php");
  if(isset($_GET['term_id']) && !empty($_GET['term_id'])){
    include("template-parts/_tab_all_products.php");
  }
}
else{
  include("template-parts/_tab_all_products.php");
}
?>

<?php include("template-parts/_footer.php");?>