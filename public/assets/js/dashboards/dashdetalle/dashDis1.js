

// Cargar la librería de Google Charts
google.charts.load('current', {'packages':['corechart']});

// Callback para dibujar todos los gráficos cuando la librería esté cargada
google.charts.setOnLoadCallback(fetchDataAndDrawCharts);

function fetchDataAndDrawCharts() {
  // Hacer una petición AJAX para obtener los datos de la API
  $.ajax({
    url: '/api/dashboardGenerales',
    method: 'GET',
    success: function(response) {
      // Iterar sobre los distritos y dibujar cada gráfico
      for (let i = 1; i <= 14; i++) {
        if(response[i]) {  // Verificar si el distrito existe en la respuesta
          drawChart(response[i], i);
        } else {
          console.warn(`Datos no encontrados para el distrito ${i}`);
        }
      }
    },
    error: function(error) {
      console.error('Error al obtener los datos:', error);
    }
  });
}

function drawChart(distritoDatos, distritoNumero) {
  let data = new google.visualization.DataTable();
  data.addColumn('string', 'Actividad');
  data.addColumn('number', 'Cantidad');
  
  data.addRows([
      ['Proyectos En espera', distritoDatos.proyectos_espera || 0],
      ['Proyectos Finalizados', distritoDatos.proyectos_finalizados || 0],
      ['Mantenimientos En espera', distritoDatos.mantenimientos_espera || 0],
      ['Mantenimientos Finalizados', distritoDatos.mantenimientos_finalizados || 0],
      ['Inspecciones Realizadas', distritoDatos.inspecciones_realizadas || 0]
  ]);
  
  let options = {
      // title: `Actividades Distritales - Distrito ${distritoNumero}`,
      colors: ['#266232', '#58B26A', '#7D2121', '#CB6B6B', '#C4C4C4'],
      width: 640,
      height: 480
  };
  
  let chart = new google.visualization.PieChart(document.getElementById(`dis${distritoNumero}`));
  chart.draw(data, options);
}
