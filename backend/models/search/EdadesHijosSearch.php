<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EdadesHijos;

/**
 * EdadesHijosSearch represents the model behind the search form of `backend\models\EdadesHijos`.
 */
class EdadesHijosSearch extends EdadesHijos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_info_hijos_id'], 'integer'],
            [['nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento'], 'safe'],
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
        $query = EdadesHijos::find();

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
            'alum_info_hijos_id' => $this->alum_info_hijos_id,
            'fecha_nacimiento' => $this->fecha_nacimiento,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido_paterno', $this->apellido_paterno])
            ->andFilterWhere(['like', 'apellido_materno', $this->apellido_materno]);

        return $dataProvider;
    }
}
