<?php
/**
 * scripts.php
 *
 * register / enqueue | scripts / styles
 */

add_action( 'wp_enqueue_scripts', 'jrn_enqueue_scripts' );
function jrn_enqueue_scripts() {

    // FLEXSLIDER
    wp_register_script( 'flexslider', CHILD_URL.'/lib/js/flexslider-min.js', array('jquery'), '2.2.0', true );
    wp_register_script( 'flexslider-init', CHILD_URL . '/lib/js/jquery.flexslider-init.js', array('flexslider'), '1.0', true );
    wp_enqueue_script( 'flexslider' );
    wp_enqueue_script( 'flexslider-init' );

    // FLASHCARDS
    wp_register_script( 'flashcards', CHILD_URL.'/lib/js/flashcards.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'flashcards' );

}