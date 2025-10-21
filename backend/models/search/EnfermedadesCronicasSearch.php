<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EnfermedadesCronicas;

/**
 * EnfermedadesCronicasSearch represents the model behind the search form of `backend\models\EnfermedadesCronicas`.
 */
class EnfermedadesCronicasSearch extends EnfermedadesCronicas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'catalogo_enferm_cronicas_id', 'alum_enfermedades_cronicas_id'], 'integer'],
            [['otro_especificas'], 'safe'],
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
        $query = EnfermedadesCronicas::find();

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
            'catalogo_enferm_cronicas_id' => $this->catalogo_enferm_cronicas_id,
            'alum_enfermedades_cronicas_id' => $this->alum_enfermedades_cronicas_id,
        ]);

        $query->andFilterWhere(['like', 'otro_especificas', $this->otro_especificas]);

        return $dataProvider;
    }
}
