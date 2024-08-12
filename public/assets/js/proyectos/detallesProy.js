/* // Seleccionar todos los botones que abren el modal
const modalButtons = document.querySelectorAll('[data-bs-target^="#Modaldetalles"]');

function crearTablaLuminariasReutilizadas(datos, encabezados, contenedorId) {
    let table = document.createElement('table');
    let thead = table.createTHead();
    let trHead = thead.insertRow();
    for (let i = 0; i < encabezados.length; i++) {
        let th = document.createElement('th');
        th.textContent = encabezados[i];
        trHead.appendChild(th);
    }

    let tbody = table.createTBody();
    for (let j = 0; j < datos.length; j++) {
        let trBody = tbody.insertRow();
        for (let k = 0; k < encabezados.length; k++) {
            let td = trBody.insertCell();
            td.textContent = datos[j][encabezados[k]];
        }
    }

    let contenedor = document.getElementById(contenedorId);
    contenedor.appendChild(table);
}

// Agregar un evento click a cada botón
modalButtons.forEach(button => {
    button.addEventListener('click', function () {
        // Obtener el ID del proyecto
        const proyectoId = this.dataset.proyectoId;

        // Realizar solicitudes a la API para obtener los datos relacionados con el proyecto
        obtenerLuminariasReutilizadas(proyectoId);
        console.log(proyectoId);
    });
});

// Función para obtener las luminarias reutilizadas desde la API
function obtenerLuminariasReutilizadas(proyectoId) {
    // Realizar la solicitud a la API para obtener las luminarias reutilizadas del proyecto
    fetch('/datosreutilizados/proyecto/${proyectoId}')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Crear la tabla con los datos de las luminarias reutilizadas
            crearTablaLuminariasReutilizadas(data, ['Nombre_Item', 'Cantidad', 'Disponibles', 'Observaciones'], 'luminariasReutilizadasContainer');
        })
        .catch(error => {
            console.error('Error al obtener las luminarias reutilizadas:', error);
        });
}



 */








/* fetch('/api/datosreutilizados/proyecto')
    .then(Response => Response.json())
    .then(data => {
        console.log(data);
        // Función para crear una tabla
        function crearTabla(datos, encabezados, contenedorId) {
            let table = document.createElement('table');
            let thead = table.createTHead();
            let trHead = thead.insertRow();
            for (let i = 0; i < encabezados.length; i++) {
                let th = document.createElement('th');
                th.textContent = encabezados[i];
                trHead.appendChild(th);
            }

            let tbody = table.createTBody();
            for (let j = 0; j < datos.length; j++) {
                let trBody = tbody.insertRow();
                for (let k = 0; k < encabezados.length; k++) {
                    let td = trBody.insertCell();
                    td.textContent = datos[j][encabezados[k]];
                }
            }

            let contenedor = document.getElementById(contenedorId);
            contenedor.appendChild(table);
        }

        crearTabla(data, ['Nombre_Item', 'Cantidad', 'Disponibles', 'Observaciones'], 'luminariasReutilizadasContainer');
    })
    .catch(error => {
        console.error('Error al obtener los datos de los accesorios:', error);
    }); */