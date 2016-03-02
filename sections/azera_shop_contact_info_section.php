<!-- =========================
 SECTION: CONTACT INFO  
============================== -->
<?php
	$azera_shop_contact_info_item = get_theme_mod('azera_shop_contact_info_content',
		json_encode(
			array( 
					array("icon_value" => "fa-envelope-o" ,"text" => "contact@site.com", "link" => "#", 'id' => 'azera_shop_56d6b291454c3' ), 
					array("icon_value" => "fa-map-o" ,"text" => "Company address", "link" => "#", 'id' => 'azera_shop_56d6b293454c4' ), 
					array("icon_value" => "fa-phone" ,"text" => "0 332 548 954", "link" => "#", 'id' => 'azera_shop_56d6b295454c5' ) 
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
													if (function_exists ( 'icl_t' ) && !empty($azera_shop_contact_item->id)){
														echo '<div class="icon-container"><i class="fa '.esc_attr( icl_t('Contact Icon', $azera_shop_contact_item->id.'_contact_icon',$azera_shop_contact_item->icon_value)).' colored-text"></i></div>';
													} else {
														echo '<div class="icon-container"><i class="fa '.esc_attr($azera_shop_contact_item->icon_value).' colored-text"></i></div>';
													}
												}
												if(!empty($azera_shop_contact_item->text)){
													if (function_exists ( 'icl_t' ) && !empty($azera_shop_contact_item->id)){
														echo '<a href="'.esc_url( icl_t('Contact Link', $azera_shop_contact_item->id.'_contact_link', $azera_shop_contact_item->link)).'" class="strong">'.icl_t('Contact',$azera_shop_contact_item->id.'_contact',html_entity_decode($azera_shop_contact_item->text)).'</a>';
													} else {
														echo '<a href="'.$azera_shop_contact_item->link.'" class="strong">'.html_entity_decode($azera_shop_contact_item->text).'</a>';
													}
												}
												echo '</div>';
											} else {

												echo '<div class="col-sm-4 contact-link-box  col-xs-12">';
												if(!empty($azera_shop_contact_item->icon_value)){
													if (function_exists ( 'icl_t' ) && !empty($azera_shop_contact_item->id)){
														echo '<div class="icon-container"><i class="fa '.esc_attr( icl_t('Contact Icon',$azera_shop_contact_item->id.'_contact_icon',$azera_shop_contact_item->icon_value) ).' colored-text"></i></div>';
													} else {
														echo '<div class="icon-container"><i class="fa '.esc_attr($azera_shop_contact_item->icon_value).' colored-text"></i></div>';
													}
												}
												if(!empty($azera_shop_contact_item->text)){
													if(function_exists('icl_t')){
														echo '<a href="" class="strong">'.icl_t('Contact Text',$azera_shop_contact_item->id.'_contact',html_entity_decode($azera_shop_contact_item->text)).'</a>';
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