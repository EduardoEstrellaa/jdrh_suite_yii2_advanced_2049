<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DatosPersonales;

/**
 * DatosPersonalesSearch represents the model behind the search form of `backend\models\DatosPersonales`.
 */
class DatosPersonalesSearch extends DatosPersonales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id'], 'integer'],
            [['curp', 'nss', 'rfc'], 'safe'],
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
        $query = DatosPersonales::find();

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
        ]);

        $query->andFilterWhere(['like', 'curp', $this->curp])
            ->andFilterWhere(['like', 'nss', $this->nss])
            ->andFilterWhere(['like', 'rfc', $this->rfc]);

        return $dataProvider;
    }
}
