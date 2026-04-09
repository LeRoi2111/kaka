<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Справочник сотрудников';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <?= Html::a('<i class="bi bi-plus-lg me-1"></i>Добавить', ['create'], ['class' => 'btn btn-primary-custom']) ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-bordered table-striped mb-0'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'], 'id',
        ['label' => 'ФИО', 'value' => fn($m) => Html::encode($m->getFullName()), 'format' => 'raw'],
        'position', 'contacts',
        [
            'class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => fn($u, $m) => Html::a('<i class="bi bi-eye"></i>', $u, ['class' => 'text-primary']),
                'update' => fn($u, $m) => Html::a('<i class="bi bi-pencil"></i>', $u, ['class' => 'text-warning']),
                'delete' => fn($u, $m) => Html::a('<i class="bi bi-trash"></i>', $u, ['class' => 'text-danger', 'data-method' => 'post', 'data-confirm' => 'Удалить?']),
            ],
        ],
    ],
]); ?>