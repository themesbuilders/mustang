(function($) {

    // Search bar
    if ($(window).width() > 767) {
        jQuery('#formTigger').click(function() {
            jQuery('#searchForm').animate({
                width: 'toggle'
            }, 200);
            return false;
        });
    }

    // Banner
    $('.main-slider').slick({
        dots: true
    });

    // Counter
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });

    // This is a functions that scrolls to #{blah}link
    function goToByScroll(id) {
        // Remove "link" from the ID
        var id = id.replace("link", "");
        
        if ( id ) {
        	// Scroll
        	$('html,body').animate({
        		scrollTop: $("#" + id).offset().top
        	},
        	'slow');
        }

    }

    /*
	$("a").click(function(e) {
        // Prevent a page reload when a link is pressed
        e.preventDefault();
        // Call the scroll function
        goToByScroll(this.id);
    });
    */

    // progressbar
    $('.progressbar1').progressBar({
        shadow: true,
        percentage: false,
        animation: true,
    });

})(jQuery);