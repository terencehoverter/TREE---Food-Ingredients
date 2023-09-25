<?php
/**
*
* Template Name:	Specialty Market Page
* Description:		Specialty Market Page
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
		$classes[] = 'tt-product-list-page tt-specialty-market-page';
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
    elseif( $img_or_slide_desk == 'video'):
        if( $top_banner['desktop_video'] ):
            ?>
            <style>
                .list-banner {
                    max-width: 900px;
                    margin: auto;
                }
            </style>
            <div class="list-banner list-banner_video hidden-xs"><?php echo $top_banner['desktop_video']; ?></div>
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
    elseif( $img_or_slide_desk == 'video'):
        if( $top_banner['mobile_video'] ):
            ?>
            <div class="list-banner list-banner_video hidden-sm hidden-md hidden-lg"><?php echo $top_banner['mobile_video']; ?></div>
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
								<a class="prod-cat-img" href="https://foodingredients.treetop.com/wp-content/uploads/2022/03/TT-Ingredients-Product-Catalog-2022.pdf" target="_blank"><img alt="Product Catalog" src="/wp-content/uploads/2022/03/product-catalog-min.png" /></a>
								<a class="prod-cat-btn" href="https://foodingredients.treetop.com/wp-content/uploads/2022/03/TT-Ingredients-Product-Catalog-2022.pdf" target="_blank">Download Our<br />Product Catalog</a>
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

	<div class="container" style="margin-top:40px">
            <div class="row">
                <div class="col-md-9">

                    <?php the_field('top_content'); ?>


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

                    <?php the_field('lower_content'); ?>
                
                </div>
                <div class="col-md-3">
                    <?php genesis_widget_area( 'primary-sidebar' ); ?>
                </div>
            </div>

	</div>
	
	<?php
    // Gravity Form if Pet Food
    if( is_page('pet-food-ingredients')) {
        ?>
        <div class="pet-sample-request">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-push-2">
                        <h1 style="text-align: center;">Contact us for more info and a sample today!</h1>
                        <p style="text-align: center;">To qualify for samples, you must be a pet food manufacturer and be able to meet our minimum order requirements for industrial quantities.</p>
                        <?php
                        echo do_shortcode( '[gravityform id="5" title="false" description="false"]' );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <style>#input_5_8{height: 42.38px;}</style>
        <?php
    }

	// Lower Banner
    $lower_image = get_field('lower_banner');
    if($lower_image):
	?>

        <div class="product-lower-banner">
            <?php

            

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
    endif;

    // Related Applications

	if( have_rows('product_related_applications_standalone') ): ?>

		<div class="container related-applications-wrap">
			<div class="row">
				<div class="col-md-12">

					<h2><span>Related Applications</span></h2>
					<div class="swiper swiper-applications2">
						<div class="swiper-wrapper">
							<?php
							while( have_rows('product_related_applications_standalone') ): the_row();
								$post_object_rp = get_sub_field('application');
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

	<?php endif;
}



genesis();