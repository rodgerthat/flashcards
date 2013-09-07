<?php
/**
 * FC_Ajax
 */

class FC_Ajax {

    /*
     * WordPress requires an action name for each AJAX request
     *
     * @var string $action
     */
    private $action = 'fc_ajaxin-it';

    function __construct() {

        // add js that will initiate ajax requests
        add_action( 'wp_enqueue_scripts', array( &$this, 'fc_enqueue_scripts' ) );

        // make sure ajax is happening
        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            // add callbacks for AJAX requests
            add_action( 'wp_ajax_' . $this->action, array( &$this, 'do_ajax' ) ); // for logged-in users
            add_action( 'wp_ajax_nopriv' . $this->action, array( &$this, 'do_ajax' ) ); // for logged-out users
        }

    }

    /**
     * enqueue & localize scripts that initialize AJAX requests
     * and pass vars from PHP to JS
     */
    function fc_enqueue_scripts() {

        wp_enqueue_script( 'flashcards-ajax', CHILD_URL.'/lib/js/jquery.flashcards-ajax.js', array('jquery'), '1.0', true );

        wp_localize_script( 'flashcards-ajax', 'flashcardsAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'action' => $this->action,
            'nonce' => wp_create_nonce( $this->action ),
        ));
    }

    function do_ajax() {

        // default error msg
        $response = array(
            'status'    => 'error',
            'message'   => 'Invalid nonce'
        );

        // check to see if nonce is valid
        if ( isset( $GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], $this->action ) ) {

            // do something

            $response['status']     = 'success';
            $response['message']    = "It's AJAX Y'ALL";
        }

        // return our response to the script in the JSON format
        header( 'Content: application/json' );
        echo json_encode( $response );
        die;
    }

}