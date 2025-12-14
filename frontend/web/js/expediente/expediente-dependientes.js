(function ($) {
    'use strict';

    const selectors = {
        tieneDependientes: '#alumdependeneconomica-tiene_dependientes',
        dependientesSection: '#dependientes-section',
        dependienteCheckbox: '.dependiente-checkbox',
        otroContainer: '#otro-dependiente-container',
        otroInput: '#dependientes-otro',
    };

    function sanitizeOtroInput() {
        const $otroInput = $(selectors.otroInput);
        if (!$otroInput.length) return;

        // Permitir escribir espacios mientras se tipea; normalizar solo al perder foco
        $otroInput.on('blur', function () {
            const raw = $(this).val();
            const trimmed = typeof raw === 'string' ? raw.trim() : '';
            $(this).val(trimmed);
            if (trimmed.length === 0) {
                this.setCustomValidity('Captura un texto para "Otro".');
            } else {
                this.setCustomValidity('');
            }
        });
    }

    function toggleDependientes(init = false) {
        const $toggle = $(selectors.tieneDependientes);
        const $section = $(selectors.dependientesSection);
        const $checkboxes = $(selectors.dependienteCheckbox);
        const $otroContainer = $(selectors.otroContainer);
        const $otroInput = $(selectors.otroInput);
        const otroId = window.DEPENDENCIA_OTRO_ID ?? null;

        if (!$toggle.length) return;

        const show = parseInt($toggle.val(), 10) === 1;
        $section.toggleClass('d-none', !show);

        if (!show) {
            $checkboxes.prop('checked', false).prop('required', false);
            $otroContainer.addClass('d-none');
            $otroInput
                .val('')
                .prop('required', false)
                .removeAttr('pattern')
                .removeClass('is-invalid')
                .get(0)?.setCustomValidity('');
            toggleDependientes.lastValue = 0;
            return;
        }

        const selected = $checkboxes.filter(':checked').map(function () {
            return parseInt(this.value, 10);
        }).get();
        const showOtro = otroId !== null && selected.includes(otroId);
        $otroContainer.toggleClass('d-none', !showOtro);
        $otroInput.prop('required', showOtro);
        if (showOtro) {
            // Obligar al menos un caracter no espacio
            $otroInput.attr('pattern', '.*\\S.*');
        } else {
            $otroInput.removeAttr('pattern')
                .removeClass('is-invalid')
                .get(0)?.setCustomValidity('');
        }

        // Si no hay checks, forzar uno requerido para validación HTML5
        $checkboxes.prop('required', selected.length === 0);
        toggleDependientes.lastValue = 1;
    }
    toggleDependientes.lastValue = null;

    function preventSubmitIfOtroEmpty() {
        const formEl = document.querySelector('.expediente-form form');
        if (!formEl) return;

        const $form = $(formEl);
        const $otroInput = $(selectors.otroInput);
        const $toggle = $(selectors.tieneDependientes);
        const otroId = window.DEPENDENCIA_OTRO_ID ?? null;

        function validateOtro(event, options = {}) {
            const sanitize = options.sanitize === true;
            const $otroContainer = $(selectors.otroContainer);
            if (!$otroContainer.length || !$otroInput.length || !$toggle.length) {
                return true;
            }

            const hasDependientes = parseInt($toggle.val(), 10) === 1;
            if (!hasDependientes) {
                $otroInput.get(0)?.setCustomValidity('');
                $otroInput.removeClass('is-invalid');
                return true;
            }

            const selected = $(selectors.dependienteCheckbox).filter(':checked').map(function () {
                return parseInt(this.value, 10);
            }).get();
            const requiresOtro = otroId !== null && selected.includes(otroId);
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

        $(selectors.dependienteCheckbox).on('change', function () {
            validateOtro(null, { sanitize: false });
        });
        $(selectors.otroInput).on('input', function () {
            validateOtro(null, { sanitize: false });
        });
    }

    function bindDependientes() {
        $(selectors.tieneDependientes).on('change', toggleDependientes);
        $(selectors.dependienteCheckbox).on('change', toggleDependientes);
        toggleDependientes(true);
        sanitizeOtroInput();
    }

    function openAccordionOnInvalid() {
        const formEl = document.querySelector('.expediente-form form');
        if (!formEl) return;

        formEl.addEventListener('invalid', function (ev) {
            ev.preventDefault();
            const target = ev.target;
            const $collapse = $(target).closest('.accordion-collapse');
            if ($collapse.length) {
                $collapse.addClass('show');
                $collapse.prev('.accordion-header').find('.accordion-button').removeClass('collapsed');
            }
            toggleDependientes();
            setTimeout(function () {
                target.focus();
                if (target.scrollIntoView) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 0);
        }, true);
    }

    $(document).ready(function () {
        bindDependientes();
        preventSubmitIfOtroEmpty();
        openAccordionOnInvalid();
    });
})(jQuery);
