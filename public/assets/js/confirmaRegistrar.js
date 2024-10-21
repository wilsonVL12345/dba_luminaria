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

