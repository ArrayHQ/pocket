<?php
/**
 * WordPress.com-specific functions and definitions.
 *
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Pocket
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 */
function pocket_wpcom_setup() {
	global $themecolors;

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {
		$themecolors = array(
			'bg'     => 'FFFFFF',
			'border' => '323A41',
			'text'   => '555555',
			'link'   => 'DD574C',
			'url'    => 'DD574C',
		);
	}
}
add_action( 'after_setup_theme', 'pocket_wpcom_setup' );