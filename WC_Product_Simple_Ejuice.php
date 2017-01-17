<?php
/**
 * Plugin Name: 	WooCommerce Custom Product Type
 * Plugin URI:		http://jeroensormani.com
 * Description:		A simple demo plugin on how to add a custom product type.
 */

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Register the custom product type after init
 */
function register_simple_ejuice_product_type() {

    /**
     * This should be in its own separate file.
     */
    class WC_Product_Simple_Ejuice extends WC_Product {

        public function __construct( $product ) {

            $this->product_type = 'simple_ejuice';

            parent::__construct( $product );

        }

    }

}
add_action( 'plugins_loaded', 'register_simple_ejuice_product_type' );


/**
 * Add to product type drop down.
 */
function add_simple_ejuice_product( $types ){

    // Key should be exactly the same as in the class
    $types[ 'simple_ejuice' ] = __( 'Simple Ejuice' );

    return $types;

}
add_filter( 'product_type_selector', 'add_simple_ejuice_product' );


/**
 * Show pricing fields for simple_ejuice product.
 */
function simple_ejuice_custom_js() {

    if ( 'product' != get_post_type() ) :
        return;
    endif;

    ?><script type='text/javascript'>
        jQuery( document ).ready( function() {
            jQuery( '.options_group.pricing' ).addClass( 'show_if_simple_ejuice' ).show();
        });

    </script><?php

}
add_action( 'admin_footer', 'simple_ejuice_custom_js' );


/**
 * Add a custom product tab.
 */
function custom_product_tabs( $tabs) {

    $tabs['ejuice'] = array(
        'label'		=> __( 'Ejuice', 'woocommerce' ),
        'target'	=> 'ejuice_options',
        'class'		=> array( 'show_if_simple_ejuice', 'show_if_variable_ejuice'  ),
    );

    return $tabs;

}
add_filter( 'woocommerce_product_data_tabs', 'custom_product_tabs' );


/**
 * Contents of the ejuice options product tab.
 */
function ejuice_options_product_tab_content() {

    global $post;

    ?><div id='ejuice_options' class='panel woocommerce_options_panel'><?php

    ?><div class='options_group'><?php

    woocommerce_wp_checkbox( array(
        'id' 		=> '_enable_ejuice_option',
        'label' 	=> __( 'Enable ejuice option X', 'woocommerce' ),
    ) );

    woocommerce_wp_text_input( array(
        'id'			=> '_text_input_y',
        'label'			=> __( 'What is the value of Y', 'woocommerce' ),
        'desc_tip'		=> 'true',
        'description'	=> __( 'A handy description field', 'woocommerce' ),
        'type' 			=> 'text',
    ) );

    ?></div>

    </div><?php


}
add_action( 'woocommerce_product_data_panels', 'ejuice_options_product_tab_content' );


/**
 * Save the custom fields.
 */
function save_ejuice_option_field( $post_id ) {


    $ejuice_option = isset( $_POST['_enable_ejuice_option'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_enable_ejuice_option', $ejuice_option );

    if ( isset( $_POST['_text_input_y'] ) ) :
        update_post_meta( $post_id, '_text_input_y', sanitize_text_field( $_POST['_text_input_y'] ) );
    endif;

}
add_action( 'woocommerce_process_product_meta_simple_ejuice', 'save_ejuice_option_field'  );
add_action( 'woocommerce_process_product_meta_variable_ejuice', 'save_ejuice_option_field'  );


