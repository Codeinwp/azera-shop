<?php
/**
 * Shop section of the homepage.
 *
 * @package azera_shop
 */

if ( class_exists( 'WooCommerce' ) ) {

	$azera_shop_shop_section_title = get_theme_mod( 'azera_shop_shop_section_title', esc_html__( 'Shop','azera-shop' ) );
	$azera_shop_shop_section_subtitle = get_theme_mod( 'azera_shop_shop_section_subtitle', esc_html__( 'Showcase your work effectively and in an attractive form that your prospective clients will love.','azera-shop' ) );
	$nb_of_products = get_theme_mod( 'azera_shop_number_of_products',3 );
	$cat = get_theme_mod( 'azera_shop_woocomerce_categories','all' );
?>
<section class="shop" id="shop" role="region" aria-label="<?php esc_html_e( 'Shop','azera-shop' ); ?>">
	<div class="section-overlay-layer">
		<div class="container">

			<?php
			if ( ! empty( $azera_shop_shop_section_title ) || ! empty( $azera_shop_shop_section_subtitle ) ) {
				?>

				<div class="section-header">
					<?php
					if ( ! empty( $azera_shop_shop_section_title ) ) {
						echo '<h2 class="dark-text">' . esc_attr( $azera_shop_shop_section_title ) . '</h2><div class="colored-line"></div>';
					} elseif ( isset( $wp_customize ) ) {
						echo '<h2 class="dark-text azera_shop_only_customizer"></h2><div class="colored-line azera_shop_only_customizer"></div>';
					}

					if ( ! empty( $azera_shop_shop_section_subtitle ) ) {
						echo '<div class="sub-heading">' . esc_attr( $azera_shop_shop_section_subtitle ) . '</div>';
					} elseif ( isset( $wp_customize ) ) {
						echo '<div class="sub-heading azera_shop_only_customizer"></div>';
					}
					?>
				</div>
				<?php
			}

			if ( class_exists( 'WooCommerce' ) ) :
				?>

				<div class="home-shop-product">
					<div class="azera_shop_products_container">
						<?php
						if ( $cat == 'all' ) {
							$args = array(
								'post_type' => 'product',
								'stock' => 1,
								'posts_per_page' => $nb_of_products,
								'orderby' => 'date',
								'order' => 'DESC',
							);
						} else {
							$args = array(
								'post_type' => 'product',
								'stock' => 1,
								'posts_per_page' => $nb_of_products,
								'orderby' => 'date',
								'order' => 'DESC',
								'product_cat' => $cat,
							);
						}
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
							global $product; ?>

							<div class="col-md-4 col-sm-6 home-shop-product-wrap-all">

								<div class="home-shop-product-wrap">
									<div class="home-shop-product-img">
										<?php
										if ( has_post_thumbnail( $loop->post->ID ) ) {
											echo get_the_post_thumbnail( $loop->post->ID,'azera_shop_home_prod' );
										} else { 											echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
										}
										?>
									</div>
									<p class="home-shop-product-price">
										<?php echo $product->get_price_html(); ?>
									</p>
									<div class="home-shop-product-info">
										<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<div class="home-shop-product-title">
												<h3><?php the_title(); ?></h3>
											</div>
										</a>
										<div class="home-shop-product-content">
											<?php the_excerpt(); ?>
										</div>
										<div class="home-add-to-cart-wrap">
											<?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
										</div>
									</div>
								</div>
							</div>

						<?php endwhile; ?>
						<?php wp_reset_query(); ?>
					</div>
				</div>
				<?php
			endif;
			?>

		</div>
	</div>
</section>
<?php
}// End if().
	?>
