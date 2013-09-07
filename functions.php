<?php
/**
 * functions.php
 *
 */


// REGISTER CHILD THEME //////////////////////////////////

define( 'CHILD_THEME_NAME', 'Flash Cards' );
define( 'CHILD_THEME_SLUG', 'flashcards' );
define( 'CHILD_THEME_URL', 'http://127.0.0.1:8080/wordpress/' );
define( 'CHILD_URL', get_stylesheet_directory_uri() );
define( 'CHILD_DIR', get_stylesheet_directory() );

define( 'AJAX_ACTION', 'fc_ajaxin-it' );

// INCLUDES //////////////////////////////////////

include_once( CHILD_DIR . '/lib/cpts/flashcards.php' ); // CPT & CT for flashcards

include_once( CHILD_DIR . '/lib/admin.php' ); // custom login / admin

include_once( CHILD_DIR . '/lib/scripts.php' ); // register / enqueue | scripts / styles

// CLASSES ///////////////////////////////////////////

//include_once( CHILD_DIR . '/classes/class-fc-ajax.php' ); // fc-ajax class



// AJAX HANDLERS ///////////////////////////////////////////

// make sure ajax is happening
//if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
// add callbacks for AJAX requests
add_action( 'wp_ajax_' . AJAX_ACTION, 'fc_do_ajax' ); // for logged-in users
add_action( 'wp_ajax_nopriv_' . AJAX_ACTION, 'fc_do_ajax' ); // for logged-out users
//}

function fc_do_ajax() {

    // do something asynchronous

    // get submitted parameters
    $postID = $_POST['postID'];

    // generate the response
    $response = json_encode( array( 'success' => true, 'postID' => $postID ) );

    // response output
    header( "Content-Type: application/json" );
    //echo $postID;
    echo $response; // anything echoed goes into the response body

    // IMPORTANT : don't forget to 'exit'
    exit;
}


