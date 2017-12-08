<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 27.08.2017
 * @Time: 1:30
 *
 * @documentation:
 */

namespace Cilaster\API\AuthManager;


use Cilaster\API\Model;
use Cilaster\DB\Tables\Users;

class Auth {

	public function login( $user ) {
		$_USERS = new Users();
		$utils = new Model();

		$row_email = $_USERS->get( ['email'], $user['login'] );
		$email = ($row_email)?$row_email->email:false;

		if ($email) { 
			$password = $utils->passwordEncoder( $user['password'], $email );

			$row_user_id = $_USERS->get( ['id'], $user['login'], " WHERE `login`='".$user['login']."' AND `password`='$password'" );
			$user_id = ($row_user_id)?$row_user_id->id:false;

			if (!$user_id) { return false; } else {
				setcookie("User-$user_id","$password",time()+3600*24*365*10,"/");

				return true;
			}
		} else {
			return false;
		}
	}

	public function logout( $user_id ) {
		// TODO: Implements Logout()
	}

}