/* import './bootstrap';
import 'laravel-datatables-vite';
import Alpine from 'alpinejs';
import '../js/dashboards/chatdetalles';

window.Alpine = Alpine;

Alpine.start();
 */

import './bootstrap';
// import $ from 'jquery';
/*  window.$ = window.jQuery = $;
 import 'select2';  */
//  import 'laravel-datatables-vite';
import Alpine from 'alpinejs'; 

// Inicializa select2 después de que el DOM esté list
import '../js/dashboards/chatdetalles';

window.Alpine = Alpine;
Alpine.start();

// Inicializa select2 después de que el DOM esté listo
$(document).ready(function() {
    $('.select2').select2();
});