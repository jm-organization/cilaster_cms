<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 19.08.2017
 * @Time: 20:21
 *
 * @documentation:
 */

namespace Cilaster\MVC\Application;


use Cilaster\API\Model;
use Cilaster\Core\Constant;
use Cilaster\DB\Connect\DBConnect;
use Cilaster\DB\Tables\Settings;

class ApplicationModel extends Model
{
	public function validServer() {
		return [
			'PHP версии 5.6 и выше' => (phpversion() >= 5.6)?phpversion():false,
			'Поддержка PDO' => (class_exists('PDO'))?true:false,
			'Работа с <b>Cookies</b>' => @ini_get('session.use_cookies'),
			'Чтение <span class="text-secondary">/modules/</span>' => is_readable(Constant::MODULES_ROOT),
			'Чтение <span class="text-secondary">/themes/</span>' => is_readable(Constant::THEMES_ROOT),
			'Чтение и запись <span class="text-secondary">/configs/</span>' => is_writable(Constant::CONFIG_ROOT) || !is_readable(Constant::CONFIG_ROOT),
			'Чтение и запись <span class="text-secondary">/includes/</span>' => is_writable(Constant::INCLUDE_ROOT) || !is_readable(Constant::INCLUDE_ROOT),
			'Создание дополнительных папок средствами PHP' => mkdir( Constant::MAIN_ROOT . '\test' ),
			//'Создание файлов средствами PHP' => '',
			'Удаление папок средствами PHP' => rmdir( Constant::MAIN_ROOT . '\test' ),
			//'Удаление файлов средствами PHP' => '',
		];
	}

	public function saveDBSettings( $settings ) {
		$pattern = file_get_contents( Constant::CONFIG_ROOT . '\data_base_config_pattern.txt' );

		file_put_contents( Constant::CONFIG_ROOT . '\data_base_config.php', sprintf( $pattern,
			$settings['host'],
			$settings['port'],
			$settings['database'],
			$settings['db-type'],
			$settings['charset'],
			$settings['user'],
			$settings['password']
		));
	}

	/**
	 * @function: createCMSTables
	 *
	 * @documentation: Создаёт таблицы нужные для работы сайта.
	 *
	 * @return bool
	 */
	public function createCMSTables() {
		$db_connect = new DBConnect();
		$cilsater_tables = file_get_contents(Constant::MAIN_ROOT.'\manager\cilaster_db.sql');
		$db = $db_connect->connect();
		$date_time = new \DateTime();

		if (!is_array( $db )) {
			if ($db->query($cilsater_tables)) {
				$db->query("INSERT INTO `c_modules` (`id`, `install_date`, `module_name`, `module_description`, `author`, `on`) VALUES
(1, '".$date_time->format('Y-m-d H:i')."', 'Admin', 'Панель администратора для сайта на Cilaster CMS', 'Magicmen', '1');");

				return true;
			}
		} else {
			return false;
		}
	}

	/**
	 * @function: fillSettings
	 *
	 * @documentation: Заполняет таблицу с настройками.
	 *
	 * @param $settings
	 *
	 * @return bool
	 */ 
	public function fillSettings( $settings ) {
		if ($settings) {
			$settings_table = new Settings();

			if ($settings_table->set($settings)) return true;
		} else {
			return false;
		}
	}

	public function installFinish() {
		if (file_put_contents(Constant::MAIN_ROOT.'\install\cilaster.php', '<?php define( \'IS_INSTALLED\', true );')) {
			return true;
		}
	}
}