/**
 * flashcards-ajax.js
 */

jQuery(document).ready(function($){

    // fetch data
    //$.get();

    // modify data
    //$.post();

    var flexsliderData = $("#flexslider-1").data('flexslider');
    console.log(flexsliderData);

    $(".select-group").click(function() {

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

                clearSlider();
                buildSlider( response.flashcards );

            }
        )

    });

    function clearSlider() {

        for ( var i = 0; i < slider.count; i++ ) {
            slider.removeSlide(i);
        }

    }

    function buildSlider( flashcards ){
        // loop thru flashcards
        for ( var i = 0; i < flashcards.length; i++ ) {
            var card = '<li class"card"><div class="table"><div class="table-cell">'+flashcards[i]+'</div></div></li>';

            // add slides to flexslider
            slider.addSlide( card, i );
        }

    }

});
