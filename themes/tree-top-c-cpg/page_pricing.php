<?php
/**
 * Tree Top Corp and CPG.
 *
 * This file adds the pricing page template to the Tree Top Corp and CPG Theme.
 *
 * Template Name: Pricing
 *
 * @package Tree Top Corp and CPG
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 * @link    http://www.3rdstudio.com/
 */

// Add pricing page body class to the head.
add_filter( 'body_class', 'treetopcc_add_body_class' );
function treetopcc_add_body_class( $classes ) {

	$classes[] = 'pricing-page';

	return $classes;

}

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Run the Genesis loop.
genesis();
