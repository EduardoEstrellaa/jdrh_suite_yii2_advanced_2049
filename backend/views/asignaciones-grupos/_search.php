<?php

use common\models\AsignacionesTutores;
use common\models\CiclosSemestres;
use common\models\Grupos;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\search\AsignacionesGruposSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="asignaciones-grupos-search">

    <?php
    $cicloOptions = ArrayHelper::map(
        CiclosSemestres::find()
            ->with(['ciclosEscolares', 'semestres'])
            ->orderBy(['id' => SORT_DESC])
            ->all(),
        'id',
        static function (CiclosSemestres $item): string {
            $parts = array_filter([
                $item->cicloEtiqueta ?? null,
                $item->semestreEtiqueta ?? null,
            ]);

            return $parts ? implode(' · ', $parts) : Yii::t('app', 'Ciclo #{id}', ['id' => $item->id]);
        }
    );

    $groupOptions = ArrayHelper::map(
        Grupos::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        static function (Grupos $item): string {
            return $item->nombre ?: Yii::t('app', 'Grupo #{id}', ['id' => $item->id]);
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

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ciclos_semestres_id')->dropDownList($cicloOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'grupos_id')->dropDownList($groupOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <?= $form->field($model, 'asignaciones_tutores_id')->dropDownList($tutorOptions, ['prompt' => Yii::t('app', 'Todos')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
