<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ciclos_semestres".
 *
 * @property int $id
 * @property int $ciclos_escolares_id
 * @property int $semestres_id
 * @property string $fecha_inicio_semestre
 * @property string $fecha_fin_semestre
 * @property string $periodo_texto_semestre
 *
 * @property AlumInscripciones[] $alumInscripciones
 * @property AsignacionesGrupos[] $asignacionesGrupos
 * @property CiclosEscolares $ciclosEscolares
 * @property Semestres $semestres
 * @property-read string $cicloEtiqueta
 * @property-read string $semestreEtiqueta
 */
class CiclosSemestres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciclos_semestres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ciclos_escolares_id', 'semestres_id', 'fecha_inicio_semestre', 'fecha_fin_semestre', 'periodo_texto_semestre'], 'required'],
            [['ciclos_escolares_id', 'semestres_id'], 'integer'],
            [['fecha_inicio_semestre', 'fecha_fin_semestre'], 'safe'],
            [['periodo_texto_semestre'], 'string', 'max' => 250],
            [['ciclos_escolares_id'], 'exist', 'skipOnError' => true, 'targetClass' => CiclosEscolares::class, 'targetAttribute' => ['ciclos_escolares_id' => 'id']],
            [['semestres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Semestres::class, 'targetAttribute' => ['semestres_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ciclos_escolares_id' => 'Ciclo escolar',
            'semestres_id' => 'Semestre',
            'fecha_inicio_semestre' => 'Fecha inicio',
            'fecha_fin_semestre' => 'Fecha fin',
            'periodo_texto_semestre' => 'Periodo',
        ];
    }

    /**
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasMany(AlumInscripciones::class, ['ciclos_semestres_id' => 'id']);
    }

    /**
     * Gets query for [[AsignacionesGrupos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacionesGrupos()
    {
        return $this->hasMany(AsignacionesGrupos::class, ['ciclos_semestres_id' => 'id']);
    }

    /**
     * Gets query for [[CiclosEscolares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiclosEscolares()
    {
        return $this->hasOne(CiclosEscolares::class, ['id' => 'ciclos_escolares_id']);
    }

    /**
     * Gets query for [[Semestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSemestres()
    {
        return $this->hasOne(Semestres::class, ['id' => 'semestres_id']);
    }

    /**
     * Etiqueta legible para el ciclo escolar.
     */
    public function getCicloEtiqueta(): string
    {
        $ciclo = $this->ciclosEscolares;
        if (!$ciclo) {
            return Yii::t('app', 'Ciclo #{id}', ['id' => $this->id]);
        }

        $partes = array_filter([
            $ciclo->nombre,
            $ciclo->periodo_texto,
        ]);

        return $partes ? implode(' / ', $partes) : Yii::t('app', 'Ciclo #{id}', ['id' => $this->id]);
    }

    /**
     * Etiqueta legible para el semestre.
     */
    public function getSemestreEtiqueta(): string
    {
        $semestre = $this->semestres;
        if (!$semestre) {
            return Yii::t('app', 'Semestre #{id}', ['id' => $this->id]);
        }

        $partes = array_filter([
            $semestre->nombre,
            $semestre->tipoSemestres->nombre ?? null,
        ]);

        return $partes ? implode(' / ', $partes) : Yii::t('app', 'Semestre #{id}', ['id' => $this->id]);
    }
}
