//  confirmar para eliminar usuarios
document.addEventListener("DOMContentLoaded", function() {
    // Delegación de eventos para eliminar usuarios
    document.addEventListener('click', function(event) {
        // Verifica si el clic fue en un enlace con la clase "delete-link"
        if (event.target.closest('.delete-link')) {
            event.preventDefault(); // Prevenir que el enlace se ejecute inmediatamente
            
            const link = event.target.closest('.delete-link'); // Obtener el enlace de eliminación

            // Muestra la alerta de confirmación
            Swal.fire({
                text: "¿Estás seguro que deseas eliminar?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "No, cancelar",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, redirige a la URL de eliminación
                    window.location.href = link.getAttribute('href');
                }
            });
        }
    });

});