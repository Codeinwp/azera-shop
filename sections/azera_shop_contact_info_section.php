<!-- =========================
 SECTION: CONTACT INFO  
============================== -->
<?php
	$azera_shop_contact_info_item = get_theme_mod('azera_shop_contact_info_content',
		json_encode(
			array( 
					array("icon_value" => "icon-basic-mail" ,"text" => "contact@site.com", "link" => "#" ), 
					array("icon_value" => "icon-basic-geolocalize-01" ,"text" => "Company address", "link" => "#" ), 
					array("icon_value" => "icon-basic-tablet" ,"text" => "0 332 548 954", "link" => "#" ) 
				)
		)
	);

	if( !azera_shop_general_repeater_is_empty($azera_shop_contact_info_item) ){
		$azera_shop_contact_info_item_decoded = json_decode($azera_shop_contact_info_item);
	?>
			<div class="contact-info" id="contactinfo" role="region" aria-label="<?php esc_html_e('Contact Info','azera-shop'); ?>">
				<div class="section-overlay-layer">
					<div class="container">

						<!-- CONTACT INFO -->
						<div class="row contact-links">

							<?php

								if(!empty($azera_shop_contact_info_item_decoded)){

										foreach($azera_shop_contact_info_item_decoded as $azera_shop_contact_item){
											if(!empty($azera_shop_contact_item->link)){
												echo '<div class="col-sm-4 contact-link-box col-xs-12">';
												if(!empty($azera_shop_contact_item->icon_value)){
													echo '<div class="icon-container"><span class="'.esc_attr($azera_shop_contact_item->icon_value).' colored-text"></span></div>';
												}
												if(!empty($azera_shop_contact_item->text)){
													echo '<a href="'.$azera_shop_contact_item->link.'" class="strong">'.html_entity_decode($azera_shop_contact_item->text).'</a>';
												}
												echo '</div>';
											} else {

												echo '<div class="col-sm-4 contact-link-box  col-xs-12">';
												if(!empty($azera_shop_contact_item->icon_value)){
													echo '<div class="icon-container"><span class="'.esc_attr($azera_shop_contact_item->icon_value).' colored-text"></span></div>';
												}
												if(!empty($azera_shop_contact_item->text)){
													if(function_exists('icl_t')){
														echo '<a href="" class="strong">'.icl_t('Contact',$azera_shop_contact_item->id.'_contact',html_entity_decode($azera_shop_contact_item->text)).'</a>';
													} else {
														echo '<a href="" class="strong">'.html_entity_decode($azera_shop_contact_item->text).'</a>';
													}
												}
												echo '</div>';
											}
										}
								}

							?>         
						</div><!-- .contact-links -->
					</div><!-- .container -->
				</div>
			</div><!-- .contact-info -->
<?php
	} 
?>