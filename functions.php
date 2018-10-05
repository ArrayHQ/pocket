<?php
/**
 * Pocket functions and definitions
 *
 * @package Pocket
 * @since Pocket 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Pocket 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 770; /* pixels */

if ( ! function_exists( 'pocket_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since pocket 1.0
 */
function pocket_setup() {

	/* Admin functionality */
	if( is_admin() ) {

		/* Add editor styles */
		add_editor_style( array( 'editor-style.css', pocket_fonts_url() ) );

	}

	/* Functionality for self-hosted sites. File is not deployed to WP.com. */
	if( file_exists( get_template_directory() . '/includes/wporg.php' ) ) {
		require_once( get_template_directory() . '/includes/wporg.php' );
	}

	// Add Customizer settings
	require_once( get_template_directory() . '/customizer.php' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* Enable support for Post Thumbnails */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // Default Thumb
	add_image_size( 'large-image', 1200, 9999, false ); // Large Post Image

	/* Add support for Post Formats */
	add_theme_support( 'post-formats', array( 'quote' ) );

	/* Infinite Scroll Support */
	add_theme_support( 'infinite-scroll', array(
		'type'           => 'click',
		'container'      => 'post-block',
		'render'         => 'pocket_render_infinite_posts',
		'footer_widgets' => false
	));

	/* Custom Background Support */
	add_theme_support( 'custom-background' );

	/* This theme uses wp_nav_menu() in two locations. */
	register_nav_menus( array(
		'primary' => __( 'Header Menu', 'pocket' ),
		'footer'  => __( 'Footer Menu', 'pocket' )
	) );

	/* Make theme available for translation */
	load_theme_textdomain( 'pocket', get_template_directory() . '/languages' );

}
endif; // pocket_setup

add_action( 'after_setup_theme', 'pocket_setup' );


/* Enqueue scripts and styles */
function pocket_scripts_styles() {

	$version = wp_get_theme()->Version;

	// Enqueue Styles

	// Pocket Stylesheet
	wp_enqueue_style( 'pocket-style', get_stylesheet_uri() );

	// Load fonts from Google
	wp_enqueue_style( 'pocket-fonts', pocket_fonts_url(), array(), null );

	// Font Awesome CSS
	wp_enqueue_style( 'pocket-font-awesome-css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.css", array(), '4.0.3', 'screen' );

	// Media Queries CSS
	wp_enqueue_style( 'pocket-media-queries-css', get_template_directory_uri() . "/media-queries.css", array(), $version, 'screen' );

	// Enqueue Scripts

	// Fidvid
	wp_enqueue_script( 'pocket-fitvid-js', get_template_directory_uri() . '/includes/js/jquery.fitvids.js', array(), false, true );

	// Custom JS
	wp_enqueue_script( 'pocket-custom-js', get_template_directory_uri() . '/includes/js/custom.js', array( 'jquery', 'pocket-fitvid-js' ), $version, true );

	// Comment reply
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'pocket_scripts_styles' );


/**
 * Return the Google font stylesheet URL
 */
if ( ! function_exists( 'pocket_fonts_url' ) ) :
function pocket_fonts_url() {

	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by these fonts, translate this to 'off'. Do not translate
	 * into your own language.
	 */

	$raleway = esc_html_x( 'on', 'Raleway font: on or off', 'pocket' );
	$arimo   = esc_html_x( 'on', 'Arimo font  : on or off', 'pocket' );

	if ( 'off' !== $raleway || 'off' !== $arimo ) {
		$font_families = array();

		if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:300,700,800';

		if ( 'off' !== $arimo )
			$font_families[] = 'Arimo:400,700,400italic,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
endif;


/* Render infinite posts by using template parts */
function pocket_render_infinite_posts() {

	while ( have_posts() ) {
		the_post();

		if ( 'quote' == get_post_format() ) {
			get_template_part( 'format', 'quote' );
		} else {
			get_template_part( 'format', 'standard' );
		};
	}
}


/**
 * Deprecated page navigation
 */
function pocket_page_has_nav() {
	_deprecated_function( __FUNCTION__, '4.0', 'pocket_page_nav()' );
	return false;
}


/**
 * Displays post pagination links
 *
 * @since 4.0
 */
function pocket_page_nav() {

	// Return early if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	} ?>

	<div class="post-nav">
		<div class="post-nav-inside">
		<?php if( get_previous_posts_link() ) : ?>
			<div class="post-nav-left"><?php previous_posts_link( '<i class="fa fa-arrow-left"></i> ' . __( 'Newer Posts', 'pocket' ) ); ?></div>
		<?php endif; ?>
		<?php if( get_next_posts_link() ) : ?>
			<div class="post-nav-right"><?php next_posts_link( __( 'Older Posts', 'pocket' ) . ' <i class="fa fa-arrow-right"></i>' ); ?></div>
		<?php endif; ?>
		</div>
	</div>
	<?php
}

/* Customize Read More text */
function pocket_modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '"><span>' . __( 'Continue Reading', 'pocket' ) . '</span></a>';
}
add_filter( 'the_content_more_link', 'pocket_modify_read_more_link' );


/* Modify body classes */
function pocket_body_class( $classes ) {

	if( ! pocket_is_wpcom() && get_option( 'pocket_customizer_color_scheme' ) == 'light' ) {
		$classes[] = 'light';
	}

	if( pocket_is_wpcom() ) {
		$classes[] = 'wpcom';
	}
	return $classes;
}
add_filter( 'body_class', 'pocket_body_class' );


/* Register Footer Widget Areas */
function pocket_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Footer Left', 'pocket' ),
		'id'            => 'footer-left',
		'description'   => __( 'Widgets in this area will be shown in the left footer area.', 'pocket' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Center', 'pocket' ),
		'id'            => 'footer-center',
		'description'   => __( 'Widgets in this area will be shown in the center footer area.', 'pocket' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Right', 'pocket' ),
		'id'            => 'footer-right',
		'description'   => __( 'Widgets in this area will be shown in the right footer area.', 'pocket' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>'
	) );
}
add_action( 'widgets_init', 'pocket_widgets_init' );


/* Custom Comment Output */
function pocket_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID() ?>">

	<div class="comment-block" id="comment-<?php comment_ID(); ?>">
		<div class="comment-info">
			<div class="comment-author vcard clearfix">
				<?php echo get_avatar( $comment->comment_author_email, 75 ); ?>

				<div class="comment-meta commentmetadata">
					<?php printf( __( '<cite class="fn">%s</cite>', 'pocket' ), get_comment_author_link() ) ?>
					<div style="clear:both;"></div>
					<a class="comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __( '%1$s at %2$s', 'pocket' ), get_comment_date(), get_comment_time() ) ?></a><?php edit_comment_link( __( '(Edit)', 'pocket' ), '  ', '' ) ?>
				</div>
			</div>
		</div>

		<div class="comment-text">
			<?php comment_text() ?>
			<p class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
			</p>
		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pocket' ) ?></em>
		<?php endif; ?>
	</div>
<?php
}

function pocket_cancel_comment_reply_button( $html, $link, $text ) {
	$style  = isset( $_GET['replytocom'] ) ? '' : ' style="display:none;"';
	$button = '<div id="cancel-comment-reply-link"' . $style . '>';

	return $button . '<i class="fa fa-times-circle"></i> </div>';
}

add_action( 'cancel_comment_reply_link', 'pocket_cancel_comment_reply_button', 10, 3 );



/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function pocket_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'pocket' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'pocket_wp_title', 10, 2 );



/**
 * Cleans up the output of wp_page_menu.
 */
function pocket_wp_page_menu_filter( $menu, $args ) {
	$menu = str_replace( '<div class="nav"><ul>', '<ul class="nav">', $menu );
	$menu = str_replace( '</div>', '', $menu );
	return $menu;
}
add_filter( 'wp_page_menu', 'pocket_wp_page_menu_filter', 10, 2 );



/**
 * Returns whether or not we're on WordPress.com
 *
 * @since  2.1
 */
function pocket_is_wpcom() {
	return ( defined( 'IS_WPCOM' ) && IS_WPCOM );
}
