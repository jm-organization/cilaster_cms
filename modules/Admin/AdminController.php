<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 31.08.2017
 * @Time: 19:26
 *
 * @documentation:
 */

namespace Module\Admin;


use Cilaster\API\Controller;

class AdminController extends Controller{

	public $view;

	/**
	 * @param mixed $view
	 */
	public function setView( $view ) {
		$this->view = $view;
	}

	/**
	 * @return mixed
	 */
	public function getView() {
		return $this->view;
	}

	/**
	 * AdminController constructor.
	 */
	public function __construct() {
		$this->setView( new AdminView() );
	}

	public function adminAction() {
		// some action

		return $this->getView()->render('admin', [
			// some variables
		], 'admin_uri_exist');
	}

}