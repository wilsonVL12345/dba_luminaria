/* document.addEventListener('DOMContentLoaded', function() {
    

    let element = document.getElementById('inspeccionAnual');
    

    if (!element) {
        return;
    }

    // Hacer la llamada a la API
    fetch('/api/dashboardGenerales4')
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

    let inspeccionesEspera = [];
    let inspeccionesFinalizados = [];
    let categorias = [];

    // Procesar los datos
    for (let i = 1; i <= 14; i++) {
        if (data[i]) {
            inspeccionesEspera.push(data[i].inspecciones_espera);
            inspeccionesFinalizados.push(data[i].inspecciones_realizadas);
            categorias.push('D-' + i);
        }
    }

    let options = {
        series: [{
            name: 'Inspecciones en Espera',
            data: inspeccionesEspera
        }, {
            name: 'Inspecciones Finalizados',
            data: inspeccionesFinalizados
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
                    return val + ' inspecciones'
                }
            }
        },
        colors: ['#3478C0', '#6E9E3E'],
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

    const InspeccionAnualChart = (function() {
        function createChart(element, data) {
            let height = parseInt(KTUtil.css(element, 'height'));
            let labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
            let borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
            let inspeccionesEspera = [];
            let inspeccionesFinalizados = [];
            let categorias = [];
    
            // Procesar los datos
            for (let i = 1; i <= 14; i++) {
                if (data[i]) {
                    inspeccionesEspera.push(data[i].inspecciones_espera);
                    inspeccionesFinalizados.push(data[i].inspecciones_realizadas);
                    categorias.push('D-' + i);
                }
            }
    
            let options = {
                series: [{
                    name: 'Inspecciones en Espera',
                    data: inspeccionesEspera
                }, {
                    name: 'Inspecciones Finalizados',
                    data: inspeccionesFinalizados
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
                            return val + ' inspecciones'
                        }
                    }
                },
                colors: ['#0ad1c8', '#0b6477'],
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
            
            let element = document.getElementById('inspeccionAnual');
            
            
            if (!element) {
                
                return;
            }
    
            // Hacer la llamada a la API
            fetch('/api/dashboardGenerales4')
                .then(response => response.json())
                .then(data => {
                    
                    createChart(element, data);
                })
                .catch(error => console.error('Error al obtener datos de la API:', error));
        }
    
        return {
            init: init
        };
    })();
    
    // Inicializar el gráfico cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', InspeccionAnualChart.init);