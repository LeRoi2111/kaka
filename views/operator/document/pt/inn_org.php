<?php
/** @var string $value ИНН организации (передаётся при рендере) */
use yii\helpers\Html;

// Очищаем значение: оставляем только цифры, дополняем до 12 символов пробелами
$inn = preg_replace('/[^0-9]/', '', $value ?? '');
$inn = str_pad($inn, 12, ' ', STR_PAD_RIGHT);
$chars = mb_str_split($inn);
?>
<td colspan="2" class="xl66" width="18" style="width:14pt">&nbsp;</td>
<td colspan="6" rowspan="2" class="xl102" width="54" style="border-right:.5pt dotted black;width:42pt">ИНН</td>
<?php for ($i = 0; $i < 12; $i++): ?>
    <td colspan="2" rowspan="2" class="xl98" width="18" style="border-right:.5pt dotted black;border-bottom:.5pt dotted black;width:14pt">
        <?= $chars[$i] !== ' ' ? Html::encode($chars[$i]) : '&nbsp;' ?>
    </td>
<?php endfor; ?>