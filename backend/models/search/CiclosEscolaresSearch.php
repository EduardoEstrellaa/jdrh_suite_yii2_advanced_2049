<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CiclosEscolares;

/**
 * CiclosEscolaresSearch represents the model behind the search form of `common\models\CiclosEscolares`.
 */
class CiclosEscolaresSearch extends CiclosEscolares
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'estados_ciclos_escolares_id'], 'integer'],
            [['nombre', 'fecha_inicio', 'fecha_fin', 'periodo_texto'], 'safe'],
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
        $query = CiclosEscolares::find();

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
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estados_ciclos_escolares_id' => $this->estados_ciclos_escolares_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'periodo_texto', $this->periodo_texto]);

        return $dataProvider;
    }
}
