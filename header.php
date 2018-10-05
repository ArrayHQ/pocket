<?php
/**
 *
 * Displays all of the <head> section and everything through <div id="main">
 *
 * @package Pocket
 * @since 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/includes/js/html5shiv.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<a class="nav-toggle" href="#">
		<span class="nav-open"><i class="fa fa-bars"></i> <?php _e( 'Menu', 'pocket' ); ?></span>
		<span class="nav-close"><i class="fa fa-times"></i> <?php _e( 'Close', 'pocket' ); ?></span>
	</a>

	<nav role="navigation" class="header-nav">
    	<div class="header-nav-inside">
    		<!-- nav menu -->
    		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav', 'container' => false ) ); ?>
    	</div>
    </nav>

	<div class="container">
		<header class="header">
			<div class="header-inside">
				<!-- grab the logo and site title -->
				<?php
				$logo = get_theme_mod( 'pocket_customizer_logo' );
				if ( ! empty( $logo ) ) { ?>
					<h1 class="logo-image">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
					</h1>
				<?php } else { ?>
				    <hgroup>
				    	<h1 class="logo-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></a></h1>
				    	<span class="logo-text-desc"><?php bloginfo( 'description' ) ?></span>
				    </hgroup>
			    <?php } ?>
			</div><!-- header inside -->
		</header>

		<div id="wrapper">
			<div id="main">
