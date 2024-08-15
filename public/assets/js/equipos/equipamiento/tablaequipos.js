/* "use strict";

// Class definition
let tablaequipamientos = function () {
    // Shared letiables
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

    // Hook export buttons
    let exportButtons = () => {
        const documentTitle = 'Lista de Equipamientos';
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
            table = document.querySelector('#equipamientotabla');

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
    tablaequipamientos.init();
});

 */

"use strict";

// Class definition
let tablaequipamientos = function () {
    // Shared letiables
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
            'columnDefs': [
                {
                    'targets': -1, // Ocultar la última columna
                    'visible': false,
                    'searchable': false
                }
            ]
        });
    }

    // Hook export buttons
    let exportButtons = () => {
        const documentTitle = 'Lista de Equipamientos';
        let buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'copyHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: ':visible' // Solo exporta columnas visibles
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: ':visible' // Solo exporta columnas visibles
                    }
                },
                {
                    extend: 'csvHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: ':visible' // Solo exporta columnas visibles
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: documentTitle,
                    exportOptions: {
                        columns: ':visible' // Solo exporta columnas visibles
                    },
                    customize: function (doc) {
                        doc.styles.tableHeader = {
                            alignment: 'center' // Centrar los encabezados de las tablas
                        };
                        doc.styles.tableBodyEven = {
                            alignment: 'center' // Centrar las filas pares
                        };
                        doc.styles.tableBodyOdd = {
                            alignment: 'center' // Centrar las filas impares
                        };
                        doc.content[1].table.widths = '*'.repeat(doc.content[1].table.body[0].length).split(''); // Ajustar el ancho de las columnas
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

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search/
    let handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#equipamientotabla');

            if (!table) {
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
    tablaequipamientos.init();
});

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