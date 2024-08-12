
    $(document).ready(function () {
        const $distritoSelect = $('[data-id="sldistrimodi"]');
        const $zonaUrbanizacionSelect = $('[data-id="txtzonaurb"]');
        const $zonaSeleccionada = "{{ $itemEspera->Zona }}"; 
         $.ajax({
            url: '/api/lista/urbanizacion',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data,'se encontro')
                function actualizarZonasUrbanizaciones() {
                    const distritoSeleccionado = $distritoSelect.val();
    
                    const zonasUrbanizaciones = data.filter(items => items.Nrodistrito == distritoSeleccionado);
    
                    $.each(zonasUrbanizaciones, function (index, items) {
                        $zonaUrbanizacionSelect.append(`<option value="${items.nombre_urbanizacion}">${items.nombre_urbanizacion}</option>`);
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
    