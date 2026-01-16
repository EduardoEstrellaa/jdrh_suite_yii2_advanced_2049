<?php

namespace backend\services\reportes;

use Yii;

class ReportChartService
{
    private const BASE_URL = 'https://quickchart.io/chart';

    /**
     * Generates a QuickChart PNG image encoded in base64.
     */
    public function generateQuickChart(string $title, array $labels, array $values, string $type = 'bar'): ?string
    {
        if (empty($labels) || empty($values)) {
            return null;
        }

        $palette = $this->palette();
        $backgrounds = [];
        foreach ($labels as $index => $_) {
            $backgrounds[] = $palette[$index % count($palette)];
        }

        $maxValue = max($values);

        $config = [
            'type' => $type,
            'data' => [
                'labels' => array_values($labels),
                'datasets' => [
                    [
                        'label' => '',
                        'data' => array_values($values),
                        'backgroundColor' => $backgrounds,
                        'borderColor' => '#94a3b8',
                        'borderWidth' => 1,
                        'borderSkipped' => 'bottom',
                        'borderRadius' => 8,
                        'barPercentage' => 0.7,
                        'categoryPercentage' => 0.7,
                    ],
                ],
            ],
            'options' => $this->chartOptions($title, $type, $maxValue),
        ];

        $params = [
            'c' => json_encode($config, JSON_UNESCAPED_UNICODE),
            'width' => 600,
            'height' => 360,
            'format' => 'png',
            'backgroundColor' => 'transparent',
        ];

        $url = self::BASE_URL . '?' . http_build_query($params);
        $image = @file_get_contents($url);
        if ($image === false) {
            Yii::warning('QuickChart returned no data for ' . $url, __METHOD__);
            return null;
        }

        return base64_encode($image);
    }

    private function chartOptions(string $title, string $type, int $maxValue): array
    {
        $options = [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => $type !== 'bar',
                    'position' => 'bottom',
                ],
                'title' => [
                    'display' => true,
                    'text' => $title,
                    'font' => [
                        'size' => 14,
                    ],
                ],
            ],
            'layout' => [
                'padding' => [
                    'left' => 12,
                    'right' => 12,
                    'top' => 10,
                    'bottom' => 5,
                ],
            ],
        ];

        if ($type === 'bar') {
            $options['scales'] = [
                'x' => [
                    'ticks' => [
                        'maxRotation' => 0,
                        'minRotation' => 0,
                        'autoSkip' => false,
                        'font' => [
                            'size' => 10,
                        ],
                    ],
                    'grid' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                        'stepSize' => 1,
                        'callback' => 'function(value){ return Number.isInteger(value) ? value : \"\"; }',
                    ],
                    'suggestedMin' => 0,
                    'suggestedMax' => $maxValue + 1,
                    'grid' => [
                        'borderDash' => [2, 4],
                    ],
                ],
            ];
        } else {
            $options['cutout'] = '55%';
            $options['plugins']['datalabels'] = [
                'color' => '#111827',
                'font' => [
                    'size' => 12,
                    'weight' => '600',
                ],
                'formatter' => 'function(value){ return value ? value : \"\"; }',
                'anchor' => 'center',
                'align' => 'center',
            ];
            $options['plugins']['tooltip'] = [
                'callbacks' => [
                    'label' => 'function(context){ return context.label + \": \" + context.formattedValue; }',
                ],
            ];
        }

        return $options;
    }

    private function palette(): array
    {
        return ['#2563eb', '#f97316', '#059669', '#8b5cf6', '#e11d48', '#38bdf8'];
    }

    public function paletteColors(): array
    {
        return $this->palette();
    }
}
