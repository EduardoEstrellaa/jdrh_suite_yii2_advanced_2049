<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use backend\models\PlanLicenciaturas;
use backend\models\Generaciones;
use frontend\models\Perfil;
use kartik\select2\Select2;
use frontend\assets\SignupAsset;
use yii\helpers\Url;


SignupAsset::register($this);

// Generar la URL correcta según la configuración de Yii
$validateUrl = Url::to(['site/validate-signup']);

// Registrar la URL como variable JS
$this->registerJs("const validateUrl = '$validateUrl';", \yii\web\View::POS_HEAD);

$this->title = 'Registro de Estudiantes';

// ✅ Función inputWithIcon corregida manteniendo el addon en Select2
function inputWithIcon($form, $model, $attribute, $iconClass, $options = [])
{
    // Para campos Select2 - MANTENIENDO EL ADDON
    if (isset($options['select2']) && $options['select2']) {
        return $form->field($model, $attribute)->widget(Select2::classname(), [
            'data' => $options['select2']['data'],
            'options' => [
                'placeholder' => $options['select2']['placeholder'] ?? 'Selecciona...',
                'class' => 'form-control'
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'addon' => [
                'prepend' => [
                    'content' => '<i class="' . $iconClass . '"></i>'
                ]
            ]
        ])->label($model->getAttributeLabel($attribute));
    }

    // Para inputs normales
    $fieldOptions = [
        'template' => '
            <div class="form-field">
                {label}
                <div class="input-group">
                    <span class="input-group-text"><i class="' . $iconClass . '"></i></span>
                    {input}
                </div>
                <div class="invalid-feedback" id="signupform-' . $attribute . '-error"></div>
                {hint}
            </div>
        '
    ];

    $input = $form->field($model, $attribute, $fieldOptions);

    if (isset($options['passwordInput']) && $options['passwordInput']) {
        return $input->passwordInput(['class' => 'form-control']);
    } elseif (isset($options['textInput']) && $options['textInput']['type'] === 'date') {
        return $input->input('date', ['class' => 'form-control']);
    } else {
        return $input->textInput(['class' => 'form-control']);
    }
}

// Obtener listas
$generoLista = Perfil::getGeneroLista();
$planLista = PlanLicenciaturas::getPlanesLicenciaturasMap();
$generacionesLista = Generaciones::getGeneracionesMap();

?>

<div class="site-signup">
    <div class="container">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <p class="text-center mb-5">Por favor completa los siguientes campos para registrarte:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'enableClientValidation' => true,
            'enableAjaxValidation' => true,
            'validationUrl' => ['site/validate-signup'],
            'validateOnSubmit' => true,
            'fieldConfig' => [
                'errorOptions' => [
                    'class' => 'invalid-feedback'
                ]
            ]
        ]); ?>

        <div class="row equal-height-cards">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-user-circle"></i> Datos de Usuario</h5>
                    </div>
                    <div class="card-body">
                        <?= inputWithIcon($form, $model, 'username', 'fas fa-user', ['autofocus' => true]) ?>
                        <?= inputWithIcon($form, $model, 'email', 'fas fa-envelope') ?>
                        <?= inputWithIcon($form, $model, 'password', 'fas fa-lock', ['passwordInput' => true]) ?>
                        <?= inputWithIcon($form, $model, 'password_repeat', 'fas fa-lock', ['passwordInput' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-id-card-alt"></i> Datos Personales</h5>
                    </div>
                    <div class="card-body">
                        <?= inputWithIcon($form, $model, 'nombre', 'fas fa-address-card') ?>
                        <?= inputWithIcon($form, $model, 'apellido', 'fas fa-address-card') ?>
                        <?= inputWithIcon($form, $model, 'fecha_nacimiento', 'fas fa-calendar-alt', ['textInput' => ['type' => 'date']]) ?>
                        <?= inputWithIcon($form, $model, 'genero_id', 'fas fa-venus-mars', [
                            'select2' => [
                                'data' => $generoLista,
                                'placeholder' => 'Selecciona tu género'
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-graduation-cap"></i> Datos Académicos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <?= inputWithIcon($form, $model, 'matricula', 'fas fa-id-badge') ?>
                            </div>
                            <div class="col-md-4">
                                <?= inputWithIcon($form, $model, 'plan_licenciaturas_id', 'fas fa-book-open', [
                                    'select2' => [
                                        'data' => $planLista,
                                        'placeholder' => 'Selecciona un plan'
                                    ]
                                ]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= inputWithIcon($form, $model, 'generaciones_id', 'fas fa-users', [
                                    'select2' => [
                                        'data' => $generacionesLista,
                                        'placeholder' => 'Selecciona una generación'
                                    ]
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3 text-center">
            <?= Html::submitButton('<i class="fas fa-user-plus"></i> Registrarse', ['class' => 'btn btn-success btn-lg w-75']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>