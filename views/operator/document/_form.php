<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Document $model */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var array $patients, $orgs, $staff, $docTypes, $services */
/** @var array $servicesData */

$existingServices = $servicesData ?? [];
$defaultDate = $model->document_date ?: date('Y-m-d');

// Преобразование массивов пациентов и сотрудников в список id => "ФИО"
$patientsList = ArrayHelper::map($patients, 'id', function($p) {
    return trim("{$p['last_name']} {$p['first_name']} {$p['middle_name']}");
});
$staffList = ArrayHelper::map($staff, 'id', function($s) {
    return trim("{$s['last_name']} {$s['first_name']} {$s['middle_name']}");
});
?>

<?php $form = ActiveForm::begin(['id' => 'doc-form']); ?>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <?= $form->field($model, 'patient_id')->dropDownList($patientsList, ['prompt' => 'Выберите пациента']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'organization_id')->dropDownList($orgs, ['prompt' => 'Выберите организацию']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'staff_id')->dropDownList($staffList, ['prompt' => 'Выберите сотрудника']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'document_type_id')->dropDownList($docTypes, ['prompt' => 'Выберите тип']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'document_date')->input('date') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'status')->dropDownList([
            'draft' => 'Черновик',
            'issued' => 'Выдан',
            'cancelled' => 'Отменён'
        ]) ?>
    </div>
</div>

<h5 class="mb-3">Перечень услуг</h5>
<div id="services-container">
    <?php if (empty($existingServices)): ?>
        <div class="service-row row g-2 mb-2 align-items-end">
            <div class="col-5"><?= Html::dropDownList('DocumentService[0][service_id]', null, $services, ['class' => 'form-select', 'prompt' => 'Услуга']) ?></div>
            <div class="col-3"><?= Html::input('number', 'DocumentService[0][amount]', null, ['class' => 'form-control', 'placeholder' => 'Сумма', 'step' => '0.01']) ?></div>
            <div class="col-3"><?= Html::input('date', 'DocumentService[0][service_date]', $defaultDate, ['class' => 'form-control']) ?></div>
            <div class="col-1"><?= Html::button('<i class="bi bi-x-lg"></i>', ['class' => 'btn btn-outline-danger remove-srv', 'type' => 'button']) ?></div>
        </div>
    <?php else: ?>
        <?php foreach ($existingServices as $i => $srv): ?>
            <div class="service-row row g-2 mb-2 align-items-end">
                <div class="col-5"><?= Html::dropDownList("DocumentService[{$i}][service_id]", $srv['service_id'], $services, ['class' => 'form-select']) ?></div>
                <div class="col-3"><?= Html::input('number', "DocumentService[{$i}][amount]", $srv['amount'], ['class' => 'form-control', 'step' => '0.01']) ?></div>
                <div class="col-3"><?= Html::input('date', "DocumentService[{$i}][service_date]", $srv['service_date'], ['class' => 'form-control']) ?></div>
                <div class="col-1"><?= Html::button('<i class="bi bi-x-lg"></i>', ['class' => 'btn btn-outline-danger remove-srv', 'type' => 'button']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= Html::button('<i class="bi bi-plus-circle"></i> Добавить услугу', ['id' => 'add-service', 'class' => 'btn btn-outline-secondary mb-4', 'type' => 'button']) ?>

<div class="form-group mt-3">
    <?= Html::submitButton('Сохранить документ', ['class' => 'btn btn-primary-custom me-2']) ?>
    <?= Html::a('Отмена', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php
$servicesJson = json_encode($services, JSON_UNESCAPED_UNICODE);
$existingCount = count($existingServices);
$defDate = $defaultDate;

$this->registerJs("
    document.addEventListener('DOMContentLoaded', function() {
        let serviceIndex = $existingCount;
        const servicesData = $servicesJson;
        const defaultDate = '$defDate';

        function getServiceOptions(selectedId) {
            let opts = '<option value=\"\">Услуга</option>';
            for (let id in servicesData) {
                opts += '<option value=\"' + id + '\" ' + (id == selectedId ? 'selected' : '') + '>' + servicesData[id] + '</option>';
            }
            return opts;
        }

        function createRow(idx, selId, amt, dt) {
            return '<div class=\"service-row row g-2 mb-2 align-items-end\">' +
                '<div class=\"col-5\"><select name=\"DocumentService[' + idx + '][service_id]\" class=\"form-select\">' + getServiceOptions(selId) + '</select></div>' +
                '<div class=\"col-3\"><input type=\"number\" name=\"DocumentService[' + idx + '][amount]\" class=\"form-control\" step=\"0.01\" placeholder=\"Сумма\" value=\"' + (amt || '') + '\"></div>' +
                '<div class=\"col-3\"><input type=\"date\" name=\"DocumentService[' + idx + '][service_date]\" class=\"form-control\" value=\"' + (dt || defaultDate) + '\"></div>' +
                '<div class=\"col-1\"><button type=\"button\" class=\"btn btn-outline-danger remove-srv\"><i class=\"bi bi-x-lg\"></i></button></div>' +
                '</div>';
        }

        document.getElementById('add-service').addEventListener('click', function() {
            document.getElementById('services-container').insertAdjacentHTML('beforeend', createRow(serviceIndex, '', '', ''));
            serviceIndex++;
        });

        document.getElementById('services-container').addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-srv');
            if (btn) {
                const row = btn.closest('.service-row');
                if (document.querySelectorAll('.service-row').length > 1) row.remove();
            }
        });
    });
", \yii\web\View::POS_END);
?>