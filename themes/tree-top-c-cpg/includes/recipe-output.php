<?php

// Custom layout for recipe pages

function wpurp_custom_template( $content, $recipe )
{
	ob_start();
	?>
	<div class="col-md-4 col-md-push-8">
		<?php the_post_thumbnail(); ?>
		<div class="wpurp-container recipe-print-btn">
			<?php
				$print_button = new WPURP_Template_Recipe_Print_Button();
				echo $print_button->output( $recipe )." print recipe";
			?>
		</div>
	</div>

	<div class="col-md-8 col-md-pull-4 recipe-content">
		<div class="recipe">
			
			<?php echo $recipe->description(); ?>

			<h3>Ingredients</h3>
			<?php
				$ingredient_list = new WPURP_Template_Recipe_Ingredients();
				echo $ingredient_list->output( $recipe );
			?>
			<h3>Directions</h3>
			<?php
				$instructions = new WPURP_Template_Recipe_Instructions();
				echo $instructions->output( $recipe );
			?>
			<div>
				<?php
				$recipe_notes = new WPURP_Template_Recipe_Notes();
				echo $recipe_notes->output( $recipe );
			?>
			</div>
		</div>
	</div>

	<?php
    $output = ob_get_contents();
    ob_end_clean();

	return $output;
}
add_filter( 'wpurp_output_recipe', 'wpurp_custom_template', 10, 2 );