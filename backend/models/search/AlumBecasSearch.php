<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumBecas;

/**
 * AlumBecasSearch represents the model behind the search form of `backend\models\AlumBecas`.
 */
class AlumBecasSearch extends AlumBecas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'tiene_beca', 'tipos_becas_id'], 'integer'],
            [['otro_especificar'], 'safe'],
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
        $query = AlumBecas::find();

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
            'tiene_beca' => $this->tiene_beca,
            'tipos_becas_id' => $this->tipos_becas_id,
        ]);

        $query->andFilterWhere(['like', 'otro_especificar', $this->otro_especificar]);

        return $dataProvider;
    }
}
