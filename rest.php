<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 21.08.2017
 * @Time: 15:44
 *
 * @documentation:
 */

header('Content-Type: application/json; charset=utf-8');
$loader = require_once __DIR__.'/vendor/autoload.php';

use Cilaster\DB\Tools\EntityManager;

global $entityManager;
$configs = require __DIR__ . '/config/application/database.php';
$entityManager = (new EntityManager($configs))->create()->getEntityManager();

\Cilaster\Rest\Rest::start();