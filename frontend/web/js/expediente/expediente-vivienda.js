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
        if (!otroBienId) {
            $container.addClass('d-none');
            $('#vivienda-bienes-otro').val('');
            return;
        }

        const hasOtro = $('.vivienda-bien-checkbox:checked').filter(function () {
            return $(this).val() === String(otroBienId);
        }).length > 0;

        if (hasOtro) {
            $container.removeClass('d-none');
            return;
        }

        $container.addClass('d-none');
        $('#vivienda-bienes-otro').val('');
    }

    function init() {
        $('#alumvivienda-vives_casa_padres').on('change', toggleVivesConPadres);
        $('#alumvivienda-tipos_viviendas_id').on('change', toggleTipoVivienda);
        $('.vivienda-bien-checkbox').on('change', toggleBienesOtro);

        toggleVivesConPadres();
        toggleTipoVivienda();
        toggleBienesOtro();
    }

    $(document).ready(init);
})(jQuery);
