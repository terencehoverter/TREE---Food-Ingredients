<?php
/**
 * Tree Top Corp and CPG.
 *
 * This file adds the Customizer additions to the Tree Top Corp and CPG Theme.
 *
 * @package Tree Top Corp and CPG
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 * @link    http://www.3rdstudio.com/
 */

add_action( 'customize_register', 'treetopcc_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function treetopcc_customizer_register( $wp_customize ) {

	$images = apply_filters( 'treetopcc_images', array( '1', '3' ) );

	$wp_customize->add_section( 'treetopcc_theme_options', array(
		'description' => __( 'Personalize the Tree Top Corp and CPG theme with these available options.', 'treetopcc-pro' ),
		'title'       => __( 'Theme Options', 'treetopcc-pro' ),
		'priority'    => 30,
	) );

	$wp_customize->add_section( 'treetopcc-settings', array(
		'description' => __( 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 800 pixels tall</strong>.', 'treetopcc-pro' ),
		'title'       => __( 'Front Page Background Images', 'treetopcc-pro' ),
		'priority'    => 35,
	) );

	foreach( $images as $image ) {

		// Add setting for front page background images.
		$wp_customize->add_setting( $image .'-treetopcc-image', array(
			'default'           => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $image ),
			'sanitize_callback' => 'esc_url_raw',
			'type'              => 'option',
		) );

		// Add control for front page background images.
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $image .'-treetopcc-image', array(
			'label'    => sprintf( __( 'Featured Section %s Image:', 'treetopcc-pro' ), $image ),
			'section'  => 'treetopcc-settings',
			'settings' => $image .'-treetopcc-image',
			'priority' => $image+1,
		) ) );

	}

	// Add setting for link color.
	$wp_customize->add_setting(
		'treetopcc_link_color',
		array(
			'default'           => treetopcc_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Add control for link color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'treetopcc_link_color',
			array(
				'description' => __( 'Change the default color for hovers for linked titles, menu links, entry meta links, and more.', 'treetopcc-pro' ),
				'label'       => __( 'Link Color', 'treetopcc-pro' ),
				'section'     => 'colors',
				'settings'    => 'treetopcc_link_color',
			)
		)
	);

	// Add setting for accent color.
	$wp_customize->add_setting(
		'treetopcc_accent_color',
		array(
			'default'           => treetopcc_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Add control for accent color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'treetopcc_accent_color',
			array(
				'description' => __( 'Change the default color for button hovers.', 'treetopcc-pro' ),
				'label'       => __( 'Accent Color', 'treetopcc-pro' ),
				'section'     => 'colors',
				'settings'    => 'treetopcc_accent_color',
			)
		)
	);

	// Add setting for footer start color.
	$wp_customize->add_setting(
		'treetopcc_footer_start_color',
		array(
			'default'           => treetopcc_customizer_get_default_footer_start_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Add control for footer start color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'treetopcc_footer_start_color',
			array(
				'description' => __( 'Change the default color for start of footer gradient.', 'treetopcc-pro' ),
				'label'       => __( 'Footer Start Color', 'treetopcc-pro' ),
				'section'     => 'colors',
				'settings'    => 'treetopcc_footer_start_color',
			)
		)
	);

	// Add setting for footer end color.
	$wp_customize->add_setting(
		'treetopcc_footer_end_color',
		array(
			'default'           => treetopcc_customizer_get_default_footer_end_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Add control for footer end color.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'treetopcc_footer_end_color',
			array(
				'description' => __( 'Change the default color for end of footer gradient.', 'treetopcc-pro' ),
				'label'       => __( 'Footer End Color', 'treetopcc-pro' ),
				'section'     => 'colors',
				'settings'    => 'treetopcc_footer_end_color',
			)
		)
	);

	// Add control for search option.
	$wp_customize->add_setting(
		'treetopcc_header_search',
		array(
			'default'           => treetopcc_customizer_get_default_search_setting(),
			'sanitize_callback' => 'absint',
		)
	);

	// Add setting for search option.
	$wp_customize->add_control(
		'treetopcc_header_search',
		array(
			'label'       => __( 'Show Menu Search Icon?', 'treetopcc-pro' ),
			'description' => __( 'Check the box to show a search icon in the menu.', 'treetopcc-pro' ),
			'section'     => 'treetopcc_theme_options',
			'type'        => 'checkbox',
			'settings'    => 'treetopcc_header_search',
		)
	);

}
