<?php

namespace backend\services\reportes;

use kartik\mpdf\Pdf;
use Yii;
use yii\web\Controller;

/**
 * Servicio responsable de exportar reportes en distintos formatos.
 */
class ReportExportService
{
    /**
     * Genera un PDF a partir de la vista y parametros provistos.
     */
    public function generarPdf(string $titulo, string $vista, array $params, Controller $controller): string
    {
        $content = $controller->renderPartial($vista, $params);
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'marginTop' => 20,
            'marginBottom' => 20,
            'content' => $content,
            'cssFile' => $this->cssFileForView($vista),
            'options' => [
                'title' => $titulo,
            ],
            'methods' => [
                'SetHeader' => ['||' . $titulo . '||'],
                'SetFooter' => ['||Reportes oficiales | ' . date('Y-m-d H:i') . '||'],
            ],
        ]);

        return $pdf->render();
    }

    private function cssFileForView(string $vista): array
    {
        $fileName = basename($vista);
        $cssFiles = ['@backend/views/reportes/pdf/css/base.css'];

        if (!empty($fileName)) {
            $viewAlias = '@backend/views/reportes/pdf/css/' . $fileName . '.css';
            $viewPath = Yii::getAlias($viewAlias);
            if (file_exists($viewPath)) {
                $cssFiles[] = $viewAlias;
            }
        }

        return $cssFiles;
    }
}
