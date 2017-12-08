<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 22.08.2017
 * @Time: 13:25
 *
 * @documentation:
 */

namespace Cilaster\API\I18n;


class Phrases {
	public $locale;

	public function __construct($locale) {
		$this->setLocale($locale);

		return $this;
	}

	/**
	 * @param mixed $locale
	 */
	public function setLocale($locale) {
		$this->locale = $locale;
	}

	/**
	 * @return mixed
	 */
	public function getLocale() {
		return $this->locale;
	}

	public function getText($phrase_id) {
		$text = $this->searchId($phrase_id);

		return $text;
	}

	public function searchId( $phrases_id ) {
		$locale_folder = I18N_ROOT;
		$ids_array = parse_ini_file($locale_folder.'\\'.$this->getLocale().'.ini');

		if ($ids_array[$phrases_id]) {
			return $ids_array[$phrases_id];
		}

		return $phrases_id;
	}
}