<!DOCTYPE html>
<html xml:lang="ru" lang="ru">
	<head>
		<title><?php echo $this->getTitle(); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<!-- head::icon -->
		<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link href="/favicon.ico" rel="icon" type="image/x-icon" />

		<!-- head::css -->
		<link rel="stylesheet" href="<?=$this->basePath('css/install.css')?>" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?=$this->basePath('_plugins/image-crop/css/imgareaselect-default.css')?>" />

        <!-- head::js -->
		<script type="text/javascript" src="<?=$this->basePath('js/jquery.min.js')?>" ></script>
		<script type="text/javascript" src="<?=$this->basePath('js/popper.min.js')?>" ></script>
		<script type="text/javascript" src="<?=$this->basePath('_bootstrap/js/_bootstrap.min.js')?>" ></script>
		<script type="text/javascript" src="<?=$this->basePath('js/jquery.cookie.js')?>" ></script>
		<script type="text/javascript" src="<?=$this->basePath('_plugins/image-crop/scripts/jquery.imgareaselect.pack.js')?>"></script>

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