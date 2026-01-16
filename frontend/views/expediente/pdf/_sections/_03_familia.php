<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'III. Datos familiares',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($section, $view) {
        echo '<h3>Datos del padre</h3>';
        echo $view->render('../_components/_kvTable', ['rows' => $section['padre'] ?? []]);

        echo $view->render('../_components/_divider');

        echo '<h3>Datos de la madre</h3>';
        echo $view->render('../_components/_kvTable', ['rows' => $section['madre'] ?? []]);
    },
]);
