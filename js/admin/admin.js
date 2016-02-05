(function($) {

	"use strict";

	function mustang_hide_mb( template, id ) {

		// When the page loads.
		var da_page_template = $('#page_template').val();
		if ( typeof da_page_template !== 'undefined' ) {
			var da_is_template = da_page_template.indexOf( template );
		}
		if ( da_is_template > -1 ) {
			$('#' + id).removeClass('hide-if-js');
		}
		else {
			$('#' + id).addClass('hide-if-js');
		}

		// When the changes happen.
		$('#page_template').change(function() {
			var value = $(this).val();
			if ( value.indexOf( template ) > -1 ) {
				$('#' + id).removeClass('hide-if-js');
			}
			else {
				$('#' + id).addClass('hide-if-js');
			}
		});

	}

	// Make a call.
	mustang_hide_mb( 'template-homepage.php', 'm1t_template_home' );
	mustang_hide_mb( 'template-gallery.php', 'm1t_template_gallery' );

})(jQuery);
