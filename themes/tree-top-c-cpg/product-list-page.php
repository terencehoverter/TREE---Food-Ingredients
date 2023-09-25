<?php
/**
*
* Template Name:	Product List Page
* Description:		Product List Page
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
	function add_body_class( $classes ) {
		$classes[] = 'tt-product-list-page';
		return $classes;
}

// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php genesis_do_post_title(); ?>
			</div>
		</div>
	</div>

	<?php
}

// banner image
add_action( 'genesis_before_entry_content', 'treetop_list_banner' );
function treetop_list_banner() {
	$top_banner = get_field('top_banner');
	$img_or_slide_desk = $top_banner['desktop_image_or_slideshow'];
	$img_or_slide_mobile = $top_banner['mobile_image_or_slideshow'];
	$catalog = $top_banner['show_product_catalog'];

	// Desktop
	if( $img_or_slide_desk == 'img'):
		if( $top_banner['desktop_image'] ):
			?>
			<div class="list-banner list-banner_img hidden-xs"><?php echo wp_get_attachment_image( $top_banner['desktop_image'], 'full' ); ?></div>
			<?php
		endif;
	elseif( $img_or_slide_desk == 'slide'):
		if( $top_banner['desktop_slideshow'] ):
			?>
			<div class="list-banner list-banner_slide hidden-xs"><?php echo do_shortcode($top_banner['desktop_slideshow']); ?></div>
			<?php
		endif;
	endif;

	// Mobile
	if( $img_or_slide_desk == 'img'):
		if( $top_banner['mobile_image'] ):
			?>
			<div class="list-banner list-banner_img hidden-sm hidden-md hidden-lg"><?php echo wp_get_attachment_image( $top_banner['mobile_image'], 'full' ); ?></div>
			<?php
		endif;
	elseif( $img_or_slide_desk == 'slide'):
		if( $top_banner['mobile_slideshow'] ):
			?>
			<div class="list-banner list-banner_slide hidden-sm hidden-md hidden-lg"><?php echo do_shortcode($top_banner['mobile_slideshow']); ?></div>
			<?php
		endif;
	endif;

	// Catalog
	if( $catalog == 'yes' ):
		?>
		<div class="glamour-text-wrap">
      		<div class="container">
        		<div class="row">
          			<div class="col-sm-6 col-md-6 col-lg-7">
            			<div class="glamour-text">
							<?php echo $top_banner['product_catalog_text'] ?>
						</div>
					</div>
					<div class="col-sm-6 col-md-5 col-md-push-1 col-lg-4 col-lg-push-1">
						<div class="product-catalog">
							<div class="prod-cat-wrap">
								<a class="prod-cat-img" href="/wp-content/uploads/2022/03/TT-Ingredients-Product-Catalog-2022.pdf" target="_blank"><img alt="Product Catalog" src="/wp-content/uploads/2022/03/product-catalog-min.png" /></a>
								<a class="prod-cat-btn" href="/wp-content/uploads/2022/03/TT-Ingredients-Product-Catalog-2022.pdf" target="_blank">Download Our<br />Product Catalog</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	endif;

}



// Content
add_action( 'genesis_entry_content', 'treetop_content', 1 );
function treetop_content() {
	?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php the_field('top_content'); ?>
			</div>
		</div>

			<?php
			// Alternating Rows
			// Check rows exists.
			if( have_rows('alternating_rows') ):

				// Loop through rows.
				while( have_rows('alternating_rows') ) : the_row();

					?>
					<div class="row tting-alternating-row">
						<?php

							$text_side = get_sub_field('text_side');
							if( $text_side == 'right' ):
								?>
								<div class="col-sm-5">
									<div class="alt-img-wrap">
										
										<div class="alt-img">
											<h2 class="visible-xs-block"><a href="<?php echo the_sub_field('title_link'); ?>"><?php the_sub_field('title'); ?></a></h2>
											<img src="<?php the_sub_field('image'); ?>" />
										</div>
									</div>
								</div>
								<div class="col-sm-7 col-lg-6 col-lg-offset-1">
									<div class="alt-txt-wrap">
										<div class="alt-txt">
											<h2 class="hidden-xs"><a href="<?php echo the_sub_field('title_link'); ?>"><?php the_sub_field('title'); ?></a></h2>
											<?php the_sub_field('text'); ?>
										</div>
									</div>
									
								</div>
								<?php
							else :
								?>
								<div class="col-sm-5 col-sm-push-7">
									<div class="alt-img-wrap">
										
										<div class="alt-img">
											<h2 class="visible-xs-block"><a href="<?php echo the_sub_field('title_link'); ?>"><?php the_sub_field('title'); ?></a></h2>
											<img src="<?php the_sub_field('image'); ?>" />
										</div>
									</div>
								</div>
								<div class="col-sm-7 col-sm-pull-5 col-lg-6">
									<div class="alt-txt-wrap">
										<div class="alt-txt">
											<h2 class="hidden-xs"><a href="<?php echo the_sub_field('title_link'); ?>"><?php the_sub_field('title'); ?></a></h2>
											<?php the_sub_field('text'); ?>
										</div>
									</div>
									
								</div>
								<?php
							endif;

						?>

					</div>
					<?php

				// End loop.
				endwhile;

			// No value.
			else :
				// Do something...
			endif; ?>

			<?php 
			if( have_rows('list_section') ): 

				while( have_rows('list_section') ): the_row(); 
					$html_achor = get_sub_field('html_anchor');
					if( $html_achor ) {
						$section_id = ' id="'.$html_achor.'"';
					}
					?>

					<div class="row">
						<div class="col-sm-12 product-list-wrap">

							<h2<?php echo $section_id; ?>><?php the_sub_field('list_heading'); ?></h2>
							<div><?php the_sub_field('list_content'); ?></div>

							<?php
							if( have_rows('list_pages') ): ?>

								<ul class="product-list">

									<?php
									while( have_rows('list_pages') ): the_row(); 
										$post_object_page = get_sub_field('list_page');
										$post_object_page_url = get_permalink($post_object_page->ID);
										// Get package size to print after product name
										$package_size = get_field('package_size', $post_object_page->ID);
										if (!empty($package_size)) {
											$print_package_size = ", ".$package_size;
										}


										?>

										<li class="product_page">
											<a href="<?php echo $post_object_page_url; ?>">
												<?php echo get_the_post_thumbnail( $post_object_page, 'full' ); ?>
												<div><?php echo $post_object_page->post_title.$print_package_size; ?></div>
											</a>
										</li>

									<?php endwhile; // have_rows('list_pages') ?>
									<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

								</ul>

							<?php endif; // have_rows('list_pages') ?>

						</div>
					</div>

				<?php endwhile; // have_rows('list-section') ?>

			<?php endif; // have_rows('list-section') ?>

			

	</div>
	
	<?php
	// Lower Banner
	?>

	<div class="product-lower-banner">
		<?php

		$lower_image = get_field('lower_banner');

		/* $size = 'full'; // (thumbnail, medium, large, full or custom size)
		if( $lower_image ) {
			echo wp_get_attachment_image( $lower_image, $size );
		} */

		?>
		<style>
			.product-lower-banner {
				background-image: url('<?php echo $lower_image; ?>');
				background-position: 50% 50%;
				background-repeat: no-repeat;
				background-size: cover;
				height: 500px;
			}
		</style>
	</div>

	<?php
}



genesis();