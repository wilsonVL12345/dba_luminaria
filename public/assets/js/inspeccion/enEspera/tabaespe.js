
/* "use strict";

// Class definition
let inspeccionEspera = function () {
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
        const documentTitle = 'Lista de Inspecciones en Espera ';
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
                            columns: [0, 1, 2, 4]  // Excluye la columna 6 (índice 6)

                        },
                        customize: function(doc) {
                             // Establecer la orientación de la página en horizontal
                          
                           // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                              doc.content[1].table.widths = ['20%', '40%', '20%', '20%']; // Reducimos el ancho de la primera columna

                               // Centrar el contenido de la primera columna
                                doc.content[1].table.body.forEach(function(row) {
                                    row[0].alignment = 'left'; // Columna "Distrito" (índice 0)
                                });

                                 // Centrar el contenido de la 4 columna
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
                            tableDist = document.querySelector('#tablainspeccions');
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
                }(); */




                $(document).on('click', '.edit-buttoninspeespemod', function () {
                    let inspecionEspId = $(this).data('id');
                  
                    // Hacer la solicitud AJAX al servidor
                    $.ajax({
                        url: '/editDatos/inspeccionespera' + inspecionEspId,
                        method: 'GET',
                        success: function (data) {
                            // Rellenar los campos del formulario en el modal con los datos recibidos
                            $('#textidEsp').val(data.id);
                            $('#txtsiscoEspeM').val(data.Nro_Sisco);
                            $('#txtfechaEspMod').val(data.Fecha_Inspeccion);
                            
                            //  Guardar la urbanización que queremos seleccionar
                             window.zonaUrbanizacionToSelect = data.ZonaUrbanizacion;
                            
                            // Primero actualizamos el distrito, lo que desencadenará la actualización de las urbanizaciones
                            $('#sldistInspEsp').val(data.Distritos_id).trigger('change');
                            
                          
                            // Mostrar el modal 
                            $('#modalModificarInspeccion').modal('show');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error al obtener los datos del equipamiento:', error);
                        }
                    });
                });
                
                 "use strict";
                
                let inspeccionEspera = function () {
                    // Shared variables
                    let tableDist;
                    let datatable;
                
                    // Private functions
                    let initDatatable = function () {
                        tableDist = document.querySelector('#tablainspeccions');
                
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
                                url: "/listaDatos/inspeccionespera",
                                type: "GET"
                            },
                            columns: [
                                
                                { data: "Nro_Sisco", name: "Nro_Sisco" },
                                { data: "ZonaUrbanizacion", name: "ZonaUrbanizacion" },
                                { data: "Distritos_id", name: "Distritos_id" },
                                {
                                    data: "Foto_Carta",
                                    name: "Foto_Carta",
                                    render: function(data, type, row) {
                                        if (data && data.trim() !== '') {
                                            return '<a href="#" class="btn btn-sm btn-icon btn-light view-imageespera" data-bs-toggle="modal" data-bs-target="#modalMostrarImagen" data-image-url="' + data + '"><i class="fas fa-image text-primary"></i></a>';
                                        } else {
                                            return '';

                                        }
                                    }
                                },

                                { data: "Fecha_Inspeccion", name: "Fecha_Inspeccion" },
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
                        const documentTitle = 'Lista de Inspecciones Realizadas';
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
                                        columns: [0, 1, 2, 4]  // Excluye la columna 6 (índice 6)
            
                                    },
                                    customize: function(doc) {
                                         // Establecer la orientación de la página en horizontal
                                      
                                       // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                                          doc.content[1].table.widths = ['20%', '40%', '20%', '20%']; // Reducimos el ancho de la primera columna
            
                                           // Centrar el contenido de la primera columna
                                            doc.content[1].table.body.forEach(function(row) {
                                                row[0].alignment = 'left'; // Columna "Distrito" (índice 0)
                                            });
            
                                             // Centrar el contenido de la 4 columna
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
                   inspeccionEspera.init();
                });
                
              // Escuchar el evento de clic en los botones de vista de imagen
$(document).on('click', '.view-imageespera', function() {
    // Obtener la URL de la imagen desde el atributo 'data-image-url'
    let imageUrl = $(this).data('image-url');
    
    // Establecer la URL en el atributo 'src' de la imagen en el modal
    $('#modalMostrarImagen img').attr('src', imageUrl);
    
    // Alternativamente, puedes establecer un texto alternativo si lo deseas
    $('#modalMostrarImagen img').attr('alt', 'Carta Enviada');
});
             