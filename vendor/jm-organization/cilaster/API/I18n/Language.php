<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 22.08.2017
 * @Time: 12:30
 *
 * @documentation:
 */

namespace Cilaster\API\I18n;


use Cilaster\Core\Config;

class Language {
	public $default_locale;

	public $user_locale;

	/**
	 * Language constructor.
	 */
	public function __construct() {
		$config_locale = (new Config('application/i18n'))->get('locale');
		$dlfc = (isset($config_locale))?$config_locale:'en-US';

		$this->setDefaultLocale($dlfc);
		$this->setUserLocale(locale_get_default());

		return $this;
	}

	/**
	 * @function: setDefaultLocale
	 *
	 * @documentation:
	 *
	 * @param $default_locale
	 */
	public function setDefaultLocale($default_locale) {
		$this->default_locale = $default_locale;
	}

	/**
	 * @function: getDefaultLocale
	 *
	 * @documentation:
	 *
	 * @return mixed
	 */
	public function getDefaultLocale() {
		return $this->default_locale;
	}

	/**
	 * @function: setUserLocale
	 *
	 * @documentation:
	 *
	 * @param $user_locale
	 */
	public function setUserLocale($user_locale) {
		$this->user_locale = $user_locale;
	}

	/**
	 * @function: getUserLocale
	 *
	 * @documentation:
	 *
	 * @return mixed
	 */
	public function getUserLocale() {
		return $this->user_locale;
	}
}