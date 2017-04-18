<?php
/**
 * Contact info section of the homepage.
 *
 * @package azera-shop
 */

$default = current_user_can( 'edit_theme_options' ) ? azera_shop_contact_get_default_content() : false;
$azera_shop_contact_info_item = get_theme_mod( 'azera_shop_contact_info_content', $default );

if ( ! azera_shop_general_repeater_is_empty( $azera_shop_contact_info_item ) ) {
	$azera_shop_contact_info_item_decoded = json_decode( $azera_shop_contact_info_item ); ?>
	<div class="contact-info" id="contactinfo" role="region" aria-label="<?php esc_html_e( 'Contact Info','azera-shop' ); ?>">
		<div class="section-overlay-layer">
			<div class="container">

				<!-- CONTACT INFO -->
				<div class="row contact-links">
					<?php
					if ( ! empty( $azera_shop_contact_info_item_decoded ) ) {
						foreach ( $azera_shop_contact_info_item_decoded as $azera_shop_contact_item ) {
							$link = ( ! empty( $azera_shop_contact_item->link ) ? apply_filters( 'azera_shop_translate_single_string',$azera_shop_contact_item->link, 'Contact section' ) : '' );
							$icon = ( ! empty( $azera_shop_contact_item->icon_value ) ? apply_filters( 'azera_shop_translate_single_string',$azera_shop_contact_item->icon_value, 'Contact section' ) : '');
							$text = ( ! empty( $azera_shop_contact_item->text ) ? apply_filters( 'azera_shop_translate_single_string',$azera_shop_contact_item->text, 'Contact section' ) : '' );

							if ( ! empty( $icon ) || ! empty( $text ) ) { ?>
								<div class="col-sm-4 contact-link-box col-xs-12">
									<?php
									if ( ! empty( $icon ) ) { ?>
										<div class="icon-container">
											<i class="fa <?php echo esc_attr( $icon ); ?> colored-text"></i>
										</div>
										<?php
									}
									if ( ! empty( $text ) ) { ?>
										<a <?php echo ( ! empty( $link ) ? 'href="' . esc_url( $link ) . '"' : ''); ?> class="strong">
											<?php echo wp_kses_post( $text ); ?>
										</a>
										<?php
									} ?>
								</div>
								<?php
							}
						}// End foreach().
					} ?>
				</div><!-- .contact-links -->
			</div><!-- .container -->
		</div>
	</div><!-- .contact-info -->
<?php
}// End if().
	?>
