<?php
/**
 * Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 05.12.2017
 * @Time: 22:05
 *
 * @Documentation:
 * 	Класс для получения информации исключительно о сервере.
 * Для получение другой информации с переменной $_SERVER,
 * обратитесь к другим методам.
 */

namespace Cilaster\API\Http;


class Server {

	public static function getCgi() {
		return $_SERVER['GATEWAY_INTERFACE'];
	}

	public static function getIp() {
		return $_SERVER['SERVER_ADDR'];
	}

	public static function getName() {
		return $_SERVER['SERVER_NAME'];
	}

	public static function getSoft() {
		return $_SERVER['SERVER_SOFTWARE'];
	}

	public static function getProtocol() {
		return $_SERVER['SERVER_PROTOCOL'];
	}

}