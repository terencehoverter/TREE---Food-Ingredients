<?php
/**
*
* Template Name:	Corporate Logos
* Description:		Corporate Logos and Templates page layout
* @package			Tree Top Corp and CPG
* @author 			3rd Studio
* @link				http://www.3rdstudio.com/
* @copyright		Copyright (c) 2020, 3rd Studio, Inc.
* @license			Exclusively for Tree Top
**/

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class01' );
	function add_body_class01( $classes ) {
		$classes[] = 'tt-corp-logos';
		return $classes;
}

// Move title area
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_entry_header', 'treetop_post_title' );
function treetop_post_title() {
	?>

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?php genesis_do_post_title(); ?>
				</div>
			</div>
		</div>

	<?php
}

// Entry Content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'tt_content', 1 );
function tt_content() {
    //if(current_user_can('mepr-active','rules:7763')):
        if(current_user_can('mepr-active','memberships:7763')):
	?>

        <main>
            <div class="container content-wrap">
                <div class="row">
                    <div class="col-sm-12 tt-corp-logos-memlinks">
                    <?php echo do_shortcode("[mepr-account-link]"); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-push-3">
                        <?php the_field('upper_text'); ?>
                    </div>
                    <div class="col-xs-6 col-md-3 col-md-pull-6">
                        <div class="tt-navcard">
                            <div class="tt-navcard-imgtop">
                                <img src="https://www.treetop.com/wp-content/themes/tree-top-c-cpg/images/tree-top-logo.svg" />
                            </div>
                            <div class="tt-navcard-text-brand">Brand Standards</div>
                            <a class="tt-navcard-heading" href="https://www.treetop.com/wp-content/uploads/2020/07/TreeTop_BrandStandards_Web.pdf" target="_blank"><div><div>Tree Top Brand Standard and Logo Usage Guidelines</div></div></a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-text">Learn <strong>which file type of the Tree Top logo to use</strong> in different applications and media and <strong>learn how to use a template</strong>.</div>
                                <div class="tt-navcard-img ncimgleft">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-video.jpg" />
                                </div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-vid"><div><div>Video Help Library</div></div></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-docs.jpg" />
                                </div>
                                <div class="tt-navcard-text">Corporate branded and approved business document <strong>templates for Microsoft PowerPoint, Excel, Word and Outlook</strong>.</div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-cdt"><div><div>Corporate Document Templates</div></div></a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-ip.jpg" />
                                </div>
                                <div class="tt-navcard-text">Appropriate for use in <strong>Excel Spreadsheets, Microsoft Word or PowerPoint documents for desktop publishing applications</strong>.</div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-ip"><div><div>Logos for Internal Printing Use</div></div></a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-dm.jpg" />
                                </div>
                                <div class="tt-navcard-text">Appropriate for use in <strong>Microsoft PowerPoint slide deck presentations, web sites or similar on-screen viewing applications</strong>.</div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-dm"><div><div>Logos for Digital Media Use</div></div></a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-cvp.jpg" />
                                </div>
                                <div class="tt-navcard-text">Appropriate for sending to <strong>professional vendors for commercial printing</strong>.</div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-cvp"><div><div>Logos for Commercial Vendor Printing</div></div></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-pper.jpg" />
                                </div>
                                <div class="tt-navcard-text">Appropriate for sending to <strong>professional vendors for promotional item printing and embroidery</strong>.</div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-pper"><div><div>Logos for Promotional Item Printing and Embroidery Reproductions</div></div></a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap tt-navcard-wg">
                            <img src="/wp-content/themes/tree-top-c-cpg/images/nc-wg-ing.jpg" />
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-wg-cpg.jpg" />
                                </div>
                                <div class="tt-navcard-text">Appropriate for use by <strong>Internal Work Groups</strong>.</div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-wg"><div><div>Work Group Logos</div></div></a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                            <div class="tt-navcard-wrap">
                                <div class="tt-navcard-img ncimgright">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-colorpalette.jpg" />
                                </div>
                                <div class="tt-navcard-text"><strong>Corporate approved color palette.</strong></div>
                            </div>
                            <a class="tt-navcard-heading" href="#corp-logos-color"><div><div>Color Palette</div></div></a>
                        </div>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <div class="tt-navcard">
                                <div class="tt-navcard-imgtop">
                                    <img src="/wp-content/themes/tree-top-c-cpg/images/nc-partner.jpg" />
                                </div>
                                <div class="tt-navcard-text tt-navcard-text-fullwidth">Appropriate for sending to <strong>professional vendors for printing</strong>.</div>
                            <a class="tt-navcard-heading" href="#corp-logos-partner"><div><div>Partner Logo Template</div></div></a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <a class="anchor-offset" id="corp-logos-vid"></a>
                    <div class="col-xs-6 col-md-3">
                        <h2>Watch Instructional Videos</h2>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="video-wrap">
                            <a href="https://www.treetop.com/resource-library/powerpoint-templates-themes/">
                                <div class="video-img"><img alt="" src="/wp-content/themes/tree-top-c-cpg/images/vid-placeholder.jpg" /></div>
                                <div class="video-txt">Learn how to save and use the <strong>Standard and Wide Corporate PowerPoint Templates & Theme</strong></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="video-wrap">
                            <a href="https://www.treetop.com/resource-library/master-slides-layouts/">
                                <div class="video-img"><img alt="" src="/wp-content/themes/tree-top-c-cpg/images/vid-placeholder2.jpg" /></div>
                                <div class="video-txt">Learn about <strong>Master Slides and Layouts</strong> and how to edit them in the <strong>Standard Corporate PowerPoint Template</strong></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="video-wrap">
                            <a href="https://www.treetop.com/resource-library/resource-library/">
                                <div class="video-img"><img alt="" src="/wp-content/themes/tree-top-c-cpg/images/vid-placeholder3.jpg" /></div>
                                <div class="video-txt">Learn when to use the different file types of the <strong>Corporate Logo</strong> in the <strong>Resource Library</strong></div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <?php if( have_rows('section') ): // 1st repeater:section if ?>
                        <div class="corp-section-wrap">

                            <?php while( have_rows('section') ): the_row(); // 1st repeater:section while
                                $anchor = get_sub_field('link_name'); ?>
                                <a class="anchor-offset" id="<?php echo $anchor; ?>"></a>
                                <div class="corp-section <?php echo $anchor; ?>">
                                    <h2><?php the_sub_field('section_heading'); ?></h2>
                                    <div><strong><?php the_sub_field('section_sub_heading'); ?></strong></div>
                                    <?php the_sub_field('section_description'); ?>

                                        <?php if( have_rows('file_table') ): // 2nd repeater:file_table if ?>
                                            <?php while( have_rows('file_table') ): the_row(); // 2nd repeater:file_table while 
                                                // columns to display vars 
                                                $table_columns = get_sub_field('file_columns'); ?>

                                                <div class="table-responsive">
                                                <table class="file-group table">
                                                    <tr>
                                                        <td class="file-group-img">
                                                            <div><?php the_sub_field('file_title'); ?></div>
                                                            <img src="<?php the_sub_field('file_image'); ?>" />
                                                        </td>
                                                        <td>
                                                            <?php if( have_rows('files') ): // 3rd repeater:files if ?>
                                                                <div class="table-responsiveX">
                                                                    <table class="file-list table table-striped table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <td>DOWNLOAD</td>
                                                                            <?php if( $table_columns && in_array('ftype', $table_columns) ) { ?>
                                                                                    <td>FILE TYPE</td>
                                                                            <?php } ?>
                                                                            <?php if( $table_columns && in_array('fsize', $table_columns) ) { ?>
                                                                                    <td>SIZE</td>
                                                                            <?php } ?>
                                                                            <?php if( $table_columns && in_array('fuse', $table_columns) ) { ?>
                                                                                    <td>USAGE</td>
                                                                            <?php } ?>
                                                                            <?php if( $table_columns && in_array('fcolor', $table_columns) ) { ?>
                                                                                    <td>COLOR MODE</td>
                                                                            <?php } ?>
                                                                            <?php if( $table_columns && in_array('fres', $table_columns) ) { ?>
                                                                                    <td>RESOLUTION</td>
                                                                            <?php } ?>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php while( have_rows('files') ): the_row(); // 2nd repeater:files while ?>
                                                                            <tr>
                                                                                <td><a download href="<?php the_sub_field('file_to_download'); ?>" target="_blank"><?php the_sub_field('file_title'); ?></a></td>
                                                                                <?php if( $table_columns && in_array('ftype', $table_columns) ) { ?>
                                                                                    <td><?php the_sub_field('file_type'); ?></td>
                                                                                <?php } ?>
                                                                                <?php if( $table_columns && in_array('fsize', $table_columns) ) { ?>
                                                                                        <td><?php the_sub_field('file_size'); ?></td>
                                                                                <?php } ?>
                                                                                <?php if( $table_columns && in_array('fuse', $table_columns) ) { ?>
                                                                                        <td><?php the_sub_field('file_usage'); ?></td>
                                                                                <?php } ?>
                                                                                <?php if( $table_columns && in_array('fcolor', $table_columns) ) { ?>
                                                                                        <td><?php the_sub_field('color_mode'); ?></td>
                                                                                <?php } ?>
                                                                                <?php if( $table_columns && in_array('fres', $table_columns) ) { ?>
                                                                                        <td><?php the_sub_field('resolution'); ?></td>
                                                                                <?php } ?>
                                                                            </tr>
                                                                            <?php endwhile; // end files while ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            <?php endif; // end files if ?>

                                                        </td>
                                                    </tr>
                                                </table>
                                                </div>

                                            <?php endwhile; // end file_table while ?>
                                        <?php endif; // end file_table if ?>

                                </div> <!-- end corp-section -->
                            <?php endwhile; // end section while ?>

                        </div> <!-- close corp-section-wrap -->
                    <?php endif; // end section if ?> 

                </div>

                <?php if( have_rows('partner_logo_templates') ): ?>
                    <hr />
                    <a class="anchor-offset" id="corp-logos-partner"></a>
                    <h2>Partner Logo Templates</h2>
                    <div class="corp-section-wrap">

                        <?php while( have_rows('partner_logo_templates') ): the_row(); ?>

                            <div class="row partner-logos">
                                <div class="col-sm-6">
                                    <strong><?php the_sub_field('partner_logo_heading'); ?></strong>
                                    <?php the_sub_field('partner_logo_text'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <img alt="" src="<?php the_sub_field('partner_logo_image'); ?>" />
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <a class="anchor-offset" id="corp-logos-color"></a>
                <hr />
                <div class="row">
                    <h2>Color Palette</h2>
                    <div class="col-sm-5">
                        <img alt="" src="https://www.treetop.com/wp-content/uploads/2020/06/brand-color-primary.jpg" />
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-md-6">
                                <img alt="" src="https://www.treetop.com/wp-content/uploads/2020/06/brand-color-c1.jpg" />
                            </div>
                            <div class="col-md-6">
                                <img alt="" src="https://www.treetop.com/wp-content/uploads/2020/06/brand-color-c2.jpg" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <img alt="" src="https://www.treetop.com/wp-content/uploads/2020/06/brand-color-n1.jpg" />
                            </div>
                            <div class="col-md-6">
                                <img alt="" src="https://www.treetop.com/wp-content/uploads/2020/06/brand-color-n2.jpg" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <script>
        jQuery(document).ready(function($){

        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn("slow");
        }
        else {
            $('.scrollToTop').fadeOut("slow");
        }
        }
                        );

        //Click event to scroll to top
        $('.scrollToTop').on('click',function(){
        $('html, body').animate({
            scrollTop : 0}
                                ,800);
        return false;
        });

        });
        </script>

        <style>
        .scrollToTop {
            display: none;
            position: fixed;
            bottom: 40px;
            right: 20px;
            height: 48px;
            width: 48px;
            background: url(/wp-content/themes/tree-top-c-cpg/images/scroll-to-top.png) no-repeat center center;
            z-index: 1000;
        }
        </style>
        <a href="#" class="scrollToTop" style="display: inline;"></a>

	<?php
    else:
        ?>
        <main>
            <div class="container content-wrap">
                <div class="row">
                    <div class="col-sm-8">
                        <p>This is a password protected section. Please register to access. If you already registered, login below.</p>
                        <p>By registering and logging in, you agree to read and comply with the Tree Top brand standards and logo usage guidelines.</p>
                        <p>Upon registering, check your email for your login information.</p>
                        <div class="container--tabs">
                            <section class="row">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a>Login</a></li>
                                    <li class=""><a href="/resource-library-register/">Register</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active"> 
                                        <?php echo do_shortcode("[mepr-login-form use_redirect='true']"); ?>
                                    </div> 
                                    <div class="tab-pane">
                                        <?php echo do_shortcode("[mepr-membership-registration-form id='7763']"); ?>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            window.addEventListener("load", function() {
            // store tabs variable
            /* var myTabs = document.querySelectorAll("ul.nav-tabs > li");
            function myTabClicks(tabClickEvent) {
                    for (var i = 0; i < myTabs.length; i++) {
                        myTabs[i].classList.remove("active");
                    }
                    var clickedTab = tabClickEvent.currentTarget;
                    clickedTab.classList.add("active");
                    tabClickEvent.preventDefault();
                    var myContentPanes = document.querySelectorAll(".tab-pane");
                    for (i = 0; i < myContentPanes.length; i++) {
                        myContentPanes[i].classList.remove("active");
                    }
                    var anchorReference = tabClickEvent.target;
                    var activePaneId = anchorReference.getAttribute("href");
                    var activePane = document.querySelector(activePaneId);
                    activePane.classList.add("active");
                }
                for (i = 0; i < myTabs.length; i++) {
                    myTabs[i].addEventListener("click", myTabClicks)
                }
            }); */
        </script>

        
        <?php
    endif; // end memberpress section.
}


genesis();