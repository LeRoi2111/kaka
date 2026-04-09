<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/** @var yii\web\View $this */
/** @var app\models\User $model */
$this->title = 'Пользователь: ' . $model->username;
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <div>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning me-1']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => 'Удалить пользователя?']) ?>
    </div>
</div>

<div class="card card-custom">
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'email:email',
                [
                    'attribute' => 'role',
                    'value' => match($model->role) {
                        'admin' => 'Администратор',
                        'operator' => 'Оператор',
                        'accountant' => 'Бухгалтер',
                        default => $model->role,
                    },
                ],
                'created_at:datetime',
            ],
            'options' => ['class' => 'table table-bordered mb-0'],
        ]) ?>
    </div>
</div>