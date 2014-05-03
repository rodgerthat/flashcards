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

    if (isset($_POST["termSlug"])) {
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

    if (isset($_POST["cardData"])) {

        $card_title = $_POST["cardTitle"];

        $card_group = $_POST["cardGroup"];

        $post = array(                      // post array
            'ID' => false,                  // Are you updating an existing post?
            'post_content' => '',           // The full text of the post.
            'post_name' => '',              // The name (slug) for your post
            'post_title' => $card_title,    // The title of your post.
            'post_status' => 'publish',     // [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] // Default 'draft'.
            'post_type' => 'flashcards',    // [ 'post' | 'page' | 'link' | 'nav_menu_item' | custom post type ] // Default 'post'.
            'post_author' => '',            // The user ID number of the author. Default is the current user ID.
            'ping_status' => 'closed',      // [ 'closed' | 'open' ] // Pingbacks or trackbacks allowed. Default is the option 'default_ping_status'.
            'post_parent' => '',            // Sets the parent of the new post, if any. Default 0.
            'menu_order' => '',             // If new post is a page, sets the order in which it should appear in supported menus. Default 0.
            'to_ping' => '',                // Space or carriage return-separated list of URLs to ping. Default empty string.
            'pinged' => '',                 // Space or carriage return-separated list of URLs that have been pinged. Default empty string.
            'post_password' => '',          // Password for post, if any. Default empty string.
            'guid' => '',                   // Skip this and let Wordpress handle it, usually.
            'post_content_filtered' => '',  // Skip this and let Wordpress handle it, usually.
            'post_excerpt' => '',           // For all your post excerpt needs.
            'post_date' => '',              // [ Y-m-d H:i:s ] // The time post was made.
            'post_date_gmt' => '',          // [ Y-m-d H:i:s ] // The time post was made, in GMT.
            'comment_status' => '',         // [ 'closed' | 'open' ] // Default is the option 'default_comment_status', or 'closed'.
            'post_category' => '',          // array('category_id') // Default empty.
            'tags_input' => '',             // '<tag>, <tag>' or array() // Default empty.
            'tax_input' => array( 'groups' => $card_group ), // array( 'taxonomy' => <array | string> ) ] // For custom taxonomies. Default empty.
            'page_template' => '',          // [ <string> ] // Default empty.
        );

        $returned_post_id = wp_insert_post( $post, true );

        // generate the response
        if ( is_object($returned_post_id) ) {
            $response = json_encode(
                array(
                    'success' => false,
                    'error' => 'wp_error',
                    '$card_title' => $card_title,
                    '$card_group' => $card_group,
                    'wp_error' => $returned_post_id
                )
            );
        } elseif ( $returned_post_id == 0 ) {
            $response = json_encode( array( 'success' => false, 'error' => 'PHAIL : card not added' ) );
        } else {
            $response = json_encode( array( 'success' => true, 'cardData' => $cardData ) );
        }

        // response output
        header( "Content-Type: application/json" );
        //echo $postID;
        echo $response; // anything echoed goes into the response body

        // IMPORTANT : don't forget to 'exit'
        exit;
    }
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


function get_groups() {

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

    return $terms;

}
