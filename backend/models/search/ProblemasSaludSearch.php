<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProblemasSalud;

/**
 * ProblemasSaludSearch represents the model behind the search form of `backend\models\ProblemasSalud`.
 */
class ProblemasSaludSearch extends ProblemasSalud
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_estado_salud_id', 'catalogo_problemas_salud_id', 'tipo_gravedad_id'], 'integer'],
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
        $query = ProblemasSalud::find();

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
            'alum_estado_salud_id' => $this->alum_estado_salud_id,
            'catalogo_problemas_salud_id' => $this->catalogo_problemas_salud_id,
            'tipo_gravedad_id' => $this->tipo_gravedad_id,
        ]);

        $query->andFilterWhere(['like', 'otro_especificar', $this->otro_especificar]);

        return $dataProvider;
    }
}
