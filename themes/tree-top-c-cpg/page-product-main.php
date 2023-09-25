<?php
/**
*
* Template Name:	Product Main Page
* Description:		Product Main Page
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
		$classes[] = 'tt-product-main';
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

// Content
add_action( 'genesis_entry_content', 'treetop_content', 1 );
function treetop_content() {

	$image = get_field('top_image');
	$size = 'full';

	?>
	<div class="product-main-banner">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php echo wp_get_attachment_image( $image, $size ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	/* $row01 = get_field('row_01');
	$row01_txt = $row01['text'];
	$row01_img = $row01['image'];
	?>
	<div class="row01">
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<?php echo $row01_txt ?>
				</div>
				<div class="col-sm-4 col-sm-offset-1">
					<?php echo wp_get_attachment_image( $row01_img, $size ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	$row02 = get_field('row_02');
	$row02_txt = $row02['text'];
	$row02_img = $row02['image'];
	?>
	<div class="row02">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 col-sm-offset-1 col-sm-push-4">
					<?php echo $row02_txt ?>
				</div>
				<div class="col-sm-4 col-sm-pull-8">
					<?php echo wp_get_attachment_image( $row02_img, $size ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php
	$row03 = get_field('row_03');
	$row03_txt = $row03['text'];
	$row03_img = $row03['image'];
	?>
	<div class="row03">
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<?php echo $row03_txt ?>
				</div>
				<div class="col-sm-4 col-sm-offset-1">
					<?php echo wp_get_attachment_image( $row03_img, $size ); ?>
				</div>
			</div>
		</div>
	</div> 
	<?php */

	// Alternating Rows
	// Check rows exists.
	if( have_rows('alternating_rows') ):

		// Loop through rows.
		while( have_rows('alternating_rows') ) : the_row();

			?>
			<div class="container">
				<div class="row">
					<?php

						$text_side = get_sub_field('text_side');
						if( $text_side == 'left' ):
							?>
							<div class="col-sm-7"><div class="alt-txt-wrap"><div class="alt-txt"><?php the_sub_field('text'); ?></div></div></div>
							<div class="col-sm-4 col-sm-offset-1"><div class="alt-img-wrap"><div class="alt-img"><img src="<?php the_sub_field('image'); ?>" /></div></div></div>
							<?php
						else :
							?>
							<div class="col-sm-7 col-sm-offset-1 col-sm-push-4"><div class="alt-txt-wrap"><div class="alt-txt"><?php the_sub_field('text'); ?></div></div></div>
							<div class="col-sm-4 col-sm-pull-8"><div class="alt-img-wrap"><div class="alt-img"><img src="<?php the_sub_field('image'); ?>" /></div></div></div>
							<?php
						endif;

					?>

				</div>
			</div>
			<?php

		// End loop.
		endwhile;

	// No value.
	else :
		// Do something...
	endif;

	}



genesis();