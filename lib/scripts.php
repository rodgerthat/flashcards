<?php
/**
 * scripts.php
 *
 * register / enqueue | scripts / styles
 */

add_action( 'wp_enqueue_scripts', 'fc_enqueue_scripts' );
function fc_enqueue_scripts() {

    // FLEXSLIDER
//    wp_register_script( 'flexslider', CHILD_URL.'/lib/js/jquery.flexslider-min.js', array('jquery'), '2.2.0', true );
//    wp_register_script( 'flexslider-init', CHILD_URL . '/lib/js/jquery.flexslider-init.js', array('flexslider'), '1.0', true );
//    wp_enqueue_script( 'flexslider' );
//    wp_enqueue_script( 'flexslider-init' );

    // FLASHCARDS
//    wp_register_script( 'flashcards', CHILD_URL.'/lib/js/jquery.fc.js', array('jquery'), '1.0', true );
//    wp_enqueue_script( 'flashcards' );


    wp_enqueue_script( 'fc-ajax', CHILD_URL.'/lib/js/jquery.fc-ajax.js', array('jquery'), '1.0', true );

    // #todo - add randmoizer for nonce
    wp_localize_script( 'fc-ajax', 'FC_Ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'action' => AJAX_ACTION,
        'nonce' => wp_create_nonce( AJAX_ACTION ),
    ));

}