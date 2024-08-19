/* document.addEventListener('DOMContentLoaded', function() {
    
    console.log("DOM cargado, iniciando script del gráfico del nuevo");

    let element = document.getElementById('detallesAnual');
    console.log("Elemento encontrado:", element);

    if (!element) {
        return;
    }

    // Hacer la llamada a la API
    fetch('/api/dashboardGenerales3')
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

    let detallesEspera = [];
    let detallesFinalizados = [];
    let categorias = [];

    // Procesar los datos
    for (let i = 1; i <= 14; i++) {
        if (data[i]) {
            detallesEspera.push(data[i].mantenimientos_espera);
            detallesFinalizados.push(data[i].mantenimientos_finalizados);
            categorias.push('D-' + i);
        }
    }

    let options = {
        series: [{
            name: 'Detalles en Espera',
            data: detallesEspera
        }, {
            name: 'Detalles Finalizados',
            data: detallesFinalizados
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
                    return val + ' detalles'
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

    const DetallesAnualChart = (function() {
        function createChart(element, data) {
            let height = parseInt(KTUtil.css(element, 'height'));
            let labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
            let borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
    
            let detallesEspera = [];
            let detallesFinalizados = [];
            let categorias = [];
    
            // Procesar los datos
            for (let i = 1; i <= 14; i++) {
                if (data[i]) {
                    detallesFinalizados.push(data[i].mantenimientos_finalizados);
                    detallesEspera.push(data[i].mantenimientos_espera);
                    categorias.push('D-' + i);
                }
            }
    
            let options = {
                series: [{
                    
                    name: 'Detalles Finalizados',
                    data: detallesFinalizados
                }, {
                    name: 'Detalles en Espera',
                    data: detallesEspera
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
                            return val + ' detalles'
                        }
                    }
                },
                colors: ['#2358E5', '#0BCE32'],
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
            console.log("DOM cargado, iniciando script del gráfico de detalles anual");
            let element = document.getElementById('detallesAnual');
            console.log("Elemento encontrado:", element);
            
            if (!element) {
                console.log("Elemento 'detallesAnual' no encontrado. Abortando inicialización del gráfico.");
                return;
            }
    
            // Hacer la llamada a la API
            fetch('/api/dashboardGenerales3')
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
    document.addEventListener('DOMContentLoaded', DetallesAnualChart.init);