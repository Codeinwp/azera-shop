<!-- =========================
 SECTION: CUSTOMERS   
============================== -->
<?php
	global $wp_customize;
	$azera_shop_happy_customers_title = get_theme_mod('azera_shop_happy_customers_title',esc_html__('Happy Customers','azera-shop'));
	$azera_shop_happy_customers_subtitle = get_theme_mod('azera_shop_happy_customers_subtitle',esc_html__('Cloud computing subscription model out of the box proactive solution.','azera-shop'));
	$azera_shop_testimonials_content = get_theme_mod('azera_shop_testimonials_content',
		json_encode(
			array(
					array('image_url' => azera_shop_get_file('/images/clients/1.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop')),
					array('image_url' => azera_shop_get_file('/images/clients/2.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop')),
					array('image_url' => azera_shop_get_file('/images/clients/3.jpg'),'title' => esc_html__('Happy Customer','azera-shop'),'subtitle' => esc_html__('Lorem ipsum','azera-shop'),'text' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, consequat nibh. Etiam non elit dui. Nullam vel eros sit amet arcu vestibulum accumsan in in leo. Fusce malesuada vulputate faucibus. Integer in hendrerit nisi. Praesent a hendrerit urna. In non imperdiet elit, sed molestie odio. Fusce ac metus non purus sollicitudin laoreet.','azera-shop'))
			)
		)
	);

	if( !empty($azera_shop_happy_customers_title) || !empty($azera_shop_happy_customers_subtitle) || !azera_shop_general_repeater_is_empty($azera_shop_testimonials_content) ){
?>
	<section class="testimonials" id="customers" role="region" aria-label="<?php esc_html_e('Testimonials','azera-shop') ?>">
		<div class="section-overlay-layer">
			<div class="container">

				<!-- SECTION HEADER -->
				<?php
				if(!empty($azera_shop_happy_customers_title) || !empty($azera_shop_happy_customers_subtitle)){
				?>
					<div class="section-header">
						<?php
							if( !empty($azera_shop_happy_customers_title) ){
								echo '<h2 class="dark-text">'.esc_attr($azera_shop_happy_customers_title).'</h2><div class="colored-line"></div>';
							} elseif ( isset( $wp_customize )   ) {
								echo '<h2 class="dark-text azera_shop_only_customizer"></h2><div class="colored-line azera_shop_only_customizer"></div>';
							}

							if( !empty($azera_shop_happy_customers_subtitle) ){
								echo '<div class="sub-heading">'.esc_attr($azera_shop_happy_customers_subtitle).'</div>';
							} elseif ( isset( $wp_customize )   ) {
								echo '<div class="sub-heading azera_shop_only_customizer"></div>';
							}
						?>
					</div>
				<?php
				}


				if(!empty($azera_shop_testimonials_content)) {
					echo '<div id="happy_customers_wrap" class="testimonials-wrap">';
					$azera_shop_testimonials_content_decoded = json_decode($azera_shop_testimonials_content);
					foreach($azera_shop_testimonials_content_decoded as $azera_shop_testimonial){
						if( !empty($azera_shop_testimonial->image_url) || !empty($azera_shop_testimonial->title) || !empty($azera_shop_testimonial->subtitle) || !empty($azera_shop_testimonial->text) ){
			?>
							<!-- SINGLE FEEDBACK -->
							<div class="testimonials-box">
								<div class="feedback border-bottom-hover">
									<div class="pic-container">
										<div class="pic-container-inner">
											<?php

												if( !empty($azera_shop_testimonial->image_url) ){
													if(!empty($azera_shop_testimonial->title)){
														echo '<img src="'.esc_url($azera_shop_testimonial->image_url).'" alt="'.$azera_shop_testimonial->title.'">';
													} else {
														echo '<img src="'.esc_url($azera_shop_testimonial->image_url).'" alt="'.esc_html('Avatar','azera-shop').'">';
													}
												} else {
													$default_image = azera_shop_get_file('/images/clients/client-no-image.jpg');
													echo '<img src="'.esc_url($default_image).'" alt="'.esc_html('Avatar','azera-shop').'">';
												}	
											?>
										</div>
									</div>
									<?php
									if(!empty($azera_shop_testimonial->title) || !empty($azera_shop_testimonial->subtitle) || !empty($azera_shop_testimonial->text)) {
									?>
										<div class="feedback-text-wrap">
										<?php
											if(!empty($azera_shop_testimonial->title)){
										?>
												<h5 class="colored-text">
													<?php
														if(function_exists('icl_t')){
															echo icl_t('Testimonials',$azera_shop_testimonial->id.'_testimonials_title',esc_attr($azera_shop_testimonial->title));
														} else {
															echo esc_attr($azera_shop_testimonial->title);
														}
													?>
												</h5>
										<?php
											}

											if(!empty($azera_shop_testimonial->subtitle)){
										?>
												<div class="small-text">
													<?php 
														if(function_exists('icl_t')){
															echo icl_t('Testimonials',$azera_shop_testimonial->id.'_testimonials_subtitle',esc_attr($azera_shop_testimonial->subtitle));
														} else {
															echo esc_attr($azera_shop_testimonial->subtitle);
														}
													?>	
												</div>
										<?php
											}

											if(!empty($azera_shop_testimonial->text)){
										?>
												<p>
													<?php 
														if(function_exists('icl_t')){
															echo icl_t('Testimonials',$azera_shop_testimonial->id.'_testimonials_text',html_entity_decode($azera_shop_testimonial->text));
														} else {
															echo html_entity_decode($azera_shop_testimonial->text);
														}
													?>
												</p>
										<?php
											}
										?>
										</div>
									<?php
									}
									?>
								</div>
							</div><!-- .testimonials-box -->
				<?php
					}
				}
				echo '</div>';
			}
				?>
			</div>
		</div>
	</section><!-- customers -->
<?php
	} else {
		if( isset( $wp_customize ) ) {
?>
			<section class="testimonials azera_shop_only_customizer" id="customers" role="region" aria-label="<?php esc_html_e('Testimonials','azera-shop') ?>">
				<div class="section-overlay-layer">
					<div class="container">
						<div class="section-header">
							<h2 class="dark-text azera_shop_only_customizer"></h2><div class="colored-line azera_shop_only_customizer"></div>
							<div class="sub-heading azera_shop_only_customizer"></div>
						</div>				
					</div>
				</div>
			</section><!-- customers -->
<?php
		}
	}