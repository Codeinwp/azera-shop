jQuery(document).ready(function() {
	
	/* If there are required actions, add an icon with the number of required actions in the About Azera Shop page -> Actions required tab */
    var azera_shop_nr_actions_required = azeraShopWelcomeScreenObject.nr_actions_required;

    if ( (typeof azera_shop_nr_actions_required !== 'undefined') && (azera_shop_nr_actions_required != '0') ) {
        jQuery('li.azera-shop-w-red-tab a').append('<span class="azera-shop-actions-count">' + azera_shop_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".azera-shop-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'azera_shop_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : azeraShopWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.azera-shop-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + azeraShopWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var azera_shop_actions_count = jQuery('.azera-shop-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof azera_shop_actions_count !== 'undefined' ) {
                    if( azera_shop_actions_count == '1' ) {
                        jQuery('.azera-shop-actions-count').remove();
                        jQuery('.azera-shop-tab-pane#actions_required').append('<p>' + azeraShopWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.azera-shop-actions-count').text(parseInt(azera_shop_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });
	
	/* Tabs in welcome page */
	function azera_shop_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".azera-shop-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}
	
	var azera_shop_actions_anchor = location.hash;
	
	if( (typeof azera_shop_actions_anchor !== 'undefined') && (azera_shop_actions_anchor != '') ) {
		azera_shop_welcome_page_tabs('a[href="'+ azera_shop_actions_anchor +'"]');
	}
	
    jQuery(".azera-shop-nav-tabs a").click(function(event) {
        event.preventDefault();
		azera_shop_welcome_page_tabs(this);
    });
	
});