<?php
$overstock_listing = new CPT(array(
    'post_type_name' => 'overstock_listing',
    'singular' => 'Overstock Listing',
    'plural' => 'Overstock Listings',
    'slug' => 'overstock_listing'
)
,
    array(
    'supports' => array('title', 'editor', 'thumbnail', 'comments'),
    'menu_icon' => 'dashicons-products'
));
$overstock_listing->register_taxonomy(array(
    'taxonomy_name' => 'overstock_categories',
    'singular' => 'Overstock Category',
    'plural' => 'Overstock Categories',
    'slug' => 'overstock_categories'
));