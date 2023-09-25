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

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'treetopcc_localization_setup' );
function treetopcc_localization_setup(){

	load_child_theme_textdomain( 'treetopcc-pro', get_stylesheet_directory() . '/languages' );

}

// Add the theme helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Include the Customizer CSS for the WooCommerce plugin.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Include notice to install Genesis Connect for WooCommerce.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

add_theme_support( 'align-wide' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Tree Top Corp and CPG' );
define( 'CHILD_THEME_URL', 'http://www.3rdstudio.com/' );
define( 'CHILD_THEME_VERSION', '22.1.7' );

// Enqueue scripts and styles.

add_action( 'wp_enqueue_scripts', 'treetopcc_enqueue_scripts_styles' );
function treetopcc_enqueue_scripts_styles() {

	wp_enqueue_style( 'treetopcc-fonts', 'https://use.typekit.net/xwb0stc.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400&display=swap', false );

	if( is_front_page() ) {
		//wp_enqueue_script( 'treetopcc-front-script', get_stylesheet_directory_uri() . '/js/front-page.js', array( '' ), '1.0.0' );
		wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js', array(), false, true );
		wp_enqueue_script( 'gsap-st-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/ScrollTrigger.min.js', array(), false, true );
		wp_enqueue_script( 'tting-front-script', get_stylesheet_directory_uri() . '/js/front-page.js', array(), '1.0.0', true );
	}
	//wp_enqueue_style( 'treetopcc-ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );

	//wp_enqueue_script( 'treetopcc-global-script', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), '1.0.0', true );

	//$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	//wp_enqueue_script( 'treetopcc-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	//wp_localize_script( 'treetopcc-responsive-menu', 'genesis_responsive_menu', treetopcc_responsive_menu_settings() );

}

// Enqueue Swiperjs
add_action( 'wp_enqueue_scripts', 'ls_scripts_styles', 20 );
/**
 * SwiperJS Scripts
 */
function ls_scripts_styles() {
	if( is_page_template( 'product-page.php' ) or is_page_template('page-specialty-markets.php') or is_singular( 'treetop_recipes' ) ) {
		//wp_enqueue_style( 'swipercssbundle', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css' , array(), '8.0.6', 'all' );
		//wp_enqueue_script( 'swiperjsbundle', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), '8.0.6', true );
		wp_register_script( 'Swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', null, null, true );
		wp_enqueue_script('Swiper');
		wp_register_script( 'SwiperInit', get_stylesheet_directory_uri().'/js/swiper-bundle-init.js', null, null, true);
		wp_enqueue_script('SwiperInit');
		wp_register_style( 'SwiperCSS', 'https://unpkg.com/swiper/swiper-bundle.min.css' );
		wp_enqueue_style('SwiperCSS');
	}
}

// Add IE Edge
function keep_ie_modern() 
{
    echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"/> \n";
} 
add_action( 'wp_head', 'keep_ie_modern', 1 );




// Define our responsive menu settings.
/*
function treetopcc_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'treetopcc-pro' ),
		'menuIconClass'    => 'ionicons-before ion-navicon',
		'subMenu'          => __( 'Submenu', 'treetopcc-pro' ),
		'subMenuIconClass' => 'ionicons-before ion-chevron-down',
		'menuClasses'      => array(
			'combine' => array( ),
			'others'  => array(
				'.nav-primary',
			),
		),
	);

	return $settings;

}
*/

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
/*
add_theme_support( 'custom-header', array(
	'width'           => 320,
	'height'          => 120,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
	'flex-width'     => true,
) );
*/

// Add support for after entry widget.
//add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for post thumbnails - featured images
add_theme_support( 'post-thumbnails' );


// Add image sizes.
//add_image_size( 'front-blog', 960, 540, TRUE );
//add_image_size( 'sidebar-thumbnail', 80, 80, TRUE );
add_image_size( 'recipe-image', 720, 800, TRUE );

// Remove header right widget area.
unregister_sidebar( 'header-right' );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
//genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'content' );
//genesis_unregister_layout( 'sidebar-content' );



// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Remove navigation meta box.
add_action( 'genesis_theme_settings_metaboxes', 'treetopcc_remove_genesis_metaboxes' );
function treetopcc_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {

	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );

}

// add to remove structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	//'header',
	//'menu-primary',
	//'menu-secondary',
	//'site-inner',
	//'footer-widgets',
	//'footer',
) );

// Register navigation menus.
//add_theme_support( 'genesis-menus', array( 
//	'primary' => __( 'Header Menu', 'treetopcc-pro' ), 
//	'secondary' => __( 'Footer Menu', 'treetopcc-pro' ) 
//) );

// Include recipe layout code
include_once "includes/recipe-output.php";
add_filter( 'wpurp_output_recipe', 'wpurp_custom_template', 10, 2 );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Reposition secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_after', 'genesis_do_subnav', 12 );

// Add body class to Tree Top Home in network menu if not on a page in the consumer site
/* if (stripos($_SERVER['REQUEST_URI'], '/consumer/') === false) {
	add_filter( 'body_class', 'add_body_class' );
		function add_body_class( $classes ) {
			$classes[] = 'tthome-child-page';
			return $classes;
	}
} */


// Register menus
function register_treetop_menus() {
	register_nav_menu( 'site-network',__( 'Site Network Menu' ));
	register_nav_menu( 'primary-desktop',__( 'Primary Desktop' ));
	register_nav_menu( 'utility',__( 'Utility' ));
	register_nav_menu( 'primary-mobile',__( 'Primary Mobile' ));
	register_nav_menu( 'recipe-cats',__( 'Recipe Categories' ));
	register_nav_menu( 'footer-01',__( 'Footer 01' ));
	register_nav_menu( 'footer-02',__( 'Footer 02' ));
	register_nav_menu( 'footer-03',__( 'Footer 03' ));
	register_nav_menu( 'footer-04',__( 'Footer 04' ));
}
add_action( 'init', 'register_treetop_menus' );

add_action( 'genesis_header', 'build_header', 5 );
function build_header() {
	?>

	<div class="site-network-menu-wrap hidden-xs">
		<div class="container">
			<div class="row">
				<div class='col-sm-12'>
					<?php wp_nav_menu( array( 'theme_location' => 'site-network' )); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="main-header-wrap">
		<div class="container">

			<?php
			// check URL so we know what the home page link is for the logo
			/* if (stripos($_SERVER['REQUEST_URI'], '/consumer/') !== false) {
				$home_link = "/consumer/";
				$logo_src = "/wp-content/themes/tree-top-c-cpg/images/tree-top-logo.png";
				$logo_class = "logo-cpg"; */
			//} else { 
				$home_link = "/";
				$logo_src = "/wp-content/themes/tree-top-c-cpg/images/tree-top-logo.svg";
				$logo_class = "logo-corp";
			// }
			?>

			<div class="brand <?php echo $logo_class; ?>">
				
				<a class="<?php echo $logo_class; ?>" href="<?php echo $home_link; ?>">
					<img alt="Tree Top Food Ingredients" src="<?php echo $logo_src; ?>" />
				</a>
			</div>

			<div class="header-right-wrap">

				<div class="tt-group">
					<?php
					$tt_group = "Fruit Ingredients";
					echo $tt_group;
					?>
				</div>

				<div class="utility-nav-wrap hidden-xs">
					<?php 
					wp_nav_menu( array( 'theme_location' => 'utility' ));
					?>
				</div>

				<div class="primary-nav-wrap hidden-xs">
					<?php 
					wp_nav_menu( array( 'theme_location' => 'primary-desktop' ));
					?>
				</div>
				
			</div>

			<div class="mobile-menu-wrap visible-xs-block">
				<?php 
				wp_nav_menu( array( 'theme_location' => 'primary-mobile' ));
				?>
			</div>

		</div>
		
	</div>

	<?php
}


//function add_site_network_menu() {
//	wp_nav_menu( array( 'theme_location' => 'site-network', 'container_class' => 'genesis-nav-menu' ));
//}
//add_action( 'genesis_header', 'add_site_network_menu', 5 );



// Add the search icon to the header if the option is set in the Customizer.
add_action( 'genesis_meta', 'treetopcc_add_search_icon' );
function treetopcc_add_search_icon() {

	$show_icon = get_theme_mod( 'treetopcc_header_search', treetopcc_customizer_get_default_search_setting() );

	// Exit early if option set to false.
	if ( ! $show_icon ) {
		return;
	}

	add_action( 'genesis_header', 'treetopcc_do_header_search_form', 14 );
	add_filter( 'genesis_nav_items', 'treetopcc_add_search_menu_item', 10, 2 );
	add_filter( 'wp_nav_menu_items', 'treetopcc_add_search_menu_item', 10, 2 );

}

// Function to modify the menu item output of the Header Menu.
function treetopcc_add_search_menu_item( $items, $args ) {

	$search_toggle = sprintf( '<li class="menu-item">%s</li>', treetopcc_get_header_search_toggle() );

	if ( 'primary' === $args->theme_location ) {
		$items .= $search_toggle;
	}

	return $items;

} 

// Reduce secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'treetopcc_secondary_menu_args' );
function treetopcc_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

} 

// Modify Gravatar size in author box.
add_filter( 'genesis_author_box_gravatar_size', 'treetopcc_author_box_gravatar' );
function treetopcc_author_box_gravatar( $size ) {

	return 90;

}

// Customize entry meta in entry header.
add_filter( 'genesis_post_info', 'treetopcc_entry_meta_header' );
function treetopcc_entry_meta_header( $post_info ) {

	$post_info = '[post_author_posts_link] &middot; [post_date format="M j, Y"] [post_edit]';

	return $post_info;

}

// Customize entry meta in entry footer.
add_filter( 'genesis_post_meta', 'treetopcc_entry_meta_footer' );
function treetopcc_entry_meta_footer( $post_meta ) {

	$post_meta = '[post_categories before=""] [post_tags before=""]';

	return $post_meta;

}

// Modify Gravatar size in entry comments.
add_filter( 'genesis_comment_list_args', 'treetopcc_comments_gravatar' );
function treetopcc_comments_gravatar( $args ) {

	$args['avatar_size'] = 48;

	return $args;

}

// Setup widget counts.
/*
function treetopcc_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}
*/
// Calculate widget count.
/*
function treetopcc_widget_area_class( $id ) {

	$count = treetopcc_count_widgets( $id );

	$class = '';

	if ( $count == 1 ) {
		$class .= ' widget-full';
	} elseif ( $count % 3 == 1 ) {
		$class .= ' widget-thirds';
	} elseif ( $count % 4 == 1 ) {
		$class .= ' widget-fourths';
	} elseif ( $count % 2 == 0 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}
*/

// Customize content limit read more link markup.
add_filter( 'get_the_content_limit', 'treetopcc_content_limit_read_more_markup', 10, 3 );
function treetopcc_content_limit_read_more_markup( $output, $content, $link ) {

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

// Remove entry meta in entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// Hook before footer CTA widget area.
add_action( 'genesis_before_footer', 'treetopcc_before_footer_cta' );
function treetopcc_before_footer_cta() {

	genesis_widget_area( 'before-footer-cta', array(
		'before' => '<div class="before-footer-cta"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

// Remove primary sidebar
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action( 'genesis_sidebar', 'genesis_do_sidebar_alt' );

// Remove site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Custom Footer
add_action( 'genesis_footer', 'tt_footer' );
function tt_footer() {
	?>
	<footer class="site-footer" itemscope="" itemtype="https://schema.org/WPFooter">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<?php
					if ( has_nav_menu( 'footer-01' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'footer-01' )); 
					}
					?>
				</div>
				<div class="col-sm-6 col-md-3">
					<?php 
					if ( has_nav_menu( 'footer-02' ) ) {
						wp_nav_menu( array( 'theme_location' => 'footer-02' ));
					}
					?>
				</div>
				<div class="col-sm-6 col-md-3">
					<?php 
					if ( has_nav_menu( 'footer-03' ) ) {
						wp_nav_menu( array( 'theme_location' => 'footer-03' )); 
					}
					?>
				</div>
				<div class="col-sm-6 col-md-3">
					<?php 
					if ( has_nav_menu( 'footer-04' ) ) {
						wp_nav_menu( array( 'theme_location' => 'footer-04' )); 
					}
					?>
					<a class="nwn-footer" href="http://www.nwnaturals.com/" target="_blank"><img alt="Northwest Naturals" src="/wp-content/themes/tree-top-c-cpg/images/nwn-logo.png"></a>
				</div>
			</div>
		</div>
	</footer>
	<?php
}

// Add site footer.
//add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
//add_action( 'genesis_after', 'genesis_do_footer' );
//add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'primary-sidebar',
	'name'        => __( 'Primary Sidebar', 'treetopcc-pro' ),
	'description' => __( 'This is the primary sidebar.', 'treetopcc-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'recent-blog-posts',
	'name'        => __( 'Recent Blog Posts', 'treetopcc-pro' ),
	'description' => __( 'This is for recent blog posts on the home page.', 'treetopcc-pro' ),
) );

genesis_register_sidebar( array(
	'id'          => 'footer-social',
	'name'        => __( 'Footer Social', 'treetopcc-pro' ),
	'description' => __( 'Footer social icons', 'treetopcc-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'blog-cagetory-menu',
	'name'        => __( 'Blog Categories', 'treetopcc-pro' ),
	'description' => __( 'Blog Category Menu', 'treetopcc-pro' ),
) );
/*genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'treetopcc-pro' ),
	'description' => __( 'This is the front page 2 section.', 'treetopcc-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'treetopcc-pro' ),
	'description' => __( 'This is the front page 3 image section.', 'treetopcc-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'treetopcc-pro' ),
	'description' => __( 'This is the front page 4 section.', 'treetopcc-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'before-footer-cta',
	'name'        => __( 'Before Footer CTA', 'treetopcc-pro' ),
	'description' => __( 'This is the before footer CTA section.', 'treetopcc-pro' ),
) );*/


// gravity forms scroll to form on submission
add_filter( 'gform_confirmation_anchor', '__return_true' );


// Add ogg mime type
function my_custom_upload_mimes($mimes = array()) {

	// Add a key and value for the CSV file type
	$mimes['ogg'] = "video/ogg";

	return $mimes;
}



add_action('upload_mimes', 'my_custom_upload_mimes');

// searchwp number of results per page
function my_searchwp_posts_per_page( $posts_per_page, $engine, $terms, $page )
{
  if( $engine != 'default' ) {
    // if this is a supplemental search engine, show 20 results per page
    return 20;
  } else {
    // it's the default search engine, return whatever it was originally
    return 20;
  }
}
 
add_filter( 'searchwp_posts_per_page', 'my_searchwp_posts_per_page', 10, 4 );

/** Treetop Locator */
require 'locator/locator.func.php';

// Reverse order when entering Market Trends in Admin
function my_acf_load_value( $value, $post_id, $field ) {

    $order = array();

    if( empty($value) ) {
        return $value;
    }

    // populate order
    // Remember to change the field_5a4d0e70a5d3f to the field that you want to sort by
    foreach( $value as $i => $row ) {
        $order[ $i ] = $row['id'];
    }

    array_multisort( $order, SORT_DESC, $value );

    return $value;
}
//add_filter('acf/load_value/name=market_trends', 'my_acf_load_value', 10, 3);


//* Add Wistia oEmbed
wp_oembed_add_provider( '/https?:\/\/(.+)?(wistia.com|wi.st)\/(medias|embed)\/.*/', 'http://fast.wistia.com/oembed', true);


/** Force sidebar-content layout on all archive pages*/
add_filter( 'genesis_pre_get_option_site_layout', 'sidebar_content_layout_archives' );
/**
* @author Brad Dalton
* @link http://wpsites.net/web-design/change-layout-genesis/
*/
function sidebar_content_layout_archives( $opt ) {

if ( is_archive() ) {

    $opt = 'sidebar-content'; 
    return $opt;

    } 

}

// Exerpts for pages
add_post_type_support( 'page', 'excerpt' );


// Recipe Archive Heading
add_filter( 'post_type_archive_title', 'filter_custom_post_type_archive_title', 10, 2 );

function filter_custom_post_type_archive_title( $post_type, $title ) {

        if ( ! is_post_type_archive() || ! genesis_has_post_type_archive_support() ) {
		    return;
	    }

        if ( is_post_type_archive( 'treetop_recipes' ) ) :
        
        return 'Application Search';
        
        else :
        
        return $title;
        
        endif;
}