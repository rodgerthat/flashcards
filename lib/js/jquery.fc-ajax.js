/**
 * flashcards-ajax.js
 */

jQuery(document).ready(function($){

    // fetch data
    //$.get();

    // modify data
    //$.post();


    $(".ajax-clicker").click(function() {

        var $el = $(this);
        var postID = $el.attr("data-postID");

        console.log("$el : " + $el);

        $.post(
            FC_Ajax.ajaxurl,
            {
                // declare parameters w/ request, and action from Object
                action : FC_Ajax.action,
                postID : postID,
                nonce : FC_Ajax.nonce
            },
            function( response ) {
                console.log( response );
                $el.after( '<p style="color:green;">'+ response.postID +'</p>');
            }
        )

    });

});
