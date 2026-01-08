<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$recreacionModel = $alumRecreacionTiempo ?? (object)[];

$tieneAccesoInternet = $recreacionModel->tienes_acceso_internet ?? null;
$sabeUsarInternet = $recreacionModel->sabes_usar_internet ?? null;

$lugarAccesoId = $recreacionModel->catalogo_lugares_acceso_principal_id ?? null;
$lugarAccesoTxt = $lugarAccesoId !== null ? F::map($lugarAccesoId, $catalogoLugaresAccesoMap ?? []) : null;
if (!$lugarAccesoTxt && !empty($recreacionModel->catalogoLugaresAccesoPrincipal->nombre ?? null)) {
    $lugarAccesoTxt = $recreacionModel->catalogoLugaresAccesoPrincipal->nombre;
}

$usosIds = $usosInternetSeleccionados ?? [];
if (empty($usosIds) && !empty($recreacionModel->usosInternets ?? null)) {
    foreach ($recreacionModel->usosInternets as $ui) {
        if (isset($ui->catalogo_usos_internet_id)) {
            $usosIds[] = (int)$ui->catalogo_usos_internet_id;
        }
    }
}

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'XIV. Conexión y uso de internet',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($tieneAccesoInternet, $lugarAccesoTxt, $sabeUsarInternet, $usosIds, $catalogoUsosInternetMap, $view) {
        ?>
        <h3>Conectividad</h3>
        <table>
            <tr>
                <td class="label">Tienes acceso a internet</td>
                <td class="value"><?= F::bool($tieneAccesoInternet) ?></td>
            </tr>
            <?php if ((int)$tieneAccesoInternet === 1): ?>
                <tr>
                    <td class="label">Punto de acceso habitual</td>
                    <td class="value"><?= F::fmt($lugarAccesoTxt) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No cuenta con acceso a internet.</span></td>
                </tr>
            <?php endif; ?>
        </table>

        <?= $view->render('../_components/_divider') ?>

        <h3>Usos principales</h3>
        <table>
            <tr>
                <td class="label">Sabes usar internet</td>
                <td class="value"><?= F::bool($sabeUsarInternet) ?></td>
            </tr>
            <?php if ((int)$sabeUsarInternet === 1): ?>
                <tr>
                    <td class="label">¿Para qué usas internet?</td>
                    <td class="value">
                        <?php
                        $usoTxt = F::listByIds($usosIds, $catalogoUsosInternetMap ?? []);
                        ?>
                        <?= $usoTxt !== 'No registrado' ? $usoTxt : '<span class="muted">Sin usos registrados.</span>' ?>
                    </td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No registra usos de internet.</span></td>
                </tr>
            <?php endif; ?>
        </table>
        <?php
    },
]);
