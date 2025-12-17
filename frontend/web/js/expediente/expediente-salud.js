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
  const problemaOtroId = (() => {
    const val = parseInt(window.PROBLEMA_OTRO_ID, 10);
    return Number.isNaN(val) ? null : val;
  })();

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

  const validateProblemas = (event) => {
    const show = parseInt($(selectorTiene).val(), 10) === 1;
    const $checkboxes = $(problemaCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      return true;
    }

    const seleccionados = $(problemaCheckboxSelector + ':checked');
    if (!seleccionados.length) {
      if (first) {
        first.setCustomValidity('Selecciona al menos un problema de salud.');
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
    }
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
    }
  };

  const validateServiciosSalud = (event) => {
    const show = parseInt($(selectorServicios).val(), 10) === 1;
    const $checkboxes = $(servicioCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      return true;
    }

    const hasSelection = $(servicioCheckboxSelector + ':checked').length > 0;
    if (!hasSelection) {
      if (first) {
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
    }
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

  const validateTratamientos = (event) => {
    const show = parseInt($(selectorTratamientos).val(), 10) === 1;
    if (!show) {
      return true;
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

  const validateUsoAnteojos = (event) => {
    const show = parseInt($(selectorAnteojos).val(), 10) === 1;
    const $checkboxes = $(anteojosCheckboxSelector);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      return true;
    }

    const hasSelection = $(anteojosCheckboxSelector + ':checked').length > 0;
    if (!hasSelection) {
      if (first) {
        first.setCustomValidity('Selecciona al menos una opción de uso de anteojos.');
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
    return true;
  };

  $(document)
    .on('change', selectorTiene, function () {
      toggleProblemas();
      validateProblemas();
    })
    .on('change', problemaCheckboxSelector, function () {
      toggleProblemaDetalle($(this));
      validateProblemas();
    })
    .on('change', problemaGravedadSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
      validateProblemas();
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
      validateTratamientos();
    })
    .on('change', tratamientoCheckboxSelector, function () {
      toggleTratamientoDetalle($(this));
      validateTratamientos();
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
      const validProblemas = validateProblemas(event);
      const validServicios = validateServiciosSalud(event);
      const validAnteojos = validateUsoAnteojos(event);
      const validTratamientos = validateTratamientos(event);
      if (!validProblemas || !validServicios || !validAnteojos || !validTratamientos) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

  $(document).ready(() => {
    toggleProblemas();
    toggleServicios();
    toggleAnteojos();
    toggleTratamientos();
    $(problemaCheckboxSelector).each(function () {
      toggleProblemaDetalle($(this));
    });
    $(problemaGravedadSelector).each(function () {
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
    validateProblemas();
    validateServiciosSalud();
    validateUsoAnteojos();
    validateTratamientos();
  });
})(jQuery);
