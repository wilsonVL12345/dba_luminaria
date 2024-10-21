// Inicializa los componentes de Metronic después de que el DOM esté listo

import './bootstrap';

// import $ from 'jquery';
/*  window.$ = window.jQuery = $;
 import 'select2'; 
  */
//  import 'laravel-datatables-vite';
import Alpine from 'alpinejs'; 

// Inicializa select2 después de que el DOM esté list
/* import '../js/dashboards/chatdetalles';

import '../js/dashboards/chatinspecciones';
import '../js/dashboards/chartproyectos';
import '../js/dashboards/detallesAnual';
import '../js/dashboards/inspeccionAnual';
import '../js/dashboards/proyectoAnual'; */

// import '../assets/plugins/global/plugins.bundle';
// import '../js/scripts.bundle'; 
// import '../assets/plugins/custom/datatables/datatables.bundle';
// import '../assets/plugins/custom/fullcalendar/fullcalendar.bundle';

import '../js/custom/apps/customers/list/export';
import '../js/custom/apps/customers/list/list';
import '../js/custom/apps/customers/add';

/* import '../js/ejecutarTrabajo/Empezar';
import '../js/consultaAtencion/atencion'; */

import '../js/widgets.bundle';
import '../js/custom/widgets';
import '../js/custom/apps/chat/chat';
import '../js/custom/utilities/modals/upgrade-plan';
import '../js/custom/utilities/modals/create-app';
import '../js/custom/utilities/modals/new-target';
import '../js/custom/utilities/modals/users-search';
/* 
import '../js/distrito/app';
import '../js/equipos/app';
import '../js/inspeccion/realizado';
import '../js/proyectos/proyecto';
import '../js/proyectos/detallesProy';
import '../js/proyectos/ejecutarProyecto';
import '../js/proyectos/selecMultiplebotones';
import '../js/enviarForm';
import '../js/distrito/actualizacionzona';

import '../js/usuario/tabla';
import '../js/usuario/confirmarDeleteRestablecer';

import '../js/flatpickrAge';
import '../js/agendar/filtraUrb';
import '../js/agendar/apoyocarro';

import '../js/inspeccion/enEspera/tabaespe';
import '../js/inspeccion/enEspera/filtraUrbInspEsp';
import '../js/inspeccion/realizado/tablareali';
import '../js/inspeccion/realizado/filtraUrbInspRea';

import '../js/realizarTrabajo/datetableRealizar';
import '../js/ejecutarTrabajo/insertarComponentes';


import '../js/detallesGenerales/realizado/tablarealizado';
import '../js/detallesGenerales/espera/carroapoyo';
import '../js/detallesGenerales/espera/filtraUrbmodif';
// import '../js/detallesGenerales/espera/datetableEspera';

import '../js/proyectos/almacen/tablaalmacen';
import '../js/proyectos/almacen/filtraUrbanizacion';
import '../js/proyectos/almacen/filtUrbaEdit';
import '../js/proyectos/lumRetirada/filtraurb';
import '../js/proyectos/lumRetirada/filtraurbEdit';
import '../js/proyectos/almacenejecutada/filtrarUrbaEjecutadas';
import '../js/proyectos/lumRetirada/datetable';
import '../js/proyectos/almacenejecutada/datetablefinal'; */

/* import '../js/distrito/datetable';
import '../js/distrito/loading';
import '../js/equipos/equipamiento/tablaequipos';
import '../js/equipos/accesorios/tablaAccesorios';
import '../js/detallesGenerales/realizado/filtraurbreal';
import '../js/detallesGenerales/realizado/apoyoreal';

import '../js/reelevamientos/dropzone';
import '../js/reelevamientos/filtUrba';
import '../js/reelevamientos/tablaReele';
import '../js/reelevamientos/filtUrbMod'; */

window.Alpine = Alpine;
Alpine.start();


// Inicializa select2 después de que el DOM esté listo
$(document).ready(function() {
    $('.select2').select2();


    
}
);