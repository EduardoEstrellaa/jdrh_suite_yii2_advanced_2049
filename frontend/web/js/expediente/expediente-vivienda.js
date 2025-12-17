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

    function toggleVivesConPadres() {
        const value = $('#alumvivienda-vives_casa_padres').val();
        const $container = $('#vivienda-otro-vives-container');
        if (value === '0') {
            $container.removeClass('d-none');
            return;
        }
        $container.addClass('d-none');
        $('#alumvivienda-otro_especificar').val('');
    }

    function toggleTipoVivienda() {
        const $container = $('#vivienda-otro-tipo-container');
        if (!otroTipoId) {
            $container.addClass('d-none');
            $('#alumvivienda-otro_tipo_especificar').val('');
            return;
        }

        const selected = $('#alumvivienda-tipos_viviendas_id').val();
        if (selected === otroTipoId) {
            $container.removeClass('d-none');
            return;
        }

        $container.addClass('d-none');
        $('#alumvivienda-otro_tipo_especificar').val('');
    }

    function toggleBienesOtro() {
        const $container = $('#vivienda-bienes-otro-container');
        const $input = $('#vivienda-bienes-otro');
        if (!otroBienId) {
            $container.addClass('d-none');
            $input.val('').prop('required', false);
            return;
        }

        const hasOtro = $('.vivienda-bien-checkbox:checked').filter(function () {
            return $(this).val() === String(otroBienId);
        }).length > 0;

        $container.toggleClass('d-none', !hasOtro);
        $input.prop('required', hasOtro);
        if (!hasOtro) {
            $input.val('').removeClass('is-invalid');
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
            $input.removeClass('is-invalid');
            return true;
        }

        const value = ($input.val() || '').trim();
        if (value === '') {
            if ($input[0]) {
                $input[0].setCustomValidity('Por favor especifica el bien.');
                $input[0].reportValidity();
            }
            $input.addClass('is-invalid');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            return false;
        }

        if ($input[0]) {
            $input[0].setCustomValidity('');
        }
        $input.removeClass('is-invalid');
        return true;
    }

    function toggleServiciosOtro() {
        const $container = $('#vivienda-servicios-otro-container');
        const $input = $('#vivienda-servicios-otro');
        if (!otroServicioId) {
            $container.addClass('d-none');
            $input.val('').prop('required', false);
            return;
        }

        const hasOtro = $('.vivienda-servicio-checkbox:checked').filter(function () {
            return $(this).val() === String(otroServicioId);
        }).length > 0;

        $container.toggleClass('d-none', !hasOtro);
        $input.prop('required', hasOtro);
        if (!hasOtro) {
            $input.val('').removeClass('is-invalid');
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
            $input.removeClass('is-invalid');
            return true;
        }

        const value = ($input.val() || '').trim();
        if (value === '') {
            if ($input[0]) {
                $input[0].setCustomValidity('Por favor especifica el servicio.');
                $input[0].reportValidity();
            }
            $input.addClass('is-invalid');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            return false;
        }

        if ($input[0]) {
            $input[0].setCustomValidity('');
        }
        $input.removeClass('is-invalid');
        return true;
    }

    function init() {
        $('#alumvivienda-vives_casa_padres').on('change', toggleVivesConPadres);
        $('#alumvivienda-tipos_viviendas_id').on('change', toggleTipoVivienda);
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
                if (!validateBienesOtro(e) || !validateServiciosOtro(e)) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                return true;
            });
            $form.on('beforeSubmit', function (e) {
                if (!validateBienesOtro(e) || !validateServiciosOtro(e)) {
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
