<?php

namespace frontend\helpers;

use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;

class FormHelper
{
    /**
     * Genera un input con icono y opcionalmente Select2 o tipo password
     *
     * @param ActiveForm $form
     * @param object $model
     * @param string $attribute
     * @param string $iconClass
     * @param array $options
     * @return string
     */
    public static function inputWithIcon($form, $model, $attribute, $iconClass, $options = [])
    {
        $fieldOptions = [
            'options' => ['class' => 'form-field mb-3'],
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
            'labelOptions' => ['class' => 'form-label fw-semibold'],
            'inputOptions' => ['class' => 'form-control ps-5'],
            'template' => '{label}
                <div class="icon-input-wrapper position-relative">
                    <i class="' . $iconClass . ' input-icon"></i>
                    {input}
                </div>
                {error}',
        ];

        // Select2
        if (!empty($options['select2'])) {
            return $form->field($model, $attribute, $fieldOptions)
                ->widget(Select2::class, [
                    'data' => $options['select2']['data'],
                    'options' => [
                        'placeholder' => $options['select2']['placeholder'] ?? 'Selecciona...',
                        'class' => 'form-control ps-5',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '100%',
                    ],
                ]);
        }

        // Password
        if (!empty($options['password'])) {
            return $form->field($model, $attribute, $fieldOptions)->passwordInput();
        }

        // Input tipo fecha
        if (!empty($options['type']) && $options['type'] === 'date') {
            return $form->field($model, $attribute, $fieldOptions)->input('date');
        }

        // Input normal
        return $form->field($model, $attribute, $fieldOptions)->textInput();
    }
}
