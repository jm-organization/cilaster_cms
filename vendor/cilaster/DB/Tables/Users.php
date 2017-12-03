<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 25.08.2017
 * @Time: 19:43
 */

namespace Cilaster\DB\Tables;


/**
 * Class Users
 * @package DB\Tables
 *
 * @documentation: Класс для общения с таблицей Пользователей.
 * Ниже будут приведены типы полей и их вид.
 *
 * @fields:
 *   @login
 *   varchar | max(32) | NOT NULL
 *   @password
 *   varchar | max(16) | NOT NULL
 *   @email
 *   varchar | max(144) | NOT NULL
 *   @first_name
 *   varchar | max(48) | DEFAULT NULL
 *   @second_name
 *   varchar | max(64) | DEFAULT NULL
 *   @last_name
 *   varchar | max(64) | DEFAULT NULL
 *   @date_registration
 *   datetime | NOT NULL
 *   @birthday
 *   date | DEFAULT NULL
 *   @user_group (group_id) (foreign key)
 *   int | NOT NULL
 *   @avatar
 *   varchar | max(256) DEFAULT NULL
 */
class Users extends TablesManager implements Table {

	public function set( $user, $group_id = 2 ) {
		$db = $this->getConnection();

		if ($db) {
			$date_registration = new \DateTime();

			$query = $db->prepare("INSERT INTO `c_users` (`login`, `password`, `email`, `first_name`, `second_name`, `last_name`, `date_registration`, `birthday`, `user_group`, `avatar`) VALUES 
							 (:login, :password, :email, :first_name, :second_name, :last_name, :date_registration, :birthday, :user_group, :avatar);");

			$query->bindParam(':login', $user['login']);
			$query->bindParam(':password', $user['password']);
			$query->bindParam(':email', $user['email']);
			$query->bindParam(':first_name', $user['first-name']);
			$query->bindParam(':second_name', $user['second-mane']);
			$query->bindParam(':last_name', $user['last-name']);
			$query->bindParam(':date_registration', $date_registration->format('Y-m-d H:i'));
			$query->bindParam(':birthday', $user['date-birthday']);
			$query->bindParam(':user_group', (($group_id)?$group_id:2));
			$query->bindParam(':avatar', $user['avatar']);

			if ($query->execute()) { return true; } else {
				
			}

		} else {
		}

		return false;
	}

	public function get( $items, $user = null, $additional_query = null ) {
		if (!is_array( $item ) && empty( $user )) { /* TODO: EXCEPTION! */ return false; } else {
			$fields = '';

			$itter = 0;
			foreach ($items as $item) { if ($itter == 0) {
				$itter++;

				$fields .= "`$item`";
			} else {
				$fields .= ", `$item`";
			}}

			$query = (empty($additional_query))?"SELECT $fields FROM `c_users` WHERE `id`='$user' OR `login`='$user'":"SELECT $fields FROM `c_users` ".$additional_query;

			return $this->queryObj($query)[0];
		}
	}

	public function update( $item ) {
		// TODO: Implement update() method.
	}

	public function delete( $item ) {
		// TODO: Implement delete() method.
	}
}