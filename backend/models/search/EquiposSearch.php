<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Equipos;

class EquiposSearch extends Equipos
{
    public function beforeValidate()
{
    // NO aplicar la lógica del modelo padre en el search
    return true;
}

    public function rules()
    {
        return [
            [['id', 'modelos_id', 'tipo_equipo_id', 'tipo_alta_id', 'estado_equipo_id', 'marca_id'], 'integer'],
            [['fecha_alta', 'numero_inventario', 'numero_serie', 'foto_equipo', 'foto_numero_inventario',
              'foto_numero_serie', 'observaciones', 'especificaciones'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Equipos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // FILTROS EXACTOS
        $query->andFilterWhere([
            'id' => $this->id,
            'modelos_id' => $this->modelos_id,
            'tipo_equipo_id' => $this->tipo_equipo_id,
            'tipo_alta_id' => $this->tipo_alta_id,
            'estado_equipo_id' => $this->estado_equipo_id,
            'marca_id' => $this->marca_id,
        ]);

        // FECHA (like)
        if (!empty($this->fecha_alta)) {
            $query->andFilterWhere(['like', 'fecha_alta', $this->fecha_alta]);
        }

        // FILTROS DE TEXTO
        $query->andFilterWhere(['like', 'numero_inventario', $this->numero_inventario])
              ->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
              ->andFilterWhere(['like', 'observaciones', $this->observaciones])
              ->andFilterWhere(['like', 'especificaciones', $this->especificaciones]);

        return $dataProvider;
    }
}
