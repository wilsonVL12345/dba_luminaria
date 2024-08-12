/* let selectedStatesArray = [];

document.getElementById('states').addEventListener('focus', function () {
    document.getElementById('options-list').style.display = 'block';
});

document.getElementById('states').addEventListener('blur', function () {
    setTimeout(function () {
        document.getElementById('options-list').style.display = 'none';
    }, 100);
});

function selectOption(state) {
    const selectedOptions = document.getElementById('selected-options');
    const existingOption = Array.from(selectedOptions.children).find(option => option.textContent.trim().startsWith(state));

    if (!existingOption) {
        const span = document.createElement('span');
        span.className = 'selected-option';
        span.innerHTML = `${state} <span class="remove-option" onclick="removeOption(event, '${state}')">x</span>`;
        selectedOptions.appendChild(span);

        // Agregar el estado al array
        selectedStatesArray.push(state);
        updateHiddenField();
    }

    document.getElementById('states').value = '';
    document.getElementById('options-list').style.display = 'none';
}

function removeOption(event, state) {
    event.stopPropagation();
    const selectedOptions = document.getElementById('selected-options');
    const optionToRemove = Array.from(selectedOptions.children).find(option => option.textContent.trim().startsWith(state));
    if (optionToRemove) {
        selectedOptions.removeChild(optionToRemove);

        // Eliminar el estado del array
        selectedStatesArray = selectedStatesArray.filter(item => item !== state);
        updateHiddenField();
    }
}

function updateHiddenField() {
    // Unir los elementos del array en una cadena separada por comas
    document.getElementById('selectedStates').value = selectedStatesArray.join(',');
}

// Inicializar el campo oculto con las opciones preseleccionadas si es necesario
document.addEventListener('DOMContentLoaded', () => {
    updateHiddenField();
});
 */