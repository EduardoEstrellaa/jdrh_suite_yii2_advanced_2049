;(function ($) {
  const selectorTiene = '#alumestadosalud-tuvo_problema_salud';
  const contenedorSelector = '#salud-problemas-container';
  const checkboxSelector = '.problema-salud-checkbox';
  const otroCampoSelector = '.problema-otro-campo';
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

  const getOtroId = () =>
    typeof PROBLEMA_OTRO_ID !== 'undefined' ? parseInt(PROBLEMA_OTRO_ID, 10) : null;

  const resetSelect = ($select) => {
    $select.val(null);
    if ($select.data('select2')) {
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

  const clearOtroCampo = ($otro) => {
    $otro.val('').removeClass('is-invalid').toggleClass('d-none', true).prop('required', false);
    if ($otro[0]) {
      $otro[0].setCustomValidity('');
    }
  };

  const disableRow = ($row) => {
    const $gravedad = $row.find('.problema-gravedad-select');
    const $gravedadWrapper = $row.find('.problema-gravedad-wrapper');
    const $otroCampo = $row.find(otroCampoSelector);

    resetSelect($gravedad);
    $gravedad.prop('disabled', true);
    $gravedadWrapper.addClass('d-none');

    if ($otroCampo.length) {
      clearOtroCampo($otroCampo);
    }
  };

  const enableRow = ($row) => {
    const $gravedad = $row.find('.problema-gravedad-select');
    const $gravedadWrapper = $row.find('.problema-gravedad-wrapper');
    const $otroCampo = $row.find(otroCampoSelector);

    $gravedad.prop('disabled', false);
    $gravedadWrapper.removeClass('d-none');

    if ($otroCampo.length) {
      $otroCampo.toggleClass('d-none', false).prop('required', true);
    }
  };

  const toggleRow = ($checkbox) => {
    const $row = $checkbox.closest('.problema-item');
    if ($checkbox.is(':checked')) {
      enableRow($row);
    } else {
      disableRow($row);
    }
  };

  const toggleProblemas = () => {
    const show = parseInt($(selectorTiene).val(), 10) === 1;
    $(contenedorSelector).toggleClass('d-none', !show);

    if (!show) {
      $(checkboxSelector).each(function () {
        const $cb = $(this);
        if ($cb.is(':checked')) {
          $cb.prop('checked', false);
          disableRow($cb.closest('.problema-item'));
        }
      });
    }
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

  const validateOtroSalud = (event) => {
    const otroId = getOtroId();
    if (!otroId) {
      return true;
    }

    const $row = $(`.problema-item[data-problema-id="${otroId}"]`);
    if (!$row.length) {
      return true;
    }

    const $checkbox = $row.find(checkboxSelector);
    const $otroCampo = $row.find(otroCampoSelector);
    if (!$checkbox.is(':checked')) {
      clearOtroCampo($otroCampo);
      return true;
    }

    const texto = ($otroCampo.val() || '').trim();
    if (!texto) {
      $otroCampo.addClass('is-invalid');
      if ($otroCampo[0]) {
        $otroCampo[0].setCustomValidity('Por favor especifica el problema de salud.');
        $otroCampo[0].reportValidity();
      }
      if (event) {
        event.preventDefault();
        event.stopPropagation();
      }
      return false;
    }

    $otroCampo.removeClass('is-invalid');
    if ($otroCampo[0]) {
      $otroCampo[0].setCustomValidity('');
    }
    return true;
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
    .on('change', selectorTiene, toggleProblemas)
    .on('change', checkboxSelector, function () {
      toggleRow($(this));
      validateOtroSalud();
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
    .on('input', otroCampoSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
    })
    .on('submit', '#expediente-form', function (event) {
      const validOtro = validateOtroSalud(event);
      const validServicios = validateServiciosSalud(event);
      const validAnteojos = validateUsoAnteojos(event);
      const validTratamientos = validateTratamientos(event);
      if (!validOtro || !validServicios || !validAnteojos || !validTratamientos) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

  $(document).ready(() => {
    toggleProblemas();
    toggleServicios();
    toggleAnteojos();
    toggleTratamientos();
    $(checkboxSelector).each(function () {
      toggleRow($(this));
    });
    $(tratamientosListSelector)
      .find(tratamientoCheckboxSelector)
      .each(function () {
        toggleTratamientoDetalle($(this));
      });
    $(tratamientoFrecuenciaSelector).each(function () {
      initSelect2($(this));
    });
    validateOtroSalud();
    validateServiciosSalud();
    validateUsoAnteojos();
    validateTratamientos();
  });
})(jQuery);
