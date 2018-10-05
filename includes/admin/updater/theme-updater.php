<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'Array_Theme_Updater_Admin' ) ) {
	include( get_template_directory() . '/includes/admin/updater/theme-updater-admin.php' );
}

// The theme version to use in the updater
define( 'POCKET_SL_THEME_VERSION', wp_get_theme( 'pocket' )->get( 'Version' ) );

// Loads the updater classes
$updater = new Array_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => esc_url( 'https://arraythemes.com' ),
		'item_name'      => __( 'Pocket WordPress Theme', 'pocket' ),
		'theme_slug'     => 'pocket',
		'version'        => POCKET_SL_THEME_VERSION,
		'author'         => __( 'Array', 'pocket' ),
		'download_id'    => '1999',
		'renew_url'      => ''
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'pocket' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'pocket' ),
		'license-key'               => __( 'Enter your license key', 'pocket' ),
		'license-action'            => __( 'License Action', 'pocket' ),
		'deactivate-license'        => __( 'Deactivate License', 'pocket' ),
		'activate-license'          => __( 'Activate License', 'pocket' ),
		'save-license'              => __( 'Save License', 'pocket' ),
		'status-unknown'            => __( 'License status is unknown.', 'pocket' ),
		'renew'                     => __( 'Renew?', 'pocket' ),
		'unlimited'                 => __( 'unlimited', 'pocket' ),
		'license-key-is-active'     => __( 'Theme updates have been enabled. You will receive a notice on your Themes page when a theme update is available.', 'pocket' ),
		'expires%s'                 => __( 'Your license for Pocket expires %s.', 'pocket' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'pocket' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'pocket' ),
		'license-key-expired'       => __( 'License key has expired.', 'pocket' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'pocket' ),
		'license-is-inactive'       => __( 'License is inactive.', 'pocket' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'pocket' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'pocket' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'pocket' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'pocket' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'pocket' )
	)

);
