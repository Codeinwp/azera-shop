<?php
/**
 * Ribbon section of the homepage.
 *
 * @package azera-shop
 */

$azera_shop_button_link = get_theme_mod( 'azera_shop_button_link' );

if ( current_user_can( 'edit_theme_options' ) ) {
	$ribbon_background = get_theme_mod( 'azera_shop_ribbon_background', azera_shop_get_file( '/images/background-images/parallax-img/parallax-img1.jpg' ) );
	$azera_shop_ribbon_title = get_theme_mod( 'azera_shop_ribbon_title',esc_html__( 'In order to edit the text here you should go to customizer.','azera-shop' ) );
	$azera_shop_button_text = get_theme_mod( 'azera_shop_button_text',esc_html__( 'Text from customizer.','azera-shop' ) );
} else {
	$ribbon_background = get_theme_mod( 'azera_shop_ribbon_background' );
	$azera_shop_ribbon_title = get_theme_mod( 'azera_shop_ribbon_title' );
	$azera_shop_button_text = get_theme_mod( 'azera_shop_button_text' );
}

if ( ! empty( $azera_shop_ribbon_title ) || ! empty( $azera_shop_button_text ) ) {

	if ( ! empty( $ribbon_background ) ) {
		echo '<section class="call-to-action ribbon-wrap" id="ribbon" style="background-image:url(' . $ribbon_background . ');" role="region" aria-label="' . esc_html__( 'Ribbon','azera-shop' ) . '">';
	} else {
		echo '<section class="call-to-action ribbon-wrap" id="ribbon" role="region" aria-label="' . esc_html__( 'Ribbon','azera-shop' ) . '">';
	} ?>

	<div class="section-overlay-layer">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<?php
					if ( ! empty( $azera_shop_ribbon_title ) ) {
						echo '<h2 class="white-text strong">' . esc_attr( $azera_shop_ribbon_title ) . '</h2>';
					} elseif ( isset( $wp_customize ) ) {
						echo '<h2 class="white-text strong azera_shop_only_customizer"></h2>';
					}

					if ( ! empty( $azera_shop_button_text ) ) {
						if ( empty( $azera_shop_button_link ) ) {
							echo '<button class="btn btn-primary standard-button" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:','azera-shop' ) . $azera_shop_button_text . '</span>' . esc_attr( $azera_shop_button_text ) . '</button>';
						} else {
							echo '<button onclick="window.location=\'' . esc_url( $azera_shop_button_link ) . '\'" class="btn btn-primary standard-button" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:','azera-shop' ) . $azera_shop_button_text . '</span>' . esc_attr( $azera_shop_button_text ) . '</button>';
						}
					} elseif ( isset( $wp_customize ) ) {
						echo '<button class="btn btn-primary standard-button azera_shop_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"></button>';
					}
					?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php
} else {
	if ( isset( $wp_customize ) ) {
		if ( ! empty( $ribbon_background ) ) {
			echo '<section class="call-to-action ribbon-wrap azera_shop_only_customizer" id="ribbon" style="background-image:url(' . $ribbon_background . ');" role="region" aria-label="' . esc_html__( 'Ribbon','azera-shop' ) . '">';
		} else {
			echo '<section class="call-to-action ribbon-wrap azera_shop_only_customizer" id="ribbon" role="region" aria-label="' . esc_html__( 'Ribbon','azera-shop' ) . '">';
		}
?>
			<div class="section-overlay-layer">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h2 class="white-text strong azera_shop_only_customizer"></h2>
							<button class="btn btn-primary standard-button azera_shop_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"></button>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}// End if().
?>
