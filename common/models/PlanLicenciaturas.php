<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "plan_licenciaturas".
 *
 * @property int $id
 * @property int $plan_estudios_id
 * @property int $licenciaturas_id
 *
 * @property Alumnos[] $alumnos
 * @property Licenciaturas $licenciaturas
 * @property PlanEstudios $planEstudios
 * @property-read string $planNombre
 * @property-read string $planEtiqueta
 * @property-read string $licenciaturaEtiqueta
 * @property PlanSemestres[] $planSemestres
 */
class PlanLicenciaturas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan_licenciaturas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan_estudios_id', 'licenciaturas_id'], 'required'],
            [['plan_estudios_id', 'licenciaturas_id'], 'integer'],
            [['licenciaturas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Licenciaturas::class, 'targetAttribute' => ['licenciaturas_id' => 'id']],
            [['plan_estudios_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanEstudios::class, 'targetAttribute' => ['plan_estudios_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_estudios_id' => 'Plan de estudios',
            'licenciaturas_id' => 'Licenciatura',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasMany(Alumnos::class, ['plan_licenciaturas_id' => 'id']);
    }

    /**
     * Gets query for [[Licenciaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLicenciaturas()
    {
        return $this->hasOne(Licenciaturas::class, ['id' => 'licenciaturas_id']);
    }

    /**
     * Gets query for [[PlanEstudios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanEstudios()
    {
        return $this->hasOne(PlanEstudios::class, ['id' => 'plan_estudios_id']);
    }

    /**
     * Gets query for [[PlanSemestres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlanSemestres()
    {
        return $this->hasMany(PlanSemestres::class, ['plan_licenciatura_id' => 'id']);
    }

    /**
     * Nombre del plan de estudios.
     */
    public function getPlanNombre(): ?string
    {
        return $this->planEstudios ? $this->planEstudios->nombre : null;
    }

    /**
     * Etiqueta que combina plan de estudios y licenciatura.
     */
    public function getPlanEtiqueta(): string
    {
        $plan = $this->planEstudios;
        $lic = $this->licenciaturas;
        if ($plan && $lic) {
            return $plan->nombre . ' – ' . $lic->nombre;
        }

        if ($plan) {
            return $plan->nombre;
        }

        if ($lic) {
            return $lic->nombre;
        }

        return Yii::t('app', 'Plan #{id}', ['id' => $this->id]);
    }

    /**
     * Etiqueta legible específica para la licenciatura.
     */
    public function getLicenciaturaEtiqueta(): string
    {
        return $this->licenciaturas ? $this->licenciaturas->nombre : Yii::t('app', 'Licenciatura #{id}', ['id' => $this->licenciaturas_id]);
    }

    /**
     * Devuelve un mapa de planes de estudios con licenciaturas [id => "PlanEstudios - Licenciatura"].
     *
     * @return array<int, string> Mapa donde la clave es el ID del plan y el valor es la combinación de PlanEstudios y Licenciatura.
     */
    public static function getPlanesLicenciaturasMap(): array
    {
        $planes = self::find()
            ->joinWith('licenciaturas')
            ->joinWith('planEstudios')
            ->all();

        return ArrayHelper::map(
            $planes,
            'id',
            fn($model) => $model->planEstudios->nombre . ' - ' . $model->licenciaturas->nombre
        );
    }
}
