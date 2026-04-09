<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Справочник пациентов';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <?= Html::a('<i class="bi bi-plus-lg me-1"></i>Добавить пациента', ['create'], ['class' => 'btn btn-primary-custom']) ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-bordered table-striped mb-0'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        ['label' => 'ФИО', 'value' => function ($model) { return Html::encode($model->getFullName()); }, 'format' => 'raw'],
        'inn',
        'birth_date:date',
        ['attribute' => 'type_person_document_id', 'value' => 'typePersonDocument.name', 'label' => 'Тип документа'],
        'phone',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => fn($url, $model) => Html::a('<i class="bi bi-eye"></i>', $url, ['class' => 'text-primary', 'title' => 'Просмотр']),
                'update' => fn($url, $model) => Html::a('<i class="bi bi-pencil"></i>', $url, ['class' => 'text-warning', 'title' => 'Редактировать']),
                'delete' => fn($url, $model) => Html::a('<i class="bi bi-trash"></i>', $url, ['class' => 'text-danger', 'data-method' => 'post', 'data-confirm' => 'Удалить пациента?']),
            ],
        ],
    ],
]); ?>