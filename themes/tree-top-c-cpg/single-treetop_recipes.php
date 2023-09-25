<?php
/**
*
* Template Name:	Recipe Page
* Description:		Recipe Page
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2018, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Code for recipe_content output is in /includes/recipe-output.php

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="entry-title">Applications</h1>
			</div>
		</div>
	</div>

	<?php
}


// Main content area
add_action( 'genesis_entry_content', 'treetop_recipe_content' );
function treetop_recipe_content() {
	?>

	<div class="container content-wrap">
		<div class="row">
			<main class="col-md-9 col-md-push-3">
				
				<article class="" itemscope itemtype="https://schema.org/CreativeWork">
				<?php genesis_do_post_title(); ?>
					<div class="row">
						<div class="col-md-4 col-md-push-8 recipe-aside">
							<?php the_post_thumbnail(); ?>
							<a class="sample-request-btn" href="/sample-request/">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
								<path d="M60 8h-56c-2.2 0-4 1.8-4 4v40c0 2.2 1.8 4 4 4h56c2.2 0 4-1.8 4-4v-40c0-2.2-1.8-4-4-4zM23.323 39.092l-12 8.727c-0.399 0.291-0.863 0.43-1.322 0.43-0.695 0-1.381-0.321-1.822-0.927-0.731-1.005-0.509-2.412 0.496-3.143l12-8.727c1.005-0.731 2.412-0.509 3.143 0.496s0.509 2.412-0.496 3.143zM55.82 47.323c-0.44 0.605-1.126 0.927-1.822 0.927-0.459 0-0.922-0.14-1.322-0.43l-12-8.727c-1.005-0.731-1.227-2.138-0.496-3.143s2.138-1.227 3.143-0.496l12 8.727c1.005 0.731 1.227 2.138 0.496 3.143zM55.323 19.82l-22 16c-0.394 0.287-0.859 0.43-1.323 0.43s-0.929-0.143-1.323-0.43l-22-16c-1.005-0.731-1.227-2.138-0.496-3.143s2.138-1.227 3.143-0.496l20.677 15.037 20.677-15.038c1.005-0.731 2.412-0.509 3.143 0.496s0.509 2.412-0.496 3.143z" fill="#ffffff" fill-opacity="0.9"></path>
								</svg>
								Request Sample
							</a>
						</div>
						<div class="col-md-8 col-md-pull-4 recipe-content">
							<?php the_field('recipe_content'); ?>
						</div>
					</div>

				</article>

				<?php
					// You may also like

					// Check if any YMAL posts are post_type = page.
					// This prevents posts deleted from Wordpress but not from the repeater to
					// not be displayed as the current post.
					$ymal_print = false;  // Set to false until we know we have a post_type = page.
					if( have_rows('you_may_also_like') ):

						while( have_rows('you_may_also_like') ): the_row();

							$post_object_rp = get_sub_field('product_page');

							// First check if $post_object_rp is true,
							// then check if post type is page.
							if ( $post_object_rp ) {
								if ( get_post_type( $post_object_rp->ID ) == 'page' ) {
									// If a 'page' exists in the repeater, set to print YMAL.
									$ymal_print = true;
								}
							}

						endwhile;
						wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly

					endif; 

					// Print YMAL if there are both rows in the repeater and at least one is post_type = page.
					if( have_rows('you_may_also_like') && $ymal_print ): ?>

						<div class="also-like">

							<h2><span>You may also like...</span></h2>
							<ul class="related-pages">
	
								<?php while( have_rows('you_may_also_like') ): the_row(); 
	
									$post_object_rp = get_sub_field('product_page');

									// First check if $post_object_rp is true.
									if( $post_object_rp ) {
										// Get URL and post type
										$post_object_rp_url = get_permalink($post_object_rp->ID);
										$post_type = get_post_type($post_object_rp->ID);
	
										// Only print li if current post is post_type = page.
										if ( get_post_type( $post_object_rp->ID ) == 'page' ) {
											?>
											<li class="related_page">
												<a href="<?php echo $post_object_rp_url; ?>">
													<?php echo get_the_post_thumbnail( $post_object_rp, 'full' ); ?>
													<?php echo $post_object_rp->post_title; ?>
												</a>
											</li>
											<?php
										}
									}

									
	
								endwhile;
								wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	
							</ul>

						</div>
			
					<?php endif; 

					// Related Applications

					if( have_rows('related_applications') ): ?>

						<div class="related-applications-wrap also-like">
							<div class="row">
								<div class="col-md-12">

									<h2><span>Related Applications...</span></h2>
									<div class="swiper swiper-applications2">
										<div class="swiper-wrapper">
											<?php
											while( have_rows('related_applications') ): the_row();
												$post_object_rp = get_sub_field('recipe_page');
												$post_object_rp_url = get_permalink($post_object_rp->ID);
											?>
												<div class="swiper-slide">
													<a href="<?php echo $post_object_rp_url; ?>">
														<?php echo get_the_post_thumbnail( $post_object_rp, 'full' ); ?>
														<?php echo $post_object_rp->post_title; ?>
													</a>
												</div>
											<?php 
											endwhile;
											wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
											?>
										</div>
										<div class="swiper-pagination"></div>
									</div>

								</div>
							</div>
						</div>

					<?php endif; ?>

			</main>
			<aside class="col-md-3 col-md-pull-9 primary-sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="https://schema.org/WPSideBar">
				<?php wp_nav_menu( array( 'theme_location' => 'recipe-cats' )); ?>
			</aside>
		</div>
	</div>



	
	<?php
}


genesis();