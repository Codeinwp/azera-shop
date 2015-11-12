<!-- =========================
 SECTION: CLIENTS LOGOs
============================== -->
<?php 
	$azera_shop_logos = get_theme_mod('azera_shop_logos_content',
		json_encode(
			array( 
				array("image_url" => azera_shop_get_file('/images/companies/1.png') ,"link" => "#" ),
				array("image_url" => azera_shop_get_file('/images/companies/2.png') ,"link" => "#" ),
				array("image_url" => azera_shop_get_file('/images/companies/3.png') ,"link" => "#" ),
				array("image_url" => azera_shop_get_file('/images/companies/4.png') ,"link" => "#" ),
				array("image_url" => azera_shop_get_file('/images/companies/5.png') ,"link" => "#" )
			)
		)
	);
	if(!empty($azera_shop_logos)){
		$azera_shop_logos_decoded = json_decode($azera_shop_logos);
		echo '<div class="clients white-bg" id="clients" role="region" aria-label="'.__('Affiliates Logos','azera-shop').'"><div class="container">';
			echo '<ul class="client-logos">';					
			foreach($azera_shop_logos_decoded as $azera_shop_logo){
				if(!empty($azera_shop_logo->image_url)){
			
					echo '<li>';
					if(!empty($azera_shop_logo->link)){
						echo '<a href="'.$azera_shop_logo->link.'" title="">';
							echo '<img src="'.$azera_shop_logo->image_url.'" alt="'. esc_html__('Logo','azera-shop') .'">';
						echo '</a>';
					} else {
						echo '<img src="'.esc_url($azera_shop_logo->image_url).'" alt="'.esc_html__('Logo','azera-shop').'">';
					}
					echo '</li>';

	
				}
			}
			echo '</ul>';
		echo '</div></div>';
	}
?>
	