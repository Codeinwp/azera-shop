<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package azera-shop
 */
?>

    <footer itemscope itemtype="http://schema.org/WPFooter" id="footer" role="contentinfo" class = "footer grey-bg">

        <div class="container">
            <div class="footer-widget-wrap">
			
				<?php
					if( is_active_sidebar( 'footer-area' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-1" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 1','azera-shop'); ?>">
							<?php
								dynamic_sidebar( 'footer-area' );
							?>
						</div>
				
				<?php
					}
					if( is_active_sidebar( 'footer-area-2' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-2" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 2','azera-shop'); ?>">
							<?php
								dynamic_sidebar( 'footer-area-2' );
							?>
						</div>
				<?php
					}
					if( is_active_sidebar( 'footer-area-3' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-3" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 3','azera-shop'); ?>">
						   <?php
								dynamic_sidebar( 'footer-area-3' );
							?>
						</div>
				<?php
					}
					if( is_active_sidebar( 'footer-area-4' ) ){
				?>
						<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-4" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e('Widgets Area 4','azera-shop'); ?>">
							<?php
								dynamic_sidebar( 'footer-area-4' );
							?>
						</div>
				<?php
					}
				?>

            </div><!-- .footer-widget-wrap -->

	        <div class="footer-bottom-wrap">
				<?php
					global $wp_customize;
				
					/* COPYRIGHT */
					$azera_shop_copyright = get_theme_mod('azera_shop_copyright','Themeisle');
					
					if( !empty($azera_shop_copyright) ){
						echo '<span class="azera_shop_copyright_content">'.esc_attr($azera_shop_copyright).'</span>';
					} elseif ( isset( $wp_customize )   ) {
						echo '<span class="azera_shop_copyright_content azera_shop_only_customizer"></span>';
					}
				
					/* OPTIONAL FOOTER LINKS */
					
					echo '<div itemscope role="navigation" itemtype="http://schema.org/SiteNavigationElement" id="menu-secondary" aria-label="'.esc_html__('Secondary Menu','azera-shop').'">';
						echo '<h1 class="screen-reader-text">'.esc_html__( 'Secondary Menu', 'azera-shop' ).'</h1>';
						wp_nav_menu( 
							array( 
								'theme_location'    => 'azera_shop_footer_menu',
								'container'         => false,
								'menu_class'        => 'footer-links small-text',
								'depth' 			=> 1,
								'fallback_cb'       => false ) );
					echo '</div>';
					/* SOCIAL ICONS */
				
					$azera_shop_social_icons = get_theme_mod('azera_shop_social_icons',
						json_encode(
							array(
								array('icon_value' =>'fa-facebook' , 'link' => '#' , 'id' => 'azera_shop_56d6b2cc454c8'),
								array('icon_value' =>'fa-twitter' , 'link' => '#' , 'id' => 'azera_shop_56d6b2cb454c7'),
								array('icon_value' =>'fa-google-plus-square' , 'link' => '#' , 'id' => 'azera_shop_56d6b2c9454c6')
								)
							)
						);

					if( !empty( $azera_shop_social_icons ) ){
						
						$azera_shop_social_icons_decoded = json_decode($azera_shop_social_icons);
						
						if( !empty($azera_shop_social_icons_decoded) ){
						
							echo '<ul class="social-icons">';
							
								foreach($azera_shop_social_icons_decoded as $azera_shop_social_icon){
									
									if( !empty($azera_shop_social_icon->icon_value) ){
										
										explode("-",$azera_shop_social_icon->icon_value);
										
										if( !empty($azera_shop_social_icon->icon_value[2]) ) {
									
											if(function_exists('icl_t')){
												echo '<li><a href="'.esc_url(icl_t('Footer Social Link',$azera_shop_social_icon->id.'_footer_social_link',$azera_shop_social_icon->link)).'"><i class="fa azera-shop-footer-icons '.icl_t('Footer Social Icon',$azera_shop_social_icon->id.'_footer_social_icon',esc_attr($azera_shop_social_icon->icon_value)).' transparent-text-dark" aria-hidden="true"></i><span class="screen-reader-text">'.esc_attr($azera_shop_social_icon->icon_value[2]).'</span></a></li>';
											} else {
												echo '<li><a href="'.esc_url($azera_shop_social_icon->link).'"><i class="azera-shop-footer-icons fa '.esc_attr($azera_shop_social_icon->icon_value).' transparent-text-dark" aria-hidden="true"></i><span class="screen-reader-text">'.esc_attr($azera_shop_social_icon->icon_value[2]).'</span></a></li>';
											}

										}
									}

								}
						
							echo '</ul>';
						
						}
					}
				?>
	            
	        </div><!-- .footer-bottom-wrap -->

	        <div class="powered-by">
	        	<?php printf(
					__( '%1$s powered by %2$s', 'azera-shop' ),
					sprintf( '<a href="https://themeisle.com/themes/azera-shop/" rel="nofollow">%s</a>', esc_html__( 'Azera Shop', 'azera-shop' ) ),
					sprintf( '<a href="http://wordpress.org/" rel="nofollow">%s</a>', esc_html__( 'WordPress', 'azera-shop' ) )
				); ?>
	        </div>

	    </div><!-- container -->

    </footer>

	<?php wp_footer(); ?>

</body>
</html>
