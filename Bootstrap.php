<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 19.08.2017
 * @Time: 20:07
 *
 * @documentation:
 * Корневой загрузчик проекта:
 *  - загружает классы,
 *  - инициализирует:
 *    - Cilaster\DB\Tools\EntityManager
 */
$loader = require_once __DIR__.'/vendor/autoload.php';

use Cilaster\DB\Tools\EntityManager;

$configs = require __DIR__ . '/config/application/database.php';

global $entityManager;
$entityManager = (new EntityManager($configs))->create()->getEntityManager();


