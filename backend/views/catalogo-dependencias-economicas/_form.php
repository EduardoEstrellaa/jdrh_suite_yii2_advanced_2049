<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\InputHelper;
use common\models\CategoriasDependencias;

/** @var yii\web\View $this */
/** @var common\models\CatalogoDependenciasEconomicas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php $categoriasDependenciasList = CategoriasDependencias::dropdownOptions(); ?>

<div class="catalogo-dependencias-economicas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= InputHelper::iconSelect2Field(
        $form,
        $model,
        'categorias_dependencias_id',
        'fa-layer-group',
        $categoriasDependenciasList,
        [
            'placeholder' => 'Selecciona una categoria',
        ],
        ['allowClear' => true]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
