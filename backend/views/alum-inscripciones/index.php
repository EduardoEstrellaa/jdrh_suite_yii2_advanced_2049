<?php

use backend\models\search\AlumInscripcionesSearch;
use common\models\Alumnos;
use common\models\AlumInscripciones;
use common\models\CiclosSemestres;
use common\models\TiposInscripciones;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var AlumInscripcionesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$alumnoOptions = ArrayHelper::map(
    Alumnos::find()
        ->joinWith(['perfil profile'])
        ->orderBy(['profile.nombre' => SORT_ASC, 'profile.apellido' => SORT_ASC])
        ->all(),
    'id',
    function (Alumnos $item) {
        if ($item->perfil) {
            return trim($item->perfil->nombre . ' ' . $item->perfil->apellido);
        }
        return $item->matricula ?: Yii::t('app', 'Alumno #{id}', ['id' => $item->id]);
    }
);

$cicloOptions = ArrayHelper::map(
    CiclosSemestres::find()
        ->with(['ciclosEscolares', 'semestres'])
        ->orderBy(['id' => SORT_DESC])
        ->all(),
    'id',
    function (CiclosSemestres $item) {
        $parts = array_filter([
            $item->ciclosEscolares->nombre ?? null,
            $item->semestres->nombre ?? null,
        ]);
        return $parts ? implode(' · ', $parts) : Yii::t('app', 'Ciclo #{id}', ['id' => $item->id]);
    }
);

$tipoOptions = ArrayHelper::map(
    TiposInscripciones::find()->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    'nombre'
);

$this->title = Yii::t('app', 'Alum Inscripciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alum-inscripciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Alum Inscripciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'alumnoNombre',
                'label' => Yii::t('app', 'Alumno'),
                'value' => 'alumnoNombre',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'alumnos_id',
                    $alumnoOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
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
                'attribute' => 'tipoNombre',
                'label' => Yii::t('app', 'Tipo de inscripción'),
                'value' => 'tipoNombre',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'tipos_inscripciones_id',
                    $tipoOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, AlumInscripciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
