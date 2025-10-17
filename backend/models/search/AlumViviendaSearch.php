<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumVivienda;

/**
 * AlumViviendaSearch represents the model behind the search form of `backend\models\AlumVivienda`.
 */
class AlumViviendaSearch extends AlumVivienda
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'vives_casa_padres', 'tipos_viviendas_id'], 'integer'],
            [['otro_especificar', 'otro_tipo_especificar'], 'safe'],
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
        $query = AlumVivienda::find();

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
            'alumnos_id' => $this->alumnos_id,
            'vives_casa_padres' => $this->vives_casa_padres,
            'tipos_viviendas_id' => $this->tipos_viviendas_id,
        ]);

        $query->andFilterWhere(['like', 'otro_especificar', $this->otro_especificar])
            ->andFilterWhere(['like', 'otro_tipo_especificar', $this->otro_tipo_especificar]);

        return $dataProvider;
    }
}
