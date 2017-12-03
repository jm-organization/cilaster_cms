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


use Cilaster\API\AuthManager\Identity;
use Cilaster\Core\Config;
use Cilaster\Core\Constant;
use Cilaster\Core\Router;
use Cilaster\API\CilasterException\CException;

class View
{
	public $title;

	public $short_title;

	public $view_port = false;

	public $theme;

	/**
	 * @function: setTitle
	 *
	 * @documentation: Устанавливает заголовок для страницы.
	 *
	 * @param $title
	 *
	 * @return mixed
	 */
	public function setTitle($title) {
		return $this->title = $title;
	}

	/**
	 * @function: getTitle
	 *
	 * @documentation: Возвращяет заголовок страницы
	 *
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $short_title
	 */
	public function setShortTitle( $short_title ) {
		$this->short_title = $short_title;
	}

	/**
	 * @return mixed
	 */
	public function getShortTitle() {
		return $this->short_title;
	}

	/**
	 * @param boolean $view_port
	 */
	public function setViewPort( $view_port ) {
		$this->view_port = $view_port;
	}

	/**
	 * @return boolean
	 */
	public function isViewPort() {
		return $this->view_port;
	}

	/**
	 * @function: setTheme
	 *
	 * @documentation: Устанавливает тему для приложения
	 *
	 * @param $theme
	 */
	public function setTheme( $theme ) {
		$this->theme = $theme;
	}

	/**
	 * @function: getTheme
	 *
	 * @documentation: Возвращает тему приложения
	 *
	 * @return mixed
	 */
	public function getTheme() {
		return $this->theme;
	}

	/**
	 * View constructor.
	 *
	 * Инициализация вида приложения.
	 *
	 * @param string $theme
	 */
	public function __construct($theme = 'default') {
		$config = new Config();

		if (IS_INSTALLED) {$viewPort = $config->appConfigs('is-adaptive');
		$this->setViewPort(($viewPort->value == 1)?true:false);}
		
		$this->setTitle($this->generateTitle());

		// TODO: meta-tags

		$this->setTheme($theme);

		return $this;
	}

	/**
	 * @function: generateTitle
	 *
	 * @documentation: В зависимости от настроек и маршрута
	 * генерирует заголовок страницы.
	 *
	 *
	 * @return string
	 */
	public function generateTitle() {
		$config = new Config();
		$app_config = (IS_INSTALLED)?$config->appConfigs('title'):'';

		$config_title = ($app_config->value)?$app_config->value:'';
		$this->setShortTitle(($config_title != '')?$config_title:'Cilaster - site');
		$AppController = new Controller();

		$page_config_title = str_replace( '{object}', $AppController->getProduct(), Router::$route->title );

		$page_title = (($page_config_title)?$page_config_title.' | ':'').$this->getShortTitle();

		return $page_title;
	}

	/**
	 * @function: generate
	 *
	 * @documentation: Генерирует страницу в зависимости от настроек шаблона.
	 * Запускает маршрутизатор для выполнения соответствующего метода Controller
	 *
	 * @throws \Exception
	 */
	public function generate() {
		$layout = str_replace('\..', '', $this->getTheme()).'_layout';

		global $content;
		$content = Router::start();

		if ($layout != 'no_layout') {
			require_once Constant::THEMES_ROOT.$this->getTheme().$layout.".php";
		}
	}

	public function adminGenerate() {
		$layout = str_replace( '\.', '', $this->getTheme() ).'_layout';

		global $content;
		$content = Router::admin_start();

		if ($layout != 'no_layout') {
			require_once Constant::THEMES_ROOT.'\\'.$this->getTheme().'\\'.$layout.".php";
		}
	}

	/**
	 * @function: generateErrorPage
	 *
	 * @documentation: Генерирует страницу ошибки.
	 *
	 * @return mixed
	 */
	public function generateErrorPage() {
		return require_once Constant::THEMES_ROOT.'\\'.$this->getTheme().'\\404.html';
	}

	/**
	 * @function: render
	 *
	 * @documentation: Запускает процес отрисовки пользовательского интерфейса.
	 * В качестве принимающих параметров принимает ассоциативный масив с данными.
	 * Далее эти данные могут будуть выведены на пользовательских страницах.
	 *
	 * Используеться как инструмент для отрисовки Форм и прочих данных,
	 * пришедших с сервера.
	 *
	 * @param $view
	 * @param array $variables
	 *
	 * @return string
	 */
	public function render($view, $variables = []) {
		if ($view) {
			ob_start();

			if (is_array($variables)) {
				foreach ($variables as $key => $value) {
					global ${$key};
					${$key} = $value;
				}
			}

			$view_path = Constant::MAIN_ROOT.Router::$route->path;

			(file_exists($view_path))?include_once $view_path:null;

			return ob_get_clean();
		}
	}

	/**
	 * @function: insert
	 *
	 * @documentation: Делает вставку файлов из директории \include
	 * в корне сайта.
	 *
	 * @param $file_path
	 * @param $file_extension
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function insert($file_path, $file_extension) {
		$path = Constant::INCLUDE_ROOT.'\\'.$file_path.$file_extension;

		if (file_exists($path)) {
			return require_once $path;
		} else {
			new CException('Файл по пути <b>'.$path.'</b> не найден.');
		}
	}

	/**
	 * @function: url
	 *
	 * @documentation: Генерирует ссылку с параметрами.
	 *
	 * @param $default
	 * @param null $query
	 * @param null $fragment
	 *
	 * @return string
	 */
	public function url( $default, $query = null, $fragment = null ) {
		$url_query = (stristr( $default, '?' ))?'&':'?';

		if (is_array( $query )) {
			$itter = 0;
			foreach ($query as $key => $value) { if ($itter == array_search( $key, $query )) {
				$itter++;
				$url_query .= $key.'='.$value;
			} else {
				$url_query .= '&'.$key.'='.$value;
			} }
		}

		if (isset( $url_query ) && strlen( $url_query ) > 1) {
			$url_query = (stristr(urldecode( $default ), substr( $url_query, 1 )))?'':$url_query;
		}

		$url = $default.((strlen( $url_query ) > 1)?$url_query:'').(($fragment)?'#'.$fragment:'');

		return $url;
	}

	/**
	 * @function: basePath
	 *
	 * @documentation: Стоит использовать для подключений
	 * таблиц каскадных стилей, javascript-файлов, изображений.
	 * Берёт ресурсы из директории темы.
	 *
	 * @param null $path
	 *
	 * @return null
	 */
	public function basePath($path = null) {
		$route = str_replace('.php', '', trim(Router::$route->route, '/'));

		$url_path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/";
		$dir = ($route == 'install' || $route == 'update')?'manager':'themes';
		$theme = ($route != 'install' && $route != 'update')?($this->getTheme().'/'):'';
		$file_path = '/'."$dir/".$theme."$path";

		return $url_path.($path)?$file_path:'';
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

	public function currentRoute($params=null) {
		$uri = Router::get_uri();

		if (!is_string($uri) && $uri == 'index') {
			return $uri;
		} elseif (is_string($uri)) {
			if (isset( $params )) {
				switch ($params) {
					case 'first':
						return explode('/', $uri)[0];
						break;
					case 'last':
						return max(explode('/', $uri));
						break;
					default:
						if (is_int( $params )) {
							return explode( '/', $uri )[ $params ];
						} else {
							return false;
						}
						break;
				}
			} else {
				return max(explode('/', $uri));
			}
		} else {
			return false;
		}
	}

	public function identity() {
		return new Identity();
	}

	public function adminBar() {
		// TODO: Проверка прав пользователя
		$admin_bar = 'admin-panel/admin_bar_layout.php';

		if (file_exists(Constant::MAIN_ROOT.'\\'.$admin_bar)) {
			return "<iframe width='100%' height='32px' src='$admin_bar' class='admin-bar-frame'><div class='admin-bar'>
						<p>К сожалению, ваш браузер не подерживает <code>&lt;iframe&gt;</code>.</p>
						<p style='float: right;'><a href='/themes/admin/path/index.php?admin' target='_blank'>Панель администратора</a></p>
					</div></iframe>";
		}

		return null;
	}
}