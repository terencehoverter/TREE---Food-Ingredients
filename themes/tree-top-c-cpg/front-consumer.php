<?php
/**
*
* Template Name:	CPG Home
* Description:		CPG Home
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Remove primary sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );

// Add front-page body class.
add_filter( 'body_class', 'treetopcc_body_class' );
function treetopcc_body_class( $classes ) {

	$classes[] = 'cpg-front-page';

	return $classes;

}

// Remove h1
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Setup content
add_action( 'genesis_entry_content', 'tt_content', 1 );
function tt_content() {
	?>

	<div class="row01">
		<div class="home-slider-desktop hidden-xs">
			<?php 
			$home_slider_desktop = get_field('cpg_slideshow_shortcode_desktop');
			echo do_shortcode($home_slider_desktop); ?>
		</div>
		<div class="home-slider-mobile hidden-sm hidden-md hidden-lg">
			<?php 
			$home_slider_mobile = get_field('cpg_slideshow_shortcode_mobile');
			echo do_shortcode($home_slider_mobile); ?>
		</div>
		<div class="fun-strawberry">
			<img src="/wp-content/themes/tree-top-c-cpg/images/fun-strawberry.png" alt="Tree Top" />
		</div>
	</div>

	<div class="row02wrap">
		<a href="/consumer/fruit-products/">
			<div class="row02">
				<div class="container">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 cpg-home-products">
							<div class="hidden-sm hidden-md hidden-lg">
								<img src="https://www.treetop.com/wp-content/uploads/2020/04/homepage-product-section-mobile-01b.jpg" />
							</div>
							<div class="hidden-xs">
								<?php the_field('cpg_row_01'); ?>
							</div>
							<!-- <h2>Products</h2> -->
							<div class="hidden-sm hidden-md hidden-lg">
								<div class="cpg-home-products-txt">No secrets. No surprises.<br />Simple ingredients.</div>
							</div>
							<div class="hidden-xs">
								<div class="cpg-home-products-txt">No secrets.<br />No surprises.<br />Simple ingredients.</div>
							</div>
							<a href="/consumer/fruit-products/" class="cgp-home-products-link">View Our Products</a>
						</div>
					</div>
				</div>
			</div>
		</a>
		<div class="fun-scooter">
			<img src="/wp-content/themes/tree-top-c-cpg/images/fun-scooter.png" alt="Tree Top" />
		</div>
	</div>

	<div class="row03wrap">
		<a class="row03" href="/consumer/where-to-buy/">
			<div class="container">
				<div class="row">
					<!--
					<div class="col-sm-12">
						<h2>Where to Buy</h2>
					</div>
					-->
				</div>
			</div>
			<div class="hidden-sm hidden-md hidden-lg">
				<img src="https://www.treetop.com/wp-content/uploads/2020/04/homepage-where-section-mobile-01b.jpg" />
			</div>
			<div class="hidden-xs">
				<?php the_field('cpg_row_02'); ?>
			</div>
			<div class="cpg-home-where-txt">We all have a hand in what we harvest.</div>
			<div class="cgp-home-where-link">Where to Buy</div>
			<!--<a href="/consumer/where-to-buy/" class="cgp-home-where-link">View Our Products</a>-->
		</a>
		<div class="fun-skateboard">
			<img src="/wp-content/themes/tree-top-c-cpg/images/fun-skateboard.png" alt="Tree Top" />
		</div>
	</div>

	<div class="row04">
		<div class="row04heading">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<a href="/consumer/our-brand/videos/">
							<h2>Our Brand</h2>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php the_field('cpg_row_03');  ?>
	</div>


	<?php
	$row05 = get_field('cpg_row_04');
	?>
	<div class="row05">
		<div class="container">
			<div class="row">
				<div class="col-sm-5 col-sm-offset-1">
					<?php echo $row05['cpg_nutrition_left']; ?>
				</div>
				<div class="col-sm-5">
					<?php echo $row05['cpg_nutrition_right']; ?>
				</div>
			</div>
		</div>
	</div>

	<a href="/consumer/recipes/">
		<div class="row06">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-1 col-sm-8 col-sm-offset-1">
						<img class="alignnone size-full wp-image-766" src="/wp-content/uploads/2018/10/recipes.png" alt="Recipes" width="356" height="243" srcset="/wp-content/uploads/2018/10/recipes.png 356w, /wp-content/uploads/2018/10/recipes-150x102.png 150w" sizes="(max-width: 356px) 100vw, 356px">
					</div>
				</div>
			</div>
		</div>
	</a>

	<div class="row07">
		<div class="container">
			<div class="row">
				<h2>See the good – share the good</h2>
				<?php echo do_shortcode('[ff id="1"]'); ?>
			</div>
		</div>
	</div>

	<?php
}




genesis();