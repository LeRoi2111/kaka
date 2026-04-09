<?php
/** @var array $data Массив данных из контроллера */
use yii\helpers\Html;

// Значение признака: '1' = да, '0' = нет
$val = $data['is_same_person'] ?? '1';
?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl81" colspan="35" style="height:17.25pt;mso-ignore:colspan">Налогоплательщик и пациент являются одним лицом<span style="mso-spacerun:yes">&nbsp;</span></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>

    <!-- Ячейка для значения (0 или 1) -->
    <td colspan="2" class="xl88" style="border-right:.5pt dotted black">
        <?= $val !== '' && $val !== null ? Html::encode($val) : '&nbsp;' ?>
    </td>

    <td class="xl81"></td>
    <td colspan="11" rowspan="2" class="xl116" width="99" style="width:77pt">0 - нет<br>1 - да<span style="mso-spacerun:yes">&nbsp;</span></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl81"></td>
    <td class="xl67"></td>
    <td class="xl67"></td>
    <td class="xl73"></td>
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
    <?php for ($i = 0; $i < 78; $i++): ?>
        <td height="8" class="xl74" width="9" style="height:6.0pt;width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>
<tr height="8" style="mso-height-source:userset;height:6.0pt">
    <?php for ($i = 0; $i < 78; $i++): ?>
        <td height="8" class="xl74" width="9" style="height:6.0pt;width:7pt"></td>
    <?php endfor; ?>
    <td class="xl65"></td>
    <td class="xl65"></td>
</tr>