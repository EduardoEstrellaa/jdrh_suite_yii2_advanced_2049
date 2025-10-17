<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumTransportes;

/**
 * AlumTransportesSearch represents the model behind the search form of `backend\models\AlumTransportes`.
 */
class AlumTransportesSearch extends AlumTransportes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'catalogo_transportes_id', 'tiempo_recorrido_transporte_id'], 'integer'],
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
        $query = AlumTransportes::find();

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
            'alumnos_id' => $this->alumnos_id,
            'catalogo_transportes_id' => $this->catalogo_transportes_id,
            'tiempo_recorrido_transporte_id' => $this->tiempo_recorrido_transporte_id,
        ]);

        return $dataProvider;
    }
}
