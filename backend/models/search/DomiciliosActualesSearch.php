<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DomiciliosActuales;

/**
 * DomiciliosActualesSearch represents the model behind the search form of `backend\models\DomiciliosActuales`.
 */
class DomiciliosActualesSearch extends DomiciliosActuales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id', 'entidades_federativas_id', 'municipios_id', 'localidades_id'], 'integer'],
            [['calle', 'numero_exterior', 'numero_interior', 'colonia', 'codigo_postal'], 'safe'],
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
        $query = DomiciliosActuales::find();

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
            'entidades_federativas_id' => $this->entidades_federativas_id,
            'municipios_id' => $this->municipios_id,
            'localidades_id' => $this->localidades_id,
        ]);

        $query->andFilterWhere(['like', 'calle', $this->calle])
            ->andFilterWhere(['like', 'numero_exterior', $this->numero_exterior])
            ->andFilterWhere(['like', 'numero_interior', $this->numero_interior])
            ->andFilterWhere(['like', 'colonia', $this->colonia])
            ->andFilterWhere(['like', 'codigo_postal', $this->codigo_postal]);

        return $dataProvider;
    }
}
