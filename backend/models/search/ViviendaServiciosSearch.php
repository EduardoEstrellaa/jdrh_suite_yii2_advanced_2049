<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ViviendaServicios;

/**
 * ViviendaServiciosSearch represents the model behind the search form of `backend\models\ViviendaServicios`.
 */
class ViviendaServiciosSearch extends ViviendaServicios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_vivienda_id', 'catalogo_servicios_vivienda_id'], 'integer'],
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
        $query = ViviendaServicios::find();

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
            'alum_vivienda_id' => $this->alum_vivienda_id,
            'catalogo_servicios_vivienda_id' => $this->catalogo_servicios_vivienda_id,
        ]);

        $query->andFilterWhere(['like', 'otro_especificar', $this->otro_especificar]);

        return $dataProvider;
    }
}
