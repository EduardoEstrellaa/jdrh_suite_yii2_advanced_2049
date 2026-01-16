<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$participaOrg = F::firstProp($alumOrganizaciones ?? null, [
    'participa',
    'participa_organizacion',
    'tiene_organizacion',
    'pertenece_organizacion',
]);
if ($participaOrg === null) {
    $participaOrg = !empty($organizacionesSeleccionadas) ? 1 : 0;
}

$orgTxt = 'No registrado';
if (!empty($organizacionesSeleccionadas)) {
    $map = $catalogoOrganizacionesMap ?? [];
    if (is_array($map) && !empty($map)) {
        $orgTxt = F::listByIds($organizacionesSeleccionadas, $map);
    } else {
        $orgTxt = implode(', ', array_map('strval', $organizacionesSeleccionadas));
    }
}

$orgOtro = F::firstProp($alumOrganizaciones ?? null, [
    'otro_especificar',
    'organizacion_otro',
    'otro',
]);

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'XV. Organizaciones y participación',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($participaOrg, $orgTxt, $orgOtro) {
        ?>
        <table>
            <tr>
                <td class="label">Participas en alguna organización</td>
                <td class="value"><?= F::bool($participaOrg) ?></td>
            </tr>
            <?php if ((int)$participaOrg === 1): ?>
                <tr>
                    <td class="label">Tus organizaciones</td>
                    <td class="value">
                        <?= F::fmt($orgTxt) ?>
                        <?php if (!empty($orgOtro)): ?>
                            <br><span class="muted">Otro:</span> <?= F::fmt($orgOtro) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No participa en organizaciones.</span></td>
                </tr>
            <?php endif; ?>
        </table>
        <?php
    },
]);
