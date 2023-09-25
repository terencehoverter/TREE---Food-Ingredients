/**
 * This script adds notice dismissal to the Tree Top Corp and CPG theme.
 *
 * @package Tree Top Corp and CPG\JS
 * @author 3rd Studio, Inc.
 * @license Exclusively for Tree Top+
 */

jQuery(document).on( 'click', '.treetopcc-woocommerce-notice .notice-dismiss', function() {

	jQuery.ajax({
		url: ajaxurl,
		data: {
			action: 'treetopcc_dismiss_woocommerce_notice'
		}
	});

});