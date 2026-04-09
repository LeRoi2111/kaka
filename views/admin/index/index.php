<?php
/** @var yii\web\View $this */
/** @var array $stats */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Панель администратора';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Сводная информация по системе</h1>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom border-start border-primary border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Пользователи</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['users']) ?></h2>
                    </div>
                    <div class="fs-1 text-primary"><i class="bi bi-people"></i></div>
                </div>
            </div>
        </div>
    </div>
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
        <div class="card card-custom border-start border-info border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Организации</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['organizations']) ?></h2>
                    </div>
                    <div class="fs-1 text-info"><i class="bi bi-building"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card card-custom border-start border-warning border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Выдано справок</h6>
                        <h2 class="mb-0"><?= Html::encode($stats['documents_issued']) ?> / <?= Html::encode($stats['documents']) ?></h2>
                    </div>
                    <div class="fs-1 text-warning"><i class="bi bi-file-earmark-check"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-custom">
    <div class="card-header bg-white">
        <h5 class="mb-0"><i class="bi bi-lightning-charge me-2"></i>Быстрый переход</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <?= Html::a('Управление пользователями', ['/admin/user/index'], ['class' => 'btn btn-outline-primary w-100']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Настройка справочников', ['/admin/reference/index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
            </div>
            <div class="col-md-4">
                <?= Html::a('Параметры системы', ['/admin/settings/index'], ['class' => 'btn btn-outline-dark w-100']) ?>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 p-3 bg-light rounded border">
    <h5 class="h6">Информация о системе</h5>
    <p class="mb-1 text-secondary-custom">Версия приложения: <strong>1.0.0</strong></p>
    <p class="mb-1 text-secondary-custom">База данных: <strong><?= Html::encode(Yii::$app->db->dsn) ?></strong></p>
    <p class="mb-0 text-secondary-custom">PHP: <strong><?= PHP_VERSION ?></strong> | Yii2: <strong><?= Yii::getVersion() ?></strong></p>
</div>