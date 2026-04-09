<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = $name;
?>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card card-custom border-danger">
            <div class="card-body text-center py-5">
                <div class="display-1 text-danger mb-3">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h1 class="h3 mb-3"><?= Html::encode($name) ?></h1>
                <p class="text-secondary-custom mb-4"><?= Html::encode($message) ?></p>
                <p class="text-muted small mb-4">Если вы считаете, что это ошибка, пожалуйста, свяжитесь с администратором системы.</p>
                <?= Html::a('Вернуться на главную', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
    </div>
</div>