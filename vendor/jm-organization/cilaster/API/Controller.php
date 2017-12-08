<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 20.08.2017
 * @Time: 18:41
 *
 * @documentation:
 */

namespace Cilaster\API;

use Cilaster\API\AuthManager\Identity;

class Controller
{
	public $identity;

	/**
	 * @param mixed $identity
	 */
	public function setIdentity( $identity ) {
		$this->identity = $identity;
	}

	/**
	 * @return mixed
	 */
	public function getIdentity() {
		return $this->identity;
	}

	public function __construct() {
		$this->setIdentity( new Identity() );
	}

	public function getProduct() {
		$product = $_GET['product'];

		switch ($product) {
			case 'cilaster':
				return 'Cilaster CMS';
				break;
			default:
				return ($product != '*')?ucfirst($product):'';
				break;
		}
	}
}