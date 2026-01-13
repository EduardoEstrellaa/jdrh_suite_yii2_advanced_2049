<?php

use common\helpers\InputHelper;
use common\models\Licenciaturas;
use common\models\PlanEstudios;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PlanLicenciaturas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="plan-licenciaturas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $planOptions = ArrayHelper::map(
        PlanEstudios::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        'nombre'
    );
    $licOptions = ArrayHelper::map(
        Licenciaturas::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        'nombre'
    );
    ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'plan_estudios_id',
        'fa-book',
        $planOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un plan de estudios')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'licenciaturas_id',
        'fa-graduation-cap',
        $licOptions,
        ['placeholder' => Yii::t('app', 'Selecciona una licenciatura')],
        ['allowClear' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
