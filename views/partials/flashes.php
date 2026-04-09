<?php
use yii\helpers\Html;
?>

<?php foreach (Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php foreach ((array)$messages as $message): ?>
        <?php
        $alertClass = match($type) {
            'success' => 'alert-success',
            'error'   => 'alert-danger',
            'warning' => 'alert-warning',
            'info'    => 'alert-info',
            default   => 'alert-secondary'
        };
        ?>
        <div class="alert <?= $alertClass ?> alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i><?= Html::encode($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>