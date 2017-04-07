<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package azera-shop
 */

if ( ! function_exists( 'azera_shop_posts_navigation' ) ) :
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function azera_shop_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation posts-navigation" role="navigation">
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><span class="meta-nav"><i class="fa fa-arrow-left"></i></span><?php next_posts_link( esc_html__( 'Older posts', 'azera-shop' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'azera-shop' ) ); ?><span class="meta-nav"><i class="fa fa-arrow-right"></span></span></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


if ( ! function_exists( 'azera_shop_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function azera_shop_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$posted_on = sprintf(
				/* translators: post date */
				_x( 'Posted on %s', 'post date', 'azera-shop' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				/* translators: post author */
				_x( 'by %s', 'post author', 'azera-shop' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	}
endif;

if ( ! function_exists( 'azera_shop_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function azera_shop_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'azera-shop' ) );
			if ( $categories_list && azera_shop_categorized_blog() ) {
				/* translators: categories list */
				printf( '<span class="cat-links"><i class="fa fa-folder-open-o" aria-hidden="true"></i>' . esc_html__( 'Posted in %1$s', 'azera-shop' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'azera-shop' ) );
			if ( $tags_list ) {
				/* translators: tags list */
				printf( '<span class="tags-links"><i class="fa fa-folder-open-o" aria-hidden="true"></i>' . esc_html__( 'Tagged %1$s', 'azera-shop' ) . '</span>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'azera-shop' ), esc_html__( '1 Comment', 'azera-shop' ), esc_html__( '% Comments', 'azera-shop' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'azera-shop' ), '<span class="edit-link">', '</span>' );
	}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function the_archive_title( $before = '', $after = '' ) {
		if ( is_category() ) {
			/* translators: archive category */
			$title = sprintf( esc_html__( 'Category: %s', 'azera-shop' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			/* translators: archive tag */
			$title = sprintf( esc_html__( 'Tag: %s', 'azera-shop' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			/* translators: archive author */
			$title = sprintf( esc_html__( 'Author: %s', 'azera-shop' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			/* translators: archive year */
			$title = sprintf( esc_html__( 'Year: %s', 'azera-shop' ), get_the_date( _x( 'Y', 'yearly archives date format', 'azera-shop' ) ) );
		} elseif ( is_month() ) {
			/* translators: archive month */
			$title = sprintf( esc_html__( 'Month: %s', 'azera-shop' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'azera-shop' ) ) );
		} elseif ( is_day() ) {
			/* translators: archive day */
			$title = sprintf( esc_html__( 'Day: %s', 'azera-shop' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'azera-shop' ) ) );
		} elseif ( is_post_type_archive() ) {
			/* translators: archive title */
			$title = sprintf( esc_html__( 'Archives: %s', 'azera-shop' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( esc_html__( '%1$s: %2$s', 'azera-shop' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = esc_html__( 'Archives', 'azera-shop' );
		}

			/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
			$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function the_archive_description( $before = '', $after = '' ) {
		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
			echo $before . $description . $after;
		}
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function azera_shop_categorized_blog() {

	$all_the_cool_cats = get_transient( 'azera_shop_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'azera_shop_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so azera_shop_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so azera_shop_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in azera_shop_categorized_blog.
 */
function azera_shop_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'azera_shop_categories' );
}
add_action( 'edit_category', 'azera_shop_category_transient_flusher' );
add_action( 'save_post',     'azera_shop_category_transient_flusher' );
