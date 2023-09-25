<?php
/**
*
* Template Name:	Search Page
* Description:		Search Page
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

function be_custom_search_button_text( $text ) {
	return esc_attr( 'Go' );
}
add_filter('genesis_search_button_text', 'be_custom_search_button_text');

// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php genesis_do_post_title(); ?>
				</div>
			</div>
		</div>

	<?php
}

// Entry Content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'tt_content', 1 );
function tt_content() {
	?>

		<div class="container content-wrap">
			<div class="row">
				<main class="col-sm-12">
					<?php get_search_form(); ?>
				</main>
			</div>
		</div>

	<?php
}


genesis();