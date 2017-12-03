<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 12:26
 *
 * @documentation:
 */

namespace Cilaster\Rest;


class QueryValid {

	public function __construct($query_key) {
		$bad_chars = ['*',',','-','_',')','('];

		foreach ($bad_chars as $char) {
			if ($query_key == $char) return false;
		}
		if (is_integer( $query_key )) return false;

		return true;
	}

}