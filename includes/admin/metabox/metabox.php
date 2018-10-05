<?php
/**
 * Custom meta box for video embeds
 *
 * @package Pocket
 * @since 4.0
 */


/**
 * Adds a video box to the the Post and Page edit screens
 *
 * @since 4.0
 */
function pocket_add_video_box() {

	$screens = array( 'post', 'page', 'array-portfolio' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'pocket_video_section',
			__( 'Video', 'pocket' ),
			'pocket_inner_video_box',
			$screen,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'pocket_add_video_box' );



/**
 * Prints the video box markup
 *
 * @since 4.0
 */
function pocket_inner_video_box( $post ) {

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'pocket_video_box_nonce' );

	// Get existing value and use it for the value of the form
	$value = get_post_meta( $post->ID, 'video', true );
	$video_help = esc_url( 'https://array.is/articles/pocket/?#creating-media-postsTB_iframe=true&amp;width=850&amp;height=600' );
	echo '</label> ';
	echo '<textarea rows="3" style="width:98%; margin-top: 10px;" id="pocket_video_field" name="pocket_video_field">'.esc_textarea($value).'</textarea>';
	echo '<p>';
		printf( __( 'Add video to your page by entering the video\'s <a class="thickbox" href="%1$s">embed code</a> in the box above (optional). ', 'pocket' ), $video_help );
}



/**
 * Saves the video embed code on post save
 *
 * @since 4.0
 */
function pocket_save_video_meta( $post_id ) {

	global $post;

	// Return early if this is a newly created post that hasn't been saved yet.
	if( 'auto-draft' == get_post_status( $post_id ) ) {
		return $post_id;
	}

	// Check if the user intended to change this value.
	if ( ! isset( $_POST['pocket_video_box_nonce'] ) || ! wp_verify_nonce( $_POST['pocket_video_box_nonce'], plugin_basename( __FILE__ ) ) )
		return $post_id;

	// Get post type object
	$post_type = get_post_type_object( $post->post_type );

	// Check if user has permission
	if( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	// Get posted data and sanitize it
	$new_video = ( isset( $_POST['pocket_video_field'] ) ? $_POST['pocket_video_field'] : '' );

	// Get existing video
	$video = get_post_meta( $post_id, 'video', true );

	// If a new video was submitted and there was no previous one, add it
	if( $new_video && '' == $video ) {
		add_post_meta( $post_id, 'video', $new_video, true );
	}

	// If the new video doesn't match the old video, update it.
	elseif( $new_video && $new_video != $video ) {
		update_post_meta( $post_id, 'video', $new_video );
	}

	// If there's no new video and an old one exists, delete it.
	elseif( '' == $new_video && $video ) {
		delete_post_meta( $post_id, 'video', $video );
	}

}
add_action( 'save_post', 'pocket_save_video_meta' );