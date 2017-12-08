<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 * @Date: 16.08.2017
 * @Time: 23:09
 */

namespace Cilaster\Core;


use Cilaster\DB\Tables\TablesManager;

class Config {
	/**
	 * @var
	 */
	public $configs;

	/**
	 * @var array
	 */
	protected $buffer = [];

	/**
	 * @function: setConfigs
	 *
	 * @documentation:
	 *
	 * @param $configs
	 *
	 */
	public function setConfigs($configs) {
		$this->configs = $configs;
	}


	/**
	 * @function: getConfigs
	 *
	 * @documentation:
	 *
	 *
	 * @return mixed
	 */
	public function getConfigs() {
		return $this->configs;
	}

	/**
	 * Config constructor.
	 *
	 * @param string $root
	 *
	 *
	 * @documentation:
	 */
	public function __construct($root = 'application') {
		$root = preg_replace('/\.[a-z]*/', '', $root);
		$file = Constant::CONFIG_ROOT.'/'.$root.'.php';
		$file = str_replace('/', '\\', $file);

		if (!file_exists($file)) { $this->setConfigs([]); }
		$configs = require $file;

		$this->setConfigs($configs);

		return $this;
	}

	/**
	 * @function: get
	 *
	 * @documentation:
	 *
	 * @param null $params
	 *
	 * @return array|mixed
	 */
	public function get($params = null) {
		$this->buffer = $this->getConfigs();

		if (isset($params)) {
			$params = trim($params);
			$params_list = explode('/', $params);
			$params_count = count($params_list);

			for ($i=0; $i<$params_count; $i++) {
				if ($i == $params_count) { return $this->buffer[$params_list[$i]]; }

				$this->buffer = $this->buffer[$params_list[$i]];
			}
		}

		return $this->buffer;
	}
}