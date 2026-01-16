<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

/** @var \common\models\AlumHabitosConsumo|null $habitosModel */
$habitosModel = $alumHabitosConsumo ?? ($alumHabitos ?? null);

$fuma = $habitosModel ? ($habitosModel->fumas ?? null) : null;

$cigarrosDiaTxt = null;
if ($habitosModel && !empty($habitosModel->catalogoCigarrosDia) && !empty($habitosModel->catalogoCigarrosDia->nombre)) {
    $cigarrosDiaTxt = $habitosModel->catalogoCigarrosDia->nombre;
} else {
    $cigarrosDiaTxt = $habitosModel ? F::fmt($habitosModel->catalogo_cigarros_dia_id ?? null) : null;
}

$tomaAlcohol = $habitosModel ? ($habitosModel->tomas_alcohol ?? null) : null;

$alcoholFreTxt = null;
if ($habitosModel) {
    if (!empty($habitosModel->frecuenciaVecesSemana) && !empty($habitosModel->frecuenciaVecesSemana->nombre)) {
        $alcoholFreTxt = $habitosModel->frecuenciaVecesSemana->nombre;
    } else {
        $alcoholFreId = $habitosModel->frecuencia_veces_semana_id ?? null;

        $mapAlcoholFre = $frecuenciaVecesSemanaMap
            ?? $frecuenciasVecesSemanaMap
            ?? $frecuenciasVecesSemanaOptions
            ?? [];

        if ($alcoholFreId !== null && is_array($mapAlcoholFre) && !empty($mapAlcoholFre)) {
            $alcoholFreTxt = $mapAlcoholFre[(int)$alcoholFreId] ?? null;
        }
    }
}

$tieneAdicciones = $habitosModel ? ($habitosModel->tienes_adicciones ?? null) : null;
$adiccionDetalle = $habitosModel ? trim((string)($habitosModel->especificiar_adiccion ?? '')) : '';

$adiccionDetalleVista = 'No tiene adicciones.';
if ((int)$tieneAdicciones === 1) {
    $adiccionDetalleVista = $adiccionDetalle !== '' ? $adiccionDetalle : 'Sin detalle registrado.';
}

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'XIII. Habitos (tabaco, alcohol y adicciones)',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($fuma, $cigarrosDiaTxt, $tomaAlcohol, $alcoholFreTxt, $tieneAdicciones, $adiccionDetalleVista, $view) {
        ?>
        <h3>Consumo de tabaco y alcohol</h3>
        <table>
            <tr>
                <td class="label">Fumas</td>
                <td class="value"><?= F::bool($fuma) ?></td>
            </tr>
            <?php if ((int)$fuma === 1): ?>
                <tr>
                    <td class="label">Si fumas, ¿cuantos cigarros por dia?</td>
                    <td class="value"><?= F::fmt($cigarrosDiaTxt) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="label">Consumes alcohol</td>
                <td class="value"><?= F::bool($tomaAlcohol) ?></td>
            </tr>
            <?php if ((int)$tomaAlcohol === 1): ?>
                <tr>
                    <td class="label">Frecuencia semanal de alcohol</td>
                    <td class="value"><?= F::fmt($alcoholFreTxt) ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <?= $view->render('../_components/_divider') ?>

        <h3>Otras adicciones</h3>
        <table>
            <tr>
                <td class="label">Tienes adicciones</td>
                <td class="value"><?= F::bool($tieneAdicciones) ?></td>
            </tr>
            <tr>
                <td class="label">Detalle</td>
                <td class="value">
                    <?php if ((int)$tieneAdicciones === 1): ?>
                        <?= F::fmt($adiccionDetalleVista) ?>
                    <?php else: ?>
                        <span class="muted"><?= F::fmt($adiccionDetalleVista) ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <?php
    },
]);
