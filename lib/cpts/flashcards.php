<?php
/*
 * flashcards.php
 *
 * register custom post type for flashcards
 *
 */

add_action( 'init', 'fc_flashcards_cpt_init' );
function fc_flashcards_cpt_init() {

    $flashcards_cpt_labels = array(
        'name' => 'Flash Cards',
        'singular_name' => 'Flash Cards',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Flash Card',
        'edit_item' => 'Edit Flash Card',
        'new_item' => 'New Flash Card',
        'all_items' => 'All Flash Cards',
        'view_item' => 'View Flash Cards',
        'search_items' => 'Search Flash Cards',
        'not_found' =>  'No Flash Cards found',
        'not_found_in_trash' => 'No Flash Cards found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Flash Cards'
    );

    $flashcards_cpt_args = array(
        'labels' => $flashcards_cpt_labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'flashcard' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

    register_post_type( 'flashcards', $flashcards_cpt_args );

}

add_action( 'init', 'fc_flashcards_tax_init' );
function fc_flashcards_tax_init() {
    // Add new taxonomy, make it hierarchical (like categories)
    $flashcards_tax_labels = array(
        'name'              => _x( 'Groups', 'taxonomy general name' ),
        'singular_name'     => _x( 'Group', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Groups' ),
        'all_items'         => __( 'All Groups' ),
        'parent_item'       => __( 'Parent Group' ),
        'parent_item_colon' => __( 'Parent Group:' ),
        'edit_item'         => __( 'Edit Group' ),
        'update_item'       => __( 'Update Group' ),
        'add_new_item'      => __( 'Add New Group' ),
        'new_item_name'     => __( 'New Group Name' ),
        'menu_name'         => __( 'Groups' ),
    );

    $flashcards_tax_args = array(
        'hierarchical'      => true,
        'labels'            => $flashcards_tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'group' ),
    );

    register_taxonomy( 'groups', array( 'flashcards' ), $flashcards_tax_args );
}