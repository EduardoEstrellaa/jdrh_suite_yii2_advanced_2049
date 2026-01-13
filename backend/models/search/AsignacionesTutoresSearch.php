<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AsignacionesTutores;

/**
 * AsignacionesTutoresSearch represents the model behind the search form of `common\models\AsignacionesTutores`.
 */
class AsignacionesTutoresSearch extends AsignacionesTutores
{
    public ?string $perfilNombre = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'perfil_id'], 'integer'],
            [['perfilNombre'], 'safe'],
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
        $query = AsignacionesTutores::find()
            ->alias('at')
            ->joinWith(['perfil' => function ($queryPerfil) {
                $queryPerfil->alias('perfil');
            }]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['perfilNombre'] = [
            'asc' => ['perfil.nombre' => SORT_ASC, 'perfil.apellido' => SORT_ASC],
            'desc' => ['perfil.nombre' => SORT_DESC, 'perfil.apellido' => SORT_DESC],
        ];
        $dataProvider->sort->defaultOrder = ['perfilNombre' => SORT_ASC];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'at.id' => $this->id,
            'at.perfil_id' => $this->perfil_id,
        ]);

        if ($this->perfilNombre) {
            $query->andWhere([
                'or',
                ['like', 'perfil.nombre', $this->perfilNombre],
                ['like', 'perfil.apellido', $this->perfilNombre],
            ]);
        }

        return $dataProvider;
    }
}
