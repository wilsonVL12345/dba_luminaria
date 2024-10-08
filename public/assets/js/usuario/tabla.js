/* 

"use strict";

// Class definition
let tablausuartios = function () {
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
        const documentTitle = 'Lista de Usuarios Activos ';
        let buttons = new $.fn.dataTable.Buttons(tableDist, {
            buttons: [
                {
                        extend: 'copyHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5, 6,7,8]  // Excluye la columna 6 (índice 6)

                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [ 1, 2, 3, 4,5, 6,7,8]  // Excluye la columna 6 (índice 6)

                        }
                    },
                    {
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
                            columns: [ 1, 2, 3, 4,5, 6,7,8]  // Excluye la columna 6 (índice 6)
                        },
                        customize: function(doc) {
                            // Establecer la orientación de la página en horizontal
                            doc.pageOrientation = 'landscape';
                    
                            // Ajustar el ancho de las columnas; nota que ahora sólo tenemos 7 columnas en lugar de 8
                            doc.content[1].table.widths = ['20%', '10%', '10%', '10%', '15%', '10%', '15%', '10%'];
                    
                            // Centrar el contenido de las columnas especificadas
                            doc.content[1].table.body.forEach(function(row) {
                                row[3].alignment = 'center'; // Columna 4
                                row[4].alignment = 'center'; // Columna 5
                                row[5].alignment = 'center'; // Columna 5
                                row[6].alignment = 'left'; // Columna 6 
                                row[7].alignment = 'center'; // Columna 7 
                            });
                    
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
                                
                            } else if (action === 'delete') {
                                // Lógica para eliminar
                                
                            }
                        });
                    };

                    // Public methods
                    return {
                        init: function () {
                            tableDist = document.querySelector('#tableDeUsuarios');
                             // Debugging statement

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
                    tablausuartios.init();
                }); 


 */
                $(document).on('click', '.edit-buttonUserEdit', function () {
                    let equipamientoId = $(this).data('id');
                    
                    // Hacer la solicitud AJAX al servidor
                    $.ajax({
                        url: '/datosUser' + equipamientoId,
                        method: 'GET',
                        success: function (data) {
                            // Rellenar los campos del formulario en el modal con los datos recibidos
                            $('#txtiduser').val(data.id);
                            $('#txtnombre').val(data.name);
                            $('#txtpaterno').val(data.Paterno);
                            $('#txtmaterno').val(data.Materno);
                            $('#txtci').val(data.Ci);
                            $('#txtcelularu').val(data.Celular);
                            $('#txtgenero').val(data.Genero).trigger('change');
                            $('#txtexpedido').val(data.Expedido).trigger('change');
                            $('#txtcargouser').val(data.Cargo).trigger('change');
                            $('#lugarresponsable').val(data.Lugar_Designado).trigger('change');
                            
                           
                            
                            // 
                            // Mostrar el modal
                            $('#modalModificarUsuario').modal('show');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al obtener los datos del equipamiento:', error);
                        }
                    });
                });
                
"use strict";

                let tablausuartios = function () {
                    // Shared variables
                    let tableDist;
                    let datatable;
                
                    // Private functions
                    let initDatatable = function () {
                        tableDist = document.querySelector('#tableDeUsuarios');
                
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
                                url: "/listaUsers",
                                type: "GET"
                            },
                            columns: [
                                {
                                    data: "perfil",  // Aquí el id que viene desde el servidor
                                    name: "perfil",
                                    render: function(data, type, row) {
                                        return '<a href="#" class="text-gray-600 text-hover-primary mb-1"><img src="'+data+'"  width="40" height="40" alt=""></a>';
                                    }
                                },
                                { data: "name", name: "name" },
                                { data: "Paterno", name: "Paterno" },
                                { data: "Materno", name: "Materno" },
                                { data: "Ci", name: "Ci" },
                                { data: "Celular", name: "Celular" },
                                { data: "Cargo", name: "Cargo" },
                                { data: "Lugar_Designado", name: "Lugar_Designado" },
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
                        const documentTitle = 'Lista de Usuarios del Sistema';
                        let buttons = new $.fn.dataTable.Buttons(tableDist, {
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4,5, 6,7]  // Excluye la columna 6 (índice 6)
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4,5, 6,7]  // Excluye la columna 6 (índice 6)
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [ 1, 2, 3, 4,5, 6,7]  // Excluye la columna 6 (índice 6)
                                    },
                                    customize: function(doc) {
                                        // Establecer la orientación de la página en horizontal
                                        doc.pageOrientation = 'landscape';
                                
                                        // Ajustar el ancho de las columnas; nota que ahora sólo tenemos 7 columnas en lugar de 8
                                        doc.content[1].table.widths = ['20%', '15%', '15%', '10%', '15%', '10%', '15%'];
                                
                                        // Centrar el contenido de las columnas especificadas
                                        doc.content[1].table.body.forEach(function(row) {
                                            row[3].alignment = 'center'; // Columna 4
                                            row[4].alignment = 'center'; // Columna 5
                                            row[5].alignment = 'center'; // Columna 5
                                            row[6].alignment = 'center'; // Columna 6 
                                        });
                                
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
                                
                            } else if (action === 'delete') {
                                // Lógica para eliminar
                                
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
                    tablausuartios.init();
                });