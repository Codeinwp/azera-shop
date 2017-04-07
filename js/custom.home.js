/* global viewcart */
/* PRE LOADER */
jQuery(window).load(function () {
    'use strict';
    jQuery('.status').fadeOut();
    jQuery('.preloader').delay(1000).fadeOut('slow');    
});

jQuery(window).resize(function() {
    'use strict';
    var ww = jQuery(window).width();
    /* COLLAPSE NAVIGATION ON MOBILE AFTER CLICKING ON LINK */
    if (ww < 480) {
        jQuery('.sticky-navigation a').on('click', function() {
            jQuery('.navbar-toggle').click();
        });
    }
});

var home_window_width_old;
jQuery(document).ready(function(){
    home_window_width_old = jQuery('.container').width();
    if( home_window_width_old < 750  ){
        jQuery('#our_services_wrap').azerashopgridpinterest({columns: 1,selector: '.service-box'});
        jQuery('#happy_customers_wrap').azerashopgridpinterest({columns: 1,selector: '.testimonials-box'});
    } else {
        jQuery('#our_services_wrap').azerashopgridpinterest({columns: 3,selector: '.service-box'});
        jQuery('#happy_customers_wrap').azerashopgridpinterest({columns: 3,selector: '.testimonials-box'});
    } 
});

jQuery(window).resize(function() {
    if( home_window_width_old !== jQuery('.container').outerWidth() ){
        home_window_width_old = jQuery('.container').outerWidth();
        if( home_window_width_old < 750  ){
            jQuery('#our_services_wrap').azerashopgridpinterest({columns: 1,selector: '.service-box'});
            jQuery('#happy_customers_wrap').azerashopgridpinterest({columns: 1,selector: '.testimonials-box'});
        } else {
            jQuery('#our_services_wrap').azerashopgridpinterest({columns: 3,selector: '.service-box'});
            jQuery('#happy_customers_wrap').azerashopgridpinterest({columns: 3,selector: '.testimonials-box'});
        } 
    }
});


/*=============================
========= MAP OVERLAY =========
===============================*/
jQuery(document).ready(function(){
    jQuery('html').click(function() {
        jQuery('.azera_shop_map_overlay').show();
    });
    
    jQuery('#container-fluid').click(function(event){
        event.stopPropagation();
    });
    
    jQuery('.azera_shop_map_overlay').on('click',function(){
        jQuery(this).hide();
    });
});

jQuery(document).ready(function(){
    if(jQuery('.overlay-layer-nav').hasClass('sticky-navigation-open')){
        var $azera_shop_header_height = jQuery('.navbar').height();
        $azera_shop_header_height+=84;
        jQuery('.header .overlay-layer').css('padding-top',$azera_shop_header_height);
    }

    /* Added View cart button on the frontpage Shop section */
    jQuery('body').on('added_to_cart',function(){

        if( typeof jQuery( 'section.shop a.add_to_cart_button.added' ) !== 'undefined' ) {

            jQuery( 'section.shop a.add_to_cart_button.added' ).each( function () {

                if( typeof jQuery( this ).parent() !== 'undefined' ) {

                    if ( ! jQuery( this ).parent().find( '.added_to_cart' ).length ) {

                        jQuery( this ).parent().append( '<a href="' + viewcart.view_cart_link + '" class="added_to_cart wc-forward">' + viewcart.view_cart_label +  '</a>' );

                    }
                }

            });
        }

    });
});

