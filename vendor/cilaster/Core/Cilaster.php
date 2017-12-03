<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 16.08.2017
 * @Time: 18:23
 */

namespace Cilaster\Core;


require_once Constant::MANAGER.'\cilaster.php';

use Cilaster\API\Model;
use Cilaster\API\View;

class Cilaster {
    public static function run() {
    	if (!IS_INSTALLED) {
            $view = new View();
            $model = new Model();

            $model->redirect($view->url('/install.php', [
                'product' => 'cilaster',
                'step' => 1,
            ]));
        }

		$app_config = Config::appConfigs('theme');
		$theme = ($app_config->value)?$app_config->value:'default';

		$view = new View($theme);

		if (!Router::uri_exist()) { $view->generateErrorPage(); }

		$view->generate();

        return null;
    }

    public static function adminPanelRun() {
        $model = new Model();

        if (!IS_INSTALLED) {
            $view = new View();

            $model->redirect($view->url('/install.php', [
                'product' => 'cilaster',
                'step'    => 1,
            ]));
        } else {
            $admin = Router::admin_uri_exist();

            if( !$admin ) {
                $view = new View();

                $model->redirect($view->url('/admin-panel/index.php?admin'));
            } else {
                $view = new View('admin', 'admin_uri_exist');

                $view->adminGenerate();
            }
        }
    }

    public static function install() {
        $view = new View('\..\manager');

		if (!Router::uri_exist()) { $view->generateErrorPage(); }

		$view->generate();
    }
}