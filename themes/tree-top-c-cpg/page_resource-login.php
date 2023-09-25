<?php
/**
*
* Template Name:	Resource Library Login
* Description:		Resource Library Login/Registration page
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
    ?>
    <main>
        <div class="container content-wrap">
            <div class="col-sm-8">
                <div class="row">
                    <p>This is a password protected section. Please register to access. If you alreayd registered, login below.</p>
                    <p>By registering and logging in, you agree to read and comply with the Tree Top brand standards and logo usage guidelines.</p>
                    <p>Upon registering, check your email for you login information.</p>
                    <div class="container--tabs">
                        <section class="row">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-1">Login</a></li>
                                <li class=""><a href="#tab-2">Register</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active"> 
                                    <?php echo do_shortcode("[mepr-login-form use_redirect='true']"); ?>
                                </div> 
                                <div id="tab-2" class="tab-pane">
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
        var myTabs = document.querySelectorAll("ul.nav-tabs > li");
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
        });
    </script>
    <?php
}



genesis();