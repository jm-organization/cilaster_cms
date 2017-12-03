<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 13:15
 *
 * @documentation:
 */

namespace Cilaster\API\Request;


class GetRequest extends Requests implements Method {

	public $data = [];

	/**
	 * @param array $data
	 *
	 * @return mixed|void
	 */
	public function setData( $data ) {
		$this->data = $data;
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @function: content
	 *
	 * @documentation:
	 *
	 * @return $this
	 */
	public function content() {
		$keys = [];
		$values = [];

		if ($this->isGet()) {
			foreach ($_GET as $key => $value) {
				array_push( $keys, $key );
				array_push( $values, $value );
			}

			$data = array_combine( $keys, $values );
			$this->setData( $data );
		}

		return $this;
	}

	/**
	 * @function: get
	 *
	 * @documentation:
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	public function get($key) {
		return $this->getData()[$key];
	}
}