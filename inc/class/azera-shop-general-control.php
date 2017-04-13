<?php
/**
 * Azera_Shop_General_Repeater class file
 *
 * PHP version 5.6
 *
 * @category    Custom Controls
 * @package     Azera_Shop
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Azera_Shop_General_Repeater class
 *
 * @category    Admin
 * @package     Azera_Shop
 * @author      Themeisle <cristian@themeisle.com>
 * @license     GNU General Public License v2 or later
 * @link        http://themeisle.com
 */
class Azera_Shop_General_Repeater extends WP_Customize_Control {

	/**
	 * Box id.
	 *
	 * @var string $id Box id.
	 */
	public $id;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $azera_shop_image_control Display option.
	 */
	private $azera_shop_image_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $azera_shop_icon_control Display option.
	 */
	private $azera_shop_icon_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $azera_shop_title_control Display option.
	 */
	private $azera_shop_title_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $azera_shop_subtitle_control Display option.
	 */
	private $azera_shop_subtitle_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $azera_shop_text_control Display option.
	 */
	private $azera_shop_text_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $azera_shop_link_control Display option.
	 */
	private $azera_shop_link_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed o Display option.
	 */
	private $azera_shop_shortcode_control = false;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $manager       The name of this control.
	 * @param      string $id    Control id.
	 * @param      array  $args    Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['azera_shop_image_control'] ) ) {
			$this->azera_shop_image_control = $args['azera_shop_image_control'];
		}
		if ( ! empty( $args['azera_shop_icon_control'] ) ) {
			$this->azera_shop_icon_control = $args['azera_shop_icon_control'];
		}
		if ( ! empty( $args['azera_shop_title_control'] ) ) {
			$this->azera_shop_title_control = $args['azera_shop_title_control'];
		}
		if ( ! empty( $args['azera_shop_subtitle_control'] ) ) {
			$this->azera_shop_subtitle_control = $args['azera_shop_subtitle_control'];
		}
		if ( ! empty( $args['azera_shop_text_control'] ) ) {
			$this->azera_shop_text_control = $args['azera_shop_text_control'];
		}
		if ( ! empty( $args['azera_shop_link_control'] ) ) {
			$this->azera_shop_link_control = $args['azera_shop_link_control'];
		}
		if ( ! empty( $args['azera_shop_shortcode_control'] ) ) {
			$this->azera_shop_shortcode_control = $args['azera_shop_shortcode_control'];
		}
		if ( ! empty( $args['section'] ) ) {
			$this->id = $args['section'];
		}
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {

		$this_default = json_decode( $this->setting->default );

		$values = $this->value();
		$json = json_decode( $values );
		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="azera_shop_general_control_repeater azera_shop_general_control_droppable">
			<?php

			if ( (count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
					<input type="hidden" id="azera_shop_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="azera_shop_repeater_colector" value="<?php  echo esc_textarea( json_encode( $this_default ) ); ?>" />
					<?php
				} else {
					$this->iterate_array(); ?>
					<input type="hidden" id="azera_shop_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="azera_shop_repeater_colector" />
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
				<input type="hidden" id="azera_shop_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="azera_shop_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
				<?php
			} ?>
		</div>

		<button type="button"   class="button add_field azera_shop_general_control_new_field">
			<?php esc_html_e( 'Add new field','azera-shop' ); ?>
		</button>

		<?php
	}

	/**
	 * Enqueue required scripts and styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'azera-shop-iconpicker-control', azera_shop_get_file( '/inc/icon-picker/js/iconpicker-control.js' ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_style( 'azera-shop-fontawesome-admin', azera_shop_get_file( '/css/font-awesome.min.css' ),array(), '4.5.0' );
	}

	/**
	 * Icon picker input
	 *
	 * @param string $value Value of this input.
	 * @param string $show Option to show or hide this.
	 */
	private function icon_picker_control( $value = '', $show = '' ) {
		?>
		<div class="azera_shop_general_control_icon" <?php if ( $show === 'azera_shop_image' || $show === 'azera_shop_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Icon','azera-shop' ); ?>
			</span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php echo esc_attr( $value ); ?>" type="text">
				<span class="input-group-addon"></span>
			</div>
		</div>
		<?php
	}

	/**
	 * Image input
	 *
	 * @param string $value Value of this input.
	 * @param string $show Option to show or hide this.
	 */
	private function image_control( $value = '', $show = '' ) {
		?>
		<p class="azera_shop_image_control" <?php if ( $show === 'azera_shop_icon' || $show === 'azera_shop_none' ) { echo 'style="display:none;"'; } ?>>
			<span class="customize-control-title">
				<?php esc_html_e( 'Image','azera-shop' )?>
			</span>
			<input type="text" class="widefat custom_media_url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-primary custom_media_button_azera_shop" value="<?php esc_html_e( 'Upload Image','azera-shop' ); ?>" />
		</p>
		<?php
	}

	/**
	 * Switch between icon and image input
	 *
	 * @param string $value Value of this input.
	 */
	private function icon_type_choice( $value = 'azera_shop_icon' ) {
		?>
		<span class="customize-control-title">
			<?php esc_html_e( 'Image type','azera-shop' );?>
		</span>
		<select class="azera_shop_image_choice">
			<option value="azera_shop_icon" <?php selected( $value,'azera_shop_icon' );?>><?php esc_html_e( 'Icon','azera-shop' ); ?></option>
			<option value="azera_shop_image" <?php selected( $value,'azera_shop_image' );?>><?php esc_html_e( 'Image','azera-shop' ); ?></option>
			<option value="azera_shop_none" <?php selected( $value,'azera_shop_none' );?>><?php esc_html_e( 'None','azera-shop' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Input control.
	 *
	 * @param array  $options Settings of this input.
	 * @param string $value Value of this input.
	 */
	private function input_control( $options, $value = '' ) {
		?>
		<span class="customize-control-title"><?php echo $options['label']; ?></span>
		<?php
		if ( ! empty( $options['type'] ) && $options['type'] === 'textarea' ) {  ?>
			<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo $options['label']; ?>"><?php echo ( ! empty( $options['sanitize_callback'] ) ?  apply_filters( $options['sanitize_callback'] , $value ) : esc_attr( $value ) ); ?></textarea>
			<?php
		} else { ?>
			<input type="text" value="<?php echo ( ! empty( $options['sanitize_callback'] ) ?  apply_filters( $options['sanitize_callback'] , $value ) : esc_attr( $value ) ); ?>" class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo $options['label']; ?>"/>
			<?php
		}
	}

	/**
	 * Iterate through repeater's content
	 *
	 * @param array $array Repeater's content.
	 */
	private function iterate_array( $array = array() ) {
		$it = 0;
		if ( ! empty( $array ) ) {
			foreach ( $array as $icon ) {  ?>
				<div class="azera_shop_general_control_repeater_container azera_shop_draggable">
					<div class="azera-shop-customize-control-title">
						<?php esc_html_e( 'Azera Shop','azera-shop' )?>
					</div>
					<div class="azera-shop-box-content-hidden">
						<?php
						$choice = '';
						$image_url = '';
						$icon_value = '';
						$title = '';
						$subtitle = '';
						$text = '';
						$link = '';
						$shortcode = '';

						if ( ! empty( $icon->choice ) ) {
							$choice = $icon->choice;
						}
						if ( ! empty( $icon->image_url ) ) {
							$image_url = $icon->image_url;
						}
						if ( ! empty( $icon->icon_value ) ) {
							$icon_value = $icon->icon_value;
						}
						if ( ! empty( $icon->title ) ) {
							$title = $icon->title;
						}
						if ( ! empty( $icon->subtitle ) ) {
							$subtitle = $icon->subtitle;
						}
						if ( ! empty( $icon->text ) ) {
							$text = $icon->text;
						}
						if ( ! empty( $icon->link ) ) {
							$link = $icon->link;
						}
						if ( ! empty( $icon->shortcode ) ) {
							$shortcode = $icon->shortcode;
						}

						if ( $this->azera_shop_image_control == true && $this->azera_shop_icon_control == true ) {

							$this->icon_type_choice( $choice );
						}

						if ( $this->azera_shop_image_control == true ) {
							$this->image_control( $image_url, $choice );
						}

						if ( $this->azera_shop_icon_control == true ) {
							$this->icon_picker_control( $icon_value, $choice );
						}

						if ( $this->azera_shop_title_control == true ) {
							$this->input_control(array(
								'label' => __( 'Title','azera-shop' ),
								'class' => 'azera_shop_title_control',
							), $title);
						}

						if ( $this->azera_shop_subtitle_control == true ) {
							$this->input_control(array(
								'label' => __( 'Subtitle','azera-shop' ),
								'class' => 'azera_shop_subtitle_control',
							), $subtitle);
						}

						if ( $this->azera_shop_text_control == true ) {
							$this->input_control(array(
								'label' => __( 'Text','azera-shop' ),
								'class' => 'azera_shop_text_control',
								'type'  => 'textarea',
							), $text);
						}

						if ( $this->azera_shop_link_control ) {
							$this->input_control(array(
								'label' => __( 'Link','azera-shop' ),
								'class' => 'azera_shop_link_control',
								'sanitize_callback' => 'esc_url',
							), $link);
						}

						if ( $this->azera_shop_shortcode_control == true ) {
							$this->input_control(array(
								'label' => __( 'Shortcode','azera-shop' ),
								'class' => 'azera_shop_shortcode_control',
							), $shortcode);
						} ?>
						<input type="hidden" class="azera_shop_box_id" value="<?php if ( ! empty( $icon->id ) ) { echo esc_attr( $icon->id );} ?>">
						<button type="button" class="azera_shop_general_control_remove_field button" <?php if ( $it == 0 ) { echo 'style="display:none;"';} ?>><?php esc_html_e( 'Delete field','azera-shop' ); ?></button>
					</div>
				</div>

				<?php
				$it++;
			}// End foreach().
		} else { ?>
			<div class="azera_shop_general_control_repeater_container">
				<div
					class="azera-shop-customize-control-title"><?php esc_html_e( 'Azera Shop', 'azera-shop' ); ?></div>
				<div class="azera-shop-box-content-hidden">
					<?php
					if ( $this->azera_shop_image_control == true && $this->azera_shop_icon_control == true ) {
						$this->icon_type_choice();
					}

					if ( $this->azera_shop_image_control == true ) {
						$this->image_control( '','azera_shop_icon' );
					}

					if ( $this->azera_shop_icon_control == true ) {
						$this->icon_picker_control();
					}

					if ( $this->azera_shop_title_control == true ) {
						$this->input_control( array(
							'label' => __( 'Title', 'azera-shop' ),
							'class' => 'azera_shop_title_control',
						) );
					}

					if ( $this->azera_shop_subtitle_control == true ) {
						$this->input_control( array(
							'label' => __( 'Subtitle', 'azera-shop' ),
							'class' => 'azera_shop_subtitle_control',
						) );
					}

					if ( $this->azera_shop_text_control == true ) {
						$this->input_control( array(
							'label' => __( 'Text', 'azera-shop' ),
							'class' => 'azera_shop_text_control',
							'type'  => 'textarea',
						) );
					}

					if ( $this->azera_shop_link_control == true ) {
						$this->input_control( array(
							'label' => __( 'Link', 'azera-shop' ),
							'class' => 'azera_shop_link_control',
						) );
					}

					if ( $this->azera_shop_shortcode_control == true ) {
						$this->input_control( array(
							'label' => __( 'Shortcode', 'azera-shop' ),
							'class' => 'azera_shop_shortcode_control',
						) );
					}
					?>
					<input type="hidden" class="azera_shop_box_id">
					<button type="button" class="azera_shop_general_control_remove_field button"
							style="display:none;"><?php esc_html_e( 'Delete field', 'azera-shop' ); ?></button>
				</div>
			</div>
			<?php
		}// End if().
	}
}
