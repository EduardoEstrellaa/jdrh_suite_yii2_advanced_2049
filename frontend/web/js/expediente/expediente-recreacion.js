;(function ($) {
  const sabeSelect = '#alumrecreaciontiempo-sabes_usar_internet';
  const accesoSelect = '#alumrecreaciontiempo-tienes_acceso_internet';
  const lugarSelect = '#alumrecreaciontiempo-catalogo_lugares_acceso_principal_id';
  const lugarContainer = '#recreacion-lugar-acceso';
  const usosContainer = '#recreacion-usos';
  const usosCheckbox = '.recreacion-uso-checkbox';

  const clearValidity = ($el) => {
    if ($el[0]) {
      $el[0].setCustomValidity('');
    }
    $el.removeClass('is-invalid');
  };

  const resetSelect = ($select) => {
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

  const toggleAccessFields = () => {
    const tieneAcceso = parseInt($(accesoSelect).val(), 10) === 1;
    $(lugarContainer).toggleClass('d-none', !tieneAcceso);
    $(lugarSelect).prop('required', tieneAcceso);
    if (!tieneAcceso) {
      resetSelect($(lugarSelect));
    }
    toggleUsos();
  };

  const toggleUsos = () => {
    const sabeUsar = parseInt($(sabeSelect).val(), 10) === 1;
    const showUsos = sabeUsar;

    $(usosContainer).toggleClass('d-none', !showUsos);
    $(usosCheckbox).prop('disabled', !showUsos);

    if (!showUsos) {
      $(usosCheckbox).prop('checked', false).removeClass('is-invalid');
    }
  };

  const validateSelectRequired = (selector, message, event) => {
    const $select = $(selector);
    const hasValue = $select.val() !== null && $select.val() !== '';
    if (hasValue) {
      clearValidity($select);
      return true;
    }
    if (event) {
      $select.addClass('is-invalid');
      if ($select[0]) {
        $select[0].setCustomValidity(message);
        $select[0].reportValidity();
      }
      event.preventDefault();
      event.stopPropagation();
    }
    return false;
  };

  const validateLugar = (show, event) => {
    const $select = $(lugarSelect);
    const shouldMarkInvalid = !!event;

    if (!show) {
      clearValidity($select);
      return true;
    }
    const hasValue = !!$select.val();
    if (hasValue) {
      clearValidity($select);
      return true;
    }

    if ($select[0] && shouldMarkInvalid) {
      $select.addClass('is-invalid');
      $select[0].setCustomValidity('Selecciona tu lugar principal de acceso.');
      if (event) {
        $select[0].reportValidity();
      }
    }
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    return false;
  };

  const validateUsos = (show, event) => {
    const $checks = $(usosCheckbox);
    const shouldMarkInvalid = !!event;

    if (!show) {
      $checks.removeClass('is-invalid');
      return true;
    }

    const checked = $checks.is(':checked');
    if (checked) {
      $checks.removeClass('is-invalid');
      return true;
    }

    if (shouldMarkInvalid) {
      $checks.addClass('is-invalid');
      event.preventDefault();
      event.stopPropagation();
    }

    return false;
  };

  const validateRecreacion = (event) => {
    const tieneAcceso = parseInt($(accesoSelect).val(), 10) === 1;
    const sabeUsar = parseInt($(sabeSelect).val(), 10) === 1;
    const showUsos = sabeUsar;

    const validSabe = validateSelectRequired(sabeSelect, 'Selecciona si sabes usar internet.', event);
    const validAcceso = validateSelectRequired(accesoSelect, 'Selecciona si tienes acceso a internet.', event);
    const validLugar = validateLugar(tieneAcceso, event);
    const validUsos = validateUsos(showUsos, event);

    return validSabe && validAcceso && validLugar && validUsos;
  };

  $(document)
    .on('change', `${accesoSelect}, ${sabeSelect}`, () => {
      toggleAccessFields();
      validateRecreacion();
    })
    .on('change', lugarSelect, function () {
      if (this.setCustomValidity) {
        this.setCustomValidity('');
      }
      $(this).removeClass('is-invalid');
    })
    .on('change', `${sabeSelect}, ${accesoSelect}`, function () {
      clearValidity($(this));
    })
    .on('change', usosCheckbox, function () {
      $(this).removeClass('is-invalid');
    })
    .on('submit', '#expediente-form', function (event) {
      if (!validateRecreacion(event)) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

  $(document).ready(() => {
    toggleAccessFields();
    validateRecreacion();
  });
})(jQuery);
