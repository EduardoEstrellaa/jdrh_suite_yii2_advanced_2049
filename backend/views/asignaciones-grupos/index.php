<?php

use common\models\AsignacionesGrupos;
use common\models\AsignacionesTutores;
use common\models\CiclosSemestres;
use common\models\Grupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\search\AsignacionesGruposSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$cicloOptions = ArrayHelper::map(
    CiclosSemestres::find()
        ->with(['ciclosEscolares', 'semestres'])
        ->orderBy(['id' => SORT_DESC])
        ->all(),
    'id',
    static function (CiclosSemestres $item): string {
        $parts = array_filter([
            $item->cicloEtiqueta ?? null,
            $item->semestreEtiqueta ?? null,
            $item->periodo_texto_semestre,
        ]);

        return $parts ? implode(' · ', $parts) : Yii::t('app', 'Ciclo #{id}', ['id' => $item->id]);
    }
);

$groupOptions = ArrayHelper::map(
    Grupos::find()->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    static function (Grupos $item): string {
        $parts = array_filter([$item->nombre, $item->descripcion]);
        return $parts ? implode(' · ', $parts) : Yii::t('app', 'Grupo #{id}', ['id' => $item->id]);
    }
);

$tutorOptions = ArrayHelper::map(
    AsignacionesTutores::find()->with('perfil')->orderBy(['id' => SORT_ASC])->all(),
    'id',
    static function (AsignacionesTutores $item): string {
        $perfil = $item->perfil;
        $nombre = $perfil ? trim($perfil->getNombreCompleto()) : '';
        if ($nombre !== '') {
            return $nombre;
        }

        return Yii::t('app', 'Tutor #{id}', ['id' => $item->id]);
    }
);

$this->title = Yii::t('app', 'Asignaciones Grupos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignaciones-grupos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Asignaciones Grupos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'cicloEtiqueta',
                'label' => Yii::t('app', 'Ciclo / Semestre'),
                'value' => 'cicloEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'ciclos_semestres_id',
                    $cicloOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'attribute' => 'grupoEtiqueta',
                'label' => Yii::t('app', 'Grupo'),
                'value' => 'grupoEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'grupos_id',
                    $groupOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'attribute' => 'tutorEtiqueta',
                'label' => Yii::t('app', 'Tutor asignado'),
                'value' => 'tutorEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'asignaciones_tutores_id',
                    $tutorOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AsignacionesGrupos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
