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


use Cilaster\API\Html\DOM\TableCreator\Table;
use Cilaster\API\View;

class ApplicationView extends View {

	public function renderValidationTable(array $data) {
		$table = new Table([
			'table' => 'table table-sm',
			'thead' => [
				'thead.thead-default',
				'columns' => [
					'th#str' => '#',
					'th#requires' => 'Требование',
					'th#status.text-right' => 'Статус',
					'th#value' => 'Значение',
				],
			],
			'tbody' => [
				'tbody#server-validation-result',
				'columns' => [
					'td.str',
					'td.reques',
					'td.status.text-right',
					'td.value',
				],
				'callbacks' => [
					'row' => function($data) {
						return ' class="'.(($data[2] || $data[2] == true)?'active':'disabled').'"';
					},
					'columns' => [
						null, null, function($data) {
							return ($data || $data == 1)?'<b class="text-success">Да</b>':'<b class="text-danger">Нет</b>';
						}, null
					]
				]
			],
			'tfoot' => false
		]);

		$table->create($data)->render();
	}
	
}