<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Patient $model */

$this->title = 'Пациент: ' . $model->getFullName();
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <div>
        <?= Html::a('<i class="bi bi-pencil me-1"></i>Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="bi bi-trash me-1"></i>Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger ms-2', 'data-method' => 'post', 'data-confirm' => 'Удалить пациента?']) ?>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'last_name',
                'first_name',
                'middle_name',
                'birth_date:date',
                'inn',
                ['attribute' => 'type_person_document_id', 'value' => $model->typePersonDocument->name ?? '—'],
                'document_series_number',
                'document_issued_by',
                'document_issue_date:date',
                'address',
                'phone',
                'email:email',
            ],
            'options' => ['class' => 'table table-bordered mb-0'],
        ]) ?>
    </div>
</div>