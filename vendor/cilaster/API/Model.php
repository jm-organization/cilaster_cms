<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 21.08.2017
 * @Time: 12:31
 *
 * @documentation: Главній класс Модели приложения. Так сказать, его API
 * для обращения к БД и прочим функциям.
 */

namespace Cilaster\API;


use Cilaster\Core\Config;
use Cilaster\Core\Router;
use Cilaster\DB\Connect\DBConnect;
use PDO;

class Model
{
	/**
	 * @function: connectDataBase
	 *
	 * @documentation: Функция соединения с базой данных
	 *
	 * @param null $connection
	 *
	 * @return array|mixed
	 */
	public function connectDataBase( $connection = null ) {
		$data_base = new DBConnect($connection);
		
		return $data_base->connect();
	}

	/**
	 * @function: redirect
	 *
	 * @param $url
	 *
	 * @throws \Exception
	 */
	public function redirect($url) {
		if (is_string($url) && $url != '*') {
			header('Location: '.$url);
		}
	}

	private function pregtrim($str) {
		return preg_replace("/[^\x20-\xFF]/","",@strval($str));
	}

	public function passwordEncoder( $password, $email=null ) {
		$configs = new Config();
		$site_config = $configs->appConfigs('salt');

		return ($email)?md5( sha1($password).sha1($site_config->value).sha1($email) ):false;
	}

	public function emailValid( $email ) {
		$email = trim( $this->pregtrim($email) );

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) { return $email; } else {
			return false;
		}
	}

	public function passwordValid( $password ) {
		$password = trim( $password );

		if (strlen( $password ) < 6 || strlen( $password ) > 16) {
			return false;
		}

		return $password;
	}
	
	
}