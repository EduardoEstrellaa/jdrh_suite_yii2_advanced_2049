$(document).ready(function () {

    let especialidadId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable especialidadId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeEmpresaModal').on('hidden.bs.modal', function (event) {
        especialidadId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-especialidad-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        especialidadId = $(this).data('especialidad-id');

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteProject(especialidadId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteProject (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'especialidad/delete?id=' + id, // Ajusta la URL según tu estructura de rutas
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}