
                
                 "use strict";
                
                let reeleLum = function () {
                    // Shared variables
                    let tableDist;
                    let datatable;
                    let valortraigo = null;
                
                    // Private functions
                    let initDatatable = function () {
                        tableDist = document.querySelector('#reelevamientoLuminaria');
                
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
                                url: "/lista/reelevamiento",
                                type: "GET",
                                data: function (d) {
                                    d.columns[2].search.value = valortraigo; // Aquí puedes cambiar el valor dinámicamente
                                }

                            },
                            columns: [
                              
                                { data: "Av_calles", name: "Av_calles" },
                                { data: "nombre_urbanizacion", name: "urbanizacion.nombre_urbanizacion" },
                                { data: "Distritos_id", name: "Distritos_id" },
                                { data: "Fecha", name: "Fecha" },
                                { data: "Descripcion", name: "Descripcion" },
                                
                                
                                {
                                    data: "Archivos",
                                    name: "Archivos",
                                    render: function(data, type, row) {
                                        return '<a href="' + data + '" download class="text-gray-600 text-hover-primary mb-1">' +
                                               '<img src="/assets/media/icons/rarblue.png" width="40" height="40">' +
                                               '</a>';
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
                    let reloadTable = function() {
                        if (datatable) {
                            datatable.ajax.reload(null, false);
                        }
                    }
                
                    // Hook export buttons
                    let exportButtons = () => {
                        const documentTitle = 'Lista de Reelevamientos';
                        let buttons = new $.fn.dataTable.Buttons(tableDist, {
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3 ,4 ] 

                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3 ,4 ] 

                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3 ,4 ] 
                                    },
                                    customize: function(doc) {
                                        // Establecer la orientación de la página en horizontal
                                        doc.pageOrientation = 'landscape';
                                       
                                       // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                                          doc.content[1].table.widths = ['20%', '30%', '10%', '10%', '30%']; // Reducimos el ancho de la primera columna
            
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
                    /* let handleActions = function() {
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
                    }; */
                    let handleActions = function() {
                        $(document).on('click', '[data-kt-action]', function(e) {
                            e.preventDefault();
                            let action = $(this).data('kt-action');
                            let id = $(this).closest('tr').find('td:first').text();
                            
                            if (action === 'edit') {
                                // Lógica para editar
                                
                            } else if (action === 'delete') {
                                // Lógica para eliminar
                                
                                // Aquí deberías implementar la lógica de eliminación
                                // Después de eliminar, recargar la tabla:
                                reloadTable();
                            }
                        });
                    };

                            let handleDistrictClick = function() {
                    $('[id^="d-"]').on('click', function(e) {
                        e.preventDefault();
                        let districtId = $(this).attr('id').split('-')[1];
                        valortraigo = districtId;
                        
                        if (datatable) {
                            datatable.ajax.reload();
                        } else {
                            sessionStorage.setItem('selectedDistrict', districtId);
                            window.location.href = $(this).find('a').attr('href');
                        }
                    });
                }
                    // Public methods
                    /* return {
                        init: function () {
                            initDatatable();
                            exportButtons();
                            handleSearchDatatable();
                            handleActions();
                        }
                    }; */
                    return {
                        init: function () {
                            if ($('#reelevamientoLuminaria').length > 0) {
                                valortraigo = sessionStorage.getItem('selectedDistrict') || localStorage.getItem('selectedDistrict');
                                sessionStorage.removeItem('selectedDistrict');
                                initDatatable();
                                exportButtons();
                                handleSearchDatatable();
                                handleActions();
                            }
                            handleDistrictClick();
                        },
                        reloadTable: reloadTable
                    };
                }();
                
                KTUtil.onDOMContentLoaded(function () {
                    reeleLum.init();
                });
                

/* // Agregar evento para guardar cambios en el modal
$('#btnGuardarCambios').on('click', function() {
    // Aquí va tu lógica para guardar los cambios
    // Después de guardar, cerrar el modal y recargar la tabla
    $('#modalModificar').modal('hide');
    reeleLum.reloadTable();
}); */

// Guardar el distrito seleccionado en localStorage cuando se cambia
$(document).on('click', '[id^="d-"]', function() {
    let districtId = $(this).attr('id').split('-')[1];
    localStorage.setItem('selectedDistrict', districtId);
});           
                /* "use strict";

                let reeleLum = function () {
                    // Shared variables
                    let tableDist;
                    let datatable;
                
                    // Private functions
                    let initDatatable = function () {
                        tableDist = document.querySelector('#reelevamientoLuminaria');
                
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
                                url: "/lista/reelevamiento",
                                type: "GET"
                            },
                            columns: [
                                { data: "Av_calles", name: "Av_calles" },
                                { data: "nombre_urbanizacion", name: "urbanizacion.nombre_urbanizacion" },
                                { data: "Distritos_id", name: "Distritos_id" },
                                { data: "Fecha", name: "Fecha" },
                                { data: "Descripcion", name: "Descripcion" },
                                
                                
                                {
                                    data: "Archivos",
                                    name: "Archivos",
                                    render: function(data, type, row) {
                                        return '<a href="' + data + '" download class="text-gray-600 text-hover-primary mb-1">' +
                                               '<img src="/assets/media/icons/rarblue.png" width="40" height="40">' +
                                               '</a>';
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
                        const documentTitle = 'Lista Reelevamientos de Luminarias';
                        let buttons = new $.fn.dataTable.Buttons(tableDist, {
                            buttons: [
                                {
                                    extend: 'copyHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3 ,4 ] 
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3 ,4 ] 
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: documentTitle,
                                    exportOptions: {
                                        columns: [0, 1, 2, 3 ,4 ] 
                                    },
                                    customize: function(doc) {
                                        // Establecer la orientación de la página en horizontal
                                        doc.pageOrientation = 'landscape';
                                       
                                       // Ajustar el ancho de las columnas (50% para "Distrito", 50% para "Urbanización")
                                          doc.content[1].table.widths = ['20%', '30%', '10%', '10%', '30%']; // Reducimos el ancho de la primera columna
            
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
                    reeleLum.init();
                }); */