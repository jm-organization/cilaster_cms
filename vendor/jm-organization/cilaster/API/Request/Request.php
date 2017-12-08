<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 13:16
 *
 * @documentation:
 */

namespace Cilaster\API\Request;


class Request {
	/**
	 * Request constructor.
	 *
	 * @documentation:
	 */
	public function __construct() {
		return $this;
	}

	/**
	 * @function: isPost
	 *
	 * @documentation: Метод проверки пришедших данных.
	 * Возвращает true если данные пришли по методу POST.
	 *
	 * @return bool
	 */
	public function isPost() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'
		    || $_SERVER['REQUEST_METHOD'] == 'post') {
			return true;
		}
		return false;
	}

	/**
	 * @function: isGet
	 *
	 * @documentation: Аналогичен методу isPost(),
	 * только проверяет пришли ли данные по методу GET.
	 *
	 * @return bool
	 */
	public function isGet() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET'
		    || $_SERVER['REQUEST_METHOD'] == 'get') {
			return true;
		}
		return false;
	}

	/**
	 * @function: getTime
	 *
	 * @documentation:
	 * Возвращает время от начала загрузки страници.
	 * При переданном true будет возвращат точное время
	 * загрузки страници.
	 *
	 * @param bool $exact
	 *
	 * @return mixed
	 */
	public function getTime($exact = false) {
		if ($exact) { return $_SERVER['REQUEST_TIME_FLOAT']; }

		return $_SERVER['REQUEST_TIME'];
	}

	/**
	 * @function: getStringUri
	 *
	 * @documentation:
	 * Возвращает строковое значение URI.
	 * 	@example: product=cilaster&step=1
	 *
	 * @return mixed
	 */
	public function getStringUri() {
		return $_SERVER['QUERY_STRING'];
	}

	public function getUri() {
		return $_SERVER['REQUEST_URI'];
	}
}