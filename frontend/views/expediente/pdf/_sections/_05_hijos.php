<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$tieneHijos = (int)($alumInfoHijos->tiene_hijos ?? 0);
$cantidadHijos = $alumInfoHijos->cantidad_hijos ?? null;
$hayListado = !empty($edadesHijos);
if ($tieneHijos !== 1 && $hayListado) {
    $tieneHijos = 1;
}

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'V. Informacion de hijos',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($tieneHijos, $cantidadHijos, $edadesHijos, $view) {
        ?>
        <table>
            <tr>
                <td class="label">¿Tiene hijos?</td>
                <td class="value"><?= F::bool($tieneHijos) ?></td>
            </tr>

            <?php if ($tieneHijos === 1): ?>
                <tr>
                    <td class="label">Cantidad de hijos</td>
                    <td class="value"><?= F::fmt($cantidadHijos) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No registra hijos.</span></td>
                </tr>
            <?php endif; ?>
        </table>

        <?php if ($tieneHijos === 1): ?>
            <?= $view->render('../_components/_divider') ?>

            <?php if (!empty($edadesHijos)): ?>
                <h3>Listado de hijos</h3>
                <table>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Nombre completo</th>
                        <th style="width:120px;">Fecha nacimiento</th>
                        <th style="width:60px;">Edad</th>
                    </tr>
                    <?php foreach ($edadesHijos as $i => $h): ?>
                        <?php
                        $nombreCompletoHijo = trim(($h->nombre ?? '') . ' ' . ($h->apellido_paterno ?? '') . ' ' . ($h->apellido_materno ?? ''));
                        $edad = F::ageYears($h->fecha_nacimiento ?? null);
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= F::fmt($nombreCompletoHijo ?: null) ?></td>
                            <td><?= F::date($h->fecha_nacimiento ?? null) ?></td>
                            <td><?= F::fmt($edad !== null ? (string)$edad : null) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="muted">No hay registros detallados de hijos.</p>
            <?php endif; ?>
        <?php endif; ?>
        <?php
    },
]);
