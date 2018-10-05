<?php

/**
 * Theme Customizer
 *
 * @package Pocket
 * @since Pocket 1.0
 */


add_action( 'customize_register', 'pocket_customizer_register' );

// Add CSS textarea
if( ! pocket_is_wpcom() ) {
	if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Pocket_Textarea_Control' ) && ! pocket_is_wpcom() ) {
		class Pocket_Textarea_Control extends WP_Customize_Control {
			public $type = 'textarea';

			public function render_content() {
				?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="8" style="width:100%; font-family: 'Courier 10 Pitch', Courier, monospace;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			<?php
			}
		}
	}
}

/**
 * Sanitize strings
 */
function pocket_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize grayscale image effect
 */
function pocket_sanitize_bw_select( $input ) {
    $valid = array(
        'disable'	=> __( 'Disable', 'pocket' ),
        'enable'	=> __( 'Enable', 'pocket' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize color scheme
 */
function pocket_sanitize_scheme_select( $input ) {
    $valid = array(
    	'dark'	=> __( 'Dark', 'pocket' ),
        'light'	=> __( 'Light', 'pocket' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * @param WP_Customize_Manager $wp_customize
 */
function pocket_customizer_register( $wp_customize ) {

	// Pocket Style Options

	$wp_customize->add_section( 'pocket_customizer_basic', array(
		'title'    => __( 'Theme Options', 'pocket' ),
		'priority' => 1
	) );

	// Logo Image
	$wp_customize->add_setting( 'pocket_customizer_logo', array() );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pocket_customizer_logo', array(
		'label'    => __( 'Logo Upload', 'pocket' ),
		'section'  => 'pocket_customizer_basic',
		'settings' => 'pocket_customizer_logo'
	) ) );

	// Accent Color
	if( ! pocket_is_wpcom() ) {
		$wp_customize->add_setting( 'pocket_customizer_accent', array(
			'default'  			=> '#DD574C',
			'sanitize_callback' => 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pocket_customizer_accent', array(
			'label'    => __( 'Accent Color', 'pocket' ),
			'section'  => 'pocket_customizer_basic',
			'settings' => 'pocket_customizer_accent'
		) ) );
	}

	// Color Scheme
	if( ! pocket_is_wpcom() ) {
		$wp_customize->add_setting( 'pocket_customizer_color_scheme', array(
			'default'           => 'dark',
			'capability'        => 'edit_theme_options',
			'type'              => 'option',
			'sanitize_callback' => 'pocket_sanitize_scheme_select'
	    ));

	    $wp_customize->add_control( 'pocket_customizer_color_scheme_select', array(
			'settings' => 'pocket_customizer_color_scheme',
			'label'    => __( 'Color Scheme', 'pocket' ),
			'section'  => 'pocket_customizer_basic',
			'type'     => 'select',
			'choices'  => array(
				'dark'     => __( 'Dark', 'pocket' ),
				'light'    => __( 'Light', 'pocket' ),
			),
	    ) );
	}

    // Featured Image Grayscale Effect
	$wp_customize->add_setting( 'pocket_customizer_bw_image', array(
		'default'           => 'disable',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'pocket_sanitize_bw_select',
		'type'              => 'option',
    ));

    $wp_customize->add_control( 'pocket_customizer_bw_image_select', array(
        'settings'	=> 'pocket_customizer_bw_image',
        'label'		=> __( 'Grayscale Featured Image Effect', 'pocket' ),
        'section'	=> 'pocket_customizer_basic',
        'type'		=> 'select',
        'choices'	=> array(
            'disable'	=> __( 'Disable', 'pocket' ),
            'enable'	=> __( 'Enable', 'pocket' ),
        ),
    ));

	// Custom CSS
	if( ! pocket_is_wpcom() ) {
		$wp_customize->add_setting( 'pocket_customizer_css', array(
			'default' => '',
			'sanitize_callback' => 'pocket_sanitize_text'
		) );

		$wp_customize->add_control( new Pocket_Textarea_Control( $wp_customize, 'pocket_customizer_css', array(
			'label'    => __( 'Custom CSS', 'pocket' ),
			'section'  => 'pocket_customizer_basic',
			'settings' => 'pocket_customizer_css',
		) ) );
	}

	/**
	 * Footer tagline
	 */
	$wp_customize->add_setting( 'pocket_footer_text', array(
		'sanitize_callback' => 'pocket_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'pocket_footer_text', array(
			'label'    => esc_html__( 'Footer Tagline', 'pocket' ),
			'section'  => 'pocket_customizer_basic',
			'settings' => 'pocket_footer_text',
			'type'     => 'text',
			'priority' => 20
		)
	);
}

/**
 * Replaces the footer tagline text
 */
function pocket_filter_footer_text() {

	// Get the footer copyright text
	$footer_copy_text = get_theme_mod( 'pocket_footer_text' );

	if ( $footer_copy_text ) {
		// If we have footer text, use it
		$footer_text = $footer_copy_text;
	} else {
		// Otherwise show the fallback theme text
		$footer_text = '&copy; ' . date("Y") . sprintf( esc_html__( ' %1$s Theme by %2$s.', 'pocket' ), 'Pocket', '<a href="https://arraythemes.com/" rel="nofollow">Array</a>' );
	}

	return $footer_text;

}
add_filter( 'pocket_footer_text', 'pocket_filter_footer_text' );
