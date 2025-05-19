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

Theme::registerAppAsset($this);
Theme::registerMainAsset($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/*" href="<?= $this->getAssetManager()->getBundle(\portalium\theme\bundles\IconAsset::class)->baseUrl ?>/favicon.ico">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="main" class="min-vh-100 d-flex flex-column ms-0 max-width-wrapper">
    <?= $this->render(
        '_header.php'
    ) ?>
    <div class="content">
        <div class="cover">
            <?= FlashMessage::widget() ?>
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
