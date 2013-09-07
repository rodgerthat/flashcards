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

// INCLUDES //////////////////////////////////////

include_once( CHILD_DIR . '/lib/cpts/flashcards.php' ); // CPT & CT for flashcards

include_once( CHILD_DIR . '/lib/admin.php' ); // custom login / admin

include_once( CHILD_DIR . '/lib/scripts.php' ); // register / enqueue | scripts / styles

// CLASSES ///////////////////////////////////////////

//include_once( CHILD_DIR . '/classes/class-fc-ajax.php' ); // fc-ajax class
