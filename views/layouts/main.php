<?php
/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? 'Автоматизация подготовки справок КНД 11511']);

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

<main class="main-wrapper">
    <div class="container">
        <?= $this->render('/partials/flashes') ?>
        <?= $content ?>
    </div>
</main>

<footer>
    <?= $this->render('/partials/footer') ?>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>