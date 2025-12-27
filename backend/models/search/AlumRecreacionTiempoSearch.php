<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AlumRecreacionTiempo;

/**
 * AlumRecreacionTiempoSearch represents the model behind the search form of `common\models\AlumRecreacionTiempo`.
 */
class AlumRecreacionTiempoSearch extends AlumRecreacionTiempo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'sabes_usar_internet', 'tienes_acceso_internet', 'catalogo_lugares_acceso_principal_id'], 'integer'],
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
        $query = AlumRecreacionTiempo::find();

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
            'sabes_usar_internet' => $this->sabes_usar_internet,
            'tienes_acceso_internet' => $this->tienes_acceso_internet,
            'catalogo_lugares_acceso_principal_id' => $this->catalogo_lugares_acceso_principal_id,
        ]);

        return $dataProvider;
    }
}
