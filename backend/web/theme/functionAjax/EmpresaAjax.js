$(document).ready(function () {

    let empresaId = 0;

    /*=============================================================================================
    //* Evento para limpiar la variable empresaId en caso de cerrar el modal
    =============================================================================================*/
    $('#removeEmpresaModal').on('hidden.bs.modal', function (event) {
        empresaId = 0;
    });

    /*=============================================================================================
    //* Evento para obtener el id del proyecto cuando se abre el modal de confirmacion
    =============================================================================================*/
    $('.delete-empresa-button').on('click', function (event) {

        event.preventDefault(); // Evitar la acción predeterminada del enlace

        empresaId = $(this).data('empresa-id');

    });

    $('#confirmDeleteButton').on('click', function (event) {
        event.preventDefault(); // Evitar la acción predeterminada del enlace
        deleteProject(empresaId);
    });



}); //-----------------------------Fin Ready -------------------------

/*=============================================================================================
//* Funcion para eliminar un registro al hacer click en el boton del modal
=============================================================================================*/

function deleteProject (id) {  
     // Enviar la solicitud AJAX para eliminar el proyecto
     $.ajax({
        url: 'empresa/delete?id=' + id, // Ajusta la URL según tu estructura de rutas
        type: 'POST',
        success: function (response) {
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Manejar errores si es necesario
            console.error('Error:', textStatus, errorThrown);
        }
    });
}