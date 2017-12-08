<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 27.08.2017
 * @Time: 15:36
 *
 * @documentation:
 */

namespace Cilaster\API\AuthManager;


use Cilaster\DB\Tables\Users;

class Identity {

	public $user;

	public $identity = false;

	/**
	 * @param object $user
	 */
	public function setUser( $user ) {
		$this->user = $user;
	}

	/**
	 * @return object
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param boolean $identity
	 */
	public function setIdentity( $identity ) {
		$this->identity = $identity;
	}

	/**
	 * @return boolean
	 */
	public function isIdentity() {
		return $this->identity;
	}

	public function __construct() {
		foreach ($_COOKIE as $key => $value) {
			if (preg_match( "/User-[0-9]*/", $key )) {
				$_USER = new Users();
				
				$user_id = explode( '-', $key )[1];
				$user = $_USER->get([
					'id', 'login', 'avatar', 'email', 'date_registration',
					'birthday', 'first_name', 'second_name', 'last_name', 'user_group',
					'permission'
				], $user_id, "WHERE `id`='$user_id' AND `password`='$value'");

				if ($user) {
					$this->setIdentity( true );
					$this->setUser( $user );
				}
			}
		}
	}

}