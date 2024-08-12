// hace aparecer los botones para agregar  datos en accesotios luminarias 
$(document).ready(function() {
    $('#selector').select2();

    $('#selector').on('change', function() {
        let selectedValues = $(this).val();

        $('#btnAccesorio').toggle(selectedValues.includes('Accesorios'));
        $('#btnReacondicionado').toggle(selectedValues.includes('Lum. Reacondicionadas'));
        $('#btnLuminaria').toggle(selectedValues.includes('Luminarias LED'));
    });
});
// endhace aparecer los botones para agregar  datos en accesotios luminarias 
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
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarReu(this)">Delete</button>
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

// para la parte de proyectos almacen -------------------------------------------------------------------------------------------------
//la parte de accesorios agregar
//ACCESORIOS PARA LA PARTE DE MOSTRAR EL FORMULARIO 
$(document).ready(function() {
    let accesoriosCount = 0;
    // Cargar opciones del selector al inicio
    cargarOpcionesSelectoracc('#txtcomponentes');
  
    $("#btnAccesorio").click(function() {
        accesoriosCount++;
        let nuevoComponenteacc = `
            <div class="row mb-5">
                <div class="row" id="formcomMalEstado">
                    <div class="col-md-6 mb-3">
                        <label for="componente" class="required fs-5 fw-bold mb-2">Componente
                        
                        </label>
                        <select class="form-control form-select-solid" data-control="select2" data-search="false" data-hide-search="true" data-placeholder="Selecione..."  name="campocomponentes[${accesoriosCount}][txtcomponentes]" id="txtcomponentes_${accesoriosCount}" required>
                            <option value="">Seleccione...</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="txtcantidad" class="required fs-5 fw-bold mb-2">Cantidad
                        	<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números positivos asta max 1-500"></i>

                        </label>
                        <input type="text" class="form-control form-control-solid" id="txtcantidad[${accesoriosCount}]" name="campocantidad[${accesoriosCount}][txtcantidad]" pattern="^([1-9][0-9]{0,2}|500)$" placeholder="Ingresar Cantidad" required>
                    </div>
                    
                    <div class="col-md-2 mb-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarAccesorios(this)">Delete</button>
                    </div>
                </div>
            </div>
        `;
        
        $("#listaproy").append(nuevoComponenteacc);
         // Cargar opciones para el nuevo selector
         cargarOpcionesSelectoracc(`#txtcomponentes_${accesoriosCount}`);
       
        
    });
});

function eliminarAccesorios(button) {
    $(button).closest('.row.mb-5').remove();
}

function cargarOpcionesSelectoracc(selector) {
    $.ajax({
        url: '/api/lista/accesorios',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let options = '<option value="">Seleccione...</option>';
            data.forEach(function(item) {
                options += `<option value="${item.id}">${item.Nombre_Item}</option>`;
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




// para la parte de proyectos almacenar  luminarias led--------------------------------------------------------------------

$(document).ready(function() {
    let lumCount = 0;

    

    $("#btnLuminaria").click(function() {
        lumCount++;
        let nuevoComponenteled = `
            <div class="row mb-5">
                <div class="row" id="formcomMalEstado">
                        <div class="col-md-2 mb-3">
                            <label for="txtcod" class="required fs-5 fw-bold mb-2">Codigo Led</label>
                            <input type="number" class="form-control form-control-solid" id="txtcod" name="campocod[${lumCount}][txtcod]" placeholder="Ingresar Cantidad" required>
                        </div>
                        <div class="col-md-2 mb-3">
                                 <label for="txtpotencia" class="required fs-5 fw-bold mb-2">Potencia</label>
                                <select class="form-control form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Seleccione..." name="campopotencia[${lumCount}][txtpotencia]" id="txtpotencia" required>
                                    
                                <option value="" disabled selected>Seleccione...</option>
                                    <option value="75 Watts">75 Watts</option>
                                    <option value="150 Watts">150 Watts</option>
                                    <option value="200 Watts">200 Watts</option>
                                    <option value="250 Watts">250 Watts</option>
                                </select>

                               
                            </div>
                        <div class="col-md-3 mb-3">
                            <label for="txtmarca" class="required fs-5 fw-bold mb-2">Marca
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                            </label>
                            <input type="text" class="form-control form-control-solid" name="campomarca[${lumCount}][txtmarca]" id="txtmarca"  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\.]*" placeholder="Ingresar la marca" required>

                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="txtmodelo" class="required fs-5 fw-bold mb-2">Modelo
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números letras mayusculas y minusculas - ()"></i>

                            </label>
                            <input type="text" class="form-control form-control-solid" id="txtmodelo" name="campomodelo[${lumCount}][txtmodelo]" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\-\(\)\.]*"  placeholder="Ingresar el modelo" required>
                        </div>
                        
                        <div class="col-md-2 mb-3 d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarled(this)">Delete</button>
                        </div>
                </div>
            </div>
        `;
        
        $("#listaproy").append(nuevoComponenteled);
        
        
    });
});

function eliminarled(button) {
    $(button).closest('.row.mb-5').remove();
}




// para la parte de proyectos almacenar  luminarias  reacondicionadas----------------------------------------------------------------

$(document).ready(function() {
    let reuCount = 0;

    

    $("#btnReacondicionado").click(function() {
        reuCount++;
        let nuevoComponentereacon = `
            <div class="row mb-5">
                <div class="row" id="formcomMalEstado">
                    <div class="col-md-6 mb-3">
                        <label for="componente" class="required fs-5 fw-bold mb-2">Nombre Luminarias Rehabilitadas</label>
                          <input type="text" class="form-control form-control-solid" name="camponom[${reuCount}][txtnom]" id="txtnom_${reuCount}" placeholder="Ingresar Cantidad" required>

                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="txtreutilizables" class="required fs-5 fw-bold mb-2">Cantidad
					<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="Solo se permiten números positivos asta max 1-500"></i>

                        </label>
                        <input type="text" class="form-control form-control-solid" id="txtcant_${reuCount}" name="campocant[${reuCount}][txtcant]" pattern="^([1-9][0-9]{0,2}|500)$" placeholder="Ingresar Cantidad" required>
                    </div>
                    
                    <div class="col-md-2 mb-3 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-danger btn-sm" onclick="eliminarreacon(this)">Delete</button>
                    </div>
                </div>
            </div>
        `;
        
        $("#listaproy").append(nuevoComponentereacon);
        
        
        
    });
});

function eliminarreacon(button) {
    $(button).closest('.row.mb-5').remove();
}




