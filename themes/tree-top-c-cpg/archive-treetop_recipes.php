<?php
/**
 * Tree Top Ingredients.
 *
 * This file adds application search to Ingredients.
 *
 * @package Tree Top Corp and CPG
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 * @link    http://www.3rdstudio.com/
 */

remove_filter( 'wp_title', 'genesis_default_title', 10, 3 );
add_filter( 'wp_title', 'genesis_default_title_new', 10, 3 );
function genesis_default_title_new( $title) {

    $title = 'Application Search';
    return $title;
}
 // Add landing page body class to the head.
add_filter( 'body_class', 'treetopcc_add_body_class' );
function treetopcc_add_body_class( $classes ) {

	$classes[] = 'applications';
    $classes[] = 'page-template-product-list-page';

	return $classes;

}

// search page like kv healthcare
// have page show no results if no query params
// maybe put form on main /applications/ that sends query params to search page


// Post Type: treetop_recipes
// Taxonomies used: treetop_recipe_category, ingredients


// check for GET
$qs = $_GET;
$qs_count = 0;

// GET Category
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category_bool = true;
    ++$qs_count;
    $category = $_GET['category'];
    $category_array = array (
        'taxonomy' => 'treetop_recipe_category',
        'field' => 'slug',
        'terms' => $category,
    );
    $term_category = get_term($category);
    $term_category = $term_category->name;
}

// GET Ingredient
if (isset($_GET['ingredient']) && !empty($_GET['ingredient'])) {
    $ingredient_bool = true;
    ++$qs_count;
    $ingredient = $_GET['ingredient'];
    $ingredient_array = array (
        'taxonomy' => 'ingredients',
        'field' => 'slug',
        'terms' => $ingredient,
    );
    $term_ingredient = get_term($ingredient);
    $term_ingredient = $term_ingredient->name;
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'application_search_loop' );
function application_search_loop() {

    global $post;
    global $category, $category_bool, $term_category, $category_array, $ingredient, $ingredient_bool, $term_ingredient, $ingredient_array, $qs, $qs_count;

    

    // Build page
    
    if( $qs_count > 0 ) {
        // If a query has been made set up ability to remove parameters

        // Cancel circle SVG
        ?>
        <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
        <symbol id="icon-cancel-circle" viewBox="0 0 500 500">
        <title>cancel-circle</title>
        <path d="M250 0c-138.071 0-250 111.929-250 250s111.929 250 250 250 250-111.929 250-250-111.929-250-250-250zM250 453.125c-112.183 0-203.125-90.942-203.125-203.125s90.942-203.125 203.125-203.125 203.125 90.942 203.125 203.125-90.942 203.125-203.125 203.125z"></path>
        <path d="M328.125 125l-78.125 78.125-78.125-78.125-46.875 46.875 78.125 78.125-78.125 78.125 46.875 46.875 78.125-78.125 78.125 78.125 46.875-46.875-78.125-78.125 78.125-78.125z"></path>
        </symbol>
        </defs>
        </svg>
        <?php
        $cancel_circle = '<svg class="as-icon icon-cancel-circle" style="width:.8em;height:.8em;"><use xlink:href="#icon-cancel-circle"></use></svg>';

        // If GET exists:
        if( $category_bool ) {
            $qs_category = $qs;
            unset($qs_category["category"]);
            $category_clean = str_replace("-", " ", $category);
            $del_category = '<span class="as-result-item"><a href="/applications/recipe/?' . http_build_query($qs_category) . '">' . $cancel_circle . '<span class="as-qs-value">' . ucwords($category_clean) . '</span></a></span>';
        }
        if( $ingredient_bool ) {
            $qs_ingredient = $qs;
            unset($qs_ingredient["ingredient"]);
            $ingredient_clean = str_replace("-", " ", $ingredient);
            $del_ingredient = '<span class="as-result-item"><a href="/applications/recipe/?' . http_build_query($qs_ingredient) . '">' . $cancel_circle . '<span class="as-qs-value">' . ucwords($ingredient_clean) . '</span></a></span>';
        }
        
    }

    ?>
    <div class="container application-search-wrap">
        
        <div class="row">
            <div class="col-sm-12">
            <form class="application-search" action="/applications/recipe/" method="get">
                <h4>Search by application category and/or ingredient.</h4>
                <div class="as-field-wrap">
                    <div class="as-field">
                        <label for="category">Category</label>
                        <?php wp_dropdown_categories( 'name=category&taxonomy=treetop_recipe_category&orderby=name&value_field=slug&show_option_none=Select a Category&option_none_value=&selected='.$category ); ?>
                    </div>
                    <div class="as-field">
                        <label for="ingreient">Ingredient</label>
                        <?php wp_dropdown_categories( 'name=ingredient&taxonomy=ingredients&orderby=name&value_field=slug&show_option_none=Select an Ingredient&option_none_value=&selected='.$ingredient ); ?>
                    </div>
                </div>
                <input type="submit" value="Search Applications">
            </form>
            </div>
        </div>

        <?php
        if( $qs ) {
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="as-results">
                        <?php echo $del_category . ' ' . $del_ingredient; ?>
                        <div class="as-clear-all"><a href="/applications/recipe/">clear all results</a></div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        
    </div>
    <?php

    $tax_query = array(
        'relation' => 'AND',
        $category_array,
        $ingredient_array,
    );
    
    $args = array(
        'post_type' => 'treetop_recipes',
        'posts_per_page' => 24,
        'post_status' => 'publish',
        'tax_query' => $tax_query,
        'orderby' => 'name',
        'order' => 'ASC',
        'paged' => get_query_var( 'paged' ),
    );

    /*
	Overwrite $wp_query with our new query.
	The only reason we're doing this is so the pagination functions work,
	since they use $wp_query. If pagination wasn't an issue, 
	use: https://gist.github.com/3218106
	*/
    global $wp_query;
	$wp_query = new WP_Query( $args );

	if ( have_posts()) : ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 product-list-wrap">
                    <ul class="product-list">
                    <?php
                    while ( have_posts() ) : the_post();  ?>
                        <li class="product_page">
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( apply_filters( 'template_posts_thumbnail_size', 'medium', $attributes, get_the_ID() ) ); ?>
                            <div><?php the_title(); ?></div>
                            </a>
                        </li>
                    <?php
                    endwhile;
                    do_action( 'genesis_after_endwhile' ); ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    elseif( !$qs ) :
        
    else :
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p>No results found. Please try again.</p>
                </div>
            </div>
        </div>
        <?php
    endif;
    wp_reset_query();

}



genesis();