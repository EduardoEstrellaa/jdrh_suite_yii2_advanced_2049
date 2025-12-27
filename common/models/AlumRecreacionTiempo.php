<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alum_recreacion_tiempo".
 *
 * @property int $id
 * @property int $alumnos_id
 * @property int $sabes_usar_internet
 * @property int $tienes_acceso_internet
 * @property int $catalogo_lugares_acceso_principal_id
 *
 * @property Alumnos $alumnos
 * @property CatalogoLugaresAccesoPrincipal $catalogoLugaresAccesoPrincipal
 * @property UsosInternet[] $usosInternets
 */
class AlumRecreacionTiempo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alum_recreacion_tiempo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alumnos_id', 'sabes_usar_internet', 'tienes_acceso_internet'], 'required', 'strict' => true],
            [['alumnos_id', 'sabes_usar_internet', 'tienes_acceso_internet', 'catalogo_lugares_acceso_principal_id'], 'integer'],
            [
                ['catalogo_lugares_acceso_principal_id'],
                'required',
                'when' => static function ($model) {
                    return (int)$model->tienes_acceso_internet === 1;
                },
                'whenClient' => "function () { return parseInt($('#alumrecreaciontiempo-tienes_acceso_internet').val(), 10) === 1; }",
            ],
            [['alumnos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alumnos::class, 'targetAttribute' => ['alumnos_id' => 'id']],
            [['catalogo_lugares_acceso_principal_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogoLugaresAccesoPrincipal::class, 'targetAttribute' => ['catalogo_lugares_acceso_principal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alumnos_id' => 'Alumnos ID',
            'sabes_usar_internet' => 'Sabes Usar Internet',
            'tienes_acceso_internet' => 'Tienes Acceso Internet',
            'catalogo_lugares_acceso_principal_id' => 'Catalogo Lugares Acceso Principal ID',
        ];
    }

    /**
     * Gets query for [[Alumnos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumnos()
    {
        return $this->hasOne(Alumnos::class, ['id' => 'alumnos_id']);
    }

    /**
     * Gets query for [[CatalogoLugaresAccesoPrincipal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogoLugaresAccesoPrincipal()
    {
        return $this->hasOne(CatalogoLugaresAccesoPrincipal::class, ['id' => 'catalogo_lugares_acceso_principal_id']);
    }

    /**
     * Gets query for [[UsosInternets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsosInternets()
    {
        return $this->hasMany(UsosInternet::class, ['alum_recreacion_tiempo_id' => 'id']);
    }
}
