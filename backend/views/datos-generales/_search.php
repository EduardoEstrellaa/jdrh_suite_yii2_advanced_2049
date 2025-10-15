<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\DatosGeneralesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="datos-generales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'perfil_id') ?>

    <?= $form->field($model, 'tlf_personal') ?>

    <?= $form->field($model, 'tlf_emergencia') ?>

    <?= $form->field($model, 'email_personal') ?>

    <?php // echo $form->field($model, 'maya_hablante') ?>

    <?php // echo $form->field($model, 'estados_civiles_id') ?>

    <?php // echo $form->field($model, 'nacionalidades_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
