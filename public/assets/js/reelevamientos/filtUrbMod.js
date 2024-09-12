/* 
$(document).ready(function () {
    const $distritoSelect = $('[data-id="reeDistritoRegisMod"]');
    const $zonaUrbanizacionSelect = $('[data-id="reeUrbanizacionRegisMod"]');
     $.ajax({
        url: '/api/lista/urbanizacion',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data,'se encontro modifi aaa')
            function actualizarZonasUrbanizaciones() {
                const distritoSeleccionado = $distritoSelect.val();

                const zonasUrbanizaciones = data.filter(items => items.Nrodistrito == distritoSeleccionado);

                $.each(zonasUrbanizaciones, function (index, items) {
                    $zonaUrbanizacionSelect.append(`<option value="${items.id}">${items.nombre_urbanizacion}</option>`);
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
    });  */

    $(document).ready(function () {
        const $distritoSelect = $('[data-id="reeDistritoRegisMod"]');
        const $zonaUrbanizacionSelect = $('[data-id="reeUrbanizacionRegisMod"]');
    
        $.ajax({
            url: '/api/lista/urbanizacion',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data, 'se encontró modifi aaa');
    
                function actualizarZonasUrbanizaciones() {
                    const distritoSeleccionado = $distritoSelect.val();
                    
                    // Limpiar opciones previas
    
                    const zonasUrbanizaciones = data.filter(items => items.Nrodistrito == distritoSeleccionado);
    
                    $.each(zonasUrbanizaciones, function (index, items) {
                        $zonaUrbanizacionSelect.append(`<option value="${items.id}">${items.nombre_urbanizacion}</option>`);
                    });
    
                    // Actualizar select2 después de modificar las opciones
                    $zonaUrbanizacionSelect.select2();
                }
    
                // Actualizar urbanizaciones cuando se cambia el distrito
                $distritoSelect.on('change', actualizarZonasUrbanizaciones);
    
                // Inicializar urbanizaciones al cargar la página
                actualizarZonasUrbanizaciones(); 
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener los datos de los distritos:', error);
            }
        });
    });
    