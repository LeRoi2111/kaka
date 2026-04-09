<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
$this->title = '';
?>
<?php $form = ActiveForm::begin(['id' => 'staff-form']); ?>
<div class="row g-3">
    <div class="col-md-4"><?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-4"><?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-4"><?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?></div>
</div>
<div class="mt-3">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary-custom']) ?>
    <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
</div>
<?php ActiveForm::end(); ?>