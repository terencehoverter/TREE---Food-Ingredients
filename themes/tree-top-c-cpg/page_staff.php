<?php
/**
*
* Template Name:	Bio List
* Description:		Bio List Page
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
				<main class="col-sm-9 col-sm-push-3">
					<div class="page-banner-image">
						<?php  

						$banner_area = get_field('banner_area');
						if( !empty($banner_area) ): 

							echo $banner_area;

						endif; ?>
					</div>
					<article class="" itemscope itemtype="https://schema.org/CreativeWork">
						
						<?php if( have_rows('staff_list') ): 

							while( have_rows('staff_list') ): the_row(); 

								// vars
								$staff_name = get_sub_field('staff_name');
								$staff_image = get_sub_field('staff_image');
								$staff_bio = get_sub_field('staff_bio');
								?>

								<div class="row">
									<div class="col-sm-3">
										<img src="<?php echo $staff_image['url']; ?>" alt="<?php echo $staff_image['alt']; ?>" />
									</div>
									<div class="col-sm-9">
										<p><strong><?php echo $staff_name; ?></strong></p>
										<p><?php echo $staff_bio; ?></p>
									</div>
								</div>


							<?php endwhile; ?>

						<?php endif; ?>

						<?php genesis_do_post_content(); ?>
					</article>

				</main>
				<aside class="col-sm-3 col-sm-pull-9 double primary-sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="https://schema.org/WPSideBar">
					<?php
					genesis_widget_area( 'primary-sidebar' );
					?>
				</aside>
			</div>
		</div>

	<?php
}






genesis();