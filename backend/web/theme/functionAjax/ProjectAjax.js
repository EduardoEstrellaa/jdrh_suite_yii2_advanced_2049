$(document).ready(function () {

    let projectId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable projectId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeProjectModal').on('hidden.bs.modal', function (event) {
        projectId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-project-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        projectId = $(this).data('project-id');

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteProject(projectId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteProject (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'proyecto/delete?id=' + id, // Ajusta la URL según tu estructura de rutas
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}