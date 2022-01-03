<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$selected = 0;
if (isset($_GET['term_id']) && !empty($_GET['term_id'])) {
    $selected = sanitize_text_field($_GET['term_id']);
}

wp_dropdown_categories(
    array(
        'name' => 'rwpp_product_category',
        'id' => 'rwpp_product_category',
        'value_field' => 'term_id',
        'taxonomy' => 'product_cat',
        'hierarchical' => true,
        'required' => true,
        'show_option_none' => __('Select Product Category'),
        'option_none_value' => '',
        'orderby' => 'name',
        'selected' => $selected,
    )
);

if (true) {
    echo 'welcome';
    echo 'welcome 123';
}
