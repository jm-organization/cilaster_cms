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

class Router {

	const reserve = ['install', 'update', 'rest', 'admin'];

	public static $route;

	/**
	 * @param mixed $route
	 */
	public static function setRoute($route) {
		self::$route = $route;
	}

	/**
	 * @return mixed
	 */
	public static function getRoute() {
		return self::$route;
	}

    /**
     * @function: getURI
     *
     * @documentation: Получает значение URI, удаляет из него GET запрос,
     * убирает в начале и в конце "/".
     *
     * @param bool $with_query
     *
     * @return mixed|string
     */
    public static function get_uri($with_query=false) {
        $uri_without_get_params = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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
	 * @documentation:Получает значение self::get_uri() и проверяет,
	 * на наличие файла по пути схожему с полученным значением,
	 * добавляя в конец .php, если его нет.
	 *
	 * @return bool
	 */
	public static function uri_exist() {
		$routes = require_once Constant::CONFIG_ROOT.'\application\routes.php';
		$route = str_replace('.php', '', self::get_uri());

		if (array_key_exists($route, array_flip(self::reserve))) {
			self::setRoute((object)$routes[$route]);

			return true;
		}

		//TODO: other routes;

		return false;
    }

    public static function admin_uri_exist() {
        $uri_path = self::get_uri();
        $page_configs = Config::pageConfigs($uri_path);

        $admin_page_path = Constant::MAIN_ROOT.'\admin-panel\path\\'.key($_GET).'.php';

        return (!empty($page_configs) && file_exists($admin_page_path))?([
            'path' => $admin_page_path,
            'page_config' => $page_configs
        ]):false;
    }

    /**
     * @function: start
     *
     * @documentation: Стартует маршрутизацию:
     * определяет текущий маршрут,
     * подгружает контроллер,
     * запускает маршрутAction();
     *
     * @return mixed
     */
    public static function start() {
    	$module = self::$route->module;

        $controller = (self::$route->controller).'Controller';
        $action = (self::$route->action).'Action';

        if (empty($module)) {
            $namespace = "MVC\\".self::$route->controller."\\$controller";

            require_once __DIR__ . '/../'.$namespace.'.php';

            $app_controller = 'Cilaster\\'.$namespace;
            $AppController = new $app_controller();

            if (method_exists( $AppController, $action )) {
                $content = $AppController->$action();
            } else {
                new CException('Метод <b>'.$action.'()</b> Не найден в <b>'.get_class($AppController).'</b>.');
            }
        } elseif (!empty($module)) {
            require_once Constant::MODULES_ROOT.'\\'.$module.'\src\\'.$module.'Controller.php';

            $controller = $module.'\\'.$controller;
            if (class_exists( $controller )) {
                $ModuleController = new $controller();

                if (method_exists( $ModuleController, $action )) {
                    $content = $ModuleController->$action();
                } else {
                    new CException('Метод <b>'.$action.'()</b> Не найден в <b>'.get_class($ModuleController).'</b>.');
                }
            } else {
                new CException('Контроллер <b>'.$controller.'</b> Не найден.');
            }
        }
        
        return $content;
    }

    public static function admin_start() {
        $page_controller = self::admin_uri_exist()['page_config']->controller;
        $controller = $page_controller.'Controller';
        $namespace = "MVC\\$page_controller\\".$controller;
        $action = str_replace('.php', '', end(explode('/', self::get_uri(true)['query']))).'Action';

        require_once __DIR__ . '\..\\'.$namespace.'.php';

        $app_controller = $namespace;
        $AppController = new $app_controller();

        $content = '';

        if (method_exists( $AppController, $action )) {
            $content = $AppController->$action();
        } else {
            new CException('Метод <b>'.$action.'()</b> Не найден в <b>'.get_class($AppController).'</b>.');
        }

        return $content;
    }
}