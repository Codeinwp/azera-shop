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
				
					$azera_shop_social_icons = get_theme_mod('azera_shop_social_icons');

					if( !empty( $azera_shop_social_icons ) ){
						
						$azera_shop_social_icons_decoded = json_decode($azera_shop_social_icons);
						
						if( !empty($azera_shop_social_icons_decoded) ){
						
							echo '<ul class="social-icons">';
							
								foreach($azera_shop_social_icons_decoded as $azera_shop_social_icon){
									$id = '';
									$link = '';
									$icon = '';
									if( !empty( $azera_shop_social_icon->id ) ){
										$id = esc_attr($azera_shop_social_icon->id);
									}
									if( !empty( $azera_shop_social_icon->link ) ){
										if( function_exists('pll__') ){
											$link = pll__($azera_shop_social_icon->link);
										} else {
											$link = apply_filters( 'wpml_translate_single_string', $azera_shop_social_icon->link, 'Azera Shop -> Footer', 'Footer social link '.$id );
										}
									}
									if( !empty( $azera_shop_social_icon->icon_value ) ){
										if( function_exists('pll__') ){
											$icon = pll__($azera_shop_social_icon->icon_value);
										} else {
											$icon = apply_filters( 'wpml_translate_single_string', $azera_shop_social_icon->icon_value, 'Azera Shop -> Footer', 'Footer social icon '.$id );
										}
									}
									if( !empty($icon) ){
										
										$ic = explode("-",$icon);
										if( !empty($ic[1]) ) {
											echo '<li><a href="'.esc_url($link).'"><i class="azera-shop-footer-icons fa '.esc_attr($icon).' transparent-text-dark" aria-hidden="true"></i><span class="screen-reader-text">'.esc_attr($ic[1]).'</span></a></li>';
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
