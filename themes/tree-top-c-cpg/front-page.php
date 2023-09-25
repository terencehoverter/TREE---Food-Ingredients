<?php
/**
 * Tree Top Corp and CPG.
 *
 * This file adds functions to the Tree Top Corp and CPG Theme.
 *
 * @package Tree Top Corp and CPG
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 * @link    http://www.3rdstudio.com/
 */



// Define scripts and styles.
add_action( 'wp_enqueue_scripts', 'treetopcc_enqueue_front_script_styles' );
function treetopcc_enqueue_front_script_styles() {

	//wp_enqueue_script( 'treetopcc-front-script', get_stylesheet_directory_uri() . '/js/wow.js' );
	//wp_enqueue_script( 'treetopcc-front-script', get_stylesheet_directory_uri() . '/js/front-page.js', array( '' ), '1.0.0' );
	//wp_enqueue_style( 'treetopcc-front-styles', get_stylesheet_directory_uri() . '/style-front.css' );

}

// Remove primary sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );

// Add front-page body class.
add_filter( 'body_class', 'treetopcc_body_class' );
function treetopcc_body_class( $classes ) {

	$classes[] = 'ingredients-front-page';

	return $classes;

}



// Remove h1
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Content
add_action( 'genesis_entry_content', 'tt_content', 1 );
function tt_content() {
	// Homepage content goes here
	?>

	<?php
}

add_action ( 'genesis_after', 'treetop_wow' );
function treetop_wow() {
?>
	<script type="text/javascript" src="/wp-content/themes/tree-top-c-cpg/js/wow.js" ></script> 
	<script>
		new WOW().init();
	</script>
<?php
}

// Run the Genesis loop.
genesis();
