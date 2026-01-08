<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'II. Datos personales',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($section, $view) {
        foreach ($section['blocks'] ?? [] as $block) {
            if (($block['type'] ?? '') === 'divider') {
                echo $view->render('../_components/_divider');
                continue;
            }

            if (($block['type'] ?? '') === 'kv') {
                if (!empty($block['title'])) {
                    echo "<h3>{$block['title']}</h3>";
                }
                echo $view->render('../_components/_kvTable', [
                    'rows' => $block['rows'] ?? [],
                ]);
            }
        }
    },
]);
