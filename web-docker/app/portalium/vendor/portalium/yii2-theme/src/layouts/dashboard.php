<?php


use yii\helpers\ArrayHelper;

use portalium\theme\Theme;
use portalium\theme\helpers\Html;
use portalium\site\widgets\FlashMessage;
use portalium\theme\widgets\Breadcrumbs;
use portalium\site\widgets\Brand;
use portalium\menu\widgets\Nav;
use portalium\theme\bundles\IconAsset;
use yii\widgets\Pjax;

Theme::registerAppAsset($this);
IconAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Uğur YILDIZ, Portalium Contributors">
    <link rel="icon" type="image/*" href="<?= $this->getAssetManager()->getBundle(IconAsset::class)->baseUrl ?>/favicon.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->setting->getValue('app::title') . ' - ' . Html::encode($this->title) ?></title>
    <?php $this->head(); ?>

</head>

<body>
    <?php $this->beginBody(); ?>
    <?php
    $assetUrl = $this->getAssetManager()->getBundle(IconAsset::class)->baseUrl;
    $this->registerJs("
            var assetUrl = '$assetUrl';
        ");
    ?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="bg-dark <?= Yii::$app->deviceDetector->getClass() ?>">
            <div class="sidebar-header bg-dark">
                <a class='logo' href="<?= Yii::$app->homeUrl ?>">
                    <?= Brand::widget([
                        'img' => Yii::$app->setting->getValue('app::logo_wide'),
                        "options" => ["height" => "30px"],
                        "title" => true,
                    ]) ?>
                </a>
                <button type="button" id="sidebar-collapse-desktop" class="btn btn-dark">
                    <i class="fa fa-align-justify"></i>
                </button>
                <a href="<?= Yii::$app->homeUrl ?>" class="sidebar-collapse-icon">
                    <?php
                    $logo_square = Yii::$app->setting->getValue('app::logo_square');
                    if (isset($logo_square['name'])) {
                        echo Brand::widget([
                            'img' => $logo_square,
                            "options" => ["height" => "30px"],
                            "title" => true,
                        ]);
                    } else {
                        echo substr(Yii::$app->setting->getValue('app::title'), 0, 1);
                    }
                    ?>
                </a>
            </div>
            <ul class="list-unstyled components" closed-display-style="<?= Yii::$app->setting->getValue("theme::menu_closed") ?>">
                <?= Nav::widget([
                    "id" => Yii::$app->setting->getValue("theme::menu_side"),
                    "options" => ["class" => "nav nav-pills flex-column"],
                ]) ?>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="main" class="min-vh-100 d-flex flex-column <?= Yii::$app->deviceDetector->getClass() ?>">
            <div class='header'>
                <nav class="navbar navbar-expand-lg navbar-light bg-dark" id='navbar'>
                    <div class="container-fluid justify-content-end">
                        <button type="button" id="sidebar-collapse-mobile" class="btn btn-dark mobile-show">
                            <i class="fa fa-align-justify"></i>
                        </button>
                        <div class="title-desktop"><?= Html::encode(
                                                        $this->title
                                                    ) ?></div>
                        <a class="m-auto logo mobile-logo" href="<?= Yii
                                                                        ::$app->homeUrl ?>">
                            <?= Brand::widget([
                                'img' => Yii::$app->setting->getValue('app::logo_wide'),
                                "options" => ["height" => "30px"],
                                "title" => true,
                            ]) ?>
                        </a>
                        <button class="btn btn-dark d-flex d-lg-none ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-align-justify"></i>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto list-padding">
                                <?= Nav::widget([
                                    "id" => Yii::$app->setting->getValue(
                                        "theme::menu_main"
                                    ),
                                    "options" => [
                                        "class" =>
                                        "nav nav-pills flex-shrink-0 dropdown mobile-column direction",
                                    ], 
                                ]) ?>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="title-mobile bg-dark"><?= Html::encode(
                                                        $this->title
                                                    ) ?></div>
            </div>
            <div class="content" style=" height: calc(100%);">
                <nav class='bread' style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <?= Breadcrumbs::widget([
                        "links" => !empty($this->params["breadcrumbs"])
                            ? $this->params["breadcrumbs"]
                            : [],
                    ]) ?>
                </nav>
                <?php
                Pjax::begin([
                    'id' => 'pjax-flash-message',
                    'timeout' => 30000
                ]);
                ?>
                <?= FlashMessage::widget() ?>
                <?php
                Pjax::end();
                ?>
                <?= $content ?>
            </div>
            <footer class="footer">
                <p class="pull-left px-3">&copy; <?= date("Y") ?> </p>
                <p class="pull-right px-3">DigiNova</p>
            </footer>
        </div>
    </div>
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>