   
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<!-- Select2 JS -->        
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}

{{-- <script>var hostUrl = "{{ asset('assets/') }}";</script>



<!-- Page Vendors Javascript(used by this page) -->
{{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}

{{-- <script src="{{ asset('assets/js/custom/apps/customers/list/export.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/customers/list/list.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/customers/add.js') }}"></script> --}}

<!-- scrip   -->
<script src="{{ asset('assets/js/consultaAtencion/atencion.js') }}"></script>
 
{{-- <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script> --}}

{{-- 
<script src="{{ asset('assets/js/equipos/app.js') }}" defer></script>
<script src="{{ asset('assets/js/inspeccion/realizado.js') }}" defer></script>
--}}
<script src="{{ asset('assets/js/enviarForm.js') }}" defer></script>
<script src="{{ asset('assets/js/confirmaRegistrar.js') }}" defer></script>

 <script src="{{ asset('assets/js/flatpickrAge.js') }}" defer></script>
{{-- 

{{-- 




--}}


<script src="{{ asset('assets/js/confirmaEliminar.js') }}" defer></script> 


{{-- 



 

{{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
    $('.select-team-member').select2();    
    });
</script> 

<script>

    $(document).ready(function() {
    $('select[name="country"]').select2({
        dropdownParent: $('#kt_modal_add_customer')
    });
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    if (typeof jQuery != 'undefined' && typeof $.fn.select2 != 'undefined') {
      $('.select-team-member').select2();
      
      $('select[name="country"]').select2({
        dropdownParent: $('#kt_modal_add_customer')
      });
    } else {
      console.error('jQuery o Select2 no están cargados correctamente');
    }
  }, 100); // Retraso de 100ms
});
</script>
<script>
  $(document).ready(function() {
      if ($.fn.DataTable.isDataTable('#kt_datatable_example')) {
          $('#kt_datatable_example').DataTable().destroy();
      }
      $('#kt_datatable_example').DataTable({
          // Opciones de inicialización
      });
  });
</script>

  


