<?php 
use portalium\site\widgets\Brand; 
use portalium\menu\widgets\Nav;
?>
<div class='header w-100'>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" id='navbar'>
        <div class="container-fluid justify-content-end cover">
            <a class="m-auto logo mobile-logo logo-login" href="<?= Yii::$app->homeUrl ?>">
                <?= Brand::widget([
                    'img' => Yii::$app->setting->getValue('app::logo_wide'),
                    "options" => ["height" => "30px"],
                    "title" => true,
                ]) ?>
            </a>
            <button class="btn btn-dark d-flex d-lg-none ml-auto fixed-menu-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-align-justify"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto list-padding">
                    <?= Nav::widget([
                        "id" => Yii::$app->setting->getValue("theme::menu_main"),
                        "options" => [
                            "class" => "nav nav-pills flex-shrink-0 dropdown mobile-column direction",
                        ],
                    ]) ?>
                </ul>
            </div>
        </div>
    </nav>
</div>