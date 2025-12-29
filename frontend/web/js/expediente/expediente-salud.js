;(function ($) {
  const selectorTiene = '#alumestadosalud-tuvo_problema_salud';
  const problemasContainerSelector = '#salud-problemas-container';
  const problemasListSelector = '#lista-problemas';
  const problemaItemSelector = '.problema-item';
  const problemaCheckboxSelector = '.problema-checkbox';
  const problemaDetalleSelector = '.problema-detalle';
  const problemaGravedadSelector = '.problema-gravedad';
  const problemaOtroSelector = '.problema-otro';
  const problemaOtroInputSelector = '.problema-otro-input';
  const selectorEnfermedadesCronicas = '#alumenfermedadescronicas-padece_enfermedades_cronicas';
  const enfermedadesCronicasContainerSelector = '#salud-enfermedades-cronicas-container';
  const enfermedadesCronicasListSelector = '#lista-enfermedades-cronicas';
  const enfermedadCronicaItemSelector = '.enfermedad-cronica-item';
  const enfermedadCronicaCheckboxSelector = '.enfermedad-cronica-checkbox';
  const enfermedadCronicaDetalleSelector = '.enfermedad-cronica-detalle';
  const enfermedadCronicaOtroSelector = '.enfermedad-cronica-otro';
  const selectorAlergias = '#alumalergia-padeces_alergias';
  const alergiasContainerSelector = '#salud-alergias-container';
  const alergiasListSelector = '#lista-alergias';
  const alergiaItemSelector = '.alergia-item';
  const alergiaCheckboxSelector = '.alergia-checkbox';
  const alergiaDetalleSelector = '.alergia-detalle';
  const alergiaGravedadSelector = '.alergia-gravedad';
  const alergiaReaccionCheckboxSelector = '.alergia-reaccion-checkbox';
  const selectorServicios = '#alumserviciossalud-tiene_servicios_salud';
  const serviciosContainerSelector = '#salud-servicios-container';
  const servicioCheckboxSelector = '.servicio-salud-checkbox';
  const selectorAnteojos = '#alumusoanteojos-utilizas_anteojos';
  const anteojosContainerSelector = '#salud-anteojos-container';
  const anteojosCheckboxSelector = '.uso-anteojos-checkbox';
  const selectorTratamientos = '#alumtratamientos-esta_en_tratamiento';
  const tratamientosContainerSelector = '#salud-tratamientos-container';
  const tratamientosListSelector = '#lista-tratamientos';
  const tratamientoItemSelector = '.tratamiento-item';
  const tratamientoCheckboxSelector = '.tratamiento-checkbox';
  const tratamientoDetalleSelector = '.tratamiento-detalle';
  const tratamientoFrecuenciaSelector = '.tratamiento-frecuencia';
  const tratamientoFechaSelector = '.tratamiento-fecha';
  const tratamientoRangoSelector = '.tratamiento-rango';
  const select2Defaults = {
    theme: 'bootstrap-5',
    width: '100%',
    allowClear: true,
  };
  const enfermedadCronicaOtroId = (() => {
    const val = parseInt(window.ENFERMEDAD_CRONICA_OTRO_ID, 10);
    return Number.isNaN(val) ? null : val;
  })();
  const problemaOtroId = (() => {
    const val = parseInt(window.PROBLEMA_OTRO_ID, 10);
    return Number.isNaN(val) ? null : val;
  })();

  const ensureProblemasErrorMessage = () => {
    const $container = $(problemasContainerSelector);
    let $msg = $container.find('.problemas-error-msg');
    if (!$msg.length) {
      $msg = $(
        '<div class="problemas-error-msg alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">' +
          '<i class="fas fa-exclamation-triangle"></i>' +
          '<div class="fw-semibold small mb-0">Selecciona al menos una opcion.</div>' +
        '</div>',
      );
      $container.prepend($msg);
    }
    return $msg;
  };

  const clearProblemasErrorState = () => {
    const $container = $(problemasContainerSelector);
    const $checkboxes = $(problemaCheckboxSelector);
    const $msg = $container.find('.problemas-error-msg');
    $container.removeClass('border border-danger border-2 bg-danger-subtle bg-opacity-10');
    $checkboxes.removeClass('is-invalid is-valid');
    if ($msg.length) {
      $msg.addClass('d-none');
    }
  };

  const setProblemasErrorState = (hasError) => {
    const $container = $(problemasContainerSelector);
    const $checkboxes = $(problemaCheckboxSelector);
    const $msg = ensureProblemasErrorMessage();
    if (hasError) {
      $container.addClass('border border-danger border-2 bg-danger-subtle bg-opacity-10');
      $checkboxes.removeClass('is-valid').addClass('is-invalid');
      $msg.removeClass('d-none');
    } else {
      $container.removeClass('border border-danger border-2 bg-danger-subtle bg-opacity-10');
      $checkboxes.removeClass('is-invalid');
      const $checked = $checkboxes.filter(':checked');
      if ($checked.length) {
        $checked.addClass('is-valid');
      } else {
        $checkboxes.removeClass('is-valid');
      }
      $msg.addClass('d-none');
    }
  };

  const ensureSectionErrorMessage = (containerSelector, messageClass, text) => {
    const $container = $(containerSelector);
    let $msg = $container.find(messageClass);
    if (!$msg.length) {
      $msg = $(`
        <div class="${messageClass.replace('.', '')} alert alert-danger d-flex align-items-center gap-2 py-2 px-3 d-none rounded-3 mb-3">
          <i class="fas fa-exclamation-triangle"></i>
          <div class="fw-semibold small mb-0">${text}</div>
        </div>
      `);
      $container.prepend($msg);
    }
    return $msg;
  };

  const setCheckboxSectionError = ({
    containerSelector,
    checkboxSelector,
    messageClass,
    text,
    hasError,
    useBackground = true,
  }) => {
    const $container = $(containerSelector);
    const $checkboxes = $(checkboxSelector);
    const $msg = ensureSectionErrorMessage(containerSelector, messageClass, text);
    const showError = !!hasError;
    const borderClasses = 'border border-danger border-2';
    const bgClasses = 'bg-danger-subtle bg-opacity-10';
    $container.toggleClass(borderClasses, showError);
    if (useBackground) {
      $container.toggleClass(bgClasses, showError);
    } else if (!showError) {
      $container.removeClass(bgClasses);
    }
    $checkboxes.toggleClass('is-invalid', showError);
    $msg.toggleClass('d-none', !showError);

    if (showError) {
      $checkboxes.removeClass('is-valid');
      return;
    }

    const $checked = $checkboxes.filter(':checked');
    if ($checked.length) {
      $checkboxes.removeClass('is-invalid');
      $checked.addClass('is-valid');
    } else {
      $checkboxes.removeClass('is-valid');
    }
  };

  const resetSelect = ($select) => {
    $select.find('option:selected').prop('selected', false);
    $select.val(null);
    if ($select.data('select2')) {
      $select.trigger('change.select2');
      $select.trigger('change');
      $select.trigger('select2:close');
    } else {
      $select.prop('selectedIndex', 0).trigger('change');
    }
    $select.removeClass('is-invalid');
    if ($select[0]) {
      $select[0].setCustomValidity('');
    }
  };

  const toggleProblemas = () => {
    const show = parseInt($(selectorTiene).val(), 10) === 1;
    $(problemasContainerSelector).toggleClass('d-none', !show);

    if (!show) {
      const first = $(problemaCheckboxSelector).first()[0];
      if (first) {
        first.setCustomValidity('');
      }
      $(problemaCheckboxSelector).prop('checked', false);
      $(problemaDetalleSelector).addClass('d-none');
      $(problemaGravedadSelector).each(function () {
        resetSelect($(this));
        $(this).prop('required', false).prop('disabled', true).trigger('change.select2');
      });
      $(problemaOtroSelector).addClass('d-none');
      $(problemaOtroInputSelector).each(function () {
        $(this).val('').prop('disabled', true).removeClass('is-invalid');
        if (this.setCustomValidity) this.setCustomValidity('');
      });
      clearProblemasErrorState();
      $(problemaCheckboxSelector).prop('required', false);
      return;
    }

    const hasSelection = $(problemaCheckboxSelector + ':checked').length > 0;
    $(problemaCheckboxSelector).prop('required', !hasSelection);
  };

  const toggleEnfermedadesCronicas = () => {
    const show = parseInt($(selectorEnfermedadesCronicas).val(), 10) === 1;
    $(enfermedadesCronicasContainerSelector).toggleClass('d-none', !show);

    if (!show) {
      const first = $(enfermedadCronicaCheckboxSelector).first()[0];
      if (first) {
        first.setCustomValidity('');
      }
      $(enfermedadCronicaCheckboxSelector).prop('checked', false);
      $(enfermedadCronicaDetalleSelector).addClass('d-none');
      $(enfermedadCronicaOtroSelector)
        .val('')
        .prop('disabled', true)
        .each(function () {
          if (this.setCustomValidity) this.setCustomValidity('');
          $(this).removeClass('is-invalid');
        });
      setCheckboxSectionError({
        containerSelector: enfermedadesCronicasContainerSelector,
        checkboxSelector: enfermedadCronicaCheckboxSelector,
        messageClass: '.enfermedades-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $(enfermedadCronicaCheckboxSelector).prop('required', false);
      return;
    }

    const hasSelection = $(enfermedadCronicaCheckboxSelector + ':checked').length > 0;
    $(enfermedadCronicaCheckboxSelector).prop('required', !hasSelection);
  };

  const toggleEnfermedadCronicaDetalle = ($checkbox) => {
    const $row = $checkbox.closest(enfermedadCronicaItemSelector);
    const $detalle = $row.find(enfermedadCronicaDetalleSelector);
    const $otro = $row.find(enfermedadCronicaOtroSelector);
    const checked = $checkbox.is(':checked');
    const enfermedadId = parseInt($row.data('enfermedad-id'), 10);
    const esOtro = Number.isInteger(enfermedadCronicaOtroId) && enfermedadId === enfermedadCronicaOtroId;

    $detalle.toggleClass('d-none', !checked || !esOtro);
    $otro.prop('disabled', !checked || !esOtro);

    if (!checked || !esOtro) {
      $otro.val('').removeClass('is-invalid');
      if ($otro[0]) {
        $otro[0].setCustomValidity('');
      }
    } else if ($otro.length) {
      setTimeout(() => $otro.trigger('focus'), 0);
    }
  };

  const toggleAlergias = () => {
    const show = parseInt($(selectorAlergias).val(), 10) === 1;
    $(alergiasContainerSelector).toggleClass('d-none', !show);

    if (!show) {
      const first = $(alergiaCheckboxSelector).first()[0];
      if (first) {
        first.setCustomValidity('');
      }
      $(alergiaCheckboxSelector).prop('checked', false);
      $(alergiaDetalleSelector).addClass('d-none');
      $(alergiaGravedadSelector).each(function () {
        resetSelect($(this));
        $(this).prop('required', false).prop('disabled', true).trigger('change.select2');
      });
      $(alergiaReaccionCheckboxSelector)
        .prop('checked', false)
        .prop('disabled', true)
        .each(function () {
          if (this.setCustomValidity) this.setCustomValidity('');
          $(this).removeClass('is-invalid');
        });
      setCheckboxSectionError({
        containerSelector: alergiasContainerSelector,
        checkboxSelector: alergiaCheckboxSelector,
        messageClass: '.alergias-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $(alergiaCheckboxSelector).prop('required', false);
      return;
    }

    const hasSelection = $(alergiaCheckboxSelector + ':checked').length > 0;
    $(alergiaCheckboxSelector).prop('required', !hasSelection);
  };

  const toggleAlergiaDetalle = ($checkbox) => {
    const $row = $checkbox.closest(alergiaItemSelector);
    const $detalle = $row.find(alergiaDetalleSelector);
    const $gravedad = $row.find(alergiaGravedadSelector);
    const $reacciones = $row.find(alergiaReaccionCheckboxSelector);
    const checked = $checkbox.is(':checked');

    $detalle.toggleClass('d-none', !checked);
    $gravedad.prop('required', checked).prop('disabled', !checked).trigger('change.select2');
    $reacciones.prop('disabled', !checked);

    if (!checked) {
      resetSelect($gravedad);
      $reacciones.prop('checked', false);
      $reacciones.each(function () {
        if (this.setCustomValidity) this.setCustomValidity('');
        $(this).removeClass('is-invalid');
      });
    } else {
      initSelect2($gravedad);
    }
  };

  const toggleProblemaDetalle = ($checkbox) => {
    const $row = $checkbox.closest(problemaItemSelector);
    const $detalle = $row.find(problemaDetalleSelector);
    const $gravedad = $row.find(problemaGravedadSelector);
    const $otroContainer = $row.find(problemaOtroSelector);
    const $otroInput = $row.find(problemaOtroInputSelector);
    const problemaId = parseInt($row.data('problema-id'), 10);
    const checked = $checkbox.is(':checked');
    const esOtro = Number.isInteger(problemaOtroId) && problemaId === problemaOtroId;

    $detalle.toggleClass('d-none', !checked);
    $gravedad.prop('required', checked).prop('disabled', !checked).trigger('change.select2');

    if (!checked) {
      resetSelect($gravedad);
    } else {
      initSelect2($gravedad);
    }

    const showOtro = checked && esOtro;
    $otroContainer.toggleClass('d-none', !showOtro);
    $otroInput.prop('disabled', !showOtro).prop('required', showOtro);

    if (!showOtro) {
      $otroInput.val('').removeClass('is-invalid');
      if ($otroInput[0]) {
        $otroInput[0].setCustomValidity('');
      }
    }
  };

  const validateProblemas = (event, options = {}) => {
    const showError = options.showError === true || !!event;
    const show = parseInt($(selectorTiene).val(), 10) === 1;
    const $checkboxes = $(problemaCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      clearProblemasErrorState();
      return true;
    }

    const seleccionados = $(problemaCheckboxSelector + ':checked');
    $(problemaCheckboxSelector).prop('required', !seleccionados.length);
    if (!seleccionados.length) {
      if (showError) {
        setProblemasErrorState(true);
        if (first) {
          first.setCustomValidity('Selecciona al menos una opcion.');
          if (event) {
            first.reportValidity();
          }
        }
        if (event) {
          event.preventDefault();
          event.stopPropagation();
        }
      } else {
        clearProblemasErrorState();
      }
      return false;
    }

    setProblemasErrorState(false);

    if (first) {
      first.setCustomValidity('');
    }

    let valid = true;
    seleccionados.each(function () {
      const $row = $(this).closest(problemaItemSelector);
      const $gravedad = $row.find(problemaGravedadSelector);
      const $otro = $row.find(problemaOtroInputSelector);
      const problemaId = parseInt($row.data('problema-id'), 10);
      const esOtro = Number.isInteger(problemaOtroId) && problemaId === problemaOtroId;

      $gravedad.removeClass('is-invalid');
      if ($gravedad[0]) {
        $gravedad[0].setCustomValidity('');
      }

      if (!$gravedad.val()) {
        valid = false;
        if ($gravedad[0]) {
          $gravedad.addClass('is-invalid');
          $gravedad[0].setCustomValidity('Selecciona la gravedad.');
          if (event) $gravedad[0].reportValidity();
        }
        return false;
      }

      if (esOtro) {
        const val = ($otro.val() || '').trim();
        $otro.removeClass('is-invalid');
        if ($otro[0]) {
          $otro[0].setCustomValidity('');
        }
        if (!val) {
          valid = false;
          if ($otro[0]) {
            $otro.addClass('is-invalid');
            $otro[0].setCustomValidity('Especifica el problema de salud.');
            if (event) $otro[0].reportValidity();
          }
          return false;
        }
      }
    });

    if (!valid && event) {
      event.preventDefault();
      event.stopPropagation();
    }

    setCheckboxSectionError({
      containerSelector: alergiasContainerSelector,
      checkboxSelector: alergiaCheckboxSelector,
      messageClass: '.alergias-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: false,
    });

    return valid;
  };

    const validateEnfermedadesCronicas = (event, options = {}) => {
    const showError = options.showError === true || !!event;
    const show = parseInt($(selectorEnfermedadesCronicas).val(), 10) === 1;
    const $checkboxes = $(enfermedadCronicaCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      setCheckboxSectionError({
        containerSelector: enfermedadesCronicasContainerSelector,
        checkboxSelector: enfermedadCronicaCheckboxSelector,
        messageClass: '.enfermedades-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $checkboxes.prop('required', false);
      return true;
    }

    const seleccionados = $(enfermedadCronicaCheckboxSelector + ':checked');
    const hasSelection = seleccionados.length > 0;
    $checkboxes.prop('required', !hasSelection);

    if (!hasSelection) {
      setCheckboxSectionError({
        containerSelector: enfermedadesCronicasContainerSelector,
        checkboxSelector: enfermedadCronicaCheckboxSelector,
        messageClass: '.enfermedades-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: true,
      });
      if (showError && first) {
        first.setCustomValidity('Selecciona al menos una opcion.');
        if (event) {
          first.reportValidity();
        }
      }
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      return false;
    }

    setCheckboxSectionError({
      containerSelector: enfermedadesCronicasContainerSelector,
      checkboxSelector: enfermedadCronicaCheckboxSelector,
      messageClass: '.enfermedades-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: false,
    });

    if (first) {
      first.setCustomValidity('');
    }

    let valid = true;
    seleccionados.each(function () {
      const $row = $(this).closest(enfermedadCronicaItemSelector);
      const enfermedadId = parseInt($row.data('enfermedad-id'), 10);
      const esOtro = Number.isInteger(enfermedadCronicaOtroId) && enfermedadId === enfermedadCronicaOtroId;
      if (!esOtro) {
        return;
      }
      const $otro = $row.find(enfermedadCronicaOtroSelector);
      const val = ($otro.val() || '').trim();
      $otro.removeClass('is-invalid');
      if ($otro[0]) {
        $otro[0].setCustomValidity('');
      }
      if (!val) {
        valid = false;
        if ($otro[0]) {
          $otro.addClass('is-invalid');
          $otro[0].setCustomValidity('Especifica la enfermedad cronica.');
          if (event) $otro[0].reportValidity();
        }
        return false;
      }
    });

    if (!valid && event) {
      event.preventDefault();
      event.stopPropagation();
    }

    return valid;
  };

  const validateAlergias = (event, options = {}) => {
    const showError = options.showError === true || !!event;
    const show = parseInt($(selectorAlergias).val(), 10) === 1;
    const $checkboxes = $(alergiaCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      setCheckboxSectionError({
        containerSelector: alergiasContainerSelector,
        checkboxSelector: alergiaCheckboxSelector,
        messageClass: '.alergias-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $checkboxes.prop('required', false);
      return true;
    }

    const seleccionados = $(alergiaCheckboxSelector + ':checked');
    const hasSelection = seleccionados.length > 0;
    $checkboxes.prop('required', !hasSelection);

    if (!hasSelection) {
      setCheckboxSectionError({
        containerSelector: alergiasContainerSelector,
        checkboxSelector: alergiaCheckboxSelector,
        messageClass: '.alergias-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: true,
      });
      if (showError && first) {
        first.setCustomValidity('Selecciona al menos una alergia.');
        if (event) {
          first.reportValidity();
        }
      }
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      return false;
    }

    setCheckboxSectionError({
      containerSelector: alergiasContainerSelector,
      checkboxSelector: alergiaCheckboxSelector,
      messageClass: '.alergias-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: false,
    });

    if (first) {
      first.setCustomValidity('');
    }

    let valid = true;
    seleccionados.each(function () {
      const $row = $(this).closest(alergiaItemSelector);
      const $gravedad = $row.find(alergiaGravedadSelector);
      const $reacciones = $row.find(alergiaReaccionCheckboxSelector);
      const $reaccionesSeleccionadas = $row.find(`${alergiaReaccionCheckboxSelector}:checked`);
      const firstReaction = $reacciones.first()[0];

      $gravedad.removeClass('is-invalid');
      if ($gravedad[0]) {
        $gravedad[0].setCustomValidity('');
      }
      if (firstReaction) {
        firstReaction.setCustomValidity('');
      }
      $reacciones.removeClass('is-invalid');

      if (!$gravedad.val()) {
        valid = false;
        if ($gravedad[0]) {
          $gravedad.addClass('is-invalid');
          $gravedad[0].setCustomValidity('Selecciona la gravedad.');
          if (event) $gravedad[0].reportValidity();
        }
        return false;
      }

      if (!$reaccionesSeleccionadas.length) {
        valid = false;
        if (firstReaction) {
          firstReaction.setCustomValidity('Selecciona al menos una reaccion.');
          if (event) firstReaction.reportValidity();
        }
        return false;
      }
    });

    if (!valid && event) {
      event.preventDefault();
      event.stopPropagation();
    }

    return valid;
  };

  const toggleServicios = () => {
    const show = parseInt($(selectorServicios).val(), 10) === 1;
    $(serviciosContainerSelector).toggleClass('d-none', !show);

    const $checkboxes = $(servicioCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      $checkboxes.prop('checked', false);
      if (first) {
        first.setCustomValidity('');
      }
      setCheckboxSectionError({
        containerSelector: serviciosContainerSelector,
        checkboxSelector: servicioCheckboxSelector,
        messageClass: '.servicios-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $checkboxes.prop('required', false);
      return;
    }

    const hasSelection = $(servicioCheckboxSelector + ':checked').length > 0;
    $checkboxes.prop('required', !hasSelection);
  };

  const toggleAnteojos = () => {
    const show = parseInt($(selectorAnteojos).val(), 10) === 1;
    $(anteojosContainerSelector).toggleClass('d-none', !show);

    const $checkboxes = $(anteojosCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      $checkboxes.prop('checked', false);
      if (first) {
        first.setCustomValidity('');
      }
      setCheckboxSectionError({
        containerSelector: anteojosContainerSelector,
        checkboxSelector: anteojosCheckboxSelector,
        messageClass: '.anteojos-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $checkboxes.prop('required', false);
      return;
    }

    const hasSelection = $(anteojosCheckboxSelector + ':checked').length > 0;
    $checkboxes.prop('required', !hasSelection);
  };

  const validateServiciosSalud = (event, options = {}) => {
    const showError = options.showError === true || !!event;
    const show = parseInt($(selectorServicios).val(), 10) === 1;
    const $checkboxes = $(servicioCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      setCheckboxSectionError({
        containerSelector: serviciosContainerSelector,
        checkboxSelector: servicioCheckboxSelector,
        messageClass: '.servicios-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $checkboxes.prop('required', false);
      return true;
    }

    const hasSelection = $(servicioCheckboxSelector + ':checked').length > 0;
    $checkboxes.prop('required', !hasSelection);
    if (!hasSelection) {
      setCheckboxSectionError({
        containerSelector: serviciosContainerSelector,
        checkboxSelector: servicioCheckboxSelector,
        messageClass: '.servicios-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: true,
      });
      if (showError && first) {
        first.setCustomValidity('Selecciona al menos un servicio de salud.');
        if (event) {
          first.reportValidity();
        }
      }
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      return false;
    }

    if (first) {
      first.setCustomValidity('');
    }
    setCheckboxSectionError({
      containerSelector: serviciosContainerSelector,
      checkboxSelector: servicioCheckboxSelector,
      messageClass: '.servicios-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: false,
    });
    return true;
  };

  const initSelect2 = ($select) => {
    if (!$select.length) return;
    const placeholder = $select.data('placeholder') || $select.attr('placeholder') || 'Selecciona...';
    if ($select.data('select2')) {
      $select.trigger('change.select2');
      return;
    }
    $select.select2(Object.assign({}, select2Defaults, { placeholder }));
  };

  const toggleTratamientos = () => {
    const show = parseInt($(selectorTratamientos).val(), 10) === 1;
    $(tratamientosContainerSelector).toggleClass('d-none', !show);

    if (!show) {
      $(tratamientoCheckboxSelector).prop('checked', false);
      $(tratamientoDetalleSelector).addClass('d-none');
      $(tratamientoFrecuenciaSelector).each(function () {
        resetSelect($(this));
        $(this).prop('required', false).prop('disabled', true).trigger('change.select2');
      });
      $(tratamientoFechaSelector).val('').prop('disabled', true).each(function () {
        if (this.setCustomValidity) this.setCustomValidity('');
      });
      $(tratamientoRangoSelector).val('').prop('disabled', true).removeClass('is-invalid');
      setCheckboxSectionError({
        containerSelector: tratamientosContainerSelector,
        checkboxSelector: tratamientoCheckboxSelector,
        messageClass: '.tratamientos-error-msg',
        text: 'Selecciona al menos un tratamiento.',
        hasError: false,
        useBackground: false,
      });
      $(tratamientoCheckboxSelector).prop('required', false);
      return;
    }

    const hasSelection = $(tratamientoCheckboxSelector + ':checked').length > 0;
    $(tratamientoCheckboxSelector).prop('required', !hasSelection);
  };

  const toggleTratamientoDetalle = ($checkbox) => {
    const $row = $checkbox.closest(tratamientoItemSelector);
    const $detalle = $row.find(tratamientoDetalleSelector);
    const $frecuencia = $row.find(tratamientoFrecuenciaSelector);
    const $fechas = $row.find(tratamientoFechaSelector);
    const $rango = $row.find(tratamientoRangoSelector);
    const checked = $checkbox.is(':checked');

    $detalle.toggleClass('d-none', !checked);
    $frecuencia.prop('required', checked).prop('disabled', !checked).trigger('change.select2');
    $fechas.prop('disabled', !checked);
    $rango.prop('disabled', !checked);

    if (!checked) {
      resetSelect($frecuencia);
      $fechas.val('');
      $fechas.each(function () {
        if (this.setCustomValidity) this.setCustomValidity('');
      });
      $rango.val('').removeClass('is-invalid');
    } else {
      initSelect2($frecuencia);
    }
  };

  const validateTratamientos = (event, options = {}) => {
    const showError = options.showError === true || !!event;
    const show = parseInt($(selectorTratamientos).val(), 10) === 1;
    if (!show) {
      setCheckboxSectionError({
        containerSelector: tratamientosContainerSelector,
        checkboxSelector: tratamientoCheckboxSelector,
        messageClass: '.tratamientos-error-msg',
        text: 'Selecciona al menos un tratamiento.',
        hasError: false,
        useBackground: false,
      });
      $(tratamientoCheckboxSelector).prop('required', false);
      return true;
    }

    const $checkboxes = $(tratamientoCheckboxSelector);
    const seleccionados = $checkboxes.filter(':checked');
    const first = $checkboxes.first()[0];
    const hasSelection = seleccionados.length > 0;
    $checkboxes.prop('required', !hasSelection);
    if (!hasSelection) {
      setCheckboxSectionError({
        containerSelector: tratamientosContainerSelector,
        checkboxSelector: tratamientoCheckboxSelector,
        messageClass: '.tratamientos-error-msg',
        text: 'Selecciona al menos un tratamiento.',
        hasError: showError,
        useBackground: false,
      });
      if (showError && first) {
        first.setCustomValidity('Selecciona al menos un tratamiento.');
        if (event) {
          first.reportValidity();
        }
      }
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      return false;
    }

    setCheckboxSectionError({
      containerSelector: tratamientosContainerSelector,
      checkboxSelector: tratamientoCheckboxSelector,
      messageClass: '.tratamientos-error-msg',
      text: 'Selecciona al menos un tratamiento.',
      hasError: false,
      useBackground: false,
    });
    if (first) {
      first.setCustomValidity('');
    }

    let valid = true;
    $(tratamientosListSelector)
      .find(tratamientoItemSelector)
      .each(function () {
        const $row = $(this);
        const $checkbox = $row.find(tratamientoCheckboxSelector);
        if (!$checkbox.is(':checked')) {
          return;
        }

        const $frecuencia = $row.find(tratamientoFrecuenciaSelector);
        const $fechas = $row.find(tratamientoFechaSelector);

        $frecuencia.removeClass('is-invalid');
        $fechas.removeClass('is-invalid');
        if ($frecuencia[0]) {
          $frecuencia[0].setCustomValidity('');
        }

        if (!$frecuencia.val()) {
          valid = false;
          if ($frecuencia[0]) {
            $frecuencia.addClass('is-invalid');
            $frecuencia[0].setCustomValidity('Selecciona la frecuencia.');
            if (event) $frecuencia[0].reportValidity();
          }
          return false;
        }

        const $inicio = $fechas.eq(0);
        const $fin = $fechas.eq(1);
        const inicioVal = $inicio.val();
        const finVal = $fin.val();

        if (inicioVal && finVal && new Date(finVal) < new Date(inicioVal)) {
          valid = false;
          $fin.addClass('is-invalid');
          if ($fin[0]) {
            $fin[0].setCustomValidity('La fecha fin debe ser igual o posterior al inicio.');
            if (event) $fin[0].reportValidity();
          }
          return false;
        }
      });

    if (!valid && event) {
      event.preventDefault();
      event.stopPropagation();
    }

    return valid;
  };

  const validateUsoAnteojos = (event, options = {}) => {
    const showError = options.showError === true || !!event;
    const show = parseInt($(selectorAnteojos).val(), 10) === 1;
    const $checkboxes = $(anteojosCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      setCheckboxSectionError({
        containerSelector: anteojosContainerSelector,
        checkboxSelector: anteojosCheckboxSelector,
        messageClass: '.anteojos-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: false,
      });
      $checkboxes.prop('required', false);
      return true;
    }

    const hasSelection = $(anteojosCheckboxSelector + ':checked').length > 0;
    $checkboxes.prop('required', !hasSelection);
    if (!hasSelection) {
      setCheckboxSectionError({
        containerSelector: anteojosContainerSelector,
        checkboxSelector: anteojosCheckboxSelector,
        messageClass: '.anteojos-error-msg',
        text: 'Selecciona al menos una opcion.',
        hasError: true,
      });
      if (showError && first) {
        first.setCustomValidity('Selecciona al menos una opcion de uso de anteojos.');
        if (event) {
          first.reportValidity();
        }
      }
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      return false;
    }

    if (first) {
      first.setCustomValidity('');
    }
    setCheckboxSectionError({
      containerSelector: anteojosContainerSelector,
      checkboxSelector: anteojosCheckboxSelector,
      messageClass: '.anteojos-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: false,
    });
    return true;
  };

  const openAccordionOnInvalid = () => {
    const formEl = document.querySelector('.expediente-form form');
    if (!formEl) return;

    formEl.addEventListener(
      'invalid',
      (ev) => {
        if ($(ev.target).is(problemaCheckboxSelector)) {
          setProblemasErrorState(true);
          const $container = $(problemasContainerSelector);
          const $collapse = $container.closest('.accordion-collapse');
          if ($collapse.length) {
            $collapse.addClass('show');
            $collapse.prev('.accordion-header').find('.accordion-button').removeClass('collapsed');
          }
          setTimeout(() => {
            ev.target.focus({ preventScroll: false });
            ev.target.scrollIntoView?.({ behavior: 'smooth', block: 'center' });
          }, 0);
        }
      },
      true,
    );
  };

  $(document)
    .on('change', selectorTiene, function () {
      toggleProblemas();
      validateProblemas(null, { showError: true });
    })
    .on('change', problemaCheckboxSelector, function () {
      toggleProblemaDetalle($(this));
      validateProblemas(null, { showError: true });
    })
    .on('change', problemaGravedadSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
      validateProblemas(null, { showError: false });
    })
    .on('change', selectorEnfermedadesCronicas, function () {
      toggleEnfermedadesCronicas();
      validateEnfermedadesCronicas();
    })
    .on('change', enfermedadCronicaCheckboxSelector, function () {
      toggleEnfermedadCronicaDetalle($(this));
      validateEnfermedadesCronicas();
    })
    .on('input', enfermedadCronicaOtroSelector, function () {
      if (this.setCustomValidity) {
        this.setCustomValidity('');
      }
      $(this).removeClass('is-invalid');
      validateEnfermedadesCronicas();
    })
    .on('change', selectorAlergias, function () {
      toggleAlergias();
      validateAlergias();
    })
    .on('change', alergiaCheckboxSelector, function () {
      toggleAlergiaDetalle($(this));
      validateAlergias();
    })
    .on('change', alergiaGravedadSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
      validateAlergias();
    })
    .on('change', alergiaReaccionCheckboxSelector, function () {
      const first = $(this).closest(alergiaItemSelector).find(alergiaReaccionCheckboxSelector).first()[0];
      if (first) {
        first.setCustomValidity('');
      }
      validateAlergias();
    })
    .on('change', selectorServicios, function () {
      toggleServicios();
      validateServiciosSalud();
    })
    .on('change', servicioCheckboxSelector, function () {
      validateServiciosSalud();
    })
    .on('change', selectorAnteojos, function () {
      toggleAnteojos();
      validateUsoAnteojos();
    })
    .on('change', anteojosCheckboxSelector, function () {
      validateUsoAnteojos();
    })
  .on('change', selectorTratamientos, function () {
    toggleTratamientos();
    validateTratamientos(null, { showError: true });
  })
  .on('change', tratamientoCheckboxSelector, function () {
    toggleTratamientoDetalle($(this));
    validateTratamientos(null, { showError: true });
  })
    .on('change', `${tratamientoFrecuenciaSelector}, ${tratamientoFechaSelector}, ${tratamientoRangoSelector}`, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
    })
    .on('input', problemaOtroInputSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
  })
  .on('submit', '#expediente-form', function (event) {
    const validProblemas = validateProblemas(event, { showError: true });
    const validEnfermedades = validateEnfermedadesCronicas(event);
    const validAlergias = validateAlergias(event);
    const validServicios = validateServiciosSalud(event);
    const validAnteojos = validateUsoAnteojos(event);
    const validTratamientos = validateTratamientos(event);
    const showEnfermedades = parseInt($(selectorEnfermedadesCronicas).val(), 10) === 1;
    const showAlergias = parseInt($(selectorAlergias).val(), 10) === 1;
    const showServicios = parseInt($(selectorServicios).val(), 10) === 1;
    const showAnteojos = parseInt($(selectorAnteojos).val(), 10) === 1;
    const showTratamientos = parseInt($(selectorTratamientos).val(), 10) === 1;
    setCheckboxSectionError({
      containerSelector: enfermedadesCronicasContainerSelector,
      checkboxSelector: enfermedadCronicaCheckboxSelector,
      messageClass: '.enfermedades-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: showEnfermedades && !validEnfermedades,
    });
    setCheckboxSectionError({
      containerSelector: alergiasContainerSelector,
      checkboxSelector: alergiaCheckboxSelector,
      messageClass: '.alergias-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: showAlergias && !validAlergias,
    });
    setCheckboxSectionError({
      containerSelector: serviciosContainerSelector,
      checkboxSelector: servicioCheckboxSelector,
      messageClass: '.servicios-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: showServicios && !validServicios,
    });
    setCheckboxSectionError({
      containerSelector: anteojosContainerSelector,
      checkboxSelector: anteojosCheckboxSelector,
      messageClass: '.anteojos-error-msg',
      text: 'Selecciona al menos una opcion.',
      hasError: showAnteojos && !validAnteojos,
    });
    setCheckboxSectionError({
      containerSelector: tratamientosContainerSelector,
      checkboxSelector: tratamientoCheckboxSelector,
      messageClass: '.tratamientos-error-msg',
      text: 'Selecciona al menos un tratamiento.',
      hasError: showTratamientos && !validTratamientos,
      useBackground: false,
    });
    if (!validProblemas || !validEnfermedades || !validAlergias || !validServicios || !validAnteojos || !validTratamientos) {
      event.preventDefault();
      event.stopPropagation();
    }
  });

  $(document).ready(() => {
    toggleProblemas();
    toggleEnfermedadesCronicas();
    toggleAlergias();
    toggleServicios();
    toggleAnteojos();
    toggleTratamientos();
    $(problemaCheckboxSelector).each(function () {
      toggleProblemaDetalle($(this));
    });
    $(problemaGravedadSelector).each(function () {
      initSelect2($(this));
    });
    $(enfermedadesCronicasListSelector)
      .find(enfermedadCronicaCheckboxSelector)
      .each(function () {
        toggleEnfermedadCronicaDetalle($(this));
      });
    $(alergiasListSelector)
      .find(alergiaCheckboxSelector)
      .each(function () {
        toggleAlergiaDetalle($(this));
      });
    $(alergiaGravedadSelector).each(function () {
      initSelect2($(this));
    });
    $(tratamientosListSelector)
      .find(tratamientoCheckboxSelector)
      .each(function () {
        toggleTratamientoDetalle($(this));
      });
    $(tratamientoFrecuenciaSelector).each(function () {
      initSelect2($(this));
    });
    validateProblemas(null, { showError: false });
    validateEnfermedadesCronicas();
    validateAlergias();
    validateServiciosSalud();
    validateUsoAnteojos();
    validateTratamientos();
    openAccordionOnInvalid();
  });
})(jQuery);



