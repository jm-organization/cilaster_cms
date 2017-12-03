<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 21.08.2017
 * @Time: 23:32
 *
 * @documentation:
 */

namespace Cilaster\API\CilasterException;


class CException extends \Exception
{
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