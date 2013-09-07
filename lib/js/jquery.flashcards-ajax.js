/**
 * flashcards-ajax.js
 */

jQuery(document).ready(function($){

    // fetch data
    //$.get();

    // modify data
    //$.post();


    $(".ajax-clicker").click(function(e) {

        var $el = $(this);

        $.get(
            flashcardsAjax.ajaxurl,
            {
                action  : flashcardsAjax.action,
                nonce   : flashcardsAjax.nonce,
                postID  : $el.attr('data-postid')
            },
            function( response, textStatus, jqXHR ) {
                if (200 == jqXHR.status && 'success' == textStatus ) {
                    if( 'success' == response.status ) {
                        $el.after( '<p style="color:green;">'+response.message+'</p>' );
                    } else {
                        $el.after( '<p style="color:red;">'+response.message+'</p>' );
                    }
                    // do stuff

                    console.log( response, textStatus, jqXHR );
                }
            },
            'json'
        );
    });

});
