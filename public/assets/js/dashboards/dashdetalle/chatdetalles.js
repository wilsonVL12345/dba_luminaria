
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado, iniciando script del gráfico");

    let element = document.getElementById('graficosdetalles');
    
    if (!element) {
        console.log("Elementos disponibles con ID:", 
            Array.from(document.querySelectorAll('[id]')).map(el => el.id).join(', '));
        return;
    }
    

    let options = {
        series: [{
            name: 'Finalizados',
            data: []
        }, {
            name: 'En Espera',
            data: []
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['D-1', 'D-2', 'D-3', 'D-4', 'D-5', 'D-6', 'D-7', 'D-8', 'D-9', 'D-10', 'D-11', 'D-12', 'D-13', 'D-14'],
        },
        yaxis: {
            title: {
                text: 'Mantenimientos Generales'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "+ " + val + " total "
                }
            }
        }
    };

    let chart = new ApexCharts(element, options);
    
    chart.render().then(() => {
        fetchData();
    }).catch((error) => {
    });

    function fetchData() {
        Promise.all([
            fetch('/api/finalizado/detalles').then(response => response.json()),
            fetch('/api/espera/detalles').then(response => response.json())
        ]).then(([finalizados, enEspera]) => {
            console.log('Datos finalizados:', finalizados);
            console.log('Datos en espera:', enEspera);

            let dataFinalizados = [];
            let dataEnEspera = [];

            for (let i = 1; i <= 14; i++) {
                dataFinalizados.push(finalizados['d' + i] || 0);
                dataEnEspera.push(enEspera['d' + i] || 0);
            }

            chart.updateSeries([
                {
                    name: 'Finalizados',
                    data: dataFinalizados
                },
                {
                    name: 'En Espera',
                    data: dataEnEspera
                }
            ]);
        }).catch(error => {
            console.error("Error al obtener datos de la API:", error);
        });
    }
});

