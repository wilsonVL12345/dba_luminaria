$(document).ready(function() {
    $('[data-control="select2"]').select2();
});

/* "use strict";

// Class definition
let tablaesperas = function () {
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
        const documentTitle = 'Lista de Luminarias  Retiradas ';
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
                            columns: [0, 1, 2, 3, 4, 6]  // Excluye la columna 6 (índice 6)
                        },
                        customize: function(doc) {
                            // Establecer la orientación de la página en horizontal
                            doc.pageOrientation = 'landscape';
                    
                            // Ajustar el ancho de las columnas; nota que ahora sólo tenemos 7 columnas en lugar de 8
                            doc.content[1].table.widths = ['10%', '25%', '15%', '25%', '10%', '15%'];
                    
                            // Centrar el contenido de las columnas especificadas
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment = 'center'; // Columna 1
                                row[1].alignment = 'left'; // Columna 2
                                row[2].alignment = 'center'; // Columna 4
                                row[4].alignment = 'center'; // Columna 5
                                row[5].alignment = 'center'; // Columna 6 (que en realidad es la 7ma columna visible)
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
                            tableDist = document.querySelector('#tablaespera');
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
                    tablaesperas.init();
                }); 
 */

                "use strict";

                let tablaesperas = function () {
                    // Shared variables
                    let tableDist;
                    let datatable;
                
                    // Private functions
                    let initDatatable = function () {
                        tableDist = document.querySelector('#tablaespera');
                
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
                                url: "/listadatos/espera",
                                type: "GET"
                            },
                            columns: [
                                { data: "Distritos_id", name: "Distritos_id" },
                                { data: "Zona", name: "Zona" },
                                { data: "Nro_Sisco", name: "Nro_Sisco" },
                                { data: "Tipo_Trabajo", name: "Tipo_Trabajo" },
                                { data: "Fecha_Programado", name: "Fecha_Programado" },
                                {
                                    data: "Foto_Carta",
                                    name: "Foto_Carta",
                                    render: function(data, type, row) {
                                        if (data && data.trim() !== '') {
                                            return '<a href="#" class="btn btn-sm btn-icon btn-light view-imageEspera" data-bs-toggle="modal" data-bs-target="#modalMostrarImagen" data-image-url="' + data + '"><i class="fas fa-image text-primary"></i></a>';
                                        } else {
                                            return '';
                
                                        }
                                    }
                                },
                
                                { data: 'Observaciones', name: 'Observaciones', render: function(data, type, row) {
                                    return '<span class="badge badge-light-danger">' + data + '</span>';
                                }},
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
                            order: [[4, "desc"]],
                
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
                        const documentTitle = 'Lista de Trabajos En Espera';
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
                                        columns: [0, 1, 2, 3, 4, 6]  // Excluye la columna 6 (índice 6)
                                    },
                                    customize: function(doc) {
                                        // Establecer la orientación de la página en horizontal
                                        doc.pageOrientation = 'landscape';
                                
                                        // Ajustar el ancho de las columnas; nota que ahora sólo tenemos 7 columnas en lugar de 8
                                        doc.content[1].table.widths = ['10%', '25%', '15%', '25%', '10%', '15%'];
                                
                                        // Centrar el contenido de las columnas especificadas
                                        doc.content[1].table.body.forEach(function(row) {
                                            row[0].alignment = 'center'; // Columna 1
                                            row[1].alignment = 'left'; // Columna 2
                                            row[2].alignment = 'center'; // Columna 4
                                            row[4].alignment = 'center'; // Columna 5
                                            row[5].alignment = 'center'; // Columna 6 (que en realidad es la 7ma columna visible)
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
                    tablaesperas.init();
                });
                $(document).on('click', '.view-imageEspera', function() {
                    // Obtener la URL de la imagen desde el atributo 'data-image-url'
                    let imageUrl = $(this).data('image-url');
                    
                    // Establecer la URL en el atributo 'src' de la imagen en el modal
                    $('#modalMostrarImagen img').attr('src', imageUrl);
                    
                    // Alternativamente, puedes establecer un texto alternativo si lo deseas
                    $('#modalMostrarImagen img').attr('alt', 'Carta Enviada');
                });
                


