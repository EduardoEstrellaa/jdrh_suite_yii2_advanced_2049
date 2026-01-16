<?php

namespace backend\controllers;

use backend\forms\reportes\AsignacionTutoresReportRequest;
use backend\forms\reportes\BecasApoyosReportRequest;
use backend\services\reportes\ReportChartService;
use backend\forms\reportes\ForaneosEstudiantesReportRequest;
use backend\forms\reportes\RiesgoCanalizacionReportRequest;
use backend\forms\reportes\SaludCondicionesReportRequest;
use backend\repositories\reportes\ReportesRepository;
use backend\services\reportes\ReportExportService;
use backend\services\reportes\ReportFormatter;
use backend\services\reportes\ReportesService;
use common\models\AsignacionesTutores;
use common\models\CiclosEscolares;
use common\models\Generaciones;
use common\models\Grupos;
use common\models\Semestres;
use common\models\TiposBecas;
use common\models\EntidadesFederativas;
use common\models\Municipios;
use common\models\CatalogoProblemasSalud;
use common\models\CatalogoEnfermCronicas;
use common\models\CatalogoAlergias;
use common\models\CatalogoTratamientos;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Controlador de reportes oficiales que orquesta servicios dedicados.
 */
class ReportesController extends Controller
{
    private ReportesService $reportesService;
    private ReportExportService $exportService;

    /**
     * Inyecta servicios reutilizables para operar los reportes.
     */
    public function init(): void
    {
        parent::init();
        $this->reportesService = new ReportesService(
            new ReportesRepository(),
            new ReportFormatter()
        );
        $this->exportService = new ReportExportService();
    }

    /**
     * Define las reglas de acceso para este controlador.
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Renderiza el listado de reportes disponibles y sus estadisticas.
     */
    public function actionIndex()
    {
        $stats = [
            'tutores' => AsignacionesTutores::find()->count(),
            'grupos' => \common\models\AsignacionesGrupos::find()->count(),
            'alumnos' => \common\models\AsignacionesAlumnosGrupos::find()->distinct()->count('alum_inscripciones_id'),
        ];

        $reports = [
            [
                'titulo' => 'Asignacion tutores',
                'descripcion' => 'Distribucion de tutores, grupos y alumnos por ciclo',
                'ruta' => ['asignacion'],
            ],
            [
                'titulo' => 'Historial de salud',
                'descripcion' => 'Ficha de salud y condiciones especiales por alumno o grupo',
                'ruta' => ['salud'],
            ],
            [
                'titulo' => 'Canalizacion riesgo',
                'descripcion' => 'Indice integral 0-100 para canalizar a alumnos en riesgo',
                'ruta' => ['riesgo'],
            ],
            [
                'titulo' => 'Becas y apoyos',
                'descripcion' => 'Inventario de apoyos y becas por alumno',
                'ruta' => ['becas'],
            ],
            [
                'titulo' => 'Estudiantes foraneos',
                'descripcion' => 'Alumnos cuyo domicilio no es Valladolid',
                'ruta' => ['foraneos'],
            ],
        ];

        return $this->render('index', [
            'stats' => $stats,
            'reports' => $reports,
        ]);
    }

    /**
     * Controla la generacion del reporte de asignacion de tutores.
     */
    public function actionAsignacion()
    {
        $request = new AsignacionTutoresReportRequest();
        $request->load(Yii::$app->request->get());
        $datos = $this->reportesService->obtenerAsignacion($request);

        $ciclos = ArrayHelper::map(CiclosEscolares::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $semestres = ArrayHelper::map(Semestres::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $grupos = ArrayHelper::map(Grupos::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $tutores = ArrayHelper::map(
            AsignacionesTutores::find()->joinWith('perfil')->all(),
            'id',
            function (AsignacionesTutores $model) {
                return $model->perfil ? $model->perfil->nombreCompleto : 'Sin tutor';
            }
        );

        $params = array_merge($datos, [
            'ciclos' => $ciclos,
            'semestres' => $semestres,
            'grupos' => $grupos,
            'tutores' => $tutores,
            'filter' => $request,
        ]);

        return $this->renderReport('reporte-asignacion-tutores', 'pdf/reporte-asignacion-tutores', $params, 'Asignacion de tutores');
    }

    /**
     * Controla la generacion del reporte de salud.
     */
    public function actionSalud()
    {
        $request = new SaludCondicionesReportRequest();
        $request->load(Yii::$app->request->get());
        $datos = $this->reportesService->generarReporteSalud($request);

        $grupos = ArrayHelper::map(Grupos::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $problemasSalud = CatalogoProblemasSalud::dropdownOptions();
        $cronicas = CatalogoEnfermCronicas::dropdownOptions();
        $alergias = CatalogoAlergias::dropdownOptions();
        $tratamientos = CatalogoTratamientos::dropdownOptions();

        $params = array_merge($datos, [
            'grupos' => $grupos,
            'problemasSalud' => $problemasSalud,
            'cronicas' => $cronicas,
            'alergias' => $alergias,
            'tratamientos' => $tratamientos,
            'filter' => $request,
        ]);

        return $this->renderReport('reporte-salud-condiciones', 'pdf/reporte-salud-condiciones', $params, 'Historial de salud');
    }

    /**
     * Controla la generacion del reporte de canalizacion de riesgo.
     */
    public function actionRiesgo()
    {
        $request = new RiesgoCanalizacionReportRequest();
        $request->load(Yii::$app->request->get());
        $datos = $this->reportesService->generarReporteRiesgo($request);

        $gruposMap = ArrayHelper::map(Grupos::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $ciclosMap = ArrayHelper::map(CiclosEscolares::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $nivelesRiesgo = [
            'amarillo' => 'Riesgo moderado',
            'rojo' => 'Riesgo alto',
            'sin_consumo' => 'Sin riesgo',
        ];

        $params = array_merge($datos, [
            'ciclos' => $ciclosMap,
            'grupos' => $gruposMap,
            'nivelesRiesgo' => $nivelesRiesgo,
            'filter' => $request,
        ]);

        return $this->renderReport('reporte-canalizacion-riesgo', 'pdf/reporte-canalizacion-riesgo', $params, 'Canalizacion de riesgo');
    }

    /**
     * Controla la generacion del reporte de becas y apoyos.
     */
    public function actionBecas()
    {
        $request = new BecasApoyosReportRequest();
        $request->load(Yii::$app->request->get());
        $datos = $this->reportesService->generarReporteBecas($request);

        $generaciones = ArrayHelper::map(Generaciones::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $tiposBecas = ArrayHelper::map(TiposBecas::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $ciclos = ArrayHelper::map(CiclosEscolares::find()->orderBy('nombre')->all(), 'id', 'nombre');

        $totalesPorTipo = $datos['totalesPorTipo'] ?? [];
        $chartItems = [];
        foreach ($tiposBecas as $nombre) {
            $cantidad = $totalesPorTipo[$nombre] ?? 0;
            if ($cantidad > 0) {
                $chartItems[$nombre] = $cantidad;
            }
        }

        $sinBecaTotal = $datos['sinBecaTotal'] ?? 0;
        if ($sinBecaTotal > 0) {
            $chartItems['Sin beca'] = $sinBecaTotal;
        }

        $chartLabels = array_keys($chartItems);
        $chartValues = array_values($chartItems);

        $chartService = new ReportChartService();
        $chartImage = $chartService->generateQuickChart(
            'Totales por tipo de beca',
            $chartLabels,
            $chartValues,
            'doughnut'
        );

        $palette = $chartService->paletteColors();
        $chartLegend = [];
        foreach ($chartLabels as $index => $label) {
            $chartLegend[] = [
                'label' => $label,
                'value' => $chartValues[$index] ?? 0,
                'color' => $palette[$index % count($palette)],
            ];
        }

        $palette = $chartService->paletteColors();
        $chartLegend = [];
        foreach ($chartLabels as $index => $label) {
            $chartLegend[] = [
                'label' => $label,
                'value' => $chartValues[$index] ?? 0,
                'color' => $palette[$index % count($palette)],
            ];
        }

        $params = array_merge($datos, [
            'generaciones' => $generaciones,
            'tiposBecas' => $tiposBecas,
            'ciclos' => $ciclos,
            'filter' => $request,
            'chartImage' => $chartImage,
            'chartLegend' => $chartLegend,
        ]);

        return $this->renderReport('reporte-becas-apoyos', 'pdf/reporte-becas-apoyos', $params, 'Becas y apoyos estudiantiles');
    }

    /**
     * Controla la generacion del reporte de estudiantes foraneos.
     */
    public function actionForaneos()
    {
        $request = new ForaneosEstudiantesReportRequest();
        $request->load(Yii::$app->request->get());
        $datos = $this->reportesService->generarReporteForaneos($request);

        $generacionesOptions = ArrayHelper::map(Generaciones::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $entidadesOptions = ArrayHelper::map(EntidadesFederativas::find()->orderBy('nombre')->all(), 'id', 'nombre');
        $municipiosOptions = [];
        if ($request->entidad_federativa_id) {
            $municipios = Municipios::find()
                ->where(['entidades_federativas_id' => $request->entidad_federativa_id])
                ->orderBy('nombre')
                ->all();
            $municipiosOptions = ArrayHelper::map($municipios, 'id', 'nombre');
        }

        $params = array_merge($datos, [
            'generacionesOptions' => $generacionesOptions,
            'entidadesOptions' => $entidadesOptions,
            'municipiosOptions' => $municipiosOptions,
            'filter' => $request,
        ]);

        return $this->renderReport('reporte-foraneos-estudiantes', 'pdf/reporte-foraneos-estudiantes', $params, 'Estudiantes foraneos');
    }

    public function actionMunicipiosPorEntidadFederativa(?int $entidadId = null): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!$entidadId) {
            return ['municipios' => []];
        }

        $municipios = Municipios::find()
            ->where(['entidades_federativas_id' => $entidadId])
            ->orderBy('nombre')
            ->all();

        return ['municipios' => ArrayHelper::map($municipios, 'id', 'nombre')];
    }

    /**
     * Renderiza la vista o exporta el PDF segun el formato pedido.
     */
    protected function renderReport(string $vista, string $pdfVista, array $params, string $titulo)
    {
        if (Yii::$app->request->get('format') === 'pdf') {
            return $this->exportService->generarPdf($titulo, $pdfVista, $params, $this);
        }

        $params['tituloReporte'] = $titulo;
        return $this->render($vista, $params);
    }
}
