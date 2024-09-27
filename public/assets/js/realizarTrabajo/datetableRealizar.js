/* "use strict";

// Class definition
let tablaRealizarTrabajo = function () {
    // Shared variables
    let table;
    let datatable;

    // Private functions
    let initDatatable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
            dateRow[3].setAttribute('data-order', realDate);
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
        });
    }

    
        let exportButtons = () => {
            const documentTitle = 'Lista Trabajar a Realizar';
            let buttons = new $.fn.dataTable.Buttons(table, {
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
                            columns: ':not(:last-child)'
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
                target.click();
            });
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    let handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#tablaRealizarTrabajo');

            if ( !table ) {
                return;
            }

            initDatatable();
            exportButtons();
            handleSearchDatatable();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    tablaRealizarTrabajo.init();
}); */

"use strict";

let tablaRealizarTrabajo = function () {
    // Shared variables
    let tableDist;
    let datatable;

    // Private functions
    let initDatatable = function () {
        tableDist = document.querySelector('#tablaRealizarTrabajo');

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
                url: "/lista/Pendiente",
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
                            return '<a href="#" class="btn btn-sm btn-icon btn-light view-imagePendiente" data-bs-toggle="modal" data-bs-target="#modalMostrarImagenTrabajos" data-image-url="' + data + '"><i class="fas fa-image text-primary"></i></a>';
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
        const documentTitle = 'Lista de Trabajos Pendientes';
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
                        columns: [0, 1, 2, 3 ,4 ,5]  // Excluye la columna 6 (índice 6)

                    },
                    customize: function(doc) {
                         // Establecer la orientación de la página en horizontal
                         doc.pageOrientation = 'landscape';
                       // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                          doc.content[1].table.widths = ['21%', '6%', '33%', '10%', '20%', '10%', ]; // Reducimos el ancho de la primera columna

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
                                row[4].alignment = 'center'; // Columna "Distrito" (índice 0)
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
    tablaRealizarTrabajo.init();
});
$(document).on('click', '.view-imagePendiente', function() {
    // Obtener la URL de la imagen desde el atributo 'data-image-url'
    let imageUrl = $(this).data('image-url');
    
    // Establecer la URL en el atributo 'src' de la imagen en el modal
    $('#modalMostrarImagenTrabajos img').attr('src', imageUrl);
    
    // Alternativamente, puedes establecer un texto alternativo si lo deseas
    $('#modalMostrarImagenTrabajos img').attr('alt', 'Carta Enviada');
});
