<?php

namespace frontend\services;

use frontend\services\pdf\MpdfRenderer;
use yii\web\Response;

/** @deprecated Use {@see \frontend\services\pdf\MpdfRenderer} directly. */
class PdfRenderer
{
    private MpdfRenderer $renderer;

    public function __construct(?MpdfRenderer $renderer = null)
    {
        $this->renderer = $renderer ?? new MpdfRenderer();
    }

    public function renderInline(string $html, string $filename = 'expediente.pdf', array $mpdfConfig = []): Response
    {
        return $this->renderer->renderInline($html, $filename, $mpdfConfig);
    }
}
