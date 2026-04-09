<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\models\TypePersonDocument;

/** @var yii\web\View $this */
/** @var app\models\Patient $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="patient-form">
    <?php $form = ActiveForm::begin(['id' => 'patient-form']); ?>

    <div class="row g-3">
        <div class="col-md-4">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'birth_date')->input('date') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type_person_document_id')->dropDownList(
                ArrayHelper::map(TypePersonDocument::find()->all(), 'id', 'name'),
                ['prompt' => 'Выберите тип документа']
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'document_series_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'document_issued_by')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'document_issue_date')->input('date') ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->input('email', ['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group mt-4">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary-custom']) ?>
        <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>