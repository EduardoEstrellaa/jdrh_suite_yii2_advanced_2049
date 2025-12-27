;(function ($) {
  const selectorDeportes = '#alumdeportes-practicas_algun_deporte';
  const selectorEjercicio = '#alumejercicio-haces_ejercicio_fisico';
  const deportesContainer = '#actividad-deportes-container';
  const ejercicioContainer = '#actividad-ejercicio-container';
  const deporteCheckbox = '.deporte-checkbox';
  const ejercicioCheckbox = '.ejercicio-checkbox';
  const ejercicioItem = '.ejercicio-item';
  const ejercicioDetalle = '.ejercicio-detalle';
  const ejercicioFrecuencia = '.ejercicio-frecuencia';

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

  const toggleDeportes = () => {
    const show = parseInt($(selectorDeportes).val(), 10) === 1;
    $(deportesContainer).toggleClass('d-none', !show);
    const $checkboxes = $(deporteCheckbox);
    const first = $checkboxes.first()[0];

    if (!show) {
      $checkboxes.prop('checked', false);
      if (first) {
        first.setCustomValidity('');
      }
    }
  };

  const toggleEjercicio = () => {
    const show = parseInt($(selectorEjercicio).val(), 10) === 1;
    $(ejercicioContainer).toggleClass('d-none', !show);
    const $checkboxes = $(ejercicioCheckbox);
    const $frecuencias = $(ejercicioFrecuencia);
    const first = $checkboxes.first()[0];

    if (!show) {
      $checkboxes.prop('checked', false);
      $frecuencias.each(function () {
        resetSelect($(this));
        $(this).prop('required', false).prop('disabled', true);
      });
      $(ejercicioDetalle).addClass('d-none');
      if (first) {
        first.setCustomValidity('');
      }
    }
  };

  const toggleEjercicioDetalle = ($checkbox) => {
    const $row = $checkbox.closest(ejercicioItem);
    const $detalle = $row.find(ejercicioDetalle);
    const $frecuencia = $row.find(ejercicioFrecuencia);
    const checked = $checkbox.is(':checked');

    $detalle.toggleClass('d-none', !checked);
    $frecuencia.prop('required', checked).prop('disabled', !checked);

    if (!checked) {
      resetSelect($frecuencia);
    }
  };

  const validateDeportes = (event) => {
    const show = parseInt($(selectorDeportes).val(), 10) === 1;
    const $checkboxes = $(deporteCheckbox);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      return true;
    }

    const hasSelection = $(deporteCheckbox + ':checked').length > 0;
    if (!hasSelection) {
      if (first) {
        first.setCustomValidity('Selecciona al menos un deporte.');
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

  const validateEjercicio = (event) => {
    const show = parseInt($(selectorEjercicio).val(), 10) === 1;
    const $checkboxes = $(ejercicioCheckbox);
    const first = $checkboxes.first()[0];

    if (!show) {
      if (first) {
        first.setCustomValidity('');
      }
      $(ejercicioFrecuencia).each(function () {
        this.setCustomValidity && this.setCustomValidity('');
        $(this).removeClass('is-invalid');
      });
      return true;
    }

    const seleccionados = $(ejercicioCheckbox + ':checked');
    if (!seleccionados.length) {
      if (first) {
        first.setCustomValidity('Selecciona al menos una actividad fisica.');
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
      const $row = $(this).closest(ejercicioItem);
      const $frecuencia = $row.find(ejercicioFrecuencia);

      $frecuencia.removeClass('is-invalid');
      if ($frecuencia[0]) {
        $frecuencia[0].setCustomValidity('');
      }

      if (!$frecuencia.val()) {
        valid = false;
        if ($frecuencia[0]) {
          $frecuencia.addClass('is-invalid');
          $frecuencia[0].setCustomValidity('Indica la frecuencia semanal.');
          if (event) {
            $frecuencia[0].reportValidity();
          }
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

  $(document)
    .on('change', selectorDeportes, () => {
      toggleDeportes();
      validateDeportes();
    })
    .on('change', selectorEjercicio, () => {
      toggleEjercicio();
      validateEjercicio();
    })
    .on('change', deporteCheckbox, function () {
      validateDeportes();
    })
    .on('change', ejercicioCheckbox, function () {
      toggleEjercicioDetalle($(this));
      validateEjercicio();
    })
    .on('change', ejercicioFrecuencia, function () {
      this.setCustomValidity && this.setCustomValidity('');
      $(this).removeClass('is-invalid');
      validateEjercicio();
    })
    .on('submit', '#expediente-form', function (event) {
      const validDeportes = validateDeportes(event);
      const validEjercicio = validateEjercicio(event);
      if (!validDeportes || !validEjercicio) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

  $(document).ready(() => {
    toggleDeportes();
    toggleEjercicio();
    $(ejercicioCheckbox).each(function () {
      toggleEjercicioDetalle($(this));
    });
    validateDeportes();
    validateEjercicio();
  });
})(jQuery);
