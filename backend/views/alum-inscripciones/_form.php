<?php

use backend\models\TiposInscripciones;
use common\helpers\InputHelper;
use common\models\Alumnos;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlumInscripciones $model */
/** @var yii\widgets\ActiveForm $form */

$alumnosList = Alumnos::find()
    ->with('perfil')
    ->orderBy(['matricula' => SORT_ASC])
    ->all();

$alumnoLabel = static function (Alumnos $alumno): string {
    $nombre = $alumno->perfil ? $alumno->perfil->getNombreCompleto() : null;
    $matricula = $alumno->matricula;

    if (!$nombre && !$matricula) {
        return Yii::t('app', 'Alumno #{id}', ['id' => $alumno->id]);
    }

    $partes = array_filter([
        $nombre,
        $matricula ? Yii::t('app', 'Mat. {mat}', ['mat' => $matricula]) : null,
    ]);

    return implode(' | ', $partes);
};

$alumnoOptions = ArrayHelper::map($alumnosList, 'id', $alumnoLabel);

$ciclosQuery = (new Query())
    ->select([
        'cs.id',
        'ce.nombre AS ciclo',
        's.nombre AS semestre',
    ])
    ->from(['cs' => '{{%ciclos_semestres}}'])
    ->leftJoin('{{%ciclos_escolares}} ce', 'ce.id = cs.ciclos_escolares_id')
    ->leftJoin('{{%semestres}} s', 's.id = cs.semestres_id')
    ->orderBy(['ce.nombre' => SORT_DESC, 's.nombre' => SORT_DESC]);

$ciclosList = $ciclosQuery->all();

$cicloOptions = ArrayHelper::map(
    $ciclosList,
    'id',
    static function ($row) {
        $partes = array_filter([
            $row['ciclo'] ?? null,
            $row['semestre'] ?? null,
        ]);

        if (empty($partes)) {
            return Yii::t('app', 'Ciclo #{id}', ['id' => $row['id']]);
        }

        return implode(' | ', $partes);
    }
);

$tiposList = TiposInscripciones::find()
    ->orderBy(['nombre' => SORT_ASC])
    ->all();

$tiposOptions = ArrayHelper::map($tiposList, 'id', 'nombre');
?>

<div class="alum-inscripciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'alumnos_id',
        'fa-user',
        $alumnoOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un alumno')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'ciclos_semestres_id',
        'fa-calendar-alt',
        $cicloOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un ciclo')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'tipos_inscripciones_id',
        'fa-file-alt',
        $tiposOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un tipo')],
        ['allowClear' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
