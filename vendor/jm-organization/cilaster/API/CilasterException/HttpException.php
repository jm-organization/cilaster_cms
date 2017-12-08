<?php
/**
 * Created in JM Organization.
 *
 * @e-mail: admin@jm-org.net
 * @Author: Magicmen
 *
 * @Date: 05.12.2017
 * @Time: 23:11
 *
 * @Documentation:
 */

namespace Cilaster\API\CilasterException;


class HttpException extends \Exception {
	public static function AcceptParameterMistake() {
		return new self("Unknown Accept parametr that was passed");
	}
}