<?php


use yii\helpers\ArrayHelper;

use portalium\theme\Theme;
use portalium\theme\Module;
use portalium\theme\helpers\Html;
use portalium\site\models\Setting;
use portalium\site\widgets\Brand;
use portalium\site\widgets\FlashMessage;
use portalium\theme\widgets\NavBar;
use portalium\theme\bundles\AppAsset;
use portalium\theme\widgets\Breadcrumbs;
use portalium\menu\widgets\Nav;
use portalium\menu\models\Menu;
use portalium\theme\bundles\IconAsset;
use portalium\widgets\Pjax;

Theme::registerAppAsset($this);
Theme::registerMainAsset($this);
IconAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/*" href="<?= $this->getAssetManager()->getBundle(IconAsset::class)->baseUrl ?>/favicon.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->setting->getValue('app::title') . ' - ' . Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <?php
    $assetUrl = $this->getAssetManager()->getBundle(IconAsset::class)->baseUrl;
    $this->registerJs("
            var assetUrl = '$assetUrl';
        ");
    ?>

    <div id="main" class="min-vh-100 d-flex flex-column ms-0 max-width-wrapper">
        <?= $this->render(
            '_header.php'
        ) ?>
        <div class="content">
            <div class="cover">
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
        </div>
        <footer class="footer">
            <div class="cover">
                <p class="pull-left px-3">&copy; <?= date("Y") ?> </p>
                <p class="pull-right px-3">DigiNova</p>
            </div>
        </footer>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>