<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<?php $form = ActiveForm::begin(['id' => 'doc-type-form']); ?>
<div class="row g-3">
    <div class="col-md-6"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
    <div class="col-md-6"><?= $form->field($model, 'template_file')->textInput(['maxlength' => true, 'placeholder' => 'Например: 1151156_template.xlsx']) ?></div>
</div>
<div class="mt-3">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary-custom']) ?>
    <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
</div>
<?php ActiveForm::end(); ?>