<?php
/**
 * Logos section of the homepage.
 *
 * @package azera-shop
 */

$default          = current_user_can( 'edit_theme_options' ) ? azera_shop_logos_get_default_content() : false;
$azera_shop_logos = get_theme_mod( 'azera_shop_logos_content', $default );
if ( ! azera_shop_general_repeater_is_empty( $azera_shop_logos ) ) {
	$azera_shop_logos_decoded = json_decode( $azera_shop_logos ); ?>
	<div class="clients white-bg" id="clients" role="region" aria-label="<?php echo esc_attr__( 'Affiliates Logos', 'azera-shop' ); ?>">
		<div class="container">
			<ul class="client-logos">
				<?php
				foreach ( $azera_shop_logos_decoded as $azera_shop_logo ) {
					$image = ! empty( $azera_shop_logo->image_url ) ? apply_filters( 'azera_shop_translate_single_string', $azera_shop_logo->image_url, 'Logos Section' ) : '';
					$link  = ! empty( $azera_shop_logo->link ) ? apply_filters( 'azera_shop_translate_single_string', $azera_shop_logo->link, 'Logos Section' ) : '';
					if ( ! empty( $image ) ) { ?>
						<li>
							<?php
							if ( ! empty( $link ) ) { ?>
								<a href="<?php echo esc_url( $link ); ?>" title="">
									<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr__( 'Logo', 'azera-shop' ); ?>">
								</a>
								<?php
							} else { ?>
								<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr__( 'Logo', 'azera-shop' ); ?>">
								<?php
							} ?>
						</li>
						<?php
					}
				} ?>
			</ul>
		</div>
	</div>
	<?php
}
