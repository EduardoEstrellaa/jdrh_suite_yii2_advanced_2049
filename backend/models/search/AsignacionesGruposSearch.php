<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AsignacionesGrupos;

/**
 * AsignacionesGruposSearch represents the model behind the search form of `backend\models\AsignacionesGrupos`.
 */
class AsignacionesGruposSearch extends AsignacionesGrupos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'semestres_id', 'ciclos_escolares_id', 'grupos_id', 'asignaciones_tutores_id'], 'integer'],
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
        $query = AsignacionesGrupos::find();

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
            'semestres_id' => $this->semestres_id,
            'ciclos_escolares_id' => $this->ciclos_escolares_id,
            'grupos_id' => $this->grupos_id,
            'asignaciones_tutores_id' => $this->asignaciones_tutores_id,
        ]);

        return $dataProvider;
    }
}
