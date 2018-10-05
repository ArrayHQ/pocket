jQuery(document).ready( function( $ ) {

		// FitVids
		$( ".box iframe" ).not( ".fitvid iframe" ).wrap( "<div class='fitvid'/>" );
		$( ".fitvid" ).fitVids();

		// Run Fitvid on Infinite Scroll
        $( document.body ).on( "post-load", function () {
			$( ".fitvid" ).fitVids();
		});

		// Detect window width
		$( window ).on( "resize load", function () {
			var current_width = $( window ).width();

			// If width is below iPad size, do this stuff
			if( current_width < 769 ) {
				// Add mobile-nav class to header-nav
				$( ".header-nav" ).addClass( "mobile-nav" );
			}

			// If width is above iPad size, do this stuff
			if( current_width > 769 ) {
				// Hide the canvas menu
				$( "#menu-canvas" ).hide();

				// Remove mobile-nav class from header-nav
				$( ".header-nav" ).removeClass( "mobile-nav" );

				// Show header nav on desktop
				$( ".header-nav" ).show();
			}
		});

		// Responsive navigation
		$( ".nav-toggle" ).click( function() {
			// Add mobile-nav class to header-nav
			$( ".header-nav" ).toggle();

			// Toggle open/close text
			$( ".nav-open, .nav-close" ).toggle();

			// Add mobile class to footer
			$( "#footer" ).toggleClass( "mobile-footer" );

			// Toggle the page content to show the footer
			$( ".header, #wrapper" ).toggle();
		});

		// Responsive sub menu toggle
		$( ".nav" ).find( "li.menu-item-has-children" ).click(function(){
		    $( ".nav li" ).not( this ).find( "ul" ).next().slideUp( 100 );
		    $( this ).find( "> ul" ).stop( true, true ).slideToggle( 100 );
		    $( this ).toggleClass( "active-sub-menu" );
		    return false;
		});

		// Don't fire sub menu toggle if a user is trying to click the link
		$( ".menu-item-has-children a" ).click( function(e) {
	    	e.stopPropagation();
	    	return true;
		});

		// Move sharing module on quote posts
		$( ".format-quote #jp-post-flair, body:not(.wpcom) .sd-sharing-enabled" ).prependTo( ".quote-meta" );
});