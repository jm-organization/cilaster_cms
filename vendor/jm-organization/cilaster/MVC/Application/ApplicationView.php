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
			'table' => 'ui celled table',
			'thead' => [
				'thead',
				'columns' => [
					'th#str' => '#',
					'th#requires' => 'Требование',
					'th#status.ui.right.aligned' => 'Статус',
					'th#value' => 'Значение',
				],
			],
			'tbody' => [
				'tbody#server_validation_result',
				'columns' => [
					'td.str',
					'td.reques',
					'td.status.ui.right.aligned',
					'td.value',
				],
				'callbacks' => [
					'row' => function($data) {
						return ' data-active="'.(($data[2] || $data[2] == true)?'active':'disabled').'"';
					},
					'columns' => [
						null, null, function($data) {
							return ($data || $data == 1)?'<b class="ui green small header">Да</b>':'<b class="ui red small header">Нет</b>';
						}, null
					]
				]
			],
			'tfoot' => false
		]);

		$table->create($data)->render();
	}
	
}