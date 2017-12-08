<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 20.08.2017
 * @Time: 15:25
 *
 * @documentation:
 */

namespace Cilaster\MVC\Application;


use Cilaster\API\Html\TableCreator\Table;
use Cilaster\API\View;

class ApplicationView extends View {

	public function renderValidationTable(array $data) {
		$table = new Table([
			'table' => 'table table-sm',
			'thead' => [
				'thead.thead-default',
				'columns' => [
					'#str' => '#',
					'#reques' => 'Требование',
					'#status.text-right' => 'Статус',
					'#value' => 'Значение',
				],
			],
			'tbody' => [
				'tbody#server-validation-result',
				'columns' => ['.str', '.reques', '.status.text-right', '.value',],
			],
		]);

		$table->create($data)->render();
	}
	
}