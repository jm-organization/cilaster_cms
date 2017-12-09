<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 17.08.2017
 * @Time: 13:16
 */

define("MAIN_ROOT", dirname(dirname(dirname(dirname(dirname(__FILE__))))));

define("THEMES_ROOT", MAIN_ROOT.'/themes');
define("CONFIG_ROOT", MAIN_ROOT.'/config');
define("I18N_ROOT", MAIN_ROOT.'/i18n');
define("MODULES_ROOT", MAIN_ROOT.'/modules');

define("BOOTSTRAP_ROOT", THEMES_ROOT.'/_bootstrap');
define("INCLUDES_ROOT", THEMES_ROOT.'/_includes');
define("EXCEPTIONS_ROOT", THEMES_ROOT.'/_exceptions');
define("PLUGINS_ROOT", THEMES_ROOT.'/_plugins');

function callback() {
	return null;
}