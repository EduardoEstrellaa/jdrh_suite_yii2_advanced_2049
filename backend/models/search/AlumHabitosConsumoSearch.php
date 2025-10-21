<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumHabitosConsumo;

/**
 * AlumHabitosConsumoSearch represents the model behind the search form of `backend\models\AlumHabitosConsumo`.
 */
class AlumHabitosConsumoSearch extends AlumHabitosConsumo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'fumas', 'catalogo_cigarros_dia_id', 'tomas_alcohol', 'frecuencia_veces_semana_id', 'tienes_adicciones'], 'integer'],
            [['especificiar_adiccion'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = AlumHabitosConsumo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'alumnos_id' => $this->alumnos_id,
            'fumas' => $this->fumas,
            'catalogo_cigarros_dia_id' => $this->catalogo_cigarros_dia_id,
            'tomas_alcohol' => $this->tomas_alcohol,
            'frecuencia_veces_semana_id' => $this->frecuencia_veces_semana_id,
            'tienes_adicciones' => $this->tienes_adicciones,
        ]);

        $query->andFilterWhere(['like', 'especificiar_adiccion', $this->especificiar_adiccion]);

        return $dataProvider;
    }
}
