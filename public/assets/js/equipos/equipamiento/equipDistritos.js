// este es el js para que muestre los equipamientos de los diferentes distritos
$(document).ready(function() {
    let lugarDesignado = $('#app').data('lugarDesignado');
    
    
    // Ocultar todos los divs inicialmente
    $('div[id^="d-"]').hide();
    
    if (lugarDesignado === 'Alcaldia') {
        // Si es 'Alcaldia', mostrar todos los divs
        $('div[id^="d-"]').show();
    } else {
        // Convertir a número si no es 'Alcaldia'
        lugarDesignado = parseInt(lugarDesignado);
        
        // Mostrar el div específico basado en Lugar_Designado
        if (lugarDesignado >= 1 && lugarDesignado <= 14) {
            $('#d-' + lugarDesignado).show();
        }
    }
}); 

$(document).on('click', '[id^="d-"]', function() {
    let districtId = $(this).attr('id').split('-')[1];
    localStorage.setItem('selectedDistrict', districtId);
});   

