<?php
/**
 * scripts.php
 *
 * register / enqueue | scripts / styles
 */

add_action( 'wp_enqueue_scripts', 'fc_enqueue_scripts' );
function fc_enqueue_scripts() {

    // FLEXSLIDER
    wp_register_script( 'flexslider', CHILD_URL.'/lib/js/jquery.flexslider-min.js', array('jquery'), '2.2.0', true );
    wp_enqueue_script( 'flexslider' );

    // RESPONSIVE NAV
    wp_register_script( 'responsive-nav', CHILD_URL.'/lib/js/responsive-nav.min.js', array(), '1.0.2', true );
    wp_enqueue_script( 'responsive-nav' );

    // AJAX & INITS
    wp_register_script( 'fc', CHILD_URL.'/lib/js/jquery.fc.js', array('jquery', 'flexslider', 'responsive-nav'), '1.0', true );
    wp_enqueue_script( 'fc' );

    // #todo - add randmoizer for nonce
    wp_localize_script( 'fc', 'FC_Ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'action' => AJAX_ACTION,
        'nonce' => wp_create_nonce( AJAX_ACTION ),
    ));

}