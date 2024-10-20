
$(document).ready(function() {
    $('#selector').on('change', function() {
        if ($(this).val().includes('Apoyo Carro Canasta')) {
            $('#apoyo-distrito').show();
            $('#txtapoyo').attr('required', 'required');
        } else {
            $('#apoyo-distrito').hide();
            $('#txtapoyo').removeAttr('required');
        }
    });

    // Inicializar Select2
    $('[data-control="select2"]').select2();
});