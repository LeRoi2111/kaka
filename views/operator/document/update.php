<?php
use yii\helpers\Html;
$this->title = 'Редактирование документа №' . $model->document_number;
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
</div>
<div class="card card-custom">
    <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
            'patients' => $patients,
            'orgs' => $orgs,
            'staff' => $staff,
            'docTypes' => $docTypes,
            'services' => $services,
            'servicesData' => $servicesData,
        ]) ?>
    </div>
</div>