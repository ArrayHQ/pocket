<?php
/**
 * Self-hosted functionality not to be included on WordPress.com.
 *
 * @package Pocket
 */

/**
 * Adds the Getting Started page and video metabox for WP.org users.
 */

if( is_admin() ) {

	if( file_exists( get_template_directory() . '/includes/admin/updater/theme-updater.php' ) ) {
		// Load Getting Started page and initialize EDD update class
		require_once( get_template_directory() . '/includes/admin/updater/theme-updater.php' );
	}

	if( file_exists( get_template_directory() . '/includes/admin/metabox/metabox.php' ) ) {
		// Meta boxes
		require_once( get_template_directory() . '/includes/admin/metabox/metabox.php' );
	}

	// TGM Activation class
	require_once( get_template_directory() . '/includes/admin/tgm/tgm-activation.php' );

}

/* Add Customizer CSS To Header */
function pocket_customizer_css() {
	?>
	<style type="text/css">
		a, #cancel-comment-reply i {
			color : <?php echo get_theme_mod( 'pocket_customizer_accent', '#DD574C' ); ?>;
		}

		.next-prev a,
		#respond .respond-submit,
		#commentform #submit,
		.wpcf7-submit,
		.search-form .submit,
		#main #infinite-handle span,
		#content .post-nav a,
		.wpcf7 input[type='submit'],
		.contact-form input[type='submit'] {
			background : <?php echo get_theme_mod( 'pocket_customizer_accent', '#DD574C' ); ?>;
		}

		<?php echo get_theme_mod( 'pocket_customizer_css' ); ?>
	</style>
<?php
}
add_action( 'wp_head', 'pocket_customizer_css' );
