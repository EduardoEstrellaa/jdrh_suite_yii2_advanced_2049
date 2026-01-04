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
        const $tipoBeca = $('#alumbecas-tipos_becas_id');
        if (tieneBeca === '1') {
            $('#tipo-beca-container').show();
            $tipoBeca.prop('required', true);
        } else {
            $('#tipo-beca-container').hide();
            $('#otro-especificar-container').hide();
            // Limpia selección y texto para evitar valores residuales en UI
            $tipoBeca.prop('required', false).val(null).trigger('change').removeClass('is-invalid');
            $('#alumbecas-otro_especificar').val('');
        }
    }

    /**
     * Mostrar u ocultar el campo "Especificar otro tipo de beca"
     */
    function toggleOtroEspecificar() {
        const tipoBeca = $('#alumbecas-tipos_becas_id').val();
        const otroId = (typeof window.TIPO_BECA_OTRO_ID !== 'undefined' && window.TIPO_BECA_OTRO_ID !== null)
            ? String(window.TIPO_BECA_OTRO_ID)
            : null;
        const $otroContainer = $('#otro-especificar-container');
        const $otroInput = $('#alumbecas-otro_especificar');

        if (otroId && tipoBeca === otroId) {
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
        const otroId = (typeof window.TIPO_BECA_OTRO_ID !== 'undefined' && window.TIPO_BECA_OTRO_ID !== null)
            ? String(window.TIPO_BECA_OTRO_ID)
            : null;
        const $otroInput = $('#alumbecas-otro_especificar');

        if (!otroId || tipoBeca !== otroId) {
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
     * Valida que el tipo de beca sea obligatorio cuando tiene_beca = 1
     */
    function validateTipoBeca(event) {
        const tieneBeca = $('#alumbecas-tiene_beca').val();
        const $tipoBeca = $('#alumbecas-tipos_becas_id');

        if (tieneBeca !== '1') {
            if ($tipoBeca[0]) $tipoBeca[0].setCustomValidity('');
            $tipoBeca.removeClass('is-invalid');
            return true;
        }

        const val = ($tipoBeca.val() || '').trim();
        if (val === '') {
            if ($tipoBeca[0]) {
                $tipoBeca[0].setCustomValidity('Selecciona el tipo de beca.');
                $tipoBeca[0].reportValidity();
            }
            $tipoBeca.addClass('is-invalid');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            return false;
        }

        if ($tipoBeca[0]) $tipoBeca[0].setCustomValidity('');
        $tipoBeca.removeClass('is-invalid');
        return true;
    }

    /**
     * Inicializa los eventos del formulario de becas
     */
    function initBecaForm() {
        $('#alumbecas-tiene_beca').on('change', toggleBecaFields);
        $('#alumbecas-tipos_becas_id').on('change', function () {
            validateTipoBeca();
            toggleOtroEspecificar();
            validateBecaOtro();
        });
        $('#alumbecas-otro_especificar').on('input', function () {
            validateBecaOtro();
        });

        const $form = $('.expediente-form form');
        if ($form.length) {
            $form.on('submit', function (e) {
                if (!validateTipoBeca(e)) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                if (!validateBecaOtro(e)) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                return true;
            });
            $form.on('beforeSubmit', function (e) {
                if (!validateTipoBeca(e) || !validateBecaOtro(e)) {
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
