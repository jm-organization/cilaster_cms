<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 26.08.2017
 * @Time: 23:46
 *
 * @documentation:
 */

namespace Cilaster\API\CilasterException;


class DBException extends \Exception {

	public function __construct( $message = '', $toRoute = '' ) {
		try {
			throw new \Exception($message);
		} catch (\Exception $e) {
			echo '<div class="card bg-light mb-3">
                    <div class="card-body">
                        <h4 class="card-title text-danger">Ошибка</h4>
                        <p class="card-text">'.$e->getMessage().'</p>
                    </div>
                    <div class="card-footer text-muted">
                        <p>В файле: '.$e->getFile().'. На строке: '.$e->getLine().'</p>
                    </div>
                  </div>';
		}
	}
	
}