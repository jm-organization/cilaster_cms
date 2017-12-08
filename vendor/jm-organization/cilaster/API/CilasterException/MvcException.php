<?php
/**
 * Created in JM Organization.
 *
 * @e-mail: admin@jm-org.net
 * @Author: Magicmen
 *
 * @Date: 06.12.2017
 * @Time: 0:02
 *
 * @Documentation:
 */

namespace Cilaster\API\CilasterException;


class MvcException extends \Exception {
	public static function UndefinedMethodInController($action, $controller) {
		return new self("Method $action() isn't found in $controller", ExceptionCodes::WARNING);
	}

	public static function UndefinedViewRoute($path, $app_controller_action) {
		return new self("Unknown viewpath $path for $app_controller_action", ExceptionCodes::FATAL);
	}

	public static function InsertedFileNotFound($path = '') {
		return new self("Insert file in path $path not found", ExceptionCodes::WARNING);
	}
}