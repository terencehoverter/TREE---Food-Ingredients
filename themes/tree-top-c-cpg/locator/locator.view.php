<?php
    $products = tt_locator_get_products();
    $args = [];
    if ( @$_GET['UPC'] ) { $args['prod'] = sanitize_text_field( $_GET['UPC'] ); }
    $stores_json = tt_locator_get_stores_json( $args );
    $stores = json_decode( $stores_json );
    $stores = @$stores->RESULTS->STORES->STORE;
    $product_name = '';
?>
<script>
    var tt_locator_stores = '<?= @$_GET['UPC'] ? trim($stores_json) : '{}' ?>';
</script>
<div id="wpsl-wrap">
    <div class="wpsl-search wpsl-clearfix ">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
        <div id="wpsl-search-wrap">
            <form autocomplete="off" id="tt_locator_form">
                <?php wp_nonce_field( 'tt_locator' ); ?>
                <div class="wpsl-input">
                    <div>
                        <label for="wpsl-search-input">Your ZIP</label>
                    </div>
                    <input id="wpsl-search-input" type="text" pattern="[0-9]{5}" value="98942" name="zip" placeholder="" aria-required="true" autocomplete="off">
                </div>
                <div class="wpsl-select-wrap">
                    <div id="wpsl-results">
                        <label for="wpsl-results-dropdown">Product</label>
                        <div class="wpsl-dropdown">
                            <select id="wpsl-results-dropdown" class="" name="product">
                                <option <?= ! @$_GET['UPC'] ? 'selected="selected" disabled="disabled"' : '' ?>>Choose a Product</option>
                                <?php foreach ( $products as $product ): ?>
                                <option value="<?= $product->upc_code ?>" <?php if ( @$_GET['UPC'] == $product->upc_code ) { echo 'selected="selected"'; $product_name = $product->upc_name; } ?>><?= $product->upc_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div id="wpsl-radius">
                        <label for="wpsl-radius-dropdown">Search radius</label>
                        <div class="wpsl-dropdown">
                            <select id="wpsl-radius-dropdown" class="" name="radius">
                                <option value="5">5 mi</option>
                                <option selected="selected" value="10">10 mi</option>
                                <option value="25">25 mi</option>
                                <option  value="50">50 mi</option>
                                <option value="100">100 mi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="wpsl-search-btn-wrap">
                    <input id="wpsl-search-btn" type="submit" value="Search">
                </div>
            </form>
        </div>
    </div>
    <div id="wpsl-selected-opt" <?= $product_name ? '' : 'class="-hidden"' ?>><b>Searching for: </b><span><?= $product_name ?: '' ?></span></div>
    <div id="wpsl-gmap" class="wpsl-gmap-canvas" style="position: relative; overflow: hidden;"></div>
    <div id="wpsl-result-list">
        <div id="wpsl-stores" class="wpsl-not-loaded">
            <ul>
                <?php if ( ! @$_GET['UPC'] ): ?>
                <li class="wpsl-store-listing">
                    <div class="wpsl-store-location">
                        <p>
                            <strong>No product selected.<br>Please select one in the “Product” box above.</strong>
                            <span class="wpsl-street"></span>
                            <span></span>
                            <span class="wpsl-country"></span>
                        </p>
                    </div>
                    <div class="wpsl-direction-wrap"></div>
                </li>
                <?php else: ?>
                    <?php foreach ( $stores as $i => $store ): ?>
                    <li class="wpsl-store-listing" data-marker-id="tt_locator__marker_<?= $i ?>">
                        <div class="wpsl-store-location">
                            <p>
                                <strong><?= $store->NAME ?></strong>
                                <span class="wpsl-street"><?= $store->ADDRESS ?></span>
                                <span><?= $store->CITY ?> <?= $store->STATE ?> <?= $store->ZIP ?></span>
                                <span class="wpsl-country"></span>
                            </p>
                        </div>
                        <div class="wpsl-direction-wrap">
                            <?= $store->DISTANCE ?> mi
                            <a class="wpsl-directions" target="_blank" href="https://www.google.com/maps/dir/Current+Location/<?= $store->LATITUDE ?>,<?= $store->LONGITUDE ?>">Directions</a>
                        </div>
                    </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div id="wpsl-direction-details">
            <ul></ul>
        </div>
    </div>
</div>
