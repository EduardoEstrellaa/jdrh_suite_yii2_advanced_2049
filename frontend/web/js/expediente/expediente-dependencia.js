(function ($) {
    function initDependenciaEconomica() {
        const $select = $('#alumdependeeconomicamente-catalogo_dependencias_economicas_id');
        if (!$select.length) return;

        const $otroContainer = $('#otro-dependencia-container');
        const $otroInput = $('#alumdependeeconomicamente-otro_especificar');
        const otroId = resolveOtroId($select);

        const toggleOtro = () => {
            const val = parseInt($select.val(), 10);
            const show = otroId !== null && !Number.isNaN(val) && val === otroId;
            $otroContainer.toggleClass('d-none', !show);
            if (!show) {
                $otroInput.val('');
            }
        };

        $select.on('change', toggleOtro);
        toggleOtro();
    }

    function resolveOtroId($select) {
        if (Number.isInteger(window.DEPENDENCIA_OTRO_ID)) {
            return window.DEPENDENCIA_OTRO_ID;
        }

        const dataId = parseInt($select.data('otro-id'), 10);
        if (!Number.isNaN(dataId)) {
            return dataId;
        }

        const match = Array.from($select.find('option')).find(opt => {
            const text = (opt.text || '').trim().toLowerCase();
            return text === 'otro';
        });

        if (match && match.value) {
            const id = parseInt(match.value, 10);
            return Number.isNaN(id) ? null : id;
        }

        return null;
    }

    $(document).ready(initDependenciaEconomica);
})(jQuery);
