<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 03.12.2017
 * Time: 18:20
 *
 * Documentation: Cli-загрузчик
 */
$loader = require_once __DIR__ . '/../Bootstrap.php';

use Cilaster\Cli\Doctrine\CliManager;

$cliDoctrine = (new CliManager())->run($entityManager);