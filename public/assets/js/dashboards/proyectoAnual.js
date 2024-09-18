/* document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado, iniciando script del gráfico del nuevo");

    let element = document.getElementById('proyectoAnual');
    console.log("Elemento encontrado:", element);

    if (!element) {
        return;
    }

    // Hacer la llamada a la API
    fetch('/api/dashboardGenerales2')
        .then(response => response.json())
        .then(data => {
            // Procesar los datos y crear el gráfico
            createChart(element, data);
        })
        .catch(error => console.error('Error:', error));
});


function createChart(element, data) {
    let height = parseInt(KTUtil.css(element, 'height'));
    let labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
    let borderColor = KTUtil.getCssVariableValue('--kt-gray-200');

    let proyectosEspera = [];
    let proyectosFinalizados = [];
    let categorias = [];

    // Procesar los datos
    for (let i = 1; i <= 14; i++) {
        if (data[i]) {
            proyectosEspera.push(data[i].proyectos_espera);
            proyectosFinalizados.push(data[i].proyectos_finalizados);
            categorias.push('D-' + i);
        }
    }

    let options = {
        series: [{
            name: 'Proyectos en Espera',
            data: proyectosEspera
        }, {
            name: 'Proyectos Finalizados',
            data: proyectosFinalizados
        }],
        chart: {
            fontFamily: 'inherit',
            type: 'bar',
            height: height,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                columnWidth: ['30%'],
                endingShape: 'rounded'
            },
        },
        legend: {
            show: true
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
            categories: categorias,
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: labelColor,
                    fontSize: '12px'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: labelColor,
                    fontSize: '12px'
                }
            }
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px'
            },
            y: {
                formatter: function (val) {
                    return val + ' proyectos'
                }
            }
        },
        colors: ['#FF0000', '#0000FF'],
        grid: {
            borderColor: borderColor,
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    };

    let chart = new ApexCharts(element, options);
    chart.render();
} */

    const ProyectoAnualChart = (function() {
        function createChart(element, data) {
            let height = parseInt(KTUtil.css(element, 'height'));
            let labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
            let borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
    
            let proyectosEspera = [];
            let proyectosFinalizados = [];
            let categorias = [];
    
            // Procesar los datos
            for (let i = 1; i <= 14; i++) {
                if (data[i]) {
                    proyectosEspera.push(data[i].proyectos_espera);
                    proyectosFinalizados.push(data[i].proyectos_finalizados);
                    categorias.push('D-' + i);
                }
            }
    
            let options = {
                series: [{
                    
                    name: 'Proyectos Finalizados',
                    data: proyectosFinalizados
                }, {
                    name: 'Proyectos en Espera',
                    data: proyectosEspera
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        columnWidth: ['30%'],
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    show: true
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
                    categories: categorias,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return val + ' proyectos'
                        }
                    }
                },
                colors: ['#213a57', '#14919b'],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };
    
            let chart = new ApexCharts(element, options);
            chart.render();
        }
    
        function init() {
            console.log("DOM cargado, iniciando script del gráfico de proyecto anual");
            let element = document.getElementById('proyectoAnual');
            console.log("Elemento encontrado:", element);
            
            if (!element) {
                console.log("Elemento 'proyectoAnual' no encontrado. Abortando inicialización del gráfico.");
                return;
            }
    
            // Hacer la llamada a la API
            fetch('/api/dashboardGenerales2')
                .then(response => response.json())
                .then(data => {
                    console.log("Datos recibidos de la API:", data);
                    createChart(element, data);
                })
                .catch(error => console.error('Error al obtener datos de la API:', error));
        }
    
        return {
            init: init
        };
    })();
    
    // Inicializar el gráfico cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', ProyectoAnualChart.init);