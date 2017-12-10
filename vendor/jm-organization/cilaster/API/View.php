<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 19.08.2017
 * @Time: 21:00
 *
 * @documentation: Генератор видов, Реализует отображение содержания страниц.
 */

namespace Cilaster\API;


use Cilaster\API\CilasterException\ExceptionGenerator;
use Cilaster\API\CilasterException\MvcException;
use Cilaster\API\Http\Mvc;
use Cilaster\API\Http\Server;
use Cilaster\API\Request\GetRequest;
use Cilaster\Core\Config;
use Cilaster\Core\Router;

class View {
	public $title;

	public $short_title;

	public $view_port = false;

	public $theme;

	public function setTitle($title) {
		return $this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setShortTitle( $short_title ) {
		$this->short_title = $short_title;
	}

	public function getShortTitle() {
		return $this->short_title;
	}

	public function setViewPort( $view_port ) {
		$this->view_port = $view_port;
	}

	public function isViewPort() {
		return $this->view_port;
	}

	public function setTheme( $theme ) {
		$this->theme = $theme;
	}

	public function getTheme() {
		return $this->theme;
	}

	/**
	 * View constructor.
	 *
	 * 	Инициализация вида приложения.
	 */
	public function __construct() {
		$route_root = explode('/', Router::$route->route)[0];
		$theme = (new Config('application'))->get("$route_root/layout");

		// TODO: View Port, metatags;

		$this->setTitle($this->generateTitle());
		$this->setTheme($theme);

		return $this;
	}

	/**
	 * @function: generateTitle
	 *
	 * @documentation:
	 * 	В зависимости от настроек и маршрута
	 * генерирует заголовок страницы.
	 *
	 * @return string
	 */
	private function generateTitle() {
		$config = (new Config('application'))->get('title');

		$config_title = trim($config);
		$this->setShortTitle(($config_title != '')?$config_title:'Cilaster CMS');

		$page_config_title = Router::$route->title;

		if (!IS_INSTALLED) {
			$page_config_title = str_replace('{object}', (new GetRequest())->content()->get('product'), Router::$route->title);
		}

		$page_title = (($page_config_title)?$page_config_title.' | ':'').$this->getShortTitle();

		return $page_title;
	}

	/**
	 * @function: generate
	 *
	 * @documentation:
	 * 	Генерирует страницу в зависимости от настроек шаблона.
	 * Запускает маршрутизатор для выполнения соответствующего метода Controller
	 *
	 * @throws \Exception
	 */
	public function generate() {
		$layout = $this->getTheme().'_layout';
		$layout = THEMES_ROOT.'/'.$this->getTheme()."/$layout.phtml";

		global $content;
		try {
			Router::start();

			$content = Router::getContent();

			if (!file_exists($layout)) { die('layout not found'); }
		} catch (\Exception $exception) {
			$content = (new ExceptionGenerator($exception))->get();
		}

		if ($layout != 'no_layout') {
			require $layout;
		}
	}

	/**
	 * @function: generateErrorPage
	 *
	 * @documentation:
	 * 	Генерирует страницу ошибки.
	 *
	 * @return mixed
	 */
	public function generateErrorPage() {
		return require_once THEMES_ROOT.'\\'.$this->getTheme().'\\404.html';
	}

	/**
	 * @function: basePath
	 *
	 * @documentation:
	 * 	Стоит использовать для подключений
	 * таблиц каскадных стилей, javascript-файлов, изображений.
	 * Берёт ресурсы из директории темы.
	 *
	 * @param null $path
	 *
	 * @return null
	 */
	public function basePath($path = null) {
		$route = str_replace('.php', '', trim(Router::$route->route, '/'));

		$url_path = "//".Server::getName();
		$dir = ($route == 'install' || $route == 'update')?'vcs':'themes';
		$theme = ($route != 'install' && $route != 'update')?($this->getTheme().'/'):'';
		$file_path = '/'."$dir/".$theme."$path";

		return $url_path.(($path)?$file_path:'');
	}

	private function rootPath() { return "//".Server::getName()."/themes/"; }

	private function isExistExtension($extension_root) {
		$bootstrap_root = THEMES_ROOT.$extension_root;

		if (!file_exists($bootstrap_root)) return false;

		return true;
	}

	public function bootstrapPath($file) {
		if (!$this->isExistExtension('_bootstrap/'.$file)) { return $this->basePath(); }

		return $this->rootPath().'_bootstrap/'.$file;
	}

	public function semanticPath($file) {
		if (!$this->isExistExtension('_semantic/'.$file)) { return $this->basePath(); }

		return $this->rootPath().'_semantic/'.$file;
	}

	public function pluginsPath($file) {
		if (!$this->isExistExtension('_plugins/'.$file)) { return $this->basePath(); }

		return $this->rootPath().'_plugins/'.$file;
	}

	/**
	 * @function: render
	 *
	 * @documentation:
	 *    Запускает процес отрисовки пользовательского интерфейса.
	 * В качестве принимающих параметров принимает ассоциативный масив с данными.
	 * Далее эти данные могут будуть выведены на пользовательских страницах.
	 *
	 *    Используеться как инструмент для отрисовки Форм и прочих данных,
	 * пришедших с сервера.
	 *
	 * @param $view
	 * @param array $variables
	 *
	 * @return string
	 * @throws MvcException
	 */
	public function render($view = null, $variables = []) {
		if ($view) {
			$view_path = THEMES_ROOT."/{$this->getTheme()}/$view.phtml";

			if (!file_exists($view_path)) {
				$method = Router::$route->module.'Controller::'.Router::$route->action.'()';

				throw MvcException::UndefinedViewRoute($view_path, $method);
			} else {
				ob_start();

				if (is_array($variables)) {
					foreach ($variables as $key => $value) {
						${$key} = $value;
					}
				}

				global $mvc, $view;
				$ModuleView = '\\Cilaster\\MVC\\'.Router::$route->module.'\\'.Router::$route->module.'View';
				if (!class_exists($ModuleView)) {
					$ModuleView = '\\Module\\'.Router::$route->module.'\\'.Router::$route->module.'View';
				}
				$view = new $ModuleView();
				$mvc = new Mvc();

				include_once $view_path;
			}

			return ob_get_clean();
		} else throw MvcException::DisplayResourceWasNotPassed();
	}

	/**
	 * @function: insert
	 *
	 * @documentation:
	 * 	Делает вставку файлов из директории \include
	 * в корне сайта.
	 *
	 * @param $file_path
	 * @param $file_extension
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function insert($file_path, $file_extension) {
		$path = str_replace('/', '\\', INCLUDES_ROOT."/$file_path$file_extension");

		try {
			if (!file_exists($path)) {
				throw MvcException::InsertedFileNotFound($path);
			}

			global $mvc, $view;
			$ModuleView = '\\Cilaster\\MVC\\'.Router::$route->module.'\\'.Router::$route->module.'View';
			if (!class_exists($ModuleView)) {
				$ModuleView = '\\Module\\'.Router::$route->module.'\\'.Router::$route->module.'View';
			}
			$view = new $ModuleView();
			$mvc = new Mvc();

			include $path;
		} catch (\Exception $e) {
			(new ExceptionGenerator($e))->render();
		}
	}

	public function navBar( $settings = [ ] ) {
		if (!empty( $settings )) {
			$nav_bar = '';
			$nav_links = '';
			$nav_bar .= ($settings['logotype'])?'<div class="logotype"><a href="/"></a></div>':'';

			foreach ($settings['links'] as $key => $value) {
				$nav_links .= '<li><a href="'.$value.'">'.$key.'</a></li>';
			}

			$nav_bar .= '<ul class="'.$settings['nav-class'].'">'.$nav_links.'</ul>';

			return '<nav>'.$nav_bar.'</nav>';
		}
	}
}