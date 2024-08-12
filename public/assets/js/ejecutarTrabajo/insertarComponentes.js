$(document).ready(function() {
    let componenteCount = 1;

    // Cargar opciones del selector al inicio
    cargarOpcionesSelector();

    $("#insertarComponentes").click(function() {
        componenteCount++;
        let nuevoComponente = `
            <div class="row mb-5">
                <div class="row" id="formcomMalEstado${componenteCount}">
                    <div class="col-md-6 mb-3">
                        <label for="componente${componenteCount}" class="required fs-5 fw-bold mb-2">Componente</label>
                        <select class="form-control form-select-solid" data-control="select2" data-search="false" data-hide-search="true" data-placeholder="Selecione..." name="campoitem[${componenteCount}]" id="campoitem${componenteCount}" required>
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="txtcod${componenteCount}" class="required fs-5 fw-bold mb-2">Cantidad
                        	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números positivos asta max 1-500"></i>

                        </label>
                        <input type="text" class="form-control form-control-solid" id="campocantidad${componenteCount}" name="campocantidad[${componenteCount}]" pattern="^([1-9][0-9]{0,2}|500)$" placeholder="Ingresar Cantidad" required>
                    </div>
                    <div class="col-md-3 mb-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarAccesorio(this)">Delete</button>
                    </div>
                </div>
            </div>
        `;
        
        $("#listacomponentes").append(nuevoComponente);
        
        // Cargar opciones para el nuevo selector
        cargarOpcionesSelector(`#campoitem${componenteCount}`);
        
        // Inicializar Select2 para el nuevo selector
        $(`#campoitem${componenteCount}`).select2();
    });
});

function eliminarAccesorio(button) {
    $(button).closest('.row.mb-5').remove();
}

function cargarOpcionesSelector(selector = '#campoitem') {
    $.ajax({
        url: '/api/lista/accesorios',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let options = '<option value="">Seleccione...</option>';
            data.forEach(function(item) {
                options += `<option value="${item.id}">${item.Nombre_Item}</option>`;
            });
            $(selector).html(options);
        },
        error: function(error) {
            console.error('Error al cargar los accesorios:', error);
        }
    });
}