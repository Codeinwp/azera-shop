<?php
/**
 * Text control.
 *
 * @package azera-shop
 */

/**
 * Class Azera_Shop_Message
 */
class Azera_Shop_Message extends WP_Customize_Control {

	/**
	 * Message variable.
	 *
	 * @var mixed|string
	 */
	private $message = '';

	/**
	 * Azera_Shop_Message constructor.
	 *
	 * @param WP_Customize_Manager $manager WP_Customize_Manager class.
	 * @param string               $id Control id.
	 * @param array                $args Control args.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['azera_shop_message'] ) ) {
			$this->message = $args['azera_shop_message'];
		}
	}

	/**
	 * Render content.
	 */
	public function render_content() {
		echo '<span class="customize-control-title">' . $this->label . '</span>';
		echo $this->message;
	}
}

