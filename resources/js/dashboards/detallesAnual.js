

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
                colors: ['#45dfb1', '#80ed99'],
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
            
            let element = document.getElementById('detallesAnual');
            
            
            if (!element) {
                
                return;
            }
    
            // Hacer la llamada a la API
            fetch('/api/dashboardGenerales3')
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
    document.addEventListener('DOMContentLoaded', DetallesAnualChart.init);