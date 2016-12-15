<?php
/**
 * Content contact.
 *
 * @package azera-shop
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'contact-page' ); ?>>

	<div class="container">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title single-title">', '</h1>' ); ?>
			<?php echo apply_filters( 'azera_shop_header_underline','<div class="colored-line-left"></div><div class="clearfix"></div>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content content-page azera_shop_contact_form">

			<?php
				$azera_shop_contact_form_shortcode = get_theme_mod( 'azera_shop_contact_form_shortcode' );
			?>
			<div class="col-md-6">
				<?php the_content(); ?>
			</div>
				<?php
				if ( ! empty( $azera_shop_contact_form_shortcode ) ) {
					echo '<div class="col-md-6">';
					echo do_shortcode( $azera_shop_contact_form_shortcode );
					echo '</div>';
				}
				?>

			<footer class="entry-footer">
				<?php edit_post_link( esc_html__( 'Edit', 'azera-shop' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .fentry-footer -->

		</div><!-- .entry-content -->

	</div>

	<?php
		$azera_shop_contact_map_shortcode = get_theme_mod( 'azera_shop_contact_map_shortcode' );
	if ( ! empty( $azera_shop_contact_map_shortcode ) ) {
		echo '<div class="contact-page-map-wrap">';
		echo do_shortcode( $azera_shop_contact_map_shortcode );
		echo '</div>';
	}
	?>
	

</article><!-- #post-## -->
