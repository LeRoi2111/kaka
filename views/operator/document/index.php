<?php
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Реестр документов';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <?= Html::a('<i class="bi bi-plus-lg me-1"></i>Создать документ', ['create'], ['class' => 'btn btn-primary-custom']) ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-bordered table-striped mb-0'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        ['label' => 'Пациент', 'value' => fn($m) => Html::encode($m->patient?->getFullName() ?? '—'), 'format' => 'raw'],
        ['label' => 'Организация', 'value' => fn($m) => Html::encode($m->organization?->name ?? '—'), 'format' => 'raw'],
        'document_number',
        'document_date:date',
        ['attribute' => 'total_amount', 'format' => ['currency', 'RUB']],
        [
            'attribute' => 'status',
            'value' => fn($m) => match($m->status) {
                'draft' => '<span class="badge bg-secondary">Черновик</span>',
                'issued' => '<span class="badge bg-success">Выдан</span>',
                'cancelled' => '<span class="badge bg-danger">Отменён</span>',
                default => $m->status,
            },
            'format' => 'raw',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {certificate}',
            'buttons' => [
                'view' => fn($url, $model) => Html::a(
                    '<i class="bi bi-eye"></i>',
                    $url,
                    ['class' => 'text-primary', 'title' => 'Просмотр карточки']
                ),
                'update' => fn($url, $model) => $model->status === 'issued'
                    ? ''
                    : Html::a('<i class="bi bi-pencil-square"></i>', $url, ['class' => 'text-warning', 'title' => 'Редактировать']),
                'delete' => fn($url, $model) => Html::a(
                    '<i class="bi bi-trash"></i>',
                    $url,
                    ['class' => 'text-danger', 'data-method' => 'post', 'data-confirm' => 'Удалить документ?', 'title' => 'Удалить']
                ),
                'certificate' => fn($url, $model) => Html::a(
                    '<i class="bi bi-file-earmark-text"></i>',
                    ['/operator/document/view-certificate', 'id' => $model->id],
                    ['class' => 'text-info', 'title' => 'Просмотр справки / Печать', 'target' => '_blank']
                ),
            ],
        ],
    ],
]); ?>