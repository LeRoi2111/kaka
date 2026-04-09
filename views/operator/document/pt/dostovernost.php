<?php
/** @var array $data Массив данных из контроллера */
use yii\helpers\Html;

// === Подготовка данных ===
$fioRaw = trim($data['staff_fio'] ?? '');
$fioParts = explode(' ', $fioRaw);
$staffLast = $fioParts[0] ?? '';
$staffFirst = $fioParts[1] ?? '';
$staffMiddle = $fioParts[2] ?? '';

$makeChars = function($str) {
    $clean = mb_strtoupper(preg_replace('/[^A-ZА-ЯЁ\s\-\.]/ui', '', $str));
    return mb_str_split(str_pad($clean, 20, ' ', STR_PAD_RIGHT));
};

$lastChars   = $makeChars($staffLast);
$firstChars  = $makeChars($staffFirst);
$middleChars = $makeChars($staffMiddle);

// Дата подписи
$docDate = $data['doc_date'] ?? '';
if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $docDate)) {
    $docDate = date('d.m.Y', strtotime($docDate));
}
$dateChars = mb_str_split(str_pad(preg_replace('/[^\d\.]/', '', $docDate), 10, ' ', STR_PAD_RIGHT));

// Количество страниц
$pageChars = mb_str_split(str_pad($data['pages_count'] ?? '1', 3, ' ', STR_PAD_LEFT));
?>

<!-- Шапка: Достоверность + QR -->
<tr class="xl67" height="28" style="mso-height-source:userset;height:21.0pt">
    <td colspan="42" rowspan="2" height="47" class="xl94" width="378" style="height:35.25pt;width:294pt">Достоверность и полноту сведений, указанных <br> в настоящей справке, подтверждаю:</td>
    <td colspan="38" class="xl85">Зона QR-кода<span style="mso-spacerun:yes">&nbsp;</span></td>
    <td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="19" style="mso-height-source:userset;height:14.25pt">
    <td colspan="38" height="19" class="xl70" style="height:14.25pt">&nbsp;</td>
    <td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- ФАМИЛИЯ -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <?php for ($i = 0; $i < 13; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= isset($lastChars[$i]) && $lastChars[$i] !== ' ' ? Html::encode($lastChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>

    <td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="25" class="xl75"></td><td colspan="2" class="xl73"></td><td colspan="2" class="xl73"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="8" style="mso-height-source:userset;height:6.0pt">
    <td height="8" class="xl67" style="height:6.0pt"></td>
    <?php for ($i = 0; $i < 20; $i++): ?><td colspan="2" class="xl96">&nbsp;</td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="20" class="xl87" width="180" style="width:140pt"></td><td colspan="16" class="xl72"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- ИМЯ -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <?php for ($i = 0; $i < 12; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $firstChars[$i] !== ' ' ? Html::encode($firstChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>
    <td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="25" class="xl75"></td><td colspan="2" class="xl73"></td><td colspan="2" class="xl73"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="8" style="mso-height-source:userset;height:6.0pt">
    <td height="8" class="xl67" style="height:6.0pt"></td>
    <?php for ($i = 0; $i < 20; $i++): ?><td colspan="2" class="xl96">&nbsp;</td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="20" class="xl87" width="180" style="width:140pt"></td><td colspan="16" class="xl72"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- ОТЧЕСТВО -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <?php for ($i = 0; $i < 12; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            <?= $middleChars[$i] !== ' ' ? Html::encode($middleChars[$i]) : '&nbsp;' ?>
        </td>
    <?php endfor; ?>
    <td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"><td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="25" class="xl75"></td><td colspan="2" class="xl73"></td><td colspan="2" class="xl73"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="8" style="mso-height-source:userset;height:6.0pt">
    <td height="8" class="xl67" style="height:6.0pt"></td>
    <?php for ($i = 0; $i < 20; $i++): ?><td colspan="2" class="xl96">&nbsp;</td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="20" class="xl87" width="180" style="width:140pt"></td><td colspan="16" class="xl72"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- Подпись (расшифровка) -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <td colspan="40" class="xl69">(фамилия, имя, отчество<font class="font18"><sup>1</sup></font><font class="font7">)</font></td>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- Разделительные строки -->
<tr class="xl67" height="8" style="mso-height-source:userset;height:6.0pt">
    <td height="8" class="xl67" style="height:6.0pt"></td>
    <?php for ($i = 0; $i < 20; $i++): ?><td colspan="2" class="xl67"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td>
    <?php for ($i = 0; $i < 24; $i++): ?><td class="xl67"></td><?php endfor; ?>
    <td class="xl72"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="8" style="mso-height-source:userset;height:6.0pt">
    <td height="8" class="xl67" style="height:6.0pt"></td>
    <?php for ($i = 0; $i < 20; $i++): ?><td colspan="2" class="xl67"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="36" class="xl111" width="324" style="width:252pt"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- Дата подписи -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <td colspan="6" class="xl75">Подпись</td>
    <td colspan="10" class="xl110">&nbsp;</td>
    <td colspan="4" class="xl67" style="border-right:.5pt dotted black">Дата</td>
    <?php for ($i = 0; $i < 10; $i++): ?>
        <?php if ($i === 2 || $i === 5): ?>
            <td colspan="2" class="xl92" style="border-right:.5pt dotted black;border-left:none">.</td>
        <?php else: ?>
            <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
                <?= $dateChars[$i] !== ' ' ? Html::encode($dateChars[$i]) : '&nbsp;' ?>
            </td>
        <?php endif; ?>
    <?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="36" class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="16" style="mso-height-source:userset;height:12.0pt">
    <td height="16" class="xl67" style="height:12.0pt"></td>
    <td colspan="6" class="xl75"></td><td colspan="10" class="xl67"></td><td colspan="4" class="xl67"></td>
    <?php for ($i = 0; $i < 10; $i++): ?><td colspan="2" class="xl67"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="36" class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<!-- Количество страниц -->
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <td class="xl75" colspan="15" style="mso-ignore:colspan">Справка составлена на<span style="display:none"><span style="mso-spacerun:yes">&nbsp;</span></span></td>
    <?php for ($i = 0; $i < 1; $i++): ?>
        <td colspan="2" class="xl88" style="border-right:.5pt dotted black<?= $i > 0 ? ';border-left:none' : '' ?>">
            2
        </td>
    <?php endfor; ?>
    <td class="xl67"></td>
    <td class="xl75" colspan="8" style="mso-ignore:colspan">страницах<span style="mso-spacerun:yes">&nbsp;</span></td>
    <?php for ($i = 0; $i < 14; $i++): ?><td class="xl73"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td>
    <?php for ($i = 0; $i < 14; $i++): ?><td class="xl67"></td><?php endfor; ?>
</tr>

<!-- Нижние пустые строки -->
<?php for ($r = 0; $r < 4; $r++): ?>
<tr class="xl67" height="23" style="mso-height-source:userset;height:17.25pt">
    <td height="23" class="xl67" style="height:17.25pt"></td>
    <?php for ($c = 0; $c < 3; $c++): ?><td class="xl75"></td><?php endfor; ?>
    <?php for ($c = 0; $c < 2; $c++): ?><td class="xl67"></td><?php endfor; ?>
    <?php for ($c = 0; $c < 2; $c++): ?><td class="xl73"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl75"></td><td class="xl67"></td>
    <?php for ($c = 0; $c < 30; $c++): ?><td class="xl73"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td>
    <?php for ($c = 0; $c < 20; $c++): ?><td class="xl67"></td><?php endfor; ?>
</tr>
<?php endfor; ?>

<tr class="xl67" height="4" style="mso-height-source:userset;height:3.0pt">
    <td height="4" class="xl67" style="height:3.0pt"></td>
    <td colspan="6" class="xl75"></td><td colspan="10" class="xl67"></td><td colspan="4" class="xl67"></td>
    <?php for ($i = 0; $i < 10; $i++): ?><td colspan="2" class="xl67"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl70">&nbsp;</td><td colspan="36" class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<tr class="xl67" height="39" style="mso-height-source:userset;height:29.25pt">
    <td height="39" class="xl67" style="height:29.25pt"></td>
    <td class="xl78" width="9" style="width:7pt"></td>
    <td colspan="76" class="xl80" width="684" style="width:532pt">
        <font class="font18"><sup>1</sup></font><font class="font7"> Отчество указывается при наличии (относится ко всем листам документа). <br></font>
        <font class="font18"><sup>2</sup></font><font class="font7"> ИНН указывается при наличии.</font>
    </td>
    <td class="xl78" width="9" style="width:7pt"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<?php for ($r = 0; $r < 4; $r++): ?>
<tr class="xl67" height="3" style="mso-height-source:userset;height:2.25pt">
    <td height="3" class="xl67" style="height:2.25pt"></td>
    <td class="<?= $r === 3 ? 'xl76' : 'xl78' ?>" width="9" style="width:7pt"></td>
    <td colspan="76" class="xl80" width="684" style="width:532pt"></td>
    <td class="<?= $r === 3 ? 'xl76' : 'xl78' ?>" width="9" style="width:7pt"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<?php endfor; ?>

<tr class="xl67" height="3" style="mso-height-source:userset;height:2.25pt">
    <td height="3" class="xl67" style="height:2.25pt"></td>
    <td class="xl67"></td>
    <?php for ($c = 0; $c < 76; $c++): ?><td class="xl80" width="9" style="width:7pt"></td><?php endfor; ?>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>
<tr class="xl67" height="3" style="mso-height-source:userset;height:2.25pt">
    <td height="3" class="xl67" style="height:2.25pt"></td>
    <td class="xl67"></td><td colspan="76" class="xl80" width="684" style="width:532pt"></td>
    <td class="xl67"></td><td class="xl67"></td><td class="xl67"></td><td class="xl67"></td>
</tr>

<tr height="19" style="mso-height-source:userset;height:14.25pt">
    <td colspan="2" height="19" class="xl66" style="height:14.25pt">&nbsp;</td>
    <td colspan="76" class="xl80" width="684" style="width:532pt"></td>
    <td class="xl66">&nbsp;</td><td class="xl66">&nbsp;</td><td class="xl65"></td><td class="xl65"></td>
</tr>

<tr height="4" style="mso-height-source:userset;height:3.0pt">
    <td height="4" class="xl65" style="height:3.0pt"></td>
    <?php for ($c = 0; $c < 78; $c++): ?><td class="xl65"></td><?php endfor; ?>
</tr>

<!--[if supportMisalignedColumns]-->
<tr height="0" style="display:none">
    <?php for ($c = 0; $c < 78; $c++): ?><td width="9" style="width:7pt"></td><?php endfor; ?>
    <td width="2" style="width:2pt"></td><td width="9" style="width:7pt"></td>
</tr>