function media_upload(button_class) {

	jQuery('body').on('click', button_class, function(e) {
		var button_id ='#'+jQuery(this).attr('id');
		var display_field = jQuery(this).parent().children('input:text');
		var _custom_media = true;

		wp.media.editor.send.attachment = function(props, attachment){

			if ( _custom_media  ) {
				if(typeof display_field != 'undefined'){
					switch(props.size){
						case 'full':
							display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
							break;
						case 'medium':
							display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
							break;
						case 'thumbnail':
							display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
							break;
						case 'azera_shop_services':
							display_field.val(attachment.sizes.azera_shop_services.url);
                            display_field.trigger('change');
							break
						case 'azera_shop_customers':
							display_field.val(attachment.sizes.azera_shop_customers.url);
                            display_field.trigger('change');
							break;
						default:
							display_field.val(attachment.url);
                            display_field.trigger('change');
					}
				}
				_custom_media = false;
			} else {
				return wp.media.editor.send.attachment( button_id, [props, attachment] );
			}
		}
		wp.media.editor.open(button_class);
		window.send_to_editor = function(html) {

		}
		return false;
	});
}

/********************************************
*** Generate uniq id ***
*********************************************/
function azera_shop_uniqid(prefix, more_entropy) {

  if (typeof prefix === 'undefined') {
    prefix = '';
  }

  var retId;
  var formatSeed = function(seed, reqWidth) {
    seed = parseInt(seed, 10)
      .toString(16); // to hex str
    if (reqWidth < seed.length) { // so long we split
      return seed.slice(seed.length - reqWidth);
    }
    if (reqWidth > seed.length) { // so short we pad
      return Array(1 + (reqWidth - seed.length))
        .join('0') + seed;
    }
    return seed;
  };

  // BEGIN REDUNDANT
  if (!this.php_js) {
    this.php_js = {};
  }
  // END REDUNDANT
  if (!this.php_js.uniqidSeed) { // init seed with big random int
    this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
  }
  this.php_js.uniqidSeed++;

  retId = prefix; // start with prefix, add current milliseconds hex string
  retId += formatSeed(parseInt(new Date()
    .getTime() / 1000, 10), 8);
  retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
  if (more_entropy) {
    // for more entropy we add a float lower to 10
    retId += (Math.random() * 10)
      .toFixed(8)
      .toString();
  }

  return retId;
}


/********************************************
*** General Repeater ***
*********************************************/
function azera_shop_refresh_general_control_values(){
	jQuery(".azera_shop_general_control_repeater").each(function(){
		var values = [];
		var th = jQuery(this);
		th.find(".azera_shop_general_control_repeater_container").each(function(){
			var icon_value = jQuery(this).find('.icp').val();
			var text = jQuery(this).find(".azera_shop_text_control").val();
			var link = jQuery(this).find(".azera_shop_link_control").val();
			var image_url = jQuery(this).find(".custom_media_url").val();
			var choice = jQuery(this).find(".azera_shop_image_choice").val();
			var title = jQuery(this).find(".azera_shop_title_control").val();
			var subtitle = jQuery(this).find(".azera_shop_subtitle_control").val();
			var id = jQuery(this).find(".azera_shop_box_id").val();
            var shortcode = jQuery(this).find(".azera_shop_shortcode_control").val();
            if( text !='' || image_url!='' || title!='' || subtitle!='' ){
                values.push({
                    "icon_value" : (choice === 'azera_shop_none' ? "" : icon_value) ,
                    "text" :  escapeHtml(text),
                    "link" : link,
                    "image_url" : (choice === 'azera_shop_none' ? "" : image_url),
                    "choice" : choice,
                    "title" : escapeHtml(title),
                    "subtitle" : escapeHtml(subtitle),
					"id" : id,
                    "shortcode" : escapeHtml(shortcode)
                });
            }

        });
        th.find('.azera_shop_repeater_colector').val(JSON.stringify(values));
        th.find('.azera_shop_repeater_colector').trigger('change');
    });
}



jQuery(document).ready(function(){
    jQuery('#customize-theme-controls').on('click','.azera-shop-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible'))
                jQuery(this).css('display','block');
        });
    });
    
    jQuery('#customize-theme-controls').on('change','.azera_shop_image_choice',function() {
        if(jQuery(this).val() == 'azera_shop_image'){
            jQuery(this).parent().parent().find('.azera_shop_general_control_icon').hide();
            jQuery(this).parent().parent().find('.azera_shop_image_control').show();
        }
        if(jQuery(this).val() == 'azera_shop_icon'){
            jQuery(this).parent().parent().find('.azera_shop_general_control_icon').show();
            jQuery(this).parent().parent().find('.azera_shop_image_control').hide();
        }
        if(jQuery(this).val() == 'azera_shop_none'){
            jQuery(this).parent().parent().find('.azera_shop_general_control_icon').hide();
            jQuery(this).parent().parent().find('.azera_shop_image_control').hide();
        }
        
        azera_shop_refresh_general_control_values();
        return false;        
    });
    media_upload('.custom_media_button_azera_shop');
    jQuery(".custom_media_url").live('change',function(){
        azera_shop_refresh_general_control_values();
        return false;
    });

	jQuery('#customize-theme-controls').on('change', '.icp', function () {
		azera_shop_refresh_general_control_values();
		return false;
	});

	jQuery("#customize-theme-controls").on('change', '.dd-selected-value',function(){
		azera_shop_refresh_general_control_values();
		return false; 
	});

	jQuery(".azera_shop_general_control_new_field").on("click",function(){
	 
		var th = jQuery(this).parent();
		var id = 'azera_shop_'+azera_shop_uniqid();
		if(typeof th != 'undefined') {
			
            var field = th.find(".azera_shop_general_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){
                field.find(".azera_shop_image_choice").val('azera_shop_icon');
                field.find('.azera_shop_general_control_icon').show();
				if(field.find('.azera_shop_general_control_icon').length > 0){
                	field.find('.azera_shop_image_control').hide();
				}
                field.find(".azera_shop_general_control_remove_field").show();

				field.find('.icp').iconpicker().on('iconpickerUpdated', function () {
					jQuery(this).trigger('change');
				});

				field.find('.iconpicker-component').html('');
				field.find('.icp').val('');
                field.find(".azera_shop_text_control").val('');
                field.find(".azera_shop_link_control").val('');
				field.find(".azera_shop_box_id").val(id);
                field.find(".custom_media_url").val('');
                field.find(".azera_shop_title_control").val('');
                field.find(".azera_shop_subtitle_control").val('');
                field.find(".azera_shop_shortcode_control").val('');
                th.find(".azera_shop_general_control_repeater_container:first").parent().append(field);
                azera_shop_refresh_general_control_values();
            }
			
		}
		return false;
	 });
	 
	jQuery("#customize-theme-controls").on("click", ".azera_shop_general_control_remove_field",function(){
		if( typeof	jQuery(this).parent() != 'undefined'){
			jQuery(this).parent().parent().remove();
			azera_shop_refresh_general_control_values();
		}
		return false;
	});


	jQuery("#customize-theme-controls").on('keyup', '.azera_shop_title_control',function(){
		 azera_shop_refresh_general_control_values();
	});

	jQuery("#customize-theme-controls").on('keyup', '.azera_shop_subtitle_control',function(){
		 azera_shop_refresh_general_control_values();
	});
    
    jQuery("#customize-theme-controls").on('keyup', '.azera_shop_shortcode_control',function(){
		 azera_shop_refresh_general_control_values();
	});
    
	jQuery("#customize-theme-controls").on('keyup', '.azera_shop_text_control',function(){
		 azera_shop_refresh_general_control_values();
	});
	
	jQuery("#customize-theme-controls").on('keyup', '.azera_shop_link_control',function(){
		azera_shop_refresh_general_control_values();
	});
	
	/*Drag and drop to change icons order*/
	jQuery(".azera_shop_general_control_droppable").sortable({
		update: function( event, ui ) {
			azera_shop_refresh_general_control_values();
		}
	});	

});

var entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;',
  };

  function escapeHtml(string) {
	  string = String(string).replace(/\\/g,'&#92;');
	  return String(string).replace(/[&<>"'\/]/g, function (s) {
      	return entityMap[s];
	  });
  }
/********************************************
*** Parallax effect
*********************************************/

jQuery(document).ready(function(){

	var sh = jQuery('#customize-control-azera_shop_enable_move').find('input:checkbox');
	if(!sh.is(':checked')){
		jQuery('#customize-control-azera_shop_first_layer').hide();
		jQuery('#customize-control-azera_shop_second_layer').hide();
		jQuery('#customize-control-header_image').show();
	} else {
		jQuery('#customize-control-azera_shop_first_layer').show();
		jQuery('#customize-control-azera_shop_second_layer').show();
		jQuery('#customize-control-header_image').hide();
	}
	
	sh.on('change',function(){
		if(jQuery(this).is(':checked')){
			jQuery('#customize-control-azera_shop_first_layer').fadeIn();
			jQuery('#customize-control-azera_shop_second_layer').fadeIn();
			jQuery('#customize-control-header_image').fadeOut();
		} else {
			jQuery('#customize-control-azera_shop_first_layer').fadeOut();
			jQuery('#customize-control-azera_shop_second_layer').fadeOut();
			jQuery('#customize-control-header_image').fadeIn();
		} 
	});
});

jQuery(document).ready(function() {

	var azera_shop_aboutpage = azeraShopCustomizerObject.aboutpage;
    var azera_shop_nr_actions_required = azeraShopCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof azera_shop_aboutpage !== 'undefined') && (typeof azera_shop_nr_actions_required !== 'undefined') && (azera_shop_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + azera_shop_aboutpage + '"><span class="azera-shop-actions-count">' + azera_shop_nr_actions_required + '</span></a>');
    }

	/* WooCommerce category select */
	jQuery(document).on('change', '.azera_shop_cat_select', function () {
		var th = jQuery(this).parent().parent();
		var chosed_option = jQuery(this).val();
		th.find(".azera-shop-woocommerce-cat").val(chosed_option);
		th.find(".azera-shop-woocommerce-cat").trigger('change');
	})
});	

/* Change header layout */

jQuery(document).ready(function () {
	
	var was_clicked = false;
	if (jQuery('.azera-shop-layout').val() == 'layout1') {
		jQuery('#customize-control-azera_shop_header_right_image').css('visibility', 'hidden');
		jQuery('#customize-control-azera_shop_header_right_image').css('position', 'absolute');
		was_clicked = false;
	} else {
		jQuery('#customize-control-azera_shop_header_right_image').css('visibility', 'visible');
		jQuery('#customize-control-azera_shop_header_right_image').css('position', 'relative');
		was_clicked = true;
	}

	jQuery(document).on('click', '.azera-shop-image-picker li', function () {
		var th = jQuery(this).parent().parent();
		var chosed_layout = jQuery(this).attr('id');
		if (chosed_layout == 'layout1') {
			jQuery('#customize-control-azera_shop_header_right_image').slideUp();
			was_clicked = false;
		} else if (chosed_layout == 'layout2') {
			if (was_clicked == false) {
				jQuery('#customize-control-azera_shop_header_right_image').css('visibility', 'visible');
				jQuery('#customize-control-azera_shop_header_right_image').css('position', 'relative');
				jQuery('#customize-control-azera_shop_header_right_image').hide();
				jQuery('#customize-control-azera_shop_header_right_image').slideDown();
			}
			was_clicked = true;
		}
		th.find(".azera-shop-layout").val(chosed_layout);
		th.find(".azera-shop-layout").trigger('change');
	});
	
});