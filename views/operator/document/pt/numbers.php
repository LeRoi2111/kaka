<?php
/** @var array $data */
use yii\helpers\Html;

// === Подготовка данных ===
$docNumber = preg_replace('/[^0-9A-Z\-\/\.]/ui', '', mb_strtoupper($data['doc_number'] ?? ''));
$docNumber = str_pad($docNumber, 14, ' ', STR_PAD_RIGHT);
$docNumChars = mb_str_split($docNumber);

$corrNumber = preg_replace('/[^0-9]/', '', $data['corr_number'] ?? '');
$corrNumber = str_pad($corrNumber, 3, ' ', STR_PAD_RIGHT);
$corrNumChars = mb_str_split($corrNumber);

$docYear = preg_replace('/[^0-9]/', '', $data['doc_year'] ?? '');
$docYear = str_pad($docYear, 4, ' ', STR_PAD_RIGHT);
$yearChars = mb_str_split($docYear);
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <!-- Номер справки -->
    <td height="23" class="xl75" colspan="10" style="height:17.25pt;mso-ignore:colspan">Номер справки<span style="display:none"><span style="mso-spacerun:yes">&nbsp;</span></span></td>
    <?php for ($i = 0; $i < 14; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $docNumChars[$i] !== ' ' ? Html::encode($docNumChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl67"></td>

    <!-- Номер корректировки -->
    <td colspan="14" class="xl75" style="border-right:.5pt dotted black">Номер корректировки</td>
    <?php for ($i = 0; $i < 3; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $corrNumChars[$i] !== ' ' ? Html::encode($corrNumChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl67"></td>

    <!-- Отчетный год (строго 4 ячейки, стиль точно как в исходнике) -->
    <td colspan="11" class="xl67" style="border-right:.5pt dotted black">Отчетный год<span style="mso-spacerun:yes">&nbsp;</span></td>
    <?php for ($i = 0; $i < 4; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black;border-left:none">
            <?= $yearChars[$i] !== ' ' ? Html::encode($yearChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>