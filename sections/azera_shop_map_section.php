<?php
/**
 * Map section of the homepage.
 *
 * @package azera-shop
 */

	$azera_shop_frontpage_map_shortcode = get_theme_mod( 'azera_shop_frontpage_map_shortcode' );
	$azera_shop_frontpage_map_shortcode = apply_filters( 'azera_shop_translate_single_string', $azera_shop_frontpage_map_shortcode, 'Map shortcode' );
if ( ! empty( $azera_shop_frontpage_map_shortcode ) ) {
?>
<div id="container-fluid">
	<div class="azera_shop_map_overlay"></div>
	<div id="cd-google-map">
		<?php echo do_shortcode( $azera_shop_frontpage_map_shortcode ); ?>
	</div>
</div><!-- .container-fluid -->
<?php
}
?>
