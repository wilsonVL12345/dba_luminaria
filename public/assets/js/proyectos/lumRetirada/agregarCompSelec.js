//PARA LA PARTE DE LUMINARIAS RETIRADAS *9-----------------------------------------------------------------------------------------------------------------------------
$(document).ready(function() {
    let componenteCounts = 0;

    // Cargar opciones del selector al inicio
    cargarOpcionesSelectorr('#txtitem');

    $("#agregaComponentess").click(function() {
        componenteCounts++;
        let nuevoComponente = `
            <div class="row mb-5">
                <div class="row" id="formcomMalEstado">
                    <div class="col-md-6 mb-3">
                        <label for="componente" class="required fs-5 fw-bold mb-2">Componente</label>
                        <select class="form-control form-select-solid" data-control="select2" data-search="false" data-hide-search="true" data-placeholder="Selecione..." name="campoitem[${componenteCounts}][txtitem]" id="txtitem_${componenteCounts}" required>
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="txtreutilizables" class="required fs-5 fw-bold mb-2">Reutilizable
                        										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números positivos asta max 1-500"></i>

                                                                </label>
                        <input type="text" class="form-control form-control-solid" id="txtreutilizables" name="camporeutilizables[${componenteCounts}][txtreutilizables]" pattern="^([1-9][0-9]{0,2}|500)$" placeholder="Ingresar Cantidad" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="txtnoreutilizables" class="required fs-5 fw-bold mb-2">No Reutilizable

                                                                </label>
                        <input type="text" class="form-control form-control-solid" id="txtnoreutilizables" name="camponoreutilizables[${componenteCounts}][txtnoreutilizables]" pattern="^([1-9][0-9]{0,2}|500)$" placeholder="Ingresar Cantidad" required>
                    </div>
                    <div class="col-md-2 mb-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarReu(this)">Eliminar</button>
                    </div>
                </div>
            </div>
        `;
        
        $("#listacomp").append(nuevoComponente);
        
        // Cargar opciones para el nuevo selector
        cargarOpcionesSelectorr(`#txtitem_${componenteCounts}`);
    });
});

function eliminarReu(button) {
    $(button).closest('.row.mb-5').remove();
}

function cargarOpcionesSelectorr(selector) {
    $.ajax({
        url: '/api/lista/accesorios',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let options = '<option value="">Seleccione...</option>';
            data.forEach(function(item) {
                options += `<option value="${item.Nombre_Item}">${item.Nombre_Item}</option>`;
            });
            $(selector).html(options).trigger('change');
            
            // Inicializar Select2 después de cargar las opciones
            $(selector).select2({
                dropdownParent: $(selector).parent()
            });
        },
        error: function(error) {
            console.error('Error al cargar los accesorios:', error);
        }
    });
}
//esta parte de codigo es para  proyectos luminaria retiradas---------------------------------------------------------------------
