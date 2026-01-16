<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'I. Datos academicos',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'extraClass' => 'section-academicos',
    'body' => function () use ($section, $view) {
        echo $view->render('../_components/_kvTable', ['rows' => $section['rows'] ?? []]);
    },
]);
