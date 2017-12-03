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


class Requests
{
	public $result = false;

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
		return $this->result;
	}

	/**
	 * @function: isGet
	 *
	 * @documentation: Аналогичен методу isPost(),
	 * только проверяет пришли ли данніе по методу GET.
	 *
	 * @return bool
	 */
	public function isGet() {
		if ($_SERVER['REQUEST_METHOD'] == 'GET'
		    || $_SERVER['REQUEST_METHOD'] == 'get') {
			return true;
		}
		return $this->result;
	}
}