<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'VIII. Bienes personales',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($bienesPersonalesSeleccionados, $catalogoBienesPersonalesOptions) {
        if (empty($bienesPersonalesSeleccionados)) {
            ?>
            <table>
                <tr>
                    <td class="label">Detalle</td>
                    <td class="value"><span class="muted">Sin bienes registrados.</span></td>
                </tr>
            </table>
            <?php
            return;
        }
        ?>
        <table>
            <tr>
                <td class="label">Bienes personales</td>
                <td class="value"><?= F::listByIds($bienesPersonalesSeleccionados ?? [], $catalogoBienesPersonalesOptions ?? []) ?></td>
            </tr>
        </table>
        <?php
    },
]);
