<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$v = $viviendaPdf ?? [];
$hay = (bool)($v['hayViviendaInfo'] ?? false);

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'VII. Bienes y servicios de la vivienda',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($v, $hay, $tiposViviendasMap, $tipoViviendaOtroId, $catalogoBienesOptions, $catalogoServiciosViviendaOptions, $view) {
        ?>
        <?php if (!$hay): ?>
            <table>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">No registró información de vivienda y servicios.</span></td>
                </tr>
            </table>
        <?php else: ?>

            <h3>Vivienda</h3>
            <table>
                <tr>
                    <td class="label">¿Vives con tus padres?</td>
                    <td class="value"><?= F::bool($v['viveConPadres'] ?? null) ?></td>
                </tr>
                <?php if (!empty($v['viveConEspecifica'])): ?>
                    <tr>
                        <td class="label">Especifica</td>
                        <td class="value"><?= F::fmt($v['viveConEspecifica']) ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td class="label">Tipo de vivienda</td>
                    <td class="value"><?= F::map(($v['tipoViviendaId'] ?? null), $tiposViviendasMap ?? []) ?></td>
                </tr>
                <?php
                $tipoOtroId = $tipoViviendaOtroId ?? null;
                $esTipoOtro = $tipoOtroId !== null && (int)($v['tipoViviendaId'] ?? 0) === (int)$tipoOtroId;
                if ($esTipoOtro && !empty($v['tipoViviendaOtro'])): ?>
                    <tr>
                        <td class="label">Especifica “Otro”</td>
                        <td class="value"><?= F::fmt($v['tipoViviendaOtro']) ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <?= $view->render('../_components/_divider') ?>

            <h3>Bienes de la vivienda</h3>
            <?php if (!empty($v['bienesSeleccionados']) || !empty($v['bienesOtro'])): ?>
                <table>
                    <tr>
                        <td class="label">Seleccionados</td>
                        <td class="value">
                            <?= F::listByIds($v['bienesSeleccionados'] ?? [], $catalogoBienesOptions ?? []) ?>
                            <?php if (!empty($v['bienesOtro'])): ?>
                                <br><span class="muted">Otro:</span> <?= F::fmt($v['bienesOtro']) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <p class="muted">Sin bienes registrados.</p>
            <?php endif; ?>

            <?= $view->render('../_components/_divider') ?>

            <h3>Servicios de la vivienda</h3>
            <?php if (!empty($v['serviciosSeleccionados']) || !empty($v['serviciosOtro'])): ?>
                <table>
                    <tr>
                        <td class="label">Servicios disponibles</td>
                        <td class="value">
                            <?= F::listByIds($v['serviciosSeleccionados'] ?? [], $catalogoServiciosViviendaOptions ?? []) ?>
                            <?php if (!empty($v['serviciosOtro'])): ?>
                                <br><span class="muted">Otro:</span> <?= F::fmt($v['serviciosOtro']) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <p class="muted">Sin servicios registrados.</p>
            <?php endif; ?>
        <?php endif; ?>
        <?php
    },
]);
