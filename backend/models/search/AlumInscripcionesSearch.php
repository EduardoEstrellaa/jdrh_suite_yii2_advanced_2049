<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumInscripciones;

/**
 * AlumInscripcionesSearch represents the model behind the search form of `backend\models\AlumInscripciones`.
 */
class AlumInscripcionesSearch extends AlumInscripciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'tipos_inscripciones_id', 'semestre_id', 'ciclos_escolares_id'], 'integer'],
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
        $query = AlumInscripciones::find();

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
            'tipos_inscripciones_id' => $this->tipos_inscripciones_id,
            'semestre_id' => $this->semestre_id,
            'ciclos_escolares_id' => $this->ciclos_escolares_id,
        ]);

        return $dataProvider;
    }
}
