
    $(document).ready(function () {
        let urbanizacionesData = [];
        const $distritoSelect = $('[data-id="sldistInspRea"]');
        const $zonaUrbanizacionSelect = $('[data-id="slurbInspRea"]');
    
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
                    $('#txtsisco').val(data.Nro_Sisco);
                    $('#daterealiModificar').val(data.Fecha_Inspeccion).trigger('change');
                    $('#txttipo').val(data.Tipo_Inspeccion).trigger('change');
                    $('#txtestado').val(data.Estado).trigger('change');
                    
                    // Primero actualizar el distrito
                    $distritoSelect.val(data.Distritos_id).trigger('change');
                    
                    // Luego actualizar la urbanización
                    setTimeout(() => {
                        actualizarSelectorUrbanizaciones(data.Distritos_id, data.ZonaUrbanizacion);
                    }, 100);
    
                    $('#modalModificarInspeccionRea').modal('show');
                },
                error: function (error) {
                    console.error('Error al obtener datos de inspección:', error);
                }
            });
        });
    
        // Cargar urbanizaciones al inicio
        cargarUrbanizaciones();
    });





    // para la parte de filtrado la version mejorada
   /*  $(document).ready(function () {
        let urbanizacionesData = [];
        const $distritoSelect = $('[data-id="sldistInspRea"]');
        const $zonaUrbanizacionSelect = $('[data-id="slurbInspRea"]');
        const urbanizacionesPorDistrito = {};
    
        // Función para cargar las urbanizaciones
        function cargarUrbanizaciones() {
            return $.ajax({
                url: '/api/lista/urbanizacion',
                type: 'GET',
                dataType: 'json'
            }).then(function (data) {
                urbanizacionesData = data;
                // Preorganizar las urbanizaciones por distrito
                data.forEach(u => {
                    if (!urbanizacionesPorDistrito[u.Nrodistrito]) {
                        urbanizacionesPorDistrito[u.Nrodistrito] = [];
                    }
                    urbanizacionesPorDistrito[u.Nrodistrito].push(u);
                });
                console.log('Urbanizaciones cargadas y organizadas');
            }).fail(function (error) {
                console.error('Error al cargar urbanizaciones:', error);
            });
        }
    
        // Función optimizada para actualizar el selector de urbanizaciones
        function actualizarSelectorUrbanizaciones(distritoId, urbanizacionSeleccionada) {
            const urbanizacionesFiltradas = urbanizacionesPorDistrito[distritoId] || [];
            
            $zonaUrbanizacionSelect.empty();
            
            if (urbanizacionesFiltradas.length > 0) {
                const fragment = document.createDocumentFragment();
                urbanizacionesFiltradas.forEach(u => {
                    fragment.appendChild(new Option(u.nombre_urbanizacion, u.nombre_urbanizacion));
                });
                $zonaUrbanizacionSelect.append(fragment);
    
                if (urbanizacionSeleccionada && urbanizacionesFiltradas.some(u => u.nombre_urbanizacion === urbanizacionSeleccionada)) {
                    $zonaUrbanizacionSelect.val(urbanizacionSeleccionada);
                }
            }
    
            $zonaUrbanizacionSelect.trigger('change');
        }
    
        // Manejar el cambio en el selector de distrito
        $distritoSelect.on('change', function() {
            const distritoSeleccionado = $(this).val();
            actualizarSelectorUrbanizaciones(distritoSeleccionado);
        });
    
        // Cargar urbanizaciones al inicio
        cargarUrbanizaciones();
    
        // ... El resto del código para manejar el clic en el botón de editar, etc.
    }); */

  
