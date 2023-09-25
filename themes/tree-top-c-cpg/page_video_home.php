<?php
/**
*
* Template Name:	Video Home Page
* Description:		Video Home Page
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
				<div class="col-sm-8 col-sm-push-2">
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

	$content_top = get_field('content_top');
	$content_bottom = get_field('content_bottom');

	?>

		<div class="container content-wrap">

			<div class="row">
				<div class="col-sm-8 col-sm-push-2">
					<div class="page-banner-image">
						<?php  

						$banner_area = get_field('banner_area');
						if( !empty($banner_area) ): 

							echo $banner_area;

						endif; ?>
					</div>
					<?php echo $content_top; ?>
				</div>
			</div>

			<?php if( have_rows('video_pages') ): 

				?>
				<div class="row">
					<main class="col-sm-8 col-sm-push-2">
						<div class="row">
						<?php

						while( have_rows('video_pages') ): the_row(); 

							// vars
							$video_title = get_sub_field('video_page_title');
							$video_image = get_sub_field('video_page_image');
							$video_link = get_sub_field('video_page_link');
							?>
			
							<div class="col-sm-6">
								<h2><a href="<?php echo $video_link; ?>"><?php echo $video_title; ?></a></h2>
								<a href="<?php echo $video_link; ?>">
									<img src="<?php echo $video_image['url']; ?>" alt="<?php echo $video_image['alt']; ?>" />
								</a>
							</div>

						<?php endwhile; ?>

					</div>
				</main>
			</div>

			<?php endif; ?>


			<div class="row">
				<div class="col-sm-8 col-sm-push-2">
					<?php echo $content_bottom; ?>
				</div>
			</div>

	<?php
}

genesis();