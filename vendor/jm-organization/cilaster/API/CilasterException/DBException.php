<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 26.08.2017
 * @Time: 23:46
 *
 * @documentation:
 */

namespace Cilaster\API\CilasterException;


class DBException extends \Exception {

	public static function configurationmistake() {
		return new self("Undefined settings");
	}

}