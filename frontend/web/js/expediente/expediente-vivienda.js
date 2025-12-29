/**
 * Lógica de formulario para la sección de vivienda.
 */
(function ($) {
    'use strict';

    const otroTipoId = typeof window.TIPO_VIVIENDA_OTRO_ID !== 'undefined'
        ? String(window.TIPO_VIVIENDA_OTRO_ID)
        : null;
    const otroBienId = typeof window.VIVIENDA_BIEN_OTRO_ID !== 'undefined'
        ? String(window.VIVIENDA_BIEN_OTRO_ID)
        : null;
    const otroServicioId = typeof window.VIVIENDA_SERVICIO_OTRO_ID !== 'undefined'
        ? String(window.VIVIENDA_SERVICIO_OTRO_ID)
        : null;

    function markInputState($input, state) {
        // state: 'valid' | 'invalid' | 'none'
        $input
            .toggleClass('is-invalid', state === 'invalid')
            .toggleClass('is-valid', state === 'valid');
    }

    function toggleVivesConPadres() {
        const value = $('#alumvivienda-vives_casa_padres').val();
        const $container = $('#vivienda-otro-vives-container');
        const $input = $('#alumvivienda-otro_especificar');
        if (value === '0') {
            $container.removeClass('d-none');
            $input.prop('required', true);
            return;
        }
        $container.addClass('d-none');
        $input.val('').prop('required', false);
        markInputState($input, 'none');
    }

    function toggleTipoVivienda() {
        const $container = $('#vivienda-otro-tipo-container');
        const $input = $('#alumvivienda-otro_tipo_especificar');
        if (!otroTipoId) {
            $container.addClass('d-none');
            $input.val('');
            markInputState($input, 'none');
            return;
        }

        const selected = $('#alumvivienda-tipos_viviendas_id').val();
        if (selected === otroTipoId) {
            $container.removeClass('d-none');
            $input.prop('required', true);
            return;
        }

        $container.addClass('d-none');
        $input.val('');
        markInputState($input, 'none');
    }

    function validateOtroVives(event) {
        const $input = $('#alumvivienda-otro_especificar');
        const required = $('#alumvivienda-vives_casa_padres').val() === '0';
        if (!required) {
            $input.prop('required', false);
            markInputState($input, 'none');
            $input.get(0)?.setCustomValidity('');
            return true;
        }

        const value = ($input.val() || '').trim();
        $input.prop('required', true);
        if (value.length === 0) {
            markInputState($input, 'invalid');
            $input.val(value);
            $input.get(0)?.setCustomValidity('Por favor especifica con quién vives.');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                $input.get(0)?.reportValidity();
            }
            return false;
        }

        $input.val(value);
        $input.get(0)?.setCustomValidity('');
        markInputState($input, 'valid');
        return true;
    }

    function validateOtroTipo(event) {
        const $input = $('#alumvivienda-otro_tipo_especificar');
        const required = otroTipoId && $('#alumvivienda-tipos_viviendas_id').val() === otroTipoId;
        if (!required) {
            $input.prop('required', false);
            markInputState($input, 'none');
            $input.get(0)?.setCustomValidity('');
            return true;
        }

        const value = ($input.val() || '').trim();
        $input.prop('required', true);
        if (value.length === 0) {
            markInputState($input, 'invalid');
            $input.val(value);
            $input.get(0)?.setCustomValidity('Por favor especifica el tipo de vivienda.');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                $input.get(0)?.reportValidity();
            }
            return false;
        }

        $input.val(value);
        $input.get(0)?.setCustomValidity('');
        markInputState($input, 'valid');
        return true;
    }

    function toggleBienesOtro() {
        const $container = $('#vivienda-bienes-otro-container');
        const $input = $('#vivienda-bienes-otro');
        if (!otroBienId) {
            $container.addClass('d-none');
            $input.val('').prop('required', false);
            markInputState($input, 'none');
            return;
        }

        const hasOtro = $('.vivienda-bien-checkbox:checked').filter(function () {
            return $(this).val() === String(otroBienId);
        }).length > 0;

        $container.toggleClass('d-none', !hasOtro);
        $input.prop('required', hasOtro);
        if (!hasOtro) {
            $input.val('');
            markInputState($input, 'none');
            if ($input[0]) {
                $input[0].setCustomValidity('');
            }
        }
    }

    function validateBienesOtro(event) {
        if (!otroBienId) {
            return true;
        }

        const $input = $('#vivienda-bienes-otro');
        const hasOtro = $('.vivienda-bien-checkbox:checked').filter(function () {
            return $(this).val() === String(otroBienId);
        }).length > 0;

        if (!hasOtro) {
            if ($input[0]) {
                $input[0].setCustomValidity('');
            }
            markInputState($input, 'none');
            return true;
        }

        const value = ($input.val() || '').trim();
        if (value === '') {
            if ($input[0]) {
                $input[0].setCustomValidity('Por favor especifica el bien.');
                $input[0].reportValidity();
            }
            markInputState($input, 'invalid');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            return false;
        }

        if ($input[0]) {
            $input[0].setCustomValidity('');
        }
        markInputState($input, 'valid');
        return true;
    }

    function toggleServiciosOtro() {
        const $container = $('#vivienda-servicios-otro-container');
        const $input = $('#vivienda-servicios-otro');
        if (!otroServicioId) {
            $container.addClass('d-none');
            $input.val('').prop('required', false);
            markInputState($input, 'none');
            return;
        }

        const hasOtro = $('.vivienda-servicio-checkbox:checked').filter(function () {
            return $(this).val() === String(otroServicioId);
        }).length > 0;

        $container.toggleClass('d-none', !hasOtro);
        $input.prop('required', hasOtro);
        if (!hasOtro) {
            $input.val('');
            markInputState($input, 'none');
            if ($input[0]) {
                $input[0].setCustomValidity('');
            }
        }
    }

    function validateServiciosOtro(event) {
        if (!otroServicioId) {
            return true;
        }

        const $input = $('#vivienda-servicios-otro');
        const hasOtro = $('.vivienda-servicio-checkbox:checked').filter(function () {
            return $(this).val() === String(otroServicioId);
        }).length > 0;

        if (!hasOtro) {
            if ($input[0]) {
                $input[0].setCustomValidity('');
            }
            markInputState($input, 'none');
            return true;
        }

        const value = ($input.val() || '').trim();
        if (value === '') {
            if ($input[0]) {
                $input[0].setCustomValidity('Por favor especifica el servicio.');
                $input[0].reportValidity();
            }
            markInputState($input, 'invalid');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            return false;
        }

        if ($input[0]) {
            $input[0].setCustomValidity('');
        }
        markInputState($input, 'valid');
        return true;
    }

    function init() {
        $('#alumvivienda-vives_casa_padres').on('change', function () {
            toggleVivesConPadres();
            validateOtroVives();
        });
        $('#alumvivienda-otro_especificar').on('input blur', function () {
            validateOtroVives();
        });
        $('#alumvivienda-tipos_viviendas_id').on('change', function () {
            toggleTipoVivienda();
            validateOtroTipo();
        });
        $('#alumvivienda-otro_tipo_especificar').on('input blur', function () {
            validateOtroTipo();
        });
        $('.vivienda-bien-checkbox').on('change', toggleBienesOtro);
        $('.vivienda-bien-checkbox').on('change', function () {
            validateBienesOtro();
        });
        $('#vivienda-bienes-otro').on('input', function () {
            validateBienesOtro();
        });
        $('.vivienda-servicio-checkbox').on('change', toggleServiciosOtro);
        $('.vivienda-servicio-checkbox').on('change', function () {
            validateServiciosOtro();
        });
        $('#vivienda-servicios-otro').on('input', function () {
            validateServiciosOtro();
        });

        const $form = $('.expediente-form form');
        if ($form.length) {
            $form.on('submit', function (e) {
                if (!validateOtroVives(e) || !validateOtroTipo(e) || !validateBienesOtro(e) || !validateServiciosOtro(e)) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                return true;
            });
            $form.on('beforeSubmit', function (e) {
                if (!validateOtroVives(e) || !validateOtroTipo(e) || !validateBienesOtro(e) || !validateServiciosOtro(e)) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });
        }

        toggleVivesConPadres();
        toggleTipoVivienda();
        toggleBienesOtro();
        toggleServiciosOtro();
    }

    $(document).ready(init);
})(jQuery);
