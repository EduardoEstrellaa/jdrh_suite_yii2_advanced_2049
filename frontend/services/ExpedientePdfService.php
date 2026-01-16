<?php

namespace frontend\services;

use common\services\ExpedienteFacade;
use frontend\services\pdf\ExpedientePdfGenerator;
use frontend\services\pdf\MpdfRenderer;
use yii\web\Response;

/** @deprecated Use {@see \frontend\services\pdf\ExpedientePdfGenerator} directly. */
class ExpedientePdfService
{
    private ExpedientePdfGenerator $generator;

    public function __construct(?ExpedientePdfGenerator $generator = null)
    {
        if ($generator === null) {
            $generator = new ExpedientePdfGenerator(
                new ExpedienteFacade(),
                new MpdfRenderer()
            );
        }

        $this->generator = $generator;
    }

    public function buildDataForAlumno(int $alumnoId): array
    {
        return $this->generator->buildDataForAlumno($alumnoId);
    }

    public function renderForAlumno(int $alumnoId, ?string $filename = null, array $mpdfConfig = []): Response
    {
        return $this->generator->renderForAlumno($alumnoId, $filename, $mpdfConfig);
    }
}
