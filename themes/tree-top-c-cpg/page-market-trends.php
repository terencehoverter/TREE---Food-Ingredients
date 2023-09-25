<?php
/**
*
* Template Name:	Market Trends Page
* Description:		Market Trends Page
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/


// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
	function add_body_class( $classes ) {
		$classes[] = 'tting-market-trends';
		return $classes;
}

// Move header/title area
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Build Content 
add_action( 'genesis_entry_content', 'tt_product_content', 1 );
function tt_product_content() {

	// Entry Header
	?>
	<header class="entry-header">
		<div class="container">
			<div class="row">
                <div class="col-sm-9 col-sm-push-3">
					<?php genesis_do_post_title(); ?>
				</div>
			</div>
		</div>
	</header>
	<?php
}
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'tt_content', 1 );
function tt_content() {
    ?>
		<div class="container content-wrap">

			<div class="row">
				<main class="col-sm-9 col-sm-push-3">
                    <article class="" itemscope itemtype="https://schema.org/CreativeWork">
                        <?php

                        $banner_image = get_field('banner_image');
                        echo wp_get_attachment_image( $banner_image, 'full' ); 

                        if( have_rows('market_trends') ):
                            $repeater = array_reverse(get_field('market_trends'));
                            if( $repeater ):
                                foreach( $repeater as $row ):
                                    ?>
                                    <div class="row tting-market-trend-item">
                                        <div class="col-sm-3">
                                            <a target="_blank" href="<?php echo $row['pdf']; ?>">
                                                <?php echo wp_get_attachment_image( $row['image'], 'full' ); ?>
                                            </a>
                                        </div>
                                        <div class="col-sm-9">
                                            <h3><a target="_blank" href="<?php echo $row['pdf']; ?>"><?php echo $row['title']; ?></a></h3>
                                            <?php echo $row['content']; ?>
                                            <a target="_blank" class="tting-read-more" href="<?php echo $row['pdf']; ?>">Explore These Trends</a>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                        endif;
                        ?>
                        <?php genesis_do_post_content(); ?>
                    </article>
                </main>
                <aside class="col-sm-3 col-sm-pull-9 double primary-sidebar" role="complementary" aria-label="Primary Sidebar" itemscope="" itemtype="https://schema.org/WPSideBar">
                    <?php genesis_widget_area( 'primary-sidebar' ); ?>
                </aside>
                
            </div>
        </div>
        <div id="footer-cta"><div class="fixed-footer-cta"><a class="cta-btn" href="/contact-us/">Ask our Trends Experts</a></div></div>

    <?php
}







genesis();