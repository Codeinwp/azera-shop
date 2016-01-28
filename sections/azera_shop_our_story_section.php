<!-- =========================
 SECTION: BRIEF LEFT
============================== -->
<?php
	global $wp_customize;
	$azera_shop_our_story_image = get_theme_mod('azera_shop_our_story_image', azera_shop_get_file('/images/about-us.png'));
	$azera_shop_our_story_title = get_theme_mod('azera_shop_our_story_title',esc_html__('Our Story','azera-shop'));
	$azera_shop_our_story_text = get_theme_mod('azera_shop_our_story_text',esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','azera-shop'));
	if(!empty($azera_shop_our_story_image) || !empty($azera_shop_our_story_title) || !empty($azera_shop_our_story_content)){
?>
		<section class="brief text-left brief-design-one brief-left" id="story" role="region" aria-label="<?php esc_html_e('About','azera-shop') ?>">
			<div class="section-overlay-layer">
				<div class="container">
					<div class="row">
						<!-- BRIEF IMAGE -->
						<?php
							if( !empty($azera_shop_our_story_image) ){
								if( !empty($azera_shop_our_story_title) ){
									echo '<div class="col-md-6 brief-content-two"><div class="brief-image-right"><img src="'.esc_url($azera_shop_our_story_image).'" alt="'.esc_attr($azera_shop_our_story_title).'"></div></div>';
								} else {
									echo '<div class="col-md-6 brief-content-two"><div class="brief-image-right"><img src="'.esc_url($azera_shop_our_story_image).'" alt="'.esc_html__('About','azera-shop').'"></div></div>';
								}
							} elseif ( isset( $wp_customize )   ) {
								echo '<div class="col-md-6 brief-content-two azera_shop_only_customizer"><img src="" alt=""><div class="brief-image-right"></div></div>';
							}
						?>

						<!-- BRIEF HEADING -->
						<div class="col-md-6 content-section brief-content-one">
							<?php
								if( !empty($azera_shop_our_story_title) ){
									echo '<h2 class="text-left dark-text">'.esc_attr($azera_shop_our_story_title).'</h2><div class="colored-line-left"></div>';
								} elseif ( isset( $wp_customize )   ) {
									echo '<h2 class="text-left dark-text azera_shop_only_customizer"></h2><div class="colored-line-left azera_shop_only_customizer"></div>';
								}
							?>

							<?php

								if( !empty($azera_shop_our_story_text) ){
									echo '<div class="brief-content-text">'.$azera_shop_our_story_text.'</div>';
								} elseif ( isset( $wp_customize )   ) {
									echo '<div class="brief-content-text azera_shop_only_customizer"></div>';
								}
							?>
						</div><!-- .brief-content-one-->
					</div>
				</div>
			</div>
		</section><!-- .brief-design-one -->
<?php
	} else {
		if( isset( $wp_customize ) ) {
?>
			<section class="brief text-left brief-design-one brief-left azera_shop_only_customizer" id="story" role="region" aria-label="<?php esc_html_e('About','azera-shop') ?>">
				<div class="col-md-6 brief-content-two azera_shop_only_customizer"><img src="" alt=""><div class="brief-image-right"></div></div>
				<div class="col-md-6 content-section brief-content-one">
					<h2 class="text-left dark-text azera_shop_only_customizer"></h2><div class="colored-line-left azera_shop_only_customizer"></div>
					<div class="brief-content-text azera_shop_only_customizer"></div>
				</div>
			</section>
<?php
		}
	}
?>