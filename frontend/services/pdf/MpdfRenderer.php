<?php

namespace frontend\services\pdf;

use Yii;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use yii\helpers\FileHelper;
use yii\web\Response;

class MpdfRenderer
{
    // This class isolates all mpdf setup details so caller can focus on html generation and response handling.
    private const DEFAULT_CONFIG = [
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 12,
        'margin_bottom' => 12,
    ];

    private string $runtimeDir;

    public function __construct()
    {
        // Ensure runtime directory exists for mpdf temp files.
        $this->runtimeDir = FileHelper::normalizePath(Yii::getAlias('@runtime/mpdf'));
        FileHelper::createDirectory($this->runtimeDir);
    }

    public function renderInline(string $html, string $filename = 'expediente.pdf', array $mpdfConfig = []): Response
    {
        $config = array_merge(
            ['tempDir' => $this->runtimeDir],
            self::DEFAULT_CONFIG,
            $mpdfConfig
        );

        $mpdf = new Mpdf($config);
        $mpdf->WriteHTML($html);

        // Conservamos STRING_RETURN para no alterar el comportamiento actual.
        $content = $mpdf->Output('', Destination::STRING_RETURN);

        return Yii::$app->response->sendContentAsFile(
            $content,
            $filename,
            [
                'mimeType' => 'application/pdf',
                'inline' => true,
            ]
        );
    }
}
