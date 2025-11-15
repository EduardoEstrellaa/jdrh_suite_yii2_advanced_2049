// ============================
// expediente-tutores.js (versión corregida)
// ============================

// IDs de los campos
const ID_ENTIDAD_NACIMIENTO = 'lugaresnacimiento-entidades_federativas_id';
const ID_MUNICIPIO_NACIMIENTO = 'lugaresnacimiento-municipios_id';
const ID_ENTIDAD_DOMICILIO = 'domiciliosactuales-entidades_federativas_id';
const ID_MUNICIPIO_DOMICILIO = 'domiciliosactuales-municipios_id';

// Configurar eventos al seleccionar una entidad federativa
function configurarEntidadFederativa(entidadId, municipioId, tipo) {
    $(document).on('select2:select', '#' + entidadId, function (e) {
        const estadoId = e.params.data.id;
        $('#' + municipioId).prop('disabled', false);
        cargarMunicipios(estadoId, municipioId, tipo);
        habilitarLocalidadPorTipo(tipo, true);
    });

    $(document).on('select2:unselect change', '#' + entidadId, function () {
        const val = $(this).val();
        if (!val) {
            $('#' + municipioId)
                .empty()
                .append('<option value="">Selecciona municipio...</option>')
                .prop('disabled', true)
                .trigger('change.select2');
            habilitarLocalidadPorTipo(tipo, false);
        }
    });
}

// Cargar municipios por AJAX
function cargarMunicipios(estadoId, municipioId, tipo) {
    $.ajax({
        url: window.MUNICIPIOS_URL,
        type: 'GET',
        data: { estado_id: estadoId },
        success: function (municipios) {
            const municipioSelect = $('#' + municipioId);
            const currentValue = municipioSelect.val(); // Guardar valor actual

            municipioSelect.empty();
            municipioSelect.append('<option value="">Selecciona municipio...</option>');
            $.each(municipios, function (id, nombre) {
                municipioSelect.append('<option value="' + id + '">' + nombre + '</option>');
            });

            // Restaurar valor anterior si existe
            if (currentValue) {
                municipioSelect.val(currentValue).trigger('change');
            }

            municipioSelect.prop('disabled', false);
            municipioSelect.trigger('change.select2');
        }
    });
}

// Habilitar o deshabilitar campo de localidad según tipo
function habilitarLocalidadPorTipo(tipo, habilitar) {
    if (tipo === 'Lugar de Nacimiento') {
        $('#lugaresnacimiento-localidad').prop('disabled', !habilitar);
    } else if (tipo === 'Domicilio Actual') {
        $('#domiciliosactuales-localidad').prop('disabled', !habilitar);
    }
}

// Verificar estado inicial de los campos
function verificarEstadoInicial() {
    // Para lugar de nacimiento
    const entidadNacimiento = $('#' + ID_ENTIDAD_NACIMIENTO).val();
    const municipioNacimiento = $('#' + ID_MUNICIPIO_NACIMIENTO).val();

    if (entidadNacimiento && municipioNacimiento) {
        $('#' + ID_MUNICIPIO_NACIMIENTO).prop('disabled', false);
        habilitarLocalidadPorTipo('Lugar de Nacimiento', true);

        // Cargar municipios para la entidad seleccionada
        cargarMunicipios(entidadNacimiento, ID_MUNICIPIO_NACIMIENTO, 'Lugar de Nacimiento');
    }

    // Para domicilio actual
    const entidadDomicilio = $('#' + ID_ENTIDAD_DOMICILIO).val();
    const municipioDomicilio = $('#' + ID_MUNICIPIO_DOMICILIO).val();

    if (entidadDomicilio && municipioDomicilio) {
        $('#' + ID_MUNICIPIO_DOMICILIO).prop('disabled', false);
        habilitarLocalidadPorTipo('Domicilio Actual', true);

        // Cargar municipios para la entidad seleccionada
        cargarMunicipios(entidadDomicilio, ID_MUNICIPIO_DOMICILIO, 'Domicilio Actual');
    }
}

// Inicializar al cargar el documento
$(document).ready(function () {
    if (typeof window.MUNICIPIOS_URL === 'undefined' || !window.MUNICIPIOS_URL) {
        return;
    }

    // Verificar estado inicial antes de deshabilitar
    verificarEstadoInicial();

    // Solo deshabilitar si no tienen valor
    if (!$('#' + ID_MUNICIPIO_NACIMIENTO).val()) {
        $('#' + ID_MUNICIPIO_NACIMIENTO).prop('disabled', true).trigger('change.select2');
    }

    if (!$('#' + ID_MUNICIPIO_DOMICILIO).val()) {
        $('#' + ID_MUNICIPIO_DOMICILIO).prop('disabled', true).trigger('change.select2');
    }

    configurarEntidadFederativa(ID_ENTIDAD_NACIMIENTO, ID_MUNICIPIO_NACIMIENTO, 'Lugar de Nacimiento');
    configurarEntidadFederativa(ID_ENTIDAD_DOMICILIO, ID_MUNICIPIO_DOMICILIO, 'Domicilio Actual');
});