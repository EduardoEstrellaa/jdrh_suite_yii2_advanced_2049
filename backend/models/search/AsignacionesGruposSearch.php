<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AsignacionesGrupos;

/**
 * AsignacionesGruposSearch represents the model behind the search form of `common\models\AsignacionesGrupos`.
 */
class AsignacionesGruposSearch extends AsignacionesGrupos
{
    public $cicloEtiqueta;
    public $grupoEtiqueta;
    public $tutorEtiqueta;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ciclos_semestres_id', 'grupos_id', 'asignaciones_tutores_id'], 'integer'],
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
        $query = AsignacionesGrupos::find()->alias('ag');

        $query->joinWith([
            'ciclosSemestres cs' => function ($q) {
                $q->joinWith(['ciclosEscolares ce', 'semestres s']);
            },
            'grupos g',
            'asignacionesTutores at' => function ($q) {
                $q->joinWith(['perfil pf']);
            },
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['cicloEtiqueta'] = [
            'asc' => [
                'ce.nombre' => SORT_ASC,
                'ce.periodo_texto' => SORT_ASC,
                's.nombre' => SORT_ASC,
            ],
            'desc' => [
                'ce.nombre' => SORT_DESC,
                'ce.periodo_texto' => SORT_DESC,
                's.nombre' => SORT_DESC,
            ],
        ];

        $dataProvider->sort->attributes['grupoEtiqueta'] = [
            'asc' => ['g.nombre' => SORT_ASC],
            'desc' => ['g.nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tutorEtiqueta'] = [
            'asc' => [
                'pf.nombre' => SORT_ASC,
                'pf.apellido' => SORT_ASC,
            ],
            'desc' => [
                'pf.nombre' => SORT_DESC,
                'pf.apellido' => SORT_DESC,
            ],
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
            'ciclos_semestres_id' => $this->ciclos_semestres_id,
            'grupos_id' => $this->grupos_id,
            'asignaciones_tutores_id' => $this->asignaciones_tutores_id,
        ]);

        $query->andFilterWhere(['like', 'ce.nombre', $this->cicloEtiqueta]);
        $query->andFilterWhere(['like', 'ce.periodo_texto', $this->cicloEtiqueta]);
        $query->andFilterWhere(['like', 's.nombre', $this->cicloEtiqueta]);
        $query->andFilterWhere(['like', 'g.nombre', $this->grupoEtiqueta]);
        $query->andFilterWhere([
            'or',
            ['like', 'pf.nombre', $this->tutorEtiqueta],
            ['like', 'pf.apellido', $this->tutorEtiqueta],
        ]);

        return $dataProvider;
    }
}
