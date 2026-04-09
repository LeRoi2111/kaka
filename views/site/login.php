<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Вход в систему';
?>

<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card card-custom">
            <div class="card-body p-4">
                <h1 class="h3 mb-4 text-center"><?= Html::encode($this->title) ?></h1>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'form-label'],
                        'inputOptions' => ['class' => 'form-control'],
                        'errorOptions' => ['class' => 'invalid-feedback d-block'],
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="d-grid mt-3">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary-custom btn-lg']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center mt-3 text-secondary-custom">
            Для получения учётной записи обратитесь к администратору организации.
        </p>
    </div>
</div>