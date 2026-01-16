<?php

namespace common\helpers;

use kartik\select2\Select2;
use yii\helpers\Html;

class InputHelper
{
    /**
     * Crea un campo de texto con icono usando addon de Bootstrap.
     */
    public static function iconTextField($form, $model, $attribute, $icon, $options = [])
    {
        $defaults = [
            'options' => ['class' => 'form-field mb-3'],
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
            'labelOptions' => ['class' => 'form-label fw-semibold'],
            'inputOptions' => ['class' => 'form-control'],
            'template' => '{label}
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas ' . $icon . '"></i>
                    </span>
                    {input}
                </div>
                {error}',
        ];

        $config = array_merge_recursive($defaults, $options);

        return $form->field($model, $attribute, $config);
    }

    /**
     * Crea un campo Select2 con icono usando addon de Bootstrap con soporte responsive.
     */
    public static function iconSelect2Field($form, $model, $attribute, $icon, $data = [], $options = [], $pluginOptions = [])
    {
        $defaultOptions = [
            'placeholder' => 'Selecciona una opción...',
            'class' => 'form-control',
        ];

        $defaultPluginOptions = [
            'allowClear' => true,
        ];

        $finalOptions = array_merge($defaultOptions, $options);
        $finalPluginOptions = array_merge($defaultPluginOptions, $pluginOptions);

        $fieldConfig = [
            'options' => ['class' => 'form-field mb-3'],
            'errorOptions' => ['class' => 'invalid-feedback d-block'],
            'labelOptions' => ['class' => 'form-label fw-semibold'],
            'template' => '{label}
                <div class="input-group select2-in-input-group">
                    <span class="input-group-text">
                        <i class="fas ' . $icon . '"></i>
                    </span>
                    {input}
                </div>
                {error}',
        ];

        if (isset($finalOptions['fieldOptions'])) {
            $fieldConfig = array_merge($fieldConfig, (array)$finalOptions['fieldOptions']);
            unset($finalOptions['fieldOptions']);
        }

        self::registerSelect2Css();

        return $form->field($model, $attribute, $fieldConfig)->widget(Select2::class, [
            'data' => $data,
            'options' => $finalOptions,
            'pluginOptions' => $finalPluginOptions,
        ]);
    }

    /**
     * Crea un Select2 para filtros (`GridView::filter`) sin icono.
     */
    public static function select2Filter($model, string $attribute, array $data = [], array $options = [], array $pluginOptions = []): string
    {
        self::registerSelect2Css();

        $defaultOptions = [
            'placeholder' => 'Selecciona una opción...',
            'class' => 'form-select form-select-sm',
        ];
        $defaultPluginOptions = [
            'allowClear' => true,
        ];

        $widget = Select2::widget([
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data,
            'options' => array_merge($defaultOptions, $options),
            'pluginOptions' => array_merge($defaultPluginOptions, $pluginOptions),
        ]);

        return Html::tag('div', $widget, ['class' => 'input-group select2-in-input-group']);
    }

    /**
     * Campo de texto con icono para inputs dinámicos (arrays), sin ActiveForm.
     */
    public static function iconFieldArray($name, $value, $icon, $placeholder = '', $options = [])
    {
        $inputOptions = $options['inputOptions'] ?? [];
        $inputOptions = array_merge([
            'class' => 'form-control',
            'placeholder' => $placeholder,
            'name' => $name,
        ], $inputOptions);

        $iconTag = Html::tag('i', '', ['class' => 'fas ' . $icon]);
        $inputGroup = Html::tag('span', $iconTag, ['class' => 'input-group-text']) .
            Html::textInput($name, $value, $inputOptions);

        return Html::tag(
            'div',
            Html::tag('label', Html::encode($placeholder), ['class' => 'form-label fw-semibold']) .
            Html::tag('div', $inputGroup, ['class' => 'input-group']),
            ['class' => 'form-field mb-3']
        );
    }

    private static function registerSelect2Css(): void
    {
        static $registered = false;
        if ($registered) {
            return;
        }

        \Yii::$app->view->registerCss(self::SELECT2_INPUT_GROUP_CSS);
        $registered = true;
    }

    private const SELECT2_INPUT_GROUP_CSS = <<<CSS
        .select2-in-input-group {
            display: flex !important;
            flex-wrap: nowrap !important;
            width: 100% !important;
        }

        .select2-in-input-group .input-group-text {
            flex-shrink: 0;
            width: auto !important;
        }

        .select2-in-input-group .select2-container {
            flex: 1 !important;
            width: auto !important;
            min-width: 100px !important;
        }

        .select2-in-input-group .select2-selection {
            height: 100% !important;
        }

        .select2-in-input-group .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0.75rem !important;
        }

        @media (max-width: 1199.98px) {
            .select2-in-input-group {
                flex-wrap: nowrap !important;
            }
        }

        @media (max-width: 991.98px) {
            .select2-in-input-group {
                flex-wrap: nowrap !important;
            }
        }

        @media (max-width: 767.98px) {
            .select2-in-input-group {
                flex-wrap: nowrap !important;
            }

            .select2-in-input-group .input-group-text {
                padding: 0.375rem 0.5rem;
            }

            .select2-in-input-group .select2-container {
                min-width: 80px !important;
            }
        }

        @media (max-width: 575.98px) {
            .select2-in-input-group {
                flex-wrap: nowrap !important;
            }

            .select2-in-input-group .input-group-text {
                padding: 0.375rem 0.375rem;
                font-size: 0.875rem;
            }

            .select2-in-input-group .select2-selection__rendered {
                font-size: 0.875rem;
                padding-left: 0.5rem !important;
            }
        }

        @media (max-width: 399.98px) {
            .select2-in-input-group {
                flex-wrap: wrap !important;
            }

            .select2-in-input-group .input-group-text {
                width: 100%;
                justify-content: center;
                border-radius: 0.375rem 0.375rem 0 0 !important;
            }

            .select2-in-input-group .select2-container {
                width: 100% !important;
                border-radius: 0 0 0.375rem 0.375rem !important;
            }
        }
    CSS;
}
