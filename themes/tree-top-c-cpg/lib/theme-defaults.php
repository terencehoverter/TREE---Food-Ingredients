<?php
/**
 * Tree Top Corp and CPG.
 *
 * This file adds the default theme settings to the Tree Top Corp and CPG Theme.
 *
 * @package Tree Top Corp and CPG
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 * @link    http://www.3rdstudio.com/
 */

add_filter( 'genesis_theme_settings_defaults', 'treetopcc_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @since 1.0.0
 */
function treetopcc_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 10;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'full-width-content';

	return $defaults;

}

add_action( 'after_switch_theme', 'treetopcc_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 *
 * @since 1.0.0
 */
function treetopcc_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 10,
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 0,
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'full-width-content',
		) );

	} 

	update_option( 'posts_per_page', 5 );

}

add_filter( 'simple_social_default_styles', 'treetopcc_social_default_styles' );
/**
 * Updates Simple Social Icon settings on activation.
 *
 * @since 1.0.0
 */
function treetopcc_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#f5f5f5',
		'background_color_hover' => '#000000',
		'border_radius'          => 3,
		'icon_color'             => '#000000',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 38,
		);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}
