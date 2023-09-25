/*
 * jQuery scrollintoview() plugin and :scrollable selector filter
 *
 * Version 1.8 (14 Jul 2011)
 * Requires jQuery 1.4 or newer
 *
 * Copyright (c) 2011 Robert Koritnik
 * Licensed under the terms of the MIT license
 * http://www.opensource.org/licenses/mit-license.php
 */
(function(f){var c={vertical:{x:false,y:true},horizontal:{x:true,y:false},both:{x:true,y:true},x:{x:true,y:false},y:{x:false,y:true}};var b={duration:"fast",direction:"both"};var e=/^(?:html)$/i;var g=function(k,j){j=j||(document.defaultView&&document.defaultView.getComputedStyle?document.defaultView.getComputedStyle(k,null):k.currentStyle);var i=document.defaultView&&document.defaultView.getComputedStyle?true:false;var h={top:(parseFloat(i?j.borderTopWidth:f.css(k,"borderTopWidth"))||0),left:(parseFloat(i?j.borderLeftWidth:f.css(k,"borderLeftWidth"))||0),bottom:(parseFloat(i?j.borderBottomWidth:f.css(k,"borderBottomWidth"))||0),right:(parseFloat(i?j.borderRightWidth:f.css(k,"borderRightWidth"))||0)};return{top:h.top,left:h.left,bottom:h.bottom,right:h.right,vertical:h.top+h.bottom,horizontal:h.left+h.right}};var d=function(h){var j=f(window);var i=e.test(h[0].nodeName);return{border:i?{top:0,left:0,bottom:0,right:0}:g(h[0]),scroll:{top:(i?j:h).scrollTop(),left:(i?j:h).scrollLeft()},scrollbar:{right:i?0:h.innerWidth()-h[0].clientWidth,bottom:i?0:h.innerHeight()-h[0].clientHeight},rect:(function(){var k=h[0].getBoundingClientRect();return{top:i?0:k.top,left:i?0:k.left,bottom:i?h[0].clientHeight:k.bottom,right:i?h[0].clientWidth:k.right}})()}};f.fn.extend({scrollintoview:function(j){j=f.extend({},b,j);j.direction=c[typeof(j.direction)==="string"&&j.direction.toLowerCase()]||c.both;var n="";if(j.direction.x===true){n="horizontal"}if(j.direction.y===true){n=n?"both":"vertical"}var l=this.eq(0);var i=l.closest(":scrollable("+n+")");if(i.length>0){i=i.eq(0);var m={e:d(l),s:d(i)};var h={top:m.e.rect.top-(m.s.rect.top+m.s.border.top),bottom:m.s.rect.bottom-m.s.border.bottom-m.s.scrollbar.bottom-m.e.rect.bottom,left:m.e.rect.left-(m.s.rect.left+m.s.border.left),right:m.s.rect.right-m.s.border.right-m.s.scrollbar.right-m.e.rect.right};var k={};if(j.direction.y===true){if(h.top<0){k.scrollTop=m.s.scroll.top+h.top}else{if(h.top>0&&h.bottom<0){k.scrollTop=m.s.scroll.top+Math.min(h.top,-h.bottom)}}}if(j.direction.x===true){if(h.left<0){k.scrollLeft=m.s.scroll.left+h.left}else{if(h.left>0&&h.right<0){k.scrollLeft=m.s.scroll.left+Math.min(h.left,-h.right)}}}if(!f.isEmptyObject(k)){if(e.test(i[0].nodeName)){i=f("html,body")}i.animate(k,j.duration).eq(0).queue(function(o){f.isFunction(j.complete)&&j.complete.call(i[0]);o()})}else{f.isFunction(j.complete)&&j.complete.call(i[0])}}return this}});var a={auto:true,scroll:true,visible:false,hidden:false};f.extend(f.expr[":"],{scrollable:function(k,i,n,h){var m=c[typeof(n[3])==="string"&&n[3].toLowerCase()]||c.both;var l=(document.defaultView&&document.defaultView.getComputedStyle?document.defaultView.getComputedStyle(k,null):k.currentStyle);var o={x:a[l.overflowX.toLowerCase()]||false,y:a[l.overflowY.toLowerCase()]||false,isRoot:e.test(k.nodeName)};if(!o.x&&!o.y&&!o.isRoot){return false}var j={height:{scroll:k.scrollHeight,client:k.clientHeight},width:{scroll:k.scrollWidth,client:k.clientWidth},scrollableX:function(){return(o.x||o.isRoot)&&this.width.scroll>this.width.client},scrollableY:function(){return(o.y||o.isRoot)&&this.height.scroll>this.height.client}};return m.y&&j.scrollableY()||m.x&&j.scrollableX()}})})(jQuery);

var tt_locator = {
    lat: 46.6483487,
    lng: -120.5539756,
    markers: [],
    infoWindows: [],
    curinfowindow: false,
    gmap: {},
};

function postalCodeLookup() {
    var head= document.getElementsByTagName('head')[0],
        submitbtn = document.getElementById('wpsl-search-btn');

    if (navigator.geolocation) {
        var fallback = setTimeout(function () {
                fail('10 seconds expired');
            }, 10000);

        navigator.geolocation.getCurrentPosition(function (pos) {
            clearTimeout(fallback);
            var point = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
            new google.maps.Geocoder().geocode({'latLng': point}, function (res, status) {
                if (status == google.maps.GeocoderStatus.OK && typeof res[0] !== 'undefined') {
                    var zip = res[0].formatted_address.match(/,\s\w{2}\s(\d{5})/);
                    if (zip) {
                        tt_locator.lat=pos.coords.latitude;
                        tt_locator.lng=pos.coords.longitude;
                        document.getElementById('wpsl-search-input').value = zip[1];
                        submitbtn.click();
                    } else fail('Unable to look-up postal code');
                } else {
                    fail('Unable to look-up geolocation');
                }
            });
        }, function (err) {
            fail(err.message);
        });
    } else {
        alert('Unable to find your location.');
    }
    function fail(err) {
        console.log('err', err);
    }
}

function tt_locator__clear_markers_and_listings ()
{
    tt_locator.gmap.then(function(r)
    {
        jQuery.each(tt_locator.markers, function(i, marker)
        {
            // if ( 'undefined' == typeof marker ) { return; }
            marker.setMap(null);
        });
        tt_locator.markers = [];
        jQuery.each(tt_locator.infoWindows, function(i, infoWindow)
        {
            // if ( 'undefined' == typeof infoWindow ) { return; }
            infoWindow.setMap(null);
        });
        tt_locator.infoWindows = [];
    });
    tt_locator.gmap.previousResults = [];

    jQuery('#wpsl-stores > ul').empty();
}

function tt_locator__add_markers ( markers )
{
    jQuery.each(markers, function( i, marker )
    {
        tt_locator__add_marker({
            id: 'tt_locator__marker_'+i,
            lat: marker.LATITUDE,
            lng: marker.LONGITUDE,
            name: marker.NAME,
            addy: marker.ADDRESS + '<br>' + marker.CITY +' '+ marker.STATE+' '+ marker.ZIP,
        });
    });

    if ( 0 !== markers.length )
    {
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < tt_locator.markers.length; i++) {
            bounds.extend(tt_locator.markers[i].getPosition());
        }
        tt_locator.gmap.get(0).fitBounds(bounds);
    }
}

function tt_locator__add_marker ( args )
{
    tt_locator.gmap.marker(
    {
        position: [args.lat, args.lng],
    })
    .infowindow(
    {
        content: '<div class="wpsl-info-window"><p><strong>'+args.name+'</strong><span>'+args.addy+'</span></p><div class="wpsl-info-actions"><a class="wpsl-directions" target="_blank" href="https://www.google.com/maps/dir/Current+Location/'+args.lat+','+args.lng+'">Directions</a></div></div>',
    })
    .then(function(r)
    {
        var marker = this.get(-2);
        var infowindow = r;
        marker.addListener('click', function() {
            infowindow.open(tt_locator.gmap, marker);
            if ( tt_locator.curinfowindow ) { tt_locator.curinfowindow.close(); }
            tt_locator.curinfowindow = infowindow;
            // console.log(args.id);
            jQuery('.wpsl-store-listing.-active').removeClass('-active');
            jQuery('.wpsl-store-listing[data-marker-id="'+args.id+'"]').scrollintoview();
            jQuery('.wpsl-store-listing[data-marker-id="'+args.id+'"]').addClass('-active');
        });
        marker.addListener('tt_locator__focus', function() {
            infowindow.open(tt_locator.gmap, marker);
            if ( tt_locator.curinfowindow ) { tt_locator.curinfowindow.close(); }
            tt_locator.curinfowindow = infowindow;
        });
        tt_locator.markers.push(marker);
        tt_locator.infoWindows.push(infowindow);
    });
}

function tt_locator__add_listings ( listings )
{
    // console.log('tt_locator__add_listings');

    if ( ! listings.length > 0 )
    {
        var html = ''
        +'<li class="wpsl-store-listing">'
            +'<div class="wpsl-store-location">'
                +'<p>'
                    +'<strong>We’re sorry, no locations were found carrying this product in your area. Try a different product selection or refine the search radius.</strong>'
                    +'<span class="wpsl-street"></span>'
                    +'<span></span>'
                    +'<span class="wpsl-country"></span>'
                +'</p>'
            +'</div>'
            +'<div class="wpsl-direction-wrap"></div>'
        +'</li>';

        jQuery('#wpsl-stores > ul').append(html);
    }

    jQuery.each(listings, function( i, listing )
    {
        tt_locator__add_listing({
            id: 'tt_locator__marker_'+i,
            lat: listing.LATITUDE,
            lng: listing.LONGITUDE,
            name: listing.NAME,
            addy: listing.ADDRESS,
            citystatezip: listing.CITY +' '+ listing.STATE+' '+ listing.ZIP,
            dist: listing.DISTANCE,
        });
    });
}

function tt_locator__add_listing ( args )
{
    var html = ''
    +'<li class="wpsl-store-listing" data-marker-id="'+args.id+'">'
        +'<div class="wpsl-store-location">'
            +'<p>'
                +'<strong>'+args.name+'</strong>'
                +'<span class="wpsl-street">'+args.addy+'</span>'
                +'<span>'+args.citystatezip+'</span>'
                +'<span class="wpsl-country"></span>'
            +'</p>'
        +'</div>'
        +'<div class="wpsl-direction-wrap">'
            +args.dist+' mi'
            +'<a class="wpsl-directions" target="_blank" href="https://www.google.com/maps/dir/Current+Location/'+args.lat+','+args.lng+'">Directions</a>'
        +'</div>'
    +'</li>';

    jQuery('#wpsl-stores > ul').append(html);
}

function tt_locator__update_gmap ()
{
    if ( null != jQuery('#tt_locator_form').find('select[name="product"]').val() && 'any' != jQuery('#tt_locator_form').find('select[name="product"]').val() )
    {
        jQuery('#wpsl-selected-opt').find('span').text( jQuery('#tt_locator_form').find('select[name="product"] option[value="'+jQuery('#tt_locator_form').find('select[name="product"]').val()+'"]').text() );
        jQuery('#wpsl-selected-opt').removeClass('-hidden');
    }

    jQuery.ajax({
        type : 'post',
        dataType : 'json',
        url : tt_locator_ajax.url,
        data : {
            action: 'get_stores_json',
            _wpnonce: jQuery('#tt_locator_form').find('input[name="_wpnonce"]').val(),
            zip: jQuery('#tt_locator_form').find('input[name="zip"]').val(),
            product: jQuery('#tt_locator_form').find('select[name="product"]').val(),
            radius: jQuery('#tt_locator_form').find('select[name="radius"]').val(),
        },
        beforeSend: function() {
            jQuery('.wpsl-search').addClass('-loading');
        },
        success: function(response) {
            try {
                var stores = response.RESULTS.STORES.STORE;
                // console.log(stores);
                tt_locator__clear_markers_and_listings();
                tt_locator__add_markers(stores);
                tt_locator__add_listings(stores);
            } catch (e) {
                console.log(e, 'err');
                return false;
            }
        },
        complete: function()
        {
            jQuery('.wpsl-search').removeClass('-loading');
        }
    })
}

function tt_locator__init_gmap ()
{
    if ( ! jQuery('#wpsl-gmap').length ) { return; }

    tt_locator.gmap = jQuery('#wpsl-gmap').gmap3({
        center:[tt_locator.lat, tt_locator.lng],
        zoom:12,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
    });

    jQuery('#wpsl-result-list').on('hover', '.wpsl-store-listing', function(e)
    {
        // console.log(jQuery(this).data('marker-id'));
        jQuery('.wpsl-store-listing.-active').removeClass('-active');
        jQuery(this).addClass('-active');
        var marker_id = jQuery(this).data('marker-id').replace('tt_locator__marker_', '');
        google.maps.event.trigger(tt_locator.markers[marker_id], 'tt_locator__focus');
    });

    jQuery('#wpsl-search-btn').on('click', function(e)
    {
        e.preventDefault();
        if ( jQuery('#wpsl-results-dropdown').val() )
        {
            tt_locator__update_gmap();
        }
    });

    try {
        var stores = JSON.parse(tt_locator_stores).RESULTS.STORES.STORE;
        tt_locator__add_markers(stores);
    } catch (e) {
        // console.log(e, 'err');
        // return false;
    }

    postalCodeLookup();
}

jQuery(function($)
{
    tt_locator__init_gmap();
});
