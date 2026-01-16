<?php

use common\models\CiclosEscolares;
use common\models\Semestres;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\CiclosSemestresSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ciclos-semestres-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php
    $cicloOptions = ArrayHelper::map(
        CiclosEscolares::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        static function ($item) {
            return $item->nombre;
        }
    );
    $semestreOptions = ArrayHelper::map(
        Semestres::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        static function ($item) {
            return $item->nombre;
        }
    );
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ciclos_escolares_id')->dropDownList($cicloOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'semestres_id')->dropDownList($semestreOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'fecha_inicio_semestre') ?>

    <?= $form->field($model, 'fecha_fin_semestre') ?>

    <?php // echo $form->field($model, 'periodo_texto_semestre') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
