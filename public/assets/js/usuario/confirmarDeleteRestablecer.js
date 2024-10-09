
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
// Delegación de eventos para restablecer la contraseña de usuarios
document.addEventListener('click', function(event) {
    // Verifica si el clic fue en un enlace con la clase "reset-password-link"
    if (event.target.closest('.reset-password-link')) {
        event.preventDefault(); // Prevenir que el enlace se ejecute inmediatamente
        
        const link = event.target.closest('.reset-password-link'); // Obtener el enlace de restablecimiento de contraseña

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
                // Si se confirma, redirige a la URL de restablecimiento de contraseña
                window.location.href = link.getAttribute('href');
            }
        });
    }
});
// para emvio de formularios 

   // Delegación de eventos para el botón de registro
document.addEventListener('click', function(event) {
    // Verifica si el clic fue en el botón con la clase "registers-link"
    if (event.target.closest('.registers-link')) {
        event.preventDefault(); // Prevenir el envío inmediato del formulario

        const form = document.querySelector('form'); // Selecciona el formulario que deseas enviar

        // Muestra la alerta de confirmación
        Swal.fire({
            
            text: "¿Estás seguro que deseas Registrar Estos Datos?",
            icon: "warning", // Cambié a warning para una alerta más apropiada
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Sí, Registrar",
            cancelButtonText: "No, cancelar",
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-secondary"
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Si se confirma, envía el formulario
                form.submit();
            }
        });
    }
});



