<?php

use common\models\Semestres;
use common\models\UnidadesEstudio;
use common\helpers\InputHelper;
use common\models\PlanLicenciaturas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PlanSemestres $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-semestres-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $planOptions = PlanLicenciaturas::getPlanesLicenciaturasMap();
    $semestreOptions = ArrayHelper::map(Semestres::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre');
    $unidadOptions = ArrayHelper::map(UnidadesEstudio::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre');
    ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'plan_licenciatura_id',
        'fa-book',
        $planOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un plan de licenciatura')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'semestres_id',
        'fa-calendar',
        $semestreOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un semestre')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'unidades_estudio_id',
        'fa-layer-group',
        $unidadOptions,
        ['placeholder' => Yii::t('app', 'Selecciona una unidad de estudio')],
        ['allowClear' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>