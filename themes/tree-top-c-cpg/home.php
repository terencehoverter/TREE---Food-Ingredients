<?php
/**
*
* Template Name:	Blog Home
* Description:		Blog Home
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Remove archive description
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );


add_action('genesis_before_loop', 'wpb_change_home_loop');
/*
 * Adding in our new home loop.
 */
function wpb_change_home_loop() {
	if ( is_home() ) {

		/** Replace the home loop with our custom **/
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'wpb_custom_loop' );
		/** Custom  loop **/
		function wpb_custom_loop() {
		if ( have_posts() ) :
				do_action( 'genesis_before_while' );
				
				while ( have_posts() ) : the_post();
					do_action( 'genesis_before_entry' );
					
					printf( '<article %s>', genesis_attr( 'entry' ) );

						echo genesis_do_post_image(); //Add in featured image
						do_action( 'genesis_entry_header' );
						do_action( 'genesis_before_entry_content' );
						printf( '<div %s>', genesis_attr( 'entry-content' ) );
						
						//do_action( 'genesis_entry_content' ); //Remove standard excerpt
						
						
						
						echo the_excerpt_max_charlength(200); //change amount of characters to display
						
						echo '</div>';
						do_action( 'genesis_after_entry_content' );
						do_action( 'genesis_entry_footer' );
					echo '</article>';
					
					do_action( 'genesis_after_entry' );
				endwhile; //* end of one post

				do_action( 'genesis_after_endwhile' );
			else : //* if no posts exist
				do_action( 'genesis_loop_else' );

			endif; //* end loop
		}
		add_action( 'genesis_sidebar', 'blog_home_sidebar' );
		function blog_home_sidebar() {
			//genesis_widget_area( 'blog-cagetory-menu' );

			if (is_category()) {
			    $cat = get_query_var('cat');
			    $this_category = get_category($cat);
			    $this_category = wp_list_categories('hide_empty=0&hierarchical=true&orderby=id&show_count=0&title_li=&use_desc_for_title=1&child_of='.$this_category->cat_ID."&echo=0");
			    if($this_category !='<li>No categories</li>')
			    {
			     echo '<h3>Categories</h3>'; 
			     echo '<ul>'.$this_category.'</ul>'; 
			    }
			}

		}
		
	}
}
add_filter( 'genesis_attr_content', 'add_class_content' );
function add_class_content( $attributes ) {
 
	 // add original plus extra CSS classes
	 $attributes['class'] .= ' col-sm-9 col-sm-push-3';
	 
	 // return the attributes
	 return $attributes;
 
}
add_filter( 'genesis_attr_sidebar-primary', 'add_class_sidebar' );
function add_class_sidebar( $attributes ) {
 
	 // add original plus extra CSS classes
	 $attributes['class'] .= ' col-sm-3 col-sm-pull-9';
	 
	 // return the attributes
	 return $attributes;
 
}
// Add opening container and row divs
add_action('genesis_before_content', 'tt_opening_divs', 1);
function tt_opening_divs() {
	?>
	<header class="entry-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-sm-push-3">
					<h1 class="entry-title" itemprop="headline">Blog</h1>
				</div>
			</div>
		</div>
	</header>
	<?php
	echo "<div class=\"container\">";
	echo "  <div class=\"row\">";
}
// Add closing container and row divs
add_action('genesis_after_content', 'tt_closing_divs', 50);
function tt_closing_divs() {
	echo "</div>";
	echo "  </div>";
}
/*
 * Limit the excerpt by character.
 *
 * @link Reference - http://codex.wordpress.org/Function_Reference/get_the_excerpt
 */
function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo ' <br><a href="' . get_permalink() . '" class="more-link" title="Read More">Read More</a>';
	} else {
		echo $excerpt;
	}
}

unregister_sidebar( 'sidebar' );

genesis();
