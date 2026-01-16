<?php

use common\models\AlumInscripciones;
use common\models\AsignacionesAlumnosGrupos;
use common\models\AsignacionesGrupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\search\AsignacionesAlumnosGruposSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$groupFormatter = static function (AsignacionesGrupos $item): string {
    $nombre = $item->grupos->nombre ?? Yii::t('app', 'Grupo #{id}', ['id' => $item->id]);

    $ciclo = $item->ciclosSemestres;
    if (!$ciclo) {
        return $nombre;
    }

    $detalles = array_filter([
        $ciclo->ciclosEscolares->nombre ?? null,
        $ciclo->semestres->nombre ?? null,
    ]);

    return $detalles ? $nombre . ' (' . implode(' / ', $detalles) . ')' : $nombre;
};

$groupOptions = ArrayHelper::map(
    AsignacionesGrupos::find()
        ->with(['grupos', 'ciclosSemestres.ciclosEscolares', 'ciclosSemestres.semestres'])
        ->orderBy(['id' => SORT_ASC])
        ->all(),
    'id',
    $groupFormatter
);

$inscripcionFormatter = static function (AlumInscripciones $item): string {
    $alumno = $item->alumnos;
    $nombre = $alumno && $alumno->perfil ? $alumno->perfil->getNombreCompleto() : null;
    $nombre = $nombre ?: ($alumno->matricula ?? Yii::t('app', 'Inscripcion #{id}', ['id' => $item->id]));

    $partes = [$nombre];
    if ($alumno && $alumno->matricula) {
        $partes[] = Yii::t('app', 'Mat. {mat}', ['mat' => $alumno->matricula]);
    }

    if ($item->tiposInscripciones) {
        $partes[] = $item->tiposInscripciones->nombre;
    }

    $ciclo = $item->ciclosSemestres;
    if ($ciclo) {
        $detalles = array_filter([
            $ciclo->ciclosEscolares->nombre ?? null,
            $ciclo->semestres->nombre ?? null,
        ]);
        if ($detalles) {
            $partes[] = implode(' / ', $detalles);
        }
    }

    return implode(' | ', array_filter($partes));
};

$inscripcionOptions = ArrayHelper::map(
    AlumInscripciones::find()
        ->with(['alumnos', 'alumnos.perfil', 'ciclosSemestres.ciclosEscolares', 'ciclosSemestres.semestres', 'tiposInscripciones'])
        ->orderBy(['id' => SORT_DESC])
        ->all(),
    'id',
    $inscripcionFormatter
);

$this->title = Yii::t('app', 'Asignaciones Alumnos Grupos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asignaciones-alumnos-grupos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Asignaciones Alumnos Grupos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'grupoEtiqueta',
                'label' => Yii::t('app', 'Grupo'),
                'value' => 'grupoEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'asignaciones_grupos_id',
                    $groupOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],
            [
                'attribute' => 'inscripcionEtiqueta',
                'label' => Yii::t('app', 'Alumno / Inscripcion'),
                'value' => 'inscripcionEtiqueta',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'alum_inscripciones_id',
                    $inscripcionOptions,
                    ['class' => 'form-control', 'prompt' => Yii::t('app', 'Todos')]
                ),
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AsignacionesAlumnosGrupos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
