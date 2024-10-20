import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                
                'recources/assets/plugins/custom/datatables/datatables.bundle.css ',
                'recources/assets/plugins/global/plugins.bundle.css ',
                'recources/assets/css/style.bundle.css',
                'recources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
                'recources/assets/css/selectMultiple.css',
                'recources/assets/css/index/principal.css',

                'recources/js/dashboards/chatdetalles.js',


            ],
            refresh: true,
        }),
    ],
    
});
