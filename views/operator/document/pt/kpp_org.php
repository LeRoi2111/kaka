<?php
/** @var string $value КПП организации (9 цифр) */
use yii\helpers\Html;

// Подготовка: только цифры, дополняем до 9 символов пробелами
$kpp = preg_replace('/[^0-9]/', '', $value ?? '');
$kpp = str_pad($kpp, 9, ' ', STR_PAD_RIGHT);
$chars = mb_str_split($kpp);
?>
<?php for ($i = 0; $i < 9; $i++): ?>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none">
        <?= $chars[$i] !== ' ' ? Html::encode($chars[$i]) : '&nbsp;' ?>
    </td>
<?php endfor; ?>