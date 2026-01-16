<?php

use frontend\services\pdf\PdfValueFormatter as F;
use common\models\TiempoRecorridoTransporte;

/** @var array $section */

$transporteId = F::firstProp($alumTransportes ?? null, ['catalogo_transportes_id', 'catalogo_transporte_id', 'transportes_id', 'transporte_id', 'medio_transporte_id']);
$tiempoId = F::firstProp($alumTransportes ?? null, ['tiempo_recorrido_transporte_id', 'tiempo_recorrido_id', 'tiempo_id']);

$transporteTxt = null;
if (!empty($alumTransportes) && !empty($alumTransportes->catalogoTransportes->nombre ?? null)) {
    $transporteTxt = $alumTransportes->catalogoTransportes->nombre;
} else {
    $transporteTxt = ($transporteId !== null)
        ? F::map($transporteId, $catalogoTransportesMap ?? ($catalogoTransportesOptions ?? []), '')
        : '';
}

$tiempoTxt = null;
if (!empty($alumTransportes) && !empty($alumTransportes->tiempoRecorridoTransporte->rango_tiempo ?? null)) {
    $tiempoTxt = $alumTransportes->tiempoRecorridoTransporte->rango_tiempo;
} else {
    if ($tiempoId !== null) {
        $mapTiempo =
            (isset($tiempoRecorridoTransporteMap) && is_array($tiempoRecorridoTransporteMap)) ? $tiempoRecorridoTransporteMap
            : ((isset($tiempoRecorridoTransporteOptions) && is_array($tiempoRecorridoTransporteOptions)) ? $tiempoRecorridoTransporteOptions
                : ((isset($tiempoRecorridoOptions) && is_array($tiempoRecorridoOptions)) ? $tiempoRecorridoOptions : []));

        if (empty($mapTiempo)) {
            $mapTiempo = TiempoRecorridoTransporte::dropdownOptions();
        }

        $tiempoTxt = $mapTiempo[(int)$tiempoId] ?? null;
    }
}

$transporteOtro = trim((string)F::firstProp($alumTransportes ?? null, ['otro_especificar', 'otro', 'transporte_otro'])) ?: null;

$hayTransporte = (trim((string)$transporteTxt) !== '') || !empty($transporteOtro) || !empty($tiempoTxt);

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'IX. Transporte y tiempos',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($hayTransporte, $transporteTxt, $transporteOtro, $tiempoTxt) {
        if ($hayTransporte): ?>
            <table>
                <tr>
                    <td class="label">Medio de transporte</td>
                    <td class="value">
                        <?= F::fmt($transporteTxt ?: null) ?>
                        <?php if (!empty($transporteOtro)): ?>
                            <br><span class="muted">Otro:</span> <?= F::fmt($transporteOtro) ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">Tiempo de recorrido</td>
                    <td class="value"><?= F::fmt($tiempoTxt) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <table>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No cuenta con información de transporte registrada.</span></td>
                </tr>
            </table>
        <?php endif;
    },
]);
