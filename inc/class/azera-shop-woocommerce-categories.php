<?php
/**
 * Woocommerce category.
 *
 * @package azera-shop
 */


if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class Azera_Shop_Woocommerce_Categories
 */
class Azera_Shop_Woocommerce_Categories extends WP_Customize_Control {

	/**
	 * Azera_Shop_Woocommerce_Categories constructor.
	 *
	 * @param WP_Customize_Manager $manager WP_Customize_Manager class.
	 * @param string               $id Control id.
	 * @param array                $args Control args.
	 * $options array              $options Control options.
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		</label>
		<?php
		$taxonomy     = 'product_cat';
		$orderby      = 'name';
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no
		$title        = '';
		$empty        = 0;
		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty,
		);
		$all_categories = get_categories( $args );
		echo '<select class="azera_shop_cat_select">';
		echo '<option class="main-cat" ' . selected( $this->value(),'all' ) . ' value="all">' . esc_html__( 'All Categories','azera-shop' ) . '</option>';
		foreach ( $all_categories as $cat ) {
			if ( $cat->category_parent == 0 ) {
				$category_id = $cat->term_id;
				echo '<option ' . selected( $this->value(),$cat->slug ) . ' class="main-cat" value="' . $cat->slug . '">' . $cat->name . '</option>';
				$args2 = array(
					'taxonomy'     => $taxonomy,
					'child_of'     => 0,
					'parent'       => $category_id,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'hide_empty'   => $empty,
				);
				$sub_cats = get_categories( $args2 );
				if ( $sub_cats ) {
					foreach ( $sub_cats as $sub_category ) {
						echo '<option ' . selected( $this->value(),$cat->slug ) . ' value="' . $cat->slug . '">' . $sub_category->name . '</option>';
					}
				}
			}
		}
		echo '</select>';
		?>
		<input type="hidden" <?php $this->link(); ?> class="azera-shop-woocommerce-cat" value="
		<?php echo esc_textarea( $this->value() ); ?>" />
		<?php
	}


}
