;(function ($) {
  const participaSelect = '#alumorganizacion-participas_organizacion';
  const container = '#organizaciones-container';
  const checkbox = '.organizacion-checkbox';
  const item = '.organizacion-item';
  const otroContainer = '.organizacion-otro-container';
  const otroInput = '.organizacion-otro-input';

  const clearInputState = ($input) => {
    $input.removeClass('is-invalid');
    if ($input[0]) {
      $input[0].setCustomValidity('');
    }
  };

  const toggleParticipacion = () => {
    const participa = parseInt($(participaSelect).val(), 10) === 1;
    const $checks = $(checkbox);
    const first = $checks.first()[0];

    $(container).toggleClass('d-none', !participa);

    if (!participa) {
      $checks.prop('checked', false);
      $(otroContainer).addClass('d-none');
      $(otroInput).prop('disabled', true).each(function () {
        clearInputState($(this));
        $(this).val('');
      });
      if (first) {
        first.setCustomValidity('');
      }
    }
  };

  const toggleOtro = ($checkbox) => {
    const $row = $checkbox.closest(item);
    const $otro = $row.find(otroContainer);
    const $input = $row.find(otroInput);
    const esOtro =
      String($checkbox.data('es-otro')) === '1' ||
      (window.ORGANIZACION_OTRO_ID &&
        parseInt($checkbox.val(), 10) === parseInt(window.ORGANIZACION_OTRO_ID, 10));

    if (!esOtro || !$otro.length) {
      return;
    }

    const checked = $checkbox.is(':checked');
    $otro.toggleClass('d-none', !checked);
    $input.prop('disabled', !checked);

    if (!checked) {
      clearInputState($input);
      $input.val('');
    }
  };

  const validateOrganizaciones = (event) => {
    const participa = parseInt($(participaSelect).val(), 10) === 1;
    const $checks = $(checkbox);
    const first = $checks.first()[0];

    if (!$checks.length) {
      return true;
    }

    if (!participa) {
      if (first) {
        first.setCustomValidity('');
      }
      $(otroInput).each(function () {
        clearInputState($(this));
      });
      return true;
    }

    const seleccionados = $(`${checkbox}:checked`);
    if (!seleccionados.length) {
      if (first) {
        first.setCustomValidity('Selecciona al menos una organizacion.');
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
      const $chk = $(this);
      const $row = $chk.closest(item);
      const $input = $row.find(otroInput);
      const esOtro =
        String($chk.data('es-otro')) === '1' ||
        (window.ORGANIZACION_OTRO_ID &&
          parseInt($chk.val(), 10) === parseInt(window.ORGANIZACION_OTRO_ID, 10));

      if (!esOtro || !$input.length) {
        clearInputState($input);
        return;
      }

      clearInputState($input);
      const val = ($input.val() || '').trim();
      if (!val) {
        valid = false;
        $input.addClass('is-invalid');
        if ($input[0]) {
          $input[0].setCustomValidity('Especifica la organizacion.');
          if (event) {
            $input[0].reportValidity();
          }
        }
      }
    });

    if (!valid && event) {
      event.preventDefault();
      event.stopPropagation();
    }

    return valid;
  };

  $(document)
    .on('change', participaSelect, () => {
      toggleParticipacion();
      validateOrganizaciones();
    })
    .on('change', checkbox, function () {
      toggleOtro($(this));
      validateOrganizaciones();
    })
    .on('input blur', otroInput, function () {
      clearInputState($(this));
      validateOrganizaciones();
    })
    .on('submit', '#expediente-form', function (event) {
      if (!validateOrganizaciones(event)) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

  $(document).ready(() => {
    toggleParticipacion();
    $(checkbox).each(function () {
      toggleOtro($(this));
    });
    validateOrganizaciones();
  });
})(jQuery);
