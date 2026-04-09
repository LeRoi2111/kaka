<?php
use yii\helpers\Html;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Управление пользователями';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <?= Html::a('<i class="bi bi-person-plus me-1"></i>Добавить пользователя', ['create'], ['class' => 'btn btn-primary-custom']) ?>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-bordered table-striped mb-0'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'username',
        'email:email',
        [
            'attribute' => 'role',
            'value' => function ($model) {
                return match($model->role) {
                    'admin' => '<span class="badge bg-primary">Администратор</span>',
                    'operator' => '<span class="badge bg-success">Оператор</span>',
                    'accountant' => '<span class="badge bg-info text-dark">Бухгалтер</span>',
                    default => $model->role,
                };
            },
            'format' => 'raw',
            'filter' => ['admin' => 'Администратор', 'operator' => 'Оператор', 'accountant' => 'Бухгалтер'],
        ],
        'created_at:datetime',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => fn($url, $model) => Html::a('<i class="bi bi-eye"></i>', $url, ['class' => 'text-primary', 'title' => 'Просмотр']),
                'update' => fn($url, $model) => Html::a('<i class="bi bi-pencil"></i>', $url, ['class' => 'text-warning', 'title' => 'Редактировать']),
                'delete' => fn($url, $model) => Html::a('<i class="bi bi-trash"></i>', $url, ['class' => 'text-danger', 'data-method' => 'post', 'data-confirm' => 'Удалить пользователя?']),
            ],
        ],
    ],
]); ?>