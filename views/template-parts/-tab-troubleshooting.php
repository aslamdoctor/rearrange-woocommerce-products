<?php
/**
 * Troubleshooting steps
 *
 * @package ReWooProducts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<h3>Troubleshooting</h3>

<h4>➡️ If the sort order you changed is not working on your Shop page, please check below is set properly.</h4>
<ol>
	<li>Go to <strong>WordPress Admin > Appearance > Customize</strong></li>
	<li>Select “Woocommerce” from left and go to “Product Catalogue”</li>
	<li>Now here check for “Default Product Sorting”.</li>
	<li>Make sure it is set to “Default sorting (custom ordering + name)”</li>
</ol>

<h4>➡️ If you have huge list of product and the plugin is not saving the sort order changes.</h4>
<p>
	Then it may be issue with PHP configuration done on your server for <strong>memory_limit</strong> and <strong>max_execution_time</strong>. <br>
	If you are not sure how to do that, please ask your web hosting provider to increase <strong>memory_limit</strong> and <strong>max_execution_time</strong> and try updating sort order after that.
</p>

<strong>This will fix the issue.</strong>

<hr>

<h3>Important Notes</h3>

<ol>
	<li>If you are using any page builder plugin to display Products, this plugin may not work. Advice to consult page builder plugin developers for same.</li>
	<li>Products rearranging CAN NOT be undone after deactivating or deleting the plugin if you are doing sorting on all products.</li>
	<li>Products rearranging WILL BE undone after deactivating or deleting the plugin if you are doing sorting on products by categories.</li>
</ol>


<br>
<br>
