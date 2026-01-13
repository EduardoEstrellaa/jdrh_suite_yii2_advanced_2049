<?php

use backend\models\Semestres;
use backend\models\UnidadesEstudio;
use common\models\PlanLicenciaturas;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\PlanSemestresSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-semestres-search">

    <?php
    $planOptions = PlanLicenciaturas::getPlanesLicenciaturasMap();
    $semestreOptions = ArrayHelper::map(Semestres::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre');
    $unidadOptions = ArrayHelper::map(UnidadesEstudio::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre');
    ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'plan_licenciatura_id')->dropDownList($planOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'semestres_id')->dropDownList($semestreOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'unidades_estudio_id')->dropDownList($unidadOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
