<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 03.12.2017
 * Time: 16:39
 *
 * Documentation:
 */

return [
	'path' => [__DIR__ . '/../../vendor/cilaster/DB/Tables/'],

	'dev' => false,

	'db' => [
		'driver' => 'pdo_mysql',
		'user' => 'root',
		'password' => '',
		'host' => 'localhost',
		'port' => 3306,
		'dbname' => 'cilaster',
		'charset' => 'utf8'
	],

	'proxy_dir' => null,

	'cache' => null,

	'simple_annotation_reader' => true,
];