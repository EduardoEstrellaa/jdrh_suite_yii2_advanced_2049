/**
 * Archivo JS para la sección de becas del expediente.
 * Controla la visibilidad de campos condicionales en el formulario y valida "Otro".
 */
(function ($) {
    'use strict';

    /**
     * Mostrar u ocultar el contenedor de tipo de beca
     */
    function toggleBecaFields() {
        const tieneBeca = $('#alumbecas-tiene_beca').val();
        if (tieneBeca === '1') {
            $('#tipo-beca-container').show();
        } else {
            $('#tipo-beca-container').hide();
            $('#otro-especificar-container').hide();
            // Limpia selección y texto para evitar valores residuales en UI
            $('#alumbecas-tipos_becas_id').val(null).trigger('change');
            $('#alumbecas-otro_especificar').val('');
        }
    }

    /**
     * Mostrar u ocultar el campo "Especificar otro tipo de beca"
     */
    function toggleOtroEspecificar() {
        const tipoBeca = $('#alumbecas-tipos_becas_id').val();
        // Asume que '1' corresponde a "Otro"
        const $otroContainer = $('#otro-especificar-container');
        const $otroInput = $('#alumbecas-otro_especificar');

        if (tipoBeca === '1') {
            $otroContainer.show();
            $otroInput.prop('required', true);
            return;
        }

        $otroContainer.hide();
        $otroInput.prop('required', false).val('').removeClass('is-invalid');
        if ($otroInput[0]) {
            $otroInput[0].setCustomValidity('');
        }
    }

    /**
     * Valida que el campo "otro" no esté vacío cuando aplica.
     */
    function validateBecaOtro(event) {
        const tipoBeca = $('#alumbecas-tipos_becas_id').val();
        const $otroInput = $('#alumbecas-otro_especificar');

        if (tipoBeca !== '1') {
            if ($otroInput[0]) {
                $otroInput[0].setCustomValidity('');
            }
            $otroInput.removeClass('is-invalid');
            return true;
        }

        const value = ($otroInput.val() || '').trim();
        if (value === '') {
            if ($otroInput[0]) {
                $otroInput[0].setCustomValidity('Por favor especifica el tipo de beca.');
                $otroInput[0].reportValidity();
            }
            $otroInput.addClass('is-invalid');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            return false;
        }

        if ($otroInput[0]) {
            $otroInput[0].setCustomValidity('');
        }
        $otroInput.removeClass('is-invalid');
        return true;
    }

    /**
     * Inicializa los eventos del formulario de becas
     */
    function initBecaForm() {
        $('#alumbecas-tiene_beca').on('change', toggleBecaFields);
        $('#alumbecas-tipos_becas_id').on('change', function () {
            toggleOtroEspecificar();
            validateBecaOtro();
        });
        $('#alumbecas-otro_especificar').on('input', function () {
            validateBecaOtro();
        });

        const $form = $('.expediente-form form');
        if ($form.length) {
            $form.on('submit', function (e) {
                if (!validateBecaOtro(e)) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                return true;
            });
            $form.on('beforeSubmit', function (e) {
                if (!validateBecaOtro(e)) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        }

        // Ejecutar al cargar la página
        toggleBecaFields();
        toggleOtroEspecificar();
    }

    // Inicialización cuando el DOM está listo
    $(document).ready(initBecaForm);

})(jQuery);
