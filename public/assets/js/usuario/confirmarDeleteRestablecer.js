// para la parte de confirmar la eliminacion de usuarios
document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los enlaces con la clase "delete-link"
    const deleteLinks = document.querySelectorAll('.delete-link');

    deleteLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault();  // Prevenir que el enlace se ejecute inmediatamente

            // Muestra la alerta de confirmación
            Swal.fire({
                text: "¿Estás seguro que deseas eliminar ?",
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
        });
    });
});

// para la parte de confirmar el reestablecimiento de contraseña  de usuarios
document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los enlaces con la clase "delete-link"
    const deleteLinks = document.querySelectorAll('.reset-password-link');

    deleteLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault();  // Prevenir que el enlace se ejecute inmediatamente

            // Muestra la alerta de confirmación
            Swal.fire({
                text: "¿Estás seguro de que deseas Restablecer la contraseña de este usuario?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Sí, Restablecer",
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
        });
    });
});