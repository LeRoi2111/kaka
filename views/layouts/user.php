<?php

use app\assets\AppAsset;
use app\models\Auth;
use app\widgets\Alert;
use yii\bootstrap5\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column justify-content-between min-vh-100">
    <?php $this->beginBody() ?>
    <?= $this->render('/html/header') ?>
    <?= Alert::widget() ?>
    <div class="container flex-grow-1">
        <div class="row pt-3">
            <div class="col-12 col-lg-3">
                <ul class="list-group list-group-flush fs-6">
                    <li class="list-group-item">
                        <a href="/user/home/info" class="text-decoration-none">
                            Моя информация
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/cart" class="text-decoration-none">
                            Корзина заказов
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="/user/home/orders" class="text-decoration-none">
                            Мои заказы
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-9">
                <?= $content ?>
            </div>
        </div>
    </div>
    <?= $this->render('/html/footer') ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>