<?php

namespace backend\services\reportes;

use backend\forms\reportes\AlimentacionEntornoReportRequest;
use backend\forms\reportes\AsignacionTutoresReportRequest;
use backend\forms\reportes\BecasApoyosReportRequest;
use backend\forms\reportes\ForaneosEstudiantesReportRequest;
use backend\forms\reportes\RiesgoCanalizacionReportRequest;
use backend\forms\reportes\SaludCondicionesReportRequest;
use backend\repositories\reportes\ReportesRepository;
use common\models\Alumnos;
use yii\data\Pagination;
use yii\db\Expression;

/**
 * Servicio coordinador de datos para los reportes oficiales.
 */
class ReportesService
{
    public function __construct(
        private ReportesRepository $repository,
        private ReportFormatter $formatter
    ) {
    }

    /**
     * Genera la tabla y totales para el reporte de asignacion.
     */
    public function obtenerAsignacion(AsignacionTutoresReportRequest $request): array
    {
        $query = $this->repository->crearAsignacionQuery();
        $request->applyToQuery($query);
        $gruposAsignados = $query->orderBy(['grupos_id' => SORT_ASC])->all();

        $tutoresActivos = [];
        $alumnoIds = [];
        $tabla = [];

        foreach ($gruposAsignados as $registro) {
            $tutor = $registro->asignacionesTutores ? $registro->asignacionesTutores->perfil : null;
            $nombreTutor = $this->formatter->obtenerNombreTutor($tutor);
            $nombreGrupo = $registro->grupos ? $registro->grupos->nombre : 'No registrado';
            $semestre = $registro->semestres ? $registro->semestres->nombre : 'No registrado';
            $alumnosLista = [];

            foreach ($registro->asignacionesAlumnosGrupos as $alumnoGrupo) {
                $inscripcion = $alumnoGrupo->alumInscripciones;
                $alumno = $inscripcion ? $inscripcion->alumnos : null;
                if ($alumno) {
                    $alumnoIds[] = $alumno->id;
                    $alumnosLista[] = $this->formatter->obtenerNombreAlumno($alumno);
                }
            }

            $tutoresActivos[$nombreTutor] = true;

            $tabla[] = [
                'tutor' => $nombreTutor,
                'grupo' => $nombreGrupo,
                'semestre' => $semestre,
                'alumnos' => $alumnosLista,
                'conteo' => count($alumnosLista),
            ];
        }

        $totales = [
            'tutores' => count($tutoresActivos),
            'grupos' => count($gruposAsignados),
            'alumnos' => count(array_unique($alumnoIds)),
        ];

        return [
            'tabla' => $tabla,
            'totales' => $totales,
            'filtros' => $request->getResumen(),
            'tieneFiltroCiclo' => (bool)$request->ciclo_escolar_id,
        ];
    }

    /**
     * Compone los datos del reporte de salud con paginacion y totales.
     */
    public function generarReporteSalud(SaludCondicionesReportRequest $request): array
    {
        $items = [];
        $paginas = null;
        $resumen = ['total' => 0, 'con_condicion' => 0];
        $alumno = null;
        $matricula = $request->matricula ? trim($request->matricula) : null;

        if ($matricula) {
            $alumno = $this->buscarAlumnoPorMatricula($matricula);
        } elseif ($request->alumno_id) {
            $alumno = $this->buscarAlumnoPorId($request->alumno_id);
        }

        $query = $this->repository->crearBaseAlumnoQuery(
            null,
            $request->grupo_id,
            [
                'perfil',
                'alumEstadoSaluds.problemasSaluds',
                'alumEnfermedadesCronicas.enfermedadesCronicas.catalogoEnfermCronicas',
                'alumAlergias.alergias.catalogoAlergias',
                'alumTratamientos.tratamientos.catalogoTratamientos',
                'alumServiciosSalud.serviciosSaluds.catalogoServiciosSalud',
            ]
        );

        $query->innerJoin('alum_estado_salud aes', 'aes.alumnos_id = a.id')
            ->innerJoin('perfil p', 'p.id = a.perfil_id')
            ->innerJoin('datos_personales dp', 'dp.perfil_id = p.id')
            ->innerJoin('lugares_nacimiento ln', 'ln.perfil_id = p.id')
            ->innerJoin('domicilios_actuales da', 'da.perfil_id = p.id')
            ->andWhere(array_merge(['or'], $this->crearExpedienteCompletoExpressions('a', 'aes')));

        if ($request->problema_id) {
            $query->leftJoin('problemas_salud ps', 'ps.alum_estado_salud_id = aes.id');
            $query->andWhere(['ps.catalogo_problemas_salud_id' => $request->problema_id]);
        }

        if ($matricula) {
            $query->andWhere(['a.matricula' => $matricula]);
        }

        $resumen['total'] = (int)(clone $query)->count('id');

        $condicionQuery = clone $query;
        $condicionQuery->andWhere(array_merge(['or'], $this->repository->crearCondicionExpressions('a', 'aes')));
        $resumen['con_condicion'] = (int)(clone $condicionQuery)->count('id');

        $dataQuery = $request->solo_con_condicion ? $condicionQuery : $query;
        $totalCount = (int)(clone $dataQuery)->count('id');

        $paginas = new Pagination([
            'totalCount' => $totalCount,
            'defaultPageSize' => 20,
        ]);

        $alumnos = $dataQuery->orderBy('a.id')->offset($paginas->offset)->limit($paginas->limit)->all();

        foreach ($alumnos as $registro) {
            $items[] = [
                'nombre' => $this->formatter->obtenerNombreAlumno($registro),
                'matricula' => $registro->matricula,
                'salud' => $this->formatter->tieneSalud($registro),
                'cronicas' => $this->formatter->tieneCronicas($registro),
                'alergias' => $this->formatter->tieneAlergias($registro),
                'tratamientos' => $this->formatter->tieneTratamientos($registro),
                'servicios' => $this->formatter->tieneServiciosSalud($registro),
            ];
        }

        return [
            'alumno' => $alumno,
            'items' => $items,
            'paginas' => $paginas,
            'resumen' => $resumen,
            'filtros' => $request->obtenerFiltros(),
        ];
    }

    private function crearConsultaDetalleAlumno(): \yii\db\ActiveQuery
    {
        return Alumnos::find()
            ->alias('a')
            ->with([
                'perfil',
                'alumEstadoSaluds.problemasSaluds',
                'alumEnfermedadesCronicas.enfermedadesCronicas',
                'alumAlergias.alergias',
                'alumTratamientos.tratamientos',
                'alumServiciosSalud.serviciosSaluds',
            ]);
    }

    private function buscarAlumnoPorMatricula(string $matricula): ?Alumnos
    {
        return $this->crearConsultaDetalleAlumno()
            ->where(['a.matricula' => $matricula])
            ->one();
    }

    private function buscarAlumnoPorId(int $id): ?Alumnos
    {
        return $this->crearConsultaDetalleAlumno()
            ->where(['a.id' => $id])
            ->one();
    }

    public function generarReporteRiesgo(RiesgoCanalizacionReportRequest $request): array
    {
        $query = $this->repository->crearBaseAlumnoQuery(
            $request->ciclo_escolar_id,
            $request->grupo_id,
            [
                'perfil',
                'alumInscripciones.asignacionesAlumnosGrupos.asignacionesGrupos.grupos',
                'alumHabitosConsumos',
            ]
        );

        $alumnos = $query->orderBy('a.id')->all();
        $items = [];
        $semaforo = ['verde' => 0, 'amarillo' => 0, 'rojo' => 0];

        foreach ($alumnos as $registro) {
            $habito = $registro->alumHabitosConsumos[0] ?? null;
            if (!$habito) {
                continue;
            }

            $riesgo = $this->formatter->clasificarRiesgoHabitos($habito);
            $items[] = array_merge($riesgo, [
                'nombre' => $this->formatter->obtenerNombreAlumno($registro),
                'grupo' => $this->formatter->extraerGrupoPrincipal($registro),
            ]);
            $semaforo[$riesgo['nivel']]++;
        }

        usort($items, function (array $a, array $b) {
            if ($a['peso'] === $b['peso']) {
                return strcmp($a['nombre'], $b['nombre']);
            }
            return $b['peso'] <=> $a['peso'];
        });

        $total = count($items);
        $paginas = new Pagination([
            'totalCount' => $total,
            'defaultPageSize' => 20,
        ]);

        $slice = array_slice($items, $paginas->offset, $paginas->limit);

        return [
            'items' => $slice,
            'paginas' => $paginas,
            'semaforo' => $semaforo,
            'filtros' => $request->obtenerFiltros(),
        ];
    }

    /**
     * Compila el reporte de becas por alumno.
     */
    public function generarReporteBecas(BecasApoyosReportRequest $request): array
    {
        $query = Alumnos::find()->alias('a')
            ->with(['perfil', 'alumInscripciones.ciclosEscolares', 'alumBecas.tiposBecas'])
            ->leftJoin('alum_inscripciones ins', 'ins.alumnos_id = a.id')
            ->leftJoin('ciclos_semestres cs', 'cs.id = ins.ciclos_semestres_id')
            ->leftJoin('alum_becas ab', 'ab.alumnos_id = a.id');

        if ($request->generacion_id) {
            $query->andWhere(['a.generaciones_id' => $request->generacion_id]);
        }
        if ($request->tipo_beca_id) {
            $query->andWhere(['ab.tipos_becas_id' => $request->tipo_beca_id]);
        }
        if ($request->ciclo_escolar_id) {
            $query->andWhere(['cs.ciclos_escolares_id' => $request->ciclo_escolar_id]);
        }
        if ($request->solo_con_beca) {
            $query->andWhere(['ab.tiene_beca' => 1]);
        }

        $alumnos = $query->groupBy('a.id')->orderBy('a.id')->all();
        $datos = [];
        $totalesPorTipo = [];

        foreach ($alumnos as $registro) {
            $beca = $registro->alumBecas[0] ?? null;
            $tipo = $beca && $beca->tiposBecas ? $beca->tiposBecas->nombre : 'Sin beca';
            $inscripcionActivo = $registro->alumInscripciones[0] ?? null;
            $periodo = $inscripcionActivo && $inscripcionActivo->ciclosEscolares
                ? $inscripcionActivo->ciclosEscolares->nombre
                : 'No definido';
            $estatus = $beca && (int)$beca->tiene_beca === 1 ? 'Vigente' : 'Sin beca';

            if ($beca && $beca->tiene_beca && $tipo !== 'Sin beca') {
                $totalesPorTipo[$tipo] = ($totalesPorTipo[$tipo] ?? 0) + 1;
            }

            $datos[] = [
                'nombre' => $this->formatter->obtenerNombreAlumno($registro),
                'matricula' => $registro->matricula,
                'tipo' => $tipo,
                'periodo' => $periodo,
                'estatus' => $estatus,
            ];
        }

        return [
            'datos' => $datos,
            'totalesPorTipo' => $totalesPorTipo,
            'filtros' => $request->obtenerFiltros(),
        ];
    }

    /**
     * Construye los datos del reporte de alimentacion y entornos de consumo.
     */
    public function generarReporteAlimentacion(AlimentacionEntornoReportRequest $request): array
    {
        $query = Alumnos::find()->alias('a')
            ->with([
                'perfil',
                'generaciones',
                'alumConsumoAlimentos.catalogoAlimentos',
                'alumConsumoAlimentos.frecuenciaVeces',
                'alumLugaresComers.catalogoLugaresComer',
                'alumInscripciones.asignacionesAlumnosGrupos.asignacionesGrupos.grupos',
            ])
            ->leftJoin('alum_inscripciones ins', 'ins.alumnos_id = a.id')
            ->leftJoin('asignaciones_alumnos_grupos aag', 'aag.alum_inscripciones_id = ins.id')
            ->leftJoin('asignaciones_grupos ag', 'ag.id = aag.asignaciones_grupos_id');

        if ($request->generacion_id) {
            $query->andWhere(['a.generaciones_id' => $request->generacion_id]);
        }
        if ($request->grupo_id) {
            $query->andWhere(['ag.grupos_id' => $request->grupo_id]);
        }

        $alumnos = $query->orderBy('a.id')->all();

        $frecuenciaAlimentos = [];
        $lugaresConteo = [];
        $patronesCohorte = [];
        $patronesGrupo = [];

        foreach ($alumnos as $alumno) {
            $cohorte = $alumno->generaciones ? $alumno->generaciones->nombre : 'Sin generacion';
            $grupoNombre = $this->formatter->extraerGrupoPrincipal($alumno);

            $patronesCohorte[$cohorte]['alumnos'] = ($patronesCohorte[$cohorte]['alumnos'] ?? 0) + 1;
            $patronesGrupo[$grupoNombre]['alumnos'] = ($patronesGrupo[$grupoNombre]['alumnos'] ?? 0) + 1;

            foreach ($alumno->alumConsumoAlimentos as $consumo) {
                $alimento = $consumo->catalogoAlimentos ? $consumo->catalogoAlimentos->nombre : 'Otro alimento';
                $frecuencia = $consumo->frecuenciaVeces ? $consumo->frecuenciaVeces->nombre : 'Sin frecuencia';
                $frecuenciaAlimentos[$alimento][$frecuencia] = ($frecuenciaAlimentos[$alimento][$frecuencia] ?? 0) + 1;
                $patronesCohorte[$cohorte]['frecuencias'][$frecuencia] = ($patronesCohorte[$cohorte]['frecuencias'][$frecuencia] ?? 0) + 1;
                $patronesGrupo[$grupoNombre]['frecuencias'][$frecuencia] = ($patronesGrupo[$grupoNombre]['frecuencias'][$frecuencia] ?? 0) + 1;
            }

            foreach ($alumno->alumLugaresComers as $lugar) {
                $nombreLugar = $lugar->catalogoLugaresComer ? $lugar->catalogoLugaresComer->nombre : 'Otro lugar';
                $lugaresConteo[$nombreLugar] = ($lugaresConteo[$nombreLugar] ?? 0) + 1;
                $patronesCohorte[$cohorte]['lugares'][$nombreLugar] = ($patronesCohorte[$cohorte]['lugares'][$nombreLugar] ?? 0) + 1;
                $patronesGrupo[$grupoNombre]['lugares'][$nombreLugar] = ($patronesGrupo[$grupoNombre]['lugares'][$nombreLugar] ?? 0) + 1;
            }
        }

        ksort($frecuenciaAlimentos);
        arsort($lugaresConteo);
        ksort($patronesCohorte);
        ksort($patronesGrupo);

        return [
            'frecuenciaAlimentos' => $frecuenciaAlimentos,
            'lugaresConteo' => $lugaresConteo,
            'patronesCohorte' => $patronesCohorte,
            'patronesGrupo' => $patronesGrupo,
            'totalAlumnos' => count($alumnos),
            'filtros' => $request->obtenerFiltros(),
        ];
    }

    /**
     * Arma los datos del reporte de estudiantes foraneos.
     */
    public function generarReporteForaneos(ForaneosEstudiantesReportRequest $request): array
    {
        $query = Alumnos::find()->alias('a')
            ->with([
                'perfil',
                'generaciones',
                'perfil.domiciliosActuales.municipios',
            ])
            ->innerJoin('perfil p', 'p.id = a.perfil_id')
            ->innerJoin('domicilios_actuales da', 'da.perfil_id = p.id')
            ->leftJoin('municipios m', 'm.id = da.municipios_id')
            ->leftJoin('alum_inscripciones ins', 'ins.alumnos_id = a.id')
            ->leftJoin('ciclos_semestres cs', 'cs.id = ins.ciclos_semestres_id')
            ->andWhere(['<>', 'da.municipios_id', 2]);

        if ($request->ciclo_escolar_id) {
            $query->andWhere(['cs.ciclos_escolares_id' => $request->ciclo_escolar_id]);
        }

        $query->groupBy('a.id');
        $alumnos = $query->orderBy('a.id')->all();

        $municipios = [];
        $generaciones = [];

        foreach ($alumnos as $alumno) {
            $municipio = 'Sin municipio';
            if ($alumno->perfil && $alumno->perfil->domiciliosActuales) {
                $dom = $alumno->perfil->domiciliosActuales[0] ?? null;
                if ($dom && $dom->municipios) {
                    $municipio = $dom->municipios->nombre;
                }
            }
            $municipios[$municipio] = ($municipios[$municipio] ?? 0) + 1;

            $generacion = $alumno->generaciones ? $alumno->generaciones->nombre : 'Sin generacion';
            $generaciones[$generacion] = ($generaciones[$generacion] ?? 0) + 1;
        }

        ksort($municipios);
        ksort($generaciones);

        return [
            'alumnos' => $alumnos,
            'municipios' => $municipios,
            'generaciones' => $generaciones,
            'filtros' => $request->obtenerFiltros(),
        ];
    }

    /**
     * Crea expresiones para asegurar que un expediente de salud contiene al menos un registro asociado.
     */
    private function crearExpedienteCompletoExpressions(string $alumnoAlias, string $estadoAlias): array
    {
        return [
            new Expression("EXISTS (SELECT 1 FROM problemas_salud ps WHERE ps.alum_estado_salud_id = {$estadoAlias}.id)"),
            new Expression("EXISTS (SELECT 1 FROM alum_servicios_salud ass WHERE ass.alumnos_id = {$alumnoAlias}.id)"),
            new Expression("EXISTS (SELECT 1 FROM alum_tratamientos atr WHERE atr.alumnos_id = {$alumnoAlias}.id)"),
            new Expression("EXISTS (SELECT 1 FROM alum_alergia aal WHERE aal.alumnos_id = {$alumnoAlias}.id)"),
            new Expression("EXISTS (SELECT 1 FROM alum_enfermedades_cronicas aec WHERE aec.alumnos_id = {$alumnoAlias}.id)"),
        ];
    }
}
