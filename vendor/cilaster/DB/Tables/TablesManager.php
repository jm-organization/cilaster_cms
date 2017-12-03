<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 23.08.2017
 * @Time: 18:20
 *
 * @documentation:
 */

namespace Cilaster\DB\Tables;


use Cilaster\API\CilasterException\DBException;
use Cilaster\DB\Connect\DBConnect;
use PDO;

class TablesManager {

	public $connection;

	/**
	 * @param mixed $connection
	 */
	public function setConnection( $connection ) {
		$this->connection = $connection;
	}

	/**
	 * @return mixed
	 */
	public function getConnection() {
		return $this->connection;
	}

	public function __construct() {
		$db = new DBConnect();
		$this->setConnection($db->connect());

		return $this;
	}

	/**
	 * @function: queryObj
	 *
	 * @documentation: Извлекает данные из таблици в виде объекта.
	 *
	 * @param $query
	 *
	 * @return PDO::FETCH_OBJ
	 */
	public function queryObj( $query ) {
		$db_connect = $this->getConnection();

		if ($query) {
			$prepare_data = $db_connect->prepare($query);
			$prepare_data->execute();
			$result = $prepare_data->fetchAll(PDO::FETCH_OBJ);

			return $result;
		} else {
			new DBException('Запрос пустой! Было передано: ('.$query.').');
		}
	}
}
