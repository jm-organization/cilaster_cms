<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 18:19
 *
 * @documentation:
 */

namespace Cilaster\DB\Connect;


use Cilaster\Core\Config;
use PDO;
use PDOException;

//use Doctrine\ORM\Tools;

class DBConnect {

	public $connect_params = [];

	public $connect_error = [];

	public $connect_success = true;

	public $connect;

	/**
	 * @param array $connect_params
	 */
	public function setConnectParams( $connect_params ) {
		$this->connect_params = $connect_params;
	}

	/**
	 * @param array $connect_error
	 */
	public function setConnectError( $connect_error ) {
		$this->connect_error = $connect_error;
	}

	/**
	 * @param boolean $connect_success
	 */
	public function setConnectSuccess( $connect_success ) {
		$this->connect_success = $connect_success;
	}

	/**
	 * @param mixed $connect
	 */
	public function setConnect( $connect ) {
		$this->connect = $connect;
	}

	/**
	 * @return array
	 */
	public function getConnectParams() {
		return $this->connect_params;
	}

	/**
	 * @return array
	 */
	public function getConnectError() {
		return $this->connect_error;
	}

	/**
	 * @return boolean
	 */
	public function isConnectSuccess() {
		return $this->connect_success;
	}

	/**
	 * @return mixed
	 */
	public function getConnect() {
		return $this->connect;
	}

	/**
	 * DBConnect constructor.
	 *
	 * @param $params
	 */
	public function __construct($params = null) {
		$configs = (empty($params))?(Config::getDBConfig()):$params;
		$this->setConnectParams($configs);
	}

	public function connect() {
		try {
			$config = $this->getConnectParams();
			$data_base = $config['db-type'].':host='.$config['host'].';dbname='.$config['db'].';charset='.$config['charset'].';port='.$config['port'];
			$this->setConnect(new PDO($data_base, $config['user'], $config['password']));

			return $this->getConnect();
		} catch (PDOException $e) {
			$this->setConnectSuccess(false);

			return [
				'code'    => (integer)$this->isConnectSuccess(),
				'status'  => 'Ошибка',
				'message' => $e->getMessage(),
			];
		}
	}

}