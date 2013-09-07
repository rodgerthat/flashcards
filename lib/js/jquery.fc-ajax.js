/**
 * flashcards-ajax.js
 */

jQuery(document).ready(function($){

    // fetch data
    //$.get();

    // modify data
    //$.post();


    $("button.group").click(function() {

        var $button = $(this);
        var termSlug = $button.attr("data-termSlug");

        console.log("$button : " + $button);

        $.post(
            FC_Ajax.ajaxurl,
            {
                // declare parameters w/ request, and action from Object
                action : FC_Ajax.action,
                termSlug : termSlug,
                nonce : FC_Ajax.nonce
            },
            function( response ) {
                console.log( response );
                $button.after( '<p style="color:green;">'+ response.termSlug +'</p>');
            }
        )

    });

});
