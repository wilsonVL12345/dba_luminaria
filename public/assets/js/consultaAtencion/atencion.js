document.addEventListener('DOMContentLoaded', function () {
    const buscarPor = document.getElementById('txtbuscarpor');
    const txtbuscar = document.getElementById('txtbuscar');
})
function buscarinfo() {

    console.log(txtbuscar.value);
    if (buscarPor.value == 'Nro_Sisco') {
        fetch('/api/atencion/apidetall')
            .then(Response => Response.json())
            .then(data => {
                // Aquí puedes crear un elemento HTML para mostrar los datos
                const datosContainer = document.createElement('div');
                datosContainer.classList.add('datos-container');

                // Recorrer los datos y agregarlos al contenedor
                data.forEach(buscaDetalles => {
                    const itemContainer = document.createElement('div');
                    itemContainer.classList.add('item-container');

                    const nombreItem = document.createElement('p');
                    nombreItem.textContent = `Nombre: ${buscaDetalles.Zona}`;

                    // Aquí puedes agregar más información del buscaDetalles según tus necesidades

                    itemContainer.appendChild(Tipo_Trabajo);
                    datosContainer.appendChild(itemContainer);
                });

                // Agregar el contenedor de datos al DOM
                const container = document.querySelector('informacion'); // Reemplaza '#mi-container' con el selector adecuado
                container.appendChild(datosContainer);

                console.log(txtbuscar.value);
            })
            .catch(error => {
                console.error('Error al obtener los detalles de trabajo de busqueda:', error);
            });


    }
}
