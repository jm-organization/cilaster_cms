<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 03.12.2017
 * Time: 17:29
 *
 * Documentation:
 */

namespace Cilaster\DB\Tools;


use Cilaster\Core\Config;
use Cilaster\Core\Constant;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class DBConnect extends Connection {
	public $configs;

	public $conn;
	
	public $connection;

	public function __construct(array $connectionParams) {
		$configs = (new Config('application/database'))->get();

		$this->setConfigs((new DBConfiguration($configs))->getConfigs());
		$this->setConn($connectionParams);
	}

	public function create() {
		$connection = DriverManager::getConnection($this->getConn(), $this->getConfigs());
		$connection->connect();

		$this->setConnection($connection);

		return $this;
	}
	
	public function setConfigs($configs) {
		$this->configs = $configs;
	}

	public function setConnection($connection) {
		$this->connection = $connection;
	}

	public function setConn($conn) {
	$this->conn = $conn;
}


	public function getConfigs() {
		return $this->configs;
	}
	
	public function getConnection() {
		return $this->connection;
	}

	public function getConn() {
	return $this->conn;
}
}