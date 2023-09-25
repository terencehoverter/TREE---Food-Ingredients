<?php
/**
 * All TreeTop Locator Functions
 */
$tt_locator_cache_length = 1; // in days


function tt_locator_enqueue_assets ()
{
	$tt_locator_js_v = filemtime( get_stylesheet_directory() .'/locator/locator.js' );
	wp_enqueue_script( 'tt-locator-js', get_stylesheet_directory_uri() . '/locator/locator.js', array( 'jquery' ), $tt_locator_js_v, true );
	wp_localize_script( 'tt-locator-js', 'tt_locator_ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
	$tt_locator_css_v = filemtime( get_stylesheet_directory() .'/locator/locator.css' );
	wp_enqueue_style( 'tt-locator-css', get_stylesheet_directory_uri() . '/locator/locator.css', [], $tt_locator_css_v );

	wp_enqueue_script( 'tt-locator-gmaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBmrhdHLCqNI8JObyb3cb7wItHo3Uba5xo', array(), '3', true ); //
	wp_enqueue_script( 'tt-locator-gmap3', 'https://cdn.jsdelivr.net/gmap3/7.2.0/gmap3.min.js', array('tt-locator-gmaps'), '7.2.0', true );
}
add_action( 'wp_enqueue_scripts', 'tt_locator_enqueue_assets', 1 );


function tt_locator_get_stores_json ( $args = [] )
{
	if ( ! @$args['prod'] && @$_GET['UPC'] ) { $args['prod'] = sanitize_text_field( $_GET['UPC'] ); }

	$args = wp_parse_args( $args,
	[
		'zip' => '98942',
		'prod' => 'any',
		'radius' => '10',
	]);

	$args['zip'] = sanitize_text_field( $args['zip'] );
	$args['prod'] = sanitize_text_field( $args['prod'] );
	$args['radius'] = sanitize_text_field( $args['radius'] );

	$stores = get_transient( 'tt_locator_stores_'.$args['zip'].'_'.$args['radius'].'mi_'.$args['prod'] );

	if ( $stores )
	{
		return $stores;
	}

	$api_endpoint = 'http://productlocator.iriworldwide.com/productlocator/servlet/ProductLocatorEngine?clientid=332&storesperpage=999&productfamilyid=TTOP&zip='.$args['zip'].'&'.($args['prod'] == 'any' ? 'productid=any&producttype=agg' : 'productid='.$args['prod'].'&producttype=upc').'&searchradius='.$args['radius'].'&storespagenum=1&outputtype=json';
	// trigger_error($api_endpoint);
	$response = wp_remote_get( $api_endpoint );

	$stores = $response['body'] ?: false;

	if ( $stores )
	{
		global $tt_locator_cache_length;
		set_transient( 'tt_locator_stores_'.$args['zip'].'_'.$args['radius'].'mi_'.$args['prod'], $stores, 60 * 60 * 24 * $tt_locator_cache_length );
	}

	return $stores ? $stores : ['error'=>'1'];
}


function tt_locator_ajax_get_stores_json ()
{
	if ( empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest' )
	{
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}

	if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'tt_locator' ) )
	{
        exit('Not an approved action.');
    }

    $args = [];

    if ( @$_REQUEST['zip'] && preg_match( "/^([0-9]{5})(-[0-9]{4})?$/i", $_REQUEST['zip'] ) ) { $args['zip'] = $_REQUEST['zip']; }
    if ( @$_REQUEST['product'] ) { $args['prod'] = sanitize_text_field( $_REQUEST['product'] ); }
    if ( @$_REQUEST['radius'] && in_array( $_REQUEST['radius'], ['5','10','25','50','100'] ) ) { $args['radius'] = $_REQUEST['radius']; }

    echo tt_locator_get_stores_json( $args );
    die();
}
add_action( 'wp_ajax_get_stores_json', 'tt_locator_ajax_get_stores_json' );
add_action( 'wp_ajax_nopriv_get_stores_json', 'tt_locator_ajax_get_stores_json' );


function tt_locator_get_stores ( $args = [] )
{
	$stores = json_decode( tt_locator_get_stores_json( $args ) );
	return @$stores->RESULTS->STORES->STORE;
}


function tt_locator_get_products ()
{
	$products = get_transient( 'tt_locator_products' );

	if ( $products )
	{
		$products = json_decode( $products );
		return @$products->products->product;
	}

	$api_endpoint = 'http://productlocator.iriworldwide.com/productlocator/products/products.pli?client_id=332&productfamilyid=TTOP&output=json';
	// trigger_error($api_endpoint);
	$response = wp_remote_get( $api_endpoint );

	$products = $response['body'] ?: false;

	if ( $products )
	{
		global $tt_locator_cache_length;
		set_transient( 'tt_locator_products', $products, 60 * 60 * 24 * $tt_locator_cache_length );
	}

	$products = @json_decode( $products );
	return @$products->products->product ? $products->products->product : ['error'=>'1'];
}

