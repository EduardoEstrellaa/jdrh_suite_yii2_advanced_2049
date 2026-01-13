<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asignaciones_grupos".
 *
 * @property int $id
 * @property int $ciclos_semestres_id
 * @property int $grupos_id
 * @property int $asignaciones_tutores_id
 *
 * @property AsignacionesAlumnosGrupos[] $asignacionesAlumnosGrupos
 * @property AsignacionesTutores $asignacionesTutores
 * @property CiclosSemestres $ciclosSemestres
 * @property Grupos $grupos
 * @property-read string $cicloEtiqueta
 * @property-read string $grupoEtiqueta
 * @property-read string $tutorEtiqueta
 */
class AsignacionesGrupos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignaciones_grupos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ciclos_semestres_id', 'grupos_id', 'asignaciones_tutores_id'], 'required'],
            [['ciclos_semestres_id', 'grupos_id', 'asignaciones_tutores_id'], 'integer'],
            [['asignaciones_tutores_id'], 'exist', 'skipOnError' => true, 'targetClass' => AsignacionesTutores::class, 'targetAttribute' => ['asignaciones_tutores_id' => 'id']],
            [['grupos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grupos::class, 'targetAttribute' => ['grupos_id' => 'id']],
            [['ciclos_semestres_id'], 'exist', 'skipOnError' => true, 'targetClass' => CiclosSemestres::class, 'targetAttribute' => ['ciclos_semestres_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ciclos_semestres_id' => 'Ciclo / Semestre',
            'grupos_id' => 'Grupo',
            'asignaciones_tutores_id' => 'Tutor asignado',
        ];
    }

    /**
     * Gets query for [[AsignacionesAlumnosGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesAlumnosGrupos()
    {
        return $this->hasMany(AsignacionesAlumnosGrupos::class, ['asignaciones_grupos_id' => 'id']);
    }

    /**
     * Gets query for [[AsignacionesTutores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesTutores()
    {
        return $this->hasOne(AsignacionesTutores::class, ['id' => 'asignaciones_tutores_id']);
    }

    /**
     * Gets query for [[CiclosSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosSemestres()
    {
        return $this->hasOne(CiclosSemestres::class, ['id' => 'ciclos_semestres_id']);
    }

    /**
     * Relación al semestre vía el ciclo.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasOne(Semestres::class, ['id' => 'semestres_id'])->via('ciclosSemestres');
    }

    /**
     * Relación al ciclo escolar para filtros.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosEscolares()
    {
        return $this->hasOne(CiclosEscolares::class, ['id' => 'ciclos_escolares_id'])->via('ciclosSemestres');
    }

    /**
     * Gets query for [[Grupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasOne(Grupos::class, ['id' => 'grupos_id']);
    }

    /**
     * Etiqueta legible para el ciclo y semestre.
     */
    public function getCicloEtiqueta(): string
    {
        $ciclo = $this->ciclosSemestres;
        if (!$ciclo) {
            return Yii::t('app', 'Ciclo #{id}', ['id' => $this->id]);
        }

        $partes = array_filter([
            $ciclo->cicloEtiqueta ?? null,
            $ciclo->semestreEtiqueta ?? null,
            $ciclo->periodo_texto_semestre,
        ]);

        return $partes ? implode(' · ', $partes) : Yii::t('app', 'Ciclo #{id}', ['id' => $this->id]);
    }

    /**
     * Etiqueta legible para el grupo.
     */
    public function getGrupoEtiqueta(): string
    {
        $grupo = $this->grupos;
        if (!$grupo) {
            return Yii::t('app', 'Grupo #{id}', ['id' => $this->id]);
        }

        $partes = array_filter([
            $grupo->nombre,
            $grupo->descripcion,
        ]);

        return $partes ? implode(' · ', $partes) : Yii::t('app', 'Grupo #{id}', ['id' => $this->id]);
    }

    /**
     * Etiqueta legible para el tutor.
     */
    public function getTutorEtiqueta(): string
    {
        $tutor = $this->asignacionesTutores;
        if (!$tutor || !$tutor->perfil) {
            return Yii::t('app', 'Tutor #{id}', ['id' => $this->asignaciones_tutores_id]);
        }

        $nombreCompleto = trim($tutor->perfil->getNombreCompleto());
        return $nombreCompleto !== '' ? $nombreCompleto : Yii::t('app', 'Tutor #{id}', ['id' => $tutor->id]);
    }
}
