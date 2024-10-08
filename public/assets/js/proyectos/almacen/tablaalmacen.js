

/* "use strict";

// Class definition
let proyectoAlmacen = function () {
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
                        extend: 'pdfHtml5',
                        title: documentTitle,
                        exportOptions: {
                            columns: [0, 1, 2, 3 ,4 ,5,6]  // Excluye la columna 6 (índice 6)

                        },
                        customize: function(doc) {
                             // Establecer la orientación de la página en horizontal
                             doc.pageOrientation = 'landscape';
                           // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                              doc.content[1].table.widths = ['15%', '7%', '29%', '10%', '10%', '8%', '21%',]; // Reducimos el ancho de la primera columna

                               // Centrar el contenido de la primera columna
                                doc.content[1].table.body.forEach(function(row) {
                                    row[0].alignment = 'center'; // Columna "Distrito" (índice 0)
                                });

                                 // Centrar el contenido de la 4 columna
                                 doc.content[1].table.body.forEach(function(row) {
                                    row[1].alignment = 'center'; // Columna "Distrito" (índice 0)
                                });
                                // Centrar el contenido de la ultima columna
                                doc.content[1].table.body.forEach(function(row) {
                                    row[3].alignment = 'center'; // Columna "Distrito" (índice 0)
                                });
                                doc.content[1].table.body.forEach(function(row) {
                                    row[4].alignment = 'center'; // Columna "Distrito" (índice 0)
                                }); 
                                doc.content[1].table.body.forEach(function(row) {
                                    row[5].alignment = 'center'; // Columna "Distrito" (índice 0)
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
                        }).container().appendTo($('#tablaAlmacenexport'));

                        // Hook dropdown menu click event to datatable export buttons
                        const exportButtons = document.querySelectorAll('#tablaAlmacen_export_menu [data-kt-export]');
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
                            tableDist = document.querySelector('#tablaAlmacen');
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
                    proyectoAlmacen.init();
                }); 


 */

                "use strict";

let proyectoAlmacen = function () {
    // Shared variables
    let tableDist;
    let datatable;

    // Private functions
    let initDatatable = function () {
        tableDist = document.querySelector('#tablaAlmacen');

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
                url: "/listaProy/almacen",
                type: "GET"
            },
            columns: [
                { data: "Cuce_Cod", name: "Cuce_Cod" },
                { data: "Distritos_id", name: "Distritos_id" },
                { data: "Zona", name: "Zona" },
                { data: "Fecha_Programada", name: "Fecha_Programada" },
                { data: "Tipo_Contratacion", name: "Tipo_Contratacion" },
                { data: "Subasta", name: "Subasta" },
                { data: "Proveedor", name: "Proveedor" },
                {
                    data: "id",  // Aquí el id que viene desde el servidor
                    name: "id",
                    render: function(data, type, row) {
                        return '<a href="/detallesAccesorios/almacen/'+data+ '" class="text-gray-600 text-hover-primary mb-1"><i class="fa-regular fa-eye"></i></a>';
                    }
                },
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
            order: [[3, "desc"]],

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
        const documentTitle = 'Lista de Proyectos';
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
                        columns: [0, 1, 2, 3 ,4 ,5,6]  // Excluye la columna 6 (índice 6)

                    },
                    customize: function(doc) {
                         // Establecer la orientación de la página en horizontal
                         doc.pageOrientation = 'landscape';
                       // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                          doc.content[1].table.widths = ['15%', '7%', '29%', '10%', '10%', '8%', '21%',]; // Reducimos el ancho de la primera columna

                           // Centrar el contenido de la primera columna
                            doc.content[1].table.body.forEach(function(row) {
                                row[0].alignment = 'center'; // Columna "Distrito" (índice 0)
                            });

                             // Centrar el contenido de la 4 columna
                             doc.content[1].table.body.forEach(function(row) {
                                row[1].alignment = 'center'; // Columna "Distrito" (índice 0)
                            });
                            // Centrar el contenido de la ultima columna
                            doc.content[1].table.body.forEach(function(row) {
                                row[3].alignment = 'center'; // Columna "Distrito" (índice 0)
                            });
                            doc.content[1].table.body.forEach(function(row) {
                                row[4].alignment = 'center'; // Columna "Distrito" (índice 0)
                            }); 
                            doc.content[1].table.body.forEach(function(row) {
                                row[5].alignment = 'center'; // Columna "Distrito" (índice 0)
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
        }).container().appendTo($('#tablaAlmacenexport'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#tablaAlmacen_export_menu [data-kt-export]');
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
    proyectoAlmacen.init();
});

 
