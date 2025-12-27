;(function ($) {
  const sabeSelect = '#alumrecreaciontiempo-sabes_usar_internet';
  const accesoSelect = '#alumrecreaciontiempo-tienes_acceso_internet';
  const lugarSelect = '#alumrecreaciontiempo-catalogo_lugares_acceso_principal_id';
  const lugarContainer = '#recreacion-lugar-acceso';
  const usosContainer = '#recreacion-usos';
  const usosCheckbox = '.recreacion-uso-checkbox';

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
    const tieneAcceso = parseInt($(accesoSelect).val(), 10) === 1;
    const sabeUsar = parseInt($(sabeSelect).val(), 10) === 1;
    const showUsos = tieneAcceso && sabeUsar;

    $(usosContainer).toggleClass('d-none', !showUsos);
    $(usosCheckbox).prop('disabled', !showUsos);

    if (!showUsos) {
      $(usosCheckbox).prop('checked', false).removeClass('is-invalid');
    }
  };

  const validateLugar = (show, event) => {
    const $select = $(lugarSelect);
    const shouldMarkInvalid = !!event;

    if (!show) {
      if ($select[0]) {
        $select[0].setCustomValidity('');
      }
      $select.removeClass('is-invalid');
      return true;
    }
    const hasValue = !!$select.val();
    if (hasValue) {
      if ($select[0]) {
        $select[0].setCustomValidity('');
      }
      $select.removeClass('is-invalid');
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
    const showUsos = tieneAcceso && sabeUsar;

    const validLugar = validateLugar(tieneAcceso, event);
    const validUsos = validateUsos(showUsos, event);

    return validLugar && validUsos;
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
