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
//    wp_register_script( 'flashcards', CHILD_URL.'/lib/js/jquery.flashcards.js', array('jquery'), '1.0', true );
//    wp_enqueue_script( 'flashcards' );


    wp_enqueue_script( 'flashcards-ajax', CHILD_URL.'/lib/js/jquery.flashcards-ajax.js', array('jquery'), '1.0', true );

    wp_localize_script( 'flashcards-ajax', 'flashcardsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'action' => 'fc_ajaxin-it',
        'nonce' => wp_create_nonce( 'fc_ajaxin-it' ),
    ));

}