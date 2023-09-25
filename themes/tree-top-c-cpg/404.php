<?php
/**
 * Genesis Sample.
 *
 * This file adds Single Post template to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  Aryan Raj
 * @license GPL-2.0-or-later
 * @link    https://www.aryanraj.com/
 */


// Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
// Remove default loop.
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );
function genesis_404() {
    ?>
    <!-- <header class="entry-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="entry-title">Page Not Found (404)</h1>
                </div>
            </div>
        </div>
    </header> -->
    <div class="entry-content">
        <div class="container content-wrap">
            <div class="row">
                <main class="col-sm-12">
                    <div style="text-align:center">
                        <h2>Oops! Looks like someone upset the apple cart!</h2>
                        <p>We've searched through every orchard but can't find what you were looking for.</p>
                        <p>If you think something has gone horribly wrong, please <a href="https://tree-top-corp-and-cpg.local/contact/">contact us</a>.<br />Otherwise, use the menu above to find what you're looking for.</p>
                        <img src="/wp-content/themes/tree-top-c-cpg/images/404.jpg" /></div>
                </main>
            </div>
        </div>
    </div>
    <?php
}

 // Run Genesis.
genesis();