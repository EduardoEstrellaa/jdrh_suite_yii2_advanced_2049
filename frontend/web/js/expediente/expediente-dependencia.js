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
                $otroInput
                    .val('')
                    .prop('required', false)
                    .removeAttr('pattern')
                    .removeClass('is-invalid')
                    .get(0)?.setCustomValidity('');
            } else {
                // Obligar a capturar texto no vac¡o cuando se elige "Otro"
                $otroInput
                    .prop('required', true)
                    .attr('pattern', '.*\\S.*');
            }
        };

        function validateOtro(event, options = {}) {
            const sanitize = options.sanitize === true;
            if (!$otroInput.length || otroId === null) {
                return true;
            }

            const val = parseInt($select.val(), 10);
            const requiresOtro = !Number.isNaN(val) && val === otroId;
            if (!requiresOtro) {
                $otroInput.get(0)?.setCustomValidity('');
                $otroInput.removeClass('is-invalid');
                return true;
            }

            const raw = $otroInput.val();
            const trimmed = typeof raw === 'string' ? raw.trim() : '';
            if (sanitize) {
                $otroInput.val(trimmed);
            }

            if (trimmed.length === 0) {
                if (event) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                $otroInput.addClass('is-invalid');
                $otroInput.get(0)?.setCustomValidity('Debes especificar el texto para "Otro".');
                $otroInput.get(0)?.reportValidity();
                const $collapse = $otroInput.closest('.accordion-collapse');
                if ($collapse.length) {
                    $collapse.addClass('show');
                    $collapse.prev('.accordion-header').find('.accordion-button').removeClass('collapsed');
                }
                return false;
            }

            $otroInput.removeClass('is-invalid');
            $otroInput.get(0)?.setCustomValidity('');
            return true;
        }

        function bindValidation() {
            const formEl = document.querySelector('.expediente-form form');
            if (!formEl) return;

            const $form = $(formEl);

            $form.on('submit', function (e) {
                if (!validateOtro(e, { sanitize: true })) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    return false;
                }
                return true;
            });

            $form.on('beforeSubmit', function (e) {
                if (!validateOtro(e, { sanitize: true })) {
                    e.preventDefault();
                    return false;
                }
                return true;
            });

            $select.on('change', function () {
                toggleOtro();
                validateOtro(null, { sanitize: false });
            });

            $otroInput.on('input blur', function () {
                validateOtro(null, { sanitize: false });
            });
        }

        $select.on('change', toggleOtro);
        toggleOtro();
        bindValidation();
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
