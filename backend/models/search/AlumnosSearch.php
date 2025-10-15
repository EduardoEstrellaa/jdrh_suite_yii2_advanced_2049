<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alumnos;

/**
 * AlumnosSearch represents the model behind the search form of `backend\models\Alumnos`.
 */
class AlumnosSearch extends Alumnos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id', 'plan_licenciaturas_id', 'generaciones_id'], 'integer'],
            [['matricula'], 'safe'],
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
        $query = Alumnos::find();

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
            'perfil_id' => $this->perfil_id,
            'plan_licenciaturas_id' => $this->plan_licenciaturas_id,
            'generaciones_id' => $this->generaciones_id,
        ]);

        $query->andFilterWhere(['like', 'matricula', $this->matricula]);

        return $dataProvider;
    }
}
