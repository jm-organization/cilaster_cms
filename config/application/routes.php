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
		'module' => '',
		'options' => [
			'route' => '/install.php',
			'action' => 'install',
			'controller' => 'Application',
			'viewpath' => 'vcs'
		]
	],

	'update' => [
		'module' => '',
		'options' => [
			'route' => '/update.php',
			'action' => 'update',
			'controller' => 'Application',
			'viewpath' => 'vcs'
		]
	],

	'rest' => [

	],

	'admin' => [
		'module' => '',
		'option' => [
			'route' => '/admin.php',
			'action' => 'index',
			'controller' => 'Admin',
			'viewpath' => 'themes/admin'
		]
	]
];