<?php
/** @var array $data Массив данных налогоплательщика */
use yii\helpers\Html;

// === ИНН налогоплательщика (12 цифр) ===
$inn = preg_replace('/[^0-9]/', '', $data['taxpayer_inn'] ?? '');
$inn = str_pad($inn, 12, ' ', STR_PAD_RIGHT);
$innChars = mb_str_split($inn);

// === Дата рождения (формат ДД.ММ.ГГГГ = 10 символов) ===
$birth = $data['taxpayer_birth'] ?? '';
// Если дата в формате "дд.мм.гггг", оставляем как есть, иначе форматируем
if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth)) {
    $birth = date('d.m.Y', strtotime($birth));
}
$birth = preg_replace('/[^\d\.]/', '', $birth);
$birth = str_pad($birth, 10, ' ', STR_PAD_RIGHT);
$birthChars = mb_str_split($birth);
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <!-- ИНН: метка + 12 ячеек -->
    <td colspan="6" height="23" class="xl75" style="height:17.25pt">ИНН<font class="font19"><sup>2</sup></font></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <?php for ($i = 0; $i < 12; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $innChars[$i] !== ' ' ? Html::encode($innChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>

    <!-- Разделители -->
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl73"></td>

    <!-- Дата рождения: метка + 10 ячеек с точками -->
    <td colspan="14" class="xl77" width="126" style="width:98pt">Дата рождения<span style="mso-spacerun:yes">&nbsp;</span></td>
    <td class="xl67"></td>

    <?php for ($i = 0; $i < 10; $i++): ?>
        <?php
        // Ячейки 2 и 5 (индексы 2 и 5) — это точки, они всегда отображаются как "."
        $isDot = ($i === 2 || $i === 5);
        $cellClass = $isDot ? 'xl92' : 'xl88';
        $content = $isDot ? '.' : ($birthChars[$i] !== ' ' ? Html::encode($birthChars[$i]) : '&nbsp;');
        $borderStyle = 'border-right:.5pt dotted black' . ($i > 0 ? ';border-left:none' : '');
        ?>
        <td colspan="2" class="<?= $cellClass ?>" style="<?= $borderStyle ?>">
            <?= $content ?>
        </td>
    <?php endfor; ?>

    <!-- Завершающие пустые ячейки -->
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl73"></td>
    <td class="xl73"></td>
    <td class="xl73"></td>
    <td class="xl73"></td>
    <td class="xl73"></td>
    <td class="xl73"></td>
    <td class="xl73"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>
<tr height="8" style="mso-height-source:userset;height:6.0pt">
    <?php for ($i = 0; $i < 82; $i++): ?>
        <td class="xl74" width="9" style="width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>