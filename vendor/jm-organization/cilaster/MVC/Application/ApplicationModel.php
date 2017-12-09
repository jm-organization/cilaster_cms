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

class ApplicationModel extends Model
{
	public function validServer() {
		return [
			[1, 'PHP версии 5.6 и выше', (phpversion() >= 5.6)?true:false, phpversion()],
			[2, 'Поддержка PDO', (class_exists('PDO'))?true:false, null],
			[3, 'Работа с <b>Cookies</b>', @ini_get('session.use_cookies'), null],
			[4, 'Чтение <span class="text-secondary">/modules/</span>', is_readable(MODULES_ROOT), null],
			[5, 'Чтение <span class="text-secondary">/themes/</span>', is_readable(THEMES_ROOT), null],
			[6, 'Чтение и запись <span class="text-secondary">/configs/</span>', is_writable(CONFIG_ROOT) || !is_readable(CONFIG_ROOT), null],
			[7, 'Чтение и запись <span class="text-secondary">/includes/</span>', is_writable(INCLUDES_ROOT) || !is_readable(INCLUDES_ROOT), null],
			[8, 'Создание дополнительных папок средствами PHP', mkdir(MAIN_ROOT.'\test'), null],
			[9, 'Удаление папок средствами PHP', rmdir(MAIN_ROOT.'\test'), null],
		];
	}

	public function saveDBSettings( $settings ) {
		$pattern = file_get_contents( CONFIG_ROOT . '\data_base_config_pattern.txt' );

		file_put_contents( CONFIG_ROOT . '\data_base_config.php', sprintf( $pattern,
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
		$cilsater_tables = file_get_contents(constants::MAIN_ROOT.'\manager\cilaster_db.sql');
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
		if (file_put_contents(constants::MAIN_ROOT.'\install\cilaster.php', '<?php define( \'IS_INSTALLED\', true );')) {
			return true;
		}
	}
}