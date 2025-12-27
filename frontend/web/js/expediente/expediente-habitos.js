;(function ($) {
  const fumasSelect = '#alumhabitoconsumo-fumas';
  const cigarrosContainer = '#habitos-cigarrillos';
  const cigarrosSelect = '#alumhabitoconsumo-catalogo_cigarros_dia_id';
  const alcoholSelect = '#alumhabitoconsumo-tomas_alcohol';
  const alcoholContainer = '#habitos-alcohol';
  const alcoholFrecuenciaSelect = '#alumhabitoconsumo-frecuencia_veces_semana_id';
  const adiccionesSelect = '#alumhabitoconsumo-tienes_adicciones';
  const adiccionesContainer = '#habitos-adicciones';
  const adiccionesInput = '#alumhabitoconsumo-especificiar_adiccion';

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

  const toggleCigarros = () => {
    const show = parseInt($(fumasSelect).val(), 10) === 1;
    $(cigarrosContainer).toggleClass('d-none', !show);
    $(cigarrosSelect).prop('required', show);
    if (!show) {
      resetSelect($(cigarrosSelect));
    }
  };

  const toggleAlcohol = () => {
    const show = parseInt($(alcoholSelect).val(), 10) === 1;
    $(alcoholContainer).toggleClass('d-none', !show);
    $(alcoholFrecuenciaSelect).prop('required', show);
    if (!show) {
      resetSelect($(alcoholFrecuenciaSelect));
    }
  };

  const toggleAdicciones = () => {
    const show = parseInt($(adiccionesSelect).val(), 10) === 1;
    $(adiccionesContainer).toggleClass('d-none', !show);
    $(adiccionesInput).prop('required', show);
    if (!show) {
      const $input = $(adiccionesInput);
      $input.val('').removeClass('is-invalid');
      if ($input[0]) {
        $input[0].setCustomValidity('');
      }
    }
  };

  const validateSelect = ($field, show, message, event) => {
    if (!show) {
      if ($field[0]) {
        $field.removeClass('is-invalid');
        $field[0].setCustomValidity('');
      }
      return true;
    }

    const hasValue = !!$field.val();
    if (hasValue) {
      if ($field[0]) {
        $field.removeClass('is-invalid');
        $field[0].setCustomValidity('');
      }
      return true;
    }

    if ($field[0]) {
      $field.addClass('is-invalid');
      $field[0].setCustomValidity(message);
      if (event) {
        $field[0].reportValidity();
      }
    }
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    return false;
  };

  const validateAdiccion = (show, event) => {
    const $input = $(adiccionesInput);
    if (!show) {
      $input.removeClass('is-invalid');
      if ($input[0]) {
        $input[0].setCustomValidity('');
      }
      return true;
    }

    const value = ($input.val() || '').toString().trim();
    if (value) {
      if ($input[0]) {
        $input[0].setCustomValidity('');
      }
      $input.removeClass('is-invalid');
      return true;
    }

    if ($input[0]) {
      $input.addClass('is-invalid');
      $input[0].setCustomValidity('Describe la adiccion.');
      if (event) {
        $input[0].reportValidity();
      }
    }
    if (event) {
      event.preventDefault();
      event.stopPropagation();
    }
    return false;
  };

  const validateHabitos = (event) => {
    const showCigarros = parseInt($(fumasSelect).val(), 10) === 1;
    const showAlcohol = parseInt($(alcoholSelect).val(), 10) === 1;
    const showAdicciones = parseInt($(adiccionesSelect).val(), 10) === 1;

    const validCigarros = validateSelect(
      $(cigarrosSelect),
      showCigarros,
      'Indica cuantos cigarros consumes.',
      event
    );
    const validAlcohol = validateSelect(
      $(alcoholFrecuenciaSelect),
      showAlcohol,
      'Indica la frecuencia de consumo.',
      event
    );
    const validAdiccion = validateAdiccion(showAdicciones, event);

    return validCigarros && validAlcohol && validAdiccion;
  };

  $(document)
    .on('change', fumasSelect, () => {
      toggleCigarros();
      validateHabitos();
    })
    .on('change', alcoholSelect, () => {
      toggleAlcohol();
      validateHabitos();
    })
    .on('change', adiccionesSelect, () => {
      toggleAdicciones();
      validateHabitos();
    })
    .on('change', `${cigarrosSelect}, ${alcoholFrecuenciaSelect}`, function () {
      if (this.setCustomValidity) {
        this.setCustomValidity('');
      }
      $(this).removeClass('is-invalid');
      validateHabitos();
    })
    .on('input blur', adiccionesInput, function () {
      if (this.setCustomValidity) {
        this.setCustomValidity('');
      }
      $(this).removeClass('is-invalid');
    })
    .on('submit', '#expediente-form', function (event) {
      if (!validateHabitos(event)) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

  $(document).ready(() => {
    toggleCigarros();
    toggleAlcohol();
    toggleAdicciones();
    validateHabitos();
  });
})(jQuery);
