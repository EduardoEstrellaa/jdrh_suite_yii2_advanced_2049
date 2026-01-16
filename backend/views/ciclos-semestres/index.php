<?php

use common\models\CiclosEscolares;
use common\models\CiclosSemestres;
use common\models\Semestres;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\CiclosSemestresSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$cicloOptions = ArrayHelper::map(
    CiclosEscolares::find()->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    static function ($item) {
        return $item->nombre;
    }
);

$semestreOptions = ArrayHelper::map(
    Semestres::find()->with('tipoSemestres')->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    static function (Semestres $item) {
        $partes = array_filter([
            $item->nombre,
            $item->tipoSemestres->nombre ?? null,
        ]);

        return $partes ? implode(' | ', $partes) : $item->nombre;
    }
);

$this->title = Yii::t('app', 'Ciclos Semestres');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ciclos-semestres-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ciclos Semestres'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'cicloEtiqueta',
                'label' => Yii::t('app', 'Ciclo escolar'),
                'value' => 'cicloEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'ciclos_escolares_id',
                    $cicloOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'attribute' => 'semestreEtiqueta',
                'label' => Yii::t('app', 'Semestre'),
                'value' => 'semestreEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'semestres_id',
                    $semestreOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            'fecha_inicio_semestre',
            'fecha_fin_semestre',
            'periodo_texto_semestre',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CiclosSemestres $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
