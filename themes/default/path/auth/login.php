<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 28.08.2017
 * @Time: 15:29
 *
 * @documentation:
 */

require_once __DIR__ . '\..\..\vendor\cilaster\MVC\Auth\AuthView.php';

use MVC\Auth\AuthView;

$view = new AuthView();
?>

<div class="auth-form">
	<form class="card" method="post" action="<?=$view->url('/auth/login/')?>">
		<div class="card-body">
			<h4 class="card-title">Вход</h4>
			<h6 class="card-subtitle mb-2 text-muted"><?=$view->getShortTitle()?></h6>
			<div class="card-text">
				<div class="form-group">
					<label for="login">Логин</label>
					<input type="text" class="form-control" name="login" id="login" aria-describedby="emailHelp" placeholder="Введите ваш логи...">
				</div>
				<div class="form-group">
					<label for="password">Пароль</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль...">
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="checkbox" class="form-check-input">
						Check me out
					</label>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
			<a href="#" class="card-link">Зарегистрироваться</a>
		</div>
	</form>
</div>
