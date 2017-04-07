<?php
/**
 * Content archive download.
 *
 * @package azera-shop
 */
?>

<div class="edd_download" itemscope itemtype="http://schema.org/Product" >
	<div class="edd_download_inner">
		<div class="edd_download_image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}

					the_title( '<h3 itemprop="name" class="edd_download_title">', '</h3>' );
				?>
			</a>
		</div>
		

		<div itemprop="description" class="edd_download_excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
		<?php echo edd_get_purchase_link( array(
			'download_id' => get_the_ID(),
		) ); ?>
	</div>	
</div><!-- #post-## -->
