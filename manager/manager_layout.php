<?php
/**
 * @Created in JM Organization.
 * @Author: Magicmen
 *
 * @Date: 19.08.2017
 * @Time: 16:05
 *
 * @documentation: Шаблон вида установки плагина/CMS.
 */

require_once __DIR__ . '\..\vendor\cilaster\API\View.php';

use Cilaster\API\View;

$app = new View();

?>

<!DOCTYPE html>
<html xml:lang="ru" lang="ru">
	<head>
		<title><?php echo $app->getTitle(); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<!-- head::icon -->
		<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link href="/favicon.ico" rel="icon" type="image/x-icon" />

		<!-- head::css -->
		<link rel="stylesheet" href="<?=$app->basePath('css/install.css')?>" />
		<link rel="stylesheet" href="<?=$app->basePath('bootstrap/css/bootstrap.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?=$app->basePath('plugins/image-crop/css/imgareaselect-default.css')?>" />


		<!-- head::js -->
		<script type="text/javascript" src="<?=$app->basePath('js/jquery.min.js')?>" ></script>
		<script type="text/javascript" src="<?=$app->basePath('js/popper.min.js')?>" ></script>
		<script type="text/javascript" src="<?=$app->basePath('bootstrap/js/bootstrap.min.js')?>" ></script>
		<script type="text/javascript" src="<?=$app->basePath('js/jquery.cookie.js')?>" ></script>
		<script type="text/javascript" src="<?=$app->basePath('plugins/image-crop/scripts/jquery.imgareaselect.pack.js')?>"></script>
	</head>
	<body>

		<div class="install-container container">
			<?php echo $content; ?>
		</div>

		<footer class="fixed-bottom">
			<div class="container">
				<p class="text-center">CMS Cilaster • 2017 • by <span class="text-uppercase">JM Organization</span></p>
			</div>
		</footer>

	</body>
</html>