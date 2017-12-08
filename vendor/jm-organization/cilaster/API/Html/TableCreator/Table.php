<?php
/**
 * Created in JM Organization.
 *
 * @e-mail: admin@jm-org.net
 * @Author: Magicmen
 *
 * @Date: 07.12.2017
 * @Time: 20:27
 *
 * @Documentation:
 */

namespace Cilaster\API\Html\TableCreator;


class Table {
	private $buffer;

	public $options;

	public function setOptions($options) {
		$this->options = $options;
	}

	public function getBuffer() {
		return $this->buffer;
	}

	public function __construct(array $options) {
		$this->setOptions($options);
	}

	public function create(array $data) {
		$table_class = ($this->getElementClass($data['table']))?'class="'.$this->getElementClass($data['table']).'"':'class="table"';
		$table_id = ($this->getElementId($data['table']))?'id="'.$this->getElementId($data['table']).'"':'';

		ob_start();
		echo "<table$table_id $table_class>";
		echo '</table>';
		$this->buffer = ob_end_clean();

		return $this;
	}

	public function render() {
		echo $this->buffer;
	}

	private function getElementClass($element) {
		preg_match("/^(\.[a-zA-Z_-0-9]*)$/", $element, $class);

		return implode(' ', $class);
	}

	private function getElementId($element) {
		preg_match("/^(\#[a-zA-Z_0-9]*)$/", $element, $id);

		return $id[0];
	}

	private function getElementName($element) {
		preg_match("/^(table|thead|tbody|tr|td|th){1}$/", $element, $name);

		return $name[0];
	}
}