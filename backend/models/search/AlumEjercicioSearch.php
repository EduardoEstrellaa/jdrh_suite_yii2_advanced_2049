<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumEjercicio;

/**
 * AlumEjercicioSearch represents the model behind the search form of `backend\models\AlumEjercicio`.
 */
class AlumEjercicioSearch extends AlumEjercicio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'haces_ejercicio_fisico'], 'integer'],
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
        $query = AlumEjercicio::find();

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
            'haces_ejercicio_fisico' => $this->haces_ejercicio_fisico,
        ]);

        return $dataProvider;
    }
}
