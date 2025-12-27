<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organizaciones;

/**
 * OrganizacionesSearch represents the model behind the search form of `common\models\Organizaciones`.
 */
class OrganizacionesSearch extends Organizaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alum_organizacion_id', 'catalogo_organizaciones_id'], 'integer'],
            [['otra_organizacion_especificar'], 'safe'],
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
        $query = Organizaciones::find();

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
            'alum_organizacion_id' => $this->alum_organizacion_id,
            'catalogo_organizaciones_id' => $this->catalogo_organizaciones_id,
        ]);

        $query->andFilterWhere(['like', 'otra_organizacion_especificar', $this->otra_organizacion_especificar]);

        return $dataProvider;
    }
}
