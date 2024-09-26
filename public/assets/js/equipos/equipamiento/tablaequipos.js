
// este es el js para que muestre los equipamientos de los diferentes distritos
$(document).ready(function() {
    let lugarDesignado = $('#app').data('lugarDesignado');
    console.log('está funcionando');
    
    // Ocultar todos los divs inicialmente
    $('div[id^="d-"]').hide();
    
    if (lugarDesignado === 'Alcaldia') {
        // Si es 'Alcaldia', mostrar todos los divs
        $('div[id^="d-"]').show();
    } else {
        // Convertir a número si no es 'Alcaldia'
        lugarDesignado = parseInt(lugarDesignado);
        
        // Mostrar el div específico basado en Lugar_Designado
        if (lugarDesignado >= 1 && lugarDesignado <= 14) {
            $('#d-' + lugarDesignado).show();
        }
    }
}); 


/* 


"use strict";

// Class definition
let tablaequipamientos = function () {
    // Shared variables
    let tableDist;
    let datatable;

    // Private functions
    let initDatatable = function () {
        // Set date data order (assuming date is in the third column, adjust index accordingly)
        const tableRows = tableDist.querySelectorAll('tbody tr');
        
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(tableDist).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'drawCallback': function(settings) {
                // Reinicializar los menús de KTMenu si es necesario
                KTMenu.createInstances();
            }
        });

        // Asegúrate de que las acciones se manejen correctamente después de cada redibujado
        datatable.on('draw', function() {
            handleActions();
        });
    }

    // Hook export buttons
    let exportButtons = () => {
        const documentTitle = 'Lista de Accesorios ';
        let buttons = new $.fn.dataTable.Buttons(tableDist, {
            buttons: [
                {
                        extend: 'copyHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                   /*  {
                        extend: 'csvHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }, 
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: ':not(:last-child)'
                        },
                        customize: function(doc) {
                           
                           // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                              doc.content[1].table.widths = ['20%', '60%', '10%', '10%']; // Reducimos el ancho de la primera columna

                               // Centrar el contenido de la primera columna
                                doc.content[1].table.body.forEach(function(row) {
                                    row[0].alignment = 'left'; // Columna "Distrito" (índice 0)
                                });

                                 // Centrar el contenido de la penultima columna
                                 doc.content[1].table.body.forEach(function(row) {
                                    row[2].alignment = 'center'; // Columna "Distrito" (índice 0)
                                });
                                // Centrar el contenido de la ultima columna
                                doc.content[1].table.body.forEach(function(row) {
                                    row[3].alignment = 'center'; // Columna "Distrito" (índice 0)
                                });
                            // Centrar el contenido del PDF de las columnas el texto
                            // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');
                            doc.styles.tableBodyEven.alignment = 'left';
                            doc.styles.tableBodyOdd.alignment = 'left';
                            
                            // Alinear el título al centro
                            doc.styles.title = {
                                alignment: 'center',
                                fontSize: 14,
                                bold: true
                            };
                    
                            // Ajustar márgenes
                            doc.pageMargins = [40, 60, 40, 60]; // Izquierda, Arriba, Derecha, Abajo
                        }
                    }

                   
                            ]
                        }).container().appendTo($('#kt_datatable_example_buttons'));

                        // Hook dropdown menu click event to datatable export buttons
                        const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
                        exportButtons.forEach(exportButton => {
                            exportButton.addEventListener('click', e => {
                                e.preventDefault();

                                // Get clicked export value
                                const exportValue = e.target.getAttribute('data-kt-export');
                                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                                // Trigger click event on hidden datatable export buttons
                                if (target) {
                                    target.click();
                                }
                            });
                        });
                    }

                    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search/
                    let handleSearchDatatable = () => {
                        const filterSearch = document.querySelector('[data-kt-filter="search"]');
                        filterSearch.addEventListener('keyup', function (e) {
                            datatable.search(e.target.value).draw();
                        });
                    }

                    // Handle actions
                    let handleActions = function() {
                        $(document).on('click', '[data-kt-action]', function(e) {
                            e.preventDefault();
                            let action = $(this).data('kt-action');
                            let id = $(this).closest('tr').find('td:first').text();
                            
                            if (action === 'edit') {
                                // Lógica para editar
                                console.log('Editando registro con ID:', id);
                            } else if (action === 'delete') {
                                // Lógica para eliminar
                                console.log('Eliminando registro con ID:', id);
                            }
                        });
                    };

                    // Public methods
                    return {
                        init: function () {
                            tableDist = document.querySelector('#equipamientotabla');
                            console.log('table:', tableDist); // Debugging statement

                            if (!tableDist) {
                                console.warn('Table not found!');
                                return;
                            }

                            initDatatable();
                            exportButtons();
                            handleSearchDatatable();
                            handleActions(); // Añadido para manejar las acciones
                        }
                    };
                }();

                // On document ready
                KTUtil.onDOMContentLoaded(function () {
                    tablaequipamientos.init();
                });  */

                $(document).on('click', '.edit-buttonequimod', function () {
                    let equipamientoId = $(this).data('id'); // Obtener el ID del accesorio
                
                    // Hacer la solicitud AJAX al servidor
                    $.ajax({
                        url: '/editardatos/equipamiento'+equipamientoId, // Cambia esta URL por la ruta que devuelve los datos del accesorio
                        method: 'GET',
                        success: function (data) {
                            // Rellenar los campos del formulario en el modal con los datos recibidos
                            $('#txtnombre').val(data.Nombre_Item); 
                            $('#txtdescripcion').val(data.Descripcion); 
                            $('#txtestado').val(data.estado).trigger('change'); 
                            $('#txtdistrito').val(data.Distritos_id).trigger('change'); 
                            $('#txtid').val(data.id); 
                            // Puedes agregar más campos aquí
                            // $('#otro_campo').val(data.otro_campo);
                            console.log(equipamientoId);
                            // Mostrar el modal
                            $('#modalModificar').modal('show');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al obtener los datos del equipamiento:', error);
                        }
                    });
                });
                
                 "use strict";
                
                let tablaequipamientos = function () {
                    // Shared variables
                    let tableDist;
                    let datatable;
                
                    // Private functions
                    let initDatatable = function () {
                        tableDist = document.querySelector('#equipamientotabla');
                
                        if (!tableDist) {
                            console.warn('Table not found!');
                            return;
                        }
                        KTMenu.createInstances();
                
                        // Init datatable
                        datatable = $(tableDist).DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: {
                                url: "/listaDatos/equipamiento",
                                type: "GET"
                            },
                            columns: [
                                // { data: "Nrodistrito", name: "Nrodistrito" },
                                /* { 
                                    data: null, // La columna del contador no tiene datos
                                    name: "index", // Solo es un nombre de referencia
                                    orderable: false, 
                                    searchable: false,
                                    render: function (data, type, row, meta) {
                                        return meta.row + 1; // Devuelve el número de fila (inicia desde 1)
                                    }
                                }, */
                                { data: "Nombre_Item", name: "Nombre_Item" },
                                { data: "Descripcion", name: "Descripcion" },
                                { data: "estado", name: "estado" },
                                { data: "Distritos_id", name: "Distritos_id" },
                                {
                                    data: "action",
                                    name: "action",
                                    orderable: false,
                                    searchable: false
                                }
                            ],
                            pageLength: 10,
                            lengthMenu: [
                                [10, 25, 50, 100, 500],
                                [10, 25, 50, 100, 500]
                            ],
                            searchDelay: 500,
                            order: [[0, "asc"]],
                
                            'drawCallback': function(settings) {
                        // Reinicializar los menús de KTMenu si es necesario
                        KTMenu.createInstances();
                             }
                        });
                
                        // Asegúrate de que las acciones se manejen correctamente después de cada redibujado
                        datatable.on('draw', function() {
                            handleActions();
                        });
                    }
                
                    // Hook export buttons
                    let exportButtons = () => {
                        const documentTitle = 'Lista de Equipamientos';
                        let buttons = new $.fn.dataTable.Buttons(tableDist, {
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: ':not(:last-child)'
                                    },
                                    customize: function(doc) {
                                       
                                       // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                                          doc.content[1].table.widths = ['20%', '60%', '10%', '10%']; // Reducimos el ancho de la primera columna
            
                                           // Centrar el contenido de la primera columna
                                            doc.content[1].table.body.forEach(function(row) {
                                                row[0].alignment = 'left'; // Columna "Distrito" (índice 0)
                                            });
            
                                             // Centrar el contenido de la penultima columna
                                             doc.content[1].table.body.forEach(function(row) {
                                                row[2].alignment = 'center'; // Columna "Distrito" (índice 0)
                                            });
                                            // Centrar el contenido de la ultima columna
                                            doc.content[1].table.body.forEach(function(row) {
                                                row[3].alignment = 'center'; // Columna "Distrito" (índice 0)
                                            });
                                        // Centrar el contenido del PDF de las columnas el texto
                                        // doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('*');
                                        doc.styles.tableBodyEven.alignment = 'left';
                                        doc.styles.tableBodyOdd.alignment = 'left';
                                        
                                        // Alinear el título al centro
                                        doc.styles.title = {
                                            alignment: 'center',
                                            fontSize: 14,
                                            bold: true
                                        };
                                
                                        // Ajustar márgenes
                                        doc.pageMargins = [40, 60, 40, 60]; // Izquierda, Arriba, Derecha, Abajo
                                    }
                                }
            
                            ]
                        }).container().appendTo($('#kt_datatable_example_buttons'));
                
                        // Hook dropdown menu click event to datatable export buttons
                        const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
                        exportButtons.forEach(exportButton => {
                            exportButton.addEventListener('click', e => {
                                e.preventDefault();
                
                                // Get clicked export value
                                const exportValue = e.target.getAttribute('data-kt-export');
                                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
                
                                // Trigger click event on hidden datatable export buttons
                                if (target) {
                                    target.click();
                                }
                            });
                        });
                    }
                
                    // Search Datatable
                    let handleSearchDatatable = () => {
                        const filterSearch = document.querySelector('[data-kt-filter="search"]');
                        filterSearch.addEventListener('keyup', function (e) {
                            datatable.search(e.target.value).draw();
                        });
                    }
                
                    // Handle actions
                    let handleActions = function() {
                        $(document).on('click', '[data-kt-action]', function(e) {
                            e.preventDefault();
                            let action = $(this).data('kt-action');
                            let id = $(this).closest('tr').find('td:first').text();
                            
                            if (action === 'edit') {
                                // Lógica para editar
                                console.log('Editando registro con ID:', id);
                            } else if (action === 'delete') {
                                // Lógica para eliminar
                                console.log('Eliminando registro con ID:', id);
                            }
                        });
                    };
                
                    // Public methods
                    return {
                        init: function () {
                            initDatatable();
                            exportButtons();
                            handleSearchDatatable();
                            handleActions();
                        }
                    };
                }();
                
                KTUtil.onDOMContentLoaded(function () {
                    tablaequipamientos.init();
                });
                
