<?php
/**
 * Created in JM Organization.
 *
 * @e-mail: admin@jm-org.net
 * @Author: Magicmen
 *
 * @Date: 06.12.2017
 * @Time: 21:56
 *
 * @Documentation:
 */

namespace Cilaster\API\CilasterException;


use Cilaster\Core\Constant;
use Cilaster\Core\Router;

class ExceptionGenerator {
	public $exception;

	public $view_root;

	public function __construct(\Exception $exception) {
		$this->exception = $exception;
		$this->view_root = Constant::THEMES_ROOT;
	}

	public function get() {
		$exception_view_file = $this->view_root."/_exceptions/view.phtml";

		$exception = (object)[
			'message' => $this->exception->getMessage(),
			'previous' => $this->exception->getPrevious(),
			'code' => $this->exception->getCode(),
			'file' => $this->exception->getFile(),
			'line' => $this->exception->getLine(),
			'trace' => $this->exception->getTrace(),
			'stringtrace' => $this->exception->getTraceAsString(),
		];

		ob_start();
		include $exception_view_file;

		return ob_get_clean();
	}

	public function render() {
		echo $this->get();
	}
}