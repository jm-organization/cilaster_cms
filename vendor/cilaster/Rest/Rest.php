<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 12:14
 *
 * @documentation:
 */

namespace Cilaster\Rest;


class Rest
{
	public static function start() {
		$rest_api = new RestAPI();

		if (new QueryValid( key($_GET) )) {
			header('Content-Type: application/json; charset=utf-8');

			echo $rest_api->method(key($_GET));
		}

		return null;
	}
}   