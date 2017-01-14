<?php 

add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );

/**
 *
 */
function my_enqueue_assets() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    wp_enqueue_style( 'material-css', get_template_directory_uri().'/mdl/material.min.css' );

    wp_enqueue_script( 'material-js', get_template_directory_uri().'/mdl/material.min.js' );

    wp_enqueue_script( 'material-js', get_template_directory_uri().'/mdl/material.min.js' );

} add_filter( 'wp_revisions_to_keep', 'divi_limit_revisions', 10, 2 );

function divi_limit_revisions( $num ) {
    $num = 3;
    return $num;
}