<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

// Deportes
$practicaDeporte = F::firstProp($alumActividadFisica ?? null, ['practica_deporte', 'tiene_deporte', 'deporte', 'realiza_deporte']);
if ($practicaDeporte === null) {
    $practicaDeporte = !empty($deportesSeleccionados) ? 1 : 0;
}

// Ejercicio
$haceEjercicio = F::firstProp($alumEjercicioFisico ?? null, ['hace_ejercicio', 'realiza_ejercicio', 'ejercicio', 'actividad_fisica']);
if ($haceEjercicio === null) {
    $haceEjercicio = !empty($ejercicioFisicos) ? 1 : 0;
}

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'XII. Actividad física y deporte',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use (
        $practicaDeporte,
        $deportesSeleccionados,
        $catalogoDeportesMap,
        $haceEjercicio,
        $ejercicioFisicos,
        $catalogoActividadesEjercicioMap,
        $frecuenciasVecesSemanaMap,
        $view
    ) {
?>
    <h3>Deportes que practicas</h3>
    <table>
        <tr>
            <td class="label">¿Practicas algún deporte?</td>
            <td class="value"><?= F::bool($practicaDeporte) ?></td>
        </tr>

        <?php if ((int)$practicaDeporte === 1): ?>
            <tr>
                <td class="label">Deportes</td>
                <td class="value">
                    <?php $depTxt = F::listByIds($deportesSeleccionados ?? [], $catalogoDeportesMap ?? []); ?>
                    <?= $depTxt !== 'No registrado'
                        ? $depTxt
                        : '<span class="muted">Sin deportes registrados.</span>' ?>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td class="label">Detalle</td>
                <td class="value"><span class="muted">No practica deportes.</span></td>
            </tr>
        <?php endif; ?>
    </table>

    <?= $view->render('../_components/_divider') ?>

    <h3>Ejercicio físico</h3>

    <table>
        <tr>
            <td class="label">¿Haces ejercicio físico?</td>
            <td class="value"><?= F::bool($haceEjercicio) ?></td>
        </tr>

        <?php if ((int)$haceEjercicio === 0): ?>
            <tr>
                <td class="label">Detalle</td>
                <td class="value"><span class="muted">No realiza ejercicio físico.</span></td>
            </tr>
        <?php elseif (empty($ejercicioFisicos)): ?>
            <tr>
                <td class="label">Detalle</td>
                <td class="value"><span class="muted">Sin registros de ejercicio físico.</span></td>
            </tr>
        <?php endif; ?>
    </table>

    <?php if (!empty($ejercicioFisicos)): ?>
        <table>
            <tr>
                <th>#</th>
                <th>Actividad</th>
                <th>Frecuencia semanal</th>
            </tr>
            <?php foreach ($ejercicioFisicos as $i => $e): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= F::map($e->catalogo_actividad_ejercicio_id ?? null, $catalogoActividadesEjercicioMap ?? []) ?></td>
                    <td><?= F::map($e->frecuencia_veces_semana_id ?? null, $frecuenciasVecesSemanaMap ?? []) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php
    },
]);
