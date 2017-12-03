<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 19.08.2017
 * @Time: 20:21
 *
 * @documentation: 
 */

namespace Cilaster\MVC\Application;


use Cilaster\API\AuthManager\Identity;
use Cilaster\API\AuthManager\Registration;
use Cilaster\API\Controller;
use Cilaster\API\I18n\Language;
use Cilaster\API\I18n\Phrases;
use Cilaster\Core\Constant;
use Cilaster\API\Request\PostRequest;

class ApplicationController extends Controller
{
	public function indexAction() {
		$view = new ApplicationView();
		$identity = $this->getIdentity();

		return $view->render('index', []);
	}

	/**
	 * @function: installAction
	 *
	 * @documentation: Action страницы установки CMS.
	 * Можно использовать, как аналог для страниц, где нужна пошаговость действий...
	 * К примеру, страница регистрации. Бинго!
	 *
	 */
	public function installAction() {
		$model = new ApplicationModel();
		$view = new ApplicationView();
		$language = new Language();
		$request = new PostRequest();
		$p = new Phrases($language->getUserLocale());
		$identity = new Identity();

		if ($_GET['product'] == 'cilaster' && !IS_INSTALLED) {
			switch ($_GET['step']) {
				case '1':
					if ($_COOKIE['step2'] && $_GET['step'] != 1) {
						$model->redirect($view->url('/install.php', [
							'product' => 'cilaster',
							'step' => 2,
						]));
					}

					$step = $p->getText('step1');
					$description = $p->getText('description1');
					$table = $model->validServer();
					break;
				case '2':
					if ($_COOKIE['step3'] && $_GET['step'] != 2) {
						$model->redirect($view->url('/install.php', [
							'product' => 'cilaster',
							'step' => 3,
						]));
					}

					$step = $p->getText('step2');
					$description = sprintf($p->getText('description2'), '#' );
					$form = 'install_forms\step-2';

					if ($request->isPost()) {
						$content = $request->content();

						# Сохранение файла конфигураций с данными о подключении к БД
						$settings = [
							'host' => $content->get('host'),
							'port' => $content->get('port'),
							'database' => $content->get('database'),
							'db-type' => $content->get('db-type'),
							'charset' => $content->get('charset'),
							'user' => $content->get('user'),
							'password' => $content->get('password'),
						];

						$model->saveDBSettings( $settings );
					}
					break;
				case '3';
					if ($_COOKIE['step4'] && $_GET['step'] != 3) {
						$model->redirect($view->url('/install.php', [
							'product' => 'cilaster',
							'step' => 4,
						]));
					}

					$step = $p->getText('step3');
					$description = $p->getText('description3');
					$form = 'install_forms\step-3';

					break;
				case 'install-tables';
					if ($model->createCMSTables()) {
						setcookie ("step4", "true",time()+172800);

						$model->redirect($view->url('/install.php', [
							'product' => 'cilaster',
							'step' => 4,
						]));
					}
					break;
				case '4':
					if ($_COOKIE['step5'] && $_GET['step'] != 4) {
						$model->redirect($view->url('/install.php', [
							'product' => 'cilaster',
							'step' => 5,
						]));
					}

					$step = $p->getText('step4');
					$description = $p->getText('description4');
					$form_php = 'install_forms\step-4';

					if ($request->isPost()) {
						$connect = $request->content();
						
						$settings = [
							"host" => $connect->get('site-host'),
							"title" => $connect->get('site-title'),
						    "is-adaptive" => ($connect->get('site-is-adaptive') == 'on')?true:false,
							"description" => $connect->get('site-description'),
							"keywords" => $connect->get('site-keywords'),
							"theme" => "default",
							"language" => $connect->get('site-language'),
						];
						$upload_file = Constant::MAIN_ROOT .'\\'. basename($_FILES['site-logotype']['name']);

						if ($model->fillSettings( $settings )) {
							if (!file_exists( $upload_file )) move_uploaded_file($_FILES['site-logotype']['tmp_name'], $upload_file);

							setcookie ("step5", "true", time()+172800);

							$model->redirect($view->url('/install.php', [
								'product' => 'cilaster',
								'step' => 5,
							]));
						}
					}
					break;
				case '5':
					if ($_COOKIE['step6'] && $_GET['step'] != 5) {
						$model->redirect($view->url('/install.php', [
							'product' => 'cilaster',
							'step' => 6,
						]));
					}

					$step = $p->getText('step5');
					$description = $p->getText('description5');
					$form_php = 'install_forms\step-5';

					if ($request->isPost()) {
						$content = $request->content();
						$registration = new Registration();

						if ($model->emailValid($content->get('email')) &&
						    $model->passwordValid($content->get('password'))
						) {
							$email = $model->emailValid($content->get('email'));
							$password = $model->passwordValid($content->get('password'));

							$user = [
								'login' => $content->get('login'),
								'password' => $model->passwordEncoder( $password, $email ),
								'email' => $email,
								'first-name' => $content->get('first-name'),
								'second-mane' => $content->get('second-name'),
							];

							if ($registration->go( $user, 4 )) {
								$model->redirect($view->url('/install.php', [
									'product' => 'cilaster',
									'step' => 6,
								]));
							}
						} else {
							$model->redirect($view->url($_SERVER['HTTP_REFERER'], [
								'error_type' => '4',
								'error' => 'Неверный пароль или E-mail адрес.'
							]));
						}
					}
					break;
				case '6':
					if ($model->installFinish()) {
						$model->redirect($view->url('/'));
					}
					break;
				default:
					$model->redirect($view->url('/install.php', [
						'product' => 'cilaster',
						'step' => 1,
					]));
					break;
			}
		} elseif ($identity->isIdentity() &&
		          $identity->getUser()->user_group == 4
		) { if ($_GET['product']) {
			switch ($_GET['product']) {
				case 'module':

					break;
				default:
					$step = 'NOT FOUND';
					break;
			}
		} else {
			$description = 'Выбирите, что желаете установить и загрузите файл.';
			$is_main = true;
		} } else {
			$model->redirect($view->url('/'));
		}

		return $view->render('install', [
			'step' => $step,
			'description' => $description,
			'table' => $table,
			'form' => $form,
			'form_php' => $form_php,
			'product' => $_GET['product'],
			'query_step' => $_GET['step'],
			'is_main' => $is_main,
		]);
	}

	public function updateAction() {
		// Проверка на взломщика
	}
}