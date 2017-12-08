<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 16.08.2017
 * @Time: 18:23
 */

namespace Cilaster\Core;


use Cilaster\API\Http\Mvc;
use Cilaster\API\View;

class Cilaster {
    public static function run() {
    	if (!IS_INSTALLED) {
    		$mvc = new Mvc();

            $mvc->redirect($mvc->url('/install.php', [
                'product' => 'cilaster',
                'step' => 1,
            ]));
        }

        $uri_exist = Router::uri_exist();

        $view = new View();
    	if (!$uri_exist) { $view->generateErrorPage(); }
    	$view->generate();
    }

    public static function adminPanelRun() {
    	// TODO: admin.

        return null;
    }

    public static function install() {
		$uri_exist = Router::uri_exist();

		$view = new View();
		if (!$uri_exist) { $view->generateErrorPage(); }
		$view->generate();
    }
}