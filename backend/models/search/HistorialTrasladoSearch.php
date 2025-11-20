<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HistorialTraslado;

/**
 * HistorialTrasladoSearch represents the model behind the search form of `common\models\HistorialTraslado`.
 */
class HistorialTrasladoSearch extends HistorialTraslado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'equipos_id', 'departamento_origen_id', 'departamento_destino_id', 'usuario_responsable'], 'integer'],
            [['motivo_traslado', 'fecha_traslado'], 'safe'],
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
        $query = HistorialTraslado::find();

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
            'equipos_id' => $this->equipos_id,
            'departamento_origen_id' => $this->departamento_origen_id,
            'departamento_destino_id' => $this->departamento_destino_id,
            'usuario_responsable' => $this->usuario_responsable,
            'fecha_traslado' => $this->fecha_traslado,
        ]);

        $query->andFilterWhere(['like', 'motivo_traslado', $this->motivo_traslado]);

        return $dataProvider;
    }
}
