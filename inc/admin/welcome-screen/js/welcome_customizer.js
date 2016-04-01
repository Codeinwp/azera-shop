jQuery(document).ready(function() {
    var azera_shop_aboutpage = azeraShopWelcomeScreenCustomizerObject.aboutpage;
    var azera_shop_nr_actions_required = azeraShopWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof azera_shop_aboutpage !== 'undefined') && (typeof azera_shop_nr_actions_required !== 'undefined') && (azera_shop_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + azera_shop_aboutpage + '"><span class="azera-shop-actions-count">' + azera_shop_nr_actions_required + '</span></a>');
    }

});