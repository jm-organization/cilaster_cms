<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 16.08.2017
 * @Time: 23:09
 */

namespace Cilaster\Core;


use Cilaster\DB\Tables\TablesManager;

class Config
{
	public static function getConfigs()
    {
        $keys = [];
        $values = [];
        $configs = null;
        $config_dir = dir(Constant::CONFIG_ROOT);
        while (false !== ($config = $config_dir->read())) { if ($config != '.' && $config != '..') {
            if (is_file(Constant::CONFIG_ROOT . '\\' . $config)) {
                array_push($keys, str_replace('.php', '', $config));
                array_push($values, require Constant::CONFIG_ROOT . '\\' . $config);
                $configs = array_combine($keys, $values);
            }
        } }
        $config_dir->close();
        return $configs;
    }

    public static function getDBConfig() {
        return self::getConfigs()['data_base_config'];
    }

    public static function appConfigs($setting_key) {
        $tm = new TablesManager();
        $result = $tm->queryObj("SELECT `setting_key`, `value` FROM `c_settings` WHERE `setting_key`='".$setting_key."'");

        return $result[0];
    }

    public static function pageConfigs($path, $page='') {
        $tm = new TablesManager();
        $query = "SELECT 
                    `page_id`, 
                    `controller`, 
                    `module`, 
                    `whitelist`, 
                    `blacklist`, 
                    `title`, 
                    `path`, 
                    `custom_url` 
                  FROM `c_pages` 
                  WHERE `custom_url`='".$path."'
                  OR `page_id`='".$page."'";

        $result = $tm->queryObj($query);

        return $result[0];
    }
}