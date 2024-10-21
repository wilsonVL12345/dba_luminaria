

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

  

