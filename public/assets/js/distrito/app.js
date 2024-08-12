/* // Usar jQuery para manejar cambios en un select de Select2
$('.form-select').select2();
$('.form-select').on('change', function (e) {
    manejarCambioTipoUbicacion(); // Llamada a tu función existente
});
// Función para manejar el cambio de selección entre Zona/Urbanización y Avenida/Calle
function manejarCambioTipoUbicacion() {
    const zonaUrbanizacionAvenidaCalle = document.getElementById('txtagregar').value;
    const camposDistritoZonaUrbanizacion = document.getElementById('form-distritoZonaUrbanizacion');
    const camposDistritoZonaUrbanizacionaAvenidaCalle = document.getElementById('form-distritoZonaUrbanizacionAvenidaCalle');

    if (zonaUrbanizacionAvenidaCalle === 'txtzonaUr') {
        camposDistritoZonaUrbanizacion.style.display = 'block';
        camposDistritoZonaUrbanizacionaAvenidaCalle.style.display = 'none';
    } else if (zonaUrbanizacionAvenidaCalle === 'street') {
        camposDistritoZonaUrbanizacion.style.display = 'none';
        camposDistritoZonaUrbanizacionaAvenidaCalle.style.display = 'block';
    }
    else {
        camposDistritoZonaUrbanizacion.style.display = 'none';
        camposDistritoZonaUrbanizacionaAvenidaCalle.style.display = 'none';
    }
}
const tipoUbicacionSelect = document.getElementById('txtagregar');

// Agregar el event listener al cambio de selección
tipoUbicacionSelect.addEventListener('change', manejarCambioTipoUbicacion);

$('#txtagregar').on('change', function () {
    var option = $(this).val();

    var txtdistrit = $('#txtdistrit');
    var txtzonaUrbx = $('#txtzonaUrbx');
    var txtzonaUr = $('#txtzonaUr');
    var txtdistrito = $('#txtdistrito');
    var txtzonaUrbanizacion = $('#txtzonaUrbanizacion');
    var txtavenidacalle = $('#txtavenidacalle');
    var txtavc = $('#txtavc');

    // Habilitar o deshabilitar los campos requeridos según la opción seleccionada
    if (option === 'txtzonaUr') {
        txtdistrit.prop('required', true);
        txtzonaUrbx.prop('required', true);
        txtzonaUr.prop('required', true);
    } else {
        txtdistrit.prop('required', false);
        txtzonaUrbx.prop('required', false);
        txtzonaUr.prop('required', false);
    }

    if (option === 'street') {
        txtdistrito.prop('required', true);
        txtzonaUrbanizacion.prop('required', true);
        txtavenidacalle.prop('required', true);
        txtavc.prop('required', true);
    } else {
        txtdistrito.prop('required', false);
        txtzonaUrbanizacion.prop('required', false);
        txtavenidacalle.prop('required', false);
        txtavc.prop('required', false);
    }
}); */