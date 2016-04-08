<!-- =========================
 SECTION: CLIENTS LOGOs
============================== -->
<?php 
	$azera_shop_logos =  get_theme_mod('azera_shop_logos_content');
	$azera_shop_logos_default = get_theme_mod('azera_shop_logos_content',
		json_encode(
			array( 
				array("image_url" => azera_shop_get_file('/images/companies/1.png') ,"link" => "#", "id" => "azera_shop_56d450842cb37" ),
				array("image_url" => azera_shop_get_file('/images/companies/2.png') ,"link" => "#", "id" => "azera_shop_56d6b175454b8" ),
				array("image_url" => azera_shop_get_file('/images/companies/3.png') ,"link" => "#", "id" => "azera_shop_56d6b17a454b9" ),
				array("image_url" => azera_shop_get_file('/images/companies/4.png') ,"link" => "#", "id" => "azera_shop_56d6b17b454ba" ),
				array("image_url" => azera_shop_get_file('/images/companies/5.png') ,"link" => "#", "id" => "azera_shop_56d6b17d454bb" )
			)
		)
	);
	$azera_shop_logos_have_default = ( empty( $azera_shop_logos ) ? true : false );
	
	if( $azera_shop_logos_have_default == true ){
		if( current_user_can( 'edit_theme_options') ){
			if(!empty($azera_shop_logos_default)){
				$azera_shop_logos_decoded = json_decode($azera_shop_logos_default);
				echo '<div class="clients white-bg" id="clients" role="region" aria-label="'.__('Affiliates Logos','azera-shop').'"><div class="container">';
					echo '<ul class="client-logos">';					
					foreach($azera_shop_logos_decoded as $azera_shop_logo){
						if(!empty($azera_shop_logo->image_url)){
					
							echo '<li>';
							if(!empty($azera_shop_logo->link)){
								if(function_exists('icl_t')){
									echo '<a href="'.esc_url( icl_t('Logo link', $azera_shop_logo->id.'_logo_link', $azera_shop_logo->link) ).'" title="">';
										echo '<img src="'.esc_url( icl_t('Logo image', $azera_shop_logo->id.'_logo_image', $azera_shop_logo->image_url) ).'" alt="'. esc_html__('Logo','azera-shop') .'">';
									echo '</a>';
								} else {
									echo '<a href="'.esc_url( $azera_shop_logo->link ).'" title="">';
										echo '<img src="'.esc_url( $azera_shop_logo->image_url ).'" alt="'. esc_html__('Logo','azera-shop') .'">';
									echo '</a>';
								}
							} else {
								if(function_exists('icl_t')){
									echo '<img src="'.esc_url( icl_t('Logo image', $azera_shop_logo->id.'_logo_image', $azera_shop_logo->image_url) ).'" alt="'.esc_html__('Logo','azera-shop').'">';
								} else {
									echo '<img src="'.esc_url( $azera_shop_logo->image_url ).'" alt="'.esc_html__('Logo','azera-shop').'">';
								}
							}
							echo '</li>';

			
						}
					}
					echo '</ul>';
				echo '</div></div>';
			}
		}
	} else {
		$azera_shop_logos_decoded = json_decode($azera_shop_logos);
		echo '<div class="clients white-bg" id="clients" role="region" aria-label="'.__('Affiliates Logos','azera-shop').'"><div class="container">';
			echo '<ul class="client-logos">';					
			foreach($azera_shop_logos_decoded as $azera_shop_logo){
				if(!empty($azera_shop_logo->image_url)){
			
					echo '<li>';
					if(!empty($azera_shop_logo->link)){
						if(function_exists('icl_t')){
							echo '<a href="'.esc_url( icl_t('Logo link', $azera_shop_logo->id.'_logo_link', $azera_shop_logo->link) ).'" title="">';
								echo '<img src="'.esc_url( icl_t('Logo image', $azera_shop_logo->id.'_logo_image', $azera_shop_logo->image_url) ).'" alt="'. esc_html__('Logo','azera-shop') .'">';
							echo '</a>';
						} else {
							echo '<a href="'.esc_url( $azera_shop_logo->link ).'" title="">';
								echo '<img src="'.esc_url( $azera_shop_logo->image_url ).'" alt="'. esc_html__('Logo','azera-shop') .'">';
							echo '</a>';
						}
					} else {
						if(function_exists('icl_t')){
							echo '<img src="'.esc_url( icl_t('Logo image', $azera_shop_logo->id.'_logo_image', $azera_shop_logo->image_url) ).'" alt="'.esc_html__('Logo','azera-shop').'">';
						} else {
							echo '<img src="'.esc_url( $azera_shop_logo->image_url ).'" alt="'.esc_html__('Logo','azera-shop').'">';
						}
					}
					echo '</li>';
	
				}
			}
			echo '</ul>';
		echo '</div></div>';
	}
?>
	