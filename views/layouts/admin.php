<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset]);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?= $this->render('/partials/header') ?>
</header>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-white border-end vh-100 position-sticky top-0 pt-3 overflow-auto">
            <?= $this->render('/partials/sidebar_admin') ?>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <?= $this->render('/partials/flashes') ?>
            <?= $content ?>
        </main>
    </div>
</div>

<footer class="footer-custom mt-auto">
    <div class="container text-center">
        <span>&copy; <?= date('Y') ?> Система подготовки справок КНД 11511. Административная панель.</span>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>