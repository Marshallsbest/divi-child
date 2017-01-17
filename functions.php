<?php
/**
 * my functions
 */
function my_enqueue_assets() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    wp_enqueue_style( 'material-css', get_stylesheet_directory_uri().'/mdl/material.min.css' );

    wp_enqueue_script( 'material-js', get_stylesheet_directory_uri().'/mdl/material.min.js' );
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );

/**
 *Used to keep revision history to a minimum
 */

function divi_limit_revisions( $num ) {
    $num = 3;
    return $num;
}
add_filter( 'wp_revisions_to_keep', 'divi_limit_revisions', 10, 2 );

/**
 *Custom post types registration class
 */

require get_stylesheet_directory() . '/inc/CPT.php';

/**
 * Custom post types
 */
require get_stylesheet_directory() . '/inc/register-Overstock.php';

/**
 * Custom post types
 */
require get_stylesheet_directory() . '/WC_Product_Simple_Ejuice.php';