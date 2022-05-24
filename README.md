# Rearrange Woocommerce Products

Rearrange Woocommerce Products is a WordPress Plugin that allows you to **rearrange/reorder** the default sort order of the products on Woocommerce Shop Page. It also allows to rearrange products based on specific category.

This is very easy to use plugin with **drag & drop** functionality to rearrange the products.

## Features

- Ability to sort products using drag-n-drop feature.
- Ability to sort products by any specific product category
- Ability to select multiple products by single click and sort them at once.

To use this plugin, please make sure that Woocommerce is installed and Activated.

## Important Notes

1. If you are using any page builder plugin to display Products, this plugin may not work. Advice to consult page builder plugin developers for same.

2. Products rearranging CAN NOT be undone after deactivating or deleting the plugin if you are doing sorting on all products.

3. Products rearranged by Category WILL BE undone after deactivating or deleting the plugin.

## Troubleshooting

If the sort order you changed is not working on your Shop page, please check below is set properly.

1. Go to `WordPress Admin > Appearance > Customize`
2. Select `Woocommerce` from left and go to `Product Catalogue`
3. Now here check for `Default Product Sorting`.
4. Make sure it is set to `Default sorting (custom ordering + name)`

If you have huge list of product and the plugin is not saving the sort order changes then it may be issue with PHP configuration done on your server for `memory_limit` and `max_execution_time`.

Ask your web hosting provider to increase `memory_limit` and `max_execution_time` and try updating sort order after that.

This will fix the issue.

## Plugin Demo

[![Rearrange Woocommerce Products - Demo - WordPress Plugin](https://img.youtube.com/vi/3JFmaoYjZyE/0.jpg)](https://www.youtube.com/watch?v=3JFmaoYjZyE "Rearrange Woocommerce Products (V3) - Demo - WordPress Plugin")

## Contribute

If you want to fix a bug in the plugin or add new features, feel free to fork this repo and follow the `CONTRIBUTING.md` file for guidelines.
