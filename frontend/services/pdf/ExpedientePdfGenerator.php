<?php

namespace frontend\services\pdf;

use Yii;
use common\models\Alumnos;
use common\services\ExpedienteFacade;
use yii\web\NotFoundHttpException;
use yii\web\Response;

// Generator that orchestrates data loading, view rendering, and pdf streaming so controller stays thin.
class ExpedientePdfGenerator
{
    private ExpedienteFacade $facade;
    private MpdfRenderer $renderer;
    private string $viewFile;

    public function __construct(
        ExpedienteFacade $facade,
        MpdfRenderer $renderer,
        string $viewFile = '@frontend/views/expediente/pdf/_expediente.php'
    ) {
        $this->facade = $facade;
        $this->renderer = $renderer;
        $this->viewFile = $viewFile;
    }

    public function renderForAlumno(int $alumnoId, ?string $filename = null, array $mpdfConfig = []): Response
    {
        $data = $this->buildDataForAlumno($alumnoId);
        $filename = $filename ?? $this->buildFilename($data['alumno']);

        $html = Yii::$app->view->renderFile(
            $this->viewFile,
            $data
        );

        return $this->renderer->renderInline($html, $filename, $mpdfConfig);
    }

    public function buildDataForAlumno(int $alumnoId): array
    {
        $alumno = Alumnos::find()
            ->where(['id' => $alumnoId])
            ->with([
                'perfil.genero',
                'planLicenciaturas.licenciaturas',
                'generaciones',
            ])
            ->one();

        if (!$alumno) {
            throw new NotFoundHttpException('Alumno no encontrado.');
        }

        if (!$alumno->perfil) {
            throw new NotFoundHttpException('Perfil no encontrado para el alumno.');
        }

        $models = $this->facade->getUpdateData($alumno->perfil->id, $alumno->id);

        return $this->ensurePdfContracts(array_merge([
            'alumno' => $alumno,
            'perfil' => $alumno->perfil,
        ], $models));
    }

    private function buildFilename($alumno): string
    {
        $matricula = $alumno->matricula ?? $alumno->id;
        return 'Expediente_' . $matricula . '.pdf';
    }

    // Guarantee stable keys so view logic does not need to fallback on missing arrays.
    private function ensurePdfContracts(array $data): array
    {
        $data['becaPdf'] = $data['becaPdf'] ?? $this->defaultBecaPdf();
        $data['ecoPdf'] = $data['ecoPdf'] ?? $this->defaultEcoPdf();
        $data['viviendaPdf'] = $data['viviendaPdf'] ?? $this->defaultViviendaPdf();
        return $data;
    }

    private function defaultBecaPdf(): array
    {
        // Default structure consumed by the view when no beca record exists.
        return [
            'tieneBeca' => 0,
            'tipoTxt' => null,
            'otroTxt' => null,
            'esOtro' => false,
            'detalle' => 'No cuenta con beca registrada.',
        ];
    }

    private function defaultEcoPdf(): array
    {
        // Default economic dependency info for the view.
        return [
            'dependencia' => [
                'hay' => false,
                'deQuienTxt' => null,
                'otroTxt' => null,
                'detalle' => 'No registró su dependencia económica.',
            ],
            'dependientes' => [
                'tiene' => 0,
                'hay' => false,
                'listaTxt' => null,
                'otroTxt' => null,
                'detalle' => 'No registró dependientes económicos.',
            ],
        ];
    }

    private function defaultViviendaPdf(): array
    {
        // Default vivienda/service info so the view can safely read the keys.
        return [
            'viveConPadres' => null,
            'viveConEspecifica' => null,
            'tipoViviendaId' => null,
            'tipoViviendaOtro' => null,
            'hayViviendaInfo' => false,
            'bienesSeleccionados' => [],
            'bienesOtro' => null,
            'serviciosSeleccionados' => [],
            'serviciosOtro' => null,
        ];
    }
}
