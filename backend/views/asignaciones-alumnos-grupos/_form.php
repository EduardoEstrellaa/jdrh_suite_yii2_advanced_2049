<?php

use common\helpers\InputHelper;
use common\models\AlumInscripciones;
use common\models\AsignacionesGrupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AsignacionesAlumnosGrupos $model */
/** @var yii\widgets\ActiveForm $form */

$groupList = AsignacionesGrupos::find()
    ->with(['grupos', 'ciclosSemestres.ciclosEscolares', 'ciclosSemestres.semestres'])
    ->orderBy(['id' => SORT_ASC])
    ->all();

$groupLabel = static function (AsignacionesGrupos $item): string {
    $nombre = $item->grupos->nombre ?? Yii::t('app', 'Grupo #{id}', ['id' => $item->id]);
    $ciclo = $item->ciclosSemestres;
    if (!$ciclo) {
        return $nombre;
    }

    $detalles = array_filter([
        $ciclo->ciclosEscolares->nombre ?? null,
        $ciclo->semestres->nombre ?? null,
    ]);
    if (!$detalles) {
        return $nombre;
    }

    return $nombre . ' (' . implode(' / ', $detalles) . ')';
};

$inscripcionList = AlumInscripciones::find()
    ->with(['alumnos', 'alumnos.perfil', 'ciclosSemestres.ciclosEscolares', 'ciclosSemestres.semestres', 'tiposInscripciones'])
    ->orderBy(['id' => SORT_DESC])
    ->all();

$inscripcionLabel = static function (AlumInscripciones $item): string {
    $alumno = $item->alumnos;
    $nombre = $alumno && $alumno->perfil ? $alumno->perfil->getNombreCompleto() : null;
    $nombre = $nombre ?: ($alumno->matricula ?? Yii::t('app', 'Inscripcion #{id}', ['id' => $item->id]));
    $partes = [$nombre];

    if ($alumno && $alumno->matricula) {
        $partes[] = Yii::t('app', 'Mat. {mat}', ['mat' => $alumno->matricula]);
    }

    $tipo = $item->tiposInscripciones->nombre ?? null;
    if ($tipo) {
        $partes[] = $tipo;
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

$groupOptions = ArrayHelper::map($groupList, 'id', $groupLabel);
$inscripcionOptions = ArrayHelper::map($inscripcionList, 'id', $inscripcionLabel);

?>

<div class="asignaciones-alumnos-grupos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'asignaciones_grupos_id',
        'fa-users',
        $groupOptions,
        ['placeholder' => 'Selecciona un grupo'],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'alum_inscripciones_id',
        'fa-user-graduate',
        $inscripcionOptions,
        ['placeholder' => 'Selecciona una inscripcion'],
        ['allowClear' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
