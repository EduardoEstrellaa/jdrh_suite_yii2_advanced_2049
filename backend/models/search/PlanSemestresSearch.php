<?php

namespace backend\models\search;

use common\models\PlanEstudios;
use common\models\PlanSemestres;
use common\models\Semestres;
use common\models\UnidadesEstudio;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PlanSemestresSearch represents the model behind the search form of `common\models\PlanSemestres`.
 */
class PlanSemestresSearch extends PlanSemestres
{
    public $planNombre;
    public $semestreNombre;
    public $unidadNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plan_licenciatura_id', 'semestres_id', 'unidades_estudio_id'], 'integer'],
            [['planNombre', 'semestreNombre', 'unidadNombre'], 'safe'],
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
        $query = PlanSemestres::find()->alias('ps')
            ->joinWith([
                'planLicenciatura pl' => function ($q) {
                    $q->joinWith(['planEstudios pe']);
                },
                'semestres s',
                'unidadesEstudio ue',
            ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['planNombre'] = [
            'asc' => ['pe.nombre' => SORT_ASC],
            'desc' => ['pe.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['semestreNombre'] = [
            'asc' => ['s.nombre' => SORT_ASC],
            'desc' => ['s.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['unidadNombre'] = [
            'asc' => ['ue.nombre' => SORT_ASC],
            'desc' => ['ue.nombre' => SORT_DESC],
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
            'plan_licenciatura_id' => $this->plan_licenciatura_id,
            'semestres_id' => $this->semestres_id,
            'unidades_estudio_id' => $this->unidades_estudio_id,
        ]);
        $query->andFilterWhere(['like', 'pe.nombre', $this->planNombre]);
        $query->andFilterWhere(['like', 's.nombre', $this->semestreNombre]);
        $query->andFilterWhere(['like', 'ue.nombre', $this->unidadNombre]);

        return $dataProvider;
    }
}
