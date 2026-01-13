<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asignaciones_alumnos_grupos".
 *
 * @property int $id
 * @property int $asignaciones_grupos_id
 * @property int $alum_inscripciones_id
 * @property-read string $grupoEtiqueta
 * @property-read string $inscripcionEtiqueta
 *
 * @property AlumInscripciones $alumInscripciones
 * @property AsignacionesGrupos $asignacionesGrupos
 */
class AsignacionesAlumnosGrupos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignaciones_alumnos_grupos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asignaciones_grupos_id', 'alum_inscripciones_id'], 'required'],
            [['asignaciones_grupos_id', 'alum_inscripciones_id'], 'integer'],
            [['alum_inscripciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlumInscripciones::class, 'targetAttribute' => ['alum_inscripciones_id' => 'id']],
            [['asignaciones_grupos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsignacionesGrupos::class, 'targetAttribute' => ['asignaciones_grupos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asignaciones_grupos_id' => 'Grupo',
            'alum_inscripciones_id' => 'Alumno / Inscripcion',
        ];
    }

    /**
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasOne(AlumInscripciones::class, ['id' => 'alum_inscripciones_id']);
    }

    /**
     * Gets query for [[AsignacionesGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesGrupos()
    {
        return $this->hasOne(AsignacionesGrupos::class, ['id' => 'asignaciones_grupos_id']);
    }

    /**
     * Etiqueta legible para el grupo.
     */
    public function getGrupoEtiqueta(): string
    {
        $asignacionGrupo = $this->asignacionesGrupos;
        if (!$asignacionGrupo) {
            return Yii::t('app', 'Sin grupo asignado');
        }

        $grupoNombre = $asignacionGrupo->grupos->nombre ?? Yii::t('app', 'Grupo #{id}', ['id' => $asignacionGrupo->id]);

        $ciclo = $asignacionGrupo->ciclosSemestres;
        $detalles = [];
        if ($ciclo) {
            $etiquetasCiclo = array_filter([
                $ciclo->ciclosEscolares->nombre ?? null,
                $ciclo->semestres->nombre ?? null,
            ]);
            if (!empty($etiquetasCiclo)) {
                $detalles[] = implode(' / ', $etiquetasCiclo);
            } else {
                $detalles[] = Yii::t('app', 'Ciclo #{id}', ['id' => $ciclo->id]);
            }
        }

        if (!empty($detalles)) {
            return $grupoNombre . ' | ' . implode(' | ', $detalles);
        }

        return $grupoNombre;
    }

    /**
     * Etiqueta legible para la inscripción/alumno.
     */
    public function getInscripcionEtiqueta(): string
    {
        $inscripcion = $this->alumInscripciones;
        if (!$inscripcion) {
            return Yii::t('app', 'Inscripcion no disponible');
        }

        $alumno = $inscripcion->alumnos;
        $nombreCompleto = null;
        if ($alumno && $alumno->perfil) {
            $nombreCompleto = $alumno->perfil->getNombreCompleto();
        }
        $nombreCompleto = $nombreCompleto ?: $alumno->matricula ?? Yii::t('app', 'Alumno #{id}', ['id' => $alumno->id ?? $inscripcion->id]);
        $matricula = $alumno->matricula ?? null;

        $tiposInscripcion = $inscripcion->tiposInscripciones->nombre ?? null;

        $ciclo = $inscripcion->ciclosSemestres;
        $cicloTexto = null;
        if ($ciclo) {
            $partesCiclo = array_filter([
                $ciclo->ciclosEscolares->nombre ?? null,
                $ciclo->semestres->nombre ?? null,
            ]);
            if (!empty($partesCiclo)) {
                $cicloTexto = implode(' / ', $partesCiclo);
            } else {
                $cicloTexto = Yii::t('app', 'Ciclo #{id}', ['id' => $ciclo->id]);
            }
        }

        $partes = array_filter([
            $nombreCompleto,
            $matricula ? Yii::t('app', 'Mat. {mat}', ['mat' => $matricula]) : null,
            $tiposInscripcion,
            $cicloTexto,
        ]);

        return $partes ? implode(' | ', $partes) : Yii::t('app', 'Inscripcion #{id}', ['id' => $inscripcion->id]);
    }
}
