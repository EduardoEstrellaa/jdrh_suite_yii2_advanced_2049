<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dependientes;

/**
 * DependientesSearch represents the model behind the search form of `backend\models\Dependientes`.
 */
class DependientesSearch extends Dependientes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_dependen_economica_id', 'catalogo_dependencias_economicas_id'], 'integer'],
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
        $query = Dependientes::find();

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
            'alum_dependen_economica_id' => $this->alum_dependen_economica_id,
            'catalogo_dependencias_economicas_id' => $this->catalogo_dependencias_economicas_id,
        ]);

        $query->andFilterWhere(['like', 'otro_especificar', $this->otro_especificar]);

        return $dataProvider;
    }
}
