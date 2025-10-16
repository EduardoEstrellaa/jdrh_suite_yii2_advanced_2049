$(document).ready(function () {

    let asesorId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable asesorId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeAsesorModal').on('hidden.bs.modal', function (event) {
        asesorId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-asesor-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        asesorId = $(this).data('asesor-id');

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteProject(asesorId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteProject (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'asesor-externo/delete?id=' + id, // Ajusta la URL según tu estructura de rutas
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}