<?php
/**
 * Created in JM Organization.
 *
 * @e-mail: admin@jm-org.net
 * @Author: Magicmen
 *
 * @Date: 05.12.2017
 * @Time: 22:52
 *
 * @Documentation:
 */

namespace Cilaster\API\Http;


use Cilaster\API\CilasterException\HttpException;

class Http {
	/**
	 * @function: getAccept
	 *
	 * @documentation:
	 * Возвращает содержимое заголовка Accept;
	 * Принимает значения
	 *
	 * @param bool $content
	 *
	 * @return mixed
	 * @throws HttpException
	 */
	public function getAccept($content = false) {
		if ($content) {
			if (array_key_exists('HTTP_ACCEPT_'.$content, $_SERVER)) {
				return $_SERVER['HTTP_ACCEPT_'.$content];
			}

			throw HttpException::AcceptParameterMistake();
		}

		return $_SERVER['HTTP_ACCEPT'];
	}

	/**
	 * @function: getConnection
	 *
	 * @documentation:
	 *
	 *
	 * @return mixed
	 */
	public function getConnection() {
		return $_SERVER['HTTP_CONNECTION'];
	}

	/**
	 * @function: getHost
	 *
	 * @documentation:
	 *
	 *
	 * @return mixed
	 */
	public function getHost() {
		return $_SERVER['HTTP_HOST'];
	}

	/**
	 * @function: getReffer
	 *
	 * @documentation:
	 *
	 *
	 * @return mixed
	 */
	public function getReffer() {
		return $_SERVER['HTTP_REFERER'];
	}

	/**
	 * @function: getUserAgent
	 *
	 * @documentation:
	 *
	 * @param null $user_agent
	 * @param bool $return_array
	 * @param bool $full_info
	 *
	 * @return mixed
	 */
	public function getUserAgent($user_agent = null, $return_array = false, $full_info = false) {
		if ($full_info) { return get_browser($user_agent, $return_array); }

		return $_SERVER['HTTP_USER_AGENT'];
	}

	/**
	 * @function: isSecured
	 *
	 * @documentation:
	 *
	 *
	 * @return bool
	 */
	public function isSecured() {
		if (isset($_SERVER['HTTPS'])) { return true; }
		
		return false;
	}
}