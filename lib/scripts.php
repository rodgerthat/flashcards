<?php
/**
 * scripts.php
 *
 * register / enqueue | scripts / styles
 */

add_action( 'wp_enqueue_scripts', 'fc_enqueue_scripts' );
function fc_enqueue_scripts() {

    // FLEXSLIDER
    wp_register_script( 'flexslider', THEME_URL.'/assets/js/jquery.flexslider-min.js', array('jquery'), '2.2.0', true );
    wp_enqueue_script( 'flexslider' );

    // RESPONSIVE NAV
    wp_register_script( 'responsive-nav', THEME_URL.'/assets/js/responsive-nav.min.js', array(), '1.0.2', true );
    wp_enqueue_script( 'responsive-nav' );

    // AJAX & INITS
    wp_register_script( 'fc', THEME_URL.'/assets/js/jquery.fc.js', array('jquery', 'flexslider', 'responsive-nav'), '1.0', true );
    wp_enqueue_script( 'fc' );
   
    // $todo - add ransomizer for nonce
    wp_localize_script( 'fc', 'FC_Ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'action' => AJAX_ACTION,
        'nonce' => wp_create_nonce( AJAX_ACTION ),
    ));

    if (!is_user_logged_in()) {
    wp_register_script('ajax-login-script', get_stylesheet_directory_uri() . '/assets/js/ajax-login-script.js', array('jquery') );
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));


    }

}

