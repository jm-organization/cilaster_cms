<?php
require_once __DIR__ . '\..\..\vendor\cilaster\MVC\Application\ApplicationView.php';

use MVC\Application\ApplicationView;

$view = new ApplicationView();
?>

<form enctype="multipart/form-data" action="<?=$view->url('/install.php', [
		'product' => $_GET['product'],
		'step' => $_GET['step']
	])?>" method="post">
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="login-input" class="col-form-label">Логин</label>
			<input type="text" required class="form-control" name="login" id="login-input" placeholder="Введите желаемый логин.">
			<small id="login-help" class="form-text text-muted">Будет отображаться на сайте.</small>
		</div>

		<div class="form-group col-md-6">
			<label for="password-input" class="col-form-label">Пароль</label>
			<input type="password" required class="form-control" name="password" id="password-input" placeholder="Ваш пароль">
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-12">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Имя" name="first-name">
				<input type="text" class="form-control" placeholder="Фамилия" name="second-name">
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-12">
			<label for="email-input" class="col-form-label">Почтовый ящик, E-mail</label>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">@</span>
				<input type="email" required id="email-input" class="form-control" placeholder="Введите ваш эллектронный ящик" name="email">
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>