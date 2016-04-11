<!-- =========================
 SECTION: CONTACT INFO  
============================== -->
<?php

if( current_user_can( 'edit_theme_options') ){
	$azera_shop_contact_info_item = get_theme_mod('azera_shop_contact_info_content', json_encode(
	array( 
		array("icon_value" => "fa-envelope-o" ,"text" => esc_html__('Text from customizer.','azera-shop'), 'id' => 'azera_shop_56d6b291454c3' ), 
		array("icon_value" => "fa-map-o" ,"text" => esc_html__('Text from customizer.','azera-shop'), 'id' => 'azera_shop_56d6b293454c4' ), 
		array("icon_value" => "fa-phone" ,"text" => esc_html__('Text from customizer.','azera-shop'), 'id' => 'azera_shop_56d6b295454c5' )
	) )
);
} else{
	$azera_shop_contact_info_item = get_theme_mod('azera_shop_contact_info_content');
}
if( !empty($azera_shop_contact_info_item) ){

	$azera_shop_contact_info_item_decoded = json_decode($azera_shop_contact_info_item); ?>
	<div class="contact-info" id="contactinfo" role="region" aria-label="<?php esc_html_e('Contact Info','azera-shop'); ?>">
		<div class="section-overlay-layer">
			<div class="container">

				<!-- CONTACT INFO -->
				<div class="row contact-links">
					<?php
					if(!empty($azera_shop_contact_info_item_decoded)){

						foreach($azera_shop_contact_info_item_decoded as $azera_shop_contact_item){
							$id = '';
							$link = '';
							$text = '';
							$icon = '';
							if( !empty( $azera_shop_contact_item->id ) ){
								$id = esc_attr($azera_shop_contact_item->id);
							}

							if( !empty( $azera_shop_contact_item->link ) ){
								if ( function_exists('pll__') ){
									$link = pll__( $azera_shop_contact_item->link );
								} else {
									$link = apply_filters( 'wpml_translate_single_string', $azera_shop_contact_item->link, 'Azera Shop -> Contact section', 'Contact box link '.$azera_shop_contact_item->id );
								}
							}

							if( !empty( $azera_shop_contact_item->text ) ){
								if ( function_exists('pll__') ){
									$text = pll__( $azera_shop_contact_item->text );
								} else {
									$text = apply_filters( 'wpml_translate_single_string', $azera_shop_contact_item->text, 'Azera Shop -> Contact section', 'Contact box text '.$azera_shop_contact_item->id );
								}
							}

							if( !empty( $azera_shop_contact_item->icon_value ) ){
								if( function_exists('pll__') ){
									$icon = pll__( $azera_shop_contact_item->icon_value );
								} else {
									$icon = apply_filters( 'wpml_translate_single_string', $azera_shop_contact_item->icon_value, 'Azera Shop -> Contact section', 'Contact box icon '.$azera_shop_contact_item->id );
								}
							}
							

							if( !empty($link) ){ ?>
								<div class="col-sm-4 contact-link-box col-xs-12">
									<?php
									if( !empty($icon) ){
										echo '<div class="icon-container"><i class="fa '.esc_attr($icon).' colored-text"></i></div>';
									}

									if(!empty($text)){
										echo '<a href="'.$link.'" class="strong">'.html_entity_decode($text).'</a>';
									} ?>
								</div>
							<?php
							} else { ?>
								<div class="col-sm-4 contact-link-box  col-xs-12">
									<?php
									if(!empty($icon)){
										echo '<div class="icon-container"><i class="fa '.esc_attr($icon).' colored-text"></i></div>';
									}

									if(!empty($text)){
										echo '<div class="strong no-link">'.html_entity_decode($text).'</div>';
									} ?>
								</div>
							<?php
							}
						}
					} ?>         
				</div><!-- .contact-links -->
			</div><!-- .container -->
		</div>
	</div><!-- .contact-info -->
<?php
} ?>