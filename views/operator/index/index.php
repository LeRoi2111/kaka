<?php
use yii\helpers\Html;
$this->title = 'Кабинет оператора';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Рабочее пространство оператора</h1>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom border-start border-success border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Пациенты</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['patients']) ?></h2>
                    </div>
                    <div class="fs-1 text-success"><i class="bi bi-person-vcard"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Организации</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['organizations']) ?></h2>
                    </div>
                    <div class="fs-1 text-primary"><i class="bi bi-building"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Создано документов</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['documents']) ?></h2>
                    </div>
                    <div class="fs-1 text-warning"><i class="bi bi-file-earmark-text"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom border-start border-info border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Выдано справок</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['documents_issued']) ?></h2>
                    </div>
                    <div class="fs-1 text-info"><i class="bi bi-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-info mb-0">
    <i class="bi bi-info-circle me-2"></i>
    Начните работу с заполнения справочников: организаций, сотрудников и пациентов. После этого можно формировать документы и экспортировать их в PDF.
</div>