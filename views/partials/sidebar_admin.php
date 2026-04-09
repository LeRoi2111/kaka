<?php
use yii\helpers\Html;

$items = [
    ['label' => 'Панель управления', 'url' => ['/admin/index/index'], 'icon' => 'bi-speedometer2'],
    ['label' => 'Пользователи системы', 'url' => ['/admin/user/index'], 'icon' => 'bi-people'],
    ['label' => 'Справочники', 'url' => ['/admin/reference/index'], 'icon' => 'bi-folder'],
    ['label' => 'Настройки системы', 'url' => ['/admin/settings/index'], 'icon' => 'bi-gear'],
    ['label' => 'Выход', 'url' => ['/site/logout'], 'icon' => 'bi-box-arrow-left', 'post' => true],
];
?>

<ul class="nav flex-column mb-4">
    <li class="nav-item px-3 mb-3">
        <span class="text-uppercase fw-bold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.1em;">Администрирование</span>
    </li>
    <?php foreach ($items as $item): ?>
        <li class="nav-item">
            <?php
            $linkOptions = [
                'class' => 'nav-link d-flex align-items-center px-3 py-2 text-dark',
                'data-method' => ($item['post'] ?? false) ? 'post' : null
            ];

            // Корректное определение активного пункта по маршруту Yii2
            $currentRoute = Yii::$app->controller->getRoute();
            $targetRoute = ltrim($item['url'][0], '/');
            if ($currentRoute === $targetRoute || str_starts_with($currentRoute, rtrim($targetRoute, '/') . '/')) {
                $linkOptions['class'] .= ' active bg-light fw-medium';
            }
            ?>
            <?= Html::a(
                Html::tag('i', '', ['class' => 'bi ' . $item['icon'] . ' me-2 fs-5']) . $item['label'],
                $item['url'],
                $linkOptions
            ) ?>
        </li>
    <?php endforeach; ?>
</ul>