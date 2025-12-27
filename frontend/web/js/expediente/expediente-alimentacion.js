;(function ($) {
  const lugarComerCheckboxSelector = '.lugar-comer-checkbox';
  const lugarComerOtroContainerSelector = '.lugar-comer-otro-container';
  const lugarComerOtroInputSelector = '.lugar-comer-otro-input';
  const consumoListSelector = '#lista-consumo-alimentos';
  const consumoItemSelector = '.consumo-alimento-item';
  const consumoFrecuenciaSelectSelector = '.consumo-frecuencia-select';
  const select2Defaults = {
    theme: 'bootstrap-5',
    width: '100%',
    allowClear: true,
  };

  const initSelect2 = ($select) => {
    if ($select.data('select2')) {
      $select.select2('destroy');
    }
    $select.select2({
      ...select2Defaults,
      placeholder: $select.data('placeholder') || '',
    });
  };

  const findOtroCheckbox = () => {
    const byData = $(`${lugarComerCheckboxSelector}[data-es-otro="1"]`);
    if (byData.length) return byData;
    if (window.LUGAR_COMER_OTRO_ID) {
      const byId = $(`${lugarComerCheckboxSelector}[value="${window.LUGAR_COMER_OTRO_ID}"]`);
      if (byId.length) return byId;
    }
    return $(lugarComerCheckboxSelector).filter((_, el) => ($(el).next('label').text() || '').trim().toLowerCase() === 'otro');
  };

  const toggleLugarComerOtro = () => {
    const $otroCheckbox = findOtroCheckbox();
    const selectedOtros = $otroCheckbox.is(':checked');
    const $container = $(lugarComerOtroContainerSelector);
    const $input = $(lugarComerOtroInputSelector);
    $container.toggleClass('d-none', !selectedOtros);
    $input.prop('disabled', !selectedOtros);
    if (!selectedOtros) {
      $input.val('').removeClass('is-invalid');
      if ($input[0]) {
        $input[0].setCustomValidity('');
      }
    } else if ($input.length) {
      setTimeout(() => $input.trigger('focus'), 0);
    }
  };

  const validateAlimentacion = (event) => {
    let valid = true;

    const $otroCheckbox = findOtroCheckbox();
    const $otroInput = $(lugarComerOtroInputSelector);
    if ($otroCheckbox.length) {
      const otroChecked = $otroCheckbox.is(':checked');
      if (otroChecked) {
        const val = ($otroInput.val() || '').trim();
        $otroInput.removeClass('is-invalid');
        if ($otroInput[0]) $otroInput[0].setCustomValidity('');
        if (!val) {
          valid = false;
          if ($otroInput[0]) {
            $otroInput.addClass('is-invalid');
            $otroInput[0].setCustomValidity('Especifica el lugar donde comes.');
            if (event) $otroInput[0].reportValidity();
          }
        }
      } else if ($otroInput[0]) {
        $otroInput[0].setCustomValidity('');
      }
    }

    $(consumoItemSelector)
      .find(consumoFrecuenciaSelectSelector)
      .each(function () {
        $(this).removeClass('is-invalid');
        if (this.setCustomValidity) this.setCustomValidity('');
      });

    if (!valid && event) {
      event.preventDefault();
      event.stopPropagation();
    }

    return valid;
  };

  $(document)
    .on('change', lugarComerCheckboxSelector, function () {
      toggleLugarComerOtro();
      validateAlimentacion();
    })
    .on('input blur', lugarComerOtroInputSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
      validateAlimentacion();
    })
    .on('submit', '#expediente-form', function (event) {
      validateAlimentacion(event);
    });

  $(document).ready(() => {
    toggleLugarComerOtro();
    validateAlimentacion();
    $(consumoFrecuenciaSelectSelector).each(function () {
      initSelect2($(this));
    });
  });
})(jQuery);
