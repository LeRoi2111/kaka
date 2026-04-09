<?php
use yii\helpers\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

NavBar::begin([
    'brandLabel' => '<i class="bi bi-file-earmark-medical-fill me-2"></i>ИС "Справка КНД"',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-lg header-custom',
        'aria-label' => 'Основная навигация'
    ],
]);

$menuItems = [
    ['label' => 'О системе', 'url' => ['/site/about']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
} else {
    $role = Yii::$app->user->identity->role ?? 'operator';
    $dashboardUrl = ['/' . $role . '/index'];

    $menuItems[] = '<li class="nav-item">' .
        Html::a('<i class="bi bi-speedometer2 "></i>Кабинет', $dashboardUrl, ['class' => 'nav-link']) .
        '</li>';
    $menuItems[] = '<li class="nav-item d-flex align-items-center">' .
        Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) .
        Html::submitButton('<i class="bi bi-box-arrow-right me-1"></i>Выйти', ['class' => 'btn btn-link nav-link p-0']) .
        Html::endForm() . '</li>';
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-lg-0'],
    'items' => $menuItems,
]);

NavBar::end();
?>