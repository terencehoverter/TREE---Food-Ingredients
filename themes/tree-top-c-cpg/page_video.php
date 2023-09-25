<?php
/**
*
* Template Name:	Video  Page
* Description:		Video  Page
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/



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

	$content_top = get_field('content_top');
	$content_bottom = get_field('content_bottom');

	?>

		<div class="container content-wrap">

			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
					<div class="page-banner-image">
						<?php  

						$banner_area = get_field('banner_area');
						if( !empty($banner_area) ): 

							echo $banner_area;

						endif; ?>
					</div>
				</div>
			</div>

			<?php if( have_rows('video') ): 

				?>
				<div class="row">
					<main class="col-sm-9 col-sm-push-3">
						<article class="" itemscope itemtype="https://schema.org/CreativeWork">
							
							<?php

							while( have_rows('video') ): the_row(); 

								?>
								<div class="row video-item">
								<?php

									// vars
									$video_title = get_sub_field('video_title');
									$video_code = get_sub_field('video_code');
									$video_anchor_class = get_sub_field('video_anchor_class');
									?>

									<h2 id="<?php echo $video_anchor_class; ?>" class="anchor-offset"><?php echo $video_title; ?></h2>
									<?php echo $video_code; ?>

								</div>

							<?php endwhile; ?>

							
						</article>
					</main>
					<aside class="col-sm-3 col-sm-pull-9 double primary-sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="https://schema.org/WPSideBar">
					<?php
					genesis_widget_area( 'primary-sidebar' );
					?>
				</aside>
				</div>

			<?php endif; ?>

		</div>

	<?php
}

genesis();