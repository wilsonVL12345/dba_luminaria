$(document).ready(function() {
    // Función para verificar y mostrar/ocultar el div para una fila específica
    function checkApoyoCarroCanasta($row) {
        let $select = $row.find('select[name="tetipTrabres[]"]');
        let apoyoSelected = $select.find('option[value="Apoyo Carro Canasta"]').is(':selected');
        $row.find('#apoyo-distritoEspera').toggle(apoyoSelected);
    }

    // Función para inicializar todos los selects
    function initializeAllSelects() {
        $('.row').each(function() {
            checkApoyoCarroCanasta($(this));
        });
    }

    // Inicializar al cargar la página
    initializeAllSelects();

    // Event listener para cambios en cualquier select
    $(document).on('change', 'select[name="tetipTrabres[]"]', function() {
        checkApoyoCarroCanasta($(this).closest('.row'));
    });

    // Reinicializar después de cualquier cambio en el DOM (por si se agregan nuevas filas dinámicamente)
    $(document).on('DOMNodeInserted', function(e) {
        if ($(e.target).find('select[name="tetipTrabres[]"]').length > 0) {
            initializeAllSelects();
        }
    });
});

 // Configurar flatpickr

