<?php
add_color_rule( 'bg', '#2f363c', array(
	array(
		'body, 
		#menu-canvas,
		.tagcloud a,
		.nav li ul li,
		#wp-calendar tbody, 
		#wp-calendar tfoot', 'background'
	),
	array( 
		'.header-nav,
		.format-quote,
		#content .post-nav a:hover,
		#footer', 'background', '-1'
	),
	array( 
		'#wp-calendar tr th', 'background', '+1'
	),			
	
), __( 'Background' ) );


add_color_rule( 'txt', '#383f49', array(
	array(
		'.entry-title a,
		.entry-title a:hover', 'color', '#ffffff'
	),
	array( 
		'.fn a,
		.fn,
		.fn a:hover', 'color', '#f6f6f6'
	),
), __( 'Titles' ) );


add_color_rule( 'link', '#dd574c', array(
	array(
		'#footer-inside .search-button,
		#content .post-nav a,
		#commentform #submit,
		#content .post-nav a:hover', 'background'
	),
	array( 
		'#cancel-comment-reply-link i,
		a,
		.sticky:before', 'color', '#ffffff'
	),
), __( 'Accent and Links' ) );


add_color_rule( 'fg1', '#ffffff', array(
	array(
		'.logo-text,
		.logo-text a,
		.logo-text a:hover,
		.format-quote a:hover', 'color', 'bg'
	),
), __( 'Site Title and Description' ) );


add_color_rule( 'extra', '#abb7C0', array(
	array(
		'.logo-text-desc,
		.nav-toggle,
		.nav-toggle:hover,
		.nav a,
		.format-quote strong, 
		.format-quote cite,
		#footer-inside .widget a,
		#infinite-handle span,
		#content .post-nav a:hover', 'color', 'bg' 
	),
) );

add_color_rule( 'extra', '#ffffff', array(
	array(
		'.nav .current-menu-item > a, 
		.nav .current_page_item > a,
		.nav li ul a, 
		.nav li ul li a,
		#content .quote-meta,
		.format-quote,
		.format-quote a,
		.nav a:hover,
		#footer-toggle:hover,
		.footer-toggle-active i,
		#footer-inside .widget a:hover,
		#footer-inside .widgettitle,
		.footer-copy a,
		#icons a, #footer-inside #icons a,
		.tagcloud a,
		#wp-calendar caption,
		#wp-calendar tr th', 'color', 'bg' 
	),
	array( 
		'.logo-text a:hover', 'color', 'bg', '-1'
	),
	array( 
		'.infinite-loader .spinner div div', 'background', 'bg'
	),
	array( 
		'.error404 .post .search-form .submit,
		#footer-inside .search-button,
		#content .post-nav a,
		#infinite-handle span,
		#commentform #submit,
		.nothing-found .search-form .submit', 'color', 'link'
	),
) );

add_color_rule( 'extra', '#8a96a0', array(
	array(
		'#footer-inside,
		.footer-copy a:hover,
		.footer-menu a[href*="twitter.com"]:before,
		.footer-menu a[href*="facebook.com"]:before,
		.footer-menu a[href*="google.com"]:before,
		.footer-menu a[href*="instagram.com"]:before,
		.footer-menu a[href*="instagram.com"]:before,
		.footer-menu a[href*="youtube.com"]:before,
		.footer-menu a[href*="vimeo.com"]:before,
		.footer-menu a[href*="dribbble.com"]:before', 'color', 'bg' 
	),
) );

add_color_rule( 'extra', '#444d52', array(
	array( 
		'.nav li ul a, 
		.nav li ul li a,
		#footer-inside .widget ul li', 'border-color', 'bg'
	),
) );

add_color_rule( 'extra', '#414649', array(
	array( 
		'#wp-calendar tbody tr td,
		#wp-calendar tfoot td', 'border-color', 'bg', '0.5'
	),
) );


add_color_rule( 'extra', '#999999', array(
	array( 
		'.wp-caption', 'color', 'bg'
	),
) );

/* Additional color palettes */

add_color_palette( array(
	'#e8eff0',
	'#383f49',
    '#445566',
    '#445566',
), 'White' );

add_color_palette( array(
	'#6b7a8b',
	'#2a343f',
    '#4b5b6d',
    '',
), 'Slate Blue' );

add_color_palette( array(
	'#85587f',
	'#2c2136',
    '#51455c',
    '',
), 'Purple' );

add_color_palette( array(
	'#3a6f55',
	'#2e3a34',
    '#4b695a',
    '',
), 'Green' );