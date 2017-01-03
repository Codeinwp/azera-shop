<?php
/**
 * Section class file.
 *
 * @package azera-shop
 */

/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Azera_Shop_Customizer_Upsell_Frontpage_Sections extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'azera-shop-frontpage-sections';

	/**
	 * Upsell text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $upsell_text = '';

	/**
	 * Label title to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $upsell_title = '';

	/**
	 * Button url.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $upsell_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function json() {
		$json = parent::json();
		$json['upsell_text']                = wp_kses_post( $this->upsell_text );
		$json['upsell_title']                = wp_kses_post( $this->upsell_title );
		$json['upsell_url']                = esc_url( $this->upsell_url );
		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
	?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<# if ( data.upsell_url ) { #>
				<h3 class="accordion-section-title">
					<# if ( data.upsell_title ) { #>
						{{{data.upsell_title}}}
					<# } #>
					<# if ( data.upsell_text && data.upsell_url ) { #>
						<a class="button button-secondary alignright" href="{{data.upsell_url}}" target="_blank">
							{{data.upsell_text}}
						</a>
					<# } #>
				</h3>
			<# } else { #>
				<p class="frontpage-sections-upsell">
					<# 	if ( data.upsell_text ) { #>
						{{{data.upsell_text}}}
					<# } #>
				</p>
			<# } #>


		</li>
		<?php
	}
}
