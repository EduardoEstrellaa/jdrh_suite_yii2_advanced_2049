<?php

namespace backend\models\search;

use common\models\AlumInscripciones;
use common\models\Alumnos;
use common\models\CiclosSemestres;
use common\models\TiposInscripciones;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AlumInscripcionesSearch represents the model behind the search form of `common\models\AlumInscripciones`.
 */
class AlumInscripcionesSearch extends AlumInscripciones
{
    public $alumnoNombre;
    public $cicloEtiqueta;
    public $tipoNombre;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'alumnos_id', 'ciclos_semestres_id', 'tipos_inscripciones_id'], 'integer'],
            [['alumnoNombre', 'cicloEtiqueta', 'tipoNombre'], 'safe'],
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
        $query = AlumInscripciones::find()->alias('ai');

        $query->joinWith([
            'alumnos al' => function ($q) {
                $q->joinWith(['perfil pf']);
            },
            'ciclosSemestres cs' => function ($q) {
                $q->joinWith(['ciclosEscolares ce', 'semestres s']);
            },
            'tiposInscripciones ti',
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['alumnoNombre'] = [
            'asc' => ['pf.nombre' => SORT_ASC, 'pf.apellido' => SORT_ASC],
            'desc' => ['pf.nombre' => SORT_DESC, 'pf.apellido' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['cicloEtiqueta'] = [
            'asc' => ['ce.nombre' => SORT_ASC, 's.nombre' => SORT_ASC],
            'desc' => ['ce.nombre' => SORT_DESC, 's.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['tipoNombre'] = [
            'asc' => ['ti.nombre' => SORT_ASC],
            'desc' => ['ti.nombre' => SORT_DESC],
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
            'alumnos_id' => $this->alumnos_id,
            'ciclos_semestres_id' => $this->ciclos_semestres_id,
            'tipos_inscripciones_id' => $this->tipos_inscripciones_id,
        ]);

        $query->andFilterWhere(['like', 'pf.nombre', $this->alumnoNombre]);
        $query->andFilterWhere(['like', 'pf.apellido', $this->alumnoNombre]);
        $query->andFilterWhere(['like', 'ce.nombre', $this->cicloEtiqueta]);
        $query->andFilterWhere(['like', 's.nombre', $this->cicloEtiqueta]);
        $query->andFilterWhere(['like', 'ti.nombre', $this->tipoNombre]);

        return $dataProvider;
    }
}
