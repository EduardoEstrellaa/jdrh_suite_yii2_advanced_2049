<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alumnos".
 *
 * @property int $id
 * @property int $perfil_id
 * @property string $matricula
 * @property int $plan_licenciaturas_id
 * @property int $generaciones_id
 *
 * @property AlumAlergia[] $alumAlergias
 * @property AlumAsisteDentista[] $alumAsisteDentistas
 * @property AlumAsisteMedico[] $alumAsisteMedicos
 * @property AlumBecas[] $alumBecas
 * @property AlumBienesPersonales[] $alumBienesPersonales
 * @property AlumConsumoAlimentos[] $alumConsumoAlimentos
 * @property AlumDatosFamiliares[] $alumDatosFamiliares
 * @property AlumDependeEconomicamente[] $alumDependeEconomicamentes
 * @property AlumDependenEconomica[] $alumDependenEconomicas
 * @property AlumDeportes[] $alumDeportes
 * @property AlumEjercicio[] $alumEjercicios
 * @property AlumEnfermedadesCronicas[] $alumEnfermedadesCronicas
 * @property AlumEstadoSalud[] $alumEstadoSaluds
 * @property AlumHabitosConsumo[] $alumHabitosConsumos
 * @property AlumInfoHijos[] $alumInfoHijos
 * @property AlumInscripciones[] $alumInscripciones
 * @property AlumLugaresComer[] $alumLugaresComers
 * @property AlumOrganizacion[] $alumOrganizacions
 * @property AlumRecreacionTiempo[] $alumRecreacionTiempos
 * @property AlumServiciosSalud[] $alumServiciosSaluds
 * @property AlumTrabajo[] $alumTrabajos
 * @property AlumTransportes[] $alumTransportes
 * @property AlumTratamientos[] $alumTratamientos
 * @property AlumUsoAnteojos[] $alumUsoAnteojos
 * @property AlumVivienda[] $alumViviendas
 * @property Generaciones $generaciones
 * @property Perfil $perfil
 * @property PlanLicenciaturas $planLicenciaturas
 */
class Alumnos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alumnos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil_id', 'matricula', 'plan_licenciaturas_id', 'generaciones_id'], 'required'],
            [['perfil_id', 'plan_licenciaturas_id', 'generaciones_id'], 'integer'],
            [['matricula'], 'string', 'max' => 10],
            [['matricula'], 'unique'],
            [['generaciones_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generaciones::class, 'targetAttribute' => ['generaciones_id' => 'id']],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::class, 'targetAttribute' => ['perfil_id' => 'id']],
            [['plan_licenciaturas_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanLicenciaturas::class, 'targetAttribute' => ['plan_licenciaturas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfil_id' => 'Perfil ID',
            'matricula' => 'Matricula',
            'plan_licenciaturas_id' => 'Plan Licenciaturas ID',
            'generaciones_id' => 'Generaciones ID',
        ];
    }

    /**
     * Gets query for [[AlumAlergias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumAlergias()
    {
        return $this->hasMany(AlumAlergia::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumAsisteDentistas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumAsisteDentistas()
    {
        return $this->hasMany(AlumAsisteDentista::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumAsisteMedicos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumAsisteMedicos()
    {
        return $this->hasMany(AlumAsisteMedico::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumBecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumBecas()
    {
        return $this->hasMany(AlumBecas::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumBienesPersonales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumBienesPersonales()
    {
        return $this->hasMany(AlumBienesPersonales::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumConsumoAlimentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumConsumoAlimentos()
    {
        return $this->hasMany(AlumConsumoAlimentos::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumDatosFamiliares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDatosFamiliares()
    {
        return $this->hasMany(AlumDatosFamiliares::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumDependeEconomicamentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDependeEconomicamentes()
    {
        return $this->hasMany(AlumDependeEconomicamente::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumDependenEconomicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDependenEconomicas()
    {
        return $this->hasMany(AlumDependenEconomica::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumDeportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumDeportes()
    {
        return $this->hasMany(AlumDeportes::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumEjercicios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumEjercicios()
    {
        return $this->hasMany(AlumEjercicio::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumEnfermedadesCronicas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumEnfermedadesCronicas()
    {
        return $this->hasMany(AlumEnfermedadesCronicas::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumEstadoSaluds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumEstadoSaluds()
    {
        return $this->hasMany(AlumEstadoSalud::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumHabitosConsumos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumHabitosConsumos()
    {
        return $this->hasMany(AlumHabitosConsumo::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumInfoHijos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInfoHijos()
    {
        return $this->hasMany(AlumInfoHijos::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumInscripciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumInscripciones()
    {
        return $this->hasMany(AlumInscripciones::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumLugaresComers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumLugaresComers()
    {
        return $this->hasMany(AlumLugaresComer::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumOrganizacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumOrganizacions()
    {
        return $this->hasMany(AlumOrganizacion::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumRecreacionTiempos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumRecreacionTiempos()
    {
        return $this->hasMany(AlumRecreacionTiempo::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumServiciosSaluds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumServiciosSaluds()
    {
        return $this->hasMany(AlumServiciosSalud::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumTrabajos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumTrabajos()
    {
        return $this->hasMany(AlumTrabajo::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumTransportes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumTransportes()
    {
        return $this->hasMany(AlumTransportes::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumTratamientos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumTratamientos()
    {
        return $this->hasMany(AlumTratamientos::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumUsoAnteojos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumUsoAnteojos()
    {
        return $this->hasMany(AlumUsoAnteojos::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[AlumViviendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumViviendas()
    {
        return $this->hasMany(AlumVivienda::class, ['alumnos_id' => 'id']);
    }

    /**
     * Gets query for [[Generaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGeneraciones()
    {
        return $this->hasOne(Generaciones::class, ['id' => 'generaciones_id']);
    }

    /**
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::class, ['id' => 'perfil_id']);
    }

    /**
     * Gets query for [[PlanLicenciaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanLicenciaturas()
    {
        return $this->hasOne(PlanLicenciaturas::class, ['id' => 'plan_licenciaturas_id']);
    }
}
