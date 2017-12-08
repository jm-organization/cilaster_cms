<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 21.08.2017
 * @Time: 12:57
 *
 * @documentation:
 */

namespace Cilaster\Rest;


use Cilaster\API\CilasterException\RestException;
use Cilaster\API\Model;
use Cilaster\API\Request\PostRequest;
use Cilaster\API\Request\Requests;
use Cilaster\DB\Tools\DBConnect;

class RestAPI
{
	public $response = null;

	/**
	 * @param mixed $response
	 */
	public function setResponse( $response ) {
		$this->response = $response;
	}

	/**
	 * @return mixed
	 */
	public function getResponse() {
		return $this->response;
	}

	public function method($method_name) {
		$request = new Requests();

		$this->setResponse([
			'status' => false,
			'ERROR' => [
				'message' => 'Method '.$method_name.'() is not exist',
			],
		]);

		if (method_exists($this, $method_name)) $this->setResponse($this->$method_name());

		return json_encode($this->getResponse());
	}

	private function getFunctionParams($function) {
		$params = explode(',', $_GET[$function]);
		$keys = $values = [];

		foreach ($params as $param) {
			array_push($keys, explode(':', $param)[0]);
			array_push($values, explode(':', $param)[1]);
		}

		return array_combine($keys, $values);
	}

	/**
	 * @function: testConnection
	 *
	 * @documentation: Проверяет соединение с Базой Данных.
	 * Требует передачи данных по методу POST.
	 *
	 * @return array|string
	 */
	public function testConnection() {
		$content = (new PostRequest())->content();
		$params = $this->getFunctionParams(__FUNCTION__);

		$requires = ['driver', 'user', 'password','host', 'port', 'dbname', 'charset'];

		$db = false;

		if ((new PostRequest())->isPost()) { $db = new DBConnect([
			'driver' => $content->get('driver'),
			'user' => $content->get('user'),
			'password' => $content->get('password'),
			'host' => $content->get('host'),
			'port' => $content->get('port'),
			'dbname' => $content->get('database'),
			'charset' => $content->get('charset'),
		]);	} elseif ((new PostRequest())->isGet()) {
			foreach ($requires as $require) { if (!array_key_exists($require, $params)) return [
				'code' => 2,
				'status' => 'Error',
				'message' => 'Unknown function params',
				'vars' => $params
			]; }

			$db = new DBConnect([
				'driver' => $params['driver'],
				'user' => $params['user'],
				'password' => $params['password'],
				'host' => $params['host'],
				'port' => $params['port'],
				'dbname' => $params['dbname'],
				'charset' => $params['charset'],
			]);
		} else {
			return null;
		}

		$connection = $db->create()->getConnection();

		if ($connection->isConnected()) {
			return [
				'code' => 1,
				'status' => 'Успешное подключение!',
				'message' => $connection->errorInfo(),
			];
		}

		return [
			'code' => 2,
			'status' => 'Error',
			'message' => $connection->errorInfo(),
		];
	}
}