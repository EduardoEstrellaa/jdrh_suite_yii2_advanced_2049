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

    private const SECTION_CONFIG = [
        [
            'id' => 'academicos',
            'title' => 'I. Datos academicos',
            'view' => '_sections/_01_academicos',
            'builder' => 'buildAcademicosSection',
        ],
        [
            'id' => 'personales',
            'title' => 'II. Datos personales',
            'view' => '_sections/_02_personales',
            'builder' => 'buildPersonalesSection',
        ],
        [
            'id' => 'familia',
            'title' => 'III. Datos familiares',
            'view' => '_sections/_03_familia',
            'pageBreakAfter' => true,
            'builder' => 'buildFamiliaSection',
        ],
        [
            'id' => 'becas',
            'title' => 'IV. Informacion de becas',
            'view' => '_sections/_04_becas',
        ],
        [
            'id' => 'hijos',
            'title' => 'V. Informacion de hijos',
            'view' => '_sections/_05_hijos',
        ],
        [
            'id' => 'situacion',
            'title' => 'VI. Situacion socioeconomica',
            'view' => '_sections/_06_situacion',
        ],
        [
            'id' => 'vivienda',
            'title' => 'VII. Bienes y servicios de la vivienda',
            'view' => '_sections/_07_vivienda',
        ],
        [
            'id' => 'bienes',
            'title' => 'VIII. Bienes personales',
            'view' => '_sections/_08_bienes',
            'pageBreakAfter' => true,
        ],
        [
            'id' => 'transporte',
            'title' => 'IX. Transporte y tiempos',
            'view' => '_sections/_09_transporte',
        ],
        [
            'id' => 'salud',
            'title' => 'X. Salud y atencion medica',
            'view' => '_sections/_10_salud',
            'pageBreakAfter' => true,
            'pageBlock' => true,
            'useCard' => true,
            'builder' => 'buildSaludSection',
        ],
        [
            'id' => 'alimentacion',
            'title' => 'XI. Alimentacion y consumo',
            'view' => '_sections/_11_alimentacion',
        ],
        [
            'id' => 'actividad',
            'title' => 'XII. Actividad fisica y deporte',
            'view' => '_sections/_12_actividad',
        ],
        [
            'id' => 'habitos',
            'title' => 'XIII. Habitos (tabaco, alcohol y adicciones)',
            'view' => '_sections/_13_habitos',
            'pageBreakAfter' => true,
        ],
        [
            'id' => 'conexion',
            'title' => 'XIV. Conexion y uso de internet',
            'view' => '_sections/_14_conexion',
            'pageBlock' => true,
            'useCard' => true,
        ],
        [
            'id' => 'organizaciones',
            'title' => 'XV. Organizaciones y participacion',
            'view' => '_sections/_15_organizaciones',
            'pageBlock' => true,
            'useCard' => true,
        ],
    ];

    public function __construct(
        ExpedienteFacade $facade,
        MpdfRenderer $renderer,
        string $viewFile = '@frontend/views/expediente/pdf/expediente.php'
    ) {
        $this->facade = $facade;
        $this->renderer = $renderer;
        $this->viewFile = $viewFile;
    }

    public function renderForAlumno(int $alumnoId, ?string $filename = null, array $mpdfConfig = []): Response
    {
        $data = $this->buildDataForAlumno($alumnoId);
        $alumno = $data['payload']['alumno'] ?? null;
        $filename = $filename ?? $this->buildFilename($alumno);

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
        $modelsWithDefaults = $this->ensurePdfContracts(array_merge([
            'alumno' => $alumno,
            'perfil' => $alumno->perfil,
        ], $models));

        $maps = $this->extractMaps($modelsWithDefaults);

        $payload = array_merge($modelsWithDefaults, [
            'alumno' => $alumno,
            'perfil' => $alumno->perfil,
            'maps' => $maps,
        ]);

        return [
            'meta' => $this->buildMeta($alumno),
            'sections' => $this->buildSections($alumno, $modelsWithDefaults, $maps),
            'payload' => $payload,
            'maps' => $maps,
        ];
    }

    private function buildFilename($alumno): string
    {
        $matricula = $alumno->matricula ?? $alumno->id;
        return 'Expediente_' . $matricula . '.pdf';
    }

    private function buildMeta(Alumnos $alumno): array
    {
        return [
            'title' => 'Expediente del Alumno',
            'generatedAt' => date('Y-m-d'),
        ];
    }

    private function buildSections(Alumnos $alumno, array $data, array $maps): array
    {
        $sections = [];

        foreach (self::SECTION_CONFIG as $config) {
            $builder = $config['builder'] ?? null;
            $built = [];

            if ($builder) {
                $built = $this->callSectionBuilder($builder, $alumno, $data, $maps);
            }

            $section = array_merge($config, $built);
            $sections[$section['id']] = $section;
        }

        return $sections;
    }

    private function callSectionBuilder(string $builder, Alumnos $alumno, array $data, array $maps): array
    {
        switch ($builder) {
            case 'buildAcademicosSection':
                return $this->buildAcademicosSection($alumno);
            case 'buildPersonalesSection':
                return $this->buildPersonalesSection($alumno, $data);
            case 'buildFamiliaSection':
                return $this->buildFamiliaSection($data);
            case 'buildSaludSection':
                return $this->buildSaludSection($data, $maps);
            default:
                return [];
        }
    }

    private function buildAcademicosSection(Alumnos $alumno): array
    {
        return [
            'id' => 'academicos',
            'title' => 'I. Datos academicos',
            'view' => '_sections/_01_academicos',
            'pageBreakAfter' => false,
            'rows' => [
                ['label' => 'Matrícula', 'value' => $this->normalizeText($alumno->matricula ?? null)],
                ['label' => 'Licenciatura', 'value' => $this->normalizeText($alumno->planLicenciaturas->licenciaturas->nombre ?? null)],
                ['label' => 'Generación', 'value' => $this->normalizeText($alumno->generaciones->nombre ?? null)],
            ],
        ];
    }

    private function buildPersonalesSection(Alumnos $alumno, array $data): array
    {
        $perfil = $alumno->perfil;
        $datosPersonales = $data['datosPersonales'] ?? null;
        $datosGenerales = $data['datosGenerales'] ?? null;
        $lugaresNacimiento = $data['lugaresNacimiento'] ?? null;
        $domiciliosActuales = $data['domiciliosActuales'] ?? null;

        $nombre = $this->normalizeText(
            trim(
                implode(' ', array_filter([
                    $perfil->nombre ?? null,
                    $perfil->apellido ?? null,
                ]))
            )
        );

        return [
            'id' => 'personales',
            'title' => 'II. Datos personales',
            'view' => '_sections/_02_personales',
            'pageBreakAfter' => false,
            'blocks' => [
                [
                    'type' => 'kv',
                    'title' => 'Perfil institucional',
                    'rows' => [
                        ['label' => 'Nombre', 'value' => $nombre],
                        ['label' => 'Fecha nacimiento', 'value' => $perfil->fecha_nacimiento ?? null, 'type' => 'date'],
                        ['label' => 'Género', 'value' => $this->normalizeText($perfil->genero->genero_nombre ?? null)],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Identificacion oficial',
                    'rows' => [
                        ['label' => 'CURP', 'value' => $datosPersonales->curp ?? null],
                        ['label' => 'Número de Seguro Social', 'value' => $datosPersonales->nss ?? null],
                        ['label' => 'RFC', 'value' => $datosPersonales->rfc ?? null],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Contacto y datos generales',
                    'rows' => [
                        ['label' => 'Teléfono personal', 'value' => $datosGenerales->tlf_personal ?? null],
                        ['label' => 'Teléfono de emergencia', 'value' => $datosGenerales->tlf_emergencia ?? null],
                        ['label' => 'Correo electrónico personal', 'value' => $datosGenerales->email_personal ?? null],
                        ['label' => 'Estado civil', 'value' => $datosGenerales->estadosCiviles->nombre ?? null],
                        ['label' => 'Nacionalidad', 'value' => $datosGenerales->nacionalidades->nombre ?? null],
                        ['label' => '¿Habla maya?', 'value' => $datosGenerales->maya_hablante ?? null, 'type' => 'bool'],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Lugar de nacimiento',
                    'rows' => [
                        ['label' => 'Entidad federativa', 'value' => $lugaresNacimiento->entidadesFederativas->nombre ?? null],
                        ['label' => 'Municipio', 'value' => $lugaresNacimiento->municipios->nombre ?? null],
                        ['label' => 'Localidad', 'value' => $lugaresNacimiento->localidad ?? null],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Domicilio actual',
                    'rows' => [
                        ['label' => 'Entidad federativa', 'value' => $domiciliosActuales->entidadesFederativas->nombre ?? null],
                        ['label' => 'Municipio', 'value' => $domiciliosActuales->municipios->nombre ?? null],
                        ['label' => 'Localidad', 'value' => $domiciliosActuales->localidad ?? null],
                        ['label' => 'Calle', 'value' => $domiciliosActuales->calle ?? null],
                        ['label' => 'Número exterior', 'value' => $domiciliosActuales->numero_exterior ?? null],
                        ['label' => 'Número interior', 'value' => $domiciliosActuales->numero_interior ?? null],
                        ['label' => 'Colonia', 'value' => $domiciliosActuales->colonia ?? null],
                        ['label' => 'Código postal', 'value' => $domiciliosActuales->codigo_postal ?? null],
                    ],
                ],
            ],
        ];
    }

    private function buildFamiliaSection(array $data): array
    {
        $padre = $data['familiaPadre'] ?? [];
        $madre = $data['familiaMadre'] ?? [];

        return [
            'id' => 'familia',
            'title' => 'III. Datos familiares',
            'view' => '_sections/_03_familia',
            'pageBreakAfter' => true,
            'padre' => [
                ['label' => 'Nombre completo', 'value' => $padre['nombre_completo'] ?? null],
                ['label' => 'Ocupación actual', 'value' => $padre['ocupacion'] ?? null],
                ['label' => '¿Habla maya? (padre)', 'value' => $padre['habla_maya'] ?? null, 'type' => 'bool'],
            ],
            'madre' => [
                ['label' => 'Nombre completo', 'value' => $madre['nombre_completo'] ?? null],
                ['label' => 'Ocupación actual', 'value' => $madre['ocupacion'] ?? null],
                ['label' => '¿Habla maya? (madre)', 'value' => $madre['habla_maya'] ?? null, 'type' => 'bool'],
            ],
        ];
    }

    private function buildSaludSection(array $data, array $maps): array
    {
        $alumAsisteMedico = $data['alumAsisteMedico'] ?? null;
        $alumAsisteDentista = $data['alumAsisteDentista'] ?? null;
        $problemas = $data['problemasSaludValidos'] ?? [];
        $cronicas = $data['enfermedadesCronicasSeleccionadas'] ?? [];
        $alergias = $data['alergiasValidas'] ?? [];
        $reaccionesSeleccionadas = $data['reaccionesAlergiasSeleccionadas'] ?? [];
        $tratamientos = $data['tratamientosValidos'] ?? [];
        $usoAnteojosSeleccionados = $data['usoAnteojosSeleccionados'] ?? [];
        $alumUsoAnteojos = $data['alumUsoAnteojos'] ?? null;
        $serviciosSaludSeleccionados = $data['serviciosSaludSeleccionados'] ?? [];

        $frecuenciasTiempoMap = $maps['frecuenciasTiempoMap'] ?? [];
        $tipoGravedadMap = $maps['tipoGravedadMap'] ?? [];
        $problemasMap = $maps['catalogoProblemasSaludMap'] ?? [];
        $reaccionesMap = $maps['catalogoReaccionesAlergicasMap'] ?? [];
        $tratamientosMap = $maps['catalogoTratamientosMap'] ?? [];
        $serviciosSaludMap = $maps['catalogoServiciosSaludMap'] ?? [];
        $usoAnteojosMap = $maps['catalogoUsoAnteojosMap'] ?? [];
        $alergiasMap = $maps['catalogoAlergiasMap'] ?? [];
        $cronicasMap = $maps['catalogoEnfermCronicasMap'] ?? [];

        $medFreId = $this->firstNonEmptyProp($alumAsisteMedico, ['frecuencia_tiempo_id', 'frecuencia_id', 'catalogo_frecuencia_id', 'frecuencia_veces_id']);
        $denFreId = $this->firstNonEmptyProp($alumAsisteDentista, ['frecuencia_tiempo_id', 'frecuencia_id', 'catalogo_frecuencia_id', 'frecuencia_veces_id']);

        $medBool = $this->boolFromFlag($this->firstNonEmptyProp($alumAsisteMedico, ['asiste_medico', 'asiste', 'tiene']));
        $denBool = $this->boolFromFlag($this->firstNonEmptyProp($alumAsisteDentista, ['asiste_dentista', 'asiste', 'tiene']));

        $problemasRows = $this->buildProblemasRows($problemas, $problemasMap, $tipoGravedadMap);
        $cronicasItems = $this->buildCronicasItems($cronicas, $cronicasMap);
        $alergiasRows = $this->buildAlergiasRows($alergias, $reaccionesSeleccionadas, $reaccionesMap, $tipoGravedadMap, $alergiasMap);
        $tratamientosRows = $this->buildTratamientosRows($tratamientos, $tratamientosMap, $frecuenciasTiempoMap);

        $tieneProblemas = !empty($problemas);
        $tieneCronicas = !empty($cronicas);
        $tieneAlergias = !empty($alergias);
        $tieneTratamientos = !empty($tratamientos);

        $usaAnteojos = $this->boolFromFlag(
            $this->firstNonEmptyProp($alumUsoAnteojos, ['usa_anteojos', 'utiliza_anteojos', 'tiene_anteojos', 'usa_lentes', 'uso_anteojos'])
        );
        if ($usaAnteojos === null) {
            $usaAnteojos = !empty($usoAnteojosSeleccionados) ? 1 : 0;
        }

        return [
            'blocks' => [
                [
                    'type' => 'kv',
                    'title' => 'Chequeos basicos',
                    'rows' => [
                        [
                            'label' => '¿Con que frecuencia acudes al medico?',
                            'value' => $medFreId ?? $medBool,
                            'type' => $medFreId !== null ? 'map' : 'bool',
                            'map' => $frecuenciasTiempoMap,
                        ],
                        [
                            'label' => '¿Con que frecuencia acudes al dentista?',
                            'value' => $denFreId ?? $denBool,
                            'type' => $denFreId !== null ? 'map' : 'bool',
                            'map' => $frecuenciasTiempoMap,
                        ],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Problemas de salud',
                    'rows' => [
                        ['label' => '¿Has tenido problemas de salud importantes?', 'value' => $tieneProblemas ? 1 : 0, 'type' => 'bool'],
                    ],
                ],
                [
                    'type' => 'table',
                    'headers' => ['#', 'Problema', 'Gravedad'],
                    'rows' => $problemasRows,
                    'emptyText' => 'Sin registros.',
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Enfermedades cronicas',
                    'rows' => [
                        ['label' => '¿Tienes alguna enfermedad cronica diagnosticada actualmente?', 'value' => $tieneCronicas ? 1 : 0, 'type' => 'bool'],
                    ],
                ],
                [
                    'type' => 'list',
                    'items' => $cronicasItems,
                    'emptyText' => 'No registro enfermedades cronicas.',
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Alergias',
                    'rows' => [
                        ['label' => '¿Te han diagnosticado alergias?', 'value' => $tieneAlergias ? 1 : 0, 'type' => 'bool'],
                    ],
                ],
                [
                    'type' => 'table',
                    'headers' => ['#', 'Alergia', 'Gravedad', 'Reacciones'],
                    'rows' => $alergiasRows,
                    'emptyText' => 'No registro alergias.',
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Tratamientos',
                    'rows' => [
                        ['label' => '¿Estas en algun tratamiento o terapia actualmente?', 'value' => $tieneTratamientos ? 1 : 0, 'type' => 'bool'],
                    ],
                ],
                [
                    'type' => 'table',
                    'headers' => ['#', 'Tratamiento', 'Frecuencia', 'Rango de fechas'],
                    'rows' => $tratamientosRows,
                    'emptyText' => 'Sin tratamientos registrados.',
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Servicios de salud',
                    'rows' => [
                        [
                            'label' => '¿Cuentas con algun servicio o cobertura de salud?',
                            'value' => !empty($serviciosSaludSeleccionados) ? 1 : 0,
                            'type' => 'bool',
                        ],
                        [
                            'label' => 'Cobertura / servicios',
                            'value' => $serviciosSaludSeleccionados,
                            'type' => 'list',
                            'map' => $serviciosSaludMap,
                            'emptyText' => 'No cuenta con cobertura.',
                        ],
                    ],
                ],
                ['type' => 'divider'],
                [
                    'type' => 'kv',
                    'title' => 'Uso de anteojos',
                    'rows' => $this->buildUsoAnteojosRows($usaAnteojos, $usoAnteojosSeleccionados, $usoAnteojosMap),
                ],
            ],
        ];
    }

    private function buildProblemasRows(array $problemas, array $problemasMap, array $tipoGravedadMap): array
    {
        $rows = [];

        foreach ($problemas as $i => $p) {
            $otro = $this->normalizeText($p->otro_especificar ?? null);
            $rows[] = [
                'cells' => [
                    ['value' => $i + 1],
                    ['value' => $p->catalogo_problemas_salud_id ?? null, 'type' => 'map', 'map' => $problemasMap, 'extra' => $otro],
                    ['value' => $p->tipo_gravedad_id ?? null, 'type' => 'map', 'map' => $tipoGravedadMap],
                ],
            ];
        }

        return $rows;
    }

    private function buildCronicasItems(array $cronicas, array $cronicasMap): array
    {
        $items = [];

        foreach ($cronicas as $catalogoId => $row) {
            $items[] = [
                'label' => $cronicasMap[(int)$catalogoId] ?? (string)$catalogoId,
                'extra' => $this->normalizeText($row->otro_especificar ?? null),
            ];
        }

        return $items;
    }

    private function buildAlergiasRows(array $alergias, array $reaccionesSeleccionadas, array $reaccionesMap, array $tipoGravedadMap, array $alergiasMap): array
    {
        $rows = [];

        foreach ($alergias as $i => $a) {
            $catId = (int)($a->catalogo_alergias_id ?? 0);
            $reacIds = $reaccionesSeleccionadas[$catId] ?? [];
            $otroAlergia = $this->normalizeText($a->otro_especificar ?? null);

            $rows[] = [
                'cells' => [
                    ['value' => $i + 1],
                    ['value' => $catId, 'type' => 'map', 'map' => $alergiasMap, 'extra' => $otroAlergia],
                    ['value' => $a->tipo_gravedad_id ?? null, 'type' => 'map', 'map' => $tipoGravedadMap],
                    ['value' => $reacIds, 'type' => 'list', 'map' => $reaccionesMap, 'emptyText' => 'Sin reacciones registradas.'],
                ],
            ];
        }

        return $rows;
    }

    private function buildTratamientosRows(array $tratamientos, array $tratamientosMap, array $frecuenciasTiempoMap): array
    {
        $rows = [];

        foreach ($tratamientos as $i => $t) {
            $otro = $this->normalizeText($t->otro_especificar ?? null);
            $inicio = $this->firstNonEmptyProp($t, ['fecha_inicio', 'inicio', 'desde', 'rango_inicio', 'fecha_desde']);
            $fin = $this->firstNonEmptyProp($t, ['fecha_fin', 'fin', 'hasta', 'rango_fin', 'fecha_hasta']);

            $rows[] = [
                'cells' => [
                    ['value' => $i + 1],
                    ['value' => $t->catalogo_tratamientos_id ?? null, 'type' => 'map', 'map' => $tratamientosMap, 'extra' => $otro],
                    ['value' => $t->frecuencia_tiempo_id ?? null, 'type' => 'map', 'map' => $frecuenciasTiempoMap],
                    ['value' => ['start' => $inicio, 'end' => $fin], 'type' => 'date_range'],
                ],
            ];
        }

        return $rows;
    }

    private function buildUsoAnteojosRows($usaAnteojos, array $usoAnteojosSeleccionados, array $usoAnteojosMap): array
    {
        $rows = [
            ['label' => '¿Utilizas anteojos o lentes de contacto?', 'value' => $usaAnteojos, 'type' => 'bool'],
        ];

        if ((int)$usaAnteojos === 1) {
            $rows[] = [
                'label' => 'Tipo de uso',
                'value' => $usoAnteojosSeleccionados,
                'type' => 'list',
                'map' => $usoAnteojosMap,
                'emptyText' => 'Sin tipo de uso registrado.',
            ];
        } else {
            $rows[] = [
                'label' => 'Detalle',
                'value' => 'No utiliza anteojos.',
                'muted' => true,
            ];
        }

        return $rows;
    }

    private function extractMaps(array $data): array
    {
        return [
            'frecuenciasTiempoMap' => $data['frecuenciasTiempoMap'] ?? [],
            'catalogoProblemasSaludMap' => $data['catalogoProblemasSaludMap'] ?? [],
            'tipoGravedadMap' => $data['tipoGravedadMap'] ?? [],
            'catalogoReaccionesAlergicasMap' => $data['catalogoReaccionesAlergicasMap'] ?? [],
            'catalogoTratamientosMap' => $data['catalogoTratamientosMap'] ?? [],
            'catalogoServiciosSaludMap' => $data['catalogoServiciosSaludMap'] ?? [],
            'catalogoUsoAnteojosMap' => $data['catalogoUsoAnteojosMap'] ?? [],
            'catalogoAlergiasMap' => $data['catalogoAlergiasMap'] ?? [],
            'catalogoEnfermCronicasMap' => $data['catalogoEnfermCronicasMap'] ?? [],
        ];
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

    private function normalizeText($value): ?string
    {
        $t = trim((string)($value ?? ''));
        return $t !== '' ? $t : null;
    }

    private function firstNonEmptyProp($obj, array $props)
    {
        if (!$obj) {
            return null;
        }

        foreach ($props as $p) {
            if (isset($obj->$p) && $obj->$p !== '' && $obj->$p !== null) {
                return $obj->$p;
            }
        }
        return null;
    }

    private function boolFromFlag($value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }
        return ((int)$value === 1) ? 1 : 0;
    }
}
