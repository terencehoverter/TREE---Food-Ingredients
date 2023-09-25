<?php
/**
 * Tree Top Corp and CPG.
 *
 * This file adds the single post template to the Tree Top Corp and CPG Theme.
 *
 * @package Tree Top Corp and CPG
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 * @link    http://www.3rdstudio.com/
 */

//add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Add body class if post has featured image.
add_filter( 'body_class', 'treetopcc_body_class_post' );
function treetopcc_body_class_post( $classes ) {

	if ( has_post_thumbnail() ) {
		$classes[] = 'featured-image';
	}

	return $classes;

}

// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
					<?php genesis_do_post_title(); ?>
					<?php genesis_post_info(); ?>
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
				<div class="col-sm-9 col-sm-push-3">
					
				</div>
			</div>
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
						<?php genesis_do_post_content(); ?>
					</article>

				</main>
				<div class="col-sm-3 col-sm-pull-9 primary-sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="https://schema.org/WPSideBar">
					<?php
					genesis_widget_area( 'blog-cagetory-menu' );
					?>
				</div>
			</div>
		</div>

	<?php
}

/*
// Enqueue Backestretch scripts.
add_action( 'wp_enqueue_scripts', 'treetopcc_enqueue_backstretch_post' );
function treetopcc_enqueue_backstretch_post() {

	if ( has_post_thumbnail() ) {

		wp_register_script( 'treetopcc-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.js', array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'treetopcc-backstretch-set', get_stylesheet_directory_uri() . '/js/backstretch-set.js', array( 'jquery', 'treetopcc-backstretch' ), '1.0.0', true );

	}

}

// Run functions if post has featured image and full-width content layout.
add_action( 'genesis_before', 'treetopcc_setup_full_width' );
function treetopcc_setup_full_width() {

	$run = genesis_site_layout() === 'full-width-content' && has_post_thumbnail();

	if ( ! $run ) {
		return;
	}

	// Localize Backstretch script.
	
	add_action( 'genesis_after', 'treetopcc_set_background_image_post' );
	function treetopcc_set_background_image_post() {

		wp_enqueue_script( 'treetopcc-backstretch' );
		wp_enqueue_script( 'treetopcc-backstretch-set' );

		$image = array( 'src' => has_post_thumbnail() ? genesis_get_image( array( 'format' => 'url' ) ) : '' );
		wp_localize_script( 'treetopcc-backstretch-set', 'BackStretchImg', $image );

	}

	// Hook entry background area.
	add_action( 'genesis_after_header', 'treetopcc_entry_background_post' );
	function treetopcc_entry_background_post() {

		echo '<div class="entry-background"></div>';

	}

	// Output Gravatar before entry title.
	add_action( 'genesis_entry_header', 'treetopcc_gravatar_post', 7 );
	function treetopcc_gravatar_post() {

		echo '<div class="entry-avatar">';
		echo get_avatar( get_the_author_meta( 'user_email' ), 110 );
		echo '</div>';

	}
	
}
*/

// Add entry meta in entry footer.
//add_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
//add_action( 'genesis_entry_footer', 'genesis_post_meta' );
//add_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
