(function ($) {
    'use strict';

    const selectors = {
        toggle: '#alumtrabajo-tiene_trabajo',
        section: '#trabajo-section',
        inputs: [
            '#alumtrabajo-nombre_empresa',
            '#alumtrabajo-puesto_ocupacion',
            '#alumtrabajo-horario_entrada',
            '#alumtrabajo-horario_salida',
        ],
    };

    function toggleTrabajo() {
        const $toggle = $(selectors.toggle);
        if (!$toggle.length) return;

        const show = parseInt($toggle.val(), 10) === 1;
        const $section = $(selectors.section);
        $section.toggleClass('d-none', !show);

        const $inputs = $(selectors.inputs.join(','));
        $inputs.prop('required', show);

        if (!show) {
            $inputs.val('');
        }
    }

    $(document).ready(function () {
        const $toggle = $(selectors.toggle);
        if (!$toggle.length) return;

        $toggle.on('change', toggleTrabajo);
        toggleTrabajo();
    });
})(jQuery);
