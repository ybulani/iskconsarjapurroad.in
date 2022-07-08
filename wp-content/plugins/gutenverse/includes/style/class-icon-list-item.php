<?php
/**
 * Gutenverse Icon List Item
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package gutenverse
 */

namespace Gutenverse\Style;

/**
 * Class Icon List Item
 *
 * @package Gutenverse
 */
class Icon_List_Item extends Style_Abstract {
	/**
	 * Block Name
	 *
	 * @var array
	 */
	protected $name = 'icon-list-item';

	/**
	 * Constructor
	 *
	 * @param array $attrs Attribute.
	 */
	public function __construct( $attrs ) {
		parent::__construct( $attrs );

		$this->set_feature(
			array(
				'advance' => null,
			)
		);
	}

	/**
	 * Generate style base on attribute.
	 */
	public function generate() {}
}
