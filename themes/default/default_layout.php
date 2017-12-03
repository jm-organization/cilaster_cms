<!DOCTYPE html>
<html xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $this->getTitle(); ?></title>

        <?php if ($this->isViewPort()) {?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php } ?>

        <!-- head::icon -->
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="/favicon.ico" rel="icon" type="image/x-icon" />

        <!-- head::css -->
        <link rel="stylesheet" href="<?=$this->basePath('css/application.css')?>" />
        <link rel="stylesheet" href="<?=$this->basePath('bootstrap/css/bootstrap.css')?>" />
        <link rel="stylesheet" href="<?=$this->basePath('plugins/cilaster-icons/css/fontello-icons.css')?>" />
        <link rel="stylesheet" href="<?=$this->basePath('css/admin.css')?>" />

        <!-- head::js -->
        <script type="application/javascript" src="<?=$this->basePath('js/jquery.min.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('js/popper.min.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('bootstrap/js/bootstrap.min.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('plugins/magics-addons/jm_tags.js')?>" ></script>
        <script type="application/javascript" src="<?=$this->basePath('js/c_server_error.js')?>" ></script>
    </head>
    <body>
        <?php //echo $this->adminBar(); ?>

        <header<?php if ($this->currentRoute() &&
                         $this->currentRoute() != 'index' &&
                         $this->currentRoute(0) != 'auth'
        ) { ?>
            class="short-header"
        <?php } ?>>
            <div class="container">
                <?php echo $this->navBar([
                    'logotype' => true,
                    'nav-class' => 'short-right-menu',
                    'links' => [
                        'Контакты' => '#',
                        'Новости' => '#',
                        'О нас' => '#',
                    ],
                ]); ?>

                <div class="description">
                    <h2><?php echo $this->getShortTitle(); ?></h2>
                </div>
            </div>

            <svg version="1.1" width="100%" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 xml:space="preserve" viewBox="0 0 100 100" preserveAspectRatio="none" class="gradient">
                <polygon fill="#FFFFFF" points="0,100 0,40 50,0 100,25 100,100"></polygon>
            </svg>
        </header>

        <section>
            <div class="container">
                <?php echo $content ?>
            </div>
        </section>

        <footer class="fixed-bottom">
            <div class="container">
                <p class="text-center align-middle">CMS Cilaster • 2017 • by <span class="text-uppercase">JM Organization</span></p>
            </div>
        </footer>
    </body>
</html>