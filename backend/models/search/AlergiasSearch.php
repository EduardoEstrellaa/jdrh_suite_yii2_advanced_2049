<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Alergias;

/**
 * AlergiasSearch represents the model behind the search form of `common\models\Alergias`.
 */
class AlergiasSearch extends Alergias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_alergia_id', 'catalogo_alergias_id', 'tipo_gravedad_id'], 'integer'],
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
        $query = Alergias::find();

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
            'alum_alergia_id' => $this->alum_alergia_id,
            'catalogo_alergias_id' => $this->catalogo_alergias_id,
            'tipo_gravedad_id' => $this->tipo_gravedad_id,
        ]);

        return $dataProvider;
    }
}
