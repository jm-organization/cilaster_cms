<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 25.08.2017
 * @Time: 19:42
 *
 * @documentation: Класс для общения с Таблицей настроек.
 */

namespace Cilaster\DB\Tables;


use Cilaster\API\CilasterException\DBException;

class Settings extends TablesManager implements Table {

	/**
	 * @function: setSettings
	 *
	 * @documentation: Метод заполнения полей таблици Настроек содержимым.
	 *
	 * @param $item
	 *
	 * @return bool
	 */
	public function set( $item ) {
		if (!empty( $item )) {
			$db_connect = $this->getConnection();

			$query = "";

			foreach ($item as $key => $value) {
				$query .= "INSERT INTO `c_settings` (`setting_key`, `value`) VALUES ('".$key."', '".$value."');";
			}

			$db_connect->query($query);

			return true;
		} else {
			new DBException('Запрос пустой! Было передано: ('.$query.').');
		}
	}

	public function get( $item ) {
		// TODO: Implement get() method.
	}

	public function update( $item ) {
		// TODO: Implement update() method.
	}

	public function delete( $item ) {
		// TODO: Implement delete() method.
	}
}