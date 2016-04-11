<!-- =========================
 SECTION: CLIENTS LOGOs
============================== -->
<?php 

if(current_user_can( 'edit_theme_options')){
	$azera_shop_logos = get_theme_mod('azera_shop_logos_content',
	json_encode(
		array( 
			array("image_url" => azera_shop_get_file('/images/companies/1.png') ,"link" => "#", "id" => "azera_shop_56d450842cb37" ),
			array("image_url" => azera_shop_get_file('/images/companies/2.png') ,"link" => "#", "id" => "azera_shop_56d6b175454b8" ),
			array("image_url" => azera_shop_get_file('/images/companies/3.png') ,"link" => "#", "id" => "azera_shop_56d6b17a454b9" ),
			array("image_url" => azera_shop_get_file('/images/companies/4.png') ,"link" => "#", "id" => "azera_shop_56d6b17b454ba" ),
			array("image_url" => azera_shop_get_file('/images/companies/5.png') ,"link" => "#", "id" => "azera_shop_56d6b17d454bb" )
		)
	) );
} else {
	$azera_shop_logos =  get_theme_mod('azera_shop_logos_content');
}


if( !empty( $azera_shop_logos ) ){
	$azera_shop_logos_decoded = json_decode( $azera_shop_logos );
	echo '<div class="clients white-bg" id="clients" role="region" aria-label="'.__('Affiliates Logos','azera-shop').'"><div class="container">';
		echo '<ul class="client-logos">';					
		foreach($azera_shop_logos_decoded as $azera_shop_logo){
			$id = '';
			$link = '';
			$image = '';
			if( !empty( $azera_shop_logo->id ) ){
				$id = esc_attr($azera_shop_logo->id);
			}

			if( !empty( $azera_shop_logo->link ) ){
				if( function_exists( 'pll__' ) ){
					$link = pll__( $azera_shop_logo->link );
				} else {
					$link = apply_filters( 'wpml_translate_single_string', $azera_shop_logo->link, 'Azera Shop -> Logos section', 'Logo link '.$azera_shop_logo->id );
				}
			}

			if( !empty( $azera_shop_logo->image_url ) ){
				if(function_exists( 'pll__' ) ){
					$image = pll__( $azera_shop_logo->image_url ); 
				} else {
					$image = apply_filters( 'wpml_translate_single_string', $azera_shop_logo->image_url, 'Azera Shop -> Logos section', 'Logo image '.$azera_shop_logo->id );
				}
			}	

			if(!empty($image)){
		
				echo '<li>';
				if(!empty($link)){
					
					echo '<a href="'.esc_url( $link ).'" title="">';
						echo '<img src="'.esc_url( $image ).'" alt="'. esc_html__('Logo','azera-shop') .'">';
					echo '</a>';

				} else {

					echo '<img src="'.esc_url( $image ).'" alt="'.esc_html__('Logo','azera-shop').'">';

				}
				echo '</li>';


			}
		}
		echo '</ul>';
	echo '</div></div>';
} ?>