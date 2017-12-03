<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 27.08.2017
 * @Time: 15:37
 *
 * @documentation:
 */

namespace Cilaster\API\AuthManager;


use Cilaster\DB\Tables\Users;

class Registration {
	public function go($user, $group_id = null) {
		$_USERS = new Users();

		if ($_USERS->set( $user, $group_id )) return true;
	}
}