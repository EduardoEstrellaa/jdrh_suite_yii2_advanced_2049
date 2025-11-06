<?php

namespace frontend\helpers;

use kartik\select2\Select2;

class InputHelper
{
    /**
     * Crea un campo de texto con ícono y estilo uniforme
     */
    public static function iconTextField($form, $model, $attribute, $icon, $options = [])
    {
        $defaults = [
            'options' => ['class' => 'form-field mb-3'],
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
            'labelOptions' => ['class' => 'form-label fw-semibold'],
            'inputOptions' => ['class' => 'form-control ps-5'],
            'template' => '{label}
                <div class="icon-input-wrapper position-relative">
                    <i class="fas ' . $icon . ' input-icon"></i>
                    {input}
                </div>
                {error}',
        ];

        $config = array_merge_recursive($defaults, $options);

        return $form->field($model, $attribute, $config);
    }


    /**
     * Crea un campo Select2 con ícono y estilos uniformes
     */
    public static function iconSelect2Field($form, $model, $attribute, $icon, $data = [], $options = [], $pluginOptions = [])
    {
        $defaults = [
            'options' => [
                'placeholder' => 'Selecciona una opción...',
                'class' => 'form-control ps-5',
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ];

        $config = array_merge_recursive($defaults, [
            'options' => $options,
            'pluginOptions' => $pluginOptions,
        ]);

        return $form->field($model, $attribute, [
            'options' => ['class' => 'form-field mb-3'],
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
            'labelOptions' => ['class' => 'form-label fw-semibold'],
            'inputOptions' => ['class' => 'form-control ps-5'],
            'template' => '{label}
            <div class="icon-input-wrapper position-relative">
                <i class="fas ' . $icon . ' input-icon"></i>
                {input}
            </div>
            {error}',
        ])->widget(Select2::class, [
            'data' => $data,
            'options' => $config['options'],
            'pluginOptions' => $config['pluginOptions'],
        ]);
    }
}
