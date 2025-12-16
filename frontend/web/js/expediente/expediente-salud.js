;(function ($) {
  const selectorTiene = '#alumestadosalud-tuvo_problema_salud';
  const contenedorSelector = '#salud-problemas-container';
  const checkboxSelector = '.problema-salud-checkbox';
  const otroCampoSelector = '.problema-otro-campo';

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

  const toggleContenedor = () => {
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

  $(document)
    .on('change', selectorTiene, toggleContenedor)
    .on('change', checkboxSelector, function () {
      toggleRow($(this));
      validateOtroSalud();
    })
    .on('input', otroCampoSelector, function () {
      this.setCustomValidity('');
      $(this).removeClass('is-invalid');
    });

  $(document).ready(() => {
    toggleContenedor();
    $(checkboxSelector).each(function () {
      toggleRow($(this));
    });
    validateOtroSalud();
  });
})(jQuery);
