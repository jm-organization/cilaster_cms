<?php
require_once __DIR__ . '\..\..\vendor\cilaster\API\View.php';

use API\View;

$app = new View();
?>

<form enctype="multipart/form-data" method="post" action="<?=$app->url('/install.php', [
    'product' => $_GET['product'],
    'step' => $_GET['step']
])?>">
    <div class="form-group row">
        <label for="site-host" class="col-sm-4 col-form-label">Адерс сайта:</label>
        <div class="col-sm-6">
            <input type="text" name="site-host" style="width:100%;" required readonly class="form-control-plaintext" id="site-host" value="<?=$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/"?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="site-title" class="col-sm-4 col-form-label">Название сайта:</label>
        <div class="col-sm-6">
            <input type="text" required name="site-title" class="form-control" id="site-title">
        </div>
    </div>

    <div class="form-group row">
        <label for="site-logotype" class="col-sm-4 col-form-label">Логотип:</label>
        <div class="col-sm-6">
            <input type="file" name="site-logotype" class="form-control-file" id="site-logotype">
        </div>
    </div>

    <div class="form-group row">
        <label for="site-language" class="col-sm-4 col-form-label">Язык сайта:</label>
        <div class="col-sm-6">
            <select class="form-control custom-select" name="site-language" id="site-language">
                <option selected>Выбирите язык сайта</option>
                <option value="ru_RU">Русский</option>
                <option value="ua_UA">Українська</option>
                <option value="en_EN">English</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 col-form-label">Адоптация под мобильные устройства:</div>
        <div class="col-sm-6">
            <span>Вкл.</span>
            <label class="custom-switch" id="custom-switch">
                <span class="rail bg-secondary"></span>
                <span class="caret bg-primary"></span>
                <input type="checkbox" name="site-is-adaptive" class="form-check-input">
            </label>
            <span>Выкл.</span>
            <script type="application/javascript">
                $(document).ready(function () {
                    $('#custom-switch').on('change', 'input[type="checkbox"]', function () {
                        $('.caret').toggleClass('input-change');
                        $('.rail').toggleClass('bg-info');

                        console.log('test');
                    });
                    $('#reset').click(function () {
                        $('.caret').removeClass('input-change');
                        $('.rail').removeClass('bg-info');
                    });
                });
            </script>
        </div>
    </div>

    <div class="form-group row">
        <label for="site-description" class="col-sm-4 col-form-label">Описание:</label>
        <div class="col-sm-6">
            <textarea class="form-control" name="site-description" id="site-description" rows="7"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="site-keywords" class="col-sm-4 col-form-label">Ключевые слова:</label>
        <div class="col-sm-6">
            <textarea class="form-control" name="site-keywords" id="site-keywords" rows="7"></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="site-logotype" class="col-sm-4 col-form-label"></label>
        <div class="col-sm-6 btn-group" role="group" aria-label="Basic example">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <button type="reset" id="reset" class="btn btn-outline-primary">Сбросить</button>
        </div>
    </div>
</form>