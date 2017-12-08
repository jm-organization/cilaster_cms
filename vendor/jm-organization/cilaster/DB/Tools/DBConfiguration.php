<?php
/**
 * Created in JM Organization.
 * Author: Magicmen
 *
 * Date: 03.12.2017
 * Time: 18:40
 *
 * Documentation:
 */

namespace Cilaster\DB\Tools;


use Cilaster\API\CilasterException\DBException;
use Doctrine\Common\Cache\Cache;
use Doctrine\DBAL\Configuration;
use Doctrine\ORM\Tools\Setup;

class DBConfiguration {
	public $configs;

	public function __construct(array $configs) {
		if (!$this->validDBConfigurationArray($configs)) {
			throw DBException::configurationmistake();
		}

		$configs = Setup::createAnnotationMetadataConfiguration($configs['path'], $configs['dev']);

		$this->setConfigs($configs);

		return $this;
	}

	private function validDBConfigurationArray(array $array) {
		$params = ['path', 'dev'];

		$valid = false;

		foreach ($params as $param) {
			if (!array_key_exists($param, $array)) { return false; }
		}

		switch (true) {
			case (is_array($array['path'])): $valid = true; break;
			case (is_bool($array['dev'])): $valid = true; break;
			default: $valid = false; break;
		}

		return $valid;
	}

	public function setConfigs($configs) {
		$this->configs = $configs;
	}


	public function getConfigs() {
		return $this->configs;
	}
}