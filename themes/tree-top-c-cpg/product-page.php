<?php
/**
*
* Template Name:	Product Page
* Description:		Product Page
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
		$classes[] = 'tt-product-page';
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
				<div class="col-md-12">
					<?php genesis_do_post_title(); ?>
				</div>
			</div>
		</div>
	</header>
	<?php
	
	// Is this product available?
	$availablility = get_field( 'product_availability' );


	// Top Banner

	$banner_image = get_field( 'banner_image' );
	if( !empty( $banner_image ) ):
		$banner_image_code = '<img src="'.esc_url($banner_image['url']).'" alt="'.esc_attr($banner_image['alt']).'" />';
	endif;
	$glamour_text = get_field( 'glamour_text' );
	$product_images = get_field( 'product_images' );
	if( $product_images['single_or_carousel'] == 'carousel' ) {
		$product_options_count = count($product_images['product_images_carousel']);
	}
	
	
	?>
	<div class="product-banner-wrap">

		<?php echo $banner_image_code; ?>

		<div class="white-block"></div>
		
		<div class="container product-desc">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-6">
					<div class="product-glamour-text">
						<?php echo $glamour_text; ?>
					</div>
					<div class="product-image">
						<?php

						// If NOT available
						if( $availablility == 'no'):

							?>
							<div class="product-not-available"><?php echo the_field( 'unavailable_message' ); ?></div>
							<?php

						// Available - or not set
						else: 
							if( $product_images ):
								
								if( $product_images['single_or_carousel'] == 'single' ):
									// single image goes here
									echo the_post_thumbnail( 'full' );

								elseif($product_images['single_or_carousel'] == 'carousel' && $product_options_count > 3 ):
									
									// carousel code goes here
									if( have_rows('product_images') ):
										while( have_rows('product_images') ): the_row();
											if( have_rows('product_images_carousel') ):
												?>
												<div class="product-options-wrap">
													<div class="swiper swiper-options">
														<div class="swiper-wrapper">
															<?php
															while( have_rows('product_images_carousel') ): the_row();
																$carousel_image = get_sub_field('carousel_image');
																$size = 'full';
																$carousel_caption = get_sub_field('image_caption');
															?>
																<div class="swiper-slide">
																	<?php echo wp_get_attachment_image( $carousel_image, $size ); ?>
																	<?php echo $carousel_caption; ?>
																</div>
															<?php 
															endwhile;
															//wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
															?>
														</div>
														<div class="swiper-pagination"></div>
													</div>
												</div>
												<?php
											endif;
										endwhile;
									endif;

								else:
									// 3 or less images go here
									if( have_rows('product_images') ):
										while( have_rows('product_images') ): the_row();
											if( have_rows('product_images_carousel') ):
												?>
												<div class="product-options-static-wrap">
													<?php
													while( have_rows('product_images_carousel') ): the_row();
														$carousel_image = get_sub_field('carousel_image');
														$size = 'full';
														$carousel_caption = get_sub_field('image_caption');
													?>
														<div class="product-option-static">
															<?php echo wp_get_attachment_image( $carousel_image, $size ); ?>
															<div><?php echo $carousel_caption; ?></div>
														</div>
													<?php 
													endwhile;
													//wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
													?>
												</div>
												<?php
											endif;
										endwhile;
									endif;

								endif;

							endif;
							
						endif;
						?>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php

	// Document links - taupe background
	?>

	<div class="document-links">
        <div class="container">
			<div class="row">
				<div class="col-sm-4"> 
					<a class="prod-btn" href="/resource-library/regulatory-documents/"><span class="prod-btn-wrap"><span class="icon-document-white"></span>Regulatory Documents</span></a>
				</div>
				<div class="col-sm-4">
					<?php
					if( $availablility == 'no'):
					else:
					?>
					<a class="prod-btn" href="/sample-request/"><span class="prod-btn-wrap"><span class="icon-box-white"></span>Request Sample</span></a>
					<?php
					endif;
					?>
				</div>
				<div class="col-sm-4"> 	
					<div id="trees_row02c" class="webpartzone">
						<a class="prod-btn" href="/resource-library/specification-sheets/"><span class="prod-btn-wrap"><span class="icon-document-white"></span>General Product Specs</span></a>
						<div class="item-specific">For item specific specifications <a href="/contact-us/">contact us</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	
	// Main Content
	?>

	<div class="product-main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-6 link-orange">
					<?php 

					// Left column content
					the_field('left_column');

					// Storage Recommendations
					if( have_rows('shelf_life_and_storage_recommendations') ):
						echo '<h3><strong>Shelf Life and Storage Recommendations:</strong></h3>';

						echo '<div class="table-responsive">';
						echo '  <table class="table" style="font-size:14px">';
						echo '    <thead>';
						echo '      <tr>';
						echo '        <th>Storage Temperature</th>';
						echo '        <th>Ambient &lt;70ºF</th>';
						echo '        <th>Refrigerated &lt;45ºF</th>';
						echo '        <th>Frozen &lt;0ºF</th>';
						echo '      </tr>';
						echo '    </thead>';
						echo '    <tbody>';
						
						while( have_rows('shelf_life_and_storage_recommendations') ) : the_row();

							// table rows
							$storage_temp = get_sub_field('storage_temperature');
							$ambient = get_sub_field('ambient_70_f');
							$refridgerated = get_sub_field('refrigerated_45_f');
							$frozen = get_sub_field('frozen_0_f');
							echo '      <tr>';
							echo '        <td>'.$storage_temp.'</td>';
							echo '        <td>'.$ambient.'</td>';
							echo '        <td>'.$refridgerated.'</td>';
							echo '        <td>'.$frozen.'</td>';
							echo '      </tr>';

						endwhile;

						echo '    </tbody>';

					else:
						// do nothing
					endif;
					echo '  </table>';
					echo '</div>';

					// Shelf Life Note
					echo '<div class="shelf-life-note">';
						the_field('shelf_life_note');
					echo '</div>';

					// Video Panel
					$video_panel = get_field('video_panel');
					if( $video_panel['display_video_panel'] == "yes" ):
						?>
						<div class="video-panel">
							<a href="<?php echo $video_panel['panel_link']; ?>" alt="Tree Top Peaches Video">
								<div class="video-panel-img"><?php echo wp_get_attachment_image( $video_panel['video_panel_image'], 'full' ); ?></div>
								<div class="video-panel-txt"><?php echo $video_panel['video_panel_text']; ?></div>
							</a>
						</div>
						<?php
					endif;
					
					?>
				</div>
				<div class="col-md-6">
					<?php
					//Nutriontional Info #1
					// Pre Nutritional Note
					echo get_field('pre_nutritional_note');

					// Nuttritional Information

					if( have_rows('nutritional_information') ):
						echo '<div class="nutritional-information">';
						echo '  <h3><strong>Nutritional Information</strong></h3>';

						// get group
						$nutritional_information = get_field('nutritional_information');

						// get upper note
						$nutritional_upper_note = $nutritional_information['nutritional_upper_note'];
						echo $nutritional_upper_note;
						
						// get/loop table data
						$nutritional_table = $nutritional_information['nutritional_table'];
						if( $nutritional_table ):
							echo '  <div class="table-responsive">';
							echo '    <table class="table table-condensed">';
							echo '      <thead>';
							echo '        <tr>';
							echo '          <th>Nutrient</th>';
							echo '          <th>Amount</th>';
							echo '        </tr>';
							echo '      </thead>';
							echo '      <tbody>';
							foreach($nutritional_table as $table_row) {
								$nutrient = $table_row["nutritional_nutrient"];
								$amount = $table_row["nutritional_amount"];
								echo '        <tr>';
								echo '          <td>'.$nutrient.'</td>';
								echo '          <td>'.$amount.'</td>';
								echo '        </tr>';
							}
							echo '      </tbody>';
							echo '    </table>';
							echo '  </div>';
							
						endif;

						// get statement
						$nutritional_statement = $nutritional_information['statement'];
						echo '<div class="nutritional-statement">'.$nutritional_statement.'</div>';

						// get lower note
						$nutritional_lower_note = $nutritional_information['lower_note'];
						echo $nutritional_lower_note;

						echo '</div>'; // close .nutritonal-information
						
					endif;

					//Nutriontional Info #2

					// Nuttritional Information
					// check if using second nutritional information
					$use_second_nutritional = get_field('use_2nd_nutritional_information_area');

					if( $use_second_nutritional ):

						if( have_rows('nutritional_information_2') ):
							echo '<div class="nutritional-information">';
							echo '  <h3><strong>Nutritional Information</strong></h3>';
	
							// get group
							$nutritional_information_2 = get_field('nutritional_information_2');
	
							// get upper note
							$nutritional_upper_note_2 = $nutritional_information_2['nutritional_upper_note'];
							echo $nutritional_upper_note_2;
							
							// get/loop table data
							$nutritional_table_2 = $nutritional_information_2['nutritional_table'];
							if( $nutritional_table_2 ):
								echo '  <div class="table-responsive">';
								echo '    <table class="table table-condensed">';
								echo '      <thead>';
								echo '        <tr>';
								echo '          <th>Nutrient</th>';
								echo '          <th>Amount</th>';
								echo '        </tr>';
								echo '      </thead>';
								echo '      <tbody>';
								foreach($nutritional_table_2 as $table_row_2) {
									$nutrient_2 = $table_row_2["nutritional_nutrient"];
									$amount_2 = $table_row_2["nutritional_amount"];
									echo '        <tr>';
									echo '          <td>'.$nutrient_2.'</td>';
									echo '          <td>'.$amount_2.'</td>';
									echo '        </tr>';
								}
								echo '      </tbody>';
								echo '    </table>';
								echo '  </div>';
								
							endif;
	
							// get statement
							$nutritional_statement_2 = $nutritional_information_2['statement'];
							echo '<div class="nutritional-statement">'.$nutritional_statement_2.'</div>';
	
							// get lower note
							$nutritional_lower_note_2 = $nutritional_information_2['lower_note'];
							echo $nutritional_lower_note_2;
	
							echo '</div>'; // close .nutritonal-information #2
							
						endif;

					endif;

					// Supplemental Links

					$supplemental_links = get_field('supplemental_links');
					if( $supplemental_links ) {

						echo '<div class="doc-dnld">';

						// if Request Sample
						if( $supplemental_links && in_array('sample', $supplemental_links) ) {
							?>
							<div class="dndl-item"><a href="/sample-request/"><span class="icon-box-green"></span>Request Sample</a></div>
							<?php
						}

						// if General Product Specifications
						if( $supplemental_links && in_array('specs', $supplemental_links) ) {
							?>
							<div class="dndl-item"><a href="/resource-library/specification-sheets/"><span class="icon-document-green"></span>General Product Specifications</a></div>
							<?php
						}

						// if Other Regulatory Documents
						if( $supplemental_links && in_array('other', $supplemental_links) ) {
							?>
							<div class="dndl-item"><a href="/resource-library/regulatory-documents/"><span class="icon-document-green"></span>Other Regulatory Documents</a></div>
							<?php
						}

						// if Kosher Certificate
						if( $supplemental_links && in_array('kosher', $supplemental_links) ) {
							?>
							<div class="dndl-item"><a href="/resource-library/regulatory-documents/#kosher"><span class="icon-kosher-green"></span>Kosher Certificate</a></div>
							<?php
						}

						// if Nutritional Data
						if( $supplemental_links && in_array('nutrition', $supplemental_links) ) {
							?>
							<div class="dndl-item"><a href="/resource-library/regulatory-documents/#nutritionals"><span class="icon-document-green"></span>Nutritional Data</a></div>
							<?php
						}

						echo '</div>';
					}

					// Specialty Markets
					// Original ACF field group stopped showing up in page edit, created 2nd version
					// but left original as is for the products already usig it, which continue to
					// work fine.

					$specialty_markets = get_field('specialty_markets');
					if( $specialty_markets ) {

						echo '<div class="row specialty-markets">';
						echo '  <h2><span>Specialty Markets</span></h2>';
						echo '  <p style="text-align: center;">Ideal for formulations in:</p>';

						// if Reduced Sugar
						if( $specialty_markets && in_array('sug', $specialty_markets) ) {
							?>
							<div class="sm-item col-sm-4"><a href="/fruit-ingredients/specialty-markets/reduced-sugars/"><img alt="reduced sugar" src="/wp-content/themes/tree-top-c-cpg/images/specialty-markets-reduced-sugar.jpeg" /></a></div>
							<?php
						}

						// if Pet Food
						if( $specialty_markets && in_array('pet', $specialty_markets) ) {
							?>
							<div class="sm-item col-sm-4"><a href="/fruit-ingredients/specialty-markets/pet-food-ingredients/"><img alt="reduced sugar" src="/wp-content/themes/tree-top-c-cpg/images/specialty-markets-pet-food.jpeg" /></a></div>
							<?php
						}

						// if Hard Cider & Alchohol
						if( $specialty_markets && in_array('alc', $specialty_markets) ) {
							?>
							<div class="sm-item col-sm-4"><a href="/fruit-ingredients/specialty-markets/hard-ciders-alcohol/"><img alt="reduced sugar" src="/wp-content/themes/tree-top-c-cpg/images/specialty-markets-hard-cider-and-alcohol.jpeg" /></a></div>
							<?php
						}

						echo '</div>';
					}
					// version 2
					$specialty_markets_2 = get_field('specialty_markets_2');
					if( $specialty_markets_2 ) {

						echo '<div class="row specialty-markets">';
						echo '  <h2><span>Specialty Markets</span></h2>';
						echo '  <p style="text-align: center;">Ideal for formulations in:</p>';

						// if Reduced Sugar
						if( $specialty_markets_2 && in_array('sug', $specialty_markets_2) ) {
							?>
							<div class="sm-item col-sm-4"><a href="/fruit-ingredients/specialty-markets/reduced-sugar/"><img alt="reduced sugar" src="/wp-content/themes/tree-top-c-cpg/images/specialty-markets-reduced-sugar.jpeg" /></a></div>
							<?php
						}

						// if Pet Food
						if( $specialty_markets_2 && in_array('pet', $specialty_markets_2) ) {
							?>
							<div class="sm-item col-sm-4"><a href="/fruit-ingredients/specialty-markets/pet-food-ingredients/"><img alt="reduced sugar" src="/wp-content/themes/tree-top-c-cpg/images/specialty-markets-pet-food.jpeg" /></a></div>
							<?php
						}

						// if Hard Cider & Alchohol
						if( $specialty_markets_2 && in_array('alc', $specialty_markets_2) ) {
							?>
							<div class="sm-item col-sm-4"><a href="/fruit-ingredients/specialty-markets/hard-ciders-alcohol/"><img alt="reduced sugar" src="/wp-content/themes/tree-top-c-cpg/images/specialty-markets-hard-cider-and-alcohol.jpeg" /></a></div>
							<?php
						}

						echo '</div>';
					}

					// You may also like

					if( have_rows('you_may_also_like') ): ?>

						<div class="also-like">

							<h2><span>You may also like</span></h2>
							<div style="line-height: 25.6px; text-align: center;margin-bottom: 12px;">Click on images below for more information.</div>
							<ul class="related-pages">
	
								<?php while( have_rows('you_may_also_like') ): the_row(); 
	
									$post_object_rp = get_sub_field('product_page');
									$post_object_rp_url = get_permalink($post_object_rp->ID);
	
								?>
	
									<li class="related_page">
										<a href="<?php echo $post_object_rp_url; ?>">
											<?php echo get_the_post_thumbnail( $post_object_rp, 'full' ); ?>
											<?php echo $post_object_rp->post_title; ?>
										</a>
									</li>
	
								<?php endwhile; ?>
								<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	
							</ul>

						</div>
			
					<?php endif; ?>
					
				</div>
			</div>
		</div>
	</div>

	<?php

	// Lower Banner

	?>
	<div class="product-lower-banner hidden-xs">
		<?php

		$lower_image = get_field('lower_image');
		$size = 'full'; // (thumbnail, medium, large, full or custom size)
		if( $lower_image ) {
			echo wp_get_attachment_image( $lower_image, $size );
		}

		?>
	</div>

	<?php	

	// Related Applications

	if( have_rows('product_related_applications') ): ?>

		<div class="container related-applications-wrap">
			<div class="row">
				<div class="col-md-12">

					<h2><span>Related Applications</span></h2>
					<div class="swiper swiper-applications">
						<div class="swiper-wrapper">
							<?php
							while( have_rows('product_related_applications') ): the_row();
								$post_object_rp = get_sub_field('application');
								$post_object_rp_url = get_permalink($post_object_rp->ID);
							?>
								<div class="swiper-slide">
									<a href="<?php echo $post_object_rp_url; ?>">
										<?php echo get_the_post_thumbnail( $post_object_rp, 'full' ); ?>
										<?php echo $post_object_rp->post_title; ?>
									</a>
								</div>
							<?php 
							endwhile;
							wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
							?>
						</div>
						<div class="swiper-pagination"></div>
					</div>

				</div>
			</div>
		</div>

	<?php endif;
}

genesis();