<?php

use common\helpers\InputHelper;
use common\models\CiclosEscolares;
use common\models\Semestres;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CiclosSemestres $model */
/** @var yii\widgets\ActiveForm $form */

$cicloOptions = ArrayHelper::map(
    CiclosEscolares::find()->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    static function ($item) {
        $partes = array_filter([
            $item->nombre,
            $item->periodo_texto,
        ]);

        return $partes ? implode(' | ', $partes) : Yii::t('app', 'Ciclo #{id}', ['id' => $item->id]);
    }
);

$semestreOptions = ArrayHelper::map(
    Semestres::find()->with('tipoSemestres')->orderBy(['nombre' => SORT_ASC])->all(),
    'id',
    static function (Semestres $item): string {
        $partes = array_filter([
            $item->nombre,
            $item->tipoSemestres->nombre ?? null,
        ]);

        return $partes ? implode(' | ', $partes) : Yii::t('app', 'Semestre #{id}', ['id' => $item->id]);
    }
);
?>

<div class="ciclos-semestres-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'ciclos_escolares_id',
        'fa-calendar',
        $cicloOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un ciclo escolar')],
        ['allowClear' => true]
    ) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'semestres_id',
        'fa-graduation-cap',
        $semestreOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un semestre')],
        ['allowClear' => true]
    ) ?>

    <?= $form->field($model, 'fecha_inicio_semestre')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'fecha_fin_semestre')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'periodo_texto_semestre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
