<?php

namespace backend\models\search;

use common\models\AsignacionesAlumnosGrupos;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AsignacionesAlumnosGruposSearch represents the model behind the search form of `common\models\AsignacionesAlumnosGrupos`.
 */
class AsignacionesAlumnosGruposSearch extends AsignacionesAlumnosGrupos
{
    public $grupoEtiqueta;
    public $inscripcionEtiqueta;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'asignaciones_grupos_id', 'alum_inscripciones_id'], 'integer'],
            [['grupoEtiqueta', 'inscripcionEtiqueta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = AsignacionesAlumnosGrupos::find()->alias('a');

        $query->joinWith([
            'asignacionesGrupos ag' => function ($q) {
                $q->joinWith(['grupos g']);
            },
            'alumInscripciones ai' => function ($q) {
                $q->joinWith([
                    'alumnos al' => function ($q2) {
                        $q2->joinWith(['perfil pf']);
                    },
                ]);
            },
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['grupoEtiqueta'] = [
            'asc' => ['g.nombre' => SORT_ASC],
            'desc' => ['g.nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['inscripcionEtiqueta'] = [
            'asc' => [
                'pf.nombre' => SORT_ASC,
                'pf.apellido' => SORT_ASC,
                'al.matricula' => SORT_ASC,
            ],
            'desc' => [
                'pf.nombre' => SORT_DESC,
                'pf.apellido' => SORT_DESC,
                'al.matricula' => SORT_DESC,
            ],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['a.id' => $this->id]);
        $query->andFilterWhere([
            'a.asignaciones_grupos_id' => $this->asignaciones_grupos_id,
            'a.alum_inscripciones_id' => $this->alum_inscripciones_id,
        ]);

        $query->andFilterWhere(['like', 'g.nombre', $this->grupoEtiqueta]);
        $query->andFilterWhere([
            'or',
            ['like', 'al.matricula', $this->inscripcionEtiqueta],
            ['like', 'pf.nombre', $this->inscripcionEtiqueta],
            ['like', 'pf.apellido', $this->inscripcionEtiqueta],
        ]);

        return $dataProvider;
    }
}
