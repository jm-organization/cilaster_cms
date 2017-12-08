<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 05.12.2017
 * Time: 22:04
 *
 * Documentation:
 */

namespace Cilaster\API\Http;


class Mvc extends Http {
	public function __construct() {
		
	}

	public function redirect($url) {
		if (is_string($url) && $url != '*') {
			header('Location: '.$url);
		}
	}

	/**
	 * @function: url
	 *
	 * @documentation: Генерирует ссылку с параметрами.
	 *
	 * @param $default
	 * @param null $query
	 * @param null $fragment
	 *
	 * @return string
	 */
	public function url($default, $query = null, $fragment = null) {
		$url_query = (stristr($default, '?'))?'&':'?';

		if (is_array($query)) {
			$itter = 0;
			foreach ($query as $key => $value) { if ($itter == array_search( $key, $query )) {
				$itter++;
				$url_query .= $key.'='.$value;
			} else {
				$url_query .= '&'.$key.'='.$value;
			} }
		}

		if (isset($url_query) && strlen($url_query) > 1) {
			$url_query = (stristr(urldecode($default), substr($url_query, 1)))?'':$url_query;
		}

		$url = $default.((strlen( $url_query ) > 1)?$url_query:'').(($fragment)?'#'.$fragment:'');

		return $url;
	}
}