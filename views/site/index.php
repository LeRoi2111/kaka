<?php
/** @var yii\web\View $this */
$this->title = 'Главная - Система подготовки справок';
use yii\helpers\Html;
?>

<div class="row justify-content-center">
    <div class="col-lg-11">
        <div class="card card-custom mb-4">
            <div class="card-body text-center py-5">
                <h1 class="display-5 mb-3">Автоматизация подготовки справок КНД 11511</h1>
                <p class="lead text-secondary-custom mb-4">
                    Веб-приложение для медицинских организаций по формированию справок о налоговом вычете
                    и ведению реестра документации.
                </p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <?= Html::a('Авторизоваться', ['/site/login'], ['class' => 'btn btn-primary-custom btn-lg px-4']) ?>
                        <?= Html::a('Регистрация', ['/site/register'], ['class' => 'btn btn-outline-secondary btn-lg px-4']) ?>
                    <?php else: ?>
                        <?php $role = Yii::$app->user->identity->role ?? 'operator'; ?>
                        <?= Html::a('Перейти в кабинет', ['/' . $role . '/index'], ['class' => 'btn btn-primary-custom btn-lg px-4']) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card card-custom h-100">
                    <div class="card-body">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-shield-check"></i></div>
                        <h5 class="card-title">Безопасность данных</h5>
                        <p class="card-text text-secondary-custom">Соответствие требованиям 152-ФЗ. Защита персональных данных пациентов и хеширование учётных записей.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom h-100">
                    <div class="card-body">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-file-earmark-pdf"></i></div>
                        <h5 class="card-title">Точное соответствие КНД</h5>
                        <p class="card-text text-secondary-custom">Генерация справок  по форме КНД 1151156. Автоматический расчёт сумм и подстановка реквизитов из БД.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom h-100">
                    <div class="card-body">
                        <div class="fs-1 text-primary mb-3"><i class="bi bi-people"></i></div>
                        <h5 class="card-title">Документооборот</h5>
                        <p class="card-text text-secondary-custom">Единый реестр пациентов, организаций и выданных справок. Быстрый поиск, фильтрация и экспорт в PDF.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-custom">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>О системе</h5>
            </div>
            <div class="card-body">
                <p>Приложение разработано для автоматизации рутинных операций медицинских учреждений.
                Система позволяет операторам, бухгалтерам и администраторам взаимодействовать с единой базой данных,
                исключая ручной ввод реквизитов и минимизируя риск ошибок при подготовке отчётных документов.</p>
                <ul class="mb-0 text-secondary-custom">
                    <li>Централизованное хранение справочников и шаблонов</li>
                    <li>Автоматическая генерация PDF по утверждённым формам</li>
                    <li>Разграничение прав доступа (Admin, Operator, Accountant)</li>
                    <li>Масштабируемая архитектура на базе Yii2 и MySQL</li>
                </ul>
            </div>
        </div>
    </div>
</div>