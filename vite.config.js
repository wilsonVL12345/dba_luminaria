import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                
                'resources/assets/plugins/custom/datatables/datatables.bundle.css ',
                'resources/assets/plugins/global/plugins.bundle.css ',
                'resources/assets/css/style.bundle.css',
                'resources/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',
                'resources/assets/css/selectMultiple.css',
                'resources/assets/css/index/principal.css',
                'resources/js/app.js',

                'resources/js/dashboards/chatdetalles.js',


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
