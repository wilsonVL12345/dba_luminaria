/* const input = document.querySelector('#filtrar')
const lista = document.querySelector('#us')

window.addEventListener('DOMContentLoaded', async () => {
    const data = await listarealizado()
    inspeccion(data.Estado)
})

async function listarealizado() {
    const response = await fetch('/api/inspeccion/realizado')
    return await response.json()

}

input.addEventListener('keyup', e => {
    console.log(input.value)
})

const inspeccion = arrayinspecc => inspe.map(insp =>
)
function inspeccion(inspe) {

} */
// esta parte es para el registro de inspecciones para filtrar urbanizaciones segun el distrito que selecciones
$(document).ready(function () {
    const $distritoSelect = $('#txtdistirto');
    const $zonaUrbanizacionSelect = $('#txturbs');

    $.ajax({
        url: '/api/apidistritos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            function actualizarZonasUrbanizaciones() {
                const distritoSeleccionado = $distritoSelect.val();
                $zonaUrbanizacionSelect.empty().append('<option value="">Seleccione...</option>');

                const zonasUrbanizaciones = data.filter(item => item.Nrodistrito == distritoSeleccionado);

                $.each(zonasUrbanizaciones, function (index, item) {
                    $zonaUrbanizacionSelect.append(`<option value="${item.nombre_urbanizacion}">${item.nombre_urbanizacion}</option>`);
                });

                // Actualizar select2 después de modificar las opciones
                $zonaUrbanizacionSelect.select2();
            }

            $distritoSelect.on('change', actualizarZonasUrbanizaciones);
            actualizarZonasUrbanizaciones(); // Inicializar las zonas/urbanizaciones al cargar la página
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos de los distritos:', error);
        }
    });
});
// esta parte es para el registro de inspecciones para filtrar urbanizaciones segun el distrito que selecciones


/* $(document).ready(function () {
    const $distselect = $('#txtdistrito');
    const $zonaUrbselect = $('#txtzurbanizacion');
    let selectedZonaUrbanizacion = $zonaUrbselect.val(); // Guardar la urbanización seleccionada

    function actualizarZonasUrbanizaciones(data) {
        const distritoSeleccionado = $distselect.val();
        $zonaUrbselect.empty().append('<option value="">Seleccione...</option>');

        const zonasUrbanizaciones = data.filter(item => item.Nrodistrito == distritoSeleccionado);

        $.each(zonasUrbanizaciones, function (index, item) {
            $zonaUrbselect.append(`<option value="${item.nombre_urbanizacion}" ${item.nombre_urbanizacion == selectedZonaUrbanizacion ? 'selected' : ''}>${item.nombre_urbanizacion}</option>`);
        });

        // Actualizar select2 después de modificar las opciones
        $zonaUrbselect.select2();

        // Forzar la selección de la urbanización si hay una seleccionada
        if (selectedZonaUrbanizacion) {
            $zonaUrbselect.val(selectedZonaUrbanizacion).trigger('change');
        }
    }

    $.ajax({
        url: '/api/apidistritos',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Inicializar las zonas/urbanizaciones al cargar la página
            actualizarZonasUrbanizaciones(data);

            $distselect.on('change', function () {
                selectedZonaUrbanizacion = ''; // Resetear la urbanización seleccionada cuando se cambia el distrito
                actualizarZonasUrbanizaciones(data);
            });
        },
        error: function (xhr, status, error) {
            console.error('Error al obtener los datos de los distritos:', error);
        }
    });
});


 */


