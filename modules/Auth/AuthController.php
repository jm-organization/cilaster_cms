<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 31.08.2017
 * @Time: 14:02
 *
 * @documentation:
 */

namespace Module\Auth;


use Cilaster\API\AuthManager\Auth;
use Cilaster\API\AuthManager\Registration;
use Cilaster\API\Controller;
use Cilaster\API\Request\PostRequest;

class AuthController extends Controller{

	public function loginAction() {
		$model = new AuthModel();
		$view = new AuthView();
		$request = new PostRequest();
		$identity = $this->getIdentity();

		if (!$identity->isIdentity()) {
			if ( $request->isPost() ) {
				$content = $request->content();
				$auth    = new Auth();

				$user = [
					'login' => $content->get( 'login' ),
					'password' => $content->get( 'password' ),
				];

				if ( !$auth->login($user) ) {
					$model->redirect( $view->url( $_SERVER['HTTP_REFERER'], [
						'error_type' => '6',
						'error' => 'Неверное имя или пароль.'
					] ) );
				} else {
					$model->redirect($view->url('/'));
				}
			}
		} else {
			$model->redirect($view->url('/'));
		}

		return $view->render('login');
	}

	public function registrationAction() {
		$model = new AuthModel();
		$view = new AuthView();
		$request = new PostRequest();

		if ($request->isPost()) {
			$content = $request->content();
			$registration = new Registration();

			if ($model->emailValid($content->get('email')) &&
			    $model->passwordValid($content->get('password'))
			) {
				$email = $model->emailValid($content->get('email'));
				$password = $model->passwordValid($content->get('password'));
				$password = $model->passwordEncoder( $password, $email );

				$user = [
					'login' => $content->get('login'),
					'password' => ($password)?$password:null,
					'email' => $email,
					'first-name' => $content->get('first-name'),
					'second-mane' => $content->get('second-name'),
				];

				if ($registration->go( $user, 2 )) {
					$model->redirect($view->url('/auth/login/'));
				} else {
					$model->redirect($view->url($_SERVER['HTTP_REFERER'], [
						'error_type' => '5',
						'error' => 'Данное имя пользователя уже занято.'
					]));
				}
			} else {
				$model->redirect($view->url($_SERVER['HTTP_REFERER'], [
					'error_type' => '4',
					'error' => 'Неверный пароль или E-mail адрес.'
				]));
			}
		}

		return $view->render('registration');
	}
}