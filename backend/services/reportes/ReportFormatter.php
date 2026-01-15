<?php

namespace backend\services\reportes;

use common\models\AlumHabitosConsumo;
use common\models\Alumnos;
use common\models\Perfil;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Formatea entidades de reporte hacia estructuras simples.
 */
class ReportFormatter
{
    /**
     * Devuelve 'SI' o 'NO' segun existencia de registros de salud.
     */
    public function tieneSalud(Alumnos $registro): string
    {
        return $this->primerRegistro($registro->alumEstadoSaluds, 'tuvo_problema_salud') ? 'SI' : 'NO';
    }

    /**
     * Devuelve 'SI' o 'NO' segun existan enfermedades cronicas.
     */
    public function tieneCronicas(Alumnos $registro): string
    {
        $cronicas = $this->primerRegistro($registro->alumEnfermedadesCronicas, 'padece_enfermedades_cronicas');
        return $cronicas ? 'SI' : 'NO';
    }
    /**
     * Devuelve 'SI' o 'NO' segun existan alergias registradas.
     */
    public function tieneAlergias(Alumnos $registro): string
    {
        $alergias = $this->primerRegistro($registro->alumAlergias, 'padeces_alergias');
        return $alergias ? 'SI' : 'NO';
    }

    /**
     * Devuelve 'SI' o 'NO' segun existan tratamientos registrados.
     */
    public function tieneTratamientos(Alumnos $registro): string
    {
        $tratamientos = $this->primerRegistro($registro->alumTratamientos, 'esta_en_tratamiento');
        return $tratamientos ? 'SI' : 'NO';
    }

    /**
     * Devuelve 'SI' o 'NO' segun existan servicios de salud registrados.
     */
    public function tieneServiciosSalud(Alumnos $registro): string
    {
        $servicios = $this->primerRegistro($registro->alumServiciosSalud, 'tiene_servicios_salud');
        return $servicios ? 'SI' : 'NO';
    }

    public function extraerDetalleSalud(Alumnos $registro): array
    {
        return [
            'cronicas' => $this->coleccionarCronicas($registro),
            'alergias' => $this->coleccionarAlergias($registro),
            'tratamientos' => $this->coleccionarTratamientos($registro),
            'servicios' => $this->coleccionarServicios($registro),
        ];
    }

    public function extraerDetalladoSalud(Alumnos $registro): array
    {
        $detalle = $this->extraerDetalleSalud($registro);
        $detalle['problemas_salud'] = $this->coleccionarProblemasSalud($registro);
        return $detalle;
    }

    private function coleccionarCronicas(Alumnos $registro): array
    {
        return $this->coleccionarNombres(
            $registro->alumEnfermedadesCronicas,
            fn($item) => array_filter(array_map(
                fn($entry) => $entry->catalogoEnfermCronicas?->nombre ?? $entry->otro_especificar ?? null,
                $item->enfermedadesCronicas ?? []
            ))
        );
    }

    private function coleccionarAlergias(Alumnos $registro): array
    {
        return $this->coleccionarNombres(
            $registro->alumAlergias,
            fn($item) => array_filter(array_map(
                fn($entry) => $entry->catalogoAlergias?->nombre ?? null,
                $item->alergias ?? []
            ))
        );
    }

    private function coleccionarTratamientos(Alumnos $registro): array
    {
        return $this->coleccionarNombres(
            $registro->alumTratamientos,
            fn($item) => array_filter(array_map(
                fn($entry) => $entry->catalogoTratamientos?->nombre ?? null,
                $item->tratamientos ?? []
            ))
        );
    }

    private function coleccionarServicios(Alumnos $registro): array
    {
        return $this->coleccionarNombres(
            $registro->alumServiciosSalud ? [$registro->alumServiciosSalud] : [],
            fn($item) => array_filter(array_map(
                fn($entry) => $entry->catalogoServiciosSalud?->nombre ?? null,
                $item->serviciosSaluds ?? []
            ))
        );
    }

    private function coleccionarProblemasSalud(Alumnos $registro): array
    {
        $coleccion = [];
        $estado = is_array($registro->alumEstadoSaluds) ? ($registro->alumEstadoSaluds[0] ?? null) : $registro->alumEstadoSaluds;
        if ($estado && $estado->problemasSaluds) {
            foreach ($estado->problemasSaluds as $item) {
                $nombre = $item->catalogoProblemasSalud?->nombre;
                if ($nombre) {
                    $coleccion[] = $nombre;
                }
            }
        }
        return array_values(array_unique($coleccion));
    }

    private function coleccionarNombres(iterable $coleccion, ?callable $extraer = null): array
    {
        $nombres = [];
        foreach ($coleccion as $item) {
            if ($extraer) {
                $values = $extraer($item);
                if (is_iterable($values)) {
                    foreach ($values as $value) {
                        $nombres[] = $value;
                    }
                } elseif ($values) {
                    $nombres[] = $values;
                }
                continue;
            }

            if (is_object($item)) {
                $nombres[] = $item->nombre ?? null;
            }
        }

        return array_values(array_unique(array_filter($nombres)));
    }

    private function primerRegistro($coleccion, string $atributo)
    {
        if (is_array($coleccion)) {
            $registro = $coleccion[0] ?? null;
        } else {
            $registro = $coleccion;
        }

        if (!$registro) {
            return null;
        }

        $valor = ArrayHelper::getValue($registro, $atributo);
        return $valor ? $registro : null;
    }

    /**
     * Retorna el nombre completo o matricula segun disponibilidad.
     */
    public function obtenerNombreAlumno(Alumnos $registro): string
    {
        return $registro->perfil ? $registro->perfil->nombreCompleto : $registro->matricula;
    }

    /**
     * Extrae la generacion principal desde la inscripcion.
     */
    public function extraerGrupoPrincipal(Alumnos $registro): string
    {
        /** @var null|\common\models\AlumInscripciones $inscripcion */
        $inscripciones = $registro->alumInscripciones;
        $gruposAsignados = [];
        foreach ($inscripciones as $inscripcion) {
            $gruposAsignados = array_merge(
                $gruposAsignados,
                $inscripcion->asignacionesAlumnosGrupos ?? []
            );
        }
        if ($gruposAsignados) {
            foreach ($gruposAsignados as $registroGrupo) {
                $grupoAsignacion = $registroGrupo->asignacionesGrupos;
                $grupoNombre = $grupoAsignacion && $grupoAsignacion->grupos
                    ? $grupoAsignacion->grupos->nombre
                    : null;
                if ($grupoNombre) {
                    return $grupoNombre;
                }
                $grupoEtiqueta = $registroGrupo->grupoEtiqueta;
                if ($grupoEtiqueta && stripos($grupoEtiqueta, Yii::t('app', 'Sin grupo asignado')) === false) {
                    return $grupoEtiqueta;
                }
            }
        }

        return 'No asignado';
    }

    /**
     * Clasifica el nivel de riesgo en base a habitos de consumo.
     */
    public function clasificarRiesgoHabitos(AlumHabitosConsumo $habito): array
    {
        $componentes = [
            'Fuma' => (bool)$habito->fumas,
            'Consume alcohol' => (bool)$habito->tomas_alcohol,
            'Tiene adicciones' => (bool)$habito->tienes_adicciones,
        ];

        $positivos = array_keys(array_filter($componentes));
        $cantidad = count($positivos);
        $nivel = 'verde';
        if ($cantidad === 1) {
            $nivel = 'amarillo';
        } elseif ($cantidad >= 2) {
            $nivel = 'rojo';
        }

        $etiquetas = [
            'verde' => Yii::t('app', 'Bajo riesgo'),
            'amarillo' => Yii::t('app', 'Riesgo moderado'),
            'rojo' => Yii::t('app', 'Riesgo alto'),
        ];

        return [
            'nivel' => $nivel,
            'etiqueta' => ArrayHelper::getValue($etiquetas, $nivel, $etiquetas['verde']),
            'motivos' => $positivos ?: ['Sin consumo registrado'],
            'peso' => ($nivel === 'rojo' ? 3 : ($nivel === 'amarillo' ? 2 : 1)),
        ];
    }

    /**
     * Devuelve el nombre del tutor o texto por defecto.
     */
    public function obtenerNombreTutor(?Perfil $perfil): string
    {
        return $perfil ? $perfil->nombreCompleto : 'Sin tutor';
    }
}
