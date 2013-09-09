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

<<<<<<< HEAD
    // RESPONSIVE NAV
    wp_register_script( 'responsive-nav', CHILD_URL.'/lib/js/responsive-nav.min.js', array(), '1.0.2', true );
    wp_enqueue_script( 'responsive-nav' );
=======
    // FLASHCARDS
//    wp_register_script( 'flashcards', CHILD_URL.'/lib/js/jquery.flashcards.js', array('jquery'), '1.0', true );
//    wp_enqueue_script( 'flashcards' );

    // AJAX & INITS
    wp_register_script( 'fc', CHILD_URL.'/lib/js/jquery.fc.js', array('jquery', 'flexslider', 'responsive-nav'), '1.0', true );
    wp_enqueue_script( 'fc' );
   
    // $todo - add ransomizer for nonce
    wp_localize_script( 'flashcards-ajax', 'flashcardsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'action' => 'fc_ajaxin-it',
        'nonce' => wp_create_nonce( 'fc_ajaxin-it' ),
    ));

}