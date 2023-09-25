<?php
/**
*
* Template Name:	Page: content-sidebar
* Description:		Page: content-sidebar
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );


// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
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
				<main class="col-sm-9">
					<!-- <div class="page-banner-image">
						<?php  

						/* $banner_area = get_field('banner_area');
						if( !empty($banner_area) ): 

							echo $banner_area;

						endif; */ ?>
					</div> -->
					<article class="" itemscope itemtype="https://schema.org/CreativeWork">
						<?php genesis_do_post_content(); ?>
					</article>

				</main>
				<aside class="col-sm-3 double primary-sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="https://schema.org/WPSideBar">
					<?php
					genesis_widget_area( 'primary-sidebar' );
					?>
				</aside>
			</div>
		</div>

	<?php
}






genesis();