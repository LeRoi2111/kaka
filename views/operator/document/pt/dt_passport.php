<?php
/** @var array $data Массив данных налогоплательщика */
use yii\helpers\Html;

// Подготовка даты выдачи документа (ожидаем формат ДД.ММ.ГГГГ)
$docDate = $data['taxpayer_doc_date'] ?? '';
if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $docDate)) {
    $docDate = date('d.m.Y', strtotime($docDate));
}
$docDate = preg_replace('/[^\d\.]/', '', $docDate);
$docDate = str_pad($docDate, 10, ' ', STR_PAD_RIGHT);
$dateChars = mb_str_split($docDate);
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td colspan="10" height="23" class="xl111" width="90" style="height:17.25pt;width:70pt">Дата выдачи<span style="mso-spacerun:yes">&nbsp;</span></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>

    <!-- Ячейки для даты: ДД.ММ.ГГГГ (10 символов) -->
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black"><?= $dateChars[0] !== ' ' ? Html::encode($dateChars[0]) : '&nbsp;' ?></td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[1] !== ' ' ? Html::encode($dateChars[1]) : '&nbsp;' ?></td>
    <!-- Точка (статичная) -->
    <td colspan="2" class="xl92" style="border-right:.5pt dotted black;border-left:none">.</td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[3] !== ' ' ? Html::encode($dateChars[3]) : '&nbsp;' ?></td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[4] !== ' ' ? Html::encode($dateChars[4]) : '&nbsp;' ?></td>
    <!-- Точка (статичная) -->
    <td colspan="2" class="xl92" style="border-right:.5pt dotted black;border-left:none">.</td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[6] !== ' ' ? Html::encode($dateChars[6]) : '&nbsp;' ?></td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[7] !== ' ' ? Html::encode($dateChars[7]) : '&nbsp;' ?></td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[8] !== ' ' ? Html::encode($dateChars[8]) : '&nbsp;' ?></td>
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none"><?= $dateChars[9] !== ' ' ? Html::encode($dateChars[9]) : '&nbsp;' ?></td>

    <td class="xl79" width="9" style="border-left:none;width:7pt">&nbsp;</td>
    <?php for ($i = 0; $i < 13; $i++): ?><td class="xl77" width="9" style="width:7pt"></td><?php endfor; ?>
    <?php for ($i = 0; $i < 9; $i++): ?><td class="xl67"></td><?php endfor; ?>
    <?php for ($i = 0; $i < 16; $i++): ?><td class="xl73"></td><?php endfor; ?>
    <?php for ($i = 0; $i < 10; $i++): ?><td class="xl67"></td><?php endfor; ?>
</tr>
<tr height="10" style="mso-height-source:userset;height:7.5pt">
    <?php for ($i = 0; $i < 80; $i++): ?>
        <td height="10" class="xl74" width="9" style="height:7.5pt;width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>