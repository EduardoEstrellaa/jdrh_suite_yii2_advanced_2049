<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$b = $becaPdf ?? [];
$tiene = (int)($b['tieneBeca'] ?? 0);
$tipo = $b['tipoTxt'] ?? null;
$otro = $b['otroTxt'] ?? null;
$esOtro = !empty($b['esOtro'] ?? false);
$otroTrim = trim((string)$otro);
$det = $b['detalle'] ?? null;

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'IV. Informacion de becas',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($tiene, $tipo, $esOtro, $otroTrim, $det) {
        ?>
        <table>
            <tr>
                <td class="label">¿Cuenta con beca?</td>
                <td class="value"><?= F::bool($tiene) ?></td>
            </tr>

            <?php if ($tiene === 1): ?>
                <tr>
                    <td class="label">Tipo de beca</td>
                    <td class="value">
                        <?php if (!empty($tipo)): ?>
                            <?= F::fmt($tipo) ?>
                        <?php else: ?>
                            <span class="muted">Sin tipo de beca registrado.</span>
                        <?php endif; ?>
                    </td>
                </tr>

                <?php if ($esOtro && $otroTrim !== ''): ?>
                    <tr>
                        <td class="label">Especificación</td>
                        <td class="value"><?= F::fmt($otroTrim) ?></td>
                    </tr>
                <?php endif; ?>

            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted"><?= F::fmt($det) ?></span></td>
                </tr>
            <?php endif; ?>
        </table>
        <?php
    },
]);
