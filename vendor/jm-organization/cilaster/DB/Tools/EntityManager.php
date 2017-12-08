<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 03.12.2017
 * Time: 16:22
 *
 * Documentation:
 */

namespace Cilaster\DB\Tools;


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;

class EntityManager {
	public $conn;

	public $config;

	public $entityManager;


	public function __construct($configs) {
		$config = (new DBConfiguration($configs))->getConfigs();
		$this->setConfig($config);

		$this->setConn($configs['db']);
	}

	public function create() {
		$entityManager = DoctrineEntityManager::create($this->getConn(), $this->getConfig());

		$this->setEntityManager($entityManager);

		return $this;
	}


	public function setConn($conn) {
		$this->conn = $conn;
	}

	public function setConfig($config) {
		$this->config = $config;
	}

	public function setEntityManager($entityManager) {
		$this->entityManager = $entityManager;
	}


	public function getConn() {
		return $this->conn;
	}

	public function getConfig() {
		return $this->config;
	}

	public function getEntityManager() {
		return $this->entityManager;
	}
}