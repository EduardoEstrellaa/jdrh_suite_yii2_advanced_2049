<?php

namespace common\services;

use DomainException;
use Yii;

use common\models\AlumDependenEconomica;
use common\models\AlumInfoHijos;
use common\models\AlumBienesPersonales;
use common\models\AlumVivienda;
use common\models\AlumEstadoSalud;
use common\models\AlumEnfermedadesCronicas;
use common\models\AlumAlergia;
use common\models\AlumAsisteMedico;
use common\models\AlumAsisteDentista;
use common\models\AlumServiciosSalud;
use common\models\AlumUsoAnteojos;
use common\models\AlumTratamientos;
use common\models\AlumRecreacionTiempo;
use common\models\AlumConsumoAlimentos;
use common\models\AlumLugaresComer;
use common\models\AlumOrganizacion;

use common\models\Alergias;
use common\models\CatalogoBienesPersonales;
use common\models\CatalogoBienesVivienda;
use common\models\CatalogoDependenciasEconomicas;
use common\models\CatalogoEnfermCronicas;
use common\models\CatalogoAlergias;
use common\models\CatalogoProblemasSalud;
use common\models\CatalogoReaccionesAlergicas;
use common\models\CatalogoServiciosSalud;
use common\models\CatalogoServiciosVivienda;
use common\models\CatalogoTratamientos;
use common\models\CatalogoUsoAnteojos;
use common\models\CatalogoLugaresAccesoPrincipal;
use common\models\CatalogoUsosInternet;
use common\models\CatalogoOrganizaciones;
use common\models\CatalogoCigarrosDia;
use common\models\CatalogoTransportes;
use common\models\CatalogoLugaresComer;
use common\models\CatalogoAlimentos;
use common\models\CatalogoActividadEjercicio;
use common\models\CatalogoDeportes;

use common\models\Dependientes;
use common\models\EdadesHijos;
use common\models\FrecuenciaVeces;
use common\models\FrecuenciaVecesSemana;
use common\models\FrecuenciaTiempo;

use common\models\ServiciosSalud;
use common\models\UsoAnteojos;
use common\models\TiempoRecorridoTransporte;
use common\models\TipoGravedad;
use common\models\TiposViviendas;

use common\models\ViviendaBienes;
use common\models\ViviendaServicios;
use common\models\VariasReaccionesAlergicas;

use common\models\Tratamientos;
use common\models\EnfermedadesCronicas;
use common\models\ProblemasSalud;

use common\models\AlumDeportes;
use common\models\AlumEjercicio;
use common\models\Deportes;
use common\models\Organizaciones;
use common\models\EjercicioFisico;
use common\models\TiposBecas;
use common\models\UsosInternet;

use common\services\support\OperationResult;

class ExpedienteFacade
{
    /**
     * Datos iniciales para vista de creación.
     */
    public function getCreateData($perfil, $alumno)
    {
        $models = ExpedienteService::getModelsForCreate($perfil, $alumno);

        return array_merge(
            $models,
            $this->getDependientesDefaults(),
            $this->getViviendaDefaults(),                   // contrato vivienda completo (incluye bienes/servicios/base)
            $this->getAlimentacionDefaults($alumno->id),
            $this->getActividadFisicaDefaults(),
            $this->getRecreacionDefaults(),
            $this->getOrganizacionDefaults(),
            $this->getSaludDefaults(),
            $this->getTratamientosDefaults(),
            $this->getCatalogosData()
        );
    }

    /**
     * Datos completos para vistas de actualización/consulta.
     *
     * Buenas prácticas:
     * - Orquestador: NO hace lógica “pesada”.
     * - Divide PDF contracts vs Form data.
     */
    public function getUpdateData($perfilId, $alumnoId)
    {
        $models    = ExpedienteService::getModelsForUpdate($perfilId, $alumnoId);
        $catalogos = $this->getCatalogosData();

        // Form data que también alimenta PDF (evitar duplicar queries)
        $dependientesData = $this->buildDependientesData($models['alumDependenEconomica'] ?? null);
        $viviendaForm     = $this->buildViviendaFormData($models['alumVivienda'] ?? null);

        $pdfContracts = $this->buildPdfContracts(
            $models,
            $alumnoId,
            $catalogos,
            $dependientesData,
            $viviendaForm
        );

        $formCollections = $this->buildFormCollections(
            $models,
            $alumnoId,
            $dependientesData,
            $viviendaForm
        );

        $extras = $this->buildExtras($models);

        return array_merge(
            $models,
            $pdfContracts,
            $formCollections,
            $extras,
            $catalogos
        );
    }

    /**
     * Crea expediente manejando errores de dominio y registrando bitácora.
     */
    public function create($perfil, $alumno, array $post)
    {
        try {
            ExpedienteService::crearExpediente($perfil, $alumno, $post);
            return OperationResult::ok('Expediente guardado correctamente.');
        } catch (DomainException $e) {
            Yii::warning($e->getMessage(), __METHOD__);
            return OperationResult::fail($e->getMessage());
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);
            return OperationResult::fail('Error inesperado al guardar el expediente.');
        }
    }

    /**
     * Actualiza expediente existente manejando errores de dominio y registro.
     */
    public function update($perfilId, $alumnoId, array $post)
    {
        try {
            $saved = ExpedienteService::actualizarExpediente($perfilId, $alumnoId, $post);
            if ($saved) {
                return OperationResult::ok('Expediente actualizado correctamente.');
            }
            return OperationResult::fail('Error al guardar el expediente. Verifica los datos.');
        } catch (DomainException $e) {
            Yii::warning($e->getMessage(), __METHOD__);
            return OperationResult::fail($e->getMessage());
        } catch (\Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);
            return OperationResult::fail('Error al guardar el expediente.');
        }
    }

    /* ============================================================
     *  Builders (ORQUESTACIÓN)
     * ============================================================
     */

    /**
     * Contratos para PDF: estables y predecibles.
     */
    private function buildPdfContracts(
        array $models,
        int $alumnoId,
        array $catalogos,
        array $dependientesData,
        array $viviendaForm
    ): array {
        $familiaPdf = $this->buildDatosFamiliaresPdfData($models['alumDatosFamiliares'] ?? null);

        $viviendaPdf = $this->buildViviendaPdfData(
            $models['alumVivienda'] ?? null,
            $viviendaForm
        );

        // Modelos económicos (keys estándar del service)
        $depEcoModel = $models['alumDependeEconomicamente'] ?? null; // de quién dependes
        $depModel    = $models['alumDependenEconomica'] ?? null;     // tiene dependientes

        $ecoPdf = $this->buildSituacionEconomicaPdfData(
            $depEcoModel,
            $depModel,
            $catalogos['catalogoDependenciasOptions'] ?? [],
            $dependientesData['dependientesSeleccionados'] ?? [],
            $dependientesData['dependientesOtro'] ?? null
        );

        $becaPdf = $this->buildBecaPdfData(
            $models['alumBecas'] ?? null,
            $catalogos['tiposBecasMap'] ?? []
        );

        // familiaPdf viene como keys directas (familiaPadre/familiaMadre) por compatibilidad con tu vista
        return array_merge(
            $familiaPdf,
            ['viviendaPdf' => $viviendaPdf],
            ['ecoPdf' => $ecoPdf],
            ['becaPdf' => $becaPdf]
        );
    }

    /**
     * Datos del FORM: selecciones y colecciones.
     * (Aquí vive la mayoría de buildXData del expediente)
     */
    private function buildFormCollections(
        array $models,
        int $alumnoId,
        array $dependientesData,
        array $viviendaForm
    ): array {
        $bienesPersonalesData      = $this->buildBienesPersonalesData($alumnoId);
        $problemasSaludData        = $this->buildProblemasSaludData($models['alumEstadoSalud'] ?? null);
        $serviciosSaludData        = $this->buildServiciosSaludData($models['alumServiciosSalud'] ?? null);
        $usoAnteojosData           = $this->buildUsoAnteojosData($models['alumUsoAnteojos'] ?? null);
        $tratamientosData          = $this->buildTratamientosData($models['alumTratamientos'] ?? null);
        $enfermedadesCronicasData  = $this->buildEnfermedadesCronicasData($models['alumEnfermedadesCronicas'] ?? null);
        $alergiasData              = $this->buildAlergiasData($models['alumAlergia'] ?? null);
        $lugaresComerData          = $this->buildLugaresComerData($alumnoId);
        $consumoAlimentosData      = $this->buildConsumoAlimentosData($alumnoId);
        $deportesData              = $this->buildDeportesData($models['alumDeportes'] ?? null);
        $ejercicioData             = $this->buildEjercicioFisicoData($models['alumEjercicio'] ?? null);
        $recreacionData            = $this->buildRecreacionData($models['alumRecreacionTiempo'] ?? null);
        $organizacionesData        = $this->buildOrganizacionesData($models['alumOrganizacion'] ?? null);

        return array_merge(
            $dependientesData,
            $viviendaForm,                 // bienes/servicios del form
            $bienesPersonalesData,
            $problemasSaludData,
            $serviciosSaludData,
            $usoAnteojosData,
            $tratamientosData,
            $enfermedadesCronicasData,
            $alergiasData,
            $lugaresComerData,
            $consumoAlimentosData,
            $deportesData,
            $ejercicioData,
            $recreacionData,
            $organizacionesData
        );
    }

    /**
     * Extras “sueltos” (no form collections y no contratos PDF).
     */
    private function buildExtras(array $models): array
    {
        $edadesHijos = $this->getEdadesHijos($models['alumInfoHijos'] ?? null);

        return [
            'edadesHijos' => $edadesHijos,
            // Si tu vista requiere estos en update, puedes agregarlos aquí.
            // 'alumAsisteMedico' => $models['alumAsisteMedico'] ?? new AlumAsisteMedico(),
            // 'alumAsisteDentista' => $models['alumAsisteDentista'] ?? new AlumAsisteDentista(),
        ];
    }

    /* ============================================================
     *  Builders “atómicos” (FORM)
     * ============================================================
     */

    private function buildDependientesData(?AlumDependenEconomica $alumDependenEconomica = null): array
    {
        if ($alumDependenEconomica === null || $alumDependenEconomica->isNewRecord) {
            return $this->getDependientesDefaults();
        }

        $dependientes = Dependientes::findAll([
            'alum_dependen_economica_id' => $alumDependenEconomica->id,
        ]);

        $seleccionados = [];
        $dependientesOtro = null;
        $otroId = CatalogoDependenciasEconomicas::getOtroId();

        foreach ($dependientes as $dep) {
            $depId = (int)$dep->catalogo_dependencias_economicas_id;
            $seleccionados[] = $depId;
            if ($otroId !== null && $depId === (int)$otroId) {
                $dependientesOtro = $dep->otro_especificar;
            }
        }

        return [
            'dependientes' => $dependientes,
            'dependientesSeleccionados' => $seleccionados,
            'dependientesOtro' => $dependientesOtro,
        ];
    }

    private function getDependientesDefaults(): array
    {
        return [
            'dependientes' => [],
            'dependientesSeleccionados' => [],
            'dependientesOtro' => null,
        ];
    }

    private function getEdadesHijos(?AlumInfoHijos $alumInfoHijos = null): array
    {
        if ($alumInfoHijos === null || $alumInfoHijos->isNewRecord) {
            return [];
        }

        return EdadesHijos::findAll([
            'alum_info_hijos_id' => $alumInfoHijos->id,
        ]);
    }

    private function buildProblemasSaludData(?AlumEstadoSalud $alumEstadoSalud = null): array
    {
        // FORM: siempre al menos 1 fila
        // PDF: solo filas con datos reales

        if ($alumEstadoSalud === null || $alumEstadoSalud->isNewRecord) {
            return [
                'problemasSalud' => [new ProblemasSalud()],
                'problemasSaludValidos' => [],
            ];
        }

        $problemasDb = ProblemasSalud::find()
            ->where(['alum_estado_salud_id' => $alumEstadoSalud->id])
            ->all();

        $validos = $this->filterFilledRows($problemasDb, [
            'catalogo_problemas_salud_id',
            'tipo_gravedad_id',
            'observaciones',
            'otro_especificar',
        ]);

        $problemasForm = $problemasDb;
        if (empty($problemasForm)) {
            $problemasForm = [new ProblemasSalud()];
        }

        return [
            'problemasSalud' => $problemasForm,
            'problemasSaludValidos' => $validos,
        ];
    }

    private function buildServiciosSaludData(?AlumServiciosSalud $alumServiciosSalud = null): array
    {
        if ($alumServiciosSalud === null || $alumServiciosSalud->isNewRecord) {
            return ['serviciosSaludSeleccionados' => []];
        }

        $ids = ServiciosSalud::find()
            ->select('catalogo_servicios_salud_id')
            ->where(['alum_servicios_salud_id' => $alumServiciosSalud->id])
            ->column();

        return [
            'serviciosSaludSeleccionados' => array_map('intval', $ids),
        ];
    }

    private function buildUsoAnteojosData(?AlumUsoAnteojos $alumUsoAnteojos = null): array
    {
        if ($alumUsoAnteojos === null || $alumUsoAnteojos->isNewRecord) {
            return ['usoAnteojosSeleccionados' => []];
        }

        $ids = UsoAnteojos::find()
            ->select('catalogo_uso_anteojos_id')
            ->where(['alum_uso_anteojos_id' => $alumUsoAnteojos->id])
            ->column();

        return [
            'usoAnteojosSeleccionados' => array_map('intval', $ids),
        ];
    }

    private function buildTratamientosData(?AlumTratamientos $alumTratamientos = null): array
    {
        if ($alumTratamientos === null || $alumTratamientos->isNewRecord) {
            return [
                'tratamientos' => [new Tratamientos()],
                'tratamientosValidos' => [],
            ];
        }

        $tratamientosDb = Tratamientos::find()
            ->where(['alum_tratamientos_id' => $alumTratamientos->id])
            ->all();

        $validos = $this->filterFilledRows($tratamientosDb, [
            'catalogo_tratamientos_id',
            'frecuencia_tiempo_id',
            'fecha_inicio',
            'fecha_fin',
            'observaciones',
            'otro_especificar',
        ]);

        $tratamientosForm = $tratamientosDb;
        if (empty($tratamientosForm)) {
            $tratamientosForm = [new Tratamientos()];
        }

        return [
            'tratamientos' => $tratamientosForm,
            'tratamientosValidos' => $validos,
        ];
    }

    private function buildLugaresComerData(int $alumnoId): array
    {
        $lugares = AlumLugaresComer::findAll(['alumnos_id' => $alumnoId]);

        $seleccionados = [];
        $otroTexto = null;
        $otrosPorId = [];
        $otroId = CatalogoLugaresComer::getOtroId();

        foreach ($lugares as $lugar) {
            $catalogoId = (int)$lugar->catalogo_lugares_comer_id;
            $seleccionados[] = $catalogoId;

            if ($otroId !== null && $catalogoId === $otroId) {
                $otroTexto = $lugar->otro_especificar;
            }
            if ($lugar->otro_especificar !== null && $lugar->otro_especificar !== '') {
                $otrosPorId[$catalogoId] = $lugar->otro_especificar;
            }
        }

        return [
            'lugaresComerSeleccionados' => $seleccionados,
            'lugarComerOtro' => $otroTexto,
            'lugaresComerOtroMap' => $otrosPorId,
        ];
    }

    private function buildConsumoAlimentosData(int $alumnoId): array
    {
        $consumos = AlumConsumoAlimentos::findAll(['alumnos_id' => $alumnoId]);
        if (empty($consumos)) {
            $consumos = [new AlumConsumoAlimentos(['alumnos_id' => $alumnoId])];
        }

        return ['consumoAlimentos' => $consumos];
    }

    private function buildDeportesData(?AlumDeportes $alumDeportes = null): array
    {
        if ($alumDeportes === null || $alumDeportes->isNewRecord) {
            return ['deportesSeleccionados' => []];
        }

        $ids = Deportes::find()
            ->select('catalogo_deportes_id')
            ->where(['alum_deportes_id' => $alumDeportes->id])
            ->column();

        return ['deportesSeleccionados' => array_map('intval', $ids)];
    }

    private function buildEjercicioFisicoData(?AlumEjercicio $alumEjercicio = null): array
    {
        if ($alumEjercicio === null || $alumEjercicio->isNewRecord) {
            return ['ejercicioFisicos' => []];
        }

        $ejercicios = EjercicioFisico::find()
            ->where(['alum_ejercicio_id' => $alumEjercicio->id])
            ->all();

        return ['ejercicioFisicos' => $ejercicios];
    }

    private function buildEnfermedadesCronicasData(?AlumEnfermedadesCronicas $alumEnfermedadesCronicas = null): array
    {
        if ($alumEnfermedadesCronicas === null || $alumEnfermedadesCronicas->isNewRecord) {
            return [
                'alumEnfermedadesCronicas' => $alumEnfermedadesCronicas ?? new AlumEnfermedadesCronicas(),
                'enfermedadesCronicas' => [new EnfermedadesCronicas()],
                'enfermedadesCronicasSeleccionadas' => [],
            ];
        }

        $enfermedades = EnfermedadesCronicas::find()
            ->where(['alum_enfermedades_cronicas_id' => $alumEnfermedadesCronicas->id])
            ->all();

        $seleccionadas = [];
        foreach ($enfermedades as $enfermedad) {
            $seleccionadas[(int)$enfermedad->catalogo_enferm_cronicas_id] = $enfermedad;
        }

        if (empty($enfermedades)) {
            $enfermedades = [new EnfermedadesCronicas()];
        }

        return [
            'alumEnfermedadesCronicas' => $alumEnfermedadesCronicas,
            'enfermedadesCronicas' => $enfermedades,
            'enfermedadesCronicasSeleccionadas' => $seleccionadas,
        ];
    }

    private function buildAlergiasData(?AlumAlergia $alumAlergia = null): array
    {
        if ($alumAlergia === null || $alumAlergia->isNewRecord) {
            return [
                'alergias' => [new Alergias()],
                'alergiasValidas' => [],
                'reaccionesAlergiasSeleccionadas' => [],
            ];
        }

        $alergiasDb = Alergias::find()
            ->where(['alum_alergia_id' => $alumAlergia->id])
            ->all();

        $validas = $this->filterFilledRows($alergiasDb, [
            'catalogo_alergias_id',
            'tipo_gravedad_id',
            'otro_especificar',
        ]);

        // Reacciones solo para alergias existentes (con id y con catálogo)
        $reacciones = [];
        foreach ($alergiasDb as $alergia) {
            if (empty($alergia->id) || empty($alergia->catalogo_alergias_id)) {
                continue;
            }

            $catalogoId = (int)$alergia->catalogo_alergias_id;

            $ids = VariasReaccionesAlergicas::find()
                ->select('catalogo_reacciones_alergicas_id')
                ->where(['alergias_id' => $alergia->id])
                ->column();

            $reacciones[$catalogoId] = array_map('intval', $ids);
        }

        $alergiasForm = $alergiasDb;
        if (empty($alergiasForm)) {
            $alergiasForm = [new Alergias()];
        }

        return [
            'alergias' => $alergiasForm,
            'alergiasValidas' => $validas,
            'reaccionesAlergiasSeleccionadas' => $reacciones,
        ];
    }

    private function buildBienesPersonalesData(int $alumnoId): array
    {
        $seleccionados = AlumBienesPersonales::find()
            ->select('catalogo_bienes_personales_id')
            ->where(['alumnos_id' => $alumnoId])
            ->column();

        return [
            'bienesPersonalesSeleccionados' => array_map('intval', $seleccionados),
        ];
    }

    private function buildRecreacionData(?AlumRecreacionTiempo $alumRecreacionTiempo = null): array
    {
        if ($alumRecreacionTiempo === null || $alumRecreacionTiempo->isNewRecord) {
            return $this->getRecreacionDefaults();
        }

        $ids = UsosInternet::find()
            ->select('catalogo_usos_internet_id')
            ->where(['alum_recreacion_tiempo_id' => $alumRecreacionTiempo->id])
            ->column();

        return [
            'usosInternetSeleccionados' => array_map('intval', $ids),
        ];
    }

    private function buildOrganizacionesData(?AlumOrganizacion $alumOrganizacion = null): array
    {
        if ($alumOrganizacion === null || $alumOrganizacion->isNewRecord) {
            return $this->getOrganizacionDefaults();
        }

        $organizaciones = Organizaciones::find()
            ->where(['alum_organizacion_id' => $alumOrganizacion->id])
            ->all();

        $seleccionadas = [];
        $otros = [];

        foreach ($organizaciones as $organizacion) {
            $catalogoId = (int)$organizacion->catalogo_organizaciones_id;
            $seleccionadas[] = $catalogoId;

            if ($organizacion->otra_organizacion_especificar !== null && $organizacion->otra_organizacion_especificar !== '') {
                $otros[$catalogoId] = $organizacion->otra_organizacion_especificar;
            }
        }

        return [
            'organizacionesSeleccionadas' => array_values(array_unique($seleccionadas)),
            'organizacionesOtroMap' => $otros,
        ];
    }

    /* ============================================================
     *  Vivienda (FORM + PDF)
     * ============================================================
     */

    /**
     * FORM: bienes + servicios (sin mezclar base PDF).
     */
    private function buildViviendaFormData(?AlumVivienda $alumVivienda = null): array
    {
        $bienes    = $this->buildViviendaBienesData($alumVivienda);
        $servicios = $this->buildViviendaServiciosData($alumVivienda);

        return array_merge($bienes, $servicios);
    }

    /**
     * PDF: contrato vivienda completo con base + bienes + servicios + bandera.
     */
    private function buildViviendaPdfData(?AlumVivienda $alumVivienda, array $viviendaForm): array
    {
        $data = $this->buildViviendaBaseData($alumVivienda);

        $data['bienesSeleccionados'] = $viviendaForm['bienesSeleccionados'] ?? [];
        $data['bienesOtro']          = $viviendaForm['bienesOtro'] ?? null;

        $data['serviciosSeleccionados'] = $viviendaForm['serviciosSeleccionados'] ?? [];
        $data['serviciosOtro']          = $viviendaForm['serviciosOtro'] ?? null;

        // Si base no trae info, pero sí bienes/servicios, consideramos que sí hay que imprimir
        if (empty($data['hayViviendaInfo'])) {
            $data['hayViviendaInfo'] = (
                !empty($data['bienesSeleccionados']) ||
                !empty($data['bienesOtro']) ||
                !empty($data['serviciosSeleccionados']) ||
                !empty($data['serviciosOtro'])
            );
        }

        return $data;
    }

    /**
     * SOLO bienes (para form). OJO: ya NO regresa getViviendaDefaults().
     */
    private function buildViviendaBienesData(?AlumVivienda $alumVivienda = null): array
    {
        if ($alumVivienda === null || $alumVivienda->isNewRecord) {
            return $this->getViviendaBienesDefaults();
        }

        $bienes = ViviendaBienes::findAll([
            'alum_vivienda_id' => $alumVivienda->id,
        ]);

        $seleccionados = [];
        $bienesOtro = null;
        $otroId = CatalogoBienesVivienda::getOtroId();

        foreach ($bienes as $bien) {
            $bienId = (int)$bien->catalogo_bienes_vivienda_id;
            $seleccionados[] = $bienId;

            if ($otroId !== null && $bienId === (int)$otroId) {
                $bienesOtro = $bien->otro_especificar;
            }
        }

        return [
            'bienesSeleccionados' => $seleccionados,
            'bienesOtro' => $bienesOtro,
        ];
    }

    /**
     * SOLO servicios (para form).
     */
    private function buildViviendaServiciosData(?AlumVivienda $alumVivienda = null): array
    {
        if ($alumVivienda === null || $alumVivienda->isNewRecord) {
            return $this->getViviendaServiciosDefaults();
        }

        $servicios = ViviendaServicios::findAll([
            'alum_vivienda_id' => $alumVivienda->id,
        ]);

        $seleccionados = [];
        $serviciosOtro = null;
        $otroId = CatalogoServiciosVivienda::getOtroId();

        foreach ($servicios as $servicio) {
            $servicioId = (int)$servicio->catalogo_servicios_vivienda_id;
            $seleccionados[] = $servicioId;

            if ($otroId !== null && $servicioId === (int)$otroId) {
                $serviciosOtro = $servicio->otro_especificar;
            }
        }

        return [
            'serviciosSeleccionados' => $seleccionados,
            'serviciosOtro' => $serviciosOtro,
        ];
    }

    private function getViviendaBienesDefaults(): array
    {
        return [
            'bienesSeleccionados' => [],
            'bienesOtro' => null,
        ];
    }

    private function getViviendaServiciosDefaults(): array
    {
        return [
            'serviciosSeleccionados' => [],
            'serviciosOtro' => null,
        ];
    }

    /**
     * Contrato vivienda COMPLETO (para create y para PDF base).
     */
    private function getViviendaDefaults(): array
    {
        return array_merge(
            $this->getViviendaBienesDefaults(),
            $this->getViviendaServiciosDefaults(),
            [
                // datos base vivienda (para PDF y para vista)
                'viveConPadres' => null,
                'viveConEspecifica' => null,
                'tipoViviendaId' => null,
                'tipoViviendaOtro' => null,

                // bandera: ayuda a imprimir o no imprimir
                'hayViviendaInfo' => false,
            ]
        );
    }

    /**
     * Base vivienda para PDF (y para contrato estable).
     * Ajusta nombres de campos reales si difieren en tu modelo.
     */
    private function buildViviendaBaseData(?AlumVivienda $alumVivienda = null): array
    {
        $data = $this->getViviendaDefaults();

        if ($alumVivienda === null || $alumVivienda->isNewRecord) {
            return $data;
        }

        // ✅ Campos REALES del modelo AlumVivienda
        $data['viveConPadres']     = $alumVivienda->vives_casa_padres;          // int requerido
        $data['viveConEspecifica'] = $this->normalizeText($alumVivienda->otro_especificar);

        $data['tipoViviendaId']    = (int)$alumVivienda->tipos_viviendas_id;    // int requerido
        $data['tipoViviendaOtro']  = $this->normalizeText($alumVivienda->otro_tipo_especificar);

        // bandera: ¿hay algo que valga la pena imprimir?
        $data['hayViviendaInfo'] = (
            $data['viveConPadres'] !== null ||                 // (siempre viene, pero lo dejamos robusto)
            !empty($data['viveConEspecifica']) ||
            ((int)($data['tipoViviendaId'] ?? 0) > 0) ||
            !empty($data['tipoViviendaOtro'])
        );

        return $data;
    }


    /* ============================================================
     *  Defaults (otras secciones)
     * ============================================================
     */

    private function getAlimentacionDefaults(int $alumnoId): array
    {
        return [
            'lugaresComerSeleccionados' => [],
            'lugarComerOtro' => null,
            'lugaresComerOtroMap' => [],
            'consumoAlimentos' => [new AlumConsumoAlimentos(['alumnos_id' => $alumnoId])],
        ];
    }

    private function getActividadFisicaDefaults(): array
    {
        return [
            'deportesSeleccionados' => [],
            'ejercicioFisicos' => [],
        ];
    }

    private function getRecreacionDefaults(): array
    {
        return [
            'usosInternetSeleccionados' => [],
        ];
    }

    private function getOrganizacionDefaults(): array
    {
        return [
            'organizacionesSeleccionadas' => [],
            'organizacionesOtroMap' => [],
        ];
    }

    private function getSaludDefaults(): array
    {
        return [
            'alumEnfermedadesCronicas' => new AlumEnfermedadesCronicas(),
            'enfermedadesCronicas' => [new EnfermedadesCronicas()],
            'enfermedadesCronicasSeleccionadas' => [],

            'alumAlergia' => new AlumAlergia(),
            'alergias' => [new Alergias()],
            'alergiasValidas' => [],
            'reaccionesAlergiasSeleccionadas' => [],

            'problemasSalud' => [new ProblemasSalud()],
            'problemasSaludValidos' => [],

            'serviciosSaludSeleccionados' => [],
            'alumAsisteMedico' => new AlumAsisteMedico(),
            'alumAsisteDentista' => new AlumAsisteDentista(),

            'usoAnteojosSeleccionados' => [],
        ];
    }

    private function getTratamientosDefaults(): array
    {
        return [
            'tratamientos' => [new Tratamientos()],
            'tratamientosValidos' => [],
        ];
    }

    /* ============================================================
     *  PDF: Familia, Beca, Situación económica
     * ============================================================
     */

    private function buildDatosFamiliaresPdfData($alumDatosFamiliares = null): array
    {
        $empty = [
            'nombre_completo' => null,
            'ocupacion' => null,
            'habla_maya' => null,
        ];

        if ($alumDatosFamiliares === null || $alumDatosFamiliares->isNewRecord) {
            return [
                'familiaPadre' => $empty,
                'familiaMadre' => $empty,
            ];
        }

        $padreNombre = trim(implode(' ', array_filter([
            $alumDatosFamiliares->padre_nombre ?? null,
            $alumDatosFamiliares->padre_apellido_paterno ?? null,
            $alumDatosFamiliares->padre_apellido_materno ?? null,
        ]))) ?: null;

        $madreNombre = trim(implode(' ', array_filter([
            $alumDatosFamiliares->madre_nombre ?? null,
            $alumDatosFamiliares->madre_apellido_paterno ?? null,
            $alumDatosFamiliares->madre_apellido_materno ?? null,
        ]))) ?: null;

        return [
            'familiaPadre' => [
                'nombre_completo' => $padreNombre,
                'ocupacion' => ($alumDatosFamiliares->padre_ocupacion ?? null) ?: null,
                'habla_maya' => $this->normalizeBool($alumDatosFamiliares->padre_mayahablante ?? null),
            ],
            'familiaMadre' => [
                'nombre_completo' => $madreNombre,
                'ocupacion' => ($alumDatosFamiliares->madre_ocupacion ?? null) ?: null,
                'habla_maya' => $this->normalizeBool($alumDatosFamiliares->madre_mayahablante ?? null),
            ],
        ];
    }

    private function buildBecaPdfData($alumBecas = null, array $tiposBecasMap = []): array
    {
        $tieneBeca = (int)($alumBecas ? ($alumBecas->tiene_beca ?? 0) : 0);

        if ($alumBecas === null || $alumBecas->isNewRecord || $tieneBeca !== 1) {
            return [
                'tieneBeca' => 0,
                'tipoTxt' => null,
                'otroTxt' => null,
                'esOtro' => false,
                'detalle' => 'El alumno no registra una beca vigente.',
            ];
        }

        $otroId = TiposBecas::getOtroId();
        $tipoId = $alumBecas->tipos_becas_id ?? null;
        $esTipoOtro = $otroId !== null && (int)$tipoId === (int)$otroId;

        $tipoTxt = $alumBecas->tiposBecas->nombre ?? null;

        if (!$tipoTxt) {
            if ($tipoId !== null && !empty($tiposBecasMap)) {
                $tipoTxt = $tiposBecasMap[(int)$tipoId] ?? null;
            }
        }

        if (!$tipoTxt && !empty($tipoId)) {
            $tipoTxt = (string)$tipoId;
        }

        $otroTxt = $esTipoOtro ? $this->normalizeText($alumBecas->otro_especificar ?? null) : null;

        return [
            'tieneBeca' => 1,
            'tipoTxt' => $tipoTxt,
            'otroTxt' => $otroTxt,
            'esOtro' => $esTipoOtro,
            'detalle' => null,
        ];
    }

    private function buildSituacionEconomicaPdfData(
        $depEcoModel = null,
        $depModel = null,
        array $catalogoDependenciasMap = [],
        array $dependientesSeleccionados = [],
        ?string $dependientesOtro = null
    ): array {
        // 1) Dependencia económica (de quién dependes)
        $depDeQuienRaw = $this->firstNonEmptyProp($depEcoModel, [
            'catalogo_dependencias_economicas_id',
            'dependencia_economica_id',
            'dependencia_id',
            'dependes_de',
            'de_quien_dependes',
        ]);

        $depOtro = $this->normalizeText(
            $this->firstNonEmptyProp($depEcoModel, [
                'otro_especificar',
                'especifica',
                'especificar',
                'dependencia_otro',
            ])
        );

        $depIds = $this->normalizeIds($depDeQuienRaw);

        $hayDependencia = $this->hasSelection($depIds) || !empty($depOtro);

        $depTxt = null;
        if ($this->hasSelection($depIds)) {
            $depTxt = $this->idsToText($depIds, $catalogoDependenciasMap);
        }

        // 2) Dependientes económicos (tiene dependientes)
        $tieneDependientes = $this->firstNonEmptyProp($depModel, [
            'tiene_dependientes',
            'tienes_dependientes',
            'dependientes',
            'tiene_dependiente',
        ]);

        if ($tieneDependientes === null) {
            $tieneDependientes = !empty($dependientesSeleccionados) ? 1 : 0;
        } else {
            $tieneDependientes = ((int)$tieneDependientes === 1) ? 1 : 0;
        }

        if ($tieneDependientes !== 1 && !empty($dependientesSeleccionados)) {
            $tieneDependientes = 1;
        }

        $dependientesTxt = null;
        if (!empty($dependientesSeleccionados)) {
            $dependientesTxt = $this->idsToText($dependientesSeleccionados, $catalogoDependenciasMap);
        }

        $dependientesOtro = $this->normalizeText($dependientesOtro);

        $hayDependientesInfo = ($tieneDependientes === 1) || !empty($dependientesTxt) || !empty($dependientesOtro);

        return [
            'dependencia' => [
                'hay' => $hayDependencia,
                'deQuienTxt' => $depTxt,
                'otroTxt' => $depOtro,
                'detalle' => $hayDependencia ? null : 'No registró su dependencia económica.',
            ],
            'dependientes' => [
                'tiene' => (int)$tieneDependientes,
                'hay' => $hayDependientesInfo,
                'listaTxt' => $dependientesTxt,
                'otroTxt' => $dependientesOtro,
                'detalle' => $hayDependientesInfo ? null : 'No registró dependientes económicos.',
            ],
        ];
    }

    /* ============================================================
     *  Catálogos
     * ============================================================
     */

    private function getCatalogosData(): array
    {
        return [
            'catalogoDependenciasOptions' => CatalogoDependenciasEconomicas::dropdownDependientesOptions(),
            'otroCatalogoDependenciaId' => CatalogoDependenciasEconomicas::getOtroId(),

            'tiposViviendasMap' => TiposViviendas::dropdownOptions(),
            'tipoViviendaOtroId' => TiposViviendas::getOtroId(),

            'catalogoBienesOptions' => CatalogoBienesVivienda::dropdownOptions(),
            'catalogoBienOtroId' => CatalogoBienesVivienda::getOtroId(),

            'catalogoServiciosViviendaOptions' => CatalogoServiciosVivienda::dropdownOptions(),
            'catalogoServicioOtroId' => CatalogoServiciosVivienda::getOtroId(),

            'catalogoBienesPersonalesOptions' => CatalogoBienesPersonales::dropdownOptions(),

            'catalogoTransportesMap' => CatalogoTransportes::dropdownOptions(),
            'tiemposRecorridoMap' => TiempoRecorridoTransporte::dropdownOptions(),

            'catalogoEnfermCronicasMap' => CatalogoEnfermCronicas::dropdownOptions(),
            'otroCatalogoEnfermCronicaId' => CatalogoEnfermCronicas::getOtroId(),

            'catalogoCigarrosDiaMap' => CatalogoCigarrosDia::dropdownOptions(),

            'catalogoLugaresComerMap' => CatalogoLugaresComer::dropdownOptions(),
            'catalogoLugarComerOtroId' => CatalogoLugaresComer::getOtroId(),

            'catalogoAlimentosMap' => CatalogoAlimentos::dropdownOptions(),
            'frecuenciasVecesMap' => FrecuenciaVeces::dropdownOptions(),

            'catalogoDeportesMap' => CatalogoDeportes::dropdownOptions(),
            'catalogoActividadesEjercicioMap' => CatalogoActividadEjercicio::dropdownOptions(),
            'frecuenciasVecesSemanaMap' => FrecuenciaVecesSemana::dropdownOptions(),

            'catalogoAlergiasMap' => CatalogoAlergias::dropdownOptions(),
            'catalogoProblemasSaludMap' => CatalogoProblemasSalud::dropdownOptions(),
            'catalogoReaccionesAlergicasMap' => CatalogoReaccionesAlergicas::dropdownOptions(),
            'catalogoServiciosSaludMap' => CatalogoServiciosSalud::dropdownOptions(),
            'catalogoTratamientosMap' => CatalogoTratamientos::dropdownOptions(),
            'catalogoUsoAnteojosMap' => CatalogoUsoAnteojos::dropdownOptions(),

            'frecuenciasTiempoMap' => FrecuenciaTiempo::dropdownOptions(),
            'tipoGravedadMap' => TipoGravedad::dropdownOptions(),

            'tiposBecasMap' => TiposBecas::dropdownOptions(),

            'otroCatalogoProblemaId' => CatalogoProblemasSalud::getOtroId(),
            'catalogoLugaresAccesoMap' => CatalogoLugaresAccesoPrincipal::dropdownOptions(),
            'catalogoUsosInternetMap' => CatalogoUsosInternet::dropdownOptions(),

            'catalogoOrganizacionesGrouped' => CatalogoOrganizaciones::groupedOptionsByTipo(),
            'catalogoOrganizacionesMap' => CatalogoOrganizaciones::dropdownOptions(),
            'catalogoOrganizacionOtroId' => CatalogoOrganizaciones::getOtroId(),
        ];
    }

    /* ============================================================
     *  Helpers (limpios y reutilizables)
     * ============================================================
     */

    private function firstNonEmptyProp($obj, array $props)
    {
        if (!$obj) return null;

        foreach ($props as $p) {
            if (isset($obj->$p) && $obj->$p !== '' && $obj->$p !== null) {
                return $obj->$p;
            }
        }
        return null;
    }

    private function normalizeText($v): ?string
    {
        $t = trim((string)($v ?? ''));
        return $t !== '' ? $t : null;
    }

    private function normalizeIds($raw)
    {
        if ($raw === null || $raw === '' || $raw === false) return null;

        if (is_array($raw)) {
            $out = array_values(array_filter(array_map('intval', $raw), fn($x) => $x > 0));
            return !empty($out) ? $out : null;
        }

        if (is_numeric($raw)) {
            $id = (int)$raw;
            return $id > 0 ? $id : null;
        }

        if (is_string($raw)) {
            $s = trim($raw);
            if ($s === '') return null;

            $json = json_decode($s, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($json)) {
                $out = array_values(array_filter(array_map('intval', $json), fn($x) => $x > 0));
                return !empty($out) ? $out : null;
            }

            if (str_contains($s, ',')) {
                $parts = array_map('trim', explode(',', $s));
                $out = array_values(array_filter(array_map('intval', $parts), fn($x) => $x > 0));
                return !empty($out) ? $out : null;
            }
        }

        return null;
    }

    private function hasSelection($ids): bool
    {
        if ($ids === null) return false;
        if (is_array($ids)) return !empty($ids);
        return is_numeric($ids) && (int)$ids > 0;
    }

    private function idsToText($ids, array $map): ?string
    {
        if (empty($map)) {
            if (is_array($ids)) return implode(', ', array_map('strval', $ids));
            return (string)$ids;
        }

        if (is_array($ids)) {
            $names = [];
            foreach ($ids as $id) {
                $id = (int)$id;
                if ($id > 0) $names[] = $map[$id] ?? (string)$id;
            }
            $names = array_values(array_filter($names, fn($x) => trim((string)$x) !== ''));
            return !empty($names) ? implode(', ', $names) : null;
        }

        $id = (int)$ids;
        return $id > 0 ? ($map[$id] ?? (string)$id) : null;
    }

    private function normalizeBool($v): ?int
    {
        if ($v === null || $v === '') return null;
        return ((int)$v === 1) ? 1 : 0;
    }

    private function isModelFilled($model, array $attrs): bool
    {
        if (!$model) return false;

        foreach ($attrs as $attr) {
            if (!isset($model->$attr)) continue;

            $v = $model->$attr;

            if (is_numeric($v) && (int)$v > 0) return true;
            if (is_string($v) && trim($v) !== '') return true;
            if ($v !== null && $v !== '' && $v !== false) return true;
        }

        return false;
    }

    private function filterFilledRows(array $rows, array $attrs): array
    {
        $rows = $rows ?? [];
        $rows = array_filter($rows, fn($m) => $this->isModelFilled($m, $attrs));
        return array_values($rows);
    }
}
