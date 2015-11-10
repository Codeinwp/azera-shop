jQuery(document).ready(function() {
    var azera_shop_aboutpage = azeraShopWelcomeScreenCustomizerObject.aboutpage;
    var azera_shop_nr_actions_required = azeraShopWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof azera_shop_aboutpage !== 'undefined') && (typeof azera_shop_nr_actions_required !== 'undefined') && (azera_shop_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + azera_shop_aboutpage + '"><span class="azera-shop-actions-count">' + azera_shop_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".azera-shops-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section azera-shops-upsells">');
    }
    if (typeof azera_shop_aboutpage !== 'undefined') {
        jQuery('.azera-shops-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + azera_shop_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', azeraShopWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".azera-shops-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});