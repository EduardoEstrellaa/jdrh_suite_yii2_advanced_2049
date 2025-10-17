<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumTrabajo;

/**
 * AlumTrabajoSearch represents the model behind the search form of `backend\models\AlumTrabajo`.
 */
class AlumTrabajoSearch extends AlumTrabajo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'tiene_trabajo'], 'integer'],
            [['nombre_empresa', 'puesto_ocupacion', 'horario_entrada', 'horario_salida'], 'safe'],
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
        $query = AlumTrabajo::find();

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
            'tiene_trabajo' => $this->tiene_trabajo,
            'horario_entrada' => $this->horario_entrada,
            'horario_salida' => $this->horario_salida,
        ]);

        $query->andFilterWhere(['like', 'nombre_empresa', $this->nombre_empresa])
            ->andFilterWhere(['like', 'puesto_ocupacion', $this->puesto_ocupacion]);

        return $dataProvider;
    }
}
