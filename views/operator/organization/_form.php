<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\Staff;

/** @var yii\web\View $this */
/** @var app\models\Organization $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="organization-form">
    <?php $form = ActiveForm::begin(['id' => 'organization-form']); ?>

    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'kpp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ogrn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'license_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'default_staff_id')->dropDownList(
                ArrayHelper::map(Staff::find()->all(), 'id', function($m) {
                    return trim($m->last_name . ' ' . $m->first_name . ' ' . ($m->middle_name ?? ''));
                }),
                ['prompt' => '— Не выбрано —']
            ) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'legal_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'actual_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary-custom']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>