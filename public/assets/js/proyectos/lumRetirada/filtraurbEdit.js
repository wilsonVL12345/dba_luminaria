$(document).ready(function () {
    const $distritoSelect = $('[data-id="txtdistritoMod"]');
    const $zonaUrbanizacionSelect = $('[data-id="txtzonaMod"]');

    $.ajax({
        url: '/api/apidistritos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            function actualizarZonasUrbanizaciones() {
                const distritoSeleccionado = $distritoSelect.val();
                // $zonaUrbanizacionSelect.empty().append('<option value="">Seleccione...</option>');

                const zonasUrbanizaciones = data.filter(item => item.Nrodistrito == distritoSeleccionado);

                $.each(zonasUrbanizaciones, function (index, item) {
                    $zonaUrbanizacionSelect.append(`<option value="${item.nombre_urbanizacion}">${item.nombre_urbanizacion}</option>`);
                });

                // Actualizar select2 después de modificar las opciones
                $zonaUrbanizacionSelect.select2();
            }

            $distritoSelect.on('change', actualizarZonasUrbanizaciones);
            actualizarZonasUrbanizaciones(); // Inicializar las zonas/urbanizaciones al cargar la página
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos de los distritos:', error);
        }
    });
});