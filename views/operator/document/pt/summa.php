<?php
/** @var array $data Массив данных из контроллера */
use yii\helpers\Html;

// === Форматирование суммы в массив из 15 символов: 12 цифр + точка + 2 цифры ===
$formatAmount = function($val) {
    $val = preg_replace('/[^\d.]/', '', (string)$val);
    if (strpos($val, '.') === false) {
        $val .= '.00';
    }
    [$intPart, $decPart] = explode('.', $val);
    // Дополняем целую часть до 12 знаков пробелами слева, дробную до 2 знаков нулями справа
    $intPart = str_pad(substr($intPart, 0, 12), 12, ' ', STR_PAD_LEFT);
    $decPart = str_pad(substr($decPart, 0, 2), 2, '0', STR_PAD_RIGHT);
    return str_split($intPart . '.' . $decPart);
};

$chars1 = $formatAmount($data['amount_code_1'] ?? '0.00');
$chars2 = $formatAmount($data['amount_code_2'] ?? '0.00');
?>

<!-- Сумма расходов по коду услуги "1" -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl75" colspan="44" style="height:17.25pt;mso-ignore:colspan">Сумма расходов на оказанные медицинские услуги по коду услуги "1"</td>
    <?php foreach ($chars1 as $i => $char): ?>
        <?php if ($char === '.'): ?>
            <td colspan="2" class="xl92" style="border-right:.5pt dotted black;border-left:none">.</td>
        <?php else: ?>
            <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
                <?= $char !== ' ' ? Html::encode($char) : '&nbsp;' ?>
            </td>
        <?php endif; ?>
    <?php endforeach; ?>
    <td colspan="2" class="xl67"></td>
    <td colspan="2" class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>
<tr height="9" style="mso-height-source:userset;height:6.75pt">
    <?php for ($i = 0; $i < 78; $i++): ?>
        <td height="9" class="xl74" width="9" style="height:6.75pt;width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>

<!-- Сумма расходов по коду услуги "2" -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl75" colspan="44" style="height:17.25pt;mso-ignore:colspan">Сумма расходов на оказанные медицинские услуги по коду услуги "2"</td>
    <?php foreach ($chars2 as $i => $char): ?>
        <?php if ($char === '.'): ?>
            <td colspan="2" class="xl92" style="border-right:.5pt dotted black;border-left:none">.</td>
        <?php else: ?>
            <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
                <?= $char !== ' ' ? Html::encode($char) : '&nbsp;' ?>
            </td>
        <?php endif; ?>
    <?php endforeach; ?>
    <td colspan="2" class="xl67"></td>
    <td colspan="2" class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>
<tr height="8" style="mso-height-source:userset;height:6.0pt">
    <?php for ($i = 0; $i < 78; $i++): ?>
        <td height="8" class="xl74" width="9" style="height:6.0pt;width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>

<!-- Пустая строка-разделитель -->
<tr class="xl67" height="8" style="mso-height-source:userset;height:6.0pt">
    <?php for ($i = 0; $i < 48; $i++): ?>
        <td colspan="2" class="xl67"></td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl67"></td>
</tr>