// para la parte de realizar trabajo(ejecutar trabajo) de  la parte de mantenimiento
let fpEjecutartraDet = flatpickr("#txtfechaejecut", 
    {
        minDate: new Date().setDate(new Date().getDate() - 7),

        "disable": [
        function(date) {
            // return true to disable
            return (date.getDay() === 0 || date.getDay() === 6);

        }
    ],
    "locale": {
        "firstDayOfWeek": 1 // start week on Monday
    }
    });

// para la parte de agendar trabajo-----------------------------------------------------
// Obtener la fecha actual
let fechaActual = new Date();

// Sumar 3 meses a la fecha actual
fechaActual.setMonth(fechaActual.getMonth() + 3);

// Formatear la fecha en formato YYYY-MM-DD y guardarla en una variable

let dia = ("0" + fechaActual.getDate()).slice(-2);
let mes = ("0" + (fechaActual.getMonth() + 1)).slice(-2); // Los meses van de 0 a 11, por eso sumamos 1
let anio = fechaActual.getFullYear();

let fechaFormateada = `${anio}-${mes}-${dia}`;

// Mostrar la fecha resultante

let variableFechasString='';



$(document).ready(function () {
    const $distritoSelect = $('#txtdistirtoAgen');
    let fechasDistrito = [];
    let flatpickrInstance;

    $.ajax({
        url: '/api/fechas/trabajo',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            fechasDistrito = data.map(function(item) {
                return {
                    fecha: moment(item.Fecha_Programado).format('YYYY-MM-DD'),
                    distritoId: item.Distritos_id
                };
            });

            function actualizarCalendario() {
                const distritoSeleccionado = parseInt($distritoSelect.val());

                let fechasFiltradas = fechasDistrito.filter(item => item.distritoId === distritoSeleccionado)
                                                   .map(item => item.fecha);

                if (flatpickrInstance) {
                    flatpickrInstance.destroy();
                }

                flatpickrInstance = flatpickr("#txtfechaprogramada", {
                    minDate: "today",
                    maxDate: new Date().fp_incr(365), // Un año desde hoy como máximo
                    "disable": [
                        function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);
                        }
                    ],
                    "locale": {
                        "firstDayOfWeek": 1
                    },
                    dateFormat: "Y-m-d",
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        const date = dayElem.dateObj.toISOString().slice(0, 10);
                        if (fechasFiltradas.includes(date)) {
                            dayElem.classList.add('highlighted');
                        }
                    },
                    onChange: function(selectedDates, dateStr, instance) {
                        if (fechasFiltradas.includes(dateStr)) {
                            alert("Has seleccionado una fecha destacada: " + dateStr);
                        }
                    }
                });

            }

            $distritoSelect.on('change', actualizarCalendario);
            actualizarCalendario(); // Inicializar el calendario al cargar la página
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener las fechas de trabajo:', error);
        }
    });
});
//fecha detalles  espera rango tabla-----------------------------------------


let rangoespera = flatpickr("#rangoFechaDetallEspera", 
    {
        
            mode: "range",
            dateFormat: "Y-m-d",
        
    }
 );
//fecha detalles  espera editar-----------------------------------------
 let fps = flatpickr("#txtfechaprogramadaedit", 
    {
        minDate: "2024-08",
            maxDate: fechaFormateada,

        "disable": [
            function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 6);
    
            }
        ],
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        }
    }
 );
// para la parte de rango de fechas en tabla realizado--------------------------------------------------------
// Función para inicializar el filtro de fechas para una tabla específica
/* $(document).ready(function() {
    // Verificar si la tabla ya ha sido inicializada como DataTable
    let datatable;
    if ($.fn.DataTable.isDataTable('#detalleRealizado')) {
        datatable = $('#detalleRealizado').DataTable();
    } else {
        // Inicializar DataTable si aún no se ha hecho
        datatable = $('#detalleRealizado').DataTable({
            // ... tus opciones actuales de DataTable ...
            "drawCallback": function(settings) {
                // Reinicializar los menús de KTMenu si es necesario
                KTMenu.createInstances();
            }
        });
    }

    // Inicializar Flatpickr
    flatpickr("#rangoFechaDetallRealizado", {
        mode: "range",
        dateFormat: "Y-m-d",
        onClose: function(selectedDates, dateStr, instance) {
            // Cuando se cierra el selector de fechas, aplicamos el filtro
            aplicarFiltroFechas();
        }
    });

    // Función para aplicar el filtro de fechas
    function aplicarFiltroFechas() {
        let fechas = $('#rangoFechaDetallRealizado').val().split(" to ");
        let fechaInicio = fechas[0] ? moment(fechas[0]) : null;
        let fechaFin = fechas[1] ? moment(fechas[1]) : null;

        datatable.draw();
    }

    // Agregar el filtro personalizado a DataTables
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            let fechas = $('#rangoFechaDetallRealizado').val().split(" to ");
            let fechaInicio = fechas[0] ? moment(fechas[0]) : null;
            let fechaFin = fechas[1] ? moment(fechas[1]) : null;
            let fechaFila = moment(data[4]); // Asumiendo que la fecha está en la tercera columna

            if (fechaInicio && fechaFin) {
                return fechaFila.isBetween(fechaInicio, fechaFin, null, '[]');
            } else if (fechaInicio) {
                return fechaFila.isSameOrAfter(fechaInicio);
            } else if (fechaFin) {
                return fechaFila.isSameOrBefore(fechaFin);
            }
            return true;
        }
    );

    // Evento para aplicar el filtro manualmente si es necesario
    $('#aplicarFiltro').on('click', function() {
        aplicarFiltroFechas();
    });
}); */
 
//fecha detalles  realizados editar-----------------------------------------

 let fpdetallRalizado = flatpickr("#dtFechaAtenr", 
    {
        minDate: "2024-08",
            maxDate: fechaFormateada,

        "disable": [
            function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 6);
    
            }
        ],
        "locale": {
            "firstDayOfWeek": 1 // start week on Monday
        }
    }
 );

 // para la parte de proyectos almacen registro de proyectos-----------------------------
let proyAlmacen = flatpickr("#dtfecha", 
    {
        minDate: new Date().setDate(new Date().getDate() - 7),

        maxDate: fechaFormateada,
        "disable": [
        function(date) {
            // return true to disable
            return (date.getDay() === 0 || date.getDay() === 6);

        }
    ],
    "locale": {
        "firstDayOfWeek": 1 // start week on Monday
    }
    });
    // para la parte de proyecto  modificar----------------------------------------------------
    let proyAlmacenedit = flatpickr("#txtfechaEsp", 
        {
            minDate: "2024-08",
                maxDate: fechaFormateada,

            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });
        let proyAlmacenEjecutar = flatpickr("#txtfechaInst", 
            {
                minDate: new Date().setDate(new Date().getDate() - 7),

                maxDate: fechaFormateada,
                "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
            });
            // para la parte de proyecto  modificar en obras ejecutadas----------------------------------------
    let proyAlmacenEjecutadasedit = flatpickr("#txtfechaObras", 
        {
            minDate: "2024-08",
                maxDate: fechaFormateada,

            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });
         // para la parte de proyectos luminarias retiradas-----------------------------
let ProyLumRetiradas = flatpickr("#txtfechamante", 
    {
        minDate: new Date().setDate(new Date().getDate() - 7),

        maxDate: fechaFormateada,
        "disable": [
        function(date) {
            // return true to disable
            return (date.getDay() === 0 || date.getDay() === 6);

        }
    ],
    "locale": {
        "firstDayOfWeek": 1 // start week on Monday
    }
    });
    // para la parte de proyecto  modificar luminarias reutilizadas----------------------------------------
    let proyAlmacenReutilizadaEdit = flatpickr("#txtfechamanteMod", 
        {
            minDate: "2024-08",
                maxDate: fechaFormateada,

            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });
        // para la parte de inspeccion registrar nuevo
        let inspeccionRegis = flatpickr("#txtfechainpeccregis", 
            {
                minDate: new Date().setDate(new Date().getDate() - 7),

                maxDate: fechaFormateada,
                "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
            });
               // para la parte de proyecto  modificar en inspecciones editar---------------------------------------
    let inspeccionesEdit = flatpickr("#txtfechainpec", 
        {
            minDate: "2024-08",
                maxDate: fechaFormateada,

            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });
        // para la parte de inspeccion registrar nuevo
        let inspeccionEmpezar = flatpickr("#dateinspecEmpezar", 
            {
                minDate: new Date().setDate(new Date().getDate() - 7),

                maxDate: fechaFormateada,
                "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
            });
             // para la parte de proyecto  modificar en inspecciones realizados edit---------------------------------------
    let inspeccionesRealizadoEdit = flatpickr("#daterealiModificar", 

        {
            minDate: "2024-08",
                maxDate: fechaFormateada,

            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });
        // para la parte de reelevamientos-----------------------------------------------------------
        let reelevamientoLum = flatpickr("#reeFechaRegis", 
            {
                minDate: new Date().setDate(new Date().getDate() - 7),
        
                maxDate: fechaFormateada,
                "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
            });
             // para la parte de reelevamientos  modificar----------------------------------------------------
    let reelevamientosLumModi = flatpickr("#reeFechaRegisMod", 
        {
            minDate: "2024-08",
                maxDate: fechaFormateada,

            "disable": [
                function(date) {
                    // return true to disable
                    return (date.getDay() === 0 || date.getDay() === 6);
        
                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });