<?php
/**
 * Class for messages controls in customizer
 *
 * @package azera-shop
 */

/**
 * Class Azera_Shop_Text_Control
 */
class Azera_Shop_Text_Control extends WP_Customize_Control {

	/**
	 * The message to display in the controler
	 *
	 * @var string $message The message to display in the controller
	 */
	private $message = '';

	/**
	 * Azera_Shop_Text_Control constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param integer              $id Id.
	 * @param array                $args Array of arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['azera_shop_message'] ) ) {
			$this->message = $args['azera_shop_message'];
		}
	}

	/**
	 * The render function for the controller
	 */
	public function render_content() {
	    if ( ! empty( $this->label ) ) { ?>
		    <span class="customize-control-title">
				<?php echo $this->label; ?>
			</span>
			<?php
	    }
		echo $this->message;
	}
}
