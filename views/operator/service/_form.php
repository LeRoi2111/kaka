<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<?php $form = ActiveForm::begin(['id' => 'service-form']); ?>
<div class="row g-3">
    <div class="col-md-3"><?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-9"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
    <div class="col-12"><?= $form->field($model, 'description')->textarea(['rows' => 3]) ?></div>
</div>
<div class="mt-3">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary-custom']) ?>
    <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
</div>
<?php ActiveForm::end(); ?>