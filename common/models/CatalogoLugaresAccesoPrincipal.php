<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "catalogo_lugares_acceso_principal".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property AlumRecreacionTiempo[] $alumRecreacionTiempos
 */
class CatalogoLugaresAccesoPrincipal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_lugares_acceso_principal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Returns a map id => nombre for dropdowns.
     */
    public static function dropdownOptions(): array
    {
        return static::find()
            ->select('nombre')
            ->indexBy('id')
            ->orderBy('nombre')
            ->column();
    }

    /**
     * Gets query for [[AlumRecreacionTiempos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlumRecreacionTiempos()
    {
        return $this->hasMany(AlumRecreacionTiempo::class, ['catalogo_lugares_acceso_principal_id' => 'id']);
    }
}
