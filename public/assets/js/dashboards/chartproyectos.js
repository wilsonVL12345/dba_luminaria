document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado, iniciando script del gráfico");

    let element = document.getElementById('graficosproyectos');
    
    if (!element) {
        console.log("Elemento 'graficosproyectos' no encontrado");
        return;
    }

    let options = {
        series: [{
            name: 'Proyectos Finalizados',
            data: []
        }, {
            name: 'Proyectos en Espera',
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
            categories: [],
        },
        yaxis: {
            title: {
                text: 'Proyectos'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " proyectos"
                }
            }
        },
        colors: ['#A9A9A9', '#FF0000'] // Azul para finalizados, Verde para en espera
    };

    let chart = new ApexCharts(element, options);
    
    chart.render().then(() => {
        fetchData();
    }).catch((error) => {
        console.error("Error al renderizar el gráfico:", error);
    });

    function fetchData() {
        fetch('/api/dashboardGenerales')
            .then(response => response.json())
            .then(data => {
                console.log('Datos recibidos:', data);

                let proyectosFinalizados = [];
                let proyectosEnEspera = [];
                let categorias = [];

                for (let i = 1; i <= 14; i++) {
                    let distrito = data[i];
                    if (distrito) {
                        proyectosFinalizados.push(distrito.proyectos_finalizados);
                        proyectosEnEspera.push(distrito.proyectos_espera);
                        categorias.push('D-' + i);
                    }
                }

                chart.updateOptions({
                    xaxis: {
                        categories: categorias
                    }
                });

                chart.updateSeries([
                    {
                        name: 'Proyectos Finalizados',
                        data: proyectosFinalizados
                    },
                    {
                        name: 'Proyectos en Espera',
                        data: proyectosEnEspera
                    }
                ]);
            })
            .catch(error => {
                console.error("Error al obtener datos de la API:", error);
            });
    }
});