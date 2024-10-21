import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                
                /* 'resources/assets/plugins/custom/datatables/datatables.bundle.css ',
                'resources/assets/plugins/global/plugins.bundle.css ',
                'resources/assets/css/style.bundle.css',
                'resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
                'resources/assets/css/selectMultiple.css',
                'resources/assets/css/index/principal.css', */

                'resources/js/app.js',

                /* 'resources/js/dashboards/chatdetalles.js',

                'resources/js/dashboards/chatinspecciones.js',
                'resources/js/dashboards/chartproyectos.js',
                'resources/js/dashboards/detallesAnual.js',
                'resources/js/dashboards/inspeccionAnual.js',
                'resources/js/dashboards/proyectoAnual.js',
                // 'resources/js/scripts.bundle.js', 
                'resources/js/custom/apps/customers/list/export.js',
                'resources/js/custom/apps/customers/list/list.js',
                'resources/js/custom/apps/customers/add.js',
                'resources/js/ejecutarTrabajo/Empezar.js',
                'resources/js/consultaAtencion/atencion.js',
                'resources/js/widgets.bundle.js',
                'resources/js/custom/widgets.js',
                'resources/js/custom/apps/chat/chat.js',
                'resources/js/custom/utilities/modals/upgrade-plan.js',
                'resources/js/custom/utilities/modals/create-app.js',
                'resources/js/custom/utilities/modals/new-target.js',
                'resources/js/custom/utilities/modals/users-search.js',
                'resources/js/distrito/app.js',
                'resources/js/equipos/app.js',
                'resources/js/inspeccion/realizado.js',
                'resources/js/proyectos/proyecto.js',
                'resources/js/proyectos/detallesProy.js',
                'resources/js/proyectos/ejecutarProyecto.js',
                'resources/js/proyectos/selecMultiplebotones.js',
                'resources/js/enviarForm.js',
                'resources/js/distrito/actualizacionzona.js',
                'resources/js/usuario/tabla.js',
                'resources/js/usuario/confirmarDeleteRestablecer.js',
                'resources/js/flatpickrAge.js',
                'resources/js/agendar/filtraUrb.js',
                'resources/js/agendar/apoyocarro.js',
                'resources/js/inspeccion/enEspera/tabaespe.js',
                'resources/js/inspeccion/enEspera/filtraUrbInspEsp.js',
                'resources/js/inspeccion/realizado/tablareali.js',
                'resources/js/inspeccion/realizado/filtraUrbInspRea.js',
                'resources/js/realizarTrabajo/datetableRealizar.js',
                'resources/js/ejecutarTrabajo/insertarComponentes.js',
                'resources/js/detallesGenerales/realizado/tablarealizado.js',
                'resources/js/detallesGenerales/espera/carroapoyo.js',
                'resources/js/detallesGenerales/espera/filtraUrbmodif.js',
                'resources/js/detallesGenerales/espera/datetableEspera.js',
                'resources/js/proyectos/almacen/tablaalmacen.js',
                'resources/js/proyectos/almacen/filtraUrbanizacion.js',
                'resources/js/proyectos/almacen/filtUrbaEdit.js',
                'resources/js/proyectos/lumRetirada/filtraurb.js',
                'resources/js/proyectos/lumRetirada/filtraurbEdit.js',
                'resources/js/proyectos/almacenejecutada/filtrarUrbaEjecutadas.js',
                'resources/js/proyectos/lumRetirada/datetable.js',
                'resources/js/proyectos/almacenejecutada/datetablefinal.js',
                'resources/js/distrito/datetable.js',
                'resources/js/distrito/loading.js',
                'resources/js/equipos/equipamiento/tablaequipos.js',
                'resources/js/equipos/accesorios/tablaAccesorios.js',
                'resources/js/detallesGenerales/realizado/filtraurbreal.js',
                'resources/js/detallesGenerales/realizado/apoyoreal.js',
                'resources/js/reelevamientos/dropzone.js',
                'resources/js/reelevamientos/filtUrba.js',
                'resources/js/reelevamientos/tablaReele.js',
                'resources/js/reelevamientos/filtUrbMod.js',
                 */

            ],
            refresh: true,
        }),
    ],
     resolve: {
        alias: {
            '$': 'jquery',
        },
    }, 
    
});
