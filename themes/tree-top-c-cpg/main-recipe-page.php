<?php
/**
*
* Template Name:	Main Recipe Page
* Description:		Main Recipe Page
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2016, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<?php genesis_do_post_title(); ?>
				hello world
			</div>
		</div>
	</div>

	<?php
}







genesis();