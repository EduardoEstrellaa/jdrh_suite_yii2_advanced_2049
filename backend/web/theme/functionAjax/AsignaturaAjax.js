$(document).ready(function () {

    $('#SwitchEstado').on('change', function () {

        //Se almacena el input switch en una variable
        let $switch = $(this);
        //ALmacena el id del switch en otra variable accediendo desde la variable donde se almaceno el switch
        let id = $switch.data('asignatura-id');
        //Actualiza la variable estado en caso si tiene el atributo checked
        let status = $switch.is(":checked");
        //Valida si tiene el atributo checked accediendo desde la variable donde se almaceno, y en dado caso muestra un mensaje diferente en la alerta
        let message = status ? '¿Estás seguro de habilitar la asignatura?' : '¿Estás seguro de deshabilitar la asignatura?';

        //Llamada de la funcion que muestra el mensjase, pasandole la variable con el mensjase que se desea mostrar y un funcion callback para confirmar si se hace la actualizacion del status o no en la base de datos
        confirmationMessage(message, function (confirmed) {
            if (confirmed) {
                updateStutus(id, status);
            } else {
                $switch.prop('checked', !status);
            }
        });
    });
});

function confirmationMessage(message, callback) {
    Swal.fire({
        html: '<div class="mt-3">' +
            '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
            '<div class="mt-4 pt-2 fs-15 mx-5">' +
            '<h4>¿Estás seguro?</h4>' +
            `<p class="text-muted mx-4 mb-0">${message}</p>` +
            '</div>' +
            '</div>',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar',
        cancelButtonClass: 'btn btn-danger w-xs mb-1',
        buttonsStyling: false,
        showCloseButton: true
    }).then((result) => {
        callback(result.isConfirmed);
    });
}
/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function updateEstado(id, estado) {
    $.ajax({
        url: 'asignatura/updateStatus',
        type: 'POST',
        data: {
            id: id,
            estado: estado ? 1 : 0,
        },
        success: function(response) {
            if (response.success) {
                alert('Estado actualizado correctamente');
            } else {
                alert('Error al actualizar el estado');
            }
        },
        error: function() {
            alert('Error en la petición');
        }
    });
}