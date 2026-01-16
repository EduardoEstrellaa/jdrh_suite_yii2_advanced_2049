<?php

use frontend\services\pdf\PdfValueFormatter as F;

/** @var array $section */

$blocks = $section['blocks'] ?? [];
$view = $this;

echo $view->render('../_components/_sectionCard', [
    'title' => $section['title'] ?? 'X. Información de salud',
    'pageBlock' => $section['pageBlock'] ?? true,
    'useCard' => $section['useCard'] ?? true,
    'pageBreakAfter' => $section['pageBreakAfter'] ?? false,
    'body' => function () use ($blocks, $view) {
        foreach ($blocks as $block) {
            $type = $block['type'] ?? 'kv';

            if ($type === 'divider') {
                echo $view->render('../_components/_divider');
                continue;
            }

            if ($type === 'kv') {
                if (!empty($block['title'])) {
                    echo "<h3>{$block['title']}</h3>";
                }
                echo $view->render('../_components/_kvTable', [
                    'rows' => $block['rows'] ?? [],
                ]);
                continue;
            }

            if ($type === 'table') {
                if (!empty($block['title'])) {
                    echo "<h3>{$block['title']}</h3>";
                }

                $rows = $block['rows'] ?? [];
                if (!empty($rows)) {
                    echo $view->render('../_components/_tableList', [
                        'headers' => $block['headers'] ?? [],
                        'rows' => $rows,
                    ]);
                } else {
                    $emptyText = $block['emptyText'] ?? 'Sin registros.';
                    echo '<p class="muted">' . F::fmt($emptyText) . '</p>';
                }
                continue;
            }

            if ($type === 'list') {
                $items = $block['items'] ?? [];
                if (!empty($block['title'])) {
                    echo "<h3>{$block['title']}</h3>";
                }

                if (!empty($items)) {
                    echo '<ul>';
                    foreach ($items as $item) {
                        $label = $item['label'] ?? null;
                        $extra = $item['extra'] ?? null;
                        echo '<li>' . F::fmt($label);
                        if ($extra !== null) {
                            echo ' <span class="muted">(Otro: ' . F::fmt($extra) . ')</span>';
                        }
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    $emptyText = $block['emptyText'] ?? 'Sin registros.';
                    echo '<p class="muted">' . F::fmt($emptyText) . '</p>';
                }
            }
        }
    },
]);
