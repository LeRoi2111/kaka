<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Document $model */

$this->title = 'Документ №' . $model->document_number;
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= Html::encode($this->title) ?></h1>
    <div>
        <?php if ($model->status === 'draft'): ?>
            <?= Html::a('<i class="bi bi-pencil me-1"></i>Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php endif; ?>
        <?= Html::a('<i class="bi bi-file-earmark-pdf-fill me-1"></i>Распечатать PDF', ['view-certificate', 'id' => $model->id], ['class' => 'btn btn-danger ms-2']) ?>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-outline-secondary ms-2']) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-custom mb-4">
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        ['attribute' => 'patient_id', 'value' => $model->patient?->getFullName(), 'label' => 'Пациент'],
                        ['attribute' => 'organization_id', 'value' => $model->organization?->name, 'label' => 'Организация'],
                        ['attribute' => 'staff_id', 'value' => $model->staff?->getFullName(), 'label' => 'Исполнитель'],
                        ['attribute' => 'document_type_id', 'value' => $model->documentType?->name, 'label' => 'Тип документа'],
                        'document_number',
                        'document_date:date',
                        ['attribute' => 'total_amount', 'format' => ['currency', 'RUB']],
                        [
                            'attribute' => 'status',
                            'value' => match($model->status) {
                                'draft' => 'Черновик', 'issued' => 'Выдан', 'cancelled' => 'Отменён', default => $model->status
                            },
                        ],
                        'created_at:datetime',
                    ],
                    'options' => ['class' => 'table table-bordered mb-0'],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-header bg-white">
                <h5 class="mb-0">Перечень оказанных услуг</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>№</th>
                            <th>Услуга (код)</th>
                            <th>Сумма</th>
                            <th>Дата оказания</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->documentServices as $i => $ds): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= Html::encode($ds->service->name ?? '—') ?> (<?= Html::encode($ds->service->code ?? '—') ?>)</td>
                                <td><?= Yii::$app->formatter->asCurrency($ds->amount, 'RUB') ?></td>
                                <td><?= Yii::$app->formatter->asDate($ds->service_date) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($model->documentServices)): ?>
                            <tr><td colspan="4" class="text-center text-muted">Услуги не добавлены</td></tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="2" class="text-end">Итого:</th>
                            <th colspan="2"><?= Yii::$app->formatter->asCurrency($model->total_amount, 'RUB') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>