<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>

    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'autocomplete' => 'username']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autocomplete' => 'email']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'role')->dropDownList([
                'admin' => 'Администратор',
                'operator' => 'Оператор',
                'accountant' => 'Бухгалтер',
            ], ['prompt' => 'Выберите роль']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput([
                'maxlength' => true,
                'autocomplete' => $model->isNewRecord ? 'new-password' : 'off',
                'placeholder' => $model->isNewRecord ? 'Придумайте пароль' : 'Оставьте пустым, чтобы не менять'
            ]) ?>
        </div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary-custom']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>