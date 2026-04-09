<?php
/** @var string $value Наименование организации (передаётся при рендере) */
use yii\helpers\Html;

// Подготовка: оставляем буквы, цифры, пробелы, точки, дефисы, кириллицу
$clean = preg_replace('/[^0-9A-ZА-ЯЁ\s\.\-\,]/ui', '', mb_strtoupper($value ?? ''));
// Разбиваем на символы, дополняем пробелами до нужной длины
$chars = mb_str_split(str_pad($clean, 46, ' ', STR_PAD_RIGHT));
$cellCount = 39; // Количество ячеек для наименования организации в шаблоне
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <!-- Пустая ячейка-отступ -->
    <td colspan="2" height="23" class="xl88" style="border-right:.5pt dotted black;height:17.25pt">&nbsp;</td>

    <!-- Ячейки для посимвольного вывода наименования организации -->
    <?php for ($i = 0; $i < $cellCount; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $chars[$i] !== ' ' ? Html::encode($chars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>

    <!-- Завершающие пустые ячейки -->
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>