<?php
/** @var array $data Массив данных налогоплательщика */
use yii\helpers\Html;

// === Код вида документа (2 цифры) ===
$docCode = preg_replace('/[^0-9]/', '', $data['taxpayer_doc_code'] ?? '');
$docCode = str_pad($docCode, 2, ' ', STR_PAD_RIGHT);
$codeChars = mb_str_split($docCode);

// === Серия и номер документа (до 12 символов: буквы+цифры) ===
$docNum = preg_replace('/[^0-9A-ZА-ЯЁ]/ui', '', mb_strtoupper($data['taxpayer_doc_num'] ?? ''));
$docNum = str_pad($docNum, 12, ' ', STR_PAD_RIGHT);
$numChars = mb_str_split($docNum);
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <!-- Код вида документа: метка + 2 ячейки -->
    <td height="23" class="xl75" colspan="14" style="height:17.25pt;mso-ignore:colspan">Код вида документа<span style="mso-spacerun:yes">&nbsp;</span></td>
    <?php for ($i = 0; $i < 2; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $codeChars[$i] !== ' ' ? Html::encode($codeChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>

    <!-- Пустые ячейки-разделители -->
    <td class="xl75"></td>
    <td class="xl75"></td>
    <td class="xl75"></td>
    <td class="xl75"></td>
    <td class="xl75"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>

    <!-- Серия и номер: метка + 12 ячеек -->
    <td colspan="12" class="xl67" style="border-right:.5pt dotted black">Серия и номер</td>
    <?php for ($i = 0; $i < 12; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $numChars[$i] !== ' ' ? Html::encode($numChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>

    <!-- Завершающие пустые ячейки -->
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>