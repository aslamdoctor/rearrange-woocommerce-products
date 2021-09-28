<?php include("template-parts/_header.php");?>

<div class="notice notice-warning inline top-notice">
  <ul>
    <li><strong>Important Notes</strong></li>
	  <li><?php _e('Press "single click" to select multiple products and drag them.', 'rwpp');?></li>
	  <li><?php _e('Products rearranging can not be undone after deactivating or deleting the plugin.', 'rwpp');?></li>
  </ul>
</div>

<?php 
$args = array(
  'post_type'         => array( 'product' ),
  'posts_per_page'    => '-1',
  'post_status'       => array('publish'),
  'orderby'           => 'menu_order',
  'order'             => 'ASC',
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) :?>
  <div id="rwpp-products-list">
  <?php 
  $serial_no = 1;
  while ( $products->have_posts() ) : $products->the_post();
    global $post;
    $product = wc_get_product( $post->ID );
    include("template-parts/_product.php");
    $serial_no++;
  endwhile;
  ?>
  </div>
  
  <button id="rwpp-get-orders" class="button-primary"><?php _e('Save Changes', 'rwpp');?></button>

  <div id="rwpp-response"></div>
  <?php 
endif;

wp_reset_postdata();
?>

<?php include("template-parts/_footer.php");?>