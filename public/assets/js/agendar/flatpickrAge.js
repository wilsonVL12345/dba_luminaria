// para la parte de realizar trabajo de  la parte de mantenimiento
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

 // Función para generar fechas aleatorias en julio
// fecha agendar 
 // Configurar flatpickr
 let fp = flatpickr("#txtfechaprogramada", {
    minDate: "today",
    "disable": [
        function(date) {
            // return true to disable
            return (date.getDay() === 0 || date.getDay() === 6);

        }
    ],
    "locale": {
        "firstDayOfWeek": 1 // start week on Monday
    }
//fecha detalles  espera editar--------------------
 });
 let fps = flatpickr("#txtfechaprogramadaedit", 
    {
        minDate: "2020-01",
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
//fecha detalles  realizados editar--------------------

 let fpdetallRalizado = flatpickr("#dtFechaAtenr", 
    {
        minDate: "2020-01",
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
    // para la parte de proyecto  modificar-------------------------------
    let proyAlmacenedit = flatpickr("#txtfechaEsp", 
        {
            minDate: "2020-01",
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
            minDate: "2020-01",
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
            minDate: "2020-01",
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
            minDate: "2020-01",
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
            minDate: "2020-01",
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