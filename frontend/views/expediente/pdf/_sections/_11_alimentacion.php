<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'XI. Alimentación y consumo',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($lugaresComerSeleccionados, $catalogoLugaresComerMap, $lugaresComerOtroMap, $lugarComerOtro, $consumoAlimentos, $catalogoAlimentosMap, $frecuenciasVecesMap, $view) {
        ?>
        <h3>Lugares donde sueles comer</h3>
        <table>
            <tr>
                <td class="label">Lugares</td>
                <td class="value">
                    <?= F::listByIds($lugaresComerSeleccionados ?? [], $catalogoLugaresComerMap ?? []) ?>
                    <?php if (!empty($lugaresComerOtroMap)): ?>
                        <?php foreach ($lugaresComerOtroMap as $cid => $texto): ?>
                            <br><span class="muted"><?= F::map($cid, $catalogoLugaresComerMap ?? []) ?>:</span> <?= F::fmt($texto) ?>
                        <?php endforeach; ?>
                    <?php elseif (!empty($lugarComerOtro)): ?>
                        <br><span>Otro:</span> <?= F::fmt($lugarComerOtro) ?>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <?= $view->render('../_components/_divider') ?>

        <h3>Frecuencia de consumo de alimentos</h3>
        <?php if (!empty($consumoAlimentos)): ?>
            <table>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Grupo de alimento</th>
                    <th style="width:190px;">Frecuencia semanal (veces)</th>
                </tr>
                <?php foreach ($consumoAlimentos as $i => $c): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= F::map($c->catalogo_alimentos_id ?? null, $catalogoAlimentosMap ?? []) ?></td>
                        <td><?= F::map($c->frecuencia_veces_id ?? null, $frecuenciasVecesMap ?? []) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="muted">Sin registros de consumo de alimentos.</p>
        <?php endif; ?>
        <?php
    },
]);
