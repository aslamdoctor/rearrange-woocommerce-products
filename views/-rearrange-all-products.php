<?php

/**
 * Master Template
 *
 * @package ReWooProducts
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function is_upgrade($product)
{
    $product_cat = get_the_terms($product->ID, 'product_cat');

    foreach ($product_cat as $cat) {
        if ($cat->slug == 'upgrade') {
            return true;
        }
    }

    return false;
}

function is_bestseller($product)
{
    $product_cat = get_the_terms($product->ID, 'product_cat');
    foreach ($product_cat as $cat) {
        if ($cat->slug == 'bestseller') {
            return true;
        }
    }

    return false;
}

?>
<?php require_once 'template-parts/-header.php'; ?>

<div class="notice notice-warning inline top-notice">
    <ul>
        <li><strong><?php esc_html_e('Important Notes', 'rearrange-woocommerce-products'); ?></strong></li>
        <li>-
            <?php
            esc_html_e(
                'Use "single click" to select multiple products and drag them.',
                'rearrange-woocommerce-products'
            );
            ?>
        </li>
        <?php
        if (
            isset($_GET['current_tab']) &&
            !empty($_GET['current_tab']) &&
            'sortby-categories' === $_GET['current_tab']
        ) {
        ?>
        <li>- <?php esc_html_e('Products arranged below', 'rearrange-woocommerce-products'); ?>
            <strong><?php esc_html_e('will be reset', 'rearrange-woocommerce-products'); ?></strong>
            <?php
                esc_html_e(
                    'after deactivating or deleting the plugin.',
                    'rearrange-woocommerce-products'
                );
                ?>
        </li>
        <?php } else {; ?>
        <li>- <?php esc_html_e('Products arranged below', 'rearrange-woocommerce-products'); ?>
            <strong><?php esc_html_e('can not be undone'); ?></strong>
            <?php
                esc_html_e(
                    'after deactivating or deleting the plugin.',
                    'rearrange-woocommerce-products'
                );
                ?>
        </li>
        <?php } ?>
        <li>- <?php esc_html_e('If you are facing any issues, try the ', 'rearrange-woocommerce-products'); ?><a
                href="https://wordpress.org/plugins/rearrange-woocommerce-products/"
                target="_blank"><?php esc_html_e('troubleshooting', 'rearrange-woocommerce-products'); ?></a>
            <?php
            esc_html_e(
                'steps first.',
                'rearrange-woocommerce-products'
            );
            ?>
        </li>
    </ul>
</div>

<input type="hidden" name="rwpp_current_page_url" id="rwpp_current_page_url"
    value="<?php echo isset($_SERVER['REQUEST_URI']) ? esc_attr(wp_unslash($_SERVER['REQUEST_URI'])) : ''; ?>">
<div class="rwpp-content-container">
    <div>
        <?php
        if (
            isset($_GET['current_tab']) &&
            !empty($_GET['current_tab']) &&
            'sortby-categories' === $_GET['current_tab']
        ) {
            include_once 'template-parts/-tab-category-products.php';
            if (isset($_GET['term_id']) && !empty($_GET['term_id'])) {
                include_once 'template-parts/-tab-all-products.php';
            }
        } else {
            include_once 'template-parts/-tab-all-products.php';
        }
        ?>
    </div>
    <aside class=" rwpp-fixed-button-container">
        <button id="rwpp-sort-by-price" class="rwpp-button">Sort By Price</button>
        <button id="rwpp-upgrades-bottom" class="rwpp-button">Upgrades to bottom</button>
        <button id="rwpp-best-top" class="rwpp-button">Best Product to the top</button>
        <button id="rwpp-save-orders"
            class="button-primary"><?php esc_html_e('Save Changes', 'rearrange-woocommerce-products'); ?></button>
    </aside>
</div>