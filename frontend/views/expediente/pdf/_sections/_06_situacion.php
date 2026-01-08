<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$eco = $ecoPdf ?? [];
$dep = $eco['dependencia'] ?? [];
$dps = $eco['dependientes'] ?? [];

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'VI. Situacion socioeconomica',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($dep, $dps, $alumTrabajo, $view) {
        ?>
        <h3>Dependencia economica</h3>
        <table>
            <?php if (!empty($dep['hay'])): ?>
                <tr>
                    <td class="label">¿De quién depende tu economía?</td>
                    <td class="value"><?= F::fmt($dep['deQuienTxt'] ?? null) ?></td>
                </tr>
                <?php if (!empty($dep['otroTxt'])): ?>
                    <tr>
                        <td class="label">Especificación</td>
                        <td class="value"><?= F::fmt($dep['otroTxt']) ?></td>
                    </tr>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted"><?= F::fmt($dep['detalle'] ?? null) ?></span></td>
                </tr>
            <?php endif; ?>
        </table>

        <?= $view->render('../_components/_divider') ?>

        <h3>Dependientes economicos</h3>
        <table>
            <tr>
                <td class="label">¿Tienes dependientes?</td>
                <td class="value"><?= F::bool((int)($dps['tiene'] ?? 0)) ?></td>
            </tr>

            <?php if (!empty($dps['hay'])): ?>
                <?php if (!empty($dps['listaTxt'])): ?>
                    <tr>
                        <td class="label">¿Quiénes dependen de ti?</td>
                        <td class="value"><?= F::fmt($dps['listaTxt']) ?></td>
                    </tr>
                <?php endif; ?>

                <?php if (!empty($dps['otroTxt'])): ?>
                    <tr>
                        <td class="label">Especificación</td>
                        <td class="value"><?= F::fmt($dps['otroTxt']) ?></td>
                    </tr>
                <?php endif; ?>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted"><?= F::fmt($dps['detalle'] ?? null) ?></span></td>
                </tr>
            <?php endif; ?>
        </table>

        <?= $view->render('../_components/_divider') ?>

        <h3>Trabajo</h3>

        <?php
        $tieneTrabajo = (int)($alumTrabajo->tiene_trabajo ?? 0);
        $empresa = trim((string)($alumTrabajo->nombre_empresa ?? '')) ?: null;
        $puesto = trim((string)($alumTrabajo->puesto_ocupacion ?? '')) ?: null;
        $entrada = $alumTrabajo->horario_entrada ?? null;
        $salida = $alumTrabajo->horario_salida ?? null;
        ?>

        <table>
            <tr>
                <td class="label">¿Tienes trabajo?</td>
                <td class="value"><?= F::bool($tieneTrabajo) ?></td>
            </tr>

            <?php if ($tieneTrabajo === 1): ?>
                <tr>
                    <td class="label">Empresa</td>
                    <td class="value"><?= F::fmt($empresa) ?></td>
                </tr>
                <tr>
                    <td class="label">Puesto / Ocupación</td>
                    <td class="value"><?= F::fmt($puesto) ?></td>
                </tr>
                <tr>
                    <td class="label">Hora de entrada</td>
                    <td class="value"><?= F::time($entrada) ?></td>
                </tr>
                <tr>
                    <td class="label">Hora de salida</td>
                    <td class="value"><?= F::time($salida) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No cuenta con empleo registrado.</span></td>
                </tr>
            <?php endif; ?>
        </table>
        <?php
    },
]);
