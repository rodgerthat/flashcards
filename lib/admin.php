<?php
/**
 * admin.php
 */

////////////// ADMIN MENUS //////////////////

function fc_remove_menus() {
    //remove_menu_page( 'themes.php' ); // remove whole appearance menu
    //remove_submenu_page( 'themes.php', 'themes.php' ); // no themes
    remove_submenu_page( 'themes.php', 'theme-editor.php' ); // no editor
    //remove_submenu_page( 'themes.php', 'theme_options' ); // no theme options
    remove_submenu_page( 'themes.php', 'customize.php'); // no customize menu
    //remove_submenu_page( 'plugins.php', 'plugin-options' ); // no plugin options
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' ); // no plugin editor
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); // remove tags
    remove_menu_page( 'link-manager.php' ); // remove links

}
add_action( 'admin_head', 'fc_remove_menus', 999 );


////////////// DASHBOARD WIDGETS & META BOXES //////////////////

function fc_disable_default_dashboard_widgets() {

    //remove_meta_box('dashboard_right_now', 'dashboard', 'core');       // Right Now Widget
    //remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
    //remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');     // Quick Press Widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
    remove_meta_box('dashboard_primary', 'dashboard', 'core');         // WordPress Blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');       // ??

    // removing plugin dashboard boxes
    //remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Peace Out, Yoast.

    // post metaboxes
    remove_meta_box( 'tagsdiv-post_tag', 'post', 'normal' ); // no tags meta box in post editor
    remove_meta_box( 'trackbacksdiv', 'post', 'normal' ); // no trackbacks meta box in post editor


}
add_action('admin_menu', 'fc_disable_default_dashboard_widgets');


////////////// CUSTOM LOGIN PAGE //////////////////

// calling your own login css so you can style it
function fc_login_css() { ?>
    <link rel="stylesheet" id="fc_wp_admin_css"  href="<?php echo get_stylesheet_directory_uri() . '/lib/css/login.css'; ?>" type="text/css" media="all" />
<?php }

// changing the logo link from wordpress.org to your site
function fc_login_url() { return get_bloginfo('url'); }

// changing the alt text on the logo to show your site name
function fc_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'fc_login_css' );
add_filter( 'login_headerurl', 'fc_login_url' );
add_filter( 'login_headertitle', 'fc_login_title' );


////////////// CUSTOMIZE ADMIN ////////////////////

// custom favicon for backend and login
function fc_admin_favicon() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="'. get_stylesheet_directory_uri() .'/lib/images/favicon.ico" />'; // careful, chrome rly liek these...
}
add_action('admin_head', 'fc_admin_favicon');
add_action('login_head', 'fc_admin_favicon');

// custom backend footer
function fc_custom_admin_footer() {
    echo '<span id="fc-admin-footer">developed by <a href="http://joelrnorris.com" target="_blank">jrn</a></span>.';
}
add_filter('admin_footer_text', 'fc_custom_admin_footer');

// custom dashboard styles
function fc_custom_dashboard() {
    echo '<link rel="stylesheet" href="'. get_stylesheet_directory_uri() . '/lib/css/admin.css">';
}
add_action('admin_head', 'fc_custom_dashboard');


////////////// CUSTOMIZE ADMIN BAR ////////////////////

// custom admin bar favicon for frontend
function fc_admin_bar_site_icon() {
    // if they've got the admin bar turned off, bail.
    if ( ! is_admin_bar_showing() ) { return; }
    echo '<style>
        body #wp-admin-bar-wp-logo>.ab-item .ab-icon { background: transparent url(' . get_stylesheet_directory_uri() . '/lib/images/favicon.ico) no-repeat center; background-size: cover; }
        body #wpadminbar #wp-admin-bar-wp-logo.hover>.ab-item .ab-icon { background-position: 2px 2px; }
    </style>';
}
// add to frontend, inside head
add_action( 'wp_head', 'fc_admin_bar_site_icon', 10 );
