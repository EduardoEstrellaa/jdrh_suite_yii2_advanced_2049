(function () {
    const $form = $('#expediente-form');
    if (!$form.length) return;

    let shouldScroll = false;

    // Marcar que hubo intento de envío
    $form.on('submit', function () {
        shouldScroll = true;
    });

    $form.on('afterValidate', function (event, messages) {
        const errorIds = Object.keys(messages || {}).filter(function (key) {
            return Array.isArray(messages[key]) && messages[key].length > 0;
        });

        if (!errorIds.length) {
            shouldScroll = false;
            return;
        }

        if (!shouldScroll) return;
        shouldScroll = false;

        const firstId = errorIds[0];
        const $field = $('#' + firstId);
        if (!$field.length) return;

        // Abrir acordeón que contenga el campo (si aplica)
        const $collapse = $field.closest('.accordion-collapse');
        if ($collapse.length && typeof bootstrap !== 'undefined') {
            const instance = bootstrap.Collapse.getOrCreateInstance($collapse, { toggle: false });
            instance.show();
        }

        const $target = $field.is(':visible') ? $field : $field.closest(':visible');
        const top = $target.offset() ? $target.offset().top - 100 : 0;

        $('html, body').animate({ scrollTop: top }, 250, function () {
            $field.trigger('focus');
        });
    });
})();
