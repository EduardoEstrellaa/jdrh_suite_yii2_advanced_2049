<?php

namespace backend\models\search;

use common\models\Licenciaturas;
use common\models\PlanEstudios;
use common\models\PlanLicenciaturas;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PlanLicenciaturasSearch represents the model behind the search form of `common\models\PlanLicenciaturas`.
 */
class PlanLicenciaturasSearch extends PlanLicenciaturas
{
    public $planNombre;
    public $planEtiqueta;
    public $licenciaturaEtiqueta;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'plan_estudios_id', 'licenciaturas_id'], 'integer'],
            [['planNombre', 'planEtiqueta', 'licenciaturaEtiqueta'], 'safe'],
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
        $query = PlanLicenciaturas::find()->alias('pl')
            ->joinWith(['planEstudios pe', 'licenciaturas l']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['planNombre'] = [
            'asc' => ['pe.nombre' => SORT_ASC],
            'desc' => ['pe.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['planEtiqueta'] = [
            'asc' => ['pe.nombre' => SORT_ASC],
            'desc' => ['pe.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['licenciaturaEtiqueta'] = [
            'asc' => ['l.nombre' => SORT_ASC],
            'desc' => ['l.nombre' => SORT_DESC],
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
            'plan_estudios_id' => $this->plan_estudios_id,
            'licenciaturas_id' => $this->licenciaturas_id,
        ]);

        $query->andFilterWhere(['like', 'pe.nombre', $this->planNombre ?: $this->planEtiqueta]);
        $query->andFilterWhere(['like', 'l.nombre', $this->licenciaturaEtiqueta]);

        return $dataProvider;
    }
}
