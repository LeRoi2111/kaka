<?php
/** @var array $data Массив данных налогоплательщика */
use yii\helpers\Html;

// === Вспомогательная функция: вывод строки посимвольно ===
$renderCharRow = function(string $label, string $value, int $totalCells = 46, string $classFirst = 'xl88', string $classRest = 'xl113', string $labelClass = 'xl111') {
    // Очистка и подготовка: оставляем буквы (кириллица+латиница), дефисы, апострофы
    $clean = preg_replace('/[^0-9A-ZА-ЯЁ\s\-\']/ui', '', mb_strtoupper($value ?? ''));
    $chars = mb_str_split(str_pad($clean, $totalCells, ' ', STR_PAD_RIGHT));

    // Определяем, где заканчивается зона xl88 (первые 20 ячеек)
    $xl88Count = 20;

    $html = '';
    // Метка поля
    $html .= '<td colspan="8" height="23" class="' . $labelClass . '" width="72" style="height:17.25pt;width:56pt">' . Html::encode($label) . "</td>\n";

    // Ячейки для символов
    for ($i = 0; $i < $totalCells; $i++) {
        $cellClass = ($i < $xl88Count) ? $classFirst : $classRest;
        $borderStyle = 'border-right:.5pt dotted black' . ($i > 0 ? ';border-left:none' : '');
        $char = $chars[$i] ?? ' ';
        $content = $char !== ' ' ? Html::encode($char) : '&nbsp;';

        $html .= '<td colspan="2" class="' . $cellClass . '" style="' . $borderStyle . '">' . $content . "</td>\n";
    }

    // Завершающие пустые ячейки
    $html .= '<td class="xl67"></td>' . "\n" . '<td class="xl67"></td>' . "\n";

    return $html;
};

// === Фамилия ===
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <?= $renderCharRow('Фамилия', $data['taxpayer_last'] ?? '') ?>
</tr>
<tr class="xl67" height="6" style="mso-height-source:userset;height:4.5pt">
    <td colspan="8" height="6" class="xl82" style="height:4.5pt"></td>
    <td class="xl82"></td>
    <td class="xl82"></td>
    <?php for ($i = 0; $i < 46; $i++): ?>
        <td colspan="2" class="<?= $i < 20 ? 'xl73' : 'xl115' ?>"></td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>

<?php
// === Имя ===
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <?= $renderCharRow('Имя', $data['taxpayer_first'] ?? '') ?>
</tr>
<tr class="xl67" height="6" style="mso-height-source:userset;height:4.5pt">
    <td colspan="8" height="6" class="xl82" style="height:4.5pt"></td>
    <td class="xl82"></td>
    <td class="xl82"></td>
    <?php for ($i = 0; $i < 46; $i++): ?>
        <td colspan="2" class="<?= $i < 20 ? 'xl73' : 'xl115' ?>"></td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>

<?php
// === Отчество ===
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <?= $renderCharRow('Отчество', $data['taxpayer_middle'] ?? '', 46, 'xl88', 'xl113', 'xl75') ?>
</tr>
<tr height="8" style="mso-height-source:userset;height:6.0pt">
    <?php for ($i = 0; $i < 82; $i++): ?>
        <td class="xl74" width="9" style="width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>