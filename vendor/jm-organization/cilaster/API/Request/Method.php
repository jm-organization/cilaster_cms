<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 14:26
 *
 * @documentation: Интерфейс для создания методов получения
 * данных с методов их передачи.
 */

namespace Cilaster\API\Request;


interface Method
{
	/**
	 * @function: setData
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function setData( $data );

	/**
	 * @function: getData
	 *
	 * @return mixed
	 */
	public function getData();

	/**
	 * @function: content
	 *
	 * @return mixed
	 */
	public function content();

	/**
	 * @function: get
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	public function get($key);
}