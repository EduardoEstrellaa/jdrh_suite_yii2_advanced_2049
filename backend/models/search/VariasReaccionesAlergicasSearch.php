<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\VariasReaccionesAlergicas;

/**
 * VariasReaccionesAlergicasSearch represents the model behind the search form of `common\models\VariasReaccionesAlergicas`.
 */
class VariasReaccionesAlergicasSearch extends VariasReaccionesAlergicas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alergias_id', 'catalogo_reacciones_alergicas_id'], 'integer'],
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
        $query = VariasReaccionesAlergicas::find();

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
            'alergias_id' => $this->alergias_id,
            'catalogo_reacciones_alergicas_id' => $this->catalogo_reacciones_alergicas_id,
        ]);

        return $dataProvider;
    }
}
