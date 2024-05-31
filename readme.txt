=== Rearrange Woocommerce Products ===
Contributors: aslamdoctor
Donate link: https://github.com/sponsors/aslamdoctor
Tags: woocommerce, product, reorder, rearrange, sort
Requires at least: 4.6
Tested up to: 6.5.3
Stable tag: 4.3.0
Requires PHP: 7.4.0
License: GPLv3 or later License
URI: http://www.gnu.org/licenses/gpl-3.0.html

Revamp Your Shop Page with Rearrange WooCommerce Products Plugin

== Description ==

Discover the Ultimate Solution to Customize Your Shop Page Sort Order

Enhance your WooCommerce shopping experience with the Rearrange WooCommerce Products plugin. This powerful tool gives you full control over your product sorting, allowing you to tailor the shopping experience to your customers' needs. Whether you need to adjust the default sort order or create custom sorting for specific categories, this plugin has you covered.

Our intuitive "drag and drop" functionality makes reordering your products effortless. Say goodbye to manual sorting - rearrange your products with ease.

Optimize your shop page's sorting order for a smoother navigation experience and increased user engagement. Download Rearrange WooCommerce Products today to revolutionize your product presentation.


== Explore the benefits of Rearrange WooCommerce Products: ==

* Customize your shop page sort order effortlessly.
* Optimize navigation and enhance user engagement.
* Simple "drag and drop" functionality.
* Say goodbye to manual sorting.
* Improve your product presentation and boost sales.

** Before using this plugin, ensure that WooCommerce is properly installed and activated on your website. **

== Important Notes ==

1. If you're using a page builder plugin to showcase your products, please be aware that this plugin may not be compatible. We recommend reaching out to the developers of your page builder plugin for further guidance.
2. It's important to note that once you deactivate or delete the plugin, any rearrangements of all products cannot be reversed.
3. If you're reordering products by categories, please keep in mind that the rearrangements WILL BE reversed upon deactivating or deleting the plugin.

== Installation ==

1. Go to your admin area and select Plugins -> Add new from the menu.
2. Search for "Rearrange Woocommerce Products".
3. Click install.
4. Click activate. If woocommrce is not installed or activated then this plugin will also not activate.
5. Go to Wordpress "Admin > Rearrange Products" and use drag-and-drop functionality to arrange your products.
6. Click on "Sort by Categories" tab to arrange products by Categories.

== Frequently Asked Questions ==

= How do I use this plugin? =

Go to Wordpress "Admin > Rearrange Products" and use drag-and-drop functionality to arrange your products.
Click on "Sort by Categories" tab to arrange products by Categories.

= Can I undo the changes I have made after deactivating or deleting the plugin? =

1. Products rearranging CAN NOT be undone after deactivating or deleting the plugin if you are doing sorting on all products. As it directly updates the "menu_order" property of the products.
2. Products rearranging WILL BE undone after deactivating or deleting the plugin if you are doing sorting on products by categories.

= Can I also update the sort order of products added using woocommerce shortcode ? =

Yes, you can override the default sort order of the products added using shortcode like this `[product_category category="my-category-slug"]`. To do that Go to "Admin > Rearrange Products > Settings" and enable/check the option that says "All Loops (including shortcodes)".

== Troubleshooting ==

**If the sort order you changed is not working on your Shop page, please check below is set properly.**

1. Go to Wordpress Admin > Appearance > Customize
2. Select “Woocommerce” from left and go to “Product Catalogue”
3. Now here check for “Default Product Sorting”.
4. Make sure it is set to “Default sorting (custom ordering + name)”

**If you have huge list of product and the plugin is not saving the sort order changes**

Then it may be issue with PHP configuration done on your server for `memory_limit` and `max_execution_time`.
Ask your web hosting provider to increase `memory_limit` and `max_execution_time` and try updating sort order after that.

This will fix the issue.

== Plugin Demo ==

[youtube https://www.youtube.com/watch?v=3JFmaoYjZyE]


== Screenshots ==

1. The plugin at work reordering all products
2. Ability to select multiple products and sort
3. You can view product info from same page
4. Products sorted by Categories for reordering
5. Shortcut link under Categories section to sort by categories

== ChangeLog ==

= Version 4.3.0 =
* Added settings to enable/disable override main loop or all loops
* tested with wordpress version 6.5.3
* tested with woocommerce version 8.9.1

= Version 4.2.0 =
* Make plugin compatible with HPOS ( High-Performance Order Storage )
* tested with wordpress version 6.4
* tested with woocommerce version 8.2.1

= Version 4.1.7 =
* Fix - under admin, some products not visible while sorting by category
* tested with wordpress version 6.3
* tested with woocommerce version 8.0.1

= Version 4.1.6 =
* Fix enqueue_assets hook not checking hook name properly when site is using different language.
Ref: https://wordpress.org/support/topic/products-are-no-longer-displayed-in-categories/#post-16934448

= Version 4.1.5 =
* Fix sort by "Latest" option not working

= Version 4.1.4 =
* tested with wordpress version 6.2.2
* tested with woocommerce version 7.9.0
* Added fix where products were missing on categories pages
* Added fix where is_product_category() was not working
* other minor bug fixes & cleanup

= Version 4.1.3 =
* tested with wordpress version 6.2.0
* tested with woocommerce version 7.7.0
* moved the plugin pages to top level of admin menu
* bug fixes

= Version 4.1.2 =
* tested with wordpress version 6.1.1
* tested with woocommerce version 7.2.0
* added page for troubleshooting guidelines

= Version 4.1.1 =
* Added translations for:
- English (Canada)
- English (UK)
- French (France)
- Spanish (Colombia)
- Spanish (Venezuela)
- Russian
- Hindi
- Spanish (Ecuador)
- Chinese (China)
- Spanish (Spain)

= Version 4.0.9 =
* added Troubleshooting steps for fix missing products issue
* tested with woocommerce version 6.5.1

= Version 4.0.8 =
* updated all node/npm packages to latest stable version
* tested with wordpress version 5.9.3
* tested with woocommerce version 6.4.1
* added notes for developers for contributing to plugin

= Version 4.0.5 =
* added global translation support

= Version 4.0.4 =
* added plugin translation support

= Version 4.0.3 =
* minor security patch to escape sql query

= Version 4.0.2 =
* minor security patch
* tested with woocommerce version 6.3.1

= Version 4.0.1 =
* delete entries from postmeta table when plugin uninstalled/deleted from admin
* fixed the issue that was making navigation menus unordered

= Version 4.0.0 =
* Fixes made for user roles and permissions checking

= Version 3.0.9 =
* Do not escape post title

= Version 3.0.8 =
* Updated code to follow WPCS Protocol
* Check for plugin authorization properly
* Add CSRF security on Ajax requests

= Version 3.0.7 =
* Security fixes: disable direct code file access from browser

= Version 3.0.6 =
* Minor security fixes

= Version 3.0.5 =
* Security Fixes: Removed nonpriv handlers
* Security Fixes: Added security to remove all SQL injections added as input
* Minor fix for checking product loop inside pre_get_posts hook

= Version 3.0.4 =
* Fixed: While sorting by categories, some products that are added recently were not visible.
* Code re-factoring and cleanup.

= Version 3.0.3 =
* Fixed: Keep default sort order on frontend if it was not updated for Categories.

= Version 3.0.2 =
* Fixed: Category orders not showing any products due to meta_query not found.

= Version 3.0.1 =
* Re-published the files as in v3.0.0, the files were not published properly

= Version 3.0.0 =

* Ability to sort products by any product category
* Ability to select multiple products by single click and sort them at once
* Removed feature to sort by Tags as it was not being used and also had unresolvable bug due to WC limitations
* Tested for Woocommerce Version 5.7.1 and Wordpress Version 5.8.1
* Code cleanup

= Version 2.3.6 =

* Tested for Woocommerce Version 4.8.0 and Wordpress Version 5.6
* Code cleanup

= Version 2.3.5 =

* Tested for Woocommerce Version 4.7.0 and Wordpress Version 5.5.3
* Tested with Storefront Theme Version 2.9.0
* Minor bug fixes with Group by Categories & Tags sorting.
* In group by categories parent category was also including products from child categories. So they were repeated to 2 places. This has been updated to show products exactly below their parent categories only. (changed 'include_children' to "false" in tax_query)
* Styling issue fixed for long product names
* Added button to expand/collapse all categories & tags


= Version 2.3.1 =

* Tested for Woocommerce Version 4.3.1 and Wordpress Version 5.4.2
* Added important notices for sorting by categories and tags


= Version 2.3.0 =

* Added feature to group and sort by Product Tags
* Added feature to move products up, down, top, bottom of the list using arrow buttons
* Added serial numbers(not ID) to each products so it can give us idea on which product's sort order we changed
* Added current user check for "manage_woocommerce" capability
* Plugin information updated to properly show "tested upto" version of Woocommerce
* Added security to disable direct access to the plugin PHP files

= Version 2.2.0 =

* Added expand/collapse feature on categories to clear the clutter
* Fixed a minor bug that was happening while activating the plugin
* Tested for Woocommerce Version 4.0.0 and Wordpress Version 5.3.2

= Version 2.1.2 =

* Hide Products from list that are set as "private"
* Added a fix for bug that was checking the user role
* Tested for Woocommerce Version 3.7.1 and Wordpress Version 5.2.4

= Version 2.1.1 =

* Added shortcut button to edit products
* Tested for Woocommerce Version 3.7.0 and Wordpress Version 5.2.3

= Version 2.0.0 =

* Added feature to group products by categories
* Added feature to preview product info from same page
* Added some minor bug fixes
* Tested for latest Woocommerce version 3.6.3

= Version 1.1.1 =

* Added fix as the plugin was not working for some people. As it was using static table prefix "wp_". So changed it to dynamic table prefix to work will all kind of WP Databases.
* Tested for latest Woocommerce version 3.5.3

= Version 1.1.0 =

* Added capability to handle huge amount of products.
* Combined multiple sql update queries into one query.

= Version 1.0.0 =

* Initial release.
