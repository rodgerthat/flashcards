<?php
/**
 * functions.php
 *
 */

#todo - standardize nomenclature stick w/ flexslider "slider" base.


// REGISTER CHILD THEME //////////////////////////////////

define( 'THEME_NAME', 'Flash Cards' );
define( 'THEME_SLUG', 'flashcards' );
define( 'THEME_URL', get_stylesheet_directory_uri() );
define( 'THEME_DIR', get_stylesheet_directory() );

define( 'AJAX_ACTION', 'fc_ajaxin-it' );

// INCLUDES //////////////////////////////////////

include_once( THEME_DIR . '/lib/cpts/flashcards.php' ); // CPT & CT for flashcards

include_once( THEME_DIR . '/lib/admin.php' ); // custom login / admin

include_once( THEME_DIR . '/lib/scripts.php' ); // register / enqueue | scripts / styles

// CLASSES ///////////////////////////////////////////

//include_once( THEME_DIR . '/classes/class-fc-ajax.php' ); // fc-ajax class

// MENU GENERATOR ///////////////////////////////////////////

function fc_generate_menu() {

    $taxonomy = 'groups';
    $term_args = array(
        'orderby'       => '',
        'order'         => 'ASC',
        'hide_empty'    => true,
        'exclude'       => array(),
        'exclude_tree'  => array(),
        'include'       => array(),
        'number'        => '',
        'fields'        => 'all',
        'slug'          => '',
        'parent'         => '',
        'hierarchical'  => true,
        'child_of'      => 0,
        'get'           => '',
        'name__like'    => '',
        'pad_counts'    => false,
        'offset'        => '',
        'search'        => '',
        'cache_domain'  => 'core'
    );

    $terms = get_terms( $taxonomy );

    //print_r($terms);

    $menu = '<ul class="menu">';

    foreach ( $terms as $term ) {

        $menu .= '<li><a class="select-group '.$term->slug.'" data-termSlug="'.$term->slug.'">'.$term->name.'</a></li>';

    }

    $menu .= '<li><a class="shuffle" data-termSlug="shuffle">Shuffle</a></li>';
    $menu .= '<li><a class="instructions" data-termSlug="instructions">Instructions</a></li>';
    $menu .= '<li><a class="admin" data-termSlug="admin" href="'.wp_login_url().'">Login</a></li>';
    $menu .= '</ul>';

    echo $menu;
    //return $menu;

}

// AJAX HANDLERS ///////////////////////////////////////////

/**
 * FC Do Ajax
 *
 * @url : http://www.garyc40.com/2010/03/5-tips-for-using-ajax-in-wordpress/
 * @url : http://codex.wordpress.org/AJAX_in_Plugins#Ajax_on_the_Viewer-Facing_Side
 */

// make sure ajax is happening
//if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
// add callbacks for AJAX requests
add_action( 'wp_ajax_' . AJAX_ACTION, 'fc_do_ajax' ); // for logged-in users
add_action( 'wp_ajax_nopriv_' . AJAX_ACTION, 'fc_do_ajax' ); // for logged-out users
//}

function fc_do_ajax() {

    // verify nonce ( saftey 1stish )
    $nonce = $_POST['nonce'];

    if ( !wp_verify_nonce( $nonce, AJAX_ACTION ) ) die ( '$yr_nonce == !good' );

    // do something asynchronous

    // get submitted parameters
    $termSlug = $_POST['termSlug'];

    // get all the flashcards in that group
    $flashcards = array();

    // WP_Query arguments
    $args = array (
        'posts_per_page' => '-1',
        'post_type'              => 'flashcards',
        'tax_query' => array(
            array(
                'taxonomy' => 'groups',
                'field' => 'slug',
                'terms' => $termSlug
            )
        )
    );

    // The Query
    $fc_query = new WP_Query( $args );

    // The Loop
    if ( $fc_query->have_posts() ) {
        while ( $fc_query->have_posts() ) {
            $fc_query->the_post();
            // do something
            global $post;

            // place postdata in an array for return
            // #todo - run a check to see if the_content() is empty, then use the title.
            $flashcards[] = $post->post_title;
        }
    } else {
        // no posts found
        $flashcards[] = 'no flashcards found';
    }

    // Restore original Post Data
    wp_reset_postdata();

    // generate the response
    $response = json_encode( array( 'success' => true, 'termSlug' => $termSlug, 'flashcards' => $flashcards )  );

    // response output
    header( "Content-Type: application/json" );
    //echo $postID;
    echo $response; // anything echoed goes into the response body

    // IMPORTANT : don't forget to 'exit'
    exit;
}



// LOGIN AJAX ///////////////////////////////////////////
/**
 * Ajax Login
 * @url : http://natko.com/wordpress-ajax-login-without-a-plugin-the-right-way/
 *
 * handle ajax login
 */
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die(); // so brutal, this php.
}

// Enable the user with no privileges to run ajax_login() in AJAX
add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );

