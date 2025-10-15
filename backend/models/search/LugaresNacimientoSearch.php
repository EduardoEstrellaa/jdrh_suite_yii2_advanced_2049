<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LugaresNacimiento;

/**
 * LugaresNacimientoSearch represents the model behind the search form of `backend\models\LugaresNacimiento`.
 */
class LugaresNacimientoSearch extends LugaresNacimiento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id', 'entidades_federativas_id', 'municipios_id', 'localidades_id'], 'integer'],
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
        $query = LugaresNacimiento::find();

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

        return $dataProvider;
    }
}
