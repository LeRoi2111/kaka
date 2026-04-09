<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = 'Услуга: ' . $model->name;
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <div>
        <?= Html::a('<i class="bi bi-pencil me-1"></i>Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="bi bi-trash me-1"></i>Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger ms-2', 'data-method' => 'post', 'data-confirm' => 'Удалить?']) ?>
    </div>
</div>
<div class="card card-custom">
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model, 'attributes' => ['id', 'code', 'name', 'description'],
            'options' => ['class' => 'table table-bordered mb-0'],
        ]) ?>
    </div>
</div>