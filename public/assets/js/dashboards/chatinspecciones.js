document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado, iniciando script del gráfico");

    let element = document.getElementById('graficosinspecciones');
    
    if (!element) {
        console.log("Elemento 'graficosproyectos' no encontrado");
        return;
    }

    let options = {
        series: [{
            name: 'Inpecciones Finalizados',
            data: []
        }, {
            name: 'Inpecciones en Espera',
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
                text: 'Inpecciones'
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
        colors: ['#6E9E3E', '#3478C0'] // Azul para finalizados, Verde para en espera

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

                let inspeccionesFinalizados = [];
                let inspeccionesEnEspera = [];
                let categorias = [];

                for (let i = 1; i <= 14; i++) {
                    let distrito = data[i];
                    if (distrito) {
                        inspeccionesFinalizados.push(distrito.inspecciones_realizadas);
                        inspeccionesEnEspera.push(distrito.inspecciones_espera);
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
                        name: 'Inspecciones Finalizados',
                        data: inspeccionesFinalizados
                    },
                    {
                        name: 'Inspecciones en Espera',
                        data: inspeccionesEnEspera
                    }
                ]);
            })
            .catch(error => {
                console.error("Error al obtener datos de la API:", error);
            });
    }
});