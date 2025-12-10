/**
 * Archivo JS para la sección de becas del expediente.
 * Controla la visibilidad de campos condicionales en el formulario.
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
        }
    }

    /**
     * Mostrar u ocultar el campo "Especificar otro tipo de beca"
     */
    function toggleOtroEspecificar() {
        const tipoBeca = $('#alumbecas-tipos_becas_id').val();
        // Asume que '1' corresponde a "Otro"
        if (tipoBeca === '1') {
            $('#otro-especificar-container').show();
        } else {
            $('#otro-especificar-container').hide();
        }
    }

    /**
     * Inicializa los eventos del formulario de becas
     */
    function initBecaForm() {
        $('#alumbecas-tiene_beca').on('change', toggleBecaFields);
        $('#alumbecas-tipos_becas_id').on('change', toggleOtroEspecificar);

        // Ejecutar al cargar la página
        toggleBecaFields();
        toggleOtroEspecificar();
    }

    // Inicialización cuando el DOM está listo
    $(document).ready(initBecaForm);

})(jQuery);
