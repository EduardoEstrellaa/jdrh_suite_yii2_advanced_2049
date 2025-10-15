<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DatosGenerales;

/**
 * DatosGeneralesSearch represents the model behind the search form of `backend\models\DatosGenerales`.
 */
class DatosGeneralesSearch extends DatosGenerales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id', 'maya_hablante', 'estados_civiles_id', 'nacionalidades_id'], 'integer'],
            [['tlf_personal', 'tlf_emergencia', 'email_personal'], 'safe'],
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
        $query = DatosGenerales::find();

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
            'perfil_id' => $this->perfil_id,
            'maya_hablante' => $this->maya_hablante,
            'estados_civiles_id' => $this->estados_civiles_id,
            'nacionalidades_id' => $this->nacionalidades_id,
        ]);

        $query->andFilterWhere(['like', 'tlf_personal', $this->tlf_personal])
            ->andFilterWhere(['like', 'tlf_emergencia', $this->tlf_emergencia])
            ->andFilterWhere(['like', 'email_personal', $this->email_personal]);

        return $dataProvider;
    }
}
