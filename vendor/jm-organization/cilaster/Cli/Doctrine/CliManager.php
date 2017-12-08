<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 03.12.2017
 * Time: 17:03
 *
 * Documentation:
 */

namespace Cilaster\Cli\Doctrine;


use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\EntityManager;

class CliManager {
	public function run(EntityManager $em) {
		return ConsoleRunner::createHelperSet($em);
	}
}