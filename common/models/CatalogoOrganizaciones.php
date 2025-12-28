<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "catalogo_organizaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $tipo_organizacion_id
 *
 * @property Organizaciones[] $organizaciones
 * @property TipoOrganizacion $tipoOrganizacion
 */
class CatalogoOrganizaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catalogo_organizaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_organizacion_id'], 'required'],
            [['tipo_organizacion_id'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['descripcion'], 'string', 'max' => 250],
            [['tipo_organizacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoOrganizacion::class, 'targetAttribute' => ['tipo_organizacion_id' => 'id']],
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
            'descripcion' => 'Descripcion',
            'tipo_organizacion_id' => 'Tipo Organizacion ID',
        ];
    }

    /**
     * Opciones simples (id => nombre) ordenadas alfabeticamente.
     */
    public static function dropdownOptions(): array
    {
        $records = static::find()
            ->select(['id', 'nombre'])
            ->orderBy(['nombre' => SORT_ASC])
            ->asArray()
            ->all();

        return ArrayHelper::map($records, 'id', 'nombre');
    }

    /**
     * Opciones agrupadas por tipo de organizacion.
     *
     * @return array<string, array<int, array{id:int,nombre:string}>>
     */
    public static function groupedOptionsByTipo(): array
    {
        $records = static::find()
            ->alias('co')
            ->select(['co.id', 'co.nombre', 't.nombre AS tipo'])
            ->leftJoin(['t' => TipoOrganizacion::tableName()], 't.id = co.tipo_organizacion_id')
            ->orderBy(['t.nombre' => SORT_ASC, 'co.nombre' => SORT_ASC])
            ->asArray()
            ->all();

        $grouped = [];
        foreach ($records as $record) {
            $tipo = $record['tipo'] ?? 'Organizaciones';
            $grouped[$tipo][] = [
                'id' => (int)$record['id'],
                'nombre' => $record['nombre'],
            ];
        }

        return $grouped;
    }

    /**
     * Identificador del registro "Otro" si existe.
     */
    public static function getOtroId(): ?int
    {
        $record = static::find()
            ->select('id')
            ->where(['like', 'nombre', 'otro', false])
            ->orderBy(['id' => SORT_ASC])
            ->one();

        return $record ? (int)$record->id : null;
    }

    /**
     * Gets query for [[Organizaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizaciones()
    {
        return $this->hasMany(Organizaciones::class, ['catalogo_organizaciones_id' => 'id']);
    }

    /**
     * Gets query for [[TipoOrganizacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrganizacion()
    {
        return $this->hasOne(TipoOrganizacion::class, ['id' => 'tipo_organizacion_id']);
    }
}
