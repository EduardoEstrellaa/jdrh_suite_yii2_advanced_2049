<?php

use common\helpers\InputHelper;
use common\models\AsignacionesTutores;
use common\models\CiclosSemestres;
use common\models\Grupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AsignacionesGrupos $model */
/** @var yii\widgets\ActiveForm $form */

$cicloOptions = ArrayHelper::map(
    CiclosSemestres::find()
        ->with(['ciclosEscolares', 'semestres.tipoSemestres'])
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
        $parts = array_filter([
            $item->nombre,
            $item->descripcion,
        ]);

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
?>

<div class="asignaciones-grupos-form">

    <?php $form = ActiveForm::begin(); ?>

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
        'grupos_id',
        'fa-users',
        $groupOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un grupo')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'asignaciones_tutores_id',
        'fa-chalkboard-teacher',
        $tutorOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un tutor')],
        ['allowClear' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
