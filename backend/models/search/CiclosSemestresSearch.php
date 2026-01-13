<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CiclosSemestres;

/**
 * CiclosSemestresSearch represents the model behind the search form of `common\models\CiclosSemestres`.
 */
class CiclosSemestresSearch extends CiclosSemestres
{
    public $cicloEtiqueta;
    public $semestreEtiqueta;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ciclos_escolares_id', 'semestres_id'], 'integer'],
            [['fecha_inicio_semestre', 'fecha_fin_semestre', 'periodo_texto_semestre'], 'safe'],
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
        $query = CiclosSemestres::find()->alias('cs');

        $query->joinWith([
            'ciclosEscolares ce',
            'semestres s' => function ($q) {
                $q->joinWith(['tipoSemestres ts']);
            },
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['cicloEtiqueta'] = [
            'asc' => ['ce.nombre' => SORT_ASC],
            'desc' => ['ce.nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['semestreEtiqueta'] = [
            'asc' => ['s.nombre' => SORT_ASC],
            'desc' => ['s.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ciclos_escolares_id' => $this->ciclos_escolares_id,
            'semestres_id' => $this->semestres_id,
            'fecha_inicio_semestre' => $this->fecha_inicio_semestre,
            'fecha_fin_semestre' => $this->fecha_fin_semestre,
        ]);

        $query->andFilterWhere(['like', 'periodo_texto_semestre', $this->periodo_texto_semestre]);

        $query->andFilterWhere(['like', 'ce.nombre', $this->cicloEtiqueta]);
        $query->andFilterWhere([
            'or',
            ['like', 's.nombre', $this->semestreEtiqueta],
            ['like', 'ts.nombre', $this->semestreEtiqueta],
        ]);

        return $dataProvider;
    }
}
