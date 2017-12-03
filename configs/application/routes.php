<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 02.12.2017
 * Time: 22:14
 *
 * Documentation:
 */

return [
	'install' => [
		'route' => '/install.php',
		'controller' => 'Application',
		'action' => 'install',
		'title' => 'Установка {object}',
		'path' => '/manager/install.php'
	],

	'update' => [
		'route' => '/update.php',
		'controller' => 'Application',
		'action' => 'update',
		'title' => 'Обновление {object}',
		'path' => '/manager/install.php'
	],

	'rest' => [

	],

	'admin' => [

	]
];