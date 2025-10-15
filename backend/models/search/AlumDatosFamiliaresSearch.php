<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AlumDatosFamiliares;

/**
 * AlumDatosFamiliaresSearch represents the model behind the search form of `backend\models\AlumDatosFamiliares`.
 */
class AlumDatosFamiliaresSearch extends AlumDatosFamiliares
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'padre_mayahablante', 'madre_mayahablante'], 'integer'],
            [['padre_nombre', 'padre_apellido_paterno', 'padre_apellido_materno', 'padre_ocupacion', 'madre_nombre', 'madre_apellido_paterno', 'madre_apellido_materno', 'madre_ocupacion'], 'safe'],
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
        $query = AlumDatosFamiliares::find();

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
            'padre_mayahablante' => $this->padre_mayahablante,
            'madre_mayahablante' => $this->madre_mayahablante,
        ]);

        $query->andFilterWhere(['like', 'padre_nombre', $this->padre_nombre])
            ->andFilterWhere(['like', 'padre_apellido_paterno', $this->padre_apellido_paterno])
            ->andFilterWhere(['like', 'padre_apellido_materno', $this->padre_apellido_materno])
            ->andFilterWhere(['like', 'padre_ocupacion', $this->padre_ocupacion])
            ->andFilterWhere(['like', 'madre_nombre', $this->madre_nombre])
            ->andFilterWhere(['like', 'madre_apellido_paterno', $this->madre_apellido_paterno])
            ->andFilterWhere(['like', 'madre_apellido_materno', $this->madre_apellido_materno])
            ->andFilterWhere(['like', 'madre_ocupacion', $this->madre_ocupacion]);

        return $dataProvider;
    }
}
