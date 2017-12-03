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


use Cilaster\API\Model;
use Cilaster\API\Request\PostRequest;
use Cilaster\API\Request\Requests;

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

		if ($request->isPost()) {
			if (method_exists( $this, $method_name )) {
				$this->setResponse( $this->$method_name() );
			} else {
				$this->setResponse([
					'status' => false,
					'ERROR' => [
						'message' => 'Method '.$method_name.'() is not exist',
					],
				]);
			}
		}

		return json_encode($this->getResponse());
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
		$model = new Model();
		$request = new PostRequest();
		$content = $request->content();

		$params = [
			'host' => $content->get('host'),
			'port' => $content->get('port'),
			'db' => $content->get('db'),
			'db-type' => $content->get('db-type'),
			'charset' => $content->get('charset'),
			'user' => $content->get('user'),
			'password' => $content->get('password'),
		];

		$connection = $model->connectDataBase( $params );

		if (!is_array( $connection )  && !empty( $connection )) {
			return [
				'code' => 1,
				'status' => 'Успешное подключение!',
				'message' => $connection->getAttribute(
					constant('PDO::ATTR_SERVER_INFO')
				),
			];
		} else {
			return (array)$connection;
		}
	}
}