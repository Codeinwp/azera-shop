<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package azera-shop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'azera_shop_content_post_class_filter','border-bottom-hover' ) ); ?>>
	<header class="entry-header">

			<div class="post-img-wrap">
			 	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >

					<?php
					if ( has_post_thumbnail() ) {
					?>
					<?php
					$image_id = get_post_thumbnail_id();
					$image_url_big = wp_get_attachment_image_src( $image_id,'azera-shop-post-thumbnail-big', true );
					$image_url_mobile = wp_get_attachment_image_src( $image_id,'azera-shop-post-thumbnail-mobile', true );
					?>
					<picture>
					<source media="(max-width: 600px)" srcset="<?php echo esc_url( $image_url_mobile[0] ); ?>">
					<img src="<?php echo esc_url( $image_url_big[0] ); ?>" alt="<?php the_title_attribute(); ?>">
					</picture>
					<?php
					} else {
					?>
					<picture>
					<source media="(max-width: 600px)" srcset=" <?php echo azera_shop_get_file( '/images/no-thumbnail-mobile.jpg' ); ?> ">
					<img src="<?php echo azera_shop_get_file( '/images/no-thumbnail.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
					</picture>
					<?php } ?>

				</a>
				<?php azera_shop_post_date_search_box_trigger(); ?>

			</div>

			<div class="entry-meta list-post-entry-meta">
				<span class="post-date" itemprop="datePublished" datetime="<?php the_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'azera-shop' ) ); ?>">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<?php the_time( get_option( 'date_format' ) ); ?>
				</span>
				<span class="post-author">
					<i class="fa fa-user" aria-hidden="true"></i><?php the_author_posts_link(); ?>
				</span>
				
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( esc_html__( ', ', 'azera-shop' ) );
					if ( ! empty( $categories_list ) ) {
						?>
						<span class="posted-in">
						<i class="fa fa-folder-open-o" aria-hidden="true"></i>
						<?php
						esc_html_e( 'Posted in ','azera-shop' );

						$pos = strpos( $categories_list, ',' );
						if ( $pos ) {
							echo substr( $categories_list, 0, $pos );
						} else {
							echo $categories_list;
						}
						echo '</span>';
					}
					?>
				
				<a href="<?php comments_link(); ?>" class="post-comments">
					<i class="fa fa-comment-o" aria-hidden="true"></i><?php comments_number( esc_html__( 'No comments','azera-shop' ), esc_html__( 'One comment','azera-shop' ), esc_html__( '% comments','azera-shop' ) ); ?>
				</a>
			</div><!-- .entry-meta -->

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php echo apply_filters( 'azera_shop_header_underline','<div class="colored-line-left"></div><div class="clearfix"></div>' ); ?>

	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			$ismore = strpos( $post->post_content, '<!--more-->' );
		if ( $ismore ) : the_content();
			else : the_excerpt();
			endif;
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'azera-shop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

