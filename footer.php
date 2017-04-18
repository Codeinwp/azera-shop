<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package azera-shop
 */
?>

	<footer itemscope itemtype="http://schema.org/WPFooter" id="footer" role="contentinfo" class="<?php echo apply_filters( 'azera_shop_footer_class_filter','footer grey-bg' ); ?>">

		<div class="container">
			<div class="footer-widget-wrap">
			
				<?php
				if ( is_active_sidebar( 'footer-area' ) ) {
				?>
				<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-1" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e( 'Widgets Area 1','azera-shop' ); ?>">
					<?php
						dynamic_sidebar( 'footer-area' );
					?>
					</div>
				
				<?php
				}
				if ( is_active_sidebar( 'footer-area-2' ) ) {
				?>
				<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-2" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e( 'Widgets Area 2','azera-shop' ); ?>">
					<?php
						dynamic_sidebar( 'footer-area-2' );
					?>
					</div>
				<?php
				}
				if ( is_active_sidebar( 'footer-area-3' ) ) {
				?>
				<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-3" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e( 'Widgets Area 3','azera-shop' ); ?>">
					<?php
						dynamic_sidebar( 'footer-area-3' );
						?>
						</div>
				<?php
				}
				if ( is_active_sidebar( 'footer-area-4' ) ) {
				?>
				<div itemscope itemtype="http://schema.org/WPSideBar" role="complementary" id="sidebar-widgets-area-4" class="col-md-3 col-sm-6 col-xs-12 widget-box" aria-label="<?php esc_html_e( 'Widgets Area 4','azera-shop' ); ?>">
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
					$azera_shop_copyright = get_theme_mod( 'azera_shop_copyright','Themeisle' );

				if ( ! empty( $azera_shop_copyright ) ) {
					echo '<span class="azera_shop_copyright_content">' . esc_attr( $azera_shop_copyright ) . '</span>';
				} elseif ( isset( $wp_customize ) ) {
					echo '<span class="azera_shop_copyright_content azera_shop_only_customizer"></span>';
				}

					/* OPTIONAL FOOTER LINKS */

					echo '<div itemscope role="navigation" itemtype="http://schema.org/SiteNavigationElement" id="menu-secondary" aria-label="' . esc_html__( 'Secondary Menu','azera-shop' ) . '">';
						echo '<h1 class="screen-reader-text">' . esc_html__( 'Secondary Menu', 'azera-shop' ) . '</h1>';
						wp_nav_menu(
							array(
								'theme_location'    => 'azera_shop_footer_menu',
								'container'         => false,
								'menu_class'        => 'footer-links small-text',
								'depth' 			=> 1,
							'fallback_cb'       => false,
						) );
						echo '</div>';
						/* SOCIAL ICONS */

						$azera_shop_social_icons = get_theme_mod( 'azera_shop_social_icons' );

						if ( ! azera_shop_general_repeater_is_empty( $azera_shop_social_icons ) ) {
							$azera_shop_social_icons_decoded = json_decode( $azera_shop_social_icons ); ?>

							<ul class="social-icons">
								<?php
								foreach ( $azera_shop_social_icons_decoded as $azera_shop_social_icon ) {
									$icon = ! empty( $azera_shop_social_icon->icon_value ) ? apply_filters( 'azera_shop_translate_single_string', $azera_shop_social_icon->icon_value, 'Social icons in footer' ) : '';
									$link = ! empty( $azera_shop_social_icon->link ) ? apply_filters( 'azera_shop_translate_single_string', $azera_shop_social_icon->link, 'Social icons in footer' ) : '';

									if ( ! empty( $icon ) && $icon !== 'No Icon' && ! empty( $link ) ) { ?>
										<li>
											<a href="<?php echo esc_url( $link ); ?>">
												<span class="screen-reader-text"><?php echo wp_kses_post( $icon ); ?></span>
												<i class="fa azera-shop-footer-icons <?php echo esc_attr( $icon ); ?> transparent-text-dark" aria-hidden="true"></i>
											</a>
										</li>
										<?php
									}
								} ?>
							</ul>
							<?php
						}// End if().
				?>

	        </div><!-- .footer-bottom-wrap -->

			<?php azera_shop_bottom_footer_trigger(); ?>

	    </div><!-- container -->

	    <?php azera_shop_after_footer_trigger(); ?>

	</footer>

	<?php wp_footer(); ?>

</body>
</html>
