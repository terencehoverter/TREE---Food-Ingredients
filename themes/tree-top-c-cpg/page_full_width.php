<?php
/**
*
* Template Name:	Page - Full Width
* Description:		Page full width
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
				<div class="col-sm-12">
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
								<a class="prod-cat-img" href="/wp-content/uploads/2022/03/Tree-Top-Ingredient-Product-Catalog.pdf" target="_blank"><img alt="Product Catalog" src="/wp-content/uploads/2022/03/product-catalog-min.png" /></a>
								<a class="prod-cat-btn" href="/wp-content/uploads/2022/03/Tree-Top-Ingredient-Product-Catalog.pdf" target="_blank">Download Our<br />Product Catalog</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	endif;

}

// Entry Content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'tt_content', 1 );
function tt_content() {
	?>

		<div class="container content-wrap">
			<div class="row">
				<main class="col-sm-12">
					
						<?php  

						$banner_area = get_field('banner_area');
						if( !empty($banner_area) ): 
							?><div class="page-banner-image"><?php
							echo $banner_area;
							?></div><?php
						endif; ?>
					
					<article class="" itemscope itemtype="https://schema.org/CreativeWork">
						<?php genesis_do_post_content(); ?>
					</article>

				</main>
			</div>
		</div>

	<?php
}






genesis();