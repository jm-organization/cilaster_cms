<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * 
 * @Date: 16.08.2017
 * @Time: 22:58
 *
 * @documentation: В этом классе обрабтываеться значение $_SERVER["REQUEST_URI"];
 * Отдаётся путь к файлу, который отвечает за представление.
 */

namespace Cilaster\Core;


use Cilaster\API\CilasterException\CException;
use Cilaster\API\CilasterException\MvcException;
use Cilaster\API\Request\Request;

class Router {
	const reserve = ['install', 'update', 'rest', 'admin'];

	public static $route = ['module', 'route', 'action', 'controller', 'viewpath', 'content'];

	/**
	 * @param array $route
	 */
	public static function setRoute($route) {
		self::$route = $route;
	}

	public static function setContent($content) {
		self::$route->content = $content;
	}

	public static function getContent() {
		return self::$route->content;
	}

	/**
	 * @function: getHttpRequest
	 *
	 * @documentation:
	 *
	 *
	 * @return Request
	 */
	public static function getHttpRequest() {
		return new Request();
	}

    /**
     * @function: getURI
     *
     * @documentation:
	 * Получает значение URI, удаляет из него GET запрос,
     * убирает в начале и в конце "/".
     *
     * @param bool $with_query
     *
     * @return mixed|string
     */
    public static function get_uri($with_query=false) {
        $uri_without_get_params = parse_url(self::getHttpRequest()->getUri(), PHP_URL_PATH);

        return (!$with_query)?(
            ($uri_without_get_params != '/')?trim($uri_without_get_params, '/'):'index'
        ):([
            'without_get' => ($uri_without_get_params != '/')?trim($uri_without_get_params, '/'):'index',
            'query' => key($_GET),
        ]);
    }

	/**
	 * @function: uri_exist
	 *
	 * @documentation:
	 * Получает значение self::get_uri() и проверяет,
	 * на наличие файла по пути схожему с полученным значением,
	 * добавляя в конец .php, если его нет.
	 *
	 *
	 * @return bool
	 */
	public static function uri_exist() {
		$routes = new Config('application\routes');
		$current_route = str_replace('.php', '', self::get_uri());

		if (array_key_exists($current_route, array_flip(self::reserve))) {
			if ($current_route == 'rest') { /* TODO: rest */ }

			$route = $routes->get($current_route);
			$buffer = [];

			$buffer['module'] = $route['module'];
			foreach (self::$route as $option) {
				$buffer[$option] = $route['options'][$option];
			}

			self::setRoute((object)$buffer);

			return true;
		}

		//TODO: other routes;

		return false;
    }

	/**
	 * @function: start
	 *
	 * @documentation:
	 *	Стартует маршрутизацию:
	 * определяет текущий маршрут,
	 * подгружает контроллер,
	 * запускает маршрутAction();
	 *
	 * @throws MvcException
	 */
	public static function start() {
    	$module = self::$route->module;

        $controller = (self::$route->controller).'Controller';
        $action = (self::$route->action).'Action';

        if (empty($module)) {
            $namespace = "MVC/".self::$route->controller."/$controller";
            require_once __DIR__ . str_replace('/', '\\', "/../$namespace.php");
            $app_controller = str_replace('/', '\\', "Cilaster/$namespace");

            $AppController = new $app_controller();

			if (method_exists($AppController, $action)) { $content = $AppController->$action(); } else {
				throw MvcException::UndefinedMethodInController($action, get_class($AppController));
			}
        } else {
			$content = 'TODO';
            // TODO: add `module` support;
        }

        self::setContent($content);
    }
}