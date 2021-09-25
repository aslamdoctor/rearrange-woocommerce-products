<div id="rwpp-container">
	
	<h1><?php _e('Rearrange Woocommerce Products', 'rwpp');?></h1>

	<h2 class="nav-tab-wrapper">
		<a href="<?php echo admin_url('edit.php?post_type=product&page=rwpp-page');?>" 
		class="nav-tab <?php echo (!isset($_GET['current_tab']) || empty($_GET['current_tab']))?'nav-tab-active':'';?>"
		>Sort by Products</a>
		
		<a href="<?php echo admin_url('edit.php?post_type=product&page=rwpp-page&current_tab=sortby-categories');?>" 
		class="nav-tab <?php echo (isset($_GET['current_tab']) && !empty($_GET['current_tab']) && $_GET['current_tab']=='sortby-categories')?'nav-tab-active':'';?>"
		>Sort by Categories</a>
		
	</h2>
