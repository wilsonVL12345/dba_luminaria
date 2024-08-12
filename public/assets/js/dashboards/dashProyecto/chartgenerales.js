/*   document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado, iniciando script del gráfico");

    let element = document.getElementById('graficos');
    
    if (!element) {
        console.error("Elemento del gráfico no encontrado: kt_apexcharts_1");
        console.log("Elementos disponibles con ID:", 
            Array.from(document.querySelectorAll('[id]')).map(el => el.id).join(', '));
        return;
    }
    
    console.log("Elemento del gráfico encontrado, configurando opciones");

    let options = {
        series: [{
            name: 'Finalizados',
            data: [44, 55, 57, 56, 61, 58, 57, 56, 61, 58, 57, 56, 61, 58]
        }, {
            name: 'En Espera',
            data: [76, 85, 101, 98, 87, 105, 101, 98, 87, 105, 101, 98, 87, 105]
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
                text: 'Proyectos  Luminarias'
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

    console.log("Creando instancia de ApexCharts");
    let chart = new ApexCharts(element, options);
    
    console.log("Renderizando gráfico");
    chart.render().then(() => {
        console.log("Gráfico renderizado exitosamente");
    }).catch((error) => {
        console.error("Error al renderizar el gráfico:", error);
    });
}); 
 
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado, iniciando script del gráfico");

    let element = document.getElementById('graficos');
    
    if (!element) {
        console.error("Elemento del gráfico no encontrado: graficos");
        console.log("Elementos disponibles con ID:", 
            Array.from(document.querySelectorAll('[id]')).map(el => el.id).join(', '));
        return;
    }
    
    console.log("Elemento del gráfico encontrado, configurando opciones");

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
                text: 'Proyectos Luminarias'
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

    console.log("Creando instancia de ApexCharts");
    let chart = new ApexCharts(element, options);
    
    console.log("Renderizando gráfico");
    chart.render().then(() => {
        console.log("Gráfico renderizado exitosamente");
        fetchData();
    }).catch((error) => {
        console.error("Error al renderizar el gráfico:", error);
    });

    function fetchData() {
        Promise.all([
            fetch('/api/retiradasFin/proyecto').then(response => response.json()),
            fetch('/api/retiradas/proyecto').then(response => response.json())
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