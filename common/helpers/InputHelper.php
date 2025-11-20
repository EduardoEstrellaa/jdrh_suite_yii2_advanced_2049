<?php

namespace common\helpers;

use kartik\select2\Select2;
use yii\helpers\Html;

class InputHelper
{
    /**
     * Crea un campo de texto con ícono usando addon de Bootstrap
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
     * Crea un campo Select2 con ícono usando addon de Bootstrap - VERSIÓN RESPONSIVE MEJORADA
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

        // CSS personalizado para mantener icono y select2 juntos en TODOS los dispositivos
        $css = "
        /* Forzar que el input-group mantenga su estructura en todos los breakpoints */
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
        
        /* SOBRESCRIBIR los estilos responsive de Bootstrap que rompen el layout */
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
            
            /* Para tablets y móviles, hacer el input-group más compacto pero manteniendo juntos */
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
            
            /* Para móviles muy pequeños, reducir aún más pero mantener juntos */
            .select2-in-input-group .input-group-text {
                padding: 0.375rem 0.375rem;
                font-size: 0.875rem;
            }
            
            .select2-in-input-group .select2-selection__rendered {
                font-size: 0.875rem;
                padding-left: 0.5rem !important;
            }
        }
        
        /* Para pantallas extremadamente pequeñas (menos de 400px) */
        @media (max-width: 399.98px) {
            .select2-in-input-group {
                flex-wrap: wrap !important; /* Solo aquí permitimos que se separen */
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
        ";

        // Registrar el CSS
        \Yii::$app->view->registerCss($css);

        return $form->field($model, $attribute, [
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
        ])->widget(Select2::class, [
            'data' => $data,
            'options' => $finalOptions,
            'pluginOptions' => $finalPluginOptions,
        ]);
    }
}
