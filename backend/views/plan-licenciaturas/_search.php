<?php

use common\models\Licenciaturas;
use common\models\PlanEstudios;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\PlanLicenciaturasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-licenciaturas-search">

    <?php
    $planOptions = ArrayHelper::map(
        PlanEstudios::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        'nombre'
    );

    $licenciaturaOptions = ArrayHelper::map(
        Licenciaturas::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        'nombre'
    );
    ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'plan_estudios_id')->dropDownList($planOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'licenciaturas_id')->dropDownList($licenciaturaOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
