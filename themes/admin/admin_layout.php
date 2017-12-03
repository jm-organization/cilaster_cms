<!DOCTYPE html>
<html xml:lang="ru" lang="ru">
    <head>
        <title><?php echo $this->getTitle(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <?php if ($this->isViewPort()) {?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php } ?>

        <!-- head::icon -->
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="/favicon.ico" rel="icon" type="image/x-icon" />

        <!-- head::css -->
        <link rel="stylesheet" href="<?=$this->basePath('css/application.css')?>" />
        <link rel="stylesheet" href="<?=$this->basePath('bootstrap/css/bootstrap.css')?>" />
        <link rel="stylesheet" href="<?=$this->basePath('plugins/cilaster-icons/css/cilaster-icons-by-fontello.css')?>" />

        <!-- head::js -->
        <script type="application/javascript" src="<?=$this->basePath('js/jquery.min.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('js/popper.min.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('bootstrap/js/bootstrap.min.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('plugins/magics-addons/jm_tags.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('js/c_server_error.js')?>" ></script>
    </head>
    <body>
        <section>
            <?php echo $content ?>
        </section>

        <footer class="fixed-bottom">
            <div class="container">
                <p class="text-center align-middle">CMS Cilaster • 2017 • by <span class="text-uppercase">JM Organization</span></p>
            </div>
        </footer>
    </body>
</html>