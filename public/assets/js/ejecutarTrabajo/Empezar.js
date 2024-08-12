/* let countTrabajo = 1;
function agrega() {


    const contenedor = document.createElement('div');
    contenedor.innerHTML = ` <div class="mb-3">
     <label for="txtitem" class="form-label">Nombre Item</label>
             <select type="text" id="txtitem" name="campoitem[${countTrabajo}][txtitem]" class="form-select" required>
             <option value="" disabled selected >Seleccione</option>
             </select>
             </div>
             
             <div class="mb-3">
             <label for="txtnoreutilizables" class="form-label">No Reutilizables</label>
             <input type="number" id="txtnoreutilizables" name="camponoreutilizables[${countTrabajo}][txtnoreutilizables]" required>
             </div>
             <div class="mb-3">
             <label for="txtobservaciones" class="form-label">Observaciones</label>
             <input type="text" id="txtobservaciones" name="campoobservaciones[${countTrabajo}][txtobservaciones]" placeholder="ninguna" >
             </div>
             <button type="button" onclick="eliminarMante(this)">Eliminar</button>
             `;
    document.getElementById('mantenimientoContainer').appendChild(contenedor);
    countTrabajo++;

    fetch('/api/lista/accesorios')
        .then(Response => Response.json())
        .then(data => {
            // Obtener el último select creado dentro del nuevo contenedor
            const select = contenedor.querySelector(`select[name="campoitem[${countTrabajo - 1}][txtitem]"]`);
            data.forEach(accesorio => {
                var option = document.createElement('option');
                option.value = accesorio.id;
                option.textContent = accesorio.Nombre_Item;
                select.appendChild(option);
            });
            console.log(data);
        })
        .catch(error => {
            console.error('Error al obtener los datos de los accesorios:', error);
        });
}
function eliminarMante(button) {
    const contenedor = button.parentNode;
    contenedor.parentNode.removeChild(contenedor);

}
 */
