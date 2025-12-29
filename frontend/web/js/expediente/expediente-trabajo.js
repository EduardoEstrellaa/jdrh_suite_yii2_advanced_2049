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

    function markInputState($input, state) {
        // state: 'valid', 'invalid', 'none'
        $input
            .toggleClass('is-invalid', state === 'invalid')
            .toggleClass('is-valid', state === 'valid');
    }

    function clearInputErrors($inputs) {
        $inputs.each(function () {
            markInputState($(this), 'none');
            this.setCustomValidity?.('');
        });
    }

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
            clearInputErrors($inputs);
        } else {
            // Recalcular estado cuando se muestra la sección
            $inputs.each(function () {
                const value = typeof this.value === 'string' ? this.value.trim() : '';
                markInputState($(this), value.length > 0 ? 'valid' : 'none');
            });
        }
    }

    function validateTrabajo(event, { sanitize = false } = {}) {
        const $toggle = $(selectors.toggle);
        if (!$toggle.length || parseInt($toggle.val(), 10) !== 1) {
            return true;
        }

        const $inputs = $(selectors.inputs.join(','));
        let valid = true;

        $inputs.each(function () {
            const $input = $(this);
            const raw = $input.val();
            const value = typeof raw === 'string' ? raw.trim() : '';
            if (sanitize) {
                $input.val(value);
            }
            const isEmpty = value.length === 0;
            if (isEmpty) {
                markInputState($input, 'invalid');
                valid = false;
                this.setCustomValidity?.('Este campo es obligatorio.');
            } else {
                markInputState($input, 'valid');
                this.setCustomValidity?.('');
            }
        });

        if (!valid && event) {
            event.preventDefault();
            event.stopPropagation();
            const $section = $(selectors.section);
            const $collapse = $section.closest('.accordion-collapse');
            if ($collapse.length) {
                $collapse.addClass('show');
                $collapse.prev('.accordion-header').find('.accordion-button').removeClass('collapsed');
            }
            $inputs.first().focus();
        }

        return valid;
    }

    $(document).ready(function () {
        const $toggle = $(selectors.toggle);
        if (!$toggle.length) return;

        $toggle.on('change', toggleTrabajo);
        toggleTrabajo();

        const formEl = document.querySelector('.expediente-form form');
        if (!formEl) return;
        const $form = $(formEl);

        $form.on('submit', function (e) {
            if (!validateTrabajo(e, { sanitize: true })) {
                e.preventDefault();
                e.stopImmediatePropagation();
                return false;
            }
            return true;
        });

        $form.on('beforeSubmit', function (e) {
            if (!validateTrabajo(e, { sanitize: true })) {
                e.preventDefault();
                return false;
            }
            return true;
        });

        $(selectors.inputs.join(',')).on('input blur', function () {
            validateTrabajo(null, { sanitize: false });
        });
    });
})(jQuery);
