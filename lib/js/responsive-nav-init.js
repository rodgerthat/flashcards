/**
 * responsive-nav-init.js
 */

var navigation = responsiveNav("#main-nav", { // Selector: The ID of the wrapper
    animate: true,      // Boolean: Use CSS3 transitions, true or false
    transition: 400,    // Integer: Speed of the transition, in milliseconds
    label: "Menu",      // String: Label for the navigation toggle
    insert: "before",    // String: Insert the toggle before or after the navigation
    customToggle: "",   // Selector: Specify the ID of a custom toggle
    openPos: "relative", // String: Position of the opened nav, relative or static
    jsClass: "js",      // String: 'JS enabled' class which is added to <html> el
    init: function(){}, // Function: Init callback
    open: function(){}, // Function: Open callback
    close: function(){} // Function: Close callback
});

// Destroy
//navigation.destroy();

// Toggle
//navigation.toggle();
