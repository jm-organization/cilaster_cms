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
	'router' => [
		'routes' => [
			// <<DANGEROUS ZONE
			'vcs' => [
				'install' => [
					'options' => [
						'route' => '/[:action.php]',
						'action' => 'install',
						'module' => 'Application',
					],
				],

				'update' => [
					'options' => [
						'route' => '/[:action.php]',
						'action' => 'update',
						'module' => 'Application',
					],
				],
			],

			'rest' => [
				'rest' => [

				],
			],

			'admin' => [
				'admin' => [
					'option' => [
						'route' => '/admin.php',
						'action' => 'index',
						'module' => 'Admin',
					],
				],
			],
			// DANGEROUS ZONE>>

			'default' => [
				// User routes
			]
		]
	],

	'navigation' => [
		'default' => [
			[
				'route' => 'install',
				'label' => 'Установка {object}',
			],
			[
				'route' => 'update',
				'label' => 'Обновление {object}',
			]
		]
	],
];