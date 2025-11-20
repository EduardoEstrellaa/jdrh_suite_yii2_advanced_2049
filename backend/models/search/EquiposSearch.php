<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Equipos;

/**
 * EquiposSearch represents the model behind the search form of `common\models\Equipos`.
 */
class EquiposSearch extends Equipos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'modelos_id', 'tipo_equipo_id', 'tipo_alta_id', 'estado_equipo_id'], 'integer'],
            [['fecha_alta', 'numero_inventario', 'numero_serie', 'foto_equipo', 'foto_numero_inventario', 'foto_numero_serie', 'observaciones', 'especificaciones'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Equipos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_alta' => $this->fecha_alta,
            'modelos_id' => $this->modelos_id,
            'tipo_equipo_id' => $this->tipo_equipo_id,
            'tipo_alta_id' => $this->tipo_alta_id,
            'estado_equipo_id' => $this->estado_equipo_id,
        ]);

        $query->andFilterWhere(['like', 'numero_inventario', $this->numero_inventario])
            ->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
            ->andFilterWhere(['like', 'foto_equipo', $this->foto_equipo])
            ->andFilterWhere(['like', 'foto_numero_inventario', $this->foto_numero_inventario])
            ->andFilterWhere(['like', 'foto_numero_serie', $this->foto_numero_serie])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones])
            ->andFilterWhere(['like', 'especificaciones', $this->especificaciones]);

        return $dataProvider;
    }
}
