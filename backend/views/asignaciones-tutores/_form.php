<?php

use common\helpers\InputHelper;
use common\models\Perfil;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AsignacionesTutores $model */
/** @var yii\widgets\ActiveForm $form */

$perfilOptions = ArrayHelper::map(
    Perfil::find()->orderBy(['nombre' => SORT_ASC, 'apellido' => SORT_ASC])->all(),
    'id',
    function (Perfil $item) {
        return trim($item->nombre . ' ' . $item->apellido) ?: Yii::t('app', 'Perfil #{id}', ['id' => $item->id]);
    }
);
?>

<div class="asignaciones-tutores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'perfil_id',
        'fa-user-tie',
        $perfilOptions,
        ['placeholder' => Yii::t('app', 'Selecciona un tutor')],
        ['allowClear' => true, 'placeholder' => Yii::t('app', 'Selecciona un tutor')]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
