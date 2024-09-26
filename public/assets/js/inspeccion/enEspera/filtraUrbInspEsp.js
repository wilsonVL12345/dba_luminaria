/* $(document).ready(function () {
    const $distritoSelect = $('[data-id="txtdistirtoo"]');
    const $zonaUrbanizacionSelect = $('[data-id="txturbs"]');
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




$(document).ready(function () {
    const $distritoSelect = $('[data-id="sldistInspEsp"]');
    const $zonaUrbanizacionSelect = $('[data-id="slurbInspEsp"]');
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
    });  */

    $(document).ready(function () {
        let urbanizacionesData = [];
        const $distritoSelect = $('[data-id="sldistInspEsp"]');
        const $zonaUrbanizacionSelect = $('[data-id="slurbInspEsp"]');
    
        // Función para cargar las urbanizaciones
        function cargarUrbanizaciones() {
            return $.ajax({
                url: '/api/lista/urbanizacion',
                type: 'GET',
                dataType: 'json'
            }).then(function (data) {
                urbanizacionesData = data;
                console.log('Urbanizaciones cargadas:', data);
            }).fail(function (error) {
                console.error('Error al cargar urbanizaciones:', error);
            });
        }
    
        // Función para actualizar el selector de urbanizaciones
        function actualizarSelectorUrbanizaciones(distritoId, urbanizacionSeleccionada) {
            $zonaUrbanizacionSelect.empty();
            const urbanizacionesFiltradas = urbanizacionesData.filter(u => u.Nrodistrito == distritoId);
            
            urbanizacionesFiltradas.forEach(u => {
                $zonaUrbanizacionSelect.append(new Option(u.nombre_urbanizacion, u.nombre_urbanizacion));
            });
    
            if (urbanizacionSeleccionada && urbanizacionesFiltradas.some(u => u.nombre_urbanizacion === urbanizacionSeleccionada)) {
                $zonaUrbanizacionSelect.val(urbanizacionSeleccionada);
            }
    
            $zonaUrbanizacionSelect.trigger('change');
        }
    
        // Manejar el cambio en el selector de distrito
        $distritoSelect.on('change', function() {
            const distritoSeleccionado = $(this).val();
            actualizarSelectorUrbanizaciones(distritoSeleccionado);
        });
    
        // Manejar el clic en el botón de editar
        $(document).on('click', '.edit-buttoninsperealmod', function () {
            const equipamientoId = $(this).data('id');
            
            $.ajax({
                url: '/editDatos/inspeccion' + equipamientoId,
                method: 'GET',
                success: function (data) {
                    $('#textidEsp').val(data.id);
                    $('#txtsiscoEspeM').val(data.Nro_Sisco);
                    $('#txtfechaEspMod').val(data.Fecha_Inspeccion);
                    
                    
                    // Primero actualizar el distrito
                    $distritoSelect.val(data.Distritos_id).trigger('change');
                    
                    // Luego actualizar la urbanización
                    setTimeout(() => {
                        actualizarSelectorUrbanizaciones(data.Distritos_id, data.ZonaUrbanizacion);
                    }, 100);
    
                    $('#modalModificarInspeccion').modal('show');
                },
                error: function (error) {
                    console.error('Error al obtener datos de inspección:', error);
                }
            });
        });
    
        // Cargar urbanizaciones al inicio
        cargarUrbanizaciones();
    });


