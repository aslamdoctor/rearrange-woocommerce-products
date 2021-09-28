<?php 
$args = array(
  'post_type'         => array( 'product' ),
  'posts_per_page'    => '-1',
  'post_status'       => array('publish'),
  'orderby'           => 'menu_order',
  'order'             => 'ASC',
);

if(isset($_GET['term_id']) && !empty($_GET['term_id'])){
  $term_id = sanitize_text_field($_GET['term_id']);

  $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'terms' => [$term_id],
        'field' => 'id',
        'operator' => 'IN'
      ),
    );
}

$products = new WP_Query( $args );

if ( $products->have_posts() ) :?>
  <div id="rwpp-products-list">
  <?php 
  $serial_no = 1;
  while ( $products->have_posts() ) : $products->the_post();
    global $post;
    $product = wc_get_product( $post->ID );
    include("_product.php");
    $serial_no++;
  endwhile;
  ?>
  </div>
  
  <button id="rwpp-save-orders" class="button-primary"><?php _e('Save Changes', 'rwpp');?></button>

  <div id="rwpp-response"></div>
  <?php 
endif;

wp_reset_postdata();